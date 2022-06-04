<?php
session_start();
ob_start();
require_once 'CLASSES/comentarios.php';
$p = new comentarios('varnahal','localhost','root','');
if(isset($_GET['id'])){
    $id_com = addslashes($_GET['id']);
    if(isset($_SESSION['id_user']))
    {
        $p->excluir($id_com,$_SESSION['id_user']);  
    }elseif(isset($_SESSION['id_master']))
    {
        $p->excluir($id_com,$_SESSION['id_master']); 
    }
    header("Location:Comments.php");
}
?>