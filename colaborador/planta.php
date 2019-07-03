<?php
  // VERIFICA SE O USUARIO TENTOU ACESSAR A PAGINA PELO ARQUIVO
  if(!isset($libera_pagina) && $libera_pagina != 1){
    header("Location: login.php");
  }

  $data_atual = date("Y-m-d");
    if(!isset($_GET['data'])){
      $data_consulta = $data_atual;
    }
    if(!isset($_GET['qtd'])){
      $qtd = 10;
    }
  $data_consulta = $_GET['data'];
  $qtd_consulta = $_GET['qtd'];
    // Formatando a data
    $data_formatada = new DateTime($data_consulta);
    //echo $data_formatada->format('d/m/Y');
?>

<script type="text/javascript">

      var tempo = 30000;

      atualizaPagina();
      function atualizaPagina(){
        setTimeout("location.reload(true);",tempo);
      }

</script>

<?php
$query_todas_variaveis = "SELECT * FROM variaveis WHERE id_planta = '$id'";
$exec_todas_variaveis = mysqli_query($conn, $query_todas_variaveis);
while($resultado_todas_variaveis = mysqli_fetch_array($exec_todas_variaveis)){
  $id_variavel = $resultado_todas_variaveis['id'];
  $nome_variavel = $resultado_todas_variaveis['nome'];
    // Ajustes no nome da VARIAVEL
    $nome_variavel_formatado = ucwords($nome_variavel, "_");
    $nome_variavel_formatado = str_replace("_", " ", $nome_variavel_formatado);
  $descricao_variavel = $resultado_todas_variaveis['descricao'];
  $unidade_variavel = $resultado_todas_variaveis['unidade'];
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var myChart = Highcharts.chart('<?php echo $nome_variavel; ?>', {
        chart: {
            type: 'line'
        },
        title: {
          text: '<?php echo $nome_variavel_formatado; ?>'
        },
        subtitle: {
          text: '<?php echo $descricao_variavel ."<br>". $data_formatada->format('d/m/Y'); ?>'
        },
        xAxis: {
          categories: [
          <?php
          //$query_monit = "SELECT * FROM monitoramento WHERE id_variavel = '$id_variavel' LIMIT 1";
          //$query_monit = "SELECT * FROM monitoramento WHERE id_variavel = '$id_variavel' AND data BETWEEN '$data_consulta' AND '$data_consulta 23:59:59' ORDER BY data DESC LIMIT $qtd_consulta";
          if($_GET['qtd'] == 'all'){
            $query_monit = "SELECT * FROM (SELECT * FROM monitoramento AS ordenacao_1 WHERE id_variavel = '$id_variavel' AND data LIKE '%$data_consulta%' ORDER BY id DESC) AS ordenacao_2 ORDER BY id ASC";
          } else{
            $query_monit = "SELECT * FROM (SELECT * FROM monitoramento AS ordenacao_1 WHERE id_variavel = '$id_variavel' AND data LIKE '%$data_consulta%' ORDER BY id DESC LIMIT $qtd_consulta) AS ordenacao_2 ORDER BY id ASC";
          }
          $exec_monit = mysqli_query($conn, $query_monit);
          while($resultado_monit = mysqli_fetch_array($exec_monit)){
            $data_monit = $resultado_monit['data'];
            echo "'".$data_monit."',";
          }
          ?>]
        },
        yAxis: {
          title: {
            text: '<?php echo $nome_variavel." (".$unidade_variavel.")"; ?>'
          }
        },
        plotOptions: {
          line: {
            dataLabels: {
              enabled: true
            },
            enableMouseTracking: false
          }
        },
        series: [{
          name: '<?php echo $nome_variavel; ?>',
          data: [
            <?php
            //$query_monit = "SELECT * FROM monitoramento WHERE id_variavel = '$id_variavel' LIMIT 1";
            if($_GET['qtd'] == 'all'){
              $query_monit = "SELECT * FROM (SELECT * FROM monitoramento AS ordenacao_1 WHERE id_variavel = '$id_variavel' AND data LIKE '%$data_consulta%' ORDER BY id DESC) AS ordenacao_2 ORDER BY id ASC";
            } else{
              $query_monit = "SELECT * FROM (SELECT * FROM monitoramento AS ordenacao_1 WHERE id_variavel = '$id_variavel' AND data LIKE '%$data_consulta%' ORDER BY id DESC LIMIT $qtd_consulta) AS ordenacao_2 ORDER BY id ASC";
            }
            $exec_monit = mysqli_query($conn, $query_monit);
            while($resultado_monit = mysqli_fetch_array($exec_monit)){
              $valor_monit = $resultado_monit['valor'];
              echo "".$valor_monit.",";
            }
            ?>
          ]
        }]
    });
});
</script>

<?php } ?>

    	<div class="row">
    	<div class="span12">

				<div class="widget widget-plain">

					<div class="widget-content">

            <a href="javascript:void();" onclick="location.href='index.php?p=plantas';" class="btn btn-large btn-support-ask"><i class="icon-chevron-left"></i> Ver todas as plantas</a>

            <a href="javascript:void();" onclick="location.href='index.php?p=plantas_gerenciar&acao=editar&id=<?php echo $id; ?>';" class="btn btn-large btn-warning btn-support-ask"><i class="icon-pencil"></i> Editar informações</a>

						<a href="javascript:location.reload();" class="btn btn-large btn-success btn-support-ask"><i class="icon-refresh"></i> Atualizar página (<span id="segs">30</span> s)</a>


					</div> <!-- /widget-content -->

				</div> <!-- /widget -->



			</div> <!-- /span12 -->
         </div>

	      <div class="row">

	      	<div class="span12">

            <div class="widget">

            <div class="widget-header">
            <i class="icon-external-link"></i>
            <h3>Endereço para enviar dados (exemplo)</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content" style="color: red;">

              <?php
                $query_variaveis = "SELECT * FROM variaveis WHERE id_planta = '$id'";
                $exec_variaveis = mysqli_query($conn, $query_variaveis);
                $num_variaveis = mysqli_num_rows($exec_variaveis);

                if($num_variaveis == 0){
                  echo "<center><h4>Não existem variáveis para esta planta.</h4></center>";
                } else{
                // VARIAVEL UTILIZADA PARA LISTAR AS VARIAVEIS NO ENDERECO DO GET
                $endereco_variaveis = "data=".$data_atual."&hora=09:05:00&";
                $i = 1;

                while($resultados_variaveis = mysqli_fetch_array($exec_variaveis)){
                  if($i == $num_variaveis){
                    $endereco_variaveis = $endereco_variaveis.$resultados_variaveis['nome']."=10.5";
                  } else{
                    $endereco_variaveis = $endereco_variaveis.$resultados_variaveis['nome']."=12&";
                  }
                  $i++;
                }

              ?>

            <center><b>http://microengenharia.sytes.net:4000/iot_ue/dados/enviar.php?id_planta=<?php echo $id; ?>&<?php echo $endereco_variaveis; ?></b></center>
            <?php } ?>
            </div> <!-- /widget-content -->

            </div> <!-- /widget -->

            <div class="widget">

					<div class="widget-header">
						<i class="icon-info-sign"></i>
						<h3>Informações da planta</h3>
					</div> <!-- /widget-header -->

					<div class="widget-content">

            <table class="table table-sm">
              <tbody>
                <tr>
                  <th scope="row">Nome da planta</th>
                  <td colspan="2"><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th scope="row">Localização</th>
                  <td colspan="2"><?php echo $localizacao; ?></td>
                </tr>
                <tr>
                  <th scope="row">Início de operação</th>
                  <td colspan="2"><?php echo $inicio_operacao; ?></td>
                </tr>
                <tr>
                  <th scope="row">Responsável</th>
                  <td colspan="2"><?php echo $responsavel; ?></td>
                </tr>
                <tr>
                  <th scope="row">Quantidade de variáveis associadas</th>
                  <td colspan="2"><?php echo $num_variaveis; ?></td>
                </tr>
              </tbody>
            </table>

            <table>
            <tr>
              <td>
            <?php echo $codigo_google_maps; ?>
            </td>
              <td><center>
                <img src="../img/plantas/<?php echo $imagem; ?>" width="600">
              </center></td>
            </tr>
          </table>



					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

        <?php if($num_variaveis != 0){ ?>

          <div class="widget">

          <div class="widget-header">
          <i class="icon-filter"></i>
          <h3>Filtros para consulta</h3>
          </div> <!-- /widget-header -->

          <div class="widget-content">

            <form action="" method="post" class="form-horizontal">
              <fieldset>

                <div class="control-group">
                  <label class="control-label" for="username">Quantidade de medições: </label>
                  <div class="controls">
                    <select id="qtd_registros_filtro" name="qtd_registros_filtro">
                       <option value="10" <?php if($_GET['qtd'] == 10){ echo "selected"; } ?>>10 últimas</option>
                       <option value="50" <?php if($_GET['qtd'] == 50){ echo "selected"; } ?>>50 últimas</option>
                       <option value="100" <?php if($_GET['qtd'] == 100){ echo "selected"; } ?>>100 últimas</option>
                       <option value="all" <?php if($_GET['qtd'] == 'all'){ echo "selected"; } ?>>Dia inteiro</option>
                    </select>
                  </div> <!-- /controls -->
                </div> <!-- /control-group -->

                <div class="control-group">
                  <label class="control-label" for="username">Data para visualização:  </label>
                  <div class="controls">
                    <input type="date" id="data_filtro" value="<?php echo $data_consulta; ?>" name="data_filtro">
                  </div> <!-- /controls -->
                </div> <!-- /control-group -->

                <div class="form-actions">
                  <button type="submit" class="btn btn-danger" id="liberar" name="liberar" value="aplicar_filtros">Aplicar filtros</button>
                  <button class="btn" id="liberar" name="liberar" value="restaurar_filtros">Restaurar padrão</button>
                </div> <!-- /form-actions -->

            </fieldset>
          </form>

          <?php

            if(isset($_POST['liberar']) && $_POST['liberar'] == 'aplicar_filtros'){
              $qtd_consulta = $_POST['qtd_registros_filtro'];
              $data_consulta = $_POST['data_filtro'];
            	echo "<script>window.location.href='index.php?p=plantas&acao=abrir&id=".$id."&qtd=".$qtd_consulta."&data=".$data_consulta."';</script>";
            } elseif(isset($_POST['liberar']) && $_POST['liberar'] == 'restaurar_filtros'){
              echo "<script>window.location.href='index.php?p=plantas&acao=abrir&id=".$id."&qtd=10&data=".$data_atual."';</script>";
            }

          ?>

          </div> <!-- /widget-content -->

          </div> <!-- /widget -->

        <div class="widget">

        <div class="widget-header">
        <i class="icon-bar-chart"></i>
        <h3>Acompanhamento das variáveis</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">

        <!-- CHART -->

        <?php
        $query_todas_variaveis = "SELECT * FROM variaveis WHERE id_planta = '$id'";
        $exec_todas_variaveis = mysqli_query($conn, $query_todas_variaveis);
        while($resultado_todas_variaveis = mysqli_fetch_array($exec_todas_variaveis)){
          $nome_variavel = $resultado_todas_variaveis['nome'];
        ?>
          <div id="<?php echo $nome_variavel; ?>" style="width:100%; height:400px;"></div>
        <?php } ?>

        </div> <!-- /widget-content -->

        </div> <!-- /widget -->

      <?php } ?>

		    </div> <!-- /spa12 -->

	      </div> <!-- /row -->
