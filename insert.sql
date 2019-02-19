-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 19 2019 г., 21:41
-- Версия сервера: 5.5.25
-- Версия PHP: 5.4.42

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `banzai`
--

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(256) NOT NULL DEFAULT '',
  `pos_id` int(11) NOT NULL DEFAULT '0',
  `bd_year` int(11) NOT NULL COMMENT 'Год рождения',
  `sex` enum('0','1','2') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_id` (`pos_id`,`bd_year`,`sex`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `fio`, `pos_id`, `bd_year`, `sex`) VALUES
(1, 'Сотрудник 1', 1, 1980, '1'),
(2, 'Сотрудник 2', 2, 1981, '2'),
(3, 'Сотрудник 3', 3, 1982, '2');

-- --------------------------------------------------------

--
-- Структура таблицы `employees_groups`
--

DROP TABLE IF EXISTS `employees_groups`;
CREATE TABLE IF NOT EXISTS `employees_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`,`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `employees_groups`
--

INSERT INTO `employees_groups` (`id`, `employee_id`, `group_id`) VALUES
(5, 1, 1),
(6, 1, 2),
(7, 1, 3),
(8, 2, 1),
(9, 2, 2),
(10, 3, 1),
(11, 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Группа 1'),
(2, 'Группа 2'),
(3, 'Группа 3');

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'Должность 1'),
(2, 'Должность 2'),
(3, 'Должность 3');
