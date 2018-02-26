-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2018 at 07:33 AM
-- Server version: 5.6.23-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epbuysco_flexrepair`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `last_activity` varchar(255) NOT NULL,
  `user_data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('17119fec97b233b27afe7e52029ed5c8', '66.249.93.90', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.75 Safari/537.36 Google Favicon', '1519647582', '');

-- --------------------------------------------------------

--
-- Table structure for table `clienti`
--

CREATE TABLE `clienti` (
  `id` int(4) NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cognome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(28) CHARACTER SET latin1 NOT NULL,
  `indirizzo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `citta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `vat` varchar(60) CHARACTER SET latin1 NOT NULL,
  `cf` varchar(60) CHARACTER SET latin1 NOT NULL,
  `data` date NOT NULL,
  `commenti` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clienti`
--

INSERT INTO `clienti` (`id`, `nome`, `cognome`, `telefono`, `indirizzo`, `citta`, `email`, `vat`, `cf`, `data`, `commenti`) VALUES
(1, 'John', 'Doe', '0000000000', '490 E South Orlando, FL', 'Orlando', 'email@provider.com', 'VAT', 'NIN', '2015-07-28', 'This is one comment'),
(2, 'Sanaullah', 'khan', '33453', 'hounslow', 'hounslow', 'sanaullahkhan81@gmail.com', '', '', '2017-12-12', ''),
(3, 'Sjeieksj', 'Hosnjs', '07779283883', 'owiekk', '', '19299292929', '', '', '2017-12-12', ''),
(4, 'Parvez', 'safsadf', '156', 'asd', 'sadd', 'jiosadjo@gmail.com', 'asd', 'as', '2017-12-19', 'dodgy guy'),
(5, 'Lucus', 'Balazynski', '07745884545', 'asdfads', '', 'lucus@gmail.com', 'asdf', 'asdf', '2017-12-19', 'Lenevo dropped'),
(6, 'Abdullah', 'Abdullah', '07563061312', 'hounslow', 'hounsllow', 'abdullah@gmail.com', 'asdf', '', '2017-12-19', ''),
(7, 'Britan', 'cena', '07393456810', 'hounsow', 'hounslow', 'britan@grian.com', '', '', '2017-12-19', ''),
(8, 'Arman', 'singh', '07427189289', '', '', '', '', '', '2018-01-06', ''),
(9, 'jose', 'JOSE', '07727454514', '', '', '', '', '', '2018-01-06', ''),
(10, 'dom', 'the D', '07427189289', '', '', '', '', '', '2018-01-07', ''),
(11, 'Tom ', 'Rodriguez', '07387180250', '', '', '', '', '', '2018-01-07', ''),
(12, 'Amin', 'hassan', '07508274063', '', '', '', '', '', '2018-01-07', ''),
(13, 'exchange', 'point', '02085779377', '', '', '', '', '', '2018-01-07', ''),
(14, 'Enea', 'Macsween', '07971985171', '', '', '', '', '', '2018-01-08', ''),
(15, 'anil', 'pori', '07777777777777', '', '', '', '', '', '2018-01-08', ''),
(16, 'Huawei', 'x585', '07000000000000', '', '', '', '', '', '2018-01-08', ''),
(17, 'iP7', 'baterry', '075456954', '', '', '', '', '', '2018-01-08', ''),
(18, 'Jack', 'apple watch', '07833447421', '', '', '', '', '', '2018-01-08', ''),
(19, 'elina', 'kambra', '07884026022', '', '', '', '', '', '2018-01-09', ''),
(20, 'tomek ', 'to', '07766391874', '', '', '', '', '', '2018-01-09', ''),
(21, 'iphone battery', 'asdf', '07508506547', '', '', '', '', '', '2018-01-10', ''),
(22, 'Suzan', 'ads', '077777777', '', '', '', '', '', '2018-01-10', ''),
(23, 'Jasmin', 'JA', '07954089442', '', '', '', '', '', '2018-01-11', ''),
(24, 'Ian s7 ', 'sasd', '07856224260', '', '', '', '', '', '2018-01-12', ''),
(25, 'hibo', 'sister', '07487727619', 'hounslow', 'hounslow', 'hibo@gmail.com', '', 'asdf', '2018-01-16', ''),
(26, 'raymunda', 'ray', '07597313674', 'houns', 'hounslow', 'puhvd', '00', '00', '2018-01-16', ''),
(27, 'parvez', 'syed', '074298678', '70 sun', 'londan', 'parvezsyed84@gmail.com', '35', '67', '2018-02-14', 'be careful'),
(28, 'adyan ', 'khan', '078654654325', 'sluoh', 'LONDON', 'PPJDFGXFXGS2.COM', 'o6', 'ugghbkhkj', '2018-02-14', 'good cousatm');

-- --------------------------------------------------------

--
-- Table structure for table `impostazioni`
--

CREATE TABLE `impostazioni` (
  `id` int(4) NOT NULL,
  `titolo` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lingua` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `showcredit` int(11) NOT NULL,
  `disclaimer` varchar(370) COLLATE utf8_unicode_ci NOT NULL,
  `skebby_user` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `skebby_pass` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `skebby_name` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `skebby_method` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `admin_user` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `valuta` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `indirizzo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_mail` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `vat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_type` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `tax` decimal(30,0) NOT NULL,
  `invoice_name` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `twilio_mode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `twilio_account_sid` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `twilio_auth_token` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `twilio_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prefix_number` int(5) NOT NULL,
  `usesms` int(2) NOT NULL,
  `r_apertura` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `r_chiusura` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `colore1` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `colore2` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `colore3` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `colore4` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `colore5` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `colore_prim` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `campi_personalizzati` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `stampadue` int(2) NOT NULL,
  `numc` int(11) NOT NULL,
  `currency_symbol` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `currency_text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `currency_position` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `printinonepage` int(11) NOT NULL,
  `rtl_support` int(11) NOT NULL,
  `email_sender` text COLLATE utf8_unicode_ci NOT NULL,
  `email_subject` text COLLATE utf8_unicode_ci NOT NULL,
  `email_use_smtp` int(11) NOT NULL,
  `email_smtp_host` text COLLATE utf8_unicode_ci NOT NULL,
  `email_smtp_user` text COLLATE utf8_unicode_ci NOT NULL,
  `email_smtp_pass` text COLLATE utf8_unicode_ci NOT NULL,
  `email_smtp_port` text COLLATE utf8_unicode_ci NOT NULL,
  `email_smtp_open_text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email_smtp_closed_text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `background_transition` text COLLATE utf8_unicode_ci,
  `timezone` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `impostazioni`
--

INSERT INTO `impostazioni` (`id`, `titolo`, `lingua`, `showcredit`, `disclaimer`, `skebby_user`, `skebby_pass`, `skebby_name`, `skebby_method`, `admin_user`, `admin_password`, `valuta`, `indirizzo`, `invoice_mail`, `telefono`, `vat`, `invoice_type`, `tax`, `invoice_name`, `categorie`, `twilio_mode`, `twilio_account_sid`, `twilio_auth_token`, `twilio_number`, `prefix_number`, `usesms`, `r_apertura`, `r_chiusura`, `colore1`, `colore2`, `colore3`, `colore4`, `colore5`, `colore_prim`, `logo`, `campi_personalizzati`, `stampadue`, `numc`, `currency_symbol`, `currency_text`, `currency_position`, `printinonepage`, `rtl_support`, `email_sender`, `email_subject`, `email_use_smtp`, `email_smtp_host`, `email_smtp_user`, `email_smtp_pass`, `email_smtp_port`, `email_smtp_open_text`, `email_smtp_closed_text`, `background_transition`, `timezone`) VALUES
(1, 'Gadget Depot', 'english', 0, '<hr>\nIn case your item turns out to be non repairable, then there will be service charge of £20.00\n<hr>\n<p align=\"center\">\nPlease visit website for Term & Condition<br>\nwww.epbuys.co.uk/terms<br>\nThank you for your Visit\n</p>', '', '', '', '', 'demo@demo.com', 'demo', 'GPB', '18 Treaty Center High Street, Hounslow, ', 'gadgetdepot18@gmail.com', '07848929979', 'VAT: 345345234', 'EU', '0', 'Parvez Syed', 'lenova\napple watch\ntablet\nGPS\nphones\nPS4\nHTC\nLaptop\niPhone\nComputer\nSmartphone\nxbox', 'prod', '', '', '', 44, 2, 'Hello %customer%, your order/repair for %model% was opened by %businessname%. Check the state of repair on %fixbookurl%.\nStatus code: (%statuscode%)', 'Hello %customer%, your order/repair fo %model% has been completed, come to %businessname% for take it. Thanks for choosing us.', '#3dc45b', '#f27705', '#a8a8a8', '#d61a1a', '#2b2b2b', '#08a4cc', 'logo_nav.png?13', 'YTozOntpOjA7czo0OiJJTUVJIjtpOjE7czo2OiJDdXN0b20iO2k6MjtzOjg6InBhc3N3b3JkIjt9', 0, 0, '', '', 'left', 0, 0, '', '', 0, '', '', '', '', 'Hello %customer%, your order/repair for %model% was opened by %businessname%. Check the state of repair on %fixbookurl%.Status code: (%statuscode%)', 'Hello %customer%, your order/repair fo %model% has been completed, come to %businessname% for take it. Thanks for choosing us.', '0', 'Europe/London');

-- --------------------------------------------------------

--
-- Table structure for table `oggetti`
--

CREATE TABLE `oggetti` (
  `ID` int(255) NOT NULL,
  `Nominativo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ID_Nominativo` int(11) NOT NULL,
  `Telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sms` int(1) NOT NULL DEFAULT '0',
  `Tipo` int(1) NOT NULL,
  `Guasto` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Categoria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Modello` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Pezzo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Anticipo` int(11) NOT NULL,
  `Prezzo` int(255) NOT NULL,
  `dataApertura` datetime NOT NULL,
  `dataChiusura` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '3',
  `Commenti` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `codice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `custom_field` longtext COLLATE utf8_unicode_ci NOT NULL,
  `send_email` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oggetti`
--

INSERT INTO `oggetti` (`ID`, `Nominativo`, `ID_Nominativo`, `Telefono`, `sms`, `Tipo`, `Guasto`, `Categoria`, `Modello`, `Pezzo`, `Anticipo`, `Prezzo`, `dataApertura`, `dataChiusura`, `status`, `Commenti`, `codice`, `custom_field`, `send_email`, `email`) VALUES
(7, 'Sanaullah khan', 2, '33453', 0, 0, 'LCD Screen, and blutoth', 'iPhone', 'xs', '', 20, 100, '2017-12-12 03:37:47', '2017-12-19 15:48:54', 0, 'broken lcd and bluetoot not working, and not testing now', 'Dri0LwCA', '{\"494d4549\":\"34534534\",\"437573746f6d\":\"dsfasd\"}', 1, 'sanaullahkhan81@gmail.com'),
(16, 'Tom  Rodriguez', 11, '07387180250', 0, 1, 'tab slow charing ', 'tablet', 'sam tab', 'zero', 0, 0, '2018-01-07 13:32:28', NULL, 0, '17:55 10.01.2018 collected', 'Y9Su8IhL', '{\"494d4549\":\"0000\",\"437573746f6d\":\"it was 23% i put it on charge at 13:22 07/01\"}', 0, ''),
(17, 'exchange point', 13, '02085779377', 0, 1, 'lcd replacement ', 'apple watch', 'mha-l29 lcd ', '95', 20, 95, '2018-01-07 14:09:44', NULL, 0, '10.01.2018 17:48 collected', 'VY0ptP7j', '{\"494d4549\":\"\",\"437573746f6d\":\"we need to call customer when we receve lcd asghar\"}', 0, ''),
(18, 'exchange point', 13, '02085779377', 0, 1, 's7 id 830 t18 came back as black listed  xp id 8340', 'phones', 's7', '000000', 0, 0, '2018-01-07 14:14:36', NULL, 0, 'repair imei send asghar vvv', 'LRDIGWzA', '{\"494d4549\":\"\",\"437573746f6d\":\"\"}', 0, ''),
(13, 'Arman singh', 8, '07427189289', 0, 1, 'lcd broken', 'phones', '6s', 'yyy', 0, 70, '2018-01-06 12:44:50', NULL, 0, 'sdfsadfsdf', 'C1A0hVYF', '{\"494d4549\":\"2390489234982348\",\"437573746f6d\":\"\"}', 0, ''),
(14, 'jose JOSE', 9, '07727454514', 0, 1, 'Dom need to call customer and update about the price if agree then go ahead with repair', 'GPS', 'TOMTOM', 'TOMTOM BROKEN GLASS', 0, 0, '2018-01-06 17:22:12', NULL, 1, 'i wrote a message regarding tomtom ,£50 , 3-4 working days. waiting for answer 07.01.18', '14', '{\"494d4549\":\"\",\"437573746f6d\":\"Dom need to call customer and update about the price if agree then go ahead with repair\"}', 0, ''),
(19, 'anil pori', 15, '07777777777777', 0, 1, 'unlocking from three', 'phones', 'alcatel pixi', '123 ', 15, 15, '2018-01-08 11:48:17', NULL, 2, 'Already unlocked,waiting for customer 12PM', '9fcJyGIi', '{\"494d4549\":\"356868069112944\",\"437573746f6d\":\"\"}', 0, ''),
(20, 'exchange point', 13, '02085779377', 0, 1, 'dead phone ', 'apple watch', 'lumia rm 941', 'zero', 0, 35, '2018-01-08 11:54:57', NULL, 0, 'Collected', 'UhGEcizF', '{\"494d4549\":\"359206058964917\",\"437573746f6d\":\"ooo\"}', 0, ''),
(25, 'elina kambra', 19, '07884026022', 0, 1, 'iphone 7 lcd genuine', 'phones', 'iphone 7', 'lcd', 0, 140, '2018-01-09 13:50:34', NULL, 0, 'Collected and delivered. 09/01/18 16:00', '6FT3ddN5', '{\"494d4549\":\"1450410310321351313\",\"437573746f6d\":\"\"}', 0, ''),
(21, 'Huawei x585', 16, '07000000000000', 0, 1, 'memory card reader', 'phones', 'huawei', 'hu', 0, 60, '2018-01-08 15:12:25', NULL, 1, 'ASk ASghar about price.', 'U2D3mR1C', '{\"494d4549\":\"354646846\",\"437573746f6d\":\"\"}', 0, ''),
(22, 'iP7 baterry', 17, '075456954', 0, 1, 'ask asghar', 'phones', 'battery', 'iph 7 bater', 0, 0, '2018-01-08 15:15:30', NULL, 0, 'ASk asghar why i addedmm', '2040', '{\"494d4549\":\"354351\",\"437573746f6d\":\"\"}', 0, ''),
(24, 'Jack apple watch', 18, '07833447421', 0, 1, 'lcd came out', 'apple watch', 'Series 1', 'Smartwatch', 0, 0, '2018-01-08 16:09:21', NULL, 2, 'Asghar fixed that. need to call costumer to collect it. ', 'wFr3Ybmo', '{\"494d4549\":\"3543\",\"437573746f6d\":\"0\"}', 0, ''),
(26, 'tomek  to', 20, '07766391874', 0, 1, 'unlock passcode', 'phones', 'mi', 'mi', 0, 30, '2018-01-09 17:13:19', NULL, 1, '', '76zmfe8C', '{\"494d4549\":\"352143541685\",\"437573746f6d\":\"\"}', 0, ''),
(27, 'iphone battery asdf', 21, '07508506547', 0, 1, 'iphone battery', 'iPhone', '5s', 'battery', 0, 30, '2018-01-10 10:27:32', NULL, 0, 'collected at 10.50', 'MW9VbvW2', '{\"494d4549\":\"546546\",\"437573746f6d\":\"\"}', 0, ''),
(29, 'Jasmin JA', 23, '07954089442', 0, 1, 'dead laptop', 'Laptop', 'Lenovo', 'Le', 0, 0, '2018-01-11 14:05:03', NULL, 2, 'NOT DONE will collect on monday, £20 SERVICE CHARGE', 'XujWkGza', '{\"494d4549\":\"\",\"437573746f6d\":\"\"}', 0, ''),
(28, 'Suzan ads', 22, '077777777', 0, 1, 'CP', 'phones', 'S7', 'Sam', 0, 45, '2018-01-10 12:37:40', NULL, 0, 'waiting for collection', 'Jc5xvjNw', '{\"494d4549\":\"3543543\",\"437573746f6d\":\"\"}', 0, ''),
(30, 'Ian s7  sasd', 24, '07856224260', 0, 1, 'water damage', 'phones', 'samsung s7', 'water damage', 0, 0, '2018-01-12 11:13:12', NULL, 1, 'water damage', '53pv8SSM', '{\"494d4549\":\"\",\"437573746f6d\":\"\"}', 0, ''),
(31, 'Suzan ads', 22, '077777777', 0, 1, 'testing', 'tablet', 'gpd', '000', 0, 0, '2018-01-15 12:28:43', '2018-01-15 12:29:50', 0, 'tesing. added more stuff, added more now', 'JtZl2YY4', '{\"494d4549\":\"testing\",\"437573746f6d\":\"tesging\"}', 0, ''),
(32, 'Parvez safsadf', 4, '156', 0, 1, 'cold syndrome', 'tablet', 'testing', '0000', 0, 0, '2018-01-16 11:16:07', NULL, 1, 'testing 1\ntesting 2', 'FX4CYeVT', '{\"494d4549\":\"dfasdf\",\"437573746f6d\":\"\"}', 0, 'jiosadjo@gmail.com'),
(33, 'hibo sister', 25, '07487727619', 0, 0, 'iphone 6s', 'phones', '6s', '000', 50, 60, '2018-01-16 12:22:38', NULL, 1, 'screen broken', 'f3P1uAbZ', '{\"494d4549\":\"42342\",\"437573746f6d\":\"\"}', 0, 'hibo@gmail.com'),
(34, 'raymunda ray', 26, '07597313674', 0, 0, 'laptop its very slow, application not opening, anitvirus finished', 'lenova', 'ideapad', '000', 0, 0, '2018-01-16 13:04:39', '2018-02-14 13:39:21', 0, 'call her and quote ', 'udaVVo1d', '{\"494d4549\":\"000\",\"437573746f6d\":\"\"}', 0, 'puhvd'),
(35, 'parvez syed', 27, '074298678', 0, 1, 'LCD Screen, and blutoth', 'iPhone', '7 128gb', '01', 20, 50, '2018-02-14 20:09:11', '2018-02-14 20:19:53', 0, 'lcd', 'XAFstAMc', '{\"494d4549\":\"3224268865876\",\"437573746f6d\":\"spp\"}', 0, 'parvezsyed84@gmail.com'),
(36, 'adyan  khan', 28, '078654654325', 0, 1, 'c/p', 'xbox', 'balck', '01', 128, 200, '2018-02-14 20:18:33', NULL, 1, 'nice cousatm', 'Ukozpy8G', '{\"494d4549\":\"7987866878754454\",\"437573746f6d\":\"hbkhgh\"}', 0, 'PPJDFGXFXGS2.COM'),
(37, 'parvez syed', 27, '074298678', 0, 1, 'lcd broken', 'phones', 's3', '01', 100, 100, '2018-02-19 16:28:01', '2018-02-19 16:32:59', 0, 'good ', 'xEefgo2o', '{\"494d4549\":\"34523f324f\",\"437573746f6d\":\"dfd\"}', 0, 'parvezsyed84@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impostazioni`
--
ALTER TABLE `impostazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oggetti`
--
ALTER TABLE `oggetti`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clienti`
--
ALTER TABLE `clienti`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `impostazioni`
--
ALTER TABLE `impostazioni`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oggetti`
--
ALTER TABLE `oggetti`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
