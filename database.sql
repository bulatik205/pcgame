-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el8
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Структура таблицы `components`
--

CREATE TABLE `components` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `price_rub` int NOT NULL,
  `type` varchar(20) NOT NULL,
  `level` float NOT NULL DEFAULT '1',
  `specifications` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `components`
--

INSERT INTO `components` (`id`, `name`, `price_rub`, `type`, `level`, `specifications`, `created_at`) VALUES
(1, 'Intel Pentium 4 (530)', 200, 'cpu', 1, 'Частота: 3.0 GHz, Сокет: LGA 775', '2025-09-11 09:35:37'),
(2, 'Intel Core 2 Duo E7500', 300, 'cpu', 1, 'Частота: 2.93 GHz, Сокет: LGA 775', '2025-09-11 09:35:37'),
(3, 'Intel Core i3-2120', 1000, 'cpu', 2, 'Частота: 3.3 GHz, Сокет: LGA 1155', '2025-09-11 09:35:37'),
(4, 'Intel Core i5-2500K', 2000, 'cpu', 2, 'Частота: 3.7 GHz, Сокет: LGA 1155', '2025-09-11 09:35:37'),
(5, 'Intel Core i5-4690K', 3500, 'cpu', 3, 'Частота: 3.9 GHz, Сокет: LGA 1150', '2025-09-11 09:35:37'),
(6, 'Intel Core i3-10100F', 7000, 'cpu', 3, 'Частота: 4.3 GHz, Сокет: LGA 1200', '2025-09-11 09:35:37'),
(7, 'Intel Core i5-11400F', 14000, 'cpu', 4, 'Частота: 4.4 GHz, Сокет: LGA 1200', '2025-09-11 09:35:37'),
(8, 'Intel Core i5-12600KF', 20000, 'cpu', 4, 'Частота: 4.9 GHz, Сокет: LGA 1700', '2025-09-11 09:35:37'),
(9, 'Intel Core i7-13700KF', 37000, 'cpu', 5, 'Частота: 5.4 GHz, Сокет: LGA 1700', '2025-09-11 09:35:37'),
(10, 'Intel Core i9-14900KF', 57000, 'cpu', 6, 'Частота: 6.0 GHz, Сокет: LGA 1700', '2025-09-11 09:35:37'),
(11, 'AMD Athlon 64 X2 6000+', 500, 'cpu', 1, 'Частота: 3.1 GHz, Сокет: AM2', '2025-09-11 09:35:37'),
(12, 'AMD Phenom II X4 965', 1500, 'cpu', 1, 'Частота: 3.4 GHz, Сокет: AM3', '2025-09-11 09:35:37'),
(13, 'AMD FX-6350', 2500, 'cpu', 2, 'Частота: 4.2 GHz, Сокет: AM3+', '2025-09-11 09:35:37'),
(14, 'AMD Ryzen 3 1200', 4000, 'cpu', 2, 'Частота: 3.4 GHz, Сокет: AM4', '2025-09-11 09:35:37'),
(15, 'AMD Ryzen 5 2600', 6000, 'cpu', 3, 'Частота: 3.9 GHz, Сокет: AM4', '2025-09-11 09:35:37'),
(16, 'AMD Ryzen 5 3600', 8000, 'cpu', 3, 'Частота: 4.2 GHz, Сокет: AM4', '2025-09-11 09:35:37'),
(17, 'AMD Ryzen 5 5600', 13000, 'cpu', 4, 'Частота: 4.4 GHz, Сокет: AM4', '2025-09-11 09:35:37'),
(18, 'AMD Ryzen 7 5700X', 18000, 'cpu', 4, 'Частота: 4.6 GHz, Сокет: AM4', '2025-09-11 09:35:37'),
(19, 'AMD Ryzen 7 7800X3D', 37000, 'cpu', 5, 'Частота: 5.0 GHz, Сокет: AM5', '2025-09-11 09:35:37'),
(20, 'AMD Ryzen 9 7950X3D', 68000, 'cpu', 6, 'Частота: 5.7 GHz, Сокет: AM5', '2025-09-11 09:35:37'),
(21, 'NVIDIA GeForce 210', 500, 'gpu', 1.05, 'Память: 1 ГБ, тянет змейку', '2025-09-11 09:35:37'),
(22, 'NVIDIA GeForce GT 520', 800, 'gpu', 1.05, 'Память: 1 ГБ, альфа майнкрафт на средних', '2025-09-11 09:35:37'),
(23, 'AMD Radeon HD 6670', 1200, 'gpu', 1.25, 'Память: 1 ГБ, электрическая плита', '2025-09-11 09:35:37'),
(24, 'NVIDIA GeForce GT 730', 2000, 'gpu', 1.25, 'Память: 2 ГБ, тянет ютуб', '2025-09-11 09:35:37'),
(25, 'NVIDIA GeForce GT 1030', 6000, 'gpu', 1.5, 'Память: 2 ГБ, 1080p Low', '2025-09-11 09:35:37'),
(26, 'AMD Radeon RX 550', 7000, 'gpu', 1.75, 'Память: 4 ГБ, 1080p Low-Med', '2025-09-11 09:35:37'),
(27, 'NVIDIA GeForce GTX 1050 Ti', 8000, 'gpu', 2, 'Память: 4 ГБ, 1080p Medium', '2025-09-11 09:35:37'),
(28, 'NVIDIA GeForce GTX 1650', 9000, 'gpu', 2.25, 'Память: 4 ГБ, 1080p High', '2025-09-11 09:35:37'),
(29, 'AMD Radeon RX 580', 13000, 'gpu', 2.5, 'Память: 8 ГБ, 1080p Ultra / 1440p Low', '2025-09-11 09:35:37'),
(30, 'NVIDIA GeForce RTX 3050', 22000, 'gpu', 3, 'Память: 8 ГБ, 1080p Ultra / 1440p Med', '2025-09-11 09:35:37'),
(31, 'NVIDIA GeForce RTX 3060', 28000, 'gpu', 3.5, 'Память: 12 ГБ, 1440p High', '2025-09-11 09:35:37'),
(32, 'AMD Radeon RX 6700 XT', 32000, 'gpu', 3.75, 'Память: 12 ГБ, 1440p Ultra', '2025-09-11 09:35:37'),
(33, 'NVIDIA GeForce RTX 4070', 55000, 'gpu', 4.5, 'Память: 12 ГБ, 1440p Ultra / 4K Med', '2025-09-11 09:35:37'),
(34, 'NVIDIA GeForce RTX 4080 Super', 100000, 'gpu', 6, 'Память: 16 ГБ, 4K Ultra', '2025-09-11 09:35:37'),
(35, 'NVIDIA GeForce RTX 4090', 180000, 'gpu', 10, 'Память: 24 ГБ, 4K Ultra / 8K с DLSS', '2025-09-11 09:35:37'),
(36, 'Samsung PC2-5300', 250, 'ram', 1, 'Тип: DDR2, Объем: 1 ГБ, Частота: 667MHz', '2025-09-11 09:35:37'),
(37, 'Kingston ValueRAM PC2-6400', 300, 'ram', 1, 'Тип: DDR2, Объем: 1 ГБ, Частота: 800MHz', '2025-09-11 09:35:37'),
(38, 'Hynix PC3-10600', 400, 'ram', 1, 'Тип: DDR3, Объем: 1 ГБ, Частота: 1333MHz', '2025-09-11 09:35:37'),
(39, 'Kingston ValueRAM DDR2-800', 400, 'ram', 2, 'Тип: DDR2, Объем: 2 ГБ, Частота: 800MHz', '2025-09-11 09:35:37'),
(40, 'Goodram DDR3-1333 MHz', 600, 'ram', 2, 'Тип: DDR3, Объем: 2 ГБ, Частота: 1333MHz', '2025-09-11 09:35:37'),
(41, 'Crucial DDR3L-1600', 700, 'ram', 2, 'Тип: DDR3L, Объем: 2 ГБ, Частота: 1600MHz', '2025-09-11 09:35:37'),
(42, 'Samsung DDR3-1600 MHz', 1000, 'ram', 3, 'Тип: DDR3, Объем: 4 ГБ, Частота: 1600MHz', '2025-09-11 09:35:37'),
(43, 'Kingston HyperX Fury DDR3-1866 MHz', 1500, 'ram', 3, 'Тип: DDR3, Объем: 4 ГБ, Частота: 1866MHz', '2025-09-11 09:35:37'),
(44, 'Patriot Signature Line DDR4-2400 MHz', 1700, 'ram', 3, 'Тип: DDR4, Объем: 4 ГБ, Частота: 2400MHz', '2025-09-11 09:35:37'),
(45, 'Corsair ValueSelect DDR3-1600 MHz', 1800, 'ram', 3, 'Тип: DDR3, Объем: 8 ГБ, Частота: 1600MHz', '2025-09-11 09:35:37'),
(46, 'Goodram IRDM DDR4-3200 MHz', 2500, 'ram', 4, 'Тип: DDR4, Объем: 8 ГБ, Частота: 3200MHz', '2025-09-11 09:35:37'),
(47, 'Teamgroup T-Force Vulcan Z DDR4-3200 MHz', 3000, 'ram', 4, 'Тип: DDR4, Объем: 8 ГБ, Частота: 3200MHz', '2025-09-11 09:35:37'),
(48, 'G.Skill Ripjaws V DDR4-3600 MHz', 5500, 'ram', 4, 'Тип: DDR4, Объем: 16 ГБ, Частота: 3600MHz', '2025-09-11 09:35:37'),
(49, 'Kingston Fury Beast DDR4-3200 MHz', 5000, 'ram', 4, 'Тип: DDR4, Объем: 16 ГБ, Частота: 3200MHz', '2025-09-11 09:35:37'),
(50, 'Crucial Ballistix DDR4-3600 MHz', 6000, 'ram', 5, 'Тип: DDR4, Объем: 16 ГБ, Частота: 3600MHz', '2025-09-11 09:35:37'),
(51, 'Corsair Vengeance LPX DDR4-3600', 9500, 'ram', 5, 'Тип: DDR4, Объем: 32 ГБ, Частота: 3600MHz', '2025-09-11 09:35:37'),
(52, 'G.Skill Trident Z RGB DDR5-6000', 12000, 'ram', 5, 'Тип: DDR5, Объем: 32 ГБ, Частота: 6000MHz', '2025-09-11 09:35:37'),
(53, 'Teamgroup Delta RGB DDR5-6000', 11500, 'ram', 5, 'Тип: DDR5, Объем: 32 ГБ, Частота: 6000MHz', '2025-09-11 09:35:37'),
(54, 'Kingston Fury Renegade DDR5-6000', 22000, 'ram', 6, 'Тип: DDR5, Объем: 64 ГБ, Частота: 6000MHz', '2025-09-11 09:35:37'),
(55, 'Corsair Dominator Platinum DDR5-5600', 25000, 'ram', 6, 'Тип: DDR5, Объем: 64 ГБ, Частота: 5600MHz', '2025-09-11 09:35:37'),
(56, 'G.Skill Ripjaws S5 DDR5-5600', 21000, 'ram', 6, 'Тип: DDR5, Объем: 64 ГБ, Частота: 5600MHz', '2025-09-11 09:35:37'),
(57, 'Samsung SyncMaster 943NW', 1500, 'monitor', 1, 'Разрешение: 1440x900, Частота: 60Hz, Диагональ: 19\"', '2025-09-11 09:35:37'),
(58, 'Dell E1916H', 4000, 'monitor', 1, 'Разрешение: 1366x768, Частота: 60Hz, Диагональ: 18.5\"', '2025-09-11 09:35:37'),
(59, 'Acer V206HQL', 5000, 'monitor', 1, 'Разрешение: 1600x900, Частота: 60Hz, Диагональ: 19.5\"', '2025-09-11 09:35:37'),
(60, 'HP 22er', 8000, 'monitor', 1, 'Разрешение: 1920x1080, Частота: 60Hz, Диагональ: 21.5\"', '2025-09-11 09:35:37'),
(61, 'AOC E2270SWHN', 7000, 'monitor', 2, 'Разрешение: 1920x1080, Частота: 75Hz, Диагональ: 21.5\"', '2025-09-11 09:35:37'),
(62, 'ASUS VP228HE', 9000, 'monitor', 2, 'Разрешение: 1920x1080, Частота: 75Hz, Диагональ: 21.5\"', '2025-09-11 09:35:37'),
(63, 'ViewSonic VX2457-MHD', 10000, 'monitor', 2, 'Разрешение: 1920x1080, Частота: 75Hz, Диагональ: 23.6\"', '2025-09-11 09:35:37'),
(64, 'Samsung Odyssey G3', 13000, 'monitor', 3, 'Разрешение: 1920x1080, Частота: 144Hz, Диагональ: 24\"', '2025-09-11 09:35:37'),
(65, 'AOC C24G1', 15000, 'monitor', 3, 'Разрешение: 1920x1080, Частота: 144Hz, Диагональ: 23.6\"', '2025-09-11 09:35:37'),
(66, 'MSI Optix G241', 17000, 'monitor', 3, 'Разрешение: 1920x1080, Частота: 144Hz, Диагональ: 23.8\"', '2025-09-11 09:35:37'),
(67, 'Gigabyte G27Q', 28000, 'monitor', 3, 'Разрешение: 2560x1440, Частота: 144Hz, Диагональ: 27\"', '2025-09-11 09:35:37'),
(68, 'LG 27GL850-B', 30000, 'monitor', 4, 'Разрешение: 2560x1440, Частота: 144Hz, Диагональ: 27\"', '2025-09-11 09:35:37'),
(69, 'Acer Nitro XV252Q', 32000, 'monitor', 4, 'Разрешение: 1920x1080, Частота: 240Hz, Диагональ: 24.5\"', '2025-09-11 09:35:37'),
(70, 'ASUS TUF Gaming VG259QM', 35000, 'monitor', 4, 'Разрешение: 1920x1080, Частота: 280Hz, Диагональ: 24.5\"', '2025-09-11 09:35:37'),
(71, 'Samsung Odyssey G7', 50000, 'monitor', 5, 'Разрешение: 2560x1440, Частота: 240Hz, Диагональ: 27\"', '2025-09-11 09:35:37'),
(72, 'Alienware AW2723DF', 60000, 'monitor', 6, 'Разрешение: 2560x1440, Частота: 280Hz, Диагональ: 27\"', '2025-09-11 09:35:37'),
(73, 'Intel Pentium 4 631', 100, 'cpu', 1, 'empty', '2025-10-05 13:24:47'), -- базовые компоненты
(74, 'NVIDIA GeForce 6200', 100, 'gpu', 1, 'empty', '2025-10-05 13:24:47'), -- базовые компоненты
(75, 'Samsung CD5 512mb', 100, 'ram', 1, 'empty', '2025-10-05 13:24:47'), -- базовые компоненты
(76, 'Samsung SyncMaster 793DF', 100, 'monitor', 1, 'empty', '2025-10-05 13:24:47'); -- базовые компоненты
 
-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `balance` int NOT NULL DEFAULT '100',
  `telegram_id` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastCash` varchar(255) NOT NULL,
  `lastGame` varchar(255) NOT NULL DEFAULT '0',
  `cpu` varchar(255) NOT NULL DEFAULT 'Intel Pentium 4 631',
  `gpu` varchar(255) NOT NULL DEFAULT 'NVIDIA GeForce 6200',
  `ram` varchar(255) NOT NULL DEFAULT 'Samsung CD5 512mb',
  `monitor` varchar(255) NOT NULL DEFAULT 'Samsung SyncMaster 793DF',
  `micro` varchar(255) NOT NULL DEFAULT 'Ноу-Нейм',
  `mouse` varchar(255) NOT NULL DEFAULT 'Шариковая мышь'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Индексы таблицы `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для таблицы `components`
--
ALTER TABLE `components`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
