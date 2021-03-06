-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Фев 25 2019 г., 13:42
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `kostovo`
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
  `photo_ads` mediumblob,
  `author_id` text,
  `favorites` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `favo`
--

CREATE TABLE `favo` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ads_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `feeback`
--

CREATE TABLE `feeback` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `text` text NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'Фамилия', 'text', 'surname', 'Введите фамилию\r\n', 'surname'),
(3, 'Пароль', 'password', 'exampleInputPassword1', 'Введите пароль', 'password1'),
(4, 'Пароль', 'password', 'exampleInputPassword2', 'Подтвердите пароль', 'password2'),
(5, 'Телефон', 'text', 'exampleInputPhone', 'Введите номер телефона', 'phone'),
(6, 'Почта', 'email', 'exampleInputEmail1', 'Введите электронную почту', 'email'),
(7, 'Адрес', 'text', 'add', 'Введите адрес ', 'address');

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
-- Структура таблицы `meta_title`
--

CREATE TABLE `meta_title` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `page` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `meta_title`
--

INSERT INTO `meta_title` (`id`, `title`, `page`) VALUES
(1, 'Главная страница о Кострово', '?page=main'),
(2, 'Новости о Кострово', '?page=news'),
(3, 'История', '?page=history'),
(4, 'Карта Кострово', '?page=maps'),
(5, 'Мероприятия Кострово', '?page=event'),
(6, 'Барахолка Кострово', '?page=market'),
(7, 'Обратная связь', '?page=contant'),
(8, 'Профиль пользователя ', '?page=profile'),
(9, 'Настройки пользователя', '?page=settings'),
(10, 'ИЗбранное пользователя', '?page=favourites'),
(11, 'Мои Объявления', '?page=ads'),
(12, 'Пользовательсообщения', '?page=message'),
(13, 'Подать объявление', '?page=give-ads');

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `users` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `token` text,
  `favorites` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Индексы таблицы `favo`
--
ALTER TABLE `favo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feeback`
--
ALTER TABLE `feeback`
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
-- Индексы таблицы `meta_title`
--
ALTER TABLE `meta_title`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `favo`
--
ALTER TABLE `favo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `feeback`
--
ALTER TABLE `feeback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `input_reg`
--
ALTER TABLE `input_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `meta_title`
--
ALTER TABLE `meta_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users_menu`
--
ALTER TABLE `users_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
