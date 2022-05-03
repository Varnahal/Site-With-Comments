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
        <tr>
            <td>1</td>
            <td>Daniel</td>
            <td>danielmarcelino91@gmail.com</td>
            <td>2</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Daniel</td>
            <td>danielmarceliqweqrqreqwrerno91@gmail.com</td>
            <td>2</td>
        </tr>
    </table>
</body>
</html>