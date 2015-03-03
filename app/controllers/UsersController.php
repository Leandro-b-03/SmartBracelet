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
        $data = array();

        $role = array();

        $roles = Role::all();

        foreach ($roles->all() as $role_filter) {
            $role[$role_filter->id] = $role_filter->name;
        }

        $data['role'] = $role;

        return View::make('users.edit')->with('data', $data);
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
            $confirm            = Input::get('confirm');
            $role               = Input::get('role');
            $user->cpf          = Input::get('cpf');
            $user->photo        = Input::get('photo');
            $user->rg           = Input::get('rg');
            $user->phone        = Input::get('phone');
            $user->mobile       = Input::get('mobile');
            $user->address      = Input::get('address');

            if($user->password != $confirm) {
                return Redirect::route('users.create')->with('flash_error', 'Senha e confirmar senha são diferentes.')->withInput();
            }

            $user->save();

            $role = Role::find($role);

            $user->attachRole($role);

            DB::commit();

            // redirect
            return Redirect::to('users')->with('flash_notice', 'Usuário criado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('users.create')->with('flash_error', 'Ocorreu um erro ao criar o usuário.')->withInput();
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

        $role = array();

        $roles = Role::all();

        foreach ($roles->all() as $role_filter) {
            $role[$role_filter->id] = $role_filter->name;
        }

        $user = User::findOrFail($id);

        $data['user'] = $user;

        $data['role'] = $role;

        foreach ($user->roles as $role) {
            $data['user_role'] = $role->id;
        }

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
            $password           = Input::get('password');
            $confirm            = Input::get('confirm');
            $role               = Input::get('role');
            $user->cpf          = Input::get('cpf');
            $user->photo        = Input::get('photo');
            $user->rg           = Input::get('rg');
            $user->phone        = Input::get('phone');
            $user->mobile       = Input::get('mobile');
            $user->address      = Input::get('address');

            if ($password) {
                if ($user->password != $confirm) {
                    return Redirect::to('users/' . $id . '/edit')->with('flash_error', 'Senha e confirmar senha são diferentes.')->withInput();
                }
            }

            $user->save();

            $role = Role::find($role);

            $user->attachRole($role);

            DB::commit();

            // redirect
            return Redirect::to('users')->with('flash_notice', 'Usuário alterado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('users/' . $id . '/edit')->with('flash_error', 'Ocorreu um erro ao alterar o usuário.')->withInput();
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
