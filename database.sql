CREATE TABLE administrateur(
	id SERIAL NOT NULL PRIMARY KEY,
	login VARCHAR(255),
	password VARCHAR(255)
);

CREATE TABLE utilisateur(
	id SERIAL NOT NULL PRIMARY KEY,
	nom VARCHAR(255),
	prenom VARCHAR(255),
	login VARCHAR(255),
	password VARCHAR(255),
	money DOUBLE PRECISION
);

CREATE TABLE place(
	id SERIAL NOT NULL PRIMARY KEY,
	description VARCHAR(255)
);

CREATE TABLE tarif(
	id SERIAL NOT NULL PRIMARY KEY,
	duree INT,
	prix DOUBLE PRECISION
);

CREATE TABLE parking(
	id SERIAL NOT NULL PRIMARY KEY,
	id_utilisateur INT NOT NULL,
	id_place INT NOT NULL,
	numero_voiture VARCHAR(20) NOT NULL,
	debut TIMESTAMP NOT NULL,
	duree INT NOT NULL,
	fin TIMESTAMP,
	statut BOOLEAN,
	pay BOOLEAN,
	amende BOOLEAN,
	FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
	FOREIGN KEY (id_place) REFERENCES place(id)
);

CREATE TABLE validation(
	id SERIAL PRIMARY KEY NOT NULL,
	id_utilisateur INT NOT NULL,
	amount DOUBLE PRECISION,
	statut BOOLEAN,
	date TIMESTAMP,
	FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
);

CREATE TABLE getnow(
	isnow TIMESTAMP
);

CREATE VIEW park_resume AS 
SELECT numero_voiture,debut,duree,debut::timestamp + (duree * '1 minute'::interval) AS dateheure_fin FROM parking;
