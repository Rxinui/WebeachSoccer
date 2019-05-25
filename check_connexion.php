<?PHP
    session_start();
    if (!empty($_POST['cookie_connexion'])){
        $vCookie = $_POST['cookie_connexion'];
        if (setcookie('cookie_connexion',$vCookie,time()+3600 ) == 0) {
            exit("ERREUR DE CREATION");
        }
    }
    // ecriture
    $_SESSION['id_connexion'] = 'admin';
    $_SESSION['mdp_connexion'] = 'e060c37cc92927255ff5e06a4051a88b08d27a3c4d1de8192c4c7cf78884ec94'; // $iutinfo en SHA256
    if ($_SESSION['id_connexion'] != $_POST['id_connexion']){
        echo "Votre login est incorrect";
        session_destroy();
        if (setcookie('cookie_connexion', '', time() - 100) == 0){
            exit('Impossible de supprimer le cookie de connexion');
        }
    }elseif($_SESSION['mdp_connexion'] != hash("sha256",$_POST['mdp_connexion']) ){
        echo "Votre mot de passe est incorrect";
        session_destroy();
        if (setcookie('cookie_connexion', '', time() - 100) == 0){
            exit('Impossible de supprimer le cookie de connexion');
        }
    }else{
        header("Location: afficher.php");
    }
    echo '<meta http-equiv="Refresh" content="3;index.php">';
?>