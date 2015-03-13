-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 11 mars 2015 kl 14:03
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
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `namn` varchar(30) NOT NULL,
  `efternamn` varchar(30) NOT NULL,
  `telenummer` varchar(30) NOT NULL,
  `adress` varchar(30) NOT NULL,
  `ort` varchar(30) NOT NULL,
  `postnummer` varchar(30) NOT NULL,
  `land` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `inlogg`
--

INSERT INTO `inlogg` (`email`, `password`, `namn`, `efternamn`, `telenummer`, `adress`, `ort`, `postnummer`, `land`) VALUES
('', '', '', '', '', '', '', '', ''),
('albin@albin.se', 'qwe', '', '', '', '', '', '', ''),
('anton@anton.se', 'anton', '', '', '', '', '', '', ''),
('calle@calle.calle', 'calle', '', '', '', '', '', '', ''),
('carl@carl.carl', 'carl', '', '', '', '', '', '', ''),
('gah@gah.se', 'gah', '', '', '', '', '', '', ''),
('go@away.se', 'go@home.se', '', '', '', '', '', '', ''),
('go@home.se', 'go@home', '', '', '', '', '', '', ''),
('hej@hej.se', 'hej', '', '', '', '', '', '', ''),
('ja@ja.se', 'ja', '', '', '', '', '', '', ''),
('jup@jupp', 'jup', '', '', '', '', '', '', ''),
('kul@kul.kul', 'kul', '', '', '', '', '', '', ''),
('po@po.se', 'po', '', '', '', '', '', '', ''),
('qw@qw.qw', 'qw', '', '', '', '', '', '', ''),
('up@up', 'up', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `produkter`
--

CREATE TABLE IF NOT EXISTS `produkter` (
`id` int(11) NOT NULL,
  `pris` int(10) NOT NULL,
  `namn` varchar(15) NOT NULL,
  `märke` varchar(15) NOT NULL,
  `plagg` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `bild` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumpning av Data i tabell `produkter`
--

INSERT INTO `produkter` (`id`, `pris`, `namn`, `märke`, `plagg`, `gender`, `bild`) VALUES
(1, 346, 'fin tshirt', 'diesel', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(2, 7437, 'dyr tshirt', 'yoloswag', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(3, 19219, 'fina jeans', 'Levi''s', 'JEANS', 'TJEJ', 'http://i.imgur.com/fu4PrlO.jpg'),
(4, 199, 'hej', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(6, 199, 'hasd', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(7, 199, 'htjrtfj', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(8, 199, '694679', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(9, 199, 'rjh4', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(10, 199, '3487e', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(11, 199, 'heah', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(12, 199, 'hfrjs', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(13, 199, 'dfnhw', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(14, 199, 'djmed', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(15, 199, 'rftyjsa', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(16, 199, 'dzn', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(17, 199, 'vanhae', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(18, 199, 'anae5rn', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg'),
(19, 199, 'fgjmsx', 'skank', 'TSHIRT', 'KILLE', 'http://i.imgur.com/fu4PrlO.jpg');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `inlogg`
--
ALTER TABLE `inlogg`
 ADD UNIQUE KEY `email` (`email`);

--
-- Index för tabell `produkter`
--
ALTER TABLE `produkter`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `namn` (`namn`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `produkter`
--
ALTER TABLE `produkter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;