-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 24 Mai 2017 à 19:20
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

--
-- Contenu de la table `specialty`
--

INSERT INTO `specialty` (`id`, `name`) VALUES
(1, 'guitare'),
(2, 'piano'),
(3, 'chant'),
(4, 'accordéon');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
