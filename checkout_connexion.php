<?php
    session_start();
    session_destroy();
     if (setcookie('cookie_connexion', '', time() - 100) == 0){
     	exit('Impossible de supprimer le cookie de connexion');
     }
    header("Location: index.php");
?>