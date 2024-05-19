-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 05:26 PM
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
-- Database: `bakery_management`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrder` ()   SELECT * FROM tbl_order
where food ='Margharitta Pizza'$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `recent_orders`
--

CREATE TABLE `recent_orders` (
  `id` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `alert` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recent_orders`
--

INSERT INTO `recent_orders` (`id`, `order_date`, `alert`) VALUES
(1, '2024-03-16 18:30:53', 'Order Placed'),
(3, '2024-03-17 16:25:17', 'Order Placed'),
(4, '2024-03-21 04:19:51', 'Order Placed'),
(5, '2024-03-21 15:04:58', 'Order Placed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Tejas V', 'txaed1', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Yashas B N', 'yashas345', 'e6b4739b804c81fe265750e747ae4363'),
(3, 'Administrator', 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'Thanmai G R', 'sheldon', '81dc9bdb52d04dc20036dbd8313ed055'),
(24, 'Nishkaa V', 'dumbo', '81dc9bdb52d04dc20036dbd8313ed055'),
(25, 'Manager', 'manage1', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(17, 'Assorted Dessert', 'Food_Category_850.jpg', 'Yes', 'Yes'),
(18, 'Pizza', 'Food_Category_418.png', 'Yes', 'Yes'),
(20, 'Burger', 'Food_Category_145.png', 'Yes', 'Yes'),
(22, 'Puff', 'Food_Category_845.png', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(11, 'Chocolate Donut', 'Chocolate Frosting on Donut', 80.00, 'Food-65d10986ef615.jpg', 17, 'Yes', 'No'),
(12, 'Sprinkled Chocolate Donut', 'Colored Sprinklers on Chocolate Frosting', 90.00, 'Food-65d109d60942c.png', 17, 'Yes', 'Yes'),
(14, 'Hazelnut Donut', 'Hazelnut spread over Chocolate Frosting', 95.00, 'Food-65d10a6061455.jpg', 17, 'Yes', 'Yes'),
(15, 'Chocolate Muffin', 'Freshly Baked chocolate muffin', 60.00, 'Food-65d10a94cbd3c.png', 17, 'Yes', 'Yes'),
(16, 'Vanilla Muffin', 'Freshly Baked Vanilla Muffin', 50.00, 'Food-65d10b2ba28b3.png', 17, 'Yes', 'Yes'),
(17, 'Chocolate Chip Muffin', 'Chocolate Chip on top of chocolate muffin', 70.00, 'Food-65d10b587a43e.png', 17, 'Yes', 'Yes'),
(18, 'Blueberry Muffin', 'Blueberry stuffed inside Vanilla Muffin', 90.00, 'Food_65d11b69d1ae3.png', 17, 'Yes', 'Yes'),
(19, 'Sugar Donut', 'Sugar Crystals drizzled upon donut', 50.00, 'Food_65d110268ec4e.png', 17, 'Yes', 'Yes'),
(20, 'Black Forest Pastry', 'Cake with whipped Cream with Cherry In Between ', 60.00, 'Food-65d1179dcb22d.png', 17, 'Yes', 'Yes'),
(21, 'Blueberry Cheescake', 'Biscuit and Blueberry Layes on Cake', 140.00, 'Food-65d117f81920d.png', 17, 'Yes', 'Yes'),
(22, 'Pineapple Cake', 'Pineapple present in between the layers', 60.00, 'Food-65d1182cdcfe7.png', 17, 'Yes', 'Yes'),
(23, 'Chocolate Truffle', 'Cake filled with Chocolatiness', 70.00, 'Food_65d11a2cdbf6a.png', 17, 'Yes', 'Yes'),
(24, 'Mc Chicken Burger', 'Chicken with Lettuce and Mayo', 120.00, 'Food-65d11c7f008c4.jpg', 20, 'Yes', 'Yes'),
(25, 'Mc Chicken Maharaja Burger', 'Double Chicken Patty with Fresh Veggies', 210.00, 'Food-65d11cb29e1ea.png', 20, 'Yes', 'Yes'),
(26, 'Mc Veggie Burger', 'Vegetable Patty with Lettuce and Mayo', 100.00, 'Food-65d11cd9d3711.jpg', 20, 'Yes', 'Yes'),
(27, 'Mc Aloo Tikki Burger', 'Aloo Patty with Tomatoes and Cheese', 60.00, 'Food-65d11d0775613.png', 20, 'Yes', 'Yes'),
(28, 'Margharitta Pizza', 'Pizza Loaded with cheese', 199.00, 'Food-65d11f8d4729a.png', 18, 'Yes', 'Yes'),
(29, 'Peppy Paneer Pizza', 'Pizza Loaded with Cheese and Paneer', 329.00, 'Food-65d11fb81d53a.png', 18, 'Yes', 'Yes'),
(30, 'Veggie Paradise', 'Pizza Loaded with Vegetables', 329.00, 'Food-65d11ff7b8c9a.png', 18, 'Yes', 'Yes'),
(31, 'Indi Chicken Tikka Pizza', 'Pizza Loaded with BBQ chicken cubes', 429.00, 'Food-65d120288c2a5.png', 18, 'Yes', 'Yes'),
(32, 'Egg Puff', 'Puff loaded with Egg', 25.00, 'Food-65d120b1bfb6f.png', 22, 'Yes', 'Yes'),
(33, 'Paneer Puff', 'Puff Loaded with Paneer', 22.00, 'Food-65d120daeaa71.png', 22, 'Yes', 'Yes'),
(34, 'Chicken Puff', 'Puff Loaded with Chicken ', 30.00, 'Food-65d120fcc9827.png', 22, 'Yes', 'Yes'),
(35, 'Veg Puff', 'Puff Loaded with Vegetables', 20.00, 'Food-65d121e6920da.png', 22, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Chocolate Donut', 80.00, 2, 160.00, '2024-02-17 16:32:49', 'Delivered', 'Tejas M', '674-345-9870', 'thief@gmail.com', '#123, Opposite Sumashree Wines , Kumarswamy Layout,Bangalore - 560045'),
(2, 'Mc Chicken', 110.00, 1, 110.00, '2024-02-17 18:11:17', 'Delivered', 'Roopa Venu', '994-566-6543', 'roopa@gmail.com', '#901,Adarsh Rhythm, Behind Fortis Hospital,Bangalore-560 076'),
(3, 'Indi Chicken Tikka Pizza', 429.00, 1, 429.00, '2024-02-17 22:17:31', 'Delivered', 'Yashas', '994-566-6543', 'roopa@gmail.com', '#901, Adarsh Rhythm Apartments, Bangalore -560 076'),
(4, 'Black Forest Pastry', 60.00, 6, 360.00, '2024-02-18 10:32:56', 'Delivered', 'Tejas M', '674-345-9870', 'thief@gmail.com', '#123,Kumarswamy Layout, Opp sumashree wines,Bangalore - 560 045'),
(5, 'Blueberry Cheescake', 140.00, 1, 140.00, '2024-02-18 10:36:26', 'Delivered', 'Thanmai GR', '847-478-4739', 'snorlax@gmail.com', '#321, Devegowda Petrol Bunk, Bangalore - 560 055'),
(8, 'Chocolate Muffin', 60.00, 1, 60.00, '2024-03-02 12:09:38', 'Cancelled', 'Thanmai GR', '847-478-4739', 'thanmai@gmail.com', '#123, Richness Appartment'),
(9, 'Veg Puff', 20.00, 1, 20.00, '2024-03-02 12:12:18', 'Cancelled', 'jane ', '977-894-9933', 'yo@gmail.com', '123'),
(10, 'Chocolate Truffle', 70.00, 1, 70.00, '2024-03-02 12:28:38', 'Cancelled', 'Tejas M', '847-478-4739', 'yo@gmail.com', '#123,yes yes'),
(12, 'Sprinkled Chocolate Donut', 90.00, 1, 90.00, '2024-03-04 21:56:29', 'Cancelled', 'Trivikrama', '977-894-9933', '123@gmail.com', 'B901,ADARSH RHYTHM'),
(13, 'Sprinkled Chocolate Donut', 90.00, 1, 90.00, '2024-03-04 21:57:52', 'Cancelled', 'Roopa Venu', '977-894-9933', '123@gmail.com', 'B901,ADARSH RHYTHM'),
(14, 'Black Forest Pastry', 60.00, 1, 60.00, '2024-03-04 21:59:38', 'Delivered', 'Sanjay', '847-478-4739', '213@gmail.com', 'B901,ADARSH RHYTHM'),
(15, 'Mc Chicken Maharaja Burger', 210.00, 1, 210.00, '2024-03-04 22:02:35', 'Delivered', 'Tejas V', '911-736-9833', 'r.venu@aiesl.in', 'B901,ADARSH RHYTHM'),
(21, 'Chocolate Chip Muffin', 70.00, 1, 70.00, '2024-03-04 22:25:31', 'Delivered', 'jane ', '977-894-9933', 'r.venu@aiesl.in', 'B901,ADARSH RHYTHM'),
(23, 'Chocolate Donut', 80.00, 1, 80.00, '2024-03-07 15:57:03', 'Delivered', 'Roopa Venu', '847-478-4739', 'r.venu@aiesl.in', 'B901,ADARSH RHYTHM'),
(24, 'Veggie Paradise', 329.00, 1, 329.00, '2024-03-07 16:04:09', 'Cancelled', 'Supreeth', '911-736-9833', 'r.venu@aiesl.in', 'B901,ADARSH RHYTHM'),
(25, 'Veggie Paradise', 329.00, 1, 329.00, '2024-03-07 16:05:50', 'Delivered', 'Tejas V', '911-736-9833', 'r.venu@aiesl.in', 'B901,ADARSH RHYTHM'),
(26, 'Mc Chicken Burger', 120.00, 1, 120.00, '2024-03-11 15:12:29', 'Delivered', 'jane ', '911-736-9833', 'r.venu@aiesl.in', 'B901,ADARSH RHYTHM'),
(27, 'Vanilla Muffin', 50.00, 2, 100.00, '2024-03-12 06:45:56', 'Delivered', 'Tejas M', '847-478-4739', 'tejas123@gmail.com', '#123,Jayanagar,Bangalore'),
(29, 'Indi Chicken Tikka Pizza', 429.00, 3, 1287.00, '2024-03-12 07:13:15', 'Delivered', 'Roopa Venu', '911-736-9833', 'r.venu@aiesl.in', 'B901,ADARSH RHYTHM'),
(30, 'Blueberry Muffin', 90.00, 1, 90.00, '2024-03-12 18:20:05', 'Delivered', 'Sanjay', '977-894-9933', 'vrtn2003@gmail.com', '123 Main Street, Bangalore'),
(31, 'Blueberry Cheescake', 140.00, 4, 560.00, '2024-03-12 22:55:28', 'Delivered', 'Thanmai GR', '911-736-9833', 'dumb@gmail.com', 'B901,ADARSH RHYTHM'),
(32, 'Indi Chicken Tikka Pizza', 429.00, 2, 858.00, '2024-03-13 11:28:18', 'Delivered', 'Tejas M', '847-478-4739', 'vrtn2003@gmail.com', 'B901,ADARSH RHYTHM'),
(33, 'Mc Veggie Burger', 100.00, 2, 200.00, '2024-03-13 11:52:59', 'Delivered', 'Tejas M', '674-345-9870', 'vrtn2003@gmail.com', 'B901,ADARSH RHYTHM'),
(35, 'Black Forest Pastry', 60.00, 2, 120.00, '2024-03-16 18:19:11', 'Delivered', 'Thanmai GR', '911-736-9833', 'r.venu@aiesl.in', 'B901,ADARSH RHYTHM'),
(36, 'Margharitta Pizza', 199.00, 2, 398.00, '2024-03-16 18:30:53', 'Delivered', 'Tejas V', '977-894-9933', 'venu_r4@hotmail.com', 'B901,ADARSH RHYTHM'),
(38, 'Hazelnut Donut', 95.00, 1, 95.00, '2024-03-17 16:25:17', 'ordered', 'harry', '1231231239', 'harry@gmail.com', 'new york home'),
(39, 'Chocolate Donut', 80.00, 3, 240.00, '2024-03-21 04:19:51', 'Delivered', 'yashas', '9999999999', 'xyz@gmail.com', 'rns institute of technology'),
(40, 'Margharitta Pizza', 199.00, 1, 199.00, '2024-03-21 15:04:58', 'ordered', 'RNsit', '1231231232', '1rn21cs183.yashasbn@gmail.com', 'Rnsit ');

--
-- Triggers `tbl_order`
--
DELIMITER $$
CREATE TRIGGER `insert_order` AFTER INSERT ON `tbl_order` FOR EACH ROW INSERT INTO recent_orders values(null,now(),"Order Placed")
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recent_orders`
--
ALTER TABLE `recent_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recent_orders`
--
ALTER TABLE `recent_orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
