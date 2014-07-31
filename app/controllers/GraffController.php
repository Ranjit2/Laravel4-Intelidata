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
			"dataProvider" => $data,
			"labelText"    => "[[numero]]",
			"titleField"   => $titleF,
			"valueField"   => $valueF,
			"balloonText" => "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>",
			"legend" => array(
				"align"      => "center",
				"markerType" => "circle",
					// "horizontalGap"    => 10,
				"position"         => "bottom",
					// "useGraphSettings" => true,
					// "markerSize"       => 10
				),
			"pathToImages" => "http://www.amcharts.com/lib/3/images/",
			"amExport" => array(
				"top" => 21,
				"right" => 20,
				"exportJPG" => true,
				"exportPNG" => true,
				"exportSVG" => true,
				),
			"sequencedAnimation" => true,
			"startAlpha" => 0,
			"startDuration" => 2,
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
		// if(!Cache::has($type)) {
		$config = Cliente::getChartSerial($id);
		$data   = isset($config['data']) ? $config['data'] : array();
		$graphs = isset($config['graphs']) ? $config['graphs']  : array();
		$ejex   = 'mes';
		$chart = array(
			"type"   => "serial",
			"theme"  => "none",
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
			"pathToImages" => "http://www.amcharts.com/lib/3/images/",
			"amExport" => array(
				"top" => 21,
				"right" => 20,
				"exportJPG" => true,
				"exportPNG" => true,
				"exportSVG" => true,
				),
			"sequencedAnimation" => true,
			"startAlpha" => 0,
			"startDuration" => 2,
			);
		if($type == 'stackbar') {
			$chart = array_add($chart, "valueAxes", array(
				array(
					"stackType" => "regular",
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

	public function devuelveIdCliente($numeroCliente)
	{
		return Cliente::where('numero_cliente','=', $numeroCliente)->get()[0]['id'];
	}

	public function telefonosPorCliente($numeroCliente)
	{
		$idCliente = $this->devuelveIdCliente($numeroCliente);
		return Cliente::find($idCliente)->telefonos;
	}

	public function montoTotal($nroCliente)
	{
		$idCliente = $this->devuelveIdCliente($nroCliente);
		$telefonos = Cliente::find($idCliente)->telefonos;
		$arreglo = array();
		foreach ($telefonos as $value)
		{
			$idTelefono = $value['id'];
			$numero     = $value['numero'];
			foreach (Telefono::find($idTelefono)->montos as $value2)
			{
				$dt         = new Carbon($value2->fecha);
				$mes 		= $dt ->month;
				$year 		= $dt ->year;
				$fecha      = $value2->fecha;
				$montoTotal = $value2->monto_total;
				$arreglo[] = ["fecha"=>$fecha,"Telefono"=>$numero, "Monto"=>$montoTotal];
			}
		}
		return $arreglo;
	}
}
