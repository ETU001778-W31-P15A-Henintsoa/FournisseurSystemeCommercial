create database fournisseur;
\c fournisseur

------------------------------------Employe-----------------------------------------------
create sequence seqEmploye;
create table employe(
    idEmploye varchar(20) default concat('EMP'|| nextval('seqEmploye')) primary key,
    nom varchar(50),
    prenom varchar(50),
    adresse varchar(30),
    matricule varchar(20),
    dateNaissance date,
    mail varchar(50),
    motDePasse varchar(50),
    etat int-------(0 efa tsy miasa intsony, 1 mbola miasa tsara)-----
);
------------------------------------Departement-----------------------------------------------
create sequence seqDepartement;
create table departement(
    idDepartement varchar(20) default concat('DEPT'|| nextval('seqDepartement')) primary key,
    nomDepartement varchar(50)
);

------------------------------------------Branche------------------------------------------
create sequence seqBranche;
create table branche(
    idBranche varchar(20) default concat('BRA'|| nextval('seqBranche')) primary key,
    salaireMax float,
    salaireMin float,
    njHParPersonne float,
    mission text,
    descriptionPoste text
);

--------------------------------Branche Departement--------------------------------------------
create sequence seqBrancheDepartement;
create table brancheDepartement(
    idBrancheDepartement varchar(20) default concat('BDEPT'|| nextval('seqBrancheDepartement')) primary key,
    idBranche varchar(20),
    idDepartement varchar(20),
    foreign key(idBranche) references branche(idBranche),
    foreign key(idDepartement) references departement(idDepartement)
);

------------------------------------EmployePoste--------------------------------------------
create sequence seqEmployePoste;
create table employePoste(
    idEmployePoste varchar(20) default concat('EPOST'|| nextval('seqEmployePoste')) primary key,
    idBrancheDepartement varchar(20),
    dateEmbauche date,
    idEmploye varchar(20),
    foreign key(idEmploye) references employe(idEmploye),
    foreign key(idBrancheDepartement) references brancheDepartement(idBrancheDepartement)
);


-----------------------------Type article---------------------------------
create sequence seqTypeArticle;
create table typeArticle(
    idTypeArticle varchar(20) default concat('TART'|| nextval('seqTypeArticle')) primary key,
    libelle varchar(50)
);

--------------------------------Article-------------------------------
create sequence seqArticle;
create table article(
    idArticle varchar(20) default concat('ART'|| nextval('seqArticle')) primary key,
    nomArticle varchar(20),
    idTypeArticle varchar(20),
    type varchar(10)
);

---------------------------------Stock-------------------------------------
create sequence seqStock;
create table stock(
    idStock varchar(20) default concat('STO' || nextval('seqStock')) primary key,
    idArticle varchar(20),
    quantite float,
    dateFinValidite date,
    prixUnitaire float,
    foreign key(idArticle) references article(idArticle)
);

---------------------------------Client-----------------------------------------
create sequence seqClient;
create table client(
    idClient varchar(20) default concat('CLI' || nextval('seqClient')) primary key,
    nom varchar(50),
    adresse varchar(50),
    ville varchar(30)
);

---------------------------------------Demande proforma------------------------------------------------
create sequence seqDemandeProforma;
create table demandeProforma(
    idDemandeProforma varchar(20) default concat('DPRO' || nextval('seqDemandeProforma')) primary key,
    dateInsertion date,
    idClient varchar(20),
    foreign key(idClient) references client(idClient)
);
alter table demandeProforma add etat int;
---------------------------------------------Detail demande de proforma--------------------------------
create sequence seqDetailDemandeProforma;
create table detailDemandeProforma(
    idDetailDemandeProforma varchar(20) default concat('DPRO' || nextval('seqDemandeProforma')) primary key,
    idArticle varchar(20),
    quantite float,
    foreign key(idArticle) references article(idArticle)
);

alter table detailDemandeProforma add idDemandeProforma varchar(20), add constraint haha foreign key(idDemandeProforma) references demandeProforma(idDemandeProforma);

------------------------------------ VILLE ---------------------------------------
create sequence seqVille;
create table Ville(
    idVille varchar(20) default concat('VILLE' || nextval('seqVille')) primary key,
    nomVille varchar(30) -- Nom de la ville
);

------------------------------------ ENTREPRISE ---------------------------------------
create sequence seqEntreprise;
create table Entreprise(
    idEntreprise varchar(20) default concat('ENT' || nextval('seqEntreprise')) primary key,
    nomEntreprise varchar(20),
    adresse varchar(50),
    numerofax varchar(20),
    contact varchar(15),
    adressemail varchar(50),
    idVille varchar(20),
    foreign key (idVille) references  Ville(idVille)
);

alter table client add adressemail varchar(50);

update client set adressemail='dimpex@gmail.com';

-- -------------------------Santatra 05-12-2023--------------------------------------
create sequence seqBonDeCommande;
create table BonDeCommande(
    idBonDeCommande varchar(20) default concat('BDC' || nextval('seqBonDeCommande')) primary key,
    idClient varchar(20),
    dateInsertion date default current_date,
    etat int default 0,
    foreign key(idClient) references Client(idClient)
);

create sequence seqDetailBonDeCommande;
create table DetailBonDeCommande(
    idDetailBonDeCommande varchar(20) default concat('DBDC' || nextval('seqDetailBonDeCommande')) primary key,
    idBonDeCommande varchar(20),
    idArticle varchar(20),
    quantite float,
    foreign key(idBonDeCommande) references BonDeCommande(idBonDeCommande),
    foreign key(idArticle) references Article(idArticle)
);

create sequence seqBonDeSortie;
create table BonDeSortie(
    idBonDeSortie varchar(20) default concat('BDS' || nextval('seqBonDeSortie')) primary key,
    dateInsertion date default current_date,
    idBonDeCommande varchar(20),
    etat int default 0,
    foreign key(idBonDeCommande) references BonDeCommande(idBonDeCommande)
);

create sequence seqDetailBonDeSortie;
create table DetailBonDeSortie(
    idDetailBonDeSortie varchar(20) default concat('DBS' || nextval('seqDetailBonDeSortie')) primary key,
    idBonDeSortie varchar(20),
    idArticle varchar(20),
    quantite float,
    foreign key(idBonDeSortie) references BonDeSortie(idBonDeSortie),
    foreign key(idArticle) references Article(idArticle)
);

-- -------------------------Santatra 06-12-2023--------------------------------------
create sequence seqCategorie;
create table Categorie(
    idCategorie varchar(20) default concat('CAT' || nextval('seqCategorie')) primary key,
    nomCategorie varchar(20)
);

alter table Article add column categorie varchar(20),add constraint categorie foreign key(categorie) references Categorie(idCategorie);

alter table stock add column dateinsertion date;

create sequence seqLivraison;
create table BonDeLivraison(
    idBonDeLivraison varchar(20) default concat('LIV' || nextval('seqLivraison')) primary key,
    dateLivraison date,
    dateinsertion date default current_date,
    idBonDeSortie varchar(20),
    etat int default 0,
    foreign key(idBonDeSortie) references BonDeSortie(idBonDeSortie)
);

create sequence seqDetailLivraison;
create table DetailBonDeLivraison(
    idDetailBonDeLivraison varchar(20) default concat('DLIV' || nextval('seqDetailLivraison')) primary key,
    idBonDeLivraison varchar(20),
    idArticle varchar(20),
    quantite float,
    foreign key(idBonDeLivraison) references BonDeLivraison(idBonDeLivraison),
    foreign key(idArticle) references Article(idArticle)
);

create sequence seqFacture;
CREATE TABLE facture(
    idFacture varchar(20) default concat('FACT' || nextval('seqFacture')) primary key,
    idBonDeCommande varchar(20),
    dateFacturation date default current_date,
    paiement int, --jour de paiement exemple 30j
    TVA float,
    etat int default 0,
    foreign key(idBonDeCommande) references BonDeCommande(idBonDeCommande)
);

create sequence seqDetailFacture;
CREATE TABLE DetailFacture(
    idDetailFacture varchar(20) default concat('DFACT' || nextval('seqDetailFacture')) primary key,
    idFacture varchar(20),
    idArticle varchar(20),
    quantite float,
    prixUnitaire float, --prix de vente a calculer
    foreign key(idFacture) references Facture(idFacture),
    foreign key(idArticle) references Article(idArticle)
);

create sequence seqMouvement;
create table Mouvement(
    idMouvement varchar(20) default concat('MVT' || nextval('seqMouvement')) primary key,
    dateMouvement date default current_date,
    idStock varchar(20),
    quantiteretirer float,
    foreign key(idStock) references Stock(idStock)
);
