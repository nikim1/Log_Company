-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 29 яну 2026 в 03:14
-- Версия на сървъра: 10.4.32-MariaDB
-- Версия на PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `logistics_db`
--

-- --------------------------------------------------------

--
-- Структура на таблица `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `company_id`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, '088834302', NULL, NULL, NULL),
(2, 12, 1, '0887249532', '2026-01-26 19:08:14', '2026-01-26 19:08:14', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `client_addresses`
--

CREATE TABLE `client_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `client_addresses`
--

INSERT INTO `client_addresses` (`id`, `client_id`, `city`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Sofia', 'ul. Goergi Hristov 5', '2026-01-24 00:24:56', '2026-01-24 01:00:57', NULL),
(2, 1, 'Plovdiv', 'ul. Paisi Hilendarski 23', '2026-01-24 00:24:56', '2026-01-24 01:00:57', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` enum('courier','office') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `company_id`, `office_id`, `position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, NULL, 'courier', '2026-01-22 21:50:23', '2026-01-22 21:50:23', NULL),
(2, 3, 1, 1, 'office', '2026-01-22 21:50:23', '2026-01-22 21:50:23', NULL),
(3, 5, 1, 1, 'office', '2026-01-22 21:50:23', '2026-01-22 21:50:23', NULL),
(6, 14, 1, NULL, 'courier', '2026-01-26 19:29:27', '2026-01-26 19:29:27', NULL),
(8, 19, 1, 1, 'office', '2026-01-28 00:16:28', '2026-01-28 00:16:28', NULL),
(9, 20, 2, NULL, 'courier', '2026-01-28 00:25:01', '2026-01-28 00:25:01', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `logistic_companies`
--

CREATE TABLE `logistic_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `logistic_companies`
--

INSERT INTO `logistic_companies` (`id`, `name`, `city`, `address`, `phone`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Send And Receive', 'Sofia', 'ul. Dimitur Kolov 54', '0888335566', 'sendandreceive@info.bg', '2026-01-23 20:46:54', '2026-01-23 20:46:54', NULL),
(2, 'Send And Receive 2', 'Plovdiv', 'ul. Ivan Asen 44', '0888542994', 'sendandreceive2@info.bg', '2026-01-23 20:46:54', '2026-01-23 20:46:54', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_01_20_000600_create_roles_table', 1),
(2, '2026_01_20_000700_create_users_table', 1),
(3, '2026_01_21_215836_create_logistic_companies_table', 1),
(4, '2026_01_21_221301_create_offices_table', 1),
(5, '2026_01_21_221604_create_employees_table', 1),
(6, '2026_01_21_221840_create_clients_table', 1),
(7, '2026_01_21_222304_create_shipments_table', 1),
(8, '2026_01_22_005234_create_cache_table', 2),
(9, '2026_01_24_002206_create_client_addresses_table', 3),
(10, '2026_01_24_034946_create_shipment_senders_table', 4),
(11, '2026_01_24_035010_create_shipment_receivers_table', 5);

-- --------------------------------------------------------

--
-- Структура на таблица `offices`
--

CREATE TABLE `offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `offices`
--

INSERT INTO `offices` (`id`, `name`, `city`, `address`, `phone`, `company_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Building B, Floor 3', 'Sofia', 'ul. Suhata reka 34', '088853533', 1, NULL, NULL, NULL),
(2, 'Building A, Floor 1', 'Sofia', 'ul. Petur Stoichkov 11', '0887463442', 1, NULL, NULL, NULL),
(3, 'Building A, Floor 2', 'Plovdiv', 'ul. Han Krum 2', '0887463111', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '2026-01-22 00:19:47', '2026-01-22 00:19:47', NULL),
(2, 'courier', '2026-01-22 00:19:47', '2026-01-22 00:19:47', NULL),
(3, 'office', '2026-01-22 00:19:47', '2026-01-22 00:19:47', NULL),
(4, 'client', '2026-01-22 00:19:47', '2026-01-22 00:19:47', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BBURbnoC2URwzYfO8DzQ5AEyIE4yGY5Xh6qhM6Vu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMHM2T1B5VVVzUVR5bnlxSzVoU3NHQjYzVTV1OXJQb2lEdVh5VkRjUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjtzOjU6InJvdXRlIjtzOjc6InByb2ZpbGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2OTY0Njk5Mzt9fQ==', 1769649015),
('c3c38VkmwAbm6ERMxSTuU5qQpm3FpIXAnyep9nvf', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia3YyQlNGQm5KUzFCblNOeVJubWRYYngzd0hKSDZ5NHo4WFJmc3hYdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3Njk2NDc4MDc7fX0=', 1769652342);

-- --------------------------------------------------------

--
-- Структура на таблица `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `status` enum('in_transit','pending','delivered','at_office') NOT NULL DEFAULT 'pending',
  `registered_by` bigint(20) UNSIGNED DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `shipments`
--

INSERT INTO `shipments` (`id`, `sender_id`, `receiver_id`, `weight`, `price`, `status`, `registered_by`, `delivered_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 2, 9.00, 19.50, 'delivered', 2, '2026-01-28 15:10:48', '2026-01-27 20:43:08', '2026-01-28 15:10:48', NULL),
(3, 1, 2, 5.00, 13.50, 'at_office', 2, NULL, '2026-01-27 22:06:07', '2026-01-28 20:07:35', NULL),
(4, 1, 2, 10.00, 23.50, 'delivered', 2, '2026-01-29 00:34:48', '2026-01-27 22:07:19', '2026-01-29 00:34:48', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `shipment_receivers`
--

CREATE TABLE `shipment_receivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_type` enum('office','address') NOT NULL,
  `office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `shipment_receivers`
--

INSERT INTO `shipment_receivers` (`id`, `shipment_id`, `delivery_type`, `office_id`, `address_id`, `courier_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'office', 1, NULL, NULL, '2026-01-27 23:34:19', '2026-01-27 23:34:19', NULL),
(2, 3, 'address', NULL, 1, 1, '2026-01-27 22:06:07', '2026-01-28 20:07:35', NULL),
(3, 4, 'address', NULL, 1, 6, '2026-01-27 22:07:19', '2026-01-28 20:00:27', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `shipment_senders`
--

CREATE TABLE `shipment_senders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('office','address') NOT NULL,
  `office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `shipment_senders`
--

INSERT INTO `shipment_senders` (`id`, `shipment_id`, `sender_type`, `office_id`, `address_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'office', 2, NULL, '2026-01-27 20:43:08', '2026-01-27 20:43:08', NULL),
(2, 3, 'office', 2, NULL, '2026-01-27 22:06:07', '2026-01-27 22:06:07', NULL),
(3, 4, 'address', NULL, 2, '2026-01-27 22:07:19', '2026-01-28 20:00:27', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_image`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$12$HPK9e/SDc.UYHhEuAwJOOeARRJ78J7dr5S30xgQrtGYv3BqaY2o6a', 1, '2026-01-22 00:25:53', '2026-01-22 00:25:53'),
(2, 'Димитър Иванов', 'divanov@gmail.com', NULL, '$2y$12$RUlsKeVKIoWA1n0OJ4q7b.RSlB5nxSIv7O4BnY.sHrl4iBYLr3gmK', 2, '2026-01-23 17:35:17', '2026-01-23 17:35:17'),
(3, 'Георги Георгиев', 'ggeorgiev@gmail.com', NULL, '$2y$12$MuePRMjrcJOIcoDfDHJaPu7Ao9sXaSBJzUfHIUs3BwyQa8E5AU/Je', 3, '2026-01-23 17:43:01', '2026-01-23 17:43:01'),
(4, 'Румен Теодоров', 'rteodorov@gmail.com', NULL, '$2y$12$rhJN1bgBEi88yjk4l/CmUuHYSxYGaCnax9VslsqPCz04G2lXfhlTy', 4, '2026-01-23 17:48:52', '2026-01-24 00:59:48'),
(5, 'Петър Асенов', 'pasenov@gmail.com', NULL, '$2y$12$A9vTYlubgBE6pKJieoLGgOx.ZKkm7lsH33YPTTN2MlpxNmw/3bUHu', 3, '2026-01-23 19:52:21', '2026-01-23 19:52:21'),
(12, 'Теодор Василев', 'tvasilev@gmail.com', NULL, '$2y$12$NTk398lYBOIuK08T14M4/Ox6sKv4T3y15UaROZypz5d3F4V.EiATW', 4, '2026-01-26 19:08:14', '2026-01-26 19:08:14'),
(14, 'Димитър Плачков', 'dplachkov@gmail.com', NULL, '$2y$12$iNZEZxszLwGTuF9UVzShE.DThWuwcGlf4qdqcwke5rd3RkGFwAKGC', 2, '2026-01-26 19:29:27', '2026-01-26 19:29:27'),
(19, 'Велислав Добринов', 'vdobrinov@gmail.com', NULL, '$2y$12$55FiFfF3o92pZlneyBerCOoP5y83RcMlSwtmKs6/pJbHoTBP8JSdi', 3, '2026-01-28 00:16:28', '2026-01-28 00:16:28'),
(20, 'Красимира Тодорова', 'ktodorova@gmail.com', NULL, '$2y$12$I4S/2YNPWBf3gBYcCbCZh.5W/bM2rNdBfSRlHirujE6qhp1CMVpdG', 2, '2026-01-28 00:25:01', '2026-01-28 00:25:01');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Индекси за таблица `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Индекси за таблица `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`),
  ADD KEY `clients_company_id_foreign` (`company_id`);

--
-- Индекси за таблица `client_addresses`
--
ALTER TABLE `client_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_addresses_client_id_foreign` (`client_id`);

--
-- Индекси за таблица `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_user_id_foreign` (`user_id`),
  ADD KEY `employees_office_id_foreign` (`office_id`),
  ADD KEY `employees_company_id_foreign` (`company_id`);

--
-- Индекси за таблица `logistic_companies`
--
ALTER TABLE `logistic_companies`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offices_company_id_foreign` (`company_id`);

--
-- Индекси за таблица `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индекси за таблица `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_registered_id_foreign` (`registered_by`),
  ADD KEY `shipments_sender_id_foreign` (`sender_id`),
  ADD KEY `shipments_receiver_id_foreign` (`receiver_id`);

--
-- Индекси за таблица `shipment_receivers`
--
ALTER TABLE `shipment_receivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_receivers_shipment_id_foreign` (`shipment_id`),
  ADD KEY `shipment_receivers_office_id_foreign` (`office_id`),
  ADD KEY `shipment_receivers_address_id_foreign` (`address_id`),
  ADD KEY `shipment_receivers_courier_id_foreign` (`courier_id`);

--
-- Индекси за таблица `shipment_senders`
--
ALTER TABLE `shipment_senders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_senders_shipment_id_foreign` (`shipment_id`),
  ADD KEY `shipment_senders_office_id_foreign` (`office_id`),
  ADD KEY `shipment_senders_address_id_foreign` (`address_id`);

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_addresses`
--
ALTER TABLE `client_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logistic_companies`
--
ALTER TABLE `logistic_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipment_receivers`
--
ALTER TABLE `shipment_receivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipment_senders`
--
ALTER TABLE `shipment_senders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `logistic_companies` (`id`),
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `client_addresses`
--
ALTER TABLE `client_addresses`
  ADD CONSTRAINT `client_addresses_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `logistic_companies` (`id`),
  ADD CONSTRAINT `employees_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `offices`
--
ALTER TABLE `offices`
  ADD CONSTRAINT `offices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `logistic_companies` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `shipments_registered_id_foreign` FOREIGN KEY (`registered_by`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `shipments_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `clients` (`id`);

--
-- Ограничения за таблица `shipment_receivers`
--
ALTER TABLE `shipment_receivers`
  ADD CONSTRAINT `shipment_receivers_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `client_addresses` (`id`),
  ADD CONSTRAINT `shipment_receivers_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `shipment_receivers_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  ADD CONSTRAINT `shipment_receivers_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `shipment_senders`
--
ALTER TABLE `shipment_senders`
  ADD CONSTRAINT `shipment_senders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `client_addresses` (`id`),
  ADD CONSTRAINT `shipment_senders_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  ADD CONSTRAINT `shipment_senders_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
