<?php

class OrdersController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::all();

        return View::make('orders.index')->with('orders', $orders);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = array();

        $data['users'] = array();

        $users = User::all();

        foreach ($users as $user) {
            $data['users'][] = array($user->id => $user->name);
        }

        $custumers = Custumer::all();

        $data['custumers'] = array();

        foreach ($custumers as $custumer) {
            $data['custumers'][] = array($custumer->id => $custumer->name);
        }

        return View::make('orders.edit')->with('data', $data);
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
            
            $order = new Order;

            $order->order_number = Input::get('order_number');
            $order->id_user      = Input::get('id_user');
            $order->id_custumer  = Input::get('id_custumer');
            $order->amount       = Input::get('amount');
            $order->discount     = Input::get('discount');
            $order->status       = Input::get('status');

            $order->save();

            DB::commit();

            // redirect
            return Redirect::to('orders')->with('flash_notice', 'Pedido inserido com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('orders.create')->with('flash_error', 'Ocorreu um erro ao criar o pedido.')->withInput();
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

        $order = Order::findOrFail($id);

        $data['order'] = $order;

        return View::make('orders.edit')->with('data', $data);
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
            $order = Order::findOrFail($id);

            DB::beginTransaction();

            $order->tag       = Input::get('tag');
            $order->id_user   = Input::get('id_user');
            $order->color     = Input::get('color');

            $order->save();

            DB::commit();

            // redirect
            return Redirect::to('orders')->with('flash_notice', 'Pedido alterada com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('orders/' . $id . '/edit')->with('flash_error', 'Ocorreu um erro ao alterar o pedido.')->withInput();
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
            $order = Order::find($id);
            $order->delete();

            DB::commit();

            // redirect
            return Redirect::to('orders')->with('flash_notice', 'Pedido deletado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('orders')->with('flash_error', 'Erro ao tentar deletar o pedido!');
        }
    }


}
