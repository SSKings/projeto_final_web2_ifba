<!DOCTYPE HTML>
<html>

<body>

      <?php
      include 'VerificarAcesso.php';
      include 'Menu.php';
      ?>

      <h2>Pesquisa de Clientes</h2>
      <br>
      <form action="PesquisarClientes_.php" method="post">
            Id: <input type="text" name="id"><br><br>
            Nome: <input type="text" name="nome"><br><br>
            Email: <input type="text" name="email"><br><br>
            Telefone: <input type="text" name="telefone"><br><br>
            <input type='reset' value='Limpar'>&nbsp;
            <input type="submit" value="Pesquisar">
      </form>

</body>

</html>