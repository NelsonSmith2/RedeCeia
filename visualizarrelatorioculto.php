<?php
//verificando se a sessao existe e evitando acesso indevido.
  include 'classes/relatorio.php';
  $u=new Relatorio;
  session_start();
  if (!isset($_SESSION['id_igreja'])) {  //se não está definido o id do usuario na sessao
    header("location:index.php");
    die();
  }

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
    <title>Rede Ceia - Cadastro Relatório</title>
  </head>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body bgcolor="#363636">

<a class="btn btn-info" href="painel.php">Voltar</a>
	<div class="container">

  		<div class="row">
		    <div class="col-sm">
		    	
		    </div>
		    <div class="col-sm">
		    		<div class= "align-self-center" style="margin-top: 150px;">
	
	<center>
	<center>
	<h2 style="text-shadow: 0.5px 0.5px black; color: Lime">Veja os seus relatórios de culto abaixo</h2>
	<div id="relatorio">
  <?php
	$u->conectar("redeceia","localhost","root","");
	$sql = $pdo->prepare("SELECT * FROM tb_relatorio_culto WHERE fk_igreja=:fk");
        $sql->bindValue(":fk",$_SESSION['id_igreja']);
        $sql->execute();
        $dado = $sql->fetchAll();
        $n=1;
        foreach($dado as $relatorio) {
        echo ("
          <ul class='list-group'>

        <li class='list-group-item'> Formulário número: ".($n)."<br>
        <li class='list-group-item'> Data: ".$relatorio['data']
        ."<br>"."<li class='list-group-item'>Quantidade de adultos: ".$relatorio['adulto']
        ."<br>"."<li class='list-group-item'>Quantidade de crianças: ".$relatorio['crianca']
        ."<br>"."<li class='list-group-item'>Quantidade de visitantes: ".$relatorio['visitante']
        ."<br>"."<li class='list-group-item'>Quantidade de conversões: ".$relatorio['conversao']
        ."<br>"."<li class='list-group-item'>Quantidade de conciliações: ".$relatorio['conciliacao']
        ."<br>"."<li class='list-group-item'>Quantidade de orações especiais: ".$relatorio['oracao_especial']
        ."<br>"."<li class='list-group-item'>Valor de dizimo arrecadado: ".$relatorio['dizimo']
        ."<br>"."<li class='list-group-item'>Valor de ofertório arrecadado: ".$relatorio['oferta']
        ."<br>"."<li class='list-group-item'>Outras doações: ".$relatorio['outros'].
        "<li class='list-group-item'>
        <br>");?>
        <a href="editarrelatorio.php?idr=<?php echo ($relatorio['idr']);?>" class="btn btn-dark">Editar</a>
        <a onclick="return confirm_click();" href="excluirrelatorio.php?idr=<?php echo ($relatorio['idr']);?>" class="btn btn-dark">Excluir</a>

        </li>
        </ul>
        <br><br><br>
        <?php
        $n++;
        }
	?>
  </div>
	</center>

	</div>
	</div>
					   
					    <div class="col-sm">
					    </div>
					</div>
				</div>
</body>
</html>

<script type="text/javascript">
  function confirm_click()
{
return confirm("Tem certeza que deseja excluir este relatório?\nClique em 'Ok' para confirmar");
}
</script>