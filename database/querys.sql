show tables;

select * from facturas;
select * from intereses;
insert into facturas (factMonto,factFecIni,factFecVen,interes) values (monto,"fechaini"."fechaVen",interes);

delete from facturas where factID BETWEEN 1 and 4;
insert into intereses  (inteDia,intePorce) values (0,0);
select * from facturas;
select * from intereses;SELECT
    facturas.*,
    intereses.intePorce,
    DATE_FORMAT(factFecIni, '%d/%m/%Y') as factFecIni,
    DATE_FORMAT(factFecVen, '%d/%m/%Y') as factFecVen 
FROM facturas
    INNER JOIN intereses ON facturas.interes = intereses.inteID
ORDER BY factID asc;

use SDF;

select
    facturas.*,
    intereses.intePorce
from facturas
    inner join intereses on facturas.interes = intereses.inteDia
where factID = 5
order by factID ASC;





DELIMITER //

CREATE FUNCTION CALCULAREINSERTARINTERESES() RETURNS 
INT BEGIN DECLARE 
	DECLARE facID INT;
	DECLARE monto DECIMAL(10, 2);
	DECLARE fecha_inicio DATE;
	DECLARE fecha_vencimiento DATE;
	DECLARE interes_fk INT;
	DECLARE dias_vencidos INT;
	DECLARE interes_calculado DECIMAL(10, 2);
	-- Recorre las facturas vencidas
	DECLARE cur CURSOR FOR
	SELECT
	    factID,
	    factMonto,
	    factFecIni,
	    factFecVen,
	    interes
	FROM facturas
	WHERE
	    factFecVen < CURDATE()
	    AND interes IS NOT NULL;
	-- Asegurarse de que la factura tiene un interés asociado
	OPEN cur;
	FETCH cur INTO factura_id,
	monto,
	fecha_inicio,
	fecha_vencimiento,
	interes_fk;
	-- Calcula e inserta los intereses en las facturas
	WHILE
	    factura_id IS NOT NULL
	DO
	SET
	    dias_vencidos = DATEDIFF(CURDATE(), fecha_vencimiento);
	-- Calcula los días vencidos
	-- Calcula el interés según la tasa de interés de la tabla intereses
	SELECT
	    intePorce INTO interes_calculado
	FROM intereses
	WHERE
	    inteDia = dias_vencidos;
	IF interes_calculado IS NOT NULL THEN
	SET
	    interes_calculado = (monto * interes_calculado) / 100;
	-- Calcula el interés
	-- Inserta el interés calculado en la factura
	INSERT INTO
	    facturas_intereses (
	        factura_id,
	        monto,
	        fecha_inicio,
	        fecha_vencimiento,
	        interes_fk,
	        interes_calculado
	    )
	VALUES (
	        factura_id,
	        monto,
	        fecha_inicio,
	        fecha_vencimiento,
	        interes_fk,
	        interes_calculado
	    );
	END IF;
	FETCH cur INTO factura_id,
	monto,
	fecha_inicio,
	fecha_vencimiento,
	interes_fk;
	END WHILE;
	CLOSE cur;
	RETURN 1;
	-- Indica que la función se ejecutó correctamente
	END;


//

DELIMITER ;


UPDATE facturas
SET
    interes = DATEDIFF(CURDATE(), factFecVen)
WHERE factFecVen < CURDATE();

select * from facturas;

UPDATE facturas AS f
    LEFT JOIN intereses AS i ON DATEDIFF(CURDATE(), f.factFecVen) = i.inteDia
SET
    f.interes = IFNULL(
        i.inteDia, (
            SELECT MAX(inteDia)
            FROM intereses
        )
    )
WHERE f.factFecVen < CURDATE();