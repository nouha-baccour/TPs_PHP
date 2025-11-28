-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 28 nov. 2025 à 10:29
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `magasin`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `code` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`code`, `nom`) VALUES
(1, 'Plantes d\'interieur'),
(2, 'Bouquet de fleurs');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `code` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `prix` float NOT NULL,
  `Qte` int NOT NULL,
  `image` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code_categorie` int NOT NULL,
  PRIMARY KEY (`code`),
  KEY `code_categorie` (`code_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`code`, `designation`, `prix`, `Qte`, `image`, `code_categorie`) VALUES
(27, 'Amaryllis', 23, 321, 'int2.jpg', 1),
(28, 'Trio de piments', 15, 2, 'int3.jpg', 1),
(29, 'Jardinière de campanules', 40, 15, 'int4.jpg', 1),
(30, 'Innocence', 50, 21, 'bouq1', 1),
(31, 'Opale', 43, 25, 'bouq2', 2),
(32, 'Roses tendresse\r\n', 52, 10, 'bouq3', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nom` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `prenom` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nom`, `prenom`) VALUES
(1, 'admin', 'admin', 'Mohamed', 'Tounsi'),
(3, 'nouha', 'nouha', 'Nouha', 'Baccour'),
(6, 'hghg', 'jkjhk', '', ''),
(7, 'rrr', 'rrr', '', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`code_categorie`) REFERENCES `categorie` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
