<?php 

include 'DadosDeConexao.php';


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

session_start();
$usuario_id = $_SESSION["usuario_id"];

$query = "SELECT id, nome FROM fornecedor WHERE usuario_id = $usuario_id ";
$resultado = $conn->query($query);

echo '<label for="fornecedor">Fornecedor:</label> ';
echo '<select name="fornecedor" id="fornecedor">';
while ($linha = $resultado->fetch_assoc()) {
    echo '<option value="' . $linha['id'] . '">' . $linha['nome'] . '</option>';
}
echo '</select>';