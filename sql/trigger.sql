delimiter |
CREATE OR REPLACE TRIGGER pasDeCheuvauchementConcerts before insert on CONCERT for each row
begin
    DECLARE heureAvant INT;
    DECLARE dureeAvant INT;
    DECLARE heureApres INT;
    DECLARE mes VARCHAR(100) default '';
    DECLARE groupe INT;

    -- recupère le groupe du concert
    SELECT idG INTO groupe FROM GROUPE NATURAL JOIN RESERVATION NATURAL JOIN CONCERT
    WHERE idR = new.idR LIMIT 1;
    
    -- recupèration du premier concert avant celui ajouter
    SELECT debutConcert,dureeConcert INTO heureAvant, dureeAvant FROM CONCERT NATURAL JOIN RESERVATION NATURAL JOIN GROUPE
    WHERE dateC = new.dateC AND debutConcert < new.debutConcert AND idG = groupe
    ORDER BY debutConcert DESC LIMIT 1;

    -- recupèration du premier concert après celui ajouter
    SELECT debutConcert INTO heureApres FROM CONCERT NATURAL JOIN RESERVATION NATURAL JOIN GROUPE
    WHERE dateC = new.dateC AND debutConcert > new.debutConcert AND idG = groupe
    ORDER BY debutConcert LIMIT 1;

    -- vérification que le concert d'avant se termine avant le debut du concert ajouté
    IF dureeAvant IS NOT NULL AND heureAvant IS NOT NULL AND new.debutConcert < heureAvant + dureeAvant THEN
        SET mes = concat(mes,"Ajout impossible car il existe déjà un concert précédent sur le créneau ", SEC_TO_TIME(TIME_TO_SEC(new.debutConcert)), "-", SEC_TO_TIME(TIME_TO_SEC(new.debutConcert) + TIME_TO_SEC(new.dureeConcert)),".");
        signal SQLSTATE '45000' SET MESSAGE_TEXT = mes ;
    end if;

    -- vérification que le concert ajouté se termine avant que le concert suivant commence
    IF heureApres IS NOT NULL AND new.debutConcert + new.dureeConcert > heureApres THEN
        SET mes = concat(mes,"Ajout impossible car il existe déjà un concert suivant sur le créneau ", SEC_TO_TIME(TIME_TO_SEC(new.debutConcert)), "-", SEC_TO_TIME(TIME_TO_SEC(new.debutConcert) + TIME_TO_SEC(new.dureeConcert)),".");
        signal SQLSTATE '45000' SET MESSAGE_TEXT = mes ;
    end if;
end|
delimiter ;

delimiter |
CREATE OR REPLACE TRIGGER pasDeCheuvauchementConcerts before update on CONCERT for each row
begin
    DECLARE heureAvant INT;
    DECLARE dureeAvant INT;
    DECLARE heureApres INT;
    DECLARE mes VARCHAR(100) default '';
    DECLARE groupe INT;

    -- recupère le groupe du concert
    SELECT idG INTO groupe FROM GROUPE NATURAL JOIN RESERVATION NATURAL JOIN CONCERT
    WHERE idR = new.idR LIMIT 1;
    
    -- recupèration du premier concert avant celui ajouter
    SELECT debutConcert,dureeConcert INTO heureAvant, dureeAvant FROM CONCERT NATURAL JOIN RESERVATION NATURAL JOIN GROUPE
    WHERE dateC = new.dateC AND debutConcert < new.debutConcert AND idG = groupe
    ORDER BY debutConcert DESC LIMIT 1;

    -- recupèration du premier concert après celui ajouter
    SELECT debutConcert INTO heureApres FROM CONCERT NATURAL JOIN RESERVATION NATURAL JOIN GROUPE
    WHERE dateC = new.dateC AND debutConcert > new.debutConcert AND idG = groupe
    ORDER BY debutConcert LIMIT 1;

    -- vérification que le concert d'avant se termine avant le debut du concert ajouté
    IF dureeAvant IS NOT NULL AND heureAvant IS NOT NULL AND new.debutConcert < heureAvant + dureeAvant THEN
        SET mes = concat(mes,"Ajout impossible car il existe déjà un concert précédent sur le créneau ", SEC_TO_TIME(TIME_TO_SEC(new.debutConcert)), "-", SEC_TO_TIME(TIME_TO_SEC(new.debutConcert) + TIME_TO_SEC(new.dureeConcert)),".");
        signal SQLSTATE '45000' SET MESSAGE_TEXT = mes ;
    end if;

    -- vérification que le concert ajouté se termine avant que le concert suivant commence
    IF heureApres IS NOT NULL AND new.debutConcert + new.dureeConcert > heureApres THEN
        SET mes = concat(mes,"Ajout impossible car il existe déjà un concert suivant sur le créneau ", SEC_TO_TIME(TIME_TO_SEC(new.debutConcert)), "-", SEC_TO_TIME(TIME_TO_SEC(new.debutConcert) + TIME_TO_SEC(new.dureeConcert)),".");
        signal SQLSTATE '45000' SET MESSAGE_TEXT = mes ;
    end if;
end|
delimiter ;

-- Insert de test pour pasDeCheuvauchementConcerts
--
-- INSERT INTO SALLE VALUES(1,"test",30,"tst","3 rue",100,100);
-- INSERT INTO GROUPE VALUES(1,"eee");
-- INSERT INTO TECHNICIEN VALUES(1,"aea","0111");
-- INSERT INTO MATERIEL VALUES(1,"flute","instru",NULL,10,10,10);
-- INSERT INTO TECHNICIEN_DEMANDE VALUES(1,1);
-- INSERT INTO MATERIEL_DEMANDE VALUES(1,1);
-- INSERT INTO RESERVATION VALUES(1,1,1,1,1,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),2);
-- INSERT INTO CONCERT VALUES(1,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),SEC_TO_TIME(60*60*8),SEC_TO_TIME(60*30),SEC_TO_TIME(60*60*9),SEC_TO_TIME(60*60*3),1);
-- INSERT INTO CONCERT VALUES(2,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),SEC_TO_TIME(60*60*13),SEC_TO_TIME(60*30),SEC_TO_TIME(60*60*14),SEC_TO_TIME(60*60),1);
-- INSERT INTO CONCERT VALUES(3,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),SEC_TO_TIME(60*60*12),SEC_TO_TIME(60*30),SEC_TO_TIME(60*60*13),SEC_TO_TIME(60*60*2),1);
-- INSERT INTO CONCERT VALUES(3,STR_TO_DATE("10/10/2010", "%d/%m/%Y"),SEC_TO_TIME(60*60*9),SEC_TO_TIME(60*30),SEC_TO_TIME(60*60*10),SEC_TO_TIME(60*60*2+60*30),1);





