CREATE TABLE GROUPE (
    idG INT PRIMARY KEY,
    nomG VARCHAR(50),
    nbTechG INT,
    nbPersG INT
);

CREATE TABLE SALLE (
    idS INT PRIMARY KEY,
    nomS VARCHAR(50),
    nbPlace INT,
    typePlace VARCHAR(50),
    adresseS VARCHAR(100),
    largeur INT,
    longueur INT,
    nbPlacesLo INT,
    nbTechS INT
);


CREATE TABLE MATERIEL (
    idM INT PRIMARY KEY,
    nomM VARCHAR(50),
    typeM VARCHAR(50),
    idG INT,
    idS INT,
    idSt INT,
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idS) REFERENCES SALLE(idS)
);

CREATE TABLE HOTEL (
    idH INT PRIMARY KEY,
    adresseH VARCHAR(100),
    nbPlaceH INT
);

CREATE TABLE PARKING (
    idPark INT PRIMARY KEY,
    nbPlaceVoiture INT,
    adressePark VARCHAR(100)
);

CREATE TABLE CONCERT (
    idC INT PRIMARY KEY,
    dateCo DATE,
    heureArrive TIME,
    debutConcert TIME,
    dureeConcert TIME,
    idG INT,
    idS INT,
    idPark INT,
    idH INT,
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idS) REFERENCES SALLE(idS),
    FOREIGN KEY(idPark) REFERENCES PARKING(idPark),
    FOREIGN KEY(idH) REFERENCES HOTEL(idH),
    CONSTRAINT temps CHECK ((0<ABS(debutConcert-heureArrive+dureeConcert)) AND ABS((debutConcert-heureArrive+dureeConcert<60*60*24)))
);

CREATE TABLE COMMENTAIRE (
    idCom INT PRIMARY KEY,
    msg VARCHAR(2500),
    idC INT,
    FOREIGN KEY(idC) REFERENCES CONCERT(idC)
);


CREATE TABLE RESTAURANT (
    idR INT PRIMARY KEY,
    nbPlaceR INT,
    adresseR VARCHAR(100)
);

CREATE TABLE RESTAURATION (
    idR INT,
    idC INT,
    heureRest TIME,
    PRIMARY KEY(idR, idC),
    FOREIGN KEY(idC) REFERENCES CONCERT(idC),
    FOREIGN KEY(idR) REFERENCES RESTAURANT(idR)
);

CREATE TABLE TRANSPORT (
    idT INT PRIMARY KEY,
    dureeT INT,
    heureT DATE
);

CREATE TABLE DEPLACE (
    idC INT,
    idT INT,
    PRIMARY KEY(idC, idT),
    FOREIGN KEY(idC) REFERENCES CONCERT(idC),
    FOREIGN KEY(idT) REFERENCES TRANSPORT(idT)
);

CREATE TABLE PERSONNEL (
    idP INT PRIMARY KEY,
    emailP VARCHAR(50),
    telephoneP VARCHAR(12)
);

CREATE TABLE PERSONNEL_ACCUEIL(
    idC INT,
    idP INT,
    PRIMARY KEY(idC,idP),
    FOREIGN KEY(idC) REFERENCES CONCERT(idC),
    FOREIGN KEY(idP) REFERENCES PERSONNEL(idP)
);