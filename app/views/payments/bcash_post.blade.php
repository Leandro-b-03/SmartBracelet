<body onload="document.getElementsByTagName('form')[0].submit()">
<!-- <body> -->
{{ Form::open(array('name' => 'pay_bcash', 'id' => 'pay_bcash', 'url' => $url, 'method' => 'put')) }}

  @foreach ($bcommon as $key => $value)
    {{Form::hidden($key, $value)}}
  @endforeach

  @foreach ($products as $key => $value)
    {{Form::hidden($key, $value)}}
  @endforeach


{{ Form::close() }}


</body>