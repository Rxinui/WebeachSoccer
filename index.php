<?php
    /*ON REND LA PAGE DE CONNEXION INACCESSIBLE PAR URL SI DEJA CONNECTEE*/
    session_start();
    if (isset($_SESSION['id_connexion']) and isset($_SESSION['mdp_connexion'])) {
        header("Location: afficher.php");
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Connexion</title>
        <?php
        include 'header_bootstrap.html';
        ?>
    </head>
    <?php
    if (empty($_COOKIE['cookie_connexion'])){
        echo '
        <form action="check_connexion.php" method="post">
            <div class="container border align-middle mt-lg-5 bg-light text-dark rounded">
                <div class="d-flex justify-content-center mt-3 mb-3">
                    <img src="rsc/beach-soccer.png" class="figure-img img-fluid rounded"  alt="..." width="180" height="180">
                </div>
                <h2 style="text-align:center">Connexion</h2>
                <div class="form-group">
                    <label for="id_connexion">Identifiant</label> 
                    <input type="text" class="form-control" id="id_connexion" name="id_connexion" aria-describedby="id_connexion" placeholder="Identifiant">
                </div>
                <div class="form-group">
                    <label for="mdp_connexion">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp_connexion" name="mdp_connexion" placeholder="Mot de passe">			
                </div>
                <div class="form-group form-check d-flex justify-content-between">
                    <input type="checkbox" class="form-check-input" id="cookie_connexion" name="cookie_connexion">
                    <label class="form" for="cookie_connexion">Resté connecté</label>
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </div>
            </div>
        </form>';
    }else{
        echo '<meta http-equiv="Refresh" content="0;URL=afficher.php">';
    }
    ?>
</html>