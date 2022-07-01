<?php
  session_start();
  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);

  $nome = $_POST['nome'];
  $usuario = $_POST['usuario'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $cpf = $_POST['CPF'];
  $idade = $_POST['idade'];
  $cidade = $_POST['cidade'];
  $endereco = $_POST['endereco'];
  $dadosEncontrados = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Usuario WHERE usuario = '$usuario' OR CPF = '$cpf'"));

  if ($usuario === $dadosEncontrados['usuario'] || $cpf == $dadosEncontrados['CPF']) {
    header("Location: ../sign-up.html");
  } else if ($usuario == "admin") {
    header("Location: ../sign-up.html");
  } else {
    if (mysqli_query($con, "INSERT INTO Usuario (nome, usuario, email, senha, CPF, endereco, cidade, idade) VALUES ('$nome', '$usuario', '$email', '$senha', '$cpf', '$endereco', '$cidade', '$idade')")) {
      header("Location: ../sign-in.html");
    } else {
      header("Location: ../sign-up.html");
    }
  }

  mysqli_close($con);
?>