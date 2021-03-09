-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2021 at 03:28 PM
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
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_cart`
--

CREATE TABLE `customer_cart` (
  `ID` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `pro_id` int(100) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_img` varchar(1000) NOT NULL,
  `pro_price` int(100) NOT NULL,
  `pro_quan` int(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_cart`
--

INSERT INTO `customer_cart` (`ID`, `customer_id`, `pro_id`, `pro_name`, `pro_img`, `pro_price`, `pro_quan`, `status`) VALUES
(1, 1, 1, 'picture', 'img/P20210203235500.jpg', 3, 1, 'exist');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `ID` int(200) NOT NULL,
  `customer_id` int(200) NOT NULL,
  `seller_id` int(200) NOT NULL,
  `pro_id` int(200) NOT NULL,
  `pro_name` varchar(200) NOT NULL,
  `pro_img` varchar(200) NOT NULL,
  `pro_price` decimal(65,0) NOT NULL,
  `pro_quan` int(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `phone_number` int(200) NOT NULL,
  `postal_code` int(200) NOT NULL,
  `area` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `detailed_address` varchar(200) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `tracking_num` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`ID`, `customer_id`, `seller_id`, `pro_id`, `pro_name`, `pro_img`, `pro_price`, `pro_quan`, `status`, `first_name`, `last_name`, `phone_number`, `postal_code`, `area`, `state`, `detailed_address`, `order_date`, `tracking_num`) VALUES
(2, 5, 3, 2, 'picture 2', 'img/P20210203235538.jpg', '4', 2, 'pending', 'dan', 'sfs', 3423, 13000, 'sdfs', 'dss', 'wwe', '2021-03-09', 0),
(3, 5, 3, 1, 'picture', 'img/P20210203235500.jpg', '3', 1, 'pending', 'dan', 'sfs', 3423, 13000, 'sdfs', 'dss', 'wwe', '2021-03-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(100) NOT NULL,
  `seller_id` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `seller_id`, `image`, `name`, `price`, `quantity`) VALUES
(1, 3, 'img/P20210203235500.jpg', 'picture', 3, 100),
(2, 3, 'img/P20210203235538.jpg', 'picture 2', 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `user_photo` varchar(100) NOT NULL,
  `identity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `Email`, `user_photo`, `identity`) VALUES
(1, 'hello', 'hello', 'hello@gmail.com', 'backimg/usericon.png', 'customer'),
(2, 'bye', 'bye', 'bye@gmail.com', 'backimg/usericon.png', 'customer'),
(3, 'haha', 'haha', 'haha@gmail.com', 'backimg/usericon.png', 'seller'),
(4, 'dye', 'dye', 'heelo@gmail.com', 'user_img/user20210204011645.jpg', 'customer'),
(5, 'hpuser', 'hpuser', 'hpuser@gmail.com', 'user_img/user20210216053622.jpg', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_cart`
--
ALTER TABLE `customer_cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_cart`
--
ALTER TABLE `customer_cart`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `ID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
