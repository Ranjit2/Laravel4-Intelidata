<?php

class Hito extends Eloquent {
	protected $table = 'hitos';
	protected $primaryKey = 'id';

	public function cliente()
	{
		return $this->belongsTo('Cliente');
	}

	public function tl_total() {
		$items_per_group = (int) 1;
		$data =  Cliente::find(Session::get('ses_user_id'))
		->hitos()
		->orderBy('fecha', 'DESC')
		->get();
		$total_records = count($data);
		$total_records = ceil($total_records/$items_per_group);
		return $total_records;
	}

	public function tl_paginate($gn = 0){
		$items_per_group = (int) 5;
		$position = ($gn * $items_per_group);
		$data =  Cliente::find(Session::get('ses_user_id'))
		->hitos()
		->orderBy('fecha', 'DESC')

		->paginate((int) $items_per_group, (int) $position)

		// ->take((int) $position)
		// ->skip((int) $items_per_group)

		->get();
		if ($data) {
			return $data;
		} else {
			return "Ha ocurrido un error";
		}
	}
}