



	<html> 
	<body> 
	<h1>Formulaire de recherche de contact</h1>
	<form method="post"> 
		Nom: <input type="text" name="nom"><br /> 
		Prenom: <input type="text" name="prenom"><br /> 
		Adresse: <input type="text" name="addr"><br /> 
		CP: <input type="text" name="cp"><br /> 
		Ville: <input type="text" name="ville"><br /> 
		Telephone: <input type="text" name="tel"><br /> 
		<input type="submit" name="envoyer">
		<input type="reset" name="reset">
	</form>
	</body> 
	</html>
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
	$reqTmp = "SELECT * FROM Contact WHERE";
	$tab = array();
	//Recuperation des données
	if (!empty($_POST['nom'])){
		$nom = $_POST['nom'];
		$reqTmp .= " Nom = ?";
		array_push($tab,$nom);
	}if (!empty($_POST['prenom'])){
		$prenom = $_POST['prenom'];
		$reqTmp .= " Prenom = ?";
		array_push($tab,$prenom);
	}if (!empty($_POST['addr'])){
		$addr = $_POST['addr'];
		$reqTmp .= " Adresse = ?";
		array_push($tab,$addr);
	}if (!empty($_POST['cp'])){
		$cp = $_POST['cp'];
		$reqTmp .= " CP = ?";
		array_push($tab,$cp);
	}if (!empty($_POST['ville'])){
		$ville = $_POST['ville'];
		$reqTmp .= " Ville = ?";
		array_push($tab,$ville);
	}if (!empty($_POST['tel'])){
		$tel = $_POST['tel'];
		$reqTmp .= " Tel = ?";
		array_push($tab,$tel);
	}

	if (!empty($_POST['envoyer'])){
		echo "
		<table>
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Adresse</th>
			<th>CP</th>
			<th>Ville</th>
			<th>Telephone</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		  </tr>
		";
		  //TANT QU'IL RESTE UNE LIGNE RAJOUTER DES LIGNES DE TABLEAU
		$req = $link->prepare($reqTmp);
		$req->execute($tab);
		while ($data = $req->fetch()){
			echo "
			<tr>
			<td>$data[0]</td>
			<td>$data[1]</td>
			<td>$data[2]</td>
			<td>$data[3]</td>
			<td>$data[4]</td>
			<td>$data[5]</td>
			<td></td>
			<td></td>
			</tr>
			";
		}echo "</table>";
	}
	
?>
