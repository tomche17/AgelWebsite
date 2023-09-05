-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Host: axelcardjaagel.mysql.db
-- Generation Time: Oct 02, 2021 at 02:22 PM
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
-- Table structure for table `comites`
--

CREATE TABLE `comites` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comites`
--

INSERT INTO `comites` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Archi', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(2, 'CBA', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(3, 'Barbou', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(4, 'Dentisterie', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(5, 'Droit', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(6, 'GDL', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(7, 'Gramme', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(8, 'HEC', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(9, 'Ingé', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(10, 'Info', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(11, 'ISEPK', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(12, 'ISIL', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(13, 'ISIS', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(14, 'Jonfosse', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(15, 'Médecine', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(16, 'Paludia', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(17, 'Pharma', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(18, 'Philo', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(19, 'Psycho', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(20, 'Rivageois', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(21, 'Sainte Croix', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(22, 'Sainte Julienne', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(23, 'Saint Laurent', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(24, 'Sciences', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(25, 'Seraing', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(26, 'Verviers', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(27, 'AGEL', '2017-11-02 18:35:18', '2017-11-02 18:35:18'),
(28, 'Autres', '2017-11-02 18:35:18', '2017-11-02 18:35:18');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `comites`
--
ALTER TABLE `comites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comites`
--
ALTER TABLE `comites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
