<?php 
session_start();
ob_start();
if(isset($_POST['logar_texto']))
{
    $_SESSION['msg'] = "Faça login para comentar";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/entrar.css">
        <link rel="shortcut icon" href="imagens/jose.ico" type="image/x-icon">


    <title>Entrar</title>
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
                echo'<li><a href="Perfil.php">Perfil</a></li>';
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
    <div id='aaa'>
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
        <input type="email" name="email" id="email" autocomplete="email">
        <img src="imagens/cadeado.png" alt="senha">
        <input type="password" name="senha" id="senha">
        <input type="submit" value="Entrar" name="btn_entrar">
        <a href="cadastrar.php">Não é cadastrado?Registre-se agora</a>
    </form>
</div>    
    <footer>  
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://github.com/varnahal">Github</a></div>
    </footer>
</body>
</html>