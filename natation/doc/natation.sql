-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Dim 12 Mai 2013 à 21:12
-- Version du serveur: 5.5.31
-- Version de PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `natation`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `mot_de_passe` varchar(45) NOT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_maitre`
--

DROP TABLE IF EXISTS `categorie_maitre`;
CREATE TABLE IF NOT EXISTS `categorie_maitre` (
  `idcategorie_maitre` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategorie_maitre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

DROP TABLE IF EXISTS `competition`;
CREATE TABLE IF NOT EXISTS `competition` (
  `idcompetition` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(11) NOT NULL,
  `idcategorie_maitre` int(11) NOT NULL,
  `idnageur` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  PRIMARY KEY (`idcompetition`),
  KEY `fk_competition_categorie_maitre1_idx` (`idcategorie_maitre`),
  KEY `fk_competition_nageur1_idx` (`idnageur`),
  KEY `fk_competition_epreuve1_idx` (`idepreuve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

DROP TABLE IF EXISTS `epreuve`;
CREATE TABLE IF NOT EXISTS `epreuve` (
  `idepreuve` int(11) NOT NULL AUTO_INCREMENT,
  `idtype_de_nage` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  PRIMARY KEY (`idepreuve`),
  KEY `fk_epreuve_type_de_nage_idx` (`idtype_de_nage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `nageur`
--

DROP TABLE IF EXISTS `nageur`;
CREATE TABLE IF NOT EXISTS `nageur` (
  `idnageur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `sexe` varchar(45) NOT NULL,
  `groupe` varchar(45) NOT NULL,
  PRIMARY KEY (`idnageur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `nageur`
--

INSERT INTO `nageur` (`idnageur`, `nom`, `prenom`, `date_de_naissance`, `sexe`, `groupe`) VALUES
(2, 'Test', 'test', '1234-12-20', 'M', 'Seniors'),
(3, 'Test', 'test', '1234-12-20', 'F', 'Seniors'),
(4, 'Tests', 'test', '1234-12-20', 'M', 'Seniors'),
(5, 'Tes', 'test', '1234-12-20', 'M', 'Seniors'),
(6, 'Test', 'test', '0000-00-00', 'M', 'Seniors'),
(7, 'Test', 'test', '1235-12-20', 'M', 'Seniors');

-- --------------------------------------------------------

--
-- Structure de la table `performance`
--

DROP TABLE IF EXISTS `performance`;
CREATE TABLE IF NOT EXISTS `performance` (
  `idperformance` int(11) NOT NULL AUTO_INCREMENT,
  `points` int(11) DEFAULT NULL,
  `temps` time DEFAULT NULL,
  `idnageur` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  PRIMARY KEY (`idperformance`),
  KEY `fk_performance_nageur1_idx` (`idnageur`),
  KEY `fk_performance_epreuve1_idx` (`idepreuve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_de_nage`
--

DROP TABLE IF EXISTS `type_de_nage`;
CREATE TABLE IF NOT EXISTS `type_de_nage` (
  `idtype_de_nage` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idtype_de_nage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `competition_ibfk_1` FOREIGN KEY (`idcategorie_maitre`) REFERENCES `categorie_maitre` (`idcategorie_maitre`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `competition_ibfk_2` FOREIGN KEY (`idnageur`) REFERENCES `nageur` (`idnageur`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `competition_ibfk_3` FOREIGN KEY (`idepreuve`) REFERENCES `epreuve` (`idepreuve`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `epreuve`
--
ALTER TABLE `epreuve`
  ADD CONSTRAINT `epreuve_ibfk_1` FOREIGN KEY (`idtype_de_nage`) REFERENCES `type_de_nage` (`idtype_de_nage`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `performance_ibfk_1` FOREIGN KEY (`idnageur`) REFERENCES `nageur` (`idnageur`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `performance_ibfk_2` FOREIGN KEY (`idepreuve`) REFERENCES `epreuve` (`idepreuve`) ON DELETE CASCADE ON UPDATE NO ACTION;
