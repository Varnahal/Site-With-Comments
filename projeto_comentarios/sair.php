<?php

session_start();
unset($_SESSION['id_master']);
unset($_SESSION['id_user']);
header('Location:entrar.php');

?>