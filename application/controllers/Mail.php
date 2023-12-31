<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {
	// use Google\Client;
	// use Google\Service\Gmail;
	// use Google\Service\Gmail\Message;

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function upload_file() {
        $dossier =  FCPATH. 'upload/';
		$fichier = basename($_FILES['piecejointe']['name']);
		$taille_maxi = 1000000000000;
		$taille = filesize($_FILES['piecejointe']['tmp_name']);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.txt', '.pdf');
		$extension = strrchr($_FILES['piecejointe']['name'], '.');

		//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc';
		}

		if($taille>$taille_maxi)
		{
			$erreur = 'Le fichier est trop gros...';
		}

		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			//On formate le nom du fichier ici...
			$fichier = strtr($fichier,
			'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
			'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

			if(move_uploaded_file($_FILES['piecejointe']['tmp_name'], $dossier . $fichier)) //Si
			{
				// $erreur = 'Upload effectué avec succès !';
				// redirect("Mail/versEnvoieMail?erreur=".$erreur);
			}
		else //Sinon (la fonction renvoie FALSE).
		{
			$erreur = 'Echec de l\'upload !';
			redirect("Mail/versEnvoieMail?erreur=".$erreur);
		}
		}
		else
		{
			redirect("Mail/versEnvoieMail?erreur=".$erreur);
		}
		return $_FILES['piecejointe']['name'];
    }

	public function versAfficheMessages(){
		$idclient = $this->input->get('idclient');
		$client = $this->Generalisation->avoirTableSpecifique('client', '*', sprintf("idclient='%s'", $idclient));
		// var_dump($client);
		$mailclient = $this->Connexion->avoirTableConditionnee("adressemail where adressemail like '".$client[0]->adressemail."'");
		// var_dump($mailclient);
		$data['messages'] = $this->Mail_modele->message($mailclient[0]);
		$data['nomClient'] = $client[0]->nom;
		$data['id'] = $mailclient[0]['idadressemail'];
		$data['idclient'] = $client[0]->idclient;
			$this->load->view('header');
			$this->load->view('affichagemail', $data);
	}

	public function versListeClient(){
		// $idEmploye=$_SESSION['user'];
		// $employePoste=$this->Connexion->avoirTableCanditionnee("v_posteEmployeValidation where idemploye='".$idEmploye."'");
		$data['client'] = $this->Generalisation->avoirTable('client');
		$this->load->view('header');
		$this->load->view('listeClients', $data);
	}

	public function versListeDepartement(){
		// $idEmploye=$_SESSION['user'];
		// $employePoste=$this->Connexion->avoirTableCanditionnee("v_posteEmployeValidation where idemploye='".$idEmploye."'");
		$data['client'] = $this->Generalisation->avoirTable('client');
		$this->load->view('header');
		$this->load->view('listeClients', $data);
	}

	public function versEnvoieMailRetour(){
		// $idEmploye=$_SESSION['user'];
		// $employePoste=$this->Connexion->avoirTableCanditionnee("v_posteEmployeValidation where idemploye='".$idEmploye."'");
		$data['client'] = $this->Generalisation->avoirTable('client');
		$this->load->view('header');
		$this->load->view('listeClients', $data);
	}


	public function envoieMail(){
		$mail = $this->input->post('idmailclient');
		$message = $this->input->post('reponse');
		$idclient = $this->input->post('idclient');
		$pj="";

		// var_dump($_FILES['piecejointe']);
		
		if($_FILES['piecejointe']['name']!=""){
			$pj = $this->upload_file();
			$this->Mail_modele->copierPdf($pj);
		}

		if($mail=="" || $message==""){
			redirect("Mail/versAfficheMessages?idclient=".$idclient);
		}

		$retour = $this->Mail_modele->envoieMail($mail, $message, $pj);

		redirect("Mail/versAfficheMessages?idclient=".$idclient);
	}

	public function envoieMailRetour(){
		$erreur = $this->input->get('erreur');
		$erreur = $erreur."Voulez vous Poursuivre?";
		$idclient = $this->input->get('idclient');

		// var_dump($idclient);

		$societe = $this->Generalisation->avoirTableSpecifique("client", "*", sprintf("idclient='%s'", $idclient));

		$mail  =  $this->Connexion->avoirTableConditionnee(sprintf("adressemail where adressemail='%s'", $societe[0]->adressemail));

		var_dump($mail);

		$retour = $this->Mail_modele->envoieMail($mail[0]['idadressemail'], $erreur, "");

		redirect("Mail/versAfficheMessages?idclient=".$idclient);
	}


	// public envoyerMailDepartement(){

	// }

}
