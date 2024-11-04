-- Insert de test pour pasDeCheuvauchementConcerts (contrainte 3)

INSERT INTO SALLE VALUES(1,"test",30,"tst","3 rue",100,100,5,2);
INSERT INTO GROUPE VALUES(1,"eee",5,3);
INSERT INTO CONCERT VALUES(1,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),'8:00:00','9:00:00','3:00:00',1,1,NULL,NULL);
INSERT INTO CONCERT VALUES(2,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),'13:00:00','14:00:00','1:00:00',1,1,NULL,NULL);
INSERT INTO CONCERT VALUES(3,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),'12:00:00','13:00:00','2:00:00',1,1,NULL,NULL);
INSERT INTO CONCERT VALUES(4,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),'9:00:00','10:00:00','3:00:00',1,1,NULL,NULL);
INSERT INTO CONCERT VALUES(5,STR_TO_DATE("11/10/2010", "%d/%m/%Y"),'22:00:00','23:00:00','4:00:00',1,1,NULL,NULL);
INSERT INTO CONCERT VALUES(6,STR_TO_DATE("12/10/2010", "%d/%m/%Y"),'01:00:00','2:00:00','1:00:00',1,1,NULL,NULL);
INSERT INTO CONCERT VALUES(7,STR_TO_DATE("14/10/2010", "%d/%m/%Y"),'00:30:00','01:00:00','01:00:00',1,1,NULL,NULL);
INSERT INTO CONCERT VALUES(8,STR_TO_DATE("13/10/2010", "%d/%m/%Y"),'23:00:00','23:30:00','3:00:00',1,1,NULL,NULL);
-- Insertion dans la table SALLE
INSERT INTO SALLE (idS, nomS, nbPlace, typePlace, adresseS, largeur, longueur, nbPlacesLo, nbTechS,nbPlaceVoiture) 
VALUES (1, "Salle Olympia", 1500, "Assise", "12 rue des Artistes, Paris", 30, 40, 300, 5,100),
       (2, "Zenith Paris", 5000, "Debout", "211 avenue Jean Jaurès, Paris", 50, 80, 1000, 10,200);

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

--Test du check dans la table CONCERT
INSERT INTO CONCERT (idC, dateCo, heureArrive, debutConcert, dureeConcert, idG, idS, idPark, idH)
VALUES (4, '2222-11-11', '15:00:00', '19:00:00', '22:00:00', 1, 1, 1, 1), --Fonctionne pas
       (5, '7464-11-20', '22:30:00', '00:00:00', '01:30:00', 2, 2, 2, 2); --Fonctionne

