<?php
session_start();
ob_start();
require_once 'CLASSES/comentarios.php';
$p = new comentarios('varnahal','localhost','root','');
if(isset($_POST['editar_texto']))
{
    if(!empty($_POST['texted']))
    {
        
        $com = addslashes($_POST['texted']);
        if(isset($_GET['iduser'])){
            $id_com=$_GET['iduser'];
            echo($com);
            echo($id_com);
            if(isset($_SESSION['id_user']))
            {
                
                $p->editar($_SESSION['id_user'],$com,$id_com);
                header("Location:Comments.php");

            }
            elseif (isset($_SESSION['id_master'])) 
            {
                $p->editar($_SESSION['id_master'],$com,$id_com);
                header("Location:Comments.php");
            }
        }else{
            header("Location:Comments.php");
        }
        
    }else{
        header("Location:Comments.php");
    }
}else{
    header("Location:Comments.php");
}
?>