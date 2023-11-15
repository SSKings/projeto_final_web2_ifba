<?php

include("VerificarAcesso.php");

if (empty($_GET['id'])) {
    echo ("É necessário informar um ID válido para editar um cliente.<br><br>");
    echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarClientes.php'\" />");
    die();
}

$id = $_GET["id"];

include 'DadosDeConexao.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("A conexão com o banco de dados falhou. Erro: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT id, nome, email, telefone FROM `cliente` WHERE id =?;");

$stmt->bind_param("i", $id);

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
       
        $linha = $resultado->fetch_assoc(); 

        $nome = $linha["nome"];
        $email = $linha["email"];
        $telefone = $linha["telefone"];

        echo ("<h2>Edição de Clientes</h2>");

        echo ("<br>");

        echo ("<form action=\"EditarCliente_.php\" method=\"post\">");
        
        echo ("ID: <input type=\"text\" name=\"id2\"  value=\"" . $id . "\" disabled><br><br>");

        echo ("<input type=\"hidden\" name=\"id\"  value=\"" . $id . "\">");
        
        echo ("Nome: <input type=\"text\" name=\"nome\"  value=\"" . $nome . "\"><br><br>");

        echo ("Email: <input type=\"text\" name=\"email\" value=\"" . $email . "\"><br><br>");

        echo ("Telefone: <input type=\"text\" name=\"telefone\" value=\"" . $telefone . "\"><br><br><br>");

        echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarContas.php'\" />");
        
        echo ("&nbsp;");
        echo ("<input type=\"submit\" value=\"Editar\">");
        echo ("</form>");
    
} else {
    echo ("É necessário informar um ID válido para editar uma cliente.<br><br>");
    echo ("<input type=\"button\" value=\"Voltar\" onclick=\"location.href='PesquisarClientes.php'\" />");
}

$stmt->close();
$conn->close();
