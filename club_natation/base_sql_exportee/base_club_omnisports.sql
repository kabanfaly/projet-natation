-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 21 Mai 2013 à 15:33
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `base club omnisports`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `sexe` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`, `description`, `sexe`) VALUES
(1, 'Avenirs', '2004 et après', '''Homme'' OR ''Femme'''),
(2, 'Poussins', '2002 et 2003', '''Homme'' OR ''Femme'''),
(3, 'Benjamins', '2000 et 2001', '''Homme'' OR ''Femme'''),
(4, 'Minimes', '1998 et 1999', '''Homme'' OR ''Femme'''),
(5, 'Cadets', '1996 et 1997', '''Homme'' OR ''Femme'''),
(6, 'Juniors', '1993, 1994 et 1995', '''Homme'' OR ''Femme'''),
(7, 'Seniors', '1992 et avant', '''Homme'' OR ''Femme''');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_maitre`
--

CREATE TABLE IF NOT EXISTS `categorie_maitre` (
  `id_categ_maitre` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categ_maitre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `sexe` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categ_maitre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `categorie_maitre`
--

INSERT INTO `categorie_maitre` (`id_categ_maitre`, `nom_categ_maitre`, `description`, `sexe`) VALUES
(1, 'C1', '25 à 29 ans', '''Homme'' OR ''Femme'''),
(2, 'C2', '30 à 34 ans', '''Homme'' OR ''Femme'''),
(3, 'C3', '35 à 39 ans', '''Homme'' OR ''Femme'),
(4, 'C4', '40 à 44 ans', '''Homme'' OR ''Femme'),
(5, 'C5', '45 à 49 ans', '''Homme'' OR ''Femme'''),
(6, 'C6', '50 à 54 ans', '''Homme'' OR ''Femme'),
(7, 'C7', '55 à 59 ans', '''Homme'' OR ''Femme'),
(8, 'C8', '60 à 64 ans', '''Homme'' OR ''Femme'),
(9, 'C9', '65 à 69 ans', '''Homme'' OR ''Femme'''),
(10, 'C10', '70 ans et plus', '''Homme'' OR ''Femme''');

-- --------------------------------------------------------

--
-- Structure de la table `chrono`
--

CREATE TABLE IF NOT EXISTS `chrono` (
  `Num_detail_perf` int(11) NOT NULL AUTO_INCREMENT,
  `num_perf` int(11) NOT NULL,
  `temps_total` time NOT NULL,
  PRIMARY KEY (`Num_detail_perf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

CREATE TABLE IF NOT EXISTS `epreuve` (
  `id_epreuve` int(11) NOT NULL AUTO_INCREMENT,
  `type_epreuve` varchar(50) NOT NULL,
  `distance_epreuve` int(11) NOT NULL,
  PRIMARY KEY (`id_epreuve`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `epreuve`
--

INSERT INTO `epreuve` (`id_epreuve`, `type_epreuve`, `distance_epreuve`) VALUES
(1, 'Nages libres', 50),
(2, 'Nages libres', 100),
(3, 'Nages libres', 200),
(4, 'Nages libres', 400),
(5, 'Nages libres', 800),
(6, 'Nages libres', 1500),
(7, 'Brasses', 50),
(8, 'Brasses', 100),
(9, 'Brasses', 200),
(10, 'Dos', 50),
(11, 'Dos', 100),
(12, 'Dos', 200),
(13, 'Papillon', 50),
(14, 'Papillon', 100),
(15, 'Papillon', 200),
(16, '4 nages (4N)', 100),
(17, '4 nages (4N)', 200),
(18, '4 nages (4N)', 400);

-- --------------------------------------------------------

--
-- Structure de la table `nageur`
--

CREATE TABLE IF NOT EXISTS `nageur` (
  `id_nageur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_nageur` varchar(50) NOT NULL,
  `prenom_nageur` varchar(50) NOT NULL,
  `sexe` varchar(50) NOT NULL,
  `annee_naissance` date NOT NULL,
  `age` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_categorie_maitre` int(11) NOT NULL,
  `club` varchar(50) NOT NULL,
  PRIMARY KEY (`id_nageur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `nageur`
--

INSERT INTO `nageur` (`id_nageur`, `nom_nageur`, `prenom_nageur`, `sexe`, `annee_naissance`, `age`, `id_categorie`, `id_categorie_maitre`, `club`) VALUES
(1, 'COULOT', 'Christian', 'Homme', '0000-00-00', 0, 0, 2, 'CO Vernouillet');

-- --------------------------------------------------------

--
-- Structure de la table `performance`
--

CREATE TABLE IF NOT EXISTS `performance` (
  `Num_perf` int(11) NOT NULL AUTO_INCREMENT,
  `id_nageur` int(11) NOT NULL,
  `id_epreuve` int(11) NOT NULL,
  `saison` year(4) NOT NULL,
  `date_perf` date NOT NULL,
  `temps_total` time NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`Num_perf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `performance`
--

INSERT INTO `performance` (`Num_perf`, `id_nageur`, `id_epreuve`, `saison`, `date_perf`, `temps_total`, `points`) VALUES
(1, 1, 0, 0000, '0000-00-00', '00:06:37', 423),
(2, 0, 0, 0000, '0000-00-00', '00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
