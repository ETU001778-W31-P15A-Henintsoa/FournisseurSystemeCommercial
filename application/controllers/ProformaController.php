<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Africa/Nairobi');

    class ProformaController extends CI_Controller {

        public function versDemande(){
            $data['client']=$this->Generalisation->avoirTable("client");
            $data['article']=$this->Generalisation->avoirTable("article");
            $this->load->view('Header');
            $this->load->view('SaisieDemandeProforma',$data);
        }
        public function entrerDemande(){
            date_default_timezone_set('Africa/Nairobi');
            $date=date('Y-m-d');
            $societe=$_POST['idClient'];
            // $employePoste=$this->Generalisation->avoirTableSpecifique("v_posteEmploye","*"," idemploye='".$idEmploye."'");
            $valeur="(default,'".$date."','".$societe."',0)";
            $this->Generalisation->insertion("demandeProforma",$valeur);
            $valeur=intval($_POST['nombreArticle']);
            $demandeProforma=$this->Generalisation->avoirTableAutrement("demandeproforma","*"," order by idDemandeproforma desc");
            for ($i=1; $i <=$valeur ; $i++) { 
                $val="(default,'".$_POST['article'.$i]."',".$_POST['quantite'.$i].",'".$demandeProforma[0]->iddemandeproforma."')";
                $this->Generalisation->insertion("detailDemandeproforma",$val);
            }
            redirect("ProformaController/versDemande");
        }

        public function versListeDemandeNonConvertie(){ // demande de profor
            $data['demandeProforma']=$demandeProforma=$this->Generalisation->avoirTableSpecifique("v_demandeProformaClient","*"," etat=0");
            $this->load->view('Header');
            $this->load->view('DemandeNonConvertie',$data);
        }

        public function genererPDFContenu($iddemande) {
            $data['proforma']=$this->Proforma->avoirProforma($iddemande);
            $this->Generalisation->miseAJour("demandeProforma"," etat=1"," idDemandeProforma='".$iddemande."'");
            $this->load->view('Header');
            return $this->load->view('Proforma', $data, true);
        }
        
        public function genererpdf() {
            $pdf = new TCPDF();
            $iddemande=$_GET['idDemandeProforma'];
            $client =$_GET['client'];
            $date =$_GET['date'];
            $pdf->AddPage();
            $data['content'] = $this->genererPDFContenu($iddemande);
            $pdf->writeHTML($data['content'], true, false, true, false, '');
            $data['pdf'] = $pdf;
            $this->load->view('Proforma', $data);
            $nomPDF = "Proforma_".$client."_".$date.".pdf";
            $pdf->Output($nomPDF, 'I');
        }
    }
    //gdao
?>