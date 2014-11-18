@extends('layout')

@section('title')
	Revender.ME | Minha conta
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Minha conta</h3>
@stop

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="box dark">
			<header>
				<div class="icons">
					<i class="fa fa-edit"></i>
				</div>
				<h5>Dados</h5>
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
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "method" => "PUT", "action" => array('MyAccountController@update', Auth::user()->id))) }}
					<div class="form-group">
						<label for="text1" class="control-label col-lg-4">Responsável</label>
						<div class="col-lg-8">
                        {{ Form::text('responsible', Auth::user()->name, array("class" => "form-control", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="pass1" class="control-label col-lg-4">Razão Social</label>
						<div class="col-lg-8">
                        {{ Form::text('corporate_name', Auth::user()->corporate_name, array("class" => "form-control", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label class="control-label col-lg-4">CNPJ</label>
						<div class="col-lg-8">
                        {{ Form::text('cnpj', Auth::user()->cnpj, array("class" => "form-control", "placeholder" => "11.111.111/0001-00", "data-mask" => "99.999.999/9999-99", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label class="control-label col-lg-4">Celular</label>
						<div class="col-lg-8">
                        {{ Form::text('mobile', Auth::user()->mobile, array("class" => "form-control", "placeholder" => "(xx) 1-1111-1111", "data-mask" => "(99) 9-9999-9999", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="text2" class="control-label col-lg-4">Telefone</label>
						<div class="col-lg-8">
                        {{ Form::text('telephone', Auth::user()->telephone, array("class" => "form-control", "placeholder" => "(xx) 1111-1111", "data-mask" => "(99) 9999-9999", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="text2" class="control-label col-lg-4">E-mail</label>
						<div class="col-lg-8">
                        {{ Form::email('email', Auth::user()->email, array("class" => "form-control", "placeholder" => "e-mail@dominio.com", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="text4" class="control-label col-lg-4">Endereço</label>
						<div class="col-lg-8">
                        {{ Form::text('address', Auth::user()->address, array("class" => "form-control", "required")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="autosize" class="control-label col-lg-4">URL</label>
						<div class="col-lg-8">
                        {{ Form::text('url', Auth::user()->url, array("class" => "form-control", "placeholder" => "dominio.com", "pattern" => "^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<hr>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="text4" class="control-label col-lg-4">Senha</label>
						<div class="col-lg-8">
                        {{ Form::password('password', array("id" => "password", "class" => "form-control")) }}
						</div>
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label for="autosize" class="control-label col-lg-4">Confirmar Senha</label>
						<div class="col-lg-8">
                        {{ Form::password('confirm_password', array("id" => "confirm_password", "class" => "form-control")) }}
						</div>
					</div>
					<!-- /.form-group -->
					{{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
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
				<p>Aqui você pode alterar dados cadastrais:</p>
				<ul>
					<li><strong>Responsável:</strong> Nome da pessoa responsãvel pela revenda</li>
					<li><strong>Razão Social:</strong> Nome da empresa</li>
					<li><strong>CNPJ:</strong> CNPJ da empresa</li>
					<li><strong>Celular:</strong> Número de celular da pessoa responsãvel pela revenda</li>
					<li><strong>Telefone:</strong> Número de telefone do responsável na empresa</li>
					<li><strong>E-mail:</strong> E-mail da pessoa responsãvel pela revenda</li>
					<li><strong>Endereço:</strong> Endereço da empresa</li>
					<li><strong>URL:</strong> URL do site institucional da empresa</li>
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
		document.getElementById("password").onchange = validatePassword;
    	document.getElementById("confirm_password").onchange = validatePassword;

    	function validatePassword(){
			var pass2=document.getElementById("confirm_password").value;
			var pass1=document.getElementById("password").value;
			if(pass1!=pass2) {
	            $(function(){
	                new PNotify({
	                    title: 'Erro',
	                    text: 'Senhas não são iguais',
	                    type: 'error'
	                });
	            });

	            $('#confirm_password').focus();
	        }
		}

		$('form').submit(function() {
			console.log($('#password').val() != "");
			if($('#password').val() != "") {
				if($('#password').val() != $('#confirm_password').val()) {
					return false;
				}
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