<?php
class Marge_modele extends CI_Model {
    public function avoirTotalSortie($date1,$date2,$idarticle) {
        $sortie = $this->Generalisation->avoirTableSpecifique("v_mouvement","*","datemouvement BETWEEN '".$date1."' and '".$date2."' and idarticle='".$idarticle."'");
        $quantiteSortie = 0;
        for($i=0;$i<count($sortie);$i++) {
            $quantiteSortie += $sortie[$i]->quantiteretirer;
        }
        return $quantiteSortie;
    }

    public function calculPrixDeVente($idarticle) {
        $stock = $this->Generalisation->avoirTableAutrement("stock","*","where idarticle='".$idarticle."' order by dateinsertion asc");
        $prixPremierAchat = $stock[0]->prixunitaire;
        $prixVente = (1.4) * $prixPremierAchat;
        return $prixVente;
    }
}
?>