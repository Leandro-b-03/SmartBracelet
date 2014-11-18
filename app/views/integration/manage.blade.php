<html>
	<head>
		<script>
			window.onload = function() {
				document.forms[0].submit();
			}
		</script>
	</head>
	<body>
		{{ Form::open(array('url' => 'https://l.editar.me/admin/index.php?route=structure/appearance&token=699caf3b311dec35cefccc3a604f11ee')) }}
		    {{ Form::hidden('username', 'admin') }}
		    {{ Form::hidden('password', '2wdc  vbn mko0**-+.') }}
		    {{ Form::hidden('token', 'a4cdae441c48ec166b14db50450a8b1e') }}
		    {{ Form::hidden('redirect', 'https://l.editar.me/admin/index.php?route=structure/appearance') }}
		{{ Form::close() }}
	</body>
</html>