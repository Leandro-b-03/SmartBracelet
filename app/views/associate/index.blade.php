@extends('layout')

@section('title')
    Smart Bracelet | Pedidos
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Minha conta</h3>
@stop

{{ HTML::style('../bower_components/jquery-ui-bootstrap/jquery.ui.theme.css'); }}


@section('content')
<div class="row-fluid">
    <h3 class="box-header">Associar cliente</h3>
    <div class="box">
        {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "orders")) }}
            <div class="control-group">
                <label class="control-label span4">
                    TAG:
                </label>
                <div class="controls span8">
                    {{ Form::text('tag','' ,array("class" => "form-control", "required")) }}
                </div>
            </div>
            <div class="control-group">
                <label for="custumer" class="control-label span4">
                    Cliente:
                </label>
                <div class="controls span8">
                    {{ Form::text('custumer','' ,array("class" => "form-control custumer input-lg", "required")) }}
                    {{ Form::hidden('id_custumer','',array("class" => "id_custumer")) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>
@stop

@section('scripts')
    {{ HTML::script('library/javascripts/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}
    {{ HTML::script('../bower_components/jquery-ui/jquery-ui.js'); }}
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

    <script>
        $('.custumer').autocomplete({
            delay: 0,
            source: function(request, response) {
                $.ajax({
                    url: 'associate/getCustomersByName?id=' +  encodeURIComponent(request.term),
                    type: 'GET',
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item.name,
                                value: item.id_custumer
                            }
                        }));
                    }
                });

            },
            messages: {
                noResults: 'sem resultados',
                results: function() {}
            },
            select: function(event, ui) {
                $('.id_custumer').val(ui.item.id_custumer);
                return false;
            }
        });
    </script>
@stop