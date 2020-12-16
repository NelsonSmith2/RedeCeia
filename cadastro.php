<?php
// Conexão com o banco de dados
	//include "db.php";
include "classes/usuario.php";
$u = new usuario;
?>
<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Rede Ceia - Cadastro</title>
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
					<h2 style="text-shadow: 0.5px 0.5px black; color: Lime">Crie uma conta para sua igreja</h2>
					
					<form  method="POST">
						<div class="form-group">	
							<input type="text" class="form-control" name="nome" placeholder="Nome da Igreja" maxlength="200">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" placeholder="Email" maxlength="200">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="senha" placeholder="Senha" maxlength="200">
						</div>
						<div class="form-group">
							<input type="password" class="form-control"  name="confsenha" placeholder="Confirmar senha" maxlength="200">
						</div>
						<div class="form-group">
							<input type="submit" value="Cadastrar" class="btn btn-dark" maxlength="200">
						</div>
					</form>
					<a class="btn btn-outline-info" href="index.php">Já tem Cadastro? <strong>Faça login!</strong></a> <br> <br>
				</center>
			</div>
<?php
//verificar se clicou no botao
if(isset($_POST['nome']))
{
	$nome = addslashes($_POST['nome']); //addslashes evita codigos maliciosos.
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confsenha = addslashes( $_POST['confsenha']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confsenha))
	{
		$u->conectar("redeceia","localhost","root","");
		if ($u->msgErro=="") //conectado normalmente;
		{
			if ($senha == $confsenha)
			{
				if ($u->cadastrar($nome, $email, $senha))
				{
					?>
					<div class="alert alert-success" role="alert">
						Cadastrado com sucesso!
					</div>
					<?php
				}
				else
			 	{
					?>
					<div class="alert alert-danger" role="alert">
						Email já cadastrado, retorne e faça login.
					</div>
					<?php
			 	}
			}
			else
			{
				?>
				<div class="alert alert-danger" role="alert">
					Senhas não conferem!
				</div>
				<?php
			}
		}
		else
			{
				?>
				<div class="alert alert-danger" role="alert">
					<?php echo "Erro: ".$u->msgErro;?>
				</div>
				<?php
			}
		}
	else
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