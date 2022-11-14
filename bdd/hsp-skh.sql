-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 oct. 2022 à 21:32
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hsp-skh`
--

-- --------------------------------------------------------

--
-- Structure de la table `amphitheatre`
--

DROP TABLE IF EXISTS `amphitheatre`;
CREATE TABLE IF NOT EXISTS `amphitheatre` (
  `id_amphitheatre` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(500) NOT NULL,
  `nb_places` int(11) NOT NULL,
  PRIMARY KEY (`id_amphitheatre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `conference`
--

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `id_conference` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date_conf` date NOT NULL,
  `heure` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `valider` tinyint(1) NOT NULL,
  `ref_amphitheatre` int(11) NOT NULL,
  PRIMARY KEY (`id_conference`),
  KEY `ref_amphitheatre` (`ref_amphitheatre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ref_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `domaine` varchar(100) NOT NULL,
  PRIMARY KEY (`ref_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`ref_utilisateur`, `domaine`) VALUES
(1, 'DG');

-- --------------------------------------------------------

--
-- Structure de la table `hopital`
--

DROP TABLE IF EXISTS `hopital`;
CREATE TABLE IF NOT EXISTS `hopital` (
  `id_hopital` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `rue` varchar(100) NOT NULL,
  `cp` int(11) NOT NULL,
  PRIMARY KEY (`id_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `hopital`
--

INSERT INTO `hopital` (`id_hopital`, `nom`, `rue`, `cp`) VALUES
(1, 'Hopital de Paris', '4 rue de la Paix', 75000);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

DROP TABLE IF EXISTS `inscrit`;
CREATE TABLE IF NOT EXISTS `inscrit` (
  `ref_etudiant` int(11) NOT NULL,
  `ref_conference` int(11) NOT NULL,
  KEY `ref_conference` (`ref_conference`),
  KEY `ref_etudiant` (`ref_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `date_log` date NOT NULL,
  `heure` int(11) NOT NULL,
  `ref_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `ref_utilisateur` (`ref_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id_offre` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `organise`
--

DROP TABLE IF EXISTS `organise`;
CREATE TABLE IF NOT EXISTS `organise` (
  `ref_etudiant` int(11) NOT NULL,
  `ref_conference` int(11) NOT NULL,
  KEY `ref_conference` (`ref_conference`),
  KEY `ref_etudiant` (`ref_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `planifier`
--

DROP TABLE IF EXISTS `planifier`;
CREATE TABLE IF NOT EXISTS `planifier` (
  `ref_representant` int(11) NOT NULL,
  `ref_conference` int(11) NOT NULL,
  KEY `ref_conference` (`ref_conference`),
  KEY `ref_representant` (`ref_representant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `postule`
--

DROP TABLE IF EXISTS `postule`;
CREATE TABLE IF NOT EXISTS `postule` (
  `ref_etudiant` int(11) NOT NULL,
  `ref_offre` int(11) NOT NULL,
  KEY `ref_etudiant` (`ref_etudiant`),
  KEY `ref_offre` (`ref_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id_rdv` int(11) NOT NULL AUTO_INCREMENT,
  `date_rdv` date NOT NULL,
  `heure` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `ref_etudiant` int(11) NOT NULL,
  `ref_representant` int(11) NOT NULL,
  `ref_offre` int(11) NOT NULL,
  PRIMARY KEY (`id_rdv`),
  KEY `ref_etudiant` (`ref_etudiant`),
  KEY `ref_offre` (`ref_offre`),
  KEY `ref_representant` (`ref_representant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `representant`
--

DROP TABLE IF EXISTS `representant`;
CREATE TABLE IF NOT EXISTS `representant` (
  `ref_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  `ref_hopital` int(11) NOT NULL,
  PRIMARY KEY (`ref_utilisateur`),
  KEY `ref_hopital` (`ref_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(500) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `mdp`, `admin`, `actif`) VALUES
(1, 'Lopes', 'Hugo', 'hugo.lop2304@gmail.com', 'a', 0, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD CONSTRAINT `inscrit_ibfk_1` FOREIGN KEY (`ref_conference`) REFERENCES `conference` (`id_conference`),
  ADD CONSTRAINT `inscrit_ibfk_2` FOREIGN KEY (`ref_etudiant`) REFERENCES `etudiant` (`ref_utilisateur`);

--
-- Contraintes pour la table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `organise`
--
ALTER TABLE `organise`
  ADD CONSTRAINT `organise_ibfk_1` FOREIGN KEY (`ref_conference`) REFERENCES `conference` (`id_conference`),
  ADD CONSTRAINT `organise_ibfk_2` FOREIGN KEY (`ref_etudiant`) REFERENCES `etudiant` (`ref_utilisateur`);

--
-- Contraintes pour la table `planifier`
--
ALTER TABLE `planifier`
  ADD CONSTRAINT `planifier_ibfk_1` FOREIGN KEY (`ref_conference`) REFERENCES `conference` (`id_conference`),
  ADD CONSTRAINT `planifier_ibfk_2` FOREIGN KEY (`ref_representant`) REFERENCES `representant` (`ref_utilisateur`);

--
-- Contraintes pour la table `postule`
--
ALTER TABLE `postule`
  ADD CONSTRAINT `postule_ibfk_1` FOREIGN KEY (`ref_etudiant`) REFERENCES `etudiant` (`ref_utilisateur`),
  ADD CONSTRAINT `postule_ibfk_2` FOREIGN KEY (`ref_offre`) REFERENCES `offre` (`id_offre`);

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`ref_etudiant`) REFERENCES `etudiant` (`ref_utilisateur`),
  ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`ref_offre`) REFERENCES `offre` (`id_offre`),
  ADD CONSTRAINT `rdv_ibfk_3` FOREIGN KEY (`ref_representant`) REFERENCES `representant` (`ref_utilisateur`);

--
-- Contraintes pour la table `representant`
--
ALTER TABLE `representant`
  ADD CONSTRAINT `representant_ibfk_1` FOREIGN KEY (`ref_hopital`) REFERENCES `hopital` (`id_hopital`),
  ADD CONSTRAINT `representant_ibfk_2` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
