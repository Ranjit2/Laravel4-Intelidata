<?php

class ClienteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /cliente
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /cliente/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /cliente
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /cliente/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /cliente/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /cliente/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /cliente/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public static function devuelveTotales($id, $fechaVar = null)
	{
		$arregloResultado = array();
		$telefonosCliente = Cliente::find($id)->productos2Aux;
		$desde = Carbon::now()->subMonths(6)->startOfMonth();
		$hasta = Carbon::now()->startOfMonth();
		foreach ($telefonosCliente as $value) {
			$idTelefono = $value->id;
			if(is_null($fechaVar))
			{
				$totalesPorTelefono = Total::whereIdTelefono($idTelefono)->whereBetween('fecha', array($desde, $hasta))->orderBy('fecha')->get();
			}
			else
			{
				$year = (new Carbon($fechaVar))->year;
				$mes  = (new Carbon($fechaVar))->month;
				$totalesPorTelefono = Total::whereIdTelefono($idTelefono)->where(DB::raw('MONTH(fecha)'),  $mes)->where(DB::raw('YEAR(fecha)'), $year)->orderBy('fecha')->get();
			}
			foreach ($totalesPorTelefono as $value2) {
				$telefonoClass = new stdClass;
				$fecha = $value2->fecha;
				$montoTotal = $value2->monto_total;
				$telefonoClass->numero = $value->numero;
				$telefonoClass->fecha  = $fecha;
				$telefonoClass->monto  = $montoTotal;
				$producto = Producto::find($value->id_producto)->nombre;
				$telefonoClass->producto = $producto;
				array_push($arregloResultado, $telefonoClass);

			}
		}
		return $arregloResultado;
	}

	public static function generaExcelTotales($id, $fecha = null)
	{
		$data =  json_decode(json_encode(ClienteController::devuelveTotales($id, $fecha)), true);
		Excel::create('TotalPorMes', function($excel)use($data)
		{
			$excel->sheet('sheet', function($sheet)use($data)
			{
				$sheet->fromArray($data);
			});
		})->export('xls');
	}

	public static function generaExcelEvolucionTotalMensual($id)
	{
		$data = array();
		$data = Cliente::postChartEvolutionForExcel($id);
		Excel::create('TotalPorMes', function($excel)use($data)
		{
			$excel->sheet('sheet', function($sheet)use($data)
			{
				$sheet->fromArray($data);
			});
		})->export('xls');
	}

	public static function estaRegistrado($id)
	{
		$existe = Cliente::whereId($id)->where('persona_id','<>',1)->get();
		if(empty($existe[0]))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public static function existeDatoCliente($id, $dato)
	{
		// if( is_null(Cliente::find(7)->persona->direccion_personal) )
		// 	return "no tiene";
		// else
		// 	return "tiene";
		$devuelve = "false";
		switch($dato)
		{
			case "email":
				!is_null(Cliente::find($id)->persona->email_personal)&& 
				(Cliente::find($id)->persona->email_personal != "") ? $devuelve = "true": $devuelve = "false";
				break;
			case "correoPostal":
				( !is_null(Cliente::find($id)->persona->direccion_personal) )&&
				(Cliente::find($id)->persona->direccion_personal != "") ? $devuelve = "true": $devuelve = "false";
				break;
			case "telefono":
				!is_null(Cliente::find($id)->persona->telefono_fijo_personal)&&
				(Cliente::find($id)->persona->telefono_fijo_personal != "") ? $devuelve = "true": $devuelve = "false";
				break;
			case "direccion":
				!is_null(Cliente::find($id)->persona->direccion_personal)&&
				(Cliente::find($id)->persona->direccion_personal != "") ? $devuelve = "true": $devuelve = "false";
				break;
			case "celular":
				!is_null(Cliente::find($id)->persona->celular_personal)&&
				(Cliente::find($id)->persona->celular_personal != "") ? $devuelve = "true": $devuelve = "false";
				break;
			case "facebook":
				!is_null(Cliente::find($id)->persona->facebook)&&
				(Cliente::find($id)->persona->facebook != "") ? $devuelve = "true": $devuelve = "false";
				break;
			case "twitter":
				!is_null(Cliente::find($id)->persona->twitter)&&
				(Cliente::find($id)->persona->twitter != "") ? $devuelve = "true": $devuelve = "false";
				break;
			case "skype":
				!is_null(Cliente::find($id)->persona->skype)&&
				(Cliente::find($id)->persona->skype != "") ? $devuelve = "true": $devuelve = "false";
				break;
		}
		return $devuelve;

	}

}