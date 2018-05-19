DELIMITER //
CREATE PROCEDURE calcularNotaMedia(IN Vid_juego INT)
BEGIN
	DECLARE Vtotal_votos INT;
    DECLARE Vtotal_nota INT;
    DECLARE Vnota_media FLOAT;
	SELECT  count(*) INTO Vtotal_votos from votos where juego = Vid_juego ;
    SELECT SUM(NOTA) INTO Vtotal_nota from votos where juego = Vid_juego ;
    SET Vnota_media = Vtotal_nota/Vtotal_votos;
	UPDATE juego SET media = Vnota_media where ID = Vid_juego;
END //
DELIMITER ;


DELIMITER $$

CREATE
	TRIGGER INSERT_NuevaNotaMedia AFTER INSERT ON votos
	FOR EACH ROW BEGIN
		CALL calcularNotaMedia(NEW.JUEGO);
    END$$

DELIMITER ;

DELIMITER $$

CREATE
	TRIGGER UPDATE_NuevaNotaMedia AFTER UPDATE ON votos
	FOR EACH ROW BEGIN
		CALL calcularNotaMedia(NEW.JUEGO);
    END$$

DELIMITER ;

DELIMITER $$

CREATE
	TRIGGER DELETE_NuevaNotaMedia AFTER DELETE ON votos
	FOR EACH ROW BEGIN
		CALL calcularNotaMedia(OLD.JUEGO);
    END$$

DELIMITER ;