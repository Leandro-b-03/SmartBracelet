@extends('layout')

@section('title')
	Revender.ME | Nova Loja
@stop

@section('style')
    {{ HTML::style("theme/assets/lib/chosen/chosen.min.css") }}
@stop

@section('name')
<h3><i class="fa fa-ticket"></i>&nbsp;Lojas</h3>
@stop

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="box dark">
			<header>
				<div class="icons">
					<i class="fa fa-edit"></i>
				</div>
				<h5>Nova Loja</h5>
				<!-- .toolbar -->
				<div class="toolbar">
					<nav style="padding: 8px;">
						<a href="javascript:;" class="btn btn-default btn-xs collapse-box">
							<i class="fa fa-minus"></i>
						</a>
						<a href="javascript:;" class="btn btn-default btn-xs full-box">
							<i class="fa fa-expand"></i>
						</a>
					</nav>
				</div>
				<!-- /.toolbar -->
			</header>
			<div class="body">
                @if(isset($data['id']))
                @if($data['balance'])
                {{ Form::open(array('url' => 'payments/batch')) }}
                {{ Form::hidden('payment[]', $data['id']) }}
                {{ Form::submit('Pagar débito desta loja', array("class" => "btn btn-danger")) }}
                {{ Form::close() }}
                @endif
                @endif
                <br>
				@if(Request::is('store/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "store")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('store.update', $data['store']->id))) }}
                @endif
					<div class="form-group">
						<label for="store_name" class="control-label col-lg-4">Nome da Loja</label>
						<div class="col-lg-8">
                        {{ Form::text('store_name', (isset($data['store']) ? $data['store']->store_name : ""), array("class" => "form-control", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="url" class="control-label col-lg-4">URL</label>
						<div class="col-lg-8">
                        {{ Form::text('url', (isset($data['store']) ? $data['store']->url : ""), array("class" => "form-control", "placeholder" => "dominio.com", "pattern" => "^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="plan" class="control-label col-lg-4">Planos</label>
						<div class="col-lg-8">
                        {{ Form::select('plan', $data['plans'], (isset($data['store']) ? $data['store']->plan->id : ""), array("class"=>"form-control chzn-select", "data-placeholder" => "Selecione")) }}
						</div>
					</div>
					<!-- /.form-group -->
                    @if(isset($data['store']))
                    @if($data['store']->status != 4 && $data['store']->status != 5)
					<div class="form-group">
						<label for="status" class="control-label col-lg-4">Status</label>
						<div class="col-lg-8">
                        {{ Form::select('status', $data['status'], (isset($data['store']) ? $data['store']->status : ""), array("class"=>"form-control chzn-select", "data-placeholder" => "Selecione")) }}
						</div>
					</div>
                    @endif
                    @else
                    <div class="form-group">
                        <label for="status" class="control-label col-lg-4">Status</label>
                        <div class="col-lg-8">
                        {{ Form::select('status', $data['status'], (isset($data['store']) ? $data['store']->status : ""), array("class"=>"form-control chzn-select", "data-placeholder" => "Selecione")) }}
                        </div>
                    </div>
                    @endif
					<!-- /.form-group -->
					<div class="form-group">
						<label for="responsible" class="control-label col-lg-4">Responsável</label>
						<div class="col-lg-8">
                        {{ Form::text('responsible', (isset($data['store']) ? $data['store']->name : ""), array("class" => "form-control", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label class="control-label col-lg-4">CNPJ</label>
						<div class="col-lg-8">
                        {{ Form::text('cnpj', (isset($data['store']) ? $data['store']->cnpj : ""), array("class" => "form-control", "placeholder" => "11.111.111/0001-00", "data-mask" => "99.999.999/9999-99", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label class="control-label col-lg-4">Celular</label>
						<div class="col-lg-8">
                        {{ Form::text('mobile', (isset($data['store']) ? $data['store']->mobile : ""), array("class" => "form-control", "placeholder" => "(xx) 1-1111-1111", "data-mask" => "(99) 9-9999-9999", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="text2" class="control-label col-lg-4">Telefone</label>
						<div class="col-lg-8">
                        {{ Form::text('telephone', (isset($data['store']) ? $data['store']->telephone : ""), array("class" => "form-control", "placeholder" => "(xx) 1111-1111", "data-mask" => "(99) 9999-9999", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="text2" class="control-label col-lg-4">E-mail</label>
						<div class="col-lg-8">
                        {{ Form::email('email', (isset($data['store']) ? $data['store']->email : ""), array("class" => "form-control", "placeholder" => "e-mail@dominio.com", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="text4" class="control-label col-lg-4">Endereço</label>
						<div class="col-lg-8">
                        {{ Form::text('address', (isset($data['store']) ? $data['store']->address : ""), array("class" => "form-control", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					{{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
                    <a href="{{ URL::to('store') }}" class="btn btn-danger">Voltar</a>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<!--END TEXT INPUT FIELD-->
	<div class="col-lg-4">
		<div class="box dark">
			<header>
				<div class="icons">
					<i class="fa fa-question"></i>
				</div>
				<h5>Ajuda</h5>
				<!-- .toolbar -->
				<div class="toolbar">
					<nav style="padding: 8px;">
						<a href="javascript:;" class="btn btn-default btn-xs collapse-box">
							<i class="fa fa-minus"></i>
						</a>
						<a href="javascript:;" class="btn btn-default btn-xs full-box">
							<i class="fa fa-expand"></i>
						</a>
					</nav>
				</div>
				<!-- /.toolbar -->
			</header>
			<div class="body">
				<p>Aqui você pode criar uma loja:</p>
				<ul>
					<li><strong>Nome da loja:</strong> Nome da loja;</li>
					<li><strong>URL:</strong> URL do site institucional da empresa</li>
					<li><strong>Planos:</strong> Selecionar um plano pré cadastrado em Planos</li>
					<li><strong>Status:</strong> Ativo ou Bloqueado</li>
					<li><strong>Responsável:</strong> Nome da pessoa responsável pela revenda</li>
					<li><strong>Razão Social:</strong> Nome da empresa</li>
					<li><strong>CNPJ:</strong> CNPJ da empresa</li>
					<li><strong>Celular:</strong> Número de celular da pessoa responsável pela revenda</li>
					<li><strong>Telefone:</strong> Número de telefone do responsável na empresa</li>
					<li><strong>E-mail:</strong> E-mail da pessoa responsãvel pela revenda</li>
					<li><strong>Endereço:</strong> Endereço da empresa</li>
				</ul>
			</div>
		</div>
	</div>
	<!--END TEXT INPUT FIELD-->
</div>
@stop

@section('scripts')
    <!-- Screenfull -->
	{{ HTML::script('theme/assets/lib/screenfull/screenfull.js'); }}
	{{ HTML::script('theme/assets/lib/jquery.uniform/jquery.uniform.min.js'); }}
	{{ HTML::script('theme/assets/lib/inputlimiter/jquery.inputlimiter.js'); }}
	{{ HTML::script('theme/assets/lib/chosen/chosen.jquery.min.js'); }}
	{{ HTML::script('theme/assets/lib/colorpicker/js/bootstrap-colorpicker.js'); }}
	{{ HTML::script('theme/assets/lib/validVal/js/jquery.validVal.min.js'); }}
	{{ HTML::script('theme/assets/lib/moment/moment.min.js'); }}
	{{ HTML::script('theme/assets/lib/daterangepicker/daterangepicker.js'); }}
	{{ HTML::script('theme/assets/lib/datepicker/js/bootstrap-datepicker.js'); }}
	{{ HTML::script('theme/assets/lib/timepicker/js/bootstrap-timepicker.min.js'); }}
	{{ HTML::script('theme/assets/lib/switch/js/bootstrap-switch.min.js'); }}
	{{ HTML::script('theme/assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}

    <script>
    	$(".chzn-select").chosen();
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