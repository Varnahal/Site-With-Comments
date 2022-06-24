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
        }else{
            header('Location:../index.php');
        } 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagens/V.png" type="image/x-icon">
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
        .pulo #memes{
            animation: pulo 0.8s ease-in-out;
        }
        @keyframes pulo {
            0%{
                top: 570px;
            }
            50%{
                top: 450px;
            }
            60%{
                top: 450px;
            }
            100%{
                top: 570px;
            }
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
            right: -100px;
            bottom: 0px;
        }
        .speed #cano{
            animation: cano1 1.5s infinite linear;
        }
        .speed1 #cano{
            animation: cano2 1.2s infinite linear;
        }
        .speed2 #cano{
            animation: cano3 1s infinite linear;
        }
        #nuvem{
            animation: cano 5s infinite linear;
            position: absolute;
            color: white;
            top: 200px;
            font-size: 55px;
        }
        #nuvem1{
            animation: cano 5.5s infinite linear;
            position: absolute;
            color: white;
            top: 250px;
            font-size: 55px;
        }
        @keyframes cano {
            0%{
                right:-100px;
            }
            100%{
                right:100%;
            }
        }
        @keyframes cano1 {
            0%{
                right:-100px;
            }
            100%{
                right:100%;
            }
        }
        @keyframes cano2 {
            0%{
                right:-100px;
            }
            100%{
                right:100%;
            } 
        }
        @keyframes cano3 {
            0%{
                right:-100px;
            }
            100%{
                right:100%;
            } 
        }
        #cont{
            position:absolute;
            font-size: 30px;
            color: white;
            left: 160px;
            margin: 10px;
        }
        #cont1{
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
        #inpnum{
            display: none;
        }
        #valorbd{
            display: none;
        }
        #numsub{
          display: none;
          font-size: 30px;
          background-color: #1937b5;
          border-radius: 10px;
          cursor: pointer;
        }
    </style>
</head>
<body onload="morreu()" id="body">
    <div>
        <button id='restart' onclick="restart()"><h1>Restart</h1></button>
        <button id="restart"><h1><?php echo '<a href="../Perfil-individual.php?id=',$dados["id"],'">Voltar</a>';?></h1></button>
    </div>
    <?php 
        $data = filter_input_array(INPUT_POST);
        if(isset($data)&&!empty($data)){
            $p->mandarleaderbd($dados['id'],$data['inpnum']);
        }
        $pontos = $p->buscarpontos($dados['id']);  
        
    ?>
    <script src="ex001.js"></script>
    <div class="caixa" onclick="pular()">
        <div id="cont1">Pontuação:</div>
        <div id="cont">0</div>
        <form action="" method="post">
            <input id="inpnum" name="inpnum" type="number">
            <input id='numsub' value="Enviar Pontuação" type="submit" name="leaderboard">
        </form>
        
        <div id="msg">Clique na tela ou no botão pular para pular</div>
        <div id="memes">mario</div>
        <div id="memes1">morreu</div>
        <div id="valorbd"><?php echo $pontos['pontos']?></div>
        <div id="cano">cano</div> 
        <div id="nuvem">nuvem</div> 
        <div id="nuvem1">nuvem</div> 
    </div>
    <button id='pulo' onclick="pular()"><h1>Pular</h1></button>
    <a href="../leaderboard.php"><button id='pulo'><h1>leaderboard </h1></button></a>
    
</body>
</html>