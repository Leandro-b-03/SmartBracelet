<?php

class UsersController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return View::make('users.index')->with('users', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('users.edit');
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
            
            $user = new User;

            $user->name         = Input::get('name');
            $user->username     = Input::get('username');
            $user->email        = Input::get('email');
            $user->password     = Input::get('password');
            $user->cpf          = Input::get('cpf');
            $user->rg           = Input::get('rg');
            $user->phone        = Input::get('phone');
            $user->mobile       = Input::get('mobile');
            $user->address      = Input::get('address');

            $user->save();

            DB::commit();

            // redirect
            return Redirect::to('users')->with('flash_notice', 'Usuário criado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('users.create')->with('flash_error', 'Ocorreu um erro ao criar o usuárop.')->withInput();
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

        $user = User::findOrFail($id);

        $data['user'] = $user;

        return View::make('users.edit')->with('data', $data);
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
            $user = User::findOrFail($id);

            DB::beginTransaction();

            $user->name         = Input::get('name');
            $user->username     = Input::get('username');
            $user->email        = Input::get('email');
            $user->password     = Input::get('password');
            $user->cpf          = Input::get('cpf');
            $user->rg           = Input::get('rg');
            $user->phone        = Input::get('phone');
            $user->mobile       = Input::get('mobile');
            $user->address      = Input::get('address');

            $user->save();

            DB::commit();

            // redirect
            return Redirect::to('users')->with('flash_notice', 'Usuário alterado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('users.create')->with('flash_error', 'Ocorreu um erro ao alterar o usuárop.')->withInput();
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
            $user = User::find($id);
            $user->delete();

            DB::commit();

            // redirect
            return Redirect::to('users')->with('flash_notice', 'Produto deletado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('users')->with('flash_error', 'Erro ao tentar deletar o usuárop!');
        }
    }


}
