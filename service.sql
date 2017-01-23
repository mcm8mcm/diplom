-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2017 at 11:32 
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `serial` varchar(25) NOT NULL,
  `devicetype` varchar(45) NOT NULL,
  `brand` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `name` varchar(32) NOT NULL,
  `short_name` varchar(3) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `flag` varchar(128) DEFAULT NULL,
  `active` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`name`, `short_name`, `currency`, `flag`, `active`) VALUES
('english', 'eng', 'USD', 'system/include/img/flags/us.png', 1),
('russian', 'rus', 'RUB', 'system/include/img/flags/ru.png', 0),
('ukrainian', 'ukr', 'UAH', 'system/include/img/flags/ua.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(6) NOT NULL,
  `title` varchar(64) NOT NULL DEFAULT 'UNTITLED',
  `article` tinytext NOT NULL,
  `added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `article`, `added`) VALUES
(0, 'First article', '<h1>This is first test article</h1>', '2016-12-27 22:56:32'),
(1, 'Вторая статья', '<h1>Это вторая тестовая статья</h1>', '2016-12-27 22:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `name` varchar(128) NOT NULL,
  `value` varchar(256) NOT NULL DEFAULT 'DEFAULT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`name`, `value`) VALUES
('lang_all_default', 'english');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `idorder` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `close_date` date DEFAULT NULL,
  `device_id` int(11) NOT NULL,
  `device_condition` varchar(64) NOT NULL,
  `complaint` varchar(64) NOT NULL,
  `completeness` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_log`
--

CREATE TABLE `order_log` (
  `id` int(11) NOT NULL,
  `oreder_id` int(11) NOT NULL,
  `post_stamp` varchar(45) NOT NULL DEFAULT 'NOW()',
  `post_author` int(11) NOT NULL,
  `post_reciver` int(11) DEFAULT NULL,
  `post_title` varchar(64) DEFAULT 'Без заголовка',
  `post_content` varchar(255) NOT NULL DEFAULT 'Нечего написать'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `price_name` varchar(64) NOT NULL DEFAULT 'some_price',
  `price_desc` varchar(64) NOT NULL DEFAULT 'some_price',
  `lang_id` varchar(16) NOT NULL DEFAULT 'english',
  `file_name` varchar(45) NOT NULL DEFAULT 'default',
  `actual` int(1) NOT NULL DEFAULT '0',
  `codepage` varchar(8) NOT NULL DEFAULT 'UTF-8'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `price_name`, `price_desc`, `lang_id`, `file_name`, `actual`, `codepage`) VALUES
(1, 'Monitors', 'Monitor fixing price', 'english', 'prices/Price-Monitors.txt', 1, 'CP1251'),
(2, 'Мониторы', 'Прайс ремонта мониторов', 'russian', 'prices/Price-Monitors.txt', 1, 'CP1251'),
(3, 'Notebooks', 'Notebook fixing price', 'english', 'prices/Price-Notebooks.txt', 1, 'CP1251'),
(4, 'Ноутбуки', 'Прайс ремонта ноутбуков', 'russian', 'prices/Price-Notebooks.txt', 1, 'CP1251'),
(5, 'Smart phones', 'Smart phones fixing price', 'english', 'prices/Price-Smart-Phones.txt', 1, 'CP1251'),
(6, 'Смартфоны', 'Прайс ремонта смартфонов', 'russian', 'prices/Price-Smart-Phones.txt', 1, 'CP1251'),
(7, 'Tablet PC', 'Tablet PC''s fixing price', 'english', 'prices/Price-Tablet.txt', 1, 'CP1251'),
(8, 'Планшетные ПК', 'Прайс ремонта планшетных ПК', 'russian', 'prices/Price-Tablet.txt', 1, 'CP1251');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `patronymic` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL COMMENT 'Encrypted pwd',
  `pwd` varchar(64) NOT NULL COMMENT 'Not encrypted pwd',
  `email` varchar(64) DEFAULT NULL,
  `group` int(11) NOT NULL,
  `active` smallint(1) DEFAULT NULL,
  `session_id` varchar(45) NOT NULL DEFAULT '',
  `language` varchar(32) NOT NULL DEFAULT '',
  `reg_expired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `patronymic`, `last_name`, `login`, `password`, `pwd`, `email`, `group`, `active`, `session_id`, `language`, `reg_expired`) VALUES
(1, 'Morozov', 'Sergeevich', 'Mikhail', 'mcm', 'edf6f38dec4d68e43d05aaba6a6586bc', '784512', 'mcm_@mail.ru', 1, 1, 'i8j2eidsmdagvjgufs0npgps77', '', '2016-12-25 22:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `name`) VALUES
(1, 'admin'),
(3, 'customer'),
(2, 'master');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `id_serial` (`serial`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idorder`),
  ADD UNIQUE KEY `idorder_UNIQUE` (`idorder`),
  ADD KEY `idx_customer` (`customer_id`),
  ADD KEY `idx_device` (`device_id`);

--
-- Indexes for table `order_log`
--
ALTER TABLE `order_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `idx_order` (`oreder_id`),
  ADD KEY `idx_customer` (`post_author`,`post_reciver`),
  ADD KEY `fk_reciver_idx` (`post_reciver`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD KEY `index4` (`group`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_device` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_log`
--
ALTER TABLE `order_log`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`post_author`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`oreder_id`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reciver` FOREIGN KEY (`post_reciver`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_group` FOREIGN KEY (`group`) REFERENCES `user_group` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
