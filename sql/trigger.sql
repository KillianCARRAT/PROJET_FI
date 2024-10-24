-- Une salle ne peut pas être réservée plusieure fois au même moment
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


-- Une salle coit avoir assez de place en loge pour accueillir les artistes
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