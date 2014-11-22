@extends('layout')

@section('title')
    Smart Bracelet | Produtos
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Minha conta</h3>
@stop

@section('content')
<div class="row-fluid">
    <h3 class="box-header">Produtos</h3>
    <div class="box">
            <div class="body">
                @if(Request::is('products/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "products")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('products.update', $data['product']->id))) }}
                @endif
                    <div class="control-group">
                        <label for="name" class="control-label span4">Produto</label>
                        <div class="controls span8">
                        {{ Form::text('name', (isset($data['product']) ? $data['product']->name : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="price" class="control-label span4">Preço R$</label>
                        <div class="controls span8">
                        {{ Form::text('price', (isset($data['product']) ? number_format($data['product']->price, 2) : ""), array("id" => "price", "class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="quantity" class="control-label span4">Quantidade</label>
                        <div class="controls span8">
                        {{ Form::number('quantity', (isset($data['product']) ? $data['product']->quantity : ""), array("class" => "form-control", "required")) }}
                        </div>
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group">
                        <label for="status" class="control-label span4">Status</label>
                        <div class="controls span8">
                        {{ Form::select('status',
                                array('1' => 'Ativado', '0' => 'Destivado')
                            );
                        }}
                        </div>
                    </div>
                    {{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
                    <a class="btn btn-danger" href="{{ URL::to('products') }}">Voltar</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    {{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/jQuery.glob.min.js'); }}
    {{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/globinfo/jQuery.glob.pt-BR.min.js'); }}
    {{ HTML::script('library/javascripts/jquery.GlobalMoneyInput/jquery.GlobalMoneyInput.js'); }}

    <script>
        $(function($){
            /* Init Global Plugin with Brazilian Portuguese configuration */
            var cfgCulture = 'pt-BR';
            $.preferCulture(cfgCulture);

            $('#price').maskMoney();
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
@stop