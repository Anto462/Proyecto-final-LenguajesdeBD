create table proyectos (
id_proyecto nvarchar(10) not null
,descripcion varchar(50)
,duracion varchar(10)
,tipo varchar (5)
,localizacion varchar (10)
,valor varchar (10)
,planofinal varchar (25)
,CONSTRAINT proyectos_pk primary key  (id_proyecto)
)
create table Usuario(
id_usuario nvarchar(10) not NULL
,nombre varchar(25)
,rol varchar(25)
,contraseña varchar(25)
,email varchar(25)
,puntacion varchar(25)
, CONSTRAINT Usuario_pk primary key (id_usuario)
)

create tabla proveedor(
id_proveedor nvarchar(10) not NULL
,nombre varchar(25)
,email varchar (25)
,fiabilidad varchar(25)
,localizacion varchar(25)
,producto varchar (25)
,CONSTRAINT proveedor_pk primary key (id_proveedor)
)

create tabla Contratista(
id_empresa varchar(10) not null
,nombre varchar(25)
,ountacion varchar (25)
,email varchar (25)
,contraseña 
,valor
, CONSTRAINT Contratista_pk primary key (id_empresa)
)

create table Anteproyecto(
id_ante_proyecto nvarchar(10) no NULL
,id_proyecto nvarchar(10) not Null
,Localizacion 
,descripcion varcahr (25)
,presupuesto varchar(25)
,duracionaprox varchar(25)
,id_usuario nvarchar(10) not NULL
,id_empresa varchar(10) not null
CONSTRAINT Contratista_pk primary key (id_ante_proyecto)
CONSTRAINT proyectos_p_fk FOREIGN KEY (id_proyecto) REFERENCES proyectos 
CONSTRAINT proyectos_L_fk FOREIGN KEY (Localizacion) REFERENCES proyectos 
CONSTRAINT Usuario_fk FOREIGN KEY (id_usuario) REFERENCES Usuario 
CONSTRAINT empresa_fk FOREIGN KEY (id_empresa) REFERENCES Contratista
)

