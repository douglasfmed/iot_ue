
<?php
  // VERIFICA SE O USUARIO TENTOU ACESSAR A PAGINA PELO ARQUIVO
  if(!isset($libera_pagina) && $libera_pagina != 1){
    header("Location: login.php");
  }
?>

<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?php if($pagina == 'inicio'){ echo "class=\"active\"";} ?>><a href="index.php"><i class="icon-dashboard"></i><span>Início</span> </a> </li>
        <li <?php if($pagina == 'plantas' || $pagina == 'plantas_cadastrar' || $pagina == 'plantas_gerenciar' || $pagina == 'associar_usuarios'){ echo "class=\"dropdown active\"";} else{ echo "class=\"dropdown\""; } ?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-bar-chart"></i><span>Plantas</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?p=plantas"><i class="icon-zoom-in"></i> Visualizar todas</a></li>

          </ul>
        </li>
        <li <?php if($pagina == 'variaveis_cadastrar' || $pagina == 'variaveis_gerenciar'){ echo "class=\"dropdown active\"";} else{ echo "class=\"dropdown\""; } ?>><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-tags"></i><span>Variáveis</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?p=variaveis_cadastrar"><i class="icon-plus-sign"></i> Cadastrar</a></li>
            <li><a href="index.php?p=variaveis_gerenciar"><i class="icon-pencil"></i> Gerenciar</a></li>

          </ul>
        </li>
        
      </ul>
    </div>
    <!-- /container -->
  </div>
  <!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->
