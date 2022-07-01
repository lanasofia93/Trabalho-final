<?php
  session_start();

  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);
  $dadosEncontrados = mysqli_query($con, "SELECT * FROM Atendimento ORDER BY aceito AND concluido DESC");

  while ($row = mysqli_fetch_array($dadosEncontrados)) {   

    $_SESSION['tituloAtendimento'] = $row['titulo'];
    $_SESSION['descricaoAtendimento'] = $row['descricao'];
    $_SESSION['data_abertura'] = $row['data_abertura'];
    $_SESSION['data_prazo'] = $row['data_prazo'] ?? NULL;
    $_SESSION['status'] = $row['status'];
    $_SESSION['enderecoAtendimento'] = $row['endereco'];
    $_SESSION['cidadeAtendimento'] = $row['cidade'];
    $_SESSION['nomeCliente'] = $row['nome_remetente'];
    $_SESSION['IDAtendimento'] = $row['ID'];
    $_SESSION['aceito'] = $row['aceito'];
    $_SESSION['concluido'] = $row['concluido'];

    $botaoAceitar = "<a href='./php/acao.php?change=1'><span class='badge badge-success'>Aceitar</span></a>";
    $botaoNegar = "<a href='./php/acao.php?change=0'><span class='badge badge-danger'>Negar</span></a>";
    $botaoConcluir = "<a href='./php/acao.php?complete=1'><span class='badge badge-success'>Concluir</span></a>";

    if ($_SESSION['aceito'] == 1) {
      $condicional = "badge-primary";
      if ($_SESSION['concluido'] == 1) {
        $condicional = "badge-success";
      }
    } else if ($_SESSION['aceito'] == 0) {
      $condicional = "badge-danger";
    }

    echo "
    <tr>
      <td>{$_SESSION['tituloAtendimento']}</td>
      <td>
        <span class='badge " . $condicional . "'>{$_SESSION['status']}</span>
      </td>
      <td>{$_SESSION['data_abertura']}</td>
      <td>{$_SESSION['data_prazo']}</td>
      <td>{$_SESSION['nomeCliente']}</td>
      <td>";

    if ($_SESSION['aceito'] == 0) {
      echo $botaoAceitar;
      echo $botaoNegar;
    } else if ($_SESSION['aceito'] == 1 && $_SESSION['concluido'] == 0) {
      echo $botaoConcluir;
    }

    echo "</td>
    </tr>
    ";
  }
?>