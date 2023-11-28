<?php
class Proforma extends CI_Model {

    public function avoirStockArticle($detailDemande){
        $stock=$this->Generalisation->avoirTableSpecifique("stock","*"," idarticle='".$detailDemande->idarticle."'");
        if(count($stock)==0  || $stock[0]->quantite==0){
            return null;
        }
        $detailProforma['societe']=$detailDemande->nom;
        $detailProforma['article']=$detailDemande->nomarticle;
        $detailProforma['quantite']=$detailDemande->quantite;
        $detailProforma['prixUnitaire']=$stock[0]->prixunitaire;
        $detailProforma['dateValidite']=$stock[0]->datefinvalidite;
        if($stock[0]->quantite<$detailDemande->quantite){
            $detailProforma['quantite']=$stock[0]->quantite;
        }
        return $detailProforma;
    }

    public function avoirProforma($iddemandeProforma){
        $detailDemande=$this->Generalisation->avoirTableSpecifique("v_detailDemandeProforma","*"," idDemandeProforma='".$iddemandeProforma."'");
        $j=0;
        $detailProforma=array();
        for ($i=0; $i <count($detailDemande) ; $i++) { 
            if($this->avoirStockArticle($detailDemande[$i])!=null){
                $detailProforma[$j]=$this->avoirStockArticle($detailDemande[$i]);
                $j++;
            }
        }
        return $detailProforma;
    }
}
?>