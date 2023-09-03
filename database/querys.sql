show tables;

select * from facturas;

insert into facturas (factMonto,factFecIni,factFecVen,interes) values (monto,"fechaini"."fechaVen",interes);

delete from facturas where factID BETWEEN 1 and 4;
insert into intereses  (inteDia,intePorce) values (0,0);
select * from facturas;
select * from intereses;
SELECT
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