---En aquellos donde se puntue coloque number para darles valores del 1 al 5

create table proveedor(
id_proveedor nvarchar(10) not NULL
,nombre varchar(25)
,email varchar (25)
,fiabilidad number
,localizacion varchar(25)
,producto varchar (25)
,CONSTRAINT proveedor_pk primary key (id_proveedor)
)

create table Usuario(
id_usuario nvarchar(10) not NULL
,nombre varchar(25)
,apellido1 varchar(25)
,apellido2 varchar(25)
,rol varchar(25)
,contraseña varchar(25)
,email varchar(25)
,puntacion number
,id_proveedor nvarchar(10) not NULL

, CONSTRAINT Usuario_pk primary key (id_usuario)
, CONSTRAINT provedor_fk FOREIGN KEY (id_proveedor) REFERENCES proveedor 
)


create table Contratista(
id_empresa varchar(10) not null
,nombre varchar(25)
,puntacion varchar (25)
,email varchar (25)
,contraseña varchar(25)
,valor number
,id_proveedor nvarchar(10) not NULL
,id_usuario nvarchar(10)

, CONSTRAINT Contratista_pk primary key (id_empresa)
, CONSTRAINT provedor_fk FOREIGN KEY (id_proveedor) REFERENCES proveedor
, usuario_fk FOREIGN KEY (id_usuario) REFERENCES Usuario  
)

create table Anteproyecto(
id_ante_proyecto nvarchar(10) not NULL
,Localizacion varchar(25)
,descripcion varchar(25)
,presupuesto number
,duracionaprox varchar(25)
,id_usuario nvarchar(10) not NULL
,id_empresa varchar(10) not null

,CONSTRAINT Contratista_pk primary key (id_ante_proyecto)
,CONSTRAINT Usuario_fk FOREIGN KEY (id_usuario) REFERENCES Usuario 
,CONSTRAINT empresa_fk FOREIGN KEY (id_empresa) REFERENCES Contratista
)

create table proyectos (
id_proyecto nvarchar(10) not null
,descripcion varchar(50)
,duracion varchar(10)
,tipo varchar (5)
,localizacion varchar (10)
,valor number
,planofinal varchar (25)
,id_ante_proyecto nvarchar(10) not NULL

,CONSTRAINT proyectos_pk primary key  (id_proyecto)
,CONSTRAINT anteproyecto_fk FOREIGN KEY (id_ante_proyecto) REFERENCES Anteproyecto
)
