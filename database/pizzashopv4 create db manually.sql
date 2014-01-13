-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2014 at 04:48 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pizzashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
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
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `name`, `description`, `image`, `price`, `promo_status`, `promo_price`, `category`) VALUES
(1, 'Pizza Hawaii', 'pizza met tomatensaus belegd met ham, champignons, ananas en mozarella', '', '13.00', 1, '9.00', 'pizza'),
(2, 'Coca Cola 33cl', '', '', '3.00', 0, '0.00', 'drank'),
(3, 'Pizza Pepperoni', 'pizza met tomatensaus belegd met pepperoni en mozarella', '', '12.00', 0, '10.00', 'pizza'),
(4, 'Pizza Margherita', 'pizza met tomatensaus belegd met mozarella', '', '10.00', 1, '7.50', 'pizza'),
(5, 'Pizza Supreme', 'pizza met tomatensaus belegd met rundsvlees, pepperoni, champignons, groene paprika en mozarella', '', '15.00', 0, '12.00', 'pizza'),
(6, 'Pizza BBQ', 'pizza met bbq-saus belegd met rundsvlees, gerookte bacon en mozarella', '', '16.00', 0, '13.00', 'pizza'),
(7, 'Fanta 33cl', '', '', '3.00', 0, '0.00', 'drank'),
(8, 'Spa rood 50cl', '', '', '4.00', 0, '0.00', 'drank'),
(10, '7 UP 33cl', '', '', '2.50', 0, '2.00', 'drank');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`name`) VALUES
('drank'),
('pizza');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `address`, `postcode`, `city`, `telephone`, `active_status`, `username`) VALUES
(4, 'Thomas', 'Deserranno', 'Moerkerkesteenweg 9', '8340', 'Damme', 50358178, 1, 'Thomas'),
(5, 'Peter', 'Van Nieuwehuyse', 'hierwaakikstraat 1', '8400', 'oostende', 1234567, 1, 'Peter'),
(6, 'Bert', 'Vandecasteele', 'daverloostraat 55', '8310', 'Assebroek', 45454545, 1, 'Bert');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryzones`
--

CREATE TABLE IF NOT EXISTS `deliveryzones` (
  `shopid` int(11) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `delivery_cost` int(4) NOT NULL,
  PRIMARY KEY (`shopid`,`postcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deliveryzones`
--

INSERT INTO `deliveryzones` (`shopid`, `postcode`, `delivery_cost`) VALUES
(1, '8340', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderlines`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orderlines_toppings`
--

CREATE TABLE IF NOT EXISTS `orderlines_toppings` (
  `orderlineid` int(11) NOT NULL,
  `toppingid` int(11) NOT NULL,
  PRIMARY KEY (`orderlineid`,`toppingid`),
  KEY `orderlines_toppings_ibfk_2` (`toppingid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `delivery_type` varchar(20) NOT NULL,
  `delivery_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerid` (`customerid`),
  KEY `shopid` (`shopid`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE IF NOT EXISTS `orderstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `address`, `postcode`, `city`) VALUES
(1, 'Maalsesteenweg 151', '8310', 'Sint-Kruis');

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

CREATE TABLE IF NOT EXISTS `toppings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `toppings`
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` char(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `admin`) VALUES
('admin', '$2y$10$pgSBJOIizHHNoyLzuvE3c.4P9ZrlCbDcb1Vjsbfdt7Zze4pcH8som', 'admin@vdabpizzashop.be', 1),
('Bert', '$2y$10$FbXU9Igo/rs6oAg5wv1yye9oiEkuqXJ3gf/uXX56DO.TXW2OvD4ne', 'blala@bla.bla', 0),
('Peter', '$2y$10$xS5qyNdt86T5v3D0xGW5ieFFL8/0wkPi2ShArGsJ7hlJ7suyP8kXe', 'peter@design.be', 0),
('Thomas', '$2y$10$aqdSt48/rAKpeH5uuQtCw.gShlci5t7dTzVNn39w03sL0pvQlWXYm', 'thomas.deserranno@gmail.com', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`name`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `deliveryzones`
--
ALTER TABLE `deliveryzones`
  ADD CONSTRAINT `deliveryzones_ibfk_1` FOREIGN KEY (`shopid`) REFERENCES `shops` (`id`);

--
-- Constraints for table `orderlines`
--
ALTER TABLE `orderlines`
  ADD CONSTRAINT `orderlines_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderlines_ibfk_2` FOREIGN KEY (`articleid`) REFERENCES `articles` (`id`);

--
-- Constraints for table `orderlines_toppings`
--
ALTER TABLE `orderlines_toppings`
  ADD CONSTRAINT `orderlines_toppings_ibfk_1` FOREIGN KEY (`orderlineid`) REFERENCES `orderlines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderlines_toppings_ibfk_2` FOREIGN KEY (`toppingid`) REFERENCES `toppings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`status`) REFERENCES `orderstatus` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shopid`) REFERENCES `shops` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
