
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
