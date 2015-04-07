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
            {{ Form::open(array("id" => "verify", "role" => "form", "class" => "form-horizontal", "url" => "verify_command", 'method' => 'get')) }}
            <div class="control-group">
                <label for="status" class="control-label span4">Codigo da comanda:</label>
                <div class="controls span8">
                {{ Form::text('bracelet', "", array('id' => 'autocomplete')); }}
                {{ Form::hidden('id_bracelet', "", array('id' => 'id_bracelet')) }}
                {{ Form::submit('Pesquisar Comanda', array("class" => "btn btn-primary")) }}
                </div>
            </div>
            <p>Por favor, aproxime a comanda do leitor! Caso necessario informe o codigo da comanda e clique no botão "Pesquisar Comanda".</p>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop

@section('scripts')
    {{ HTML::script('library/javascripts/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}
    {{ HTML::script('library/javascripts/jQuery-Autocomplete/dist/jquery.autocomplete.js'); }}

    <script>
        $(function($){
            var comand = null;

            $('#autocomplete').autocomplete({
                serviceUrl: '/autocomplete/comands',
                onSelect: function (suggestion) {
                    comand = suggestion.data.id;

                    $('#id_bracelet').val(comand);
                    $('#verify').attr('action', '{{ URL::to("verify_command") }}' + '/' + comand + '/edit');
                }
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
                            $('#verify').attr('action', '{{ URL::to("verify_command") }}' + '/' + comand + '/edit');
                        }
                    }
                });
            }
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