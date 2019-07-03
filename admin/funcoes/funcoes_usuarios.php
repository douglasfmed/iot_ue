<?php

function cadastrarUsuario($nome, $email, $senha, $nivel){

  global $conn;
  $senha = base64_encode($senha);

  $insere_usuario = "INSERT INTO usuarios (nome, email, senha, nivel_acesso) values ('$nome','$email','$senha','$nivel')";

  if(mysqli_query($conn, $insere_usuario)){
    echo "<script>window.alert('Usuário inserido com sucesso!');</script>";
    echo "<script>window.location.href='index.php?p=usuarios_gerenciar';</script>";
  }

}

function editarUsuario($nome_novo, $email_novo, $senha_novo, $nivel_novo, $id){

  global $conn;
  $senha_novo = base64_encode($senha_novo);

  $edita_usuario = "UPDATE usuarios SET nome = '$nome_novo', email = '$email_novo', senha = '$senha_novo', nivel_acesso = '$nivel_novo' WHERE id = $id";
  if(mysqli_query($conn, $edita_usuario)){
  	echo "<script>window.alert('Dados alterados com sucesso!');</script>";
  	echo "<script>window.location.href='index.php?p=usuarios_gerenciar';</script>";
  }
}

function apagarUsuario($id){

  global $conn;
  $apaga_usuario = "DELETE FROM usuarios WHERE id = $id";
  if(mysqli_query($conn, $apaga_usuario)){
    echo "<script>window.alert('Usuário apagado com sucesso!');</script>";
    echo "<script>window.location.href='index.php?p=usuarios_gerenciar';</script>";
  }

}

?>
