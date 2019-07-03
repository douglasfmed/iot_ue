<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Plataforma IoT µE</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">
<link rel="icon" href="img/favicon.ico">

</head>

<body>

	<div class="navbar navbar-fixed-top">

	<div class="navbar-inner">

		<div class="container">

			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<a class="brand" href="index.html"><img src="img/logo_ue_branco.png" width="25" height="25" style="margin-bottom: 2px;"> Plataforma IoT µE </a>

			</div> <!-- /container -->

	</div> <!-- /navbar-inner -->

</div> <!-- /navbar -->



<div class="account-container">

	<div class="content clearfix">

		<form method="POST" action="valida.php">

			<h1>Login</h1>

			<div class="login-fields">

				<p>Por favor informe seus dados de acesso</p>

				<div class="field">
					<label for="username">E-mail:</label>
					<input type="text" id="email" name="email" value="" placeholder="E-mail" class="login username-field" />
				</div> <!-- /field -->

				<div class="field">
					<label for="password">Senha:</label>
					<input type="password" id="senha" name="senha" value="" placeholder="Senha" class="login password-field"/>
				</div> <!-- /password -->

			</div> <!-- /login-fields -->

			<div class="login-actions">

        <!--
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
      -->

				<button class="button btn btn-success btn-large" type="submit">Entrar na plataforma</button>

			</div> <!-- .actions -->



		</form>

	</div> <!-- /content -->

</div> <!-- /account-container -->

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

</body>

</html>
