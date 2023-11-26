<style>
    a :hover{
        color: orange;
    }

    a{color: orange;}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
              <div class="card">
                <?php 
                    if(count($proforma)>0){ ?>
                        <h5 class="card-header">Proforma pour la societe <?=$proforma[0]['societe']  ?></h5>
                    <?php }
                ?>
                <div class="text-nowrap">
                  <table class="table" border="1px">
                      <!-- <thead> -->
                        <tr>
                          <th><strong>Article</strong></th>
                          <th><strong>Quantite</strong></th>
                          <th><strong>Prix unitaire</strong></th>
                          <th><strong>Date de fin de validite</strong></th>
                        </tr>
                      <!-- </thead> -->
                      <tbody class="table-border-bottom-0">
                        <?php // var_dump($demandeemployevalider); ?>
                        <?php for($i=0; $i<count($proforma); $i++){ ?>
                        <tr>
                            <td><?= $proforma[$i]['article'] ?></td>
                            <td><?= $proforma[$i]['quantite'] ?></td>
                            <td><?= $proforma[$i]['prixUnitaire'] ?></td>
                            <td><?= $proforma[$i]['dateValidite'] ?></td>
                        </tr>
                        <?php } ?>  
                      </tbody>
                  </table>
                </div>
              </div>


