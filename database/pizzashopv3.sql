-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 08 jan 2014 om 16:27
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
  `promo_status` tinyint(1) NOT NULL,
  `promo_price` decimal(10,2) NOT NULL,
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `articles`
--

INSERT INTO `articles` (`id`, `name`, `description`, `image`, `price`, `promo_status`, `promo_price`, `category`) VALUES
(1, 'Pizza Hawaii', 'pizza met tomatensaus belegd met ham, champignons, ananas en mozarella', '', '11.00', 0, '8.50', 'pizza'),
(2, 'Coca Cola 33cl', '', '', '3.00', 0, '0.00', 'drank'),
(3, 'Pizza Pepperoni', 'pizza met tomatensaus belegd met pepperoni en mozarella', '', '12.00', 0, '10.00', 'pizza'),
(4, 'Pizza Margherita', 'pizza met tomatensaus belegd met mozarella', '', '10.00', 1, '7.50', 'pizza'),
(5, 'Pizza Supreme', 'pizza met tomatensaus belegd met rundsvlees, pepperoni, champignons, groene paprika en mozarella', '', '15.00', 0, '12.00', 'pizza'),
(6, 'Pizza BBQ', 'pizza met bbq-saus belegd met rundsvlees, gerookte bacon en mozarella', '', '16.00', 0, '13.00', 'pizza'),
(7, 'Fanta 33cl', '', '', '3.00', 0, '0.00', 'drank'),
(8, 'Spa rood 50cl', '', '', '4.00', 0, '0.00', 'drank');

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
  `active_status` tinyint(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `address`, `postcode`, `city`, `active_status`, `username`) VALUES
(1, 'Thomas', 'Deserranno', 'Moerkerkesteenweg 9', '8340', 'Damme', 1, 'thomas');

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
(1, '8340', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderlines`
--

CREATE TABLE IF NOT EXISTS `orderlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `amount` int(4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `articleid` (`articleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `orderlines`
--

INSERT INTO `orderlines` (`id`, `orderid`, `articleid`, `amount`, `price`) VALUES
(1, 1, 1, 2, '10.00'),
(2, 1, 2, 2, '3.00'),
(3, 2, 3, 1, '12.00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderlines_toppings`
--

CREATE TABLE IF NOT EXISTS `orderlines_toppings` (
  `orderlineid` int(11) NOT NULL,
  `toppingid` int(11) NOT NULL,
  PRIMARY KEY (`orderlineid`,`toppingid`),
  KEY `toppingid` (`toppingid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `orderlines_toppings`
--

INSERT INTO `orderlines_toppings` (`orderlineid`, `toppingid`) VALUES
(1, 5),
(1, 7),
(1, 8),
(1, 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `delivery_time` datetime NOT NULL,
  `status` tinyint(2) NOT NULL,
  `customerid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerid` (`customerid`),
  KEY `shopid` (`shopid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `date`, `delivery_time`, `status`, `customerid`, `shopid`) VALUES
(1, '2014-01-01', '0000-00-00 00:00:00', 1, 1, 1),
(2, '2014-01-02', '2014-01-02 18:00:00', 1, 1, 1);

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
(4, 'ham', '1.75'),
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
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `admin`) VALUES
('admin', '$2y$10$pgSBJOIizHHNoyLzuvE3c.4P9ZrlCbDcb1Vjsbfdt7Zze4pcH8som', 'admin@vdabpizzashop.be', 1),
('test', '$2y$10$9pp0J1vMPMQQ.dBpxWVwcOfgDfWWmQs5C.q/CUxoM0l7YnL1jKHHa', 'test@test.be', 0),
('thomas', '', '', 0),
('Thomas81', '$2y$10$Pn3fnsbnb7NxtAhOEikPAeaDtmNRqqu.XB0HgGEEeePYKRVRuwsEy', 'thomas.deserranno@gmail.com', 0);

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
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Beperkingen voor tabel `deliveryzones`
--
ALTER TABLE `deliveryzones`
  ADD CONSTRAINT `deliveryzones_ibfk_1` FOREIGN KEY (`shopid`) REFERENCES `shops` (`id`);

--
-- Beperkingen voor tabel `orderlines`
--
ALTER TABLE `orderlines`
  ADD CONSTRAINT `orderlines_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderlines_ibfk_2` FOREIGN KEY (`articleid`) REFERENCES `articles` (`id`);

--
-- Beperkingen voor tabel `orderlines_toppings`
--
ALTER TABLE `orderlines_toppings`
  ADD CONSTRAINT `orderlines_toppings_ibfk_1` FOREIGN KEY (`orderlineid`) REFERENCES `orderlines` (`id`),
  ADD CONSTRAINT `orderlines_toppings_ibfk_2` FOREIGN KEY (`toppingid`) REFERENCES `toppings` (`id`);

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shopid`) REFERENCES `shops` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
