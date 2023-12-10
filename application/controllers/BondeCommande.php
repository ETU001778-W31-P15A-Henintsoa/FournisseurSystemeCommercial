<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BonDeCommande extends CI_Controller {

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
		$this->Generalisation->insertion("BonDeCommande(idClient)","('".$societe."')");
		$BonDeCommande=$this->Generalisation->avoirTableAutrement("BonDeCommande","*"," order by idBonDeCommande desc");
		$quantite = 0;
		for($i=1; $i <= $valeur ;$i++) {
			$donneeStock = $this->Generalisation->avoirTableAutrement("Stock", "*", "where idarticle = '".$_POST['article'.$i]."'");
			$quantite = $donneeStock[0]->quantite;
			if($quantite < $_POST['quantite'.$i]) {
				$error['error'] = "quantite non valide pour l'article:".$_POST['article'.$i].". La quantite disponible est ".$quantite;
				$data['client']=$this->Generalisation->avoirTable("client");
       	 		$data['article']=$this->Generalisation->avoirTable("article");
				$this->load->view('header');
				$this->load->view('SaisieBonDeCommande',$error);
			}else {
				$this->Generalisation->insertion("DetailBonDeCommande(idbondecommande,idArticle,quantite)","('".$BonDeCommande[0]->idbondecommande."','".$_POST['article'.$i]."',".$_POST['quantite'.$i].")");
			}
		}
		redirect('BonDeCommande/versSaisieCommande');
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
