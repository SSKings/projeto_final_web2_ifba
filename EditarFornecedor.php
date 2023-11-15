<?php

include("VerificarAcesso.php");

if (empty($_GET['id'])) {
    echo ("É necessário informar um ID válido para editar um fornecedor.<br><br>");
    echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarFornecedores.php'\" />");
    die();
}
session_start();
$usuario_id = $_SESSION["usuario_id"];

$id = $_GET["id"];

include 'DadosDeConexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT id, nome, endereco, email, telefone FROM `fornecedor` WHERE id = ? AND usuario_id = ?;");

$stmt->bind_param("ii", $id, $usuario_id);

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
       
        $linha = $resultado->fetch_assoc(); 

        $nome = $linha["nome"];
        $endereco = $linha["endereco"];
        $email = $linha["email"];
        $telefone = $linha["telefone"];

        echo ("<h2>Edição de Fornecedor</h2>");

        echo ("<br>");

        echo ("<form action=\"EditarFornecedor_.php\" method=\"post\">");
        
        echo ("ID: <input type=\"text\" name=\"id2\"  value=\"" . $id . "\" disabled><br><br>");

        echo ("<input type=\"hidden\" name=\"id\"  value=\"" . $id . "\">");
        
        echo ("Nome: <input type=\"text\" name=\"nome\"  value=\"" . $nome . "\"><br><br>");

        echo ("Nome: <input type=\"text\" name=\"endereco\"  value=\"" . $endereco . "\"><br><br>");

        echo ("Email: <input type=\"text\" name=\"email\" value=\"" . $email . "\"><br><br>");

        echo ("Telefone: <input type=\"text\" name=\"telefone\" value=\"" . $telefone . "\"><br><br><br>");

        echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarFornecedores.php'\" />");
        
        echo ("&nbsp;");
        echo ("<input type=\"submit\" value=\"Editar\">");
        echo ("</form>");
    
} else {
    echo ("É necessário informar um ID válido para editar uma cliente.<br><br>");
    echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarFornecedores.php'\" />");
}

$stmt->close();
$conn->close();
