-----------------------------------------Vue demande de proforma client-------------------------
create or replace view v_demandeProformaClient as
    select c.*, dp.dateInsertion,dp.etat,dp.iddemandeproforma from demandeProforma dp
        join client c on c.IdClient=dp.idClient;

-------------------------------------------v_detailDemandeProforma----------------------------------------
create or replace view v_detailDemandeProforma as
    select dp.*,nomArticle,quantite,a.idArticle from v_demandeProformaClient dp
        join detailDemandeProforma ddp on ddp.idDemandeProforma=dp.idDemandeProforma
        join article a on a.idArticle=ddp.idArticle;