<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Facture extends CI_Controller {
		
        public function versFormulaireFacture() {
            $data['bondecommande'] = $this->Generalisation->avoirTableConditionnee("v_bondecommande");
            // echo count($data['bondecommande']);
            $this->load->view('header');
            $this->load->view('FormulaireFacture',$data);
        }

        public function genererFacture() {
            $idbondecommande = $this->input->post('bondecommande');
            $paiement = $this->input->post('paiement');
            $tva = $this->input->post('tva');

            $this->Generalisation->insertion("Facture(idbondecommande,paiement,TVA)","('".$idbondecommande."',".$paiement.",".$tva.")");
            $detail= $this->Generalisation->avoirTableAutrement("v_DetailBonDeCommande","*","where idbondecommande='".$idbondecommande."'");
            $facture=$this->Generalisation->avoirTableAutrement("Facture","*"," order by idfacture desc");
            foreach($detail as $details) {
                $prixVente = $this->Facture_modele->calculPrixDeVente($details->idarticle);
                $this->Generalisation->insertion("DetailFacture(idfacture,idarticle,quantite,prixunitaire)","('".$facture[0]->idfacture."','".$details->idarticle."',".$details->quantite.",".$prixVente.")");
            }
            redirect('Facture/versFormulaireFacture');
        }

        public function versListeFacture() {
            $data['facture'] = $this->Generalisation->avoirTableConditionnee("v_facture");
            $this->load->view('header');
            $this->load->view('ListeFacture',$data);
        }

        public function versDetailFacture() {
            $idfacture = $this->input->get('idFacture');
            $data['detail'] = $this->Generalisation->avoirTableAutrement("v_detailfacture","*","where idfacture='".$idfacture."'");
            $this->load->view('header');
            $this->load->view('DetailFacture',$data);
        }
    }
?>