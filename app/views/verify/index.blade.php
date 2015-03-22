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
            <div class="control-group">
                <label for="status" class="control-label span4">Codigo da comanda:</label>
                <div class="controls span8">
                {{ Form::text('id_bracelet', ""); }}
                {{ Form::submit('Pesquisar Comanda', array("class" => "btn btn-primary")) }}
                </div>
            </div>
            <p>Por favor, aproxime a comanda do leitor! Caso necessario informe o codigo da comanda e clique no botão "Pesquisar Comanda".
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