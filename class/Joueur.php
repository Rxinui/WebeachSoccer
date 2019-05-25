<?php

	class Joueur {
		//définition d'une constante
		private $id_joueur;
		private $numLicence;
		private $nom;
		private $prenom;
		private $dateNaissance;
		private $taille;
		private $statut;
		private $poste;
		private $photoPath;

		//définition d'une méthode constructeur
		public function __construct($id_joueur=NULL,$numLicence=NULL,$nom=NULL,$prenom=NULL,$dateNaissance=NULL,$taille=NULL,$poids=NULL,$statut=NULL,$poste=NULL,$photoPath=NULL) { 
			$this->id_joueur = $id_joueur;
			$this->numLicence = $numLicence;
			$this->nom = $nom; 
			$this->prenom = $prenom;
			$this->dateNaissance = $dateNaissance; 
			$this->taille = $taille;
			$this->poids = $poids;
			$this->statut= $statut;
			$this->poste= $poste;
			$this->photoPath = $photoPath; 
		}
		
		public function getId_joueur() {
			return $this->id_joueur;
		}

		public function getNom() {
			return $this->nom;
		}
		
		public function getPrenom() {
			return $this->prenom;
		}
		
		public function getPoste() {
			return $this->poste;
		}
		
		public function getPhotoPath() {
			return $this->photoPath;
		}
		
		public function getStatut() {
			return $this->statut;
		}
		
		public function getNumLicence() {
			return $this->numLicence;
		}
		
		public function getDateNaissance($format=false) {
			$newDateNaissance = new DateTime($this->dateNaissance);
			return ($format? $newDateNaissance->format('d/m/Y') : $this->dateNaissance);
		}
		
		public function getTaille() {
			return $this->taille;
		}
		
		public function getPoids() {
			return $this->poids;
		}
		
		public function form($action,$titre="Titre par défaut",$bPrimaire="Valider",$bSecondaire="Réinitialiser"){
			echo '<div class="container col">
			<h1 class="mt-3">'.$titre.'</h1><br />
			<form class="form-group" method="post" action="'.$action.'">
				<input type="hidden" name="id_joueur" value='.$this->id_joueur.'>
				<input class="form-control" type="int" name="num" pattern="[0-9]+"  value="'.$this->numLicence.'" placeholder="Numéro de licence" required><br />
				<div class="form-row">
					<div class="form-group col-md-6">
						<input class="form-control col" type="text" name="nom" pattern="[a-z A-z]+" value="'.$this->nom.'" placeholder="Nom" required>
					</div>
					<div class="form-group col-md-6">
						<input class="form-control col" type="text" name="prenom" pattern="[a-z A-z]+" value="'.$this->prenom.'" placeholder="Prenom" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<input class="form-control" type="date" name="ddn"  value="'.$this->dateNaissance.'" placeholder="Date de naissance AAAA-MM-JJ" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"> 
					</div>
					<div class="form-group col-md-3">
						<input class="form-control" type="int" name="taille" pattern="[0-9]{3}" value="'.$this->taille.'" placeholder="Taille en cm" >
					</div>
					<div class="form-group col-md-3">
						<input class="form-control" type="int" name="poids" pattern="[0-9]{2,3}" value="'.$this->poids.'" placeholder="Poids en kg" >
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<select class="form-control" name="poste">
							<option value="Ailier" '.($this->poste == "Ailier" ? "selected" : "" ).' >Ailier</option>
							<option value="Attaquant" '.($this->poste == "Attaquant" ? "selected" : "" ).'>Attaquant</option>
							<option value="Defenseur" '.($this->poste == "Defenseur" ? "selected" : "" ).'>Defenseur</option>
							<option value="Gardien" '.($this->poste == "Gardien" ? "selected" : "" ).'>Gardien</option>
							<option value="Pivot" '.($this->poste == "Pivot" ? "selected" : "" ).'>Pivot</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<select class="form-control" name="statut">
							<option value="Actif" '.($this->statut == "Actif" ? "selected" : "" ).' >Actif</option>
							<option value="Absent" '.($this->statut == "Absent" ? "selected" : "" ).'>Absent</option>
							<option value="Blesse" '.($this->statut == "Blesse" ? "selected" : "" ).'>Blessé</option>
							<option value="Suspendu" '.($this->statut == "Suspendu" ? "selected" : "" ).'>Suspendu</option>
						</select>
					</div>
				</div>
				<div class="form-row">
						<input type="file" value="'.$this->photoPath.'" class="form-control-file" accept="image/jpeg, image/jpg, image/png" name="photoName">	
				</div>
				<input class = "btn btn-primary mr-3 mb-3 mt-3" type="submit" value="'.$bPrimaire.'">
				<input class = "btn btn-secondary ml-1 mr-3 mb-3 mt-3" type="reset" value="'.$bSecondaire.'">				
			</form>
			</div>';
		}

		public function toCard($bPrimary="Éditer",$bSecondary="Effacer",$cPrimary="btn-primary",$cSecondary="btn-danger"){
			echo '<div class="card col-5r mt-3 ml-3 mr-3 mb-3" style="width: 15rem;">
					<img class="card-img-top" src="'.$this->photoPath.'" alt="Card image cap">
					<div class="card-body ">
						<h5 class="card-title">'.$this->nom.' '.$this->prenom.'</h5>
						<p class="card-text"> 
							<ul class="list-group list-group-flush">
								<li class="list-group-item">'.(isset($this->poste)?$this->poste:'N/A').'</li>
								<li class="list-group-item">'.(isset($this->statut)?$this->statut:'N/A').'</li>
								<li class="list-group-item">'.(isset($this->taille)?$this->taille:'N/A').' cm</li>
								<li class="list-group-item">'.(isset($this->poids)?$this->poids:'N/A').' kg</li>
								<li class="list-group-item">'.$this->getDateNaissance(true).'</li>
							</ul>
						</p>
						<div class="form-group">
							<form action="modifier.php" method="post">
								<input type="hidden" name="id_joueur" value='.$this->id_joueur.'>
								<input class="btn '.$cPrimary.' float-left" type="submit" name="editer" value="'.$bPrimary.'">
								<input class="btn '.$cSecondary.' float-right" type="submit" name="effacer" value="'.$bSecondary.'" formaction="joueurs/rm_conf_joueur.php" > 
							</form>
						</div>
					</div>
				</div>
					';
		}

		public function toCardTitulaire($cpt){
			echo '<div class="card col-5r mt-3 ml-3 mr-3 mb-3" style="width: 15rem;">
							<img class="card-img-top" src="'.$this->photoPath.'" alt="Card image cap">
							<div class="card-body ">
								<h5 class="card-title">'.$this->nom.' '.$this->prenom.'</h5>
								<p class="card-text">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">'.(isset($this->poste)?$this->poste:'N/A').'</li>
										<li class="list-group-item">'.(isset($this->taille)?$this->taille:'N/A').' cm</li>
										<li class="list-group-item">'.(isset($this->poids)?$this->poids:'N/A').' kg</li>
										<li class="list-group-item">'.$this->getDateNaissance(true).'</li>
									</ul>
								</p>
								<div class="form-group">
									<input type="hidden" name="id_joueur'.$cpt.'" value='.$this->id_joueur.'>
									<select class="form-control mb-3" name="titulaire'.$cpt.'">
										<option value="-1">Aucun</option>
										<option value="1">Titulaire</option>
										<option value="0">Remplaçant</option>
									</select>
									<div class="input-group mb-3">
										<input class="form-control" type="int" pattern="[0-5]" name="note'.$cpt.'" placeholder="Note sur 5">
										<div class="input-group-append">
											<span class="input-group-text">/5</span>
										</div>
									</div>
									<textarea class="form-control" rows="3" name="commentaire'.$cpt.'" placeholder="Ajouter un commentaire"></textarea>
								</div>
							</div>
						</div>
					';
		}
		

	}
?>
