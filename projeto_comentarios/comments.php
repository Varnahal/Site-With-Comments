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
    <link rel="shortcut icon" href="imagens/V.png" type="image/x-icon">

    <title>Comentários</title>
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
                    <img class="imgbl"src="imagens/',$dados_user["foto"],'" alt="">
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
            if(isset($dados_user))
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

    <div id="largura">
    <h1>Comentários</h1>
        <section id='conteudo1'>
            <div id="img-com">
                <img id='jose' src="imagens/V.png" alt="José">
            </div>
            
            <p class="text">Está aqui é a area de comentários<?php if(!isset($dados_user)){echo ', para comentar é necessario estar logado';}?>, você pode comentar oque quiser aqui, pode ser uma recomendação para o site ou somente algo que queira comentar.</p>
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
                        if ($v['editado'] == 1) {
                            $editado = ' (editado) '; 
                        }else{
                            $editado = '';
                        }
                        if(isset($_SESSION['id_master']))
                        {
                            $p = "<a href='excluir.php?id=".$v['id']."'><u>Excluir</u></a>"; 
                            $ed = "<u>Editar</u>";
                            
                        }else
                        {
                            if(!isset($_SESSION['id_master']) && isset($_SESSION['id_user']))
                            {
                                if($v['fk_id_usuraio'] == $_SESSION['id_user'])
                                {
                                   $p = "<a href='excluir.php?id=".$v['id']."'><u>Excluir</u></a>";
                                   $ed = "<u>Editar</u>"; 
                                }
                                else
                                {
                                    $p = "";
                                    $ed = '';
                                }
                            
                            }else
                            {
                                $ed = '';
                                $p = "";
                            }
                        }
                        $idtxt = strval($v['id']);
                      echo"<div class='comment-area'>
                            <img src='imagens/{$v['foto']}' alt=''>
                            <h3>{$v['nome']} $editado</h3>
                            <h4>{$v['horario']} {$data->format('d/m/Y')}&nbsp;".$p.' '.'<span id="edit'.$v['id'].'" onclick="edit('. $idtxt.')">'.$ed.'</span>'."</h4>
                            <p id='pcom".$v['id']."'>{$v['comentario']}</p>
                            </div> ";
                    }
                }else
                {
                    echo'tem nada nn rala!';
                }
            ?>
            <script>
                function edit(id){
                    var idtxt = String(id);
                    var inutil = String('pcom'+idtxt);
                    
                    var pcom = document.getElementById(inutil);
                    console.log(inutil)
                    var edit = document.getElementById(`edit${idtxt}`);
                    var pcomtxt = String(pcom.innerHTML);
                    pcom.innerHTML = `<form action="editar.php?iduser=${idtxt}" method="post" id="formedit"><input type="text" value="${pcomtxt}" name="texted"><input id="salvar" type="submit" value="salvar" name="editar_texto"><h1 id="cancelar" onclick="cancelar('${pcomtxt}',${id})"><u>cancelar</u></h1></form>`;
                    edit.innerHTML ='';

                }
                function cancelar(txt,id){
                    console.log(String(txt));
                    console.log(String(id));
                    var idtxt = String(id);
                    var inutil = String('pcom'+idtxt);
                    var pcom = document.getElementById(inutil);
                    var edit = document.getElementById(`edit${idtxt}`);
                    pcom.innerHTML = txt;
                    edit.innerHTML ='<u>editar</u>';
                }
            </script>
            
        </section>
        <section id='conteudo2'>
            <div>
            
            <p>Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui.</p>
            </div>
        </section>
        <section id='conteudo3'>
            <div>
                <h5>Anuncie-Aqui</h5>
                <p>Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui Anuncie-Aqui.</p>
            </div>
        </section>
        
    </div>
    <footer>  
    <div><a href="https://www.instagram.com/varnahal0712/">Instagram</a> | <a href="https://github.com/varnahal">Github</a></div>
    </footer>
</body>
</html>