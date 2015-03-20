<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$data = array();

        $customers = Customer::all();

        $data['customers'] = array();

        foreach ($customers as $customer) {
            $data['customers'][$customer->id] = $customer->name;
        }

        $bracelets = Bracelet::all();

        $data['bracelets'] = array();

        foreach ($bracelets as $bracelet) {
            $data['bracelets'][$bracelet->id] = $bracelet->tag . ' - ' .$bracelet->color;
        }

        $data['order_bracelets'] = OrderBracelet::where('id_order', '0')->get();

        return View::make('home')->with('data', $data);
	}

}
