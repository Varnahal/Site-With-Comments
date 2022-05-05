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
    <link rel="shortcut icon" href="imagens/jose.ico" type="image/x-icon">
    <title>Sistema de comentarios</title>
</head>
<body>
    <header>
        <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            if(isset($_SESSION['id_master']))
            {
                echo'<li><a href="dados.php">Dados</a></li>';
            }
            ?>
            <li><a href="Comments.php">Comentários</a></li>
            <?php
            if(isset($dados))
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
        if(isset($_SESSION['id_user']) || isset($_SESSION['id_master']))
        {   
            echo "<h2>";
            echo "Salve ";
            echo $dados['nome'];
            echo "</h2>";

        }
        

        ?>
    <div><h3>Conteúdo <b>TOP</b></h3>
</div>
    
</body>
</html>