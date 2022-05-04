<?php
session_start();
ob_start();
require_once 'CLASSES/comentarios.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0">
    <link rel="stylesheet" href="CSS/comments.css">
    <title>Comentários</title>
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
            <form action="" method="post">
                <img src="imagens/perfil.png" alt="imagemperfil">
                <textarea name="text" id="text" cols="30" rows="10" maxlength="400" placeholder="Digita algun bagui aí"></textarea>
                <input type="submit" value="Publicar">
            </form>
            <?php
            
                $p = new comentarios('varnahal','localhost','root','');
                $dados = $p->buscarComentarios();
                //var_dump($dados);
                if(count($dados)>0){
                    foreach ($dados as $v) {
                        $data = new DateTime($v['dia']);
                        if(isset($_SESSION['id_master']))
                        {
                            $p = "<a href=''>Excluir</a>"; 
                        }else
                        {
                            if(!isset($_SESSION['id_master']) && isset($_SESSION['id_user']))
                            {
                                if($v['fk_id_usuraio'] == $_SESSION['id_user'])
                                {
                                   $p = "<a href=''>Excluir</a>"; 
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
                            <img src='imagens/perfil.png' alt=''>
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
</body>
</html>