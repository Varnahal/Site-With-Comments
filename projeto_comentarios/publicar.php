<?php
session_start();
ob_start();
require_once 'CLASSES/comentarios.php';
$p = new comentarios('varnahal','localhost','root','');
if(isset($_POST['enviar_texto']))
{
    if(!empty($_POST['text']))
    {
        $com = addslashes($_POST['text']);
        if(isset($_SESSION['id_user']))
        {
            $p->publicar($_SESSION['id_user'],$com);
            header("Location:comments.php");

        }
        elseif (isset($_SESSION['id_master'])) 
        {
            $p->publicar($_SESSION['id_master'],$com);
            header("Location:comments.php");
        }
    }
}
?>