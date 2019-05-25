<?php
	class MyElement {
		//définition d'une constante
		private $contenu;

		//définition d'une méthode constructeur
		public function __construct() { 
			$this->contenu = "";
		}
		
		public static function pageConfirmation($message,$img){
			echo '<div class="container-s border-top border-bottom mt-lg-5">
					<h2 style="text-align:center">'.$message.'</h2>
					<p align="center"><img src="'.$img.'" style="text-align:center"></p>
				</div>';
		}

		public static function popUpConfirmation($action,$id,$titre="Titre",$body="Corps du message"){
			echo '
			<!-- Modal -->
			<div class="modal fade" id="modalConfirmation'.$id.'" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalTitle">'.$titre.'</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							'.$body.'
						</div>
						<form action="'.$action.'" method="post">
							<div class="modal-footer">
								<input type="hidden" name="id_modal" value='.$id.'>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
								<button type="submit" class="btn btn-primary">Confirmer</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			';
		}

		public static function popUpModification($action,$id,$titre="Titre",$body="Corps de message"){
			echo '
			<!-- Modal -->
			<div class="modal fade" id="modalModification'.$id.'" tabindex="-1" role="dialog" aria-labelledby="modalModification" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered " role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalTitle">'.$titre.'</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="'.$action.'" method="post">
						<div class="modal-body">
							'.$body.'
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id_modal" value='.$id.'>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
							<button type="submit" class="btn btn-primary">Confirmer</button>
						</div>
					</form>
					</div>
				</div>
			</div>
			';
		}

		public static function tabNavs($etat_joueurs=true,$etat_matchs=false,$etat_participants=false){
			$etat_joueurs = ($etat_joueurs ? "active": "" );
			$etat_matchs = ($etat_matchs ? "active": "" );
			$etat_participants = ($etat_participants ? "active": "" );
			echo '<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
				<a class="nav-link '.$etat_joueurs.'" id="joueurs-tab" data-toggle="tab" href="#joueurs" role="tab" aria-controls="joueurs" aria-selected="true">Joueurs</a>
				</li>
				<li class="nav-item">
				<a class="nav-link '.$etat_matchs.'" id="matchs-tab" data-toggle="tab" href="#matchs" role="tab" aria-controls="matchs" aria-selected="false">Matchs</a>
				</li>
				<li class="nav-item">
				<a class="nav-link '.$etat_participants.'"  id="participants-tab" data-toggle="tab" href="#participants" role="tab" aria-controls="participants" aria-selected="false">Participants</a>
				</li> 
			</ul>';
		}
	}
?>