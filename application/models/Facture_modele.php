<?php 
    if(! defined('BASEPATH')) exit('No direct script access allowed');
    class Facture_modele extends CI_Model{
        
        public function calculPrixDeVente($article) {
            $stock = $this->Generalisation->avoirTableAutrement("stock","*","where idarticle='".$article."' order by dateinsertion asc");
            $prixPremierAchat = $stock[0]->prixunitaire;
            $prixVente = (1.4) * $prixPremierAchat;
            return $prixVente;
        }
    }
    
?>