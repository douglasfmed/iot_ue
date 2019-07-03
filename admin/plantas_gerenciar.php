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
	$acao = 'gerenciar';
}

if($acao == 'gerenciar'){

?>
	      <div class="row">

	      	<div class="span12">

            <div class="widget">
              <a href="javascript:void();" onclick="location.href='index.php?p=plantas_cadastrar';" class="btn btn-large btn-success btn-support-ask"><i class="icon-plus-sign"></i> Cadastrar uma nova planta</a>

              <a href="javascript:void();" onclick="location.href='index.php?p=plantas';" class="btn btn-large btn-support-ask"><i class="icon-zoom-in"></i> Visualizar todas</a>

            </div>

	      		<div class="widget">

					<div class="widget-header">
						<i class="icon-user"></i>
					<h3>Listando todas as plantas</h3>
					</div> <!-- /widget-header -->

					<div class="widget-content">

            <div id="tabela_busca" class="form-horizontal">
            <fieldset>
            <div class="control-group">
              <i class="icon-zoom-in"></i> <input class="span5 m-wrap" id="appendedInputButton" type="text" placeholder="Qual planta você está buscando?">
            </div> <!-- /control-group -->
            </fieldset>
            </div>

            <table class="table table-striped table-bordered" id="tabela">
              <thead>
                <tr>
                  <th> Nome da planta </th>
                  <th> Localização</th>
                  <th> Responsável</th>
                  <th class="td-actions"> Ações </th>
                </tr>
              </thead>
              <tbody>

              <?php

              $result_usuarios = "SELECT * FROM plantas ORDER BY nome ASC";
          		$resultado_usuarios = mysqli_query($conn, $result_usuarios);
              $numero_resultado = mysqli_num_rows($resultado_usuarios);

              while($resultado = mysqli_fetch_array($resultado_usuarios)){

          		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
          		if(isset($resultado)){
                $id = $resultado['id'];
                $nome = $resultado['nome'];
                $localizacao = $resultado['localizacao'];
                $responsavel = $resultado['responsavel'];
              }
              ?>
              <tr>
                <td><?php echo $nome; ?></td>
                <td><?php echo $localizacao; ?></td>
                <td><?php echo $responsavel; ?></td>
                <td class="td-actions">
                <center>
									<a href="index.php?p=plantas_gerenciar&acao=editar&id=<?php echo $id; ?>" class="btn btn-warning btn-small"><i class="btn-icon-only icon-pencil"> </i> Editar</a>
                  <a href="index.php?p=plantas_gerenciar&acao=apagar&id=<?php echo $id; ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i> Apagar</a>
                </center>
                </td>
              </tr>

							<?php
              }
              ?>

              </tbody>
            </table>
              <?php
              // MOSTRA MSG CASO NAO EXISTA NENHUMA PLANTA
              if($numero_resultado == 0){
                echo "<h2>Nenhuma planta cadastrada...</h2>";
              }
              ?>
					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

		    </div> <!-- /spa12 -->

	      </div> <!-- /row -->

<?php

} elseif ($acao == 'apagar') {

	if(isset($_GET['id'])){
		apagarPlanta($_GET['id']);
	}

} elseif ($acao == 'editar') {

	if(isset($_GET['id'])){

		$id = $_GET['id'];

		$query = "SELECT * FROM plantas WHERE id = $id LIMIT 1";
		$resultados = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_array($resultados)){

		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		if(isset($resultado)){
			$nome = $resultado['nome'];
			$localizacao = $resultado['localizacao'];
			$inicio_operacao = $resultado['inicio_operacao'];
			$responsavel = $resultado['responsavel'];
      $imagem = $resultado['imagem'];
      $codigo_google_maps = $resultado['codigo_google_maps'];
		}
?>

<div class="row">

  <div class="span12">

    <div class="widget">

  <div class="widget-header">
    <i class="icon-pencil"></i>
  <h3>Editando uma planta</h3>
  </div> <!-- /widget-header -->

  <div class="widget-content">

    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <fieldset>

        <div class="control-group">
          <label class="control-label" for="username">Nome da planta</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="nome" name="nome" value="<?php echo $nome; ?>" placeholder="Qual é o nome da planta?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Localização</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="localizacao" name="localizacao" value="<?php echo $localizacao; ?>" placeholder="Onde fica a planta?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Responsável</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="responsavel" name="responsavel" value="<?php echo $responsavel; ?>" placeholder="Quem é responsável pela planta?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Início de operação</label>
          <div class="controls">
              <input class="span6" type="date" id="inicio_operacao" value="<?php echo $inicio_operacao; ?>" name="inicio_operacao">
              <p class="help-block"><i class="icon-warning-sign"></i> Você pode alterar a data digitando manualmente ou clicando na setinha no final do campo.</p>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="username">Código HTML do Google Maps</label>
          <div class="controls">
              <textarea class="span6" id="codigo_google_maps" name="codigo_google_maps" placeholder="Cole aqui o código para incorporar o mapa de localização. Ele pode ser obtido no site do Google Maps." rows="10"><?php echo $codigo_google_maps; ?></textarea>
              <p class="help-block"><a href="http://www.google.com/maps" target="_blank"><i class="icon-external-link"></i> Clique aqui para abrir o Google Maps.</a></p>
          </div>
        </div>

        <fieldset>
        <legend>Imagem atual da planta</legend>
          <center>
            <img src="../img/plantas/<?php echo $imagem; ?>" width="400" />
          </center>
       </fieldset>

       <hr>

       <h3><font color="red"><i class="icon-warning-sign"></i> Atenção:</font> Caso você deseje alterar a imagem da planta, basta selecionar abaixo. Caso não deseje alterar, não selecione nada.</h3>
       <br>

        <div class="control-group">
          <label class="control-label" for="username">Nova imagem:</label>
          <div class="controls">
              <input type="file" class="custom-file-input" id="imagem_planta" name="imagem_planta">
          </div>
        </div>

         <br />


        <div class="form-actions">
          <button type="submit" class="btn btn-warning" id="liberar" name="liberar" value="alterar">Alterar</button>
          <button class="btn" id="liberar" name="liberar" value="cancelar">Cancelar</button>
        </div> <!-- /form-actions -->
      </fieldset>
    </form>

  </div> <!-- /widget-content -->

</div> <!-- /widget -->

</div> <!-- /spa12 -->

</div> <!-- /row -->

<?php
}

if(isset($_POST['liberar']) && $_POST['liberar'] == 'alterar'){
	editarPlanta($id, $_POST['nome'], $_POST['localizacao'], $_POST['responsavel'], $_POST['codigo_google_maps'], $_FILES['imagem_planta'] ,$_POST['inicio_operacao']);
} elseif(isset($_POST['liberar']) && $_POST['liberar'] == 'cancelar'){
  if($_SESSION['usuarioNivelAcesso'] == 1){
     echo "<script>window.location.href='index.php?p=plantas_gerenciar';</script>";
  } else{
    echo "<script>window.location.href='index.php?p=plantas';</script>";
  }
}

	} else{
    if($_SESSION['usuarioNivelAcesso'] == 1){
       echo "<script>window.location.href='index.php?p=plantas_gerenciar';</script>";
    } else{
      echo "<script>window.location.href='index.php?p=plantas';</script>";
    }
	}

}
?>
