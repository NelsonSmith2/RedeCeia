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

<a class="btn btn-info" href="visualizarrelatorioculto.php">Voltar</a>
	<div class="container">

  		<div class="row">
		    <div class="col-sm">
		    	
		    </div>
		    <div class="col-sm">
		    		<div class= "align-self-center" style="margin-top: 150px;">
	<center>
	<h2 style="text-shadow: 0.5px 0.5px black; color: Lime">Altere as infromações que você deseja editar no seu relatório de culto</h2>
	<?php
	$conexao = new PDO("mysql:dbname=redeceia;host=localhost","root","");
	$sql = $conexao->prepare("SELECT * FROM tb_relatorio_culto WHERE idr=:id");
	        $sql->bindValue(":id",$_GET['idr']);
	        $sql->execute();
	        $dado = $sql->fetchAll();
			foreach($dado as $relatorio) {
        		echo ("<br>
				<form  method='POST'>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Quantidade de adultos</label>	
						<input type='number' class='form-control' name='adulto' value='".$relatorio['adulto']."' placeholder='Quantidade de adultos' maxlength='10'>
					</div>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Quantidade de crianças</label>	
						<input type='number' class='form-control' name='crianca' value='".$relatorio['crianca']."' placeholder='Quantidade de crianças' maxlength='10'>
					</div>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Quantidade de visitantes</label>	
						<input type='number' class='form-control' name='visitante' value='".$relatorio['visitante']."' placeholder='Quantidade de visitantes' maxlength='10'>
					</div>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Quantidade de conversões</label>	
						<input type='number' class='form-control' name='conversao' value='".$relatorio['conversao']."' placeholder='Quantidade de conversões' maxlength='10'>
					</div>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Quantidade de conciliacões</label>	
						<input type='number' class='form-control' name='conciliacao' value='".$relatorio['conciliacao']."' placeholder='Quantidade de conciliacões' maxlength='10'>
					</div>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Quantidade de orações especiais</label>
						<input type='number' class='form-control' name='oracao_especial' value='".$relatorio['oracao_especial']."' placeholder='Quantidade de orações especiais' maxlength='10'>
					</div>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Valor do dizimo coletado</label>	
						<input type='number' class='form-control' name='dizimo' value='".$relatorio['dizimo']."' placeholder='Valor do dizimo coletado' maxlength='10'>
					</div>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Valor de ofertório coletado</label>	
						<input type='number' class='form-control' name='oferta' value='".$relatorio['oferta']."' placeholder='Valor de ofertório coletado' maxlength='10'>
					</div>	
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Outras doações</label>	
						<input type='text' class='form-control' name='outros' value='".$relatorio['outros']."' placeholder='Outras doações' maxlength='200'>
					</div>
					<div class='form-group'>
						<label style='font-size:large;color: lime;'>Data</label>	
						<input type='date' class='form-control' name='data' value='".$relatorio['data']."'
					</div>
					<div class='form-group'>	
						<br>
						<input type='submit' class='btn btn-dark' value='Finalizar edição' maxlength='200'>
					</div>
				</form>
				</center>
				</div>");
    		}

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
				if ($u->editarRelatorioCulto($adulto, $crianca, $visitante, $conversao, $conciliacao, $oracao_especial, $dizimo, $oferta, $outros, $data, $_GET['idr']))
				{
					echo ("<script>
							location.href='visualizarrelatorioculto.php';
							alert('O relátório foi editado com sucesso!');
						</script>");
				}else
				{
					echo ("<script>
							alert('Não foi possível editar o relatório');
							location.href='visualizarrelatorioculto.php';
						</script>");
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
<?php
/*
if($sql){
	echo ("<script>
			location.href='visualizarrelatorioculto.php';
			alert('O relátório foi excluído com sucesso!');
		</script>");
}else{
	echo ("<script>
			alert('Não foi possível deletar o usuário');
			location.href='visualizarrelatorioculto.php';
		</script>");
}
*/
?>