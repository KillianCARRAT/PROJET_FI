CREATE TABLE SALLE (
    idS INT PRIMARY KEY,
    nomS VARCHAR(50),
    nbPlaceS INT,
    typePlaceS VARCHAR(50),
    adresseS VARCHAR(100),
    largeurS INT,
    longueurS INT,
    nbPlacesLo INT,
    nbTechS INT,
    nbPlaceVoitureS INT
);

CREATE TABLE HOTEL (
    idH INT PRIMARY KEY,
    adresseH VARCHAR(100),
    nbPlaceH INT
);

CREATE TABLE GROUPE (
    idG INT PRIMARY KEY,
    nomG VARCHAR(50),
    mail VARCHAR(50),
    nbTechG INT,
    nbPersG INT
);

CREATE TABLE HEBERGEMENT (
    idH INT,
    idG INT,
    heureH TIME,
    dateH DATE,
    PRIMARY KEY(idH, idG),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idH) REFERENCES HOTEL(idH)
);

CREATE TABLE MATERIEL (
    idM INT PRIMARY KEY AUTO_INCREMENT,
    nomM VARCHAR(50),
    typeM VARCHAR(50),
    qte INT,
    idG INT,
    idS INT,
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idS) REFERENCES SALLE(idS)
);


CREATE TABLE CONCERT (
    idC INT PRIMARY KEY,
    dateC DATE,
    heureArrive TIME,
    debutConcert TIME,
    dureeConcert TIME,
    besoinTransport VARCHAR(50),
    besoinHotel VARCHAR(50),
    nombreTechNecessaire INT,
    dateMax DATE,
    idG INT NOT NULL,
    idS INT NOT NULL,
    FOREIGN KEY(idS) REFERENCES SALLE(idS),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    CONSTRAINT temps CHECK ((0<ABS(debutConcert-heureArrive+dureeConcert)) AND ABS((debutConcert-heureArrive+dureeConcert<60*60*24)))
);

CREATE TABLE BESOIN (
    idC INT,
    idM INT,
    nbBesoin INT,
    PRIMARY KEY (idC,idM),
    FOREIGN KEY(idC) REFERENCES CONCERT(idC),
    FOREIGN KEY(idM) REFERENCES MATERIEL(idM)
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
    idG INT,
    heureR TIME,
    dateR DATE,
    PRIMARY KEY(idR, idG),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idR) REFERENCES RESTAURANT(idR)
);

CREATE TABLE TRANSPORT (
    idT INT PRIMARY KEY,
    dureeT INT,
    heureT DATE
);

CREATE TABLE DEPLACE (
    idG INT,
    idT INT,
    PRIMARY KEY(idG, idT),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
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

CREATE TABLE UTILISATEUR(
    iden VARCHAR(5) PRIMARY KEY,
    mdp VARCHAR(100),
    typeU VARCHAR(3)
);

CREATE TABLE LIEN (
    idG INT,
    iden VARCHAR(5),
    PRIMARY KEY (idG,iden),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(iden) REFERENCES UTILISATEUR(iden)
);
