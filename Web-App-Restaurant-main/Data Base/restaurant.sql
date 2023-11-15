-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 23 avr. 2023 à 21:56
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation_tables`
--

CREATE TABLE `affectation_tables` (
  `Id_Affectation` int(11) NOT NULL,
  `Id_Reservation` int(11) NOT NULL,
  `Id_Table` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `Num_Contact` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Subjct` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`Num_Contact`, `Email`, `Subjct`) VALUES
(1, 'hyperrftw29@gmail.com', 'gfhh'),
(2, 'hyperrftw29@gmail.com', 'dsdsdqd'),
(3, 'hyperrftw29@aaa.com', 'fefefef');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `Id_Reservation` int(11) NOT NULL,
  `Gender` enum('Mr','Mme','Mlle') NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone_Number` varchar(8) NOT NULL,
  `Number_People` int(11) NOT NULL,
  `Date_Reservation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`Id_Reservation`, `Gender`, `First_Name`, `Last_Name`, `Email`, `Phone_Number`, `Number_People`, `Date_Reservation`) VALUES
(1, 'Mr', 'KHIARI', 'Ala Eddine', 'khiarialaa@gmail.com', '28566088', 3, '2022-01-12'),
(2, 'Mr', 'azaz', 'zazaza', 'zazaz@user.tn', 'aaaaaadk', 2, '4455-12-31');

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `Id_Staff` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone_Number` int(11) NOT NULL,
  `Salaire` int(11) NOT NULL,
  `Job` enum('Restaurant_Manger','Cashier','Chef','server','Dishwasher') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tables`
--

CREATE TABLE `tables` (
  `Id_Table` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `Emplacement` varchar(20) NOT NULL,
  `Statut` enum('Disponible','Reserver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectation_tables`
--
ALTER TABLE `affectation_tables`
  ADD PRIMARY KEY (`Id_Affectation`),
  ADD KEY `FK_aff_tables` (`Id_Reservation`),
  ADD KEY `FK_aff_tables2` (`Id_Table`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Num_Contact`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Id_Reservation`);

--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Id_Staff`);

--
-- Index pour la table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`Id_Table`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `Num_Contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Id_Reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation_tables`
--
ALTER TABLE `affectation_tables`
  ADD CONSTRAINT `FK_aff_tables` FOREIGN KEY (`Id_Reservation`) REFERENCES `reservation` (`Id_Reservation`),
  ADD CONSTRAINT `FK_aff_tables2` FOREIGN KEY (`Id_Table`) REFERENCES `tables` (`Id_Table`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
