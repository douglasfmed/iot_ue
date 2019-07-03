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
  <h3>Cadastrando um novo usuário</h3>
  </div> <!-- /widget-header -->

  <div class="widget-content">

    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <fieldset>

        <div class="control-group">
          <label class="control-label" for="username">Nome completo</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="nome" name="nome" value="" placeholder="Qual é o nome da pessoa?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">E-mail</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="email" name="email" value="" placeholder="Informe o email do usuário">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Senha</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="senha" name="senha" value="" placeholder="Qual será a senha?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Nível de acesso</label>
          <div class="controls">
            <select class="custom-select span6" id="nivel" name="nivel">
  					  <option selected>Selecione um nível</option>
  					  <option value="1">Administrador geral</option>
              <option value="2" disabled>Subadministrador</option>
  					  <option value="3">Colaborador</option>
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
	cadastrarUsuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['nivel']);
} elseif(isset($_POST['liberar']) && $_POST['liberar'] == 'cancelar'){
  echo "<script>window.location.href='index.php?p=usuarios_gerenciar';</script>";
}

?>
