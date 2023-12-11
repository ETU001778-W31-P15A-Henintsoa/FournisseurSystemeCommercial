<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BonDeLivraison extends CI_Controller {

    public function versDateLivraison() {
        $idEmploye = $_SESSION['user'];
        $employePoste=$this->Generalisation->avoirTableSpecifique("v_posteEmployeValidation","*"," idemploye='".$idEmploye."'");
        if($employePoste[0]->libelle == "livraison"){
            $data['idbondesortie'] = $this->input->get('idbondesortie');
            $this->load->view('header');
            $this->load->view('GenererLivraison',$data);
        }else {
            $data["error"]="Vous n'avez pas accès à cette page";
            $this->load->view('header');
            $this->load->view('errors/Erreur',$data);
        }
    }

    public function genererBonDeLivraison() {
        $idbondesortie = $this->input->post('idbondesortie');
        $dateLivraison = $this->input->post('datelivraison');
        $detail= $this->Generalisation->avoirTableAutrement("v_detailbondesortie","*","where idbondesortie='".$idbondesortie."'");
        $this->Generalisation->insertion("BonDeLivraison(idbondesortie,datelivraison)", "('".$idbondesortie."','".$dateLivraison."')");
        $BonDeLivraison=$this->Generalisation->avoirTableAutrement("BonDeLivraison","*"," order by idBonDeLivraison desc");
        foreach($detail as $details) {
            $this->Generalisation->insertion("DetailBonDeLivraison(idbondelivraison,idarticle,quantite)","('".$BonDeLivraison[0]->idbondelivraison."','".$details->idarticle."',".$details->quantite.")");
        }
        redirect('BonDeLivraison/versListeBonDeLivraison');
    }

    public function versListeBonDeLivraison() {
        $idEmploye = $_SESSION['user'];
        $employePoste=$this->Generalisation->avoirTableSpecifique("v_posteEmployeValidation","*"," idemploye='".$idEmploye."'");
        if($employePoste[0]->libelle == "livraison"){
            $data['bondelivraison'] = $this->Generalisation->avoirTableConditionnee("v_bondelivraison");
            $this->load->view('header');
            $this->load->view('ListeBonDeLivraison',$data);
        }else {
            $data["error"]="Vous n'avez pas accès à cette page";
            $this->load->view('header');
            $this->load->view('errors/Erreur',$data);
        }
    }

    public function versDetailBonDeLivraison() {
        $idbondelivraison = $this->input->get('idbondelivraison');
        $data['detail'] = $this->Generalisation->avoirTableAutrement("v_detaillivraison","*","where idbondelivraison='".$idbondelivraison."'");
        $this->load->view('header');
        $this->load->view('DetailBonDeLivraison',$data);
    }
    
    public function versLivraisonPDF() {
        $idbondelivraison = $this->input->get('idbondelivraison');
        try {
            $this->BonDeLivraison_modele->genererBonDeLivraisonPDF($idbondelivraison);
        } catch (Exception $e) {
            echo 'Exception : ',  $e->getMessage(), "\n";
        }
    }
}
