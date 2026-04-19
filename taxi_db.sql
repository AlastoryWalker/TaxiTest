-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 19 2026 г., 08:24
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `taxi_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `color` varchar(30) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`car_id`, `license_plate`, `brand`, `model`, `year`, `color`, `is_active`) VALUES
(1, 'А123БВ777', 'Toyota', 'Camry', 2022, 'Черный', 1),
(2, 'Б234ГД777', 'Hyundai', 'Solaris', 2021, 'Белый', 1),
(3, 'В345ДЕ777', 'Kia', 'Rio', 2023, 'Серебристый', 1),
(4, 'Г456ЖЗ777', 'Volkswagen', 'Polo', 2020, 'Синий', 1),
(5, 'Д567ИК777', 'Skoda', 'Rapid', 2022, 'Красный', 1),
(6, 'Е678ЛМ777', 'Renault', 'Logan', 2021, 'Бежевый', 1),
(7, 'Ж789НО777', 'Nissan', 'Almera', 2023, 'Черный', 1),
(8, 'З890ПР777', 'Chevrolet', 'Cruze', 2020, 'Белый', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT 5.0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `drivers`
--

INSERT INTO `drivers` (`driver_id`, `full_name`, `phone`, `license_number`, `rating`, `created_at`) VALUES
(1, 'Александров Александр Александрович', '+79261111111', 'DL-001-2020', 4.9, '2026-04-19 04:24:56'),
(2, 'Борисов Борис Борисович', '+79262222222', 'DL-002-2019', 4.7, '2026-04-19 04:24:56'),
(3, 'Викторов Виктор Викторович', '+79263333333', 'DL-003-2021', 5.0, '2026-04-19 04:24:56'),
(4, 'Григорьев Григорий Григорьевич', '+79264444444', 'DL-004-2018', 4.5, '2026-04-19 04:24:56'),
(5, 'Дмитриев Дмитрий Дмитриевич', '+79265555555', 'DL-005-2022', 4.8, '2026-04-19 04:24:56'),
(6, 'Егоров Егор Егорович', '+79266666666', 'DL-006-2020', 4.6, '2026-04-19 04:24:56'),
(7, 'Жуков Жука Жукович', '+79267777777', 'DL-007-2019', 4.9, '2026-04-19 04:24:56'),
(8, 'Захаров Захар Захарович', '+79268888888', 'DL-008-2021', 4.7, '2026-04-19 04:24:56');

-- --------------------------------------------------------

--
-- Структура таблицы `driver_car_assignments`
--

CREATE TABLE `driver_car_assignments` (
  `assignment_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` timestamp NULL DEFAULT NULL,
  `is_current` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `driver_car_assignments`
--

INSERT INTO `driver_car_assignments` (`assignment_id`, `driver_id`, `car_id`, `start_date`, `end_date`, `is_current`) VALUES
(1, 1, 1, '2025-01-01 01:00:00', NULL, 1),
(2, 2, 2, '2025-01-01 01:00:00', NULL, 1),
(3, 3, 3, '2025-01-01 01:00:00', NULL, 1),
(4, 4, 4, '2025-01-01 01:00:00', NULL, 1),
(5, 5, 5, '2025-01-01 01:00:00', NULL, 1),
(6, 6, 6, '2025-01-01 01:00:00', NULL, 1),
(7, 7, 7, '2025-01-01 01:00:00', NULL, 1),
(8, 8, 8, '2025-01-01 01:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `tariff_id` int(11) NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `dropoff_location` varchar(255) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `total_price` decimal(10,2) DEFAULT NULL,
  `distance_km` decimal(10,2) DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `passenger_id`, `driver_id`, `car_id`, `tariff_id`, `pickup_location`, `dropoff_location`, `order_time`, `start_time`, `end_time`, `status`, `total_price`, `distance_km`, `duration_minutes`) VALUES
(1, 1, 1, 1, 2, 'ул. Ленина 10', 'пр. Мира 25', '2025-01-15 03:30:00', '2025-01-15 03:35:00', '2025-01-15 03:50:00', 'completed', 324.00, 5.20, 15),
(2, 2, 2, 2, 1, 'ул. Гагарина 5', 'ул. Пушкина 12', '2025-01-15 04:00:00', '2025-01-15 04:10:00', '2025-01-15 04:25:00', 'completed', 234.00, 3.80, 15),
(3, 3, 3, 3, 3, 'пл. Революции 1', 'аэропорт Шереметьево', '2025-01-15 05:00:00', '2025-01-15 05:05:00', '2025-01-15 06:20:00', 'completed', 1244.00, 35.00, 75),
(4, 4, 4, 4, 1, 'ул. Советская 45', 'ТЦ Мега', '2025-01-15 06:30:00', '2025-01-15 06:40:00', '2025-01-15 07:00:00', 'completed', 289.00, 6.50, 20),
(5, 5, 5, 5, 2, 'вокзал', 'ул. Новая 78', '2025-01-15 07:15:00', '2025-01-15 07:20:00', '2025-01-15 07:45:00', 'completed', 424.00, 8.20, 25),
(6, 6, 6, 6, 1, 'ул. Цветочная 12', 'ул. Садовая 34', '2025-01-15 08:00:00', NULL, NULL, 'in_progress', NULL, NULL, NULL),
(7, 7, 7, 7, 4, 'ТЦ Европейский', 'Домодедовская 15', '2025-01-15 08:30:00', NULL, NULL, 'pending', NULL, NULL, NULL),
(8, 8, 1, 1, 2, 'ул. Мира 100', 'ул. Ленина 50', '2025-01-15 09:00:00', NULL, NULL, 'pending', NULL, NULL, NULL),
(9, 9, 2, 2, 1, 'пр. Победы 22', 'ул. Кирова 8', '2025-01-14 02:00:00', '2025-01-14 02:10:00', '2025-01-14 02:30:00', 'completed', 274.00, 4.50, 20),
(10, 10, 3, 3, 3, 'ул. Южная 5', 'Бизнес центр', '2025-01-14 03:30:00', '2025-01-14 03:35:00', '2025-01-14 04:00:00', 'completed', 674.00, 12.00, 25),
(11, 1, 4, 4, 1, 'Рынок', 'ул. Северная 90', '2025-01-14 04:00:00', '2025-01-14 04:15:00', '2025-01-14 04:35:00', 'completed', 319.00, 5.80, 20),
(12, 2, 5, 5, 2, 'Парк Горького', 'ул. Восточная 15', '2025-01-14 05:00:00', '2025-01-14 05:05:00', '2025-01-14 05:30:00', 'completed', 399.00, 7.20, 25),
(13, 3, NULL, NULL, 1, 'ул. Западная 33', 'ул. Центральная 7', '2025-01-15 10:00:00', NULL, NULL, 'cancelled', NULL, NULL, NULL),
(14, 4, 6, 6, 4, 'Стадион', 'ул. Спортивная 20', '2025-01-13 11:00:00', '2025-01-13 11:10:00', '2025-01-13 11:40:00', 'completed', 564.00, 9.50, 30),
(15, 5, 7, 7, 2, 'Кинотеатр', 'ул. Театральная 5', '2025-01-13 12:30:00', '2025-01-13 12:35:00', '2025-01-13 12:50:00', 'completed', 324.00, 4.00, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `passengers`
--

CREATE TABLE `passengers` (
  `passenger_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `passengers`
--

INSERT INTO `passengers` (`passenger_id`, `full_name`, `phone`, `email`, `registration_date`) VALUES
(1, 'Иванов Иван Иванович', '+79161234567', 'ivanov@mail.ru', '2026-04-19 04:24:55'),
(2, 'Петров Петр Петрович', '+79162345678', 'petrov@mail.ru', '2026-04-19 04:24:55'),
(3, 'Сидоров Сидор Сидорович', '+79163456789', 'sidorov@mail.ru', '2026-04-19 04:24:55'),
(4, 'Козлова Анна Михайловна', '+79164567890', 'kozlova@mail.ru', '2026-04-19 04:24:55'),
(5, 'Новиков Дмитрий Алексеевич', '+79165678901', 'novikov@mail.ru', '2026-04-19 04:24:55'),
(6, 'Морозова Елена Владимировна', '+79166789012', 'morozova@mail.ru', '2026-04-19 04:24:55'),
(7, 'Волков Сергей Игоревич', '+79167890123', 'volkov@mail.ru', '2026-04-19 04:24:55'),
(8, 'Лебедева Ольга Сергеевна', '+79168901234', 'lebedeva@mail.ru', '2026-04-19 04:24:55'),
(9, 'Соколов Андрей Николаевич', '+79169012345', 'sokolov@mail.ru', '2026-04-19 04:24:55'),
(10, 'Павлова Мария Андреевна', '+79160123456', 'pavlova@mail.ru', '2026-04-19 04:24:55');

-- --------------------------------------------------------

--
-- Структура таблицы `tariffs`
--

CREATE TABLE `tariffs` (
  `tariff_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `price_per_km` decimal(10,2) NOT NULL,
  `price_per_minute` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tariffs`
--

INSERT INTO `tariffs` (`tariff_id`, `name`, `base_price`, `price_per_km`, `price_per_minute`, `description`) VALUES
(1, 'Эконом', 99.00, 15.00, 3.00, 'Базовый тариф для коротких поездок'),
(2, 'Комфорт', 199.00, 25.00, 5.00, 'Удобные автомобили с кондиционером'),
(3, 'Бизнес', 499.00, 45.00, 10.00, 'Премиум автомобили с водителем'),
(4, 'Минивэн', 299.00, 35.00, 7.00, 'Вместительные автомобили для компаний');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','driver','passenger') NOT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `role`, `entity_id`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, '2026-04-19 04:24:56'),
(2, 'driver1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'driver', 1, '2026-04-19 04:24:56'),
(3, 'driver2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'driver', 2, '2026-04-19 04:24:56'),
(4, 'driver3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'driver', 3, '2026-04-19 04:24:56'),
(5, 'passenger1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'passenger', 1, '2026-04-19 04:24:56'),
(6, 'passenger2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'passenger', 2, '2026-04-19 04:24:56');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `idx_cars_active` (`is_active`);

--
-- Индексы таблицы `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `idx_drivers_rating` (`rating`);

--
-- Индексы таблицы `driver_car_assignments`
--
ALTER TABLE `driver_car_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `tariff_id` (`tariff_id`),
  ADD KEY `idx_orders_passenger` (`passenger_id`),
  ADD KEY `idx_orders_driver` (`driver_id`),
  ADD KEY `idx_orders_status` (`status`),
  ADD KEY `idx_orders_time` (`order_time`);

--
-- Индексы таблицы `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`passenger_id`);

--
-- Индексы таблицы `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`tariff_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `driver_car_assignments`
--
ALTER TABLE `driver_car_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `passengers`
--
ALTER TABLE `passengers`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `tariff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `driver_car_assignments`
--
ALTER TABLE `driver_car_assignments`
  ADD CONSTRAINT `driver_car_assignments_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `driver_car_assignments_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`passenger_id`) REFERENCES `passengers` (`passenger_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`tariff_id`) REFERENCES `tariffs` (`tariff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
