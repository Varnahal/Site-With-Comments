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
    <link rel="shortcut icon" href="imagens/V.png" type="image/x-icon">


    <title>Entrar</title>
</head>
<body id="corpo" class="corpo">
    <header>
        <nav>
        <ul id="barras">
            <?php
            if(isset($_SESSION['id_user']) || isset($_SESSION['id_master']))
            {
                echo '<li>
                    <a href="Perfil.php">
                    <img class="imgbl"src="imagens/',$dados["foto"],'" alt="">
                    </a>
                    </li>';

            }

            
            ?>
            
            <li>
                
                <div class="hbg" id="hbg" onclick="hbg()">
                    <div class = "hbg-1"></div>
                    <div class = "hbg-2"></div>
                    <div class = "hbg-3"></div>
                </div>
                
            </li>
            
        </ul>
    </nav>
    <div id="barra-lateral">
        <ul class="b-lateral">
        <a href="index.php"><li id="brr">Home</li></a>
            <?php
            if(isset($_SESSION['id_master']))
            {
                echo'<a href="dados.php"><li id="brr">Dados</li></a>';
            }
            ?>
            <a href="Comments.php"><li id="brr">Comentários</li></a>
            <?php
            if(isset($dados))
            {
                echo'<a href="Perfil.php"><li id="brr">Perfil</li></a>';
                echo'<a href="sair.php"><li id="brr">Sair</li></a>';
            }else
            {
                echo'<a href="entrar.php"><li id="brr">Entrar</li></a>';
            }
            
            ?>
        </ul>          
    </div>
    <script>
        function hbg(){
            var bod = document.getElementById('corpo');
            if(bod.classList.contains('corpo')){
                bod.classList.replace('corpo','x');
            }else if(bod.classList.contains('x')){
                bod.classList.replace('x','corpo');
            };
        }
    </script>
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