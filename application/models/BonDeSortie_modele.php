<?php 
    if(! defined('BASEPATH')) exit('No direct script access allowed');
    class BonDeSortie_modele extends CI_Model{
        
        public function verifEtatArticle($idarticle) {
            $article = $this->Generalisation->avoirTableConditionnee("v_Article");
            $resultat = array();
            foreach($article as $articles) {
                if($articles->nomcategorie == "FIFO"){
                    $resultat = $this->Generalisation->avoirTableAutrement("stock","*","where idarticle='".$idarticle."' order by dateinsertion asc");
                }else if($articles->nomcategorie == "LIFO") {
                    $resultat = $this->Generalisation->avoirTableAutrement("stock","*","where idarticle='".$idarticle."' order by dateinsertion desc");
                }else {
                    $resultat = $this->Generalisation->avoirTableAutrement("stock","*","where idarticle='".$idarticle."'");
                }
            }
            return $resultat;
        }
    }
    
?>