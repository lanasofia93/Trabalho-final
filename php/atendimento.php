<?php
  session_start();

  $nomeRemetente = $_POST['nomeRemetente'];
  $emailRemetente = $_POST['emailRemetente'];
  $endereco = $_POST['endereco'];
  $cidade = $_POST['cidade'];
  $titulo = $_POST['titulo'];
  $descricao = $_POST['descricao'];
  $IDRemetente = $_SESSION['ID_user'];
  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);

  if (mysqli_query($con, "INSERT INTO Atendimento (ID_remetente, nome_remetente, email_remetente, titulo, descricao, endereco, cidade, data_abertura) VALUES ('$IDRemetente', '$nomeRemetente', '$emailRemetente', '$titulo', '$descricao', '$endereco', '$cidade', CURDATE())")) {
    header("Location: ../index.html");
  } else {
    header("Location: ../contact.php");
  }
?>