<?php

class CommandsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $commands = Bracelet::all();

        return View::make('commands.index')->with('commands', $commands);
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

        return View::make('commands.edit')->with('data', $data);
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

            $bracelet->tag       = Input::get('tag');
            $bracelet->id_user   = Input::get('id_user');
            $bracelet->color     = Input::get('color');

            $bracelet->save();

            DB::commit();

            // redirect
            return Redirect::to('commands')->with('flash_notice', 'Pulseira criada com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('commands.create')->with('flash_error', 'Ocorreu um erro ao criar a pulseira.')->withInput();
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

        $users = User::all();

        foreach ($users as $user) {
            $data['users'][] = array($user->id => $user->name);
        }

        $bracelet = Bracelet::findOrFail($id);

        $data['bracelet'] = $bracelet;

        return View::make('commands.edit')->with('data', $data);
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

            $bracelet->tag       = Input::get('tag');
            $bracelet->id_user   = Input::get('id_user');
            $bracelet->color     = Input::get('color');

            $bracelet->save();

            DB::commit();

            // redirect
            return Redirect::to('commands')->with('flash_notice', 'Pulseira alterada com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('commands.create')->with('flash_error', 'Ocorreu um erro ao alterar a pulseira.')->withInput();
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
            return Redirect::to('commands')->with('flash_notice', 'Pulseira deletado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('commands')->with('flash_error', 'Erro ao tentar deletar a pulseira!');
        }
    }


}
