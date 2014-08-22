<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Cliente
 *
 * @property integer $id
 * @property string $numero_cliente
 * @property string $rut
 * @property string $tipo
 * @property string $clave
 * @property string $remember_token
 * @property integer $id_persona
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\ClientePregunta[] $clientePreguntas
 * @property-read \Persona $persona
 * @property-read \Illuminate\Database\Eloquent\Collection|\Producto[] $productos
 * @property-read \Illuminate\Database\Eloquent\Collection|\Producto[] $productos2
 * @property-read \Illuminate\Database\Eloquent\Collection|\Telefono[] $telefonos
 * @property-read \Illuminate\Database\Eloquent\Collection|\Telefono[] $numeros
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereNumeroCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereRut($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereTipo($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereClave($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereIdPersona($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereDeletedAt($value)
 */
class Cliente extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table      = 'cliente';
	protected $primaryKey = 'id';
	protected $fillable   = array('id','numero_cliente','rut','clave');
	protected $hidden     = array('numero_cliente', 'clave');

	public function clientePreguntas()
	{
		return $this->hasMany('ClientePregunta','id_cliente');
	}

	public function persona () {
		return $this->hasOne('Persona','id', 'id_persona');
	}

	public function getAuthIdentifier() {
		return $this->getKey();
	}

	public function getAuthPassword() {
		return $this->clave;
	}

	public function getId() {
		return $this->id;
	}

	public function productos() {
		return $this->belongsToMany('Producto', 'cliente_producto', 'id_cliente', 'id_producto')->withpivot('monto','id_mes', 'numero_telefonico');
	}


	public function productos2() {
		return $this->belongsToMany('Producto', 'cliente_producto', 'id_cliente', 'id_producto')->withpivot('monto','id_mes', 'numero_telefonico')->whereBetween('id_mes', array(Carbon::today()->subMonths(6)->month, Carbon::today()->month))->groupBy('id_mes','numero_telefonico')->orderBy('id_mes','ASC');
	}

	public function telefonos() {
		return $this->hasMany('Telefono', 'id_cliente');
	}


	public function devuelveIdCliente($numeroCliente) {
		return Cliente::where('numero_cliente','=', $numeroCliente)->get()[0]['id'];
	}

	public function telefonosPorCliente($numero_cliente) {
		$idCliente = $this->devuelveIdCliente($numeroCliente);
		return Cliente::find($idCliente)->telefonos;
	}

	public function numeros() {
		return $this->hasMany('Telefono', 'id_cliente')->select('id','numero');
	}

	public static function productosPorMes($id, $mes) {
		return Cliente::find($id)->productos()->where('id_mes',$mes)->get()->toArray();
	}

	public static function getChartPie($id) {
		$data = array();
		try {
			foreach (Cliente::find($id)->productos2 as $value) {
				array_push($data,array(
					'producto' => $value->nombre,
					'numero'   => $value->pivot->numero_telefonico,
					'mes'      => Func::convNumberToMonth($value->pivot->id_mes),
					'monto'    => $value->pivot->monto,
					));
			}
		} catch(PDOException $exception) {
			return Response::make('Database error! ' . $exception->getCode());
		}
		return $data;
	}

	public static function getChartPieMonth($id, $mes) {
		$data = array();
		try {
			foreach (Cliente::find($id)->productos2()->where('id_mes',$mes)->get() as $value) {
				array_push($data,array(
					'producto' => $value->nombre,
					'numero'   => $value->pivot->numero_telefonico,
					'mes'      => Func::convNumberToMonth($value->pivot->id_mes),
					'monto'    => $value->pivot->monto,
					));
			}
		}
		catch(PDOException $exception) {
			return Response::make('Database error! ' . $exception->getCode());
		}
		return $data;
	}

	public static function getChartSerial($id = '') {
		$config = array(); $data = array(); $data2 = array(); $numbers = array(); $count = 0;
		try {
			foreach (Cliente::find($id)->productos2 as $value) {
				array_push($numbers, $value->pivot->numero_telefonico);
				if(isset($data[$value->pivot->id_mes])) {
					$data[$value->pivot->id_mes] = array_add($data[$value->pivot->id_mes], $value->pivot->numero_telefonico, $value->pivot->monto);
				} else {
					$data[$value->pivot->id_mes] = array( 'mes' => Func::convNumberToMonth($value->pivot->id_mes), $value->pivot->numero_telefonico => $value->pivot->monto, );
				}
			}
		} catch(PDOException $exception) {
			return Response::make('Database error! ' . $exception->getCode());
		}
		foreach ($data as $value) { $config['data'][] = $value; }
		foreach (array_unique($numbers) as $value) {
			$config['graphs'][] = array(
				"balloonText" => "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
				"fillAlphas"  => 1,
				"labelText"   => "",
				"labelRotation" => 45,
				"lineAlpha"   => 1,
				"title"       => "Numero ". ++$count . " - " . $value,
				"type"        => "column",
				"color"       => "#000000",
				"valueField"  => $value,
				);
		}
		return $config;
	}

	public static function getChartStacked($id = '') {
		$config = array(); $data = array(); $data2 = array(); $numbers = array(); $count = 0;
		try {
			foreach (Cliente::find($id)->productos2 as $value) {
				array_push($numbers, $value->pivot->numero_telefonico);
				if(isset($data[$value->pivot->id_mes])) {
					$data[$value->pivot->id_mes] = array_add($data[$value->pivot->id_mes], $value->pivot->numero_telefonico, $value->pivot->monto);
				} else {
					$data[$value->pivot->id_mes] = array( 'mes' => Func::convNumberToMonth($value->pivot->id_mes), $value->pivot->numero_telefonico => $value->pivot->monto, );
				}
			}
		} catch(PDOException $exception) {
			return Response::make('Database error! ' . $exception->getCode());
		}
		foreach ($data as $value) { $config['data'][] = $value; }
		foreach (array_unique($numbers) as $value) {
			$config['graphs'][] = array(
				"balloonText" => "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
				"fillAlphas"  => 1,
				"labelText"   => "$[[value]]",
				"labelRotation" => 45,
				"lineAlpha"   => 1,
				"title"       => "Numero ". ++$count . " - " . $value,
				"type"        => "column",
				"color"       => "#000000",
				"valueField"  => $value,
				);
		}
		return $config;
	}

	public static function existeFechaArreglo($arreglo, $year, $month) {
		foreach ($arreglo as $key => $value) {
			$dt   = new Carbon($value['fecha']);
			$mes  = $dt->month;
			$ano  = $dt->year;
			if( ($month == $mes) && ($year == $ano) )
			{
				return $key;
			}
		}
		return false;
	}

	public static function montoTotal($id) {
		$arreglo = array(); $config = array(); $numbers = array(); $count = 0;
		foreach (Cliente::find($id)->telefonos as $value)
		{
			$idTelefono = $value['id'];
			$numero     = $value['numero'];
			array_push($numbers, $numero);

			$hasta = Carbon::now();
			$desde = Carbon::now()->subMonths(13);

			$montosClientes = Telefono::find($idTelefono)->montos()->whereBetween('fecha', array($desde, $hasta))->get();
			//$montosClientes = Telefono::find($idTelefono)->montos->take(13) as $value2;
			foreach ($montosClientes as $value2)
			{
				$dt         = new Carbon($value2->fecha);
				$mes        = $dt ->month;
				$year       = $dt ->year;
				$fecha      = $value2->fecha;
				$montoTotal = $value2->monto_total;
				if((!empty($arreglo)) && (is_numeric(Cliente::existeFechaArreglo($arreglo, $year, $mes)))) {
					$indice = Cliente::existeFechaArreglo($arreglo, $year, $mes);
					$arreglo[$indice] = array_add($arreglo[$indice], $numero, $montoTotal);
				}
				else {
					$arreglo[] = array("fecha" => $fecha, $numero => $montoTotal);
				}
			}
		}
		foreach ($arreglo as $value) { $config['data'][] = $value; }

		foreach (array_unique($numbers) as $value) {
			$config['graphs'][] = array(
				"balloonText" => "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
				"fillAlphas"  => 1,
				"labelText"   => "",
				"lineAlpha"   => 1,
				"title"       => "Numero ". ++$count . " - " . $value,
				"type"        => "column",
				"color"       => "#000000",
				"valueField"  => $value,
				);
		}
		return $config;
	}

}