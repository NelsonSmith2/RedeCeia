<?php
//verificando se a sessao existe e evitando acesso indevido.
  include 'classes/relatorio.php';
  include 'classes/celula.php';
  $u=new Relatorio;
  $c=new Celula;
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
    <script src="js/jquery.js"></script>
<body bgcolor="#363636">

<a class="btn btn-info" href="painel.php">Voltar</a>
	<div class="container">

  		<div class="row">
		    <div class="col-sm">
		    	
		    </div>
		    <div class="col-sm">
		    		<div class= "align-self-center" style="margin-top: 150px;">
	
	<center>
	<h2 style="text-shadow: 0.5px 0.5px black; color: Lime">Insira as infromações necessárias para o relatório de célula</h2>



	<form  method="POST">
		<select class="form-control" name="celula" id="celula">
		<option value="0">
			Selecione uma célula
		</option>
		<?php
			$c->conectar("redeceia","localhost","root","");
			$c->selectCelula($_SESSION['id_igreja']);
		?>

		</select>
		<br>
		<div  class="form-group">
			<input id="nome" type="text" class="form-control" name="nome" placeholder="Nome" maxlength="200">
		</div>
		<div class="form-group">
			<input id="area" type="text" class="form-control" name="area" placeholder="Área" maxlength="200">
		</div>
		<div class="form-group">
			<input id="endereco" type="text" class="form-control" name="endereco" placeholder="Endereço" maxlength="200">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="lider" placeholder="Líder" maxlength="200">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="anfitriao" placeholder="Anfitrião" maxlength="200">
		</div>
		<div class="form-group">
			<input type="number" class="form-control" name="adulto" placeholder="Quantidade de adultos" maxlength="10">
		</div>
		<div class="form-group">
			<input type="number" class="form-control" name="crianca" placeholder="Quantidade de crianças" maxlength="10">
		</div>
		<div class="form-group">
			<input type="date" class="form-control" name="data" placeholder="Outras doações" maxlength="200">
		</div>
		<div id="cadastro" class="form-group">
			<input type="submit" class="btn btn-dark" value="Cadastrar relatório" maxlength="200">
		</div>
	</form>
	</center>
	</div>
	<?php

	if(isset($_POST['nome'])){

		$nome = $_POST['nome'];
		$area = $_POST['area'];
		$endereco = $_POST['endereco'];
		$lider = $_POST['lider'];
		$anfitriao = $_POST['anfitriao'];
		$adulto = $_POST['adulto'];
		$crianca = $_POST['crianca'];
		$data = $_POST['data'];
		$celula = $_POST['celula'];
		//echo("Célula: ".$celula);
		if(!empty($nome) && !empty($area) && !empty($endereco) && !empty($lider) && !empty($anfitriao) && !empty($adulto) && !empty($crianca) && !empty($data)){

			$u->conectar("redeceia","localhost","root",""); //conectando ao banco
			if($u->msgErro=="") // caso a mensagem esteja vazia, login ok
			{
				if ($u->cadastrarRelatorioCelula($nome, $area, $endereco, $lider, $anfitriao, $adulto, $crianca, $data, $_SESSION['id_igreja'], $celula))
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

<script type="text/javascript">
	$(document).ready(function(){
		$("#celula").on("change", function(){
			idCelula = $("#celula").val();
			if(idCelula==0){
				$("#nome").val("");
				$("#nome").prop("readonly",false);
				$("#area").val("");
				$("#area").prop("readonly",false);
				$("#endereco").val("");
				$("#endereco").prop("readonly",false);

			}else{
				$.ajax({
				url: 'capta_celula.php?idCelula='+idCelula,
				type: 'GET',
				success: function(data){
					console.log(data);
					data = JSON.parse(data);
					console.log(data);
					console.log(idCelula);
					$("#nome").val(data.nome);
					$("#nome").prop("readonly",true);
					$("#area").val(data.area);
					$("#area").prop("readonly",true);
					$("#endereco").val(data.endereco);
					$("#endereco").prop("readonly",true);
				} 

				});
			}

			

		});
	});
</script>
</script>