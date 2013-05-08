-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 08 Mai 2013 à 16:55
-- Version du serveur: 5.5.31
-- Version de PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `natation`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_maitre`
--

DROP TABLE IF EXISTS `categorie_maitre`;
CREATE TABLE IF NOT EXISTS `categorie_maitre` (
  `idcategorie_maitre` int(11) NOT NULL,
  `categorie` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategorie_maitre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

DROP TABLE IF EXISTS `competition`;
CREATE TABLE IF NOT EXISTS `competition` (
  `idcompetition` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `idcategorie_maitre` int(11) NOT NULL,
  `idnageur` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  PRIMARY KEY (`idcompetition`),
  KEY `fk_competition_categorie_maitre1_idx` (`idcategorie_maitre`),
  KEY `fk_competition_nageur1_idx` (`idnageur`),
  KEY `fk_competition_epreuve1_idx` (`idepreuve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

DROP TABLE IF EXISTS `epreuve`;
CREATE TABLE IF NOT EXISTS `epreuve` (
  `idepreuve` int(11) NOT NULL,
  `idtype_de_nage` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  PRIMARY KEY (`idepreuve`),
  KEY `fk_epreuve_type_de_nage_idx` (`idtype_de_nage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `nageur`
--

DROP TABLE IF EXISTS `nageur`;
CREATE TABLE IF NOT EXISTS `nageur` (
  `idnageur` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `sexe` varchar(45) NOT NULL,
  `groupe` varchar(45) NOT NULL,
  PRIMARY KEY (`idnageur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performance`
--

DROP TABLE IF EXISTS `performance`;
CREATE TABLE IF NOT EXISTS `performance` (
  `idperformance` int(11) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `temps` time DEFAULT NULL,
  `idnageur` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  PRIMARY KEY (`idperformance`),
  KEY `fk_performance_nageur1_idx` (`idnageur`),
  KEY `fk_performance_epreuve1_idx` (`idepreuve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_de_nage`
--

DROP TABLE IF EXISTS `type_de_nage`;
CREATE TABLE IF NOT EXISTS `type_de_nage` (
  `idtype_de_nage` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idtype_de_nage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `competition_ibfk_3` FOREIGN KEY (`idepreuve`) REFERENCES `epreuve` (`idepreuve`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `competition_ibfk_1` FOREIGN KEY (`idcategorie_maitre`) REFERENCES `categorie_maitre` (`idcategorie_maitre`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `competition_ibfk_2` FOREIGN KEY (`idnageur`) REFERENCES `nageur` (`idnageur`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `epreuve`
--
ALTER TABLE `epreuve`
  ADD CONSTRAINT `epreuve_ibfk_1` FOREIGN KEY (`idtype_de_nage`) REFERENCES `type_de_nage` (`idtype_de_nage`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `performance_ibfk_2` FOREIGN KEY (`idepreuve`) REFERENCES `epreuve` (`idepreuve`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `performance_ibfk_1` FOREIGN KEY (`idnageur`) REFERENCES `nageur` (`idnageur`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;