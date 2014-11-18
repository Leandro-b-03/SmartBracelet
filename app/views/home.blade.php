@extends('layout')

@section('title')
	Smart Bracelet | Dashboard
@stop

@section('name')
<h3><i class="fa fa-dashboard"></i>&nbsp; Dashboard</h3>
@stop

@section('content')
        <!-- Bracelets statistics
            ================================================== -->
        <section class="row-fluid">
            <div class="well widget-pie-charts span6">
                <h3 class="box-header">
                    Total de braceletes
                </h3>
                <div class="box no-border non-collapsible">
                    <div class="span4 pie-chart">
                        <div id="easy-pie-chart-1" data-percent="58">
                            58%
                        </div>
                        <div class="caption">
                            Braceletes em uso
                        </div>
                    </div>
                    
                    <div class="span4 pie-chart">
                        <div id="easy-pie-chart-2" data-percent="42">
                            42%
                        </div>
                        <div class="caption">
                            Braceletes disponiveis
                        </div>
                    </div>

                    <div class="span4 pie-chart">
                        <div id="easy-pie-chart-3" data-percent="91">
                            91%
                        </div>
                        <div class="caption">
                            Total de Braceletes usados
                        </div>
                    </div>
                </div>
            </div>
            <div class="well widget-pie-charts span6">
                <h3 class="box-header">
                    Total lucro
                </h3>
                <div class="box no-border non-collapsible">
                    <div class="span4 pie-chart">
                        <div id="easy-pie-chart-4" data-percent="82">
                            752MB
                        </div>
                        <div class="caption">
                            Used RAM
                        </div>
                    </div>

                    <div class="span4 pie-chart">
                        <div id="easy-pie-chart-5" data-percent="35">
                            35%
                        </div>
                        <div class="caption">
                            Processor Load
                        </div>
                    </div>

                    <div class="span4 pie-chart">
                        <div id="easy-pie-chart-6" data-percent="77">
                            1.5TB
                        </div>
                        <div class="caption">
                            Bandwidth
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / Server statistics -->
@stop

@section('scripts')
@stop