<?php
    include 'MyElement.php';
	class Match {
		//définition d'une constante
		private $id_matchs;
		private $dateHeure;
		private $equipeAdverse;
		private $lieu;
		private $resultat;

		//définition d'une méthode constructeur
		public function __construct($id_matchs=NULL,$dateHeure=NULL,$equipeAdverse=NULL,$lieu=NULL,$resultat=NULL) { 
			$this->id_matchs = $id_matchs;
			$this->dateHeure = $dateHeure;
			$this->equipeAdverse = $equipeAdverse; 
			$this->lieu = $lieu;
			$this->resultat = $resultat; 
        }
        /*FORMAT RESULTAT
            'BUT EQUIPE - BUT ADVERSE'
        */
        public function getButEquipe(){
            return (int) strstr($this->resultat, '-', true);
        }

        public function getButAdverse(){
            return (int) substr(strstr($this->resultat, '-'),1);
		}

		public function getDateMatch($format=false){
        	$dateMatch = strstr($this->dateHeure, ' ', true);
            $newDateMatch = new DateTime($dateMatch);
            return ($format? $newDateMatch->format('d/m/Y') : $dateMatch);
		}

		public function getHeureMatch(){
			return substr(strstr($this->dateHeure, ' '),1);
		}

		/* verifier s'il existe une interface Comparator */
		public function compareTo(){
        	return $this->getButEquipe() - $this->getButAdverse();
		}

		public function form($action,$titre="Titre par défaut",$bPrimaire="Valider",$bSecondaire="Réinitialiser"){
			echo '<div class="container col">
            <h1 class="mt-3">'.$titre.'</h1><br />
			<form class="form-group" method="post" action="'.$action.'">
                <input type="hidden" name="id_matchs" value='.$this->id_matchs.'>
                <div class="form-row">
                	<div class="form-group col-md-6">
                		<input class="form-control" type="text" name="equipeAdverse"  value="'.$this->equipeAdverse.'" placeholder="Équipe adverse" required>
					</div>
                	<div class="form-group col-md-6">
                		<input class="form-control" type="text" name="lieu"  value="'.$this->lieu.'" placeholder="Lieu de la rencontre" required>
                	</div>
				</div>
                <div class="form-row">
                	<div class="form-group col-md-6">
                		<input class="form-control" type="date" name="dateM" value="'.$this->getDateMatch().'" placeholder="Date de la rencontre AAAA-MM-JJ" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                	</div>
                	<div class="form-group col-md-6">
                		<input class="form-control" type="time" name="heure" value="'.$this->getHeureMatch().'" placeholder="Heure de la rencontre HH:MM:SS" required pattern="[0-9]{2}:[0-9]{2}">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
                		<input type="int" class="form-control" pattern="[0-9]*" name="scoreEquipe" value="" placeholder="Notre score" required>
                	</div>
                	<div class="form-group col-md-6">	
                		<input type="int" class="form-control" pattern="[0-9]*" name="scoreAdverse" value="" placeholder="Score adverse" required>
					</div>
				</div>
				<input class = "btn btn-primary mr-3 mb-3 mt-3" type="submit" value="'.$bPrimaire.'">
				<input class = "btn btn-secondary ml-1 mr-3 mb-3 mt-3" type="reset" value="'.$bSecondaire.'">				
			</form>
			</div>';
		}
		
		public function toTable($cpt=NULL){
			if ($this->getButEquipe() > $this->getButAdverse()){
				$couleur = "table-success"; // gagne
			}elseif ($this->getButEquipe() < $this->getButAdverse()) {
				$couleur = "table-danger"; // perdu
			}else{
				$couleur = "table-warning"; // nul 
			}
			$body_confirmation = "Êtes-vous sûre de vouloir supprimer le match qui à eu lieu le ".$this->dateHeure." à ".$this->lieu." contre ".$this->equipeAdverse." ?";
			$body_modification = '
			<div class="form-row">
				<div class="form-group col-md-8">
					<input class="form-control" type="text" name="equipeAdverse" value='.$this->equipeAdverse.' required>
				</div>
				<div class="form-group col-md-2">
					<input class="form-control" type="int" name="scoreEquipe" value='.$this->getButEquipe().' required>
				</div>
				<div class="form-group col-md-2">
					<input class="form-control" type="int" name="scoreAdverse" value='.$this->getButAdverse().' required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<input class="form-control" type="date" name="dateM" value='.$this->getDateMatch().' required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
				</div>
				<div class="form-group col-md-6">
					<input class="form-control" type="time" name="heure" value='.$this->getHeureMatch().' required pattern="[0-9]{2}:[0-9]{2}">
				</div>
			</div>
			<input class="form-control" type="text" name="lieu" value='.$this->lieu.' required>
			';
			echo '
			<tr class="'.$couleur.'">
				<th scope="row">'.$cpt.'</th>
				<td>'.$this->equipeAdverse.'</td>
				<td>'.$this->resultat.'</td>
				<td>'.$this->getDateMatch(true).' '.$this->getHeureMatch().'</td>
				<td>'.$this->lieu.'</td> 
				<td align="center">
					<!-- modifier -->
					<button class="btn" data-toggle="modal" data-target="#modalModification'.$this->id_matchs.'" > 
						<span class="octicon octicon-clippy"></span> 
						<img src="css/octicons/svg/pencil.svg">
					</button>
					'.MyElement::popUpModification("matchs/edit_match.php",$this->id_matchs,"Modification",$body_modification).'
				</td>
				<td align="center">
					<!-- supprimer -->
					<button class="btn" data-toggle="modal" data-target="#modalConfirmation'.$this->id_matchs.'"> 
						<span class="octicon octicon-clippy"></span> 
						<img src="css/octicons/svg/trashcan.svg"> 
					</button>
					'.MyElement::popUpConfirmation("matchs/rm_match.php",$this->id_matchs,"Confirmation de la suppression",$body_confirmation).'
				</td>
			</tr>
				';
		}

	}
?>
