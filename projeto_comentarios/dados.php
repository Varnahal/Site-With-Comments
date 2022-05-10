<?php
session_start();
ob_start();

if(!isset($_SESSION['id_master']))
{
    header('Location:index.php');
    
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dados.css">
    <link rel="shortcut icon" href="imagens/jose.ico" type="image/x-icon">

    <title>Dados de Pessoas</title>
</head>
<body>
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
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://www.facebook.com/daniel.marcelinodelima.79">Facebook</a></div>
    </footer>
</body>
</html>