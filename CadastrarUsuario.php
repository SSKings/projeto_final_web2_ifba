<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro De Usuário</title>
</head>
<body>
      <h2>Cadastro de Usuário</h2>
      <br>
      <form action="CadastrarUsuario_.php" method="post">
            Login: <input type="text" name="login"><br><br>
            Senha: <input type="password" name="senha"><br><br>
            <input type="button" value="Login" onclick="location.href='Login.php'" />
            &nbsp;
            <input type="submit" value="Cadastrar">
      </form>
      
</body>
</html>