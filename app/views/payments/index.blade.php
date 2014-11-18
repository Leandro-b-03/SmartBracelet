@extends('layout')

@section('title')
Revender.ME | Pagamentos
@stop

@section('name')
<h3><i class="fa fa-credit-card"></i>&nbsp; Pagamentos</h3>
@stop

@section('style')
  {{ HTML::style('theme/assets/lib/daterangepicker/daterangepicker-bs3.css'); }}
@stop

@section('scripts')
  {{ HTML::script('theme/assets/lib/moment/moment.min.js'); }}
  {{ HTML::script('theme/assets/lib/daterangepicker/daterangepicker.js'); }}

  <!-- requireJS -->
  {{ HTML::script('js/bower_components/requirejs/require.js', array('data-main' => '/js/main')); }}

@stop

@section('content')
<div id="payment_page">
  <div class="row">
    <div class="col-lg-12">
      <div class="box dark">
        <header>
          <div class="icons">
            <i class="fa fa-credit-card"></i>
          </div>
          <h5>À Pagar</h5>
          <!-- .toolbar -->
          <div class="toolbar">
            <nav style="padding: 8px;">
              <!-- <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                <i class="fa fa-minus"></i>
              </a>
              <a href="javascript:;" class="btn btn-default btn-xs full-box">
                <i class="fa fa-expand"></i>
              </a>
              <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                <i class="fa fa-times"></i>
              </a> -->
            </nav>
          </div>
          <!-- /.toolbar -->
        </header>
        <div class="body">

          @if (count($balances) > 0)
          {{ Form::open(array('name' => 'form_batch', 'id' => 'form_batch', 'url' => '/payments/batch', 'method' => 'post')) }}
          <table class="table table-striped responsive-table">
              <div class='pull-right'>
                <a id="pay_in_lot" class="btn btn-primary disabled">Pagamento em Lote </a>
              </div>
            <thead>
              <tr>
                <th><input type="checkbox" class="js_select_all" /></th>
                <th>Loja</th>
                <th>Valor</th>
                <th>Data de vencimento</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($balances as $balance)
                <tr>
                  @if( $balance['cod_status'] < 1 )
                  <td><input type="checkbox" name='payment[]' value="{{$balance['balance_id']}}" class="checkToPay" data-id="{{$balance['balance_id']}}" /> </td>
                  @else
                  <td></td>
                  @endif
                  <td><a href="{{ URL::to('store/' . $balance['store_id'] . '/edit') }}">{{ $balance['store_name'] }}</a></td>
                  <td style="color:red;font-weight:bold">{{ number_format($balance['balance'], 2, ',' , '.') }}</td>
                  <td>{{ date('d/m/Y', strtotime($balance['due_date'])) }}</td>
                  <td>
                    {{ $balance['status'] }}
                  </td>
                  @if( $balance['cod_status'] < 1 )
                  <td><a data-id="{{$balance['balance_id']}}" class="btn btn-danger js_pay_item">Pagar</a></td>
                  @else
                  <td></td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ Form::close() }}
          @else
            <h5>Você não possui nenhuma pendência</h5>
          @endif
          <!-- Large modal -->

          <div class="modal fade" id="bcash_modal" tabindex="-1" role="dialog">
            
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="overlaya"></div>
                <div class="windows8">
                  <div class="wBall" id="wBall_1">
                    <div class="wInnerBall">
                    </div>
                  </div>
                  <div class="wBall" id="wBall_2">
                    <div class="wInnerBall">
                    </div>
                  </div>
                  <div class="wBall" id="wBall_3">
                    <div class="wInnerBall">
                    </div>
                  </div>
                  <div class="wBall" id="wBall_4">
                    <div class="wInnerBall">
                    </div>
                  </div>
                  <div class="wBall" id="wBall_5">
                    <div class="wInnerBall">
                    </div>
                  </div>
                </div>
                <div class="content-raw"></div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!--END TEXT INPUT FIELD-->
  </div>
  <div class="row" id="history">
    <div class="col-lg-12">
      <div class="box dark">
        <header>
          <div class="icons">
            <i class="fa fa-history"></i>
          </div>
          <h5>Histórico de pagamentos</h5>
          <!-- .toolbar -->
          <div class="toolbar">
            <nav style="padding: 8px;">
            </nav>
          </div>
          <!-- /.toolbar -->
        </header>
        <div class="body">
          @if(count($paid) > 0)
            <div class="form-horizontal">
              <div class="form-group">
                <label for="reservation" class="control-label col-lg-2">Datas de Pagamento</label>
                <div class="col-lg-4">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                    <input type="text" class="form-control" id="pagto_range" name="reservation">
                  </div>
                </div>
              </div>
            </div>
            @include('payments.history')
          @else
            <h5>Nenhum histórico de pagamento</h5>
          @endif
        </div>
      </div>
    <!--END TEXT INPUT FIELD-->
  </div>
</div>
</div>

<style type="text/css">
.overlaya{
  position: absolute;
  width: 100%;
  height: 100%;
  z-index: 10;
  background-color: rgba(0,0,0,0.5); /*dim the background*/
}
.windows8 {


  position: absolute;
  width: 90px;
  height:90px;
  left:50%;
  top:50%;
}

.windows8 .wBall {
  position: absolute;
  width: 86px;
  height: 86px;
  margin-left: ;
  opacity: 0;
  -moz-transform: rotate(225deg);
  -moz-animation: orbit 7.15s infinite;
  -webkit-transform: rotate(225deg);
  -webkit-animation: orbit 7.15s infinite;
  -ms-transform: rotate(225deg);
  -ms-animation: orbit 7.15s infinite;
  -o-transform: rotate(225deg);
  -o-animation: orbit 7.15s infinite;
  transform: rotate(225deg);
  animation: orbit 7.15s infinite;
}

.windows8 .wBall .wInnerBall{
  position: absolute;
  width: 11px;
  height: 11px;
  background: #000000;
  left:0px;
  top:0px;
  -moz-border-radius: 11px;
  -webkit-border-radius: 11px;
  -ms-border-radius: 11px;
  -o-border-radius: 11px;
  border-radius: 11px;
}

.windows8 #wBall_1 {
  -moz-animation-delay: 1.56s;
  -webkit-animation-delay: 1.56s;
  -ms-animation-delay: 1.56s;
  -o-animation-delay: 1.56s;
  animation-delay: 1.56s;
}

.windows8 #wBall_2 {
  -moz-animation-delay: 0.31s;
  -webkit-animation-delay: 0.31s;
  -ms-animation-delay: 0.31s;
  -o-animation-delay: 0.31s;
  animation-delay: 0.31s;
}

.windows8 #wBall_3 {
  -moz-animation-delay: 0.62s;
  -webkit-animation-delay: 0.62s;
  -ms-animation-delay: 0.62s;
  -o-animation-delay: 0.62s;
  animation-delay: 0.62s;
}

.windows8 #wBall_4 {
  -moz-animation-delay: 0.94s;
  -webkit-animation-delay: 0.94s;
  -ms-animation-delay: 0.94s;
  -o-animation-delay: 0.94s;
  animation-delay: 0.94s;
}

.windows8 #wBall_5 {
  -moz-animation-delay: 1.25s;
  -webkit-animation-delay: 1.25s;
  -ms-animation-delay: 1.25s;
  -o-animation-delay: 1.25s;
  animation-delay: 1.25s;
}

@-moz-keyframes orbit {
  0% {
    opacity: 1;
    z-index:99;
    -moz-transform: rotate(180deg);
    -moz-animation-timing-function: ease-out;
  }

  7% {
    opacity: 1;
    -moz-transform: rotate(300deg);
    -moz-animation-timing-function: linear;
    -moz-origin:0%;
  }

  30% {
    opacity: 1;
    -moz-transform:rotate(410deg);
    -moz-animation-timing-function: ease-in-out;
    -moz-origin:7%;
  }

  39% {
    opacity: 1;
    -moz-transform: rotate(645deg);
    -moz-animation-timing-function: linear;
    -moz-origin:30%;
  }

  70% {
    opacity: 1;
    -moz-transform: rotate(770deg);
    -moz-animation-timing-function: ease-out;
    -moz-origin:39%;
  }

  75% {
    opacity: 1;
    -moz-transform: rotate(900deg);
    -moz-animation-timing-function: ease-out;
    -moz-origin:70%;
  }

  76% {
    opacity: 0;
    -moz-transform:rotate(900deg);
  }

  100% {
    opacity: 0;
    -moz-transform: rotate(900deg);
  }

}

@-webkit-keyframes orbit {
  0% {
    opacity: 1;
    z-index:99;
    -webkit-transform: rotate(180deg);
    -webkit-animation-timing-function: ease-out;
  }

  7% {
    opacity: 1;
    -webkit-transform: rotate(300deg);
    -webkit-animation-timing-function: linear;
    -webkit-origin:0%;
  }

  30% {
    opacity: 1;
    -webkit-transform:rotate(410deg);
    -webkit-animation-timing-function: ease-in-out;
    -webkit-origin:7%;
  }

  39% {
    opacity: 1;
    -webkit-transform: rotate(645deg);
    -webkit-animation-timing-function: linear;
    -webkit-origin:30%;
  }

  70% {
    opacity: 1;
    -webkit-transform: rotate(770deg);
    -webkit-animation-timing-function: ease-out;
    -webkit-origin:39%;
  }

  75% {
    opacity: 1;
    -webkit-transform: rotate(900deg);
    -webkit-animation-timing-function: ease-out;
    -webkit-origin:70%;
  }

  76% {
    opacity: 0;
    -webkit-transform:rotate(900deg);
  }

  100% {
    opacity: 0;
    -webkit-transform: rotate(900deg);
  }

}

@-ms-keyframes orbit {
  0% {
    opacity: 1;
    z-index:99;
    -ms-transform: rotate(180deg);
    -ms-animation-timing-function: ease-out;
  }

  7% {
    opacity: 1;
    -ms-transform: rotate(300deg);
    -ms-animation-timing-function: linear;
    -ms-origin:0%;
  }

  30% {
    opacity: 1;
    -ms-transform:rotate(410deg);
    -ms-animation-timing-function: ease-in-out;
    -ms-origin:7%;
  }

  39% {
    opacity: 1;
    -ms-transform: rotate(645deg);
    -ms-animation-timing-function: linear;
    -ms-origin:30%;
  }

  70% {
    opacity: 1;
    -ms-transform: rotate(770deg);
    -ms-animation-timing-function: ease-out;
    -ms-origin:39%;
  }

  75% {
    opacity: 1;
    -ms-transform: rotate(900deg);
    -ms-animation-timing-function: ease-out;
    -ms-origin:70%;
  }

  76% {
    opacity: 0;
    -ms-transform:rotate(900deg);
  }

  100% {
    opacity: 0;
    -ms-transform: rotate(900deg);
  }

}

@-o-keyframes orbit {
  0% {
    opacity: 1;
    z-index:99;
    -o-transform: rotate(180deg);
    -o-animation-timing-function: ease-out;
  }

  7% {
    opacity: 1;
    -o-transform: rotate(300deg);
    -o-animation-timing-function: linear;
    -o-origin:0%;
  }

  30% {
    opacity: 1;
    -o-transform:rotate(410deg);
    -o-animation-timing-function: ease-in-out;
    -o-origin:7%;
  }

  39% {
    opacity: 1;
    -o-transform: rotate(645deg);
    -o-animation-timing-function: linear;
    -o-origin:30%;
  }

  70% {
    opacity: 1;
    -o-transform: rotate(770deg);
    -o-animation-timing-function: ease-out;
    -o-origin:39%;
  }

  75% {
    opacity: 1;
    -o-transform: rotate(900deg);
    -o-animation-timing-function: ease-out;
    -o-origin:70%;
  }

  76% {
    opacity: 0;
    -o-transform:rotate(900deg);
  }

  100% {
    opacity: 0;
    -o-transform: rotate(900deg);
  }

}

@keyframes orbit {
  0% {
    opacity: 1;
    z-index:99;
    transform: rotate(180deg);
    animation-timing-function: ease-out;
  }

  7% {
    opacity: 1;
    transform: rotate(300deg);
    animation-timing-function: linear;
    origin:0%;
  }

  30% {
    opacity: 1;
    transform:rotate(410deg);
    animation-timing-function: ease-in-out;
    origin:7%;
  }

  39% {
    opacity: 1;
    transform: rotate(645deg);
    animation-timing-function: linear;
    origin:30%;
  }

  70% {
    opacity: 1;
    transform: rotate(770deg);
    animation-timing-function: ease-out;
    origin:39%;
  }

  75% {
    opacity: 1;
    transform: rotate(900deg);
    animation-timing-function: ease-out;
    origin:70%;
  }

  76% {
    opacity: 0;
    transform:rotate(900deg);
  }

  100% {
    opacity: 0;
    transform: rotate(900deg);
  }

}

</style>
@stop

