-- Table GROUPE
INSERT INTO GROUPE (idG, nomG) VALUES (1, 'The Rockers'), (2, 'Jazz Fusion'), (3, 'Symphonic Sounds');

-- Table ARTISTE
INSERT INTO ARTISTE (idA, nomA, prenomA, dtnA, lieuNaissance, adresseA, numeroSecu, numCongeSpect, numCNI, dateDelivrance, dateExpiration, reductionTrain)
VALUES (1, 'Smith', 'John', '1985-05-12', 'New York', '123 Music Ave', 123456789, '12345CS', 'AB123456', '2020-01-15', '2030-01-15', '50%'),
       (2, 'Doe', 'Jane', '1990-08-25', 'Los Angeles', '456 Harmony St', 987654321, '67890CS', 'CD654321', '2021-03-10', '2031-03-10', '25%');

-- Table APPARTIENT
INSERT INTO APPARTIENT (idG, idA) VALUES (1, 1), (2, 2), (1, 2);

-- Table MATERIEL
INSERT INTO MATERIEL (idM, nomM, typeM, idA, hauteurM, largeurM, profonfeurM)
VALUES (1, 'Guitar', 'Instrument', 1, 1.20, 0.40, 0.15),
       (2, 'Drums', 'Instrument', 2, 1.50, 1.00, 0.80);

-- Table TECHNICIEN
INSERT INTO TECHNICIEN (idT, emailT, telephoneT) VALUES (1, 'tech1@example.com', '555-1234'), (2, 'tech2@example.com', '555-5678');

-- Table EQUIPE_TECHNIQUE
INSERT INTO EQUIPE_TECHNIQUE (idG, idT) VALUES (1, 1), (2, 2);

-- Table SALLE
INSERT INTO SALLE (idS, nomS, nbPlace, typePlace, adresseS, largeur, longueur)
VALUES (1, 'Main Hall', 500, 'Seated', '789 Performance Blvd', 20, 30),
       (2, 'Outdoor Arena', 2000, 'Standing', '123 Concert Road', 50, 80);

-- Table CONTIENT
INSERT INTO CONTIENT (idS, idM) VALUES (1, 1), (2, 2);

-- Table LOGES
INSERT INTO LOGES (idL, nbPers, idS) VALUES (1, 10, 1), (2, 20, 2);

-- Table MATERIEL_DEMANDE
INSERT INTO MATERIEL_DEMANDE (idMD, idM) VALUES (1, 1), (2, 2);

-- Table TECHNICIEN_DEMANDE
INSERT INTO TECHNICIEN_DEMANDE (idTD, idT) VALUES (1, 1), (2, 2);

-- Table RESERVATION
INSERT INTO RESERVATION (idR, idS, idG, idTD, idMD, dateR, dureeR)
VALUES (1, 1, 1, 1, 1, '2024-11-01', 5),
       (2, 2, 2, 2, 2, '2024-11-15', 7);

-- Table CONCERT
INSERT INTO CONCERT (idC, dateC, heureArrive, tempPrep, debutConcert, dureeConcert, idR)
VALUES (1, '2024-11-01', '14:00:00', '02:00:00', '16:00:00', '03:00:00', 1);

-- Table FICHE_ACCEUIL
INSERT INTO FICHE_ACCEUIL (idAcc, idR) VALUES (1, 1), (2, 2);

-- Table RESTAURANT
INSERT INTO RESTAURANT (idResto, nbPlaceResto, adresseResto, prixResto)
VALUES (1, 100, '500 Diner St', 50.000), (2, 200, '678 Eatery Ave', 75.000);

-- Table RESTAURATION
INSERT INTO RESTAURATION (idAcc, idResto, dateResto)
VALUES (1, 1, '2024-11-01'), (2, 2, '2024-11-15');

-- Table VEHICULE
INSERT INTO VEHICULE (idV, nomV, nbPlaceV, volumeV)
VALUES (1, 'Van', 5, 2000), (2, 'Bus', 40, 8000);

-- Table TRANSPORT
INSERT INTO TRANSPORT (idAcc, idV, dateTrans, dureeTrans)
VALUES (1, 1, '2024-11-01', 60), (2, 2, '2024-11-15', 120);

-- Table PARKING
INSERT INTO PARKING (idPark, nbPlaceVoiture, nbPlaceCamion, adressePark)
VALUES (1, 50, 10, '1000 Parking Lot'), (2, 100, 20, '2000 Garage Lane');

-- Table PARKING_PROCHE
INSERT INTO PARKING_PROCHE (idAcc, idPark) VALUES (1, 1), (2, 2);

-- Table CHAMBRE
INSERT INTO CHAMBRE (idChambre, tailleChambre) VALUES (1, 20), (2, 25);

-- Table HOTEL
INSERT INTO HOTEL (idH, adresseH, etoileH, prixH)
VALUES (1, 'Luxury Stay', 5, 300.000), (2, 'Budget Inn', 3, 100.000);

-- Table CHAMBRE_HOTEL
INSERT INTO CHAMBRE_HOTEL (idH, idChambre) VALUES (1, 1), (2, 2);

-- Table HEBERGEMENT
INSERT INTO HEBERGEMENT (idAcc, idH, dateHebergement, nbNuit)
VALUES (1, 1, '2024-11-01', 2), (2, 2, '2024-11-15', 3);

-- Table PERSONNEL
INSERT INTO PERSONNEL (idPerso, emailP, telephoneP) VALUES (1, 'personnel1@example.com', '555-8765'), (2, 'personnel2@example.com', '555-4321');

-- Table PERSONNEL_ACCEUIL
INSERT INTO PERSONNEL_ACCEUIL (idAcc, idPerso) VALUES (1, 1), (2, 2);

-- Table COMMENTAIRE
INSERT INTO COMMENTAIRE (idCom, msg, idR) VALUES (1, 'Great event!', 1), (2, 'Looking forward to the next show.', 2);

-- Table STOCK_ASSOCIATION
INSERT INTO STOCK_ASSOCIATION (idM) VALUES (1), (2);
