-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 14 avr. 2021 à 07:51
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `petite_annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `password_admin` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Déchargement des données de la table `administration`
--

INSERT INTO `administration` (`id_admin`, `email_admin`, `password_admin`) VALUES
(1, 'admin@admin.com', 'azerty'),
(2, 'admin@admin.fr', 'azerty');

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id_annonce` int NOT NULL AUTO_INCREMENT,
  `nom_annonce` varchar(225) NOT NULL,
  `description_annonce` text NOT NULL,
  `prix_annonce` decimal(10,0) NOT NULL,
  `photo_annonce` varchar(255) NOT NULL,
  `date_depot` datetime NOT NULL,
  `categorie_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `regions_id` int NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `Id de la catégorie` (`categorie_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `regions_id` (`regions_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `nom_annonce`, `description_annonce`, `prix_annonce`, `photo_annonce`, `date_depot`, `categorie_id`, `utilisateur_id`, `regions_id`) VALUES
(1, 'cadre', 'cadre 145\"', '2000', 'https://data.pixiz.com/output/user/frame/preview/400x400/5/4/6/5/2285645_9da1e.jpg', '2021-04-07 10:50:07', 8, 1, 1),
(3, 'chocolat', 'œuvre d\'art', '50000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMtFnM3qElXtgPsUfR0x-YqNrwk6ZEfaimNg&usqp=CAU', '2021-04-09 11:19:19', 8, 3, 3),
(5, 'chocolat', 'œuvre d\'art', '50000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMtFnM3qElXtgPsUfR0x-YqNrwk6ZEfaimNg&usqp=CAU', '2021-04-09 11:19:19', 8, 3, 5),
(6, 'portable a chier', 'portable a chier qui n\'a plus de battrie, ni d\'ecran, ni de prise de chargement', '3000', 'https://www.ducatillon.com/upload/referentiel/26582/289.6147-5.jpg', '2021-04-09 11:19:19', 1, 4, 10),
(7, 'chocolat', 'œuvre d\'art', '50000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMtFnM3qElXtgPsUfR0x-YqNrwk6ZEfaimNg&usqp=CAU', '2021-04-09 11:19:19', 8, 3, 5),
(8, 'portable a chier', 'portable a chier qui n\'a plus de battrie, ni d\'ecran, ni de prise de chargement', '3000', 'https://www.ducatillon.com/upload/referentiel/26582/289.6147-5.jpg', '2021-04-09 11:19:19', 1, 4, 6),
(9, 'chocolat', 'œuvre d\'art', '50000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMtFnM3qElXtgPsUfR0x-YqNrwk6ZEfaimNg&usqp=CAU', '2021-04-09 11:19:19', 8, 3, 4),
(10, 'portable potable', 'potepote', '1576', '../public/img/kineti11.jpg', '2021-04-13 00:00:00', 2, 4, 7),
(11, 'chocolat', 'œuvre d\'art', '50000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMtFnM3qElXtgPsUfR0x-YqNrwk6ZEfaimNg&usqp=CAU', '2021-04-09 11:19:19', 8, 3, 13),
(12, 'portable a chier', 'portable a chier qui n\'a plus de battrie, ni d\'ecran, ni de prise de chargement', '3000', 'https://www.ducatillon.com/upload/referentiel/26582/289.6147-5.jpg', '2021-04-09 11:19:19', 1, 4, 11),
(13, 'chocolat', 'œuvre d\'art', '50000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMtFnM3qElXtgPsUfR0x-YqNrwk6ZEfaimNg&usqp=CAU', '2021-04-09 11:19:19', 8, 3, 13),
(14, 'portable a chier', 'portable a chier qui n\'a plus de battrie, ni d\'ecran, ni de prise de chargement', '3000', 'https://www.ducatillon.com/upload/referentiel/26582/289.6147-5.jpg', '2021-04-09 11:19:19', 1, 4, 11),
(15, 'chocolat', 'œuvre d\'art', '50000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMtFnM3qElXtgPsUfR0x-YqNrwk6ZEfaimNg&usqp=CAU', '2021-04-09 11:19:19', 8, 3, 13),
(16, 'pompe a p*****s', 'pour faire gonfler votre engin', '42596', '../public/img/pompe.jpg', '2021-04-13 00:00:00', 1, 4, 11),
(17, 'pif', 'au pif', '4865682', '../public/img/TrainHeartnet.jpg', '2021-04-14 00:00:00', 3, 1, 12);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `type_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `type_categorie`) VALUES
(1, 'Multimedias'),
(2, 'Electro-menager'),
(3, 'Meubles'),
(4, 'Véhicules'),
(5, 'Modes'),
(6, 'Divers'),
(7, 'immobilier'),
(8, 'livre/Art');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id_regions` int NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(255) NOT NULL,
  PRIMARY KEY (`id_regions`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id_regions`, `nom_region`) VALUES
(1, 'grand_est'),
(2, 'aquitaine'),
(3, 'ra_auvergne'),
(4, 'normandie'),
(5, 'bourgogne_fc'),
(6, 'bretagne'),
(7, 'centre'),
(8, 'corse'),
(9, 'ile_france'),
(10, 'occitanie'),
(11, 'haut_france'),
(12, 'pays_loire'),
(13, 'paca');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(255) NOT NULL,
  `email_utilisateur` varchar(255) NOT NULL,
  `password_utilisateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `email_utilisateur`, `password_utilisateur`) VALUES
(1, 'vendeur1', 'vendeur1@hotmail.fr', 'azerty'),
(2, 'vendeur2', 'vendeur2@hotmail.fr', 'azerty'),
(3, 'testvendeur', 'testvendeur@test.com', 'azerty'),
(4, 'testvendeur2', 'testvendeur2@test2.fr', 'azerty'),
(11, 'nouveau', 'vendeur3@vendeur.fr', 'azerty'),
(12, 'nouveau', 'vendeur3@vendeur.fr', 'azerty');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `annonces_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `annonces_ibfk_3` FOREIGN KEY (`regions_id`) REFERENCES `regions` (`id_regions`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
