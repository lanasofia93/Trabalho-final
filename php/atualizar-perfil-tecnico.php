<?php
  session_start();

  $nome = $_POST['nomeTecnico'];
  $email = $_POST['emailTecnico'];
  $formacao = $_POST['formacaoTecnico'];
  $idade = $_POST['idadeTecnico'];
  $endereco = $_POST['enderecoTecnico'];
  $cidade = $_POST['cidadeTecnico'];
  $IDTecnico = $_SESSION['IDTecnico'];
  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);
  $dadosEncontrados = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Tecnico WHERE matricula = '$IDTecnico'"));

  if ($dadosEncontrados['matricula'] === $_SESSION['IDTecnico']) {
    if (mysqli_query($con, "UPDATE Tecnico SET nome = '$nome', formacao = '$formacao', email = '$email', idade = '$idade', endereco = '$endereco', cidade = '$cidade' WHERE matricula = '$IDTecnico'")) {
      include_once "recarregar-sessoes.php";
      header("Location: ../app-profile.php");
    }
  }

  mysqli_close($con);
?>