<?php

class AutocompleteController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function products()
    {
    	$products = Product::where('name', 'like', "%" . Input::get('query') . "%")->get();

    	$jsonSerialize = array();

    	foreach ($products as $product) {
    		$jsonSerialize['suggestions'][] = array('value' => $product->name, 'data' => $product);
    	}

    	return Response::json($jsonSerialize);
    }
}