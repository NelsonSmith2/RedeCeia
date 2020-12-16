<?php
//verificando se a sessao existe e evitando acesso indevido.
  include 'classes/usuario.php';
  $u=new Usuario;
  session_start();
  if (!isset($_SESSION['id_igreja'])) {  //se não está definido o id do usuario na sessao
    header("location:index.php");
    die();
  }
  //echo isset($_SESSION['nome']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Rede Ceia - Painel</title>
  </head>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body bgcolor="#363636">


  <div class="container">
      <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
            <div class= "align-self-center" style="margin-top: 150px;">

            
          <center>
            <?php echo "<h2 style='text-shadow: 0.5px 0.5px black; color: Lime'>Bem-vindo, ".$_SESSION['nome']."!</h2>"?>
            	<form method="POST" action="cadastrocelula.php">
                <input type="submit" class="btn btn-dark" style="width: 350px;" value="Cadastrar Célula" class="criar relatório culto"> 
                </form>
                <br>
              <form method="POST" action="criarrelatorioculto.php">
            		<input type="submit" class="btn btn-dark" style="width: 350px;" value="Criar relatório de culto" class="criar relatório culto">
              </form>
              <br>
              <form method="POST" action="criarrelatoriocelula.php">
                <input type="submit" class="btn btn-dark" style="width: 350px;" value="Criar relatório de célula" class="criar relatório célula">
              </form>
              <br>
              <form method="POST" action="visualizarrelatorioculto.php">
                <input type="submit" class="btn btn-dark" style="width: 350px;" value="Ver meus relatórios de culto" class="ver relatórios culto">
              </form>
              <br>
              <form method="POST" action="visualizarrelatoriocelula.php">
                <input type="submit" class="btn btn-dark" style="width: 350px;" value="Ver meus relatórios de célula" class="ver relatórios célula">
              </form>
              <br>
            	<a class="btn btn-info" href="sair.php">Sair</a>
              <h2 style='text-shadow: 0.5px 0.5px black; color: Lime'><br>Veja abaixo um gráfico de seus relatórios</h2>
              <?php
               $u->conectar("redeceia","localhost","root","");
               $sql = $pdo->prepare("SELECT COUNT(idr) FROM tb_relatorio_culto WHERE fk_igreja=:fk");
               $sql->bindValue(":fk",$_SESSION['id_igreja']);
               $sql->execute();
               $dado = $sql->fetchAll();
               //print_r($dado[0][0]);
               $qtdculto=$dado[0][0];


               $u->conectar("redeceia","localhost","root","");
               $sql2 = $pdo->prepare("SELECT COUNT(idr) FROM tb_relatorio_celula WHERE fk_igreja=:fk");
               $sql2->bindValue(":fk",$_SESSION['id_igreja']);
               $sql2->execute();
               $dado2 = $sql2->fetchAll();
               //print_r($dado[0][0]);
               $qtdcelula=$dado2[0][0];

              ?>
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
              <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                  var data = google.visualization.arrayToDataTable([
                    ['Relatórios', 'Quantidade'],
                    ['Relatório de culto',<?php echo($qtdculto);?>],
                    ['Relatório de célula',<?php echo($qtdcelula);?>]
                  ]);

                  var options = {
                    title: ['My Daily Activities'],
                    backgroundColor: 'transparent',
                    pieSliceText: 'value',
                    pieHole: 2
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                  chart.draw(data, options);
                }
              </script>
                    <div id="piechart" style=" background-color:transparent; margin-left: 50px; width: 900px; height: 500px;"></div>
            	</center>
        	</div>
          </div>
             
              <div class="col-sm">
              </div>
          </div>
        </div>
</body>
</html>