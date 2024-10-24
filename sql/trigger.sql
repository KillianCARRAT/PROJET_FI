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

