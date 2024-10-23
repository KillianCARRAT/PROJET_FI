-- Insertion dans la table SALLE
INSERT INTO SALLE (idS, nomS, nbPlace, typePlace, adresseS, largeur, longueur, nbPlacesLo, nbTechS)
VALUES 
(1, 'Salle de Concert A', 500, 'Assise', '123 Rue de la Musique', 30, 50, 50, 10),
(2, 'Salle de Spectacle B', 300, 'Debout', '45 Avenue des Arts', 20, 40, 20, 5);

-- Insertion dans la table HOTEL
INSERT INTO HOTEL (idH, adresseH, nbPlaceH)
VALUES 
(1, '456 Boulevard de l’Hôtel', 200),
(2, '789 Chemin des Étoiles', 150);

-- Insertion dans la table GROUPE
INSERT INTO GROUPE (idG, nomG, nbTechG, nbPersG, idH)
VALUES 
(1, 'Groupe A', 5, 10, 1),
(2, 'Groupe B', 3, 8, 2);

-- Insertion dans la table MATERIEL
INSERT INTO MATERIEL (idM, nomM, typeM, idG, idS)
VALUES 
(1, 'Microphone', 'Audio', 1, 1),
(2, 'Projecteur', 'Visuel', 2, 2);

-- Insertion dans la table PARKING
INSERT INTO PARKING (idPark, nbPlaceVoiture, adressePark, idS)
VALUES 
(1, 50, '789 Rue des Voitures', 1),
(2, 30, '321 Rue des Parkings', 2);

-- Insertion dans la table CONCERT
INSERT INTO CONCERT (idC, dateCo, heureArrive, debutConcert, dureeConcert, idG, idM, idS)
VALUES 
(1, '2024-12-01', '18:00:00', '19:00:00', '02:00:00', 1, 1, 1),
(2, '2024-12-05', '17:30:00', '18:30:00', '01:30:00', 2, 2, 2);


-- Insertion dans la table COMMENTAIRE

INSERT INTO COMMENTAIRE (idCom, msg, idC)
VALUES 
(1, 'Super concert, j’ai adoré!', 1),
(2, 'Très belle performance.', 2);

-- Insertion dans la table RESTAURANT
INSERT INTO RESTAURANT (idR, nbPlaceR, adresseR)
VALUES 
(1, 100, '111 Rue des Délices'),
(2, 80, '222 Rue de la Gastronomie');

-- Insertion dans la table RESTAURATION
INSERT INTO RESTAURATION (idR, idG, heureR)
VALUES 
(1, 1, '20:00:00'),
(2, 2, '19:00:00');

-- Insertion dans la table TRANSPORT
INSERT INTO TRANSPORT (idT, dureeT, heureT)
VALUES 
(1, 30, '2024-12-01'),
(2, 45, '2024-12-05');

-- Insertion dans la table DEPLACE
INSERT INTO DEPLACE (idG, idT)
VALUES 
(1, 1),
(2, 2);

-- Insertion dans la table PERSONNEL
INSERT INTO PERSONNEL (idP, emailP, telephoneP)
VALUES 
(1, 'personnel1@example.com', '0123456789'),
(2, 'personnel2@example.com', '0987654321');

-- Insertion dans la table PERSONNEL_ACCUEIL
INSERT INTO PERSONNEL_ACCUEIL (idC, idP)
VALUES 
(1, 1),
(2, 2);
