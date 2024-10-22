delimiter
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
