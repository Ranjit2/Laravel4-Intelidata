<?php

class GraffController extends BaseController {

	public function getChartPie($id = '', $type = 'pie', $mes = NULL) {
// if(!Cache::has($type)) {
		if(is_null($mes) OR !is_numeric($mes)){
			$data = Cliente::getChartPie($id);
		} else {
			$data = Cliente::getChartPieMonth($id, $mes);
		}
		$titleF = 'mes';
		$valueF = 'monto';
		$chart = array(
			"type"         => "pie",
			"theme"        => "none",
			"language" => "de",
			"dataProvider" => $data,
			"labelText"    => "[[numero]]",
			"titleField"   => $titleF,
			"valueField"   => $valueF,
			"balloonText" => "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>",
			"legend" => array(
				"align"      => "center",
				"markerType" => "circle",
				"horizontalGap"    => 10,
				"position"         => "bottom",
				"useGraphSettings" => true,
				"markerSize"       => 10,
				"divId" => "donut-legend",
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
				),
			"sequencedAnimation" => false,
			"startAlpha" => 0,
			"startDuration" => 0,
			);
		if ($type == 'donut') {
			$chart = array_add($chart, "labelRadius", 5);
			$chart = array_add($chart, "radius", "42%");
			$chart = array_add($chart, "innerRadius", "60%");
		}
// 	Cache::put($type, $chart, 20);
// } else {
// 	$chart = Cache::get($type);
// }
		return Response::json($chart);
	}

	public function getChartSerial($id = '', $type = 'column') {
// if(!Cache::has($type)) {
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
			"legend" => array(
				"horizontalGap"    => 10,
				"position"         => "bottom",
				"useGraphSettings" => true,
				"markerSize"       => 10,
				"markerType"       => "circle",
				"align"            => "center",
				),
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
				),
			"sequencedAnimation" => false,
			"startAlpha" => 0,
			"startDuration" => 0,
			);
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
// 	Cache::put($type, $chart, 20);
// } else {
// 	$chart = Cache::get($type);
// }
		return Response::json($chart);
	}

	public function getChartPieEnt($id = '', $type = 'pie', $mes = NULL) {
// if(!Cache::has($type)) {
		if(is_null($mes) OR !is_numeric($mes)){
			$data = Cliente::getChartPie($id);
		} else {
			$data = Cliente::getChartPieMonth($id, $mes);
		}
		$titleF = 'mes';
		$valueF = 'monto';
		$chart = array(
			"type"         => "pie",
			"theme"        => "none",
			"language" => "de",
			"dataProvider" => $data,
			"labelText"    => "[[numero]]",
			"titleField"   => $titleF,
			"valueField"   => $valueF,
			"balloonText" => "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>",
			"legend" => array(
				"align"      => "center",
				"markerType" => "circle",
				"horizontalGap"    => 10,
				"position"         => "bottom",
				"useGraphSettings" => true,
				"markerSize"       => 10,
				"divId" => "donut-legend",
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
				),
			"sequencedAnimation" => false,
			"startAlpha" => 0,
			"startDuration" => 0,
			);
		if ($type == 'donut') {
			$chart = array_add($chart, "labelRadius", 5);
			$chart = array_add($chart, "radius", "42%");
			$chart = array_add($chart, "innerRadius", "60%");
		}
// 	Cache::put($type, $chart, 20);
// } else {
// 	$chart = Cache::get($type);
// }
		return Response::json($chart);
	}

	public function getSerialChartEnt($id = '', $type = 'column') {
		$config = Cliente::montoTotal($id);
		$data   = isset($config['data']) ? $config['data'] : array();
		$graphs = isset($config['graphs']) ? $config['graphs']  : array();
		$ejex   = 'fecha';
		$chart = array(
			"type"   => "serial",
			"theme"  => "none",
			"language" => "es",
			"legend" => array(
				"horizontalGap"    => 10,
				"position"         => "bottom",
				"useGraphSettings" => true,
				"markerSize"       => 10,
				"markerType" => "circle",
				"align"      => "center",
				),
			"dataDateFormat" => "YYYY-MM-DD HH:NN",
			"dataProvider" => $data,
			"graphs" => $graphs,
			"categoryField" => $ejex,
			"categoryAxis" => array(
				"gridPosition" => "start",
				"axisAlpha"    => 0.3,
				"gridAlpha"    => 0,
				"parseDates" => true,
				"minPeriod" => "MM",
				"equalSpacing" => true,
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
				),
			"sequencedAnimation" => false,
			"startAlpha" => 0,
			"startDuration" => 0,
			);
if($type == 'stackbar') {
	$chart = array_add($chart, "valueAxes", array(array(
		"stackType" => "regular",
		"unit" => "$",
		"unitPosition" => "left",
		"axisAlpha" => 0.3,
		"gridAlpha" => 0,
		)));
} else {
	$chart = array_add($chart, "valueAxes", array(array(
		"unit" => "$",
		"unitPosition" => "left",
		"axisAlpha" => 0.3,
		"gridAlpha" => 0,
		)));
}
return Response::json($chart);
}


public function telefonosConServicios($nroCliente, $fecha)
{
	$idCliente = Cliente::devuelveIdCliente($nroCliente);
$telefonos = Cliente::find($idCliente)->numeros; //devuelve id y numeros del telefono del cliente a buscar
// $arreglo   = array();
// $date      = new Carbon($fecha);
// $month     = $date->month;
// $year      = $date->year;
$arregloTelefonos = array();

foreach ($telefonos as $value)
{
	$idTelefono = $value['id'];
	$numero     = $value['numero'];
	array_push($arregloTelefonos, $numero);
	$arregloServicios = array();
foreach (Telefono::find($idTelefono)->servicios as $value2)//devuelve id telefono, servicio y monto serv
{
// $dt         = new Carbon($value2->fecha);
// $mes        = $dt->month;
// $ano        = $dt->year;
// $montoTotal = $value2->montoTotal;
	$servicio = $value2['tipo'];
	$monto    = $value2['precio_servicio'];
	array_push($arregloServicios, $servicio, $monto);
}
array_push($arregloTelefonos, $arregloServicios);
//array_push($arreglo, $numero, $montoTotal);
}

//return Telefono::find(1)->servicios;
//return Cliente::find($idCliente)->numeros;
return $arregloTelefonos;
}

}

