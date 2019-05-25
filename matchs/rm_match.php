<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Confirmation</title>
		<?php
		include 'header_bootstrap.html';
		?>
	</head>
	<body>
<?PHP
	require_once '../sgbd_login.php';
    $id_matchs = $_POST['id_modal'];
    $req = $link->prepare('DELETE FROM matchs WHERE id_matchs=:id_matchs');
    $req->execute(array('id_matchs' => $id_matchs));
    header("Location: ../afficher.php");
?>
	</body>
</html>

