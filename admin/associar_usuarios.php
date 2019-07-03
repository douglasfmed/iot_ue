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
              <a href="javascript:void();" onclick="location.href='index.php?p=associar_usuarios&acao=cadastrar';" class="btn btn-large btn-success btn-support-ask"><i class="icon-plus-sign"></i> Criar uma nova associação</a>

            </div>

	      		<div class="widget">

					<div class="widget-header">
						<i class="icon-group"></i>
					<h3>Listando todas as associações</h3>
					</div> <!-- /widget-header -->

					<div class="widget-content">

            <p class="help-block"><i class="icon-warning-sign"></i> Aqui estão listados apenas os usuários <b>colaboradores</b>, pois os administradores têm acesso a todas as plantas.</p>

            <table class="table table-striped table-bordered" id="tabela">

              <div id="tabela_busca" class="form-horizontal">
              <fieldset>
              <div class="control-group">
                <i class="icon-zoom-in"></i> <input class="span5 m-wrap" id="appendedInputButton" type="text" placeholder="O que você está buscando?">
              </div> <!-- /control-group -->
              </fieldset>
              </div>

              <thead>
                <tr>
                  <th> Nome da planta </th>
                  <th> Nome do usuário</th>
                  <th class="td-actions"> Ações </th>
                </tr>
              </thead>
              <tbody>

              <?php

              $query = "SELECT * FROM acesso_plantas_usuarios";
              $resultados = mysqli_query($conn, $query);
              $numero_registros = mysqli_num_rows($resultados);

              while($resultado = mysqli_fetch_array($resultados)){

          		if(isset($resultado)){
                $id = $resultado['id'];
                $id_usuario = $resultado['id_usuario'];
                $id_planta = $resultado['id_planta'];

                  $query_planta = "SELECT nome FROM plantas WHERE id = $id_planta";
                  $resultados_planta = mysqli_query($conn, $query_planta);
                  $nome_planta = mysqli_fetch_assoc($resultados_planta);
                  $nome_planta = $nome_planta['nome'];

                  $query_usuario = "SELECT nome FROM usuarios WHERE id = $id_usuario";
                  $resultados_usuario = mysqli_query($conn, $query_usuario);
                  $nome_usuario = mysqli_fetch_assoc($resultados_usuario);
                  $nome_usuario = $nome_usuario['nome'];
              }
              ?>
              <tr>
                <td><?php echo $nome_planta; ?></td>
                <td><?php echo $nome_usuario; ?></td>
                <td class="td-actions">
                <center>
                  <a href="index.php?p=associar_usuarios&acao=apagar&id=<?php echo $id; ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i> Apagar</a>
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
              if($numero_registros == 0){
                echo "<h2>Nenhuma associação cadastrada...</h2>";
              }
              ?>
					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

		    </div> <!-- /spa12 -->

	      </div> <!-- /row -->

<?php

} elseif ($acao == 'apagar') {

	if(isset($_GET['id'])){
    $id = $_GET['id'];
    $apaga_associacao = "DELETE FROM acesso_plantas_usuarios WHERE id = $id";
    if(mysqli_query($conn, $apaga_associacao)){
      echo "<script>window.alert('Associação apagada com sucesso!');</script>";
      echo "<script>window.location.href='index.php?p=associar_usuarios';</script>";
    }
	}

} elseif ($acao == 'cadastrar') {
?>

<div class="row">

  <div class="span12">

    <div class="widget">

  <div class="widget-header">
    <i class="icon-plus-sign"></i>
  <h3>Criando uma nova associação</h3>
  </div> <!-- /widget-header -->

  <div class="widget-content">

    <form action="" method="post" class="form-horizontal">
      <fieldset>

      <div class="control-group">
          <label class="control-label" for="username">Nome da planta</label>
          <div class="controls">
            <select class="custom-select span6" id="id_planta" name="id_planta">
              <option selected>Selecione a planta</option>
              <?php
                $query_plantas = "SELECT * FROM plantas ORDER BY nome ASC";
                $resultados_plantas = mysqli_query($conn, $query_plantas);

                while($resultado_plantas = mysqli_fetch_array($resultados_plantas)){
                  $id_planta = $resultado_plantas['id'];
                  $nome_planta = $resultado_plantas['nome'];
                  echo "<option value=\"$id_planta\">$nome_planta</option>";
                }
              ?>
          </select>
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Nome do usuário</label>
          <div class="controls">
            <select class="custom-select span6" id="id_usuario" name="id_usuario">
              <option selected>Selecione o usuário</option>
              <?php
                $query_usuarios = "SELECT * FROM usuarios WHERE nivel_acesso = 3 ORDER BY nome ASC";
                $resultados_usuarios = mysqli_query($conn, $query_usuarios);

                while($resultado_usuarios = mysqli_fetch_array($resultados_usuarios)){
                  $id_usuario = $resultado_usuarios['id'];
                  $nome_usuario = $resultado_usuarios['nome'];
                  echo "<option value=\"$id_usuario\">$nome_usuario</option>";
                }
              ?>
          </select>
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

         <br />


        <div class="form-actions">
          <button type="submit" class="btn btn-success" id="liberar" name="liberar" value="cadastrar">Cadastrar</button>
          <button class="btn" id="liberar" name="liberar" value="cancelar">Cancelar</button>
        </div> <!-- /form-actions -->
      </fieldset>
    </form>

  </div> <!-- /widget-content -->

</div> <!-- /widget -->

</div> <!-- /spa12 -->

</div> <!-- /row -->

<?php

if(isset($_POST['liberar']) && $_POST['liberar'] == 'cadastrar'){
  $id_usuario = $_POST['id_usuario'];
  $id_planta = $_POST['id_planta'];

    $query_verifica_duplicado = "SELECT * FROM acesso_plantas_usuarios WHERE id_planta = '$id_planta' AND id_usuario = '$id_usuario'";
    $executa_query_verifica_duplicado = mysqli_query($conn, $query_verifica_duplicado);
    $num_verifica_duplicado = mysqli_num_rows($executa_query_verifica_duplicado);

    if($num_verifica_duplicado != 0){
      echo "<script>window.alert('Erro! A associação que você está tentando criar já existe...');</script>";
    } else{
      $query_cadastrar = "INSERT INTO acesso_plantas_usuarios (id_planta, id_usuario) VALUES ('$id_planta', '$id_usuario')";
      if(mysqli_query($conn, $query_cadastrar)){
        echo "<script>window.alert('Associação inserida com sucesso!');</script>";
        echo "<script>window.location.href='index.php?p=associar_usuarios';</script>";
      } else{
        echo "<script>window.alert('Erro ao inserir no banco de dados...');</script>";
      }
    }

} elseif(isset($_POST['liberar']) && $_POST['liberar'] == 'cancelar'){
  echo "<script>window.location.href='index.php?p=associar_usuarios';</script>";
}

?>

<?php
}
?>
