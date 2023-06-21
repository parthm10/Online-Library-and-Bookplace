-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 05:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_library_bookplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookhosts`
--

CREATE TABLE `bookhosts` (
  `bhname` varchar(50) NOT NULL,
  `bhmail` varchar(50) NOT NULL,
  `bhpass` varchar(255) NOT NULL,
  `bhid` int(10) NOT NULL,
  `bhphone` varchar(10) NOT NULL,
  `bhpincode` int(6) NOT NULL,
  `bhcity` varchar(30) NOT NULL,
  `bhstate` varchar(30) NOT NULL,
  `bhaddr` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookhosts`
--

INSERT INTO `bookhosts` (`bhname`, `bhmail`, `bhpass`, `bhid`, `bhphone`, `bhpincode`, `bhcity`, `bhstate`, `bhaddr`) VALUES
('Aryaan Bhaskar', 'ab@gmail.com', '$2y$10$Du0fOnjUhQMjC9xDSwYki.KQrV/rldQyfty17Hiy4Gzi42CyjOTo6', 500001, '9876543210', 400072, 'Mumbai', 'Maharashtra', 'Hiranandani'),
('Parth Maheshwari', 'pm@gmail.com', '$2y$10$34tDlpb4bCNMbUDlMX0p9emwkFYrRf9tF5FKJ6vDVRb/dFffaZfmS', 500002, '9876543343', 632014, 'Vellore', 'Tamil Nadu', 'Q Block, Mens Hostel, VIT, Vellore'),
('Tejas Kokadwar', 'tk@gmail.com', '$2y$10$93PfqmmcpGniFB7rsOWpnu1hsd/lg/b4GoS85mNiTPnqpNAvPSVXa', 500003, '9876542111', 631012, 'Katpadi', 'Tamil Nadu', 'Prime Park'),
('Swapnil Jain', 'sj@gmail.com', '$2y$10$PgBE/JQVjegbiMMW2ycnL.mUpvZRs1T8LKN4B3mG94Vb0EPEM0Iiu', 500004, '7098765432', 632011, 'Vellore', 'Tamil Nadu', 'Princeton Park');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` varchar(17) NOT NULL,
  `title` varchar(100) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `author` varchar(50) NOT NULL,
  `libid` int(10) NOT NULL,
  `quant` int(5) NOT NULL,
  `pub_name` varchar(50) NOT NULL,
  `pub_year` int(4) NOT NULL,
  `bookcover` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `genre`, `author`, `libid`, `quant`, `pub_name`, `pub_year`, `bookcover`, `type`) VALUES
('9780008123208', 'And Then There Were None', 'Thriller', 'Agatha Christie', 500002, 1, 'Collins Crime Club', 2002, 'https://covers.openlibrary.org/b/isbn/9780008123208-L.jpg', 'Bookplace'),
('9780131873742', 'Digital Signal Processing : Principles, Algorithms and Applications', 'Textbook', 'Dimitris Manolakis', 100002, 10, 'Pearson', 2016, 'https://covers.openlibrary.org/b/isbn/9780131873742-L.jpg', 'University'),
('9780395647387', 'The Lord of the Rings', 'Fiction', 'J. R. R. Tolkien', 100004, 4, 'Houghton Mifflin Harcourt', 1992, 'https://covers.openlibrary.org/b/isbn/9780395647387-L.jpg', 'Bookplace'),
('9781524796280', 'Fire and Blood', 'Fantasy', 'Goerge R.R. Martin', 500002, 2, 'Bantam Books', 2018, 'https://covers.openlibrary.org/b/isbn/9781524796280-L.jpg', 'Bookplace'),
('9781612680194', 'Rich Dad Poor Dad', 'Self-Improvement', 'Robert Kiyosaki, Sharon Lechter', 500002, 2, 'Warner Books', 2017, 'https://covers.openlibrary.org/b/isbn/9781612680194-L.jpg', 'Bookplace'),
('9781633698703', 'Doing Agile Right: Transformation Without Chaos', 'Textbook', 'Darrell Rigby, Sarah Elk', 100002, 5, 'Harvard Business Review Press', 2020, 'https://covers.openlibrary.org/b/isbn/9781633698703-L.jpg', 'Bookplace'),
('9781683649168', 'No Bad Parts', 'Thriller', 'Dr. Schwartz', 100004, 7, 'Sounds True Inc', 2021, 'https://covers.openlibrary.org/b/isbn/9781683649168-L.jpg', 'Bookplace'),
('9781982143657', 'It Ends with Us', 'Action', 'Colleen Hoover', 100002, 9, 'Pocket Books', 2020, 'https://covers.openlibrary.org/b/isbn/9781982143657-L.jpg', 'Bookplace'),
('9789325298651', 'Differential Calculus', 'Textbook', 'Amit M. Agarwal', 100004, 10, 'Arihant', 2018, 'https://covers.openlibrary.org/b/isbn/9789325298651-L.jpg', 'Public Library'),
('9789391165482', 'Do Epic Shit', 'Self-Improvement', 'Ankur Warikoo', 500001, 2, 'Juggernaut', 2022, 'https://covers.openlibrary.org/b/isbn/9789391165482-L.jpg', 'Bookplace');

-- --------------------------------------------------------

--
-- Table structure for table `issued`
--

CREATE TABLE `issued` (
  `umail` varchar(50) NOT NULL,
  `isbn` varchar(17) NOT NULL,
  `libid` int(10) NOT NULL,
  `issue_date` varchar(50) NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `return_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued`
--

INSERT INTO `issued` (`umail`, `isbn`, `libid`, `issue_date`, `due_date`, `return_date`) VALUES
('ab@mail.com', '9780395647387', 100004, '11-11-2022', '26-11-2022', 'na');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `libmail` varchar(50) NOT NULL,
  `libpass` varchar(255) NOT NULL,
  `libid` int(10) NOT NULL,
  `libname` varchar(50) NOT NULL,
  `libtype` varchar(20) NOT NULL,
  `pincode` int(6) NOT NULL,
  `libaddr` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`libmail`, `libpass`, `libid`, `libname`, `libtype`, `pincode`, `libaddr`) VALUES
('ab@gmail.com', '$2y$10$LC74JUg41XiiNuPd1h7DfukCrM0/Dksmp8/julM4ka/KBYoCIKP.2', 100001, 'Private Library', 'Private', 632014, 'Vellore, Tamil Nadu'),
('saintmarylib@gmail.com', '$2y$10$N57bsvTuU.t2lC6sjpAiDOQ1Rqq1I81xoNs0z36QXQh3BsHK.FKmK', 100003, 'Saint Mary Library', 'Public', 632012, 'Katpadi, Tamil Nadu'),
('vit@gmail.com', '$2y$10$jgQ.TXtFIr98ZU.XRv6C/u1Hjr7CCfCBOFHRShqoXYqNXRJdki7n2', 100002, 'VIT Library', 'University', 632014, 'Vellore, Tamil Nadu'),
('vpl@gmail.com', '$2y$10$2iDJghdSo.m5sdMUfeuqXeoNWX3vUHTTcJdaQJRs6U4kfLJ5r4pSe', 100004, 'Vellore Public Library', 'Public', 632014, 'Vellore, Tamil Nadu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uname` varchar(50) NOT NULL,
  `umail` varchar(50) NOT NULL,
  `upass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uname`, `umail`, `upass`) VALUES
('Aryaan Bhaskar', 'ab@mail.com', '5e1ab4306e0758597ee29a613eb2bf9d'),
('Girraj Gautam', 'gg@outlook.com', '500038062adf1a460c477686bd622fea'),
('Ikshit Samanta', 'is@gmail.com', 'f5dc1b116b1c58be3a56dc001d5efc9c'),
('Parth Maheshwari', 'pm@gmail.com', '6db012f325716c8c81d88f23dc0d3302'),
('Swapnil Jain', 'sj@gmail.com', '1c5a869761d08e502f5dbcdca6ed3deb'),
('Tejas Kokadwar', 'tk@outlook.com', '65ac0f50ab8881923bd1706b4ca76e78');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookhosts`
--
ALTER TABLE `bookhosts`
  ADD PRIMARY KEY (`bhid`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`libmail`),
  ADD UNIQUE KEY `libmail` (`libmail`),
  ADD UNIQUE KEY `libid` (`libid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`umail`),
  ADD UNIQUE KEY `umail` (`umail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookhosts`
--
ALTER TABLE `bookhosts`
  MODIFY `bhid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500014;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `libid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100012;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
