@extends('layout')

@section('title')
    Smart Bracelet | Clientes
@stop


@section('content')
<div class="row-fluid">
    <h3 class="box-header">Clientes</h3>
    <div class="box">
        <div class="box pull-right" style="padding-bottom: 20px">
            <a class="btn btn-blue"href="{{ URL::to('custumers/create') }}">
                <i class="fa fa-pencil"></i>
                Adicionar Cliente
            </a>
        </div>
            <table class="table table-bordered">
                <thead>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>Data de aniversario</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    @if ($custumers->count() > 0)
                    @foreach ($custumers as $custumer)
                    <tr>
                        <td>{{$custumer->name }}</td>
                        <td>{{$custumer->address}}</td>
                        <td>{{$custumer->phone}}</td>
                        <td>{{$custumer->rg}}</td>
                        <td>{{$custumer->cpf}}</td>
                        <td>{{$custumer->birthday}}</td>
                        <td>
                			{{ Form::open(array('method' => 'DESTROY', "url" => array('custumers', $custumer->id))) }}
                			 	{{ Form::hidden('_method', 'DELETE') }}
                                <a class="btn btn-primary" href="{{ URL::to('custumers/' . $custumer->id . '/edit') }}">
                                    <i class="fa fa-pencil"></i>
                                    Editar
                                </a>
                                {{ HTML::decode(Form::button('<i class="fa fa-close"></i> Deletar', array("class" => "btn btn-danger", "type" => "submit"))) }}
                            {{ Form::close() }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7">Não há produtos</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('scripts')
    {{ HTML::script('library/javascripts/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}

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