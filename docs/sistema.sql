-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 03 Mars 2014 à 18:25
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sistema`
--
CREATE DATABASE IF NOT EXISTS `sistema` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sistema`;

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE IF NOT EXISTS `adherent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `promo` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `adherent`
--

INSERT INTO `adherent` (`id`, `nom`, `prenom`, `promo`) VALUES
(7, 'Venuzzi', 'Franck', 'L3I'),
(8, 'Dubois', 'Emilie', 'L3I'),
(9, 'LeComte', 'Pierre', 'L3I');

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `prenom`) VALUES
(1, 'Baldwin', 'Alec'),
(2, 'Connor', 'John'),
(3, 'LaForge', 'George');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raisonSociale` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id`, `raisonSociale`) VALUES
(4, 'International Corporation'),
(5, 'Supply Fly'),
(6, 'Viva Fiesta');

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE IF NOT EXISTS `competences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(48) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detenir`
--

CREATE TABLE IF NOT EXISTS `detenir` (
  `user` int(11) NOT NULL,
  `competence` int(11) NOT NULL,
  PRIMARY KEY (`user`,`competence`),
  KEY `competence` (`competence`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE IF NOT EXISTS `fichiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(128) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `type` varchar(48) NOT NULL,
  `projet` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projet` (`projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `incidents`
--

CREATE TABLE IF NOT EXISTS `incidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `projet` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projet` (`projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `type` varchar(48) NOT NULL,
  `date` datetime NOT NULL,
  `element` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login` varchar(48) NOT NULL,
  `mdp` varchar(48) NOT NULL,
  `type` char(1) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`login`),
  KEY `id` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `login`
--

INSERT INTO `login` (`login`, `mdp`, `type`, `user`) VALUES
('admin1', 'admin1', 'A', 1),
('edubois', 'edubois', 'E', 8),
('fvenuzzi', 'fvenuzzi', 'E', 7),
('intcorp', 'intcorp', 'C', 4),
('plecomte', 'plecomte', 'E', 9),
('sistemator', 'sistemator', 'A', 2),
('supfly', 'supfly', 'C', 5),
('techo', 'techo', 'A', 3),
('vivafiesta', 'vivafiesta', 'C', 6);

-- --------------------------------------------------------

--
-- Structure de la table `necessite`
--

CREATE TABLE IF NOT EXISTS `necessite` (
  `projet` int(11) NOT NULL,
  `competence` int(11) NOT NULL,
  PRIMARY KEY (`projet`,`competence`),
  KEY `competence` (`competence`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE IF NOT EXISTS `participer` (
  `user` int(11) NOT NULL,
  `projet` int(11) NOT NULL,
  `chefProjet` tinyint(1) NOT NULL DEFAULT 0,
  `status` char(1) NOT NULL DEFAULT 'N',  -- A - affecté / N - non afffecté / T - terminé --
  PRIMARY KEY (`user`,`projet`),
  KEY `projet` (`projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participer`
--

INSERT INTO `participer` (`user`, `projet`,  `chefProjet`,  `status`) VALUES
(8, 1, 0, 'A'),
(9, 1, 0, 'A'),
(7, 1, 1, 'O');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(128) NOT NULL,
  `description` text,
  `type` varchar(128) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '',
  `client` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`titre`, `description`, `type`, `client`) VALUES
('site Viva Fiesta', 'Développer le site vitrine du magasin Viva Fiesta. (fake)', 'Web', 6);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` char(10) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(48) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `telephone`, `mail`, `adresse`, `codePostal`, `ville`, `actif`) VALUES
(1, '0102030405', 'admin1@sistema.fr', '26 rue de la paix', '13006', 'Marseille', 1),
(2, '0203040506', 'sistemator@sistema.fr', '56 avenue des braves', '13005', 'Marseille', 1),
(3, '0304050607', 'techo@sistema.fr', '48 une rue au fond à droite', '13112', 'Aix En Provence', 1),
(4, '0405060708', 'corpo.contact@corpo.fr', 'une autre rue', '13005', 'Marseille', 1),
(5, '0506070809', 'contact.supplyFly@suppyF.fr', 'ha, une avenue !', '13115', 'Aix En Provence', 1),
(6, '0607080909', 'vivaFiesta@gmail.fr', '42 Cours Mirabeau', '13006', 'Marseille', 1),
(7, '0708090909', 'franck.venuzzi@gmail.fr', 'ho, une impasse', '13556', 'Marignane', 0),
(8, '0809090909', 'emilie.dubois@yahoo.fr', 'inconnue', '13112', 'Aix-En-Provence', 1),
(9, '0909090909', 'lecomte@gmail.com', 'Au dessus du kebab', '13006', 'Marseille', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `adherent_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `detenir`
--
ALTER TABLE `detenir`
  ADD CONSTRAINT `detenir_ibfk_1` FOREIGN KEY (`user`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `detenir_ibfk_2` FOREIGN KEY (`competence`) REFERENCES `competences` (`id`);

--
-- Contraintes pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD CONSTRAINT `fichiers_ibfk_1` FOREIGN KEY (`projet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`projet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `necessite`
--
ALTER TABLE `necessite`
  ADD CONSTRAINT `necessite_ibfk_1` FOREIGN KEY (`projet`) REFERENCES `projet` (`id`),
  ADD CONSTRAINT `necessite_ibfk_2` FOREIGN KEY (`competence`) REFERENCES `competences` (`id`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`user`) REFERENCES `adherent` (`id`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`projet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
