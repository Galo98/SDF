create database SDF;

use SDF;

create table intereses(
    inteID int auto_increment,
    inteDia int,
    intePorce int,
    primary key (inteID,inteDia)
);

create table facturas(
    factID int auto_increment,
    factMonto float(9.2),
    factFecIni date,
    factFecVen date,
    interes int,
    primary key (factID,factFecIni),
    foreign key (interes) references intereses(inteID)
);