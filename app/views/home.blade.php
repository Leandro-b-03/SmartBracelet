@extends('layout')

@section('title')
	Smart Bracelet | Dashboard
@stop

@section('style')
@stop

@section('name')
<h3><i class="fa fa-dashboard"></i>&nbsp; Dashboard</h3>
@stop

@section('content')
        <!-- Bracelets statistics
            ================================================== -->
        <section class="row-fluid">
            <div class="span8">
                <h3 class="box-header">
                    <i class="fa fa-user"></i>
                    Vincular cliente a comanda
                </h3>

                <div class="box">
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "home")) }}
                    <!-- control group -->
                    <div class="control-group">
                        <label for="status" class="control-label span4">Cliente</label>
                        <div class="controls span8">
                            {{Form::text('cpf-customer', "", array('id' => 'cpf-customer', 'placeholder' => 'CPF do cliente'))}}
                            {{Form::hidden('id_customer' ,"", array('id' => 'id_customer')}}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="status" class="control-label span4">Comanda</label>
                        <div class="controls span8">
                        {{ Form::text('bracelet', "", array('id' => 'autocomplete')); }}
                        {{ Form::hidden('id_bracelet', "", array('id' => 'id_bracelet')) }}
                        </div>
                    </div>
                    {{ Form::submit('Vincular', array("class" => "btn btn-primary")) }}
                {{ Form::close() }}
                </div>
            </div>
            <div id="counters" class="span4">
                <h3 class="box-header">
                    <i class="icon-signal"></i>
                    Estatisticas
                </h3>
                <div class="box no-border no-padding widget-statistics">
                
                    <div class="rounded-borders">
                        <div class="counter small">
                            <span>
                            {{ $data['bracelets_total'] }}
                            </span>
                        </div>
                        <div class="counter-label">
                            Comandas
                        </div>
                    </div>
                    
                    <div class="rounded-borders">
                        <div class="counter small">
                            <span>
                            {{ $data['bracelets_total'] - count($data['bracelets']) }}
                            </span>
                        </div>
                        <div class="counter-label">
                            Comandas em Uso
                        </div>
                    </div>
                    
                    <div class="rounded-borders">
                        <div class="counter small">
                            <span>
                            {{ $data['customers_total'] }}
                            </span>
                        </div>
                        <div class="counter-label">
                            Clientes Cadastrados
                        </div>
                    </div>
                    
                    <div class="rounded-borders">
                        <div class="counter small">
                            <span>
                            {{ $data['customers_total'] - count($data['customers']) }}
                            </span>
                        </div>
                        <div class="counter-label">
                            Clientes Ativos
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Daily statistics -->
        </section>
        <section class="row-fluid">
            <div class="span8">
                <h3 class="box-header">
                    <i class="fa fa-user"></i>
                    Clientes vinculados
                </h3>

                <div class="box">
                    <table class="table table-bordered datagrid">
                        <thead>
                            <th>Usuário</th>
                            <th>Comanda</th>
                            <th>Ação</th>
                        </thead>
                        @if ($data['customer_bracelets']->count() > 0)
                        <tbody>
                            @foreach ($data['customer_bracelets'] as $customer_bracelet)
                            <tr>
                                <td>{{ $customer_bracelet->customer()->first()->name }}</td>
                                <td>{{ $customer_bracelet->bracelet()->first()->tag . ' - ' . ($customer_bracelet->bracelet()->first()->color == 1 ? 'Vermelho' : 'Verde') }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ URL::to('verify_command/' . $customer_bracelet->bracelet()->first()->id . '/edit') }}">
                                        <i class="fa fa-pencil"></i>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </section>
        <!-- / Server statistics -->
@stop

@section('scripts')
    {{ HTML::script('library/javascripts/jQuery-Autocomplete/dist/jquery.autocomplete.js'); }}

    
    <script>
        $(function($){
            var comand = null;

            $('#autocomplete').autocomplete({
                serviceUrl: '/autocomplete/comands',
                onSelect: function (suggestion) {
                    comand = suggestion.data.id;
                    $('#id_bracelet').val(comand);
                }
            });

            $('#cpf-customer').autocomplete({
                serviceUrl: '/autocomplete/getCustomerByCpf',
                onSelect: function (suggestion) {
                    $('#id_customer').val(suggestion.data.id);
                }
            });
        });

        setInterval(ajaxCall, 1000);

        function ajaxCall() {
            $.ajax({
                url: "/general/getComand",
                method: "get",
                data: "id_user=" + {{ Auth::user()->id }},
                success: function(data) {
                    if (data.error) {
                        new PNotify({
                            title: 'Erro',
                            text: data.error,
                            type: 'error',
                            styling: 'fontawesome'
                            });
                    } else {
                        comand = data.bracelet.id;
    
                        $('#autocomplete').val(data.bracelet.tag);
                        $('#id_bracelet').val(comand);
                    }
                }
            });
        }

    </script>

    @if (Session::has('flash_error'))
    <script type="text/javascript">
        $(function(){
            new PNotify({
                title: 'Erro',
                text: '{{ Session::get('flash_error') }}',
                type: 'error',
                styling: 'fontawesome'
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
                type: 'success',
                styling: 'fontawesome'
            });
        });
    </script>
    @endif
@stop