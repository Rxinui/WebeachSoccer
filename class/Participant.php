<?php

	class Participant {

		/* 5 joueurs au maximum, dont l’un sera le gardien de but.  */
		/*  Remplacant : 3 min et 5 max */
		
		const NB_TITULAIRES = 5;
		const MIN_JOUEURS = 8;
		const MAX_JOUEURS = 10;
		const MIN_REMPLACANTS = 3;
		const MAX_REMPLACANTS = 5;
	
		private $joueur;
		private $matchs;
		private $titulaire; //Boolean
		private $note; // Integer [0;5]
		private $commentaire; // Text

		//définition d'une méthode constructeur
		public function __construct($joueur,$matchs,$titulaire=NULL,$note=NULL,$commentaire=NULL) { 
			$this->joueur = $joueur;
			$this->matchs = $matchs;
			$this->titulaire = $titulaire; 
			$this->note = $note;
			$this->commentaire = $commentaire; 
        }
		
		public function toCard($cpt){
			echo '<div class="card '.($this->titulaire == 1 ? 'border-primary' : 'border-warning').' col-5r mt-3 ml-3 mr-3 mb-3" style="width: 15rem;">
							<img class="card-img-top" src="'.$this->joueur->getPhotoPath().'" alt="Card image cap">
							<div class="card-body ">
								<h5 class="card-title">'.$this->joueur->getNom().' '.$this->joueur->getPrenom().'</h5>
								<p class="card-text">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">'.($this->joueur->getPoste() != NULL ?$this->joueur->getPoste():'N/A').'</li>
										<li class="list-group-item">'.($this->joueur->getTaille() != NULL ?$this->joueur->getTaille():'N/A').' cm</li>
										<li class="list-group-item">'.($this->joueur->getPoids() != NULL ?$this->joueur->getPoids():'N/A').' kg</li>
										<li class="list-group-item">'.$this->joueur->getDateNaissance(true).'</li>
									</ul>
								</p>
								<div class="input-group mb-3">
									<input class="form-control" type="int" pattern="[0-5]" name="note'.$cpt.'" value="'.$this->note.'" placeholder="Note sur 5">
									<div class="input-group-append">
										<span class="input-group-text">/5</span>
									</div>
								</div>
								<div class="form-group">
									<textarea class="form-control" rows="3" name="commentaire'.$cpt.'" >'.$this->commentaire.'</textarea>
								</div>
							</div>
						</div>
					';
		}
		
		
	}
?>

