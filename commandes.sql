-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Host: axelcardjaagel.mysql.db
-- Generation Time: Oct 02, 2021 at 02:39 PM
-- Server version: 5.6.50-log
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `axelcardjaagel`
--

-- --------------------------------------------------------

--
-- Table structure for table `commandes_old`
--

CREATE TABLE `commandes_old` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `frequentation` int(11) NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresselegale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adressefacturation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresselivraison` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prixtotal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_validated` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commandes_old`
--

INSERT INTO `commandes_old` (`id`, `event_id`, `frequentation`, `nom`, `prenom`, `email`, `adresselegale`, `adressefacturation`, `adresselivraison`, `telephone`, `prixtotal`, `is_validated`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 20000, 'Cardinaels', 'Axel', 'axel.cardinaels@icloud.com', 'Rue Des Anciens Combattants 22', 'Rue Des Anciens Combattants 22', 'Rue Des Anciens Combattants 22', '049152940', '1460.5', 0, '2018-02-05 23:11:01', '2018-02-05 23:10:52', '2018-02-05 23:11:01'),
(2, 7, 2000, 'Taha', 'Nouara', 'nouarataha@gmail.com', 'Rue Darchis 11, 4000 Liège', 'Place du XX Aout 24, 4000 Liège', 'Rue de Droixhe 10, 4000 Liège', '0493504243', '28677.8', 0, '2018-02-08 12:31:04', '2018-02-07 15:44:18', '2018-02-08 12:31:04'),
(3, 12, 2000, 'Cardinaels', 'Axel', 'axel.cardinaels@icloud.com', 'Rue Bla', 'RUe', 'Rue de droixhe', '048194', '1460.5', 0, '2018-02-08 12:31:12', '2018-02-07 17:30:12', '2018-02-08 12:31:12'),
(4, 13, 2000, 'Axel', 'Cardinaels', 'axel.cardinaels@gmail.com', 'Rue Des Anciens Combattants 22', 'Rue Des Anciens Combattants 22', 'Rue Des Anciens Combattants 22', '+32491529027', '1460.5', 1, '2018-02-10 19:23:28', '2018-02-10 19:21:46', '2018-02-10 19:23:28'),
(5, 19, 2000, 'Bartholomé', 'Guillaume', 'bartholome.guillaume@gmail.com', 'Voie de Messe, 9 - 4560 Clavier', 'Rue Bois l\'Evêque, 3 - 4000 Liège', 'Rue de Droixhe, 10 - 4020 Liège', '0498534531', '32793.2', 1, '2018-09-06 08:42:40', '2018-02-12 17:46:15', '2018-09-06 08:42:40'),
(6, 21, 1000, 'Sansen', 'Mélina', 'sansenmelina@hotmail.com', 'Rue des grands champs 91 4000 liege', 'Rue des grands champs 91 4000 liege', 'Rue de droixhe 10', '0497026711', '18720.4', 1, '2018-09-06 08:46:44', '2018-02-12 19:18:03', '2018-09-06 08:46:44'),
(7, 22, 900, 'Favart', 'Frans', 'frans.favart@gmail.com', 'rue hodiamont, 20 4802 heusy', 'rue hodiamont, 20 4802 heusy', 'rue de Droixhe, 10 4020 Liège', '0494944958', '18199.2', 1, '2018-09-06 08:46:45', '2018-02-13 12:34:02', '2018-09-06 08:46:45'),
(8, 23, 1800, 'Robin', 'Hames', 'robin_hames3108@hotmail.com', 'Rue Florent Boclinville 35 4041 Vottem', 'Rue Florent Boclinville 35 4041 Vottem', 'Salle de guindaille Droixhe, Rue de Droixhe 10, 4020 Liège', '0477623265', '22083.08', 1, '2018-09-06 08:46:47', '2018-02-13 13:43:42', '2018-09-06 08:46:47'),
(9, 24, 2000, 'Piette', 'Barnabé', 'barnabe.piette@gmail.com', 'Rue Fraischamps, 21, 4030 Grivegnée', 'Rue André Renard 20, 4430, Ans', 'Rue de Droixhe, 10', '0497915819', '33987.6', 1, '2018-09-06 08:46:48', '2018-02-13 19:53:47', '2018-09-06 08:46:48'),
(10, 25, 800, 'Doxins', 'Arnaud', 'criterium@hotmail.be', 'Rue Germinal 8 4610 Beyne-heusay', 'Quai St-Léonard 15 4000 Liège', 'Rue de Droixhe 4020 Liège', '0494179380', '9949.28', 1, '2018-09-06 08:46:49', '2018-02-15 08:48:23', '2018-09-06 08:46:49'),
(11, 26, 2000, 'Céline', 'Georges', 'celinegeorges94@gmail.com', 'Rue du brûlé 37, Jemeppe sur Sambre', 'Rue Jonfosse 54', 'Rue de Droixhe 10', '0472890760', '36376.4', 1, '2018-09-06 08:46:50', '2018-02-16 12:55:49', '2018-09-06 08:46:50'),
(12, 27, 500, 'Baumgarten', 'Tim', 'likaboos97@gmail.com', 'Rue boveroth 24, 4837 Membach', 'Rue boveroth 24, 4837 Membach', 'Rue de droite 10, 4000 Liège', '+32494904610', '18127.45', 1, '2018-09-06 08:46:51', '2018-02-16 18:32:32', '2018-09-06 08:46:51'),
(13, 28, 2000, 'Cardinaels', 'Axel', 'axel.cardinaels@icloud.com', 'Rue Des Anciens Combattants 22', 'Rue Des Anciens Combattants 22', 'Rue Des Anciens Combattants 22', '0491529027', '7302.5', 0, '2018-02-16 23:02:27', '2018-02-16 23:02:06', '2018-02-16 23:02:27'),
(14, 31, 1200, 'Hadrien', 'Jeukenne', 'hadrien.jeukenne@hotmail.com', 'Rue d\'andenne, 2', 'Rue louvrex, 14', 'Rue de Droixhe, 10', '0479949090', '24296.3', 1, '2018-09-06 08:46:55', '2018-02-19 15:38:56', '2018-09-06 08:46:55'),
(15, 20, 2300, 'Georges', 'Jodie', 'jodie.georges@hotmail.fr', 'rue des vieilles écoles n\'39 Tonny, 6680 SAINTE-ODE', 'Rue Hazinelle, 6 4000 Liège', '10 Rue de Droixhe, Droixhe. Liège 4020', '0499524530', '33456.59', 1, '2018-09-06 08:46:42', '2018-02-20 20:47:30', '2018-09-06 08:46:42'),
(16, 33, 2300, 'Jassogne', 'Antoine', 'touraco.aj@gmail.com', 'Aisne 50, 6941 Durbuy', 'Aisne 50, 6941 Durbuy', 'Rue de Droixhe 10, 4020 Liège', '0477405874', '35214.8', 1, '2018-09-06 08:46:57', '2018-02-23 15:59:34', '2018-09-06 08:46:57'),
(17, 34, 500, 'Tillement', 'Adeline', 'ade_tillement@hotmail.com', '17 rue des chênes 6700 Arlon', '26 rue grangagnage 4000 Liège', 'rue de Droixhe 4', '0497643750', '10223.5', 1, '2018-09-06 08:46:58', '2018-02-24 15:22:47', '2018-09-06 08:46:58'),
(18, 29, 1000, 'De Roeck', 'Camille', 'camille.deroeck@gmail.com', 'Rue de la Huuscht 17 6700 Arlon', 'Rue Charles Magnette 60 boite 38 4000 Liège', 'Rue de Droixhe n°10 4020 Liège', '0497927250', '12138.85', 1, '2018-09-06 08:46:52', '2018-02-26 13:05:34', '2018-09-06 08:46:52'),
(19, 35, 700, 'Belin', 'Adeline', 'Adeline.belin@hotmail.be', 'Chaussée de Balaclava 16, 6840 Longlier', 'Quai Churchill 8, 41-01  4020 Liège', 'Rue de Droixhes, 4020 Liège', '0497468926', '15073.13', 1, '2018-09-06 08:47:00', '2018-02-26 16:32:29', '2018-09-06 08:47:00'),
(20, 36, 300, 'Collard', 'Ylona', 'ylonacollard@gmail.com', 'Quai marcellis 1b boîte 071 4020 liège', 'Quai marcellis 1b boîte 071 4020 liège', 'Rue de droixhe 10, 4020 liège', '0477930537', '8652.91', 1, '2018-09-06 08:47:01', '2018-02-27 12:59:27', '2018-09-06 08:47:01'),
(21, 32, 2300, 'Bricmont', 'Noëmie', 'noemie-01@hotmail.com', '112 rue de Soulme 5620 Morville', '10 rue Donceel 4000 Liège', 'Rue de Droihxe', '0476030496', '30735.6', 1, '2018-09-06 08:46:56', '2018-02-28 08:40:10', '2018-09-06 08:46:56'),
(22, 38, 150, 'Jassogne', 'Antoine', 'touraco.aj@gmail.com', 'Aisne 50, 6941 Durbuy', 'Aisne 50, 6941 Durbuy', 'Rue de Droixhe 10, 4020 Liège', '0477405874', '4313.04', 1, '2018-09-06 08:47:03', '2018-03-11 21:39:45', '2018-09-06 08:47:03'),
(23, 42, 20, 'Bohez', 'Thomas', 'tbohez@gmail.com', '4, rue Haut Vinave 4350 Momalle', '4, rue Haut Vinave 4350 Momalle', '10, rue de Droixhe 4000 Liège', '0496303355', '718.84', 0, '2018-04-05 11:52:15', '2018-03-29 14:31:59', '2018-04-05 11:52:15'),
(24, 43, 50, 'Bohez', 'Thomas', 'tbohez@gmail.com', '4, rue Haut Vinave 4350 Momalle', '4, rue Haut Vinave 4350 Momalle', '10, rue de Droixhe, 4000 Liège', '0496303355', '2336.8', 0, '2018-03-30 20:14:04', '2018-03-29 14:34:48', '2018-03-30 20:14:04'),
(25, 43, 50, 'Bohez', 'Thomas', 'tbohez@gmail.com', '4, rue Haut Vinave 4350 Momalle', '4, rue Haut Vinave 4350 Momalle', '10, rue de Droixhe, 4000 Liège', '0496303355', '2336.8', 1, '2018-04-20 08:26:58', '2018-03-29 14:35:23', '2018-04-20 08:26:58'),
(26, 47, 60, 'Sansen', 'Mélina', 'sansenmelina@hotmail.com', 'Rue des grands champs 91 4000 Liège', 'Rue des grands champs, 91   4000 Liège', 'Rue de Herve 653, 4030 Liège', '+32490430645', '1752.6', 0, '2018-04-05 11:52:18', '2018-04-01 13:51:19', '2018-04-05 11:52:18'),
(27, 48, 75, 'Piette', 'Barnabé', 'Barnabe.piette@gmail.com', 'Rue de Droixhe, 10', 'Rue André Renard 20, 4430, Ans', 'Rue de Droixhe, 10', '0497915819', '2921', 1, '2018-09-06 08:48:28', '2018-04-01 20:20:32', '2018-09-06 08:48:28'),
(28, 49, 80, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'rue des golettes 19', 'Rue Hazinelle, 6', 'Rue de Droixhe n10, Droixhe Liège', '0499524530', '3190.28', 1, '2018-09-06 08:48:29', '2018-04-10 12:11:43', '2018-09-06 08:48:29'),
(29, 50, 600, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'Rue des golettes 19 5190 Spy', 'Rue Hazinelle, 6', 'Boulevard de la Constitution n°41, 4020 Liège (StLuc)', '0499524530', '5516.82', 1, '2018-09-06 08:48:30', '2018-04-16 07:16:40', '2018-09-06 08:48:30'),
(30, 51, 100, 'Bartholomé', 'Guillaume', 'bartholome.guillaume@gmail.com', 'Voie de Messe, 9', 'Rue Saint-Léonard 236A, 4000 Liège', 'Rue de Droixhe, 10', '0498534531', '2774.95', 1, '2018-09-06 08:48:33', '2018-04-16 17:47:48', '2018-09-06 08:48:33'),
(31, 52, 60, 'Marenne', 'Pierre', 'pierre.marenn@gmail.com', 'Rue du Moulin 6, 4920 Aywaille', 'Rue du Moulin 6, 4920 Aywaille', 'Rue de Droixhe 10, 4020 Liège', '0484708184', '1668.98', 1, '2018-10-03 12:29:53', '2018-04-26 12:40:43', '2018-10-03 12:29:53'),
(32, 54, 100, 'Robin', 'Hames', 'robin_hames3108@hotmail.com', 'Rue Florent Boclinville 35 4041 Vottem', 'Rue Florent Boclinville 35 4041 Vottem', 'Rue Florent Boclinville 35 4041 Vottem', '0477623265', '1376.88', 1, '2018-09-06 08:48:36', '2018-05-17 18:58:18', '2018-09-06 08:48:36'),
(33, 55, 50, 'Georges', 'Celine', 'celinegeorges94@gmail.com', 'Mageret 335/A3, 6600 Bastogne', 'Rue Jonfosse 54, 4000 Liege', 'Salle de Droixhe (rue de Droixhe, 10)', '0472890760', '2921', 1, '2018-09-06 08:48:39', '2018-06-06 11:38:52', '2018-09-06 08:48:39'),
(34, 56, 150, 'Bartholomé', 'Guillaume', 'bartholome.guillaume@gmail.com', 'Voie de Messe, 9 - 4560 Clavier', 'Rue Saint-Léonard, 236A - 4000 Liège', 'Rue de Droixhe, 10', '0498534531', '2962.24', 1, '2018-09-06 08:48:41', '2018-06-11 18:15:39', '2018-09-06 08:48:41'),
(35, 53, 70, 'Sansen', 'Mélina', 'sansenmelina@hotmail.com', 'Rue des grands champs 91, 4000 Liège', 'Rue des grands champs 91, 4000 Liège', 'Rue de droixhe 10, 4020 Liège', '0497026711', '2628.9', 1, '2018-09-06 08:48:35', '2018-06-17 17:57:36', '2018-09-06 08:48:35'),
(36, 60, 60, 'Mouton', 'Lise', 'lise.mouton3@gmail.com', 'Chemin du moulin, 122 6637 Fauvillers', 'Chemin du moulin, 122 6637 Fauvillers', 'Rue de Droixhe 10, 4020 Liège', '0476283311', '1168.4', 1, '2018-09-06 08:48:42', '2018-06-20 12:17:54', '2018-09-06 08:48:42'),
(37, 62, 1, 'Marenne', 'Pierre', 'pierre.marenn@gmail.com', 'Place du Vingt Août 24', 'Place du Vingt Août 24', 'Place du Vingt Août 24', '0484708184', '4673.6', 0, '2018-08-28 08:29:32', '2018-08-22 07:53:40', '2018-08-28 08:29:32'),
(38, 63, 50, 'Hames', 'Robin', 'robin_hames3108@hotmail.com', 'Rue Florent Boclinville 35, 4041 Vottem', 'Rue Florent Boclinville 35, 4041 Vottem', 'Salle de guindaille de Droixhe, Rue de Droixhe 10, 4020 Liège', '+32477623265', '2336.8', 1, '2018-10-03 12:29:56', '2018-08-22 18:30:29', '2018-10-03 12:29:56'),
(39, 64, 150, 'Favart', 'Frans', 'frans.favart@gmail.com', 'rue hodiamont, 20 4802 Heusy', 'rue hodiamont, 20 4802 Heusy', 'Quai Gloesener, 6  B - 4020 Liège', '0474514864', '1744.33', 1, '2018-10-03 12:29:57', '2018-09-01 11:25:08', '2018-10-03 12:29:57'),
(40, 62, 1, 'Marenne', 'Pierre', 'pierre.marenn@gmail.com', 'Place du Vingt Août 24', 'Place du Vingt Août 24', 'Place du Vingt Août 24', '0484708184', '4673.6', 0, '2018-09-05 13:10:02', '2018-09-03 17:08:23', '2018-09-05 13:10:02'),
(41, 62, 1, 'Marenne', 'Pierre', 'pierre.marenn@gmail.com', 'Place du Vingt Août 24', 'Place du Vingt Août 24', '10 Rue de Droixhe', '0484708184', '4673.6', 1, '2018-10-03 12:29:55', '2018-09-05 13:11:09', '2018-10-03 12:29:55'),
(42, 67, 400, 'Piette', 'Barnabé', 'barnabe.piette@gmail.com', 'Rue Fraischamps, 21, 4030 Grivegnée', 'Rue André Renard 20, 4430, Ans', 'Rue de Droixhe, 10', '0497915819', '7506', 1, '2018-10-04 16:42:15', '2018-09-19 06:55:07', '2018-10-04 16:42:15'),
(43, 65, 250, 'Cartenstart', 'Romain', 'romain.cartens@hotmail.com', 'Chaussée Brunehaut, 399 - 4453 Juprelle', 'Quai de Rome, 10 - 4000 Liège', 'Rue de Droixhe, 10', '0490197498', '5254.2', 0, '2018-10-03 08:12:28', '2018-10-02 08:01:47', '2018-10-03 08:12:28'),
(44, 68, 200, 'Lamborelle', 'Maxime', 'maxime.lamborelle@gmail.com', 'Rue Nouvelle 14 6810 Izel', 'Avenue Rogier 8 4000 Liège', 'Rue de Droixhe 10 4000 Liège', '0478712412', '3602.88', 1, '2018-10-28 09:07:03', '2018-10-04 12:45:18', '2018-10-28 09:07:03'),
(45, 69, 200, 'Poty', 'Simon', 'simon.poty@hotmail.com', '43 rue Joseph Mignolet 4317 Faimes', '43 rue Joseph Mignolet 4317 Faimes', 'Rue de Droixhe 10 4000 Liège', '0473705745', '4503.6', 1, '2018-10-28 09:07:06', '2018-10-05 15:09:42', '2018-10-28 09:07:06'),
(46, 70, 300, 'Emonts', 'Delphine', 'delphine.emonts@gmail.com', 'Rue Gît-le-coq, 17, 4020 Jupille, Belgique', 'Rue Louvrex, 14,  4000 Liège, Belgique', 'Rue de Droixhe, 10,  4020 Liège, Belgique (salle de guindaille AGEL)', '0494038698', '4503.6', 1, '2018-10-28 09:07:12', '2018-10-08 05:11:59', '2018-10-28 09:07:12'),
(47, 71, 10, 'Alexendre', 'Schoenaerts', 'alexandre.schoenaerts@gmail.com', 'Route du condroz 105 4031 Angleur', 'Route du condroz 105 4031 Angleur', 'Rue du Sart-Tilman 341', '0499251545', '734.19', 1, '2018-10-28 09:07:14', '2018-10-10 15:21:23', '2018-10-28 09:07:14'),
(48, 72, 50, 'Lamborelle', 'Maxime', 'maxime.lamborelle@gmail.com', 'Rue Nouvelle 14 6810 Izel', 'Avenue Rogier 8 4000 Liège', 'Rue de Droixhe 10', '0475712704', '2755.11', 1, '2018-10-28 09:07:15', '2018-10-11 11:45:47', '2018-10-28 09:07:15'),
(49, 73, 200, 'Henrottin', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'Rue de la roche', '22', 'Rue de droixhe 10', '0495732954', '2251.8', 0, '2018-10-13 19:53:56', '2018-10-13 13:49:54', '2018-10-13 19:53:56'),
(50, 73, 250, 'TIF-MODE', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'Rue de la roche', '22', 'Rue de droixhe 10', '0495732954', '2401.92', 1, '2018-10-19 10:06:20', '2018-10-14 12:53:40', '2018-10-19 10:06:20'),
(51, 75, 250, 'Doxins', 'Arnaud', 'criterium@hotmail.be', 'Rue Germinal 8, 4610 Beyne-Heusay', 'Quai St Léonard 15, 4000 Liège', 'Rue de Droixhe 10, 4020 Liège', '0494179380', '12009.6', 1, '2018-10-21 21:15:07', '2018-10-16 11:04:26', '2018-10-21 21:15:07'),
(52, 74, 150, 'Briamont', 'Mélanie', 'briamont.melanie@outlook.be', 'rue de Rechain 36 4650 Chaineux', 'Rue Provinciale 18 4451 Voroux-Lez-Liers', 'rue de Droixhe 10  4020 Liège', '0497293456', '1801.44', 1, '2018-10-28 09:07:16', '2018-10-16 13:23:11', '2018-10-28 09:07:16'),
(53, 76, 40, 'Lenart', 'Olivia', 'olivia.lenart@gmail.com', 'Vervoz 5, Clavier', 'Rue d’Anixhe 15, 4458 Fexhe Slins', 'Rue de droixhe 10, 4000 Liege', '0493745012', '1501.2', 1, '2018-10-28 09:07:20', '2018-10-18 14:41:45', '2018-10-28 09:07:20'),
(54, 73, 250, 'Henrottin', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'Rue de la roche', '22', 'Rue de droixhe 10', '0495732954', '2401.92', 1, '2018-10-28 09:07:21', '2018-10-19 11:21:36', '2018-10-28 09:07:21'),
(55, 78, 200, 'Evrard', 'Théo', 'evrard.theo24@gmail.com', 'Rue Nouvelle 14 6810 Izel', 'Avenue Rogier 8 4000 Liège', 'Rue de Droixhe 10', '0499245198', '3302.64', 1, '2018-11-12 12:32:32', '2018-10-19 14:00:50', '2018-11-12 12:32:32'),
(56, 77, 500, 'Hornung', 'Gabriel', 'gabrielhornung@hotmail.com', 'Maria-Nicklisch Straße 61, 81739 München, Allemagne', 'Rue Louvrex 14, 4000 Liège, Belgique', 'Rue de Droixhe, 10, 4020 Liège, Belgique', '0483535942', '6004.8', 1, '2018-11-12 12:32:34', '2018-10-20 11:22:28', '2018-11-12 12:32:34'),
(57, 79, 100, 'Doxins', 'Arnaud', 'criterium@hotmail.be', 'Rue Germinal 8 4610 Beyne-Heusay', 'Rue Molinvaux 122 4000 Liège', 'Rue de Droixhe 10 4020 Liège', '0497194038', '4803.84', 1, '2018-11-12 12:32:35', '2018-10-20 13:07:36', '2018-11-12 12:32:35'),
(58, 80, 400, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'Rue des Golettes n19 5190 Spy', 'Rue Hazinelle n6 4000 Liège', 'Boulevard de la constitution 41, 4000 Liège', '0499524530', '4226.05', 1, '2018-11-12 12:32:37', '2018-10-22 10:03:30', '2018-11-12 12:32:37'),
(59, 81, 400, 'Henrottin', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'Rue de la roche', '22', 'Rue de droixhe 10', '0495732954', '4803.84', 1, '2018-10-26 11:53:27', '2018-10-26 11:44:43', '2018-10-26 11:53:27'),
(60, 81, 400, 'Henrottin', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'Rue de la roche', '22', 'Rue de droixhe 10', '0495732954', '4803.84', 1, '2018-11-12 12:32:39', '2018-10-26 11:58:43', '2018-11-12 12:32:39'),
(61, 82, 200, 'Poty', 'Simon', 'simon.poty@hotmail.com', '43 rue Joseph Mignolet 4317 Faimes', '43 rue Joseph Mignolet 4317 Faimes', '10 rue de Droixhe 4000 Liège', '0473705745', '4503.6', 1, '2018-11-12 12:32:44', '2018-10-27 14:48:07', '2018-11-12 12:32:44'),
(62, 84, 400, 'Cartenstart', 'Romain', 'romain.cartens@hotmail.com', 'Chaussée Brunehaut, 399 4453, Villers-saint-Siméon', 'Quai de Rome, 10 4000 Liège', 'Rue de Droixhe, 10  4000, Liège.', '0490197498', '6755.4', 1, NULL, '2018-10-30 16:44:22', '2018-10-31 13:48:48'),
(63, 86, 800, 'Theo', 'Evrard', 'evrard.theo24@gmail.com', 'Rue Nouvelle 14, 6810 Izel', 'Avenue Rogier 8, 4000 Liège boite 82', 'Rue de Droixhe 10', '0475712704', '12123.91', 1, NULL, '2018-10-31 21:27:54', '2018-11-01 16:36:46'),
(64, 87, 300, 'Mélanie', 'Briamont', 'briamont.melanie@outlook.be', 'rue de Rechain 36 4650 Chaineux', 'Rue Provinciale 18 4451 Voroux-Lez-Liers', 'rue de Droixhe 10  4020 Liège', '0497293456', '4131.44', 1, NULL, '2018-11-04 12:13:43', '2018-11-04 16:47:16'),
(65, 88, 200, 'Donovan', 'Jonlet', 'dono45678@hotmail.com', 'Rue de l\'Ecluse, 11', 'Quai du Barbou 33/12 4020 Liège', 'Rue de Droixhe, 10 Liège', '0488272734', '2401.92', 1, '2018-11-07 19:09:06', '2018-11-04 14:11:21', '2018-11-07 19:09:06'),
(66, 83, 150, 'Briamont', 'Mélanie', 'briamont.melanie@outlook.be', 'rue de Rechain 36 4650 Chaineux', 'Rue Provinciale 18 4451 Voroux-Lez-Liers', 'rue de Droixhe 10  4020 Liège', '0497293456', '2702.16', 1, NULL, '2018-11-04 15:25:26', '2018-11-04 16:47:49'),
(67, 89, 400, 'Huberland', 'Julien', 'julien_phk@live.fr', 'Rue du Mohet, 22 - Limont 4357', 'Chemin de Huy, 4 - Braives 4260', 'Rue de Droixhe, 10 - Liège 4020 - Salle de guindaille', '0497218238', '7922.4', 0, '2018-11-05 14:22:00', '2018-11-05 13:55:48', '2018-11-05 14:22:00'),
(68, 89, 400, 'Huberland', 'Julien', 'julien_phk@live.fr', 'Rue du Mohet, 22 - Limont 4357', 'Chemin de Huy, 4 - Braives 4260', 'Rue de Droixhe, 10 - Liège 4020 - Salle de guindaille', '0497218238', '9362.24', 1, NULL, '2018-11-05 14:41:16', '2018-11-05 15:11:20'),
(69, 91, 150, 'Lenart', 'Olivia', 'olivia.lenart@gmail.com', 'Anixhe 15, 4458 Fexhe-Slins', 'Anixhe 15, 4458 Fexhe-Slins', 'Rue de Droixhe 10, 4020 Liège', '0493745012', '1978.96', 1, NULL, '2018-11-06 21:39:16', '2018-11-07 10:13:16'),
(70, 90, 600, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'Rue Hazinelle, 6', 'Rue Hazinelle', 'Rue de Droixhe n°10, Droixhe 4020 Liège', '0499524530', '8485.56', 1, NULL, '2018-11-07 11:01:03', '2018-11-09 09:54:05'),
(71, 88, 200, 'Donovan', 'Jonlet', 'dono45678@hotmail.com', 'Rue de l\'Ecluse, 11 4684 Haccourt', 'Quai du Barbou 33/12 4020 Liège', 'Rue de Droixhe, 10 Liège', '0488272734', '1501.2', 0, '2018-11-07 19:08:48', '2018-11-07 17:10:05', '2018-11-07 19:08:48'),
(72, 88, 250, 'Jonlet', 'Donovan', 'dono45678@hotmail.com', 'Rue de l\'Ecluse 11 4684 Haccourt', 'Quai du Barbou 33/12 4020 Liège', 'Rue de Droixhe, 10 Liège', '0488272734', '4203.36', 1, NULL, '2018-11-07 19:11:04', '2018-11-07 19:11:47'),
(73, 92, 250, 'Henrottin', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'Rue de la roche', '22', 'Rue de droixhe 10', '0495732954', '5342.4', 1, NULL, '2018-11-11 18:38:57', '2018-11-12 08:57:47'),
(74, 93, 150, 'Leduc', 'François', 'francois.leduc@scarlet.be', 'Bois de la Croix Claire 54, Nandrin 4550', 'Bois de la Croix Claire 54, Nandrin 4550', 'Rue de droixhe 10,', '0494703529', '3490.23', 0, '2018-11-12 08:56:42', '2018-11-11 20:49:10', '2018-11-12 08:56:42'),
(75, 93, 150, 'Leduc', 'François', 'francois.leduc@scarlet.be', 'Bois de la Croix Claire 54, Nandrin 4550', 'Bois de la Croix Claire 54, Nandrin 4550', 'Rue de droixhe 10,  4020 Liège', '0494703529', '3490.23', 1, NULL, '2018-11-11 20:49:42', '2018-11-12 08:56:52'),
(76, 94, 400, 'Defourny', 'Mathilde', 'mamadefourny@hotmail.com', 'Rue André Reanrd 20 4430 Ans', 'Rue André Renard 20 4430 Ans', 'Rue de Droixhe 10 4020 Liège', '0496829842', '8666.44', 1, NULL, '2018-11-12 10:33:15', '2018-11-12 10:40:01'),
(77, 96, 200, 'Stevens', 'Julie', 'stevens.julie@outlook.com', '8 rue de la province 4000 Liège', '8 rue de la province 4000 Liège', 'Rue de Droixhe - Salle de guindaille', '0472102745', '5109.78', 1, NULL, '2018-11-12 10:47:14', '2018-11-12 10:52:14'),
(78, 97, 350, 'Francois', 'Margot', 'Margot-francois@hotmail.fr', 'Rue du vieux pont 20 Remouchamps', 'Rue du vieux pont, 20 Remouchamps', 'Rue de droixhe 10', '049403', '0', 0, '2018-11-14 19:59:28', '2018-11-12 14:53:19', '2018-11-14 19:59:28'),
(79, 97, 350, 'Francois', 'Margot', 'Margot-francois@hotmail.fr', 'Rue du vieux pont 20 Remouchamps', 'Rue du vieux pont, 20 Remouchamps', 'Rue de droixhe 10', '0494039363', '7438.08', 1, NULL, '2018-11-12 14:59:27', '2018-11-14 19:59:38'),
(80, 98, 300, 'Doxins', 'Arnaud', 'criterium@hotmail.be', 'Rue Germinal 8, 4610 Beyne-Heusay', 'Quai St Léonard 15, 4000 Liège', 'Rue de Droixhe 10, 4020 Liège', '0494179380', '9718.02', 1, NULL, '2018-11-13 13:36:24', '2018-11-14 19:57:31'),
(81, 98, 300, 'Doxins', 'Arnaud', 'criterium@hotmail.be', 'Rue Germinal 8, 4610 Beyne-Heusay', 'Quai St Léonard 15, 4000 Liège', 'Rue de Droixhe 10, 4020 Liège', '0494179380', '0', 0, '2018-11-16 15:53:26', '2018-11-13 13:37:22', '2018-11-16 15:53:26'),
(82, 99, 350, 'Bonnewyn', 'Chloe', 'chloe.bonnewyn@gmail.com', 'Hofstraße Oudler 4, 4790 Burg-Reuland', 'Hofstraße Oudler 4, 4790 Burg-Reuland', 'Rue de Droixhe 10, 4020 Liège', '0470757000', '5254.2', 0, '2018-11-16 15:51:37', '2018-11-15 19:08:54', '2018-11-16 15:51:37'),
(83, 99, 350, 'Bonnewyn', 'Chloe', 'chloe.bonnewyn@gmail.com', 'Hofstraße Oudler 4, 4790 Burg-Reuland', 'Hofstraße Oudler 4, 4790 Burg-Reuland', 'Rue de Droixhe 10, 4020 Liège', '0470757000', '5254.2', 1, NULL, '2018-11-15 19:09:30', '2018-11-16 15:52:12'),
(84, 98, 300, 'Doxins', 'Arnaud', 'criterium@hotmail.be', 'Rue Germinal 8, 4610 Beyne-Heusay', 'Quai St Léonard 15, 4000 Liège', 'Rue de Droixhe 10, 4020 Liège', '0494179380', '0', 1, NULL, '2018-11-17 14:06:31', '2018-11-17 15:58:49'),
(85, 98, 300, 'Doxins', 'Arnaud', 'criterium@hotmail.be', 'Rue Germinal 8, 4610 Beyne-Heusay', 'Quai St Léonard 15, 4000 Liège', 'Rue de Droixhe 10, 4020 Liège', '0494179380', '0', 0, '2018-11-17 15:59:12', '2018-11-17 14:06:36', '2018-11-17 15:59:12'),
(86, 102, 300, 'Zois', 'Nicolas', 'Nicolasz@outlook.be', 'Rue Lambert-le-bhgue 13, 4000 Liege', '35 rue de la campagne, 4500 Tihange', 'Chapi 4.0 - Rue de Droixhe 10, 4020 Liège', '0497026711', '5731.96', 1, NULL, '2018-11-17 16:48:51', '2018-11-18 14:00:43'),
(87, 100, 400, 'Cambrelin', 'Sarah', 'camb.sarah@gmail.com', 'Rue A.Melsens n°27, 7950 Huissignies', 'Rue Hermicourt n°5, 4000 Liège', 'Rue de Droixhe 10, 4000 Liège', '0470053008', '5220.24', 1, NULL, '2018-11-17 17:58:25', '2018-11-18 14:00:33'),
(88, 103, 200, 'Pierre', 'Vanhees', 'vanhees_pierre@hotmail.Fr', 'Rue hemricourt 20', 'Rue hemricourt 20 4000 liège', 'Rue de droixhe', '0499218786', '6543.36', 1, NULL, '2018-11-18 15:48:57', '2018-11-19 17:26:53'),
(89, 104, 100, 'Parmentier', 'Colin', 'colparmentier@gmail.com', 'Rue Fontaine Deltour, 35 - 4540 AMAY', 'Rue Fontaine Deltour, 35 - 4540 AMAY', 'Rue de Droixhe', '0477886099', '1801.44', 1, NULL, '2018-11-20 13:44:33', '2018-11-20 16:38:34'),
(90, 105, 350, 'Hornung', 'Gabriel', 'gabrielhornung@hotmail.com', 'Rue Bonne Fortune  1, 4000 Liège, Belgique', 'Rue Louvrex 14, 4000 Liège, Belgique', 'Rue de Droixhe, 10, 4020 Liège, Belgique', '+32483535942', '5850', 1, NULL, '2018-11-21 11:15:40', '2018-11-22 07:53:22'),
(91, 106, 150, 'Pecheur', 'Gaeten', 'pecheurgaetan@hotmail.com', 'rue aux terrasses 2A 4540 Amay', 'rue aux terrasses 2A 4540 Amay', 'Rue de Droixhe 10, 4020 Liège', '0499175894', '4096.12', 1, NULL, '2018-11-22 12:28:39', '2018-11-23 13:42:41'),
(92, 107, 200, 'Cartenstart', 'Romain', 'romain.cartens@hotmail.com', 'Chaussée Brunehaut, 399 4453, Villers-saint-Siméon', 'Quai de Rome, 10 4000 Liège', 'Rue de Droixhe, 10  4000, Liège.', '0490197498', '5254.2', 1, NULL, '2018-11-23 13:56:53', '2018-11-25 11:07:10'),
(93, 108, 200, 'Machiels', 'Celine', 'Celinemachiels28@gmail.com', 'Rue d\'Aywaille 24, 4170 Comblain-au-Pont', 'Rue d\'Aywaille 24, 4170 Comblain-au-Pont', 'Rue de Droixhe 10, 4020 Liège, Belgique', '0494497021', '5937.23', 1, NULL, '2018-11-23 15:20:12', '2018-11-25 11:06:58'),
(94, 110, 200, 'Théo', 'Evrard', 'evrard.theo24@gmail.com', 'Rue Nouvelle 14,  6810 Izel', 'Avenue Rogier 8, 4000 Liège boite 82', 'Rue de Droixhe 10 4000 Liège', '0472276339', '3753', 1, NULL, '2018-11-23 19:00:48', '2018-11-25 11:06:16'),
(95, 111, 15, 'Louis', 'Romain', 'R.louis@student.uliege.be', 'Rue de camping n 47 boîte 11 4000 liège', 'Rue de campine n 47 boîte 11 4000 liège', 'Rue de droixhe 10', '0494414132', '300.24', 1, NULL, '2018-12-13 09:06:39', '2018-12-13 09:08:05'),
(96, 112, 100, 'Stalars', 'Adrien', 'adrien-stalars@hotmail.com', 'Avenue Mathieu, 49 6600 Bastogne', 'Rue Louvrex, 14 4000 Liège', 'Rue de Droixhe 10, 4020 Liège', '+32471233784', '900.72', 1, NULL, '2019-01-16 07:39:42', '2019-01-17 20:31:59'),
(97, 113, 800, 'Gilissen', 'Lucas', 'gilissenlucas@gmail.com', 'Boulevard de la sauveniere 97 4000 Liège', 'Boulevard de la sauveniere 97 4000 Liège', 'Rue de droixhe 10 4000 Liège', '0497637170', '13510.8', 1, NULL, '2019-02-06 12:46:35', '2019-02-06 12:48:53'),
(98, 114, 600, 'Pierre', 'Vanhees', 'vanhees_pierre@hotmail.Fr', 'Rue hemricourt 20', 'Rue hemricourt 20 4000 liège', 'Rue de droixhe', '0499218786', '18600.64', 0, '2019-02-12 16:10:38', '2019-02-09 12:42:18', '2019-02-12 16:10:38'),
(99, 114, 600, 'Pierre', 'Vanhees', 'vanhees_pierre@hotmail.Fr', 'Rue hemricourt 20', 'Rue hemricourt 20 4000 liège', 'Rue de droixhe', '0499218786', '18600.64', 1, NULL, '2019-02-09 12:42:40', '2019-02-12 16:10:23'),
(100, 115, 200, 'Calers', 'vincent', 'vincmarcel@hotmail.com', 'route d\'ath,478 7050 Jurbise', 'Chemin du trèfle, 4 boite 3116 4000 Liège', 'rue de Droixhe, 10 4000 Liège', '0478583602', '3602.88', 1, NULL, '2019-02-11 15:54:09', '2019-02-11 19:21:53'),
(101, 116, 2200, 'Defourny', 'Mathilde', 'mamadefourny@hotmail.com', 'Rue André Reanrd 20 4430 Ans', 'Rue André Renard 20 4430 Ans', 'Rue de Droixhe 10 4020 Liège', '0496829842', '29679.68', 1, NULL, '2019-02-12 10:06:33', '2019-02-12 16:11:53'),
(102, 117, 1200, 'Romain', 'Cartenstart', 'romain.cartens@hotmail.com', 'Chaussée Brunehaut, 399', 'Chaussée Brunehaut, 399', 'Rue de Droixhe, 10  4000, Liège.', '+32490197498', '25439.36', 1, NULL, '2019-02-12 15:40:37', '2019-02-12 16:13:04'),
(103, 118, 1500, 'Doxins', 'Arnaud', 'criterium@hotmail.be', 'Rue Germinal 8 4610 Beyne-Heusay', 'Rue Germinal 8 4610 Beyne-Heusay', 'Rue de droixhe 10 4020 Liège', '0494179380', '20345.42', 1, NULL, '2019-02-13 10:53:22', '2019-02-13 11:02:36'),
(104, 120, 2200, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'Rue Hazinelle n6 4000 Liège', 'Rue Hazinelle n6 4000 Liège', 'n10 rue de Droixhe, Droixhe Liège 4020', '0499524530', '34549.68', 0, '2019-02-13 16:33:13', '2019-02-13 15:58:21', '2019-02-13 16:33:13'),
(105, 120, 2200, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'Rue Hazinelle n6 4000 Liège', 'Rue Hazinelle n6 4000 Liège', 'n10 rue de Droixhe, Droixhe Liège 4020', '0499524530', '33611.52', 0, '2019-02-18 06:18:08', '2019-02-13 16:42:44', '2019-02-18 06:18:08'),
(106, 121, 2200, 'Francois', 'Margot', 'Margot-francois@hotmail.fr', 'Rue du vieux pont, 20 Remouchamps', 'Rue du vieux pont, 20 Remouchamps', 'Rue de droixhe 10 Liège', '0494039363', '37190.4', 1, NULL, '2019-02-14 12:35:34', '2019-02-15 17:40:04'),
(107, 122, 1300, 'Zois', 'Nicolas', 'maureen-r@hotmail.be', '35 Rue De La Campagne 4500 Huy', '35 Rue De La Campagne 4500 Huy', 'Rue de Droixhe, 4020, Liège', '0497026711', '17400.8', 1, NULL, '2019-02-15 17:05:00', '2019-02-15 17:40:21'),
(108, 123, 2000, 'Briamont', 'Melanie', 'briamont.melanie@outlook.be', 'Rue de Rechain 36 4650 Chaineux', 'Rue Provinciale 18 4451 Voroux-Lez-Liers', 'Rue de Droixhe 10 4000 Liège', '0484324248', '29139.65', 1, NULL, '2019-02-15 22:31:36', '2019-02-16 15:38:23'),
(109, 120, 2200, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'Rue Hazinelle n6 4000 Liège', 'Rue Hazinelle n6 4000 Liège', 'n10 ru de droixhe', '0499524530', '34549.68', 1, NULL, '2019-02-16 18:44:45', '2019-02-18 06:18:37'),
(110, 124, 1250, 'Henrottin', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'rue de la roche 22', 'rue de la roche', 'rue de droixhe 10', '0495732954', '23473.52', 1, '2019-02-18 17:23:37', '2019-02-17 13:18:50', '2019-02-18 17:23:37'),
(111, 124, 1250, 'Henrottin', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'Rue de la roche 22', 'rue de la roche 22', 'rue de droixhe 10', '0495732954', '23773.76', 1, NULL, '2019-02-18 17:21:40', '2019-02-18 17:23:46'),
(112, 125, 1400, 'Gos', 'Benjamin', 'gosbenjamin.helmo@gmail.com', '11 rue du parc 4180 comblain-la-tour', 'Chemin de Huy 4 - Braives 4260', 'Rue de Droixhe 10, Liège 4020', '0497194038', '21849.6', 1, '2019-02-27 11:20:00', '2019-02-19 17:34:02', '2019-02-27 11:20:00'),
(113, 126, 2000, 'Theo', 'Evrard', 'evrard.theo24@gmail.com', 'Rue Nouvelle 14, 6810 Izel', 'Avenue Rogier 8, 4000 Liège', 'Rue de Droixhe 10, 4020', '0472276339', '32691.92', 1, NULL, '2019-02-20 14:42:34', '2019-02-20 14:59:20'),
(114, 127, 1200, 'Hornung', 'Gabriel', 'Gabrielhornung@hotmail.com', 'Rue Louvrex 14', 'Rue Louvrex 14', 'Salle de Guindaille (Rue de droixhe)', '0483535942', '26101.2', 1, NULL, '2019-02-22 15:30:24', '2019-02-23 14:15:51'),
(115, 128, 350, 'Machiels', 'Celine', 'Celinemachiels28@gmail.com', '24 Rue d\'Aywaille  4170 Comblain au Pont', '24 rue d\'Aywaille', 'Rue De Droixhe 10.   4000 LiÃ¨ge', '0494497021', '6488.98', 1, NULL, '2019-02-23 08:36:24', '2019-02-23 14:16:17'),
(116, 123, 2000, 'Briamont', 'Melanie', 'briamont.melanie@outlook.be', 'Rue de rechain 36 4650 chaineux', 'Rue provinciale 18 4451 voroux-lez-liers', 'Rue de Droixhe 10 4020 Liège', '0497293456', '29660.85', 0, '2019-02-25 10:45:36', '2019-02-25 10:18:30', '2019-02-25 10:45:36'),
(117, 123, 2000, 'Briamont', 'Melanie', 'briamont.melanie@outlook.be', 'Rue de rechain 36 4650 chaineux', 'Rue provinciale 18 4451 voroux-lez-liers', 'Rue de Droixhe 10 4020 Liège', '0497293456', '29660.85', 1, NULL, '2019-02-25 10:18:31', '2019-02-25 10:45:30'),
(118, 129, 600, 'Cambrelin', 'Sarah', 'camb.sarah@gmail.com', 'Rue  Hemricourt n°5, 4000 Liège', 'Rue  Hemricourt n°5, 4000 Liège', 'Rue de Droixhe 10, 4020 Liège', '0470053008', '12009.6', 0, '2019-02-27 11:20:30', '2019-02-27 07:52:46', '2019-02-27 11:20:30'),
(119, 129, 600, 'Sarah', 'Cambrelin', 'camb.sarah@gmail.com', 'Rue Hemricourt n°5, 4000 Liege', 'Rue Hemricourt n°5, 4000 Liège', 'Rue de Droixhe n°10, 4020 Liège', '0470053008', '15012', 0, '2019-02-27 11:20:21', '2019-02-27 10:21:39', '2019-02-27 11:20:21'),
(120, 125, 2000, 'Gos', 'Benjamin', 'gosbenjamin.helmo@gmail.com', '11 rue du parc 4180 comblain-la-tour', 'Chemin de Huy 4 - Braives 4260', 'Rue de Droixhe 10, Liège 4020', '0497194038', '31457.28', 1, NULL, '2019-02-27 11:41:25', '2019-03-01 14:25:18'),
(121, 130, 2100, 'Pecheur', 'Gaeten', 'pecheurgaetan@hotmail.com', 'rue aux terrasses 2A 4540 Amay', 'rue aux terrasses 2A 4540 Amay', 'Rue de Droixhe 10, 4020 Liège', '0499175894', '32645.12', 1, NULL, '2019-02-28 08:38:40', '2019-03-01 14:25:34'),
(122, 131, 750, 'Wilkin', 'Marie', 'wilkin.marie@hotmail.be', 'rue de droixhe', 'Chemin d\'amostrennes numero 22 4130 esneux', 'Rue de droixhe', '0491642565', '15715.36', 1, NULL, '2019-02-28 16:39:27', '2019-03-01 14:25:46'),
(123, 119, 2200, 'Jonlet', 'Donovan', 'dono45678@hotmail.com', 'Rue de l\'Ecluse', '11', 'Rue de Droixhe, 10 Liège', '0470582807', '39780.4', 1, NULL, '2019-03-01 08:04:05', '2019-03-01 14:25:57'),
(124, 132, 20, 'Louis', 'Romain', 'louisromain.be@hotmail.com', 'Rue de campine 47 /11', 'Rue de campine 47 /11', 'Salle de guindaille droixhe', '0494414132', '150.12', 1, NULL, '2019-04-01 07:50:51', '2019-04-03 21:16:48'),
(125, 134, 70, 'Defourny', 'Mathilde', 'mamadefourny@hotmail.com', 'Rue André Reanrd 20 4430 Ans', 'Rue André Renard 20 4430 Ans', 'Rue de Droixhe 10 4020 Liège', '0496829842', '2251.8', 0, '2019-04-27 12:47:14', '2019-04-19 09:11:23', '2019-04-27 12:47:14'),
(126, 135, 100, 'Defourny', 'Mathilde', 'mamadefourny@hotmail.com', 'Rue André Reanrd 20 4430 Ans', 'Rue André Renard 20 4430 Ans', 'Rue de Droixhe 10 4020 Liège', '0496829842', '2251.8', 1, NULL, '2019-04-19 10:36:38', '2019-04-27 12:47:18'),
(127, 136, 50, 'Lenart', 'Olivia', 'olivia.lenart@gmail.com', 'Anixhe 15 4458 Fexhe Slins', 'Anixhe 15 4458 Fexhe Slins', 'Place du 20-aout, 24 4000 Liège', '0483647383', '300.24', 1, NULL, '2019-04-22 16:14:10', '2019-04-27 12:47:28'),
(128, 137, 500, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'rue des golettes 19', 'Rue Hazinelle n6 4000 Liège', 'Boulevard de la Constitution n40 4000 Liège ( cour de Saint Luc )', '0499524530', '5172.15', 1, NULL, '2019-04-24 10:10:25', '2019-04-27 12:47:40'),
(129, 138, 50, 'Elaerts', 'Mathias', 'elaerts.mathias@gmail.com', 'rue des golettes 19', 'Rue Hazinelle n6 4000 Liège', 'Rue de Droixhe n10 (salle de guindaille)', '0499524530', '2251.8', 1, NULL, '2019-04-24 10:13:22', '2019-04-27 12:47:56'),
(130, 139, 60, 'Cornet', 'Justine', 'justine.cornet@hotmail.fr', '18, avenue Dr Pierre Gaspar 4900 Spa', '18, avenue Dr Pierre Gaspar 4900 Spa', 'Rue de Droixhe 10, 4020 Bressoux', '0475225890', '450.36', 1, NULL, '2019-04-26 09:33:01', '2019-04-27 12:48:05'),
(131, 140, 65, 'Pecheur', 'Gaëtan', 'pecheurgaetan@hotmail.com', 'rue aux terrasses 2A, 4540 Amay', 'rue aux terrasses 2A, 4540 Amay', 'rue de Droixhe 10, 4020 Liège', '0499175894', '2401.92', 1, NULL, '2019-06-04 17:08:10', '2019-06-16 11:40:46'),
(132, 141, 60, 'Théo', 'Evrard', 'evrard.theo24@gmail.com', 'Rue Nouvelle 14, 6810 Izel', 'Avenue Rogier 8, 4000 Liège', 'Rue de Droixhe 10, 4020 Liège', '+32475712704', '1523.75', 1, NULL, '2019-06-12 12:35:04', '2019-06-16 11:41:00'),
(133, 142, 100, 'Briamont', 'Melanie', 'briamont.melanie@outlook.be', 'Rue de Rechain 36 4650 Chaineux', 'Rue provinciale 18 4451 Voroux-lez-Liers', '10 rue de Droixhe 4020 Liège', '0497293456', '2773', 1, NULL, '2019-06-14 10:41:35', '2019-06-16 11:41:16'),
(134, 143, 100, 'Romain', 'Cartenstart', 'romain.cartens@hotmail.com', 'Chaussée Brunehaut, 399 Juprelle 4450', 'Rue Saint Gilles 378', 'Rue de Droixhe, 10  4000, Liège.', '+32489039489', '1951.56', 1, NULL, '2019-06-15 18:13:05', '2019-06-16 11:41:24'),
(135, 144, 70, 'Francois', 'margot', 'margot-francois@hotmail.fr', 'Rue de Droixhe 10', 'Rue du vieux pont, 20 4920 Remouchamps', 'Rue de Droixhe 10', '+32494039363', '2251.8', 1, NULL, '2019-06-16 05:59:33', '2019-06-16 11:42:18'),
(136, 145, 30, 'Leduc', 'François', 'francois.leduc@scarlet.be', 'Bois de la croix claire, 54,  4550 Nandrin', 'Bois de la croix claire, 54 4550 Nandrin', 'Rue de droixhe 10, 4020 Liège', '0494703529', '854.84', 1, NULL, '2019-06-24 13:01:06', '2019-06-25 03:41:39'),
(137, 147, 400, 'Henrottin', 'Maxime', 'Maxime.HENROTTIN@student.hel.be', 'rue de la roche', '22', 'Quai Gloesner 6, 4020 Liège', '0495732954', '1484.79', 1, NULL, '2019-08-29 11:25:00', '2019-09-01 00:22:55'),
(138, 151, 150, 'Defourny', 'Mathilde', 'defournymathilde@gmail.com', 'Rue André Reanrd 20 4430 Ans', 'Rue André Renard 20 4430 Ans', 'Rue de Droixhe 10 4020 Liège', '0496829842', '3753', 1, NULL, '2019-09-17 08:36:48', '2019-09-24 07:27:48'),
(139, 152, 200, 'Defourny', 'Mathilde', 'defournymathilde@gmail.com', 'Rue André Renard 20 4430 Ans', 'Rue André Renard 20 4430 Ans', 'Rue de Droixhe 10 4020 Liège', '0496829842', '4803.84', 0, '2019-10-02 10:58:16', '2019-09-24 10:36:05', '2019-10-02 10:58:16'),
(140, 68, 200, 'Radoux', 'Francois', 'francoisradoux@skynet.be', 'rue du Bois Rosine, 30 4577 Strée', 'rue du Bois Rosine, 30 4577 Strée', 'rue de Droixhe, 10 4020 Droixhe', '0472276339', '3302.64', 1, NULL, '2019-10-04 07:25:04', '2019-10-04 15:27:14'),
(141, 72, 70, 'Radoux', 'François', 'francoisradoux@skynet.be', 'rue du Bois Rosine, 30 4577 Strée', 'rue du Bois Rosine, 30 4577 Strée', 'rue A. Deponthiere à 4431 Ans', '0472276339', '3024.95', 1, NULL, '2019-10-12 14:03:09', '2019-10-12 16:52:22'),
(142, 153, 200, 'Klein', 'Igor', 'igor.klein001@gmail.com', '10 rue de Crombin 6900 Marche en Famenne', '10 rue de Crombin 6900 Marche en Famenne', '10 rue de Droixhe 4000 Liège', '+32495875604', '4503.6', 1, NULL, '2019-10-12 17:12:17', '2019-10-12 17:16:27'),
(143, 157, 500, 'Klein', 'Igor', 'igor.klein001@gmail.com', 'rue de crombin 10, 6900 Marche en Famenne', 'rue de crombin 10, 6900 Marche en Famenne', '10 rue de Droixhe 4000 Liège', '+32495875604', '7506', 1, NULL, '2019-10-18 07:19:35', '2019-10-18 10:04:43'),
(144, 156, 200, 'Baisi', 'Alexandre', 'alexandre.baisi@gmail.com', 'Rue Champ du Pihot 85B 4671 Saive', 'Rue Champ du Pihot 85B 4671 Saive', '10 Rue de Droixhe 4020 Liège', '0472785230', '6004.8', 0, '2019-10-18 10:00:03', '2019-10-18 09:54:16', '2019-10-18 10:00:03'),
(145, 158, 200, 'Baisi', 'Alexandre', 'alexandre.baisi@gmail.com', 'rue Champ du Pihot 85B 4671 Saive', 'rue Champ du Pihot 85B 4671 Saive', '10 Rue de Droixhe 4020 Liège', '0472785230', '6004.8', 1, NULL, '2019-10-18 10:03:43', '2019-10-18 10:04:14'),
(146, 78, 200, 'Radoux', 'Francois', 'francoisradoux@skynet.be', 'rue du Bois Rosine, 30 4577 Strée', 'rue du Bois Rosine, 30 4577 Strée', 'rue de Droixhe, 10  4020 Liège', '0472276339', '3707.12', 1, NULL, '2019-10-20 21:55:36', '2019-10-22 08:11:17'),
(147, 159, 150, 'Massard', 'Louis', 'Louis.massard@hotmail.com', 'Rue victor Libert, 20 6900 marche-en-famenne', 'Rue victor Libert, 20 6900 marche-en-famenne', 'Rue de Droixhe 10, 4020 Liège', '0496184594', '3002.4', 1, NULL, '2019-10-21 16:24:56', '2019-10-22 08:11:26'),
(148, 76, 55, 'Liegeois', 'Delphine', 'Delphineliegeois@hotmail.fr', 'Coloster', '20', 'Avenue Alfred deponthiere 54, 4431 loncin', '+32494824665', '1200.96', 0, '2019-10-24 16:01:27', '2019-10-23 16:24:38', '2019-10-24 16:01:27'),
(149, 76, 55, 'Liegeois', 'Delphine', 'Delphineliegeois@hotmail.fr', 'Coloster', '20', 'Avenue Alfred deponthiere 54, 4431 loncin', '+32494824665', '1200.96', 0, '2019-10-24 16:01:29', '2019-10-23 16:25:00', '2019-10-24 16:01:29'),
(150, 160, 250, 'Dhaese', 'Clemence', 'clemence.dhaese@hotmail.com', '44 rue Adrien David 4520 Bas-Oha', '14 Rue Haute Desnié 4910 Theux', 'Rue de Droixhe 10 4020 Liège', '0497175381', '4503.6', 1, NULL, '2019-10-24 13:58:46', '2019-10-24 15:55:45'),
(151, 161, 60, 'Liegeois', 'Delphine', 'Delphineliegeois@hotmail.fr', 'Coloster', '20', 'Avenue Alfred deponthiere 54, 4431 loncin', '+32494824665', '1200.96', 1, NULL, '2019-10-24 16:05:09', '2019-10-24 16:16:23'),
(152, 163, 300, 'Sadraimanesh', 'Karen', 'karen.sadraemanesh@gmail.com', 'Rue des Augustins', '41', 'Rue de Droixhe 10, 4020 Liège', '0489039489', '8256.6', 1, NULL, '2019-10-30 10:22:02', '2019-10-31 10:17:49'),
(153, 165, 200, 'Vigilante', 'Ophelie', 'ophelie20-08-97@hotmail.com', 'Rue d\'angleur 74 4420 MONTEGNEE', 'Rue d\'angleur 74, 4420 MONTEGNEE', 'Rue de droixhes 10, 4020 LIEGE', '0493638606', '6482.56', 1, NULL, '2019-10-30 10:37:40', '2019-11-01 16:54:44'),
(154, 166, 200, 'Liegeois', 'Delphine', 'Delphineliegeois@hotmail.fr', 'Coloster', '20', 'Rue de droixhe 10', '+32494824665', '2625.32', 1, NULL, '2019-10-31 09:01:10', '2019-10-31 10:18:38'),
(155, 86, 450, 'Radoux', 'Francois', 'francoisradoux@skynet.be', 'rue du Bois Rosine, 30 4577 Strée', 'rue du Bois Rosine, 30 4577 Strée', 'rue de Droixhe, 10 4020 Liège', '0472276339', '10508.4', 1, NULL, '2019-11-01 23:04:19', '2019-11-03 11:21:43'),
(156, 104, 150, 'LAURENT', 'Matthieu', 'm.laurent225@gmail.com', '8 rue de lamicht 6700 arlon', '8  rue de lamicht 6700 arlon', 'Rue de Droixhe 10, 4020 Liège', '0479405300', '2009.92', 1, NULL, '2019-11-05 11:29:15', '2019-11-06 13:32:41'),
(157, 169, 150, 'CB Pharma', 'CB Pharma', 'charlotte.antzorn@outlook.com', 'Clos des Masures 12 4052 Beaufays', 'Clos des Masures 12 4052 Beaufays', 'Rue de Droixhe 10 4020 Liège', '0472785230', '3602.88', 1, NULL, '2019-11-06 13:50:17', '2019-11-06 13:58:40'),
(158, 90, 650, 'Roulet', 'Olivier', 'olivier2396@gmail.com', 'rue de la Fontaine 1, 1420 Braine L\'Alleud', 'rue Alphonse Robert 94, 1315 Incourt', 'Rue de Droixhe 10, 4020 Liège', '0477761490', '10198.8', 1, NULL, '2019-11-06 16:37:53', '2019-11-08 10:30:37'),
(159, 170, 350, 'Massard', 'Louis', 'Louis.massard@hotmail.com', 'Rue Victor Libert, 20 6900 Marche-en-Famenne', 'Rue Victor Libert, 20 6900 Marche-en-Famenne', 'Rue de Droixhe 10, 4020 Liège', '0496184594', '8393.6', 1, NULL, '2019-11-07 13:27:42', '2019-11-08 10:30:47'),
(160, 171, 300, 'Klein', 'Igor', 'igor.klein001@gmail.com', 'rue de Crombin10', 'Rue de Crombin 10', '10 rue de Droixhe 4000 Liège', '+32495875604', '4712.08', 1, NULL, '2019-11-09 19:04:47', '2019-11-09 19:12:37'),
(161, 172, 200, 'Davreux', 'Faustine', 'faustinedavreux@hotmail.com', 'Rosière-la-Grande 52, 6640 Vaux-sur-Sûre', 'Rosière-la-Grande 52, 6640 Vaux-sur-Sûre', 'Rue de Droixhe 10, 4020 Liège', '0471229417', '8044.56', 1, NULL, '2019-11-11 13:52:58', '2019-11-11 20:00:41'),
(162, 174, 200, 'Baisi', 'Alexandre', 'alexandre.baisi@gmail.com', 'rue Champ du Pihot 4671 Saive', '85B', '10 Rue de Droixhe 4020 Liège', '0491323582', '6721.44', 1, NULL, '2019-11-12 13:39:54', '2019-11-12 13:40:03'),
(163, 100, 200, 'Close', 'Sebastien', 'seb_cl258123@outlook.fr', 'Rue Neuve', '109', 'Rue de Droixhe 10, 4020 Liège', '+32498131063', '3984.67', 1, NULL, '2019-11-14 15:53:51', '2019-11-14 22:07:54'),
(164, 178, 200, 'Baisi', 'Alexandre', 'mariee_f.10@hotmail.fr', 'rue Champ du Pihot', '85B', '10 Rue de Droixhe 4020 Liège', '0496156045', '5909.85', 1, NULL, '2019-11-15 18:24:57', '2019-11-15 18:25:09'),
(165, 180, 200, 'Htouar', 'Robin', 'robin.houart@gmail.com', 'Leon Evrard 11 1390 Bossut', 'Leon Evrard 11 1390 Bossut', 'rue de Droixhe 10 4020 Liège', '0473116447', '5105.74', 1, NULL, '2019-11-15 18:55:46', '2019-11-15 19:27:40'),
(166, 180, 200, 'Houart', 'Robin', 'robin.houart@gmail.com', 'Leon Evrard', '11', 'rue de Droixhe 10 4020 Liège', '0473116447', '5105.74', 0, '2019-11-15 19:27:33', '2019-11-15 18:56:24', '2019-11-15 19:27:33'),
(167, 181, 350, 'Dengis', 'Simon', 'simon.dengis@hotmail.com', 'Rue Sainte-Walburge, 86', 'Rue Sainte-Walburge, 86', 'Salle de Droixhe : Rue de Droixhe 10, 4020 Liège', '0496171791', '6667.5', 1, NULL, '2019-11-15 19:09:26', '2019-11-15 19:28:20'),
(168, 179, 250, 'Delbrouck', 'Aurélie', 'aureliedelbrouck@hotmail.com', 'Rue haute Desnié 14 4910 Theux', 'Rue Haute Desnié 14 4910 Theux', 'Rue de Droixhe 10 4020 Liège', '+32497175381', '4335', 1, NULL, '2019-11-15 19:32:45', '2019-11-15 19:35:23'),
(169, 182, 400, 'Titeux', 'Manon', 'manon.titeux1301@gmail.com', 'Allée Verte 45 4600 Visé', 'Impasse Hardy 8 4000 Liege', 'Rue de droixhe (chapi)', '0497363464', '8700.4', 1, NULL, '2019-11-16 17:42:53', '2019-11-16 19:21:51'),
(170, 189, 300, 'Fassotte', 'Louise', 'fassottelouise@gmail.com', 'Rue du haut village, 29b - 4960 Malmedy', 'Rue de l\'Université, 26 - 4000 Liège', 'Rue de Droixhe, 10 - 4020 Liège', '0492600043', '8293.28', 1, NULL, '2019-11-18 13:05:07', '2019-11-18 16:27:50'),
(171, 190, 300, 'Baisi', 'Alexandre', 'alexandre.baisi@gmail.com', 'rue Champ du Pihot 85B 4671 Saive', 'rue Champ du Pihot 85B 4671 Saive', '10 Rue de Droixhe 4020 Liège', '0483535942', '9187.2', 1, NULL, '2019-11-21 18:01:36', '2019-11-21 18:01:47'),
(172, 191, 200, 'Baisi', 'Alexandre', 't.ypersiel@gmail.com', 'rue Champ du Pihot 85B 4671 Saive', 'rue Champ du Pihot 85B 4671 Saive', '10 Rue de Droixhe 4020 Liège', '0475417499', '0', 0, '2019-11-21 18:53:32', '2019-11-21 18:52:43', '2019-11-21 18:53:32'),
(173, 191, 200, 'Baisi', 'Alexandre', 't.ypersiel@gmail.com', 'rue Champ du Pihot 85B 4671 Saive', 'rue Champ du Pihot 85B 4671 Saive', '10 Rue de Droixhe 4020 Liège', '0475417499', '3405.52', 1, NULL, '2019-11-21 18:53:19', '2019-11-21 18:53:42'),
(174, 192, 300, 'Pidutti', 'Thomas', 'thomas.pidutti@hotmail.be', 'Rue provinciale 18, 4451 Voroux-Les-Liers', 'Rue provinciale 18, 4451 Voroux-Les-Liers', 'Rue de Droixhe, 10', '0498564159', '5372.89', 1, NULL, '2019-11-23 12:02:29', '2019-11-23 12:03:08'),
(175, 194, 1000, 'Sadraiemanesh', 'Karen', 'k.sadraimanesh@student.uliege.be', 'Rue des Augustins 41, 4000 Liège', 'Rue des Augustins 41, 4000  Liège', 'Rue de Droixhe 10, 4020 Liège', '0489039489', '24571.4', 1, NULL, '2020-01-02 18:33:41', '2020-01-05 19:21:14'),
(176, 193, 2200, 'Ypersiel', 'Thomas', 't.ypersiel@gmail.com', '8c, rue d\'Hervin, 6927 Resteigne', '91, quai de Rome, 4000 Liège', '10, rue de Droixhe, 4020 Liège', '+32475417499', '32676', 1, NULL, '2020-01-03 13:27:18', '2020-01-05 19:21:00'),
(177, 193, 2200, 'Ypersiel', 'Thomas', 't.ypersiel@gmail.com', '8c, rue d\'Hervin, 6927 Resteigne', '91, quai de Rome, 4000 Liège', '10, rue de Droixhe, 4020 Liège', '+32475417499', '32676', 1, '2020-01-05 19:20:47', '2020-01-03 13:27:49', '2020-01-05 19:20:47'),
(178, 195, 2400, 'CB Pharma', 'CB Pharma', 'charlotte.antzorn@outlook.com', 'Clos les Masures 12 4052 Beaufays', 'Clos les Masures 12 4052 Beaufays', 'Rue de Droixhe 10 4020 Liège', '0472785230', '40380.4', 1, NULL, '2020-01-06 18:50:26', '2020-01-09 10:53:21'),
(179, 196, 900, 'Hilgers', 'Andrea', 'AndreaHilgershilgersandrea@hotmail.com', 'Atzerath 12, 4780 Saint Vith', 'Atzerath 12, 4780 Saint Vith', 'Rue de Droixhe 10', '0470062491', '14457.41', 1, NULL, '2020-01-07 17:39:07', '2020-01-09 10:53:11'),
(180, 197, 1500, 'Detry', 'Astrid', 'astrid.detry@hotmail.be', 'Thier', '1', 'Rue de Droixhe, 10  4000 Liège', '+32476683360', '24951.1', 1, NULL, '2020-01-20 19:00:58', '2020-01-23 11:48:21'),
(181, 199, 2200, 'Massard', 'Louis', 'Louis.massard@hotmail.com', 'Rue Victor Libert, 20 6900 Marche-en-Famenne', 'Rue Victor Libert, 20 6900 Marche-en-Famenne', 'Rue de Droixhe 10, 4020 Liège', '0496184594', '31144.8', 1, NULL, '2020-01-25 13:32:43', '2020-01-26 16:24:22'),
(182, 200, 1000, 'Dhaese', 'Clemence', 'clemence.dhaese@hotmail.com', '14 rue Haute Desnié 4910 Theux', '14 Rue Haute Desnié 4910 Theux', 'Rue de Droixhe 10 4020 Liège', '0497175381', '18895.2', 1, NULL, '2020-01-26 11:02:41', '2020-01-26 16:24:10'),
(183, 201, 350, 'Close', 'Sébastien', 'seb_cl258123@outlook.fr', 'Rue Neuve 109', 'Rue Neuve 109', 'Rue de Droixhe 10, 4020 Liège', '0498131063', '7656', 1, NULL, '2020-01-27 20:24:15', '2020-01-28 20:36:37'),
(184, 198, 500, 'Dengis', 'Simon', 'simon.dengis@hotmail.com', 'Rue Sainte-Walburge, 86', 'Rue Sainte-Walburge, 86', 'Salle de Droixhe : Rue de Droixhe 10, 4020 Liège', '0496171791', '16341.36', 1, NULL, '2020-01-28 19:37:05', '2020-01-28 20:36:52'),
(185, 202, 200, 'Baisi', 'Alexandre', 'vincmarcel@hotmail.com', 'rue Champ du Pihot 85B 4671', 'Rue Champ du Pihot 85B 4671', '10 Rue de Droixhe 4020 Liège', '0496156045', '5108.32', 1, NULL, '2020-01-29 09:12:48', '2020-01-29 09:13:05'),
(186, 203, 2200, 'Fassotte', 'Louise', 'fassottelouise@gmail.com', 'Rue du haut village, 29 B - 4960 Malmedy', 'Rue de l\'Université, 26 - 4000 Liège', 'Rue de Droixhe, 10 - 4020 Liège', '0492600043', '38311.6', 1, NULL, '2020-01-30 15:44:53', '2020-02-02 12:51:50'),
(187, 204, 2200, 'Roulet', 'Olivier', 'olivier2396@gmail.com', 'Rue De La fontaine 1 1420 braine la Leup', 'Rue Alponse Robert 94 1315 Incourt', 'Rue de Droixhe 10 4020 liege', '0499312031', '39440.8', 1, NULL, '2020-02-01 09:20:27', '2020-02-02 12:51:53'),
(188, 205, 700, 'Baisi', 'Alexandre', 'alexandre.baisi@gmail.com', 'rue Champ du Pihot 85 B Saive', 'rue Champ du Pihot 85 B Saive', '10 Rue de Droixhe 4020 Liège', '0496156045', '13780.8', 1, NULL, '2020-02-02 12:53:05', '2020-02-02 12:53:13'),
(189, 208, 1150, 'Davreux', 'Faustine', 'faustinedavreux@hotmail.com', 'Rosière-la-Grande 52,6640 Vaux-sur-Sûre', 'Rosière-la-Grande 52, 6640 Vaux-sur-Sûre', 'Rue de Droixhe 10, 4020 Liège', '0471229417', '21621.2', 1, NULL, '2020-02-04 17:07:00', '2020-02-04 19:27:13'),
(190, 209, 200, 'Dengis', 'Simon', 'simon.dengis@hotmail.com', 'Rue Sainte-Walburge, 86', 'Rue Sainte-Walburge, 86', 'Salle de Droixhe : Rue de Droixhe 10, 4020 Liège', '0496171791', '3435.92', 1, NULL, '2020-02-05 08:39:20', '2020-02-08 15:33:01'),
(191, 210, 1000, 'VIGILANTE', 'Ophélie', 'ophelie20-08-97@hotmail.com', 'Rue d\'Angleur 74', 'Rue d\'angleur 74 4420 Montegnée', 'Rue de droixhe 10, 4000 Liège', '0493638606', '10755.2', 1, NULL, '2020-02-06 16:04:21', '2020-02-08 15:33:11'),
(192, 126, 2000, 'Radoux', 'Francois', 'francoisradoux@skynet.be', 'rue du Bois Rosine, 30 4577 Strée', 'rue du Bois Rosine, 30 4577 Strée', 'rue de Droixhe 10, 4020 Liège', '0472276339', '29950.4', 1, NULL, '2020-02-09 07:34:51', '2020-02-11 16:41:55'),
(193, 212, 1500, 'Baisi', 'Alexandre', 'adrien-stalars@hotmail.com', 'rue Champ du Pihot 85 B 4671 Saive', 'rue Champ du Pihot 85 B 4671 Saive', '10 Rue de Droixhe 4020 Liège', '0471233784', '25356.8', 1, NULL, '2020-02-11 16:41:36', '2020-02-11 16:41:45'),
(194, 213, 2000, 'Baisi', 'Alexandre', 'chloelannoy@hotmail.com', 'rue Champ du Pihot 85 B 4671 Saive', 'rue Champ du Pihot 85 B 4671 Saive', '10 Rue de Droixhe 4020 Liège', '0498564159', '28916.45', 1, NULL, '2020-02-11 16:44:15', '2020-02-11 16:44:23'),
(195, 214, 1300, 'Klein', 'Igor', 'igor.klein001@gmail.com', 'rue de crombin 10, 6900 Marche en Famenne', 'rue de crombin 10, 6900 Marche en Famenne', '10 rue de Droixhe 4000 Liège', '0495875604', '26551.2', 1, NULL, '2020-02-14 10:53:34', '2020-02-16 13:21:20'),
(196, 214, 1300, 'Klein', 'Igor', 'igor.klein001@gmail.com', 'rue de crombin 10, 6900 Marche en Famenne', 'rue de crombin 10, 6900 Marche en Famenne', '10 rue de Droixhe 4000 Liège', '0495875604', '0', 0, '2020-02-16 13:21:28', '2020-02-14 10:53:54', '2020-02-16 13:21:28'),
(197, 214, 1300, 'Klein', 'Igor', 'igor.klein001@gmail.com', 'rue de crombin 10, 6900 Marche en Famenne', 'rue de crombin 10, 6900 Marche en Famenne', '10 rue de Droixhe 4000 Liège', '0495875604', '26551.2', 0, '2020-02-16 13:21:31', '2020-02-14 11:02:28', '2020-02-16 13:21:31'),
(198, 215, 1000, 'Salvatella', 'Guillaume', 'tresorier@veterinexpo.be', 'Rue du Val-Benoît 123 4031 Liège', 'Rue du Val-Benoît 123 4031 Liège', '10 Rue de Droixhe 4020 Liège', '0495252932', '19813.2', 1, NULL, '2020-02-24 11:16:30', '2020-02-24 11:16:45'),
(199, 221, 20, 'Lemoine', 'Guillaume', 'lemoineguillaume@hotmail.com', 'Rue des Wallons n°22 - 4000 LIEGE', 'Rue des Wallons n°22 - 4000 LIEGE', 'Pas de livraison', '0497728843', '765.6', 1, NULL, '2021-07-08 07:23:55', '2021-08-20 07:19:31');
INSERT INTO `commandes_old` (`id`, `event_id`, `frequentation`, `nom`, `prenom`, `email`, `adresselegale`, `adressefacturation`, `adresselivraison`, `telephone`, `prixtotal`, `is_validated`, `deleted_at`, `created_at`, `updated_at`) VALUES
(200, 219, 1, 'Claessens', 'Xavier', 'xa.claessens@gmail.com', 'Place du XX aout 19/091 4000 Liege', 'Idem', 'Take away au dépôt Makart - Hesby Drink', '+32497898248', '459.36', 1, NULL, '2021-07-08 16:15:53', '2021-08-20 07:19:49'),
(201, 225, 600, 'Frankin', 'Clément', 'cl.frankin@hotmail.com', 'Rue saint Martin n14 4357 Limong', 'Rue de l’église n12 4357 Limont', 'Retrait au dépôt,  le samedi 18', '0491287572', '643.24', 1, NULL, '2021-09-06 10:16:40', '2021-09-07 10:16:13'),
(202, 226, 2500, 'Baisi', 'Alexandre', 'alexandre.baisi@gmail.com', 'rue Champ du Pihot', '85B', '10 rue de Droixhe', '+32496156045', '34835.51', 1, NULL, '2021-09-10 09:41:33', '2021-09-10 09:41:43'),
(203, 227, 1, 'Dumont', 'Olivier', 'olivierslts@hotmail.com', 'rue bassenge 13 4000 LIEGE', 'rue bassenge 13 4000 LIEGE', 'rue bassenge 13 4000 LIEGE', '+32498226404', '1608.1', 1, NULL, '2021-09-17 07:00:36', '2021-09-19 12:34:06'),
(204, 229, 500, 'Nelissen', 'Eva', 'evanelissen@hotmail.fr', 'rue Champ du Pihot', '85B', '10 rue de Droixhe', '+32496156045', '2914.9', 1, NULL, '2021-09-19 12:33:56', '2021-09-19 12:34:10'),
(205, 230, 500, 'Baisi', 'Alexandre', 'alexandre.baisi@gmail.com', '10 rue de Droixhe', '10 rue de Droixhe', '10 rue de Droixhe', '0476803874', '5949.97', 1, NULL, '2021-09-22 13:35:40', '2021-09-22 13:35:55'),
(206, 231, 500, 'Jacob', 'Gauthier', 'gau.jacob@gmail.com', '10 rue de Droixhe', '10 rue de Droixhe', '10 rue de Droixhe', '0498628327', '4341.87', 1, NULL, '2021-09-22 15:29:53', '2021-09-22 15:29:59'),
(207, 233, 50, 'Delcour', 'Florian', 'florian.delcour1@gmail.com', '3c rue Joseph Weicker, 6740 Villers-Sur-Semois', '3 rue Cathédrale, 4000 Liège', '3 rue Cathédrale, 4000 Liège', '0492765114', '321.62', 1, NULL, '2021-09-26 16:31:41', '2021-09-27 08:19:36'),
(208, 235, 2500, 'Lemarchand', 'Maxime', 'maximelemarchand00@gmail.com', '10 rue de Droixhe', '10 rue de Droixhe', '10 rue de Droixhe', '0492316596', '34734.96', 1, NULL, '2021-09-27 13:44:33', '2021-09-27 13:46:47'),
(209, 236, 2500, 'Lemarchand', 'Maxime', 'maximelemarchand00@gmail.com', '10 rue de Droixhe', '10 rue de Droixhe', '10 rue de Droixhe', '0492316596', '34734.96', 1, NULL, '2021-09-27 13:46:01', '2021-09-27 13:46:49'),
(210, 238, 250, 'Louis', 'Lucie', 'lucie.louis.8@gmail.com', 'rue jules cralle 247 4030 Grivegnée', 'rue jules cralle 247 4030 Grivegnée', 'Rue de Droixhe 10, 4020 Liège', '0499385062', '5628.35', 1, NULL, '2021-09-29 18:15:14', '2021-09-29 18:45:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commandes_old`
--
ALTER TABLE `commandes_old`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commandes_old`
--
ALTER TABLE `commandes_old`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
