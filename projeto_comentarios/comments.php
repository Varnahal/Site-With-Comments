<?php
session_start();
ob_start();
require_once 'CLASSES/comentarios.php';
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
        
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0">
    <link rel="stylesheet" href="CSS/comments.css">
    <link rel="shortcut icon" href="imagens/jose.ico" type="image/x-icon">

    <title>Comentários</title>
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
    </header>

    <div id="largura">
    <h1>Guia Definitivo Como Criar um Blog Incrível e Ganhar Dinheiro Com Ele</h1>
        <section id='conteudo1'>
            
            <img id='jose' src="imagens/jose.jpg" alt="José">
            <p class="text">É um fato há muito estabelecido que um leitor se distrairá com o conteúdo legível de uma página ao analisar seu layout. O ponto de usar o Lorem Ipsum é que ele tem uma distribuição de letras mais ou menos normal, em vez de usar 'Conteúdo aqui, conteúdo aqui'.</p>
            <p class="text">1. O ponto de usar o Lorem Ipsum</p>
            <p class="text">2. È que ele tem uma distribuição de letras</p>
            <p class="text">3. Lorem Ipsum é que ele tem uma distribuição</p>
            <p class="text">4. letras mais ou menos normal</p>
            <h2>Deixe seu comentário</h2>
            
                <?php
                if(isset($_SESSION['id_master']) || isset($_SESSION['id_user']))
                {
                   echo '<form action="publicar.php" method="post">
                <img src="imagens/'.$dados_user['foto'].'" alt="imagemperfil">
                <textarea name="text" id="text" cols="30" rows="10" maxlength="400" placeholder="Digita algun bagui aí"></textarea>';
                    echo '<input type="submit" value="Publicar" name = "enviar_texto">';
                }
                else
                {
                    
                    echo '<form action="entrar.php" method="post">
                <img src="imagens/perfil.png" alt="imagemperfil">
                <textarea name="text" id="text" cols="30" rows="10" maxlength="400" placeholder="Logar antes de comentar"></textarea>';
                    echo '<input type="submit" value="Logar para comentar" name = "logar_texto">';
                }
                
                ?>
                
            </form>
            <?php
            if(isset($_SESSION['e-msg']))
            {   echo"<p id='erro'>"; 
                echo $_SESSION['e-msg'];
                unset($_SESSION['e-msg']);
                echo"</p>";
            }
            
                $p = new comentarios('varnahal','localhost','root','');
                $dados = $p->buscarComentarios();
                //var_dump($dados);
                if(count($dados)>0){
                    foreach ($dados as $v) {
                        $data = new DateTime($v['dia']);
                        if(isset($_SESSION['id_master']))
                        {
                            $p = "<a href='excluir.php?id=".$v['id']."'>Excluir</a>"; 
                        }else
                        {
                            if(!isset($_SESSION['id_master']) && isset($_SESSION['id_user']))
                            {
                                if($v['fk_id_usuraio'] == $_SESSION['id_user'])
                                {
                                   $p = "<a href='excluir.php?id=".$v['id']."'>Excluir</a>"; 
                                }
                                else
                                {
                                    $p = "";

                                }
                            
                            }else
                            {
                                $p = "";
                            }
                        }
                        
                      echo"<div class='comment-area'>
                            <img src='imagens/{$v['foto']}' alt=''>
                            <h3>{$v['nome']}</h3>
                            <h4>{$v['horario']} {$data->format('d/m/Y')}&nbsp;".$p."</h4>
                            <p>{$v['comentario']}</p>
                            </div> ";
                    }
                }else
                {
                    echo'tem nada nn rala!';
                }
            ?>
            
        </section>
        <section id='conteudo2'>
            <div>
            <img src="imagens/img-lateral.jpg" alt="">
            <p>Analisar seu layout. O ponto de usar o Lorem Ipsum é que ele tem uma distribuição de letras mais ou menos normal, em vez de usar 'Conteúdo aqui, conteúdo aqui'.</p>
            </div>
        </section>
        <section id='conteudo3'>
            <div>
                <h5>Saiba mais sobre como fazer</h5>
                <p>Analisar seu layout. O ponto de usar o Lorem Ipsum é que ele tem uma distribuição de letras mais ou menos normal, em vez de usar 'Conteúdo aqui, conteúdo aqui'.</p>
            </div>
        </section>
        
    </div>
    <footer>  
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://www.facebook.com/daniel.marcelinodelima.79">Facebook</a></div>
    </footer>
</body>
</html>
