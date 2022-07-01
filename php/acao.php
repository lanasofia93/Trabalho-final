<?php
  session_start();
  $IDAtendimento = $_SESSION['IDAtendimento'];
  $IDTecnico = $_SESSION['IDTecnico'];

  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);

  $iniciado = (int)isset($_GET['change']);
  $concluido = (int)isset($_GET['complete']);

  if ($iniciado === 1) {
    // $data_prazo = mysqli_fetch_assoc(mysqli_query("SELECT ADDDATE(CURDATE(), INTERVAL 1 MONTH) AS dataPrazo FROM Atendimento WHERE ID = '$IDAtendimento'"));
    // $dataLimite = $data_prazo['dataPrazo'];
    $aceito = mysqli_query($con, "UPDATE Atendimento SET aceito = 1, ID_tecnico = '$IDTecnico', status = 'Em Andamento', data_prazo = ADDDATE(CURDATE(), INTERVAL 1 MONTH) WHERE ID = '$IDAtendimento'");
    unset($iniciado);
    header("Location: ../app-profile.php");
  } else if ($concluido === 1) {
    $aceito = mysqli_query($con, "UPDATE Atendimento SET concluido = 1, status = 'Concluído' WHERE ID = '$IDAtendimento'");
    unset($concluido);
    header("Location: ../app-profile.php");
  } else if ($iniciado === 0) {
    $aceito = mysqli_query($con, "UPDATE Atendimento SET aceito = 0, status = 'Aguardando' WHERE ID = '$IDAtendimento'");
    unset($iniciado);
    header("Location: ../app-profile.php");
  }
?>