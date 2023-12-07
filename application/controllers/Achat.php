<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Achat extends CI_Controller {
		public function versFormulaireStock() {
            $data['article'] = $this->Generalisation->avoirTableConditionnee("article");
            $this->load->view('header');
            $this->load->view('FormulaireAchat',$data);
        }

        public function insererStock() {
            $dateEntree = $this->input->post('dateEntree');
            $dateFinValidite = $this->input->post('datefin');
            $article = $this->input->post('article');
            $quantite = $this->input->post('quantite');
            $prixUnitaire = $this->input->post('prix');
            $values = "('".$article."',".$quantite.",'".$dateFinValidite."',".$prixUnitaire.",'".$dateEntree."')";
            $this->Generalisation->insertion("stock(idarticle,quantite,datefinvalidite,prixunitaire,dateinsertion)",$values);
            redirect('Achat/versFormulaireStock');
        }
        
    }
?>