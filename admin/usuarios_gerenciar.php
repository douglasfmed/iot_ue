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
              <a href="javascript:void();" onclick="location.href='index.php?p=usuarios_cadastrar';" class="btn btn-large btn-success btn-support-ask"><i class="icon-plus-sign"></i> Cadastrar um novo usuário</a>
            </div>

	      		<div class="widget">

					<div class="widget-header">
						<i class="icon-user"></i>
						<h3>Listando todos os usuários</h3>
					</div> <!-- /widget-header -->

					<div class="widget-content">



            <table class="table table-striped table-bordered" id="tabela">

              <div id="tabela_busca" class="form-horizontal">
              <fieldset>
              <div class="control-group">
                <i class="icon-zoom-in"></i> <input class="span5 m-wrap" id="appendedInputButton" type="text" placeholder="Quem você está buscando?">
              </div> <!-- /control-group -->
              </fieldset>
              </div>

              <thead>
                <tr>
                  <th> Nome do usuário </th>
                  <!--<th> E-mail</th>-->
                  <th> Nível de acesso</th>
                  <th class="td-actions"> Ações </th>
                </tr>
              </thead>
              <tbody>

              <?php

              $result_usuarios = "SELECT * FROM usuarios ORDER BY nome ASC";
          		$resultado_usuarios = mysqli_query($conn, $result_usuarios);

              while($resultado = mysqli_fetch_array($resultado_usuarios)){

          		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
          		if(isset($resultado)){
                $id_usuario = $resultado['id'];
                $nome_usuario = $resultado['nome'];
                $email_usuario = $resultado['email'];
                  if($resultado['nivel_acesso'] == 1){
                    $nivel_usuario = "Administrador";
                  } elseif($resultado['nivel_acesso'] == 2){
                    $nivel_usuario = "Subadministrador";
                  } else{
                    $nivel_usuario = "Colaborador";
                  }
              }
              ?>
              <tr>
                <td><?php echo $nome_usuario; ?></td>
                <!--<td><?php echo $email_usuario; ?></td>-->
                <td><?php echo $nivel_usuario; ?></td>
                <td class="td-actions">
                <center>
									<a href="index.php?p=usuarios_gerenciar&acao=editar&id=<?php echo $id_usuario; ?>" class="btn btn-warning btn-small"><i class="btn-icon-only icon-pencil"> </i> Editar</a>
                  <a href="index.php?p=usuarios_gerenciar&acao=apagar&id=<?php echo $id_usuario; ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i> Apagar</a>
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
		apagarUsuario($_GET['id']);
	}

} elseif ($acao == 'editar') {

	if(isset($_GET['id'])){

		$id = $_GET['id'];


		$result_usuarios = "SELECT * FROM usuarios WHERE id = $id LIMIT 1";
		$resultado_usuarios = mysqli_query($conn, $result_usuarios);

		while($resultado = mysqli_fetch_array($resultado_usuarios)){

		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		if(isset($resultado)){
			$nome_usuario = $resultado['nome'];
			$email_usuario = $resultado['email'];
			$senha_usuario = base64_decode($resultado['senha']);
			$nivel_usuario = $resultado['nivel_acesso'];
		}
?>

<div class="row">

  <div class="span12">

    <div class="widget">

  <div class="widget-header">
    <i class="icon-pencil"></i>
  <h3>Editando um usuário</h3>
  </div> <!-- /widget-header -->

  <div class="widget-content">

    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <fieldset>

        <div class="control-group">
          <label class="control-label" for="username">Nome completo</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="nome" name="nome" value="<?php echo $nome_usuario; ?>" placeholder="Qual é o nome da pessoa?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">E-mail</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="email" name="email" value="<?php echo $email_usuario; ?>" placeholder="Informe o email do usuário">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Senha</label>
          <div class="controls">
            <input type="text" class="span6 disabled" id="senha" name="senha" value="<?php echo $senha_usuario; ?>" placeholder="Qual será a senha?">
          </div> <!-- /controls -->
        </div> <!-- /control-group -->

        <div class="control-group">
          <label class="control-label" for="username">Nível de acesso</label>
          <div class="controls">
            <select class="custom-select span6" id="nivel" name="nivel">
  					  <option>Selecione</option>
  					  <option value="1" <?php if($nivel_usuario == 1) echo "selected"; ?>>Administrador</option>
  					  <option value="2" <?php if($nivel_usuario == 2) echo "selected"; ?> disabled>Subadministrador</option>
              <option value="3" <?php if($nivel_usuario == 3) echo "selected"; ?>>Colaborador</option>
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
	editarUsuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['nivel'], $id);
} elseif(isset($_POST['liberar']) && $_POST['liberar'] == 'cancelar'){
  echo "<script>window.location.href='index.php?p=usuarios_gerenciar';</script>";
}

	} else{
		echo "<script>window.location.href='index.php?p=usuarios_gerenciar';</script>";
	}

}
?>
