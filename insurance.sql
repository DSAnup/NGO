-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2021 at 12:48 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `ims_loan`
--

CREATE TABLE `ims_loan` (
  `LoanID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `LoanSchemeID` int(11) DEFAULT NULL,
  `LoanPrefix` varchar(20) DEFAULT 'SCH',
  `LoanDate` datetime DEFAULT NULL,
  `LoanIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ims_loan`
--

INSERT INTO `ims_loan` (`LoanID`, `UserID`, `LoanSchemeID`, `LoanPrefix`, `LoanDate`, `LoanIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 898, 4, 'SCH', '2021-02-09 12:06:00', 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(2, 1, 1, 'SCH', '2021-02-04 12:07:00', 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(3, 3, 4, 'SCH', '2021-02-07 15:10:00', 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ims_loanscheme`
--

CREATE TABLE `ims_loanscheme` (
  `LoanSchemeID` int(11) NOT NULL,
  `LoanSchemeName` varchar(255) DEFAULT NULL,
  `LoanSchemeDay` int(11) DEFAULT NULL,
  `LoanSchemeAmount` int(11) DEFAULT NULL,
  `LoanSchemePercentage` int(11) DEFAULT NULL,
  `LoanSchemePayPerInstallment` int(11) DEFAULT NULL,
  `LoanSchemePayableAmount` int(11) DEFAULT NULL,
  `LoanSchemeTotalInstallment` int(11) DEFAULT NULL,
  `LoanSchemeIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ims_loanscheme`
--

INSERT INTO `ims_loanscheme` (`LoanSchemeID`, `LoanSchemeName`, `LoanSchemeDay`, `LoanSchemeAmount`, `LoanSchemePercentage`, `LoanSchemePayPerInstallment`, `LoanSchemePayableAmount`, `LoanSchemeTotalInstallment`, `LoanSchemeIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Weekly', 7, 150000, NULL, 3800, 197600, 52, 1, 2, NULL, NULL, '2021-01-30 22:57:50', NULL, NULL),
(4, 'Monthly', 30, 150000, NULL, 17500, 210000, 12, 1, 2, NULL, NULL, '2021-01-31 23:37:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ims_loantransaction`
--

CREATE TABLE `ims_loantransaction` (
  `LoanTransactionID` int(11) NOT NULL,
  `LoanID` int(11) DEFAULT NULL,
  `LoanTransactionPayableDate` datetime DEFAULT NULL,
  `LoanTransactionPaidDate` datetime DEFAULT NULL,
  `LoanTransactionIsPaid` tinyint(1) NOT NULL DEFAULT 0,
  `LoanTransactionIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ims_loantransaction`
--

INSERT INTO `ims_loantransaction` (`LoanTransactionID`, `LoanID`, `LoanTransactionPayableDate`, `LoanTransactionPaidDate`, `LoanTransactionIsPaid`, `LoanTransactionIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 1, '2021-03-11 00:00:00', '2021-02-09 00:00:00', 1, 1, 2, 2, NULL, '2021-02-09 12:06:35', '2021-02-09 12:06:47', NULL),
(2, 1, '2021-04-10 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(3, 1, '2021-05-10 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(4, 1, '2021-06-09 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(5, 1, '2021-07-09 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(6, 1, '2021-08-08 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(7, 1, '2021-09-07 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(8, 1, '2021-10-07 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(9, 1, '2021-11-06 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(10, 1, '2021-12-06 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(11, 1, '2022-01-05 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(12, 1, '2022-02-04 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:06:35', NULL, NULL),
(13, 2, '2021-02-16 00:00:00', '2021-02-09 00:00:00', 1, 1, 2, 2, NULL, '2021-02-09 12:07:19', '2021-02-09 12:07:31', NULL),
(14, 2, '2021-02-23 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(15, 2, '2021-03-02 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(16, 2, '2021-03-09 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(17, 2, '2021-03-16 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(18, 2, '2021-03-23 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(19, 2, '2021-03-30 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(20, 2, '2021-04-06 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(21, 2, '2021-04-13 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(22, 2, '2021-04-20 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(23, 2, '2021-04-27 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(24, 2, '2021-05-04 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(25, 2, '2021-05-11 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(26, 2, '2021-05-18 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(27, 2, '2021-05-25 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(28, 2, '2021-06-01 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(29, 2, '2021-06-08 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(30, 2, '2021-06-15 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(31, 2, '2021-06-22 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(32, 2, '2021-06-29 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(33, 2, '2021-07-06 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(34, 2, '2021-07-13 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(35, 2, '2021-07-20 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(36, 2, '2021-07-27 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(37, 2, '2021-08-03 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(38, 2, '2021-08-10 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(39, 2, '2021-08-17 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(40, 2, '2021-08-24 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(41, 2, '2021-08-31 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(42, 2, '2021-09-07 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(43, 2, '2021-09-14 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(44, 2, '2021-09-21 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(45, 2, '2021-09-28 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(46, 2, '2021-10-05 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(47, 2, '2021-10-12 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(48, 2, '2021-10-19 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(49, 2, '2021-10-26 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(50, 2, '2021-11-02 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(51, 2, '2021-11-09 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(52, 2, '2021-11-16 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(53, 2, '2021-11-23 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(54, 2, '2021-11-30 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(55, 2, '2021-12-07 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(56, 2, '2021-12-14 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(57, 2, '2021-12-21 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(58, 2, '2021-12-28 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(59, 2, '2022-01-04 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(60, 2, '2022-01-11 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(61, 2, '2022-01-18 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(62, 2, '2022-01-25 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(63, 2, '2022-02-01 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(64, 2, '2022-02-08 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 12:07:19', NULL, NULL),
(65, 3, '2021-03-11 00:00:00', '2021-02-10 00:00:00', 1, 1, 2, 899, NULL, '2021-02-09 15:11:48', '2021-02-10 13:24:21', NULL),
(66, 3, '2021-04-10 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(67, 3, '2021-05-10 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(68, 3, '2021-06-09 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(69, 3, '2021-07-09 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(70, 3, '2021-08-08 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(71, 3, '2021-09-07 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(72, 3, '2021-10-07 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(73, 3, '2021-11-06 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(74, 3, '2021-12-06 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(75, 3, '2022-01-05 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL),
(76, 3, '2022-02-04 00:00:00', NULL, 0, 1, 2, NULL, NULL, '2021-02-09 15:11:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_applicationchangelog`
--

CREATE TABLE `sphp_applicationchangelog` (
  `ApplicationChangeLogID` int(11) NOT NULL,
  `ApplicationChangeLogTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ApplicationChangeLogDescription` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationChangeLogTime` datetime NOT NULL,
  `ApplicationChangeLogIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sphp_applicationtraffic`
--

CREATE TABLE `sphp_applicationtraffic` (
  `ApplicationTrafficID` int(11) NOT NULL,
  `ApplicationTrafficServer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficHost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficSessionCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficTime` datetime DEFAULT NULL,
  `ApplicationTrafficIP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficMethod` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficProtocol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficURL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficScript` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficQuery` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficReferer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficUserAgent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficResourceUsageDurationUser` int(11) DEFAULT NULL,
  `ApplicationTrafficResourceUsageDurationSystem` int(11) DEFAULT NULL,
  `ApplicationTrafficExecutionBegin` datetime DEFAULT NULL,
  `ApplicationTrafficExecutionEnd` datetime DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ApplicationTrafficLatitude` float(9,5) DEFAULT NULL,
  `ApplicationTrafficLongitude` float(9,5) DEFAULT NULL,
  `ApplicationTrafficMetro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficCity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficPostCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficCountry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApplicationTrafficIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sphp_country`
--

CREATE TABLE `sphp_country` (
  `CountryID` int(11) NOT NULL,
  `CountryName` varchar(85) COLLATE utf8_unicode_ci NOT NULL,
  `CountryCode` int(11) NOT NULL DEFAULT 0,
  `CountryISOCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `CountryISOCode2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CountryFlag` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `CountryMap` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LanguageID` int(11) DEFAULT NULL,
  `CurrencyID` int(11) DEFAULT NULL,
  `CountryIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) NOT NULL DEFAULT 0,
  `UserIDUpdated` int(11) NOT NULL DEFAULT 0,
  `UserIDLocked` int(11) NOT NULL DEFAULT 0,
  `TimeInserted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeLocked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_country`
--

INSERT INTO `sphp_country` (`CountryID`, `CountryName`, `CountryCode`, `CountryISOCode`, `CountryISOCode2`, `CountryFlag`, `CountryMap`, `LanguageID`, `CurrencyID`, `CountryIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Bangladesh', 88, 'BD', 'BGD', '6E4759C6EFA74AC381AEAB0AA8031AF40E26BE4359DC41EB8F601352E7CD1CA9.png', '', 2, NULL, 1, 0, 2, 0, '2015-02-06 01:11:08', '2019-02-10 10:43:09', '0000-00-00 00:00:00'),
(2, 'United States', 1, 'USA', NULL, 'A18E14552118430BB21FF1C636EC18DE8AB1B6A43E4A482587E9D09308B58D5E.png', '', 1, NULL, 1, 0, 2, 0, '2015-02-06 01:11:08', '2019-02-10 12:37:01', '0000-00-00 00:00:00'),
(3, 'United Kingdom', 44, 'UK', NULL, 'A381C122043448D9A6F925CEA8B807468E940F8F0F09472EB67EA6F5FD8C926B.png', '', 8, NULL, 1, 0, 2, 0, '2015-02-06 01:11:25', '2019-02-10 12:37:11', '0000-00-00 00:00:00'),
(4, 'Afghanistan', 93, 'AF', NULL, '', '', NULL, NULL, 1, 124, 2, 0, '2015-02-14 23:25:16', '2015-03-04 02:59:24', '0000-00-00 00:00:00'),
(7, 'France', 33, 'FRA', NULL, '', '', NULL, NULL, 1, 1, 2, 0, '2015-03-02 02:57:00', '2015-03-02 19:28:24', '0000-00-00 00:00:00'),
(11, 'Belarus', 375, 'BY', NULL, 'BA5ECE60A45D44CBAFB610DF85422E79E8680B92492345A8B8280F3C326F170A.png', '', 3, NULL, 1, 1, 2, 0, '2015-03-03 16:29:15', '2019-02-10 12:28:47', '0000-00-00 00:00:00'),
(13, 'Ukraine', 38, 'UA', NULL, 'BD16646DE4B24904926986FE5A96A3703B8B511341904BAC9873B83C8130B081.png', '', 24, NULL, 1, 1, 2, 0, '2015-03-05 11:48:21', '2019-02-10 12:37:40', '0000-00-00 00:00:00'),
(14, 'China', 86, 'CN', NULL, 'DB6634A88C39423DA0871AB535FBDE832BE12C0F119C40DDA0F073CF4705033E.png', '', 4, NULL, 1, 1, 2, 0, '2015-03-06 02:25:53', '2019-02-10 12:40:22', '0000-00-00 00:00:00'),
(15, 'India', 91, 'IN', NULL, '', '', NULL, NULL, 1, 1, 2, 0, '2015-03-06 04:28:49', '2015-03-06 16:26:23', '0000-00-00 00:00:00'),
(16, 'Canada', 1, 'CA', NULL, '3B7CCC5E4C63426B937A6F19D01EB01285E22BE54F774EE3BF082AC146AF88FF.png', '', 1, NULL, 1, 2, 2, 0, '2015-03-06 16:31:18', '2019-02-10 12:40:12', '0000-00-00 00:00:00'),
(17, 'Hong Kong', 852, 'HK', NULL, '', '', NULL, NULL, 1, 1, 2, 0, '2015-03-08 11:28:20', '2015-03-08 16:14:09', '0000-00-00 00:00:00'),
(18, 'Netherlands', 31, 'NL', NULL, '', '', NULL, NULL, 1, 2, 2, 0, '2015-03-09 05:53:49', '2015-03-09 05:55:53', '0000-00-00 00:00:00'),
(19, 'Japan', 81, 'JP', NULL, '', '', NULL, NULL, 1, 2, 0, 0, '2015-03-09 22:29:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Bulgaria', 359, 'BG', NULL, '782B5E9CC1C74894B8ADAA17DB33618AFDFC0ABD93D64640A4E1A896ADCA4A05.png', '', 3, NULL, 1, 2, 2, 0, '2015-03-10 02:23:14', '2019-02-10 12:28:07', '0000-00-00 00:00:00'),
(21, 'Sweden', 45, 'SE', NULL, 'C53F09495A444AFEA15E5D2DDA578CC2F82095C3448E43EAA9AF97F8587EA69B.png', '', 3, NULL, 1, 2, 2, 0, '2015-03-10 02:23:59', '2019-02-10 12:33:22', '0000-00-00 00:00:00'),
(22, 'Germany', 49, 'DE', NULL, '', '', NULL, NULL, 1, 2, 0, 0, '2015-03-16 04:01:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Australia', 61, 'AU', NULL, '606AF98BFD7A4DE8B3FBA84B81724E6298504010782C45489DE93D0FF5D77D02.png', '', 1, NULL, 1, 2, 2, 0, '2015-03-19 11:44:56', '2019-02-10 12:39:49', '0000-00-00 00:00:00'),
(24, 'Russia', 7, 'RU', NULL, '', '', NULL, NULL, 1, 2, 0, 0, '2015-03-20 04:13:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Other', 0, 'OTHER', NULL, '', '', NULL, NULL, 1, 2, 0, 0, '2015-03-21 18:47:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Saudi Arabia', 966, 'KSA', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Andorra', 376, 'AD', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'United Arab Emirates', 971, 'AE', NULL, '971FD6E982BA4361BF8275315C5C605878358368F2384A048F436E9811FF0F42.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:30:43', '0000-00-00 00:00:00'),
(99, 'Antigua and Barbuda', 1268, 'AG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Anguilla', 1264, 'AI', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Albania', 355, 'AL', NULL, '57E13336DCC44424B3A5DCF4C6BB169D3BF3254F198F40389174EECD0486E0EA.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:29:40', '0000-00-00 00:00:00'),
(102, 'Armenia', 374, 'AM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Angola', 244, 'AO', NULL, '2612B41E2EE34E25A8D313E6C5553A187F5C837DF8FF4048AFF6E1438C746087.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:29:15', '0000-00-00 00:00:00'),
(104, 'Antarctica', 0, 'AQ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Argentina', 54, 'AR', NULL, '781FCB5DBDA940859C0500F7869E7F93DBC9424338A649A1B98B2B6211F29DE0.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 10:46:50', '0000-00-00 00:00:00'),
(106, 'American Samoa', 1684, 'AS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Austria', 43, 'AT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Aruba', 297, 'AW', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Ã…land Islands', 358, 'AX', NULL, '', '', NULL, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2015-09-07 05:35:28', '0000-00-00 00:00:00'),
(110, 'Azerbaijan', 994, 'AZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Bosnia and Herzegovina', 387, 'BA', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Barbados', 1246, 'BB', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Belgium', 32, 'BE', NULL, '0FAE601B68BA41F2A9E01CDC3EBE7AD7AB4DDA62FEBF42EBB18F8D7EDA3D4792.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:28:27', '0000-00-00 00:00:00'),
(114, 'Burkina Faso', 226, 'BF', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Bahrain', 973, 'BH', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Burundi', 257, 'BI', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Benin', 229, 'BJ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Saint BarthÃ©lemy', 590, 'BL', NULL, '', '', NULL, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2015-09-07 06:20:04', '0000-00-00 00:00:00'),
(119, 'Bermuda', 1441, 'BM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Brunei Darussalam', 673, 'BN', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Bolivia', 591, 'BO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Caribbean Netherlands', 5997, 'BQ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Brazil', 55, 'BR', NULL, 'E53D748F54CF43D0869A49178C03171565DDFD0271C04F9BBE9A296DE3C4F55B.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:20:49', '0000-00-00 00:00:00'),
(124, 'Bahamas', 1242, 'BS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Bhutan', 975, 'BT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Bouvet Island', 0, 'BV', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Botswana', 267, 'BW', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Belize', 501, 'BZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Cocos (Keeling) Islands', 61, 'CC', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Central African Republic', 236, 'CF', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Congo', 242, 'CG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Switzerland', 41, 'CH', NULL, 'AEEFF27537CB42D2A546AEB268D88BC27755618C1FA84A12B9932414389059CB.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:33:31', '0000-00-00 00:00:00'),
(133, 'CÃ´te d\'Ivoire', 225, 'CI', NULL, '', '', NULL, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2015-09-07 06:19:00', '0000-00-00 00:00:00'),
(134, 'Cook Islands', 682, 'CK', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Chile', 56, 'CL', NULL, '3A540B1DCB934573AE26B37A5D7A43AEF0011F1A77C04F9EA3821880E2DC4A18.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:21:41', '0000-00-00 00:00:00'),
(136, 'Cameroon', 237, 'CM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Colombia', 57, 'CO', NULL, 'D91823A2F5E04B1692D0948A00319DBF90E6B6F7DFE447998F890C2DA5798D57.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:21:28', '0000-00-00 00:00:00'),
(138, 'Costa Rica', 506, 'CR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Cuba', 53, 'CU', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Cape Verde', 238, 'CV', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'CuraÃ§ao', 5999, 'CW', NULL, '', '', NULL, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2015-09-07 06:19:18', '0000-00-00 00:00:00'),
(142, 'Christmas Island', 61, 'CX', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Cyprus', 357, 'CY', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Czech Republic', 420, 'CZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Djibouti', 253, 'DJ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Denmark', 45, 'DK', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Dominica', 1767, 'DM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Dominican Republic', 1809, 'DO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Algeria', 213, 'DZ', NULL, '93EF98BA598343DF93A989AD4ECCF48B03749CA3B03741A59F74BD0279668E75.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 10:45:10', '0000-00-00 00:00:00'),
(150, 'Ecuador', 593, 'EC', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Estonia', 372, 'EE', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Egypt', 20, 'EG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Western Sahara', 212, 'EH', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Eritrea', 291, 'ER', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Spain', 34, 'ES', NULL, 'A63A69F6F4DB49CEA857AF97DB33348D600A4BAB694B4F9096BFBC5B9821032F.png', '', 22, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:38:18', '0000-00-00 00:00:00'),
(156, 'Ethiopia', 251, 'ET', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Finland', 358, 'FI', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'Fiji', 679, 'FJ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'Falkland Islands', 500, 'FK', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Micronesia', 691, 'FM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Faroe Islands', 298, 'FO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Gabon', 241, 'GA', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Grenada', 1473, 'GD', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Georgia', 995, 'GE', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'French Guiana', 594, 'GF', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Guernsey', 44, 'GG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Ghana', 233, 'GH', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Gibraltar', 350, 'GI', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Greenland', 299, 'GL', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Gambia', 220, 'GM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Guinea', 224, 'GN', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Guadeloupe', 590, 'GP', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Equatorial Guinea', 240, 'GQ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Greece', 30, 'GR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'South Georgia and the South Sandwich Islands', 500, 'GS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Guatemala', 502, 'GT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Guam', 1671, 'GU', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Guinea-Bissau', 245, 'GW', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Guyana', 592, 'GY', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Heard and McDonald Islands', 0, 'HM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Honduras', 504, 'HN', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Croatia', 385, 'HR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Haiti', 509, 'HT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Hungary', 36, 'HU', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Indonesia', 62, 'ID', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Ireland', 353, 'IE', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Israel', 972, 'IL', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Isle of Man', 44, 'IM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'British Indian Ocean Territory', 246, 'IO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Iraq', 964, 'IQ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Iran', 98, 'IR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Iceland', 354, 'IS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'Italy', 39, 'IT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Jersey', 44, 'JE', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Jamaica', 1876, 'JM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Jordan', 962, 'JO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'Kenya', 254, 'KE', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'Kyrgyzstan', 996, 'KG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Cambodia', 855, 'KH', NULL, '001D93E496284251BE97211ACFF566F2AD9D1AEB379F4C5B9784BFDE685C6DDE.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:27:38', '0000-00-00 00:00:00'),
(200, 'Kiribati', 686, 'KI', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'Comoros', 269, 'KM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Saint Kitts and Nevis', 1869, 'KN', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'North Korea', 850, 'KP', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'South Korea', 82, 'KR', NULL, '', '', 14, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:38:33', '0000-00-00 00:00:00'),
(205, 'Kuwait', 965, 'KW', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'Cayman Islands', 1345, 'KY', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'Kazakhstan', 76, 'KZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'Lao People\'s Democratic Republic', 856, 'LA', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Lebanon', 961, 'LB', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Saint Lucia', 1758, 'LC', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Liechtenstein', 423, 'LI', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Sri Lanka', 94, 'LK', NULL, 'E22951E58D08438782FA8E5D8AB96C982396E38569EA405F8AD8BAC5F4C5158A.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:32:59', '0000-00-00 00:00:00'),
(213, 'Liberia', 231, 'LR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Lesotho', 266, 'LS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Lithuania', 370, 'LT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Luxembourg', 352, 'LU', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Latvia', 371, 'LV', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Libya', 218, 'LY', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Morocco', 212, 'MA', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Monaco', 377, 'MC', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Moldova', 373, 'MD', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'Montenegro', 382, 'ME', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Saint-Martin (France)', 590, 'MF', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'Madagascar', 261, 'MG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'Marshall Islands', 692, 'MH', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'Macedonia', 389, 'MK', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'Mali', 223, 'ML', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'Myanmar', 95, 'MM', 'MYN', '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'Mongolia', 976, 'MN', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'Macau', 853, 'MO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'Northern Mariana Islands', 1670, 'MP', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Martinique', 596, 'MQ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Mauritania', 222, 'MR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'Montserrat', 1664, 'MS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'Malta', 356, 'MT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'Mauritius', 230, 'MU', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'Maldives', 960, 'MV', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Malawi', 265, 'MW', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Mexico', 52, 'MX', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 'Malaysia', 60, 'MY', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 'Mozambique', 258, 'MZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'Namibia', 264, 'NA', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 'New Caledonia', 687, 'NC', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 'Niger', 227, 'NE', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 'Norfolk Island', 672, 'NF', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 'Nigeria', 234, 'NG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 'Nicaragua', 505, 'NI', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 'Norway', 47, 'NO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 'Nepal', 977, 'NP', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(250, 'Nauru', 674, 'NR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(251, 'Niue', 683, 'NU', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(252, 'New Zealand', 64, 'NZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(253, 'Oman', 968, 'OM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(254, 'Panama', 507, 'PA', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(255, 'Peru', 51, 'PE', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(256, 'French Polynesia', 689, 'PF', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(257, 'Papua New Guinea', 675, 'PG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(258, 'Philippines', 63, 'PH', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(259, 'Pakistan', 92, 'PK', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(260, 'Poland', 48, 'PL', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(261, 'St. Pierre and Miquelon', 508, 'PM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(262, 'Pitcairn', 64, 'PN', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(263, 'Puerto Rico', 1787, 'PR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(264, 'Palestine', 970, 'PS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(265, 'Portugal', 351, 'PT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(266, 'Palau', 680, 'PW', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(267, 'Paraguay', 595, 'PY', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(268, 'Qatar', 974, 'QA', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(269, 'RÃ©union', 262, 'RE', NULL, '', '', NULL, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2015-09-07 06:19:44', '0000-00-00 00:00:00'),
(270, 'Romania', 40, 'RO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(271, 'Serbia', 381, 'RS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(272, 'Rwanda', 250, 'RW', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(273, 'Solomon Islands', 677, 'SB', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(274, 'Seychelles', 248, 'SC', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(275, 'Sudan', 249, 'SD', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(276, 'Singapore', 65, 'SG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(277, 'Saint Helena', 290, 'SH', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(278, 'Slovenia', 386, 'SI', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(279, 'Svalbard and Jan Mayen Islands', 4779, 'SJ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(280, 'Slovakia', 421, 'SK', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(281, 'Sierra Leone', 232, 'SL', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(282, 'San Marino', 378, 'SM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(283, 'Senegal', 221, 'SN', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(284, 'Somalia', 252, 'SO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(285, 'Suriname', 597, 'SR', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(286, 'South Sudan', 211, 'SS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(287, 'Sao Tome and Principe', 239, 'ST', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(288, 'El Salvador', 503, 'SV', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(289, 'Sint Maarten (Dutch part)', 1721, 'SX', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(290, 'Syria', 963, 'SY', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(291, 'Swaziland', 268, 'SZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(292, 'Turks and Caicos Islands', 1649, 'TC', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(293, 'Chad', 235, 'TD', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(294, 'French Southern Territories', 0, 'TF', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(295, 'Togo', 228, 'TG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(296, 'Thailand', 66, 'TH', NULL, '6D1220E57D084D638DE5AD1D481E22B49C36273CF654414DB5BB6FB6C5751CE1.png', '', 23, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:37:59', '0000-00-00 00:00:00'),
(297, 'Tajikistan', 992, 'TJ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(298, 'Tokelau', 690, 'TK', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(299, 'Timor-Leste', 670, 'TL', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(300, 'Turkmenistan', 993, 'TM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(301, 'Tunisia', 216, 'TN', NULL, 'ACA659F736104E7F8D2013E6A9C55180B90174568FDC4AC7885BDCC487A71DC1.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:31:39', '0000-00-00 00:00:00'),
(302, 'Tonga', 676, 'TO', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(303, 'Turkey', 90, 'TR', NULL, '606ECF36742E495ABF2698234EE873D18F000140FBD249F0B8DDA24B201F9451.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:31:05', '0000-00-00 00:00:00'),
(304, 'Trinidad and Tobago', 1868, 'TT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(305, 'Tuvalu', 688, 'TV', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(306, 'Taiwan', 886, 'TW', NULL, 'EEE8ED4F00844D3B9E43B2770285B577404BCAA665994F0796B039B3A135DBC3.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:33:41', '0000-00-00 00:00:00'),
(307, 'Tanzania', 255, 'TZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(308, 'Uganda', 256, 'UG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(309, 'United States Minor Outlying Islands', 0, 'UM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(310, 'Uruguay', 598, 'UY', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(311, 'Uzbekistan', 998, 'UZ', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(312, 'Vatican', 379, 'VA', NULL, '', '', NULL, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2015-09-07 06:32:57', '0000-00-00 00:00:00'),
(313, 'Saint Vincent and the Grenadines', 1784, 'VC', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(314, 'Venezuela', 58, 'VE', NULL, '04FD76ABF7F145529A2271F60D75E818DC18046307CA4137B6C0EA44DA52FC9A.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:31:20', '0000-00-00 00:00:00'),
(315, 'Virgin Islands (British)', 1284, 'VG', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(316, 'Virgin Islands (U.S.)', 1340, 'VI', NULL, '', '', NULL, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2015-09-07 06:31:22', '0000-00-00 00:00:00'),
(317, 'Vietnam', 84, 'VN', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(318, 'Vanuatu', 678, 'VU', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(319, 'Wallis and Futuna Islands', 681, 'WF', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(320, 'Samoa', 685, 'WS', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(321, 'Yemen', 967, 'YE', NULL, '6F79D202276748C4837D8022B1CAB384EE53F9B7037B4F55A9C7B7A6462C4120.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:34:17', '0000-00-00 00:00:00'),
(322, 'Mayotte', 262, 'YT', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(323, 'South Africa', 27, 'ZA', NULL, 'B5FC589064E746738B1BAE9623D783D94F95A7E9C2904D44880076C78A8F816F.png', '', 3, NULL, 1, 0, 2, 0, '0000-00-00 00:00:00', '2019-02-10 12:38:47', '0000-00-00 00:00:00'),
(324, 'Zambia', 260, 'ZM', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(325, 'Zimbabwe', 263, 'ZW', NULL, '', '', NULL, NULL, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sphp_countrystate`
--

CREATE TABLE `sphp_countrystate` (
  `CountryStateID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CountryStateIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_countrystate`
--

INSERT INTO `sphp_countrystate` (`CountryStateID`, `CountryID`, `StateName`, `CountryStateIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 1, 'Dhaka', 1, NULL, NULL, NULL, '2020-06-29 09:07:07', NULL, NULL),
(2, 1, 'Barishal', 1, NULL, NULL, NULL, '2020-06-29 09:11:42', NULL, NULL),
(3, 1, 'Chittagong', 1, NULL, NULL, NULL, '2020-06-29 09:11:42', NULL, NULL),
(4, 1, 'Comilla', 1, NULL, NULL, NULL, '2020-06-29 09:11:42', NULL, NULL),
(5, 1, 'Tangail', 1, NULL, NULL, NULL, '2020-06-29 15:37:56', NULL, NULL),
(6, 1, 'Kustia', 1, NULL, NULL, NULL, '2020-06-29 16:02:12', NULL, NULL),
(7, 1, '', 1, NULL, NULL, NULL, '2020-06-30 11:51:10', NULL, NULL),
(8, 1, 'Chattogram', 1, NULL, NULL, NULL, '2020-07-01 00:11:04', NULL, NULL),
(9, 1, 'Feni', 1, NULL, NULL, NULL, '2020-07-02 12:19:37', NULL, NULL),
(10, 1, 'Laxmipur', 1, NULL, NULL, NULL, '2020-07-08 12:40:44', NULL, NULL),
(11, 1, 'Rajshahi', 1, NULL, NULL, NULL, '2020-07-09 14:34:09', NULL, NULL),
(12, 1, 'Cox\'s Bazar', 1, NULL, NULL, NULL, '2020-07-14 18:57:12', NULL, NULL),
(13, 1, 'Dinajpur', 1, NULL, NULL, NULL, '2020-07-15 16:25:07', NULL, NULL),
(14, 1, 'Gopalgonj', 1, NULL, NULL, NULL, '2020-07-15 19:02:38', NULL, NULL),
(15, 1, 'Jessore', 1, NULL, NULL, NULL, '2020-07-16 18:35:31', NULL, NULL),
(16, 1, 'Netrokuna', 1, NULL, NULL, NULL, '2020-07-16 23:24:16', NULL, NULL),
(17, 1, 'Dhak', 1, NULL, NULL, NULL, '2020-07-19 17:48:01', NULL, NULL),
(18, 1, 'Narayangonj', 1, NULL, NULL, NULL, '2020-07-20 12:11:46', NULL, NULL),
(19, 1, 'Kishargonj', 1, NULL, NULL, NULL, '2020-07-21 15:19:01', NULL, NULL),
(20, 1, ' Bagerhat', 1, NULL, NULL, NULL, '2020-07-22 13:47:48', NULL, NULL),
(21, 1, 'Bagerhat.', 1, NULL, NULL, NULL, '2020-07-22 14:00:22', NULL, NULL),
(22, 1, 'Kushtia', 1, NULL, NULL, NULL, '2020-07-22 17:42:13', NULL, NULL),
(23, 1, 'Sylhet', 1, NULL, NULL, NULL, '2020-07-22 19:30:52', NULL, NULL),
(24, 1, 'Pabna', 1, NULL, NULL, NULL, '2020-07-22 20:11:56', NULL, NULL),
(25, 1, 'Bagherhat', 1, NULL, NULL, NULL, '2020-07-23 12:00:59', NULL, NULL),
(26, 1, 'Jhenaidah', 1, NULL, NULL, NULL, '2020-07-26 15:23:22', NULL, NULL),
(27, 1, 'Gazipur', 1, NULL, NULL, NULL, '2020-07-27 14:33:21', NULL, NULL),
(28, 1, 'Khilgaon', 1, NULL, NULL, NULL, '2020-08-02 11:15:24', NULL, NULL),
(29, 1, 'Naogaon', 1, NULL, NULL, NULL, '2020-08-06 14:19:46', NULL, NULL),
(30, 1, 'ctg', 1, NULL, NULL, NULL, '2020-08-08 14:12:50', NULL, NULL),
(31, 1, 'Uttara', 1, NULL, NULL, NULL, '2020-08-09 17:17:48', NULL, NULL),
(32, 1, 'Bagura', 1, NULL, NULL, NULL, '2020-08-11 15:32:12', NULL, NULL),
(33, 1, 'bandorbon', 1, NULL, NULL, NULL, '2020-08-13 10:25:45', NULL, NULL),
(34, 1, 'Thakurgaon', 1, NULL, NULL, NULL, '2020-08-13 13:51:31', NULL, NULL),
(35, 1, ' Jhenaidah', 1, NULL, NULL, NULL, '2020-08-17 18:48:16', NULL, NULL),
(36, 1, 'panchagor', 1, NULL, NULL, NULL, '2020-08-17 19:21:57', NULL, NULL),
(37, 1, 'Chadpur', 1, NULL, NULL, NULL, '2020-08-18 12:28:11', NULL, NULL),
(38, 1, 'Khulna', 1, NULL, NULL, NULL, '2020-08-18 21:20:08', NULL, NULL),
(39, 1, 'Noaga ', 1, NULL, NULL, NULL, '2020-08-20 18:30:07', NULL, NULL),
(40, 1, 'Lalmonirhat', 1, NULL, NULL, NULL, '2020-08-20 21:17:03', NULL, NULL),
(41, 1, ' Jamalpur', 1, NULL, NULL, NULL, '2020-08-22 10:08:51', NULL, NULL),
(42, 1, 'Rajbari ', 1, NULL, NULL, NULL, '2020-08-22 13:44:58', NULL, NULL),
(43, 1, 'Savar', 1, NULL, NULL, NULL, '2020-08-24 23:05:25', NULL, NULL),
(44, 1, 'shirajgonj', 1, NULL, NULL, NULL, '2020-08-25 12:23:40', NULL, NULL),
(45, 1, 'Madaripur', 1, NULL, NULL, NULL, '2020-08-27 13:10:57', NULL, NULL),
(46, 1, 'noakhali', 1, NULL, NULL, NULL, '2020-08-29 17:09:40', NULL, NULL),
(47, 1, 'Satkhira', 1, NULL, NULL, NULL, '2020-08-29 20:43:19', NULL, NULL),
(48, 1, 'rangpur', 1, NULL, NULL, NULL, '2020-09-21 15:34:38', NULL, NULL),
(49, 1, 'Lokkhipur ', 1, NULL, NULL, NULL, '2020-09-22 10:52:38', NULL, NULL),
(50, 1, 'Mymensingh', 1, NULL, NULL, NULL, '2020-10-10 12:19:18', NULL, NULL),
(51, 1, 'Barisal', 1, NULL, NULL, NULL, '2020-10-10 15:00:30', NULL, NULL),
(52, 1, 'Raipur', 1, NULL, NULL, NULL, '2020-10-12 17:29:44', NULL, NULL),
(53, 1, 'Narshingdi', 1, NULL, NULL, NULL, '2020-10-13 18:49:56', NULL, NULL),
(54, 1, 'Bogra', 1, NULL, NULL, NULL, '2020-10-17 16:25:24', NULL, NULL),
(55, 1, ' kishorgonj', 1, NULL, NULL, NULL, '2020-10-17 16:49:21', NULL, NULL),
(56, 1, 'Chadhpur ', 1, NULL, NULL, NULL, '2020-10-18 13:24:26', NULL, NULL),
(57, 1, 'norsindi', 1, NULL, NULL, NULL, '2020-10-18 16:23:00', NULL, NULL),
(58, 1, 'bogura', 1, NULL, NULL, NULL, '2020-10-19 13:39:26', NULL, NULL),
(59, 1, 'pirojpur', 1, NULL, NULL, NULL, '2020-10-19 16:34:57', NULL, NULL),
(60, 1, 'Kishorganj', 1, NULL, NULL, NULL, '2020-10-20 15:13:30', NULL, NULL),
(61, 1, 'Gaibandha', 1, NULL, NULL, NULL, '2020-10-21 11:37:10', NULL, NULL),
(62, 1, 'Rajhshahi', 1, NULL, NULL, NULL, '2020-10-21 13:11:26', NULL, NULL),
(63, 1, 'Laksmipur', 1, NULL, NULL, NULL, '2020-10-25 18:05:04', NULL, NULL),
(64, 1, ' Dhaka', 1, NULL, NULL, NULL, '2020-11-01 12:29:22', NULL, NULL),
(65, 1, ' Lobon chora', 1, NULL, NULL, NULL, '2020-11-03 18:18:14', NULL, NULL),
(66, 1, 'Narsingdi ', 1, NULL, NULL, NULL, '2020-11-04 18:34:35', NULL, NULL),
(67, 1, 'Manikganj', 1, NULL, NULL, NULL, '2020-11-05 14:38:13', NULL, NULL),
(68, 1, 'Brahmanbaria', 1, NULL, NULL, NULL, '2020-11-07 11:01:32', NULL, NULL),
(69, 1, 'Shariatpur', 1, NULL, NULL, NULL, '2020-11-07 17:49:26', NULL, NULL),
(70, 1, ' Nokhali Sadar', 1, NULL, NULL, NULL, '2020-11-09 13:20:40', NULL, NULL),
(71, 1, 'Joypurhat', 1, NULL, NULL, NULL, '2020-11-09 16:51:41', NULL, NULL),
(72, 1, 'Shariyatpur', 1, NULL, NULL, NULL, '2020-11-11 18:32:22', NULL, NULL),
(73, 1, 'Chandpur', 1, NULL, NULL, NULL, '2020-11-12 12:17:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_currency`
--

CREATE TABLE `sphp_currency` (
  `CurrencyID` int(11) NOT NULL,
  `CurrencyName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CurrencyCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CurrencyCode2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CurrencySymbol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CurrencyMajorName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CurrencyMinorName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CurrencyIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_currency`
--

INSERT INTO `sphp_currency` (`CurrencyID`, `CurrencyName`, `CurrencyCode`, `CurrencyCode2`, `CurrencySymbol`, `CurrencyMajorName`, `CurrencyMinorName`, `CurrencyIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Bangladeshi Taka', 'BDT', 'BDT', 'Tk', 'Taka', 'Paisa', 1, NULL, NULL, NULL, '2019-02-03 14:06:12', '2019-02-03 14:06:12', NULL),
(2, 'Pakistani Rupee', 'PKR', 'PKR', 'Rs', 'Rupee', 'Paisa', 1, NULL, NULL, NULL, '2019-02-03 14:06:12', '2019-02-03 14:06:12', NULL),
(3, 'Indian Rupee', 'INR', 'INR', 'Rs', 'Rupee', 'Paisa', 1, NULL, NULL, NULL, '2019-02-03 14:06:12', '2019-02-03 14:06:12', NULL),
(4, 'British Pound', 'GBP', 'GBP', '£', 'Pound', 'Starling', 1, NULL, NULL, NULL, '2019-02-03 14:06:12', '2019-02-03 14:06:12', NULL),
(5, 'US Dollar', 'USD', 'US$', '$', 'Dollar', 'Cent', 1, NULL, NULL, NULL, '2019-02-03 14:06:12', '2019-02-03 14:06:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_datatype`
--

CREATE TABLE `sphp_datatype` (
  `DataTypeID` int(11) NOT NULL,
  `DataTypeName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataTypeIdentifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataTypeIcon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataTypeIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sphp_gender`
--

CREATE TABLE `sphp_gender` (
  `GenderID` int(11) NOT NULL,
  `GenderName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GenderIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_gender`
--

INSERT INTO `sphp_gender` (`GenderID`, `GenderName`, `GenderIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Female', 1, NULL, NULL, NULL, '2019-02-03 14:06:13', '2019-02-03 14:06:13', NULL),
(2, 'Male', 1, NULL, NULL, NULL, '2019-02-03 14:06:13', '2019-02-03 14:06:13', NULL),
(3, 'Other', 1, NULL, NULL, NULL, '2019-02-03 14:06:13', '2019-02-03 14:06:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_language`
--

CREATE TABLE `sphp_language` (
  `LanguageID` int(11) NOT NULL,
  `LanguageName` varchar(85) COLLATE utf8_unicode_ci NOT NULL,
  `LanguageNameNative` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LanguageCode` varchar(85) COLLATE utf8_unicode_ci NOT NULL,
  `LanguageRegionalCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LanguageIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) NOT NULL DEFAULT 0,
  `UserIDUpdated` int(11) NOT NULL DEFAULT 0,
  `UserIDLocked` int(11) NOT NULL DEFAULT 0,
  `TimeInserted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeLocked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_language`
--

INSERT INTO `sphp_language` (`LanguageID`, `LanguageName`, `LanguageNameNative`, `LanguageCode`, `LanguageRegionalCode`, `LanguageIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'English (United States)', 'English (United States)', 'EN', 'US', 1, 151, 0, 0, '2015-02-09 17:54:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Bengali (Bangladesh)', 'বাংলা (বাংলাদেশী)', 'BN', 'BD', 1, 151, 2, 0, '2015-02-09 18:23:56', '2019-02-10 09:50:21', '0000-00-00 00:00:00'),
(3, 'Arabic', 'عربى', 'AR', NULL, 1, 124, 2, 0, '2015-02-10 00:48:37', '2019-02-10 10:33:21', '0000-00-00 00:00:00'),
(4, 'Chinese (Simplified)', '簡體中文）', 'ZH', 'HANS', 1, 124, 2, 0, '2015-02-10 00:50:56', '2019-02-10 10:32:52', '0000-00-00 00:00:00'),
(5, 'Chinese (Traditional)', '中國傳統的）', 'ZH', 'HANT', 1, 124, 2, 0, '2015-02-10 00:51:39', '2019-02-10 10:32:26', '0000-00-00 00:00:00'),
(6, 'Czech', 'čeština', 'CS', NULL, 1, 124, 2, 0, '2015-02-10 00:52:11', '2019-02-10 10:34:24', '0000-00-00 00:00:00'),
(7, 'Danish', 'Dansk', 'DA', NULL, 1, 124, 0, 0, '2015-02-10 00:54:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'English (United Kingdom)', 'English (United Kingdom)', 'EN', 'UK', 1, 124, 0, 0, '2015-02-10 00:55:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'French', 'franÃ§ais', 'FR', NULL, 1, 124, 2, 0, '2015-02-10 00:55:38', '2015-03-10 02:06:16', '0000-00-00 00:00:00'),
(10, 'German', 'Deutsch', 'DE', NULL, 1, 124, 0, 0, '2015-02-10 00:55:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Hindi', 'हिंदी', 'HI', NULL, 1, 124, 2, 0, '2015-02-10 00:56:09', '2019-02-10 10:37:28', '0000-00-00 00:00:00'),
(12, 'Irish', 'Gaeilge', 'GA', NULL, 1, 124, 0, 0, '2015-02-10 00:56:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Japanese', '日本人', 'JA', NULL, 1, 124, 2, 0, '2015-02-10 00:56:35', '2019-02-10 10:38:45', '0000-00-00 00:00:00'),
(14, 'Korean', '한국어', 'KO', NULL, 1, 124, 2, 0, '2015-02-10 00:56:47', '2019-02-10 10:39:09', '0000-00-00 00:00:00'),
(15, 'Lao', 'àºžàº²àºªàº²àº¥àº²àº§', 'LO', NULL, 1, 124, 2, 0, '2015-02-10 00:57:00', '2015-03-10 02:07:42', '0000-00-00 00:00:00'),
(16, 'Malayalam', 'മലയാളം', 'ML', NULL, 1, 124, 2, 0, '2015-02-10 00:57:13', '2019-02-10 10:38:13', '0000-00-00 00:00:00'),
(17, 'Nepali', 'à¤¨à¥‡à¤ªà¤¾à¤²à¥€', 'NE', NULL, 1, 124, 2, 0, '2015-02-10 00:57:29', '2015-03-10 02:08:27', '0000-00-00 00:00:00'),
(18, 'Oriya', 'à¬“à¬¡à¬¼à¬¿à¬†', 'OR', NULL, 1, 124, 2, 0, '2015-02-10 00:57:42', '2015-03-10 02:08:45', '0000-00-00 00:00:00'),
(19, 'Polish', 'polski', 'PL', NULL, 1, 124, 2, 0, '2015-02-10 00:57:55', '2015-03-10 02:09:35', '0000-00-00 00:00:00'),
(20, 'Quechua', 'Kichwa', 'QU', NULL, 1, 124, 0, 0, '2015-02-10 00:58:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Russian', 'русский', 'RU', NULL, 1, 124, 2, 0, '2015-02-10 00:58:30', '2019-02-10 10:36:51', '0000-00-00 00:00:00'),
(22, 'Spanish', 'espaÃ±ol', 'ES', NULL, 1, 124, 2, 0, '2015-02-10 00:58:42', '2015-03-10 00:04:04', '0000-00-00 00:00:00'),
(23, 'Thai', 'ไทย', 'TH', NULL, 1, 124, 2, 0, '2015-02-10 00:58:59', '2019-02-10 10:36:12', '0000-00-00 00:00:00'),
(24, 'Ukrainian', 'Українська', 'UK', NULL, 1, 124, 2, 0, '2015-02-10 00:59:14', '2019-02-10 10:35:32', '0000-00-00 00:00:00'),
(25, 'Vietnamese', 'Tiếng Việt', 'VI', NULL, 1, 124, 2, 0, '2015-02-10 00:59:28', '2019-02-10 10:40:15', '0000-00-00 00:00:00'),
(26, 'Welsh', 'Cymraeg', 'CY', NULL, 1, 124, 0, 0, '2015-02-10 00:59:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Xhosa', 'isiXhosa', 'XH', NULL, 1, 124, 0, 0, '2015-02-10 00:59:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Yoruba', 'YorÃ¹bÃ¡', 'YO', NULL, 1, 124, 2, 0, '2015-02-10 01:00:14', '2015-03-10 00:06:20', '0000-00-00 00:00:00'),
(29, 'Zhuang', 'VaÆ…cueÅ‹Æ…', 'ZA', NULL, 1, 124, 2, 0, '2015-02-10 01:00:28', '2015-03-10 02:11:59', '0000-00-00 00:00:00'),
(30, 'Mongiliea', 'Mongli', 'MG', NULL, 1, 294, 0, 0, '2015-02-12 16:23:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Belarusian', 'беларускі', 'BE', NULL, 1, 2, 2, 0, '2015-03-04 02:54:42', '2019-02-10 10:34:00', '0000-00-00 00:00:00'),
(32, 'Pashto', 'Ù¾ÚšØªÙˆ', 'PS', NULL, 1, 2, 2, 0, '2015-03-04 02:59:07', '2015-03-10 02:09:07', '0000-00-00 00:00:00'),
(33, 'Dutch', 'Nederlands', 'NL', NULL, 1, 2, 0, 0, '2015-03-09 05:55:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sphp_measure`
--

CREATE TABLE `sphp_measure` (
  `MeasureID` int(11) NOT NULL,
  `MeasureName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MeasureCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MeasureSymbol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MeasureTypeID` int(11) DEFAULT NULL,
  `MeasureIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_measure`
--

INSERT INTO `sphp_measure` (`MeasureID`, `MeasureName`, `MeasureCode`, `MeasureSymbol`, `MeasureTypeID`, `MeasureIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Nos', 'Nos', 'x', 1, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:19:10', NULL),
(2, 'Pc', 'Pc', 'x', 1, 1, NULL, NULL, NULL, '2019-02-03 14:06:16', '2019-02-03 14:06:16', NULL),
(3, 'Gram', 'G', 'G', 3, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:18:23', NULL),
(4, 'Kilogram', 'Kg', 'Kg', 3, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:18:46', NULL),
(5, 'Celcius', 'C', '°', 5, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:18:04', NULL),
(6, 'Farenhite', 'F', '°', 5, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:18:16', NULL),
(7, 'Inch', 'In', 'In', 2, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:18:36', NULL),
(8, 'Meter', 'M', 'M', 2, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:18:53', NULL),
(9, 'Centimeter', 'Cm', 'Cm', 2, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:18:10', NULL),
(10, 'Mililitre', 'ml', 'ml', 4, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:19:01', NULL),
(11, 'Piece', 's', 's', 1, 1, NULL, 2, NULL, '2019-02-03 14:06:16', '2019-02-05 09:19:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_measuretype`
--

CREATE TABLE `sphp_measuretype` (
  `MeasureTypeID` int(11) NOT NULL,
  `MeasureTypeName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MeasureTypeIdentifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MeasureTypeIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_measuretype`
--

INSERT INTO `sphp_measuretype` (`MeasureTypeID`, `MeasureTypeName`, `MeasureTypeIdentifier`, `MeasureTypeIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Count', 'COUNT', 1, NULL, NULL, NULL, '2019-02-03 14:06:16', '2019-02-03 14:06:16', NULL),
(2, 'Length', 'LENGTH', 1, NULL, NULL, NULL, '2019-02-03 14:06:16', '2019-02-03 14:06:16', NULL),
(3, 'Weight', 'WEIGHT', 1, NULL, NULL, NULL, '2019-02-03 14:06:16', '2019-02-03 14:06:16', NULL),
(4, 'Volume', 'VOLUME', 1, NULL, NULL, NULL, '2019-02-03 14:06:16', '2019-02-03 14:06:16', NULL),
(5, 'Temperature', 'TEMPERATURE', 1, NULL, NULL, NULL, '2019-02-03 14:06:16', '2019-02-03 14:06:16', NULL),
(6, 'Force', 'FORCE', 1, NULL, NULL, NULL, '2019-02-03 14:06:16', '2019-02-03 14:06:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_notification`
--

CREATE TABLE `sphp_notification` (
  `NotificationID` int(11) NOT NULL,
  `NotificationSignature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NotificationEventTime` datetime NOT NULL,
  `NotificationSubject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `NotificationMessage` text COLLATE utf8_unicode_ci NOT NULL,
  `NotificationTypeID` int(11) DEFAULT NULL,
  `NotificationSourceID` int(11) DEFAULT NULL,
  `NotificationTo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NotificationFrom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserIDFrom` int(11) DEFAULT NULL,
  `UserIDTo` int(11) DEFAULT NULL,
  `NotificationAttemptTime` datetime DEFAULT NULL,
  `NotificationAttempt` int(11) NOT NULL DEFAULT 0,
  `NotificationSentTime` datetime DEFAULT NULL,
  `NotificationIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sphp_notificationsource`
--

CREATE TABLE `sphp_notificationsource` (
  `NotificationSourceID` int(11) NOT NULL,
  `NotificationSourceName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NotificationSourceIdentifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NotificationSourceIsActive` tinyint(11) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_notificationsource`
--

INSERT INTO `sphp_notificationsource` (`NotificationSourceID`, `NotificationSourceName`, `NotificationSourceIdentifier`, `NotificationSourceIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'System', 'SYSTEM', 1, NULL, NULL, NULL, '2019-09-05 07:46:05', NULL, NULL),
(2, 'Manual', 'MANUAL', 1, NULL, NULL, NULL, '2019-09-05 07:46:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_notificationtype`
--

CREATE TABLE `sphp_notificationtype` (
  `NotificationTypeID` int(11) NOT NULL,
  `NotificationTypeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NotificationTypeIdentifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NotificationTypeIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_notificationtype`
--

INSERT INTO `sphp_notificationtype` (`NotificationTypeID`, `NotificationTypeName`, `NotificationTypeIdentifier`, `NotificationTypeIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Mobile SMS', 'MOBILE_SMS', 1, NULL, NULL, NULL, '2019-09-03 12:08:55', NULL, NULL),
(2, 'Email', 'EMAIL', 1, NULL, NULL, NULL, '2019-09-03 12:08:55', NULL, NULL),
(3, 'Push', 'PUSH', 1, NULL, NULL, NULL, '2020-09-22 19:18:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_system_content`
--

CREATE TABLE `sphp_system_content` (
  `SystemContentID` int(11) NOT NULL,
  `SystemContentName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentIdentifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentIsActive` tinyint(1) DEFAULT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sphp_system_contentitem`
--

CREATE TABLE `sphp_system_contentitem` (
  `SystemContentItemID` int(11) NOT NULL,
  `SystemContentItemName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentItemCaption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentItemIcon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentItemPicture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentItemBanner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentItemFile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentItemApplicationURL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SystemContentID` int(11) DEFAULT NULL,
  `SystemContentItemIsActive` tinyint(1) DEFAULT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sphp_system_contentitemusergroup`
--

CREATE TABLE `sphp_system_contentitemusergroup` (
  `SystemContentItemUserGroupID` int(11) NOT NULL,
  `SystemContentItemID` int(11) DEFAULT NULL,
  `UserGroupID` int(11) DEFAULT NULL,
  `SystemContentItemUserGroupIsActive` tinyint(1) DEFAULT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sphp_user`
--

CREATE TABLE `sphp_user` (
  `UserID` int(11) NOT NULL,
  `UserSignInName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserEmail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPasswordHash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserNameFirst` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserNameMiddle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserNameLast` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserBirthDate` date DEFAULT NULL,
  `UserDeathDate` date DEFAULT NULL,
  `GenderID` int(11) DEFAULT NULL,
  `UserPhoneMobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPhoneHome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPhoneWork` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPhoneOther` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserURL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPicture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPictureThumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserAddressStreet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserAddressPoliceStation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserAddressCity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserAddressZIP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserAddressState` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserAddressCountryID` int(11) DEFAULT NULL,
  `LanguageID` int(11) DEFAULT NULL,
  `UserSignUpTime` datetime DEFAULT NULL,
  `UserSignUpActivationKey` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserSignUpIsActivated` tinyint(1) NOT NULL,
  `UserPasswordResetKey` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPasswordResetAttemptTime` datetime DEFAULT NULL,
  `UserPasswordResetAttemptCount` int(11) DEFAULT NULL,
  `UserIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_user`
--

INSERT INTO `sphp_user` (`UserID`, `UserSignInName`, `UserEmail`, `UserPasswordHash`, `UserNameFirst`, `UserNameMiddle`, `UserNameLast`, `UserBirthDate`, `UserDeathDate`, `GenderID`, `UserPhoneMobile`, `UserPhoneHome`, `UserPhoneWork`, `UserPhoneOther`, `UserURL`, `UserPicture`, `UserPictureThumbnail`, `UserAddressStreet`, `UserAddressPoliceStation`, `UserAddressCity`, `UserAddressZIP`, `UserAddressState`, `UserAddressCountryID`, `LanguageID`, `UserSignUpTime`, `UserSignUpActivationKey`, `UserSignUpIsActivated`, `UserPasswordResetKey`, `UserPasswordResetAttemptTime`, `UserPasswordResetAttemptCount`, `UserIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Guest', 'Guest@System.Dom', NULL, 'Guest', NULL, 'Visitor', '0000-00-00', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-02-03 14:06:14', '2019-02-03 14:06:14', NULL),
(2, 'Administrator', 'Administrator@System.Dom', '5f4dcc3b5aa765d61d8327deb882cf99', 'System', NULL, 'Administrator', '2019-01-31', NULL, 3, '+00000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, 2, NULL, '2019-02-03 14:06:14', '2021-01-13 11:06:57', NULL),
(3, 'Member', 'Member@System.Dom', '5f4dcc3b5aa765d61d8327deb882cf99', 'General', NULL, 'User', '0000-00-00', NULL, 3, '+0000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, 2, NULL, '2019-02-03 14:06:14', '2019-02-10 08:55:35', NULL),
(24, 'Shahriar', 'Shahriar@SingularityBD.Com', '8dd43ae0638e1ce2690e2e3cfa653923', 'Shahriar', NULL, 'Kabir', '1978-07-19', NULL, 2, '+8801847464939', NULL, NULL, NULL, NULL, NULL, NULL, 'L#5, H#147, R#1, Baridhara DOHS', NULL, 'Dhaka', NULL, NULL, 1, 1, NULL, NULL, 0, NULL, NULL, NULL, 1, 2, 2, NULL, '2019-07-23 00:27:57', '2021-02-10 13:01:14', NULL),
(898, 'anup', 'anup@bondstein.com', 'bda3083124482f58ea35b182d658db99', 'Anup', NULL, 'Mondal', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 0, NULL, NULL, NULL, 1, 21, 2, NULL, '2020-10-27 16:57:56', '2021-02-11 12:22:55', NULL),
(899, 'rajib', 'rajib@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Rajib', NULL, 'Tarafder', NULL, NULL, 2, '05885255', NULL, '555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 109, 1, NULL, NULL, 0, NULL, NULL, NULL, 1, 2, 2, NULL, '2021-02-10 13:05:24', '2021-02-11 10:42:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_userdevice`
--

CREATE TABLE `sphp_userdevice` (
  `UserDeviceID` int(11) NOT NULL,
  `UserDeviceIdentifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserDeviceUserAgent` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserDeviceIP` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserDeviceCountry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserDeviceCity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserDeviceLatitude` float(13,9) DEFAULT NULL,
  `UserDeviceLongitude` float(13,9) DEFAULT NULL,
  `UserDeviceIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_userdevice`
--

INSERT INTO `sphp_userdevice` (`UserDeviceID`, `UserDeviceIdentifier`, `UserDeviceUserAgent`, `UserDeviceIP`, `UserDeviceCountry`, `UserDeviceCity`, `UserDeviceLatitude`, `UserDeviceLongitude`, `UserDeviceIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'ae372a61c5c72cfeb0d832a33924ae21-bca09089869a0310bf1d23d65cebb8d4-f966a21085a2e12b815620a177298d01-f0z43h00wk34nxz9jjfcby68f4ecorz1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:82.0) Gecko/20100101 Firefox/82.0', '127.0.0.1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-15 14:32:25', NULL, NULL),
(2, 'd0f7d9822d2310f204d922bc95899247-1f552c5f2a0bbbbd9ff6a1c3bfdd5ef9-77c17cfe67dc99fb9abdb2929b8a480f-ck494tktojwo6l5g7utis6lf6wqs1xs1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '::1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-15 15:07:48', NULL, NULL),
(3, '2c84f8a642c4b770348c2aa295320925-bca09089869a0310bf1d23d65cebb8d4-0c0dd7d643c411575ebd99c708e5f1b7-g83egatavodd4yidmkk0mtj85vqyl6jr', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:82.0) Gecko/20100101 Firefox/82.0', '127.0.0.1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-15 15:09:21', NULL, NULL),
(4, '35e4ccdf94af0f9ae3425f23e285dce8-bca09089869a0310bf1d23d65cebb8d4-f663467ef2a93f68324c2996ce525285-8z0eb63l60y5mrjy39rlz2sxpawru0l9', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:82.0) Gecko/20100101 Firefox/82.0', '127.0.0.1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-15 15:42:49', NULL, NULL),
(5, '53c615fa63c0af00afdf09280eba102d-8d3fec2581d3961f3037851d5cc0039c-fto7id1651foclts5ggukf8ave-4b9lwd2d291sjc7ctdmospazkfkyo91w', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '::1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-16 15:09:55', NULL, NULL),
(6, '29a7f1faef252e55bd85fba574032ea7-8d3fec2581d3961f3037851d5cc0039c-9rd4v73ss99ua1iq1f45r8tqfs-al47b0ppfxabest7td2j4r8wajz5hetj', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '::1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-17 14:49:45', NULL, NULL),
(7, '814394dd5e290329a5a8578e99979a7c-8d3fec2581d3961f3037851d5cc0039c-op793fkr64reba1hdo0r6t44kf-0fwqkg6fyfl7ouqok54j2pof0ifhmeal', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '::1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-17 17:05:05', NULL, NULL),
(8, 'b9abf6a39916a09fd36afbac04b0d4d7-8d3fec2581d3961f3037851d5cc0039c-0iaiva1l27b9jfhmta8cd1j2pj-3shxgqh8tkajs1p851fm8qxkzo8hhx7b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '::1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-23 14:33:33', NULL, NULL),
(9, 'f0f82ea7d47027d9b0b778bb357b6e46-8d3fec2581d3961f3037851d5cc0039c-mqe828mmeh3gdcgas55k56pqq8-rovj9itcef2qkqnij6h36aat0hlq46ts', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '::1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-23 16:25:08', NULL, NULL),
(10, 'f0291c76cd4b7e448ed2bc1b9b166406-57c2b4c157dca444b0d506e0ab9928a2-2umfaq4ns1oglsduv2v5d97qsm-c1kidkgf49k91zpbooagqs47e1g6ts2j', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0', '::1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-25 10:55:04', NULL, NULL),
(11, '700a488e42f0162a7ac44b086984c4d2-57c2b4c157dca444b0d506e0ab9928a2-0v12nesju40vqqnsmvm62qjf8b-b6dr4ygp27sd3p79nq1vrmec2ns9qqqi', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0', '::1', '', '', NULL, NULL, 1, 0, NULL, NULL, '2020-11-26 13:18:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_usergroup`
--

CREATE TABLE `sphp_usergroup` (
  `UserGroupID` int(11) NOT NULL,
  `UserGroupName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserGroupIdentifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserGroupWeight` float(11,3) NOT NULL,
  `UserGroupIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_usergroup`
--

INSERT INTO `sphp_usergroup` (`UserGroupID`, `UserGroupName`, `UserGroupIdentifier`, `UserGroupWeight`, `UserGroupIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 'Guest', 'GUEST', 10.000, 1, NULL, NULL, NULL, '2019-02-03 14:06:14', '2019-02-03 14:06:14', NULL),
(2, 'Administrator', 'ADMINISTRATOR', 100.000, 1, NULL, 24, NULL, '2019-02-03 14:06:14', '2019-09-30 01:59:01', NULL),
(3, 'Member', 'MEMBER', 50.000, 1, NULL, 24, NULL, '2019-02-03 14:06:14', '2019-09-30 01:59:08', NULL),
(5, 'Customer', 'CUSTOMER', 65.000, 1, 24, NULL, NULL, '2019-09-30 01:59:28', NULL, NULL),
(8, 'Developer', 'DEVELOPER', 95.000, 1, 24, NULL, NULL, '2020-06-16 21:40:17', NULL, NULL),
(11, 'Manager', 'MANAGER', 85.000, 1, 2, NULL, NULL, '2021-02-11 10:41:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_useruserdevice`
--

CREATE TABLE `sphp_useruserdevice` (
  `UserUserDeviceID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `UserDeviceID` int(11) NOT NULL,
  `UserUserDeviceTimeActiveLast` datetime DEFAULT NULL,
  `UserUserDeviceIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_useruserdevice`
--

INSERT INTO `sphp_useruserdevice` (`UserUserDeviceID`, `UserID`, `UserDeviceID`, `UserUserDeviceTimeActiveLast`, `UserUserDeviceIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 0, 1, '2020-11-15 14:40:08', 1, 0, NULL, NULL, '2020-11-15 14:40:08', NULL, NULL),
(2, 0, 5, '2020-11-23 13:15:16', 1, 0, NULL, NULL, '2020-11-16 15:41:42', NULL, NULL),
(4, 2, 5, '2020-11-16 16:54:14', 1, 2, NULL, NULL, '2020-11-16 16:54:14', NULL, NULL),
(12, 0, 8, '2020-11-23 16:20:59', 1, 0, NULL, NULL, '2020-11-23 16:20:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sphp_useruserdevicenotification`
--

CREATE TABLE `sphp_useruserdevicenotification` (
  `UserUserDeviceNotificationID` int(11) NOT NULL,
  `UserUserDeviceID` int(11) NOT NULL,
  `NotificationID` int(11) NOT NULL,
  `UserUserDeviceNotificationIsRead` tinyint(1) NOT NULL DEFAULT 0,
  `UserUserDeviceNotificationIsActive` tinyint(1) NOT NULL DEFAULT 0,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sphp_userusergroup`
--

CREATE TABLE `sphp_userusergroup` (
  `UserUserGroupID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `UserGroupID` int(11) DEFAULT NULL,
  `UserUserGroupIsActive` tinyint(1) NOT NULL,
  `UserIDInserted` int(11) DEFAULT NULL,
  `UserIDUpdated` int(11) DEFAULT NULL,
  `UserIDLocked` int(11) DEFAULT NULL,
  `TimeInserted` datetime DEFAULT NULL,
  `TimeUpdated` datetime DEFAULT NULL,
  `TimeLocked` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sphp_userusergroup`
--

INSERT INTO `sphp_userusergroup` (`UserUserGroupID`, `UserID`, `UserGroupID`, `UserUserGroupIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `TimeInserted`, `TimeUpdated`, `TimeLocked`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, '2019-02-11 10:57:35', NULL, NULL),
(2, 2, 2, 1, 24, NULL, NULL, '2019-10-23 18:51:03', NULL, NULL),
(3, 3, 3, 1, 2, NULL, NULL, '2019-02-10 08:55:35', NULL, NULL),
(4, 14, 5, 1, 2, NULL, NULL, '2021-01-24 12:36:55', NULL, NULL),
(5, 13, 11, 1, 2, NULL, NULL, '2021-01-25 14:10:24', NULL, NULL),
(6, 13, 5, 1, 2, NULL, NULL, '2021-01-25 14:10:24', NULL, NULL),
(7, 987, 5, 1, 2, NULL, NULL, '2021-01-25 14:32:29', NULL, NULL),
(8, 8, 2, 1, 2, NULL, NULL, '2021-01-25 14:33:57', NULL, NULL),
(10, 899, 11, 1, 2, NULL, NULL, '2021-02-11 10:42:11', NULL, NULL),
(11, 898, 2, 1, 2, NULL, NULL, '2021-02-11 12:22:55', NULL, NULL),
(12, 898, 8, 1, 2, NULL, NULL, '2021-02-11 12:22:55', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ims_loan`
--
ALTER TABLE `ims_loan`
  ADD PRIMARY KEY (`LoanID`),
  ADD KEY `CustomerID` (`UserID`),
  ADD KEY `LoanSchemeID` (`LoanSchemeID`),
  ADD KEY `LoanDate` (`LoanDate`),
  ADD KEY `LoanIsActive` (`LoanIsActive`),
  ADD KEY `LoanID_2` (`LoanID`);

--
-- Indexes for table `ims_loanscheme`
--
ALTER TABLE `ims_loanscheme`
  ADD PRIMARY KEY (`LoanSchemeID`),
  ADD KEY `LoanSchemeName` (`LoanSchemeName`),
  ADD KEY `LoanSchemeDay` (`LoanSchemeDay`),
  ADD KEY `LoanSchemeAmount` (`LoanSchemeAmount`),
  ADD KEY `LoanSchemePayPerInstallment` (`LoanSchemePayPerInstallment`),
  ADD KEY `LoanSchemeTotalInstallment` (`LoanSchemeTotalInstallment`),
  ADD KEY `LoanSchemePayableAmount` (`LoanSchemePayableAmount`);

--
-- Indexes for table `ims_loantransaction`
--
ALTER TABLE `ims_loantransaction`
  ADD PRIMARY KEY (`LoanTransactionID`),
  ADD KEY `LoanTransactionPayableDate` (`LoanTransactionPayableDate`),
  ADD KEY `LoanID` (`LoanID`),
  ADD KEY `LoanTransactionPaidDate` (`LoanTransactionPaidDate`),
  ADD KEY `LoanTransactionIsPaid` (`LoanTransactionIsPaid`);

--
-- Indexes for table `sphp_applicationchangelog`
--
ALTER TABLE `sphp_applicationchangelog`
  ADD PRIMARY KEY (`ApplicationChangeLogID`);

--
-- Indexes for table `sphp_applicationtraffic`
--
ALTER TABLE `sphp_applicationtraffic`
  ADD PRIMARY KEY (`ApplicationTrafficID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `sphp_country`
--
ALTER TABLE `sphp_country`
  ADD PRIMARY KEY (`CountryID`),
  ADD UNIQUE KEY `CountryName` (`CountryName`),
  ADD UNIQUE KEY `CountryISOCode` (`CountryISOCode`),
  ADD KEY `CountryIsActive` (`CountryIsActive`),
  ADD KEY `CountryCode` (`CountryCode`),
  ADD KEY `LanguageID` (`LanguageID`),
  ADD KEY `CurrencyID` (`CurrencyID`);

--
-- Indexes for table `sphp_countrystate`
--
ALTER TABLE `sphp_countrystate`
  ADD PRIMARY KEY (`CountryStateID`),
  ADD UNIQUE KEY `UniqueData` (`CountryID`,`StateName`),
  ADD KEY `CountryID` (`CountryID`),
  ADD KEY `StateName` (`StateName`),
  ADD KEY `CountryStateIsActive` (`CountryStateIsActive`);

--
-- Indexes for table `sphp_currency`
--
ALTER TABLE `sphp_currency`
  ADD PRIMARY KEY (`CurrencyID`),
  ADD UNIQUE KEY `CurrencyName` (`CurrencyName`);

--
-- Indexes for table `sphp_datatype`
--
ALTER TABLE `sphp_datatype`
  ADD PRIMARY KEY (`DataTypeID`),
  ADD UNIQUE KEY `DataTypeName` (`DataTypeName`),
  ADD UNIQUE KEY `DataTypeIdentifier` (`DataTypeIdentifier`);

--
-- Indexes for table `sphp_gender`
--
ALTER TABLE `sphp_gender`
  ADD PRIMARY KEY (`GenderID`),
  ADD UNIQUE KEY `GenderName` (`GenderName`);

--
-- Indexes for table `sphp_language`
--
ALTER TABLE `sphp_language`
  ADD PRIMARY KEY (`LanguageID`),
  ADD UNIQUE KEY `LanguageName` (`LanguageName`),
  ADD UNIQUE KEY `LanguageNameInNativeLanguage` (`LanguageNameNative`),
  ADD KEY `LanguageIsActive` (`LanguageIsActive`);

--
-- Indexes for table `sphp_measure`
--
ALTER TABLE `sphp_measure`
  ADD PRIMARY KEY (`MeasureID`),
  ADD KEY `MeasureTypeID` (`MeasureTypeID`);

--
-- Indexes for table `sphp_measuretype`
--
ALTER TABLE `sphp_measuretype`
  ADD PRIMARY KEY (`MeasureTypeID`),
  ADD UNIQUE KEY `MeasureTypeName` (`MeasureTypeName`),
  ADD UNIQUE KEY `MeasureTypeIdentifier` (`MeasureTypeIdentifier`);

--
-- Indexes for table `sphp_notification`
--
ALTER TABLE `sphp_notification`
  ADD PRIMARY KEY (`NotificationID`),
  ADD UNIQUE KEY `UniqueNotification` (`NotificationEventTime`,`NotificationSubject`,`NotificationSignature`,`NotificationTypeID`,`NotificationTo`) USING BTREE,
  ADD KEY `NotificationEventTime` (`NotificationEventTime`),
  ADD KEY `NotificationSentTime` (`NotificationSentTime`),
  ADD KEY `NotificationAttempt` (`NotificationAttempt`),
  ADD KEY `NotificationSourceID` (`NotificationSourceID`),
  ADD KEY `NotificationTypeID` (`NotificationTypeID`),
  ADD KEY `NotificationIsActive` (`NotificationIsActive`) USING BTREE,
  ADD KEY `UserIDFrom` (`UserIDFrom`),
  ADD KEY `UserIDTo` (`UserIDTo`),
  ADD KEY `TimeInserted` (`TimeInserted`);

--
-- Indexes for table `sphp_notificationsource`
--
ALTER TABLE `sphp_notificationsource`
  ADD PRIMARY KEY (`NotificationSourceID`),
  ADD UNIQUE KEY `NotificationSourceName` (`NotificationSourceName`),
  ADD UNIQUE KEY `NotificationSourceIdentifier` (`NotificationSourceIdentifier`),
  ADD KEY `NotificationSourceIsActive` (`NotificationSourceIsActive`);

--
-- Indexes for table `sphp_notificationtype`
--
ALTER TABLE `sphp_notificationtype`
  ADD PRIMARY KEY (`NotificationTypeID`),
  ADD UNIQUE KEY `NotificationTypeName` (`NotificationTypeName`),
  ADD UNIQUE KEY `NotificationTypeIdentifier` (`NotificationTypeIdentifier`);

--
-- Indexes for table `sphp_system_content`
--
ALTER TABLE `sphp_system_content`
  ADD PRIMARY KEY (`SystemContentID`),
  ADD UNIQUE KEY `SystemContentName` (`SystemContentName`),
  ADD UNIQUE KEY `SystemContentIdentifier` (`SystemContentIdentifier`);

--
-- Indexes for table `sphp_system_contentitem`
--
ALTER TABLE `sphp_system_contentitem`
  ADD PRIMARY KEY (`SystemContentItemID`),
  ADD UNIQUE KEY `SystemContentItemName` (`SystemContentItemName`),
  ADD UNIQUE KEY `SystemContentItemCaption` (`SystemContentItemCaption`),
  ADD UNIQUE KEY `SystemContentItemApplicationURL` (`SystemContentItemApplicationURL`),
  ADD KEY `SystemContentID` (`SystemContentID`);

--
-- Indexes for table `sphp_system_contentitemusergroup`
--
ALTER TABLE `sphp_system_contentitemusergroup`
  ADD PRIMARY KEY (`SystemContentItemUserGroupID`),
  ADD KEY `SystemContentItemID` (`SystemContentItemID`),
  ADD KEY `UserGroupID` (`UserGroupID`);

--
-- Indexes for table `sphp_user`
--
ALTER TABLE `sphp_user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserSignInName`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`),
  ADD KEY `GenderID` (`GenderID`),
  ADD KEY `UserAddressCountryID` (`UserAddressCountryID`),
  ADD KEY `LanguageID` (`LanguageID`);

--
-- Indexes for table `sphp_userdevice`
--
ALTER TABLE `sphp_userdevice`
  ADD PRIMARY KEY (`UserDeviceID`),
  ADD UNIQUE KEY `UserDeviceIdentifier` (`UserDeviceIdentifier`),
  ADD KEY `UserDeviceIsActive` (`UserDeviceIsActive`),
  ADD KEY `TimeInserted` (`TimeInserted`);

--
-- Indexes for table `sphp_usergroup`
--
ALTER TABLE `sphp_usergroup`
  ADD PRIMARY KEY (`UserGroupID`),
  ADD UNIQUE KEY `UserGroupName` (`UserGroupName`),
  ADD UNIQUE KEY `UserGroupIdentifier` (`UserGroupIdentifier`);

--
-- Indexes for table `sphp_useruserdevice`
--
ALTER TABLE `sphp_useruserdevice`
  ADD PRIMARY KEY (`UserUserDeviceID`),
  ADD UNIQUE KEY `UniqueData` (`UserID`,`UserDeviceID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `UserDeviceID` (`UserDeviceID`),
  ADD KEY `UserUserDeviceIsActive` (`UserUserDeviceIsActive`),
  ADD KEY `UserUserDeviceTimeActiveLast` (`UserUserDeviceTimeActiveLast`);

--
-- Indexes for table `sphp_useruserdevicenotification`
--
ALTER TABLE `sphp_useruserdevicenotification`
  ADD PRIMARY KEY (`UserUserDeviceNotificationID`),
  ADD UNIQUE KEY `UniqueData` (`UserUserDeviceID`,`NotificationID`),
  ADD KEY `UserUserDeviceID` (`UserUserDeviceID`),
  ADD KEY `NotificationID` (`NotificationID`),
  ADD KEY `UserUserDeviceNotificationIsRead` (`UserUserDeviceNotificationIsRead`),
  ADD KEY `UserUserDeviceNotificationIsActive` (`UserUserDeviceNotificationIsActive`),
  ADD KEY `TimeInserted` (`TimeInserted`);

--
-- Indexes for table `sphp_userusergroup`
--
ALTER TABLE `sphp_userusergroup`
  ADD PRIMARY KEY (`UserUserGroupID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `UserGroupID` (`UserGroupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ims_loan`
--
ALTER TABLE `ims_loan`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ims_loanscheme`
--
ALTER TABLE `ims_loanscheme`
  MODIFY `LoanSchemeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ims_loantransaction`
--
ALTER TABLE `ims_loantransaction`
  MODIFY `LoanTransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `sphp_applicationchangelog`
--
ALTER TABLE `sphp_applicationchangelog`
  MODIFY `ApplicationChangeLogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sphp_applicationtraffic`
--
ALTER TABLE `sphp_applicationtraffic`
  MODIFY `ApplicationTrafficID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sphp_country`
--
ALTER TABLE `sphp_country`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `sphp_countrystate`
--
ALTER TABLE `sphp_countrystate`
  MODIFY `CountryStateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `sphp_currency`
--
ALTER TABLE `sphp_currency`
  MODIFY `CurrencyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sphp_datatype`
--
ALTER TABLE `sphp_datatype`
  MODIFY `DataTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sphp_gender`
--
ALTER TABLE `sphp_gender`
  MODIFY `GenderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sphp_language`
--
ALTER TABLE `sphp_language`
  MODIFY `LanguageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sphp_measure`
--
ALTER TABLE `sphp_measure`
  MODIFY `MeasureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sphp_measuretype`
--
ALTER TABLE `sphp_measuretype`
  MODIFY `MeasureTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sphp_notification`
--
ALTER TABLE `sphp_notification`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sphp_notificationsource`
--
ALTER TABLE `sphp_notificationsource`
  MODIFY `NotificationSourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sphp_notificationtype`
--
ALTER TABLE `sphp_notificationtype`
  MODIFY `NotificationTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sphp_system_content`
--
ALTER TABLE `sphp_system_content`
  MODIFY `SystemContentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sphp_system_contentitem`
--
ALTER TABLE `sphp_system_contentitem`
  MODIFY `SystemContentItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sphp_system_contentitemusergroup`
--
ALTER TABLE `sphp_system_contentitemusergroup`
  MODIFY `SystemContentItemUserGroupID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sphp_user`
--
ALTER TABLE `sphp_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=900;

--
-- AUTO_INCREMENT for table `sphp_userdevice`
--
ALTER TABLE `sphp_userdevice`
  MODIFY `UserDeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sphp_usergroup`
--
ALTER TABLE `sphp_usergroup`
  MODIFY `UserGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sphp_useruserdevice`
--
ALTER TABLE `sphp_useruserdevice`
  MODIFY `UserUserDeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sphp_useruserdevicenotification`
--
ALTER TABLE `sphp_useruserdevicenotification`
  MODIFY `UserUserDeviceNotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sphp_userusergroup`
--
ALTER TABLE `sphp_userusergroup`
  MODIFY `UserUserGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
