<html> 
  <body> 
	<form method="post"> 
		Number 1 : <input type="int" value="<?php 
							if (!empty($_POST['n1']))
								echo $_POST['n1']
							?>"
						name="n1"><br /> 
		Nombre 2 : <input type="int" value="<?php 
							if (!empty($_POST['n2']))
								echo $_POST['n2']
							?>"
						name="n2"><br /> 
		Opérateurs : 
		  <input type="submit" value="+" name="ope"> 
		  <input type="submit" value="-" name="ope">
		  <input type="submit" value="*" name="ope">
		  <input type="submit" value="/" name="ope"><br />
		Respuesta : <input type="text" value ="<?php
  	//Récupération des paramètres du formulaire 
	if (!empty($_POST['ope'])){
	  	$n1 = $_POST['n1']; 
	  	$n2 = $_POST['n2'];
	  	$ope = $_POST['ope']; 
	  	//Affichage des paramètres 
		switch($ope){
		case '+':
			echo $n1 + $n2; break;
		case '-':
			echo $n1 - $n2; break;
		case '*':
			echo $n1 * $n2; break;
		case '/':
			if ($n2 != 0){
				echo $n1 / $n2; break;
			}else{
				echo "DIVISION PAR 0 IMPOSSIBLE"; break;
			}
		}
	}
	?>" name="res"><br /> 
	</form>
  </body> 
</html>

