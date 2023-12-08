
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
                      <h5 class="mb-0">Inserer dans stock</h5>
                      <!-- <small class="text-muted float-end">Default label</small> -->
                    </div>
                    <div class="card-body">
                      <form action="<?php  echo site_url("Achat/insererStock"); ?>" method="post">
                      <div class="mb-3 row">
                      <label for="defaultSelect" class="form-label">Date entree stock</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date"  name="dateEntree" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 row">
                      <label for="defaultSelect" class="form-label">Date fin validite</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date"  name="datefin" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3">
                            <label for="defaultSelect" class="form-label">Article</label>
                            <select id="defaultSelect" class="form-select" name="article">
                            <?php for($i=0;$i<count($article);$i++) { ?>
                                <option value="<?php echo $article[$i]->idarticle; ?>"><?php echo $article[$i]->nomarticle; ?> </option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 row">
                            <label for="defaultSelect" class="form-label">quantite</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number"  id="html5-date-input" name="quantite" />
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="defaultSelect" class="form-label">Prix Unitaire</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text"  id="html5-date-input" name="prix" />
                                </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Inserer</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
</div>
</div>