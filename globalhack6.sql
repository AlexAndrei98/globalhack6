-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2016 at 04:23 AM
-- Server version: 5.5.52-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `globalhack6`
--

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `driverid` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mobilenum` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `ridescompleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`driverid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driverid`, `name`, `mobilenum`, `lat`, `lon`, `available`, `ridescompleted`) VALUES
(1, 'Kyu Cho', '6187793770', 0, 0, 1, 0),
(2, 'Andy Mulchek', '3146624356', 0, 0, 0, 0),
(3, 'Andy Fulton', '5732476610', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE IF NOT EXISTS `facilities` (
  `facilityid` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `address` varchar(150) COLLATE utf8_bin NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `male` tinyint(1) NOT NULL,
  `female` tinyint(1) NOT NULL,
  `youth` tinyint(1) NOT NULL,
  `family` tinyint(1) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT '0',
  `available` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`facilityid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`facilityid`, `name`, `address`, `lat`, `lon`, `male`, `female`, `youth`, `family`, `capacity`, `available`) VALUES
(1, 'Gateway 180', '1000 19th Street, Saint Louis, MO 63106', 38.6376, -90.2014, 1, 1, 1, 1, 171, 112),
(2, 'Karen House Catholic Worker', '1840 Hogan Street, Saint Louis, MO 63106', 38.6466, -90.1998, 1, 1, 1, 1, 13, 11),
(3, 'Peter and Paul Community Services', '2612 Wyoming Street, Saint Louis, MO 63118', 38.6072, -90.2035, 1, 0, 0, 0, 60, 7),
(4, 'Horizon Club', '202 N 23rd Street, Saint Louis, MO 63103', 38.6322, -90.2123, 1, 1, 1, 0, 56, 32),
(5, 'The Bridge Outreach', '1610 Olive Street, Saint Louis MO 63103', 38.6305, -90.2037, 1, 1, 1, 1, 76, 7),
(6, 'Covenant House', '2727 North Kingshighway Boulevard, Saint Louis, MO 63113', 38.6698, -90.2571, 1, 1, 1, 0, 34, 18),
(7, 'Haven of Grace', '1225 Warren Street, Saint Louis, MO 63106', 38.6505, -90.1949, 0, 1, 1, 1, 87, 78),
(8, 'Kathy Weinman', '41 South Central, Clayton, MO 63105', 38.7039, -90.3057, 0, 1, 1, 1, 56, 36),
(9, 'Loaves and Fishes', '2750 McKelvey Road, Maryland Heights, MO 63043', 38.7333, -90.4457, 0, 0, 0, 1, 29, 6),
(10, 'Lydia''s House', '3500 Giles Avenue, Saint Louis, MO 63116', 38.5937, -90.2461, 0, 1, 1, 1, 56, 52),
(11, 'Missionaries of Charity', '3629 Cottage Avenue, Saint Louis MO, 63113', 38.6531, -90.2239, 0, 1, 1, 1, 45, 14),
(12, 'New Life Evangelistic Center', '1411 Locust Street, Saint Louis, MO 63103', 38.6317, -90.2006, 1, 1, 1, 1, 34, 19),
(13, 'Opal''s House', '1626 Cleveland Avenue, East Saint Louis 62205', 38.6057, -90.1167, 1, 1, 1, 1, 90, 84),
(14, 'Our Ladies Inn', '4223 S Compton Avenue, Saint Louis, MO 63111', 38.5799, -90.2043, 0, 1, 0, 1, 18, 2),
(15, 'Salvation Army Family Haven', '10740 Page Avenue, Saint Louis, MO 63132', 38.692, -90.3987, 1, 1, 1, 1, 64, 22),
(16, 'St. Patrick Center', '800 N Tucker Boulevard, Saint Louis, MO 63101', 38.6334, -90.1956, 1, 1, 1, 1, 20, 4),
(17, 'Biddle House  Opportunities Center', '1212 N 13th Street, Saint Louis, MO 63106', 38.6377, -90.1949, 1, 0, 0, 0, 16, 4),
(18, 'Stepping into the Light Ministrry', '1402 Herbert Street, Saint Louis, MO 63107', 38.6539, -90.1978, 1, 0, 0, 0, 20, 2),
(19, 'Sunshine Mission', '1315 Howard Street, Saint Louis, MO 63106', 38.6435, -90.1952, 1, 0, 0, 0, 10, 3),
(20, 'Family Living Center', '510 N 25th Street, East Saint Louis, IL 62205', 38.613, -90.1287, 0, 0, 0, 1, 24, 0),
(21, 'Catholic Urban Programs', '7 Vieux Carre Drive, East Saint Louis, IL 62203', 38.595, -90.0558, 1, 1, 1, 1, 10, 1),
(22, 'The Good Samaritan Hours of Granite City', '1825 Delmar Avenue, Granite City , IL 62040', 38.7005, -90.1522, 0, 1, 1, 1, 30, 6),
(23, 'Salvation Army Booth House', '114 East 5th , Alton IL 62002', 38.893, -90.1839, 1, 1, 1, 1, 40, 11),
(24, 'Jefferson County Rescue Mission', '8943 Commercial Boulevard, Pevely MO 63070', 38.2812, -90.3904, 1, 1, 1, 1, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `requestid` int(11) NOT NULL AUTO_INCREMENT,
  `receivedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sitecode` varchar(10) COLLATE utf8_bin NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `pickuptime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `closedtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sourcenum` varchar(20) COLLATE utf8_bin NOT NULL,
  `destnum` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`requestid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=34 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`requestid`, `receivedtime`, `sitecode`, `status`, `pickuptime`, `closedtime`, `sourcenum`, `destnum`) VALUES
(1, '2016-10-23 05:53:12', '255', 5, '0000-00-00 00:00:00', '2016-10-23 08:35:47', '16187793770', '16184778675'),
(2, '2016-10-23 05:53:59', '255', 5, '0000-00-00 00:00:00', '2016-10-23 07:52:36', '16187793770', '16184778675'),
(3, '2016-10-23 05:54:40', '255', 5, '0000-00-00 00:00:00', '2016-10-23 07:49:45', '16187793770', '16184778675'),
(4, '2016-10-23 05:58:11', '255', 5, '0000-00-00 00:00:00', '2016-10-23 08:37:28', '16187793770', '16184778675'),
(5, '2016-10-23 05:58:36', '261', 5, '0000-00-00 00:00:00', '2016-10-23 07:46:59', '16187793770', '16184778675'),
(6, '2016-10-23 07:54:52', '522', 5, '0000-00-00 00:00:00', '2016-10-23 08:38:07', '16187793770', '16184778675'),
(7, '2016-10-23 07:56:28', '522', 5, '0000-00-00 00:00:00', '2016-10-23 08:36:34', '16187793770', '16184778675'),
(8, '2016-10-23 07:57:40', '522', 5, '0000-00-00 00:00:00', '2016-10-23 08:26:59', '16187793770', '16184778675'),
(9, '2016-10-23 07:59:24', '995', 5, '0000-00-00 00:00:00', '2016-10-23 08:22:45', '15732476610', '16184778675'),
(10, '2016-10-23 08:23:54', '522', 5, '0000-00-00 00:00:00', '2016-10-23 08:39:24', '16187793770', '16184778675'),
(11, '2016-10-23 08:25:43', '522', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(12, '2016-10-23 08:26:59', '522', 5, '0000-00-00 00:00:00', '2016-10-23 08:55:34', '16187793770', '16184778675'),
(13, '2016-10-23 08:28:25', '522', 5, '0000-00-00 00:00:00', '2016-10-23 08:56:38', '16187793770', '16184778675'),
(14, '2016-10-23 08:31:00', '522', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(15, '2016-10-23 08:33:49', '858', 5, '0000-00-00 00:00:00', '2016-10-23 08:35:29', '16187793770', '16184778675'),
(16, '2016-10-23 08:37:09', '858', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(17, '2016-10-23 08:38:39', '522', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(18, '2016-10-23 08:41:07', '522', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(19, '2016-10-23 08:41:29', '858', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(20, '2016-10-23 08:41:54', '858', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(21, '2016-10-23 08:45:58', '165', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16364749180', '16184778675'),
(22, '2016-10-23 08:47:06', '165', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16364749180', '16184778675'),
(23, '2016-10-23 08:48:27', '522', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(24, '2016-10-23 08:48:53', '255', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(25, '2016-10-23 08:49:04', '165', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16364749180', '16184778675'),
(26, '2016-10-23 08:49:21', '165', 5, '0000-00-00 00:00:00', '2016-10-23 08:52:23', '13146624356', '16184778675'),
(27, '2016-10-23 08:50:52', '165', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16182257441', '16184778675'),
(28, '2016-10-23 08:54:31', '522', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16187793770', '16184778675'),
(29, '2016-10-23 08:54:49', '165', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16364749180', '16184778675'),
(30, '2016-10-23 08:56:08', '165', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16364749180', '16184778675'),
(31, '2016-10-23 09:03:11', '165', 5, '0000-00-00 00:00:00', '2016-10-23 09:04:23', '16364749180', '16184778675'),
(32, '2016-10-23 09:03:35', '165', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16182257441', '16184778675'),
(33, '2016-10-23 09:03:46', '995', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '16364749180', '16184778675');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `siteid` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `address` varchar(150) COLLATE utf8_bin NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `code` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`siteid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`siteid`, `name`, `address`, `lat`, `lon`, `code`) VALUES
(1, 'Saint Louis Public Library', '1301 Olive Street, Saint Louis, MO 63103', 38.5547, -90.1994, '143'),
(2, 'Shrewsbury Metrolink Station', '707 N 1st Street, Saint Louis, MO 63102', 38.63, -90.1833, '261'),
(3, 'Busch Stadium ', '700 Clarke Avenue, Saint Louis, MO 63102', 38.6257, -90.2103, '759'),
(4, 'Saint Louis County Community Health Center', '4000 Jennings Station Rd., Saint Louis, MO 63121', 38.6947, -90.2741, '435'),
(5, 'Saint Louis County Department of Public Health', '6121 North Hanley Road, Berkeley, MO 63134', 38.7485, -90.3361, '858'),
(6, 'Sweetie Pies At The Mangrove', '4270 Manchester Avenue, Saint Louis, MO 63110', 38.6268, -90.2567, '255'),
(7, 'Saint Louis Muny', '1 Theatre Drive, Saint Louis, MO  63112', 38.6408, -90.2805, '165'),
(8, 'Soulard Farmers Market', '730 Carroll Street, Saint Louis, MO 63104', 38.6107, -90.2011, '995'),
(9, 'Saint Louis Galleria Mall', '1155 Saint Louis Galleria Street, Saint Louis, MO 63117', 38.6354, -90.3474, '522');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
