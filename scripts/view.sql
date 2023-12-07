-----------------------------------------Vue demande de proforma client-------------------------
create or replace view v_demandeProformaClient as
    select c.*, dp.dateInsertion,dp.etat,dp.iddemandeproforma from demandeProforma dp
        join client c on c.IdClient=dp.idClient;

-------------------------------------------v_detailDemandeProforma----------------------------------------
create or replace view v_detailDemandeProforma as
    select dp.*,nomArticle,quantite,a.idArticle from v_demandeProformaClient dp
        join detailDemandeProforma ddp on ddp.idDemandeProforma=dp.idDemandeProforma
        join article a on a.idArticle=ddp.idArticle;

-- ----------------------------------v_stock----------------------------------------------
create or replace view v_StockArticle as
    select s.idArticle,a.nomArticle,s.quantite,s.prixUnitaire,s.dateFinValidite
    from stock s
    join article a on a.idArticle = s.idArticle;

-- ---------------------------------v_bondecommande---------------------------------------
create or replace view v_bondecommande as
    select c.nom,BonDeCommande.*
    from BonDeCommande 
        join client c on c.idClient = BonDeCommande.idClient;

-- ------------------------------v_DetailBonDeCommande------------------------------
create or replace view v_DetailBonDeCommande as
    select d.*,a.nomArticle,c.nom as client
    from DetailBonDeCommande d
        join BonDeCommande b on b.idBonDeCommande=d.idBonDeCommande
        join article a on a.idArticle = d.idArticle
        join client c on b.idClient = c.idClient;

-- ------------------------------v_Article-------------------------------------------
create or replace view v_Article as
    select article.* , categorie.nomCategorie
    from article
        join categorie on article.categorie = categorie.idCategorie;

-- -----------------------------v_bondesortie-------------------------------
create or replace view v_bondesortie as
    select vb.* , bs.dateInsertion as dateBondeSortie,bs.idBonDeSortie
    from BonDeSortie bs
        join v_bondecommande vb on  vb.idBonDeCommande = bs.idBonDeCommande;

-- ---------------------------v_detailbondesortie--------------------------------
create or replace view v_DetailBonDeSortie as
    select d.idDetailBonDeSortie,d.idArticle,d.quantite,vb.*,article.nomArticle
    from DetailBonDeSortie d
        join v_bondesortie vb on vb.idbondesortie = d.idbondesortie
        join article on article.idarticle = d.idarticle;

-- ---------------------------v_detailbondeLivraison---------------------------
create or replace view v_DetailBonDeLivraison as
    select 
    from BonDeLivraison bl
        join DetailBonDeLivraison dl  on bl.idBonDeLivraison = dl.idBonDeLivraison
        join v_DetailBonDeSortie vd on vd.idbondesortie = bl.idbondesortie