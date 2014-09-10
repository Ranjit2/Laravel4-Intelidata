<?php

class ProductoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /producto
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /producto/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /producto
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /producto/{id}
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
	 * GET /producto/{id}/edit
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
	 * PUT /producto/{id}
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
	 * DELETE /producto/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function generaExcelHistoricoCategoria($id, $fecha, $mes)
	{
		$fecha    = new Carbon($fecha);
		$resultado = DB::table('cliente')
		->select('producto.nombre as producto', DB::raw('SUM(total.monto_total) as valor'))
		->join('telefono', 'cliente.id', '=', 'telefono.id_cliente')
		->join('total', 'telefono.id', '=', 'total.id_telefono')
		->join('producto', 'producto.id','=','telefono.id_producto')
		->where('cliente.id','=',7)
		->where(DB::raw('MONTH(fecha)'), $fecha->month)
		->where(DB::raw('YEAR(fecha)'), $fecha->year)
		->groupBy('telefono.id_producto')
		->get();

		$data =  json_decode(json_encode($resultado), true);


		Excel::create('historicoCategoria', function($excel)use($data, $mes)
		{
			$excel->sheet($mes, function($sheet)use($data)
			{
				$sheet->fromArray($data);
			});
		})->export('xls');

		return;
	}
}