-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 年 8 朁E23 日 07:15
-- サーバのバージョン： 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staffsystem`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `m_group`
--

CREATE TABLE `m_group` (
  `group_cd` int(11) NOT NULL,
  `group_name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_group`
--

INSERT INTO `m_group` (`group_cd`, `group_name`) VALUES
(1, 'データ収集班'),
(2, 'Webアプリ班'),
(3, 'サーバ構築班'),
(8, 'データ収集班');

-- --------------------------------------------------------

--
-- テーブルの構造 `t_staff`
--

CREATE TABLE `t_staff` (
  `user_id` varchar(16) NOT NULL,
  `pw` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  `name_kana` varchar(16) NOT NULL,
  `group_cd` int(11) NOT NULL,
  `hobby` varchar(16) NOT NULL,
  `administrator` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `t_staff`
--

INSERT INTO `t_staff` (`user_id`, `pw`, `name`, `name_kana`, `group_cd`, `hobby`, `administrator`) VALUES
('account0', 'account0', '寺崎栞里', 'ﾃﾗｻｷｼｵﾘ', 1, 'ピアノ', 1),
('account1', 'account1', 'りんご', 'ﾘﾝｺﾞ', 1, 'りんごをたべる', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_group`
--
ALTER TABLE `m_group`
  ADD PRIMARY KEY (`group_cd`);

--
-- Indexes for table `t_staff`
--
ALTER TABLE `t_staff`
  ADD PRIMARY KEY (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
