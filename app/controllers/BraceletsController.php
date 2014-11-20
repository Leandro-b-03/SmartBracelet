<?php

class BraceletsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $bracelets = Bracelet::all();

        return View::make('bracelets.index')->with('bracelets', $bracelets);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::all();

        foreach ($users as $user) {
            $data['users'][] = array($user->id => $user->name);
        }

        return View::make('bracelets.edit')->with('data', $data);
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
            
            $bracelet = new Bracelet;

            $bracelet->name         = Input::get('name');
            $bracelet->price        = number_format(Input::get('price'), 2);
            $bracelet->quantity     = Input::get('quantity');
            $bracelet->status       = Input::get('status');

            $bracelet->save();

            DB::commit();

            // redirect
            return Redirect::to('bracelets')->with('flash_notice', 'Produto criado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('bracelets.create')->with('flash_error', 'Ocorreu um erro ao criar o produto.')->withInput();
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

        $bracelet = Bracelet::findOrFail($id);

        $data['bracelet'] = $bracelet;

        return View::make('bracelets.edit')->with('data', $data);
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
            $bracelet = Bracelet::findOrFail($id);

            DB::beginTransaction();

            $bracelet->name         = Input::get('name');
            $bracelet->price        = number_format(Input::get('price'), 2);
            $bracelet->quantity     = Input::get('quantity');
            $bracelet->status       = Input::get('status');

            $bracelet->save();

            DB::commit();

            // redirect
            return Redirect::to('bracelets')->with('flash_notice', 'Produto alterado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('bracelets.create')->with('flash_error', 'Ocorreu um erro ao alterar o produto.')->withInput();
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
            $bracelet = Bracelet::find($id);
            $bracelet->delete();

            DB::commit();

            // redirect
            return Redirect::to('bracelets')->with('flash_notice', 'Produto deletado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('bracelets')->with('flash_error', 'Erro ao tentar deletar o produto!');
        }
    }


}
