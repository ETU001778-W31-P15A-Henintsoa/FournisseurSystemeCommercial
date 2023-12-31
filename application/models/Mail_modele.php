<?php 
    if(! defined('BASEPATH')) exit('No direct script access allowed');

    class Mail_modele extends CI_Model{

        // public function envoyerEmailReel($destinataire, $sujet, $message, $fichier) {
            // $sujet = 'Sujet de l\'e-mail';
            // $message = '<p>'.$message.'</p>';

            // // Mon mail
            // $monMail = $this->monMail();

            // // var_dump($monMail->motdepasse);
    
            // try {
            //     $to = "h.lovahenintsoa@gmail.com";
            //     $subject = "HTML email";

            //     $message = "
            //     <html>
            //     <head>
            //     <title>HTML email</title>
            //     </head>
            //     <body>
            //     <p>This email contains HTML Tags!</p>
            //     <table>
            //     <tr>
            //     <th>Firstname</th>
            //     <th>Lastname</th>
            //     </tr>
            //     <tr>
            //     <td>John</td>
            //     <td>Doe</td>
            //     </tr>
            //     </table>
            //     </body>
            //     </html>
            //     ";

            //     // Always set content-type when sending HTML email
            //     $headers = "MIME-Version: 1.0" . "\r\n";
            //     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            //     // More headers
            //     $headers .= 'From: <dimpexenterprise@gmail.com>' . "\r\n";
            //     // $headers .= 'Cc: dimpexenterprise@gmail.com' . "\r\n";

            //     $send = mail($to,$subject,$message,$headers);

            //     if($send){
            //         echo "oui";
            //     }else{
            //         echo $this->email->print_debugger();
            //     }

                // // the message
                // $msg = "Bonjour\nSecond line of text";

                // // use wordwrap() if lines are longer than 70 characters
                // $msg = wordwrap($msg,70);

                // // send email
                // mail("h.lovahenintsoa@gmail.com","My subject",$msg);

                // // Email configuration
                // $config = array(
                //     "protocol" => "smtp",
                //     "smtp_host" => "ssl://smtp.googlemail.com",
                //     "smtp_port" => "465",
                //     '_smtp_auth' =>TRUE,
                //     "smtp_user" => "dimpexenterprise@gmail.com",
                //     "smtp_pass" => "dimpexenterprise",
                //     "smtp_crypto" => "ssl",
                //     "mailtype" => "html",
                //     "charset" => "utf-8",
                //     "wordwrap" => TRUE,
                //     "newline" =>"\r\n",
                //     "smtp_timeout" => "",
                //     "validation" => FALSE
                // );

                // $this->email->set_newline("\r\n"); 

                // // var_dump($config);

                // $this->email->initialize($config);

                // $this->email->from('dimpexenterprise@gmail.com', 'DIMPEX Enterprise');
                // $this->email->to('h.lovahenintsoa@gmail.com');
                // $this->email->subject($sujet);
                // $this->email->message($message);

                // if($fichier != null && $fichier!="" && $fichier!=FCPATH . 'upload/'){
                //    // Attachment
                //     $cheminFichierJoint = $fichier; // Remplacez par le chemin réel de votre fichier
                //     $this->email->attach($cheminFichierJoint);
                // }

                // // $this->email->send();
        
                // if ($this->email->send()) {
                //     echo 'L\'e-mail avec la pièce jointe a été envoyé avec succès.';
                // } else {
                //     echo $this->email->print_debugger();
                // }

            // } catch (Exception $e) {
            //     var_dump($e);
            // }
        // }

        // public function envoyerEmail() {
    
        //     $this->email->from('dimpexenterprise@gmail.com', 'DIMPEX Enterprise');
        //     $this->email->to('h.lovahenintsoa@gmail.com');
        //     $this->email->subject('Sujet de l\'e-mail');
        //     $this->email->message('Ceci est le corps de l\'e-mail.');
    
        //     if ($this->email->send()) {
        //         echo 'L\'e-mail a été envoyé avec succès.';
        //     } else {
        //         echo 'Erreur lors de l\'envoi de l\'e-mail: ' . $this->email->print_debugger();
        //     }
        // }

        // public function envoyer(){
        //     try {
        //         $mail = new PHPMailer(true);
        //     } catch (\Throwable $th) {
        //         //throw $th;
        //     }
        // }

        public function copierPdf(){
            shell_exec("cp -rf /var/www/html/Fournisseur/FournisseurSystemeCommercial/upload/* /var/www/html/SystemeCommercial/SystemeCommercial/upload/");
        }

        // Fonctions Fonctionnelles
        public function envoieMail($destinataire, $message, $fichier){
            $mail = $this->monMail();
            $message = "Reponse de Proforma//".$message;
            
            // $fichier = FCPATH . 'upload/'.$fichier;
            // $this->envoyerEmailReel($destinataire, $sujet, $message, $fichier);

            // var_dump($destinataire);

            if(count($destinataire)==0){
                return false;
            }

            $this->Connexion->insertion("mail(dateenvoie, envoyeur, destinataire)", sprintf("(current_date, '%s', '%s')", $mail['idadressemail'], $destinataire));
            
            $mails = $this->Connexion->avoirTableConditionnee("mail order by dateenvoie ");

            $this->Connexion->insertion("message(idmail, libelle, piecejointe)", sprintf("('%s', '%s', '%s')", $mails[count($mails)-1]['idmail'], $message, $fichier));
            
            $this->copierPdf();

            return true;
        }

        public function envoieMailDepartement($envoyeur, $destinataire, $message, $fichier){
            $message = "//".$message;
            
            // $fichier = FCPATH . 'upload/'.$fichier;
            // $this->envoyerEmailReel($destinataire, $sujet, $message, $fichier);

            // var_dump($destinataire);

            if(count($destinataire)==0){
                return false;
            }

            $this->Connexion->insertion("mail(dateenvoie, envoyeur, destinataire)", sprintf("(current_date, '%s', '%s')", $envoyeur, $destinataire));
            
            $mails = $this->Connexion->avoirTableConditionnee("mail order by dateenvoie ");

            $this->Connexion->insertion("message(idmail, libelle, piecejointe)", sprintf("('%s', '%s', '%s')", $mails[count($mails)-1]['idmail'], $message, $fichier));
            
            $this->copierPdf();

            return true;
        }

        public function monMail(){
            $monentreprise = $this->Generalisation->avoirTable("entreprise");
            $mail = $this->Connexion->avoirTableConditionnee("adressemail where adressemail like '".$monentreprise[0]->adressemail."'");
            return $mail[0];
        }


        public function message($client){
            $mail = $this->monMail();

            $messages = $this->Connexion->avoirTableConditionnee(sprintf("v_mailmessage where (envoyeur='%s' and destinataire='%s') or (envoyeur='%s' and destinataire='%s') order by dateenvoie", $mail['idadressemail'], $client['idadressemail'], $client['idadressemail'], $mail['idadressemail']));

            $a=0;
            foreach($messages as $message){
                $messages[$a]['etat'] = 0;
                $messages[$a]['p'] = 0;

                if($message['envoyeur'] == $mail['idadressemail']){
                    $messages[$a]['etat'] = 1;
                }
                if($message['piecejointe'] !="" && $message['piecejointe']!=null){
                    $messages[$a]['p'] = 1;
                }

                $a++;
            }

            // var_dump($messages);

            return $messages;
        }



    }
    
?>