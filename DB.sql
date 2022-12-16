create table proveedor(
id_proveedor number not null
,nombre varchar(25)
,email varchar (25)
,fiabilidad number(3)
,localizacion varchar(25)
,producto varchar (25)
,primary key (id_proveedor)
);

create table Usuario(
id_usuario number not null
,nombre varchar(25)
,apellido1 varchar(25)
,apellido2 varchar(25)
,roll varchar(25)
,contrasena varchar(25)
,email varchar(25)
,puntacion number
,id_proveedor number not null

,primary key (id_usuario)
,FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor) 
);

create table Contratista(
id_empresa number not null
,nombre varchar(25)
,puntacion varchar (25)
,email varchar (25)
,contrasena varchar(25)
,valor number
,id_proveedor number not null
,id_usuario number not null

,primary key (id_empresa)
,FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor)
,FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario) 
);

create table Anteproyecto(
id_ante_proyecto NUMBER GENERATED ALWAYS AS IDENTITY
,Localizacion varchar(25)
,descripcion varchar(25)
,presupuesto number
,duracionaprox varchar(25)
,id_usuario number not null
,id_empresa number not null

,primary key (id_ante_proyecto)
,FOREIGN KEY (id_usuario) REFERENCES Usuario (id_usuario)
,FOREIGN KEY (id_empresa) REFERENCES Contratista (id_empresa)
);

create table proyectos (
id_proyecto NUMBER GENERATED ALWAYS AS IDENTITY
,descripcion varchar(50)
,duracion varchar(10)
,tipo varchar (5)
,localizacion varchar (10)
,valor number
,planofinal varchar (25)
,id_ante_proyecto number not null

,primary key  (id_proyecto)
,FOREIGN KEY (id_ante_proyecto) REFERENCES Anteproyecto(id_ante_proyecto)
);
---------------------------------------------------------------
-----------------------

CREATE OR REPLACE TRIGGER TRG_ANTEPROYECTOS
AFTER INSERT ON Anteproyecto
DECLARE
    VAR_IDANTEPROYECTO NUMBER;
    VAR_LOCALIZACION VARCHAR2(100);
    VAR_DESCRIPCION VARCHAR2(100);
    VAR_DURACION VARCHAR2(100);
    VAR_PRESU NUMBER;
    VAR_TIPO VARCHAR2(100);
    VAR_CONTROL VARCHAR2(100);
    
BEGIN
    SELECT max(id_ante_proyecto) INTO VAR_CONTROL FROM Anteproyecto;
    SELECT id_ante_proyecto INTO VAR_IDANTEPROYECTO FROM Anteproyecto WHERE id_ante_proyecto = VAR_CONTROL;
    SELECT presupuesto INTO VAR_PRESU FROM Anteproyecto WHERE id_ante_proyecto = VAR_CONTROL;
    SELECT Localizacion INTO VAR_LOCALIZACION FROM Anteproyecto WHERE id_ante_proyecto = VAR_CONTROL;
    SELECT descripcion INTO VAR_DESCRIPCION FROM Anteproyecto WHERE id_ante_proyecto = VAR_CONTROL;
    SELECT duracionaprox INTO VAR_DURACION FROM Anteproyecto WHERE id_ante_proyecto = VAR_CONTROL;
    
    IF VAR_PRESU > 8000000 then
    VAR_TIPO := 'MED';
    ELSIF VAR_PRESU > 80000000 then
    VAR_TIPO := 'BIG';
    ELSE
    VAR_TIPO := 'SMALL';
    END IF;
    
    INSERT INTO proyectos( descripcion, duracion, tipo, localizacion, valor, planofinal, id_ante_proyecto)
    VALUES(VAR_DESCRIPCION,VAR_DURACION,VAR_TIPO,VAR_LOCALIZACION,0,'Pendiente',VAR_IDANTEPROYECTO);
END;

INSERT INTO PROVEEDOR (id_proveedor,nombre, email, fiabilidad, localizacion, producto) VALUES (1,'Materiales Jota', 'mjota@gmail.com', 75, 'Heredia', 'Materiales construccion');
INSERT INTO USUARIO (id_usuario,nombre, apellido1, apellido2, roll, contrasena, email, puntacion, id_proveedor) VALUES (1,'Jose', 'Rodriguez', 'Jara', 'Servicios', '123', 'jose@gmail.com', 100, 1);
INSERT INTO CONTRATISTA (id_empresa,nombre, puntacion, email, contrasena, valor, id_proveedor, id_usuario) VALUES (1,'Constructora Izq SA', 5, 'cizq@gmail.com', '123', 123, 1,  1);
INSERT INTO ANTEPROYECTO (Localizacion, descripcion, presupuesto, duracionaprox, id_usuario, id_empresa) VALUES ('Heredia', 'Materiales construcción.', 5000000.00, '8 meses', 1, 1);
INSERT INTO ANTEPROYECTO (Localizacion, descripcion, presupuesto, duracionaprox, id_usuario, id_empresa) VALUES ('Belen','Casa Campo',10000,'6 meses',1,1);
-----------------------------------------------
create table FIABILIDAD(
    codigo_registro  NUMBER GENERATED ALWAYS AS IDENTITY,
    codigo_proveedor NUMBER(10) NOT NULL,
    promedio_anterior NUMBER(3) NOT NULL,
    promedio_actualizado NUMBER(3) NOT NULL,
    fecha DATE
);
-----------------------------------------------------
-------------------------
CREATE OR REPLACE TRIGGER TRG_PROYECTOS
AFTER UPDATE ON PROYECTOS
FOR EACH ROW
WHEN (NEW.VALOR != 0)
    BEGIN
    UPDATE PROYECTOS SET PLANOFINAL = 'APROBADOS';
END;
------------------------
create view muestraprov as SELECT * FROM proveedor;
create view muestrausers as SELECT * FROM Usuario;
create view muestracont as SELECT * FROM Contratista;
create view muestraant as SELECT * FROM Anteproyecto;
-----
------------------DROPS
drop table proveedor;
drop table Usuario;
drop table Contratista;
drop table Anteproyecto;
drop table proyectos;
drop table fiabilidad;

drop view muestraprov;
drop view muestrausers;
drop view muestracont;
drop view muestraant;