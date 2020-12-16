<?php
 $conexao = new PDO("mysql:dbname=redeceia;host=localhost","root","");

$sql = $conexao->prepare("SELECT * FROM tb_celula WHERE idc=:id");
$sql->bindValue(":id", $_GET['idCelula']);
$sql->execute();

	$dado = $sql->fetchAll();
	/*print_r($dado);*/
    		//echo('<input type="text" class="form-control" name="nome" value="'.$dado[0]['nome'].'" readonly>');
				echo(json_encode($dado[0]));

?>
