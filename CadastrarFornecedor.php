<!DOCTYPE HTML>
<html>

<body>

      <?php
        include 'VerificarAcesso.php';
      ?>

      <h2>Cadastro de Fornecedor</h2>
      <br>
      <form action="CadastrarFornecedor_.php" method="post">
            Nome: <input type="text" name="nome"><br><br>
            Endereço: <input type="text" name="endereco"><br><br>
            Email: <input type="text" name="email"><br><br>
            Telefone: <input type="text" name="telefone"><br><br><br>
            <input type="button" value="Voltar" onclick="location.href='PesquisarFornecedores.php'" />
            &nbsp;
            <input type="submit" value="Cadastrar">
      </form>

</body>

</html>