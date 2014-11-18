<html>
	<head>
		<script>
			window.onload = function() {
				document.forms[0].submit();
			}
		</script>
	</head>
	<body>
		{{ Form::open(array('url' => 'http://' . (app()->environment() == 'desenv' ? 'l.' : '') . 'editar.me' . (app()->environment() != 'production' ? ':85' : '') . '/admin/' . $store['name'] . '/' . $store['id'])) }}
		    {{ Form::hidden('username', 'admin') }}
		    {{ Form::hidden('password', '2wdc  vbn mko0**-+.') }}
		    {{ Form::hidden('back', 'http://revender.me/store') }}
		{{ Form::close() }}
	</body>
</html>