@extends('layout')

@section('title')
    Smart Bracelet | Produtos
@stop

@section('content')
<div class="row-fluid">
    <h3 class="box-header">Cadastro de clientes</h3>
    <div class="box">
            <div class="body">
                @if(Request::is('customers/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "customers")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('customers.update', $data['customer']->id))) }}
                @endif
                    <div class="control-group">
                        <label for="name" class="control-label span4">Nome</label>
                        <div class="controls span8">
                        {{ Form::text('name', (isset($data['customer']) ? $data['customer']->name : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="address" class="control-label span4">Endereço</label>
                        <div class="controls span8">
                        {{ Form::text('address', (isset($data['customer']) ? $data['customer']->address : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="phone" class="control-label span4">Telefone</label>
                        <div class="controls span8">
                        {{ Form::text('phone', (isset($data['customer']) ? $data['customer']->phone : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="rg" class="control-label span4">RG</label>
                        <div class="controls span8">
                        {{ Form::text('rg', (isset($data['customer']) ? $data['customer']->rg : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="cpf" class="control-label span4">CPF</label>
                        <div class="controls span8">
                        {{ Form::text('cpf', (isset($data['customer']) ? $data['customer']->cpf : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="birthday" class="control-label span4">Data de aniversario</label>
                        <div class="controls span8">
                        {{ Form::text('birthday', (isset($data['customer']) ? $data['customer']->dirthday : ""), array("class" => "form-control datepicker", "required")) }}
                        </div>
                    </div>
                    {{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
                    <a class="btn btn-danger" href="{{ URL::to('customers') }}">Voltar</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    {{ HTML::script('library/javascripts/bootstrap-datepicker.js'); }}
    @if(!isset($data))
	    <script>
	    	$('.datepicker').datepicker();
	    </script>
	@else 
		<script>
	    	$('.datepicker').datepicker('setValue','{{$data['customer']->birthday;}}');
	    </script>
	@endif
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