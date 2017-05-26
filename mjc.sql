-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 26 Mai 2017 à 18:34
-- Version du serveur :  5.7.11-0ubuntu6
-- Version de PHP :  7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mjc`
--

--
-- Contenu de la table `specialty`
--

INSERT INTO `specialty` (`id`, `name`) VALUES
(1, 'piano'),
(2, 'guitare'),
(3, 'chant');

--
-- Contenu de la table `subscription`
--

INSERT INTO `subscription` (`id`, `teacher_id`, `student_id`, `startAt`, `finishAt`, `subscriptionAt`, `specialties_id`) VALUES
(1, 1, 2, '2017-06-06 03:07:00', '2017-05-05 07:16:00', '2017-05-24 15:45:31', 3),
(2, 6, 7, '2017-05-26 15:00:00', '2017-05-26 16:00:00', '2017-05-26 10:46:00', 1),
(3, 8, 9, '2017-05-29 16:00:00', '2017-05-29 16:29:00', '2017-05-26 17:44:00', 1);

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `birthAt`, `role`, `username`, `isActive`) VALUES
(1, 'admin', 'admin', 'admin@admin.fr', 'admin', '2013-05-10 11:08:00', 'USER_ADMIN', 'admin', 1),
(2, 'fre', 'freu', 'frei@frei.fr', '$2y$13$x0dM9pvcLvZJssXgohvQEujBOAR5/4KdnVV5rNtvdRwy52r4z3Jni', '2018-07-08 08:10:00', 'ROLE_STUDENT', 'frei', 1),
(3, 'prof', 'prof', 'prof@prof.fr', '$2y$13$MrBHIbAcXzEQBbd9FaFj3OBHNC7wv6XYo/4.AabfjY7BUZBio8hBe', '2016-06-08 10:10:00', 'ROLE_TEACHER', 'prof', 1),
(4, 'eleve', 'eleve', 'eleve@eleve.fr', '$2y$13$Umq7JRj64CeFXc08tD/BnuQNyas7HmALJXhQSqOQzE1EvQ61X6MKy', '2015-06-07 05:11:00', 'ROLE_STUDENT', 'eleve', 1),
(5, 'Julien', 'Arauzo', 'julien@julien', '$2y$13$HygHR/vevpf00Oo2UCz15uuu0WBzTryFxa7dho5xeqUJdHNeehO3K', '2013-02-05 01:00:00', 'ROLE_STUDENT', 'corke', 1),
(6, 'Lucie', 'Copin', 'lucie@lucie', '$2y$13$aGZY3z.AwrOfuQd9pREN5uERmcjcTfhQflpwUGt4AOamkCPc1VbTS', '2017-04-04 02:06:00', 'ROLE_TEACHER', 'lucie', 1),
(7, 'Jean Christophe', 'Guinez', 'jc@jc', '$2y$13$p8G5BlVhKXm4C8W0eG.G1OWgYYJv.u3FGx2UTRI60gALtZeqOknwC', '2013-05-03 02:04:00', 'ROLE_TEACHER', 'jc', 1),
(8, 'Dario', 'Spagnolo', 'dario@dario', '$2y$13$Wv0BjHNxqajtVb1H90z7UOSD1p68zVhBHnZGlWnK9IOGMVbZwON66', '2015-04-10 02:07:00', 'ROLE_ADMIN', 'adminDario', 1),
(9, 'Guillaume', 'Lodi', 'guillaume@guillaume', '$2y$13$F.7kxhH.fP51EWt0udzTF.8KYLm8tcg9CtSRf5OMfZYF8f0XNHLGa', '2018-04-02 02:08:00', 'ROLE_STUDENT', 'guillaume', 1),
(10, 'Yves', 'de Lépinay', 'yves@yves', '$2y$13$aN/srqd1ZrJuymkwkre92OZ3voMvNuocQM2M5/ryUeqMSKCmtvth2', '2012-11-05 06:10:00', 'ROLE_STUDENT', 'yves', 1),
(11, 'Séverine', 'Coyer', 'severine@severine', '$2y$13$zvf8VcRG5UWXtxRZ.w0UR.eGugJRZZktlfNjR8q4LLdFwqqnTqHNC', '2012-01-04 01:00:00', 'ROLE_STUDENT', 'secoy', 1),
(12, 'koko', 'koko', 'koko@koko.fr', '$2y$13$29cqI5ARBn.HkqOPdqwh4OY73KboHpzgHxmFB3LNAMzHRpuUZo9LS', '1908-04-10 00:00:00', 'ROLE_STUDENT', 'koko', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
