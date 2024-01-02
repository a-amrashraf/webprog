-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 03:14 PM
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
-- Database: `businessdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_items`
--

CREATE TABLE `delivery_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_items`
--

INSERT INTO `delivery_items` (`id`, `product_id`, `description`, `price`, `quantity`, `address`, `city`, `zip`, `created_at`, `username`) VALUES
(27, 103, 'Hankook tire\r\n', 3870.00, 3, 'sssss', 'sssssssss', 'ssssssssss', '2023-12-29 12:09:33', 'omar'),
(28, 303, 'Bosch Car Battery - TD70 - 12/62 AH\r\n', 2500.00, 1, 'sssss', 'sssssssss', 'ssssssssss', '2023-12-29 12:09:33', 'omar'),
(29, 303, 'Bosch Car Battery - TD70 - 12/62 AH\r\n', 2500.00, 3, 'bev', 'giza', '123', '2023-12-29 13:41:17', 'omar'),
(30, 302, 'Bosch Car Battery - AGM 105L - 12/105 AH\r\n', 11600.00, 1, 'v', 'sssssssss', 'ssssssssss', '2023-12-29 13:43:51', 'omar');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `description`, `price`, `image_url`) VALUES
(101, 'achilles tire', 3400.00, 'https://ghataty.com/web/image/1324/0%20ATR-Sport.png'),
(102, 'Dunlop tire\r\n', 3300.00, 'https://www.blackcircles.com.eg/upload/blackcircles/profiles/bc_eg/ENASAVE-EC300-plus/small.png'),
(103, 'Hankook tire\r\n', 3870.00, 'https://ghataty.com/web/image/1341/z222%20ghataty.png'),
(104, 'Continental Tire\r\n', 4500.00, 'https://eg.continental-me.com/storage/patterns/June2023/gS7w96kbRb4NIrK81Vyg.webp'),
(105, 'Bridgestone Tire\r\n', 4300.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/f/i/fit_fix_bridgestone_turanza_t005_1__12_1.jpg'),
(106, 'Goodride Tire\r\n', 3600.00, 'https://www.blackcircles.com.eg/upload/blackcircles/profiles/bc_eg/goodridRp88/small.jpg'),
(107, 'Pirelli Tire\r\n', 4090.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/p/7/p7cint_side_5_1.jpg'),
(108, 'Kumho Tire\r\n', 3450.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/f/i/fit_fix_kumho_solus_ta31_1__3_1_1.jpg'),
(109, 'Michellin Tire\r\n', 4750.00, 'https://ghataty.com/web/image/1369/Pilot%20Super%20Sport.jpg'),
(110, 'test', 69.60, '6999'),
(111, 'delete', 9.00, 'k'),
(201, 'Shell Helix Ultra Motor Oil - 5W-30 - 4 Liters', 1300.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/s/h/shell_helix_ultra_motor_oil_-_5w-30_-_4_liters_1_.jpg'),
(202, 'Shell Helix HX6 Motor Oil - 15W-50 - 4 Liters', 700.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/s/h/shell_helix_hx6_motor_oil_-_15w-50_-_4_liters_1_.jpg'),
(203, 'Shell Helix Ultra Motor Oil - 5W-30 - 1 Liter\r\n', 400.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/s/h/shell_helix_ultra_motor_oil_-_5w-30_-_1_liter_1_.jpg'),
(204, 'Mobil 1 FSX1 Motor Oil - 5W-40 - 4 Liters\r\n', 1250.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/m/o/mobil_1_fsx1_motor_oil_-_5w-40_-_4_liters_1_.jpg'),
(205, 'Mobil 1 X1 Motor Oil - 5W-30 - 4 Liters\r\n', 1200.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/m/o/mobil_1_x1_motor_oil_-_5w-30_-_4_liters_1_.jpg'),
(206, 'Mobil 1 FSX1 Motor Oil - 5W-40 - 1 Liter\r\n', 350.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/m/o/mobil_1_fsx1_motor_oil_-_5w-40_-_1_liter_1_.jpg'),
(207, 'Leichtlauf High Tech - 5W - 40 - 4L\r\n ', 1600.00, 'https://www.liqui-moly-eg.com/images/virtuemart/product/resized/2595_1619590698585_ctx-1_400x300.jpg'),
(208, 'Molygen New Gen - 5W - 30 - 4L\r\n', 1700.00, 'https://www.liqui-moly-eg.com/images/virtuemart/product/resized/9089_1620303910297_ctx-1_400x300.jpg'),
(209, 'Leichtlauf High Tech - 5W - 40 - 1L\r\n', 450.00, 'https://www.liqui-moly-eg.com/images/virtuemart/product/resized/3863_1619591551555_ctx-1_400x300.jpg'),
(301, 'Bosch Car Battery - DIN55L - 12/56 AH\r\n', 2600.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/b/o/bosch_car_battery_regular_2_1.jpg'),
(302, 'Bosch Car Battery - AGM 105L - 12/105 AH\r\n', 11600.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/b/o/bosch_car_battery_agm.jpg'),
(303, 'Bosch Car Battery - TD70 - 12/62 AH\r\n', 2500.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/b/o/bosch_car_battery_regular_ns_1.jpg'),
(304, 'Chloride Platinum Car Battery - DIN70L 12/70 AH R\r\n', 4700.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/c/h/chloride_platinum_car_battery_1.jpg'),
(305, 'Chloride Gold Car Battery - NS60SL - 45 AH\r\n', 2350.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/s/h/shutterstock_1138114859_14_1.png'),
(306, 'Chloride Gold Car Battery - DIN100L 12/100 AH\r\n', 4600.00, 'https://be.fitandfix.com/media/catalog/product/cache/97fabc546d2859ba137aa538c4251d72/s/h/shutterstock_1138114859.png'),
(307, 'ACDelco Car Battery - 74Ah - DIN74 - R\r\n', 5000.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/f/i/fit_fix_acdelco_car_battery_din74_r_74ah_1_.jpg'),
(308, 'ACDelco Car Battery - 45Ah - NS60L - R\r\n', 3100.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/a/c/acdelco_car_battery_6.jpg'),
(309, 'ACDelco Car Battery - 35Ah - NS40ZL - R\r\n', 2900.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/f/i/fit_fix_acdelco_car_battery_ns40zl_r_35ah_1_.jpg'),
(401, 'OIL change - service\r\n', 80.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/o/i/oil_change.jpg'),
(402, 'Air tires inflation - service \"4 tires\"\r\n', 20.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/n/i/nitrogen_tires_inflation_-_service_1_1_1_1_1_1_1_1.jpg'),
(403, 'Nitrogen tires inflation - service \"4 tires\"\r\n', 65.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/n/i/nitrogen_tires_inflation_-_service_1_1_1_1_1_1_1_1.jpg'),
(404, 'Battery checkup - service\r\n', 150.00, 'https://be.fitandfix.com/media/catalog/product/cache/d529207e052fabc1dfaf9fd3b91343a7/b/a/battery_checkup_service.jpg'),
(405, 'Tire balancing - service, runflat \"4 tires\"\r\n', 400.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4zyFDsTceyDbFMAIX1v_8YyALdDXSeDd73g&usqp=CAU'),
(406, 'Tire balancing - service, regular \"4 tires\"\r\n', 300.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4zyFDsTceyDbFMAIX1v_8YyALdDXSeDd73g&usqp=CAU'),
(407, 'Tire Repair - service, Runflat \"1 tire\"\r\n', 120.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrFkSGN2ANO36MV_xd2xKHzmxT1TyZ698K9Q&usqp=CAU'),
(408, 'Tire repair - service, Regular \"1 tire\"\r\n', 100.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrFkSGN2ANO36MV_xd2xKHzmxT1TyZ698K9Q&usqp=CAU'),
(409, 'Car detailing - service\r\n', 200.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqsjXCeRCN04HxKqn1ydihAHgXdgKDFYgp6A&usqp=CAU'),
(501, 'Car Bluetooth Device', 50.00, 'https://eg.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/48/494224/1.jpg?5510'),
(502, 'Car Refreshener', 25.00, 'https://www.littletrees.com/sites/default/files/styles/full_media_background/public/2022-11/FIBER-CAN_3840X1504.jpg?itok=rEoug7QQ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(22) NOT NULL,
  `Gender` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `Username`, `Password`, `Email`, `Gender`) VALUES
(1, 'omar', 'omar', 'omar@omar', 'Male'),
(2, 'hemoooooooo', 'hemo12', 'hemo1234@gmail.com', 'Female'),
(3, 'booooooooob', 'bob123', 'bob@my', 'Male'),
(4, 'tatatata', 'tata123', 'tata@tata', 'Male'),
(5, 'test123', 'test123', 'test@test', 'Female'),
(6, 'test123', 'test123', 'test@test', 'Female'),
(7, 'test123', 'test123', 'test@test', 'Female'),
(8, 'Amr Ashraf', 'amr123', 'amr@123', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_items`
--
ALTER TABLE `delivery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `delivery_items`
--
ALTER TABLE `delivery_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
