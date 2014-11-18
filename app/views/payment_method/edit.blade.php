@extends('layout')

@section('title')
	Revender.ME | Nova Método de Pagamento
@stop

@section('style')
    {{ HTML::style("theme/assets/lib/chosen/chosen.min.css") }}
@stop

@section('name')
<h3><i class="fa fa-ticket"></i>&nbsp;Método de pagamento</h3>
@stop

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="box dark">
			<header>
				<div class="icons">
					<i class="fa fa-edit"></i>
				</div>
				<h5>Novo método de pagamento</h5>
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
				@if(Request::is('payments_method/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "payments_method")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('payments_method.update', $data['payment_method']->id))) }}
                @endif
                    <div class="form-group">
                        <label for="text2" class="control-label col-lg-4">E-mail</label>
                        <div class="col-lg-8">
                        {{ Form::email('email', (isset($data['payment_method']) ? $data['payment_method']->email : ''), array("class" => "form-control", "placeholder" => "e-mail@dominio.com", "required")) }}
                        </div>
                    </div>
                    <!-- /.form-group -->
					<div class="form-group">
						<label for="payments_method_name" class="control-label col-lg-4">TOKEN</label>
						<div class="col-lg-8">
                        {{ Form::text('token', (isset($data['payment_method']) ? $data['payment_method']->token : ''), array("class" => "form-control", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="plan" class="control-label col-lg-4">Facilitador</label>
						<div class="col-lg-8">
                        {{ Form::select('type', array('0' => 'PagSeguro'), '', array("class"=>"form-control chzn-select")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="responsible" class="control-label col-lg-4">Ativo</label>
						<div class="col-lg-8">
                        {{ Form::checkbox('status', 1, (isset($data['payment_method']) ? $data['payment_method']->status : '')) }}
						</div>
					</div>
                    <!-- /.form-group -->
					{{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
                    <a href="{{ URL::to('payments_method') }}" class="btn btn-danger">Voltar</a>
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