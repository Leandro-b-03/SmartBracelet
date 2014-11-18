@extends('layout')

@section('title')
	Revender.ME | Integração
@stop

@section('style')
    {{ HTML::style("theme/assets/lib/bootcards/css/bootcards.css") }}
    {{ HTML::style("theme/assets/lib/bootcards/css/bootcards-desktop.css") }}
    {{ HTML::style("theme/assets/lib/chosen/chosen.min.css") }}
    <style>
	.no_margin{
		margin:0px !important;
	}
    </style>
@stop

@section('name')
<h3><i class="fa fa-ticket"></i>&nbsp; Lojas</h3>
@stop

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="box dark">
			<header>
				<div class="icons">
					<i class="fa fa-edit"></i>
				</div>
				<h5>Lojas</h5>
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
				<div class="tolbar pull-right">
					<a class="btn btn-primary" href="{{ URL::to('integration/create') }}">
						<i class="fa fa-pencil"></i>
						Criar novo token
					</a>
				</div>
				<div class="clearfix"></div>
				<hr />
				@if($data['eapps']->count())
				@foreach ($data['eapps'] as $eapp)
				<div class="col-sm-6 bootcards-list">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title pull-left">{{ $eapp->app }}</h3>
							<div class="pull-right">
								{{ Form::open(array('url' => 'integration/' . $eapp->id, 'class' => 'pull-right')) }}
									{{ Form::hidden('_method', 'DELETE') }}
									<a class="btn btn-primary" href="{{ URL::to('integration/' . $eapp->id . '/edit') }}">
										<i class="fa fa-pencil"></i>
										Editar
									</a>
									{{ HTML::decode(Form::button('<i class="fa fa-close"></i> Deletar', array("class" => "btn btn-danger", "type" => "submit"))) }}
								{{ Form::close() }}
							</div>
						</div>
						<div class="list-group">
							<div class="list-group-item">
								<p class="list-group-item-text">URL de retorno</p>
								<h4 class="list-group-item-heading">{{ $eapp->url_return }}</h4>
							</div>
							<div class="list-group-item">
								<p class="list-group-item-text">Token</p>
								<h4 class="list-group-item-heading">{{ $eapp->token }}</h4>
							</div>
						</div>
					    <div class="panel-footer">
					        <a href="{{ URL::to('integration/jquery/' . $eapp->id) }}" class="btn btn-default btn-block"><i class="fa fa-arrow-down"></i> Download do modelo</a>
					    </div>
						<div class="panel-footer">
							<small class="pull-right"><a  data-toggle="modal" data-target="#integration-help">Manual</a></small>
						</div>
					</div>
				</div>
				@endforeach
				<div class="clearfix"></div>
				<div class="pull-right">
					{{ $data['eapps']->links() }}
				</div>
				<div class="clearfix"></div>
				@else
				<p>Não há tokens cadastrados</p>
				@endif
			</div>
		</div>
	</div>
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
				<p>Aqui você pode gerar tokens de integração para o seus sites, na opção download do modelo você pode fazer baixar um zip na qual há um formulário em html para a criação da loja.</p>
				<p>Para mais detalhes <a data-toggle="modal" data-target="#integration-help">clique aqui</a>.</p>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id="integration-help" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="integration-help" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title pull-left">Manual - Integração</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
    {{ HTML::script("theme/assets/lib/bootcards/js/bootcards.js"); }}

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