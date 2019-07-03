<?php

    include_once("../conexao.php");

    $URL_ATUAL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_quebrada = explode('/', $URL_ATUAL);
    //echo "URL: ";
    //print_r($url_quebrada[5]);
    //echo "<br>";

    $variaveis = explode('?', $url_quebrada[5]);
    $variaveis = explode("&", $variaveis[1]);

    //echo "QUANTIDADE DE VARIAVEIS: ";
    //echo count($variaveis);
    //echo "<br>";

    //print_r($variaveis);
    //echo "<br>";

    $id_planta = explode('=', $variaveis[0], 2);
    $id_planta = $id_planta[1];
    unset($variaveis[0]);
    // Lembrar que o indice 0 tambem foi excluido assim

    $data = explode('=', $variaveis[1], 2);
    $data = $data[1];
    unset($variaveis[1]);
    // Lembrar que o indice 1 tambem foi excluido assim

    $hora = explode('=', $variaveis[2], 2);
    $hora = $hora[1];
    unset($variaveis[2]);
    // Lembrar que o indice 2 tambem foi excluido assim

    // Ajustando para o formato do PhpMyAdmin
    $data = $data." ".$hora;

    $i = 1;
    foreach ($variaveis as $variavel) {
      //echo $variavel;

        $variavel = explode('=', $variavel, 2);
        $nome_variavel = $variavel[0];
        $valor_variavel = $variavel[1];

        // Trocar $nome_variavel por id_variavel (pensar em alguma solução)
        // Pois pode dar problema se existirem 2 variáveis com o mesmo nome
        $query_variaveis = "SELECT id FROM variaveis WHERE nome = '$nome_variavel' AND id_planta = '$id_planta' LIMIT 1";
        $exec_variaveis = mysqli_query($conn, $query_variaveis);
        $id_variavel = mysqli_fetch_array($exec_variaveis);
        $id_variavel = $id_variavel['id'];

        $query_monit = "INSERT INTO monitoramento (valor, data, id_variavel) VALUES ('$valor_variavel', '$data', '$id_variavel')";
        if(mysqli_query($conn, $query_monit)){
          echo "Valor inserido com sucesso no BD!";
          echo "<br>";
        } else{
          echo "Erro ao inserir no BD.";
          echo "<br>";
        }


    }

?>
