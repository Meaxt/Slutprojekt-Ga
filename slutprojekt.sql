-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 12 jan 2015 kl 10:52
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumpning av Data i tabell `produkter`
--

INSERT INTO `produkter` (`Id`, `Namn`, `Pris`, `brand`, `color`, `category`) VALUES
(2, 'Twerk', 16, '', '', ''),
(11, 'Antons dator', 420, '', '', ''),
(13, 'Hej', 123, 'Jo', 'Vit', 'Yee'),
(14, 'Hej', 123, 'Jo', 'Vit', 'Yee'),
(15, 'Te', 90000, 'asd', 'dhasd', 'duasd'),
(16, 'anton', 1337, 'Nylund', 'VIt', 'Human');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
