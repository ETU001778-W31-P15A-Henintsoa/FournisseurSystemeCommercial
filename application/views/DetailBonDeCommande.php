<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bon de</span> Commande</h4>

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
                        <p for=""><strong>Bon de Commande N : </strong> <?php echo $detail[0]->idbondecommande; ?></p>
                        <p for=""><strong>Client : </strong> <?php echo $detail[0]->nom; ?></p>
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
                                <th>Designation</th>
                                <th>quantite</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($detail as $details) { ?>
                            <tr>
                                <td><?php echo $details->nomarticle; ?></td>
                                <td><?php echo $details->quantite; ?></td>
                            </tr> 
                            <?php } ?>
                        </tbody>
                     
                    </table>
                </div>
            </div>
        </div>


</div>