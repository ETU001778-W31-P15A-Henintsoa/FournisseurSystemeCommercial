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

-- -----------------------------------Categorie----------------------------------------
insert into Categorie(nomCategorie) values('FIFO'),('LIFO'),('CMUP');

update Article set categorie='CAT1' where idarticle='ART1';
update Article set categorie='CAT2' where idarticle='ART2';
update Article set categorie='CAT3' where idarticle='ART3';

update stock set dateinsertion='2023-11-21' where idstock='STO1';
update stock set dateinsertion='2023-11-21' where idstock='STO2';
update stock set dateinsertion='2023-11-21' where idstock='STO3';

 ----------------------------------------------departement-------------------------------------------------
INSERT INTO Departement (nomDepartement)
VALUES
    ('logistique'),
    ('Service livraison'),
    ('Finance');

 ----------------------------------------------departement-------------------------------------------------
INSERT INTO Employe (nom, prenom, adresse, matricule, dateNaissance, mail, motDePasse, etat)
VALUES
  ('Ariette', 'Loyola', '123 Rue de la Sarbone', 'MAT12345', '1990-05-15', 'ariette@email.com', 'mdp1234', 1),
  ('Stanley', 'Judi', '123 Rue de la Sarbone', 'MAT12345', '1990-05-15', 'stanley@email.com', 'mdp12345', 1),
  ('Roberto', 'Jackson', '123 Rue de la Sarbone', 'MAT12345', '1990-05-15', 'roberto@email.com', 'mdp123456', 1);

-----------------------------------------------Branche----------------------------------------------------------
INSERT INTO Branche (nomBranche,salaireMax, salaireMin, njHParPersonne, mission, descriptionPoste)
VALUES
    ('Magasinier',50000.00, 30000.00, 8.0, 'Reponsable des stocks de produits', 'Gestion de sortie et entré des stocks'),
    ('Livreur',50000.00, 30000.00, 8.0, 'Livraison des produits des clients', 'Vous devez vous assurez que chaque produit arrive bien à destination'),
    ('Comptable',50000.00, 30000.00, 8.0, 'Assure le bon fonctionnement des activités financières', 'Analyste financier responsable de lanalyse des états financiers');

-----------------------------------------------BrancheDepartement-------------------------------------------------
insert into brancheDepartement(idBranche,idDepartement) values
('BRA1','DEPT1'),
('BRA2','DEPT2'),
('BRA3','DEPT3');

--------------------------------------Poste EMploye-----------------------------------------------------------
insert into employePoste(idBrancheDepartement,dateEmbauche,idEmploye) values
('BDEPT1','2021-02-04','EMP1'),
('BDEPT2','2020-02-04','EMP2'),
('BDEPT3','2022-02-04','EMP3');

-- --------------------------------------Validation-----------------------------------------------------------
insert into validation(idBrancheDepartement,libelle) values
('BDEPT1','magasin');
insert into validation(idBrancheDepartement,libelle) values
('BDEPT2','livraison');
insert into validation(idBrancheDepartement,libelle) values
('BDEPT3','vente');