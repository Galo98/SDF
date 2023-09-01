create database SDF;

use SDF;

create table intereses(
    inteDia int unique,
    intePorce int,
    primary key (inteDia)
);

create table facturas(
    factID int auto_increment,
    factMonto float(9.2),
    factFecIni date,
    factFecVen date,
    interes int,
    primary key (factID,factFecIni),
    foreign key (interes) references intereses(inteDia)
);

insert into intereses values (0,0);