<?php

class GraffController extends BaseController {

	public function postChartPie($id = '', $type = 'pie', $fecha = NULL) {
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

	public function postTelefonosPorProducto ($id = NULL, $id_producto = NULL, $date = NULL) {
		if(!isset($id)) {
			$id = Session::get('ses_user_id');
		}
		if(!isset($id_producto)) {
			$id_producto = 1;
		}
		if(!isset($date)) {
			$date = Carbon::now()->toDateString();
		}
		try {
			$data = Producto::postTelefonosPorProducto($id, $id_producto, $date);
			return $data;
		} catch(Exception $ex) {
			return ($ex->getMessage());
		}
	}
}