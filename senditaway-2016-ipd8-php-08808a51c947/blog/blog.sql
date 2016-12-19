-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2016 at 07:50 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL,
  `pubDate` date NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `imagePath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ID`, `authorID`, `pubDate`, `title`, `body`, `imagePath`) VALUES
(1, 1, '2016-09-23', 'Story about a cat', 'Lorem ipsum dolor sit amet, his eu munere sapientem laboramus, agam fierent democritum sit ad. Ea tation dicunt disputationi duo. Vix mazim pericula ei, utinam aperiri has id. Eu rebum equidem vel.\r\n\r\nUt eos quis delenit, duo meliore platonem tincidunt ne. Cum an error habemus. Mea eu nullam accumsan, velit alterum cu vel, his harum audire referrentur cu. An per doming voluptatum persequeris, pro ut stet case accusata. Ceteros molestie eos ex.\r\n\r\nEu oratio sapientem vix. Qui ei posse utroque accusata, ius id aliquam probatus molestiae, te detracto mentitum definitiones pro. Vix veritus atomorum et. Adversarium theophrastus per ei. Usu alia ignota eruditi ut, alterum iudicabit ne vim.\r\n\r\nEx tractatos percipitur eos, per brute dicunt impetus et. Nam no populo persius, eu eirmod quaeque sententiae pri. Prompta officiis ocurreret sed in, offendit tacimates persequeris ex vix, tollit legendos inciderint et eum. Id has porro neglegentur.\r\n\r\nNo vix primis utamur, ius ubique mucius ne. Dolorem minimum cum te, vim ei alii animal eleifend. Ut vim minim dicant incorrupte, ut complectitur necessitatibus usu, mei sonet platonem consetetur no. Nusquam laboramus cu quo, autem propriae explicari no his. Te labores erroribus cotidieque vis, ipsum offendit ut vis.', 'uploads/20160923-185917-Hello__Hi__I_am_a_cat____jpg.jpeg'),
(2, 1, '2016-09-23', 'About another cat', 'asdfasdfas asd lj klja dflkjas kldfj alkdj flkasj dlkajsdklfj as;ldkfj a;lkj d;alkdj ;aslkdjf;laskj;dflkjas', 'uploads/20160923-192007-skin-cancer-cats_jpg.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `pubTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `password`) VALUES
(1, 'GregP', 'greg@greg.com', 'abcABC123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `authorID` (`authorID`),
  ADD KEY `pubDate` (`pubDate`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `articleID` (`articleID`),
  ADD KEY `authorID` (`authorID`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`authorID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`articleID`) REFERENCES `articles` (`ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`authorID`) REFERENCES `users` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
