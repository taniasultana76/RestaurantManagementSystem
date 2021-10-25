-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2021 at 11:52 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fosdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ID` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID`, `username`, `password`, `img`) VALUES
(1, 'admin', '12', 'ad.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

CREATE TABLE `tbl_book` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `people` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`id`, `name`, `address`, `people`, `date`, `mobile`, `item`, `message`) VALUES
(9, 'Tania sultana', 'malibag,dhaka', '10', '2021-04-02', '01721768843', ' Appetizer,Drinks,', 'Well decorated'),
(10, 'Jannat Lima', 'motijhil', '30', '2021-04-02', '01896786543', ' Cake-item,', 'food must have to be delicious.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_od`
--

CREATE TABLE `tbl_log_od` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gen` varchar(255) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_log_od`
--

INSERT INTO `tbl_log_od` (`id`, `username`, `email`, `address`, `password`, `gen`, `img`) VALUES
(4, 'Aminul Islam', 'b@gmail.com', 'Dhaka,Mohakhali', '1234', 'Male', 'ad.png'),
(8, 'Tania Sultana', 't@gmail.com', 'Dhaka,malibag,1200', '1234', 'Female', 'tanu.jpg'),
(9, 'Tania', 'ssssssssssss', 'dhaka', '111111', 'Female', 'ad.png'),
(10, 'Rima Akter', 'nddndn', 'dhaka', 'sssssssss', 'Female', 'ad.png'),
(11, 'ss', 'bisonnoborsha14@gmail.com', 'dhaka', 'sssss', 'Female', 'ad.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(25) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menuID`, `menuName`, `img`) VALUES
(1, 'Mixed Food', 'pizza.jpg'),
(2, 'Pizza', 'burger.jpg'),
(3, 'Burger', 'momo.jpg'),
(4, 'Momo', 'momo.jpg'),
(5, 'Fuchka', NULL),
(6, 'Drinks', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menuitem`
--

CREATE TABLE `tbl_menuitem` (
  `itemID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menuitem`
--

INSERT INTO `tbl_menuitem` (`itemID`, `menuID`, `menuItemName`, `price`, `img`) VALUES
(9, 1, 'Rice Bowl', '120.00', 'plate1.png'),
(10, 1, 'Fruit Salad', '220.00', 'plate2.png'),
(11, 1, 'Mint Ice', '300.00', 'plate3.png'),
(12, 3, 'Chciken-burger', '100.00', 'bur.jfif'),
(13, 2, 'Italian-pizza', '150.00', 'piz.jpg'),
(14, 4, 'Steam-momo', '120.00', 'momo.jpg'),
(15, 4, 'Chicken-momo', '150.00', 'menu-momo.jpg'),
(16, 5, 'Fuchka', '150.00', 'k.jpeg'),
(17, 6, 'Appel juice', '120.00', 'fa.jpg'),
(18, 2, 'Mashroom-pizza', '280.00', 'menu-pizza.jpg'),
(19, 3, 'Mini-burger', '60.00', 'burger.jpg'),
(20, 3, 'Beef-burger', '320.00', 'menu-burger.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_online_order`
--

CREATE TABLE `tbl_online_order` (
  `orderID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `food` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_online_order`
--

INSERT INTO `tbl_online_order` (`orderID`, `username`, `food`, `price`, `qty`, `total`, `date`, `time`, `status`, `cus_name`, `phone`, `email`, `address`) VALUES
(22, 'Aminul Islam', 'Fuchka', 150, 1, 150, '2021-05-17', '09:42:29', 'Delivered', 'tania', '01721768843', 'mim@gmail.com', 'v'),
(27, 'Aminul Islam', 'Fuchka', 150, 1, 150, '2021-05-17', '09:54:31', 'Delivered', 'zzzzzzzz', '01721768843', 'tanu@gmail.com', 'x'),
(28, 'Tania Sultana', 'Mini-burger', 60, 1, 60, '2021-05-17', '15:52:56', 'cancelled', 'Rima', '01721768843', 'tanu@gmail.com', 'dhaka'),
(29, 'Tania Sultana', 'Mashroom-pizza', 120, 1, 120, '2021-05-17', '21:51:46', 'Delivered', 'Tania', '01721768843', 'tanu@gmail.com', 'tangail'),
(30, 'Tania Sultana', 'Italian-pizza', 150, 3, 450, '2021-05-18', '10:37:51', 'Delivered', 'Rima', '01721768843', 'ts1161545@gmail.com', 'Dhaka,khilgaon.5/A'),
(31, 'Tania Sultana', 'Beef-burger', 120, 1, 120, '2021-06-06', '21:32:57', 'Delivered', 'Rifat', '01721768843', 'ts1161545@gmail.com', 'Dhaka,hatirjhil'),
(33, 'Tania Sultana', 'Mashroom-pizza', 120, 1, 120, '2021-06-07', '22:44:37', 'Delivered', 'tania', '01721768843', 'ts@gmail.com', 'Hatirjhil,dhaka'),
(34, 'Tania Sultana', 'Appel juice', 120, 1, 120, '2021-06-14', '20:05:25', 'Delivered', 'Tania', '0192222', 'tanu@gmail.com', 'Dhaka,Mogbazar'),
(42, 'Tania Sultana', 'Chciken-burger', 100, 1, 100, '2021-09-12', '20:56:41', 'Delivered', 'Tania', '01721768843', 'ts@gmail.com', 'dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `order_date` date NOT NULL,
  `time` time NOT NULL DEFAULT current_timestamp(),
  `chef` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderID`, `username`, `status`, `total`, `order_date`, `time`, `chef`) VALUES
(1, 'Bappy hasan', 'Completed', '480.00', '2021-05-20', '20:21:48', 'Md.Nasir'),
(2, 'Bappy hasan', 'Completed', '120.00', '2021-05-25', '19:36:58', 'Md.Nasir'),
(3, 'Bappy hasan', 'cancelled', '120.00', '2021-05-25', '19:38:38', 'Md.Nasir'),
(5, 'Bappy hasan', 'cancelled', '150.00', '2021-05-26', '21:38:40', 'Md.Nasir'),
(6, 'Rima Akter ', 'Completed', '390.00', '2021-06-07', '22:03:35', 'Md.Ahmed'),
(7, 'Rima Akter ', 'Completed', '240.00', '2021-06-07', '20:07:45', 'Md.Ahmed'),
(8, 'Rima Akter ', 'Completed', '150.00', '2021-06-07', '19:44:45', 'Md.Ahmed'),
(9, 'Rima Akter ', 'cancelled', '120.00', '2021-06-14', '19:55:15', 'Md.Ahmed'),
(10, 'Rima Akter ', 'Completed', '120.00', '2021-06-17', '13:15:50', 'Md.Ahmed'),
(11, 'Rima Akter ', 'Completed', '120.00', '2021-06-18', '12:49:44', 'Md.Ahmed'),
(12, 'Rima Akter ', 'Completed', '800.00', '2021-06-19', '23:25:03', 'Md.Ahmed'),
(13, 'Rima Akter ', 'Completed', '240.00', '2021-09-12', '20:55:54', 'Md.Ahmed'),
(14, 'Rima Akter ', 'Completed', '120.00', '2021-09-23', '11:00:11', 'Md.Ahmed'),
(15, 'Rima Akter ', 'Completed', '120.00', '2021-09-23', '11:25:28', 'Md.Ahmed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetail`
--

CREATE TABLE `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `orderDetailID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orderdetail`
--

INSERT INTO `tbl_orderdetail` (`orderID`, `username`, `orderDetailID`, `itemID`, `quantity`) VALUES
(1, 'Rima ', 19, 9, 2),
(1, 'Rima ', 20, 11, 2),
(2, 'Bappy', 21, 10, 2),
(3, 'Bappy', 22, 17, 1),
(5, 'Rima ', 23, 15, 1),
(6, 'Rima Akter ', 24, 13, 1),
(6, 'Rima Akter ', 25, 9, 2),
(7, 'Rima Akter ', 26, 9, 2),
(8, 'Rima Akter ', 27, 15, 1),
(9, 'Rima Akter ', 28, 9, 1),
(10, 'Rima Akter ', 29, 9, 1),
(11, 'Rima Akter ', 30, 9, 1),
(12, 'Rima Akter ', 31, 9, 2),
(12, 'Rima Akter ', 32, 18, 2),
(13, 'Rima Akter ', 45, 9, 2),
(14, 'Rima Akter ', 46, 9, 1),
(15, 'Rima Akter ', 47, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role`) VALUES
('waiter'),
('chef');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staffID` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gen` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staffID`, `username`, `email`, `gen`, `img`, `password`, `status`, `role`) VALUES
(1, 'Rima Akter ', 'ts@gmail.com', 'Female', 'cf3.JFIF', '1234', 'Online', 'waiter'),
(6, 'Md.Ahmed', 'a@gmail.com', 'Male', 'cf2.JFIF', '1234', 'Online', 'chef'),
(7, 'Bappy hasan', 't@gmail.com', 'Female', 'ow.png', '1234', 'Offline', 'waiter'),
(8, 'Md.Nasir', 'n@gmail.com', 'Male', 'cf1.jpg', '1234', 'Offline', 'chef');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log_od`
--
ALTER TABLE `tbl_log_od`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `tbl_menuitem`
--
ALTER TABLE `tbl_menuitem`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `menuID` (`menuID`);

--
-- Indexes for table `tbl_online_order`
--
ALTER TABLE `tbl_online_order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `tbl_orderdetail`
--
ALTER TABLE `tbl_orderdetail`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD KEY `itemID` (`itemID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_book`
--
ALTER TABLE `tbl_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_log_od`
--
ALTER TABLE `tbl_log_od`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_menuitem`
--
ALTER TABLE `tbl_menuitem`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_online_order`
--
ALTER TABLE `tbl_online_order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_orderdetail`
--
ALTER TABLE `tbl_orderdetail`
  MODIFY `orderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staffID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
