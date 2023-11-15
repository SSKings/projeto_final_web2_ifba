<?php

include 'VerificarAcesso.php';

session_start();

echo "<h2>Cadastro de Fornecedor</h2>";

if (empty($_POST['nome']) || empty($_POST['endereco']) || empty($_POST['email']) || empty($_POST['telefone'])) {
  echo ("Os campos 'Nome', 'Email' e 'Telefone' são Obrigatórios.<br><br>");
  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='CadastrarCliente.php'\" />");
  die();
}

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

$stmt = $conn->prepare("INSERT INTO `fornecedor` (`nome`, `endereco`, `email`, `telefone`, `usuario_id`) VALUES (?, ?, ?, ?, ?);");

$stmt->bind_param("ssssi", $nome, $endereco, $email, $telefone, $usuario_id);

if ($stmt->execute() === TRUE) {
  $idGeradoPeloInsert = $conn->insert_id;
  echo "Fornecedor   cadastrado com sucesso! <br> Número de ID gerado no cadastro foi: " . $idGeradoPeloInsert . ".<br><br>";
} else {
  echo "Erro ao tentar cadastrar um novo Fornecedor: " . $conn->error . "<br><br>";
}

echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarFornecedores.php'\" />");

$stmt->close();
$conn->close();
