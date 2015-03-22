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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function comands()
    {
        $bracelets = Bracelet::where('tag', 'like', "%" . Input::get('query') . "%")->get();

        $jsonSerialize = array();

        foreach ($bracelets as $bracelet) {
            $jsonSerialize['suggestions'][] = array('value' => $bracelet->tag, 'data' => $bracelet);
        }

        return Response::json($jsonSerialize);
    }
}