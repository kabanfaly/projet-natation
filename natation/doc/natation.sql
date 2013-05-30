-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 30 Mai 2013 à 04:11
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idcategorie` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

DROP TABLE IF EXISTS `competition`;
CREATE TABLE IF NOT EXISTS `competition` (
  `idcompetition` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(11) NOT NULL,
  `idnageur` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  PRIMARY KEY (`idcompetition`),
  KEY `fk_competition_nageur1_idx` (`idnageur`),
  KEY `fk_competition_epreuve1_idx` (`idepreuve`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
  `idcategorie` int(11) NOT NULL,
  PRIMARY KEY (`idnageur`),
  KEY `idcategorie` (`idcategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `performance`
--

DROP TABLE IF EXISTS `performance`;
CREATE TABLE IF NOT EXISTS `performance` (
  `idperformance` int(11) NOT NULL AUTO_INCREMENT,
  `points` int(11) DEFAULT NULL,
  `temps` varchar(45) NOT NULL,
  `idnageur` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  PRIMARY KEY (`idperformance`),
  KEY `fk_performance_nageur1_idx` (`idnageur`),
  KEY `fk_performance_epreuve1_idx` (`idepreuve`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_de_nage`
--

DROP TABLE IF EXISTS `type_de_nage`;
CREATE TABLE IF NOT EXISTS `type_de_nage` (
  `idtype_de_nage` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idtype_de_nage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `competition_ibfk_8` FOREIGN KEY (`idnageur`) REFERENCES `nageur` (`idnageur`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `competition_ibfk_9` FOREIGN KEY (`idepreuve`) REFERENCES `epreuve` (`idepreuve`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `epreuve`
--
ALTER TABLE `epreuve`
  ADD CONSTRAINT `epreuve_ibfk_3` FOREIGN KEY (`idtype_de_nage`) REFERENCES `type_de_nage` (`idtype_de_nage`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `nageur`
--
ALTER TABLE `nageur`
  ADD CONSTRAINT `nageur_ibfk_1` FOREIGN KEY (`idcategorie`) REFERENCES `categorie` (`idcategorie`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `performance_ibfk_5` FOREIGN KEY (`idnageur`) REFERENCES `nageur` (`idnageur`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `performance_ibfk_6` FOREIGN KEY (`idepreuve`) REFERENCES `epreuve` (`idepreuve`) ON DELETE CASCADE ON UPDATE NO ACTION;
