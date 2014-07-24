<?php

class Grafico extends Eloquent {

	protected $table = 'my_chart_data';

	public static function graf2 (){
		$qry = Grafico::orderBy('category','ASC')->get();
		$graf = array();
		foreach ($qry as $value) {
			$array = array(
				'category' => $value->category,
				'value1'   => (int)$value->value1,
				'value2'   => (int)$value->value2,
				);
			array_push($graf, $array);
		}
		return json_encode($graf);
	}

	public static function graf1 (){
		$qry = Grafico::orderBy('category','ASC')->get();
		$graf = array();
		foreach ($qry as $value) {
			$array = array(
				'category' => $value->category,
				'value1'   => (int)$value->value1,
				'value2'   => (int)$value->value2,
				);
			array_push($graf, $array);
		}
		return json_encode($graf);
	}


	// public static function donut_valueByProduct ($user = '', $groupBy = '', $year = 2014) {
	// 	$donut = array();
	// 	$query = Grafico::select('empresa', DB::raw('SUM(monto) as monto'), 'categoria')->where('empresa', $user)->where('año', $year)->groupBy($groupBy)->get();
	// 	foreach ($query as $value) {
	// 		$highlight  = Func::rnd_color();
	// 		$background = Func::oscurece_color($highlight, 2);
	// 		$array = array(
	// 			'label'     => $value->categoria,
	// 			'title'     => $value->categoria,
	// 			'value'     => (int)$value->monto,
	// 			'color'     => $background,
	// 			'highlight' => $highlight,
	// 			);
	// 		array_push($donut, $array);
	// 	}

	// 	return json_encode($donut);
	// }

	// public static function historicChart () {
	// 	$chart = array();
	// 	$query = Grafico::groupBy('mes')->get();

	// 	foreach ($query as $value) {
	// 		$color = Func::rgba();
	// 		$array = array(
	// 			'label'                => $value->categoria,
	// 			'title'                => $value->categoria,
	// 			'fillColor'            => array_get($color, 'full'),
	// 			'strokeColor'          => array_get($color, 'full'),
	// 			'pointColor'           => array_get($color, 'full'),
	// 			'pointStrokeColor'     => '#fff',
	// 			'pointHighlightFill'   => '#fff',
	// 			'pointHighlightStroke' => 'rgba(220,220,220,1)',
	// 			'data'                 => [65, 59, 80, 81, 56, 55, 40, 55]
	// 			);
	// 		array_push($chart, $array);
	// 	}

	// 	return json_encode($chart);
	// }
}
