@extends('layout')

@section('title')
    Smart Bracelet | Pedidos
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Minha conta</h3>
@stop

@section('content')
<div class="row-fluid">
    <h3 class="box-header">Pedidos</h3>
    <div class="box">
        <div class="box pull-right" style="padding-bottom: 20px">
            <a class="btn btn-blue"href="{{ URL::to('orders/create') }}">
                <i class="fa fa-pencil"></i>
                Adicionar Pedidos
            </a>
        </div>
            <table class="table table-bordered datagrid">
                <thead>
                    <th>Número do Pedido</th>
                    <th>Funcionario/Usuário</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Desconto</th>
                    <th>Status</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    @if ($orders->count() > 0)
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->custumer->name }}</td>
                        <td>{{ $order->discount }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ ($product->status ? 'Ativo' : 'Não Ativo') }}</td>
                        <td>{{ Form::open(array('url' => 'orders/' . $order->id, 'class' => '')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <a class="btn btn-primary" href="{{ URL::to('orders/' . $order->id . '/edit') }}">
                                    <i class="fa fa-pencil"></i>
                                    Editar
                                </a>
                                {{ HTML::decode(Form::button('<i class="fa fa-close"></i> Deletar', array("class" => "btn btn-danger", "type" => "submit"))) }}
                            {{ Form::close() }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7">Não há pedidos</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('scripts')
    {{ HTML::script('library/javascripts/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}

    @if (Session::has('flash_error'))
    <script type="text/javascript">
        $(function(){
            new PNotify({
                title: 'Erro',
                text: '{{ Session::get('flash_error') }}',
                type: 'error'
            });
        });
    </script>
    @endif

    @if (Session::has('flash_notice'))
    <script type="text/javascript">
        $(function(){
            new PNotify({
                title: 'Sucesso',
                text: '{{ Session::get('flash_notice') }}',
                type: 'success'
            });
        });
    </script>
    @endif
@stop