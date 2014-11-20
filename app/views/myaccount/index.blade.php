@extends('layout')

@section('title')
	Smart Bracelet | Perfil
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Minha conta</h3>
@stop

@section('content')
<div class="row-fluid">
    <h3 class="box-header">Perfil</h3>
	<div class="box">
			<div class="body">
		        {{ Form::open(array("role" => "form", "class" => "form-horizontal", "method" => "PUT", "action" => array('MyAccountController@update', Auth::user()->id))) }}
					<div class="control-group">
						<label for="text1" class="control-label span4">Nome</label>
						<div class="controls span8">
		                {{ Form::text('name', Auth::user()->name, array("required")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label for="pass1" class="control-label span4">Usuário</label>
						<div class="controls span8">
		                {{ Form::text('username', Auth::user()->username, array("required")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label class="control-label span4">CPF</label>
						<div class="controls span8">
		                {{ Form::text('cpf', Auth::user()->cpf, array("placeholder" => "111.111.111-11", "data-mask" => "999.999.999-99", "required")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label for="autosize" class="control-label span4">RG</label>
						<div class="controls span8">
		                {{ Form::text('rg', Auth::user()->rg, array("placeholder" => "11.111.111-1", "data-mask" => "99.999.999-9", "required")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label class="control-label span4">Celular</label>
						<div class="controls span8">
		                {{ Form::text('mobile', Auth::user()->mobile, array("placeholder" => "(xx) 1-1111-1111", "data-mask" => "(99) 9-9999-9999", "required")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label for="text2" class="control-label span4">Telefone</label>
						<div class="controls span8">
		                {{ Form::text('phone', Auth::user()->phone, array("placeholder" => "(xx) 1111-1111", "data-mask" => "(99) 9999-9999", "required")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label for="text2" class="control-label span4">E-mail</label>
						<div class="controls span8">
		                {{ Form::email('email', Auth::user()->email, array("placeholder" => "e-mail@dominio.com", "required")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label for="text4" class="control-label span4">Endereço</label>
						<div class="controls span8">
		                {{ Form::text('address', Auth::user()->address, array("required")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<hr>
					<!-- /.control-group -->
					<div class="control-group">
						<label for="text4" class="control-label span4">Senha</label>
						<div class="controls span8">
		                {{ Form::password('password', array("id" => "password", "class" => "form-control")) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label for="autosize" class="control-label span4">Confirmar Senha</label>
						<div class="controls span8">
		                {{ Form::password('confirm_password', array("id" => "confirm_password", "class" => "form-control")) }}
						</div>
					</div>
					<!-- /.control-group -->
					{{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	{{ HTML::script('library/javascripts/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}

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