CREATE TABLE SALLE (
    idS INT PRIMARY KEY,
    nomS VARCHAR(50),
    nbPlaceS INT,
    typePlaceS VARCHAR(50),
    adresseS VARCHAR(100),
    largeurS INT,
    longueurS INT,
    nbPlacesLo INT,
    nbTechS INT
);


CREATE TABLE GROUPE (
    idG INT PRIMARY KEY,
    nomG VARCHAR(50),
    mail VARCHAR(50),
    nbTechG INT,
    nbPersG INT
);

CREATE TABLE TYPEM (
    typeM VARCHAR(50) PRIMARY KEY,
    color VARCHAR(50) 
);

CREATE TABLE MATERIEL (
    idM INT PRIMARY KEY AUTO_INCREMENT,
    nomM VARCHAR(50),
    typeM VARCHAR(50),
    qteAsso INT,
    FOREIGN KEY(typeM) REFERENCES TYPEM(typeM)
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
    commentaire VARCHAR(10000),
    idG INT NOT NULL,
    idS INT NOT NULL,
    FOREIGN KEY(idS) REFERENCES SALLE(idS),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG)
);

CREATE TABLE BESOIN (
    idC INT,
    idM INT,
    nbBesoin INT,
    PRIMARY KEY (idC,idM),
    FOREIGN KEY(idC) REFERENCES CONCERT(idC),
    FOREIGN KEY(idM) REFERENCES MATERIEL(idM)
);

CREATE TABLE AVOIRGROUPE (
    idG INT,
    idM INT,
    qte INT,
    PRIMARY KEY (idG,idM),
    FOREIGN KEY(idG) REFERENCES GROUPE(idG),
    FOREIGN KEY(idM) REFERENCES MATERIEL(idM)
);

CREATE TABLE AVOIRSALLE (
    idS INT,
    idM INT,
    qte INT,
    PRIMARY KEY (idS,idM),
    FOREIGN KEY(idS) REFERENCES SALLE(idS),
    FOREIGN KEY(idM) REFERENCES MATERIEL(idM)
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

