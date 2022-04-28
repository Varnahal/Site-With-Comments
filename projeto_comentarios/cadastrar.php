<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastrar.css">
    <title>Cadastrar</title>
</head>
<body>
<form action="" method="post">
        <h1>Cadastre-se</h1>
        <label for="nome">NOME</label>
        <input type="text" name="nome" id="nome">
        <label for="email">E-MAIL</label>
        <input type="email" name="email" id="email">
        <label for="senha">SENHA</label>
        <input type="password" name="senha" id="senha">
        <label for="confsenha">CONFIRMAR SENHA</label>
        <input type="password" name="confsenha" id="confsenha">
        <input type="submit" value="Cadastrar">
        
        <a href="entrar.php">já é cadastrado? Faça login</a>
    </form> 
</body>
</html>