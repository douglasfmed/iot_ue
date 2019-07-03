<?php
  // VERIFICA SE O USUARIO TENTOU ACESSAR A PAGINA PELO ARQUIVO
  if(!isset($libera_pagina) && $libera_pagina != 1){
    header("Location: login.php");
  }
?>

<div class="row">
  <div class="span6">

    <div class="widget widget-nopad">
      <div class="widget-header"> <i class="icon-user"></i>
        <h3> Bem-vindo!</h3>
      </div>
      <!-- /widget-header -->
      <div class="widget-content">

          <center>
          <h6 class="bigstats">Olá, <b><?php echo $_SESSION['usuarioNome']; ?></b> !</h6>
        </center>
          <center>
          <h5>Seja bem-vindo à plataforma IoT do laboratório de microengenharia da Universidade Federal da Paraíba (UFPB).</h5>
          <br>
          Você é um usuário com níveis de acesso de <b>Colaborador</b>.
          <br><br>
        </center>
      </div>
      <!-- /widget-content -->
    </div>
    <!-- /widget -->

    <div class="widget widget-nopad">
      <div class="widget-header"> <i class="icon-map-marker"></i>
        <h3> Localização do nosso laboratório</h3>
      </div>
      <!-- /widget-header -->
      <div class="widget-content">
        <div class="widget big-stats-container">
          <div class="widget-content">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.8530950407585!2d-34.85276368568042!3d-7.142980672050189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7acc297e49d9157%3A0xc93410002d50b03b!2sLaborat%C3%B3rio+de+Microengenharia!5e0!3m2!1spt-BR!2sbr!4v1561582196996!5m2!1spt-BR!2sbr" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
          <!-- /widget-content -->

        </div>
      </div>
    </div>
    <!-- /widget -->

  </div>
  <!-- /span6 -->
  <div class="span6">
    <div class="widget">
      <div class="widget-header"> <i class="icon-bookmark"></i>
        <h3>Ações rápidas</h3>
      </div>
      <!-- /widget-header -->
      <div class="widget-content">
        <div class="shortcuts"> <a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-zoom-in"></i> <span class="shortcut-label">Visualizar todas as plantas</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-tags"></i><span
                                          class="shortcut-label">Gerenciar variáveis de medição</span> </a><a href="javascript:;" class="shortcut"><i
                                              class="shortcut-icon icon-tag"></i><span class="shortcut-label">Criar variável de medição</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-question-sign"></i> <span class="shortcut-label">Suporte</span> </a> </div>
        <!-- /shortcuts -->
      </div>
      <!-- /widget-content -->
    </div>
    <!-- /widget -->

    <div class="widget widget-nopad">
      <div class="widget-header"> <i class="icon-list-alt"></i>
        <h3> Últimas atualizações da plataforma</h3>
      </div>
      <!-- /widget-header -->
      <div class="widget-content">
        <ul class="news-items">
          <li>

            <div class="news-item-date"> <span class="news-item-day">25</span> <span class="news-item-month">Jun</span> </div>
            <div class="news-item-detail"> <b>Implementação dos filtros</b>
              <p class="news-item-preview"> Liberação na página das plantas do recursos para filtrar os resultados de monitoramento das variáveis por quantidade de registros e data. </p>
            </div>

          </li>
          <li>

            <div class="news-item-date"> <span class="news-item-day">20</span> <span class="news-item-month">Jun</span> </div>
            <div class="news-item-detail"> <b>Cadastro de usuários multiníveis</b>
              <p class="news-item-preview"> Nesta versão do sistema, é possível cadastrar usuários de níveis diferentes de acesso (administradores e colaboradores). </p>
            </div>

          </li>
        </ul>
      </div>
      <!-- /widget-content -->
    </div>
    <!-- /widget -->
  </div>
  <!-- /span6 -->
</div>
<!-- /row -->
