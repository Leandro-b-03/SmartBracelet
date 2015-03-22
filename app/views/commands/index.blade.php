@extends('layout')

@section('title')
    Smart Bracelet | Comandas
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Minha conta</h3>
@stop

@section('content')
<div class="row-fluid">
    <h3 class="box-header">Comandas</h3>
    <div class="box">
        <div class="box pull-right" style="padding-bottom: 20px">
            <a class="btn btn-blue"href="{{ URL::to('commands/create') }}">
                <i class="fa fa-pencil"></i>
                Adicionar Comandas
            </a>
        </div>
            <table class="table table-bordered datagrid">
                <thead>
                    <th>TAG</th>
                    <th>Cor</th>
                    <th>Ação</th>
                </thead>
                @if ($commands->count() > 0)
                <tbody>
                    @foreach ($commands as $command)
                    <tr>
                        <td>{{ $command->tag }}</td>
                        <td>{{ ($command->color == 1 ? 'Vermelho' : 'Verde') }}</td>
                        <td>{{ Form::open(array('url' => 'commands/' . $command->id, 'class' => '')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <a class="btn btn-primary" href="{{ URL::to('commands/' . $command->id . '/edit') }}">
                                    <i class="fa fa-pencil"></i>
                                    Editar
                                </a>
                                {{ HTML::decode(Form::button('<i class="fa fa-close"></i> Deletar', array("class" => "btn btn-danger", "type" => "submit"))) }}
                            {{ Form::close() }}</td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
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