<?php

include 'VerificarAcesso.php';

session_start();

echo "<h2>Cadastro de Produto</h2>";

if (empty($_POST['nome']) || empty($_POST['preco']) || empty($_POST['estoque']) || empty($_POST['fornecedor'])) {
  echo ("Os campos 'Nome', 'Preço', 'Estoque' e 'Fornecedor'  são Obrigatórios.<br><br>");
  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='CadastrarProduto.php'\" />");
  die();
}

$nome = $_POST["nome"];
$preco = $_POST["preco"];
$estoque = $_POST["estoque"];
$fornecedor_id = $_POST["fornecedor"];
$usuario_id = $_SESSION["usuario_id"];

include 'DadosDeConexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO `produto` (`nome`, `preco`, `qtd_estoque`, `fornecedor_id`, `usuario_id`) VALUES (?, ?, ?, ?, ?);");

$stmt->bind_param("sdiii", $nome, $preco, $estoque, $fornecedor_id, $usuario_id);

if ($stmt->execute() === TRUE) {
  $idGeradoPeloInsert = $conn->insert_id;
  echo "Produto   cadastrado com sucesso! <br> Número de ID gerado no cadastro foi: " . $idGeradoPeloInsert . ".<br><br>";
} else {
  echo "Erro ao tentar cadastrar um novo Produto: " . $conn->error . "<br><br>";
}

echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarProdutos.php'\" />");

$stmt->close();
$conn->close();
