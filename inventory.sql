-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-08-19 13:47:33
-- 服务器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `inventory`
--

-- --------------------------------------------------------

--
-- 表的结构 `inventory_permissions`
--

CREATE TABLE `inventory_permissions` (
  `id` int(11) NOT NULL,
  `permissionsName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `inventory_permissions`
--

INSERT INTO `inventory_permissions` (`id`, `permissionsName`) VALUES
(1, 'super'),
(2, '超级管理员'),
(3, '管理员');

-- --------------------------------------------------------

--
-- 表的结构 `inventory_user`
--

CREATE TABLE `inventory_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `inventory_user`
--

INSERT INTO `inventory_user` (`id`, `username`, `password`) VALUES
(1, '李白', '123456'),
(2, '李白', '123456'),
(3, '李白', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `inventory_user_permissions_relationship`
--

CREATE TABLE `inventory_user_permissions_relationship` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `permissions_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `inventory_user_permissions_relationship`
--

INSERT INTO `inventory_user_permissions_relationship` (`id`, `user_id`, `permissions_id`) VALUES
(1, '1', '1'),
(2, '1', '2'),
(3, '2', '2');

--
-- 转储表的索引
--

--
-- 表的索引 `inventory_permissions`
--
ALTER TABLE `inventory_permissions`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `inventory_user`
--
ALTER TABLE `inventory_user`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `inventory_user_permissions_relationship`
--
ALTER TABLE `inventory_user_permissions_relationship`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `inventory_permissions`
--
ALTER TABLE `inventory_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `inventory_user`
--
ALTER TABLE `inventory_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `inventory_user_permissions_relationship`
--
ALTER TABLE `inventory_user_permissions_relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
