<?php
  	//Récupération des paramètres du formulaire 
  	$n1 = $_POST['n1']; 
  	$n2 = $_POST['n2'];
  	$ope = $_POST['ope']; 
  	//Affichage des paramètres 
	if ($ope == '+'){
		echo $n1 + $n2;
	}if ($ope == '-'){
		echo $n1 - $n2;
	}if ($ope == '*'){
		echo $n1 * $n2;
	}if ($ope == '/'){
		}if ($n2 != 0){
			echo $n1 / $n2;
		}else{
			echo "DIVISION PAR 0 IMPOSSIBLE";
		}
?>
