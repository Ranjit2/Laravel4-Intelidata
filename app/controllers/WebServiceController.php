<?php

class WebServiceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /webservice
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /webservice/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /webservice
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /webservice/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /webservice/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /webservice/{id}
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
	 * DELETE /webservice/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function example() {
		SoapWrapper::add(function ($service) {
			$service->name('weather')->wsdl('http://www.webservicex.net/globalweather.asmx?WSDL');
		});

		$data = array(
			'CountryName' => 'Chile',
			'CityName'    => 'Santiago',
			);
		$func       = 'GetWeather';
		$funcResult = $func . 'Result';
		// $data       = Func::arrayToXML($data);

		$result = SoapWrapper::service('weather', function($service) use ($data, $func, $funcResult) {
			// var_dump($service->getFunctions());
			return $service->call($func, $data)->$funcResult;
		});
		Func::printr($result);

		die();
	}
}