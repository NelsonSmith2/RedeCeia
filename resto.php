<?php
	$conexao = new PDO("mysql:dbname=redeceia;host=localhost","root","");

function retorna_celula($celula,$conexao){
	$captaCelula = $conexao->prepare("SELECT * FROM tb_celula WHERE idc='$celula'");
	$captaCelula->execute();
	$dado = $captaCelula->fetchAll();

	$nome_celula = $dado['nome'];

	json_encode($nome_celula);
}


if(isset($_GET['celula'])){
	echo retorna_celula($_GET['celula'], $conexao)
}

$captaCelula = $conexao->prepare("SELECT * FROM tb_celula WHERE idc='".$_POST['id']."'");
$captaCelula->execute();

	$dado = $captaCelula->fetchAll();
    echo('<input type="text" class="form-control" name="nome" value="'.$celula['nome'].'">');
?>












<script type="text/javascript">
	$(document).ready(function(){
		$("#celula").on("change", function(){
			//var idCelula = $("#celula").val();
			var $nome_celula = $("input[name='nome']");

			$.getJSON('capta_celula.php',{
				celula: $ (this).val()
			}, function(json){
				$nome_celula.val(json.nome_celula);
			});

		});
	});
</script>










<?php
	$conexao = new PDO("mysql:dbname=redeceia;host=localhost","root","");

$captaCelula = $conexao->prepare("SELECT * FROM tb_celula WHERE idc='".$_POST['id']."'");
$captaCelula->execute();

	$dado = $captaCelula->fetchAll();
    		echo('<input type="text" class="form-control" name="nome" value="'.$dado['nome'].'" readonly>');

?>





$("#celula").on("change", function(){
			var idCelula = $("#celula").val();

			$.ajax({
				url: 'capta_celula.php',
				type: 'POST',
				data: {id:idCelula},
				beforeSend: function(){
					$("#nome").html("Carregando...");
				},
				success: function(data){
					$("#nome").html({data});
				},
				error: function(data){
					$("#nome").html("Houve um error ao carregar");
				}

			});

		});
		