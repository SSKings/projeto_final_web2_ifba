<?php

include 'VerificarAcesso.php';

echo "<h2>Edição de Cliente</h2>";

if (empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['telefone'])) {
  echo ("Os campos 'id', 'Nome', 'Email' e 'Telefone' são Obrigatórios.<br><br>");
  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarClientes.php'\" />");
  die();
}

$id = $_POST["id"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$usuario_id = $_SESSION["usuario_id"];

include 'DadosDeConexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE `cliente` SET `nome`=?, `email`=?, `telefone`=? WHERE `id`=? AND usuario_id = ?;");

$stmt->bind_param("sssii", $nome, $email, $telefone, $id, $usuario_id);

if ($stmt->execute() === TRUE) {
  echo "Cliente " . $id . " editado com sucesso!<br><br>";
} else {
  echo "Erro ao tentar editar um cliente: " . $conn->error . "<br><br>";
}

echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarClientes.php'\" />");

$stmt->close();
$conn->close();
