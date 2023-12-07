<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BonDeSortie extends CI_Controller {

    public function genererBonDeSortie() {
        $idbondecommande = $this->input->get('idbondecommande');
		$detail= $this->Generalisation->avoirTableAutrement("v_DetailBonDeCommande","*","where idbondecommande='".$idbondecommande."'");
        $this->Generalisation->insertion("BonDeSortie(idbondecommande)", "('".$idbondecommande."')");
        $BonDeSortie=$this->Generalisation->avoirTableAutrement("BonDeSortie","*"," order by idBonDeSortie desc");
        foreach($detail as $details) {
            $resultat = $this->BonDeSortie_modele->verifEtatArticle($details->idarticle);
            $reste = $details->quantite;
            $i=0;
            while($reste != 0 && $i<count($resultat)) {
                if($resultat[$i]->quantite >= $reste) {
                    $quantite_enlever = $resultat[$i]->quantite - $reste;
                    $this->Generalisation->miseAJour("stock", "quantite=".$quantite_enlever, " idarticle='".$details->idarticle."' and idstock='".$resultat[$i]->idstock."'");
                    $reste = 0;
                }else {
                    $reste -= $resultat[$i]->quantite;
                    $this->Generalisation->miseAJour("stock", "quantite=0", " idarticle='".$details->idarticle."' and idstock='".$resultat[$i]->idstock."'");
                }
            }

            $this->Generalisation->insertion("DetailBonDeSortie(idbondesortie,idarticle,quantite)", "('".$BonDeSortie[0]->idbondesortie."','".$details->idarticle."',".$details->quantite.")");
        }
        redirect('BonDeCommande/versSaisieCommande');
    }

    public function versListeBonDeSortie() {
        $data['bondeSortie'] = $this->Generalisation->avoirTableConditionnee("v_bondesortie");
		$this->load->view('header');
		$this->load->view('ListeBonDeSortie',$data);
    }

    public function versDetailBonDeSortie() {
        $idbondesortie = $this->input->get('idbondesortie');
        // echo $idbondesortie;
		$data['detail'] = $this->Generalisation->avoirTableAutrement("v_detailbondesortie","*","where idbondesortie='".$idbondesortie."'");
		$this->load->view('header');
		$this->load->view('DetailBonDeSortie',$data);
    }
}
