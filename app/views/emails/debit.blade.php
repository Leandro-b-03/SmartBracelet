<!DOCTYPE html>
<html lang="pt_BR">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>A loja <?php echo $store_name;?> está em débito</h2>

		<div>
			<p>Esta loja não cumpriu os requisitos para a permanência sem débito a ser gerado.</p>
			<br>
			<p>Para pagar acesse: <a href="<?php echo URL::to('payment/' . $store_id . '/pay'); ?>">Pagamentos</a></p>
		</div>
	</body>
</html>
