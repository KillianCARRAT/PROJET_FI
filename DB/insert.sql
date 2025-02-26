INSERT INTO UTILISATEUR (iden, mdp, typeU)
VALUES ('o2230', '$2y$10$PQgHjDz9RAji8TiJBAOk4uHbhhsMlhg1CswqPRwU2/RCbZJ3EfkhK', 'TEC'),
       ('admin', '$2y$10$wad64u6SRLILGA55en6Ycuf6QWEREe6xNrhPBmSD8YeYSqej4U3fy', 'ADM'),
       ('u6996', '$2y$10$iLtz8UA1jcV77639chJbk.qsyxmZI0BR6p0WfiyLJ0YjXp8K21xRe', 'ORG');


-- Insérer des salles
INSERT INTO SALLE (idS, nomS, nbPlaceS, typePlaceS, adresseS, largeurS, longueurS, nbPlacesLo, nbTechS)
VALUES (1, 'Olympia', 100, 'Concert', '28 Boulevard des Capucines, Paris', 20, 30, 10, 5),
    (2, 'Zénith', 150, 'Concert', '211 Avenue Jean Jaurès, Paris', 25, 35, 15, 7),
    (3, 'Accor Arena', 200, 'Concert', '8 Boulevard de Bercy, Paris', 30, 40, 20, 10),
    (4, 'Stade de France', 250, 'Concert', 'Saint-Denis, Paris', 35, 45, 25, 12);

-- Insérer des groupes
INSERT INTO GROUPE (idG, nomG, mail, nbTechG, nbPersG)
VALUES (1, 'Coldplay', 'coldplay@example.com', 5, 10),
    (2, 'U2', 'u2@example.com', 7, 15),
    (3, 'Imagine Dragons', 'imaginedragons@example.com', 4, 8),
    (4, 'Maroon 5', 'maroon5@example.com', 6, 12);

-- Insérer des utilisateurs
INSERT INTO UTILISATEUR (iden, mdp, typeU)
VALUES ('A001', '$2y$10$iLtz8UA1jcV77639chJbk.qsyxmZI0BR6p0WfiyLJ0YjXp8K21xRe', 'ART'),
    ('A002', '$2y$10$iLtz8UA1jcV77639chJbk.qsyxmZI0BR6p0WfiyLJ0YjXp8K21xRe', 'ART'),
    ('A003', '$2y$10$iLtz8UA1jcV77639chJbk.qsyxmZI0BR6p0WfiyLJ0YjXp8K21xRe', 'ART'),
    ('A004', '$2y$10$iLtz8UA1jcV77639chJbk.qsyxmZI0BR6p0WfiyLJ0YjXp8K21xRe', 'ART');

-- Lier les utilisateurs aux groupes
INSERT INTO LIEN (idG, iden)
VALUES (1, 'A001'),
    (2, 'A002'),
    (3, 'A003'),
    (4, 'A004');

-- Insérer des concerts
INSERT INTO CONCERT (idC, dateC, heureArrive, debutConcert, dureeConcert, dateMax, nombreTechNecessaire, besoinTransport, besoinHotel, commentaire,idG, idS)
VALUES (1, '2025-03-01', '18:00:00', '19:00:00', '02:00:00', '2025-03-01',10, null,null, "commentaire de test",1, 1),
    (2, '2025-03-02', '17:00:00', '18:00:00', '01:30:00', '2025-03-02',10, null,null, null, 2, 2),
    (3, '2025-03-03', '16:00:00', '17:00:00', '01:45:00', '2025-03-03',15, null,null, null, 3, 3),
    (4, '2025-03-04', '15:00:00', '16:00:00', '02:15:00', '2025-03-04',2, null,null, null, 4, 4);





