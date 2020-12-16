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
	<h2 style="text-shadow: 0.5px 0.5px black; color: Lime">Insira as infromações necessárias para o relatório de culto</h2>
	
	<form  method="POST">
		<div class="form-group">	
			<input type="number" class="form-control" name="adulto" placeholder="Quantidade de adultos" maxlength="10">
		</div>
		<div class="form-group">	
			<input type="number" class="form-control" name="crianca" placeholder="Quantidade de crianças" maxlength="10">
		<div class="form-group">	
			</div>
			<input type="number" class="form-control" name="visitante" placeholder="Quantidade de visitantes" maxlength="10">
		<div class="form-group">	
			</div>
			<input type="number" class="form-control" name="conversao" placeholder="Quantidade de conversões" maxlength="10">
		<div class="form-group">	
			</div>
			<input type="number" class="form-control" name="conciliacao" placeholder="Quantidade de conciliacões" maxlength="10">
		<div class="form-group">	
			</div>
			<input type="number" class="form-control" name="oracao_especial" placeholder="Quantidade de orações especiais" maxlength="10">
		<div class="form-group">	
			</div>
			<input type="number" class="form-control" name="dizimo" placeholder="Valor do dizimo coletado" maxlength="10">
		<div class="form-group">	
			</div>
			<input type="number" class="form-control" name="oferta" placeholder="Valor de ofertório coletado" maxlength="10">
		<div class="form-group">	
			</div>
			<input type="text" class="form-control" name="outros" placeholder="Outras doações" maxlength="200">
		<div class="form-group">	
			</div>
			<input type="date" class="form-control" name="data" placeholder="Outras doações" maxlength="200"> <br>
		<div class="form-group">	
			
			<input type="submit" class="btn btn-dark" value="Cadastrar relatório" maxlength="200">
		</div>
	</form>
	</center>
	</div>
	<?php

	if(isset($_POST['adulto'])){

		
		$adulto = $_POST['adulto'];
		$crianca = $_POST['crianca'];
		$visitante = $_POST['visitante'];
		$conversao = $_POST['conversao'];
		$conciliacao = $_POST['conciliacao'];
		$oracao_especial = $_POST['oracao_especial'];
		$dizimo = $_POST['dizimo'];
		$oferta = $_POST['oferta'];
		$outros = $_POST['outros'];
		$data = $_POST['data'];

		if(!empty($adulto) && !empty($crianca) && !empty($visitante) && !empty($conversao) && !empty($conciliacao) && !empty($oracao_especial) && !empty($dizimo) && !empty($oferta) && !empty($outros) && !empty($data)){

			$u->conectar("redeceia","localhost","root",""); //conectando ao banco
			if($u->msgErro=="") // caso a mensagem esteja vazia, login ok
			{
				if ($u->cadastrarRelatorioCulto($adulto, $crianca, $visitante, $conversao, $conciliacao, $oracao_especial, $dizimo, $oferta, $outros, $data, $_SESSION['id_igreja']))
				{
						?>
						<div class="alert alert-success" role="alert">
							Cadastrado com sucesso!
						</div>
						<?php
				}else
				{
				?>
				<div class="alert alert-danger" role="alert">
					<?php echo "Erro: ".$u->msgErro;?>
				</div>
				<?php
				}
			}else
			{
				?>
				<div class="alert alert-danger" role="alert">
					<?php echo "Erro: ".$u->msgErro;?>
				</div>
				<?php
			}
		}else
		{
			?>
			<div class="alert alert-danger" role="alert">
				Preencha todos os campos!
			</div>
			<?php
		}
	}


	?>
		</div>
					   
					    <div class="col-sm">
					    </div>
					</div>
				</div>
</body>
</html>