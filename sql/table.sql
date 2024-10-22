CREATE TABLE GROUPE (
    idG INT PRIMARY KEY,
    nomG VARCHAR(50)
);

CREATE TABLE ARTISTE (
    idA INT PRIMARY KEY,
    nomA VARCHAR(50),
    prenomA VARCHAR(50),
    dtnA DATE,
    lieuNaissance VARCHAR(100),
    adresseA VARCHAR(50),
    numeroSecu INT,
    numCongeSpect VARCHAR(100),
    numCNI VARCHAR(10),
    dateDelivrance DATE,
    dateExpiration DATE,
    reductionTrain VARCHAR(50)
);

CREATE TABLE APPARTIENT (
    idG INT,
    idA INT,
    PRIMARY KEY(idG, idA),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idA) REFERENCES ARTISTE(idA)
);

CREATE TABLE MATERIEL (
    idM INT PRIMARY KEY,
    nomM VARCHAR(50),
    typeM VARCHAR(50),
    idA INT,
    hauteurM DECIMAL(5,3),
    largeurM DECIMAL(5,3),
    profonfeurM DECIMAL(5,3),
    FOREIGN KEY(idA) REFERENCES ARTISTE(idA)
);

CREATE TABLE TECHNICIEN (
    idT INT PRIMARY KEY,
    emailT VARCHAR(50),
    telephoneT VARCHAR(20)
);

CREATE TABLE EQUIPE_TECHNIQUE (
    idG INT,
    idT INT,
    PRIMARY KEY(idG, idT),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idT) REFERENCES TECHNICIEN(idT)
);

CREATE TABLE SALLE (
    idS INT PRIMARY KEY,
    nomS VARCHAR(50),
    nbPlace INT,
    typePlace VARCHAR(50),
    adresseS VARCHAR(100),
    largeur INT,
    longueur INT
);

CREATE TABLE CONTIENT (
    idS INT,
    idM INT,
    PRIMARY KEY(idS, idM),
    FOREIGN KEY(idS) REFERENCES SALLE(idS),
    FOREIGN KEY(idM) REFERENCES MATERIEL(idM)
);

CREATE TABLE LOGES (
    idL INT PRIMARY KEY,
    nbPers INT,
    idS INT,
    FOREIGN KEY(idS) REFERENCES SALLE(idS)
);

CREATE TABLE MATERIEL_DEMANDE(
    idMD INT,
    idM INT,
    PRIMARY KEY(idMD,idM),
    FOREIGN KEY(idM) REFERENCES MATERIEL(idM)
);

CREATE TABLE TECHNICIEN_DEMANDE(
    idTD INT,
    idT INT,
    PRIMARY KEY(idTD,idT),
    FOREIGN KEY(idT) REFERENCES TECHNICIEN(idT)
);


CREATE TABLE RESERVATION (
    idR INT PRIMARY KEY,
    idS INT,
    idG INT,
    idTD INT,
    idMD INT,
    dateR DATE,
    dureeR INT,
    FOREIGN KEY(idS) REFERENCES SALLE(idS),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idTD) REFERENCES TECHNICIEN_DEMANDE(idTD),
    FOREIGN KEY(idMD) REFERENCES MATERIEL_DEMANDE(idMD)
);

CREATE TABLE CONCERT (
    idC INT PRIMARY KEY,
    dateC DATE,
    heureArrive TIME,
    tempPrep TIME,
    debutConcert TIME,
    dureeConcert TIME,
    idR INT,
    FOREIGN KEY(idR) REFERENCES RESERVATION(idR),
    CHECK (0<HOUR(tempPrep)<24)
);

CREATE TABLE FICHE_ACCEUIL (
    idAcc INT PRIMARY KEY,
    idR INT,
    FOREIGN KEY(idR) REFERENCES RESERVATION(idR)
);

CREATE TABLE RESTAURANT (
    idResto INT PRIMARY KEY,
    nbPlaceResto INT,
    adresseResto VARCHAR(100),
    prixResto DECIMAL(5, 3)
);

CREATE TABLE RESTAURATION (
    idAcc INT,
    idResto INT,
    dateResto DATE,
    PRIMARY KEY(idAcc, idResto, dateResto),
    FOREIGN KEY(idAcc) REFERENCES FICHE_ACCEUIL(idAcc),
    FOREIGN KEY(idResto) REFERENCES RESTAURANT(idResto)
);

CREATE TABLE VEHICULE (
    idV INT PRIMARY KEY,
    nomV VARCHAR(50),
    nbPlaceV INT,
    volumeV INT -- en litre
);

CREATE TABLE TRANSPORT (
    idAcc INT,
    idV INT,
    dateTrans DATE,
    dureeTrans INT,
    PRIMARY KEY(idAcc, idV, dateTrans),
    FOREIGN KEY(idAcc) REFERENCES FICHE_ACCEUIL(idAcc),
    FOREIGN KEY(idV) REFERENCES VEHICULE(idV)
);

CREATE TABLE PARKING (
    idPark INT PRIMARY KEY,
    nbPlaceVoiture INT,
    nbPlaceCamion INT,
    adressePark VARCHAR(100)
);

CREATE TABLE PARKING_PROCHE (
    idAcc INT,
    idPark INT,
    PRIMARY KEY(idAcc, idPark),
    FOREIGN KEY(idAcc) REFERENCES FICHE_ACCEUIL(idAcc),
    FOREIGN KEY(idPark) REFERENCES PARKING(idPark)
);

CREATE TABLE CHAMBRE (
    idChambre INT PRIMARY KEY,
    tailleChambre INT
);

CREATE TABLE HOTEL (
    idH INT PRIMARY KEY,
    adresseH VARCHAR(100),
    etoileH INT,
    prixH DECIMAL(5, 3)
);

CREATE TABLE CHAMBRE_HOTEL (
    idH INT,
    idChambre INT,
    PRIMARY KEY(idH, idChambre),
    FOREIGN KEY(idH) REFERENCES HOTEL(idH),
    FOREIGN KEY(idChambre) REFERENCES CHAMBRE(idChambre)
);

CREATE TABLE HEBERGEMENT (
    idAcc INT,
    idH INT,
    dateHebergement DATE,
    nbNuit INT,
    PRIMARY KEY(idAcc, idH),
    FOREIGN KEY(idAcc) REFERENCES FICHE_ACCEUIL(idAcc),
    FOREIGN KEY(idH) REFERENCES HOTEL(idH)
);

CREATE TABLE PERSONNEL (
    idPerso INT PRIMARY KEY,
    emailP VARCHAR(50),
    telephoneP VARCHAR(12)
);

CREATE TABLE PERSONNEL_ACCEUIL (
    idAcc INT,
    idPerso INT,
    PRIMARY KEY(idAcc, idPerso),
    FOREIGN KEY(idAcc) REFERENCES FICHE_ACCEUIL(idAcc),
    FOREIGN KEY(idPerso) REFERENCES PERSONNEL(idPerso)
);

CREATE TABLE COMMENTAIRE (
    idCom INT PRIMARY KEY,
    msg VARCHAR(2500),
    idR INT,
    FOREIGN KEY(idR) REFERENCES RESERVATION(idR)
);

CREATE TABLE STOCK_ASSOCIATION(
    idM INT PRIMARY KEY,
    FOREIGN KEY(idM) REFERENCES MATERIEL(idM)
);
