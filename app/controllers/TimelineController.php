	<?php

	class TimelineController extends \BaseController {

	/**
	* Display a big timeline.
	* GET /timeline
	* POST-AJAX /timeline
	*
	* @return Response
	*/
	public function index()
	{
		if(Request::ajax() && Request::isMethod('POST')) {
			$group_number = filter_var(Input::get('group_no', 0), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			if(!is_numeric($group_number)){
				header('HTTP/1.1 500 Invalid number!');
				exit();
			}
			HTML::timeline(Telefono::tl_paginate($group_number));
		} else {
			$total_groups = Telefono::tl_total();
			return View::make('timeline')->with('total_groups', $total_groups);
		}
	}

}