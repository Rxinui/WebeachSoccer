<?php
	function bisex($annee){
		if ($annee%4 != 0 or ($annee%100==0 and $annee%400 != 0) ){
			return "$annee n'est pas bissextile" ;	
		} return "$annee est bissextile" ;
	}
	
	echo "Nous sommes le  ".date("d/m/Y ")." il est ".date("H:i:s") ;
	$a = 	1996 ;
	echo "L'annee ".bisex($a) ;
?>
