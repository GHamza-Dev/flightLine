-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 05:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flightlight`
--

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `flightID` int(100) NOT NULL,
  `aFrom` varchar(100) NOT NULL,
  `aTo` varchar(100) NOT NULL,
  `departTime` datetime NOT NULL,
  `arrivalTime` datetime NOT NULL,
  `price` float NOT NULL,
  `nbrPlaces` int(11) NOT NULL,
  `reservedPlaces` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flightID`, `aFrom`, `aTo`, `departTime`, `arrivalTime`, `price`, `nbrPlaces`, `reservedPlaces`) VALUES
(40, 'Youcode - Safi', 'Amori - Italiano chiabata boli', '2022-02-28 19:12:00', '2022-04-24 19:12:00', 123, 20, NULL),
(41, 'In corporis quibusda', 'Nam possimus iste a', '2023-01-23 12:06:00', '2013-02-06 14:55:00', 338, 69, 66),
(42, 'Amet minus et dicta', 'Cum numquam mollit i', '2022-04-08 00:02:00', '2022-11-17 09:22:00', 451, 15, 1),
(43, 'Cupiditate itaque an', 'Sapiente aut eveniet', '2022-03-28 15:23:00', '2022-04-11 10:50:00', 62, 54, 0);

-- --------------------------------------------------------

--
-- Table structure for table `passanger`
--

CREATE TABLE `passanger` (
  `passengerID` int(100) NOT NULL,
  `reservationID` int(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `birthDay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passanger`
--

INSERT INTO `passanger` (`passengerID`, `reservationID`, `firstName`, `lastName`, `birthDay`) VALUES
(25, 51, 'Orson', 'Trujillo', '2008-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservationID` int(100) NOT NULL,
  `userID` int(100) NOT NULL,
  `flightID` int(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationID`, `userID`, `flightID`, `date`) VALUES
(51, 12, 42, '2022-02-25 11:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(100) NOT NULL,
  `nic` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `nic`, `firstName`, `lastName`, `email`, `phone`, `password`) VALUES
(9, 'BB123456', 'Yassine', 'Lamine', 'yassine@gmail.com', '067398737', '1234a'),
(12, 'AA56789', 'Hamza', 'yobi', 'hamza@ich.bin', '3490765433456', '1234A'),
(13, 'KK76876767567', 'Yassine', 'Kamal', 'kamzal@gmail.com', '6785434', '0000');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_available`
-- (See below for the actual view)
--
CREATE TABLE `v_available` (
`flightID` int(100)
,`aFrom` varchar(100)
,`aTo` varchar(100)
,`departTime` datetime
,`arrivalTime` datetime
,`price` float
,`nbrPlaces` int(11)
,`reservedPlaces` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_available`
--
DROP TABLE IF EXISTS `v_available`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_available`  AS SELECT `flight`.`flightID` AS `flightID`, `flight`.`aFrom` AS `aFrom`, `flight`.`aTo` AS `aTo`, `flight`.`departTime` AS `departTime`, `flight`.`arrivalTime` AS `arrivalTime`, `flight`.`price` AS `price`, `flight`.`nbrPlaces` AS `nbrPlaces`, `flight`.`reservedPlaces` AS `reservedPlaces` FROM `flight` WHERE `flight`.`departTime` > current_timestamp() AND `flight`.`nbrPlaces` > `flight`.`reservedPlaces` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flightID`);

--
-- Indexes for table `passanger`
--
ALTER TABLE `passanger`
  ADD PRIMARY KEY (`passengerID`),
  ADD KEY `reservationID` (`reservationID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `flightID` (`flightID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `flightID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `passanger`
--
ALTER TABLE `passanger`
  MODIFY `passengerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `passanger`
--
ALTER TABLE `passanger`
  ADD CONSTRAINT `fk_passanger_reservation` FOREIGN KEY (`reservationID`) REFERENCES `reservation` (`reservationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`flightID`) REFERENCES `flight` (`flightID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
