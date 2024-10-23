-- Une salle ne peut pas être réservée plusieure fois au même moment
delimiter |
CREATE OR REPLACE TRIGGER ReservationSalleMemeMoment BEFORE INSERT ON CONCERT FOR EACH ROW
begin
    declare mess VARCHAR(500);
    declare debut date;
    declare fin date;
    declare fini boolean default false;
    declare lesHeures cursor for 
        select heureArrive, ADDDATE(debutConcert,dureeConcert) FROM CONCERT WHERE idS=new.idS;
    declare continue handler for not found set fini = true;
    open lesHeures;
    while not fini do
        fetch lesHeures into debut,fin;
        if NEW.heureArrive < fin AND ADDDATE(NEW.heureArrive, INTERVAL NEW.dureeConcert DAY) > debut then
            close lesHeures;
            set mess = concat ("réservation impossible pour la réservation numéro ", new.idC);
            signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
        end if;
    end while;
    close lesHeures;
end |
delimiter ;