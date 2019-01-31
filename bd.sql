-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Янв 31 2019 г., 12:14
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `kostrobo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `vaul` varchar(255) NOT NULL,
  `price` tinyint(4) NOT NULL,
  `text` text NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `photo` mediumblob,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ads`
--

INSERT INTO `ads` (`id`, `title`, `vaul`, `price`, `text`, `date`, `photo`, `author_id`) VALUES
(1, 'Продам айпэд', 'Транспорт', 123, 'Аппарат практически новый. ipad air', '2019-01-23 17:23:22', NULL, NULL),
(2, 'yuyhytrtt', 'Транспорт', 123, 'укбьошоогтр типпирт ьтичсми мм', '2019-01-23 17:25:18', NULL, NULL),
(3, 'asdfdds', 'Транспорт', 123, 'ренекаргнекуцйеннщдж\r\nждлорпапаппека', '2019-01-24 12:36:22', 0x52556c454534333275784d2e6a7067, NULL),
(4, 'кенгнгн', 'Транспорт', 123, 'гнепрорпае\r\nорпрорпгдлор\r\nдлорпрр', '2019-01-24 12:46:19', NULL, NULL),
(5, 'wygffdfjg', 'Транспорт', 111, 'пирвавруакурка итуркаьам виаопавап ваааткнр', '2019-01-31 13:11:37', NULL, NULL);

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
(4, 'Пароль', 'password', 'exampleInputPassword2', 'Подтвердите пароль', 'password2');

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
(1, '?page=passwordto', 'Восстановить ', 'Забыли пароль?'),
(2, '?page=reg', 'Жмите сюда', 'Еще не зарегистрировались?');

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

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` text NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` mediumblob,
  `phone` varchar(255) DEFAULT NULL,
  `address` text,
  `users-id` int(11) DEFAULT NULL,
  `token` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `photo`, `phone`, `address`, `users-id`, `token`) VALUES
(1, 'Сергей', 'Слепенков', 'segasle@gmail.ccm', '$2y$10$UusrGyJnKaibjCuqvC1Lgej9dtsfNA3FCkBpig2Gf26SZyNbPRLtK', 0x52556c454534333275784d2e6a7067, '+7(915)954-37-12', 'Московская область', NULL, NULL),
(10, 'Сергей', 'Слепенков', 'segasle@gmail.com', NULL, 0x68747470733a2f2f70702e757365726170692e636f6d2f633834383632302f763834383632303133352f653832342f71514133746643303251412e6a70673f6176613d31, NULL, NULL, 176938709, '41da4670fcfe80ba6c7c721a0bb6495afc072c2da8255ef3d94a664a2cdcf9e5c9312f2d784e1c525550e');

-- --------------------------------------------------------

--
-- Структура таблицы `users_menu`
--

CREATE TABLE `users_menu` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '?page=',
  `title` text NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_menu`
--

INSERT INTO `users_menu` (`id`, `url`, `title`, `parent`) VALUES
(1, '?page=profile', 'Профиль', 0),
(2, '?page=settings', 'Настройки', 0),
(3, '?page=favourites', 'Избранное', 0),
(4, '?page=ads', 'Мои объявления', 0),
(5, '?page=message', 'Сообщения', 0),
(6, '?page=give-ads', 'Подать объявление', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_menu`
--
ALTER TABLE `users_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `input_reg`
--
ALTER TABLE `input_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `reg`
--
ALTER TABLE `reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `social_network`
--
ALTER TABLE `social_network`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users_menu`
--
ALTER TABLE `users_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;