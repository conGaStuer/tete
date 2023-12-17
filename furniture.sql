-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 02:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` char(255) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `reg_date`) VALUES
(1, 'admin', '123456', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `item_price` int(25) NOT NULL,
  `item_tag` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `item_name`, `image`, `item_price`, `item_tag`) VALUES
(4, 'Minimal Chair', 'https://img.freepik.com/free-photo/green-sofa-white-living-room-with-free-space_43614-834.jpg?w=900&t=st=1695217558~exp=1695218158~hmac=6b8e8c5035617eacdd8655ac34a0d53f560e503b8058f106b06cf4e1eefe303c', 851, 'chair'),
(6, '2 Seater Sofa', 'https://img.freepik.com/free-photo/gray-sofa-white-living-room-interior-with-copy-space-3d-rendering_43614-802.jpg?w=1060&t=st=1695217641~exp=1695218241~hmac=e38892dc8d83b861caf53ff7103dade6c12d03891b2da3f3302a5ebfde1d639a', 245, 'chair');

-- --------------------------------------------------------

--
-- Table structure for table `furnitures`
--

CREATE TABLE `furnitures` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(255) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furnitures`
--

INSERT INTO `furnitures` (`id`, `username`, `password`, `reg_date`) VALUES
(1, 'hello', '123456', '0000-00-00 00:00:00'),
(2, 'yasuo', '1', '0000-00-00 00:00:00'),
(3, 'xinchao', '123456', '0000-00-00 00:00:00'),
(4, 'yone', '123456', '0000-00-00 00:00:00'),
(5, 'sasuke', '123456', '0000-00-00 00:00:00'),
(6, 'qqqqqq', '123456', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `furnitures_item`
--

CREATE TABLE `furnitures_item` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` varchar(255) NOT NULL,
  `item_tag` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furnitures_item`
--

INSERT INTO `furnitures_item` (`id`, `image`, `item_name`, `item_price`, `item_tag`) VALUES
(1, 'https://img.freepik.com/free-photo/gray-sofa-brown-living-room-with-copy-space_43614-954.jpg?w=900&t=st=1695216791~exp=1695217391~hmac=b498a4acec3c6c910ec306ff56afc5cb685daf332b6b1c98fa7f764fcecaf723', '1 BHK Royal Package for Bachelors', '564', 'package'),
(2, 'https://img.freepik.com/free-photo/picture-frame-wall-with-scandinavian-home-interior_53876-139779.jpg?w=996&t=st=1695216905~exp=1695217505~hmac=93fcaa1ca4e8c915de3afd301bc7c3bbbf1a97ea0f4f6c578f195d6c58cdce55', '1 BHK Royal Package for Partners', '5111', 'package'),
(3, 'https://img.freepik.com/free-photo/mid-century-modern-living-room-interior-design-with-monstera-tree_53876-129803.jpg?w=996&t=st=1695217528~exp=1695218128~hmac=eaf10f9a817c0b4f49144b2a01b66e10c228e499e48772885125943f879af64e', '1 BHK Royal Package for Family', '1615', 'package'),
(4, 'https://img.freepik.com/free-photo/green-sofa-white-living-room-with-free-space_43614-834.jpg?w=900&t=st=1695217558~exp=1695218158~hmac=6b8e8c5035617eacdd8655ac34a0d53f560e503b8058f106b06cf4e1eefe303c', 'Minimal Chair', '851', 'chair'),
(5, 'https://img.freepik.com/free-photo/gray-sofa-white-living-room-interior-with-copy-space-3d-rendering_43614-802.jpg?w=1060&t=st=1695217641~exp=1695218241~hmac=e38892dc8d83b861caf53ff7103dade6c12d03891b2da3f3302a5ebfde1d639a', '2 Seater Sofa', '561', 'chair'),
(6, 'https://img.freepik.com/free-psd/realistic-bright-modern-double-bedroom-with-furniture_176382-456.jpg?w=1060&t=st=1695217879~exp=1695218479~hmac=0d6527225f3e3fc71583552f20ccbe69106afe793acc2ec508d547423e3c2c49', 'Bedroom for Partners', '1120', 'room'),
(7, 'https://img.freepik.com/free-photo/minimalist-modern-white-kitchen-with-wooden-floor-natural-light-interior-design-ai-generative_123827-23490.jpg?w=996&t=st=1695217921~exp=1695218521~hmac=00b022cd3704c4fc03cd5c22bd28c2f8d59cba32cfe315761363b06ddbcb12a3', 'Kitchen Room for Family', '1221', 'room'),
(8, 'https://img.freepik.com/free-photo/business-desk-concept-with-laptop_23-2149073032.jpg?w=996&t=st=1695218061~exp=1695218661~hmac=9269cea2e4e4a1d5f92a54198ffaadd1c3ed574fabd54d3254c1adf1e68fa603', 'Computer Table', '1000', 'table');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `item_price` int(25) NOT NULL,
  `item_tag` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item_name`, `image`, `item_price`, `item_tag`) VALUES
(1, '  1 BHK Royal Package for Bachelors', '  https://img.freepik.com/free-photo/gray-sofa-brown-living-room-with-copy-space_43614-954.jpg?w=900&t=st=1695216791~exp=1695217391~hmac=b498a4acec3c6c910ec306ff56afc5cb685daf332b6b1c98fa7f764fcecaf723  ', 564, 'package'),
(2, '1 BHK Royal Package for Partners', 'https://img.freepik.com/free-photo/picture-frame-wall-with-scandinavian-home-interior_53876-139779.jpg?w=996&t=st=1695216905~exp=1695217505~hmac=93fcaa1ca4e8c915de3afd301bc7c3bbbf1a97ea0f4f6c578f195d6c58cdce55', 5111, 'package'),
(3, ' 1 BHK Royal Package for Family', ' https://img.freepik.com/free-photo/mid-century-modern-living-room-interior-design-with-monstera-tree_53876-129803.jpg?w=996&t=st=1695217528~exp=1695218128~hmac=eaf10f9a817c0b4f49144b2a01b66e10c228e499e48772885125943f879af64e ', 1615, 'package'),
(4, 'Minimal Chair', 'https://img.freepik.com/free-photo/green-sofa-white-living-room-with-free-space_43614-834.jpg?w=900&t=st=1695217558~exp=1695218158~hmac=6b8e8c5035617eacdd8655ac34a0d53f560e503b8058f106b06cf4e1eefe303c', 851, 'chair'),
(5, '1 BHK Royal Package for Families', 'https://img.freepik.com/free-photo/stylish-scandinavian-living-room-with-design-mint-sofa-furnitures-mock-up-poster-map-plants-eleg_1258-152155.jpg?w=1380&t=st=1695217600~exp=1695218200~hmac=82c630ab2515c3afb39d8ad650f209b371e0ff446a784f06f45c2b8adeda2540', 616, 'package'),
(6, '2 Seater Sofa', 'https://img.freepik.com/free-photo/gray-sofa-white-living-room-interior-with-copy-space-3d-rendering_43614-802.jpg?w=1060&t=st=1695217641~exp=1695218241~hmac=e38892dc8d83b861caf53ff7103dade6c12d03891b2da3f3302a5ebfde1d639a', 245, 'chair'),
(7, 'Velvet Armchair', 'https://img.freepik.com/free-photo/picture-frame-by-velvet-armchair_53876-132788.jpg?w=360&t=st=1695217691~exp=1695218291~hmac=cea71c1c1db963f3752e36dd1fa50b3d7f382a76a6981d9d72043274f3e57bad', 313, 'chair'),
(8, 'Bedroom for Partners', 'https://img.freepik.com/free-psd/realistic-bright-modern-double-bedroom-with-furniture_176382-456.jpg?w=1060&t=st=1695217879~exp=1695218479~hmac=0d6527225f3e3fc71583552f20ccbe69106afe793acc2ec508d547423e3c2c49', 1120, 'room'),
(9, 'Computer Table', 'https://img.freepik.com/free-photo/business-desk-concept-with-laptop_23-2149073032.jpg?w=996&t=st=1695218061~exp=1695218661~hmac=9269cea2e4e4a1d5f92a54198ffaadd1c3ed574fabd54d3254c1adf1e68fa603', 1000, 'table'),
(10, 'Bed for Partners', 'https://img.freepik.com/free-photo/beautiful-bed-middle-bedroom_23-2148982015.jpg?size=626&ext=jpg&uid=R116779415&ga=GA1.2.1510566008.1693293482&semt=sph', 552, 'room');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `furnitures`
--
ALTER TABLE `furnitures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `furnitures_item`
--
ALTER TABLE `furnitures_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_name` (`item_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_name` (`item_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `furnitures`
--
ALTER TABLE `furnitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
