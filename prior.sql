-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql308.epizy.com
-- Generation Time: Jul 14, 2021 at 10:22 PM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_28313323_prior`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `priorid` int(3) NOT NULL,
  `username` varchar(512) NOT NULL,
  `name` varchar(512) NOT NULL,
  `message` varchar(4096) NOT NULL,
  `timedate` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `priorid`, `username`, `name`, `message`, `timedate`) VALUES
(1, 27, 'meowman', 'Meow Man', 'This is the first comment', '2021-04-08 04:45:28'),
(2, 27, 'Meow Man', 'meowman', '<p>This is the second message</p>', '2021-04-08 13:13:00'),
(3, 27, 'meowman', 'Meow Man', '<p>This is the third comment</p>', '2021-04-08 13:15:33'),
(4, 27, 'meowman', 'Meow Man', '<p>This is the third comment</p>', '2021-04-08 13:16:48'),
(5, 30, 'meowman', 'Meow Man', '<p>Whatcha doing??</p>', '2021-04-08 13:38:01'),
(6, 30, 'meowman', 'Meow Man', '<p>Nothing. Just simply wasting time</p>', '2021-04-08 13:38:22'),
(7, 30, 'meowman', 'Meow Man', '<p>This is a comment now.!!&nbsp;</p>', '2021-04-08 19:40:53'),
(8, 30, 'meowman', 'Meow Man', '<p>PWA is awesome dude!&nbsp;</p>', '2021-04-08 19:41:30'),
(9, 30, 'meowman', 'Meow Man', '<p>Testing from LAN</p>', '2021-04-20 03:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `duetable`
--

CREATE TABLE `duetable` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `subject` varchar(32) NOT NULL,
  `staff` varchar(32) NOT NULL,
  `title` varchar(2048) NOT NULL,
  `timedate` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `duetable`
--

INSERT INTO `duetable` (`id`, `username`, `subject`, `staff`, `title`, `timedate`) VALUES
(9, 'meowman', 'ADS', 'NATHEZHTHA', '<p>Test Due</p>', '20-04-2021'),
(11, 'meowman', 'CAA', 'SUNIL', '<p>CA Sunil Test</p>', '10-04-2021'),
(12, 'meowman', 'OST', 'SHERLEY', '<p>test 1</p>', '14-04-2021'),
(13, 'meowman', 'OLA', 'VIVEKANANDAN', '<p>Test 234</p>', '21-04-2021'),
(14, 'meowman', 'ALA', 'NATHEZHTHA', '<p>Final test</p>', '14-04-2021'),
(15, 'meowman', 'CAA', 'SUNIL', '<p>Test</p>', '22-04-2021'),
(16, 'meowman', 'DAA', 'HEMALATHA', '<p>Algo</p>', '22-04-2021'),
(17, 'meowman', 'DAA', 'SUNIL', '<p>Test for sunil</p>', '21-04-2021'),
(18, 'meowman', 'CAA', 'SUNIL', '<p>Test</p>', '21-04-2021'),
(19, 'meowman', 'DAA', 'SWEETLYN', '<p>DAA swt</p>', '08-04-2021'),
(20, 'meowman', 'CAA', 'SHANMUGAPRIYA', '<p>CA SP</p>', '15-04-2021'),
(21, 'meowman', 'OST', 'VIVEK', '<p>OS VIVEK</p>', '14-04-2021'),
(22, 'meowman', 'ADS', 'JAYANTHI', '<p>ADS JAYA</p>', '08-04-2021'),
(23, 'meowman', 'OLA', 'SHERLEY', '<p>OS L SHER</p>', '27-04-2021'),
(24, 'meowman', 'ALA', 'ARULNAN', '<p>ADS L ARUL</p>', '14-04-2021'),
(25, 'meowman', 'DAA', 'HEMALATHA', '<p>HEMA DAA</p>', '29-04-2021');

-- --------------------------------------------------------

--
-- Table structure for table `goodman`
--

CREATE TABLE `goodman` (
  `id` int(11) NOT NULL,
  `teach` varchar(32) NOT NULL,
  `coursename` varchar(32) NOT NULL,
  `class` varchar(32) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `timedate` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goodman`
--

INSERT INTO `goodman` (`id`, `teach`, `coursename`, `class`, `link`, `timedate`) VALUES
(1, 'Meow', 'EVS', 'Class 1', 'https://www.youtube.com/watch?v=WlFE5yyuD7s', '2021-04-01 06:29:56'),
(2, 'Meow', 'ADS', 'Class 1', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-01 06:29:56'),
(3, 'Meow', 'ALGO', 'Class 1', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-01 06:29:56'),
(4, 'Meow', 'PED', 'Class 1', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-01 06:29:56'),
(5, 'Meow', 'CA', 'Class 1', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-01 06:29:56'),
(6, 'Meow', 'OS', 'Class 1', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-01 06:29:56'),
(7, 'Meow', 'OS', 'Class 2', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-05 06:29:56'),
(8, 'Meow', 'CA', 'Class 2', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-05 06:29:56'),
(9, 'Meow', 'PED', 'Class ', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-01 06:29:56'),
(10, 'Meow', 'ALGO', 'Class 2', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-05 06:29:56'),
(11, 'Meow', 'ADS', 'Class 2', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-05 06:29:56'),
(12, 'Meow', 'EVS', 'Class 2', 'https://www.youtube.com/watch?v=WaZzNv_S0wA', '2021-04-05 06:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `prior`
--

CREATE TABLE `prior` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `message` varchar(4096) NOT NULL,
  `important` int(2) DEFAULT NULL,
  `iscomment` varchar(10) NOT NULL DEFAULT '0',
  `timedate` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prior`
--

INSERT INTO `prior` (`id`, `name`, `username`, `message`, `important`, `iscomment`, `timedate`) VALUES
(30, 'Meow Man', 'meowman', '<p>This is a test message</p>', 0, '0', '2021-04-08 13:37:23'),
(36, 'Prior', 'prior', 'Things Prior can do, Info group cannot<br>\r\n[ based on End User Experience ]<br><br>\r\n<p>\r\n1. Comment on Priors <br>\r\n&emsp;Click on the Chat Icon next to the username on any prior to begin commenting.<br>\r\n\r\n2. Tags<br>\r\n&emsp;Find your information in a more organized way, defined by mods. Click on the \'Tags by Mods\' option in the hamburger menu<br>\r\n\r\n3. Due Schedules<br>\r\n&emsp;Get Personalized Due posts right within the prior app. Whenever a mod posts a due schedule, it will be shown to you in the due page.<br>\r\n&emsp;Click on the \'Blue Calendar\' button on the top left of the web app to begin.<br>\r\n&emsp;Clicking on the Green Tick next to a due will mark is as \'DONE\' so that YOU CAN FIND WHAT YOU REALLY NEED.<br>\r\n</p>', NULL, '0', '2021-04-20 3:37:23'),
(37, 'Prior', 'prior', 'Things Prior can do, Info group cannot<br>\r\n[ based on MOD Experience ]<br><br>\r\n<p>\r\n1. Easy UI<br>\r\n2. Create Tags to organize information<br>\r\n3. Schedule Events to notify everyone (Due Scheduler)<br>\r\n4. Instant Prior to post without navigating multiple pages.<br>\r\n5. Single tap to Delete a prior<br>\r\n<br>\r\nMore features will be added soon.<br>\r\n\r\n\r\n</p>', NULL, '0', '2021-04-20 1:37:23'),
(38, 'Prior', 'prior', '<p>Current Limitations to the web app: <br></p><p>\r\n1.  Style Sheet is not working as intended for iOS Safari Users. Usage of Chromium Browsers is recommended<br>\r\n2.  Push Notification is temporarily suspended. Will be implemented on production server.<br>\r\n3.  Settings page to change passwords and username will be blocked to allow everyone to access the site<br>\r\n4.  This page is served over bot-protected server which means, service workers cannot be installed, which makes this a semi-PWA. It will be a PWA on the production server.<br>\r\n5.  Image upload is temporarily suspended.<br>\r\n</p>', NULL, '0', '2021-04-20 4:37:23'),
(39, 'Meow Man', 'meowman', '<p>Hi</p>', 1, '0', '2021-04-20 15:43:06'),
(40, 'Meow Man', 'meowman', '<p><a href=\"https://google.com\">https://google.com</a></p>', 0, '0', '2021-06-30 17:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `tagposts`
--

CREATE TABLE `tagposts` (
  `id` int(11) NOT NULL,
  `tagid` int(32) NOT NULL,
  `tagname` varchar(256) NOT NULL,
  `name` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `message` varchar(4096) NOT NULL,
  `timedate` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tagposts`
--

INSERT INTO `tagposts` (`id`, `tagid`, `tagname`, `name`, `username`, `message`, `timedate`) VALUES
(1, 1, 'Greetings', 'Meow Man', 'meowman', 'This is the first post in the Greetings tag', '2021-04-08 13:37:23'),
(2, 1, 'Greetings', 'Meow Man', 'meowman', '<p>This is the first post as meowman in the greetings tag</p>', ''),
(3, 1, 'Greetings', 'Meow Man', 'meowman', '<p>This is the first post as meowman in the greetings tag</p>', '2021-04-09 01:30:12'),
(4, 3, 'New Greetings', 'Meow Man', 'meowman', '<p>This is the first message as meowman in new greetings tag</p>', '2021-04-09 01:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tagname` varchar(256) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tagname`, `username`) VALUES
(1, 'Greetings', 'meowman');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `ismod` int(2) DEFAULT '0',
  `course` varchar(1024) NOT NULL,
  `completed` varchar(4096) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `ismod`, `course`, `completed`) VALUES
(1, 'Meow Man', 'meowman', 'meowman', 1, 'ABCDEF\r\nDAHEMA \r\nOSSHER \r\nADNATH \r\nALNATH\r\nOLVIVE\r\nCASUNI', ''),
(2, 'Doggy Man', 'doggyman', 'doggyman', 1, 'ABCDEF\r\nDASWEE\r\nOSVIVE\r\nADJAYA\r\nALARUL\r\nOLSHER\r\nCASHAN', '19DASWEE21OSVIVE20CASHAN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `duetable`
--
ALTER TABLE `duetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goodman`
--
ALTER TABLE `goodman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prior`
--
ALTER TABLE `prior`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagposts`
--
ALTER TABLE `tagposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `duetable`
--
ALTER TABLE `duetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `goodman`
--
ALTER TABLE `goodman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prior`
--
ALTER TABLE `prior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tagposts`
--
ALTER TABLE `tagposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
