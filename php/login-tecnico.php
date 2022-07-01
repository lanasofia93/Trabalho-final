<?php
  session_start();

  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);
  $dadosEncontrados = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Tecnico WHERE usuario = '$usuario'"));

  if ($usuario === $dadosEncontrados['usuario'] && $senha === $dadosEncontrados['senha']) {
    $_SESSION['logadoTecnico'] = True;
    $_SESSION['usuarioTecnico'] = $usuario;
    $_SESSION['nomeTecnico'] = $dadosEncontrados['nome'];
    $_SESSION['emailTecnico'] = $dadosEncontrados['email'];
    $_SESSION['idadeTecnico'] = $dadosEncontrados['idade'];
    $_SESSION['enderecoTecnico'] = $dadosEncontrados['endereco'];
    $_SESSION['cidadeTecnico'] = $dadosEncontrados['cidade'];
    $_SESSION['IDTecnico'] = $dadosEncontrados['matricula'];
    $_SESSION['formacaoTecnico'] = $dadosEncontrados['formacao'];
    header("Location: ../dashboard.php");
  } else {
    header("Location: ../sign-in-tecnico.html");
  }

  mysqli_close($con);
?>