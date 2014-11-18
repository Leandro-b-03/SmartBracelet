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
				@if(Request::is('integration/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "integration")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('integration.update', $data['eapp']->id))) }}
                @endif
					<div class="form-group">
						<label for="app" class="control-label col-lg-4">Aplicação</label>
						<div class="col-lg-8">
                        {{ Form::text('app', (isset($data['eapp']) ? $data['eapp']->app : ""), array("class" => "form-control", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="url_return" class="control-label col-lg-4">URL de retorno</label>
						<div class="col-lg-8">
                        {{ Form::text('url_return', (isset($data['eapp']) ? $data['eapp']->url_return : ""), array("class" => "form-control", "placeholder" => "http://dominio.com/retorno.php", "pattern" => "^(https?://)?(www\.)?([a-zA-Z0-9_%]*)\b\.[a-z]{2,4}(\.[a-z]{2})?((/[a-zA-Z0-9_%]*)+)?(\.[a-z]*)?")) }}
						</div>
					</div>
					<!-- /.form-group -->
					{{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
                    <a href="{{ URL::to('integration') }}" class="btn btn-danger">Voltar</a>
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
				<p>Aqui você pode criar um token para sua aplicação:</p>
				<ul>
					<li><strong>Aplicação:</strong> Nome da loja;</li>
					<li><strong>URL de retorno:</strong> URL da qual tera o retorno do site.</li>
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