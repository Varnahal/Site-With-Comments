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
    <link rel="stylesheet" href="css/entrar.css">

    <title>Entrar</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Comments.php">Comentários</a></li>
            <li><a href="entrar.php">Entrar</a></li>
        </ul>
    </nav>
    <?php
    $data = filter_input_array(INPUT_POST);
    if(isset($data['btn_entrar']))
    {
        $email = addslashes($data['email']);
        $senha = addslashes($data['senha']);
        if(!empty($email)&&!empty($senha)){
            require_once 'CLASSES/usuarios.php';
                $p = new usuario('varnahal','localhost','root','');
                
            if($p->entrar($email,$senha)){
                $_SESSION['msg-p'] = "Logado com sucesso";
                header("Location: index.php");
            }
            else
            {
                $_SESSION['msg'] = "Senha ou Email incorretos";
            }
            
        }
        else
        {
            $_SESSION['msg'] = "Preencha todos os campos";
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
        <h1>Acessar</h1>
        <img src="imagens/envelope.png" alt="email">
        <input type="email" name="email" id="email">
        <img src="imagens/cadeado.png" alt="senha">
        <input type="password" name="senha" id="senha">
        <input type="submit" value="Entrar" name="btn_entrar">
        <a href="cadastrar.php">Não é cadastrado?Registre-se agora</a>
    </form>
</body>
</html>