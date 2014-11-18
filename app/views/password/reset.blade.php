<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Revender.ME - Login</title>
        <meta name="msapplication-TileColor" content="#5bc0de" />
        <meta name="msapplication-TileImage" content="theme/assets/img/metis-tile.png" />
        <!-- Bootstrap -->
        {{ HTML::style('theme/assets/lib/bootstrap/css/bootstrap.min.css'); }}
        <!-- Font Awesome -->
        {{ HTML::style('theme/assets/lib/font-awesome/css/font-awesome.min.css'); }}
        <!-- Metis core stylesheet -->
        {{ HTML::style('theme/assets/css/main.min.css'); }}
        {{ HTML::style('theme/assets/lib/animate.css/animate.min.css'); }}
        <!-- PNotify -->
        {{ HTML::style("theme/assets/lib/pnotify/pnotify.custom.min.css") }}
    </head>
    <body class="login">
        <div class="form-signin">
            <div class="text-center">
                <!-- <img src="theme/assets/img/logo.png" alt="Revender.ME Logo"> -->
                <h2>Revender.ME</h2>
            </div>
            <hr>
            <div class="tab-content">
                <div id="forgot" class="tab-pane active">
                    {{ Form::open(array("role" => "form", "action" => array('RemindersController@postReset'))) }}
                        <p class="text-muted text-center">Coloque os dados para trocar a senha</p>
                        {{ Form::hidden('token', $token) }}
                        {{ Form::text('email', "", array("class" => "form-control", "placeholder" => "e-mail@dominio.com", "required")) }}
                        <hr>
                        {{ Form::password('password', array("class" => "form-control top", "placeholder" => "Senha", "required")) }}
                        {{ Form::password('password_confirmation', array("class" => "form-control bottom", "placeholder" => "Confirmar Senha", "required")) }}
                        <br>
                        {{ Form::submit('Recuperar senha', array("class" => "btn btn-lg btn-danger btn-block")) }}
                    {{ Form::close() }}
                </div>
            </div>
            <hr>
        </div>
        {{ HTML::script("theme/assets/lib/jquery/jquery.min.js") }}
        {{ HTML::script("theme/assets/lib/bootstrap/js/bootstrap.min.js") }}
        {{ HTML::script("theme/assets/lib/pnotify/pnotify.custom.min.js") }}

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
    </body>
</html>