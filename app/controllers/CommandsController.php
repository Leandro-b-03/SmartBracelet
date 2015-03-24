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
        return View::make('commands.edit');
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

            $verify_bracelet = Bracelet::where('tag', Input::get('tag'))->get();
            
            if (!$verify_bracelet ->count()) {
                $bracelet = new Bracelet;

                $bracelet->tag       = Input::get('tag');
                $bracelet->color     = Input::get('color');

                $bracelet->save();
            } else {
                return Redirect::route('commands.create')->with('flash_error', 'Tag já cadastrada.')->withInput();
            }

            DB::commit();

            // redirect
            return Redirect::to('commands')->with('flash_notice', 'Comanda criada com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('commands.create')->with('flash_error', 'Ocorreu um erro ao criar a comanda.')->withInput();
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

            $verify_bracelet = Bracelet::where('tag', Input::get('tag'))->get()->first();
            
            if ($verify_bracelet->id == $bracelet->id) {
                $bracelet->tag       = Input::get('tag');
                $bracelet->color     = Input::get('color');

                $bracelet->save();
            } else {
                return Redirect::route('commands.create')->with('flash_error', 'Tag já cadastrada.')->withInput();
            }

            DB::commit();

            // redirect
            return Redirect::to('commands')->with('flash_notice', 'Comanda alterada com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('commands/' . $id . '/edit')->with('flash_error', 'Ocorreu um erro ao alterar a comanda.')->withInput();
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
            return Redirect::to('commands')->with('flash_notice', 'Comanda deletado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('commands')->with('flash_error', 'Erro ao tentar deletar a comanda!');
        }
    }


}
