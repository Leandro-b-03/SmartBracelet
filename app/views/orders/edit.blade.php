@extends('layout')

@section('title')
    Smart Bracelet | Pedidos
@stop

@section('name')
<h3><i class="fa fa-user"></i>&nbsp; Minha conta</h3>
@stop

@section('content')
<div class="row-fluid">
    <h3 class="box-header">Pedidos</h3>
    <div class="box">
            <div class="body">
                @if(Request::is('orders/create'))
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", "url" => "orders")) }}
                @else
                {{ Form::open(array("role" => "form", "class" => "form-horizontal", 'method' => 'PUT', "route" => array('orders.update', $data['order']->id))) }}
                @endif
                    <div>
                        <ul id="tabs" class="nav nav-tabs">
                            <li class="active"><a href="#general" data-toggle="tab">Geral</a></li>
                            <li><a href="#product" data-toggle="tab">Produtos</a></li>
                        </ul>
                    </div>
                    <div id="general" class="tab-pane active">
                        <div class="control-group">
                            <label for="order_number" class="control-label span4">Número do pedido</label>
                            <div class="controls span8">
                            {{ Form::text('order_number', (isset($data['order']) ? $data['order']->order_number : ""), array("class" => "form-control", "required")) }}
                            </div>
                        </div>
                        <!-- /.control-group -->
                        <div class="control-group">
                            <label for="status" class="control-label span4">Funcionario/Usuário</label>
                            <div class="controls span8">
                            {{ Form::select('id_user', $data['users'], (isset($data['order']) ? $data['order']->user->id : "")); }}
                            </div>
                        </div>
                        <!-- /.control-group -->
                        <div class="control-group">
                            <label for="status" class="control-label span4">Cliente</label>
                            <div class="controls span8">
                            {{ Form::select('id_customer', $data['customers'], (isset($data['order']) ? $data['order']->customer->id : "")); }}
                            </div>
                        </div>
                        <!-- /.control-group -->
                        <div class="control-group">
                            <label for="status" class="control-label span4">Comanda</label>
                            <div class="controls span8">
                            {{ Form::select('id_bracelet', $data['bracelets'], (isset($data['bracelet_id']) ? $data['bracelet_id'] : "")); }}
                            </div>
                        </div>
                        <!-- /.control-group -->
                        <div class="control-group">
                            <label for="amount" class="control-label span4">Valor</label>
                            <div class="controls span8">
                            {{ Form::text('amount', (isset($data['order']) ? "R$ " . number_format ($data['order']->amount, 2) : ""), array("class" => "form-control price", "id" => "price", "disabled")) }}
                            {{ Form::hidden('amount', (isset($data['order']) ? $data['order']->amount : ""), array("id" => "pricea")) }}
                            </div>
                        </div>
                        <!-- /.control-group -->
                        <div class="control-group">
                            <label for="discount" class="control-label span4">Desconto</label>
                            <div class="controls span8">
                            {{ Form::text('discount', (isset($data['order']) ? $data['order']->discount : ""), array("class" => "form-control price")) }}
                            </div>
                        </div>
                        <!-- /.control-group -->
                        <div class="control-group">
                            <label for="status" class="control-label span4">Status</label>
                            <div class="controls span8">
                            {{ Form::select('status',
                                    array('1' => 'Ativado', '0' => 'Destivado'), (isset($data['product']) ? $data['product']->status : "")
                                );
                            }}
                            </div>
                        </div>
                    </div>
                    <div id="product" class="tab-pane">
                        <div class="control-group">
                            <label for="order_number" class="control-label span4">Número do pedido</label>
                            <div class="controls span8">
                                <input id="autocomplete" type="text" class="form-control" value="" /> <a id="add-product" class="btn btn-green">Adicionar</a>
                            </div>
                            <hr />
                            <table id="products-table" class="table table-bordered">
                                <thead>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Valor</th>
                                    <th>Ação</th>
                                </thead>
                                @if ($data['order_bracelets']->count() > 0)
                                <tbody>
                                    @foreach ($data['order_bracelets'] as $order_bracelet)
                                    <tr>
                                        <td><input type="hidden" id="product-{{ $order_bracelet->id_product }}" /> {{ $order_bracelet->product->name }}</td>
                                        <td><input name="products[{{ $order_bracelet->id_product }}][quantity][]" type="number" class="form-control qtd-plus" value="{{ $order_bracelet->quantity }}" /></td>
                                        <td>R$ {{ number_format ($order_bracelet->price, 2) }}<input class="price" name="products[{{ $order_bracelet->id_product }}][price][]" type="hidden" value="{{ $order_bracelet->price }}" /></td>
                                        <td><a class="btn btn-danger delete">Deletar</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                    {{ Form::submit('Salvar', array("class" => "btn btn-primary")) }}
                    <a class="btn btn-danger" href="{{ URL::to('orders') }}">Voltar</a>
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
    {{ HTML::script('library/javascripts/jQuery-Autocomplete/dist/jquery.autocomplete.js'); }}

    <script>
        $(function($){
            var table = $('#products-table').DataTable({
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

            /* Init Global Plugin with Brazilian Portuguese configuration */
            var cfgCulture = 'pt-BR';
            $.preferCulture(cfgCulture);

            $('.price').maskMoney();

            $('#tabs a:first').tab('show')

            $('#tabs a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });

            var product = null;

            $('#autocomplete').autocomplete({
                serviceUrl: '/autocomplete/products',
                onSelect: function (suggestion) {
                    product = suggestion.data;
                }
            });

            $('#add-product').on('click', function() {
                if(product != null) {
                    addProduct();
                } else {
                    if ($('#autocomplete').val() != '') {
                        $.ajax({
                            type: "GET",
                            url: '/autocomplete/products',
                            data: "query=" + $('#autocomplete').val(),
                            dataType: "json",
                            success: function(suggestion) {
                                console.log(suggestion.suggestions);
                                console.log(suggestion.suggestions.length);
                                if(suggestion.suggestions.length == 1) {
                                    product = suggestion.suggestions[0].data;
                                    addProduct();
                                } else {
                                    new PNotify({
                                        title: 'Erro',
                                        text: 'Produto não encontrado.',
                                        type: 'error'
                                    });
                                }
                            },
                        });
                    } else {
                        new PNotify({
                            title: 'Erro',
                            text: 'Digite o nome de um produto.',
                            type: 'error'
                        });
                    }
                }
            });

            function addProduct() {
                var has_product = $("#product-" + product.id);

                if(has_product.length == 0){
                    table.row.add([
                        '<input type="hidden" id="product-' + product.id + '" /> ' + product.name,
                        '<input name="products[' + product.id + '][quantity][]" type="number" class="form-control qtd-plus" value="1" />',
                        'R$ ' + parseFloat(product.price).toFixed(2) + '<input class="price" name="products[' + product.id + '][price][]" type="hidden" value="' + product.price + '" />',
                        '<a class="btn btn-danger delete">Deletar</a>'
                    ]).draw();
                } else {
                    var val = has_product.parents('tr').find('input.qtd-plus').val();
                    has_product.parents('tr').find('input.qtd-plus').val(parseInt(val) + 1);
                }

                $('#autocomplete').val('');
                product = null;
                sumPrices();
            }

            $('#products-table').on('change', 'input.qtd-plus', function() {
                sumPrices();
            });

            function sumPrices() {
                var total = 0;
                $('#products-table').find('input.qtd-plus').each(function() {
                    var val = parseInt($(this).val());
                    var price = parseFloat($(this).parents('tr').find('.price').val());
                    var total_inside = parseFloat(val * price);

                    total = parseFloat(total) + total_inside;
                });

                $('#price').val('R$ ' + total.toFixed(2));
                $('#pricea').val(total.toFixed(2));
            }

            $('#products-table').on('click', 'a', function(e) {
                $(this).parents('tr').addClass('selected');

                table.row('.selected').remove().draw( false );
                e.preventDefault();
            });
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