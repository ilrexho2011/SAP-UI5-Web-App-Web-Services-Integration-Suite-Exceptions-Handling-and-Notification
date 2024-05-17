-- phpMyAdmin SQL Dump
-- PHP Version: 8.2.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 15:52 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 8.2.4

-- Create Schema at Server
CREATE SCHEMA `albsale` ;
-- Schema created continue with tables

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `albsale-vlora`
--

-- --------------------------------------------------------

--
-- Strukturimi i tabeles `salt`
--

DROP TABLE IF EXISTS `salt`;
CREATE TABLE `salt` (
  `saltcode` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `producer` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `priceperunit` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Shtimi i te dhenave per tabelen `salt`
--

INSERT INTO `salt` (`saltcode`, `title`, `producer`, `stock`, `unit`, `priceperunit`, `currency`) VALUES
(13455, 'Jodiertes_Speisesalz', 'Albsale', '200', 'Ton', '955', 'EU'),
(456124, 'Hochwertiges_Korallensalz', 'Albsale', '150', 'Ton', '1270', 'EU'),
(245656, 'Reines_Industriesalz', 'Albsale', '1900', 'Ton', '955', 'EU'),
(35345, 'Rohes_Meersalz', 'Albsale', '1200', 'Ton', '654', 'EU'),
(44353, 'Straßen_Salz', 'Dhrovjan', '5200', 'Ton', '265', 'EU'),
(587564, 'Gemahlenes_Steinsalz', 'Dhrovjan', '18900', 'Ton', '192', 'EU'),
(654323, 'Laborsalz', 'Albsale', '90', 'Ton', '2155', 'EU'),
(651123, 'Geräuchertes_Salz', 'Albsale', '190', 'Ton', '3225', 'EU'),
(785123, 'Schwarzes_Salz', 'Skrofotine', '120', 'Ton', '1375', 'EU');

-- --------------------------------------------------------

--
-- Strukturimi i tabeles `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `ZINN` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Shtimi i te dhenave per tabelen `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `ZINN`, `email`, `tel`) VALUES
(01, 'Joni', 'Sula', 'Sj03857', 'sulajn@big-market.com', '0692335489'),
(02, 'Tomi', 'Devole', 'Ad03984', 'tomi.devole@aldi-nord.de', '0693403857'),
(03, 'Niku', 'Ferhati', 'Fi03746', 'ferhatin@conad.com', '0682547896'),
(04, 'Robert', 'Kona', 'Ki03958', 'konar@spar.com', '0694735687'),
(05, 'Lulzim', 'Canaj', 'Bi03286', 'canajl@chemiche-lab.pl', '0693403857'),
(06, 'Alesia', 'Deda', 'Ma03856', 'deda.alesia@herti.com', '0682635891'),
(07, 'Ilirjan', 'Rexho', 'Ti09345', 'ilre@bashkia-vlore.net', '0696919362'),
(08, 'Artan', 'Bello', 'A546834', 'artan.bello@furribukes.de', '0696912657'),
(09, 'Zymbyl', 'Qaramani', 'A415654', 'qaramani.z@marketilagjes.com', '0695965491'),
(10, 'Bora', 'Haxhiu', 'A7674', 'borah@gmail.com', '06824125874'),
(11, 'Ama', 'Neti', 'S2587', 'amaneti@gmail.com', '0685469871'),
(12, 'Jonida', 'Shehu', 'D6666', 'kinginthenorth@yahoo.com', '0698965121'),
(13, 'Gerald', 'Rexho', 'G1109', 'grexho17@gmail.com', '0682158647');
COMMIT;

--
-- Table structure for table `salesorder`
--

DROP TABLE IF EXISTS `salesorder`;
CREATE TABLE `salesorder` (
  `idso` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `ZINN` varchar(30) NOT NULL,
  `saltcode` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `value` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `salesorder` (`idso`, `ZINN`, `saltcode`, `title`, `quantity`, `unit`, `value`, `currency`) VALUES
('01', 'A7674', '13455', 'Jodiertes Speisesalz', '20', 'Ton', '1910', 'EU');
COMMIT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salt`
--
/* ALTER TABLE `salt`
    ADD PRIMARY KEY (`saltcode`); */

--
-- Indexes for table `user`
--
/* ALTER TABLE `user`
    ADD PRIMARY KEY (`id`); */
