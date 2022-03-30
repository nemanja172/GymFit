-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 09:53 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymfit`
--

-- --------------------------------------------------------

--
-- Table structure for table `fitnes`
--

CREATE TABLE `fitnes` (
  `ID_fitnesa` int(11) NOT NULL,
  `Ime` varchar(20) NOT NULL,
  `Lokacija` varchar(30) NOT NULL,
  `Naslov` varchar(30) NOT NULL,
  `Tip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fitnes`
--

INSERT INTO `fitnes` (`ID_fitnesa`, `Ime`, `Lokacija`, `Naslov`, `Tip`) VALUES
(1, 'FitInn', 'Ljubljana', 'Šmartinska cesta 152', 'Fitnes'),
(2, 'Tivoli SC', 'Ljubljana', 'Celovška cesta 25', 'Bazen'),
(3, 'XGym', 'Kranj', 'Ljubljanska cesta 252', 'Fitnes'),
(4, 'Golfer', 'Koper', 'Kamp Adria 5', 'Golf'),
(5, 'Randolf', 'Kranj', ' Partizanska cesta 22', 'Tenis'),
(6, 'ŠD Bevke', 'Bevke', 'Bevke 92a ', 'Tenis'),
(7, 'CleverFit', 'Ljubljana', 'Celovška cesta 253', 'Fitnes'),
(8, 'Habakuk', 'Maribor', 'Pohorska ulica 59', 'Bazen'),
(9, 'TK Gorica', 'Nova Gorica', 'Bazoviška ulica 4/1', 'Tenis');

-- --------------------------------------------------------

--
-- Table structure for table `termin`
--

CREATE TABLE `termin` (
  `ID_termina` int(11) NOT NULL,
  `ID_uporabnika` int(11) NOT NULL,
  `ID_fitnesa` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `termin`
--

INSERT INTO `termin` (`ID_termina`, `ID_uporabnika`, `ID_fitnesa`, `datum`) VALUES
(1, 1, 1, '2021-06-02'),
(2, 1, 3, '2021-06-05'),
(3, 1, 2, '2021-06-12'),
(4, 2, 2, '2021-06-16'),
(6, 2, 1, '2021-06-27'),
(14, 4, 3, '2021-06-04'),
(15, 4, 4, '2021-06-14'),
(16, 5, 2, '2021-06-12'),
(17, 6, 3, '2021-06-13'),
(18, 9, 1, '2021-06-16'),
(19, 10, 2, '2021-06-18'),
(20, 10, 2, '2021-06-19'),
(21, 9, 4, '2021-06-11'),
(22, 1, 8, '2021-12-29'),
(23, 2, 8, '2021-12-30'),
(24, 3, 6, '2021-12-31'),
(25, 2, 3, '2021-12-30'),
(26, 3, 4, '2022-01-19'),
(27, 2, 4, '2022-01-24'),
(29, 3, 4, '2022-01-24'),
(30, 5, 3, '2022-01-30'),
(31, 7, 4, '2022-01-28'),
(32, 3, 4, '2022-01-25'),
(33, 8, 3, '2022-01-29'),
(34, 6, 2, '2022-02-06'),
(35, 2, 4, '2022-02-16'),
(36, 2, 2, '2022-02-14'),
(37, 7, 2, '2022-02-17'),
(39, 1, 6, '2022-02-25'),
(40, 1, 3, '2022-03-01'),
(41, 1, 3, '2022-02-14'),
(42, 2, 2, '2022-02-13'),
(44, 3, 1, '2022-02-20'),
(45, 8, 1, '2022-02-21'),
(46, 2, 4, '2022-03-17'),
(48, 3, 1, '2022-03-11'),
(49, 3, 4, '2022-03-14'),
(50, 3, 7, '2022-03-18'),
(51, 3, 4, '2022-03-31'),
(53, 3, 5, '2022-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `uporabnik`
--

CREATE TABLE `uporabnik` (
  `ID_uporabnika` int(11) NOT NULL,
  `Ime` varchar(15) NOT NULL,
  `Priimek` varchar(15) NOT NULL,
  `Geslo` varchar(20) NOT NULL,
  `Datum_rojstva` date NOT NULL,
  `Spol` char(1) NOT NULL,
  `Tel_stevilka` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Paket` char(1) NOT NULL,
  `user_level` int(11) DEFAULT 0,
  `token` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uporabnik`
--

INSERT INTO `uporabnik` (`ID_uporabnika`, `Ime`, `Priimek`, `Geslo`, `Datum_rojstva`, `Spol`, `Tel_stevilka`, `Email`, `Paket`, `user_level`, `token`) VALUES
(1, 'Nemanja', 'Mihajlovic', 'IKTFE2021', '1993-02-28', 'M', '069-695-602', 'nemanja172@yahoo.com', 'S', 1, '3dca514386f57c207c5e4bb1d719c088'),
(2, 'Maja', 'Novak', 'cebelica', '1995-05-20', 'Z', '041-502-142', 'mnovak@gmail.com', 'M', 1, 'd2dde0f45e76720714cb9eb7b990b52a'),
(3, 'Tonej', 'Jez', 'tonejez', '1997-08-06', 'M', '061-458534', 'tonej@gmail.com', 'L', 0, '938fe60feb51d638e58fe03277b5b31e'),
(4, 'Nejc', 'Laric', 'nejcl', '1996-01-24', 'M', '069-857456', 'nejcla@yahoo.com', 'M', 0, 'a1d6b44f670a238f9b2ee8bcd3599a39'),
(5, 'Frenk', 'Udir', 'frenku', '1991-03-12', 'M', '069-812356', 'triglav12@yahoo.com', 'S', 0, 'bcd34002140340cbbe245ec5f6f6bf2d'),
(6, 'Spela', 'Valic', 'spelav', '1997-07-04', 'Z', '041-547858', 'spela@gmail.com', 'S', 1, '5f6cb9f788b712d2705f0f6a9e9da827'),
(7, 'Melanija', 'Fronc', 'melanijaf', '1997-04-04', 'Z', '041-852455', 'mfrc@gmail.com', 'S', 0, 'b4da86cf3ba8a8b30039bc4f432fb04e'),
(8, 'Ena', 'Horozovic', 'enah', '1999-05-23', 'Z', '069675628', 'ena@gmail.com', 'M', 1, '2d4f66bff7a75e769aead859b5e1cf3e'),
(9, 'Mojca', 'Ivarntik', 'mojcai', '1991-05-12', 'Z', '041-457562', 'ivartnik12@yahoo.com', 'L', 0, NULL),
(10, 'Larisa', 'Pahor', 'larisap', '1995-01-24', 'Z', '041-748356', 'lari12@yahoo.com', 'L', 0, NULL),
(11, 'Marija', 'Homar', 'marijah', '1997-06-10', 'Z', '069-458958', 'maja@siol.si', 'L', 0, NULL),
(14, 'Rok', 'Dovc', 'rokd', '1999-02-05', 'M', '041-575377', 'dovc@gmail.com', 'M', 0, NULL),
(15, 'Samo', 'Dolenc', 'samod', '1999-04-05', 'M', '041-852045', 'dolnc@gmail.com', 'L', 0, NULL),
(16, 'Urban', 'Batagelj', 'urbanb', '1986-06-14', 'M', '069854752', 'urban@a1.si', 'X', 0, NULL),
(17, 'Peter', 'Kos', 'peterk', '1991-05-12', 'M', '069558625', 'pekos@telekom.si', 'X', 0, NULL),
(18, 'Jan', 'Križman', 'jank', '1990-05-20', 'M', '060-485854', 'jankr@gmail.com', 'X', 0, NULL),
(19, 'Rok', 'Zagar', 'roky', '1999-02-10', 'M', '069-5645456', 'rokz@gmail.com', 'M', 0, NULL),
(21, 'Gasper', 'Koman', 'gasperk', '1991-02-11', 'M', '060-585231', 'gasperk@gmail.com', 'X', 0, NULL),
(22, 'Elena', 'Kovic', 'elenak', '1997-05-06', 'Z', '068-579856', 'elenak@yahoo.com', 'L', 0, NULL),
(31, 'Petra', 'Tharler', 'petra', '1998-02-11', 'Z', '069-569696', 'petra@a1.si', 'S', 0, NULL),
(38, 'Gregor', 'Kopran', 'undefined', '2000-05-07', 'M', '069-863859', 'gregor@gmail.com', 'L', 0, NULL),
(39, 'Ales', 'Bester', 'alesb', '1997-02-17', 'M', '068-548552', 'alesb@a1.si', 'L', 0, NULL),
(43, 'Nina', 'Pintar', 'ninap', '1992-02-14', 'Z', '065-858756', 'ninap@siol.si', 'L', 0, NULL),
(44, 'Emina', 'Geber', 'eminag', '1989-05-04', 'Z', '065-548686', 'eminag@gmail.com', 'X', 0, NULL),
(74, 'test', 'test', 'test', '2022-03-23', 'M', '069-9876525', 'test@tewesdf.com', 'S', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fitnes`
--
ALTER TABLE `fitnes`
  ADD PRIMARY KEY (`ID_fitnesa`);

--
-- Indexes for table `termin`
--
ALTER TABLE `termin`
  ADD PRIMARY KEY (`ID_termina`),
  ADD KEY `ID_uporabnika` (`ID_uporabnika`,`ID_fitnesa`),
  ADD KEY `termin_ibfk_2` (`ID_fitnesa`);

--
-- Indexes for table `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`ID_uporabnika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fitnes`
--
ALTER TABLE `fitnes`
  MODIFY `ID_fitnesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `termin`
--
ALTER TABLE `termin`
  MODIFY `ID_termina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `ID_uporabnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `termin`
--
ALTER TABLE `termin`
  ADD CONSTRAINT `termin_ibfk_1` FOREIGN KEY (`ID_uporabnika`) REFERENCES `uporabnik` (`ID_uporabnika`),
  ADD CONSTRAINT `termin_ibfk_2` FOREIGN KEY (`ID_fitnesa`) REFERENCES `fitnes` (`ID_fitnesa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
