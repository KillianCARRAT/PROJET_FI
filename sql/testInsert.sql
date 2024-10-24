-- Insertion dans la table SALLE
INSERT INTO SALLE (idS, nomS, nbPlace, typePlace, adresseS, largeur, longueur, nbPlacesLo, nbTechS) 
VALUES (1, "Salle Olympia", 1500, "Assise", "12 rue des Artistes, Paris", 30, 40, 300, 5),
       (2, "Zenith Paris", 5000, "Debout", "211 avenue Jean Jaurès, Paris", 50, 80, 1000, 10);

-- Insertion dans la table HOTEL
INSERT INTO HOTEL (idH, adresseH, nbPlaceH) 
VALUES (1, "5 rue de l'Hôtel, Paris", 200),
       (2, "10 avenue des Champs, Paris", 300);

-- Insertion dans la table GROUPE
INSERT INTO GROUPE (idG, nomG, nbTechG, nbPersG, idH) 
VALUES (1, "The Rolling Stones", 10, 50, 1),
       (2, "Coldplay", 12, 60, 2);

-- Insertion dans la table HEBERGEMENT
INSERT INTO HEBERGEMENT (idH, idG, heureR, dateR) 
VALUES (1, 1, "14:00:00", "2024-10-20"),
       (2, 2, "15:00:00", "2024-10-21");

-- Insertion dans la table MATERIEL
INSERT INTO MATERIEL (idM, nomM, typeM, idG, idS) 
VALUES (1, "Guitare électrique", "Instrument", 1, 1),
       (2, "Microphone", "Sonorisation", 2, 2);

-- Insertion dans la table PARKING
INSERT INTO PARKING (idPark, nbPlaceVoiture, adressePark, idS) 
VALUES (1, 200, "Parking Olympia, Paris", 1),
       (2, 500, "Parking Zenith, Paris", 2);

-- Insertion dans la table CONCERT
INSERT INTO CONCERT (idC, dateCo, heureArrive, debutConcert, dureeConcert, idG, idM, idS) 
VALUES (1, "2024-10-25", "19:00:00", "20:00:00", "02:00:00", 1, 1, 1),
       (2, "2024-10-26", "18:00:00", "19:00:00", "01:30:00", 2, 2, 2);

-- Insertion dans la table COMMENTAIRE
INSERT INTO COMMENTAIRE (idCom, msg, idC) 
VALUES (1, "Super concert !", 1),
       (2, "Le son était incroyable !", 2);

-- Insertion dans la table RESTAURANT
INSERT INTO RESTAURANT (idR, nbPlaceR, adresseR) 
VALUES (1, 100, "10 rue de la Gastronomie, Paris"),
       (2, 150, "20 avenue des Saveurs, Paris");

-- Insertion dans la table RESTAURATION
INSERT INTO RESTAURATION (idR, idG, heureR, dateR) 
VALUES (1, 1, "12:00:00", "2024-10-25"),
       (2, 2, "13:00:00", "2024-10-26");

-- Insertion dans la table TRANSPORT
INSERT INTO TRANSPORT (idT, dureeT, heureT) 
VALUES (1, 60, "2024-10-24"),
       (2, 90, "2024-10-25");

-- Insertion dans la table DEPLACE
INSERT INTO DEPLACE (idG, idT) 
VALUES (1, 1),
       (2, 2);

-- Insertion dans la table PERSONNEL
INSERT INTO PERSONNEL (idP, emailP, telephoneP) 
VALUES (1, "accueil@concert.com", "0123456789"),
       (2, "tech@concert.com", "0987654321");

-- Insertion dans la table PERSONNEL_ACCUEIL
INSERT INTO PERSONNEL_ACCUEIL (idC, idP) 
VALUES (1, 1),
       (2, 2);
