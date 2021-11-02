-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 02 2021 г., 10:45
-- Версия сервера: 5.7.33
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `delaweb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211030164640', '2021-10-30 19:48:52', 351),
('DoctrineMigrations\\Version20211030170436', '2021-10-30 20:05:25', 327);

-- --------------------------------------------------------

--
-- Структура таблицы `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `organizations`
--

INSERT INTO `organizations` (`id`, `name`) VALUES
(5, 'Becker-Stanton'),
(4, 'Bergnaum, O\'Kon and Lesch'),
(10, 'Block, Price and Tremblay'),
(6, 'Boehm LLC'),
(1, 'Botsford, Von and Wuckert'),
(9, 'Davis, Stroman and Walter'),
(2, 'Hackett, Gutmann and Ferry'),
(7, 'Koelpin, Abshire and Stanton'),
(3, 'Walsh LLC'),
(8, 'White, Bahringer and Baumbach');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` int(11) NOT NULL,
  `organization` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `roles` json DEFAULT NULL,
  `created_at` date NOT NULL COMMENT '(DC2Type:date_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `host`, `organization`, `phone`, `roles`, `created_at`) VALUES
(1, 'Sienna', 'Koss', '$2y$10$BcqagqEr0ag/a8opgYSjSuquuEpuB3kOTtHXuzq0YTgyYhY6OtHCC', 3, 9, 5650753, '[]', '2021-11-01'),
(2, 'Robbie', 'Eichmann', '$2y$10$MPFh0hdLixpXGMOjoHP2GOJZ92iHEyVs8mEd3JjMWviWpekz2PyRO', 8, 1, 5240670, '[]', '2021-11-01'),
(3, 'Jazmyn', 'Carroll', '$2y$10$0s7akBBEQPlBw3EljknBUeia4MwHdS5FgBvX1lqRzeO4WKSfIQwXy', 8, 3, 7029928, '[]', '2021-11-01'),
(4, 'Jeffery', 'Tromp', '$2y$10$6f1Bp6K7uRYwws1bzr/3xOAlvt.o8yHz4Da71QAwNM/j1dVYCLXUm', 2, 6, 5590748, '[]', '2021-11-01'),
(5, 'Roxanne', 'Roob', '$2y$10$.QpGqMZx6GZWlXaoXk24D.tt3KFFrcd6L3aak78FrAcj2iwDrK5Oy', 6, 3, 2101516, '[]', '2021-11-01'),
(6, 'Lura', 'Cruickshank', '$2y$10$Y6oDhtEmSDLqQb.WoS9JCOtV/HukxYIobxqqdvVHgrQaikaT7SQZa', 1, 5, 2026802, '[]', '2021-11-01'),
(7, 'Kaya', 'O\'Kon', '$2y$10$wsRyFWDNPaZKX8f3y6DyhuQ5QdIf3kxqClj4c/.vV.d4nJ8cZ51Xa', 9, 6, 4905170, '[]', '2021-11-01'),
(8, 'Jaylen', 'Ledner', '$2y$10$DVhB7m.dnxwjZo1H42SWAOm8NkeBTKk/xnxhxNaOQWD1X6tntIwJG', 1, 5, 3348746, '[]', '2021-11-01'),
(9, 'Derick', 'Hilll', '$2y$10$IaC6mzjqaCv7vQRkRNL9k.3mZ6K/Cc3JeXTjnWRqKV5PmW/dSYxhW', 6, 3, 3410063, '[]', '2021-11-01'),
(10, 'Braulio', 'Altenwerth', '$2y$10$N3CjDWMV5/MK7oiS9VqQaOQwAe3SuSzEobGI9dTT8y8pC85LwFMtq', 5, 5, 1751159, '[]', '2021-11-01');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_427C1C7F5E237E06` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9444F97DD` (`phone`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
