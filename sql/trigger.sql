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