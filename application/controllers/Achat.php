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

        public function versFormulaireMarge() {
            $this->load->view('header');
            $this->load->view('FormulaireMarge');
        }

        public function versMarge() {
            $datedebut = $this->input->post('datedebut');
            $datefin = $this->input->post('datefin');
            $article = $this->Generalisation->avoirTableAutrement("v_mouvement","idarticle","");
            $sommeSortiePrixVente = 0;
            $prixVente = 0;
            $sommeSortiePrixStock = 0;
            $data['margeArticle'] =[];
            $data['parVente'] = [];
            $data['parStock'] = [];
            for($i=0;$i<count($article);$i++) {
                $prixVente = $this->Marge_modele->calculPrixDeVente($article[$i]->idarticle);
                $sortie = $this->Marge_modele->avoirTotalSortie($datedebut,$datefin,$article[$i]->idarticle);
                $sortiePrixVente = $sortie * $prixVente;
                $sommeSortiePrixVente += $sortiePrixVente;
                $detailSortie = $this->Generalisation->avoirTableSpecifique("v_mouvement","*","datemouvement BETWEEN '".$datedebut."' and '".$datefin."' and idarticle='".$article[$i]->idarticle."'");
                for($j=0;$j<count($detailSortie);$j++) {
                    $sortiePrixStock = $detailSortie[$j]->quantiteretirer * $detailSortie[$j]->prixunitaire;
                }
                $sommeSortiePrixStock += $sortiePrixStock;
                $data['margeArticle'][$i] = $sortiePrixVente - $sortiePrixStock;
            }
            
            $data['prixVenteDetail'] = [];
            $margeBrute = $sommeSortiePrixVente - $sommeSortiePrixStock;
            $data['margeBrute'] = $margeBrute;
            $data['detail'] = $this->Generalisation->avoirTableSpecifique("v_mouvement","*","datemouvement BETWEEN '".$datedebut."' and '".$datefin."'");
            for($j=0;$j<count($data['detail']);$j++){
                $data['prixVenteDetail'][$j] = $this->Marge_modele->calculPrixDeVente($data['detail'][$j]->idarticle);
                $data['parVente'][$j] = $data['margeArticle'][$j] / $sortiePrixVente;
                $data['parStock'][$j] = $data['margeArticle'][$j] / $sortiePrixStock;
            }
            $data['datedebut'] = $datedebut;
            $data['datefin'] = $datefin;
            $this->load->view('header');
            $this->load->view('AffichageMarge',$data);
        }
        
    }
?>