<style>
    a :hover{
        color: orange;
    }

    a{color: orange;}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Listes </span> Bon de Commande</h4>
              <div class="card">
                <h5 class="card-header">Bon de Commande</h5>
                <div class="text-nowrap">
                  <table class="table">
                      <!-- <thead> -->
                        <tr>
                          <th><strong>Numero de Commande</strong></th>
                          <th><strong>Date</strong></th>
                          <th><strong>client</strong></th>
                          <th><strong></strong></th>
                          <th><strong></strong></th>
                        </tr>
                      <!-- </thead> -->
                      <tbody class="table-border-bottom-0">
                        <?php // var_dump($demandeemployevalider); ?>
                        <?php for($i=0; $i<count($bondecommande); $i++){ ?>
                        <tr>
                            <td><?= $bondecommande[$i]->idbondecommande ?></td>
                            <td><?= $bondecommande[$i]->dateinsertion ?></td>
                            <td><?= $bondecommande[$i]->nom ?></td>
                            <td><span class="badge bg-label-warning me-1"><a  href="<?php echo site_url("BonDeCommande/versDetailsBonDeCommande?idbondecommande=").$bondecommande[$i]->idbondecommande; ?>">Voir Detail</a></span></td>
                            <td><span class="badge bg-label-warning me-1"><a  href="<?php echo site_url("BonDeSortie/genererBonDeSortie?idbondecommande=").$bondecommande[$i]->idbondecommande; ?>">Generer bon de sortie</a></span></td>
                        </tr>
                        <?php } ?>  
                      </tbody>
                  </table>
                </div>
              </div>


