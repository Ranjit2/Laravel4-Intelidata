<?php

class GraffController extends BaseController {

	public function getChartPie($id = '', $type = 'pie', $mes = NULL) {
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
			"language"     => "es",
			"depth3D"      => 10,
			"angle"        => 10,
			"dataProvider" => $data,
			"labelText"    => "",
			"titleField"   => $titleF,
			"valueField"   => $valueF,
			"balloonText" => "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>",
			"legend" => array(
				"align"      => "center",
				"markerType" => "circle",
				"horizontalGap"    => 0,
				"position"         => "bottom",
				"markerSize"       => 10,
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
		if ($type == 'donut') {
			$chart = array_add($chart, "labelRadius", 5);
			$chart = array_add($chart, "radius", "42%");
			$chart = array_add($chart, "innerRadius", "60%");
		}
		return Response::json($chart);
	}

	public function getChartSerial($id = '', $type = 'column') {
		if(!Cache::has($type)) {
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
					"exportPDF" => true,

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

public function getChartPieEnt($id = '', $type = 'pie', $mes = NULL) {
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
		"language"     => "es",
		"depth3D"  => 20,
		"angle"    => 10,
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
			"exportPDF" => true,
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
return Response::json($chart);
}

public function getSerialChartEnt($id = '', $type = 'column') {
	return Cliente::montoTotal($id);
}

public function getChartBroke($id, $date = null) {
	if(!isset($date)) {
		$date = Carbon::now()->toDateString();
	}
	try {
		$data = Telefono::telefonosConServicios($id, $date);
		return $data;
	} catch(Exception $ex) {
		dd($ex->getMessage());
	}
}


public function getChartEvolution(){
	$count = 1;
	$data = array();
	// $data2 = array();
	$years = array(
		Carbon::now()->subYears(2)->year,
		Carbon::now()->subYears(1)->year,
		Carbon::now()->year,
		);
	$ids = Cliente::find(7)->numeros()->lists('id');

	for ($i = 0; $i < 12; $i++) {
		array_push($data, array(
			'date' => Func::convNumberToMonth($count),
			'year1' => $years[0],
			'year2' => $years[1],
			'year3' => $years[2],
			));

		// array_push($data2, array(
		// 	'date' => Func::convNumberToMonth($count),
		// 	'val1' => 0,
		// 	'val2' => 0,
		// 	'val3' => 0,
		// 	'year1' => $years[0],
		// 	'year2' => $years[1],
		// 	'year3' => $years[2],
		// 	));

		$query = Total::select(DB::raw('YEAR(fecha) AS year, SUM(monto_total) AS monto_total'))
		->whereIn('id_telefono', $ids)
		->whereIn(DB::raw('YEAR(fecha)'), $years)
		->where(DB::raw('MONTH(fecha)'), $i)
		->groupBy(DB::raw('YEAR(fecha)'), DB::raw('MONTH(fecha)'))
		->orderBy('fecha')
		->get();

		foreach ($query as $value) {
			switch ($value->year) {
				case $years[0]:
				$data[$i] = array_add($data[$i], 'val1', $value->monto_total);
				// array_set($data2[$i], 'val1', $value->monto_total);
				break;

				case $years[1]:
				$data[$i] = array_add($data[$i], 'val2', $value->monto_total);
				// array_set($data2[$i], 'val2', $value->monto_total);
				break;

				case $years[2]:
				$data[$i] = array_add($data[$i], 'val3', $value->monto_total);
				// array_set($data2[$i], 'val3', $value->monto_total);
				break;

				default:
				break;
			}
		}
		$count++;
	}
	// return View::make('evolution')->with('data', json_encode($data))->with('data2', json_encode($data2))->with('year', $years);
	return View::make('evolution')->with('data', json_encode($data))->with('year', $years);
}
}