<?php
    $URL_ATUAL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    //echo $URL_ATUAL;

    $url_quebrada = explode('/', $URL_ATUAL);
    echo "URL: ";
    print_r($url_quebrada[5]);
    echo "<br>";

    $variaveis = explode('?', $url_quebrada[5]);
    echo "VARIÁVEIS: ";
    echo $variaveis[1];
    echo "<br>";

    //echo count(explode("&",$variaveis[1]));

    $variaveis = explode("&", $variaveis[1]);
    print_r($variaveis);

?>
