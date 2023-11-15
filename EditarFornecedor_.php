<?php

include 'VerificarAcesso.php';

echo "<h2>Edição de Fornecedor</h2>";

if (empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['endereco']) || empty($_POST['email']) 
    || empty($_POST['telefone'])) {

  echo ("Os campos 'id', 'Nome', 'Endereço', 'Email' e 'Telefone' são Obrigatórios.<br><br>");
  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarFornecedores.php'\" />");
  die();
}

session_start();

$id = $_POST["id"];
$nome = $_POST["nome"];
$endereco = $_POST["endereco"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$usuario_id = $_SESSION["usuario_id"];

include 'DadosDeConexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE `fornecedor` SET `nome`=?, `endereco`=?, `email`=?, `telefone`=? WHERE id = ? AND usuario_id=?;");

$stmt->bind_param("ssssii", $nome, $endereco, $email, $telefone, $id, $usuario_id);

if ($stmt->execute() === TRUE) {
  echo "Fornecedor " . $id . " editado com sucesso!<br><br>";
} else {
  echo "Erro ao tentar editar um Fornecedor: " . $conn->error . "<br><br>";
}

echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarFornecedores.php'\" />");

$stmt->close();
$conn->close();
