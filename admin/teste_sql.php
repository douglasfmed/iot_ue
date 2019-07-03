<?php

// $query = "
// CREATE TABLE IF NOT EXISTS usuario(
//     cod INT (6) NOT NULL AUTO_INCREMENT,
//     nome VARCHAR (50) NOT NULL,
//     data DATE NOT NULL,
//     hora TIME NOT NULL,
//     PRIMARY KEY(cod)
// );
// ";

$query = "DROP TABLE usuario";

if(mysqli_query($conn, $query)){
  echo "<script>window.alert('Tabela criada com sucesso!');</script>";
  echo "<script>window.location.href='index.php';</script>";
}

?>
