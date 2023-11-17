<?php

include 'VerificarAcesso.php';

if ( !(isset($_POST['id'])) || (!isset($_POST['nome']) || (!isset($_POST['preco'])) || (!isset($_POST['estoque'])) 
|| (!isset($_POST['fornecedor'])) ))
{

  echo ("<h2>Acesso Direto à Página Não Permitido</h2>");
  echo ("É necessário realizar uma pesquisa antes de acessar esta página. <br><br>");
  echo ("Clique no botão abaixo para realizar uma pesquisa válida: <br><br>"); 
  echo ("<input type=\"button\" value=\"Pesquisar\" onclick=\"location.href='PesquisarProdutos.php'\" />");
  die();
}


include 'Menu.php';

echo "<h2>Lista de Produtos</h2>";

include 'DadosDeConexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

$id = $_POST["id"];
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$estoque = $_POST["estoque"];
$fornecedor_id = $_POST["fornecedor"];
$usuario_id = $_SESSION["usuario_id"];


if ($nome == '' && $id == '') {
$stmt = $conn->prepare("SELECT p.id, p.nome, p.preco, p.qtd_estoque, p.usuario_id, p.fornecedor_id, f.nome as fornecedor FROM  `produto` as p JOIN `fornecedor` as f ON p.fornecedor_id = f.id WHERE p.usuario_id = ?;");
  $stmt->bind_param("i", $usuario_id);
}

if ($nome != '' && $id == '') {
  $stmt = $conn->prepare("SELECT p.id, p.nome, p.preco, p.estoque, p.fornecedor_id, f.nome FROM `produto` p 
  INNER JOIN fornecedor f ON p.fornecedor_id = f.id WHERE p.nome = ? AND p.usuario_id = ?;");
  
  $stmt->bind_param("si", $nome, $usuario_id );
}

if ($nome == '' && $id != '') {
  $stmt = $conn->prepare("SELECT p.id, p.nome, p.preco, p.estoque, p.fornecedor_id, f.nome FROM `produto` p 
  INNER JOIN fornecedor f ON p.fornecedor_id = f.id WHERE p.id = ? AND p.usuario_id = ?;");
  
  $stmt->bind_param("ii", $id, $usuario_id);
}

if ($nome != '' && $id != '') {
  $stmt = $conn->prepare("SELECT p.id, p.nome, p.preco, p.estoque, p.fornecedor_id, f.nome FROM `produto` p 
  INNER JOIN `fornecedor` f ON p.fornecedor_id = f.id WHERE p.id = ? AND p.nome = ? AND p.usuario_id = ?;");
  
  $stmt->bind_param("isi", $id, $nome, $usuario_id);
}

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

  echo "<form action='ExcluirProdutos.php' method='post'>";

  echo ("<table border='1' style='border-collapse: collapse'>");

  echo("<tr>");

     echo("<th></th>");
     echo("<th>ID</th>");
     echo("<th>Nome</th>");
     echo("<th>Preço</th>");
     echo("<th>Estoque</th>");
     echo("<th>Fornecedor</th>");
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
    echo ($linha["preco"]);
    echo("</td>");

    echo("<td>");
    echo ($linha["qtd_estoque"]);
    echo("</td>");

    echo("<td>");
    echo ($linha["fornecedor"]);
    echo("<td>"); 

    echo ("<input type=\"button\" value=\"Editar\" onclick=\"location.href='EditarProduto.php?id=" . $linha["id"] . "'\" />");
    echo("</td>");
    
    echo("</tr>");

  }

  echo ("</table>");

  echo "<br>";

  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarProdutos.php'\" />");

  echo ("&nbsp;");

  echo "<input type='submit' onclick='return confirm(\"Deseja realmente excluir o(s) cliente(s) selecionado(s)?\")' value='Excluir'>";

  echo "</form>";
} else {
  echo "Sem registros de produto no sistema.<br><br>";

  echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarProdutos.php'\" />");
}



$stmt->close();
$conn->close();
