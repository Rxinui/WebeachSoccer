<?php
    // ID connexion
    $server = "localhost";
    $login = "lwr2466a";
    $mdp = "723Daj8z";
    $db = $login;
    //Connexion au serveur MySQL
    try {
        $link= new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>