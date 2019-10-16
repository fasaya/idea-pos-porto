-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2019 at 12:51 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idea_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_assignment`
--

CREATE TABLE `tb_assignment` (
  `id_assignment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_assignment`
--

INSERT INTO `tb_assignment` (`id_assignment`, `id_user`, `id_outlet`) VALUES
(1, 3, 1),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `is_verified` enum('0','1') NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `is_deletable` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id_login`, `id_role`, `email`, `pwd`, `is_verified`, `is_active`, `is_deletable`) VALUES
(2, 1, 'aya_maruf@yahoo.com', '12345', '1', '1', '0'),
(3, 3, 'andifasaya@gmail.com', '12345', '1', '1', '1'),
(4, 3, 'fasayaa@yahoo.com', '', '0', '1', '1'),
(5, 3, 'fasayayaqhsya@gmail.com', '', '0', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id_outlet` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `postal` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id_outlet`, `nama`, `address`, `phone`, `provinsi`, `kota`, `kecamatan`, `postal`) VALUES
(1, 'Outlet 1', 'Jalan Toddopuli X', '0411 2345678', 'Sulawesi Selatan', 'Makassar', 'Rappocini', '90222');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `id_item` int(11) NOT NULL,
  `id_kategoti` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_category`
--

CREATE TABLE `tb_product_category` (
  `id_category` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_mod_opt`
--

CREATE TABLE `tb_product_mod_opt` (
  `id_mod_opt` int(11) NOT NULL,
  `id_mod_set` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_mod_set`
--

CREATE TABLE `tb_product_mod_set` (
  `id_mod_set` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_type`
--

CREATE TABLE `tb_product_type` (
  `id_type` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deletable` enum('1','0') NOT NULL,
  `b_dashboard` enum('1','0') NOT NULL,
  `b_reports` enum('0','1') NOT NULL,
  `b_library` enum('0','1') NOT NULL,
  `b_inventory` enum('0','1') NOT NULL,
  `b_customer` enum('1','0') NOT NULL,
  `b_employee` enum('1','0') NOT NULL,
  `b_acc_setting` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `name`, `is_deletable`, `b_dashboard`, `b_reports`, `b_library`, `b_inventory`, `b_customer`, `b_employee`, `b_acc_setting`) VALUES
(1, 'Superadmin', '0', '1', '1', '1', '1', '1', '1', '1'),
(2, 'Admin', '1', '0', '1', '1', '1', '1', '1', '1'),
(3, 'Dashboard Only', '1', '0', '0', '0', '0', '1', '1', '1'),
(7, 'Others', '1', '1', '1', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `deskripsi` mediumtext,
  `pin` varchar(10) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_login`, `nama`, `phone`, `deskripsi`, `pin`, `status`) VALUES
(1, 2, 'Andi Fasaya', '0811415779', '', '', '1'),
(2, 3, 'Aminah', '08114608579', '', '', '1'),
(3, 4, 'Irfan Ibnu', '811415779', '', '', '1'),
(4, 5, 'Amar', '0811415779', '', '', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_assignment`
--
ALTER TABLE `tb_assignment`
  ADD PRIMARY KEY (`id_assignment`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `id_user` (`id_role`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_kategoti` (`id_kategoti`);

--
-- Indexes for table `tb_product_category`
--
ALTER TABLE `tb_product_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `tb_product_mod_opt`
--
ALTER TABLE `tb_product_mod_opt`
  ADD PRIMARY KEY (`id_mod_opt`),
  ADD KEY `id_mod_set` (`id_mod_set`);

--
-- Indexes for table `tb_product_mod_set`
--
ALTER TABLE `tb_product_mod_set`
  ADD PRIMARY KEY (`id_mod_set`);

--
-- Indexes for table `tb_product_type`
--
ALTER TABLE `tb_product_type`
  ADD PRIMARY KEY (`id_type`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_login_2` (`id_login`),
  ADD KEY `id_login` (`id_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_assignment`
--
ALTER TABLE `tb_assignment`
  MODIFY `id_assignment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_product_category`
--
ALTER TABLE `tb_product_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_product_mod_opt`
--
ALTER TABLE `tb_product_mod_opt`
  MODIFY `id_mod_opt` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_product_mod_set`
--
ALTER TABLE `tb_product_mod_set`
  MODIFY `id_mod_set` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_product_type`
--
ALTER TABLE `tb_product_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_assignment`
--
ALTER TABLE `tb_assignment`
  ADD CONSTRAINT `tb_assignment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_assignment_ibfk_2` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`);

--
-- Constraints for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD CONSTRAINT `tb_login_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id_role`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `tb_login` (`id_login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
