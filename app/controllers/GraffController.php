<?php

class GraffController extends BaseController {

	/**
	 * Get data for Pie/Donut chart and send to JS function
	 * @param  string $id   ID User
	 * @param  string $type Type of chart
	 * @return JSON data    Data used to make the chart
	 */
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
			"labelText"    => "", //"labelText"    => "[[numero]]",
			"titleField"   => $titleF,
			"valueField"   => $valueF,
			// "balloonText" => "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>",
			"legend" => array(
				"align"      => "center",
				"markerType" => "circle",
					// "horizontalGap"    => 10,
				"position"         => "bottom",
					// "useGraphSettings" => true,
					// "markerSize"       => 10,
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

	/**
	 * Get data for Serial chart and send to JS function
	 * @param  string $id   ID User
	 * @param  string $type Type of chart
	 * @return JSON data    Data used to make the chart
	 */
	public function getChartSerial($id = '', $type = 'column') {
		if(!Cache::has($type)) {
			$config = Cliente::getChartSerial($id, $type);
			$data   = isset($config['data']) ? $config['data'] : array();
			$graphs = isset($config['graphs']) ? $config['graphs']  : array();
			$ejex   = 'mes';
			$chart = array(
				"type"   => "serial",
				"theme"  => "none",
				"language" => "de",
				"legend" => array(
					// "horizontalGap"    => 10,
					"position"         => "bottom",
					// "useGraphSettings" => true,
					// "markerSize"       => 10,
					"markerType" => "circle",
					"align"      => "center",
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
			Cache::put($type, $chart, 20);
		} else {
			$chart = Cache::get($type);
		}
		return Response::json($chart);
	}

	/**
	 * Get data for Serial chart and send to JS function
	 * @param  string $id   ID User
	 * @param  string $type Type of chart
	 * @return JSON data    Data used to make the chart
	 */
	public function getChartBreak($id = '', $type = 'column') {
		$config = Cliente::montoTotal($id);
		$data   = isset($config['data']) ? $config['data'] : array();
		$graphs = isset($config['graphs']) ? $config['graphs']  : array();
		$ejex   = 'fecha';
		$chart = array(
			"type"   => "serial",
			"theme"  => "none",
			"language" => "de",
			"legend" => array(
					// "horizontalGap"    => 10,
				"position"         => "bottom",
					// "useGraphSettings" => true,
					// "markerSize"       => 10,
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
return Response::json($chart);
}


}