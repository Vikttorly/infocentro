create table funcionario(
	id int(2) not null primary key auto_increment,
	usuario varchar(45),
	contrasena varchar(45),
	nombre text(90),
	sexo char(1),
	rango char(1),
	fRegistro timestamp
);

create table usuarios(
	id int(8) not null primary key auto_increment,
	ci int(8),
	nombre text(90),
	fNacimiento date,
	sexo char(1),
	direccion varchar(300),
	registrador int(2)
);

create table visitas(
	id int(8) not null primary key auto_increment,
	usuario int(8),
	registrador int(2),
	fEntrada timestamp
);