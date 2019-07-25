<?php
	session_start();

	// INCLUDES DAS FUNCOES
	include_once("../conexao.php");
	include_once("funcoes/funcoes_principais.php");
	include_once("funcoes/funcoes_usuarios.php");
	include_once("funcoes/funcoes_plantas.php");

	$nivel_utilizado = 1;
	autenticaPagina();
	// VARIAVEL USADA PARA IMPEDIR QUE OS USUARIOS ENTREM NOS ARQUIVOS INDIVIDUAIS
	$libera_pagina = 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Plataforma IoT µE - Universidade Federal da Paraíba</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="../css/font-awesome.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/pages/dashboard.css" rel="stylesheet">
<link href="../css/pages/signin.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../img/favicon.ico">
<script src="../js/highcharts/highcharts.js"></script>
<script src="../js/highcharts/exporting.js"></script>
<script src="../js/highcharts/export-data.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html"><img src="../img/logo_ue_branco.png" width="25" height="25" style="margin-bottom: 2px;"> Plataforma IoT µE </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <a href="../sair.php" class="btn btn-danger"><span class="icon-lock"></span> Sair</a>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!-- /container -->
  </div>
  <!-- /navbar-inner -->
</div>
<!-- /navbar -->

<?php
if(!isset($_GET['p'])){
	$pagina = "inicio";
} else{
	$pagina = $_GET['p'];
}
?>

<?php
include_once("menu.php");
?>



<div class="main">
  <div class="main-inner">
    <div class="container">
    <?php
    // Verificação dinâmica das páginas
        if(file_exists($pagina.".php")){
          include_once($pagina.".php");
        } else{
          include_once("erro.php");
        }
    ?>
    </div>

    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>
<!-- /main -->

<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2019 <a href="#">Laboratório de Microengenharia - UFPB.</a> </div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/excanvas.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/base.js"></script>
<script type="text/javascript" src="../js/script_buscas.js"></script>

</body>
</html>
