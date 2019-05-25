<?php
	//$age = array('Jean' => '20', 'Jacques' => '30', 'Pierre' => '25');
	//echo $age['Pierre'];
	$identite=array(
	"personne 1" => array("nom" => "dutronc", "prenom"=>"michel", "age"=>"30"),
	"personne 2" => array("nom" => "duroc", "prenom"=>"émilie", "age"=>"23"),
	"personne 3" => array("nom" => "dupersil", "prenom"=>"évelyne", "age"=>"36"));	
	foreach($identite as $tab){
		foreach($tab as $i=>$v){
			if ($i == 'nom')
				echo "$v <br />" ;		
		} 
	}

	for(int i = 
?>
