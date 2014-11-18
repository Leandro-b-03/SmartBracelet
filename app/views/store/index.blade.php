@extends('layout')

@section('title')
	Revender.ME | Lojas
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
<div class="text-center">
	{{ Form::open(array("class" => "form", "method" => "GET")) }}
		<div class="form-group">
			<div class="col-md-2">
	        {{ Form::text('store_name', $data['store_name'], array("class" => "form-control", "placeholder" => "Nome da loja")) }}
			</div>
			<div class="col-md-2">
	        {{ Form::select('plan', $data['plans'], $data['plan'], array("class"=>"form-control chzn-select", "data-placeholder" => "Plano")) }}
			</div>
			<div class="col-md-2">
	        {{ Form::select('status', $data['status'], $data['status_select'], array("class"=>"form-control chzn-select", "data-placeholder" => "Status")) }}
			</div>
			<div class="col-md-2">
				<label>Pagamento<br>pendente {{ Form::checkbox('payment') }}</label>
			</div>
		</div>
		<!-- /.form-group -->
		<div class="tolbar pull-right">
			{{ Form::submit('Pesquisar', array("class" => "btn btn-primary")) }}
			<a class="btn btn-warning" href="{{ URL::to('store') }}">
				Limpar pesquisa
			</a>
		</div>
		<div class="clearfix"></div>
	{{ Form::close() }}
</div>
<hr />
<div class="row">
	<div class="col-lg-12">
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
				{{ Form::open(array('id' => 'store_form', 'url' => 'payments/batch')) }}
					<div class="tolbar pull-right">
						<a class="btn btn-primary" href="{{ URL::to('store/create') }}">
							<i class="fa fa-pencil"></i>
							Nova Loja
						</a>
						{{ HTML::decode(Form::button('<i class="fa fa-credit-card"></i> Pagar selecionados', array("class" => "btn btn-danger", "type" => "submit"))) }}
					</div>
					<div class="clearfix"></div>
					<hr />
					@if($data['stores']->count())
					@foreach ($data['stores'] as $store)
					<div class="col-sm-3 bootcards-list">
						<div class="panel panel-default">
							<div class="panel-heading clearfix">
								<h3 class="panel-title pull-left">{{ $store->store_name }}</h3>
								<a class="btn btn-primary pull-right" href="{{ URL::to('store/' . $store->id . '/edit') }}">
									<i class="fa fa-pencil"></i>
									Editar
								</a>
							</div>
							<div class="list-group">
								<div class="list-group-item">
									<p class="list-group-item-text">Administrador</p>
									<h4 class="list-group-item-heading">{{ Auth::user()->name }}</h4>
								</div>
								<div class="list-group-item">
									<p class="list-group-item-text">Responsável</p>
									<h4 class="list-group-item-heading">{{ $store->name }}</h4>
								</div>
								<div class="list-group-item">
									<p class="list-group-item-text">Status</p>
									<h4 class="list-group-item-heading">{{ (isset($store->status) ? (($store->status == 1) ? 'Ativo' : (($store->status == 2) ? 'Bloqueado' : (($store->status == 3) ? 'Cancelado' : (($store->status == 4) ? 'Bloqueado pela revenda' : 'Cancelado pela revenda')))) : "Não há estatus" ) }}</h4>
								</div>
								<div class="list-group-item">
									<p class="list-group-item-text">Plano</p>
									<h4 class="list-group-item-heading">{{ $store->plan }}</h4>
								</div>
							</div>
							<div class="panel-footer">
								<small class="pull-left">
								@if(isset($store->paid))
								@if(!$store->paid)
									<label>Selecionar para pagamento {{ Form::checkbox('payment[]', $store->id, false, array('class' => 'no_margin')) }}</label>
								@else
									<label><i class="fa fa-check"></i></label>
								@endif
								@else
									<label><i class="fa fa-check"></i></label>
								@endif
								</small>
								<small class="pull-right">
									<a class="btn btn-xs btn-default" href="{{ URL::to('store/manage/' . $store->edite_me_store_id) }}">
										<i class="fa fa-bars"></i>
										Gerenciar
									</a>
								</small>
							</div>
						</div>
					</div>
					@endforeach
					<div class="clearfix"></div>
					<div class="pull-right">
						{{ $data['stores']->links() }}
					</div>
					<div class="clearfix"></div>
					@else
					<p>Não há lojas cadastradas</p>
					@endif
				{{ Form::close() }}
			</div>
		</div>
	</div>
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
    {{ HTML::script("theme/assets/lib/bootcards/js/bootcards.js") }}

    <script type="text/javascript">
    	$(".chzn-select").chosen();

    	$('#store_form').submit(function() {
    		console.log('teste');
    		if(!$('input:checkbox', this).is(':checked')) {
	            new PNotify({
	                title: 'Erro',
	                text: 'Selecione ao menos 1 loja em débito.',
	                type: 'error'
	            });

	            return false;
    		}
    	})
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