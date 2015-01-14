-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 14 jan 2015 kl 09:27
-- Serverversion: 5.6.14
-- PHP-version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `slutprojekt`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `inlogg`
--

CREATE TABLE IF NOT EXISTS `inlogg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumpning av Data i tabell `inlogg`
--

INSERT INTO `inlogg` (`id`, `username`, `password`) VALUES
(1, 'meaxt', 'meaxt'),
(2, 'antomen', 'antomen'),
(4, '123', '123'),
(5, '123', '123'),
(6, 'hej', 'hej'),
(7, '', ''),
(8, '', ''),
(9, '', ''),
(10, '', ''),
(11, '', ''),
(12, '', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `produkter`
--

CREATE TABLE IF NOT EXISTS `produkter` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Namn` varchar(20) NOT NULL,
  `Pris` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumpning av Data i tabell `produkter`
--

INSERT INTO `produkter` (`Id`, `Namn`, `Pris`, `brand`, `color`, `category`) VALUES
(17, 'Yee', 1295, 'AntonCo', 'Vit', 'Jackor'),
(18, 'Yoo', 295, 'AntonCo', 'Svart', 'Jackor'),
(19, 'Hulla', 999, 'AntonCo', 'Rosa', 'Jackor'),
(20, 'Tera', 683, 'MattiasCo', 'Gul', 'Jackor'),
(21, 'Weho', 8672, 'MattiasCo', 'Brun', 'Jackor'),
(22, 'Trumpa', 674, 'MattiasCo', 'Vit', 'Skjortor'),
(23, 'rolig', 572, 'AntonCo', 'Svart', 'Skjortor'),
(24, 'Alla', 225, 'MattiasCo', 'Svart', 'Jeans'),
(25, 'Bla', 795, 'AntonCo', 'Brun', 'Jeans'),
(26, 'hoj', 687, 'MattiasCo', 'Svart', 'T-shirt'),
(27, 'gutt', 2545, 'AntonCo', 'Vit', 'T-shirt');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
