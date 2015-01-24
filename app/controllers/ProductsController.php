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
        // Inser the data on base.
        try
        {
            DB::beginTransaction();
            
            $product = new Product;

            $product->name         = Input::get('name');
            $product->price        = number_format(Input::get('price'), 2);
            $product->quantity     = Input::get('quantity');
            $product->image        = Input::get('image');
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
        $data = array();

        $product = Product::findOrFail($id);

        $data['product'] = $product;

        return View::make('products.edit')->with('data', $data);
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
        try
        {
            $product = Product::findOrFail($id);

            DB::beginTransaction();

            $product->name         = Input::get('name');
            $product->price        = number_format(Input::get('price'), 2);
            $product->quantity     = Input::get('quantity');
            $product->image        = Input::get('image');
            $product->status       = Input::get('status');

            $product->save();

            DB::commit();

            // redirect
            return Redirect::to('products')->with('flash_notice', 'Produto alterado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('products.create')->with('flash_error', 'Ocorreu um erro ao alterar o produto.')->withInput();
        }
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
