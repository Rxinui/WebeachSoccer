<?php
class form {

	public $debut, $fin, $contenu;

	public function __construct(){
		$this->debut = "<form method='post'>";
		$this->fin = "</form>";
		$this->contenu = "<fieldset>";
	}

	public function setText($text){
		$cond = "<?php if (!empty($_POST[\''.$text.'\'])) echo $_POST[\''.$text.'\']; ?>";
		$this->contenu .= '<input type="."\"int\""." value=\"".$cond."\" name=\"".$text."\">';
	}

	public function setButton($button){
		$this->contenu .= "<input type=submit value=".$button." name='ope'>";
	}

	public function getForm(){
		$ch ="<html><body>".$this->debut.$this->contenu."</fieldset>".$this->fin."</body></html>";
		return $ch;
	}

}
?>


