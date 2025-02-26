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

INSERT INTO COMMENTAIRE (msg)
VALUES ('
The standard Lorem Ipsum passage, used since the 1500s

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC

Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
1914 translation by H. Rackham

But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"
Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC

At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."
1914 translation by H. Rackham

On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."'
);

-- Insérer des concerts
INSERT INTO CONCERT (idC, dateC, heureArrive, debutConcert, dureeConcert, dateMax, nombreTechNecessaire, besoinTransport, besoinHotel,idG, idS, idCom)
VALUES (1, '2025-03-01', '18:00:00', '19:00:00', '02:00:00', '2025-03-01',10, null,null, 1, 1, 1),
    (2, '2025-03-02', '17:00:00', '18:00:00', '01:30:00', '2025-03-02',10, null,null, 2, 2, null),
    (3, '2025-03-03', '16:00:00', '17:00:00', '01:45:00', '2025-03-03',15, null,null, 3, 3, null),
    (4, '2025-03-04', '15:00:00', '16:00:00', '02:15:00', '2025-03-04',2, null,null, 4, 4, null);






