<?php
    session_start();
    if ( empty($_COOKIE['cookie_connexion']) and (empty($_SESSION['id_connexion']) or empty($_SESSION['mdp_connexion']))) {
        session_destroy();
        header("Location: index.php");
    }
?>