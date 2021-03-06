<?php

class VerifyCommandController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $verify_command = Order::all();

        return View::make('verify.index')->with('verify_command', $verify_command);
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
            $data['users'][$user->id] = $user->name;
        }

        $customers = Customer::all();

        $data['customers'] = array();

        foreach ($customers as $customer) {
            $data['customers'][$customer->id] = $customer->name;
        }

        $bracelets = Bracelet::all();

        $data['bracelets'] = array();

        foreach ($bracelets as $bracelet) {
            $data['bracelets'][$bracelet->id] = $bracelet->tag . ' - ' .$bracelet->color;
        }

        $data['order_bracelets'] = OrderBracelet::where('id_order', '0')->get();

        return View::make('verify.edit')->with('data', $data);
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
            $order->id_customer  = Input::get('id_customer');
            $id_bracelet         = Input::get('id_bracelet');
            $order->amount       = Input::get('amount');
            $order->discount     = Input::get('discount');
            $order->status       = Input::get('status');
            $products            = Input::get('products');

            $order->save();

            if ($products) {
                foreach ($products as $key => $values) {
                    $order_bracelet = New OrderBracelet;

                    $order_bracelet->id_order    = $order->id;
                    $order_bracelet->id_product  = $key;
                    $order_bracelet->id_bracelet = $id_bracelet;
                    $order_bracelet->quantity    = $values['quantity'][0];
                    $order_bracelet->price       = $values['price'][0];

                    $order_bracelet->save();

                    $order_bracelet = null;
                }
            }

            DB::commit();

            // redirect
            return Redirect::to('verify_command')->with('flash_notice', 'Pedido inserido com sucesso!')->with('products', $data['order_bracelets'] = $products);
        }
        catch (Exception $e)
        {
            DB::rollback();

            d($e);
            
            // return Redirect::route('verify.create')->with('flash_error', 'Ocorreu um erro ao criar o pedido.')->withInput();
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

        // $order = Order::findOrFail($id);
        $order = Order::where('id_bracelet', $id)->where('status', 1)->get()->first();

        if ($order) {
            $data['order'] = $order;

            $customers = Customer::all();

            $data['customers'] = array();

            foreach ($customers as $customer) {
                $data['customers'][$customer->id] = $customer->name;
            }

            $bracelets = Bracelet::all();

            $data['bracelets'] = array();

            foreach ($bracelets as $bracelet) {
                $data['bracelets'][$bracelet->id] = $bracelet->tag . ' - ' . ($bracelet->color == 1 ? 'Vermelho' : 'Verde');
            }

            $data['order_bracelets'] = OrderBracelet::where('id_order', $order->id)->get();

            return View::make('verify.edit')->with('data', $data);
        } else {
            return Redirect::to('verify_command')->with('flash_error', 'Comanda não vinculada a nenhum pedido!');
        }
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
        $order = Order::findOrFail($id);
        try
        {
            DB::beginTransaction();
            $order->amount       = Input::get('amount');
            $order->discount     = 0; // Input::get('discount');
            $order->status       = Input::get('status');
            $products            = Input::get('products');

            $order->save();

            OrderBracelet::where('id_order', $id)->delete();

            if ($products) {
                foreach ($products as $key => $values) {
                    $order_bracelet = New OrderBracelet;

                    $order_bracelet->id_order    = $order->id;
                    $order_bracelet->id_product  = $key;
                    $order_bracelet->id_bracelet = $order->id_bracelet;
                    $order_bracelet->quantity    = $values['quantity'][0];
                    $order_bracelet->price       = $values['price'][0];

                    $order_bracelet->save();

                    $order_bracelet = null;
                }
            }

            if ($order->status == 2) {
                $customer_bracelet = CustomerBracelet::where('id_bracelet', $order->id_bracelet)->where('status', 1)->get()->first();

                $customer_bracelet->status = 2;

                $customer_bracelet->save();
            }

            DB::commit();

            // redirect
            return Redirect::to('verify_command')->with('flash_notice', 'Pedido alterada com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();

            return Redirect::to('verify_command/' . $order->id_bracelet . '/edit')->with('flash_error', 'Ocorreu um erro ao alterar o pedido.')->withInput();
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
            return Redirect::to('verify_command')->with('flash_notice', 'Pedido deletado com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::to('verify_command')->with('flash_error', 'Erro ao tentar deletar o pedido!');
        }
    }


}
