<?php 
session_start();
ob_start();
?>
<?php
        if(isset($_SESSION['id_user']))
        {
            require_once '../CLASSES/usuarios.php';
            $p = new usuario('varnahal','localhost','root','');
            $dados = $p->buscardados($_SESSION['id_user']);
        }elseif(isset($_SESSION['id_master']))
        {
            require_once '../CLASSES/usuarios.php';
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
    <title>ex001</title>
    <style>
        body{
            display: flex;
            align-items: center;
            flex-direction: column;
            background-color: rgb(105, 105, 105);
        }
        div#memes{
            position: absolute;
            left: 80px;
            top: 570px;
            color: white;
            font-size: 30px;
        }
        div#memes1{
            position: absolute;
            left: 80px;
            top: 570px;
            color: white;
            font-size: 30px;
        }
        .caixa{
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 900px;
            height: 600px;
            background-color: rgb(52, 52, 52);
            overflow: hidden;
            position: relative;
        }
        div#cano{
            position: absolute;
            color: white;
            font-size: 25px;
            animation: cano 2s infinite linear;
            bottom: 0px;
        }
        @keyframes cano {
            from{
                right:-100px;
            }
            to{
                right:100%;
            }
            
        }
        #cont{
            font-size: 30px;
            color: white;
            margin: 10px;
        }
        #msg{
            margin-top: 100px;
            align-self: center;
            color: aliceblue;
        }
        .disclaimer{
            display:none;
        }
        
    </style>
</head>
<body onload="morreu()" id="body">
    <div>
        <button id='restart' onclick="restart()"><h1>Restart</h1></button>
        <button id="restart"><h1><?php echo '<a href="../Perfil-individual.php?id=',$dados["id"],'">Voltar</a>';?></h1></button>
    </div>
    
    <script src="ex001.js"></script>
    <div class="caixa" onclick="executar()">
        <div id="cont">Pontuação: 0</div>
        <div id="msg">Clique na tela ou no botão pular para pular</div>
        <div id="memes">mario</div>
        <div id="memes1">morreu</div>
        <div id="cano">cano</div> 
    </div>
    <button id='pulo' onclick="executar()"><h1>Pular</h1></button>
    
</body>
</html>