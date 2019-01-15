-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Янв 15 2019 г., 15:49
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `kostrobo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `input_reg`
--

CREATE TABLE `input_reg` (
  `id` int(11) NOT NULL,
  `placeholder` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `for` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `input_reg`
--

INSERT INTO `input_reg` (`id`, `placeholder`, `type`, `for`, `text`, `name`) VALUES
(1, 'Имя', 'text', 'exampleInputName', 'Введите имя', 'name'),
(2, 'Почта', 'email', 'exampleInputEmail1', 'Введите электронную почту', 'email'),
(3, 'Пароль', 'password', 'exampleInputPassword1', 'Введите пароль', 'password1'),
(4, 'Пароль', 'password', 'exampleInputPassword2', 'Подтвердите пароль', 'password2'),
(5, '', 'checkbox', '', 'Вы должны согласиться со правами на передачу данных ', '');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '?page=',
  `title` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `url`, `title`, `parent`) VALUES
(1, '?page=main', 'Главная', 0),
(2, '?page=news', 'Новости', 0),
(3, '?page=history', 'Истории ', 0),
(4, '?page=maps', 'Карта', 0),
(5, '?page=event', 'Мероприятия ', 0),
(6, '?page=market', 'Барахолка', 0),
(7, '?page=contant', 'Контакты', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `reg`
--

CREATE TABLE `reg` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '?page=',
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reg`
--

INSERT INTO `reg` (`id`, `url`, `title`, `description`) VALUES
(1, '?page=reg', 'Жмите сюда', 'Еще не зарегистрировались?');

-- --------------------------------------------------------

--
-- Структура таблицы `social_network`
--

CREATE TABLE `social_network` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `social_network`
--

INSERT INTO `social_network` (`id`, `url`, `class`) VALUES
(1, 'https://ok.ru/profile/522349619246', 'icon_ok'),
(2, 'https://www.instagram.com/segasle1998/?hl=ru', 'icon_instagram'),
(3, 'https://www.facebook.com/segasle', 'icon_facebook'),
(4, 'https://vk.com/serg_slepenkov', 'icon_vk');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `input_reg`
--
ALTER TABLE `input_reg`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_network`
--
ALTER TABLE `social_network`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `input_reg`
--
ALTER TABLE `input_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `reg`
--
ALTER TABLE `reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `social_network`
--
ALTER TABLE `social_network`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
