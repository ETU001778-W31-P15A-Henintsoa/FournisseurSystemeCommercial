<?php 

    require_once(APPPATH.'third_party/pdf/fpdf.php');

    if(! defined('BASEPATH')) exit('No direct script access allowed');
    class BonDeLivraison_modele extends CI_Model{
        
    
        public function genererBonDeLivraisonPDF($idbondelivraison) {
            $data = $this->Generalisation->avoirTableAutrement("v_detaillivraison","*","where idbondelivraison='".$idbondelivraison."'");
        
            $pdf = new FPDF();
            $pdf->AddPage();
        
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetTextColor(0); 
            $pdf->Cell(0, 10, 'Bon de Livraison', 0, 1, 'C');
            
            $pdf->Ln(10); 
        
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetTextColor(0); 
            $pdf->Cell(0, 8, 'Bon de livraison N:' . $data[0]->idbondelivraison ,0,1);
            $pdf->Cell(0, 8, 'Date de livraison: ' . $data[0]->datelivraison, 0, 1);
            $pdf->Cell(0, 8, 'Numero de commande: ' . $data[0]->idbondecommande, 0, 1);
            $pdf->Cell(0, 8, 'Client: ' . $data[0]->nom, 0, 1);
            $pdf->Cell(0, 8, 'Lieu de livraison: ' . $data[0]->adresse . " ".$data[0]->ville , 0, 1);
        
            $pdf->Ln(15); 
            $pdf->SetFont('Arial', '', 12);
            
            $pdf->SetFillColor(0, 0, 0); 
            $pdf->SetTextColor(255); 
            
            $pdf->Cell(80, 10, 'Article', 1, 0, 'C', true);
            $pdf->Cell(80, 10, 'Quantite', 1, 1, 'C', true);
        
            $pdf->SetFillColor(224, 235, 255);
            $pdf->SetTextColor(0); 
            
            foreach ($data as $row) {
                if (is_object($row)) {
                    $pdf->Cell(80, 10, $row->nomarticle, 1);
                    $pdf->Cell(80, 10, $row->quantite, 1, 1);
                }
            }
        
            $nomPDF = "bon_de_livraison_" . $data[0]->nom . ".pdf";
            $pdf->Output($nomPDF, 'I');
        }
        
        
        

        
        
        

    }
    
?>