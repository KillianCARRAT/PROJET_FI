
-- Contrainte pour vérifier que plusieurs concerts d'un même groupe ne se chevauche pas (on insert)
delimiter |
CREATE OR REPLACE TRIGGER pasDeCheuvauchementConcertsInsert before insert on CONCERT for each row
begin
    DECLARE heureAvant INT;
    DECLARE dureeAvant INT;
    DECLARE heureApres INT;
    DECLARE mes VARCHAR(100) default '';

    -- recupèration du premier concert avant celui ajouter
    SELECT debutConcert,dureeConcert INTO heureAvant, dureeAvant FROM CONCERT
    WHERE dateC = new.dateC AND debutConcert < new.debutConcert AND idG = new.idG
    ORDER BY debutConcert DESC LIMIT 1;

    -- recupèration du premier concert après celui ajouter
    SELECT debutConcert INTO heureApres FROM CONCERT
    WHERE dateC = new.dateC AND debutConcert > new.debutConcert AND idG = new.idG
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

-- Contrainte pour vérifier que plusieurs concerts d'un même groupe ne se chevauche pas (on update)
delimiter |
CREATE OR REPLACE TRIGGER pasDeCheuvauchementConcertsUpdate before update on CONCERT for each row
begin
    DECLARE heureAvant INT;
    DECLARE dureeAvant INT;
    DECLARE heureApres INT;
    DECLARE mes VARCHAR(100) default '';

    -- recupèration du premier concert avant celui ajouter
    SELECT debutConcert,dureeConcert INTO heureAvant, dureeAvant FROM CONCERT
    WHERE dateC = new.dateC AND debutConcert < new.debutConcert AND idG = new.idG
    ORDER BY debutConcert DESC LIMIT 1;

    -- recupèration du premier concert après celui ajouter
    SELECT debutConcert INTO heureApres FROM CONCERT
    WHERE dateC = new.dateC AND debutConcert > new.debutConcert AND idG = new.idG
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
