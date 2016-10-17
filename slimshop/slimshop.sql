-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2016 at 08:03 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slimshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `ID` int(11) NOT NULL,
  `sessionID` varchar(50) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `createdTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`ID`, `sessionID`, `productID`, `quantity`, `createdTS`) VALUES
(8, '4p1ui081dpo0gis10sf7sv0jp2', 3, 3, '2016-10-12 17:54:55'),
(9, '4p1ui081dpo0gis10sf7sv0jp2', 4, 8, '2016-10-12 17:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `ID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `origProductID` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` varchar(6) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `totalBeforeTax` decimal(10,2) NOT NULL,
  `shippingBeforeTax` decimal(10,2) NOT NULL,
  `taxes` decimal(10,2) NOT NULL,
  `totalWithShippingAndTaxes` decimal(10,2) NOT NULL,
  `dateTimePlaced` datetime NOT NULL,
  `dateTimeShipped` datetime NOT NULL,
  `status` enum('placed','shipped','cancelled','delivered') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imagePath` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `name`, `description`, `imagePath`, `price`) VALUES
(1, 'Cat one', 'This is a cat number one. lakjdfklaj kldfj akldfj aklsj faklsj fdaskljdflakjldfkaj df', 'cat1.jpg', '5.57'),
(2, 'Another cat it is 2222', 'Two klj23 4lk2j 4kl23j l4kj 23lk4j 32klj 2lkj4 32klj 4kl2j 34klj 2l34kj 2lkj4 23lkj ', 'cat2.jpg', '22.45'),
(3, 'Third poster of a cat 3333', 'jkljlk23j 234kl 234klj3 4lk2j 34klj 234klj 2kl34j kl23j 4lk23j 4kl23j 4kl23j 423lj 234lk3', 'cat3.jpg', '17.79'),
(4, 'Quarter cat 444', 'klaj dlaskf jklj 23l4kj 423klj 423klj 4l23kj 4lk23j 4kl23j 4lk23j 4lk23j 4lk23j lkj 234kjl 234klj l', 'cat4.jpg', '55.44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FBID` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `securityRole` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FBID`, `name`, `email`, `password`, `securityRole`) VALUES
(1, NULL, 'Jerry', 'jerry@jerry.com', 'ABCabc123', 'user'),
(2, NULL, 'Patty P', 'patty@p.com', 'ec5f6aee63bb96a3a2d88662fc215328', 'user'),
(3, NULL, 'Terry P', 'terry@terry.com', '60d82e060ad50da2c287d6680cd6111adcb56aededd9e1f4681328f30f1b88b7', 'user'),
(4, NULL, 'GregP', 'greg@greg.com', '$2y$10$9PTpSl1AhXGOGt7a8lSB1eTRyuKO5FPZdWZq8GeoSafWsPq8MUD1.', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `sessionID_2` (`sessionID`,`productID`),
  ADD KEY `sessionID` (`sessionID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `origProductID` (`origProductID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`origProductID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
