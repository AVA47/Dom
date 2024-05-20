-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3305
-- Время создания: Май 25 2023 г., 12:55
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `egoist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cofe`
--

CREATE TABLE `cofe` (
  `cofe_id` int(11) NOT NULL,
  `cofe_img` varchar(25) DEFAULT NULL,
  `cofe_cost` int(11) NOT NULL,
  `cofe_name` varchar(25) NOT NULL,
  `cofe_info` varchar(2550) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cofe`
--

INSERT INTO `cofe` (`cofe_id`, `cofe_img`, `cofe_cost`, `cofe_name`, `cofe_info`) VALUES
(3, NULL, 99, 'Латте', 'В ИТАЛИИ ЛАТТЕ ГОТОВИТСЯ В ДОМАШНИХ УСЛОВИЯХ И ОБЫЧНО ПЬЁТСЯ ТОЛЬКО ДО ОБЕДА. ДЛЯ ИЗГОТОВЛЕНИЯ ЛАТТЕ ИСПОЛЬЗУЕТСЯ МОКА И ЧАШКА ПОДОГРЕТОГО МОЛОКА. ЧАЩЕ ВСЕГО ЛАТТЕ ГОТОВИТСЯ ИЗ ПОРЦИИ ЭСПРЕССО, КОТОРАЯ ЗАЛИВАЕТСЯ КАК ГОРЯЧИМ, ТАК И ХОЛОДНЫМ ВСПЕНЕННЫМ МОЛОКОМ. СООТНОШЕНИЕ ЭСПРЕССО, ВЗБИТОГО МОЛОКА И МОЛОЧНОЙ ПЕНЫ У ТАКОГО НАПИТКА, ЧТО ПОЗВОЛЯЕТ ПОЛУЧИТЬ НАИЛУЧШИЕ ВКУСОВЫЕ, АРОМАТИЧЕСКИЕ И ЭСТЕТИЧЕСКИЕ СВОЙСТВА НАПИТКА. ДЛЯ ПРИДАНИЯ ДОПОЛНИТЕЛЬНЫХ ВКУСОВЫХ ОЩУЩЕНИЙ, ПЕНКУ ЛАТТЕ ЧАСТО ПОСЫПАЮТ ДОБАВКАМИ: КОРИЦЕЙ, ШОКОЛАДОМ, ИЛИ ОРЕХОВОЙ КРОШКОЙ. ТАКЖЕ ПРИМЕНЯЮТ ДОБАВЛЕНИЕ СИРОПА АМАРЕТТО: ГУРМАНЫ УТВЕРЖДАЮТ, ЧТО СОЧЕТАНИЕ ГОРЬКОВАТОГО ВКУСА КОФЕ И ЛИКЕРА АМАРЕТТО НЕОБЫЧАЙНО ПИКАНТНО И НЕ ОСТАВИТ КОГО-ЛИБО РАВНОДУШНЫМ.');

-- --------------------------------------------------------

--
-- Структура таблицы `tovar`
--

CREATE TABLE `tovar` (
  `tovar_id` int(11) NOT NULL,
  `tovar_name` varchar(25) NOT NULL,
  `tovar_img` varchar(255) DEFAULT NULL,
  `tovar_cost` int(11) NOT NULL,
  `tovar_info` varchar(2500) NOT NULL,
  `tovar_img_cofe` varchar(250) NOT NULL,
  `tovar_img_cofe_2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovar`
--

INSERT INTO `tovar` (`tovar_id`, `tovar_name`, `tovar_img`, `tovar_cost`, `tovar_info`, `tovar_img_cofe`, `tovar_img_cofe_2`) VALUES
(1, 'Латте', 'product1.jpg', 99, 'В ИТАЛИИ ЛАТТЕ ГОТОВИТСЯ В ДОМАШНИХ УСЛОВИЯХ И ОБЫЧНО ПЬЁТСЯ ТОЛЬКО ДО ОБЕДА. ДЛЯ ИЗГОТОВЛЕНИЯ ЛАТТЕ ИСПОЛЬЗУЕТСЯ МОКА И ЧАШКА ПОДОГРЕТОГО МОЛОКА. ЧАЩЕ ВСЕГО ЛАТТЕ ГОТОВИТСЯ ИЗ ПОРЦИИ ЭСПРЕССО, КОТОРАЯ ЗАЛИВАЕТСЯ КАК ГОРЯЧИМ, ТАК И ХОЛОДНЫМ ВСПЕНЕННЫМ МОЛОКОМ. СООТНОШЕНИЕ ЭСПРЕССО, ВЗБИТОГО МОЛОКА И МОЛОЧНОЙ ПЕНЫ У ТАКОГО НАПИТКА, ЧТО ПОЗВОЛЯЕТ ПОЛУЧИТЬ НАИЛУЧШИЕ ВКУСОВЫЕ, АРОМАТИЧЕСКИЕ И ЭСТЕТИЧЕСКИЕ СВОЙСТВА НАПИТКА. ДЛЯ ПРИДАНИЯ ДОПОЛНИТЕЛЬНЫХ ВКУСОВЫХ ОЩУЩЕНИЙ, ПЕНКУ ЛАТТЕ ЧАСТО ПОСЫПАЮТ ДОБАВКАМИ: КОРИЦЕЙ, ШОКОЛАДОМ, ИЛИ ОРЕХОВОЙ КРОШКОЙ. ТАКЖЕ ПРИМЕНЯЮТ ДОБАВЛЕНИЕ СИРОПА АМАРЕТТО: ГУРМАНЫ УТВЕРЖДАЮТ, ЧТО СОЧЕТАНИЕ ГОРЬКОВАТОГО ВКУСА КОФЕ И ЛИКЕРА АМАРЕТТО НЕОБЫЧАЙНО ПИКАНТНО И НЕ ОСТАВИТ КОГО-ЛИБО РАВНОДУШНЫМ.', 'girl22.png', 'girl11.jpg'),
(2, 'Зелёный чай', 'product2.jpg', 110, 'Давным давно в далекой далекой галактике...', 'girl1.jpg', 'girl2.jpg'),
(3, 'Мокко', 'product3.jpg', 110, '', '', '0'),
(4, 'Латте', 'product3.jpg', 110, '', '', '0'),
(5, 'Моттто', 'product2.jpg', 99, '', '', '0'),
(6, 'Чай', 'product1.jpg', 87, '', '', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cofe`
--
ALTER TABLE `cofe`
  ADD PRIMARY KEY (`cofe_id`);

--
-- Индексы таблицы `tovar`
--
ALTER TABLE `tovar`
  ADD PRIMARY KEY (`tovar_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cofe`
--
ALTER TABLE `cofe`
  MODIFY `cofe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tovar`
--
ALTER TABLE `tovar`
  MODIFY `tovar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
