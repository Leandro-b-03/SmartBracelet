<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <title>Checkout</title>
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
    <body class="plan">
        <div class="form-plan">
            <div class="text-center">
                <h2>Planos</h2>
            </div>
            <hr>
            <div class="row form-group">
                <div class="col-xs-12">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                        <li class="active"><a href="#step-1">
                            <h4 class="list-group-item-heading">Passo 1</h4>
                            <p class="list-group-item-text">Forma de pagamento</p>
                        </a></li>
                        <li class="disabled"><a href="#step-2">
                            <h4 class="list-group-item-heading">Passo 2</h4>
                            <p class="list-group-item-text">Confirmar pedido</p>
                        </a></li>
                    </ul>
                </div>
            </div>
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12 well text-center">
                        <h2>Passo 1: Forma de pagamento</h2>
                        @foreach ($data['payments'] as $payment)
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon beautiful">
                                    {{ Form::radio('payment_type', $payment->type) }}
                                </span>
                                <label for="payment_type" class="form-control small">{{ $payment->type ? 'Bcash' : 'PagSeguro' }}</label>
                            </div>
                        </div>
                        <br>
                        @endforeach
                        <button id="activate-step-2" class="btn btn-primary btn-lg btn-rect">Ir para o Passo 2</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-xs-12">
                    <div class="col-md-12 well">
                        <h2 class="text-center">Passo 2: Confirmar pedido</h2>
                        <div class="row">
                            <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <address>
                                            <strong>{{ $data['store']->store_name }}</strong>
                                            <br>
                                            {{ $data['store']->address }}
                                            <!-- <br>
                                            Los Angeles, CA 90026 -->
                                            <br>
                                            <abbr title="Phone">Telefone:</abbr> {{ $data['store']->telephone }}
                                            <br>
                                            <abbr title="Phone">Celular:</abbr> {{ $data['store']->mobile }}
                                        </address>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                        <p>
                                            <em>Data: {{ strftime('%A, %d de %B de %Y', strtotime('today')); }}</em>
                                        </p>
                                        <p>
                                            <em>Receipt #: 34522677W</em>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="text-center">
                                        <h1>Receipt</h1>
                                    </div> -->
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Plano</th>
                                                <th>#</th>
                                                <th class="text-center">Preço</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-md-9"><em>{{ $data['plan']->name }}</em></h4></td>
                                                <td class="col-md-1" style="text-align: center"> 1 </td>
                                                <td class="col-md-1 text-center">R$ {{ $data['plan']->price }}</td>
                                                <td class="col-md-1 text-center">R$ {{ $data['plan']->price }}</td>
                                            </tr>
                                            <tr>
                                                <td>   </td>
                                                <td>   </td>
                                                <td class="text-right">
                                                <p>
                                                    <strong>R$ {{ $data['plan']->price }} </strong>
                                                </p></td>
                                                <td class="text-center">
                                                <p>
                                                    <strong>R$ {{ $data['plan']->price }}</strong>
                                                </p></td>
                                            </tr>
                                            <tr>
                                                <td>   </td>
                                                <td>   </td>
                                                <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                                <td class="text-center text-danger"><h4><strong>R$ {{ $data['plan']->price }}</strong></h4></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="" class="btn btn-success btn-lg btn-block btn-rect btn-pay">
                                        Realizar Pagamento   <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ HTML::script("theme/assets/lib/jquery/jquery.min.js") }}
        {{ HTML::script("theme/assets/lib/bootstrap/js/bootstrap.min.js") }}
        {{ HTML::script("theme/assets/lib/pnotify/pnotify.custom.min.js") }}
        {{ HTML::script('theme/assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js'); }}
        <script type="text/javascript">
            (function($) {
                $(document).ready(function() {
    
                var navListItems = $('ul.setup-panel li a'),
                    allWells = $('.setup-content');

                    allWells.hide();

                    navListItems.click(function(e)
                    {
                        e.preventDefault();
                        var $target = $($(this).attr('href')),
                            $item = $(this).closest('li');
                        
                        if (!$item.hasClass('disabled')) {
                            navListItems.closest('li').removeClass('active');
                            $item.addClass('active');
                            allWells.hide();
                            $target.show();
                        }
                    });
                    
                    $('ul.setup-panel li.active a').trigger('click');

                    $('#activate-step-2').on('click', function(e) {
                        $('ul.setup-panel li:eq(1)').removeClass('disabled');
                        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
                        $(this).remove();
                    });

                    $('.input-group-addon').click(function() {
                        radio = $(this).find('input');
                        radio.prop( "checked", true );

                        if(radio.val() == 0) {
                            $('.btn-pay').attr('href', "{{ URL::to('pay/' . $data['plan']->id . '/' . $data['store']->id . '/0') }}");
                        } else {
                            $('.btn-pay').attr('href', "{{ URL::to('pay/' . $data['plan']->id . '/' . $data['store']->id . '/1') }}");
                        }
                    });

                    $('.small').click(function() {
                        radio = $(this).parent().find('input');
                        radio.prop( "checked", true );

                        if(radio.val() == 0) {
                            $('.btn-pay').attr('href', "{{ URL::to('pay/' . $data['plan']->id . '/' . $data['store']->id . '/0') }}");
                        } else {
                            $('.btn-pay').attr('href', "{{ URL::to('pay/' . $data['plan']->id . '/' . $data['store']->id . '/1') }}");
                        }
                    });

                    if($('payment_type').val() == 0) {
                        $('.btn-pay').attr('href', "{{ URL::to('pay/' . $data['plan']->id . '/' . $data['store']->id . '/0') }}");
                    } else {
                        $('.btn-pay').attr('href', "{{ URL::to('pay/' . $data['plan']->id . '/' . $data['store']->id . '/1') }}");
                    }
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