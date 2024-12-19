-- Insertion dans la table SALLE
INSERT INTO SALLE (idS, nomS, nbPlaceS, typePlaceS, adresseS, largeurS, longueurS, nbPlacesLo, nbTechS,nbPlaceVoitureS) 
VALUES (1, "Salle Olympia", 1500, "Assise", "12 rue des Artistes, Paris", 30, 40, 300, 5,100),
       (2, "Zenith Paris", 5000, "Debout", "211 avenue Jean Jaurès, Paris", 50, 80, 1000, 10,200);

-- Insertion dans la table HOTEL
INSERT INTO HOTEL (idH, adresseH, nbPlaceH) 
VALUES (1, "5 rue de l'Hôtel, Paris", 200),
       (2, "10 avenue des Champs, Paris", 300);

-- Insertion dans la table GROUPE

INSERT INTO GROUPE (idG, nomG,mail, nbTechG, nbPersG) 
VALUES (1, "The Rolling Stones",'e@e' ,10, 50),
       (2, "Coldplay",'e@e' , 12, 60);

-- Insertion dans la table HEBERGEMENT
INSERT INTO HEBERGEMENT (idH, idG, heureH, dateH) 
VALUES (1, 1, "14:00:00", "2024-10-20"),
       (2, 2, "15:00:00", "2024-10-21");

-- Insertion dans la table MATERIEL
INSERT INTO MATERIEL (idM, nomM, typeM, idG, idS) 
VALUES (1, "Guitare électrique", "Instrument", 1, 1),
       (2, "Microphone", "Sonorisation", 2, 2);

-- Insertion dans la table CONCERT
INSERT INTO CONCERT (idC, dateC, heureArrive, debutConcert, dureeConcert, idG, idS) 
VALUES (1, "2024-10-25", "19:00:00", "20:00:00", "02:00:00",STR_TO_DATE("10/01/2025", "%d/%m/%Y"), 1, 1),
       (2, "2024-10-26", "18:00:00", "19:00:00", "01:30:00",STR_TO_DATE("10/01/2025", "%d/%m/%Y"), 2, 2);

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

-- Insert de test pour ReservationSalleMemeMoment (contrainte 1)
INSERT INTO CONCERT VALUES(3,STR_TO_DATE("10/10/2014", "%d/%m/%Y"),'8:00:00','9:00:00','03:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(4,STR_TO_DATE("10/10/2014", "%d/%m/%Y"),'10:00:00','11:00:00','03:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),2,1);
INSERT INTO CONCERT VALUES(5,STR_TO_DATE("10/10/2014", "%d/%m/%Y"),'6:00:00','7:00:00','2:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),2,1);
INSERT INTO CONCERT VALUES(6,STR_TO_DATE("10/10/2014", "%d/%m/%Y"),'5:00:00','6:00:00','2:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),2,1);

-- Insert le test pour PlaceEnLogesSuffisantes (contrainte 2)

INSERT INTO SALLE VALUES(3, "Temp", 250, "Mixte", "2 avenue te, Londre", 50, 80, 500, 10,200);
INSERT INTO SALLE VALUES(4, "Temp", 250, "Mixte", "2 avenue te, Londre", 50, 80, 550, 10,200);

INSERT INTO CONCERT VALUES(21,STR_TO_DATE("11/10/2015", "%d/%m/%Y"),'8:00:00','9:00:00','3:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,3);
INSERT INTO CONCERT VALUES(23,STR_TO_DATE("12/10/2015", "%d/%m/%Y"),'8:00:00','9:00:00','3:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),2,3);
INSERT INTO CONCERT VALUES(22,STR_TO_DATE("13/10/2015", "%d/%m/%Y"),'8:00:00','9:00:00','3:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,4);
INSERT INTO CONCERT VALUES(23,STR_TO_DATE("14/10/2015", "%d/%m/%Y"),'8:00:00','9:00:00','3:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),2,4);

-- Insert de test pour pasDeCheuvauchementConcerts (contrainte 3)

INSERT INTO CONCERT VALUES(7,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),'8:00:00','9:00:00','3:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(8,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),'13:00:00','14:00:00','1:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(9,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),'12:00:00','13:00:00','2:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(10,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),'9:00:00','10:00:00','3:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(11,STR_TO_DATE("11/10/2010", "%d/%m/%Y"),'22:00:00','23:00:00','4:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(12,STR_TO_DATE("12/10/2010", "%d/%m/%Y"),'01:00:00','2:00:00','1:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(13,STR_TO_DATE("14/10/2010", "%d/%m/%Y"),'00:30:00','01:00:00','01:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(14,STR_TO_DATE("13/10/2010", "%d/%m/%Y"),'23:00:00','23:30:00','3:00:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);

-- Insert de test pour pasDeCheuvauchementPrepConcerts (contrainte 4)

INSERT INTO CONCERT VALUES(15,STR_TO_DATE("10/11/2010", "%d/%m/%Y"),'8:00:00','10:00:00','0:10:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(16,STR_TO_DATE("10/11/2010", "%d/%m/%Y"),'13:00:00','15:00:00','0:10:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(17,STR_TO_DATE("10/11/2010", "%d/%m/%Y"),'12:00:00','14:00:00','0:10:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);
INSERT INTO CONCERT VALUES(18,STR_TO_DATE("10/11/2010", "%d/%m/%Y"),'9:00:00','11:00:00','0:10:00',STR_TO_DATE("10/01/2025", "%d/%m/%Y"),1,1);

--Test du check dans la table CONCERT (contrainte 5)

INSERT INTO CONCERT (idC, dateC, heureArrive, debutConcert, dureeConcert, idG, idS)
VALUES (19, '2030-11-11', '15:00:00', '19:00:00', '22:00:00', 1, 1);
INSERT INTO CONCERT VALUES (20, '2031-11-20', '22:30:00', '00:00:00', '01:30:00', 2, 2);

-- Insert de test pour ReservationPourResto (contrainte 6)

INSERT INTO RESTAURANT VALUES(3,60,"test");
INSERT INTO RESTAURANT VALUES(4,70,"test");
INSERT INTO RESTAURATION VALUES(3,1,"11:11:11",'2000-11-11');
INSERT INTO RESTAURATION VALUES(3,2,"11:11:11",'2000-11-11');
INSERT INTO RESTAURATION VALUES(4,1,"11:11:11",'2000-11-11');
INSERT INTO RESTAURATION VALUES(4,2,"11:11:11",'2000-11-11');

-- Insert de test pour ReservationPourHotel (contrainte 7)

INSERT INTO HOTEL VALUES(3,'test',60);
INSERT INTO HOTEL VALUES(4,'test',70);
INSERT INTO HEBERGEMENT VALUES(3,1,"11:11:11",'2000-11-11');
INSERT INTO HEBERGEMENT VALUES(3,2,"11:11:11",'2000-11-11');
INSERT INTO HEBERGEMENT VALUES(4,1,"11:11:11",'2000-11-11');
INSERT INTO HEBERGEMENT VALUES(4,2,"11:11:11",'2000-11-11');


INSERT INTO UTILISATEUR (iden, mdp, typeU)
VALUES ('o2230', '$2y$10$PQgHjDz9RAji8TiJBAOk4uHbhhsMlhg1CswqPRwU2/RCbZJ3EfkhK', 'TEC'),
       ('A3022', '$2y$10$64i6uYK8KGK9jNVPkKRak.0I3eht4ZOK2OZc/cWC1TbH59WzbLBb.', 'ART'),
       ('u6996', '$2y$10$iLtz8UA1jcV77639chJbk.qsyxmZI0BR6p0WfiyLJ0YjXp8K21xRe', 'ORG');


INSERT INTO LIEN (idG,iden)
VALUES (2,'A3022' )
