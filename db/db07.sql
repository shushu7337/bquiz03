-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-07-17 10:30:33
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db07`
--

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(1) UNSIGNED NOT NULL,
  `length` int(3) UNSIGNED NOT NULL,
  `ondate` date NOT NULL,
  `publish` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int(10) UNSIGNED NOT NULL,
  `sh` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `movie`
--

INSERT INTO `movie` (`id`, `name`, `level`, `length`, `ondate`, `publish`, `director`, `trailer`, `poster`, `intro`, `rank`, `sh`) VALUES
(4, '院線片04', 4, 90, '2022-07-15', '院線片04', '院線片04', '03B04.mp4', '03B04.png', '院線片04', 4, 1),
(5, '院線片05', 1, 90, '2020-07-16', '院線片05發行商', '院線片05導演', '03B05.mp4', '03B05.png', '院線片05介紹院線片05介紹院線片05介紹院線片05介紹院線片05介紹院線片06介紹院線片06介紹', 10, 1),
(6, '院線片66', 3, 66, '2020-07-17', '院線片66', '院線片66', '03B06.mp4', '03B06.png', '院線片66', 5, 1),
(7, '院線片07', 2, 90, '2020-07-18', '院線片07發行商', '院線片07導演', '03B07.mp4', '03B07.png', '院線片07介紹院線片07介紹院線片07介紹院線片07介紹院線片07介紹院線片08介紹院線片08介紹', 7, 1),
(8, '院線片08', 4, 90, '2020-07-16', '院線片08發行商', '院線片08導演', '03B08.mp4', '03B08.png', '院線片08介紹院線片08介紹院線片08介紹院線片08介紹院線片08介紹院線片09介紹院線片09介紹', 8, 1),
(9, '院線片09', 1, 90, '2020-07-17', '院線片09發行商', '院線片09導演', '03B09.mp4', '03B09.png', '院線片09介紹院線片09介紹院線片09介紹院線片09介紹院線片09介紹院線片10介紹院線片10介紹', 6, 1),
(10, '院線片10', 2, 90, '2020-07-14', '院線片10發行商', '院線片10導演', '03B10.mp4', '03B10.png', '院線片10介紹院線片10介紹院線片10介紹院線片10介紹院線片10介紹院線片10介紹院線片10介紹', 9, 1),
(11, '院線片11', 1, 90, '2020-07-11', '院線片11發行商', '院線片11導演', '03B01.mp4', '03B01.png', '院線片11介紹院線片11介紹院線片11介紹院線片11介紹院線片11介紹', 11, 1),
(12, '院線片12', 2, 90, '2020-07-13', '院線片12發行商', '院線片12導演', '03B02.mp4', '03B02.png', '院線片12介紹院線片12介紹院線片12介紹院線片12介紹院線片12介紹', 12, 1),
(13, '院線片13', 3, 90, '2020-07-14', '院線片13發行商', '院線片13導演', '03B03.mp4', '03B03.png', '院線片13介紹院線片13介紹院線片13介紹院線片13介紹院線片13介紹', 13, 1),
(14, '院線片14', 4, 90, '2020-07-15', '院線片14發行商', '院線片14導演', '03B04.mp4', '03B04.png', '院線片14介紹院線片14介紹院線片14介紹院線片14介紹院線片14介紹', 14, 1),
(15, '院線片15', 1, 90, '2020-07-16', '院線片15發行商', '院線片15導演', '03B05.mp4', '03B05.png', '院線片15介紹院線片15介紹院線片15介紹院線片15介紹院線片15介紹', 15, 1),
(16, '院線片16', 3, 90, '2020-07-17', '院線片16發行商', '院線片16導演', '03B06.mp4', '03B06.png', '院線片16介紹院線片16介紹院線片16介紹院線片16介紹院線片16介紹', 17, 1),
(17, '院線片17', 2, 90, '2022-07-18', '院線片17發行商', '院線片17導演', '03B07.mp4', '03B07.png', '院線片17介紹院線片17介紹院線片17介紹院線片17介紹院線片17介紹', 16, 1),
(20, '院線片20', 2, 90, '2020-07-14', '院線片20發行商', '院線片20導演', '03B10.mp4', '03B10.png', '院線片20介紹院線片20介紹院線片20介紹院線片20介紹院線片20介紹', 20, 1),
(21, 'aaa', 3, 0, '2020-07-17', 'aaa', 'aaa', '03B01v.mp4', '03B03.png', 'aaa', 21, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路徑',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '檔案名稱',
  `rank` int(10) UNSIGNED NOT NULL COMMENT '順序',
  `sh` int(1) UNSIGNED NOT NULL,
  `ani` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `path`, `name`, `rank`, `sh`, `ani`) VALUES
(1, '03A01.jpg', '123', 1, 1, 4),
(2, '03A02.jpg', '', 2, 1, 4),
(5, '03A03.jpg', '1321312', 3, 1, 4),
(6, '03A04.jpg', '預告片04', 4, 1, 4),
(7, '03A05.jpg', '預告片05', 5, 1, 4),
(8, '03A06.jpg', '預告片06', 6, 1, 4),
(9, '03A07.jpg', '預告片07', 7, 1, 4),
(10, '03A08.jpg', '預告片08', 8, 1, 4);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
