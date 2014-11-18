<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        AdminFlare - Sign In
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <script src="assets/javascripts/1.3.0/adminflare-demo-init.min.js" type="text/javascript"></script>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        // Include Bootstrap stylesheet 
        document.write('<link href="assets/css/' + DEMO_ADMINFLARE_VERSION + '/' + DEMO_CURRENT_THEME + '/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" id="bootstrap-css">');
        // Include AdminFlare stylesheet 
        document.write('<link href="assets/css/' + DEMO_ADMINFLARE_VERSION + '/' + DEMO_CURRENT_THEME + '/adminflare.min.css" media="all" rel="stylesheet" type="text/css" id="adminflare-css">');
        // Include AdminFlare page stylesheet 
        document.write('<link href="assets/css/' + DEMO_ADMINFLARE_VERSION + '/pages.min.css" media="all" rel="stylesheet" type="text/css">');
    </script>
    
    <script src="assets/javascripts/1.3.0/modernizr-jquery.min.js" type="text/javascript"></script>
    <script src="assets/javascripts/1.3.0/adminflare-demo.min.js" type="text/javascript"></script>

    <!--[if lte IE 9]>
        <script src="assets/javascripts/jquery.placeholder.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('input, textarea').placeholder();
            });
        </script>
    <![endif]-->
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#signin-container').submit(function() {
                document.location = 'dashboard.html';
                return false;
            });

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
        <a href="dashboard.html" title="AdminFlare" class="header">
            <img src="assets/images/af-logo-signin.png" alt="Sign in to Admin Flare">
            <span>
                Sign in to<br>
                <strong>AdminFlare</strong>
            </span>
        </a>
        {{ Form::open(array("role" => "form")) }}
            <fieldset>
                <div class="fields">
                    <input type="text" name="username" placeholder="Username" id="id_username" tabindex="1">

                    <input type="password" name="password" placeholder="Password" id="id_password" tabindex="2">
                </div>
                <a href="#" title="" tabindex="3" class="forgot-password">Forgot?</a>

                <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign In</button>
            </fieldset>
        {{ Form::close() }}
        <div class="social">
            <p>...or sign in with</p>

            <a href="dashboard.html" title="" tabindex="5" class="twitter">
                <i class="icon-twitter"></i>
            </a>

            <a href="dashboard.html" title="" tabindex="6" class="facebook">
                <i class="icon-facebook"></i>
            </a>

            <a href="dashboard.html" title="" tabindex="7" class="google">
                <i class="icon-google-plus"></i>
            </a>
        </div>
    </section>

</body>
</html>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Revender.ME - Primeiro Acesso</title>
        <meta name="msapplication-TileColor" content="#5bc0de" />
        <meta name="msapplication-TileImage" content="theme/assets/img/metis-tile.png" />
        <!-- Bootstrap -->
        {{ HTML::style('theme/assets/lib/bootstrap/css/bootstrap.min.css'); }}
        <!-- Font Awesome -->
        {{ HTML::style('theme/assets/lib/font-awesome/css/font-awesome.min.css'); }}
        <!-- Metis core stylesheet -->
        {{ HTML::style('theme/assets/css/main.min.css'); }}
        {{ HTML::style('theme/assets/css/less/login/login.less'); }}
        {{ HTML::script('theme/assets/lib/less/less-1.7.3.min.js'); }}
        {{ HTML::style('theme/assets/lib/animate.css/animate.min.css'); }}
        <!-- PNotify -->
        {{ HTML::style("theme/assets/lib/pnotify/pnotify.custom.min.css") }}
    </head>
    <body class="login">
        <div class="form-signin form-signup">
            <div class="text-center">
                <img src="theme/assets/img/logo.png" alt="Revender.ME Logo">
                <!-- <h2>Revender.ME</h2> -->
            </div>
            <hr>
            <div class="tab-content">
                <div id="signup" class="tab-pane active">
                    {{ Form::open(array("role" => "form")) }}
                        <div class="row">
                            <div class="col-lg-6 col-md-offset-3">
                                {{ Form::text('username', Auth::user()->username, array("class" => "form-control top", "placeholder" => "Nome de usuário", "required")) }}
                                {{ Form::password('password', array("id" => "password", "class" => "form-control middle", "placeholder" => "Senha", "required")) }}
                                {{ Form::password('confirm_password', array("id" => "confirm_password", "class" => "form-control middle", "placeholder" => "Confirmar Senha", "required")) }}
                                {{ Form::text('cnpj', "", array("class" => "form-control bottom", "placeholder" => "11.111.111/0001-00", "data-mask" => "99.999.999/9999-99", "required")) }}
                            </div>
                        </div>
                        <hr>
                        <h4>Termos de contrato</h4>
                        <div class="form-control term">
                            {{ $term->term }}
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-8 col-md-offset-2">
                                <label>Aceitos os termos e condições do contrato acima {{ Form::checkbox('terms', $term->id, false, array("required")) }}</label>
                                <br>
                                <br>
                                {{ Form::submit('Enviar solicitação', array("class" => "btn btn-lg btn-success btn-block")) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <hr>
            <div class="text-center">
                <ul class="list-inline">
                    <p>{{ date('Y') }} &copy; Revender.ME</p>
                </ul>
            </div>
        </div>
        {{ HTML::script("theme/assets/lib/jquery/jquery.min.js") }}
        {{ HTML::script("theme/assets/lib/bootstrap/js/bootstrap.min.js") }}
        {{ HTML::script('theme/assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}
        {{ HTML::script("theme/assets/lib/pnotify/pnotify.custom.min.js") }}
        <script type="text/javascript">
            (function($) {
                $(document).ready(function() {
                    $('.list-inline li > a').click(function() {
                        var activeForm = $(this).attr('href') + ' > form';
                        //console.log(activeForm);
                        $(activeForm).addClass('animated fadeIn');
                        //set timer to 1 seconds, after that, unload the animate animation
                        setTimeout(function() {
                            $(activeForm).removeClass('animated fadeIn');
                        }, 1000);
                    });
                });
            })(jQuery);

            PNotify.prototype.options.styling = "fontawesome";

            document.getElementById("password").onchange = validatePassword;
            document.getElementById("confirm_password").onchange = validatePassword;

            function validatePassword(){
                var pass2=document.getElementById("confirm_password").value;
                var pass1=document.getElementById("password").value;
                if(pass1!=pass2) {
                    $(function(){
                        new PNotify({
                            title: 'Erro',
                            text: 'Senhas não são iguais',
                            type: 'error'
                        });
                    });

                    $('#confirm_password').focus();
                }
            }

            $('form').submit(function() {
                console.log($('#password').val() != "");
                if($('#password').val() != "") {
                    if($('#password').val() != $('#confirm_password').val()) {
                        return false;
                    }
                }
            });
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
    </body>
</html>