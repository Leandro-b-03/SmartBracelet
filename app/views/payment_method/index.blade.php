@extends('layout')

@section('title')
    Revender.ME | Meios de Pagamentos
@stop

@section('style')
    {{ HTML::style('theme/assets/lib/datatables/3/dataTables.bootstrap.css'); }}
@stop

@section('name')
<h3><i class="fa fa-tasks"></i>&nbsp; Meios de Pagamentos</h3>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box dark">
            <header>
                <h5>Meios de Pagamentos</h5>
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
                    <a class="btn btn-primary" href="{{ URL::to('payments_method/create') }}">
                        <i class="fa fa-pencil"></i>
                        Nova forma de pagamento
                    </a>
                </div>
                <div class="clearfix"></div>
                <hr />
                <table id="dataTables-plans" class="table table-hover table-striped responsive-table">
                    <thead>
                        <tr>
                            <th>Facilitador</th>
                            <th>E-mail</th>
                            <th>Token</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{ ($payment->type ? 'Bcash' : 'PagSeguro') }}</td>
                            <td>{{ $payment->email }}</td>
                            <td>{{ $payment->token }}</td>
                            <td>{{ ($payment->status ? 'Exibir' : 'Não Exibir') }}</td>
                            <td>{{ Form::open(array('url' => 'payments_method/' . $payment->id, 'class' => '')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    <a class="btn btn-primary" href="{{ URL::to('payments_method/' . $payment->id . '/edit') }}">
                                        <i class="fa fa-pencil"></i>
                                        Editar
                                    </a>
                                    {{ HTML::decode(Form::button('<i class="fa fa-close"></i> Deletar', array("class" => "btn btn-danger", "type" => "submit"))) }}
                                {{ Form::close() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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