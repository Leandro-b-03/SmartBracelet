<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <title>Upgrade</title>
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
        {{ HTML::style('theme/assets/css/no-media.css'); }}
    </head>
    <body class="plan hidden-overflow">
        <div class="form-plan">
            <div class="text-center">
                <!-- <img src="theme/assets/img/logo.png" alt="Revender.ME Logo"> -->
                <h2>Planos</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12 col-md-offset-{{ 6 - count($plans) }}">
                    <ul class="pricing-table dark" contenteditable>
                        @foreach ($plans as $plan)
                        @if(!isset($plan['store_id']))
                        <li class="col-lg-2">
                            <h3>{{ $plan->name }}</h3>
                            <div class="price-body">
                                <div class="price">
                                    <span class="price-figure"><sup>R$</sup>{{ str_replace('.', ',<small>', $plan->price) }}</small> </span>
                                    <span class="price-term">por mês</span>
                                </div>
                            </div>
                            <div class="features">
                                <ul>
                                    <li><strong>{{ $plan->product }}</strong> Produtos</li>
                                </ul>
                            </div>
                            <div class="footer">
                                <a href="{{ URL::to('checkout/' . $plan->id . '/' . $store_id) }}" class="btn btn-info btn-rect"><span class="fa fa-arrow-circle-up"></span> Upgrade</a>
                            </div>
                        </li>
                        @endif
                        @endforeach
                        <div class="clearfix"></div>
                    </ul>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
        </div>
        {{ HTML::script("theme/assets/lib/jquery/jquery.min.js") }}
        {{ HTML::script("theme/assets/lib/bootstrap/js/bootstrap.min.js") }}
        {{ HTML::script("theme/assets/lib/pnotify/pnotify.custom.min.js") }}
        {{ HTML::script('theme/assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}
        <script type="text/javascript">
            (function($) {
                $('li').hover(function(){
                    $(this).addClass('active danger');
                    $(this).find('a').addClass('btn-metis-1 btn-lg');
                }, function(){
                    $(this).removeClass('active danger');
                    $(this).find('a').removeClass('btn-metis-1 btn-lg');
                });

                $('a').click(function() {
                    window.location = $(this).attr('href');
                });
            })(jQuery);

            PNotify.prototype.options.styling = "fontawesome";
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