<?php

function autenticaPagina(){

  global $nivel_utilizado;
  
  if(!isset($_SESSION['usuarioNome'])){
    header("Location: ../index.php");
  }
  if($_SESSION['usuarioNivelAcesso'] != $nivel_utilizado){
    header("Location: ../index.php");
  }
}
?>
