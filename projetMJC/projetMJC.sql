-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 24 Mai 2017 à 17:51
-- Version du serveur :  5.7.11-0ubuntu6
-- Version de PHP :  7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetMJC`
--

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `startAt` datetime NOT NULL,
  `teacher_isPresent` tinyint(1) NOT NULL,
  `student_isPresent` tinyint(1) NOT NULL,
  `appreciation` longtext COLLATE utf8_unicode_ci,
  `subscription_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialty`
--

CREATE TABLE `specialty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `specialty`
--

INSERT INTO `specialty` (`id`, `name`) VALUES
(1, 'guitare'),
(2, 'piano'),
(3, 'chant'),
(4, 'accordéon');

-- --------------------------------------------------------

--
-- Structure de la table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `specialties_id` int(11) DEFAULT NULL,
  `startAt` datetime NOT NULL,
  `finishAt` datetime NOT NULL,
  `subscriptionAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthAt` datetime DEFAULT NULL,
  `role` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `birthAt`, `role`, `username`, `isActive`) VALUES
(3, 'Yves', 'de Lépinay', 'yves@yves', '$2y$13$aN/srqd1ZrJuymkwkre92OZ3voMvNuocQM2M5/ryUeqMSKCmtvth2', '2012-11-05 06:10:00', 'ROLE_STUDENT', 'yves', 1),
(4, 'Séverine', 'Coyer', 'severine@severine', '$2y$13$zvf8VcRG5UWXtxRZ.w0UR.eGugJRZZktlfNjR8q4LLdFwqqnTqHNC', '2012-01-04 01:00:00', 'ROLE_STUDENT', 'secoy', 1),
(5, 'Julien', 'Arauzo', 'julien@julien', '$2y$13$HygHR/vevpf00Oo2UCz15uuu0WBzTryFxa7dho5xeqUJdHNeehO3K', '2013-02-05 01:00:00', 'ROLE_STUDENT', 'corke', 1),
(6, 'Lucie', 'Copin', 'lucie@lucie', '$2y$13$aGZY3z.AwrOfuQd9pREN5uERmcjcTfhQflpwUGt4AOamkCPc1VbTS', '2017-04-04 02:06:00', 'ROLE_TEACHER', 'lucie', 1),
(7, 'Jean Christophe', 'Guinez', 'jc@jc', '$2y$13$p8G5BlVhKXm4C8W0eG.G1OWgYYJv.u3FGx2UTRI60gALtZeqOknwC', '2013-05-03 02:04:00', 'ROLE_TEACHER', 'jc', 1),
(8, 'Dario', 'Spagnolo', 'dario@dario', '$2y$13$Wv0BjHNxqajtVb1H90z7UOSD1p68zVhBHnZGlWnK9IOGMVbZwON66', '2015-04-10 02:07:00', 'ROLE_ADMIN', 'admin', 1),
(9, 'Guillaume', 'Lodi', 'guillaume@guillaume', '$2y$13$F.7kxhH.fP51EWt0udzTF.8KYLm8tcg9CtSRf5OMfZYF8f0XNHLGa', '2018-04-02 02:08:00', 'ROLE_STUDENT', 'guillaume', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F39A1887DC` (`subscription_id`);

--
-- Index pour la table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A3C664D341807E1D` (`teacher_id`),
  ADD UNIQUE KEY `UNIQ_A3C664D3CB944F1A` (`student_id`),
  ADD KEY `IDX_A3C664D3E3AC3692` (`specialties_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F39A1887DC` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`);

--
-- Contraintes pour la table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `FK_A3C664D341807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_A3C664D3CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_A3C664D3E3AC3692` FOREIGN KEY (`specialties_id`) REFERENCES `specialty` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
