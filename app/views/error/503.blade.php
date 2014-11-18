<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>503</title>
		<meta name="msapplication-TileColor" content="#5bc0de" />
        <meta name="msapplication-TileImage" content="theme/assets/img/metis-tile.png" />
        <!-- Bootstrap -->
        {{ HTML::style('theme/assets/lib/bootstrap/css/bootstrap.min.css'); }}
        <!-- Font Awesome -->
        {{ HTML::style('theme/assets/lib/font-awesome/css/font-awesome.min.css'); }}
        <!-- Metis core stylesheet -->
        {{ HTML::style('theme/assets/css/main.min.css'); }}
	</head>
	<body class="error">
		<div class="container">
			<div class="col-lg-8 col-lg-offset-2 text-center">
				<div class="logo">
					<h1>503</h1>
				</div>
				<p class="lead text-muted">Oops, um erro ocorreu. Serviço indisponivel!</p>
				<div class="clearfix"></div>
				<!-- <div class="col-lg-6 col-lg-offset-3">
                    <form action="{{ URL::to('/') }}">
						<div class="input-group">
							<input type="text" placeholder="search ..." class="form-control">
							<span class="input-group-btn">
							<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
				</div> -->
				<div class="clearfix"></div>
				<br>
				<div class="col-lg-6  col-lg-offset-3">
					<div class="btn-group btn-group-justified">
                        <a href="{{ URL::to('/') }}" class="btn btn-info">Voltar ao Dashboard</a>
                        <a href="http://revender.me/" class="btn btn-warning">Revender.ME</a>
					</div>
				</div>
			</div>
			<!-- /.col-lg-8 col-offset-2 -->
		</div>
	</body>
</html>