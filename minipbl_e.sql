-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 年 8 朁E24 日 04:16
-- サーバのバージョン： 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minipbl_e`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

CREATE TABLE `member` (
  `email` varchar(32) NOT NULL,
  `p_name` varchar(16) NOT NULL,
  `c_name` varchar(16) NOT NULL,
  `graduation_year` int(5) NOT NULL,
  `issend` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`email`, `p_name`, `c_name`, `graduation_year`, `issend`) VALUES
('g2116028@fun.ac.jp', '寺崎栞里', '寺崎葵', 2016, 1),
('hakodate@gmail.com', '未来太郎', '未来次郎', 2016, 0),
('kazama@fun.ac.jp', '風間よしみつ', '風間ちこりーた', 2016, 1),
('nakahara@gmail.com', '中原紫雲', '中原愛染', 2009, 1),
('terasaki@fun.ac.jp', '寺崎栞里', '寺崎結', 2014, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
