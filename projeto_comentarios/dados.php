<?php
session_start();
ob_start();

if(!isset($_SESSION['id_master']))
{
    header('Location:index.php');
    
}
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
    <link rel="stylesheet" href="CSS/dados.css">
    <link rel="shortcut icon" href="imagens/V.png" type="image/x-icon">

    <title>Dados de Pessoas</title>
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
    <table>
        
        <tr id="titulo">
            <td>ID</td>
            <td>NOME</td>
            <td>EMAIL</td>
            <td>COMENTÁRIOS</td>
        </tr>
        <?php 
        require_once 'CLASSES/usuarios.php';

            $p = new usuario('varnahal','localhost','root','');
            $dados = $p->buscarusuarios();
            //var_dump($dados);
            if(count($dados)> 0)
            {
                foreach ($dados as $v) {
                    echo"<tr>";
                    echo "<td>".$v['id']."</td>";
                    echo "<td>".$v['nome']."</td>";
                    echo "<td>".$v['email']."</td>";
                    echo "<td>".$v['quantidade']."</td>";
                    echo"</tr>";

                }
            }else
            echo"<h1>Sem dados por aqui</h1>";
                

        ?>
    </table>
    <footer>  
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://github.com/varnahal">Github</a></div>
    </footer>
</body>
</html>