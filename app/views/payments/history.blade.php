@if(count($paid) > 0)
<table class="table table-striped responsive-table">
  <thead>
    <tr>
      <th>Loja</th>
      <th>Valor</th>
      <th>Data de Pagto</th>
      <th>Vencimento</th>
    </tr>
  </thead>
  <tbody>
    @foreach($paid as $balance)
    <tr>
      <td><a href="#">{{ $balance['store_name'] }}</a></td>
      <td style="">{{ number_format($balance['balance'], 2, ',' , '.') }}</td>
      <td>{{ date('d/m/Y', strtotime($balance['last_update'])) }}</td>
      <td>{{ date('d/m/Y', strtotime($balance['due_date'])) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@elseif(count($paid < 1) && $filtered)
<h5>Nenhum Histórico com o filtro selecionado!</h5>
@endif