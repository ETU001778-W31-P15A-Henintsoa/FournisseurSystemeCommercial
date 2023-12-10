<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Facture</h4>

        <!-- Logo -->
        
       
        <!-- <div class="card">
            <center>
              <h3>Bon de Commande</h3>
            <h3><?php
                // date_default_timezone_set('Africa/Nairobi');
              //$date=new dateTime($donnee['date']->date);
                // echo $detail[0]->datebondesortie;
              ?> </h3>  
            </center>
        </div> -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <p for=""><strong>Numero de facture : </strong> <?php echo $detail[0]->idfacture; ?></p>
                        <p for=""><strong>Date de facturation: </strong> <?php echo $detail[0]->datefacturation; ?></p>
                        <p for=""><strong>Numero de Commande : </strong> <?php echo $detail[0]->idbondecommande; ?></p>
                        <p for=""><strong>Paiement : </strong> <?php echo $detail[0]->paiement; ?> jours</p>
                        <p for=""><strong>Client : </strong> <?php echo $detail[0]->nom; ?></p>
                        <p for=""><strong>Adresse : </strong> <?php echo $detail[0]->adresse ."</br>".$detail[0]->ville; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header"></h5>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>quantite</th>
                                <th>Prix Unitaire</th>
                                <th>Prix TTC</th>
                                <th>Prix HT</th>
                                <th>Prix TVA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sommeTTC = 0;
                                $sommeHT = 0;
                                $sommeTVA = 0; 
                                foreach($detail as $details) { ?>
                            <tr>
                                <td><?php echo $details->nomarticle; ?></td>
                                <td><?php echo $details->quantite; ?></td>
                                <td><?php echo $details->prixunitaire; ?> Ar</td>
                                <td><?php echo $ttc = ($details->prixunitaire)*($details->quantite); ?>Ar</td>
                                <td><?php echo $ht = $ttc / (1.2); ?> Ar</td>
                                <td><?php echo $tva = $ht * (0.2); ?> Ar</td>
                            </tr> 
                            <?php
                                $sommeTTC += $ttc;
                                $sommeHT += $ht;
                                $sommeTVA += $tva; 
                             } ?>
                             <tr>
                                <td></td><td></td><td></td>
                                <td><?php echo  $sommeTTC; ?> Ar</td>
                                <td><?php echo  $sommeHT; ?> Ar</td>
                                <td><?php echo  $sommeTVA; ?> Ar</td>
                            <tr>
                        </tbody>
                     
                    </table>
                </div>
            </div>
        </div>


</div>