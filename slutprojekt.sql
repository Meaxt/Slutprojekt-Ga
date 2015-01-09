-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 09 jan 2015 kl 14:50
-- Serverversion: 5.6.20
-- PHP-version: 5.5.15

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
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
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
`Id` int(11) NOT NULL,
  `Namn` varchar(20) NOT NULL,
  `Pris` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumpning av Data i tabell `produkter`
--

INSERT INTO `produkter` (`Id`, `Namn`, `Pris`, `brand`, `color`, `category`) VALUES
(2, 'Twerk', 16, '', '', ''),
(11, 'Antons dator', 420, '', '', ''),
(13, 'Hej', 123, 'Jo', 'Vit', 'Yee'),
(14, 'Hej', 123, 'Jo', 'Vit', 'Yee'),
(15, 'Te', 90000, 'asd', 'dhasd', 'duasd');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `inlogg`
--
ALTER TABLE `inlogg`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `produkter`
--
ALTER TABLE `produkter`
 ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `inlogg`
--
ALTER TABLE `inlogg`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT för tabell `produkter`
--
ALTER TABLE `produkter`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
