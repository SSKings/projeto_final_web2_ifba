<!DOCTYPE HTML>
<html>

<body>

      <?php
      include 'VerificarAcesso.php';
      include 'Menu.php';
      ?>

      <h2>Pesquisa de Produtos</h2>
      <br>
      <form action="PesquisarProdutos_.php" method="post">
            Id: <input type="text" name="id"><br><br>
            Nome: <input type="text" name="nome"><br><br>
            Preço: <input type="text" name="preco"><br><br>
            Estoque: <input type="text" name="estoque"><br><br>

            <?php include 'PreencherComboFornecedor.php'; ?>
            <br><br>
            <input type='reset' value='Limpar'>&nbsp;
            <input type="submit" value="Pesquisar">
      </form>

</body>

</html>