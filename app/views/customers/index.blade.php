@extends('layout')

@section('title')
    Smart Bracelet | Clientes
@stop


@section('content')
<div class="row-fluid">
    <h3 class="box-header">Clientes</h3>
    <div class="box">
        <div class="box pull-right" style="padding-bottom: 20px">
            <a class="btn btn-blue"href="{{ URL::to('customers/create') }}">
                <i class="fa fa-pencil"></i>
                Adicionar Cliente
            </a>
        </div>
            <table class="table table-bordered datagrid">
                <thead>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>Data de aniversario</th>
                    <th>Ação</th>
                </thead>
                @if ($customers->count() > 0)
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->rg }}</td>
                        <td>{{ $customer->cpf }}</td>
                        <td>{{ $customer->birthday }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ URL::to('customers/' . $customer->id . '/edit') }}">
                                <i class="fa fa-pencil"></i>
                                Editar
                            </a>
                        </td>
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