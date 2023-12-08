<?php
class Login_modele extends CI_Model {
    public function verification_login($mail, $mdp){
        $error="";
		if ($mail == "" || $mdp == "") {
			$error['error'] = "Les Champs ne doivent pas etre vides.";
			$this->load->view('index', $error);
		} else {

			$test = FALSE;
			
			if ($mail == "jumbo@gmail.com" && $mdp == "jumbo") {
				$test = true;
				$_SESSION['user'] = $user -> idemploye;
			}
			
			if ($test == FALSE) {
				$error['error'] = "Mot de passe ou mail incorrect";
				$this->load->view('index', $error);
			}

            return $error;
		}
	}
}
?>
