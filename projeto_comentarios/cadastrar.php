<?php 
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastrar.css">
    <link rel="shortcut icon" href="imagens/jose.ico" type="image/x-icon">

    <title>Cadastrar</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Comments.php">Comentários</a></li>
            <?php
            if(isset($_SESSION['id_user']) || isset($_SESSION['id_master']))
            {
                echo'<li><a href="sair.php">Sair</a></li>';
            }else
            {
                echo'<li><a href="entrar.php">Entrar</a></li>';
            }
            
            ?>
        </ul>
    </nav>
</header>

    <?php 

    $data = filter_input_array(INPUT_POST);
   // var_dump($data);
    if(isset($data['btn_cadastro']))
    {
        $nome = addslashes($data['nome']);
        $email = addslashes($data['email']);
        $senha = addslashes($data['senha']);
        $confsenha = addslashes($data['confsenha']);
        if(!empty($nome) && !empty($email) &&!empty($senha) &&!empty($confsenha)){
            if($senha == $confsenha){
                require_once 'CLASSES/usuarios.php';
                $j = new usuario('varnahal','localhost','root','');
                if($j->cadastrar($nome,$email,$senha))
                {
                    $_SESSION['msg-p'] = "Usuario cadastrado com sucesso";
                } 
                else
                {
                    $_SESSION['msg'] = "Usuario já cadastrado";
                }
            }
            else
            {
                $_SESSION['msg'] = "Senhas não correspondem";
            }
            
        }
        else
        {
            $_SESSION['msg'] = "Erro preencha todas as colunas";
        }
        
    }
    
    
    
?>
<form action="" method="post">
        <?php
        if(isset($_SESSION['msg'])){
        echo "<p id='n'>".$_SESSION['msg']."</p>";
        unset($_SESSION['msg']);
        }elseif(isset($_SESSION['msg-p']))
        {
            echo "<p id='p'>".$_SESSION['msg-p']."</p>";
            unset($_SESSION['msg-p']);
        }
        ?>
        
        <h1>Cadastre-se</h1>
        <label for="nome">NOME</label>
        <input type="text" name="nome" id="nome" maxlength="220">
        <label for="email">E-MAIL</label>
        <input type="email" name="email" id="email" maxlength="220">
        <label for="senha">SENHA</label>
        <input type="password" name="senha" id="senha" maxlength="220">
        <label for="confsenha">CONFIRMAR SENHA</label>
        <input type="password" name="confsenha" id="confsenha">
        <input type="submit" value="Cadastrar" name="btn_cadastro">
       
        
        <a href="entrar.php">já é cadastrado? Faça login</a>
    </form> 
</body>
</html>
