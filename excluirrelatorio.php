<?php
	$conexao = new PDO("mysql:dbname=redeceia;host=localhost","root","");
	$sql = $conexao->prepare("DELETE FROM tb_relatorio_culto WHERE idr=:id");
	        $sql->bindValue(":id",$_GET['idr']);
	        $sql->execute();       
if($sql){
	echo ("<script>
			location.href='visualizarrelatorioculto.php';
			alert('O relátório foi excluído com sucesso!');
		</script>");
}else{
	echo ("<script>
			alert('Não foi possível deletar o relatório');
			location.href='visualizarrelatorioculto.php';
		</script>");
}
?>