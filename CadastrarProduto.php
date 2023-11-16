<!DOCTYPE HTML>
<html>

<body>

      <?php
        include 'VerificarAcesso.php';
      ?>

      <h2>Cadastro de Produto</h2>
      <br>
      <form action="CadastrarProduto_.php" method="post">
            Nome: <input type="text" name="nome"><br><br>
            Preço: <input type="text" name="preco"><br><br>
            Qtd em Estoque: <input type="text" name="estoque"><br><br>
            <div>
                <?php include 'PreencherComboFornecedor.php'; ?>

            </div>
            <br>
            <input type="button" value="Voltar" onclick="location.href='PesquisarProdutos.php'" />
            &nbsp;
            <input type="submit" value="Cadastrar">
      </form>

</body>

</html>