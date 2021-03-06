@extends('layout')

@section('title')
	Smart Bracelet | Pulseiras
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Minha conta</h3>
@stop

@section('content')
<div class="row-fluid">
    <h3 class="box-header">Pulseiras</h3>
	<div class="box">
			<div class="body">
				@if(Request::is('commands/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "commands")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('commands.update', $data['bracelet']->id))) }}
                @endif
					<div class="control-group">
						<label for="tag" class="control-label span4">TAG</label>
						<div class="controls span8">
		                {{ Form::text('tag', (isset($data['bracelet']) ? $data['bracelet']->tag : ""), array("class" => "form-control", "required", 'id' => 'tag')) }}
						</div>
					</div>
					<!-- /.control-group -->
					<div class="control-group">
						<label for="color" class="control-label span4">Cor</label>
						<div class="controls span8">
		                {{ Form::select('color',
                                array('1' => 'Vermelho', '2' => 'Verde'), (isset($data['bracelet']) ? $data['bracelet']->color : '1')
                            );
                        }}
						</div>
					</div>
					{{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
					<a class="btn btn-danger" href="{{ URL::to('commands') }}">Voltar</a>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	{{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/jQuery.glob.min.js'); }}
	{{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/globinfo/jQuery.glob.pt-BR.min.js'); }}
	{{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/jquery.GlobalMoneyInput.js'); }}

	<script>
		$(function($){
			/* Init Global Plugin with Brazilian Portuguese configuration */
			var cfgCulture = 'pt-BR';
			$.preferCulture(cfgCulture);

			$('#price').maskMoney();
		});

        setInterval(ajaxCall, 1000);

        function ajaxCall() {
            $.ajax({
                url: "/general/getComand",
                method: "get",
                data: "new=true&id_user=" + {{ Auth::user()->id }},
                success: function(data) {
                    if (data.error) {
                        new PNotify({
                            title: 'Erro',
                            text: data.error,
                            type: 'error',
                            styling: 'fontawesome'
                            });
                    } else {
                        comand = data.bracelet.tag;
    
                        $('#tag').val(data.bracelet.tag);
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