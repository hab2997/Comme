-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 06:50 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `user_email`, `user_pass`) VALUES
(3, 'akbatra567@gmail.com', 'akbatra');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'DELL'),
(3, 'LG'),
(4, 'Samsung'),
(5, 'Sony'),
(6, 'Toshiba'),
(7, 'Prabhat Publications'),
(8, 'Amazon');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES
(7, '::1', 0),
(10, '::1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Laptops'),
(2, 'Cameras'),
(3, 'Mobiles'),
(4, 'Computers'),
(5, 'Banana'),
(6, 'iPhones'),
(7, 'Books'),
(8, 'Tablets');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `p_id` int(100) NOT NULL,
  `c_id` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `status` text NOT NULL,
  `order_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `p_id`, `c_id`, `qty`, `invoice_no`, `status`, `order_date`) VALUES
(5, 8, 5, 1, 462643381, 'Completed', '0000-00-00'),
(6, 6, 5, 3, 481994459, 'Completed', '2014-07-21'),
(7, 9, 0, 1, 1545302558, 'Completed', '2014-07-23'),
(8, 5, 0, 2, 705705316, 'in Progress', '2014-08-08'),
(9, 7, 6, 1, 1935681132, 'in Progress', '2014-08-08'),
(10, 9, 6, 3, 1817786416, 'in Progress', '2014-08-08'),
(11, 5, 6, 2, 423122154, 'in Progress', '2014-08-08'),
(12, 8, 6, 4, 496641685, 'in Progress', '2014-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `currency` text NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `amount`, `customer_id`, `product_id`, `trx_id`, `currency`, `payment_date`) VALUES
(1, 800, 5, 6, '31B07494JS505133P', 'USD', '0000-00-00'),
(2, 500, 5, 9, '18747053K31546734', 'USD', '0000-00-00'),
(3, 1000, 5, 9, '183154524M7953521', 'USD', '0000-00-00'),
(4, 900, 5, 5, '8L053110TE658224T', 'USD', '2014-07-21'),
(5, 450, 5, 8, '42M62596JN658381G', 'USD', '2014-07-21'),
(6, 600, 5, 6, '1FC71986FP579232R', 'USD', '2014-07-21'),
(7, 500, 0, 9, '0AH67056C64289013', 'USD', '2014-07-23'),
(8, 1800, 0, 5, '1F431738AY795223E', 'USD', '2014-08-08'),
(9, 250, 6, 7, '3G918931JL634141Y', 'USD', '2014-08-08'),
(10, 1500, 6, 9, '0BF7586175203573G', 'USD', '2014-08-08'),
(11, 1800, 6, 5, '7RS823437E828061K', 'USD', '2014-08-08'),
(12, 1800, 6, 8, '84J65197FN011600G', 'USD', '2014-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(5, 0, 0, 'Samsung Camera', 900, '<p>This is a great samsung mobile, you must buy it in order to have some really good fun.&nbsp;</p>', 'Vivo-NEX.jpg', 'Samsung, Cameras, Special'),
(6, 3, 6, 'HTC mobile ', 200, '<p>this one is a great one.</p>', 'HTC-Google-Nexus-One-2.jpg', 'mobiles, new, special'),
(7, 2, 6, 'Toshiba Camera ', 250, '<p>This is a great camera...</p>', 'professional-video-camera.jpg', 'Toshiba, cameras, Special'),
(8, 3, 5, 'Nokia Tablet', 450, '<p>this is a great thing....</p>', 'nokia-windows-200-dollar-tablet2-640x353.jpg', 'Samsung, Cameras, Special'),
(9, 1, 2, 'Dell Pink Laptop', 500, '<p>this is a very nice <strong>laptop</strong> and I like it very much....</p>', '1.jpg', 'dell, laptops, new, special'),
(10, 1, 1, 'HP Envy Laptop', 400, '<p>this is so much nice laptop..</p>', 'original.jpg', 'dell, laptops, new, special'),
(11, 7, 7, 'Born to win', 350, '<ul class=\"product-info-list\" style=\"margin: 0px; padding: 0px 20px 20px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); list-style: none; font-family: Raleway, sans-serif; font-size: 14px;\">\r\n<li style=\"margin: 0px; padding: 15px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 1125px;\"><label style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 328.5px; display: inline-block; font-weight: 600;\">Author</label>&nbsp;<span style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block;\">Zig Ziglar &amp; Tom Ziglar</span></li>\r\n<li style=\"margin: 0px; padding: 15px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 1125px; background-color: #f3f3f3;\"><label style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 328.5px; display: inline-block; font-weight: 600;\">ISBN</label>&nbsp;<span style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block; font-family: Arial, Helvetica, sans-serif;\">9789386231055</span></li>\r\n<li style=\"margin: 0px; padding: 15px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 1125px;\"><label style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 328.5px; display: inline-block; font-weight: 600;\">Language</label>&nbsp;<span style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block;\">ENGLISH</span></li>\r\n<li style=\"margin: 0px; padding: 15px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 1125px; background-color: #f3f3f3;\"><label style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 328.5px; display: inline-block; font-weight: 600;\">Publisher</label>&nbsp;<span style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block;\">Prabhat Prakashan</span></li>\r\n<li style=\"margin: 0px; padding: 15px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 1125px;\"><label style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 328.5px; display: inline-block; font-weight: 600;\">Edition</label>&nbsp;<span style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block;\">1</span></li>\r\n<li style=\"margin: 0px; padding: 15px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 1125px; background-color: #f3f3f3;\"><label style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 328.5px; display: inline-block; font-weight: 600;\">Publication Year</label>&nbsp;<span style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block; font-family: Arial, Helvetica, sans-serif;\">2016</span></li>\r\n<li style=\"margin: 0px; padding: 15px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 1125px;\"><label style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 328.5px; display: inline-block; font-weight: 600;\">Number of pages</label>&nbsp;<span style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block; font-family: Arial, Helvetica, sans-serif;\">192</span></li>\r\n<li style=\"margin: 0px; padding: 15px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 1125px; background-color: #f3f3f3;\"><label style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 328.5px; display: inline-block; font-weight: 600;\">Binding Style</label>&nbsp;<span style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block;\">Hard Cover</span></li>\r\n</ul>', '1472463161.jpg', 'Motivation, Self-help');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
