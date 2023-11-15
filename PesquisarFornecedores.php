<!DOCTYPE HTML>
<html>

<body>

      <?php
      include 'VerificarAcesso.php';
      include 'Menu.php';
      ?>

      <h2>Pesquisa de Fornecedores</h2>
      <br>
      <form action="PesquisarFornecedores_.php" method="post">
            Id: <input type="text" name="id"><br><br>
            Nome: <input type="text" name="nome"><br><br>
            Endereço: <input type="text" name="endereco"><br><br>
            Email: <input type="text" name="email"><br><br>
            Telefone: <input type="text" name="telefone"><br><br>
            <input type='reset' value='Limpar'>&nbsp;
            <input type="submit" value="Pesquisar">
      </form>

</body>

</html>