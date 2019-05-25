-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 25 2019 г., 14:39
-- Версия сервера: 5.7.23-log
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `game_cities`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `city_name`) VALUES
(1, 'Киев'),
(2, 'Харьков'),
(3, 'Одесса'),
(4, 'Днепр'),
(5, 'Донецк'),
(6, 'Запорожье'),
(7, 'Львов'),
(8, 'Кривой Рог'),
(9, 'Николаев'),
(10, 'Мариуполь'),
(11, 'Луганск'),
(12, 'Винница'),
(13, 'Макеевка'),
(14, 'Севастополь'),
(15, 'Симферополь'),
(16, 'Херсон'),
(17, 'Полтава'),
(18, 'Чернигов'),
(19, 'Черкассы'),
(20, 'Хмельницкий'),
(21, 'Житомир'),
(22, 'Черновцы'),
(23, 'Сумы'),
(24, 'Горловка'),
(25, 'Ровно'),
(26, 'Ивано-Франковск'),
(27, 'Каменское'),
(28, 'Кропивницкий'),
(29, 'Кременчуг'),
(30, 'Тернополь'),
(31, 'Луцк'),
(32, 'Белая Церковь'),
(33, 'Краматорск'),
(34, 'Мелитополь'),
(35, 'Керчь'),
(36, 'Ужгород'),
(37, 'Никополь'),
(38, 'Бердянск'),
(39, 'Славянск'),
(40, 'Алчевск'),
(41, 'Павлоград'),
(42, 'Северодонецк'),
(43, 'Евпатория'),
(44, 'Бровары'),
(45, 'Каменец-Подольский');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
