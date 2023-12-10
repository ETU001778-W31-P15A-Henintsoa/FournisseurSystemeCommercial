
<style>
  #choix{
    width:900px;
       margin-left:300px;
       margin-right:auto;
  }
</style>
<div class="content-wrapper" id="choix">
<div class="container-xxl flex-grow-1 container-p-y" class="choix">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bon de</span> Livraison</h4>
             <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Inserer la date de livraison</h5>
                    </div>
                    <div class="card-body">
                      <form action="<?php  echo site_url("BonDeLivraison/genererBonDeLivraison"); ?>" method="post">
                      <input type="hidden" name="idbondesortie" value="<?= $idbondesortie ?>">
                      <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Date  de livraison</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date"  name="datelivraison" id="html5-date-input" />
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