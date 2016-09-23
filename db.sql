-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 23 2016 г., 03:47
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ssid` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`, `ssid`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '0034bed5925e168bc4c8725784d65cd4');

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `make` text NOT NULL,
  `model` text NOT NULL,
  `year` int(11) DEFAULT NULL,
  `VIN` text NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`id`, `make`, `model`, `year`, `VIN`, `idUser`) VALUES
(1, 'Kia', 'Sorento', 2003, '1FAHP26W49G252740', 1),
(2, 'Renault', 'Sandero', 2008, '1FAHP26W49G252526', 1),
(3, 'bmw', 'x6', 2014, '1FAHP26W49G299926', 2),
(11, 'Toyota', 'Camry', 2015, '1FAHP26W49G252577', 1),
(12, 'Mercedes-benz', 'GLE', 2016, '1FM5K7D86EGC54962', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `idCar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `date`, `amount`, `status`, `idCar`) VALUES
(1, '2016-02-02', 300, '1', 1),
(2, '2016-06-02', 777, '1', 2),
(3, '2016-04-02', 50, '1', 3),
(5, '2016-06-06', 555, '3', 2),
(6, '2016-09-20', 456, '2', 11),
(7, '2015-01-01', 896, '1', 11),
(8, '2016-08-08', 9000, '1', 12),
(9, '2016-09-20', 698, '2', 12),
(10, '2016-09-21', 58, '2', 12),
(11, '2016-05-05', 258, '1', 13),
(12, '2016-08-05', 7569, '3', 13),
(13, '2016-08-05', 7569, '3', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `dateOfBirth`, `address`, `phone`, `email`) VALUES
(1, 'Anna', 'Ivanova', '1996-06-06', '20 Sunny Street, Minsk,Belarus', '+375296585802', 'ivanova@gmail.com'),
(2, 'Mary', 'Petrova', '1995-05-17', '5 Independent Street, Minsk,Belarus', '+375296552508', 'petrova@gmail.com'),
(13, 'Alex', 'Smirnov', '1995-05-17', '20 Kolesnikova Street, Minsk,Belarus', '+375296552508', 'alex@gmail.com'),
(24, 'Denis', 'Latysgkin', '1996-04-06', '1 Melega street,Minsk', '375295895858', 'den@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
