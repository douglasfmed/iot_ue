<?php
  // VERIFICA SE O USUARIO TENTOU ACESSAR A PAGINA PELO ARQUIVO
  if(!isset($libera_pagina) && $libera_pagina != 1){
    header("Location: login.php");
  }
$idUsuario = $_SESSION['usuarioId'];
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
              <a href="javascript:void();" onclick="location.href='index.php?p=variaveis_cadastrar';" class="btn btn-large btn-success btn-support-ask"><i class="icon-plus-sign"></i> Cadastrar uma nova variável</a>
            </div>

	      		<div class="widget">

					<div class="widget-header">
						<i class="icon-user"></i>
						<h3>Listando todas as variáveis</h3>
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
                  <th> Nome da variável </th>
                  <th> Planta associada</th>
                  <th class="td-actions"> Ações </th>
                </tr>
              </thead>
              <tbody>

              <?php

              $result_usuarios = "SELECT variaveis.id, variaveis.nome, variaveis.descricao, variaveis.unidade, variaveis.id_planta FROM variaveis INNER JOIN acesso_plantas_usuarios ON variaveis.id_planta=acesso_plantas_usuarios.id_planta WHERE acesso_plantas_usuarios.id_usuario=$idUsuario ORDER BY variaveis.nome ASC";
          		$resultado_usuarios = mysqli_query($conn, $result_usuarios);

              while($resultado = mysqli_fetch_array($resultado_usuarios)){

          		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
          		if(isset($resultado)){
                $id = $resultado['id'];
                $nome = $resultado['nome'];
                $id_planta = $resultado['id_planta'];
                  $query_planta = "SELECT * FROM plantas WHERE id = '$id_planta'";
                  $executa_planta = mysqli_query($conn, $query_planta);
                  $resultados_planta = mysqli_fetch_assoc($executa_planta);
                  $nome_planta = $resultados_planta['nome'];
              }
              ?>
              <tr>
                <td><?php echo $nome; ?></td>
                <td><?php echo $nome_planta; ?></td>
                <td class="td-actions">
                <center>
									<a href="index.php?p=variaveis_gerenciar&acao=editar&id=<?php echo $id; ?>" class="btn btn-warning btn-small"><i class="btn-icon-only icon-pencil"> </i> Editar</a>
                  <a href="index.php?p=variaveis_gerenciar&acao=apagar&id=<?php echo $id; ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i> Apagar</a>
                </center>
                </td>
              </tr>

							<?php
              }
              ?>

              </tbody>
            </table>

					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

		    </div> <!-- /spa12 -->

	      </div> <!-- /row -->

<?php

} elseif ($acao == 'apagar') {

	if(isset($_GET['id'])){
    $id = $_GET['id'];
    $apaga_variavel = "DELETE FROM variaveis WHERE id = $id";
    if(mysqli_query($conn, $apaga_variavel)){
      echo "<script>window.alert('Variável apagada com sucesso!');</script>";
      echo "<script>window.location.href='index.php?p=variaveis_gerenciar';</script>";
    }
	}

} elseif ($acao == 'editar') {

	if(isset($_GET['id'])){

		$id = $_GET['id'];

		$result_usuarios = "SELECT * FROM variaveis WHERE id = $id LIMIT 1";
		$resultado_usuarios = mysqli_query($conn, $result_usuarios);

		while($resultado = mysqli_fetch_array($resultado_usuarios)){

		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		if(isset($resultado)){
			$nome = $resultado['nome'];
			$descricao = $resultado['descricao'];
			$unidade = $resultado['unidade'];
			$id_planta = $resultado['id_planta'];
		}

?>

<div class="row">

  <div class="span12">

    <div class="widget">

  <div class="widget-header">
    <i class="icon-pencil"></i>
  <h3>Editando uma variável</h3>
  </div> <!-- /widget-header -->

  <div class="widget-content">

    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <fieldset>

        <div class="control-group">
          <label class="control-label" for="username">Nome</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="nome" name="nome" value="<?php echo $nome; ?>" placeholder="nome_da_variavel">
            <p class="help-block"><i class="icon-warning-sign"></i> Não utilizar espaços nem caracteres especiais.</p>
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Descrição</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="descricao" name="descricao" value="<?php echo $descricao; ?>" placeholder="Breve descrição desta variável">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Unidade</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="unidade" name="unidade" value="<?php echo $unidade; ?>" placeholder="Qual a unidade da variável? Exemplo: °C, J, m/s">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Tipo de variável</label>
          <div class="controls">
            <select class="custom-select span6" id="tipo_variavel" name="tipo_variavel">
  					  <option selected>Selecione um tipo</option>
              <option disabled>Variável XY</option>
              <option disabled>Variável de geolocalização</option>
            </select>
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Planta associada</label>
          <div class="controls">
            <select class="custom-select span6" id="id_planta" name="id_planta">
  					  <option selected>Selecione uma planta</option>

              <?php
                  if($_SESSION['usuarioNivelAcesso'] == 1){
                      $query = "SELECT * FROM plantas ORDER BY nome ASC";
                  } else{
                      $idUsuario = $_SESSION['usuarioId'];
                      $query = "SELECT * FROM plantas WHERE id = (SELECT id_planta FROM acesso_plantas_usuarios WHERE id_usuario = $idUsuario) ORDER BY nome ASC";
                  }
                $resultados = mysqli_query($conn, $query);
                $num_resultados = mysqli_num_rows($resultados);
                if($num_resultados == 0){
                  echo "<script>Nenhuma planta disponível!</script>";
                  echo "<script>window.location.href='index.php?p=variaveis_gerenciar';</script>";
                } else{
                  while($resultado = mysqli_fetch_array($resultados)){
                    $id_plantas = $resultado['id'];
                    $nome_planta = $resultado['nome'];
                      if($id_planta == $id_plantas){
                        echo "<option value=\"$id_plantas\" selected>$nome_planta</option>";
                      } else{
                        echo "<option value=\"$id_plantas\">$nome_planta</option>";
                      }
                  }
                }

              ?>
  					</select>
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

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
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $unidade = $_POST['unidade'];
  $id_planta = $_POST['id_planta'];
  $query = "UPDATE variaveis SET nome = '$nome', descricao = '$descricao', unidade = '$unidade', id_planta = '$id_planta' WHERE id = $id";
  if(mysqli_query($conn, $query)){
    echo "<script>window.alert('Dados alterados com sucesso!');</script>";
    echo "<script>window.location.href='index.php?p=variaveis_gerenciar';</script>";
  }
} elseif(isset($_POST['liberar']) && $_POST['liberar'] == 'cancelar'){
  echo "<script>window.location.href='index.php?p=variaveis_gerenciar';</script>";
}

	} else{
		echo "<script>window.location.href='index.php?p=variaveis_gerenciar';</script>";
	}

}
?>
