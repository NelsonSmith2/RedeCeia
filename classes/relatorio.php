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
<?php
Class Relatorio {
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
  			$msgErro =
        $e->getMessage(); /*pega a mensagem de erro do php e joga na variavel msegErro e mostra pro usuario.*/
  		}
  	}

    public function cadastrarRelatorioCulto($adulto, $crianca, $visitante, $conversao, $conciliacao, $oracao_especial, $dizimo, $oferta, $outros, $data, $igreja)
    {
      global $pdo;
      global $msgErro;
      
        $sql = $pdo->prepare("INSERT INTO tb_relatorio_culto (adulto, crianca, visitante, conversao, conciliacao, oracao_especial, dizimo, oferta, outros, data, fk_igreja) VALUES (:a,:c,:v,:cv,:co,:o_r,:d,:o,:ou,:dt,:fk)");
        $sql->bindValue(":a", $adulto);
        $sql->bindValue(":c", $crianca);
        $sql->bindValue(":v", $visitante);
        $sql->bindValue(":cv", $conversao);
        $sql->bindValue(":co", $conciliacao);
        $sql->bindValue(":o_r", $oracao_especial);
        $sql->bindValue(":d", $dizimo);
        $sql->bindValue(":o", $oferta);
        $sql->bindValue(":ou", $outros);
        $sql->bindValue(":dt", $data);
        $sql->bindValue(":fk", $igreja);
        $sql->execute();
        return true;

    }

    public function editarRelatorioCulto($adulto, $crianca, $visitante, $conversao, $conciliacao, $oracao_especial, $dizimo, $oferta, $outros, $data, $idr)
    {
      global $pdo;
      global $msgErro;
      
        $sql = $pdo->prepare("UPDATE tb_relatorio_culto SET adulto = :a, crianca = :c, visitante = :v, conversao = :cv, conciliacao = :co, oracao_especial = :o_r, dizimo = :d, oferta = :o, outros = :ou, data = :dt WHERE idr = :id");
        $sql->bindValue(":a", $adulto);
        $sql->bindValue(":c", $crianca);
        $sql->bindValue(":v", $visitante);
        $sql->bindValue(":cv", $conversao);
        $sql->bindValue(":co", $conciliacao);
        $sql->bindValue(":o_r", $oracao_especial);
        $sql->bindValue(":d", $dizimo);
        $sql->bindValue(":o", $oferta);
        $sql->bindValue(":ou", $outros);
        $sql->bindValue(":dt", $data);
        $sql->bindValue(":id", $idr);
        $sql->execute();
        return true;

    }

    public function cadastrarRelatorioCelula($nome, $area, $endereco, $lider, $anfitriao, $adulto, $crianca, $data, $igreja, $celula)
    {
      global $pdo;
      global $msgErro;
      
        $sql = $pdo->prepare("INSERT INTO tb_relatorio_celula (nome, area, endereco, lider, anfitriao, adulto, crianca, data, fk_igreja, fk_celula) VALUES (:no,:ar,:en,:li,:an,:ad,:cr,:dt,:fk,:ck)");
        
        $sql->bindValue(":no", $nome);
        $sql->bindValue(":ar", $area);
        $sql->bindValue(":en", $endereco);
        $sql->bindValue(":li", $lider);
        $sql->bindValue(":an", $anfitriao);
        $sql->bindValue(":ad", $adulto);
        $sql->bindValue(":cr", $crianca);
        $sql->bindValue(":dt", $data);
        $sql->bindValue(":fk", $igreja);
        $sql->bindValue(":ck", $celula);
        $sql->execute();
        //$sql->debugDumpParams();
        return true;

    }

    public function vizualizarRelatorioCulto($igreja)
    {
      global $pdo;
      global $msgErro;
      
        $sql = $pdo->prepare("SELECT * FROM tb_relatorio_culto WHERE fk_igreja=:fk");
        $sql->bindValue(":fk", $igreja);
        $sql->execute();
        $dado = $sql->fetchAll();
        $n=1;
        foreach($dado as $relatorio) {
        echo ("
          <ul class='list-group'>

        <li class='list-group-item'> Formulário número: ".($n)."<br>
        <li class='list-group-item'> Data: ".$relatorio['data']
        ."<br>"."<li class='list-group-item'>Quantidade de adultos: ".$relatorio['adulto']
        ."<br>"."<li class='list-group-item'>Quantidade de crianças: ".$relatorio['crianca']
        ."<br>"."<li class='list-group-item'>Quantidade de visitantes: ".$relatorio['visitante']
        ."<br>"."<li class='list-group-item'>Quantidade de conversões: ".$relatorio['conversao']
        ."<br>"."<li class='list-group-item'>Quantidade de conciliações: ".$relatorio['conciliacao']
        ."<br>"."<li class='list-group-item'>Quantidade de orações especiais: ".$relatorio['oracao_especial']
        ."<br>"."<li class='list-group-item'>Valor de dizimo arrecadado: ".$relatorio['dizimo']
        ."<br>"."<li class='list-group-item'>Valor de ofertório arrecadado: ".$relatorio['oferta']
        ."<br>"."<li class='list-group-item'>Outras doações: ".$relatorio['outros'].
        "<li class='list-group-item'>
        <br>
        <form  method='POST'>
        <div class='form-group'>".
          '<button class="btn btn-dark" value="'.$relatorio['idr'].'" name="editar">Editar</button>
          <button class="btn btn-dark" value="'.$relatorio['idr'].'" name="excluir">Excluir</button>
        </div>

        </li>
        
        </form>
        </ul>
        <br><br><br>');
        $n++;
        }
    }

    public function vizualizarRelatorioCelula($igreja)
    {
      global $pdo;
      global $msgErro;
      
        $sql = $pdo->prepare("SELECT * FROM tb_relatorio_celula WHERE fk_igreja=:fk");
        $sql->bindValue(":fk", $igreja);
        $sql->execute();
        $dado = $sql->fetchAll();
        $n=1;
        foreach($dado as $relatorio) {
        echo ("
          <ul class='list-group'>
          
         <li class='list-group-item'>Formulário número: ".($n)."<br>
        <li class='list-group-item'>Data: ".$relatorio['data']
        ."<br>"."<li class='list-group-item'>Nome: ".$relatorio['nome']
        ."<br>"."<li class='list-group-item'>Área: ".$relatorio['area']
        ."<br>"."<li class='list-group-item'>Endereço: ".$relatorio['endereco']
        ."<br>"."<li class='list-group-item'>Líder: ".$relatorio['lider']
        ."<br>"."<li class='list-group-item'>Anfitrião: ".$relatorio['anfitriao']
        ."<br>"."<li class='list-group-item'>Quantidade de adultos: ".$relatorio['adulto']
        ."<br>"."<li class='list-group-item'>Quantidade crianças: ".$relatorio['crianca']."<br>".
        "<li class='list-group-item'>
        <div class='form-group'>
        <br>
        <input type='submit' class='btn btn-dark' value='Editar' class='editar'>
        <input type='submit' class='btn btn-dark' value='Excluir' class='excluir'>
        </li>
        </form>
        </ul>
        <br><br><br>");
        $n++;
        }
    }
}

?>


</body>
</html>