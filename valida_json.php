<?php
	session_start();
	//Incluindo a conexão com banco de dados
	include_once("conexao.php");
	//O campo usuário e senha preenchido entra no if para validar
	if((isset($_POST['email'])) && (isset($_POST['senha']))){
		$usuario = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
		$senha = mysqli_real_escape_string($conn, $_POST['senha']);
		$senha = base64_encode($senha);

		//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_usuario = "SELECT * FROM usuarios WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);

		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		if(isset($resultado)){
			$_SESSION['usuarioId'] = $resultado['id'];
			$_SESSION['usuarioNome'] = $resultado['nome'];
			$_SESSION['usuarioNivelAcesso'] = $resultado['nivel_acesso'];
			$_SESSION['usuarioEmail'] = $resultado['email'];

			//echo "<script>window.location.href='index.php';</script>";

			if($_SESSION['usuarioNivelAcesso'] == "1"){
				$retorno = array('autenticacao' => 'ok', 'tipo_usuario' => 'admin');
			} elseif($_SESSION['usuarioNivelAcesso'] == "2"){
				$retorno = array('autenticacao' => 'ok', 'tipo_usuario' => 'subadmin');
			} else{
				$retorno = array('autenticacao' => 'ok', 'tipo_usuario' => 'colaborador');
			}

			echo json_encode($retorno);

		//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		//redireciona o usuario para a página de login
		}else{
			//Váriavel global recebendo a mensagem de erro
			$retorno = array('autenticacao' => 'falha', 'tipo_usuario' => 0);
			echo json_encode($retorno);
		}
	//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
	}else{
		$retorno = array('autenticacao' => 'falha', 'tipo_usuario' => 0);
		echo json_encode($retorno);
	}
?>
