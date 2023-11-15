<?php

include 'VerificarAcesso.php';

echo "<h2>Exclusão de Fornecedores</h2>";

session_start();
$usuario_id = $_SESSION["usuario_id"];

if (empty($_POST['check_list'])) {
  echo ("Não foram selecionadas fornecedores a serem deletados.<br><br>");
} else {

  include 'DadosDeConexao.php';

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("DELETE FROM `fornecedor` WHERE id=? AND usuario_id = ?;");

  $sucessoDelete = TRUE;

  foreach ($_POST['check_list'] as $id) {

    $stmt->bind_param("ii", $id, $usuario_id);

    if (!($stmt->execute() === TRUE)) {

      echo "Erro ao tentar excluir o fornecedor " . $id . ": " . $conn->error;
      $sucessoDelete = FALSE;
    } else {
      echo "Cliente com ID " . $id . " apagada.<br>";
    }
  }

  $stmt->close();
  $conn->close();

  if ($sucessoDelete) {
    echo "<br>Fornecedores(s) apagado(s) com sucesso.<br><br>";
  } else {
    echo "Existe(m) Cliente(s) não apagado(s) com sucesso.<br><br>";
  }
}

echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarFornecedores.php'\" />");
