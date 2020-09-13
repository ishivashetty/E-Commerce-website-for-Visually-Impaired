-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 08:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fabrica`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) UNSIGNED NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Joining_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Name`, `Email`, `Password`, `Joining_Date`) VALUES
(1, 'Shiva Shetty', 'shivashetty@fabrica.com', 'fabrica123', '2020-05-17 18:16:15'),
(2, 'Vishwajeet Kumar', 'vishwajeet@fabrica.com', 'FABRICA123', '2020-05-24 22:48:08'),
(3, 'Peter', 'peter@fabrica.com', 'fabrica99', '2020-05-26 18:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Id` int(11) UNSIGNED NOT NULL,
  `Customer_id` int(11) UNSIGNED NOT NULL,
  `Product_id` int(11) UNSIGNED NOT NULL,
  `Quantity` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) UNSIGNED NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `MOBILE` varchar(10) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Pincode` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `Name`, `MOBILE`, `Email`, `Address`, `City`, `Pincode`) VALUES
(1, 'Shiva Shetty', '8082148140', 'shivashetty34@gmail.com', 'Dummy Address', 'Mumbai', 400082),
(2, 'Vishwajeet Kumar', '7896546425', 'vishwajeet@gmail.com', 'Bihar Bihar', 'Patna', 678465);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Id`, `customer_id`, `Name`, `Email`, `Password`) VALUES
(1, 1, 'Shiva Shetty', 'shivashetty34@gmail.com', 'SHIVA123'),
(2, 2, 'Vishwajeet Kumar', 'vishwajeet@gmail.com', 'PASSWORD');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) UNSIGNED NOT NULL,
  `Order_id` varchar(100) DEFAULT NULL,
  `Customer_id` int(11) UNSIGNED NOT NULL,
  `Product_id` int(11) UNSIGNED NOT NULL,
  `Quantity` int(4) DEFAULT NULL,
  `Unit_price` float DEFAULT NULL,
  `Total_price` float DEFAULT NULL,
  `Order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `Order_id`, `Customer_id`, `Product_id`, `Quantity`, `Unit_price`, `Total_price`, `Order_date`) VALUES
(1, '#F1T1590474656410', 1, 13, 3, 99, 297, '2020-05-26 06:30:56'),
(2, '#F1T1590474656410', 1, 19, 4, 199, 796, '2020-05-26 06:30:56'),
(3, '#F1T1590474656410', 1, 17, 1, 149, 149, '2020-05-26 06:30:56'),
(4, '#F1T1590474810245', 1, 6, 4, 349, 1396, '2020-05-26 06:33:30'),
(5, '#F1T1590475145394', 1, 6, 3, 349, 1047, '2020-05-26 06:39:05'),
(6, '#F1T1590475145394', 1, 13, 4, 99, 396, '2020-05-26 06:39:05'),
(7, '#F1T1590475145394', 1, 2, 3, 399, 1197, '2020-05-26 06:39:05'),
(8, '#F1T1590475145394', 1, 7, 3, 299, 897, '2020-05-26 06:39:05'),
(9, '#F1T1590475145394', 1, 14, 1, 89, 89, '2020-05-26 06:39:05'),
(10, '#F1T1590475505720', 1, 3, 1, 299, 299, '2020-05-26 06:45:05'),
(11, '#F2T1590475529712', 2, 2, 4, 399, 1596, '2020-05-26 06:45:29'),
(12, '#F2T1590475529712', 2, 4, 4, 499, 1996, '2020-05-26 06:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(11) UNSIGNED NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `ImageUrl` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `Category`, `Description`, `Price`, `Gender`, `ImageUrl`) VALUES
(2, 'Beard Tshirts', 'tshirts', 'Beard  Tshirts for Men', 399, 'male', 'src/images/products/male/1.jpg'),
(3, 'Black Tshirts of Round Collar', 'tshirts', 'Black Tshirts for Men, Round Collar', 299, 'male', 'src/images/products/male/2.jpg'),
(4, '(Outsiders) Tshirts', 'tshirts', 'White Tshirts with Label (Outsiders)', 499, 'male', 'src/images/products/male/3.jpg'),
(5, '(Freedom) Tshirts', 'tshirts', 'Black Tshirts with Label (Freedom)', 449, 'male', 'src/images/products/male/4.jpg'),
(6, 'Beard Print Tshirts', 'tshirts', 'Black Tshirts with Beard Print', 349, 'male', 'src/images/products/male/5.jpg'),
(7, 'Watermelon Print Tshirts', 'tshirts', 'White Tshirts for Girls with Watermelon Print', 299, 'female', 'src/images/products/female/0.jpg'),
(10, 'Cacti Print Tshirts', 'tshirts', 'White Tshirts for Girls with Cacti Print', 299, 'female', 'src/images/products/female/1.jpg'),
(11, 'Custom Print Tshirts', 'tshirts', 'White Tshirts for Girls with Custom Print', 499, 'female', 'src/images/products/female/2.jpg'),
(12, 'Doodle Print Tshirts', 'tshirts', 'White Tshirts for Girls with Doodle Print', 399, 'female', 'src/images/products/female/3.jpg'),
(13, 'Custom Doodle Book Covers', 'covers', 'Custom Doodle Covers for Notebooks and Diaries', 99, 'both', 'src/images/products/both/0.jpg'),
(14, 'Custom Laptop Covers', 'covers', 'Custom Covers for Laptops and Mobile', 89, 'both', 'src/images/products/both/3.jpg'),
(15, 'Custom Print on Accessories', 'custom', 'Custom Print on Accessories', 149, 'both', 'src/images/products/both/4.jpg'),
(16, 'Custom Keychains', 'custom', 'Custom Print on Keychains', 199, 'both', 'src/images/products/both/5.jpg'),
(17, 'Custom Print Book Covers', 'custom', 'Custom Print Covers for Notebooks and Diaries', 149, 'both', 'src/images/products/both/6.jpg'),
(19, 'Custom Designed Book Covers', 'custom', 'Custom Designed Covers for Notebooks and Diaries', 199, 'both', 'src/images/products/both/8.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_CART_CUSTOMER_ID` (`Customer_id`),
  ADD KEY `FK_CART_PRODUCT_ID` (`Product_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_LOGIN_CUSTOMER_ID` (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_ORDERS_CUSTOMER_ID` (`Customer_id`),
  ADD KEY `FK_ORDERS_PRODUCT_ID` (`Product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_CART_CUSTOMER_ID` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Id`),
  ADD CONSTRAINT `FK_CART_PRODUCT_ID` FOREIGN KEY (`Product_id`) REFERENCES `products` (`Id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `FK_LOGIN_CUSTOMER_ID` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ORDERS_CUSTOMER_ID` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Id`),
  ADD CONSTRAINT `FK_ORDERS_PRODUCT_ID` FOREIGN KEY (`Product_id`) REFERENCES `products` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
