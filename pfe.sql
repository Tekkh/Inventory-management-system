-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 13 avr. 2019 à 16:05
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

CREATE TABLE `achat` (
  `code_achat` int(255) NOT NULL,
  `desc_achat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `tel` int(14) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `tel`, `username`, `password`) VALUES
(1, 'KHORB Tawfik', 766848452, 'TEK', 'TEK12345'),
(2, 'TALHA Elhassane', 624434911, 'Talha', 'hassan123');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `code_prod` int(50) DEFAULT NULL,
  `code_achat` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `deplacement`
--

CREATE TABLE `deplacement` (
  `code_dep` int(255) NOT NULL,
  `empl_org` varchar(255) DEFAULT NULL,
  `empl_des` varchar(255) DEFAULT NULL,
  `desc_dep` varchar(255) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `deplacement`
--

INSERT INTO `deplacement` (`code_dep`, `empl_org`, `empl_des`, `desc_dep`, `qte`) VALUES
(1, 'B2', 'C3', 'SSD dÃ©placement', 50),
(2, 'A3', 'C4', 'Xeon dÃ©placement', 100);

-- --------------------------------------------------------

--
-- Structure de la table `emplacement`
--

CREATE TABLE `emplacement` (
  `code_emp` varchar(255) NOT NULL,
  `desc_emp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplacement`
--

INSERT INTO `emplacement` (`code_emp`, `desc_emp`) VALUES
('A1', 'Rangee A'),
('A2', 'Rangee A'),
('A3', 'Rangee A'),
('A4', 'Rangee A'),
('A5', 'Rangee A'),
('A6', 'Rangee A'),
('A7', 'Rangee A'),
('B1', 'Rangee B'),
('B2', 'Rangee B'),
('B3', 'Rangee B'),
('B4', 'Rangee B'),
('B5', 'Rangee B'),
('B6', 'Rangee B'),
('B7', 'Rangee B'),
('C1', 'Rangee C'),
('C2', 'Rangee C'),
('C3', 'Rangee C'),
('C4', 'Rangee C'),
('C5', 'Rangee C'),
('C6', 'Rangee C'),
('C7', 'Rangee C');

-- --------------------------------------------------------

--
-- Structure de la table `inventaire`
--

CREATE TABLE `inventaire` (
  `code_inv` varchar(255) NOT NULL,
  `desc_inv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `code_prod` int(255) NOT NULL,
  `desc_prod` varchar(255) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `code_emp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`code_prod`, `desc_prod`, `qte`, `code_emp`) VALUES
(1001, 'Memoire RAM 8Go', 5000, 'A1'),
(1002, 'Memoire RAM 4Go', 7500, 'A2'),
(1003, 'Processeur Xeon 2.2G', 450, 'A3'),
(1004, 'Processeur HPE5 1.9G', 200, 'A4'),
(1005, 'Carte Graphique GTX 1080', 100, 'A5'),
(1006, 'Carte graphique GT710', 300, 'A6'),
(1007, 'Carte reseau T-WN78', 500, 'A7'),
(1008, 'Carte reseau AJ71A', 250, 'B1'),
(1009, 'Disque Dur SSD 500Go', 200, 'B2'),
(1010, 'Disque Dur HDD 1To', 3000, 'B3'),
(1011, 'Souris sans fil M18', 5000, 'B4'),
(1012, 'Souris sans fil H4', 5000, 'B5'),
(1013, 'Clavier sans fil K98', 2000, 'B6'),
(1014, 'Clavier AZERTY MK27', 4000, 'B7'),
(1015, 'Imprimante laser C11C', 700, 'C1'),
(1016, 'Imprimante Multifonctions PIX', 400, 'C2');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `tel` int(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `full_name`, `tel`, `username`, `password`) VALUES
(1, 'Tawfik', 674152367, 'Tek', '123456789'),
(2, 'Hassan', 624569874, 'Hassan', '123458hh'),
(3, 'Hamza', 624562589, 'MIRI', '12345678');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`code_achat`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD KEY `code_prod` (`code_prod`),
  ADD KEY `code_achat` (`code_achat`);

--
-- Index pour la table `deplacement`
--
ALTER TABLE `deplacement`
  ADD PRIMARY KEY (`code_dep`);

--
-- Index pour la table `emplacement`
--
ALTER TABLE `emplacement`
  ADD PRIMARY KEY (`code_emp`);

--
-- Index pour la table `inventaire`
--
ALTER TABLE `inventaire`
  ADD PRIMARY KEY (`code_inv`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`code_prod`),
  ADD KEY `code_emp` (`code_emp`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achat`
--
ALTER TABLE `achat`
  MODIFY `code_achat` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `deplacement`
--
ALTER TABLE `deplacement`
  MODIFY `code_dep` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `code_prod` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1017;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`code_prod`) REFERENCES `produit` (`code_prod`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`code_achat`) REFERENCES `achat` (`code_achat`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`code_emp`) REFERENCES `emplacement` (`code_emp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
