<?php

class GraffController extends BaseController {

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		return View::make('graffs');
	}

	/**
	 * Get data for Serial chart and send to JS function
	 * @param  string $id   ID User
	 * @param  string $type Type of chart
	 * @return JSON data    Data used to make the chart
	 */
	public function getChartSerial($id = '', $type = 'column') {
		// if(!Cache::has($type)) {
		$config   = Cliente::getChartSerial($id);
		$data = $config['data'];
		$graphs = $config['graphs'];
		$ejex   = 'mes';
		$chart = array(
			"baseHref" => true,
			"type" => "serial",
			"theme" => "none",
			"dataProvider" => $data,
			"gridAboveGraphs" => true,
			"startDuration" => 1,
			"graphs" => $graphs,
			"chartCursor" => array(
				"categoryBalloonEnabled" => false,
				"cursorAlpha"            => 0,
				"zoomable"               => false
				),
			"categoryField" => "mes",
			"categoryAxis" => array(
				"gridAlpha"    => 0,
				"tickLength"   => 0,
				"equalSpacing" => true,
				),
			"titles" => array(
				"text" => "Speedometer",
				"size" => 15
				),
			"pathToImages" => "http://www.amcharts.com/lib/3/images/",
			"amExport" => array(
				"top"                 => 21,
				"right"               => 20,
				"buttonColor"         => '#EFEFEF',
				"buttonRollOverColor" => '#DDDDDD',
				"exportPDF"           => true,
				"exportJPG"           => true,
				"exportPNG"           => true,
				"exportSVG"           => true,
				),
			"sequencedAnimation" => false,
			"startAlpha" => 0,
			"startDuration" => 0,
			);
		// 	Cache::put($type, $chart, 20);
		// } else {
		// 	$chart = Cache::get($type);
		// }
return Response::json($chart);
}

	/**
	 * Get data for Pie/Donut chart and send to JS function
	 * @param  string $id   ID User
	 * @param  string $type Type of chart
	 * @return JSON data    Data used to make the chart
	 */
	public function getChartPie($id = '', $type = 'pie') {
		// if(!Cache::has($type)) {
		$data = Cliente::getChartPie($id);
		$titleF = 'mes';
		$valueF = 'monto';
		$chart = array(
			"baseHref" => true,
			"type"         => "pie",
			"theme"        => "none",
			"dataProvider" => $data,
			"labelText"    => "[[title]]<br>[[numero]]",
			"titleField"   => $titleF,
			"valueField"   => $valueF,
			"balloonText" => "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
			"legend" => array(
				"align" => "center",
				"markerType" => "circle",
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
}
