CREATE OR REPLACE TRIGGER ReservationSalleMemeMoment BEFORE INSERT ON RESERVATION ON EACH ROW
begin
    declare mess VARCHAR(500);
    declare debut date;
    declare fin date;
    declare fini boolean default false;
    declare lesHeures cursor for 
        select dateR, ADDTIME(dateR,dureeR) FROM RESERVATION WHERE idS=new.idS;
    declare continue handler for not found set fini = true;
    open lesHeures;
    while not fini do
        fetch lesHeures into debut,fin;
        if new.dateR>debut AND new.dateR<fin then
            close lesHeures;
            set mess = concat ("réservation impossible", new.idR);
            signal SQLSTATE ’45000’ set MESSAGE_TEXT = mess;
        end if;
    end while;
    close lesHeures;
end |

INSERT into 