# Execution en local

Serveur utilisé : **XAMPP**

Lien de telechargement :<https://www.apachefriends.org/fr/download.html>

Installer.


Récupérer le dépot git sur : <https://github.com/Eyola/ECF-Garage.git>

Télécharger dans le dossier "htdocs" dans le repertoire de XAMPP (par défaut C:\xampp\htdocs).

Lancer le panneau de controle de XAMPP : start **"Apache"** et start **"MySQL"**.

Se connecter à un serveur de base de donnée, ou utiliser PHPmyAdmin accessible via XAMPP (cliquer sur "Admin" sur la ligne "MySQL" du panneau de controle de XAMPP).

Envoyer les requêtes SQL suivantes :

````SQL
CREATE DATABASE parrot;

CREATE TABLE car (
car_id char(60) NOT NULL PRIMARY KEY,
car_brand varchar(100) NOT NULL,
car_model varchar(100) NOT NULL,
car_price int(6) NOT NULL,
car_year int(4) NOT NULL,
car_kilometer int(6) NOT NULL,
car_description varchar(255) DEFAULT NULL,
car_img text DEFAULT NULL
);

CREATE TABLE commentary (
commentary_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
commentary_name varchar(100) NOT NULL,
commentary_first_name varchar(100) NOT NULL,
commentary_statut varchar(20) NOT NULL DEFAULT 'Wait',
commentary_mail varchar(254) NOT NULL,
commentary_message varchar(255) NOT NULL
);

CREATE TABLE users (
users_id int(6) NOT NULL PRIMARY_KEY AUTO_INCREMENT,
users_role varchar(20) NOT NULL DEFAULT 'user',
users_name varchar(100) NOT NULL,
users_first_name varchar(100) NOT NULL,
users_mail varchar(254) NOT NULL UNIQUE,
users_password varchar(60) NOT NULL
);

INSERT INTO users (users_id, users_role, users_name, users_first_name, users_mail, users_password) VALUES
(857, 'admin', 'Parrot', 'Vincent', 'vincent.parrot@garage.fr', '$2y$10$zB525MFCK1NQVETaPp6dxO3aCeI3w/6bcjGJbIqI2o81tArEBnI4K');

INSERT INTO car (car_id, car_brand, car_model, car_price, car_year, car_kilometer, car_description, car_img) VALUES
('822e5c6b-d03d-11ee-ae21-408d5c4b144d', 'Peugeot', '308', 12000, 2016, 150000, 'Une voiture récente', '308.jpg'),
('93e98ece-d03c-11ee-ae21-408d5c4b144d', 'Renault', 'Clio', 6000, 2014, 175000, 'Une voiture sympa', 'Clio.jpg'),
('996aa9c8-d03d-11ee-ae21-408d5c4b144d', 'Dacia', 'Sandero', 13000, 2018, 135000, 'Une voiture plus grosse', 'Dacia.jpg'),
('bf54a755-d03d-11ee-ae21-408d5c4b144d', 'Citroen', '2 chevaux', 15000, 1956, 384000, 'Une authentique !', '2cv.jpg');
```

Démarrer le navigateur web et entrer l'url suivante : <http://localhost/ECF-Garage/>

id de connexion admin : vincent.parrot@garage.fr -> 123
