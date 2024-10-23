-- Inserts pour la table GROUPE
INSERT INTO GROUPE (idG, nomG, nbTechG, nbPersG) 
VALUES (1, 'Groupe A', 5, 10), 
       (2, 'Groupe B', 4, 8),
       (3, 'Groupe C', 6, 12);

-- Inserts pour la table SALLE
INSERT INTO SALLE (idS, nomS, nbPlace, typePlace, adresseS, largeur, longueur, nbPlacesLo, nbTechS) 
VALUES (1, 'Salle 1', 500, 'assis', '123 Rue de la Musique, Paris', 20, 30, 50, 4),
       (2, 'Salle 2', 1000, 'debout', '456 Avenue des Artistes, Lyon', 25, 35, 80, 6),
       (3, 'Salle 3', 800, 'mixte', '789 Boulevard du Concert, Marseille', 22, 32, 70, 5);

-- Inserts pour la table MATERIEL
INSERT INTO MATERIEL (idM, nomM, typeM, idG, idS, idSt)
VALUES (1, 'Micro', 'Son', 1, 1, NULL),
       (2, 'Guitare', 'Instrument', 1, 1, NULL),
       (3, 'Baffles', 'Son', 2, 2, NULL);

-- Inserts pour la table HOTEL
INSERT INTO HOTEL (idH, adresseH, nbPlaceH)
VALUES (1, 'Hotel Central, Paris', 100),
       (2, 'Hotel de Lyon, Lyon', 150),
       (3, 'Hotel du Port, Marseille', 200);

-- Inserts pour la table PARKING
INSERT INTO PARKING (idPark, nbPlaceVoiture, adressePark)
VALUES (1, 50, 'Parking A, Paris'),
       (2, 80, 'Parking B, Lyon'),
       (3, 60, 'Parking C, Marseille');

-- Inserts pour la table CONCERT
INSERT INTO CONCERT (idC, dateCo, heureArrive, debutConcert, dureeConcert, idG, idS, idPark, idH)
VALUES (1, '2024-11-15', '18:00:00', '19:30:00', '02:00:00', 1, 1, 1, 1),
       (2, '2024-11-20', '17:30:00', '19:00:00', '01:30:00', 2, 2, 2, 2),
       (3, '2024-11-25', '18:00:00', '19:30:00', '02:00:00', 3, 3, 3, 3);

-- Inserts pour la table COMMENTAIRE
INSERT INTO COMMENTAIRE (idCom, msg, idC)
VALUES (1, 'Super concert, très bonne ambiance!', 1),
       (2, 'Le son était excellent!', 2),
       (3, 'Lieu magnifique, expérience incroyable!', 3);

-- Inserts pour la table RESTAURANT
INSERT INTO RESTAURANT (idR, nbPlaceR, adresseR)
VALUES (1, 100, 'Restaurant 1, Paris'),
       (2, 120, 'Restaurant 2, Lyon'),
       (3, 80, 'Restaurant 3, Marseille');

-- Inserts pour la table RESTAURATION
INSERT INTO RESTAURATION (idR, idC, heureRest)
VALUES (1, 1, '17:00:00'),
       (2, 2, '16:30:00'),
       (3, 3, '17:00:00');

-- Inserts pour la table TRANSPORT
INSERT INTO TRANSPORT (idT, dureeT, heureT)
VALUES (1, 45, '2024-11-15'),
       (2, 30, '2024-11-20'),
       (3, 60, '2024-11-25');

-- Inserts pour la table DEPLACE
INSERT INTO DEPLACE (idC, idT)
VALUES (1, 1),
       (2, 2),
       (3, 3);

-- Inserts pour la table PERSONNEL
INSERT INTO PERSONNEL (idP, emailP, telephoneP)
VALUES (1, 'personnel1@example.com', '0123456789'),
       (2, 'personnel2@example.com', '0987654321'),
       (3, 'personnel3@example.com', '0123456789');

-- Inserts pour la table PERSONNEL_ACCUEIL
INSERT INTO PERSONNEL_ACCUEIL (idC, idP)
VALUES (1, 1),
       (2, 2),
       (3, 3);

--Test du check dans la table CONCERT
INSERT INTO CONCERT (idC, dateCo, heureArrive, debutConcert, dureeConcert, idG, idS, idPark, idH)
VALUES (4, '2222-11-11', '15:00:00', '19:00:00', '22:00:00', 1, 1, 1, 1), --Fonctionne pas
       (5, '7464-11-20', '22:30:00', '00:00:00', '01:30:00', 2, 2, 2, 2); --Fonctionne