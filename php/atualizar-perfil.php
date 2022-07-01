<?php
  session_start();

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $idade = $_POST['idade'];
  $endereco = $_POST['endereco'];
  $cidade = $_POST['cidade'];
  $ID = $_SESSION['ID_user'];
  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);
  $dadosEncontrados = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Usuario WHERE ID = '$ID'"));

  if ($dadosEncontrados['ID'] === $_SESSION['ID_user']) {
    if (mysqli_query($con, "UPDATE Usuario SET nome = '$nome', email = '$email', idade = '$idade', endereco = '$endereco', cidade = '$cidade' WHERE ID = '$ID'")) {
      include_once "recarregar-sessoes.php";
      header("Location: ../profile.php");
    }
  }

  mysqli_close($con);
?>