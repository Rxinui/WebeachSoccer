

<?PHP
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
	
	//Recuperation des données
	$nom = $_POST['nom'];
	$prenom = $_POST['pnom'];
	$addr = $_POST['addr'];
	$cp = $_POST['cp'];
	$ville = $_POST['ville'];
	$tel = $_POST['tel'];

	// requete
	//$requeteTest = "SELECT * FROM Contact WHERE Nom = '$nom' AND Prenom = '$prenom' AND Adresse = '$addr' AND CP = '$cp' AND Ville = '$ville' AND Tel = '$tel'";
	$reqVerif = $link->query("SELECT * FROM Contact WHERE Nom = '$nom' AND Prenom = '$prenom' AND Adresse = '$addr' AND CP = '$cp' AND Ville = '$ville' AND Tel = '$tel'");
	if ($reqVerif->rowCount() == 0){
		//Préparation de la requête
		$req = $link->prepare('INSERT INTO Contact (Nom,Prenom,Adresse,CP,Ville,Tel) 
								VALUES(:nom, :prenom, :addr, :cp, :ville, :tel)');
		///Exécution de la requête
		$req->execute(array('nom' => $nom,
							'prenom' => $prenom,
							'addr' => $addr,
							'cp' => $cp,
							'ville' => $ville,
							'tel' => $tel));
		echo "<h2>Contact ajouté avec succès</h2>";
	} else {
		echo "<h2>Contact existant</h2>";
	}
	
?>
