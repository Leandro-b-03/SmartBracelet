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
        <div class="box pull-right" style="padding-bottom: 20px">
            <a class="btn btn-blue"href="{{ URL::to('bracelets/create') }}">
                <i class="fa fa-pencil"></i>
                Adicionar Pulseiras
            </a>
        </div>
            <table class="table table-bordered">
                <thead>
                    <th>TAG</th>
                    <th>Funcionario/Usuário</th>
                    <th>Cor</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    @if ($bracelets->count() > 0)
                    @foreach ($bracelets as $bracelet)
                    <tr>
                        <td>{{ $bracelet->tag }}</td>
                        <td>{{ $bracelet->user->name }}</td>
                        <td>{{ $bracelet->color }}</td>
                        <td>{{ Form::open(array('url' => 'bracelets/' . $bracelet->id, 'class' => '')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <a class="btn btn-primary" href="{{ URL::to('bracelets/' . $bracelet->id . '/edit') }}">
                                    <i class="fa fa-pencil"></i>
                                    Editar
                                </a>
                                {{ HTML::decode(Form::button('<i class="fa fa-close"></i> Deletar', array("class" => "btn btn-danger", "type" => "submit"))) }}
                            {{ Form::close() }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4">Não há pulseiras</td>
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