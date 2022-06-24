<?php
session_start();
ob_start();

?>
    <?php
        if(isset($_SESSION['id_user']))
        {
            require_once 'CLASSES/usuarios.php';
            $p = new usuario('varnahal','localhost','root','');
            $dados_user = $p->buscardados($_SESSION['id_user']);
        }elseif(isset($_SESSION['id_master']))
        {
            require_once 'CLASSES/usuarios.php';
            $p = new usuario('varnahal','localhost','root','');
            $dados_user = $p->buscardados($_SESSION['id_master']);
        }

            $id = filter_input(INPUT_GET,'id');
            if(empty($id)){
                header('Location:comments.php');
            }
            require_once 'CLASSES/usuarios.php';
            $p = new usuario('varnahal','localhost','root','');
            if($p->buscardados($id)){
                $dados = $p->buscardados($id);
            }else{
                header('Location:index.php');
            }
            
           
        
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/individual.css">
    <link rel="shortcut icon" href="imagens/V.png" type="image/x-icon">

    <title>Varnahal</title>
</head>
<body id="corpo" class="corpo">
    <header>
        <nav>
        <ul id="barras">
            <?php
            if(isset($_SESSION['id_user']) || isset($_SESSION['id_master']))
            {
                echo '<li>
                <a href="Perfil-individual.php?id=',$dados_user["id"],'">
                    <img class="imgbl"src="imagens/',$dados_user["foto"],'" alt="">
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
                echo'<a href="Perfil-individual.php?id=',$dados_user["id"],'"><li id="brr">Perfil</li></a>';
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
    <section class="banner">
        
    </section>
    <div class="fundo-banner"><img class="img-perfil" src="imagens/<?php echo $dados['foto'] ?>" alt=""></div>
    <section class="pagina">
        <div class="nome"><?php echo $dados['nome']?>
        </div>
                <div class="descricao">Descrição:<br><br><?php if(!empty($dados['descricao'])){echo $dados['descricao'];} ?>
                </div>
                <?php 
                if(isset($_SESSION['id_master'])){
                    if($id == $_SESSION['id_master']){
                        echo"<div class='se'>
            <a class='sair' href='sair.php'>Sair</a>
            <a class='editar' href='Perfil.php'>Editar Perfil</a>
        </div>";
        echo"<div class='jogo'><a href='jogo/jogo.php'>Jogar</a></div>";
                    }
                }elseif(isset($_SESSION['id_user'])){
                    if($id == $_SESSION['id_user']){
                        echo"<div class='se'>
            <a class='sair' href='sair.php'>Sair</a>
            <a class='editar' href='Perfil.php'>Editar Perfil</a>
        </div>";
        echo"<div class='jogo'><a href='jogo/jogo.php'>Jogar</a></div>";
                }
                
                }
                ?>
    </section>
    
    <footer>  
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://github.com/varnahal">Github</a></div>
    </footer>
</body>
</html>