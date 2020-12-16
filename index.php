<?php
// Conexão com o banco de dados
//include "db.php";
include "classes/usuario.php";
$u = new Usuario;
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
    <title>Rede Ceia - Login</title>
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
							<h1 style="text-shadow: 0.5px 0.5px black;color: Lime">Rede Ceia</h1> <img src="css/logo.png" width="38%">
							<h2 style="text-shadow: 0.5px 0.5px black; color: Lime">Seja bem-vindo!</h2>
							<form method="POST">
								<div class="form-group">
									<input type="email" class="form-control" placeholder="Email" name='email'>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Senha" name='senha'>
								</div>
								<div class="form-group">
									<input type="submit" value="Logar" class="btn btn-dark">
								</div>
									<a class="btn btn-info" href="cadastro.php">Ainda não é inscrito? <br><strong>Cadastre-se</strong></a> <br> <br>
							</form>
						</center>
					</div>

							<?php
				if(isset($_POST['email']))
				{
					$email = addslashes($_POST['email']);
					$senha = addslashes($_POST['senha']);
					//verificando se todos os campos nao estao vazios
					if(!empty($email) && !empty($senha))
					{
						$u->conectar("redeceia","localhost","root",""); //conectando ao banco
						if($u->msgErro=="") // caso a mensagem esteja vazia, login ok
						{
							if ($u->logar($email, $senha))
							{
								header("location:painel.php"); //encaminhado para proxima area apos verificar usuario e senha
							}
							else
							{
								?>
								<div class="alert alert-danger" role="alert">
									Email e/ou senha estão incorretos!
								</div>
								<?php
							}
						}
						else
						{
							?>
							<div class="alert alert-danger" role="alert">
								<?php echo "Erro: ".$u->msgErro; ?>
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
