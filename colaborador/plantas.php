<?php
  // VERIFICA SE O USUARIO TENTOU ACESSAR A PAGINA PELO ARQUIVO
  if(!isset($libera_pagina) && $libera_pagina != 1){
    header("Location: login.php");
  }
?>

<?php

if(isset($_GET['acao'])){
	$acao = $_GET['acao'];
} else{
	$acao = 'ver_todas';
}

if($acao == 'ver_todas'){

$idUsuario = $_SESSION['usuarioId'];
//$query = "SELECT * FROM plantas WHERE id = (SELECT id_planta FROM acesso_plantas_usuarios WHERE id_usuario = $idUsuario) ORDER BY nome ASC";

$query = "SELECT plantas.id, plantas.nome, plantas.localizacao, plantas.inicio_operacao, plantas.responsavel, plantas.imagem, plantas.codigo_google_maps FROM plantas INNER JOIN acesso_plantas_usuarios ON plantas.id=acesso_plantas_usuarios.id_planta WHERE acesso_plantas_usuarios.id_usuario=$idUsuario ORDER BY plantas.nome ASC";

  $resultados = mysqli_query($conn, $query);
  $num_resultados = mysqli_num_rows($resultados);
  if($num_resultados == 0){
    echo "<script>Nenhuma planta disponível!</script>";
    echo "<script>window.location.href='index.php';</script>";
  }
?>
<div class="row">
<?php
  while($resultado = mysqli_fetch_array($resultados)){

  //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
  if(isset($resultado)){
    $id = $resultado['id'];
    $nome = $resultado['nome'];
    $imagem = $resultado['imagem'];
  }
?>
	      <div class="span4">

	      		<div class="widget">

					<div class="widget-header">
						<i class="icon-map-marker"></i>
					<h3><?php echo $nome; ?></h3>
					</div> <!-- /widget-header -->

					<div class="widget-content">
            <center>
              <img style="max-width: 300px; max-height: 150px; width: auto; height: auto;" src="../img/plantas/<?php echo $imagem; ?>" width="300" />
            </center>

            <br>

              <div class="btn-group pull-right">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='index.php?p=plantas&acao=abrir&id=<?php echo $id; ?>&qtd=10&data=<?php echo date("Y-m-d"); ?>';">Abrir</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='index.php?p=plantas_gerenciar&acao=editar&id=<?php echo $id; ?>';">Editar</button>
              </div>

					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

      </div> <!-- /span4 -->

<?php
  }
?>
</div> <!-- /row -->
<?php
} elseif($acao == 'abrir'){

  $id = $_GET['id'];

  $result_usuarios = "SELECT * FROM plantas WHERE id = $id LIMIT 1";
  $resultado_usuarios = mysqli_query($conn, $result_usuarios);

  while($resultado = mysqli_fetch_array($resultado_usuarios)){

  //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
  if(isset($resultado)){
    $nome = $resultado['nome'];
    $localizacao = $resultado['localizacao'];
    $inicio_operacao = $resultado['inicio_operacao'];
    $responsavel = $resultado['responsavel'];
    $imagem = $resultado['imagem'];
    $codigo_google_maps = $resultado['codigo_google_maps'];
  }

  }

  include_once("planta.php");
}
?>
