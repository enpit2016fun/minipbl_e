-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 年 8 朁E24 日 05:27
-- サーバのバージョン： 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_list`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `event`
--

CREATE TABLE `event` (
  `event_name` varchar(20) NOT NULL,
  `event_date` date NOT NULL,
  `event_img` varchar(20) NOT NULL,
  `event_text` text NOT NULL,
  `event_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='イベント一覧表';

--
-- テーブルのデータのダンプ `event`
--

INSERT INTO `event` (`event_name`, `event_date`, `event_img`, `event_text`, `event_number`) VALUES
('第1回運動会', '2016-08-01', 'forest.jpg', '運動会だー', 1),
('第1回バザー', '2016-08-02', 'forest.jpg', 'バザーだー', 2),
('第1回お祭り', '2016-08-03', 'forest.jpg', 'お祭りだー', 3),
('第1回花見', '2016-08-04', 'forest.jpg', '花見だー', 4),
('第1回卒園式', '2016-08-05', 'forest.jpg', '卒園式だー', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
