<?php


echo "<h2>Cadastro de Usuário</h2>";

if (empty($_POST['login']) || empty($_POST['senha'])) {
  echo ("Os campos 'Login' e 'Senha'  são Obrigatórios.<br><br>");
  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='CadastrarUsuario.php'\" />");
  die();
}

$login = $_POST["login"];
$senha = $_POST["senha"];

include 'DadosDeConexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO `usuario` (`login`, `senha`) VALUES (?, ?);");

$stmt->bind_param("ss", $login, $senha);

if ($stmt->execute() === TRUE) {
  $idGeradoPeloInsert = $conn->insert_id;
  echo "Usuário cadastrado com sucesso! <br> Número de ID gerado no cadastro foi: " . $idGeradoPeloInsert . ".<br><br>";
} else {
  echo "Erro ao tentar cadastrar uma novo usuário: " . $conn->error . "<br><br>";
}

echo ("<input type=\"button\" value=\"Entrar\" onclick=\"location.href='Login.php'\" />");

$stmt->close();
$conn->close();
