<!DOCTYPE html>
<html>
<head>
  <title>Rede Ceia - Meus Relatórios</title>
  <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.js"></script>
  <body>
<?php
Class Celula {
	private $pdo;  /*criando variavel para usar nas funçoes*/
	public $msgErro="";
  	public function conectar($dbnome, $host, $usuario, $senha)
  	{
  	  global $pdo;
      global $msgErro;
  		try
  		{
  			$pdo = new PDO("mysql:dbname=".$dbnome.";host=".$host,$usuario,$senha);
  		} catch (PDOException $e) {
  			$msgErro = $e->getMessage(); /*pega a mensagem de erro do php e joga na variavel msegErro e mostra pro usuario.*/
  		}
  	}

    public function cadastrarCelula($nome, $area, $endereco, $igreja)
    {
      global $pdo;
      global $msgErro;
      
        $sql = $pdo->prepare("INSERT INTO tb_celula (nome, area, endereco, fk_igreja) VALUES (:n,:a,:e,:fk)");
        
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":a", $area);
        $sql->bindValue(":e", $endereco);
        $sql->bindValue(":fk", $igreja);
        $sql->execute();
        return true;

    }

    
    public function selectCelula($igreja)
    {
      global $pdo;
      global $msgErro;
      
        $sql = $pdo->prepare("SELECT * FROM tb_celula WHERE fk_igreja=:fk");
        $sql->bindValue(":fk", $igreja);
        $sql->execute();
        $dado = $sql->fetchAll();
       foreach ($dado as $celula) {
        echo ('<option value="'.$celula['idc'].'">'.$celula['nome'].'</option>');
      }
    }

}

?>


</body>
</html>