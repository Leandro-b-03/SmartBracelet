@extends('layout')

@section('title')
	Revender.ME | Planos
@stop

@section('style')
	{{ HTML::style('theme/assets/lib/datatables/3/dataTables.bootstrap.css'); }}
@stop

@section('name')
<h3><i class="fa fa-tasks"></i>&nbsp; Planos</h3>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box dark">
			<header>
				<div class="icons">
					<i class="fa fa-edit"></i>
				</div>
				<h5>Planos</h5>
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
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "method" => "PUT", "route" => array('plans.update'))) }}
              		{{ Form::hidden('id[trial]', (isset($plans['trial']->id) ? $plans['trial']->id : "")) }}
              		{{ Form::hidden('id[plan_1]', (isset($plans['plan_1']->id) ? $plans['plan_1']->id : "")) }}
              		{{ Form::hidden('id[plan_2]', (isset($plans['plan_2']->id) ? $plans['plan_2']->id : "")) }}
              		{{ Form::hidden('id[plan_3]', (isset($plans['plan_3']->id) ? $plans['plan_3']->id : "")) }}
              		{{ Form::hidden('id[plan_4]', (isset($plans['plan_4']->id) ? $plans['plan_4']->id : "")) }}
              		{{ Form::hidden('id[plan_5]', (isset($plans['plan_5']->id) ? $plans['plan_5']->id : "")) }}
                	<table id="dataTables-plans" class="table table-hover table-striped responsive-table">
                      <thead>
                        <tr>
                          <th>Plano</th>
                          <th>Nome</th>
                          <th>Qtd. de Produtos</th>
                          <th>Preço</th>
                          <th>Bloqueio Automatico</th>
                          <th>Ativo</th>
                          <th>Duração em dias</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Trial</td>
                          <td>{{ Form::text('name[trial]', (isset($plans['trial']->name) ? $plans['trial']->name : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('product[trial]', (isset($plans['trial']->product) ? $plans['trial']->product : ""), array("class" => "form-control")) }}</td>
                          <td></td>
                          <td>{{ Form::checkbox('status[trial]', null, (isset($plans['trial']->status) ? ($plans['trial']->status ? true : false) : false)) }}</td>
                          <td>{{ Form::checkbox('block[trial]', null, (isset($plans['trial']->block) ? ($plans['trial']->block ? true : false) : false)) }}</td>
                          <td>{{ Form::text('time[trial]', (isset($plans['trial']->time) ? $plans['trial']->time : ""), array("class" => "form-control")) }}</td>
                        </tr>
                        <tr>
                          <td>Plano 1</td>
                          <td>{{ Form::text('name[plan_1]', (isset($plans['plan_1']->name) ? $plans['plan_1']->name : ""), array("class" => "form-control", "required")) }}</td>
                          <td>{{ Form::text('product[plan_1]', (isset($plans['plan_1']->product) ? $plans['plan_1']->product : ""), array("class" => "form-control", "required")) }}</td>
                          <td>{{ Form::text('price[plan_1]', (isset($plans['plan_1']->price) ? $plans['plan_1']->price : ""), array("class" => "form-control", "required")) }}</td>
                          <td></td>
                          <td>{{ Form::checkbox('status[plan_1]', null, (isset($plans['plan_1']->status) ? ($plans['plan_1']->status ? true : false) : false)) }}</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Plano 2</td>
                          <td>{{ Form::text('name[plan_2]', (isset($plans['plan_2']->name) ? $plans['plan_2']->name : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('product[plan_2]', (isset($plans['plan_2']->product) ? $plans['plan_2']->product : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('price[plan_2]', (isset($plans['plan_2']->price) ? $plans['plan_2']->price : ""), array("class" => "form-control")) }}</td>
                          <td></td>
                          <td>{{ Form::checkbox('status[plan_2]', null, (isset($plans['plan_2']->status) ? ($plans['plan_2']->status ? true : false) : false)) }}</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Plano 3</td>
                          <td>{{ Form::text('name[plan_3]', (isset($plans['plan_3']->name) ? $plans['plan_3']->name : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('product[plan_3]', (isset($plans['plan_3']->product) ? $plans['plan_3']->product : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('price[plan_3]', (isset($plans['plan_3']->price) ? $plans['plan_3']->price : ""), array("class" => "form-control")) }}</td>
                          <td></td>
                          <td>{{ Form::checkbox('status[plan_3]', null, (isset($plans['plan_3']->status) ? ($plans['plan_3']->status ? true : false) : false)) }}</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Plano 4</td>
                          <td>{{ Form::text('name[plan_4]', (isset($plans['plan_4']->name) ? $plans['plan_4']->name : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('product[plan_4]', (isset($plans['plan_4']->product) ? $plans['plan_4']->product : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('price[plan_4]', (isset($plans['plan_4']->price) ? $plans['plan_4']->price : ""), array("class" => "form-control")) }}</td>
                          <td></td>
                          <td>{{ Form::checkbox('status[plan_4]', null, (isset($plans['plan_4']->status) ? ($plans['plan_4']->status ? true : false) : false)) }}</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Plano 5</td>
                          <td>{{ Form::text('name[plan_5]', (isset($plans['plan_5']->name) ? $plans['plan_5']->name : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('product[plan_5]', (isset($plans['plan_5']->product) ? $plans['plan_5']->product : ""), array("class" => "form-control")) }}</td>
                          <td>{{ Form::text('price[plan_5]', (isset($plans['plan_5']->price) ? $plans['plan_5']->price : ""), array("class" => "form-control")) }}</td>
                          <td></td>
                          <td>{{ Form::checkbox('status[plan_5]', null, (isset($plans['plan_5']->status) ? ($plans['plan_5']->status ? true : false) : false)) }}</td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
					{{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<!--END TEXT INPUT FIELD-->
	<!-- <div class="col-lg-4">
		<div class="box dark">
			<header>
				<div class="icons">
					<i class="fa fa-question"></i>
				</div>
				<h5>Ajuda</h5>
				<!-- .toolbar - - >
				<div class="toolbar">
					<nav style="padding: 8px;">
						<a href="javascript:;" class="btn btn-default btn-xs collapse-box">
							<i class="fa fa-minus"></i>
						</a>
						<a href="javascript:;" class="btn btn-default btn-xs full-box">
							<i class="fa fa-expand"></i>
						</a>
						<a href="javascript:;" class="btn btn-danger btn-xs close-box">
							<i class="fa fa-times"></i>
						</a>
					</nav>
				</div>
				<!-- /.toolbar - ->
			</header>
			<div class="body">
				<p>Aqui você pode alterar os seus planos:</p>
				<ul>
					<li><strong>Trial:</strong> Número de produtos, duração em dias do plano<br> e bloqueio automático após o periodo;</li>
					<li><strong>Plano 1:</strong> Número de produtos e seu valor;</li>
					<li><strong>Plano 2:</strong> Número de produtos e seu valor;</li>
					<li><strong>Plano 3:</strong> Número de produtos e seu valor;</li>
					<li><strong>Plano 4:</strong> Número de produtos e seu valor;</li>
					<li><strong>Plano 5:</strong> Número de produtos e seu valor.</li>
				</ul>
			</div>
		</div>
	</div> -->
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
	{{ HTML::script('theme/assets/lib/datatables/jquery.dataTables.js'); }}
	{{ HTML::script('theme/assets/lib/datatables/3/dataTables.bootstrap.js'); }}

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