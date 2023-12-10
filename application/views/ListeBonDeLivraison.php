<style>
    a :hover{
        color: orange;
    }

    a{color: orange;}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Listes </span> Bon de Livraison</h4>
              <div class="card">
                <h5 class="card-header">Bon de Livraison</h5>
                <div class="text-nowrap">
                  <table class="table">
                      <!-- <thead> -->
                        <tr>
                          <th><strong>Numero de Livraison</strong></th>
                          <th><strong>Date de livraison </strong></th>
                          <th><strong>Numero de commande</strong></th>
                          <th><strong>Client</strong></th>
                          <th><strong></strong></th>
                        </tr>
                      <!-- </thead> -->
                      <tbody class="table-border-bottom-0">
                        <?php for($i=0; $i<count($bondelivraison); $i++){ ?>
                        <tr>
                            <td><?= $bondelivraison[$i]->idbondelivraison; ?></td>
                            <td><?= $bondelivraison[$i]->datelivraison; ?></td>
                            <td><?= $bondelivraison[$i]->idbondecommande; ?></td>
                            <td><?= $bondelivraison[$i]->nom; ?></td>
                            <td><span class="badge bg-label-warning me-1"><a  href="<?php echo site_url("BonDeLivraison/versDetailBonDeLivraison?idbondelivraison=").$bondelivraison[$i]->idbondelivraison; ?>">Voir Detail</a></span></td>
                        </tr>
                        <?php } ?>  
                      </tbody>
                  </table>
                </div>
              </div>


