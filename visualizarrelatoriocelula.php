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
	<h2 style="text-shadow: 0.5px 0.5px black; color: Lime">Veja os seus relatórios de célula abaixo</h2>
	<?php
	$u->conectar("redeceia","localhost","root","");
	$u->vizualizarRelatorioCelula($_SESSION['id_igreja']);
	?>
	</center>


	</div>
	</div>
					   
					    <div class="col-sm">
					    </div>
					</div>
				</div>
	

</body>
</html>