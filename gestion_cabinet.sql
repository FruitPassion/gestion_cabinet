CREATE OR REPLACE USER 'local_user'@'localhost' IDENTIFIED BY 'password';
DROP DATABASE IF EXISTS db_gestion_cabinet;
create database db_gestion_cabinet;
grant all privileges on db_gestion_cabinet.* TO 'local_user'@'localhost' identified by 'password';
flush privileges;
USE db_gestion_cabinet;

CREATE TABLE Medecin
(
    id_medecin INT AUTO_INCREMENT,
    nom        varchar(50),
    prenom     varchar(50),
    civilite   bool,
    PRIMARY KEY (id_medecin)
);

CREATE TABLE Patient
(
    id_patient     INT AUTO_INCREMENT,
    nom            varchar(50),
    prenom         varchar(50),
    civilite       bool,
    adresse        varchar(100),
    code_postal    int(5),
    ville          varchar(50),
    date_naissance DATE,
    lieu_naissance varchar(50),
    nss            BIGINT,
    id_medecin     int,
    PRIMARY KEY (id_patient),
    FOREIGN KEY (id_medecin) REFERENCES Medecin (id_medecin)
);

CREATE TABLE RendezVous
(
    id_medecin INT,
    id_patient INT,
    date       DATE,
    heure      TIME,
    duree      int,
    PRIMARY KEY (id_medecin, id_patient),
    FOREIGN KEY (id_medecin) REFERENCES Medecin (id_medecin),
    FOREIGN KEY (id_patient) REFERENCES Patient (id_patient)
);

CREATE TABLE Utilisateur
(
    id_utilisateur INT AUTO_INCREMENT,
    login          varchar(50),
    password       varchar(50),
    PRIMARY KEY (id_utilisateur)
);

INSERT INTO Utilisateur (login, password)
VALUES ('user1', 'password1'),
       ('user2', 'password2');

INSERT INTO Medecin (nom, prenom, civilite)
VALUES ('Oskour', 'Jeanne', 1),
       ('Macon', 'Benoit', 0),
       ('Ki', 'Moon', 0);

INSERT INTO Patient (nom, prenom, civilite, adresse, code_postal, ville, date_naissance, lieu_naissance, nss, id_medecin)
VALUES
    ('Dort', 'Theo', 0, '3 chemin Duquerry', '97122', 'Baie-Mahault', '2003-03-11', 'Le Moule', '1234543234321', 1),
    ('Hamood', 'Habibi', 1, '12 rue Duquerry', '97190', 'Gosier', '2004-07-31', 'Baie-Mahult', '2345678954343', 1),
    ('Nanaha', 'Hamza', 0, '3333 boulevard Duquerry', '97170', 'Petit-Bourg', '1998-08-15', 'Gosier', '3243546543267', 1),
    ('Boudin', 'Raphael', 0, '666 impasse Duquerry', '97122', 'Baie-Mahault', '1930-12-06', 'Anse-Bertrand', '6545654367898', 2),
    ('Duclerc', 'Mathieu', 1, '123 maisonnée Duquerry', '97110', 'Abymes', '1989-01-01', 'Saint-Anne', '7654343234321', 2),
    ('Longuet', 'Cedric', 0, '11 boulevard Duquerry', '97122', 'Baie-Mahault', '1999-11-11', 'Goyave', '9876567654543', 3),
    ('Gribanova', 'Sofia', 1, '12 route Emile Louis', '97121', 'Anse-Bertrand', '2000-01-14', 'Vieux Habitants', '0987654321876', 3),
    ('Armand', 'Simon', 0, '543 impasse Balkani', '97180', 'Saint-Anne', '1987-05-23', 'Saint-Anne', '5678901234567', 3),
    ('Gikapa', 'Christian', 0, '63 allée Bellanger', '97160', 'Le Moule', '1996-06-26', 'Abymes', '8907686543235', 3),
    ('Bes', 'Eliotte', 1, '87 chemin VIagra', '97122', 'Baie-Mahault', '2001-03-10', 'Le Moule', '7887654323454', 3);



INSERT INTO RendezVous (id_medecin, id_patient, date, heure, duree)
VALUES (1, 1, '2023-11-12', '09:00:00', 30),
       (1, 2, '2023-11-13', '10:30:00', 45),
       (2, 4, '2023-11-12', '11:00:00', 30),
       (2, 5, '2023-11-14', '14:00:00', 30),
       (3, 6, '2023-11-15', '15:30:00', 45),
       (3, 7, '2023-11-16', '16:00:00', 30),
       (1, 3, '2023-11-17', '09:30:00', 30),
       (3, 8, '2023-11-19', '08:45:00', 45),
       (1, 5, '2023-11-21', '09:00:00', 30),
       (1, 6, '2023-11-22', '10:30:00', 45),
       (2, 7, '2023-11-23', '11:00:00', 30),
       (2, 8, '2023-11-24', '14:00:00', 30),
       (3, 9, '2023-11-25', '15:30:00', 45),
       (3, 10, '2023-11-26', '16:00:00', 30),
       (2, 3, '2023-11-28', '10:00:00', 30),
       (3, 4, '2023-11-29', '08:45:00', 45),
       (3, 1, '2023-11-30', '11:15:00', 30);