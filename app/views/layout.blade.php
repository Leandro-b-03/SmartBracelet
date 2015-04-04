<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        @section('title')
        @show
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    {{ HTML::script('library/javascripts/1.3.0/adminflare-demo-init.min.js'); }}

    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700'); }}
    {{ HTML::style('library/css/1.3.0/black-blue/bootstrap.min.css'); }}
    {{ HTML::style('library/css/1.3.0/black-blue/adminflare.min.css'); }}
    {{ HTML::style("library/css/font-awesome/css/font-awesome.min.css") }}
    {{ HTML::style("library/css/pnotify.custom.min.css") }}
    {{ HTML::style("library/css/jquery.dataTables.min.css") }}
    {{ HTML::style("library/css/jdataTables.bootstrap.css") }}
    {{ HTML::style("library/css/custom.css") }}

    {{ HTML::script('library/javascripts/1.3.0/modernizr-jquery.min.js'); }}
    {{ HTML::script('library/javascripts/1.3.0/bootstrap.min.js'); }}
    {{ HTML::script('library/javascripts/1.3.0/adminflare.min.js'); }}

    <style type="text/css">
        /* ======================================================================= */
        /* Server Statistics */
        .well.widget-pie-charts .box {
            margin-bottom: -20px;
        }

        /* ======================================================================= */
        /* Why AdminFlare */
        #why-adminflare ul {
            position: relative;
            padding: 0 10px;
            margin: 0 -10px;
        }

        #why-adminflare ul:nth-child(2n) {
            background: rgba(0, 0, 0, 0.02);
        }

        #why-adminflare li {
            padding: 8px 10px;
            list-style: none;
            font-size: 14px;
            padding-left: 23px;
        }

        #why-adminflare li i {
            color: #666;
            font-size: 14px;
            margin: 3px 0 0 -23px;
            position: absolute;
        }


        /* ======================================================================= */
        /* Supported Browsers */
        #supported-browsers header { color: #666; display: block; font-size: 14px; }

        #supported-browsers header strong { font-size: 18px; }

        #supported-browsers .span10 { margin-bottom: -15px; text-align: center; }

        #supported-browsers .span10 div {
            margin-bottom: 15px;
            margin-right: 15px;
            display: inline-block;
            width: 120px;
        }

        #supported-browsers .span10 div:last-child { margin-right: 0; }

        #supported-browsers .span10 img { height: 40px; width: 40px; }

        #supported-browsers .span10 span { line-height: 40px; font-size: 14px; font-weight: 600; }

        @media (max-width: 767px) {
            #supported-browsers header { text-align: center; margin-bottom: 20px; }
        }

        /* ======================================================================= */
        /* Status panel */
        .status-example { line-height: 0; position:relative; top: 22px }
    </style>
    @section('style')
    @show

    <script type="text/javascript">
        $(document).ready(function () {
            $('a[rel=tooltip]').tooltip();

            // Easy Pie Charts
            var easyPieChartDefaults = {
                animate: 2000,
                scaleColor: false,
                lineWidth: 12,
                lineCap: 'square',
                size: 100,
                trackColor: '#e5e5e5'
            }
            $('#easy-pie-chart-1').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: '#3da0ea'
            }));
            $('#easy-pie-chart-2').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: '#e7912a'
            }));
            $('#easy-pie-chart-3').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: '#bacf0b'
            }));
            $('#easy-pie-chart-4').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: '#4ec9ce'
            }));
            $('#easy-pie-chart-5').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: '#ec7337'
            }));
            $('#easy-pie-chart-6').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: '#f377ab'
            }));
            // Visits Chart
            var visitsChartData = [{
                // Visits
                label: 'Visits',
                data: [
                    [6, 1300],
                    [7, 1600],
                    [8, 1900],
                    [9, 2100],
                    [10, 2500],
                    [11, 2200],
                    [12, 2000],
                    [13, 1950],
                    [14, 1900],
                    [15, 2000]
                ]
            }, {
                // Returning Visits
                label: 'Returning Visits',
                data: [
                    [6, 500],
                    [7, 600],
                    [8, 550],
                    [9, 600],
                    [10, 800],
                    [11, 900],
                    [12, 800],
                    [13, 850],
                    [14, 830],
                    [15, 1000]
                ],
                filledPoints: true
            }];
            $('#visits-chart').simplePlot(visitsChartData, {
                series: {
                    points: {
                        show: true,
                        radius: 5
                    },
                    lines: {
                        show: true
                    }
                },
                xaxis: {
                    tickDecimals: 2
                },
                yaxis: {
                    tickSize: 1000
                }
            }, {
                height: 205,
                tooltipText: "y + ' visitors at ' + x + '.00h'"
            });
            // Comments Tab
            $('.comment-remove').click(function () {
                bootbox.confirm("Are you sure?", function (result) {
                    alert("Confirm result: " + result);
                });
                return false;
            });
            // New Users Tab
            $('#tab-users a').tooltip();
        });
    </script>
</head>
<body>
<script type="text/javascript">demoSetBodyLayout();</script>
    <!-- Main navigation bar
        ================================================== -->
    <header class="navbar navbar-fixed-top" id="main-navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="logo" href="#"><img alt="Smart Bracelet" src="library/images/sb-logo.png"></a>

                <a class="btn nav-button collapsed" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-reorder"></span>
                </a>

                <div class="nav-collapse collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle usermenu" data-toggle="dropdown">
                                <img alt="Avatar" src="{{ URL::to('/') . '/' . Auth::user()->photo }}">
                                <span>&nbsp;&nbsp;{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{  URL::to('users/' . Auth::user()->id . '/edit') }}">Perfil</a>
                                </li>
                                <!-- <li>
                                    <a href="#">Configuração</a>
                                </li> -->
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ URL::to('logout') }}">Sair</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- / Main navigation bar -->

    <!-- Left navigation panel
        ================================================== -->
    <nav id="left-panel">
        <div id="left-panel-content">
            <ul>
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{ URL::to('/') }}"><span class="fa fa-dashboard"></span>Dashboard</a>
                </li>
                <li class="lp-dropdown {{ Request::is('users') || Request::is('customers') ? 'active' : '' }}">
                    <a href="#" class="lp-dropdown-toggle" id="manager-dropdown"><span class="fa fa-users"></span>Gerenciar</a>
                    <ul class="lp-dropdown-menu simple" data-dropdown-owner="manager-dropdown">
                        <li>
                            <a tabindex="-1" href="{{ URL::to('users') }}"><i class="fa fa-user"></i>&nbsp;&nbsp;Usuários</a>
                        </li>
                        <li>
                            <a tabindex="-1" href="{{ URL::to('customers') }}"><i class="icon-check"></i>&nbsp;&nbsp;Clientes</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('products') ? 'active' : '' }}">
                    <a href="{{ URL::to('products') }}"><span class="fa fa-tags"></span>Produtos</a>
                </li>
                <li class="{{ Request::is('commands') ? 'active' : '' }}">
                    <a href="{{ URL::to('commands') }}"><span class="fa fa-circle-o-notch"></span>Comandas</a>
                </li>
                <!-- pagina de edição dos pedidos -->
               <!--  <li class="{{ Request::is('orders') ? 'active' : '' }}">
                    <a href="{{ URL::to('orders') }}"><span class="fa fa-edit"></span>Pedidos</a>
                </li> -->
                <li class="{{ Request::is('verify_command') ? 'active' : '' }}">
                    <a href="{{ URL::to('verify_command') }}"><span class="fa fa-edit"></span>Pedidos</a>
                </li>
            </ul>
        </div>
        <div class="icon-caret-down"></div>
        <div class="icon-caret-up"></div>
    </nav>
    <!-- / Left navigation panel -->

    <!-- Page content
        ================================================== -->
    <section class="container">
        @yield('content')
        <!-- Page footer
            ================================================== -->
        <footer id="main-footer">
            Copyright © {{ date('Y') }} <a href="#">Smart Bracelet</a>, todos os direitos reservados.
            <a href="#" class="pull-right" id="on-top-link">
                Para cima&nbsp;<i class=" icon-chevron-up"></i>
            </a>
        </footer>
        <!-- / Page footer -->
        {{ HTML::script("library/javascripts/pnotify.custom.min.js") }}
        {{ HTML::script("library/javascripts/jquery.dataTables.min.js") }}
        @section('scripts')
        @show 

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('.datagrid').DataTable({
                    language: {
                        processing:     "Carregando...",
                        search:         "Pesquisar&nbsp;:",
                        lengthMenu:     "Exibir _MENU_ registros",
                        info:           "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                        infoEmpty:      "Exibindo de 0 a 0 de 0 registros",
                        infoFiltered:   "(filtrado de _MAX_ registros no total)",
                        infoPostFix:    "",
                        loadingRecords: "Carregando...",
                        zeroRecords:    "Não foram encontrados resultados",
                        emptyTable:     "Não há dados disponíveis na tabela",
                        paginate: {
                            first:      "«« Primeiro",
                            previous:   "« Anterior",
                            next:       "Seguinte »",
                            last:       "Último »»"
                        }
                    }
                });
            });
        </script>
    </section>
</body>
</html>