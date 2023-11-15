<?php

include 'VerificarAcesso.php';

if ( !(isset($_POST['id'])) || (!isset($_POST['nome']) || (!isset($_POST['email'])) || (!isset($_POST['telefone'])) )) {
  echo ("<h2>Acesso Direto à Página Não Permitido</h2>");
  echo ("É necessário realizar uma pesquisa antes de acessar esta página. <br><br>");
  echo ("Clique no botão abaixo para realizar uma pesquisa válida: <br><br>"); 
  echo ("<input type=\"button\" value=\"Pesquisar\" onclick=\"location.href='PesquisarContas.php'\" />");
  die();
}

$id = $_POST["id"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$usuario_id = $_SESSION["usuario_id"];

include 'Menu.php';

echo "<h2>Lista de Clientes</h2>";

include 'DadosDeConexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

if ($nome == '' && $id == '') {
  $stmt = $conn->prepare("SELECT id, nome, email, telefone, usuario_id FROM `cliente` WHERE usuario_id = ?;");
  $stmt->bind_param("s", $usuario_id);
}

if ($nome != '' && $id == '') {
  $stmt = $conn->prepare("SELECT id, nome, email, telefone FROM `cliente` WHERE nome =? AND usuario_id = ?;");
  
  $stmt->bind_param("si", $nome, $usuario_id );
}

if ($nome == '' && $id != '') {
  $stmt = $conn->prepare("SELECT id, nome, email, telefone FROM `cliente` WHERE id =? AND usuario_id =?;");
  
  $stmt->bind_param("ii", $id, $usuario_id);
}

if ($nome != '' && $id != '') {
  $stmt = $conn->prepare("SELECT id, nome, email, telefone FROM `cliente` WHERE id =? AND nome=? AND usuario_id = ?;");
  
  $stmt->bind_param("isi", $id, $nome, $usuario_id);
}

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

  echo "<form action='ExcluirClientes.php' method='post'>";

  echo ("<table border='1' style='border-collapse: collapse'>");

  echo("<tr>");

     echo("<th></th>");
     echo("<th>ID</th>");
     echo("<th>Nome</th>");
     echo("<th>Email</th>");
     echo("<th>Telefone/th>");
     echo("<th></th>");

  echo("</tr>");

  while ($linha = $resultado->fetch_assoc()) {
    
    echo("<tr>");

    echo("<td>");
    echo "<input name='check_list[]' type='checkbox' value='" . $linha["id"] . "'>";
    echo("</td>");

    echo("<td>");
    echo ($linha["id"]);
    echo("</td>");

    echo("<td>");
    echo ($linha["nome"]);
    echo("</td>");

    echo("<td>");
    echo ($linha["email"]);
    echo("</td>");

    echo("<td>");
    echo ($linha["telefone"]);
    echo("<td>"); 

    echo ("<input type=\"button\" value=\"Editar\" onclick=\"location.href='EditarCliente.php?id=" . $linha["id"] . "'\" />");
    echo("</td>");
    
    echo("</tr>");

  }

  echo ("</table>");

  echo "<br>";

  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarClientes.php'\" />");

  echo ("&nbsp;");

  echo "<input type='submit' onclick='return confirm(\"Deseja realmente excluir o(s) cliente(s) selecionado(s)?\")' value='Excluir'>";

  echo "</form>";
} else {
  echo "Sem registros de cliente no sistema.<br><br>";

  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarClientes.php'\" />");
}



$stmt->close();
$conn->close();
