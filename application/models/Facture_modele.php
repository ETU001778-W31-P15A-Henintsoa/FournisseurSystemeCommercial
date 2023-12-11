<?php 
    if(! defined('BASEPATH')) exit('No direct script access allowed');
    class Facture_modele extends CI_Model{
        
        public function calculPrixDeVente($article) {
            $stock = $this->Generalisation->avoirTableAutrement("stock","*","where idarticle='".$article."' order by dateinsertion asc");
            $prixPremierAchat = $stock[0]->prixunitaire;
            $prixVente = (1.4) * $prixPremierAchat;
            return $prixVente;
        }
        
        public function genererFacturePDF($idfacture) {
            $data = $this->Generalisation->avoirTableAutrement("v_detailfacture", "*", "where idfacture='" . $idfacture . "'");
        
            $pdf = new FPDF();
            $pdf->AddPage();
        
            // En-tête
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetTextColor(0);
            $pdf->Cell(0, 10, 'Facture', 0, 1, 'C');
        
            $pdf->Ln(10); // Saut de ligne
        
            // Informations de la facture
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetTextColor(0);
            $pdf->Cell(0, 8, 'Numero de facture : ' . $data[0]->idfacture, 0, 1);
            $pdf->Cell(0, 8, 'Date de facturation: ' . $data[0]->datefacturation, 0, 1);
            $pdf->Cell(0, 8, 'Numero de commande: ' . $data[0]->idbondecommande, 0, 1);
            $pdf->Cell(0, 8, 'Paiement: ' . $data[0]->paiement.' jours', 0, 1);
            $pdf->Cell(0, 8, 'Client: ' . $data[0]->nom, 0, 1);
            $pdf->Cell(0, 8, 'Adresse: ' . $data[0]->adresse . " " . $data[0]->ville, 0, 1);
        
            $pdf->Ln(15); // Saut de ligne
        
            // Tableau des produits
            $pdf->SetFont('Arial', '', 12);
        
            $pdf->SetFillColor(41, 128, 185); // Couleur de fond pour l'en-tête du tableau
            $pdf->SetTextColor(255); // Couleur du texte en blanc pour l'en-tête du tableau
        
            $pdf->Cell(20, 10, 'Produit', 1, 0, 'C', true);
            $pdf->Cell(20, 10, 'Quantite', 1, 0, 'C', true);
            $pdf->Cell(30, 10, 'Prix Unitaire', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Prix TTC', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Prix HT', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'TVA', 1, 1, 'C', true);
        
            $pdf->SetFillColor(224, 235, 255); // Couleur de fond pour les lignes du tableau
            $pdf->SetTextColor(0); // Couleur du texte en noir pour les lignes du tableau
        
            $sommeTTC = 0;
            $sommeHT = 0;
            $sommeTVA = 0;
        
            foreach ($data as $row) {
                if (is_object($row)) {
                    $pdf->Cell(20, 10, $row->nomarticle, 1);
                    $pdf->Cell(20, 10, $row->quantite, 1, 0, 'C');
                    $pdf->Cell(30, 10, $row->prixunitaire, 1, 0, 'C');
                    $ttc = $row->prixunitaire * $row->quantite;
                    $pdf->Cell(40, 10, $ttc, 1, 0, 'C');
                    $ht = $ttc / (1.2);
                    $pdf->Cell(40, 10, $ht, 1, 0, 'C');
                    $tva = ($ht) * (0.2);
                    $pdf->Cell(40, 10, $tva, 1, 1, 'C');
                }
                $sommeTTC += $ttc;
                $sommeHT += $ht;
                $sommeTVA += $tva;
            }
        
            // Total
            $pdf->Cell(70, 10, 'TOTAL', 1);
            $pdf->Cell(40, 10, $sommeTTC, 1, 0, 'C');
            $pdf->Cell(40, 10, $sommeHT, 1, 0, 'C');
            $pdf->Cell(40, 10, $sommeTVA, 1, 1, 'C');
        
            // Enregistrez le PDF sur le serveur ou envoyez-le en sortie
            $nomPDF = "Facture_" . $data[0]->datefacturation . "_" . $data[0]->nom . ".pdf";
            $pdf->Output($nomPDF, 'I');
        }
        
    }
    
?>