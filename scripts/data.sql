--------------------------------------Client--------------------------------------------------------
insert into client values
(default,'Dimpex','Lot Vt Andohamandroseza','Antananarivo');
----------------------------------type article---------------------------------------------------------
insert into typeArticle(libelle) values
('fourniture de bureau');


---------------------------------------article---------------------------------------------------
INSERT INTO Article (nomArticle, idTypeArticle)
VALUES
    ('Stylo', 'TART1'),
    ('Cahier', 'TART1'),
    ('Classeur', 'TART1');

-------------------------------------Stock------------------------------------------------------------
insert into stock values
(default,'ART1',100,'2023-12-22',700),
(default,'ART2',100,'2023-12-22',1500),
(default,'ART3',100,'2023-12-22',3000);

---------------------------------proforma----------------------------------------------------------
insert into demandeProforma(dateInsertion,idClient) values('26-11-2023','CLI1');
insert into detailDemandeProforma(idArticle,quantite) values('ART1',10);

------------------------------------ VILLE ---------------------------------------
insert into Ville(nomVille) values
 ('Antananarivo'),
 ('Antsirable');

------------------------------------ Entreprise ---------------------------------------
insert into entreprise(nomEntreprise, adresse, numerofax, contact, adressemail, idVille) values
('JUMBO', 'Lot 44BC BIS Andoharanofotsy', '00499221/709-338', '+261 332178522', 'jumbo@gmail.com', 'VILLE1');
