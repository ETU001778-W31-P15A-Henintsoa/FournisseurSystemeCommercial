<style>
    a :hover{
        color: orange;
    }

    a{color: orange;}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Listes </span> Factures</h4>
              <div class="card">
                <h5 class="card-header">Factures</h5>
                <div class="text-nowrap">
                  <table class="table">
                      <!-- <thead> -->
                        <tr>
                          <th><strong>Numero de facture</strong></th>
                          <th><strong>Date de facturation </strong></th>
                          <th><strong>Numero de commande</strong></th>
                          <th><strong>paiement</strong></th>
                          <th><strong></strong></th>
                        </tr>
                      <!-- </thead> -->
                      <tbody class="table-border-bottom-0">
                        <?php // var_dump($demandeemployevalider); ?>
                        <?php for($i=0; $i<count($facture); $i++){ ?>
                        <tr>
                            <td><?= $facture[$i]->idfacture; ?></td>
                            <td><?= $facture[$i]->datefacturation; ?></td>
                            <td><?= $facture[$i]->idbondecommande; ?></td>
                            <td><?= $facture[$i]->paiement." jours"; ?></td>
                            <td><span class="badge bg-label-warning me-1"><a  href="<?php echo site_url("Facture/versDetailFacture?idFacture=").$facture[$i]->idfacture; ?>">Voir Detail</a></span></td>
                            <td><span class="badge bg-label-warning me-1"><a  href="<?php echo site_url("Facture/versPDFFacture?idFacture=").$facture[$i]->idfacture; ?>">Generer PDF</a></span></td>
                        </tr>
                        <?php } ?>  
                      </tbody>
                  </table>
                </div>
              </div>


