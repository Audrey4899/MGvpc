-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 06 avr. 2020 à 15:25
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mgvpcdb`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `verifTech`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `verifTech` ()  BEGIN
DECLARE nb INT;
SELECT COUNT(*) INTO nb FROM problemesav WHERE idEmploye IS NULL;
IF nb != 0 THEN
	INSERT INTO incident(descIncident, dateIncident, vu) VALUES ('Il y a un ou plusieurs problèmes SAV géré(s) par aucun employé.', CURRENT_TIMESTAMP(), 0);
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `categorieproduit`
--

DROP TABLE IF EXISTS `categorieproduit`;
CREATE TABLE IF NOT EXISTS `categorieproduit` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` char(50) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorieproduit`
--

INSERT INTO `categorieproduit` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Livres'),
(2, 'Vêtements'),
(3, 'Instruments de musique'),
(4, 'High-Tech'),
(5, 'Jeux vidéos'),
(6, 'DVD & Blu-ray'),
(7, 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(5) NOT NULL AUTO_INCREMENT,
  `nomClient` char(50) NOT NULL,
  `prenomClient` char(50) NOT NULL,
  `rueClient` char(100) NOT NULL,
  `cpClient` char(10) NOT NULL,
  `villeClient` char(50) NOT NULL,
  `mailClient` char(100) NOT NULL,
  `telClient` char(20) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `rueClient`, `cpClient`, `villeClient`, `mailClient`, `telClient`) VALUES
(1, 'Berg', 'Maggy', '4988 Felis. Av.', '28459', 'Berlin', 'ullamcorper.Duis.at@ligulaeuenim.co.uk', '07 81 72 20 28'),
(2, 'Calderon', 'Mannix', 'Ap #573-7705 Malesuada St.', '79839', 'Chaudfontaine', 'non.leo.Vivamus@tellus.ca', '07 51 73 66 48'),
(3, 'Ochoa', 'Olga', 'P.O. Box 233, 6705 Praesent St.', '13969', 'Port Harcourt', 'Cras@Vivamuseuismod.co.uk', '07 39 55 54 52'),
(4, 'Turner', 'Donna', '539-8375 Diam. Av.', '06893', 'Richmond', 'ipsum.porta@bibendumullamcorperDuis.org', '05 10 43 24 20'),
(5, 'Chaney', 'Joel', 'Ap #189-7429 In Rd.', '97472', 'Guna', 'nostra@ultriciesadipiscingenim.edu', '03 33 13 57 37'),
(6, 'Osborn', 'Bruce', '8675 Nec, Ave', '59455', 'Stintino', 'eget.lacus.Mauris@est.net', '04 08 52 23 58'),
(7, 'Curtis', 'Price', '109-7295 Aliquam St.', '73007', 'Koninksem', 'diam.Pellentesque@Curae.net', '05 95 10 76 96'),
(8, 'Lynn', 'Cain', 'P.O. Box 652, 4004 Nunc. Street', '96894', 'Ruvo del Monte', 'ac.libero.nec@quisurnaNunc.org', '01 25 67 19 98'),
(9, 'Olsen', 'Austin', '5969 Malesuada Rd.', '00334', 'Sacramento', 'accumsan.neque@fringillaornare.edu', '07 39 47 13 72'),
(10, 'Rocha', 'Liberty', 'Ap #843-1427 Parturient Road', '00894', 'Loppem', 'odio.Etiam@massaIntegervitae.org', '06 66 50 36 67'),
(11, 'Salas', 'Omar', 'Ap #833-3921 Mollis Av.', '20007', 'Steenhuffel', 'amet.ornare.lectus@afacilisis.ca', '05 25 02 13 71'),
(12, 'Hodge', 'Benjamin', 'Ap #999-1999 Mattis St.', '36283', 'Dhule', 'Quisque@primisinfaucibus.net', '05 68 87 39 05'),
(13, 'Morin', 'Steel', '780-6498 Feugiat St.', '97128', 'Inverurie', 'a.odio@variusultrices.ca', '08 19 53 32 50'),
(14, 'Howell', 'Bianca', '475-2412 Magna Av.', '30879', 'Labrecque', 'et.magnis.dis@temporarcuVestibulum.ca', '08 75 38 70 18'),
(15, 'Whitney', 'Preston', '674-1632 Augue Road', '31945', 'San Giovanni in Galdo', 'congue.In@Utsemper.net', '01 39 39 45 11'),
(16, 'Townsend', 'Logan', 'P.O. Box 676, 1893 Egestas Avenue', '64273', 'Ceranesi', 'at.arcu@scelerisquescelerisque.co.uk', '04 22 00 80 40'),
(17, 'Anthony', 'Ulric', '834-4739 Turpis. St.', '85776', 'Bellevue', 'Phasellus.elit.pede@sit.org', '07 23 59 81 79'),
(18, 'Orr', 'Gary', '116-8888 Mauris Road', '51980', 'Bergeggi', 'Morbi.metus@elitEtiamlaoreet.ca', '08 61 61 48 95'),
(19, 'David', 'Veronica', 'Ap #451-3602 Euismod Rd.', '42267', 'Tranent', 'diam.Sed.diam@dolorDonecfringilla.org', '03 94 33 44 69'),
(20, 'Garcia', 'Howard', '549-1050 Et Rd.', '82927', 'Diksmuide', 'elit.Etiam@inhendreritconsectetuer.org', '05 67 40 19 34'),
(21, 'Herman', 'Colton', 'Ap #507-4886 Volutpat. Rd.', '78860', 'Pettineo', 'convallis.convallis.dolor@amet.ca', '06 46 79 23 41'),
(22, 'Graves', 'Ahmed', '4547 Sociosqu Ave', '19985', 'Wichita', 'diam.Pellentesque@euismod.org', '08 45 22 16 23'),
(23, 'Dunn', 'Aquila', '131-967 Nunc St.', '72496', 'Crowsnest Pass', 'pellentesque.tellus@ultriciesornareelit.co.uk', '03 69 74 37 21'),
(24, 'Baird', 'Xyla', 'Ap #155-9872 Augue Avenue', '98628', 'Fourbechies', 'dolor.sit.amet@eleifendCrassed.com', '05 59 36 97 91'),
(25, 'Collins', 'Wayne', '433-4960 Cursus Street', '59822', 'Istres', 'non.magna.Nam@aliquamarcuAliquam.edu', '08 17 93 95 23'),
(26, 'Wilson', 'Octavius', '840 Nec Rd.', '02158', 'Friedberg', 'netus.et@convallisin.net', '02 32 06 54 99'),
(27, 'Harper', 'Donna', '6005 Non Rd.', '63075', 'Cisterna di Latina', 'pellentesque@quam.edu', '03 13 96 31 19'),
(28, 'Hester', 'Richard', '101-7928 Dui. Rd.', '53031', 'Afşin', 'odio.Etiam@consequatdolor.ca', '05 53 58 95 11'),
(29, 'Ingram', 'Mia', 'Ap #733-8795 Cursus Street', '93903', 'Joncret', 'ut.nisi@Vestibulumaccumsan.co.uk', '01 04 60 95 76'),
(30, 'Bender', 'Marcia', '771-4853 Euismod Av.', '73291', 'Salzgitter', 'convallis@pellentesqueSed.com', '02 50 28 51 35'),
(31, 'Marquez', 'Olympia', '9353 Vestibulum St.', '46165', 'Rotorua', 'ipsum@mollisduiin.net', '01 08 48 60 38'),
(32, 'Rivera', 'Fulton', 'Ap #698-4016 Nam St.', '30269', 'Douai', 'natoque.penatibus.et@a.co.uk', '04 76 50 23 36'),
(33, 'Cobb', 'Erich', '197-2270 Mollis Road', '33821', 'Castel Giorgio', 'Donec.at.arcu@Sedpharetra.org', '06 39 35 12 52'),
(34, 'Stanton', 'Marah', 'Ap #383-8667 Sed St.', '42950', 'Sarreguemines', 'iaculis.odio.Nam@amet.net', '01 14 23 90 01'),
(35, 'Reynolds', 'MacKensie', 'P.O. Box 824, 9101 Sagittis. Ave', '72930', 'Leduc', 'non@ultriciesligulaNullam.net', '09 84 12 56 11'),
(36, 'Park', 'Travis', '463 Eu Street', '39563', 'Campotosto', 'Proin@convalliserateget.edu', '07 11 37 25 68'),
(37, 'Everett', 'Robert', 'Ap #485-2918 Turpis Av.', '82706', 'Prè-Saint-Didier', 'felis.Nulla@quis.net', '02 53 89 83 19'),
(38, 'Jenkins', 'Maris', '869-2784 Arcu Road', '73308', 'Tiruchirapalli', 'malesuada.fames.ac@neque.net', '05 05 73 44 19'),
(39, 'Gray', 'Cain', '3819 Aliquam Rd.', '20819', 'San Esteban', 'Aliquam.fringilla@in.edu', '05 22 80 58 32'),
(40, 'Mcbride', 'Louis', '434-3382 Netus St.', '84965', 'Meerut', 'metus.Aenean.sed@Quisquelibero.com', '06 33 91 67 46'),
(41, 'Singleton', 'Cole', 'P.O. Box 614, 9044 Lectus St.', '99231', 'Jönköping', 'Donec.fringilla.Donec@magnaCras.edu', '09 37 31 57 34'),
(42, 'Owens', 'Mannix', 'Ap #554-5761 Lacus. Rd.', '29925', 'Lacombe', 'Nunc.commodo@sed.net', '09 06 76 62 43'),
(43, 'Sweet', 'Jakeem', '987-4255 In Rd.', '12466', 'Schriek', 'Suspendisse.non.leo@Maurismolestie.com', '06 13 48 07 07'),
(44, 'Munoz', 'Jorden', 'P.O. Box 319, 4858 Euismod Rd.', '15574', 'İmamoğlu', 'Sed.id@sitametdapibus.co.uk', '02 37 99 89 31'),
(45, 'Alston', 'Lucius', 'P.O. Box 894, 7018 Eu Rd.', '40863', 'Deurne', 'ac.mattis.ornare@orcilobortis.net', '01 60 27 89 86'),
(46, 'Austin', 'Chaney', '698-2823 Et, Street', '77904', 'Gaya', 'magna.Cras@elit.co.uk', '07 45 06 26 39'),
(47, 'Frank', 'Hu', 'Ap #295-8615 Lorem St.', '13101', 'Preore', 'vel.sapien@Mauris.org', '04 11 34 06 45'),
(48, 'Randall', 'Ira', 'Ap #125-5776 Sed Road', '03229', 'Ávila', 'tempor@sem.co.uk', '08 44 96 19 27'),
(49, 'Clayton', 'Iona', 'Ap #836-8371 Porttitor Rd.', '33828', 'Vremde', 'arcu.Nunc.mauris@nibhlaciniaorci.net', '08 51 59 92 12'),
(50, 'Aguilar', 'Clementine', '3508 Nulla Av.', '13663', 'Cap-Rouge', 'metus.Vivamus.euismod@Aliquamadipiscinglobortis.ca', '05 45 00 07 54'),
(51, 'Noble', 'Teegan', 'Ap #726-3796 Placerat. Ave', '70617', 'Knoxville', 'Phasellus.nulla.Integer@mauriserateget.edu', '06 44 62 77 64'),
(52, 'Emerson', 'Nash', '3831 Eu Road', '95244', 'Macklin', 'diam@commodoauctorvelit.co.uk', '01 87 99 76 77'),
(53, 'Huffman', 'Jacqueline', 'Ap #598-3162 Suspendisse Rd.', '82092', 'Almelo', 'Sed.nec@dignissimMaecenas.co.uk', '07 18 11 03 11'),
(54, 'Donaldson', 'Yael', '869-4801 Nascetur Av.', '45992', 'Lowestoft', 'Aliquam.ultrices@arcuSedet.org', '08 05 99 75 42'),
(55, 'Stein', 'Dane', 'P.O. Box 302, 9207 Arcu. St.', '91509', 'Felitto', 'pede.malesuada.vel@nonhendrerit.ca', '05 03 75 33 65'),
(56, 'Drake', 'Clarke', 'Ap #235-8256 Fringilla Avenue', '03631', 'Corswarem', 'mollis.nec@sempereratin.ca', '08 63 27 13 49'),
(57, 'Brown', 'Clark', 'Ap #614-4486 Sagittis Avenue', '16998', 'Satriano di Lucania', 'ligula@natoquepenatibus.ca', '08 23 27 35 73'),
(58, 'Nguyen', 'Ryan', 'P.O. Box 774, 3453 Eleifend Road', '16482', 'Lakeshore', 'felis.adipiscing.fringilla@massaVestibulum.com', '07 86 04 98 28'),
(59, 'Dillon', 'Miranda', 'P.O. Box 654, 1877 Aliquam Road', '58448', 'Gifhorn', 'nisl.Maecenas.malesuada@euodiotristique.com', '07 81 88 70 19'),
(60, 'Valencia', 'Deanna', '2111 A, Avenue', '76759', 'Ferrandina', 'elit@nulla.com', '07 58 86 82 84'),
(61, 'Mcclure', 'Simone', '8639 Donec Street', '26374', 'Taunusstein', 'scelerisque@Mauris.edu', '09 66 79 04 23'),
(62, 'Wallace', 'Dominic', 'P.O. Box 113, 2831 Semper Rd.', '48221', 'Notre-Dame-du-Nord', 'Nunc.laoreet@atnisiCum.com', '04 66 99 33 08'),
(63, 'Morris', 'Ezra', 'Ap #344-9994 Accumsan St.', '02352', 'Moorsel', 'leo@eget.org', '01 41 13 88 30'),
(64, 'Adkins', 'Aladdin', 'Ap #392-9400 Imperdiet Rd.', '33289', 'Schwäbisch Gmünd', 'natoque.penatibus.et@tristiqueac.org', '03 46 68 08 21'),
(65, 'Monroe', 'Magee', '842-7407 Vulputate St.', '15067', 'Hasselt', 'viverra.Maecenas@luctus.ca', '03 16 79 58 00'),
(66, 'Cochran', 'Carlos', '4762 Nunc Avenue', '68339', 'Avernas-le-Bauduin', 'pede@molestie.ca', '04 67 21 62 80'),
(67, 'Freeman', 'Echo', 'P.O. Box 783, 2848 Commodo St.', '29132', 'Bochum', 'lacus@ametrisus.ca', '05 64 62 58 50'),
(68, 'Blevins', 'Jermaine', 'P.O. Box 321, 4076 Quis St.', '49223', 'Alness', 'Cras.pellentesque.Sed@adipiscingelitCurabitur.net', '02 54 65 63 05'),
(69, 'Tyson', 'Libby', '574 Ut Road', '01781', 'Oostkerk', 'sem@Integer.co.uk', '05 30 89 52 21'),
(70, 'Miranda', 'Duncan', 'P.O. Box 665, 7467 Dolor St.', '43362', 'Saint-Oyen', 'venenatis.a.magna@ultriciesdignissimlacus.com', '04 72 67 15 74'),
(71, 'Chambers', 'Jenna', '3276 Etiam Street', '04196', 'Sterrebeek', 'sollicitudin.commodo.ipsum@feugiat.net', '02 75 57 75 74'),
(72, 'Stout', 'Kirsten', 'P.O. Box 907, 4194 Aliquet Street', '35913', 'Barrhead', 'urna.Nunc@eusem.edu', '09 48 16 86 39'),
(73, 'Crawford', 'Taylor', 'Ap #740-7169 Congue, Av.', '94191', 'Hattiesburg', 'orci@duiCumsociis.ca', '03 05 45 77 34'),
(74, 'Cole', 'Rinah', 'P.O. Box 866, 9663 Amet, Rd.', '80444', 'Rigolet', 'magna@consequatdolorvitae.com', '02 01 00 02 56'),
(75, 'Irwin', 'Hanae', '378-6007 Lorem Avenue', '76850', 'Brahmapur', 'magna.nec.quam@sapiencursusin.co.uk', '03 32 51 75 60'),
(76, 'Lawrence', 'Candace', 'Ap #109-4708 Fringilla, Road', '57873', 'Marcinelle', 'eu.arcu.Morbi@venenatislacus.net', '02 21 93 18 03'),
(77, 'French', 'Abdul', '436-6415 Risus. Street', '84399', 'Kamarhati', 'eros.non@odiosemper.com', '06 07 33 98 99'),
(78, 'Davis', 'Lionel', 'Ap #312-294 In St.', '37138', 'Baunatal', 'Duis.mi.enim@Pellentesque.ca', '05 18 71 03 43'),
(79, 'Odom', 'Levi', '1963 Quisque Rd.', '27854', 'Sainte-Ode', 'molestie@ut.co.uk', '01 33 00 74 48'),
(80, 'Foley', 'Serina', 'P.O. Box 986, 5504 Aliquam Street', '54817', 'Kirkcaldy', 'quam@semmagna.edu', '01 71 69 02 97'),
(81, 'Pickett', 'Nadine', 'Ap #925-7347 Tortor, Av.', '46277', 'Stirling', 'Cum@ametdapibusid.com', '01 78 23 98 06'),
(82, 'Workman', 'Mara', 'Ap #826-788 Ipsum. Av.', '76278', 'Detroit', 'diam.dictum@sodaleseliterat.ca', '08 77 52 92 18'),
(83, 'Wheeler', 'Cullen', 'Ap #804-2661 Phasellus St.', '14112', 'Koningshooikt', 'tempus.lorem.fringilla@nonummy.org', '07 73 41 39 70'),
(84, 'Kirkland', 'Virginia', '319-8868 Elementum, St.', '96596', 'Burntisland', 'ut.lacus@gravidanonsollicitudin.ca', '09 13 19 64 58'),
(85, 'Schroeder', 'Zane', 'P.O. Box 256, 8324 Odio. Street', '32413', 'Alert Bay', 'pharetra.sed.hendrerit@ategestasa.edu', '03 61 99 78 75'),
(86, 'Moon', 'Benjamin', 'P.O. Box 622, 1647 Lorem Rd.', '52620', 'Eckernförde', 'adipiscing.non.luctus@nonenimcommodo.org', '03 89 84 64 81'),
(87, 'Moran', 'Piper', '648-5362 Donec Avenue', '11862', 'San Giovanni in Galdo', 'mollis.vitae.posuere@maurisidsapien.org', '03 10 16 22 76'),
(88, 'Mueller', 'Lana', '3439 Libero. Av.', '83123', 'Wha Ti', 'Aliquam.fringilla.cursus@purusac.org', '05 65 88 47 65'),
(89, 'Acevedo', 'Clementine', 'P.O. Box 845, 2488 Curabitur St.', '10498', 'Rockville', 'semper@at.com', '09 79 12 77 00'),
(90, 'Vazquez', 'Xenos', 'P.O. Box 263, 4320 Malesuada. Av.', '38418', 'Andernach', 'Cras.eu.tellus@rhoncusDonecest.com', '09 20 41 69 21'),
(91, 'Morse', 'Galvin', 'P.O. Box 378, 1361 Sed Street', '35409', 'Fontaine-l\'Ev que', 'id@nibhlacinia.org', '05 45 93 33 11'),
(92, 'Huffman', 'Randall', '559-8106 Ipsum Av.', '60300', 'Birmingham', 'Nullam.scelerisque@liberoIntegerin.co.uk', '05 31 36 47 55'),
(93, 'Moore', 'Cullen', 'Ap #589-1209 Arcu Street', '01012', 'Worms', 'eget@purusMaecenaslibero.org', '08 13 50 32 51'),
(94, 'Smith', 'Fritz', 'P.O. Box 823, 744 Purus. St.', '95774', 'Spruce Grove', 'odio.auctor.vitae@sapienimperdietornare.co.uk', '07 89 61 64 94'),
(95, 'Zimmerman', 'Alan', '650-6225 Ultrices St.', '61577', 'Vespolate', 'luctus.sit.amet@eratsemper.co.uk', '06 22 60 70 87'),
(96, 'Hood', 'Thane', '7181 Non St.', '22039', 'Cargovil', 'sagittis.augue.eu@commodohendreritDonec.com', '01 17 65 87 52'),
(97, 'Burks', 'McKenzie', '611 Ornare. St.', '00443', 'Henley-on-Thames', 'leo@interdumCurabiturdictum.org', '03 90 70 05 67'),
(98, 'Flynn', 'Oleg', '5291 Vitae Road', '78324', 'Neuruppin', 'arcu.eu.odio@justo.ca', '07 35 98 94 42'),
(99, 'Byrd', 'Raphael', '9464 Phasellus Avenue', '48442', 'Vitacura', 'aliquam@Mauris.co.uk', '06 46 27 59 52'),
(100, 'Pugh', 'Clinton', 'P.O. Box 140, 5611 Nam Road', '89390', 'Wilhelmshaven', 'amet@Proinultrices.net', '02 95 98 07 16');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `dateCommande` date NOT NULL,
  `etatCommande` char(50) NOT NULL,
  `idClient` int(11) NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `Commande_Client_FK` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `dateCommande`, `etatCommande`, `idClient`) VALUES
(1, '2019-02-03', 'Expédiée', 48),
(2, '2019-02-03', 'Expédiée', 12),
(3, '2019-02-03', 'Expédiée', 78),
(4, '2019-02-03', 'Expédiée', 99),
(5, '2019-02-03', 'Expédiée', 45),
(6, '2019-02-03', 'Expédiée', 26),
(7, '2019-02-03', 'Expédiée', 74),
(8, '2019-02-03', 'Expédiée', 88),
(9, '2019-01-03', 'Expédiée', 1),
(10, '2019-02-03', 'Annulée', 56),
(11, '2019-02-03', 'Expédiée', 19),
(12, '2019-02-03', 'Expédiée', 92),
(13, '2019-02-03', 'Expédiée', 21),
(14, '2019-02-03', 'Expédiée', 46),
(15, '2019-02-03', 'Expédiée', 44),
(16, '2019-02-03', 'Expédiée', 27),
(17, '2019-02-03', 'Expédiée', 96),
(18, '2019-02-03', 'Expédiée', 14),
(19, '2019-02-03', 'Expédiée', 58),
(20, '2019-02-03', 'Annulée', 8),
(21, '2019-02-03', 'Expédiée', 65),
(22, '2019-02-03', 'Expédiée', 83),
(23, '2019-02-03', 'Expédiée', 41),
(24, '2019-02-03', 'Expédiée', 34),
(25, '2019-02-03', 'Expédiée', 29),
(26, '2019-02-04', 'En cours de traitement', 66),
(27, '2019-02-04', 'En cours de traitement', 28),
(28, '2019-02-04', 'En cours de traitement', 100),
(29, '2019-02-04', 'En cours de traitement', 75),
(30, '2019-02-04', 'En cours de traitement', 47),
(31, '2019-02-06', 'En cours de traitement', 6),
(32, '2019-02-06', 'En cours de traitement', 3),
(81, '2019-02-06', 'En cours de traitement', 91),
(82, '2019-02-06', 'En cours de traitement', 45),
(83, '2019-02-09', 'En cours de traitement', 5),
(84, '2019-02-09', 'En cours de traitement', 6),
(85, '2019-02-09', 'En cours de traitement', 6),
(86, '2019-02-09', 'En cours de traitement', 5),
(87, '2019-02-10', 'En cours de traitement', 95),
(88, '2019-02-10', 'En cours de traitement', 89),
(89, '2019-02-10', 'En cours de traitement', 89),
(90, '2019-02-10', 'En cours de traitement', 54),
(91, '2019-02-16', 'En cours de traitement', 77),
(92, '2019-02-16', 'En cours de traitement', 95),
(93, '2019-02-16', 'En cours de traitement', 23);

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `idProduit` char(20) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idProduit`,`idCommande`),
  KEY `Contenir_Commande0_FK` (`idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idProduit`, `idCommande`, `quantite`) VALUES
('BAT-0001', 91, 1),
('BLU-0002', 8, 1),
('BLU-0004', 17, 1),
('BLU-0005', 17, 1),
('BUR-0001', 15, 1),
('BUR-0002', 18, 1),
('BUR-0002', 29, 1),
('BUR-0004', 2, 1),
('CAS-0001', 21, 1),
('CAS-0001', 27, 1),
('CAS-0001', 83, 1),
('CAS-0001', 86, 1),
('DVD-0001', 31, 1),
('DVD-0003', 82, 1),
('DVD-0004', 8, 1),
('DVD-0004', 82, 1),
('ENC-0001', 14, 1),
('ENC-0001', 21, 1),
('ENC-0002', 16, 1),
('GUI-0002', 5, 1),
('GUI-0002', 81, 1),
('GUI-0003', 12, 1),
('GUI-0003', 91, 1),
('JEA-0001', 23, 3),
('JEA-0002', 11, 2),
('JEA-0002', 26, 1),
('JEA-0003', 26, 1),
('JEA-0003', 92, 1),
('JEU-0001', 2, 1),
('JEU-0001', 15, 1),
('JEU-0001', 93, 1),
('JEU-0002', 15, 1),
('JEU-0003', 15, 1),
('JEU-0003', 93, 1),
('JEU-0004', 15, 1),
('JEU-0005', 30, 1),
('JEU-0006', 2, 1),
('LIV-0001', 20, 1),
('LIV-0001', 28, 1),
('LIV-0002', 4, 2),
('LIV-0006', 4, 1),
('LIV-0006', 20, 1),
('LIV-0006', 28, 1),
('LIV-0009', 19, 1),
('LIV-0010', 28, 1),
('MON-0001', 3, 1),
('MON-0001', 87, 1),
('PIA-0001', 13, 1),
('PIA-0002', 10, 1),
('PIA-0002', 13, 1),
('POR-0006', 93, 1),
('PUL-0001', 92, 1),
('PUL-0002', 11, 1),
('PUL-0002', 26, 1),
('PUL-0002', 88, 1),
('PUL-0002', 89, 1),
('PUL-0002', 92, 1),
('ROB-0001', 22, 1),
('ROB-0001', 26, 1),
('SMA-0001', 6, 1),
('SMA-0001', 25, 1),
('SMA-0003', 9, 1),
('SMA-0003', 25, 1),
('SMA-0003', 27, 1),
('SMA-0004', 14, 1),
('TAB-0001', 30, 1),
('TAB-0002', 7, 1),
('TEE-0001', 23, 1),
('TEE-0002', 4, 1),
('TEE-0002', 84, 1),
('TEE-0002', 85, 1),
('TEE-0002', 88, 1),
('TEE-0002', 89, 1),
('TEE-0002', 90, 1),
('TEE-0002', 92, 3),
('VIO-0001', 1, 1),
('VIO-0001', 32, 1),
('VIO-0002', 24, 1);

-- --------------------------------------------------------

--
-- Structure de la table `employesav`
--

DROP TABLE IF EXISTS `employesav`;
CREATE TABLE IF NOT EXISTS `employesav` (
  `idEmploye` int(11) NOT NULL AUTO_INCREMENT,
  `nomEmploye` char(50) NOT NULL,
  `prenomEmploye` char(50) NOT NULL,
  `telEmploye` char(20) NOT NULL,
  `mailEmploye` char(70) NOT NULL,
  `mdpEmploye` char(50) NOT NULL,
  PRIMARY KEY (`idEmploye`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employesav`
--

INSERT INTO `employesav` (`idEmploye`, `nomEmploye`, `prenomEmploye`, `telEmploye`, `mailEmploye`, `mdpEmploye`) VALUES
(1, 'Walter', 'Colorado', '08 08 03 16 47', 'sit.amet.consectetuer@blanditenimconsequat.net', 'SEY75QXH4FX'),
(2, 'Wilder', 'Kiayada', '05 20 69 65 74', 'dapibus.ligula@et.com', 'QMG86UWJ8MP'),
(3, 'Carrillo', 'Theodore', '03 54 57 76 79', 'ligula@nunc.org', 'QNT83TAE5SK'),
(4, 'Copeland', 'Willa', '08 27 21 15 80', 'dictum.magna@Sedet.net', 'XVP86BAT3BB'),
(5, 'Nolan', 'Nash', '07 34 93 85 01', 'ipsum@facilisis.co.uk', 'DQD62QVX8PQ'),
(6, 'Mcclain', 'Quyn', '01 02 97 57 91', 'Cum.sociis.natoque@vulputatelacus.net', 'DCD03HCX8BO'),
(7, 'Rollins', 'Arden', '06 16 18 13 55', 'Nullam@orci.net', 'VBC88QXR5TT'),
(8, 'Golden', 'Mechelle', '06 75 94 79 69', 'magnis.dis.parturient@egestasadui.ca', 'HSN08QFS8VY'),
(9, 'Woodard', 'Giacomo', '06 44 00 31 61', 'Morbi.non@luctusipsumleo.ca', 'ZZI91LNR2RT'),
(10, 'Best', 'Sylvester', '06 01 88 78 10', 'dignissim.Maecenas.ornare@maurissapiencursus.co.uk', 'GUO28TAW9WX'),
(11, 'Gibbs', 'Nathan', '05 31 03 87 48', 'dictum.eu.eleifend@nonummyipsumnon.org', 'RKE99WCA2XG'),
(12, 'Mclaughlin', 'Noah', '09 24 93 07 89', 'dolor.Fusce.feugiat@aliquetsemut.org', 'QYA38VKD5FK'),
(13, 'Gonzales', 'Flynn', '02 59 72 06 93', 'luctus@ultricies.co.uk', 'RLX22LZH5RM'),
(14, 'Galloway', 'Carol', '04 97 93 21 70', 'congue@anteNuncmauris.ca', 'CDU74JIN7VZ'),
(15, 'Reed', 'Shelley', '02 49 49 48 32', 'Phasellus@suscipitnonummy.ca', 'DRY59GKV4YP'),
(16, 'Grimes', 'Rooney', '01 04 01 00 92', 'neque.sed.sem@lobortismauris.com', 'SYA72IQJ0ZB'),
(17, 'Morin', 'Nerea', '08 42 53 04 35', 'amet.consectetuer.adipiscing@vehiculaPellentesquetincidunt.ca', 'MHX93CIL7RB'),
(18, 'Buchanan', 'Erasmus', '02 48 90 09 39', 'et@metusfacilisislorem.edu', 'OST25CJP1MY'),
(19, 'Mooney', 'Walter', '02 32 31 94 34', 'turpis@Donectempuslorem.net', 'TUB17IIR7NQ'),
(20, 'Perkins', 'Mallory', '03 96 72 91 62', 'quam@Aliquamornarelibero.net', 'QRT38XJG7LO'),
(21, 'Schmidt', 'Blaze', '06 69 68 35 28', 'a@Suspendissenon.edu', 'BKF44OPI5NF'),
(22, 'Henson', 'Ria', '02 31 29 89 06', 'velit.eu@pharetrafelis.ca', 'YEM50GSB3TG'),
(23, 'Roman', 'Beverly', '06 13 38 99 24', 'Vestibulum.ante.ipsum@egetmagnaSuspendisse.net', 'CPW17CWM5EB'),
(24, 'Patterson', 'Hall', '03 76 19 67 13', 'aliquam.arcu.Aliquam@tinciduntnunc.org', 'FCX41NGO2SG'),
(25, 'Freeman', 'Kyla', '06 97 71 36 28', 'et@Nuncac.com', 'JWV89JKR1HY'),
(26, 'Coleman', 'Amery', '05 46 03 78 72', 'porta.elit.a@ante.ca', 'PZD72NVG2QN'),
(27, 'Gomez', 'Jesse', '09 10 23 35 36', 'auctor.Mauris@Uttincidunt.net', 'JKV29YNY1NS'),
(28, 'Chandler', 'Justina', '03 95 30 20 32', 'tincidunt.adipiscing@adipiscingnon.ca', 'QRP50WJX0HX'),
(29, 'Fletcher', 'Isabelle', '09 49 37 66 10', 'Etiam.imperdiet@pedeet.org', '1696072778799'),
(30, 'Murphy', 'Patricia', '09 40 99 78 26', 'erat.in@vulputate.ca', 'GPP55UHN2GG'),
(31, 'Gates', 'Blythe', '01 80 11 05 18', 'natoque@Aliquamvulputate.org', 'OHN81SNK5SW'),
(32, 'Terry', 'Jordan', '07 74 69 34 42', 'elementum.lorem.ut@Nullam.org', 'QFA78LLC0FP'),
(33, 'Galloway', 'Uriah', '02 05 41 88 35', 'non.ante.bibendum@antedictum.net', 'QIN79SWB7QB'),
(34, 'Raymond', 'Casey', '08 20 99 64 91', 'Nunc.sed.orci@Phasellusornare.com', 'CYD89WJQ3VE'),
(35, 'Lamb', 'Derek', '05 83 50 40 35', 'elit@velesttempor.co.uk', 'RKO01HPU1VI'),
(36, 'Stevenson', 'Lani', '01 07 27 56 14', 'ornare@nequeet.com', 'DLV94QDT3UZ'),
(37, 'Scott', 'Melyssa', '05 49 66 19 54', 'ut@dignissim.ca', 'DJY34TRS5OZ'),
(38, 'Stein', 'Rogan', '01 54 19 88 91', 'eu@luctus.org', 'CAO17XND8PM'),
(39, 'Howell', 'Martin', '02 13 39 90 19', 'tempus@Cum.net', 'LGZ06YLA5PG'),
(40, 'Prince', 'Shelley', '06 97 37 35 73', 'metus.facilisis@non.ca', 'JOP48YML5WY'),
(41, 'Hodges', 'Wynter', '02 91 72 73 47', 'Vivamus.euismod.urna@elementum.org', 'MEY84KFL4NM'),
(42, 'Velasquez', 'Buckminster', '05 74 36 07 17', 'risus@bibendumfermentummetus.ca', 'WKL89GDU4JQ'),
(43, 'Guerrero', 'Allegra', '07 35 62 21 47', 'arcu@dolorFuscefeugiat.com', 'FSJ15BOD1DV'),
(44, 'Norman', 'Dale', '04 80 33 95 42', 'dolor.egestas@semper.ca', 'WYJ90TFY8RU'),
(45, 'Marshall', 'Roanna', '04 01 14 59 51', 'est.Nunc.laoreet@Duissit.ca', 'WMZ06UMQ0UJ'),
(46, 'Hayden', 'Nero', '08 97 99 37 36', 'vulputate.mauris.sagittis@Aliquameratvolutpat.org', 'IWY52EWE1MU'),
(47, 'Leblanc', 'Zeph', '02 36 81 79 91', 'Mauris.magna.Duis@lacinia.com', 'BEO06DEO6WL'),
(48, 'Lang', 'Gil', '06 85 10 93 56', 'dis.parturient@metuseu.edu', 'HVO06UMN0IT'),
(49, 'Howell', 'Kibo', '06 02 37 12 83', 'Vivamus@pedeNuncsed.ca', 'NWT32YJI0KI'),
(50, 'Casey', 'Nita', '07 88 46 99 48', 'magna.malesuada@lectuspede.ca', 'ZLB68WJU7ZQ'),
(51, 'Dupont', 'Marie', '01 02 03 04 05', 'test@gmail.com', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

DROP TABLE IF EXISTS `incident`;
CREATE TABLE IF NOT EXISTS `incident` (
  `idIncident` int(5) NOT NULL AUTO_INCREMENT,
  `descIncident` text NOT NULL,
  `dateIncident` date NOT NULL,
  `vu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idIncident`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `incident`
--

INSERT INTO `incident` (`idIncident`, `descIncident`, `dateIncident`, `vu`) VALUES
(1, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(2, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(3, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(4, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(5, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(6, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(7, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(8, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(9, 'Un nouveau problème SAV a été signalé', '2019-02-03', 1),
(13, 'Un nouveau problème SAV a été signalé', '2019-02-04', 1),
(11, 'Un nouveau problème SAV a été signalé', '2019-02-04', 1),
(12, 'Un nouveau problème SAV a été signalé', '2019-02-04', 1),
(14, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(15, 'Il y a plus de 20 problèmes déclarés sur un même produit : voir la cause de chaque problème.', '2019-02-04', 0),
(16, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(17, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(18, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(19, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(20, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(21, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(22, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(23, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(24, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(25, 'Un nouveau problème SAV a été signalé', '2019-02-04', 0),
(26, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(27, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(28, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(29, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(30, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(31, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(32, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(33, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(34, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(35, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(36, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(37, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(38, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(39, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(40, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(41, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(42, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(82, 'Un nouveau problème SAV a été signalé', '2019-02-06', 0),
(81, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(80, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(79, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(78, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(77, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(76, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(75, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(74, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(73, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(72, 'Un nouveau problème SAV a été signalé', '2019-02-05', 0),
(83, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(84, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(85, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(86, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(87, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(88, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(89, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(90, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(91, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(92, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(93, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(94, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(95, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(96, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(97, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(98, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(99, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(100, 'Un nouveau problème SAV a été signalé', '2019-02-09', 0),
(101, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(102, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(103, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(104, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(105, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(106, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(107, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(108, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(109, 'Un nouveau problème SAV a été signalé', '2019-02-10', 0),
(110, 'Un nouveau problème SAV a été signalé', '2019-02-16', 0),
(111, 'Un nouveau problème SAV a été signalé', '2019-02-16', 0),
(112, 'Un nouveau problème SAV a été signalé', '2019-02-16', 0),
(113, 'Un nouveau problème SAV a été signalé', '2019-02-16', 0),
(114, 'Un nouveau problème SAV a été signalé', '2019-02-16', 0);

-- --------------------------------------------------------

--
-- Structure de la table `problemesav`
--

DROP TABLE IF EXISTS `problemesav`;
CREATE TABLE IF NOT EXISTS `problemesav` (
  `idProblemeSAV` int(5) NOT NULL AUTO_INCREMENT,
  `titreProblemeSAV` char(50) NOT NULL,
  `descProblemeSAV` text NOT NULL,
  `dateProblemeSAV` date NOT NULL,
  `etatProblemeSAV` char(50) NOT NULL,
  `montantProcedure` float NOT NULL,
  `idEmploye` int(5) DEFAULT NULL,
  `idClient` int(5) NOT NULL,
  `idProcedure` int(5) NOT NULL,
  `idProduit` char(20) NOT NULL,
  PRIMARY KEY (`idProblemeSAV`),
  KEY `idProduit` (`idProduit`),
  KEY `idProcedure` (`idProcedure`),
  KEY `idClient` (`idClient`),
  KEY `idEmploye` (`idEmploye`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `problemesav`
--

INSERT INTO `problemesav` (`idProblemeSAV`, `titreProblemeSAV`, `descProblemeSAV`, `dateProblemeSAV`, `etatProblemeSAV`, `montantProcedure`, `idEmploye`, `idClient`, `idProcedure`, `idProduit`) VALUES
(43, 'Manche déformé', 'Le manche s\'est déformé', '2019-02-10', 'Terminé', 0, 45, 34, 2, 'VIO-0002'),
(38, 'Erreur', 'Le jeu reçu n\'est pas celui qui a été commandé', '2019-02-09', 'Terminé', 0, 11, 44, 4, 'JEU-0001'),
(44, 'Panne', 'Le smartphone ne démarre plus.', '2019-02-10', 'Terminé', 0, 20, 46, 2, 'SMA-0004'),
(45, 'Taille', 'La taille est trop petite.', '2019-02-10', 'Terminé', 0, 4, 66, 4, 'JEA-0003'),
(40, 'Produit défectueux', 'La montre ne s\'allume pas.', '2019-02-10', 'Terminé', 0, 16, 95, 1, 'MON-0001'),
(47, 'Panne', 'La tablette ne charge plus.', '2019-02-10', 'Terminé', 0, 17, 74, 2, 'TAB-0002'),
(46, 'Cassé', 'Ecran fissuré, plus d\'image', '2019-02-10', 'Terminé', 0, 3, 29, 2, 'SMA-0003'),
(48, 'Erreur de commande', 'Le produit reçu ne correspond pas à celui qui a été commandé.', '2019-02-10', 'Terminé', 0, 8, 99, 4, 'LIV-0002'),
(50, 'Produit incompet', 'Il manque la caisse claire', '2019-02-16', 'A traiter', 0, 16, 77, 1, 'BAT-0001'),
(51, 'Erreur de commande', 'Le produit reçu n\'est pas celui qui a été commandé', '2019-02-16', 'A traiter', 0, 23, 95, 4, 'PUL-0001'),
(52, 'Produit défectueux', 'L\'écran était cassé lors du déballage de l\'ordinateur', '2019-02-16', 'A traiter', 0, 29, 23, 1, 'POR-0006');

--
-- Déclencheurs `problemesav`
--
DROP TRIGGER IF EXISTS `trigNbPbSAVI`;
DELIMITER $$
CREATE TRIGGER `trigNbPbSAVI` BEFORE INSERT ON `problemesav` FOR EACH ROW BEGIN
IF (SELECT COUNT(*) FROM problemesav WHERE problemesav.idProduit = new.idProduit) > 20 THEN
	INSERT INTO incident(descIncident, dateIncident, vu) VALUES ('Il y a plus de 20 problèmes déclarés sur un même produit : voir la cause de chaque problème.', CURRENT_TIMESTAMP, 0);
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigNewPbSAVI`;
DELIMITER $$
CREATE TRIGGER `trigNewPbSAVI` BEFORE INSERT ON `problemesav` FOR EACH ROW BEGIN
INSERT INTO incident (descIncident, dateIncident, vu) VALUES ('Un nouveau problème SAV a été signalé', CURRENT_TIMESTAMP(), 0);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigVerifClientProduitI`;
DELIMITER $$
CREATE TRIGGER `trigVerifClientProduitI` BEFORE INSERT ON `problemesav` FOR EACH ROW BEGIN
IF NOT EXISTS (SELECT * FROM contenir CTN, commande CMD WHERE CTN.idProduit = new.idProduit AND CMD.idClient = new.idClient AND CTN.idCommande = CMD.idCommande) THEN
	SIGNAL SQLSTATE'45000'
	SET MESSAGE_TEXT = "AJOUT IMPOSSIBLE : Ce client n'a jamais commandé ce produit.",
	MYSQL_ERRNO = 22;
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigVerifClientProduitU`;
DELIMITER $$
CREATE TRIGGER `trigVerifClientProduitU` BEFORE UPDATE ON `problemesav` FOR EACH ROW BEGIN
IF NOT EXISTS (SELECT * FROM contenir CTN, commande CMD WHERE CTN.idProduit = new.idProduit AND CMD.idClient = new.idClient AND CTN.idCommande = CMD.idCommande) THEN
	SIGNAL SQLSTATE'45000'
	SET MESSAGE_TEXT = "MODIFICATION IMPOSSIBLE : Ce client n'a jamais commandé ce produit !",
	MYSQL_ERRNO = 22;
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigVerifEtatD`;
DELIMITER $$
CREATE TRIGGER `trigVerifEtatD` BEFORE DELETE ON `problemesav` FOR EACH ROW BEGIN
IF(old.etatProblemeSAV != 'Terminé') THEN
 	SIGNAL SQLSTATE'45000'
 	SET MESSAGE_TEXT = "SUPPRESSION IMPOSSIBLE : Ce problème n'est pas clos.",
 	MYSQL_ERRNO = 22;
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigVerifGarI`;
DELIMITER $$
CREATE TRIGGER `trigVerifGarI` BEFORE INSERT ON `problemesav` FOR EACH ROW BEGIN
	DECLARE joursGar INT;
	DECLARE joursCP int;
	
	-- Nombre de jours entre la date commande et la date problème
	SELECT datediff(dateProblemeSAV, dateCommande) INTO joursCP FROM commande, problemesav WHERE commande.idClient = new.idClient AND problemesav.idProduit = new.idProduit;
	
	-- Durée en nombre de jour de la garantie
	SELECT dureeGarantie*365 INTO joursGAR FROM produit WHERE idProduit = new.idProduit;
	
	if(joursCP > joursGAR && new.idProcedure = 2) THEN -- Test si le nombre de jours entre la commande et le problème est supérieur au nombre de jours de la garantie
		SIGNAL SQLSTATE'45000'
		SET MESSAGE_TEXT = "AJOUT IMPOSSIBLE : Ce produit n'est plus sous garantie",
		MYSQL_ERRNO = 22;
	END IF;
	
	IF(joursCP < joursGAR && new.idProcedure = 3) THEN -- Test si le nombre de jours entre la commande et le problème est inférieur au nombre de jours de la garantie
		SIGNAL SQLSTATE'45000'
		SET MESSAGE_TEXT = 'AJOUT IMPOSSIBLE : Ce produit est encore sous garantie',
		MYSQL_ERRNO = 22;
	END IF;
	
	IF(joursGar = 0 && new.idProcedure = 2) THEN -- Test si le produit qu'on veut prendre en garantie à une garantie
		SIGNAL SQLSTATE'45000'
		SET MESSAGE_TEXT = "AJOUT IMPOSSIBLE : Ce produit n'a pas de garantie",
		MYSQL_ERRNO = 22;
	END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigVerifGarU`;
DELIMITER $$
CREATE TRIGGER `trigVerifGarU` BEFORE UPDATE ON `problemesav` FOR EACH ROW BEGIN
	DECLARE joursGar INT;
	DECLARE joursCP int;
	
	-- Nombre de jours entre la date commande et la date problème
	SELECT datediff(dateProblemeSAV, dateCommande) INTO joursCP FROM commande, problemesav WHERE commande.idClient = new.idClient AND problemesav.idProduit = new.idProduit;
	
	-- Durée en nombre de jour de la garantie
	SELECT dureeGarantie*365 INTO joursGAR FROM produit WHERE idProduit = new.idProduit;
	
	if(joursCP > joursGAR && new.idProcedure = 2) THEN -- Test si le nombre de jours entre la commande et le problème est supérieur au nombre de jours de la garantie
		SIGNAL SQLSTATE'45000'
		SET MESSAGE_TEXT = "MODIFICATION IMPOSSIBLE : Ce produit n'est plus sous garantie",
		MYSQL_ERRNO = 22;
	END IF;
	
	IF(joursCP < joursGAR && new.idProcedure = 3) THEN -- Test si le nombre de jours entre la commande et le problème est inférieur au nombre de jours de la garantie
		SIGNAL SQLSTATE'45000'
		SET MESSAGE_TEXT = "MODIFICATION IMPOSSIBLE : Ce produit est encore sous garantie",
		MYSQL_ERRNO = 22;
	END IF;
	
	IF(joursGar = 0 && new.idProcedure = 2) THEN -- Test si le produit qu'on veut prendre en garantie à une garantie
		SIGNAL SQLSTATE'45000'
		SET MESSAGE_TEXT = "MODIFICATION IMPOSSIBLE : Ce produit n'a pas de garantie",
		MYSQL_ERRNO = 22;
	END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigVerifPrxI`;
DELIMITER $$
CREATE TRIGGER `trigVerifPrxI` BEFORE INSERT ON `problemesav` FOR EACH ROW BEGIN
IF(new.idProcedure != 3 && new.montantProcedure > 0) THEN
	SIGNAL SQLSTATE'45000'
	SET MESSAGE_TEXT = "AJOUT IMPOSSIBLE : Cette procédure est GRATUITE, vous ne pouvez pas entrer un montant supérieur à 0.",
	MYSQL_ERRNO = 22;
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigVerifPrxU`;
DELIMITER $$
CREATE TRIGGER `trigVerifPrxU` BEFORE UPDATE ON `problemesav` FOR EACH ROW BEGIN
IF(new.idProcedure != 3 && new.montantProcedure > 0) THEN
	SIGNAL SQLSTATE'45000'
	SET MESSAGE_TEXT = "MODIFICATION IMPOSSIBLE : Cette procédure est GRATUITE, vous ne pouvez pas entrer un montant supérieur à 0.",
	MYSQL_ERRNO = 22;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `proceduresav`
--

DROP TABLE IF EXISTS `proceduresav`;
CREATE TABLE IF NOT EXISTS `proceduresav` (
  `idProcedure` int(11) NOT NULL AUTO_INCREMENT,
  `libelleProcedure` char(50) NOT NULL,
  PRIMARY KEY (`idProcedure`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `proceduresav`
--

INSERT INTO `proceduresav` (`idProcedure`, `libelleProcedure`) VALUES
(1, 'Remboursement'),
(2, 'Prise en garantie'),
(3, 'Réparation (hors garantie)'),
(4, 'Echange');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` char(20) NOT NULL,
  `nomProduit` char(50) NOT NULL,
  `descProduit` text NOT NULL,
  `prixProduit` float NOT NULL,
  `dureeGarantie` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `Produit_CategorieProduit_FK` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `nomProduit`, `descProduit`, `prixProduit`, `dureeGarantie`, `idCategorie`) VALUES
('BAT-0001', 'PEARL DRUMS DMP925SC-260', 'La Decade Maple, c\'est l\'aboutissement de 70 années d\'expérience dans l\'art de créer des batteries. Et si cette nouvelle batterie porte le nom de Decade, ce n\'est pas un hasard : Pearl a mis 10 ans pour concevoir une batterie aux caractéristiques milieu de gamme contenue dans un budget aussi serré. Jugez plutôt : fûts 100% érable, vernis brillants ou mats, nouvelles coquilles légères, stands et accessoires inclus, etc.', 712.99, 3, 3),
('BAT-0002', 'PEARL DRUMS MASTER MAPLE', 'Depuis 25 ans, les Pearl Masters ont toujours été synonymes d\'excellence pour les professionnels. Pearl rends hommage à cette longue histoire en créant la MCT, compromis parfait entre la pure résonance des MMX et la puissante projection des MRX. Malgré des caractéristiques Premium comme un érable nord-américain de grande qualité, la nouvelles MCT devient la moins chère de toutes les Master.', 1499, 5, 3),
('BAT-0003', 'SONOR VINTAGE VT 16 THREE22', 'Déjà célèbres dans les années 60, les kits SONOR Teardrop proposaient une fabrication d\'une qualité exceptionnelle, reconnue par des stars internationales comme Connie Kay, Roy Haynes, Sonny Payne, ou Kenny \'Klook\' Clarke.', 2725, 3, 3),
('BER-0001', ' Bermuda chino en twill léger', 'Le basique incontournable des belles journées ensoleillées !', 10.9, 0, 2),
('BLU-0001', 'Bohemian Rhapsody Steelbook', 'Bohemian Rhapsody retrace le destin extraordinaire du groupe Queen et de leur chanteur emblématique Freddie Mercury, qui a défié les stéréotypes, brisé les conventions et révolutionné la musique. Du succès fulgurant de Freddie Mercury à ses excès, risquant la quasi-implosion du groupe, jusqu’à son retour triomphal sur scène lors du concert Live Aid, alors qu’il était frappé par la maladie, découvrez la vie exceptionnelle d’un homme qui continue d’inspirer les outsiders, les rêveurs et tous ceux qui aiment la musique.', 29.99, 0, 6),
('BLU-0002', 'A Star Is Born Steelbook', 'Star de country un peu oubliée, Jackson Maine découvre Ally, une jeune chanteuse très prometteuse. Tandis qu\'ils tombent follement amoureux l\'un de l\'autre, Jack propulse Ally sur le devant de la scène et fait d\'elle une artiste adulée par le public. Bientôt éclipsé par le succès de la jeune femme, il vit de plus en plus de mal son propre déclin…', 24.99, 0, 6),
('BLU-0003', 'En eaux troubles', 'Missionné par un programme international d’observation de la vie sous-marine, un submersible a été attaqué par une créature gigantesque qu’on croyait disparue. Sérieusement endommagé, il gît désormais dans une fosse, au plus profond de l’océan Pacifique, où son équipage est pris au piège. Il n’y a plus de temps à perdre : Jonas Taylor, sauveteur-plongeur expert des fonds marins, est engagé par un océanographe chinois particulièrement visionnaire, contre l’avis de sa fille Suyin. Taylor a pour mission de sauver l’équipage - et l’écosystème marin - d’une redoutable menace : un requin préhistorique de 23 m de long connu sous le nom de Megalodon. Or, il se trouve que le plongeur s’est déjà retrouvé face-à-face avec le squale plusieurs années auparavant. Avec l’aide de Suyin, il doit à présent surmonter sa peur et risquer sa vie pour sauver les hommes et les femmes prisonniers de l’embarcation… et accepter d’affronter une fois encore le prédateur le plus terrible de tous les temps.', 34.99, 0, 6),
('BLU-0004', 'Ant-Man et La Guêpe', 'Maintenant épaulé par la Guêpe, Scott reprend du service et endosse pour un second film le costume de Ant-Man. Une nouvelle aventure Marvel ponctuée de séquences spectaculaires et à l\'humour bien dosé.', 34.99, 0, 6),
('BLU-0005', 'Black Panther', 'Après les événements qui se sont déroulés dans Captain America : Civil War, T’Challa revient chez lui prendre sa place sur le trône du Wakanda, une nation africaine technologiquement très avancée.', 40.99, 0, 6),
('BLU-0006', 'Avengers : Infinity War', 'Jusqu’ici, les Avengers et leurs alliés continuaient de protéger le monde de menaces trop vastes pour être neutralisées par un seul individu, mais un nouveau danger émerge aujourd’hui des confins du cosmos : le redoutable Thanos. Ce dictateur intergalactique ne reculera devant rien pour réunir les six pierres d’infinité dans sa quête de pouvoir afin d’asservir l’humanité toute entière. Ses adversaires devront être prêts à tout sacrifier pour le neutraliser avant que son attaque éclair ne conduise à la destruction complète...', 40.99, 0, 6),
('BUR-0001', 'Apple iMac 27\"', 'Apple iMac 27\" Retina 5K 2 To Fusion Drive 8 Go RAM Intel Core i5 quadricœur à 3,8 GHz Nouveau', 2599, 2, 7),
('BUR-0002', 'HP PAV GAMING 690-0003', 'HP PAV GAMING 690-0003 I5-8400/8/1T+128/NVID GTX 1050TI 4GB', 949, 4, 7),
('BUR-0003', 'MSI NIGHTBL. MI3', 'MSI NIGHTBL. MI3 7RA-055EU I5 7400/8/1+128/GTX 1050 2G', 899, 2, 7),
('BUR-0004', 'PC Asus ROG', 'PC Asus ROG FX10CP-FR008T', 798.84, 2, 7),
('CAS-0001', 'Bose Casque sans fil à réduction de bruit', 'Comment Bose parvient-il encore à améliorer son casque à réduction de bruit ultra-performant ? Désormais, le casque sans fil à réduction de bruit QuietComfort 35 II vous permet d’ajuster le niveau de réduction de bruit. Il vous suffit d’appuyer sur la nouvelle touche Action pour profiter pleinement de la technologie de réduction du bruit ultra-performante et vous isoler complètement ou en partie du monde extérieur. Vous choisissez le niveau correspondant à votre environnement.', 313, 2, 4),
('DVD-0001', 'AMELIE-VN', 'Amélie, serveuse dans un bar de Montmartre n’est pas une jeune fille comme les autres. Au cours de sa petite enfance, elle a vu son poisson rouge disparaître dans un bassin municipal, sa mère mourir écrasé par une touriste québécoise sur le parvis de Notre Dame et son père reporter toute son affection sur un nain de jardin. La vie de la jeune fille est simple, Mais son plus grand plaisir consiste à observer les gens. Amélie est décidée à faire le bien et à réparer la vie de ceux qui l’entourent.', 5.99, 0, 6),
('DVD-0002', 'Harry Potter L’intégrale', 'L\'intégrale des 8 films de la saga accompagnés de toutes les affiches des films', 39.99, 0, 6),
('DVD-0003', 'HOBBIT-TRILOGY', 'LE HOBBIT : UN VOYAGE INATTENDU™ - Suivez Bilbon Sacquet, qui, avec le Magicien Gandalf et 13 Nains dirigés par Thorin Écu-De-Chêne, se retrouve au cœur d’une quête aux proportions épiques et semée d’embûches afin de reconquérir le royaume perdu d’Erebor. LE HOBBIT : LA DESOLATION DE SMAUG™ - Bilbon et les Nains échappent aux araignées géantes ainsi qu’aux Elfes de Mirkwood et font la rencontre du mystérieux Bard, qui les fait entrer dans Lacville en secret. Arrivant finalement à la Montagne Solitaire, ils défient le dragon Smaug. LE HOBBIT : LA BATAILLE DES CINQ ARMEES™ - Les Nains d’Erebor ont reconquis leur pays d’origine, mais doivent à présent faire face aux conséquences d’avoir déchaîné la fureur du dragon Smaug. Alors que cinq grandes armées sont sur le pied de guerre, Bilbon Sacquet se voit contraint de lutter pour sa survie, et les races des Nains, Elfes et Hommes doivent s’unir ou succomber.', 19.99, 0, 6),
('DVD-0004', 'Le Seigneur des Anneaux', 'Dans ce chapitre de la trilogie, le jeune et timide Hobbit, Frodon Sacquet, hérite d\'un anneau. Bien loin d\'être une simple babiole, il s\'agit de l\'Anneau Unique, un instrument de pouvoir absolu qui permettrait à Sauron, le Seigneur des ténèbres, de régner sur la Terre du Milieu et de réduire en esclavage ses peuples. À moins que Frodon, aidé d\'une Compagnie constituée de Hobbits, d\'Hommes, d\'un Magicien, d\'un Nain, et d\'un Elfe, ne parvienne à emporter l\'Anneau à travers la Terre du Milieu jusqu\'à la Crevasse du Destin, lieu où il a été forgé, et à le détruire pour toujours. Un tel périple signifie s\'aventurer très loin en Mordor, les terres du Seigneur des ténèbres, où est rassemblée son armée d\'Orques maléfiques... La Compagnie doit non seulement combattre les forces extérieures du mal mais aussi les dissensions internes et l\'influence corruptrice qu\'exerce l\'Anneau lui-même. L\'issue de l\'histoire à venir est intimement liée au sort de la Compagnie...', 88.99, 0, 6),
('ENC-0001', 'Bose SoundLink Revolve Enceinte Bluetooth - Noir', 'L’enceinte Bluetooth SoundLink Revolve de Bose est conçue pour diffuser un son profond, puissant et enveloppant dans toutes les directions. Placez-la au centre de votre pièce pour un son identique quel que soit l’endroit où vous vous trouvez. Ou installez-la près d’un mur pour un son réfléchi et immersif qui vous rappellera votre dernier concert. Grâce à sa forme cylindrique évasée, elle permet une prise en main et un transport faciles. Son boîtier en aluminium robuste protège cette merveille technologique partout où vous allez, tandis que le design résistant à l’eau vous garantit une ambiance à toute épreuve, même sous la pluie.', 199.99, 2, 4),
('ENC-0002', 'JBL Flip 4', 'JBL Flip 4 - Enceinte Bluetooth portable étanche Un accessoire universel adapté à tous les temps. Puissante & Légère – c\'est possible ! L\'enceinte JBL Flip 4 est petite, légère, totalement transportable ET offre un son stéréo étonnamment puissant. Retrouvez la qualité audio JBL, associée aux fonctionnalités incontournables de l\'enceinte moderne : connexion bluetooth 4.2, autonomie longue de 12h, parfaite étanchéité (IPX7), kit mains-libres, technologie JBL Connect +, intégration d\'un assistant vocal, boomers passifs JBL, et le tout dans un matériau solide, robuste et design ! Ce baffle extérieur connecté prodiguant des basses puissantes est tout ce dont vous avez besoin.', 90.99, 2, 4),
('GUI-0001', 'EAGLETONE NORTH CA 20S NATURELLE', 'Le modèle Auditorium CA20S affiche une table en cèdre massif A+ pour un son rond et chaud, une projection intense et une longue durée de vie.', 349, 2, 3),
('GUI-0002', 'FENDER STRATOCASTER AMERICAN', 'Fender lance la guitare American Special Series Stratocaster®, qui met à votre portée tout ce dont vous rêvez dans un instrument abordable fabriqué aux États-Unis. Cette guitare est équipée d’un corps en aulne, d’un manche en érable avec touche à radius de 9,5 pouces et frettes jumbo, de micros Texas Special, d’un tremolo synchronisé de style vintage et d’une finition uréthane satinée.', 1109, 4, 3),
('GUI-0003', 'PRS - PAUL REED SMITH SE', 'Guitare électrique, demi-caisse. Corps en acajou avec chambres tonales pour un sustain augmenté. Table plaquée Erable flammé avec ouïes en \'\'F\'\'. 22 x frettes Medium Jumbo. Manche collé (mortaise & tenon) en Erable.', 895, 2, 3),
('JEA-0001', ' Jean skinny motard', 'Le jean motard avec abrasions est au rendez-vous de la tendance ! ', 18, 0, 2),
('JEA-0002', ' Pantalon slim 5 poches stretch', 'Le classique du pantalon slim dans tous les coloris et pour toutes les saisons ! Bref, un basique à adopter dès à présent.', 10, 0, 2),
('JEA-0003', ' Jean slim stretch\r\n', 'Le basique aux finitions soignées ! ', 20, 0, 2),
('JEU-0001', 'CALL OF DUTY BLACK OPS IIII SPECIALIST EDITION', 'Black Ops est de retour ! Il est accompagné de combats au sol multijoueur ultra-réalistes, de la plus grande offre jamais connue du mode Zombies, avec trois aventures complètes et venues d\'outre-tombe dès sa sortie, et de Blackout, où l\'univers de Black Ops prend vie au sein d\'une bataille royale colossale. Blackout possède la plus grande carte de l\'histoire de Call of Duty, les combats typiques de Black Ops, ainsi que les personnages, les lieux et les armes de la série.', 39.99, 0, 5),
('JEU-0002', 'Battlefield V', 'Participez au plus grand conflit de l\'Histoire avec Battlefield™ V. La licence revient aux sources et dépeint la Seconde Guerre mondiale comme jamais auparavant. Livrez des batailles multijoueur brutales aux côtés de votre escouade dans des modes imposants comme Grandes Opérations et coopératifs comme Tir Groupé. Assistez également à des drames humains dans un contexte de conflit mondial avec les récits de guerre du mode solo. Combattez dans des environnements inédits aux 4 coins du monde et découvrez le Battlefield le plus immersif à ce jour.', 69.99, 0, 5),
('JEU-0003', 'PLAYERUNKNOWN\'S BATTLEGROUNDS', 'PLAYERUNKNOWN\'S BATTLEGROUNDS est le meilleur battle royale de tir, opposant 100 joueurs les uns aux autres dans une lutte pour la survie. En partant de rien, les joueurs se jettent dans la bataille et doivent s\'affronter pour survivre tout en cherchant des armes et des ressources au fur et à mesure que la carte rétrécit et que le combat s\'intensifie. S\'étendant sur une variété d\'environnements palpitants et immersifs qui modifient singulièrement le style de gameplay et les tactiques de survie, PLAYERUNKNOWN\'S BATTLEGROUNDS est plus qu\'un simple jeu : c\'est un battle royale. Nécessite Xbox Live Gold pour jouer (vendu séparément).', 29.99, 0, 5),
('JEU-0004', 'DESTINY 2 RENEGATS', 'Que vous fassiez vos premiers pas dans l\'univers de Destiny 2 ou que vous soyez déjà l\'un des millions à vouloir venger Cayde-6, Destiny 2 : Renégats - Collection Légendaire propose l\'expérience Destiny 2 : Renégats ultime pour les nouveaux joueurs et les vétérans.', 69.99, 0, 5),
('JEU-0005', 'MONSTER HUNTER WORLD', 'Dans la série action RPG \"Monster Hunter\", vous devez maîtriser l\'art de la chasse pour traquer de gigantesques créatures dans des environnements somptueux.', 49.99, 0, 5),
('JEU-0006', 'DARK SOULS REMASTERED', 'Vint alors l\'avènement du Feu... Redécouvrez le jeu de référence salué par la critique. Dans cette splendide version remastérisée, retrouvez Lordran et redécouvrez ses décors époustouflants en haute définition et en 60 fps. Dark Souls Remastered comprend le jeu de base, ainsi que le DLC « Artorias of the Abyss ».', 29.99, 0, 5),
('JEU-0007', 'DEAD RISING 4', 'Profitez de la meilleure offre avec l’édition Deluxe numérique de Dead Rising 4. Inclut Dead Rising 4 et le Season Pass Dead Rising 4, avec du contenu bonus exclusif.', 89.99, 0, 5),
('JEU-0008', 'MASS EFFECT ANDROMEDA', 'Mass Effect : Andromeda embarque les joueurs vers la galaxie d’Andromède , bien au-delà de la Voie Lactée. Là-bas, les joueurs mèneront notre combat pour un nouveau foyer en terrain hostile où nous sommes les aliens.', 79.99, 0, 5),
('JEU-0009', 'DISHONORED DEATH OF THE OUTSIDER', 'Endossez le rôle de Billie Lurk (alias Meagan Foster), l\'une des plus célèbres tueuses à gages de Dunwall et retrouvez votre ancien mentor, le légendaire Daud, pour fomenter le plus grand assassinat jamais envisagé : tuer l\'Outsider, une quasi-divinité que Billie et Daud considèrent comme responsable des pires heures de l\'Empire.', 29.99, 0, 5),
('JEU-0010', 'SNIPER : GHOST WARRIOR 3', 'Pénétrez en territoire ennemi dans ce FPS militaire ultime. Accomplissez des missions en choisissant l’approche qui vous convient le mieux dans un monde ouvert impitoyable.', 21.99, 0, 5),
('LIV-0001', 'Le petit prince', '«Le premier soir, je me suis donc endormi sur le sable à mille milles de toute terre habitée. J\'étais bien plus isolé qu\'un naufragé sur un radeau au milieu de l\'océan. Alors, vous imaginez ma surprise, au lever du jour, quand une drôle de petite voix m\'a réveillé. Elle disait : “S\'il vous plaît... dessine-moi un mouton !” J\'ai bien regardé. Et j\'ai vu ce petit bonhomme tout à fait extraordinaire qui me considérait gravement...»', 6.9, 0, 1),
('LIV-0002', 'Contes', 'Extrait : \"L\'INTREPIDE SOLDAT DE PLOMB. [...]La première chose qu\'ils entendirent en ce monde, quand fut enlevé le couvercle de la boîte qui les renfermait, ce fut ce cri : “ Des soldats de plomb ! ” que poussait un petit garçon en battant des mains. On les lui avait donnés en cadeau pour sa fête, et il s\'amusait à les ranger sur la table. Tous les soldats se ressemblaient parfaitement, à l\'exception d\'un seul, qui n\'avait qu\'une jambe.\"', 2.95, 0, 1),
('LIV-0003', 'Grands espaces (Les)', 'Catherine Meurisse a grandi à la campagne, entourée de pierres, d\'arbres, et avec un chantier sous les yeux : celui de la ferme que ses parents rénovent, afin d\'y habiter en famille. Une grande et vieille maison qui se transforme, des arbres à planter, un jardin à imaginer, la nature à observer : ainsi naît le goût de la création et germent les prémices d\'un futur métier : dessinatrice. Avec humour et tendresse, l\'auteure raconte le paradis de l\'enfance, que la nature, l\'art et la littérature, ses alliés de toujours, peuvent aider à conserver autant qu\'à dépasser. Les Grands Espaces raconte le lieu d\'une enfance et l\'imaginaire qui s\'y déploie, en toute liberté.', 19.99, 0, 1),
('LIV-0004', 'Batman - Dark Knight III, Intégrale', 'Après avoir remporté une victoire décisive contre le tandem formé par Luthor et Brainiac, Batman disparaît et Gotham est à nouveau en proie au crime et à la désolation. Mais peu après, la rumeur circule le Chevalier Noir serait de retour. Pendant ce temps, Lara, la fille de Superman, appelle le scientifique Ray Palmer au secours de la ville-bouteille de Kandor. BATMAN - DARK KNIGHT III est la suite tant attendue de DARK KNIGHT RETURNS et de DARK KNIGHT STRIKES AGAIN, conçue par Frank MILLER (BATMAN ANNEE UN), assisté au scénario par Brian AZZARELLO (100 BULLETS), et dessinée par Andy KUBERT (FLASHPOINT) et Klaus JANSON (Daredevil). Aux chapitres de la série sont ajoutés des épisodes complémentaires explorant cet Univers si singulier et dessiné par MILLER lui-même, ainsi que John ROMITA Jr (Amazing Spider-Man) et Eduardo RISSO (DARK NIGHT - UNE HISTOIRE VRAIE).', 35, 0, 1),
('LIV-0005', 'Les particules élémentaires', 'Michel, chercheur en biologie rigoureusement déterministe, incapable d\'aimer, gère le déclin de sa sexualité en se consacrant au travail, à son Monoprix et aux tranquillisants. Une année sabbatique donne à ses découvertes un tour qui bouleversera la face du monde. Bruno, de son côté, s\'acharne en une quête désespérée du plaisir sexuel. Un séjour au \" Lieu du Changement \", camping post-soixante-huitard tendance New Age, changera-t-il sa vie ? Un soir, une inconnue à la bouche hardie lui fait entrevoir la possibilité pratique du bonheur. Par leur parcours familial et sentimental chaotique, les deux demi-frères illustrent de manière exemplaire la société d\'aujourd\'hui et la quête complexe de l\'amour vrai.', 8.1, 0, 1),
('LIV-0006', 'Mondo et Trois Autres Histoires', 'Ce volume rassemble quatre nouvelles du recueil Mondo et autres histoires : Mondo, Lullaby, Celui qui n\'avait jamais vu la', 6.3, 0, 1),
('LIV-0007', 'La Prophétie de l\'Almanach', 'Richard Firenze, un collectionneur de livres anciens, passionné par les prophéties de Nostradamus, est assassiné dans de troublantes circonstances. Le tueur a fouillé toute sa maison sans rien emporter, laissant une importante somme d’argent et des manuscrits rares dans le coffre-fort. La capitaine Valentin en charge de l’enquête suspecte le Grand Maître d’une mystérieuse société secrète appelée les Illuminés d’Avignon. Les adeptes organisent des cérémonies ancestrales et communiquent avec des entités célestes. Peu de temps avant sa mort, Richard a remis à sa fille une enveloppe contenant d’étranges indices : un quatrain de Nostradamus, une carte de tarot représentant la tour de Babel, deux photos sur lesquelles on peut voir le bâton d’Asclépios, symbole des alchimistes et un almanach de 1567. Ses recherches amèneront Alice à se rendre à Florence qui est la ville de la célèbre famille des Médicis, baignée d’une forte tradition ésotérique et alchimique. Alice parviendra-t-elle à résoudre l’énigme laissée par son père ? Retrouvera-t-elle le dernier almanach de Nostradamus qui d’après de vieilles légendes contiendrait une terrible prophétie ? Le temps est compté. Un mystérieux tueur est à sa poursuite. L’assassin fera tout pour s’emparer du vieil ouvrage.', 15.82, 0, 1),
('LIV-0008', 'Un pape pour l\'apocalypse', 'A Aurillac, le capitaine Malo Sinclair s\'ennuie... Il faut dire que Malo, jeune as prometteur de la police criminelle du quai des Orfèvres, avait tout pour monter vite et haut dans la hiérarchie... s\'il n\'avait eu la malheureuse idée de démolir le portrait d\'un suspect, fils d\'un ministre. Pour le protéger autant que pour le punir, son chef a décidé de le mettre \"au vert\". Et pour ce faire, quoi de mieux qu\'Aurillac, préfecture du Cantal, où l\'on compte plus de vaches que d\'habitants ? Après deux ans, Malo est à la limite de la dépression. C\'est alors qu\'on l\'appelle pour une affaire de vol sur le chantier de fouille de l\'abbaye Saint-Géraud récemment mise à jour. Une tête mécanique, incroyable vestige, presqu\'une légende urbaine, a disparu. Enfin une affaire qui sort de l\'ordinaire ! Mais, quand les cadavres pleuvent, Malo ne peut se dire qu\'une chose : il n\'en demandait pas tant... Un polar ésotérique autour du personnage de Gerbert d\'Aurillac, le sulfureux Pape de l\'an Mil.', 20.9, 0, 1),
('LIV-0009', 'La Marque de Windfield', '1866. Un jeune élève du collège de Windfield, non loin de Londres, se noie lors d\'une escapade qui tourne au drame. Plusieurs garçons sont témoins de l\'événement. Parmi eux, Edward Pilaster, l\'héritier de la fortune des Pilaster, une richissime dynastie de banquiers, Hugh Pilaster, un cousin pauvre d\'Edward, et Micky Miranda, fils d\'un grand propriétaire terrien d\'Amérique du Sud. Ce tragique accident - mais s\'agit-il d\'un accident ? - et les secrets qui l\'entourent vont marquer à jamais ces trois garçons. Leurs destins ne cesseront plus de s\'entrecroiser au fil des rivalités amoureuses et des luttes impitoyables pour s\'assurer le contrôle de la banque. Bureaux lambrissés d\'acajou des grands temples de la finance... Bas-fonds où gentlemen s\'encanaillent dans le jeu ou la débauche...\r\n\r\nEn faisant le récit haletant des passions qui déchirent cette famille, Ken Follett redonne vie à la fascinante Angleterre victorienne. Dans toute sa splendeur. Dans toute sa noirceur.', 8.7, 0, 1),
('LIV-0010', 'Les misérables', 'Les misérables est un roman de Victor Hugo paru en 1862. L\'action se déroule en France au début du XIXe siècle. On suit la vie de Jean Valjean, du retour du bagne jusqu\'à sa mort. Autour de lui gravitent les personnages témoins de la misère de ce siècle, misérables eux-mêmes ou proches de la misère : Fantine, Cosette, Marius, mais aussi les Thénardier ainsi que le représentant de la loi Javert. ', 5.3, 0, 1),
('MON-0001', 'Garmin Forerunner 35', 'Forerunner 35, montre GPS de running avec cardio poignet Garmin Elevate. Cette montre GPS de course à pied intuitive, intègre la technologie de fréquence cardiaque Garmin Elevate qui mesure la fréquence cardiaque au poignet 24/7. Elle enregistre vos données de distance, de vitesse ainsi que vos records personnels. Le suivi d\'activité enregistre le nombre de pas effectué par jour. Type d\'affichage: Antireflet, MIP transflectif . Matériau de sangle: Silicone.Résolution d\'affichage: 128 x 128 pixels.', 149.99, 3, 4),
('PIA-0001', 'BIRD INSTRUMENTS XP1', 'XP1 WH V2 Nouvelle version ! ', 379, 3, 3),
('PIA-0002', 'CASIO CDP-S100 - NOIR', 'Le nouveau modèle de la gamme CDP-S séduit grâce à ses fonctionnalités d\'exception : un nouveau mécanisme à marteaux, une nouvelle source sonore, un nouveau système de haut-parleurs et la connexion à l\'application Chordana Play for Piano !', 444, 3, 3),
('POR-0001', 'Apple MacBook Air 13.3\'\'', 'Apple MacBook Air 13.3\'\' LED 128 Go SSD 8 Go RAM Intel Core i5 bicœur à 1.8 Ghz MQD32FN', 1099, 4, 7),
('POR-0002', 'ASUS S430UA-EB128T', 'Vous cherchez un ordinateur portable qui allie performances, élégance et confort ? Découvrez le beau et jeune ASUS VivoBook S14 S430. Ce PC s’adapte parfaitement à votre personnalité.', 649, 3, 7),
('POR-0003', 'Asus A540UA', 'Asus A540UA 15,6\" 8 Go RAM 1 To + 128 Go', 699, 3, 7),
('POR-0004', 'HP PAVILION X360', 'Le HP Pavilion X360 14-ba106nb est un ordinateur portable 2 en 1 compact et puissant que vous utilisez également comme tablette. Grâce au processeur Intel Core i5, vous pouvez modifier des photos dans des programmes graphiques. Êtes-vous meilleur avec vos mains qu\'avec une souris et un clavier? Faites pivoter l\'écran à 360 degrés et utilisez l\'écran tactile pour régler votre travail. Vous pouvez voir votre travail accompli en plaçant ce Pavilion X360 dans la position de tente, de sorte que l\'ordinateur portable reste en...', 799, 2, 7),
('POR-0005', 'HP 15-DA0047', 'HP 15-DA0047 15.6/I5-8250/8/1T+128/NVIDIA GF MX110 2GB', 749, 2, 7),
('POR-0006', 'Lenovo 330-15IKBR', 'Lenovo 330-15IKBR 15.6/I5-8250/8 Go /1To +256 Go /NVidia GF MX150 2Go', 849, 4, 7),
('PUL-0001', ' Pull bicolore Eco-conception', 'Un jeu de points qui crée un joli motif à chevrons. En plus c\'est du bio ! ;)', 15, 0, 2),
('PUL-0002', ' Pull en maille fine col V', 'Le pull col V est un incontournable du dressing masculin. ', 12, 0, 2),
('ROB-0001', ' Robe décolleté devant et dos', 'Une robe fluide et colorée à ajouter à son dressing ! ', 18, 0, 2),
('SMA-0001', 'Honor View 20', 'Le Honor View 20 au design premium en verre vous offre une incroyable expérience. Le Honor View 20 est conçu avec le processeur Kirin 980. Il est doté d\'une batterie de 4000 mAh avec super charge.', 549, 2, 4),
('SMA-0002', 'Huawei P20 Lite', 'Le nouveau P20 Lite de chez Huawei: un smartphone au design compact et élégant, le style et la performance ! Double capteur photo de 16MP + 2MP, pour des photos éblouissantes, Ecran FullViewFHD+ de 5.84 pouces d\'une résolution de 2280 x 1080 pixels, pour des couleurs vives et des contrastes élevés, Processeur Kirin659 octo-coeur, pour un téléphone qui reste rapide et offre une fluidité du système sans interruption même avec plusieurs applications ouvertes en même temps, Batterie de 3000mAh pour une autonomie plus longue et une recharge plus rapide, Reconnaissance faciale rapide en temps réel, pour un déverrouillage aisé', 233.6, 2, 4),
('SMA-0003', 'Huawei Mate 10 lite', 'Le Mate 10 Lite dispose d\'un écran éblouissant de 5, 9 pouces offrant une incroyable immersive, pour un design moderne et élégant. Le superbe écran FHD+ révolutionne votre manière d\'interagir sur les réseaux sociaux, regarder des vidéos, lire des livres et naviguer sur le web.', 209.93, 2, 4),
('SMA-0004', 'Samsung Galaxy S8', 'Le Samsung Galaxy S8 bouscule les codes esthétiques et repousse les limites des écrans tels que vous les connaissiez. Son écran Infinity sublime la richesse des images et offre une immersion spectaculaire. Un nouveau monde s’ouvre au creux de votre main. Sortez du cadre.', 416, 2, 4),
('TAB-0001', 'HUAWEI MediaPad T5', 'La HUAWEI MediaPad T5 10 est une tablette dotée d\'un écran de 10, 1 pouces, doté d\'une résolution Full HD de 1920 x 1200p, donnant vie à chaque instant. Fonctionnant avec Android 8, elle embarque un processeur Kirin 659 8 cœurs. ', 159, 2, 4),
('TAB-0002', 'Asus Zenpad 10 Z301MF-1H006A', 'Pour ne jamais être un frein à votre mobilité, le Z301MF s\'habille de dimensions ultrafines avec un poids de moins de 500g et une épaisseur de 8.95 mm.La dalle IPS permet à la tablette d\'offrir une image parfaite même lors d\'une utilisation en extérieur et sous le soleil. Cette technologie assure également un large angle de vision de 178°. Profitez également de graphismes riches en détails avec l’écran Full HD de 1920 x 1200.Le Z301MF est équipé d’un capteur face arrière de 5 mégapixels et dispose d’un deuxième capteur photo de 2 mégapixels placé sur sa face avant et qui vous permettra également de prendre des photos ou de mener des vidéoconférences.', 159, 2, 4),
('TEE-0001', 'T-shirt en côtes', 'Un indispensable à toujours avoir dans sa garde robe ! ', 10, 0, 2),
('TEE-0002', ' T-shirt imprimé', 'Un message girl power ! ', 5.2, 0, 2),
('VES-0001', ' Veste en jean stretch', 'Un indémodable du dressing : la veste en jean ! Elle se marie avec tous les looks et se porte au quotidien ! ', 20, 0, 2),
('VIO-0001', 'VENDOME 4/4 ORSIGNY', 'Les violonistes de niveau intermédiaire commencent à développer leurs propres préférences en termes de style de jeu. Ils s\'approprient de plus en plus leur instrument, et cherchent le son qui leur convient. Lâ€™assemblage exceptionnel de ces violons leur permet de supporter facilement les techniques de jeu exigeantes que les violonistes de niveau intermédiaire sont amenés à apprendre, comme lâ€™expression musicale et le détaché (spiccato).', 815, 3, 3),
('VIO-0002', 'EAGLETONE RIMINI 4/4', 'Conçue et préparée par un luthier, la gamme de violons Eagletone Rimini se démarque par une qualité de fabrication irréprochable et inégalable dans cette gamme de prix.', 250.99, 2, 3);

--
-- Déclencheurs `produit`
--
DROP TRIGGER IF EXISTS `trigModifPrixU`;
DELIMITER $$
CREATE TRIGGER `trigModifPrixU` BEFORE UPDATE ON `produit` FOR EACH ROW BEGIN
IF new.prixProduit > (old.prixProduit + old.prixProduit * 0.2)  THEN
	SIGNAL SQLSTATE'45000'
	SET MESSAGE_TEXT = "MODIFICATION IMPOSSIBLE : Vous ne pouvez pas augmenter de plus de 20% le prix d'un produit.",
	MYSQL_ERRNO = 22;
ELSEIF new.prixProduit < (old.prixProduit - old.prixProduit * 0.2)  THEN
	SIGNAL SQLSTATE'45000'
	SET MESSAGE_TEXT = "MODIFICATION IMPOSSIBLE : Vous ne pouvez pas diminuer de plus de 20% le prix d'un produit.",
	MYSQL_ERRNO = 22;
END IF;
END
$$
DELIMITER ;

DELIMITER $$
--
-- Évènements
--
DROP EVENT `appelVerifTech`$$
CREATE DEFINER=`root`@`localhost` EVENT `appelVerifTech` ON SCHEDULE EVERY 1 DAY STARTS '2019-01-31 20:44:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
	call verifTech();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
