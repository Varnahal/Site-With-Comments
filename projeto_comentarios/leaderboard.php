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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/leaderboard.css">
    <link rel="shortcut icon" href="imagens/V.png" type="image/x-icon">
    <title>Leaderboard</title>
    <style>
        main{
            background-color: rgba(46, 46, 46, 1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        main table{
            border: 1px solid black;
        }
        main td{
            border: 1px solid black;
            font-size: 40px;
            text-align: center;
        }
    </style>
</head>
<body id="corpo" class="corpo">
<header>
        <nav>
        <ul id="barras">
            <?php
            if(isset($_SESSION['id_user']) || isset($_SESSION['id_master']))
            {
                echo '<li>
                <a href="Perfil-individual.php?id=',$dados["id"],'">
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
            <a href="jogo/jogo.php"><li id="brr">JOGO</li></a>
            <?php
            if(isset($dados))
            {
                echo'<a href="Perfil-individual.php?id=',$dados["id"],'"><li id="brr">Perfil</li></a>';
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
    <main>
    <?php
    require_once 'CLASSES/usuarios.php';
    $p = new usuario('varnahal','localhost','root','');
    $data = $p->leaderboard();
    echo '<table>';
    ?>
    <tr>
        <td>Posição</td>
        <td>Nome</td>
        <td>Pontos</td>
    </tr>
    <?php
    for ($i=0; $i < count($data) ; $i++) { 
        echo'<tr>';
        for ($c=0; $c < 1; $c++) { 
            echo '<td>',$i+1,'°</td>';
            echo '<td>',$data[$i]['nome'],'</td>';
            echo '<td>',$data[$i]['pontos'],'</td>';
        }
        echo'</tr>';
    }
    echo '</table>';
    ?>
    </main>
</body>
</html>