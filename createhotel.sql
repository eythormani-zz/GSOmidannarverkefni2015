CREATE TABLE hotel(
	ID int auto_increment PRIMARY KEY,
	nafn varchar(30)
);
CREATE TABLE notendur(
	ID int auto_increment PRIMARY KEY,
	nafn varchar(100),
	email varchar(100),
	simi int(7),
	kortanumer varchar(32)
);
CREATE TABLE tegund(
	ID int auto_increment PRIMARY KEY,
	tegund varchar(20),
	nott int(10),
	fjoldi tinyint
);
CREATE TABLE herbergi(
	ID int auto_increment PRIMARY KEY,
	tegundID int references tegund(ID),
	hotelID int references hotel(ID),
);
CREATE TABLE bokanir(
	ID int auto_increment PRIMARY KEY,
	notandiID int references Notendur(ID),
	hotelID int references Hotel(ID),
	herbergiID int references Herbergi(ID),
	hallo date,
	bless date
);
CREATE TABLE users(
	ID int auto_increment PRIMARY KEY,
	username varchar(255),
	password varchar(255),
	salt char(21)
);