<!DOCTYPE html>
<html lang="pt_BR">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Sua loja virtual foi criada com sucesso!</h2>
		<div>
			<p>Parabéns <?php echo $name; ?> você possui uma loja virtual totalmente gratuíta</p>
			<p>Acesse sua loja em: <a href="<?php echo $url;?>"><?php echo $url;?></a>
			<br>
			Para editar acesse o nosso portal <a href="<?php echo $reseller_url; ?>"><?php echo $reseller_url; ?></a> com os dados abaixo:
			<br><br>
			<strong>Usuário:</strong> <?php echo $user; ?>
			<br>
			<strong>Senha:</strong> <?php echo $password; ?>
			</p>
			<br>
			<p>Atensiosamente,
			<br>
			<br>Central de Relacionamento <?php echo $reseller_store_name; ?></p>
		</div>
	</body>
</html>