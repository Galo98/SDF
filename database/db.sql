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