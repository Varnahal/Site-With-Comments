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
    <link rel="stylesheet" href="CSS/cadastrar.css">
        <link rel="shortcut icon" href="imagens/jose.ico" type="image/x-icon">

    <title>Cadastrar</title>
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
<div id="aaa">
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
        
        <h1>Cadastrar</h1>
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
</div>

    <footer>  
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://github.com/varnahal">Github</a></div>
    </footer>
</body>
</html>
