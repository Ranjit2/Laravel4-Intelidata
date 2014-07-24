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
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create()
	{
		return View::make('graffs.create');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store()
	{
	//
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function show($id)
	{
		return View::make('graffs.show');
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function edit($id)
	{
		return View::make('graffs.edit');
	}

	/**
	* Update the specified resource in storage.
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
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id)
	{
	//
	}

	public function getChartSerial($id = '', $type = 'column') {
		$data   = Cliente::getChartSerial($id);
		$graphs = '';
		$ejex   = '';
		$chart = array(
			'type'   => 'serial',
			'theme'  => 'none',
			'legend' => array(
				'horizontalGap'    => 10,
				'maxColumns'       => 1,
				'position'         => 'bottom',
				'useGraphSettings' => true,
				'markerSize'       => 10,
				),
			'dataProvider' => $data,
			'valueAxes'    => array(
				'stackType'  => 'regular',
				'axisAlpha'  => 0.3,
				'gridAlpha'  => 0.2,
				'gridColor'  => '#FFFFFF',
				'dashLength' =>  0
				),
			'graphs'        => $graphs,
			'categoryField' => $ejex,
			'categoryAxis'  => array(
				'gridPosition' => 'start',
				'axisAlpha'    => 0,
				'gridAlpha'    => 0,
				'position'     => 'left',
				),
			'pathToImages' => 'http://cdn.amcharts.com/lib/3/images/',
			// 'gridAboveGraphs': true,
			// 'startDuration': 1,
			'exportConfig' => array(
				'menuTop'   => '20px',
				'menuRight' => '20px',
				'menuItems' =>  array(
					'icon'   =>  'http => //www.amcharts.com/lib/3/images/export.png',
					'format' =>  'png',
					)
				),
			'amExport' => array(
				'top' => 21,
				'right' => 20,
				'exportJPG' => true,
				'exportPNG' => true,
				'exportSVG' => true,
				'exportPDF' => true,
				),
		);


		// echo json_encode('SERAL CHART');
		// Debugbar::info(json_encode($chart));
		// return Response::json($chart);
		// return json_encode($chart);
	}

	public function getChartPie($id = '', $type = 'pie') {
		$data   = Cliente::getChartPie($id);
		$titleF = 'nombre';
		$valueF = 'monto';
		$chart = array(
			'type'         => 'pie',
			'theme'        => 'none',
			'dataProvider' => $data,
			'labelText'    => '[[title]]',
			'titleField'   => $titleF,
			'valueField'   => $valueF,
			'exportConfig' => array(
				'menuTop'   => '20px',
				'menuRight' => '20px',
				'menuItems' =>  array(
					'icon'   =>  'http => //www.amcharts.com/lib/3/images/export.png',
					'format' =>  'png',
				),
			),
		);
		if ($type == 'donut') {
			$chart = array_add($chart, "labelRadius", 5);
			$chart = array_add($chart, "radius", "42%");
			$chart = array_add($chart, "innerRadius", "60%");
		}
		return Response::json($chart);
	}
}
