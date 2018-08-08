-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 08 Août 2018 à 19:33
-- Version du serveur :  5.7.23-0ubuntu0.16.04.1
-- Version de PHP :  5.6.37-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ContactMe`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id_amis` int(11) NOT NULL,
  `id_ajout` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` bigint(20) NOT NULL,
  `pseudo` varchar(21) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `mdp` varchar(21) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `tel` int(11) NOT NULL,
  `genre` varchar(60) NOT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id_amis`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id_amis` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
