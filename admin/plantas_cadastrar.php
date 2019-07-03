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
  <h3>Cadastrando uma nova planta</h3>
  </div> <!-- /widget-header -->

  <div class="widget-content">

    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <fieldset>

        <div class="control-group">
          <label class="control-label" for="username">Nome da planta</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="nome" name="nome" value="" placeholder="Qual é o nome da planta?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Localização</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="localizacao" name="localizacao" value="" placeholder="Onde fica a planta?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Responsável</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="responsavel" name="responsavel" value="" placeholder="Quem é responsável pela planta?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Início de operação</label>
          <div class="controls">
              <input class="span6" type="date" id="inicio_operacao" value="<?php echo date("Y-m-d"); ?>" name="inicio_operacao">
              <p class="help-block"><i class="icon-warning-sign"></i> Você pode alterar a data digitando manualmente ou clicando na setinha no final do campo.</p>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="username">Código HTML do Google Maps</label>
          <div class="controls">
              <textarea class="span6" id="codigo_google_maps" name="codigo_google_maps" placeholder="Cole aqui o código para incorporar o mapa de localização. Ele pode ser obtido no site do Google Maps." rows="10"></textarea>
              <p class="help-block"><a href="http://www.google.com/maps" target="_blank"><i class="icon-external-link"></i> Clique aqui para abrir o Google Maps.</a></p>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="username">Imagem da planta</label>
          <div class="controls">
              <input type="file" class="custom-file-input" id="imagem_planta" name="imagem_planta">
          </div>
        </div>

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
	cadastrarPlanta($_POST['nome'], $_POST['localizacao'], $_POST['responsavel'], $_POST['codigo_google_maps'], $_FILES['imagem_planta'] ,$_POST['inicio_operacao']);
} elseif(isset($_POST['liberar']) && $_POST['liberar'] == 'cancelar'){
  echo "<script>window.location.href='index.php?p=plantas_gerenciar';</script>";
}

?>
