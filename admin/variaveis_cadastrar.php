<?php
  // VERIFICA SE O USUARIO TENTOU ACESSAR A PAGINA PELO ARQUIVO
  if(!isset($libera_pagina) && $libera_pagina != 1){
    header("Location: login.php");
  }
?>

<div class="row">

  <div class="span12">

    <div class="widget">

  <div class="widget-header">
    <i class="icon-plus-sign"></i>
  <h3>Cadastrando uma nova variável</h3>
  </div> <!-- /widget-header -->

  <div class="widget-content">

    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <fieldset>

        <div class="control-group">
          <label class="control-label" for="username">Nome</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="nome" name="nome" value="" placeholder="nome_da_variavel">
            <p class="help-block"><i class="icon-warning-sign"></i> Não utilizar espaços nem caracteres especiais.</p>
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Descrição</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="descricao" name="descricao" value="" placeholder="Breve descrição desta variável">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Unidade</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="unidade" name="unidade" value="" placeholder="Qual a unidade da variável? Exemplo: °C, J, m/s">
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
                    $id_planta = $resultado['id'];
                    $nome_planta = $resultado['nome'];
                    echo "<option value=\"$id_planta\">$nome_planta</option>";
                  }
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
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $unidade = $_POST['unidade'];
  $id_planta = $_POST['id_planta'];

	$query = "INSERT INTO variaveis (nome, descricao, unidade, id_planta) VALUES ('$nome', '$descricao', '$unidade', '$id_planta')";
    if(mysqli_query($conn, $query)){
      echo "<script>window.alert('Variável criada com sucesso!');</script>";
      echo "<script>window.location.href='index.php?p=variaveis_gerenciar';</script>";
    } else{
      echo "<script>window.alert('Erro ao inserir no banco de dados...');</script>";
    }
} elseif(isset($_POST['liberar']) && $_POST['liberar'] == 'cancelar'){
  echo "<script>window.location.href='index.php?p=variaveis_gerenciar';</script>";
}

?>
