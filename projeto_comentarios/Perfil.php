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
        }else
        {
            header("Location:index.php");
        }
        $p = new usuario('varnahal','localhost','root','');
        
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Perfil.css">
    <title>Document</title>
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

if(isset($_POST['btn_salvar'])){
   $dados_user = filter_input_array(INPUT_POST);
   // var_dump($dados_user);
    if(!empty($dados_user['nome'])){
        if(isset($_SESSION['id_user'])){
            if($p->MudarInfoNome($_SESSION['id_user'],$dados_user['nome'])){
                $_SESSION['msg-p'] = "alterado com sucesso";
            }else{
                $_SESSION['msg'] = "não foi possivel alterar";
            }

        }elseif(isset($_SESSION['id_master'])){
            if($p->MudarInfoNome($_SESSION['id_master'],$dados_user['nome'])){
                $_SESSION['msg-p'] = "alterado com sucesso";
            }else{
                $_SESSION['msg'] = "não foi possivel alterar";
            }
        }
        
    }
    if(!empty($dados_user['senha'])){
        if(isset($_SESSION['id_user'])){
            if($p->MudarInfoSenha($_SESSION['id_user'],$dados_user['senha'])){
                $_SESSION['msg-p'] = "alterado com sucesso";
            }else{
                $_SESSION['msg'] = "não foi possivel alterar";
            }

        }elseif(isset($_SESSION['id_master'])){
            if($p->MudarInfoSenha($_SESSION['id_master'],$dados_user['senha'])){
                $_SESSION['msg-p'] = "alterado com sucesso";
            }else{
                $_SESSION['msg'] = "não foi possivel alterar";
            }
        }
    }
    if(isset($_FILES['foto'])){
       if(!empty($_FILES['foto']['name'])){
        var_dump($_FILES['foto']);
        if($_FILES['foto']['type'] == 'image/png'){
            $nome_foto = md5($_FILES['foto']['name']. rand(1,999)).'.png';
        }else
        {
            $nome_foto = md5($_FILES['foto']['name']. rand(1,999)).'.png' ;
        }
        move_uploaded_file($_FILES['foto']['tmp_name'],'imagens/'.$nome_foto);
        if(isset($_SESSION['id_user'])){
            if($p->MudarInfoFoto($_SESSION['id_user'],$nome_foto)){
                $_SESSION['msg-p'] = "alterado com sucesso";
            }
            else{
                $_SESSION['msg'] = "não foi possivel alterar";
            }
        }elseif(isset($_SESSION['id_master'])){
            if($p->MudarInfoFoto($_SESSION['id_master'],$nome_foto)){
                $_SESSION['msg-p'] = "alterado com sucesso";
            }
            else{
                $_SESSION['msg'] = "não foi possivel alterar";
            }
        }
        
    } 
    }
}
    


?>
<section>
<div id="antigo">
    <h2>Info Antiga</h2>
    <?php
    if(isset($_SESSION['id_user'])){
        $data = $p->buscardados($_SESSION['id_user']);
    }elseif(isset($_SESSION['id_master'])){
        $data = $p->buscardados($_SESSION['id_master']);
    }
    //var_dump($data);
    
echo '<h1 id=an>Foto: </h1><img src="imagens/'.$data['foto'].'" alt="">';
echo'<h1 id=an>Nome:'.$data['nome'].'</h1>';
echo'<h1 id=an>Senha:Segredo hihihihiihihi</h1>';
?>
</div>
    
    <form action="" method="post" enctype="multipart/form-data">
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
        
        <h2><?php echo $dados['nome']?></h2>
        <h2>insira suas novas informações</h2>
        <label for="">FOTO DE PERFIL:</label>
        <input type="file" name="foto" id="foto">
        <label for="nome">NOME:</label>
        <input type="text" name="nome" id="nome" maxlength="220">
        <label for="senha">SENHA:</label>
        <input type="password" name="senha" id="senha" maxlength="220">
        <input type="submit" value="Salvar" name="btn_salvar">
    </form> 
</section>


    <footer>  
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://www.facebook.com/daniel.marcelinodelima.79">Facebook</a></div>
    </footer>
    
</body>
</html>
