
<style>
  #choix{
    width:900px;
       margin-left:300px;
       margin-right:auto;
  }
</style>
<div class="content-wrapper" id="choix">
<div class="container-xxl flex-grow-1 container-p-y" class="choix">
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Generer un facture</h5>
                      <!-- <small class="text-muted float-end">Default label</small> -->
                    </div>
                    <div class="card-body">
                      <form action="<?php  echo site_url("Facture/genererFacture"); ?>" method="post">
                      <div class="mb-3">
                            <label for="defaultSelect" class="form-label">Numero de commande</label>
                            <select id="defaultSelect" class="form-select" name="bondecommande">
                            <?php for($i=0;$i<=count($bondecommande);$i++) { ?>
                                <option value="<?php echo $bondecommande[$i]->idbondecommande; ?>"><?php echo $bondecommande[$i]->idbondecommande."_". $bondecommande[$i]->dateinsertion."_".$bondecommande[$i]->nom; ?> </option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 row">
                            <label for="defaultSelect" class="form-label">Paiement</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number"  id="html5-date-input" name="paiement" />
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="defaultSelect" class="form-label">TVA</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number"  id="html5-date-input" name="tva" />
                                </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Generer</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
</div>
</div>