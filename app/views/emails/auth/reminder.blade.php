<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Esqueceu a senha?</h2>

		<div>
			Para resetar sua senha, acesse o link abaixo:
            <br>
            {{ URL::to('password/reset', array($token)) }}
		</div>
	</body>
</html>
