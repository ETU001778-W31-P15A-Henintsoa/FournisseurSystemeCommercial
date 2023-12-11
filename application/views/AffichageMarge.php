<style>
    a :hover{
        color: orange;
    }

    a{color: orange;}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Listes  </span> des ventes entre <?php echo $datedebut." et ".$datefin; ?></h4>
              <div class="card">
                <h5 class="card-header">Listes Ventes</h5>
                <div class="text-nowrap">
                  <table class="table">
                      <!-- <thead> -->
                        <tr>
                          <th><strong>Date</strong></th>
                          <th><strong>Article </strong></th>
                          <th><strong>quantite</strong></th>
                          <th><strong>Prix Unitaire</strong></th>
                          <th><strong>Marge brute</strong></th>
                          <th><strong>% par vente</strong></th>
                          <th><strong>% par stock</strong></th>
                        </tr>
                      <!-- </thead> -->
                      <tbody class="table-border-bottom-0">
                          <?php
                          $sommeParVente = 0;
                          $sommeParStock = 0;
                          for ($i = 0; $i < count($detail); $i++) { ?>
                              <tr>
                                  <td><?= $detail[$i]->datemouvement; ?></td>
                                  <td><?= $detail[$i]->nomarticle; ?></td>
                                  <td><?= $detail[$i]->quantiteretirer; ?></td>
                                  <td><?= isset($prixVenteDetail[$i]) ? $prixVenteDetail[$i] : ''; ?></td>
                                  <td><?= isset($margeArticle[$i]) ? $margeArticle[$i] : ''; ?></td>
                                  <td><?= isset($parVente[$i]) ? $parVente[$i] : ''; ?>%</td>
                                  <td><?= isset($parStock[$i]) ? $parStock[$i] : ''; ?>%</td>
                              </tr>
                              <?php
                              // Initialize variables $parVente and $parStock if they are not already initialized
                              $parVente[$i] = isset($parVente[$i]) ? $parVente[$i] : 0;
                              $parStock[$i] = isset($parStock[$i]) ? $parStock[$i] : 0;

                              $sommeParVente += $parVente[$i];
                              $sommeParStock += $parStock[$i];
                          } ?>
                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Total</td>
                              <td><?= isset($margeBrute) ? $margeBrute : ''; ?></td>
                              <td><?= $sommeParVente; ?>%</td>
                              <td><?= $sommeParStock; ?>%</td>
                          </tr>
                      </tbody>

                  </table>
                </div>
              </div>


