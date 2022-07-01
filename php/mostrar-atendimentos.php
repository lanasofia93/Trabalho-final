<?php
  session_start();

  $IDUsuario = $_SESSION['ID_user'];
  include_once "carregar-banco-de-dados.php";
  $con = mysqli_connect($_SESSION['BDhost'], $_SESSION['BDuser'], $_SESSION['BDpassword'], $_SESSION['BDname']);
  $dadosEncontrados = mysqli_query($con, "SELECT * FROM Atendimento WHERE ID_remetente = '$IDUsuario'");

  while ($row = mysqli_fetch_array($dadosEncontrados)) {   
    $IDTecnico = $row['ID_tecnico'] ?? NULL;
    if ($IDTecnico) {
      $dadosTecnico = mysqli_fetch_assoc(mysqli_query($con, "SELECT nome, email FROM Tecnico WHERE matricula = '$IDTecnico'"));
      $_SESSION['nomeTecnico'] = $dadosTecnico['nome'];
      $_SESSION['emailTecnico'] = $dadosTecnico['email'];
    } else {
      $_SESSION['nomeTecnico'] = "Aguardando";
      $_SESSION['emailTecnico'] = "Aguardando";
    }

    $_SESSION['tituloAtendimento'] = $row['titulo'];
    $_SESSION['descricaoAtendimento'] = $row['descricao'];
    $_SESSION['data_abertura'] = $row['data_abertura'];
    $_SESSION['data_prazo'] = $row['data_prazo'] ?? NULL;
    $_SESSION['status'] = $row['status'];
    $_SESSION['enderecoAtendimento'] = $row['endereco'];
    $_SESSION['cidadeAtendimento'] = $row['cidade'];
    $_SESSION['IDTecnico'] = $row['ID_tecnico'] ?? NULL;
    $_SESSION['IDAtendimento'] = $row['ID'];
    $_SESSION['aceito'] = $row['aceito'];
    $_SESSION['concluido'] = $row['concluido'];

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
      <td>{$_SESSION['nomeTecnico']}</td>
      <td>{$_SESSION['emailTecnico']}</td>
    </tr>
    ";

    unset($_SESSION['IDTecnico']);
    unset($_SESSION['nomeTecnico']);
    unset($_SESSION['emailTecnico']);
    unset($_SESSION['data_prazo']);
  }
?>