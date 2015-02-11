<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]>-->
<html class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            Smart Bracelet - Sign In
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        {{ HTML::script('library/javascripts/1.3.0/adminflare-demo-init.min.js'); }}

        {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700'); }}
        {{ HTML::style('library/css/1.3.0/black-blue/bootstrap.min.css'); }}
        {{ HTML::style('library/css/1.3.0/default/adminflare.min.css'); }}
        {{ HTML::style('library/css/1.3.0/pages.min.css'); }}
        {{ HTML::style("library/css/pnotify.custom.min.css") }}

        {{ HTML::script('library/javascripts/1.3.0/modernizr-jquery.min.js'); }}

        <!--[if lte IE 9]>
            {{ HTML::script('library/javascripts/jquery.placeholder.min.js'); }}
            <script type="text/javascript">
                $(document).ready(function () {
                    $('input, textarea').placeholder();
                });
            </script>
        <![endif]-->

        <script type="text/javascript">
            $(document).ready(function() {
                var updateBoxPosition = function() {
                    $('#signin-container').css({
                        'margin-top': ($(window).height() - $('#signin-container').height()) / 2
                    });
                };
                $(window).resize(updateBoxPosition);
                setTimeout(updateBoxPosition, 50);
            });
        </script>
    </head>
    <body class="signin-page">

        <!-- Page content
            ================================================== -->
        <section id="signin-container">
            <a title="Smart Bracelet" class="header">
                <img src="library/images/af-logo-signin.png" alt="Logar em Smart Bracelet">
                <span>
                    Logar em<br>
                    <strong>Smart Bracelet</strong>
                </span>
            </a>
            {{ Form::open(array("role" => "form")) }}
                <fieldset>
                    <div class="fields">
                        {{ Form::text('username', "", array("class" => "form-control top", "placeholder" => "Usuário", "autofocus", "required")) }}
                        {{ Form::password('password', array("class" => "form-control bottom", "placeholder" => "Senha", "required")) }}
                    </div>
                {{ Form::button('Login', array("class" => "btn btn-primary btn-block", "tabindex" => "4", "type" => "submit")) }}
                </fieldset>
            {{ Form::close() }}
        </section>

        {{ HTML::script("library/javascripts/pnotify.custom.min.js") }}
        @if (Session::has('flash_error'))
        <script type="text/javascript">
            $(function(){
                new PNotify({
                    title: 'Erro',
                    text: '{{ Session::get('flash_error') }}',
                    type: 'error',
                    styling: 'fontawesome'
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
                    type: 'success',
                    styling: 'fontawesome'
                });
            });
        </script>
        @endif
    </body>
</html>