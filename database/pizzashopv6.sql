-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 13 jan 2014 om 14:23
-- Serverversie: 5.6.11
-- PHP-versie: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `pizzashop`
--
CREATE DATABASE IF NOT EXISTS `pizzashop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pizzashop`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `promo_status` tinyint(1) NOT NULL DEFAULT '0',
  `promo_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `articles`
--

INSERT INTO `articles` (`id`, `name`, `description`, `image`, `price`, `promo_status`, `promo_price`, `category`) VALUES
(1, 'Pizza Hawaii', 'pizza met tomatensaus belegd met ham, champignons, ananas en mozarella', 'noimage.jpg', '13.00', 1, '9.00', 'pizza'),
(2, 'Coca Cola 33cl', '', 'noimage.jpg', '3.00', 0, '0.00', 'drank'),
(3, 'Pizza Pepperoni', 'pizza met tomatensaus belegd met pepperoni en mozarella', 'noimage.jpg', '12.00', 0, '10.00', 'pizza'),
(4, 'Pizza Margherita', 'pizza met tomatensaus belegd met mozarella', 'noimage.jpg', '10.00', 1, '7.50', 'pizza'),
(5, 'Pizza Supreme', 'pizza met tomatensaus belegd met rundsvlees, pepperoni, champignons, groene paprika en mozarella', 'noimage.jpg', '15.00', 0, '12.00', 'pizza'),
(6, 'Pizza BBQ', 'pizza met bbq-saus belegd met rundsvlees, gerookte bacon en mozarella', 'noimage.jpg', '16.00', 0, '13.00', 'pizza'),
(7, 'Fanta 33cl', '', 'noimage.jpg', '3.00', 0, '0.00', 'drank'),
(8, 'Spa rood 50cl', '', 'noimage.jpg', '4.00', 0, '0.00', 'drank'),
(10, '7 UP 33cl', '', 'noimage.jpg', '2.50', 0, '2.00', 'drank');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `categories`
--

INSERT INTO `categories` (`name`) VALUES
('drank'),
('pizza');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `telephone` int(11) NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `address`, `postcode`, `city`, `telephone`, `active_status`, `username`) VALUES
(4, 'Thomas', 'Deserranno', 'Moerkerkesteenweg 9', '8340', 'Damme', 50358178, 1, 'Thomas'),
(7, 'Peter', 'Van Nieuwehuyse', 'westendelaan 1', '8400', 'Oostende', 1234567, 1, 'Peter'),
(8, 'Bert', 'Vandecasteele', 'Daverloostraat 55', '8310', 'Assebroek', 1234567, 1, 'Bert');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `deliveryzones`
--

CREATE TABLE IF NOT EXISTS `deliveryzones` (
  `shopid` int(11) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `delivery_cost` int(4) NOT NULL,
  PRIMARY KEY (`shopid`,`postcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `deliveryzones`
--

INSERT INTO `deliveryzones` (`shopid`, `postcode`, `delivery_cost`) VALUES
(1, '8000', 2),
(1, '8310', 2),
(1, '8340', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderlines`
--

CREATE TABLE IF NOT EXISTS `orderlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `articleid` (`articleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Gegevens worden uitgevoerd voor tabel `orderlines`
--

INSERT INTO `orderlines` (`id`, `orderid`, `articleid`, `quantity`, `price`) VALUES
(25, 12, 5, 2, '15.00'),
(26, 12, 8, 2, '4.00'),
(27, 13, 6, 1, '16.00'),
(28, 13, 1, 1, '9.00'),
(29, 13, 2, 2, '3.00'),
(30, 14, 4, 2, '7.50'),
(31, 14, 2, 2, '3.00'),
(32, 15, 5, 1, '15.00'),
(33, 15, 10, 1, '2.50'),
(34, 16, 3, 3, '12.00'),
(35, 17, 3, 1, '12.00'),
(36, 17, 4, 1, '7.50');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderlines_toppings`
--

CREATE TABLE IF NOT EXISTS `orderlines_toppings` (
  `orderlineid` int(11) NOT NULL,
  `toppingid` int(11) NOT NULL,
  PRIMARY KEY (`orderlineid`,`toppingid`),
  KEY `orderlines_toppings_ibfk_2` (`toppingid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `orderlines_toppings`
--

INSERT INTO `orderlines_toppings` (`orderlineid`, `toppingid`) VALUES
(28, 4),
(36, 4),
(25, 5),
(32, 5),
(35, 5),
(25, 6),
(30, 6),
(32, 6),
(27, 8),
(34, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `delivery_type` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerid` (`customerid`),
  KEY `shopid` (`shopid`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `date`, `delivery_type`, `status`, `customerid`, `shopid`) VALUES
(12, '2014-01-13 14:17:17', 'deliver', 1, 4, 1),
(13, '2014-01-13 14:17:49', 'deliver', 1, 4, 1),
(14, '2014-01-13 14:18:18', 'deliver', 1, 8, 1),
(15, '2014-01-13 14:18:41', 'deliver', 1, 8, 1),
(16, '2014-01-13 14:19:00', 'pickup', 1, 8, 1),
(17, '2014-01-13 14:19:31', 'pickup', 1, 7, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderstatus`
--

CREATE TABLE IF NOT EXISTS `orderstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `description`) VALUES
(1, 'bestelling ontvangen'),
(2, 'bestelling klaar'),
(3, 'onderweg voor levering'),
(4, 'geleverd'),
(5, 'gesloten');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `shops`
--

INSERT INTO `shops` (`id`, `address`, `postcode`, `city`) VALUES
(1, 'Maalsesteenweg 151', '8310', 'Sint-Kruis');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `toppings`
--

CREATE TABLE IF NOT EXISTS `toppings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `toppings`
--

INSERT INTO `toppings` (`id`, `name`, `price`) VALUES
(4, 'ham', '1.50'),
(5, 'mozarella', '1.00'),
(6, 'champignons', '1.25'),
(7, 'ananas', '1.50'),
(8, 'kip', '1.80'),
(9, 'augurken', '1.00'),
(10, 'pepperoni', '1.50');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` char(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `admin`) VALUES
('admin', '$2y$10$pgSBJOIizHHNoyLzuvE3c.4P9ZrlCbDcb1Vjsbfdt7Zze4pcH8som', 'admin@vdabpizzashop.be', 1),
('Bert', '$2y$10$Fkaw3PG9jag//Y6on38c2.Su2F2oRh.n1NFvvRaWw07nKx.i5ATLm', 'blala@bla.bla', 0),
('Peter', '$2y$10$DgzhUlt2kFhE5tszWrkYkOieSvdwl.33QMPFOh2rzmCqjOaVjeW5u', 'peter@design.be', 0),
('Thomas', '$2y$10$aqdSt48/rAKpeH5uuQtCw.gShlci5t7dTzVNn39w03sL0pvQlWXYm', 'thomas.deserranno@gmail.com', 0);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`name`);

--
-- Beperkingen voor tabel `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `deliveryzones`
--
ALTER TABLE `deliveryzones`
  ADD CONSTRAINT `deliveryzones_ibfk_1` FOREIGN KEY (`shopid`) REFERENCES `shops` (`id`);

--
-- Beperkingen voor tabel `orderlines`
--
ALTER TABLE `orderlines`
  ADD CONSTRAINT `orderlines_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderlines_ibfk_2` FOREIGN KEY (`articleid`) REFERENCES `articles` (`id`);

--
-- Beperkingen voor tabel `orderlines_toppings`
--
ALTER TABLE `orderlines_toppings`
  ADD CONSTRAINT `orderlines_toppings_ibfk_1` FOREIGN KEY (`orderlineid`) REFERENCES `orderlines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderlines_toppings_ibfk_2` FOREIGN KEY (`toppingid`) REFERENCES `toppings` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shopid`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`status`) REFERENCES `orderstatus` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
