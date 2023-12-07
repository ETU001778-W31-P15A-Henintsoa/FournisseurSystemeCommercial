<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BonDeLivraison extends CI_Controller {

    public function versDateLivraison() {
        $data['idbondesortie'] = $this->input->get('idbondesortie');
        $this->load->view('header');
        $this->load->view('GenererLivraison',$data);
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
        $data['bondelivraison'] = $this->Generalisation->avoirTableConditionnee("v_bondelivraison");
        $this->load->view('header');
        $this->load->view('ListeBonDeLivraison',$data);
    }

    public function versDetailBonDeLivraison() {
        $idbondelivraison = $this->input->get('idbondelivraison');
        $data['detail'] = $this->Generalisation->avoirTableAutrement("v_detaillivraison","*","where idbondelivraison='".$idbondelivraison."'");
        $this->load->view('header');
        $this->load->view('DetailBonDeLivraison',$data);
    }
 
}
