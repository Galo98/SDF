create database SDF;

use SDF;

create table intereses(
    inteDia int unique,
    intePorce int,
    primary key (inteDia)
);

create table
    clientes(
        cliID int auto_increment,
        cliNombre varchar(42),
        primary key (cliID)
    );
    
create table facturas(
    factID int auto_increment,
    factMonto float(9.2),
    factFecIni date,
    factFecVen date,
    interes int,
    cliID int,
    primary key (factID,factFecIni), 
    foreign key (cliID) references clientes(cliID),
    foreign key (interes) references intereses(inteDia)
);

insert into intereses values (0,0);

CREATE PROCEDURE GENERAR_FACTURAS() BEGIN 
	SET @factMonto = 1000;
	WHILE @factMonto <= 20000
	DO 
	SET @factFecIni = CONCAT(YEAR(NOW()), '-', LPAD(FLOOR(RAND() * 12) + 1, 2, '0'), '-', LPAD(FLOOR(RAND() * 31 + 1), 2, '0'));
	REPEAT
        SET @factFecIni = CONCAT(YEAR(NOW()), '-', LPAD(FLOOR(RAND() * 12) + 1, 2, '0'), '-', LPAD(FLOOR(RAND() * 31 + 1), 2, '0'));
    UNTIL @factFecIni IS NOT NULL END REPEAT;
    SET @factFecVen = @factFecIni + INTERVAL 30 DAY;
	SET @interes = 0;
	SET @cliID = FLOOR(RAND() * 10);
    WHILE @cliID = 0 DO 
        SET @cliID = FLOOR(RAND() * 10);
    END WHILE;
	INSERT INTO
	    facturas (
	        factMonto,
	        factFecIni,
	        factFecVen,
	        interes,
	        cliID
	    )
	VALUES (
	        @factMonto,
	        @factFecIni,
	        @factFecVen,
	        @interes,
	        @cliID
	    );
	SET @factMonto = @factMonto + 1000;
	END WHILE;
END;

CALL generar_facturas();

-- drop procedure GENERAR_FACTURAS;


DELIMITER //
CREATE PROCEDURE CALCULAPORCENTAJEMONTOTOTAL()
BEGIN
    DECLARE montoTot DECIMAL(10, 2);
    SELECT SUM(factMonto) INTO montoTot FROM facturas;
    SELECT
        facturas.cliID,
        clientes.cliNombre,
        COUNT (facturas.factID) as factTot,
        SUM(CASE WHEN facturas.interes > 0 THEN 1 ELSE 0 END) AS factVen,
        SUM(factMonto) AS mTotClie,
        (SUM(factMonto) / montoTot) * 100 AS porcentaje
    FROM facturas
    INNER JOIN clientes ON clientes.cliID = facturas.cliID
    GROUP BY facturas.cliID;
END //
DELIMITER ;

CALL CalculaPorcentajeMontoTotal();

-- drop Procedure CALCULAPORCENTAJEMONTOTOTAL;