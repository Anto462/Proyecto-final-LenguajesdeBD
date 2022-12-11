---En aquellos donde se puntue coloque number para darles valores del 1 al 5

create table proveedor(
id_proveedor number not null
,nombre varchar(25)
,email varchar (25)
,fiabilidad number
,localizacion varchar(25)
,producto varchar (25)
,primary key (id_proveedor)
);

create table Usuario(
id_usuario number not null
,nombre varchar(25)
,apellido1 varchar(25)
,apellido2 varchar(25)
,rol varchar(25)
,contraseña varchar(25)
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
,contraseña varchar(25)
,valor number
,id_proveedor number not null
,id_usuario number not null

,primary key (id_empresa)
,FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor)
,FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario) 
);

create table Anteproyecto(
id_ante_proyecto number not null
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
id_proyecto number not null
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
