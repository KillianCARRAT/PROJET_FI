
-- Contrainte pour vérifier que plusieurs concerts d'un même groupe ne se chevauche pas (on insert)
delimiter |
CREATE OR REPLACE TRIGGER pasDeCheuvauchementConcertsInsert before insert on CONCERT for each row
begin
    DECLARE heureAvant TIME;
    DECLARE dureeAvant TIME;
    DECLARE dateAvant DATE;
    DECLARE heureApres TIME;
    DECLARE dateApres DATE;
    DECLARE dateTimeAvant DATETIME;
    DECLARE dateTimeApres DATETIME;
    DECLARE dateTimeNew DATETIME;
    DECLARE timeDiffr INT;
    DECLARE temp VARCHAR(100) default '';
    DECLARE mes VARCHAR(1000) default '';

    -- recupèration du premier concert avant celui ajouter
    SELECT debutConcert,dureeConcert,dateC INTO heureAvant, dureeAvant, dateAvant FROM CONCERT
    WHERE debutConcert <= new.debutConcert AND dateC=new.dateC AND idG = new.idG OR idG = new.idG AND dateC < new.dateC
    ORDER BY dateC DESC,debutConcert DESC LIMIT 1;

    -- recupèration du premier concert après celui ajouter
    SELECT debutConcert,dateC INTO heureApres,dateApres FROM CONCERT
    WHERE debutConcert >= new.debutConcert AND dateC=new.dateC AND idG = new.idG OR idG = new.idG AND dateC > new.dateC 
    ORDER BY dateC,debutConcert LIMIT 1;

    IF dateAvant IS NOT NULL THEN
        SET dateTimeAvant = STR_TO_DATE(concat(YEAR(dateAvant),"-",MONTH(dateAvant),"-",DAY(dateAvant)," ",heureAvant),"%Y-%m-%d %H:%i:%s");
        SET dateTimeNew = STR_TO_DATE(concat(YEAR(new.dateC),"-",MONTH(new.dateC),"-",DAY(new.dateC)," ",new.debutConcert),"%Y-%m-%d %H:%i:%s");
        SET timeDiffr = TIMESTAMPDIFF(SECOND,dateTimeAvant,dateTimeNew);
        IF ABS(timeDiffr) < TIME_TO_SEC(dureeAvant) THEN
            SET mes = concat(mes,"Ajout impossible car il existe déjà un concert précédent sur le créneau ",dateTimeNew," - ",dateAvant," ",SEC_TO_TIME(timeDiffr));
            signal SQLSTATE '45000' SET MESSAGE_TEXT = mes ;
        end if;
    end if;

    -- vérification que le concert ajouté se termine avant que le concert suivant commence
    IF dateApres IS NOT NULL THEN
        SET dateTimeApres = STR_TO_DATE(concat(YEAR(dateApres),"-",MONTH(dateApres),"-",DAY(dateApres)," ",heureApres),"%Y-%m-%d %H:%i:%s");
        SET dateTimeNew = STR_TO_DATE(concat(YEAR(new.dateC),"-",MONTH(new.dateC),"-",DAY(new.dateC)," ",new.debutConcert),"%Y-%m-%d %H:%i:%s");
        SET timeDiffr = TIMESTAMPDIFF(SECOND,dateTimeNew,dateTimeApres);
        IF ABS(timeDiffr) < TIME_TO_SEC(new.dureeConcert) THEN
            SET mes = concat(mes,"Ajout impossible car il existe déjà un concert suivant sur le créneau. ",dateTimeNew," - ",dateTimeApres," ",SEC_TO_TIME(timeDiffr)," ",new.dureeConcert);
            signal SQLSTATE '45000' SET MESSAGE_TEXT = mes ;
        end if;
    end if;
end|
delimiter ;

-- Contrainte pour vérifier que plusieurs concerts d'un même groupe ne se chevauche pas (on update)
delimiter |
CREATE OR REPLACE TRIGGER pasDeCheuvauchementConcertsUpdate before update on CONCERT for each row
begin
    DECLARE heureAvant TIME;
    DECLARE dureeAvant TIME;
    DECLARE dateAvant DATE;
    DECLARE heureApres TIME;
    DECLARE dateApres DATE;
    DECLARE dateTimeAvant DATETIME;
    DECLARE dateTimeApres DATETIME;
    DECLARE dateTimeNew DATETIME;
    DECLARE timeDiffr INT;
    DECLARE temp VARCHAR(100) default '';
    DECLARE mes VARCHAR(1000) default '';

    -- recupèration du premier concert avant celui ajouter
    SELECT debutConcert,dureeConcert,dateC INTO heureAvant, dureeAvant, dateAvant FROM CONCERT
    WHERE debutConcert <= new.debutConcert AND dateC=new.dateC AND idG = new.idG OR idG = new.idG AND dateC < new.dateC
    ORDER BY dateC DESC,debutConcert DESC LIMIT 1;

    -- recupèration du premier concert après celui ajouter
    SELECT debutConcert,dateC INTO heureApres,dateApres FROM CONCERT
    WHERE debutConcert >= new.debutConcert AND dateC=new.dateC AND idG = new.idG OR idG = new.idG AND dateC > new.dateC 
    ORDER BY dateC,debutConcert LIMIT 1;

    IF dateAvant IS NOT NULL THEN
        SET dateTimeAvant = STR_TO_DATE(concat(YEAR(dateAvant),"-",MONTH(dateAvant),"-",DAY(dateAvant)," ",heureAvant),"%Y-%m-%d %H:%i:%s");
        SET dateTimeNew = STR_TO_DATE(concat(YEAR(new.dateC),"-",MONTH(new.dateC),"-",DAY(new.dateC)," ",new.debutConcert),"%Y-%m-%d %H:%i:%s");
        SET timeDiffr = TIMESTAMPDIFF(SECOND,dateTimeAvant,dateTimeNew);
        IF ABS(timeDiffr) < TIME_TO_SEC(dureeAvant) THEN
            SET mes = concat(mes,"Ajout impossible car il existe déjà un concert précédent sur le créneau ",dateTimeNew," - ",dateAvant," ",SEC_TO_TIME(timeDiffr));
            signal SQLSTATE '45000' SET MESSAGE_TEXT = mes ;
        end if;
    end if;

    -- vérification que le concert ajouté se termine avant que le concert suivant commence
    IF dateApres IS NOT NULL THEN
        SET dateTimeApres = STR_TO_DATE(concat(YEAR(dateApres),"-",MONTH(dateApres),"-",DAY(dateApres)," ",heureApres),"%Y-%m-%d %H:%i:%s");
        SET dateTimeNew = STR_TO_DATE(concat(YEAR(new.dateC),"-",MONTH(new.dateC),"-",DAY(new.dateC)," ",new.debutConcert),"%Y-%m-%d %H:%i:%s");
        SET timeDiffr = TIMESTAMPDIFF(SECOND,dateTimeNew,dateTimeApres);
        IF ABS(timeDiffr) < TIME_TO_SEC(new.dureeConcert) THEN
            SET mes = concat(mes,"Ajout impossible car il existe déjà un concert suivant sur le créneau. ",dateTimeNew," - ",dateTimeApres," ",SEC_TO_TIME(timeDiffr)," ",new.dureeConcert);
            signal SQLSTATE '45000' SET MESSAGE_TEXT = mes ;
        end if;
    end if;
end|
delimiter ;