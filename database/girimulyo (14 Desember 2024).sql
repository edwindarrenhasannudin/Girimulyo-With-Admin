-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 07:14 AM
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
-- Database: `girimulyo`
--

-- --------------------------------------------------------

--
-- Table structure for table `commodities`
--

CREATE TABLE `commodities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commodities`
--

INSERT INTO `commodities` (`id`, `name`, `image`, `link`) VALUES
(1, 'Alpukat', 'asset/ALPUKAT.jpg', 'produk/alpukat.html'),
(2, 'Labu', 'asset/LABU.jpg', 'produk/labu.html'),
(3, 'Kelapa', 'asset/KELAPA.jpg', 'produk/kelapa.html'),
(4, 'Jagung', 'asset/JAGUNG.jpg', 'produk/jagung.html');

-- --------------------------------------------------------

--
-- Table structure for table `potensi`
--

CREATE TABLE `potensi` (
  `id` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potensi`
--

INSERT INTO `potensi` (`id`, `nama`) VALUES
(1, 'Alpukat'),
(2, 'Labu'),
(3, 'Jagung'),
(4, 'Singkong'),
(5, 'Pisang'),
(6, 'Coklat');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `title`, `content`) VALUES
(1, 'Profil Desa', 'Desa Girimulyo adalah desa agraris dengan kekayaan alam dan potensi besar di sektor pertanian dan perkebunan. Terletak di wilayah Lampung Timur, Desa Girimulyo memiliki lahan subur yang mendukung budidaya berbagai komoditas unggulan seperti alpukat, jagung, kelapa, labu, dan coklat. Selain itu, desa ini juga menjadi penghasil utama singkong dan pisang yang berkualitas tinggi.\r\n\r\nNamun, seperti desa agraris pada umumnya, Desa Girimulyo menghadapi beberapa tantangan dalam memperluas jaringan pasar. Desa Girimulyo adalah desa agraris dengan kekayaan alam dan potensi besar di sektor pertanian dan perkebunan. Terletak di wilayah Lampung Timur, Desa Girimulyo memiliki lahan subur yang mendukung budidaya berbagai komoditas unggulan seperti alpukat, jagung, kelapa, labu, dan coklat. Selain itu, desa ini juga menjadi penghasil utama singkong dan pisang yang berkualitas tinggi.\r\n\r\nNamun, seperti desa agraris pada umumnya, Desa Girimulyo menghadapi beberapa tantangan dalam memperluas jaringan pasar. Keterbatasan akses digital, promosi yang belum maksimal, serta kondisi infrastruktur transportasi yang kurang memadai sering kali menjadi kendala dalam meningkatkan visibilitas produk pertanian dan perkebunan lokal.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commodities`
--
ALTER TABLE `commodities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `potensi`
--
ALTER TABLE `potensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commodities`
--
ALTER TABLE `commodities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `potensi`
--
ALTER TABLE `potensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
