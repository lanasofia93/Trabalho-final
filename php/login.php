<?php
  session_start();

  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);
  $dadosEncontrados = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Usuario WHERE usuario = '$usuario'"));

  if ($usuario === $dadosEncontrados['usuario'] && $senha === $dadosEncontrados['senha']) {
    $_SESSION['logado'] = True;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nome'] = $dadosEncontrados['nome'];
    $_SESSION['email'] = $dadosEncontrados['email'];
    $_SESSION['idade'] = $dadosEncontrados['idade'];
    $_SESSION['endereco'] = $dadosEncontrados['endereco'];
    $_SESSION['cidade'] = $dadosEncontrados['cidade'];
    $_SESSION['ID_user'] = $dadosEncontrados['ID'];
    header("Location: ../contact.php");
  } else {
    header("Location: ../sign-in.html");
  }

  mysqli_close($con);
?>