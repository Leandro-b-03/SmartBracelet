<?php

class ProductsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();

        return View::make('products.index')->with('products', $products);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('products.edit');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
        // Inser the data on base.
        try
        {
            $product = null;

            DB::beginTransaction();
            
            $product = new Product;

            $product->name         = Input::get('name');
            $product->price        = Input::get('price');
            $product->quantity     = Input::get('quantity');
            $product->status       = Input::get('status');

            $product->save();

            DB::commit();

            // redirect
            return Redirect::to('products')->with('flash_notice', 'Produto criado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('products.create')->with('flash_error', 'Ocorreu um erro ao criar o produto.')->withInput();
        }
    }


    /**
     * Display the specified resource.
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
        try
        {

            DB::beginTransaction();
            // delete
            $product = Product::find($id);
            $product->delete();

            DB::commit();

            // redirect
            return Redirect::to('products')->with('flash_notice', 'Produto deletado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('products')->with('flash_error', 'Erro ao tentar deletar o produto!');
        }
    }


}
