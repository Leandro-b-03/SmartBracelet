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
            <div class="body">
                @if(Request::is('orders/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "orders")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('orders.update', $data['order']->id))) }}
                @endif
                    <div class="control-group">
                        <label for="order_number" class="control-label span4">Número do pedido</label>
                        <div class="controls span8">
                        {{ Form::text('order_number', (isset($data['order']) ? $data['order']->order_number : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="status" class="control-label span4">Funcionario/Usuário</label>
                        <div class="controls span8">
                        {{ Form::select('id_user', $data['users'], (isset($data['order']) ? $data['order']->user->id : "")); }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="status" class="control-label span4">Cliente</label>
                        <div class="controls span8">
                        {{ Form::select('id_custumer', $data['custumers'], (isset($data['order']) ? $data['order']->custumer->id : "")); }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="amount" class="control-label span4">Valor</label>
                        <div class="controls span8">
                        {{ Form::text('amount', (isset($data['order']) ? $data['order']->amount : ""), array("class" => "form-control price", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="discount" class="control-label span4">Desconto</label>
                        <div class="controls span8">
                        {{ Form::text('discount', (isset($data['order']) ? $data['order']->discount : ""), array("class" => "form-control price", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="status" class="control-label span4">Status</label>
                        <div class="controls span8">
                        {{ Form::select('status',
                                array('1' => 'Ativado', '0' => 'Destivado')
                            );
                        }}
                        </div>
                    </div>
                    {{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
                    <a class="btn btn-danger" href="{{ URL::to('orders') }}">Voltar</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    {{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/jQuery.glob.min.js'); }}
    {{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/globinfo/jQuery.glob.pt-BR.min.js'); }}
    {{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/jquery.GlobalMoneyInput.js'); }}

    <script>
        $(function($){
            /* Init Global Plugin with Brazilian Portuguese configuration */
            var cfgCulture = 'pt-BR';
            $.preferCulture(cfgCulture);

            $('.price').maskMoney();
        });
    </script>

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