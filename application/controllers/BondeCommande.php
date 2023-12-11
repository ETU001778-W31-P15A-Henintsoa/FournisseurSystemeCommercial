<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BondeCommande extends CI_Controller {

	public function versSaisieCommande()
	{
		$data['client']=$this->Generalisation->avoirTable("client");
        $data['article']=$this->Generalisation->avoirTable("article");
		$this->load->view('header');
		$this->load->view('SaisieBonDeCommande',$data);
	}

	public function entrerCommande() {
		$societe = $this->input->post('idClient');
		$valeur = intval($this->input->post('nombreArticle'));
		$commandeValide = true; 
		$erreur = "";
		// $this->Generalisation->insertion("BonDeCommande(idClient)", "('" . $societe . "')");
		// $BonDeCommande = $this->Generalisation->avoirTableAutrement("BonDeCommande", "*", " order by idBonDeCommande desc");
		$quantite = 0;

		for ($i = 1; $i <= $valeur; $i++) {
			$donneeStock = $this->Generalisation->avoirTableAutrement("v_StockArticle", "*", "where idarticle = '" . $_POST['article' . $i] . "'");
			for($j=0;$j<count($donneeStock);$j++) {
				$quantite += $donneeStock[$j]->quantite;
			}
			
	
			if ($quantite < $_POST['quantite' . $i]) {
				$commandeValide = false; 
				$data['errors'][] = "Quantité non valide pour l'article:" . $donneeStock[0]->nomarticle . ". La quantité disponible est " . $quantite;
				$erreur = $erreur."Quantité non valide pour l article:" . $donneeStock[0]->nomarticle . ". La quantité disponible est " . $quantite.".\n";
			} else {

				if ($i === 1) {
					$this->Generalisation->insertion("BonDeCommande(idClient)", "('" . $societe . "')");
					$BonDeCommande = $this->Generalisation->avoirTableAutrement("BonDeCommande", "*", " order by idBonDeCommande desc");
				}
				$this->Generalisation->insertion("DetailBonDeCommande(idbondecommande,idArticle,quantite)", "('" . $BonDeCommande[0]->idbondecommande . "','" . $_POST['article' . $i] . "'," . $_POST['quantite' . $i] . ")");
			}
		}

		$data['erreur'] = $erreur;
		$data['idclient'] = $societe;
	
		if (!$commandeValide) {
			$data['error'] = implode('<br>', $data['errors']);
			$this->load->view('header');
			$this->load->view('errors/erreurValidationAchat', $data);
		} else {
			redirect('BonDeCommande/versListeBonDeCommande');
		}
	}
	

	public function versListeBonDeCommande() {
		$data['bondecommande'] = $this->Generalisation->avoirTableConditionnee("v_bondecommande");
		$this->load->view('header');
		$this->load->view('ListeBonDeCommande',$data);
	}
	
	public function versDetailsBonDeCommande() {
		$idbondecommande = $this->input->get('idbondecommande');
		$data['detail'] = $this->Generalisation->avoirTableAutrement("v_DetailBonDeCommande","*","where idbondecommande='".$idbondecommande."'");
		$this->load->view('header');
		$this->load->view('DetailBonDeCommande',$data);
	}
}
