<?php

class GraffController extends BaseController {

<<<<<<< HEAD
	public function postChartPie($id = '', $type = 'pie', $mes = NULL) {
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
=======
	public function getChartPie($id = '', $type = 'pie', $fecha = NULL) {
		if(is_null($fecha))
		{
		 	$data = Cliente::getChartPie($id);
		} else {
		 	$data = Cliente::getChartPieMonth($id, $fecha);
		}
     	//$data = Cliente::getChartPie($id);
		$titleF = 'numero';
		$valueF = 'monto';
		$chart = array(
			"type"         => "pie",
			"theme"        => "none",
			"language"     => "es",
			"depth3D"      => 10,
			"angle"        => 10,
			"dataProvider" => $data,
			"labelText"    => "[[producto]]",
			"titleField"   => $titleF,
			"valueField"   => $valueF,
			"balloonText" => "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>",
<<<<<<< HEAD
			// "legend" => array(
			// 	"align"      => "center",
			// 	"markerType" => "circle",
			// 	"horizontalGap"    => 0,
			// 	"position"         => "bottom",
			// 	"markerSize"       => 10,
			// 	// "divId" => "donut-legend",
			// 	),
=======
			"legend" => array(
				"align"      => "center",
				"markerType" => "circle",
				"horizontalGap"    => 0,
				"position"         => "bottom",
				"markerSize"       => 10,
				),
>>>>>>> origin/dev
			"numberFormatter" => array(
				"decimalSeparator" => ",",
				"thousandsSeparator" => ".",
				"precision" => -1
				),
			"pathToImages" => "http://www.amcharts.com/lib/3/images/",
			"amExport" => array(
				"top" => 21,
				"right" => 20,
				"exportJPG" => true,
				"exportPNG" => true,
				"exportSVG" => true,
				"exportPDF" => true,
				),
			"sequencedAnimation" => false,
			"startAlpha" => 0,
			"startDuration" => 0,
			);
		if ($type == 'donut') {
			$chart = array_add($chart, "labelRadius", 5);
			$chart = array_add($chart, "radius", "35%");
			$chart = array_add($chart, "innerRadius", "70%");
>>>>>>> origin/dev
		}
	}

<<<<<<< HEAD
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
=======
	public function getChartSerial($id = '', $type = 'column') {
		//if(!Cache::has($type)) {
			if($type != 'column') {
				$config = Cliente::getChartStacked($id);
			} else {
				$config = Cliente::getChartSerial($id);
			}
			$data   = isset($config['data']) ? $config['data'] : array();
			$graphs = isset($config['graphs']) ? $config['graphs']  : array();
			$ejex   = 'mes';
			$chart = array(
				"type"   => "serial",
				"theme"  => "none",
				"language" => "es",
				"depth3D"  => 20,
				"angle"    => 10,
				// "legend" => array(
				// 	"horizontalGap"    => 10,
				// 	"position"         => "bottom",
				// 	"useGraphSettings" => true,
				// 	"markerSize"       => 10,
				// 	"markerType"       => "circle",
				// 	"align"            => "center",
				// 	),
				"dataProvider" => $data,
				"graphs" => $graphs,
				"categoryField" => $ejex,
				"categoryAxis" => array(
					"gridPosition" => "start",
					"axisAlpha"    => 0.3,
					"gridAlpha"    => 0,
					),
				"numberFormatter" => array(
					"decimalSeparator" => ",",
					"thousandsSeparator" => ".",
					"precision" => -1
					),
				"pathToImages" => "http://www.amcharts.com/lib/3/images/",
				"amExport" => array(
					"top" => 21,
					"right" => 20,
					"exportJPG" => true,
					"exportPNG" => true,
					"exportSVG" => true,
					"exportPDF" => true,

					),
				"sequencedAnimation" => false,
				"startAlpha" => 0,
				"startDuration" => 0,
				);
<<<<<<< HEAD
			if($type == 'stackbar') {
				$chart = array_add($chart, "valueAxes", array(
					array(
						"stackType" => "regular",
						"unit" => "$",
						"unitPosition" => "left",
						"axisAlpha" => 0.3,
						"gridAlpha" => 0,
						)
					)
				);
			} else {
				$chart = array_add($chart, "valueAxes", array(
					array(
						"unit" => "$",
						"unitPosition" => "left",
						"axisAlpha" => 0.3,
						"gridAlpha" => 0,
						)
					)
				);
			}
			//Cache::put($type, $chart, 20);
		// } else {
		// 	$chart = Cache::get($type);
		// }
		return Response::json($chart);
	}
=======
if($type == 'stackbar') {
	$chart = array_add($chart, "valueAxes", array(
		array(
			"stackType" => "regular",
			"unit" => "$",
			"unitPosition" => "left",
			"axisAlpha" => 0.3,
			"gridAlpha" => 0,
			)
		)
	);
} else {
	$chart = array_add($chart, "valueAxes", array(
		array(
			"unit" => "$",
			"unitPosition" => "left",
			"axisAlpha" => 0.3,
			"gridAlpha" => 0,
			)
		)
	);
}
Cache::put($type, $chart, 20);
} else {
	$chart = Cache::get($type);
}
return Response::json($chart);
}
>>>>>>> origin/dev

public function getChartPieEnt($id = '', $type = 'pie', $mes = NULL) {
	if(is_null($mes) OR !is_numeric($mes)){
		$data = Cliente::getChartPie($id);
	} else {
		$data = Cliente::getChartPieMonth($id, $mes);
>>>>>>> origin/dev
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
}