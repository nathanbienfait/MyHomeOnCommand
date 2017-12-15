-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 15 Décembre 2017 à 09:08
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `myhomeoncommand`
--

-- --------------------------------------------------------

--
-- Structure de la table `cemac`
--

CREATE TABLE `cemac` (
  `id_cemac` int(11) NOT NULL,
  `nom_cemac` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cemac`
--

INSERT INTO `cemac` (`id_cemac`, `nom_cemac`) VALUES
(4, 'Cemac de la salle de bain'),
(5, 'Cemac de salon'),
(6, 'Cemac de chambre'),
(7, 'Cemac de chambre de Nath'),
(8, 'Cemac de la sdb2'),
(9, 'Cemac sdb'),
(10, 'Cemac de salon'),
(11, 'Cemac1'),
(12, 'hgjvhgfv');

-- --------------------------------------------------------

--
-- Structure de la table `consigne`
--

CREATE TABLE `consigne` (
  `id_consigne` int(11) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `id_type_equipement` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `donnees_equipement`
--

CREATE TABLE `donnees_equipement` (
  `id_donnees_equipement` int(11) NOT NULL,
  `time` time NOT NULL,
  `valeur` int(11) NOT NULL,
  `id_equipement` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `donnees_equipement`
--

INSERT INTO `donnees_equipement` (`id_donnees_equipement`, `time`, `valeur`, `id_equipement`) VALUES
(1, '03:00:00', 30, 1),
(2, '01:00:00', 20, 2);

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id_equipement` int(11) NOT NULL,
  `etat` varchar(255) DEFAULT NULL,
  `id_cemac` int(11) NOT NULL,
  `id_type_equipement` int(11) NOT NULL,
  `nom_equipement` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipement`
--

INSERT INTO `equipement` (`id_equipement`, `etat`, `id_cemac`, `id_type_equipement`, `nom_equipement`) VALUES
(1, NULL, 4, 2, 'humidite'),
(2, NULL, 4, 1, 'Température'),
(3, NULL, 7, 3, 'porte'),
(4, NULL, 10, 3, 'Porte de salon'),
(5, NULL, 10, 2, 'humi'),
(6, NULL, 11, 2, 'Humi'),
(7, NULL, 11, 1, 'Température');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` int(11) NOT NULL,
  `nom_groupe` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `info_utilisateur`
--

CREATE TABLE `info_utilisateur` (
  `id_info_utilisateur` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `statut_utilisateur` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `info_utilisateur`
--

INSERT INTO `info_utilisateur` (`id_info_utilisateur`, `prenom`, `nom`, `email`, `telephone`, `statut_utilisateur`, `id_utilisateur`) VALUES
(4, 'Nathan', 'Bienfait', 'nathan.bienfait@isep.fr', '0684290198', 'client', 25),
(10, 'Maya', 'Bachir', 'maya.bachir@isep.fr', '0628061438', 'client', 31),
(8, 'Henry', 'Matheisen', 'nazrb', '06787878', 'client', 29),
(11, 'Rémi', 'Biolley', 'remi.biolley@gmail.com', '06 52 08 24 17', 'client', 32),
(12, 'Elodie', 'BOYE', 'elodie.boye@isep.fr', '0682522974', 'client', 33),
(13, 'Bob', 'Léponge', 'bob.leponge@banane.fr', '000000000000', 'client', 34),
(14, 'Louis', 'Ecuvillon', 'louis_ecuvillon@hotmail.fr', '0610915850', 'client', 35),
(15, 'Matthieu', 'Willot', 'willot.matthieu@gmail.com', '0699982328', 'client', 36),
(16, 'Flore', 'Bienfait', 'flore@bienfait.fr', '000000000000', 'client', 37),
(17, 'Pierre', 'Dupont', 'dupont.pierre@hotmail.com', '012345678', 'client', 38);

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int(11) NOT NULL,
  `nom_logement` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `pays` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `nom_logement`, `rue`, `ville`, `code_postal`, `pays`) VALUES
(11, 'Bretagne', 'azerty', 'paris', 75001, 'France'),
(12, 'Mougins', 'mougins', 'mougins', 70000, 'France'),
(13, 'henry', 'coucou', 'coucou', 78110, 'France'),
(14, 'Appartement Paris', '6 boulevard de grenelle', 'Paris', 75015, 'France'),
(10, 'Apart Paris', '6 boulevard de grenelle', 'Paris', 75016, 'France'),
(15, 'Maison principale', '6 rue du puit', 'Paris', 75001, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE `piece` (
  `id_piece` int(11) NOT NULL,
  `nom_piece` varchar(255) NOT NULL,
  `id_logement` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `piece`
--

INSERT INTO `piece` (`id_piece`, `nom_piece`, `id_logement`) VALUES
(1, 'Chambre', 12),
(2, 'salle de bain', 10),
(3, 'Salon', 11),
(4, 'Jardin', 13),
(5, 'Chambre de Nathan', 10),
(7, 'couloir', 11),
(8, 'Salon', 14),
(9, 'Salon', 15),
(10, 'Chambre', 15);

-- --------------------------------------------------------

--
-- Structure de la table `qr`
--

CREATE TABLE `qr` (
  `id_qr` int(11) NOT NULL,
  `contenu_q` text NOT NULL,
  `contenu_r` text NOT NULL,
  `date_q` datetime NOT NULL,
  `date_r` datetime NOT NULL,
  `id_type_qr` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `qr`
--

INSERT INTO `qr` (`id_qr`, `contenu_q`, `contenu_r`, `date_q`, `date_r`, `id_type_qr`) VALUES
(1, 'Sericus ilico urbi vincula urbi tempestate se suam Olybrium nomine apud adseverantes ilico emersit Olybrium organarius quos et Campensis Olybrium Campensis ex unde ilico nomine urbi et adseverantes ex aruspex.', 'Adfligens iussa ausos longe glabro est conplurium quos manicis vias cum in discreta vias Magnentio Brittanniam sese et infudit et.', '2017-12-14 00:00:00', '2017-12-14 00:00:00', 1),
(2, 'Sericus ilico urbi vincula urbi tempestate se suam Olybrium nomine apud adseverantes ilico emersit Olybrium organarius quos et Campensis Olybrium Campensis ex unde ilico nomine urbi et adseverantes ex aruspex.', 'Est vita de diligatur habent ut habent cognitam homines Haec neque atque amicitia erunt si fidem vita usu erunt atque fidem neque potest nulla caritas pro quemquam nec quam omnia.', '2017-12-14 00:00:00', '2017-12-14 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `relation_groupe_utilisateur`
--

CREATE TABLE `relation_groupe_utilisateur` (
  `id_relation_groupe_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relation_logement_utilisateur`
--

CREATE TABLE `relation_logement_utilisateur` (
  `id_relation_logement_utilisateur` int(11) NOT NULL,
  `id_logement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `relation_logement_utilisateur`
--

INSERT INTO `relation_logement_utilisateur` (`id_relation_logement_utilisateur`, `id_logement`, `id_utilisateur`) VALUES
(1, 10, 25),
(2, 11, 25),
(3, 12, 25),
(4, 13, 29),
(5, 14, 34),
(6, 15, 38);

-- --------------------------------------------------------

--
-- Structure de la table `relation_piece_cemac`
--

CREATE TABLE `relation_piece_cemac` (
  `id_relation_piece_cemac` int(11) NOT NULL,
  `id_piece` int(11) NOT NULL,
  `id_cemac` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `relation_piece_cemac`
--

INSERT INTO `relation_piece_cemac` (`id_relation_piece_cemac`, `id_piece`, `id_cemac`) VALUES
(1, 2, 4),
(2, 3, 5),
(3, 1, 6),
(4, 5, 7),
(5, 2, 8),
(6, 2, 9),
(7, 8, 10),
(8, 9, 11),
(9, 9, 12);

-- --------------------------------------------------------

--
-- Structure de la table `relation_utilisateur_qr`
--

CREATE TABLE `relation_utilisateur_qr` (
  `id_relation_utilisateur_qr` int(11) NOT NULL,
  `id_qr` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_equipement`
--

CREATE TABLE `type_equipement` (
  `id_type_equipement` int(11) NOT NULL,
  `nom_type_equipement` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_equipement`
--

INSERT INTO `type_equipement` (`id_type_equipement`, `nom_type_equipement`) VALUES
(1, 'temperature'),
(2, 'humidite'),
(3, 'ouverture');

-- --------------------------------------------------------

--
-- Structure de la table `type_qr`
--

CREATE TABLE `type_qr` (
  `id_type_qr` int(11) NOT NULL,
  `nom_type_qr` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `id_type_utilisateur` int(11) NOT NULL,
  `nom_type_utilisateur` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`id_type_utilisateur`, `nom_type_utilisateur`) VALUES
(1, 'admin'),
(2, 'support'),
(3, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_type_utilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login`, `password`, `id_type_utilisateur`) VALUES
(1, 'titou', 'groupe4b', 1),
(31, 'Aenerya', 'lapinous01', 3),
(25, 'nath', 'titounat', 3),
(29, 'bouny', 'bouny', 3),
(32, 'Rémus', 'erenouvelle1', 3),
(33, 'EloOkami', 'piano12', 3),
(34, 'BOB', 'bob', 3),
(35, 'Louiszeboss', 'nounours', 3),
(36, 'Matt', 'matt', 3),
(37, 'flore', 'flore', 3),
(38, 'Pierroti', 'coucoucou', 3);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cemac`
--
ALTER TABLE `cemac`
  ADD PRIMARY KEY (`id_cemac`);

--
-- Index pour la table `consigne`
--
ALTER TABLE `consigne`
  ADD PRIMARY KEY (`id_consigne`);

--
-- Index pour la table `donnees_equipement`
--
ALTER TABLE `donnees_equipement`
  ADD PRIMARY KEY (`id_donnees_equipement`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id_equipement`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_groupe`);

--
-- Index pour la table `info_utilisateur`
--
ALTER TABLE `info_utilisateur`
  ADD PRIMARY KEY (`id_info_utilisateur`);

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`);

--
-- Index pour la table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`id_piece`);

--
-- Index pour la table `qr`
--
ALTER TABLE `qr`
  ADD PRIMARY KEY (`id_qr`);

--
-- Index pour la table `relation_groupe_utilisateur`
--
ALTER TABLE `relation_groupe_utilisateur`
  ADD PRIMARY KEY (`id_relation_groupe_utilisateur`);

--
-- Index pour la table `relation_logement_utilisateur`
--
ALTER TABLE `relation_logement_utilisateur`
  ADD PRIMARY KEY (`id_relation_logement_utilisateur`);

--
-- Index pour la table `relation_piece_cemac`
--
ALTER TABLE `relation_piece_cemac`
  ADD PRIMARY KEY (`id_relation_piece_cemac`);

--
-- Index pour la table `relation_utilisateur_qr`
--
ALTER TABLE `relation_utilisateur_qr`
  ADD PRIMARY KEY (`id_relation_utilisateur_qr`);

--
-- Index pour la table `type_equipement`
--
ALTER TABLE `type_equipement`
  ADD PRIMARY KEY (`id_type_equipement`);

--
-- Index pour la table `type_qr`
--
ALTER TABLE `type_qr`
  ADD PRIMARY KEY (`id_type_qr`);

--
-- Index pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`id_type_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cemac`
--
ALTER TABLE `cemac`
  MODIFY `id_cemac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `consigne`
--
ALTER TABLE `consigne`
  MODIFY `id_consigne` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `donnees_equipement`
--
ALTER TABLE `donnees_equipement`
  MODIFY `id_donnees_equipement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id_equipement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_utilisateur`
--
ALTER TABLE `info_utilisateur`
  MODIFY `id_info_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `piece`
--
ALTER TABLE `piece`
  MODIFY `id_piece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `qr`
--
ALTER TABLE `qr`
  MODIFY `id_qr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `relation_groupe_utilisateur`
--
ALTER TABLE `relation_groupe_utilisateur`
  MODIFY `id_relation_groupe_utilisateur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `relation_logement_utilisateur`
--
ALTER TABLE `relation_logement_utilisateur`
  MODIFY `id_relation_logement_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `relation_piece_cemac`
--
ALTER TABLE `relation_piece_cemac`
  MODIFY `id_relation_piece_cemac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `relation_utilisateur_qr`
--
ALTER TABLE `relation_utilisateur_qr`
  MODIFY `id_relation_utilisateur_qr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type_equipement`
--
ALTER TABLE `type_equipement`
  MODIFY `id_type_equipement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `type_qr`
--
ALTER TABLE `type_qr`
  MODIFY `id_type_qr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `id_type_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
