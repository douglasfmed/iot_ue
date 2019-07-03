<?php
	session_start();

	unset(
		$_SESSION['usuarioId'],
		$_SESSION['usuarioNome'],
		$_SESSION['usuarioNiveisAcessoId'],
		$_SESSION['usuarioEmail'],
		$_SESSION['usuarioSenha']
	);

	echo "<script>window.location.href='index.php';</script>";
	//header("Location: login.php");
?>
