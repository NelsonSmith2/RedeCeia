<?php
  session_start();
  unset($_SESSION['id_igreja']); //destruindo a sessao
  header("location: index.php");//encaminhado para index
 ?>