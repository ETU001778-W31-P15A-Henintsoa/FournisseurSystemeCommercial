-----------------------------------------Vue demande de proforma client-------------------------
create or replace view v_demandeProformaClient as
    select c.*, dp.dateInsertion,dp.etat,dp.iddemandeproforma from demandeProforma dp
        join client c on c.IdClient=dp.idClient;

-------------------------------------------v_detailDemandeProforma----------------------------------------
create or replace view v_detailDemandeProforma as
    select dp.*,nomArticle,quantite,a.idArticle from v_demandeProformaClient dp
        join detailDemandeProforma ddp on ddp.idDemandeProforma=dp.idDemandeProforma
<<<<<<< Updated upstream
        join article a on a.idArticle=ddp.idArticle;
=======
        join article a on a.idArticle=ddp.idArticle;

-- ----------------------------------v_stock----------------------------------------------
create or replace view v_StockArticle as
    select s.idArticle,a.nomArticle,s.quantite,s.prixUnitaire,s.dateFinValidite
    from stock s
    join article a on a.idArticle = s.idArticle;

-- ---------------------------------v_bondecommande---------------------------------------
create or replace view v_bondecommande as
    select c.nom,c.adresse,c.ville,c.adressemail,BonDeCommande.*
    from BonDeCommande 
        join client c on c.idClient = BonDeCommande.idClient;

-- ------------------------------v_DetailBonDeCommande------------------------------
create or replace view v_DetailBonDeCommande as
    select d.*,a.nomArticle,b.nom,b.adresse,b.ville,b.adressemail,b.idclient,b.dateinsertion
    from DetailBonDeCommande d
        join v_bondecommande b on b.idBonDeCommande=d.idBonDeCommande
        join article a on a.idArticle = d.idArticle;

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

-- ---------------------------v_livraison---------------------------
create or replace view v_bondelivraison as
    select vb.*,bl.dateLivraison,bl.dateinsertion as dateinsertionLivraison,bl.idBonDeLivraison
    from BonDeLivraison bl
        join v_bondesortie vb on bl.idbondesortie = vb.idbondesortie; 

----------------------------v_detaillivraison---------------------------
create or replace view v_detailLivraison as
    select vbl.*,dl.idarticle,dl.quantite,article.nomArticle
    from DetailBonDeLivraison dl 
        join v_bondelivraison vbl on vbl.idBonDeLivraison = dl.idBonDeLivraison 
        join Article on article.idarticle = dl.idarticle;

-- ------------------------v_facture---------------------------- 
create or replace view v_facture as
    select vb.*,f.dateFacturation,f.paiement,f.TVA,f.etat,f.idFacture
    from facture f
        join v_bondecommande vb on vb.idBonDeCommande = f.idBonDeCommande;

-- -------------------------v_detailFacture-------------------------
create or replace view v_detailFacture as
    select vf.*,df.idArticle,df.quantite,df.prixUnitaire,a.nomArticle
    from DetailFacture df 
        join v_facture vf on df.idFacture = vf.idFacture
        join Article a on a.idarticle = df.idarticle;
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======

-- -------------------------v_mouvement-----------------------
create or replace view v_mouvement as
    select a.nomArticle,s.*,m.dateMouvement,m.quantiteretirer
    from stock s
        join Mouvement m on m.idstock = s.idstock
        join Article a on a.idarticle = s.idArticle;
>>>>>>> Stashed changes
