<?php
  // VERIFICA SE O USUARIO TENTOU ACESSAR A PAGINA PELO ARQUIVO
  if(!isset($libera_pagina) && $libera_pagina != 1){
    header("Location: login.php");
  }
?>

	<div class="row">

		<div class="span12">

			<div class="error-container">
				<h1>404</h1>

				<h2>Ops! Página não encontrada.</h2>

				<div class="error-details">
					Parece que você está tentando acessar uma página que não existe, por favor clique no botão abaixo para voltar à página inicial.

				</div> <!-- /error-details -->

				<div class="error-actions">
					<a href="index.php" class="btn btn-large btn-primary">
						<i class="icon-chevron-left"></i>
						&nbsp;
						Voltar à página inicial
					</a>



				</div> <!-- /error-actions -->

			</div> <!-- /error-container -->

		</div> <!-- /span12 -->

	</div> <!-- /row -->
