-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- HÃ´te : 127.0.0.1:3306
-- GÃ©nÃ©rÃ© le :  Dim 04 fÃ©v. 2018 Ã  17:21
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de donnÃ©es :  `myhomeoncommand`
--

-- --------------------------------------------------------

--
-- Structure de la table `cemac`
--

DROP TABLE IF EXISTS `cemac`;
CREATE TABLE IF NOT EXISTS `cemac` (
  `id_cemac` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cemac` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cemac`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `cemac`
--

INSERT INTO `cemac` (`id_cemac`, `nom_cemac`) VALUES
(21, 'CeMac1'),
(22, 'Cemac salon');

-- --------------------------------------------------------

--
-- Structure de la table `conditions_utilisation`
--

DROP TABLE IF EXISTS `conditions_utilisation`;
CREATE TABLE IF NOT EXISTS `conditions_utilisation` (
  `id_conditions_utilisation` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_conditions_utilisation` text,
  PRIMARY KEY (`id_conditions_utilisation`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `conditions_utilisation`
--

INSERT INTO `conditions_utilisation` (`id_conditions_utilisation`, `contenu_conditions_utilisation`) VALUES
(1, 'Conditions d\'utilisation Ã  remplir par Domisep');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `telephone_contact` text,
  `email_contact` text,
  `adresse_contact` text,
  PRIMARY KEY (`id_contact`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `telephone_contact`, `email_contact`, `adresse_contact`) VALUES
(1, '0561787818', 'domisep@isep.fr', '44 bis ....');

-- --------------------------------------------------------

--
-- Structure de la table `donnees_equipement`
--

DROP TABLE IF EXISTS `donnees_equipement`;
CREATE TABLE IF NOT EXISTS `donnees_equipement` (
  `id_donnees_equipement` int(11) NOT NULL AUTO_INCREMENT,
  `temps` time NOT NULL,
  `date_utilisation` date DEFAULT NULL,
  `valeur` int(11) NOT NULL,
  `id_equipement` int(11) NOT NULL,
  PRIMARY KEY (`id_donnees_equipement`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `donnees_equipement`
--

INSERT INTO `donnees_equipement` (`id_donnees_equipement`, `temps`, `date_utilisation`, `valeur`, `id_equipement`) VALUES
(1, '03:00:00', '2018-02-01', 40, 23),
(2, '01:00:00', '2018-02-02', 50, 23),
(3, '07:00:00', '2018-02-03', 50, 23),
(4, '17:00:00', '2018-02-01', 26, 22),
(5, '10:00:00', '2018-02-02', 24, 22),
(6, '14:00:00', '2018-02-03', 21, 22),
(17, '08:00:00', '2018-02-02', 1, 24),
(16, '06:00:00', '2018-02-04', 1, 24),
(15, '07:00:00', '2018-02-05', 1, 24),
(11, '06:00:00', '2018-02-06', 1, 26),
(12, '03:00:00', '2018-02-08', 43, 28),
(13, '09:00:00', '2018-02-06', 24, 27),
(14, '05:00:00', '2018-02-08', 20, 27);

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
CREATE TABLE IF NOT EXISTS `equipement` (
  `id_equipement` int(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(255) DEFAULT NULL,
  `id_cemac` int(11) NOT NULL,
  `id_type_equipement` int(11) NOT NULL,
  `nom_equipement` varchar(255) NOT NULL,
  `valeur_cible` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_equipement`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `equipement`
--

INSERT INTO `equipement` (`id_equipement`, `etat`, `id_cemac`, `id_type_equipement`, `nom_equipement`, `valeur_cible`) VALUES
(24, NULL, 21, 4, 'LumiÃ¨res', NULL),
(23, NULL, 21, 2, 'Humidite', 2),
(22, NULL, 21, 1, 'Temperature', 2),
(26, NULL, 22, 4, 'lumiÃ¨res 1', NULL),
(27, NULL, 22, 1, 'tempÃ©rature 1', NULL),
(28, NULL, 22, 2, 'humiditÃ© 1', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_groupe` int(11) NOT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `info_utilisateur`
--

DROP TABLE IF EXISTS `info_utilisateur`;
CREATE TABLE IF NOT EXISTS `info_utilisateur` (
  `id_info_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `statut_utilisateur` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id_info_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `info_utilisateur`
--

INSERT INTO `info_utilisateur` (`id_info_utilisateur`, `prenom`, `nom`, `email`, `telephone`, `statut_utilisateur`, `id_utilisateur`, `token`) VALUES
(37, 'Pierre ', 'Dupont', NULL, NULL, 'client', 107, '$2y$10$AubhFedS6lgUdhtxe5v3L.QW1ZXjHzz6VmeJ6Gt0OHhEqC23SkA92'),
(33, 'Nathan', 'Bienfait', 'nathan.bienfait@isep.fr', '0745342857', 'client', 103, '$2y$10$eJL90ItXZ8zdOfkVf4UX0ux9eymFd.ewH2pb.Ftd3DS4Ql4olruyi'),
(35, 'Elodie', 'Boye', 'elodie.boye@isep.fr', '0682522974', 'client', 105, '$2y$10$btQURi95KtuHqZh6vkKffeNl9U2Li5pz5HOQywc1vLsNseV6VYRzm'),
(31, 'RÃ©mi', 'Biolley ', 'remi.boilley@isep.fr', '0628061438', 'client', 101, '$2y$10$WbkCWdknrH/aLIaq7qwase8VU.nTxV.f7w3oM3fyBb.P.1cxC0WOq'),
(32, 'Louis ', 'Ecuvillon', 'louis.ecuvillon@isep.fr', '0678675645', 'client', 102, '$2y$10$dQtKRPA//PnnjvZXad2JsOAXbZSv.BIWSlMem7q/HNG2STMxTQdgK'),
(30, 'Maya', 'Bachir', 'maya.bachir@isep.fr', '0684290190', 'client', 100, '$2y$10$fofZltO2ed3xChfq1KZajOf8thk0muwb9ujxHFxL/Py6/6YtRF98O'),
(34, 'Alexis', 'Delorme', 'alexis.delorme@isep.fr', '0687956745', 'client', 104, '$2y$10$v4qZcwc9J4Q1F.D1Hch6fOANn82W2GsbpJO8/3xpGmiWGNhWxagcK');

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id_logement` int(11) NOT NULL AUTO_INCREMENT,
  `nom_logement` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `pays` varchar(255) NOT NULL,
  PRIMARY KEY (`id_logement`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `nom_logement`, `rue`, `ville`, `code_postal`, `pays`) VALUES
(21, 'Appart Paris', 'Victor Hugo', 'Issy-les-Moulinneaux', 92130, 'France'),
(22, 'Maison principale', '1 rue des Anges', 'Paris', 75016, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `id_piece` int(11) NOT NULL AUTO_INCREMENT,
  `nom_piece` varchar(255) NOT NULL,
  `id_logement` int(11) NOT NULL,
  PRIMARY KEY (`id_piece`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `piece`
--

INSERT INTO `piece` (`id_piece`, `nom_piece`, `id_logement`) VALUES
(21, 'Chambre ', 21),
(22, 'Salon', 22);

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

DROP TABLE IF EXISTS `presentation`;
CREATE TABLE IF NOT EXISTS `presentation` (
  `id_presentation` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_presentation` text,
  PRIMARY KEY (`id_presentation`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `presentation`
--

INSERT INTO `presentation` (`id_presentation`, `contenu_presentation`) VALUES
(1, 'Bonjour, nous sommes Domisep');

-- --------------------------------------------------------

--
-- Structure de la table `qr`
--

DROP TABLE IF EXISTS `qr`;
CREATE TABLE IF NOT EXISTS `qr` (
  `id_qr` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_q` text,
  `contenu_r` text,
  `date_q` datetime DEFAULT NULL,
  `date_r` datetime DEFAULT NULL,
  `id_type_qr` int(11) NOT NULL,
  PRIMARY KEY (`id_qr`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `qr`
--

INSERT INTO `qr` (`id_qr`, `contenu_q`, `contenu_r`, `date_q`, `date_r`, `id_type_qr`) VALUES
(22, 'La puce sous un de mes Ã©quipements est rouge, qu\'est-ce que cela veut dire?', 'Cela signifie que l\'Ã©quipement en question n\'envoie plus de donnÃ©es Ã  son cemac. Pensez Ã  vÃ©rifier qu\'aucun objet extÃ©rieur ne vient perturber la connexion entre le capteur et son cemac attitrÃ©. Sinon, nous vous invitons Ã  contacter un opÃ©rateur.', '2018-01-27 00:00:00', '2018-01-27 00:00:00', 1),
(25, 'Oui, je l\'ai fait deux fois, rien n\'a changÃ©. Que puis-je faire pour faire fonctionner mon Ã©quipement de nouveau?', ' - - Un membre du support va vous rÃ©pondre dans les plus bref dÃ©lais - - ', '2018-01-28 00:46:25', '2018-01-28 00:46:25', 2),
(24, 'Bonjour\r\nLa connexion entre mon Ã©quipement et le cemac semble ne plus fonctionner.', 'Bien, avant tout, je vais vous posez quelques questions classique afin de mieux cerner le problÃ¨me. \r\n\r\nTout d\'abord, avez vous essayÃ© d\'Ã©teindre et rallumer le systÃ¨me?', '2018-01-28 00:43:42', '2018-01-28 00:43:42', 2),
(23, 'Le nom que je donne Ã  mes Ã©quipement est-il important?', 'Vous pouvez nommer vos Ã©quipements comme bon vous semble. cela n\'a aucune influence sur le fonctionnement de votre systÃ¨me. Les noms vous permettent juste de mieux vous y retrouver.', '2018-01-27 00:00:00', '2018-01-27 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `relation_groupe_utilisateur`
--

DROP TABLE IF EXISTS `relation_groupe_utilisateur`;
CREATE TABLE IF NOT EXISTS `relation_groupe_utilisateur` (
  `id_relation_groupe_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `id_groupe` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_relation_groupe_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relation_logement_utilisateur`
--

DROP TABLE IF EXISTS `relation_logement_utilisateur`;
CREATE TABLE IF NOT EXISTS `relation_logement_utilisateur` (
  `id_relation_logement_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `id_logement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_relation_logement_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `relation_logement_utilisateur`
--

INSERT INTO `relation_logement_utilisateur` (`id_relation_logement_utilisateur`, `id_logement`, `id_utilisateur`) VALUES
(12, 21, 105),
(13, 22, 100);

-- --------------------------------------------------------

--
-- Structure de la table `relation_piece_cemac`
--

DROP TABLE IF EXISTS `relation_piece_cemac`;
CREATE TABLE IF NOT EXISTS `relation_piece_cemac` (
  `id_relation_piece_cemac` int(11) NOT NULL AUTO_INCREMENT,
  `id_piece` int(11) NOT NULL,
  `id_cemac` int(11) NOT NULL,
  PRIMARY KEY (`id_relation_piece_cemac`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `relation_piece_cemac`
--

INSERT INTO `relation_piece_cemac` (`id_relation_piece_cemac`, `id_piece`, `id_cemac`) VALUES
(18, 21, 21),
(19, 22, 22);

-- --------------------------------------------------------

--
-- Structure de la table `relation_utilisateur_qr`
--

DROP TABLE IF EXISTS `relation_utilisateur_qr`;
CREATE TABLE IF NOT EXISTS `relation_utilisateur_qr` (
  `id_relation_utilisateur_qr` int(11) NOT NULL AUTO_INCREMENT,
  `id_qr` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_relation_utilisateur_qr`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `relation_utilisateur_qr`
--

INSERT INTO `relation_utilisateur_qr` (`id_relation_utilisateur_qr`, `id_qr`, `id_utilisateur`) VALUES
(1, 9, 42),
(2, 10, 42),
(7, 19, 105),
(6, 18, 107),
(8, 20, 107),
(9, 21, 107),
(10, 24, 107),
(11, 25, 107);

-- --------------------------------------------------------

--
-- Structure de la table `slogan`
--

DROP TABLE IF EXISTS `slogan`;
CREATE TABLE IF NOT EXISTS `slogan` (
  `id_slogan` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_slogan` text,
  PRIMARY KEY (`id_slogan`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `slogan`
--

INSERT INTO `slogan` (`id_slogan`, `contenu_slogan`) VALUES
(1, 'A connected home in a connected world');

-- --------------------------------------------------------

--
-- Structure de la table `type_donnees`
--

DROP TABLE IF EXISTS `type_donnees`;
CREATE TABLE IF NOT EXISTS `type_donnees` (
  `id_type_donnees` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_donnees` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type_donnees`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `type_donnees`
--

INSERT INTO `type_donnees` (`id_type_donnees`, `nom_type_donnees`) VALUES
(1, 'binaire'),
(2, 'non_binaire');

-- --------------------------------------------------------

--
-- Structure de la table `type_equipement`
--

DROP TABLE IF EXISTS `type_equipement`;
CREATE TABLE IF NOT EXISTS `type_equipement` (
  `id_type_equipement` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_equipement` varchar(255) NOT NULL,
  `image_fond` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `unite` varchar(255) NOT NULL,
  `id_type_donnees` int(11) DEFAULT NULL,
  `message_etat_haut` text,
  `message_etat_bas` text,
  PRIMARY KEY (`id_type_equipement`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `type_equipement`
--

INSERT INTO `type_equipement` (`id_type_equipement`, `nom_type_equipement`, `image_fond`, `logo`, `unite`, `id_type_donnees`, `message_etat_haut`, `message_etat_bas`) VALUES
(1, 'temperature', 'images/Thermometre2.jpg', 'images/Thermometre.png', 'Â°C', 2, NULL, NULL),
(2, 'humidite', 'images/Humidite.png', 'images/Goutte.png', '%', 2, NULL, NULL),
(3, 'ouverture', 'images/Paysage.png', 'images/ouvertureFenetre.png', '', 1, 'ouvert', 'fermÃ©'),
(4, 'lumieres', 'images/lumiere.jpg', 'images/Ampoule.png', '', 1, 'AllumÃ©', 'Eteint');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

DROP TABLE IF EXISTS `type_utilisateur`;
CREATE TABLE IF NOT EXISTS `type_utilisateur` (
  `id_type_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_utilisateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`id_type_utilisateur`, `nom_type_utilisateur`) VALUES
(1, 'admin'),
(2, 'support'),
(3, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_type_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login`, `password`, `id_type_utilisateur`) VALUES
(101, 'RÃ©mi', '$2y$10$HC3VcpyGA4pPU5EEc.FnsuuLvXcqknLsG7j4O61wDGxaqL0S.7GMC', 3),
(104, 'Alexis', '$2y$10$f/8VUcHwEO2fDGs0717a1e6f8hUSLZCUEJuIDqrZRBDV/rC50QfrS', 3),
(105, 'Elodie', '$2y$10$bRkNVlh8wwkt9zGdY.HUkOI/B2V7bH9t777nT05Cqe5DScJdRDU5m', 3),
(102, 'Louis', '$2y$10$xvmzwdjKpGAzC.13V3i4BuwnRchUS1wYxfTV9RO6bN9cxfMJ2rzTe', 3),
(99, 'Admin', '$2y$10$vkvahNmJ9dbkssILKhN.EOw/y/o.zWcjewiQ2OEAarYNHKbVhoCgO', 1),
(107, 'PierreD', '$2y$10$siaLx8d/ViMt1ik0637jMO9fxKLeDvjIAe9h.5oOBptQ/kd9Y/ptO', 3),
(100, 'Maya', '$2y$10$PNoV1WXn4dngOTgj2hsd9.BHAp29GOmmiwDqKwmodRNHbQLhwYpEq', 3),
(72, 'Operateur', '$2y$10$dEbGP.sE.ZUXibMBCIykjegKLyIjLPwx4aMZ16tI4EZH8psY5h/Ze', 2),
(103, 'Nathan', '$2y$10$2Bpek/as8YPDN.iAlLdzhO2blWX3DlurEFVUp.8u2VrXuxmObiceG', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
