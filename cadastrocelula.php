<?php
//verificando se a sessao existe e evitando acesso indevido.
  include 'classes/celula.php';
  $u=new Celula;
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
    <title>Rede Ceia - Cadastro Célula</title>
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
							<h2 style="text-shadow: 0.5px 0.5px black; color: Lime">Crie sua célula inserindo os dados abaixo</h2>
							<form  method="POST">
								<div class="form-group">	
									<input type="text" class="form-control" name="nome" placeholder="Nome" maxlength="200">
								</div>
								<div class="form-group">	
									<input type="text" class="form-control" name="area" placeholder="Area" maxlength="200">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="endereco" placeholder="Endereço" maxlength="200">
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-dark" value="Cadastrar Célula" maxlength="200">
								</div>
							</form>
							</center>

							
						</div>
							<?php

	if(isset($_POST['nome'])){

		$nome = $_POST['nome'];
		$area = $_POST['area'];
		$endereco = $_POST['endereco'];

		if(!empty($nome) && !empty($area) && !empty($endereco)){

			$u->conectar("redeceia","localhost","root",""); //conectando ao banco
			if($u->msgErro=="") // caso a mensagem esteja vazia, login ok
			{
				if ($u->cadastrarCelula($nome, $area, $endereco, $_SESSION['id_igreja']))
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