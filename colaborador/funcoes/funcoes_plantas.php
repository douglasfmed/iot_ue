<?php

function editarPlanta($id, $nome, $localizacao, $responsavel, $codigo_google_maps, $imagem, $inicio_operacao){

  global $conn;

  if(!empty($imagem['name'])){

    // APAGANDO A IMAGEM ANTIGA
    $query = "SELECT * FROM plantas WHERE id = '$id' LIMIT 1";
    $resultado_query = mysqli_query($conn, $query);
    $resultado = mysqli_fetch_assoc($resultado_query);
    $imagem_apagar = $resultado['imagem'];

    unlink('../img/plantas/'.$imagem_apagar);

    // ALTERANDO OS DADOS DA PLANTA
    $nome_imagem = $imagem['name'];

    if(uploadImagem($imagem)){

      global $novoNome;

      $query = "UPDATE plantas SET nome = '$nome', localizacao = '$localizacao', responsavel = '$responsavel', codigo_google_maps = '$codigo_google_maps', imagem = '$novoNome', inicio_operacao = '$inicio_operacao' WHERE id = $id";
      if(mysqli_query($conn, $query)){
      	echo "<script>window.alert('Dados alterados com sucesso!');</script>";
        echo "<script>window.location.href='index.php?p=plantas';</script>";
      }

    }

  } else{
    $query = "UPDATE plantas SET nome = '$nome', localizacao = '$localizacao', responsavel = '$responsavel', codigo_google_maps = '$codigo_google_maps', inicio_operacao = '$inicio_operacao' WHERE id = $id";
    if(mysqli_query($conn, $query)){
    	echo "<script>window.alert('Dados alterados com sucesso!');</script>";
    	echo "<script>window.location.href='index.php?p=plantas';</script>";
    }
  }

}

function uploadImagem($imagem){
  // REF: https://php.eduardokraus.com/upload-de-imagens-com-php
  $destino = "../img/plantas/".$imagem['name'];
  $arquivo_tmp = $imagem['tmp_name'];

  // Pega a extensão
  $extensao = pathinfo ($imagem['name'], PATHINFO_EXTENSION);
  // Converte a extensão para minúsculo
  $extensao = strtolower($extensao);

  if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        global $novoNome;
        $novoNome = uniqid(time()).'.'.$extensao;

        // Concatena a pasta com o nome
        $destino = '../img/plantas/'.$novoNome;

        // tenta mover o arquivo para o destino
        if (@move_uploaded_file($arquivo_tmp, $destino)){
            //echo "<script>window.alert('Planta cadastrada com sucesso!');</script>";
            return 1;
        }
        else
            echo "<script>window.alert('Erro ao salvar arquivo...');</script>";
    }
    else
        echo "echo <script>window.alert('Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"');</script>";
}

?>
