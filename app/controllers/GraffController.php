<?php

class GraffController extends BaseController {

	public function getChartPie($id = '', $type = 'pie', $fecha = NULL) {
		if(is_null($fecha))
		{
			$data = Cliente::getChartPie($id);
		} else {
			$data = Cliente::getChartPieMonth($id, $fecha);
		}
		return $data;
	}


	public function postChartSerial($id = '', $type = 'column') {
		if($type != 'column') {
			try {
				$config = Cliente::postChartStacked($id);
				return $config;
			} catch(Exception $ex) {
				return ($ex->getMessage());
			}
		} else {
			try {
				$config = Cliente::postChartSerial($id);
				return $config;
			} catch(Exception $ex) {
				return ($ex->getMessage());
			}
		}
	}

	public function postChartPieEnt($id = '', $type = 'pie', $mes = NULL) {
		if(is_null($mes) OR !is_numeric($mes)){
			try {
				$data = Cliente::postChartPie($id);
				return $data;
			} catch(Exception $ex) {
				return ($ex->getMessage());
			}
		} else {
			try {
				$data = Cliente::postChartPieMonth($id, $mes);
				return $data;
			} catch(Exception $ex) {
				return ($ex->getMessage());
			}
		}
	}

	public function postSerialChartEnt($id = '', $type = 'column') {
		try {
			$data = Cliente::postMontoTotal($id);
			return $data;
		} catch(Exception $ex) {
			return ($ex->getMessage());
		}
	}

	public function postTelefonosConServicios($id = '', $date = null) {
		if(!isset($date)) {
			$date = Carbon::now()->toDateString();
		}
		try {
			$data = Telefono::postTelefonosConServicios($id, $date);
			return $data;
		} catch(Exception $ex) {
			return ($ex->getMessage());
		}
	}

	public function postChartEvolution($id = ''){
		if($id != '') {
			try {
				$config = Cliente::postChartEvolution($id);
				return $config;
			} catch(Exception $ex) {
				return ($ex->getMessage());
			}
		} else {
			return "No hay datos";
		}
	}

	public function postChartComparative($id) {
		try {
			$data = Cliente::postChartComparative($id);
			return $data;
		} catch(Exception $ex) {
			return ($ex->getMessage());
		}
	}

	public function postHistoricoCategoria($id, $date)
	{
		$fecha    = new Carbon($date);
		$resultado = DB::table('cliente')
		->select('producto.nombre', DB::raw('SUM(total.monto_total) as cantidad'))
		->join('telefono', 'cliente.id', '=', 'telefono.id_cliente')
		->join('total', 'telefono.id', '=', 'total.id_telefono')
		->join('producto', 'producto.id','=','telefono.id_producto')
		->where('cliente.id','=',7)
		->where(DB::raw('MONTH(fecha)'), $fecha->month)
		->where(DB::raw('YEAR(fecha)'), $fecha->year)
		->groupBy('telefono.id_producto')
		->get();
		return $resultado;
	}
}