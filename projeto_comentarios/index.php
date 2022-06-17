<?php
session_start();
ob_start();

?>
    <?php
        if(isset($_SESSION['id_user']))
        {
            require_once 'CLASSES/usuarios.php';
            $p = new usuario('varnahal','localhost','root','');
            $dados = $p->buscardados($_SESSION['id_user']);
        }elseif(isset($_SESSION['id_master']))
        {
            require_once 'CLASSES/usuarios.php';
            $p = new usuario('varnahal','localhost','root','');
            $dados = $p->buscardados($_SESSION['id_master']);
        }
        
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/estilo.css">
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
    <div id="conteudo">
        <div id="conteudo-conteiner">
        <h3><?php if(isset($dados)){
            echo $dados['nome'];
        }else{
            echo 'Varnahal';
        } ?></h3>
        <?php 
            if(isset($_SESSION['id_user']) || isset($_SESSION['id_master']))
            {
                echo '<p>Obrigado por acessar meu site, fique a vontade para olhar alguns dos meus <u><a href="#projetos">projetos</a></u> ou comentar na ala <a href="Comments.php "><u>comentários</u>.</a> Também pode mudar suas informações em <a href="Perfil.php "><u>Perfil</u>.</a> Vários atributos do site mudam caso você esteja logado, então explore</p>';
            }else{
               echo '<p>Olá vc está no meu site, fique a vontade para olhar alguns dos meus <u><a href="#projetos">projetos</a></u> ou comentar na ala <a href="Comments.php "><u>comentários</u> </a>, mas para isso terá que estar logado <a href="entrar.php"><u>Clique aqui</u> </a> para logar ou Clique na barra lateral em Entrar. Vários atributos do site mudam caso você esteja logado, então recomendo que <a href="entrar.php"><u>entre</u> </a></p>';
            }
        ?> 
        </div>
        
    </div>
    <section class="sobre">
        <div class="sobre-h1">
                <h1>Sobre mim</h1>
            </div>
        <div class="sobre-conteiner">
            
            <div class="texto-sobre">
                <p>
                   Olá meu nome é Varnahal tenho 17 anos, estudo Programação por meio de videos na internet, hoje em dia estou mais focado em desenvolvimento web ultilizando de HTML5, CSS3, JavaScript e PHP para fazer meus projetos e montar este site.<br>
                   Também planejo além de ano que vem fazer uma faculdade de engenharia da computação, tenho a vontade de até o final do ano começar a estudar outras linguagens que não tenham tanto aver com desenvolvimento web e mais pro lado da engenharia e AI.
                </p>
            </div>
        </div>
    </section>
    <div id="projetos">
        <h1 class="h1-pj">Principais projetos</h1>
        <div class="conteiner-pj">
            <ul class="ul-pj">
                <a href="https://github.com/Varnahal/Aulas-MVC-Miriam-TechCod" target="_blank"><li class="pj">Project mark I  <p>Projeto MVC desenvolvido assistindo as aulas de Miriam Techcod no YouTube</p></li></a>
                
                <a href="https://github.com/Varnahal/Projetinhos" target="_blank"><li class="pj">Project mark II  <p>Varios Projetos desenvolvidos assistindo pelo Youtube</p></li></a>
                
                <a href="https://github.com/Varnahal/Aulas-Javascript" target="_blank"><li class="pj">Project mark III  <p>Aulas de JavaScript com o Professor Gustavo Guanabara</p></li></a>
                
                <a href="https://github.com/varnahal" target="_blank"> <li class="mais">Mais Projetos no Github</li></a>
               
            </ul>
        </div>
            
    </div>
    <footer>  
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://github.com/varnahal">Github</a></div>
    </footer>
</body>
</html>
</body>
</html>