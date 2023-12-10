<style>
    a :hover{
        color: orange;
    }

    a{color: orange;}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Listes </span> Bon de Sortie</h4>
              <div class="card">
                <h5 class="card-header">Bon de Sortie</h5>
                <div class="text-nowrap">
                  <table class="table">
                      <!-- <thead> -->
                        <tr>
                          <th><strong>Numero de Sortie</strong></th>
                          <th><strong>Date </strong></th>
                          <th><strong>Numero de commande</strong></th>
                          <th><strong></strong></th>
                        </tr>
                      <!-- </thead> -->
                      <tbody class="table-border-bottom-0">
                        <?php // var_dump($demandeemployevalider); ?>
                        <?php for($i=0; $i<count($bondeSortie); $i++){ ?>
                        <tr>
                            <td><?= $bondeSortie[$i]->idbondesortie; ?></td>
                            <td><?= $bondeSortie[$i]->dateinsertion; ?></td>
                            <td><?= $bondeSortie[$i]->idbondecommande; ?></td>
                            <td><span class="badge bg-label-warning me-1"><a  href="<?php echo site_url("BonDeSortie/versDetailBonDeSortie?idbondesortie=").$bondeSortie[$i]->idbondesortie; ?>">Voir Detail</a></span></td>
                            <td><span class="badge bg-label-warning me-1"><a  href="<?php echo site_url("BonDeLivraison/versDateLivraison?idbondesortie=").$bondeSortie[$i]->idbondesortie; ?>">Generer Bon de Livraison</a></span></td>
                        </tr>
                        <?php } ?>  
                      </tbody>
                  </table>
                </div>
              </div>


