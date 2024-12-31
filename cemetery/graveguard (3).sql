-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 04:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graveguard`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `account_id` int(11) NOT NULL,
  `account_uname` varchar(100) NOT NULL,
  `account_email` varchar(100) NOT NULL,
  `account_pword` varchar(255) NOT NULL,
  `account_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`account_id`, `account_uname`, `account_email`, `account_pword`, `account_type`) VALUES
(4, 'testtestes', 'carry@mail.com', '123', ''),
(6, 'vairon', 'vairon@gmail.com', '123123123', ''),
(7, 'urusu', 'urusu@mail.com', '123', ''),
(8, 'dwolf', 'dwolf@mail.com', '12345678', ''),
(9, 'luna', 'luna@mail.com', '123123123', ''),
(10, 'jugg', 'jugg@mail.com', '$2y$10$XDnjevsm8kX7.xIQ3Dqf6eMXBuKi2wxwnbRdZ6FpwTGQr4.ODT2ZK', ''),
(11, 'roy', 'roy@mail.com', '$2y$10$AHJa6Fv3DUcTwM4o/jtPF.yNQ.TcB3/zA40xOfuMVhclfC1kR.E9y', ''),
(13, 'kim', 'kim@outlook.com', '$2y$10$VlhlEFkzjfwFOapvaGVRwuhObWuKubdZaElKRp1ZhzaLn2y8Go73O', ''),
(14, 'subrosa', 'inate@sol.com', '$2y$10$vErD4PyHlcgCuKnK2qHTHeSUhvS04rJ3TDI/YtEZrH5e5EZIk79B2', ''),
(16, 'drow', 'drow@mail.com', '12345678', '');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_tbl`
--

CREATE TABLE `brgy_tbl` (
  `brgy_id` int(11) NOT NULL,
  `brgy_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_tbl`
--

INSERT INTO `brgy_tbl` (`brgy_id`, `brgy_name`) VALUES
(1, 'Barangay Uno'),
(2, 'Bagacay'),
(3, 'Balao'),
(4, 'Bolocboloc'),
(5, 'Budbud'),
(6, 'Calamba'),
(7, 'Campangga'),
(8, 'Candugay'),
(9, 'Gunting'),
(10, 'Guibuangan'),
(11, 'Japitan'),
(12, 'Kagay'),
(13, 'Luinab'),
(14, 'Lupo'),
(15, 'Malolos'),
(16, 'Mantayupan'),
(17, 'Mayana'),
(18, 'Palaypay'),
(19, 'Poblacion'),
(20, 'San Rafael'),
(21, 'Santander'),
(22, 'Sayaw'),
(23, 'Tal-ot'),
(24, 'Tubod'),
(25, 'Vito'),
(26, 'Azucena');

-- --------------------------------------------------------

--
-- Table structure for table `deadpp_tbl`
--

CREATE TABLE `deadpp_tbl` (
  `deadpp_id` int(11) NOT NULL,
  `brgy_id` int(11) NOT NULL,
  `deadpp_lname` varchar(100) NOT NULL,
  `deadpp_fname` varchar(100) NOT NULL,
  `deadpp_mname` varchar(100) DEFAULT NULL,
  `deadpp_gender` varchar(10) NOT NULL,
  `deadpp_bdate` date NOT NULL,
  `deadpp_ddate` date NOT NULL,
  `deadpp_rep` varchar(100) DEFAULT NULL,
  `deadpp_conNum` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deadpp_tbl`
--

INSERT INTO `deadpp_tbl` (`deadpp_id`, `brgy_id`, `deadpp_lname`, `deadpp_fname`, `deadpp_mname`, `deadpp_gender`, `deadpp_bdate`, `deadpp_ddate`, `deadpp_rep`, `deadpp_conNum`) VALUES
(1, 1, 'Doe', 'John', 'M.', 'Male', '1950-01-15', '2023-10-20', 'Jane Doe', '09171234567'),
(37, 25, 'ln', 'fn', 'mn', 'Female', '2024-12-05', '2024-12-19', 'reaper', '09766623626'),
(38, 19, 'washeroom', 'lad', 'ies', 'Male', '2021-05-07', '2024-12-17', 'borat', '2332522522'),
(39, 19, 'go', 'duck', 'duck', 'Male', '2024-12-04', '2024-12-19', 'brave', '0782712441'),
(40, 12, 'seven', 'agent', 'fourty', 'Male', '2024-12-03', '2025-01-02', 'Tomahawk', '46747477471'),
(41, 13, 'kim', 'luna', 'N/A', 'Male', '2024-12-04', '2025-01-03', 'drow ranger', '2315511222'),
(42, 17, 'Shaker', 'earth', 'Shek', 'Male', '2024-12-04', '2025-01-03', 'earth spirit', '097756672'),
(43, 3, 'econ', 'Ghost', 'R', 'Female', '2024-12-11', '2025-01-09', 'Price', '23222322'),
(44, 9, 'void', 'face', 'less', 'Male', '2024-12-10', '2025-01-03', 'juggernaut', '092891414');

-- --------------------------------------------------------

--
-- Table structure for table `grave_tbl`
--

CREATE TABLE `grave_tbl` (
  `grave_id` int(11) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `deadpp_id` int(11) NOT NULL,
  `grave_burried` date NOT NULL,
  `grave_xpire` date DEFAULT NULL,
  `grave_fee` double NOT NULL,
  `grave_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grave_tbl`
--

INSERT INTO `grave_tbl` (`grave_id`, `plot_id`, `deadpp_id`, `grave_burried`, `grave_xpire`, `grave_fee`, `grave_type`) VALUES
(7, 24, 37, '2024-12-10', '2025-01-02', 5000, 'Vault'),
(8, 25, 38, '2024-12-04', '2024-12-26', 5000, 'Natural Burial'),
(9, 26, 39, '2024-12-10', '2025-01-03', 5000, 'Natural Burial'),
(10, 27, 40, '2024-12-03', '2025-01-03', 5000, 'Cremation Plot'),
(11, 28, 41, '2024-12-09', '2025-01-10', 5000, 'Mausoleum'),
(12, 29, 42, '2024-12-04', '2025-01-02', 5000, 'Family Plot'),
(13, 30, 43, '2024-12-11', '2025-01-09', 5000, 'Vault'),
(14, 31, 44, '2024-12-17', '2025-01-10', 5000, 'Lawn Grave');

-- --------------------------------------------------------

--
-- Table structure for table `plot_tbl`
--

CREATE TABLE `plot_tbl` (
  `plot_id` int(11) NOT NULL,
  `plot_number` int(11) NOT NULL,
  `plot_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plot_tbl`
--

INSERT INTO `plot_tbl` (`plot_id`, `plot_number`, `plot_description`) VALUES
(1, 101, 'Near the main gate of the cemetery'),
(2, 0, ''),
(3, 0, ''),
(4, 0, ''),
(5, 0, ''),
(6, 0, ''),
(7, 0, ''),
(8, 0, ''),
(9, 0, ''),
(10, 0, ''),
(11, 0, ''),
(12, 0, ''),
(13, 0, ''),
(14, 0, ''),
(15, 0, ''),
(16, 0, ''),
(17, 0, ''),
(18, 0, ''),
(19, 0, ''),
(20, 0, ''),
(21, 4, 'asdadadasdasd'),
(22, 22, 'asdadadasdasd'),
(23, 332, 'asdadadasdasd'),
(24, 23452, 'plot description'),
(25, 1, 'Adjacent to the chapel'),
(26, 6763, 'Near the memorial garden'),
(27, 901, 'In the quiet corner'),
(28, 61, 'Near the main gate of the cemetery'),
(29, 2321, 'Adjacent to the chapel'),
(30, 8080, 'Under the large oak tree'),
(31, 2020, 'On the east side of the cemetery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `brgy_tbl`
--
ALTER TABLE `brgy_tbl`
  ADD PRIMARY KEY (`brgy_id`);

--
-- Indexes for table `deadpp_tbl`
--
ALTER TABLE `deadpp_tbl`
  ADD PRIMARY KEY (`deadpp_id`),
  ADD KEY `brgy_id` (`brgy_id`);

--
-- Indexes for table `grave_tbl`
--
ALTER TABLE `grave_tbl`
  ADD PRIMARY KEY (`grave_id`),
  ADD KEY `plot_id` (`plot_id`),
  ADD KEY `deadpp_id` (`deadpp_id`);

--
-- Indexes for table `plot_tbl`
--
ALTER TABLE `plot_tbl`
  ADD PRIMARY KEY (`plot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `brgy_tbl`
--
ALTER TABLE `brgy_tbl`
  MODIFY `brgy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `deadpp_tbl`
--
ALTER TABLE `deadpp_tbl`
  MODIFY `deadpp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `grave_tbl`
--
ALTER TABLE `grave_tbl`
  MODIFY `grave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `plot_tbl`
--
ALTER TABLE `plot_tbl`
  MODIFY `plot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deadpp_tbl`
--
ALTER TABLE `deadpp_tbl`
  ADD CONSTRAINT `deadpp_tbl_ibfk_1` FOREIGN KEY (`brgy_id`) REFERENCES `brgy_tbl` (`brgy_id`);

--
-- Constraints for table `grave_tbl`
--
ALTER TABLE `grave_tbl`
  ADD CONSTRAINT `grave_tbl_ibfk_1` FOREIGN KEY (`plot_id`) REFERENCES `plot_tbl` (`plot_id`),
  ADD CONSTRAINT `grave_tbl_ibfk_2` FOREIGN KEY (`deadpp_id`) REFERENCES `deadpp_tbl` (`deadpp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
