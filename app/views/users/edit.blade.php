@extends('layout')

@section('title')
    Smart Bracelet | Usuários
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Usuários</h3>
@stop

@section('content')
<div class="row-fluid">
    <h3 class="box-header">Usuários</h3>
    <div class="box">
            <div class="body">

            $user->name         = Input::get('name');
            $user->username     = Input::get('username');
            $user->email        = Input::get('email');
            $user->password     = Input::get('password');
            $user->cpf          = Input::get('cpf');
            $user->rg           = Input::get('rg');
            $user->phone        = Input::get('phone');
            $user->mobile       = Input::get('mobile');
            $user->address      = Input::get('address');
                @if(Request::is('users/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "users")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('users.update', $data['user']->id))) }}
                @endif
                    <div class="control-group">
                        <label for="name" class="control-label span4">Nome Completo</label>
                        <div class="controls span8">
                        {{ Form::text('name', (isset($data['user']) ? $data['user']->name : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="username" class="control-label span4">Nome de Usuário</label>
                        <div class="controls span8">
                        {{ Form::text('username', (isset($data['user']) ? $data['user']->username : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="email" class="control-label span4">Email</label>
                        <div class="controls span8">
                        {{ Form::text('email', (isset($data['user']) ? $data['user']->email : ""), array("id" => "email", "class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="cpf" class="control-label span4">CPF</label>
                        <div class="controls span8">
                        {{ Form::text('cpf', (isset($data['user']) ? $data['user']->cpf : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="rg" class="control-label span4">RG</label>
                        <div class="controls span8">
                        {{ Form::text('rg', (isset($data['user']) ? $data['user']->rg : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="phone" class="control-label span4">Telefone</label>
                        <div class="controls span8">
                        {{ Form::text('phone', (isset($data['user']) ? $data['user']->phone : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="mobile" class="control-label span4">Celular</label>
                        <div class="controls span8">
                        {{ Form::text('mobile', (isset($data['user']) ? $data['user']->mobile : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="address" class="control-label span4">Endereço</label>
                        <div class="controls span8">
                        {{ Form::text('address', (isset($data['user']) ? $data['user']->address : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="status" class="control-label span4">Status</label>
                        <div class="controls span8">
                        {{ Form::select('status',
                                array('1' => 'Ativado', '0' => 'Destivado'), (isset($data['user']) ? $data['user']->status : '1')
                            );
                        }}
                        </div>
                    </div>
                    <hr />
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="password" class="control-label span4">Senha</label>
                        <div class="controls span8">
                        {{ Form::text('password', (isset($data['user']) ? $data['user']->password : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="confirm" class="control-label span4">Confirmar Senha</label>
                        <div class="controls span8">
                        {{ Form::text('confirm', (isset($data['user']) ? $data['user']->confirm : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    {{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
                    <a class="btn btn-danger" href="{{ URL::to('users') }}">Voltar</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
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