
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
                      <h5 class="mb-0">Choisissez deux dates</h5>
                      <!-- <small class="text-muted float-end">Default label</small> -->
                    </div>
                    <div class="card-body">
                      <form action="<?php  echo site_url("Achat/versMarge"); ?>" method="post">
                      <div class="mb-3 row">
                      <label for="defaultSelect" class="form-label">Date Debut</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date"  name="datedebut" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 row">
                      <label for="defaultSelect" class="form-label">Date Fin</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date"  name="datefin" id="html5-date-input" />
                        </div>
                      </div>
                        
                        <button type="submit" class="btn btn-primary">Voir</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
</div>
</div>