-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 04 2020 г., 11:42
-- Версия сервера: 5.7.28-0ubuntu0.16.04.2
-- Версия PHP: 7.3.12-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `basket`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `in_stock` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `in_stock`, `created_at`, `updated_at`) VALUES
(1, 'Nokia 3.2', 3500, 10, 1, '2020-01-03 11:12:57', '2020-01-03 11:12:57'),
(2, 'Samsung A20', 4900, 30, 1, '2020-01-03 11:13:35', '2020-01-03 11:13:35'),
(3, 'Xiomi A7', 2800, 5, 1, '2020-01-03 11:13:57', '2020-01-03 11:13:57'),
(4, 'ZTE A7', 2300, 1, 0, '2020-01-03 11:14:14', '2020-01-03 11:14:14'),
(5, 'Card 8 Gb', 120, 5, 1, '2020-01-03 11:16:44', '2020-01-03 11:16:44'),
(6, 'Card 16 Gb', 216, 50, 1, '2020-01-03 11:17:12', '2020-01-03 11:17:12'),
(7, 'Card 32 GB', 315, 34, 1, '2020-01-03 11:17:34', '2020-01-03 11:17:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
