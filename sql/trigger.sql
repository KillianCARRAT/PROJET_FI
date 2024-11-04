-- 1 Une salle ne peut pas être réservée plusieure fois au même moment
delimiter |
CREATE OR REPLACE TRIGGER ReservationSalleMemeMoment BEFORE INSERT ON CONCERT FOR EACH ROW
begin
    declare mess VARCHAR(500);
    declare debut date;
    declare fin date;
    declare probleme boolean default false;
    declare fini boolean default false;
    declare lesHeures cursor for 
        select heureArrive, ADDDATE(debutConcert,dureeConcert) FROM CONCERT WHERE idS=new.idS;
    declare continue handler for not found set fini = true;
    open lesHeures;
    while not fini do
        fetch lesHeures into debut,fin;
        if NEW.heureArrive>debut OR ADDDATE(NEW.debutConcert,NEW.dureeConcert)<fin then
            set probleme:=1;
        end if;
        if NEW.heureArrive<debut AND ADDDATE(NEW.debutConcert,NEW.dureeConcert)>fin then
            set probleme:=1;
        end if;
        if probleme then
            close lesHeures;
            set mess = concat ("réservation impossible pour la réservation numéro ", new.idC);
            signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
        end if;
    end while;
    close lesHeures;
end |
delimiter ;


-- 2 Une salle doit avoir assez de place en loge pour accueillir les artistes
delimiter |
CREATE OR REPLACE TRIGGER PlaceEnLogesSuffisantes BEFORE INSERT ON CONCERT FOR EACH ROW
begin
    declare nbArtiste int;
    declare nbLoges int;
    declare mes varchar(250) default "";
    SELECT nbPlacesLo into nbLoges FROM SALLE WHERE idS = new.idS;
    SELECT nbPersG into nbArtiste FROM GROUPE WHERE idG = new.idG;
    if nbLoges < nbArtiste THEN
        set mes = concat("le nombre de loges et insuffissant, ", nbLoges, " loges pour ", nbArtiste, " artistes.");
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    end if;
end |
delimiter ;

-- 3.1 Contrainte pour vérifier que plusieurs concerts d'un même groupe ne se chevauche pas (on insert)
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

-- 3.2 Contrainte pour vérifier que plusieurs concerts d'un même groupe ne se chevauche pas (on update)
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


-- 6 Le nombre de place du restaurants doit être supérieur ou égal au nombre de personnes dans le groupe + techniciens
delimiter |
CREATE OR REPLACE TRIGGER ReservationPourResto BEFORE INSERT ON RESTAURATION FOR EACH ROW
begin
    declare mess varchar(100);
    declare nbPersonnes INT;
    declare place INT;
    SELECT nbPersG+nbTechG INTO nbPersonnes FROM GROUPE WHERE idG=new.idG LIIMT 1;
    SELECT nbPlaceR INTO place FROM RESTAURANT WHERE idR=new.idR LIIMT 1;
    if nbPersonnes > place THEN
        set mess = concat("il n'y a pas assez de place dans le restorant", new.idR);
        signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
    end if;
end |
delimiter ;

-- 7 Le nombre de place de l’hotels doit être supérieur ou égal au nombre de personnes dans le groupe + techniciens
delimiter |
CREATE OR REPLACE TRIGGER ReservationPourHotel BEFORE INSERT ON HOTEL FOR EACH ROW
begin
    declare mess varchar(100);
    declare nbPers INT default 1;
    declare place INT default 0;
    SELECT nbPersG+nbTechG into nbPers FROM GROUPE WHERE idH=new.idH LIMIT 1;
    SELECT nbPlaceH into place FROM HOTEL WHERE idH=new.idH LIMIT 1;
    if nbPers>place then
        set mess = concat("il manque des places dans l'hotel ", new.idH);
        signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
    end if;
end |
delimiter ;
