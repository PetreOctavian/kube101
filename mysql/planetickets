-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 25, 2019 la 08:53 PM
-- Versiune server: 10.1.38-MariaDB
-- Versiune PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `planetickets`
--

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `availableseats`
-- (Vezi mai jos vizualizarea actuală)
--
CREATE TABLE `availableseats` (
`ID` int(11)
,`total seats` int(5)
,`free seats` int(5)
);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `flights`
--

CREATE TABLE `flights` (
  `ID` int(11) NOT NULL,
  `departure location` varchar(30) NOT NULL DEFAULT ',',
  `departure date` datetime NOT NULL,
  `arrival location` varchar(30) NOT NULL DEFAULT ',',
  `flight duration` time NOT NULL,
  `travel class` varchar(30) NOT NULL DEFAULT 'economy',
  `cabin luggage` varchar(30) NOT NULL DEFAULT 'NO',
  `hold luggage` varchar(30) NOT NULL DEFAULT 'NO',
  `seats` int(5) NOT NULL DEFAULT '5',
  `image path` varchar(30) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `flights`
--

INSERT INTO `flights` (`ID`, `departure location`, `departure date`, `arrival location`, `flight duration`, `travel class`, `cabin luggage`, `hold luggage`, `seats`, `image path`, `price`) VALUES
(93, 'Cusco,Peru', '2017-02-23 07:40:05', 'Vitoria,Brazil', '12:41:29', 'business', 'NO', 'NO', 9, '../images/i12.jpg', 297),
(94, 'Ljubljana,Slovenia', '2016-07-22 19:33:13', 'Hargeisa,Somalia', '02:41:19', 'first', '5', '60', 8, '../images/i21.jpg', 171),
(95, 'Hagatna,United States', '2017-04-13 19:53:10', 'Havana,Cuba', '01:29:49', 'economy', 'NO', 'NO', 3, '../images/i10.jpg', 505),
(96, 'Puerto Ayacucho,Venezuela', '2019-05-16 21:13:05', 'Enugu,Nigeria', '15:48:04', 'first', 'NO', 'NO', 7, '../images/i35.jpg', 245),
(97, 'Chandigarh,India', '2018-05-01 03:02:54', 'Bordeaux,France', '07:14:22', 'business', 'NO', 'NO', 5, '../images/i18.jpg', 341),
(98, 'Dunedin,New Zealand', '2018-11-30 07:24:12', 'Rochester,United States', '09:25:04', 'business', 'NO', '85', 3, '../images/i25.jpg', 210),
(99, 'Tunis,Tunisia', '2018-03-05 17:03:37', 'Nassau,Bahamas', '08:05:54', 'first', 'NO', '38', 9, '../images/i0.jpg', 432),
(100, 'Cockburn Town,United Kingdom', '2017-06-01 06:24:21', 'Strasbourg,France', '21:49:05', 'first', 'NO', 'NO', 11, '../images/i10.jpg', 268),
(101, 'Paramaribo,Suriname', '2018-04-23 16:25:31', 'Des Moines,United States', '12:25:42', 'first', 'NO', '62', 10, '../images/i18.jpg', 506),
(102, 'Port Moresby,Papua New Guinea', '2018-06-07 23:32:02', 'Anchorage,United States', '16:52:54', 'first', 'NO', '94', 4, '../images/i9.jpg', 341),
(103, 'Porto,Portugal', '2017-12-16 09:18:20', 'Fukushima,Japan', '21:01:51', 'economy', 'NO', '38', 3, '../images/i35.jpg', 461),
(104, 'Hermosillo,Mexico', '2020-05-05 12:45:57', 'N`Djamena,Chad', '02:28:12', 'business', 'NO', '32', 4, '../images/i9.jpg', 313),
(105, 'Toyama,Japan', '2020-08-09 10:30:54', 'Lviv,Ukraine', '01:38:00', 'first', '11', '71', 1, '../images/i27.jpg', 376),
(106, 'Yellowknife,Canada', '2018-12-16 04:29:04', 'Takamatsu,Japan', '21:09:19', 'business', 'NO', 'NO', 8, '../images/i28.jpg', 405),
(107, 'Makati,Philippines', '2019-10-29 04:36:01', 'Kandahar,Afghanistan', '11:20:54', 'business', 'NO', '44', 9, '../images/i16.jpg', 332),
(108, 'Warsaw,Poland', '2020-02-05 21:16:42', 'Palmas,Brazil', '13:06:35', 'economy', 'NO', 'NO', 1, '../images/i11.jpg', 488),
(109, 'Horta,Portugal', '2016-05-10 19:55:34', 'Mata-Utu,France', '03:16:00', 'first', 'NO', 'NO', 4, '../images/i24.jpg', 324),
(110, 'Helena,United States', '2020-06-26 10:00:48', 'The Valley,United Kingdom', '10:02:40', 'first', 'NO', 'NO', 5, '../images/i15.jpg', 281),
(111, 'New York City,United States', '2018-06-22 12:09:18', 'Izhevsk,Russia', '07:26:56', 'first', 'NO', 'NO', 3, '../images/i10.jpg', 265),
(112, 'Mumbai,India', '2018-04-11 23:31:34', 'San Sebastian,Spain', '15:04:03', 'first', 'NO', 'NO', 2, '../images/i8.jpg', 248),
(113, 'Cluj-Napoca,Romania', '2018-11-05 16:08:25', 'Nelspruit,South Africa', '00:17:25', 'business', 'NO', 'NO', 8, '../images/i6.jpg', 278),
(114, 'Adak,United States', '2016-07-06 10:57:20', 'Hannover,Germany', '17:20:57', 'business', 'NO', '34', 5, '../images/i27.jpg', 344),
(115, 'Yangon,Burma', '2019-08-25 08:51:32', 'Tiksi,Russia', '03:40:31', 'business', 'NO', '33', 11, '../images/i29.jpg', 296),
(116, 'Kofu,Japan', '2017-08-08 00:04:22', 'Andorra la Vella,Andorra', '03:18:21', 'first', '13', '60', 10, '../images/i34.jpg', 188),
(117, 'Kochi,India', '2019-04-09 18:47:52', 'Virginia Beach,United States', '22:36:45', 'business', 'NO', '85', 5, '../images/i29.jpg', 234),
(118, 'Livingstone,Zambia', '2019-08-14 22:51:36', 'Kolkata (Calcutta),India', '03:58:23', 'economy', 'NO', 'NO', 10, '../images/i22.jpg', 306),
(119, 'Tromso,Norway', '2018-10-17 20:44:30', 'Mersin,Turkey', '12:54:13', 'business', 'NO', '99', 3, '../images/i5.jpg', 368),
(120, 'Udon Thani,Thailand', '2017-07-15 11:43:25', 'Puerto Aisen,Chile', '07:09:37', 'first', 'NO', 'NO', 4, '../images/i25.jpg', 493),
(121, 'Colombo,Sri Lanka', '2016-05-07 08:56:30', 'Paramaribo,Suriname', '00:07:00', 'economy', 'NO', 'NO', 3, '../images/i0.jpg', 241),
(122, 'Hamilton,United Kingdom', '2018-08-12 07:17:34', 'Salta,Argentina', '09:34:13', 'economy', 'NO', '72', 1, '../images/i3.jpg', 454);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `logindata`
--

CREATE TABLE `logindata` (
  `ID` int(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `first name` varchar(30) NOT NULL,
  `last name` varchar(30) NOT NULL,
  `adress` varchar(30) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `coco` int(11) NOT NULL DEFAULT '200',
  `user type` varchar(10) NOT NULL DEFAULT 'user',
  `validation status` varchar(10) NOT NULL DEFAULT 'valid',
  `connection status` varchar(10) NOT NULL DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `logindata`
--

INSERT INTO `logindata` (`ID`, `username`, `password`, `email`, `first name`, `last name`, `adress`, `telephone`, `coco`, `user type`, `validation status`, `connection status`) VALUES
(60, 'petreocty1998', 'cartof123', 'amigo_octy@gmail.com', 'octavian', 'petre', 'amigo', '0741', 703, 'user', 'valid', 'offline'),
(63, 'admin', 'admin', 'amadsadsaigo@gmail.com', 'q', 'd', 'asd', 'w2', 98605, 'admin', 'valid', 'online'),
(65, 'qaz', 'qaz', 'qaz', 'qaz', 'qaz', 'qaz', 'qaz', 1000, 'user', 'valid', 'offline'),
(999, '', '', '', '', '', NULL, NULL, 0, '', '', ''),
(1009, 'user123', 'pwas123', 'kilimajaro@gmail.com', 'qaz', 'wsx', 'Cal. bucuresti nr.38', '03125846', 200, 'user', 'valid', 'offline');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `ID flight` int(11) NOT NULL,
  `ID user` int(11) NOT NULL,
  `taken seats` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'unhonored'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `transactions`
--

CREATE TABLE `transactions` (
  `ID` int(20) NOT NULL,
  `code` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `time` datetime NOT NULL,
  `money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `transactions`
--

INSERT INTO `transactions` (`ID`, `code`, `username`, `time`, `money`) VALUES
(1, '0', 'admin', '2019-05-18 23:34:10', 171),
(2, '0', 'admin', '2019-05-18 23:36:13', 0),
(3, '0', 'admin', '2019-05-18 23:36:28', 0),
(4, '0', 'admin', '2019-05-19 00:41:24', 297),
(5, '2', 'admin', '2019-05-19 00:45:32', 297),
(6, '0', 'admin', '2019-05-19 09:28:21', 297),
(7, '0', 'admin', '2019-05-19 09:33:54', 594),
(8, '0', 'admin', '2019-05-19 10:12:27', 2970),
(9, '0', 'admin', '2019-05-19 10:52:41', 1485),
(10, '0', 'admin', '2019-05-19 12:07:48', 2673),
(11, 'UR8r16uj', 'admin', '2019-05-19 12:32:21', 1485),
(12, 'BXgTSAY8', 'admin', '2019-05-19 12:32:44', 1188),
(13, 'MudnuVHZ', 'petreocty1998', '2019-05-24 18:54:47', 297);

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `availableseats`
--
DROP TABLE IF EXISTS `availableseats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `availableseats`  AS  select `flights`.`ID` AS `ID`,`flights`.`seats` AS `total seats`,`flights`.`seats` AS `free seats` from `flights` group by `flights`.`ID` order by `flights`.`seats` desc ;

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`ID`);

--
-- Indexuri pentru tabele `logindata`
--
ALTER TABLE `logindata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexuri pentru tabele `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `flight_key` (`ID flight`),
  ADD KEY `user_key` (`ID user`);

--
-- Indexuri pentru tabele `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `flights`
--
ALTER TABLE `flights`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT pentru tabele `logindata`
--
ALTER TABLE `logindata`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT pentru tabele `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pentru tabele `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `flight_key` FOREIGN KEY (`ID flight`) REFERENCES `flights` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_key` FOREIGN KEY (`ID user`) REFERENCES `logindata` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
