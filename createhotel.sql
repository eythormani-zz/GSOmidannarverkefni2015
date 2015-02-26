CREATE TABLE Hotel(
	ID int auto_increment,
	nafn varchar(30)
);
CREATE TABLE Notendur(
	ID int auto_increment,
	nafn varchar(100),
	email varchar(100),
	simi int(7),
	kortanumer varchar(32)
);
CREATE TABLE Tegund(
	ID int auto_increment,
	tegund varchar(20),
	nott int(10),
	fjoldi tinyint
);
CREATE TABLE Herbergi(
	ID int auto_increment,
	tegundID int references Tegund(ID),
	hotelID int references Hotel(ID),
	laust binary
);
CREATE TABLE Bokanir(
	ID int auto_increment,
	notandiID int references Notendur(ID),
	hotelID int references Hotel(ID),
	herbergiID int references Herbergi(ID),
	hallo date,
	bless date
);