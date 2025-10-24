DROP TABLE IF EXISTS capacite;

CREATE TABLE capacite (
    id INT NOT NULL AUTO_INCREMENT,
    nom_capacite VARCHAR(255) DEFAULT NULL,
    CONSTRAINT capacite_id PRIMARY KEY (id)
);

INSERT INTO capacite (id, nom_capacite) VALUES
(1, 'Invisibilité'),
(2, 'Téléportation'),
(3, 'Contrôle du feu'),
(4, 'Maîtrise de la glace'),
(5, 'Télépathie'),
(6, 'Super force'),
(7, 'Vitesse surhumaine'),
(8, 'Guérison rapide'),
(9, 'Contrôle du temps'),
(10, 'Manipulation de l’électricité'),
(11, 'Lévitation'),
(12, 'Vision nocturne'),
(13, 'Transformation animale'),
(14, 'Bouclier d’énergie'),
(15, 'Lecture des pensées');

DROP TABLE IF EXISTS equipe;

CREATE TABLE equipe (
    id INT NOT NULL AUTO_INCREMENT,
    nom_equipe VARCHAR(255) DEFAULT NULL,
    CONSTRAINT equipe_id PRIMARY KEY (id)
);

INSERT INTO equipe (id, nom_equipe) VALUES
(1, 'La Ligue des Justiciers'),
(2, 'Les Avengers'),
(3, 'Les X-Men'),
(4, 'Les Quatre Fantastiques'),
(5, 'Les Teen Titans'),
(6, 'Les Gardiens de la Galaxie'),
(7, 'Suicide Squad'),
(8, 'Les Indestructibles'),
(9, 'Les Watchmen'),
(10, 'The Boys'),
(11, 'Les Power Rangers'),
(12, 'Umbrella Corp'),
(13, 'La Ligue des Gentlemen Extraordinaires'),
(14, 'Les Thunderbolts');

DROP TABLE IF EXISTS heros;

CREATE TABLE heros (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(200) DEFAULT NULL,
    prenom VARCHAR(200) DEFAULT NULL,
    pseudo VARCHAR(200) DEFAULT NULL,
    capacite_id INT DEFAULT NULL,
    equipe_id INT DEFAULT NULL,
    CONSTRAINT heros_id PRIMARY KEY (id),
    CONSTRAINT fk_heros_capacite FOREIGN KEY (capacite_id) REFERENCES capacite (id),
    CONSTRAINT fk_heros_equipe FOREIGN KEY (equipe_id) REFERENCES equipe (id)
);

INSERT INTO heros (id, nom, prenom, pseudo, capacite_id, equipe_id) VALUES
-- Avengers
(1, 'Stark', 'Tony', 'Iron Man', 10, 2),
(2, 'Rogers', 'Steve', 'Captain America', 14, 2),
(3, 'Odinson', 'Thor', 'Thor', 10, 2),
(4, 'Romanoff', 'Natasha', 'Black Widow', 12, 2),
(5, 'Barton', 'Clint', 'Hawkeye', 12, 2),
(6, 'Banner', 'Bruce', 'Hulk', 6, 2),
(7, 'Maximoff', 'Wanda', 'Sorcière Rouge', 5, 2),
(8, 'Vision', NULL, 'Vision', 14, 2),
(9, 'Lang', 'Scott', 'Ant-Man', 1, 2),
(10, 'Danvers', 'Carol', 'Captain Marvel', 10, 2),

-- X-Men
(11, 'Summers', 'Scott', 'Cyclope', 10, 3),
(12, 'Grey', 'Jean', 'Phénix', 5, 3),
(13, 'Logan', NULL, 'Wolverine', 8, 3),
(14, 'Monroe', 'Ororo', 'Tornade', 10, 3),
(15, 'Drake', 'Bobby', 'Iceberg', 4, 3),
(16, 'Rasputin', 'Piotr', 'Colossus', 6, 3),
(17, 'Pryde', 'Kitty', 'Shadowcat', 1, 3),
(18, 'Darkholme', 'Raven', 'Mystique', 13, 3),
(19, 'Wagner', 'Kurt', 'Diablo', 2, 3),
(20, 'Xavier', 'Charles', 'Professeur X', 5, 3),

-- Quatre Fantastiques
(21, 'Richards', 'Reed', 'Monsieur Fantastique', 11, 4),
(22, 'Storm', 'Susan', 'Femme Invisible', 1, 4),
(23, 'Storm', 'Johnny', 'Torch Human', 3, 4),
(24, 'Grimm', 'Ben', 'La Chose', 6, 4),

-- Ligue des Justiciers
(25, 'Wayne', 'Bruce', 'Batman', 12, 1),
(26, 'Kent', 'Clark', 'Superman', 6, 1),
(27, 'Prince', 'Diana', 'Wonder Woman', 6, 1),
(28, 'Allen', 'Barry', 'Flash', 7, 1),
(29, 'Curry', 'Arthur', 'Aquaman', 6, 1),
(30, 'Jordan', 'Hal', 'Green Lantern', 14, 1),
(31, 'Stone', 'Victor', 'Cyborg', 10, 1),

-- Teen Titans
(32, 'Grayson', 'Dick', 'Nightwing', 12, 5),
(33, 'Logan', 'Garfield', 'Beast Boy', 13, 5),
(34, 'Roth', 'Rachel', 'Raven', 5, 5),
(35, 'Todd', 'Jason', 'Red Hood', 12, 5),
(36, 'West', 'Wally', 'Kid Flash', 7, 5),

-- Gardiens de la Galaxie
(37, NULL, NULL, 'Star-Lord', 12, 6),
(38, NULL, NULL, 'Groot', 6, 6),
(39, NULL, NULL, 'Rocket Raccoon', 12, 6),
(40, NULL, NULL, 'Drax le Destructeur', 6, 6),
(41, NULL, NULL, 'Gamora', 12, 6),

-- Suicide Squad
(42, 'Quinn', 'Harleen', 'Harley Quinn', 12, 7),
(43, NULL, NULL, 'Deadshot', 12, 7),
(44, NULL, NULL, 'Captain Boomerang', 7, 7),
(45, NULL, NULL, 'Killer Croc', 6, 7);

COMMIT