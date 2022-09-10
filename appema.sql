-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-09-2022 a las 01:42:11
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'USUARIO QUE REALIZA LA ACCION',
  `correo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'CORREO DE USUARIO QUE REALIZA LA ACCION',
  `observaciones` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ACCION REALIZADA',
  `direccion_ip` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'DIRECCION IP',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `correo`, `observaciones`, `direccion_ip`, `created_at`, `updated_at`) VALUES
(1, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso control-total en la plataforma', '127.0.0.1', '2022-09-08 20:56:12', '2022-09-08 20:56:12'),
(2, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso ver-configuracion en la plataforma', '127.0.0.1', '2022-09-08 20:56:27', '2022-09-08 20:56:27'),
(3, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de rol ADMIN en la plataforma', '127.0.0.1', '2022-09-09 13:37:10', '2022-09-09 13:37:10'),
(4, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso editar-configuracion en la plataforma', '127.0.0.1', '2022-09-09 14:04:08', '2022-09-09 14:04:08'),
(5, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de rol ADMINS en la plataforma', '127.0.0.1', '2022-09-09 15:07:57', '2022-09-09 15:07:57'),
(6, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de rol ADMINS en la plataforma', '127.0.0.1', '2022-09-09 15:10:29', '2022-09-09 15:10:29'),
(7, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de rol ADMIN en la plataforma', '127.0.0.1', '2022-09-09 15:10:46', '2022-09-09 15:10:46'),
(8, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de rol DOCENTE en la plataforma', '127.0.0.1', '2022-09-09 15:10:58', '2022-09-09 15:10:58'),
(9, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de permiso control-total en la plataforma', '127.0.0.1', '2022-09-09 15:13:24', '2022-09-09 15:13:24'),
(10, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de rol DOCENTE en la plataforma', '127.0.0.1', '2022-09-09 15:17:33', '2022-09-09 15:17:33'),
(11, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de rol ADMIN en la plataforma', '127.0.0.1', '2022-09-09 16:07:05', '2022-09-09 16:07:05'),
(12, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso control-total en la plataforma', '127.0.0.1', '2022-09-09 16:48:54', '2022-09-09 16:48:54'),
(13, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso ver-usuarios en la plataforma', '127.0.0.1', '2022-09-09 16:49:40', '2022-09-09 16:49:40'),
(14, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso editar-usuarios en la plataforma', '127.0.0.1', '2022-09-09 16:49:51', '2022-09-09 16:49:51'),
(15, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso eliminar-usuarios en la plataforma', '127.0.0.1', '2022-09-09 16:50:33', '2022-09-09 16:50:33'),
(16, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de rol SUPER-ADMIN en la plataforma', '127.0.0.1', '2022-09-09 16:50:56', '2022-09-09 16:50:56'),
(17, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de rol ADMIN en la plataforma', '127.0.0.1', '2022-09-09 16:51:10', '2022-09-09 16:51:10'),
(18, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de de usuario vitalfutclubbga@gmail.com en la plataforma', '127.0.0.1', '2022-09-09 20:30:42', '2022-09-09 20:30:42'),
(19, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de de usuario vitalfutclubbga@gmail.com en la plataforma', '127.0.0.1', '2022-09-09 20:40:54', '2022-09-09 20:40:54'),
(20, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion  de usuario vitalfutclubbga@gmail.com en la plataforma', '127.0.0.1', '2022-09-09 23:23:41', '2022-09-09 23:23:41'),
(21, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación del usuario ojrincon@bucaramanga.gov.co en la plataforma', '127.0.0.1', '2022-09-09 23:36:09', '2022-09-09 23:36:09'),
(22, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion  de usuario julianrincon9230@gmail.com en la plataforma', '127.0.0.1', '2022-09-09 23:41:33', '2022-09-09 23:41:33'),
(23, 'Fabian', 'julianrincon9230@gmail.com', 'Actualizacion  de usuario julianrincon9230@gmail.com en la plataforma', '127.0.0.1', '2022-09-09 23:43:18', '2022-09-09 23:43:18'),
(24, 'Oscar', 'julianrincon9230@gmail.com', 'Actualizacion de contraseña del usuario: vitalfutclubbga@gmail.com en la plataforma', '127.0.0.1', '2022-09-10 00:08:43', '2022-09-10 00:08:43'),
(25, 'Oscar', 'julianrincon9230@gmail.com', 'Usuario : vitalfutclubbga@gmail.com desactivado en la plataforma', '127.0.0.1', '2022-09-10 01:29:39', '2022-09-10 01:29:39'),
(26, 'Oscar', 'julianrincon9230@gmail.com', 'Usuario: vitalfutclubbga@gmail.comactivado en la plataforma', '127.0.0.1', '2022-09-10 01:30:11', '2022-09-10 01:30:11'),
(27, 'Oscar', 'julianrincon9230@gmail.com', 'Usuario : vitalfutclubbga@gmail.com desactivado en la plataforma', '127.0.0.1', '2022-09-10 01:32:03', '2022-09-10 01:32:03'),
(28, 'Oscar', 'julianrincon9230@gmail.com', 'Actualizacion  de usuario julianrincon9230@gmail.com en la plataforma', '127.0.0.1', '2022-09-10 01:34:11', '2022-09-10 01:34:11'),
(29, 'Fabian', 'julianrincon9230@gmail.com', 'Usuario: vitalfutclubbga@gmail.comactivado en la plataforma', '127.0.0.1', '2022-09-10 01:36:27', '2022-09-10 01:36:27'),
(30, 'Fabian', 'julianrincon9230@gmail.com', 'Usuario : vitalfutclubbga@gmail.com desactivado en la plataforma', '127.0.0.1', '2022-09-10 01:38:41', '2022-09-10 01:38:41'),
(31, 'Fabian', 'julianrincon9230@gmail.com', 'Usuario: vitalfutclubbga@gmail.comactivado en la plataforma', '127.0.0.1', '2022-09-10 01:40:15', '2022-09-10 01:40:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_09_06_185730_create_permission_tables', 2),
(5, '2022_09_08_143813_table_auditoria_create', 3),
(6, '2022_09_09_182849_table_users_softdeletes', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'control-total', 'web', '2022-09-09 16:48:54', '2022-09-09 16:48:54'),
(2, 'ver-usuarios', 'web', '2022-09-09 16:49:40', '2022-09-09 16:49:40'),
(3, 'editar-usuarios', 'web', '2022-09-09 16:49:51', '2022-09-09 16:49:51'),
(4, 'eliminar-usuarios', 'web', '2022-09-09 16:50:33', '2022-09-09 16:50:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'SUPER-ADMIN', 'web', '2022-09-09 16:50:56', '2022-09-09 16:50:56'),
(2, 'ADMIN', 'web', '2022-09-09 16:51:10', '2022-09-09 16:51:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(3) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` bigint(1) DEFAULT NULL COMMENT 'Estado del usuario\r\n',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `password`, `role_id`, `number`, `city`, `estado`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'User', NULL, 'ojrincon@bucaramanga.gov.co', '$2y$10$LueqldPmcKdhoK7I9uMZzOpTUUQ71fSUd/w2TNXlrw7TAEC3x6ExC', NULL, NULL, NULL, 0, NULL, 'VZRMC0PaCZTVY0F7wJxPqbwhCvf2hJ8FAjJO0bhQr6v6aJ2Jea0845dzg87n', NULL, '2022-09-09 23:36:09', '2022-09-09 23:36:09'),
(2, 'Fabian', 'Hernandez', NULL, 'julianrincon9230@gmail.com', '$2y$10$g5BAX2rOZCTw1.ay.HxEm.XrZsgYyT8i7/21o1PM3iSqehHIMmSbW', 1, '3219080690', NULL, 1, NULL, '80Xj9B5l4CQhbYMX56Afu16k00rNCmWXFo2x4qarpYW4nTIbqoIqtzQjwdMq', '2022-08-31 07:51:21', '2022-09-10 01:34:11', NULL),
(4, 'Julian', 'Rincon', NULL, 'vitalfutclubbga@gmail.com', '$2y$10$jPUSjfF6ww4GkxDIDRb0ruvs53AVcBX8PXjyVFkEC5iNZo6c.LiGq', 2, '3166107397', 'BUCARAMANGA', 1, NULL, NULL, '2022-09-09 20:40:54', '2022-09-10 01:40:15', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_remember_token_unique` (`remember_token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
