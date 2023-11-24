<style>
    a :hover{
        color: orange;
    }

    a{color: orange;}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Listes </span> Demandes de proforma non Convertie</h4>
              <div class="card">
                <h5 class="card-header">Demandes de proforma non convertie</h5>
                <div class="text-nowrap">
                  <table class="table">
                      <!-- <thead> -->
                        <tr>
                          <th><strong>id de demande</strong></th>
                          <th><strong>Date d'insertion de la demande</strong></th>
                          <th><strong>client</strong></th>
                          <th><strong></strong></th>
                        </tr>
                      <!-- </thead> -->
                      <tbody class="table-border-bottom-0">
                        <?php // var_dump($demandeemployevalider); ?>
                        <?php for($i=0; $i<count($demandeProforma); $i++){ ?>
                        <tr>
                            <td>
                                <!-- <i class="fab fa-angular fa-lg text-danger me-3"></i>  -->
                            <?= $demandeProforma[$i]->iddemandeproforma ?></td>
                            <td><?= $demandeProforma[$i]->dateinsertion ?></td>
                            <td><?= $demandeProforma[$i]->nom ?></td>
                            <td><span class="badge bg-label-warning me-1"><a  href="<?php echo site_url('ProformaController/genererpdf?idDemandeProforma='.$demandeProforma[$i]->iddemandeproforma); ?>">Generer PDF</a></span></td>
                        </tr>
                        <?php } ?>  
                      </tbody>
                  </table>
                </div>
              </div>


