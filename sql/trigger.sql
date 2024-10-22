-- Une salle ne peut pas être réservée plusieure fois au même moment
delimiter |
CREATE OR REPLACE TRIGGER ReservationSalleMemeMoment BEFORE INSERT ON RESERVATION FOR EACH ROW
begin
    declare mess VARCHAR(500);
    declare debut date;
    declare fin date;
    declare fini boolean default false;
    declare lesHeures cursor for 
        select dateR, ADDDATE(dateR,dureeR) FROM RESERVATION WHERE idS=new.idS;
    declare continue handler for not found set fini = true;
    open lesHeures;
    while not fini do
        fetch lesHeures into debut,fin;
        if NEW.dateR < fin AND ADDDATE(NEW.dateR, INTERVAL NEW.dureeR DAY) > debut then
            close lesHeures;
            set mess = concat ("réservation impossible ", new.idR);
            signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
        end if;
    end while;
    close lesHeures;
end |
delimiter ;


-- Deux concerts d’un même groupe ne peuvent pas avoir lieu en même temps
delimiter |
CREATE OR REPLACE TRIGGER PlaceEnLogesSuffisantes BEFORE INSERT ON RESERVATION FOR EACH ROW
begin
    declare nbArtiste;
    declare nbLoges;
    declare mes varchar(100);
    SELECT COUNT(idA) INTO nbArtiste FROM ARTISTE NATURAL JOIN APPARTIENT NATURAL JOIN GROUPE NATURAL JOIN RESERVATION;
    SELECT SUM(nbPers) INTO nbLoges FROM LOGES NATURAL JOIN SALLE NATURAL JOIN RESERVATION;
    if nbArtiste > nbLoges THEN
        set mes = concat("le nombre de loges et insuffissant, ", nbLoges, " loges pour ", nbArtiste, " artistes.");
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    end if;
end |
delimiter ;

delimiter |
CREATE OR REPLACE TRIGGER pasDeCheuvauchementConcertsInsert before insert on CONCERT for each row
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
CREATE OR REPLACE TRIGGER pasDeCheuvauchementConcertsUpdate before update on CONCERT for each row
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
