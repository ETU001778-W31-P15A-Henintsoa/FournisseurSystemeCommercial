<?php 

    require_once(APPPATH.'third_party/pdf/fpdf.php');

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

    
        public function genererBonDeSortiePDF($idbondesortie) {
            $data = $this->Generalisation->avoirTableAutrement("v_detailbondesortie", "*", "where idbondesortie='".$idbondesortie."'");
        
            $pdf = new FPDF();
            $pdf->AddPage();
        
            // En-tête
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetTextColor(0); // Couleur bleue
            $pdf->Cell(0, 10, 'Bon de Sortie de Stock', 0, 1, 'C');
            
            $pdf->Ln(10); // Saut de ligne
        
            // Informations du bon de sortie
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetTextColor(0); // Couleur par défaut (noir)
            $pdf->Cell(0, 8, 'Date: ' . $data[0]->datebondesortie, 0, 1);
            $pdf->Cell(0, 8, 'Client: ' . $data[0]->nom, 0, 1);
            $pdf->Cell(0, 8, 'Bon de commande N: ' . $data[0]->idbondecommande, 0, 1);
        
            $pdf->Ln(15); // Saut de ligne
        
            // Tableau des produits
            $pdf->SetFont('Arial', '', 12);
            
            $pdf->SetFillColor(0, 0, 0); // Couleur de fond pour l'en-tête du tableau
            $pdf->SetTextColor(255); // Couleur du texte en blanc pour l'en-tête du tableau
            
            $pdf->Cell(80, 10, 'Produit', 1, 0, 'C', true);
            $pdf->Cell(80, 10, 'Quantite', 1, 1, 'C', true);
        
            $pdf->SetFillColor(224, 235, 255); // Couleur de fond pour les lignes du tableau
            $pdf->SetTextColor(0); // Couleur du texte en noir pour les lignes du tableau
            
            foreach ($data as $row) {
                if (is_object($row)) {
                    $pdf->Cell(80, 10, $row->nomarticle, 1);
                    $pdf->Cell(80, 10, $row->quantite, 1, 1);
                }
            }
        
            // Enregistrez le PDF sur le serveur ou envoyez-le en sortie
            $nomPDF = "bon_de_sortie_" . $data[0]->datebondesortie . ".pdf";
            $pdf->Output($nomPDF, 'I');
        }
        
        
        

        
        
        

    }
    
?>