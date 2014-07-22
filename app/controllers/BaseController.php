<?php

class BaseController extends Controller {

	/**
	 * Construct
	 *
	 * @return null
	 */
	public function __construct()
	{
	    Event::fire('ahir.velocity', $this);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function index()
	{
		if(Request::ajax()) {
        	return Response::json(Input::all());
    	}
	}

}
