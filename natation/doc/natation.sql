SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `mot_de_passe` varchar(45) NOT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `administrateur` (`idadmin`, `login`, `mot_de_passe`) VALUES
(1, 'admin', 'admin');

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idcategorie` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO `categorie` (`idcategorie`, `categorie`, `description`) VALUES
(1, 'Avenirs', '2004 et apr&Atilde;&uml;s'),
(2, 'Poussins', '2002 2003'),
(3, 'Benjamins', '2000 2001'),
(4, 'Minimes', '1998 1999'),
(5, 'Cadets', '1996 1997'),
(6, 'Junior', '1993 1994 1995'),
(7, 'Seniors', '1992 et avant'),
(8, 'C1', '25 &Atilde;&nbsp; 29 ans'),
(9, 'C2', '30 &Atilde;&nbsp; 35');

DROP TABLE IF EXISTS `competition`;
CREATE TABLE IF NOT EXISTS `competition` (
  `idcompetition` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(11) NOT NULL,
  `idnageur` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  PRIMARY KEY (`idcompetition`),
  KEY `fk_competition_nageur1_idx` (`idnageur`),
  KEY `fk_competition_epreuve1_idx` (`idepreuve`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `competition` (`idcompetition`, `annee`, `idnageur`, `idepreuve`) VALUES
(1, 2013, 1, 1),
(2, 2013, 2, 3);

DROP TABLE IF EXISTS `epreuve`;
CREATE TABLE IF NOT EXISTS `epreuve` (
  `idepreuve` int(11) NOT NULL AUTO_INCREMENT,
  `idtype_de_nage` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  PRIMARY KEY (`idepreuve`),
  KEY `fk_epreuve_type_de_nage_idx` (`idtype_de_nage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `epreuve` (`idepreuve`, `idtype_de_nage`, `distance`) VALUES
(1, 1, 100),
(2, 1, 50),
(3, 2, 100),
(4, 2, 50),
(5, 3, 100),
(6, 3, 150);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `nageur` (`idnageur`, `nom`, `prenom`, `date_de_naissance`, `sexe`, `idcategorie`) VALUES
(1, 'KABA', 'N''faly', '1984-12-20', 'M', 7),
(2, 'KABA', 'Mamady', '1985-12-20', 'M', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO `performance` (`idperformance`, `points`, `temps`, `idnageur`, `idepreuve`, `annee`) VALUES
(1, 123, '44.26', 1, 1, 2012),
(2, 123, '51.67', 1, 1, 2012),
(3, 123, '52.00', 1, 1, 2012),
(4, 1, '49.79', 1, 2, 2012),
(5, 1, '53.88', 1, 2, 2012),
(6, 2, '54.10', 1, 2, 2012),
(7, 3, '47.76', 1, 2, 2012),
(8, 2, '44.30', 1, 1, 2012),
(9, 23, '44.26', 2, 2, 2013);

DROP TABLE IF EXISTS `type_de_nage`;
CREATE TABLE IF NOT EXISTS `type_de_nage` (
  `idtype_de_nage` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idtype_de_nage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `type_de_nage` (`idtype_de_nage`, `type`) VALUES
(1, 'Brasse'),
(2, 'Crawl'),
(3, 'Papillon');


ALTER TABLE `competition`
  ADD CONSTRAINT `competition_ibfk_8` FOREIGN KEY (`idnageur`) REFERENCES `nageur` (`idnageur`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `competition_ibfk_9` FOREIGN KEY (`idepreuve`) REFERENCES `epreuve` (`idepreuve`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `epreuve`
  ADD CONSTRAINT `epreuve_ibfk_3` FOREIGN KEY (`idtype_de_nage`) REFERENCES `type_de_nage` (`idtype_de_nage`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `nageur`
  ADD CONSTRAINT `nageur_ibfk_1` FOREIGN KEY (`idcategorie`) REFERENCES `categorie` (`idcategorie`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `performance`
  ADD CONSTRAINT `performance_ibfk_5` FOREIGN KEY (`idnageur`) REFERENCES `nageur` (`idnageur`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `performance_ibfk_6` FOREIGN KEY (`idepreuve`) REFERENCES `epreuve` (`idepreuve`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;