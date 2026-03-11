-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2026 a las 01:17:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_archivo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones_virtual`
--

CREATE TABLE `acciones_virtual` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_accion` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo_archivo` varchar(50) NOT NULL,
  `descripcion_documento` text DEFAULT NULL,
  `tomo` varchar(100) DEFAULT NULL,
  `numero_foja` varchar(100) DEFAULT NULL,
  `gestion` varchar(50) DEFAULT NULL,
  `unidad_instalacion` varchar(255) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `documento_adjunto` varchar(255) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `unidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'activo',
  `categoria_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `codigo_archivo`, `descripcion_documento`, `tomo`, `numero_foja`, `gestion`, `unidad_instalacion`, `observaciones`, `documento_adjunto`, `fecha_registro`, `unidad_id`, `estado`, `categoria_id`, `created_at`, `updated_at`) VALUES
(2, 'GAMV/SMAF/DF/UTIC/01/2021', 'Instructivo de emision de informes', '1', '10', '2021', 'Folder amarrillo', 'Ninguna', NULL, '2026-01-19', 2, 'Activo', 1, '2026-01-19 21:38:34', '2026-01-19 21:38:34'),
(3, 'GAMV/SMAF/DF/ N°001/2021', 'Instructivo de emision de informes', '1', '10', '2021', 'Folder amarrillo', 'Ninguna', NULL, '2026-01-19', 2, 'Activo', 1, '2026-01-19 21:42:57', '2026-01-19 21:42:57'),
(4, 'GAMV/SMAF/DF/004/2021', 'Instructivo de emision de informes', '1', '10', '2021', 'Folder amarrillo', 'Ninguna', NULL, '2026-01-19', 2, 'Activo', 1, '2026-01-19 21:46:28', '2026-01-19 21:46:28'),
(5, 'GAMV/SMDHEP/INST/01/2021', 'Instructivo de emision de informes', '1', '10', '2021', 'Folder amarrillo', 'Ninguna', NULL, '2026-01-19', 2, 'Activo', 1, '2026-01-19 21:47:03', '2026-01-19 21:47:03'),
(6, 'GAMV/SMDHEP/INST/010/2021', 'Instructivo de emision de informes', '1', '10', '2021', 'Folder amarrillo', 'Ninguna', NULL, '2026-01-19', 2, 'Activo', 1, '2026-01-19 21:47:30', '2026-01-19 21:47:30'),
(7, 'GAMV/DESP/Dir.PLAN/010/2021', 'Instructivo de emision de informes', '1', '10', '2021', 'Folder amarrillo', 'Ninguna', NULL, '2026-01-19', 1, 'Activo', 1, '2026-01-19 21:48:03', '2026-01-19 21:48:03'),
(8, 'GAMV/DESP/Dir.PLAN/0166/2021', 'Instructivo de emision de informes', '1', '10', '2021', 'Folder amarrillo', 'Ninguna', NULL, '2026-01-19', 2, 'Activo', 1, '2026-01-19 21:49:26', '2026-01-19 21:49:26'),
(9, '58', 'Hoja de Ruta Interna', '2', '167', '2021', 'Folder amarrillo', 'Ninguna', NULL, '2021-01-07', 2, 'Activo', 3, '2026-01-19 21:59:20', '2026-01-19 21:59:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `fecha_envio`, `created_at`, `updated_at`) VALUES
(1, 'Smaf', 'Registros financieros', NULL, '2025-11-18 08:21:21', '2025-11-18 08:21:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_archivos`
--

CREATE TABLE `areas_archivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas_archivos`
--

INSERT INTO `areas_archivos` (`id`, `nombre`, `descripcion`, `fecha_envio`, `created_at`, `updated_at`) VALUES
(1, 'Tesoreria', 'Respaldo de tesoreria', NULL, '2025-08-16 21:10:51', '2025-08-16 21:10:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_despacho`
--

CREATE TABLE `areas_despacho` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas_despacho`
--

INSERT INTO `areas_despacho` (`id`, `nombre`, `descripcion`, `fecha_envio`, `created_at`, `updated_at`) VALUES
(1, 'Despacho registros', 'Registros de respaldo de despacho', NULL, '2025-08-10 20:03:14', '2025-08-10 20:03:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistente_virtual`
--

CREATE TABLE `asistente_virtual` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text DEFAULT NULL,
  `tipo_solicitud` varchar(100) DEFAULT NULL,
  `contexto_relacionado` varchar(255) DEFAULT NULL,
  `accion_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_pregunta` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_06b45192b9757c33125bd6795f71a92b', 'i:1;', 1771259765),
('laravel_cache_06b45192b9757c33125bd6795f71a92b:timer', 'i:1771259765;', 1771259765),
('laravel_cache_2b2de4a7a4518c2f420cfbbb1e2c2a55', 'i:1;', 1771866619),
('laravel_cache_2b2de4a7a4518c2f420cfbbb1e2c2a55:timer', 'i:1771866619;', 1771866619),
('laravel_cache_2e6a54b4f53de8918e86cf18ec9b32c6', 'i:1;', 1771550281),
('laravel_cache_2e6a54b4f53de8918e86cf18ec9b32c6:timer', 'i:1771550281;', 1771550281),
('laravel_cache_4d2361ef502131c22b02267cf1e0e8a4', 'i:1;', 1771258482),
('laravel_cache_4d2361ef502131c22b02267cf1e0e8a4:timer', 'i:1771258482;', 1771258482),
('laravel_cache_58a529729abdfedf1f6a0f17c1ebdaf4', 'i:1;', 1771866639),
('laravel_cache_58a529729abdfedf1f6a0f17c1ebdaf4:timer', 'i:1771866639;', 1771866639),
('laravel_cache_84d79ab094bf2e035d8cb4a7243b9f2d', 'i:1;', 1771381948),
('laravel_cache_84d79ab094bf2e035d8cb4a7243b9f2d:timer', 'i:1771381948;', 1771381948),
('laravel_cache_aa705d4826d3a08dca1f595fb0b059f1', 'i:1;', 1771552935),
('laravel_cache_aa705d4826d3a08dca1f595fb0b059f1:timer', 'i:1771552935;', 1771552935),
('laravel_cache_d4e73c981acb06a8e80abcb3687081db', 'i:2;', 1771553203),
('laravel_cache_d4e73c981acb06a8e80abcb3687081db:timer', 'i:1771553203;', 1771553203),
('laravel_cache_fortify.2fa_codes.0eb51b4e66aca9b71550e9e16b180ec8', 'i:59048674;', 1771460287),
('laravel_cache_fortify.2fa_codes.184bbdbc4656cac9c2b078ea0f1fe434', 'i:59041987;', 1771259685),
('laravel_cache_fortify.2fa_codes.23e7a204e051b5cb24dcfe9dd2ad3f45', 'i:59048677;', 1771460370),
('laravel_cache_fortify.2fa_codes.25ebec6ff0985027249185e9cfd2069a', 'i:59041947;', 1771258482),
('laravel_cache_fortify.2fa_codes.439a32f82783eb19bbc8248e71605026', 'i:59041990;', 1771259765),
('laravel_cache_fortify.2fa_codes.486f39ae1498b6124a83a0b5033aa84a', 'i:59046064;', 1771381989),
('laravel_cache_fortify.2fa_codes.abd3eeca6dad057c381539aa2e85078d', 'i:59045791;', 1771373800),
('laravel_cache_fortify.2fa_codes.b38a027e391fea4a763540304eb50c81', 'i:59041728;', 1771251913),
('laravel_cache_fortify.2fa_codes.f21ca76a0783a602c7762b756bfd0b28', 'i:59062219;', 1771866639),
('laravel_cache_fortify.2fa_codes.f27fc438c09ec52c54a23a326442a885', 'i:59051764;', 1771552998),
('laravel_cache_fortify.2fa_codes.f346238a29553af1b20da920a03fb667', 'i:59051773;', 1771553262),
('laravel_cache_fortify.2fa_codes.f44e2e7fcac3466ea619d56df5e39b5f', 'i:59051707;', 1771551287),
('laravel_cache_fortify.2fa_codes.f5aea790ed193d55e2fcb3e160340d54', 'i:59037372;', 1771121229),
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:6:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:6:\"module\";s:1:\"d\";s:11:\"description\";s:1:\"e\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:50:{i:0;a:6:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"despacho.index\";s:1:\"c\";s:8:\"despacho\";s:1:\"d\";s:35:\"ver listado de registro de despacho\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:1;a:6:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"despacho.create\";s:1:\"c\";s:8:\"despacho\";s:1:\"d\";s:27:\"Registrar datos en despacho\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:2;a:6:{s:1:\"a\";i:3;s:1:\"b\";s:13:\"despacho.edit\";s:1:\"c\";s:8:\"despacho\";s:1:\"d\";s:36:\"Editar datos en el registro despacho\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:3;a:6:{s:1:\"a\";i:4;s:1:\"b\";s:16:\"despacho.destroy\";s:1:\"c\";s:8:\"despacho\";s:1:\"d\";s:38:\"Eliminar datos en el registro despacho\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:4;a:6:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"smaf.create\";s:1:\"c\";s:4:\"smaf\";s:1:\"d\";s:31:\"crear datos en el registro smaf\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:5;a:6:{s:1:\"a\";i:6;s:1:\"b\";s:10:\"smaf.index\";s:1:\"c\";s:4:\"smaf\";s:1:\"d\";s:40:\"ver listado de datos en el registro smaf\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:6;a:6:{s:1:\"a\";i:7;s:1:\"b\";s:9:\"smaf.edit\";s:1:\"c\";s:4:\"smaf\";s:1:\"d\";s:32:\"editar datos en el registro smaf\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:6:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"smaf.destroy\";s:1:\"c\";s:4:\"smaf\";s:1:\"d\";s:34:\"eliminar datos en el registro smaf\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:6:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"unidades.index\";s:1:\"c\";s:8:\"unidades\";s:1:\"d\";s:33:\"ver listado del registro unidades\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:9;a:6:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"unidades.create\";s:1:\"c\";s:8:\"unidades\";s:1:\"d\";s:35:\"crear datos en el registro unidades\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:10;a:6:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"unidades.edit\";s:1:\"c\";s:8:\"unidades\";s:1:\"d\";s:34:\"editar datos del registro unidades\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:11;a:6:{s:1:\"a\";i:12;s:1:\"b\";s:16:\"unidades.destroy\";s:1:\"c\";s:8:\"unidades\";s:1:\"d\";s:36:\"eliminar datos del registro unidades\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:12;a:6:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"tesoreria.index\";s:1:\"c\";s:9:\"tesoreria\";s:1:\"d\";s:37:\"Ver listado de registro de tesorería\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:13;a:6:{s:1:\"a\";i:14;s:1:\"b\";s:16:\"tesoreria.create\";s:1:\"c\";s:9:\"tesoreria\";s:1:\"d\";s:25:\"Crear datos en tesorería\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:14;a:6:{s:1:\"a\";i:15;s:1:\"b\";s:14:\"tesoreria.edit\";s:1:\"c\";s:9:\"tesoreria\";s:1:\"d\";s:38:\"Editar datos en el registro tesorería\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:6:{s:1:\"a\";i:16;s:1:\"b\";s:17:\"tesoreria.destroy\";s:1:\"c\";s:9:\"tesoreria\";s:1:\"d\";s:40:\"Eliminar datos en el registro tesorería\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:16;a:6:{s:1:\"a\";i:17;s:1:\"b\";s:11:\"areas.index\";s:1:\"c\";s:10:\"Actas smaf\";s:1:\"d\";s:28:\"Ver listado de actas de smaf\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:6:{s:1:\"a\";i:18;s:1:\"b\";s:12:\"areas.create\";s:1:\"c\";s:10:\"Actas smaf\";s:1:\"d\";s:25:\"Crear un campo para actas\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:6:{s:1:\"a\";i:19;s:1:\"b\";s:10:\"areas.show\";s:1:\"c\";s:10:\"Actas smaf\";s:1:\"d\";s:41:\"Ver registros de actas en reporte de smaf\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:6:{s:1:\"a\";i:20;s:1:\"b\";s:13:\"areas.destroy\";s:1:\"c\";s:10:\"Actas smaf\";s:1:\"d\";s:17:\"Eliminar registro\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:6:{s:1:\"a\";i:21;s:1:\"b\";s:20:\"areas-despacho.index\";s:1:\"c\";s:14:\"Actas despacho\";s:1:\"d\";s:29:\"Ver listado de actas despacho\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:21;a:6:{s:1:\"a\";i:22;s:1:\"b\";s:21:\"areas-despacho.create\";s:1:\"c\";s:14:\"Actas despacho\";s:1:\"d\";s:26:\"Crear el registro de actas\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:22;a:6:{s:1:\"a\";i:23;s:1:\"b\";s:19:\"areas-despacho.edit\";s:1:\"c\";s:14:\"Actas despacho\";s:1:\"d\";s:27:\"Editar datos en el registro\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:23;a:6:{s:1:\"a\";i:24;s:1:\"b\";s:19:\"areas-despacho.show\";s:1:\"c\";s:14:\"Actas despacho\";s:1:\"d\";s:32:\"Ver el listado de actas despacho\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:24;a:6:{s:1:\"a\";i:25;s:1:\"b\";s:22:\"areas-despacho.destroy\";s:1:\"c\";s:14:\"Actas despacho\";s:1:\"d\";s:17:\"Eliminar registro\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:25;a:6:{s:1:\"a\";i:26;s:1:\"b\";s:20:\"areas-archivos.index\";s:1:\"c\";s:15:\"Actas tesoreria\";s:1:\"d\";s:30:\"Ver listado de actas tesoreria\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:26;a:6:{s:1:\"a\";i:27;s:1:\"b\";s:21:\"areas-archivos.create\";s:1:\"c\";s:15:\"Actas tesoreria\";s:1:\"d\";s:23:\"Crear registro de actas\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:27;a:6:{s:1:\"a\";i:28;s:1:\"b\";s:19:\"areas-archivos.edit\";s:1:\"c\";s:15:\"Actas tesoreria\";s:1:\"d\";s:24:\"Editar registro de actas\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:28;a:6:{s:1:\"a\";i:29;s:1:\"b\";s:19:\"areas-archivos.show\";s:1:\"c\";s:15:\"Actas tesoreria\";s:1:\"d\";s:39:\"Ver listado de reportes actas tesoreria\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:29;a:6:{s:1:\"a\";i:30;s:1:\"b\";s:22:\"areas-archivos.destroy\";s:1:\"c\";s:15:\"Actas tesoreria\";s:1:\"d\";s:17:\"Eliminar registro\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:30;a:6:{s:1:\"a\";i:31;s:1:\"b\";s:17:\"ubicaciones.index\";s:1:\"c\";s:11:\"Ubicaciones\";s:1:\"d\";s:43:\"Listado ubicaciones de archivos financieros\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:31;a:6:{s:1:\"a\";i:32;s:1:\"b\";s:18:\"ubicaciones.create\";s:1:\"c\";s:11:\"Ubicaciones\";s:1:\"d\";s:36:\"Crear nuevos estantes de ubicaciones\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:32;a:6:{s:1:\"a\";i:33;s:1:\"b\";s:16:\"ubicaciones.edit\";s:1:\"c\";s:11:\"Ubicaciones\";s:1:\"d\";s:26:\"Editar ubicaciones creadas\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:33;a:6:{s:1:\"a\";i:34;s:1:\"b\";s:16:\"ubicaciones.show\";s:1:\"c\";s:11:\"Ubicaciones\";s:1:\"d\";s:59:\"Ver listado de archivos financieros asignados en el estante\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:34;a:6:{s:1:\"a\";i:35;s:1:\"b\";s:19:\"ubicaciones.destroy\";s:1:\"c\";s:11:\"Ubicaciones\";s:1:\"d\";s:46:\"Eliminar la asignacion de archivos financieras\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:35;a:6:{s:1:\"a\";i:36;s:1:\"b\";s:17:\"financieras.index\";s:1:\"c\";s:11:\"Financieras\";s:1:\"d\";s:20:\"Listado de registros\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:36;a:6:{s:1:\"a\";i:37;s:1:\"b\";s:18:\"financieras.create\";s:1:\"c\";s:11:\"Financieras\";s:1:\"d\";s:15:\"Crear registros\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:6:{s:1:\"a\";i:38;s:1:\"b\";s:16:\"financieras.edit\";s:1:\"c\";s:11:\"Financieras\";s:1:\"d\";s:16:\"Editar registros\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:38;a:6:{s:1:\"a\";i:39;s:1:\"b\";s:16:\"financieras.show\";s:1:\"c\";s:11:\"Financieras\";s:1:\"d\";s:36:\"Ver listado de registros financieros\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:39;a:6:{s:1:\"a\";i:40;s:1:\"b\";s:19:\"financieras.destroy\";s:1:\"c\";s:11:\"Financieras\";s:1:\"d\";s:30:\"Eliminar registros financieras\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:6:{s:1:\"a\";i:41;s:1:\"b\";s:15:\"prestamos.index\";s:1:\"c\";s:28:\"Prestamos archivo financiero\";s:1:\"d\";s:44:\"Listado de prestamos de archivos financieros\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:41;a:6:{s:1:\"a\";i:42;s:1:\"b\";s:16:\"prestamos.create\";s:1:\"c\";s:28:\"Prestamos archivo financiero\";s:1:\"d\";s:31:\"Registrar prestamo  de archivos\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:42;a:6:{s:1:\"a\";i:43;s:1:\"b\";s:14:\"prestamos.edit\";s:1:\"c\";s:28:\"Prestamos archivo financiero\";s:1:\"d\";s:31:\"Editar el registro de prestamos\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:43;a:6:{s:1:\"a\";i:44;s:1:\"b\";s:14:\"prestamos.show\";s:1:\"c\";s:28:\"Prestamos archivo financiero\";s:1:\"d\";s:27:\"Ver el registro de prestamo\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:44;a:6:{s:1:\"a\";i:45;s:1:\"b\";s:17:\"prestamos.destroy\";s:1:\"c\";s:28:\"Prestamos archivo financiero\";s:1:\"d\";s:17:\"Eliminar registro\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:45;a:6:{s:1:\"a\";i:46;s:1:\"b\";s:22:\"prestamo-central.index\";s:1:\"c\";s:24:\"Prestamo archivo central\";s:1:\"d\";s:37:\"Listado de archivos prestados central\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:46;a:6:{s:1:\"a\";i:47;s:1:\"b\";s:23:\"prestamo-central.create\";s:1:\"c\";s:24:\"Prestamo archivo central\";s:1:\"d\";s:37:\"Registrar prestamo de archivo central\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:47;a:6:{s:1:\"a\";i:48;s:1:\"b\";s:21:\"prestamo-central.edit\";s:1:\"c\";s:24:\"Prestamo archivo central\";s:1:\"d\";s:15:\"Editar prestamo\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:48;a:6:{s:1:\"a\";i:49;s:1:\"b\";s:21:\"prestamo-central.show\";s:1:\"c\";s:24:\"Prestamo archivo central\";s:1:\"d\";s:23:\"Ver registros prestados\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:49;a:6:{s:1:\"a\";i:50;s:1:\"b\";s:24:\"prestamo-central.destroy\";s:1:\"c\";s:24:\"Prestamo archivo central\";s:1:\"d\";s:18:\"Eliminar prestamos\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}}s:5:\"roles\";a:6:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"administrador\";s:1:\"e\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:8:\"despacho\";s:1:\"e\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:9:\"tesoreria\";s:1:\"e\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:4:\"smaf\";s:1:\"e\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:7:\"central\";s:1:\"e\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:8:\"archivos\";s:1:\"e\";s:3:\"web\";}}}', 1771953039);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre_categoria`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Informes', 'informacion de la gestion pasada', '2025-10-28 20:10:17', '2025-10-28 20:10:17'),
(2, 'HRP-678', 'contratacion de internet', '2025-11-05 23:48:50', '2025-11-05 23:48:50'),
(3, 'HRI', 'Hoja de ruta interna', '2026-01-19 21:50:29', '2026-01-19 21:50:29'),
(4, 'HRE', 'Hoja de ruta externa', '2026-01-19 21:51:13', '2026-01-19 21:51:13'),
(5, 'Informe tecnico', 'Informe de sustento tecnico', '2026-01-19 21:53:47', '2026-01-19 21:53:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `financieras`
--

CREATE TABLE `financieras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `enviado_archivo` enum('pendiente','enviado') NOT NULL DEFAULT 'pendiente',
  `fecha_envio` timestamp NULL DEFAULT NULL,
  `entidad` varchar(255) NOT NULL,
  `unidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `tipo_ejecucion` varchar(50) NOT NULL,
  `fecha_documento` date DEFAULT NULL,
  `documento_adjunto` varchar(255) DEFAULT NULL,
  `numero_compromiso` varchar(50) DEFAULT NULL,
  `numero_devengado` varchar(50) DEFAULT NULL,
  `numero_pago` varchar(50) DEFAULT NULL,
  `numero_foja` varchar(100) DEFAULT NULL,
  `numero_hoja_ruta` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado_administrativo` enum('enviado','pendiente','recibido','rechazado','tesoreria','archivos') DEFAULT 'enviado',
  `enviado_a_tesoreria` tinyint(1) NOT NULL DEFAULT 0,
  `estado_actualizado` timestamp NULL DEFAULT NULL,
  `area_despacho_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_archivo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado_despacho` enum('enviado','pendiente','recibido','rechazado') NOT NULL DEFAULT 'enviado',
  `estado_tesoreria` enum('enviado','pendiente','recibido','rechazado') NOT NULL DEFAULT 'enviado',
  `tesoreria_actualizado` timestamp NULL DEFAULT NULL,
  `despacho_actualizado` timestamp NULL DEFAULT NULL,
  `ubicacion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `enviado_a_despacho` tinyint(1) NOT NULL DEFAULT 0,
  `estado_actual` varchar(255) NOT NULL DEFAULT 'smaf'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `financieras`
--

INSERT INTO `financieras` (`id`, `codigo`, `enviado_archivo`, `fecha_envio`, `entidad`, `unidad_id`, `tipo_documento`, `tipo_ejecucion`, `fecha_documento`, `documento_adjunto`, `numero_compromiso`, `numero_devengado`, `numero_pago`, `numero_foja`, `numero_hoja_ruta`, `created_at`, `updated_at`, `area_id`, `estado_administrativo`, `enviado_a_tesoreria`, `estado_actualizado`, `area_despacho_id`, `area_archivo_id`, `estado_despacho`, `estado_tesoreria`, `tesoreria_actualizado`, `despacho_actualizado`, `ubicacion_id`, `enviado_a_despacho`, `estado_actual`) VALUES
(1, 'FIN-202601-001', 'enviado', '2026-01-14 04:10:51', 'Gobierno Autonomo Municipal de Viacha', 2, 'Original', 'Efectivo', '2025-11-17', NULL, '1', '0', '1', '102', '10', '2025-11-18 08:27:46', '2026-01-25 04:56:07', 1, 'pendiente', 0, '2025-12-11 04:26:56', 1, 1, 'recibido', 'recibido', '2026-01-20 06:15:15', '2025-12-10 18:34:55', 128, 1, 'smaf'),
(2, 'FIN-202601-002', 'enviado', '2026-01-20 06:27:25', 'Gobierno Autonomo Municipal de Viacha', 3, 'Original', 'Efectivo', '2025-11-18', NULL, '1', '0', '12', '200', '21', '2025-11-18 18:55:54', '2026-01-20 06:28:41', 1, 'enviado', 1, NULL, 1, 1, 'recibido', 'enviado', NULL, '2025-12-10 18:36:36', 132, 1, 'smaf'),
(3, 'FIN-202601-003', 'enviado', '2026-01-20 06:40:00', 'Gobierno Autonomo Municipal de Viacha', 2, 'Original', 'Efectivo', '2025-11-18', NULL, '1', '0', '1', '122', '12', '2025-11-18 22:04:52', '2026-01-20 06:40:54', 1, 'recibido', 1, '2025-12-10 05:41:47', 1, 1, 'recibido', 'recibido', '2026-01-20 06:40:26', '2025-12-10 18:58:17', 758, 1, 'smaf'),
(4, NULL, 'pendiente', '2025-12-10 08:02:05', 'Gobierno Autonomo Municipal de Viacha', 3, 'Original', 'Efectivo', '2025-11-18', NULL, '1', '0', '1', NULL, NULL, '2025-12-10 08:00:19', '2025-12-10 18:16:59', 1, 'enviado', 1, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 1, 'smaf'),
(5, 'FIN-202601-004', 'enviado', '2026-01-25 04:58:30', 'Gobierno Autonomo Municipal de Viacha', 2, 'Original', 'Efectivo', '2026-01-24', NULL, '1', '0', '1', '24', '244', '2026-01-25 01:49:36', '2026-01-25 04:58:52', 1, 'recibido', 0, '2026-01-25 01:52:15', 1, 1, 'recibido', 'recibido', '2026-01-25 01:56:40', '2026-01-25 01:54:08', 133, 1, 'smaf'),
(6, NULL, 'pendiente', '2026-01-26 01:50:35', 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2025-03-15', NULL, '1', '0', '1', '21', '211', '2026-01-26 01:35:49', '2026-01-26 03:47:27', 1, 'enviado', 1, NULL, 1, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 1, 'smaf'),
(7, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 01:37:48', '2026-01-26 01:37:48', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(8, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 8, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 01:41:31', '2026-01-26 01:41:31', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(9, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 01:43:16', '2026-01-26 01:43:16', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(10, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 8, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 01:48:44', '2026-01-26 01:48:44', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(11, NULL, 'pendiente', NULL, 'Gobierno Autonomo Municipal de Viacha', 5, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 01:56:14', '2026-01-26 01:56:14', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(12, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 5, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 01:57:52', '2026-01-26 01:57:52', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(13, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 02:01:19', '2026-01-26 02:01:19', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(14, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 02:36:09', '2026-01-26 02:36:09', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(15, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 02:38:21', '2026-01-26 02:38:21', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(16, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 02:51:09', '2026-01-26 02:51:09', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(17, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 02:53:27', '2026-01-26 02:53:27', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(18, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 03:01:07', '2026-01-26 03:01:07', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(19, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 8, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 03:04:23', '2026-01-26 03:04:23', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(20, NULL, 'pendiente', NULL, 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 03:09:56', '2026-01-26 03:09:56', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 0, 'smaf'),
(21, NULL, 'pendiente', '2026-02-23 22:46:10', 'Gobierno Autónomo Municipal de Viacha', 7, 'Original', 'Efectivo', '2026-01-25', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 03:11:09', '2026-02-23 22:46:10', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 1, 'smaf'),
(22, NULL, 'pendiente', '2026-01-27 20:47:27', 'Gobierno Autónomo Municipal de Viacha', 3, 'Original', 'Efectivo', '2025-05-10', NULL, '1', '0', '1', NULL, NULL, '2026-01-26 03:27:57', '2026-01-27 20:47:27', 1, 'enviado', 0, NULL, NULL, NULL, 'enviado', 'enviado', NULL, NULL, NULL, 1, 'smaf'),
(23, 'FIN-202601-005', 'enviado', '2026-01-27 04:51:39', 'Gobierno Autonomo Municipal de Viacha', 2, 'Original', 'Efectivo', '2026-01-26', NULL, '1', '0', '1', '100', '1001', '2026-01-27 04:45:06', '2026-01-27 04:54:13', 1, 'recibido', 1, '2026-01-27 04:46:59', 1, 1, 'recibido', 'recibido', '2026-01-27 04:52:36', '2026-01-27 04:51:29', 821, 1, 'smaf'),
(24, 'FIN-202601-006', 'enviado', '2026-01-28 02:40:36', 'Gobierno Autonomo Municipal de Viacha', 2, 'Original', 'Efectivo', '2026-01-27', NULL, '1', '0', '1', '200', '2011', '2026-01-28 02:37:13', '2026-01-28 02:42:46', 1, 'enviado', 1, NULL, 1, 1, 'enviado', 'enviado', NULL, NULL, 884, 1, 'smaf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_archivos`
--

CREATE TABLE `historial_archivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `archivo_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_evento` varchar(100) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `id_financiera` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(163, '2025_04_13_214824_create_users_table', 1),
(164, '2025_04_13_221316_create_unidades_table', 1),
(165, '2025_05_17_130233_create_categorias_table', 1),
(166, '2025_05_17_130305_create_financieras_table', 1),
(167, '2025_05_17_130327_create_archivos_table', 1),
(168, '2025_05_17_130420_create_historial_archivos_table', 1),
(169, '2025_05_17_130535_create_acciones_virtual_table', 1),
(170, '2025_05_17_130557_create_asistente_virtual_table', 1),
(171, '2025_05_17_130606_create_cache_table', 1),
(172, '2025_05_19_194419_create_permission_tables', 1),
(173, '2025_06_02_181509_add_two_factor_columns_to_users_table', 1),
(174, '2025_06_26_014650_create_areas_table', 1),
(175, '2025_06_26_015051_add_area_id_to_financieras_table', 1),
(176, '2025_06_27_020707_add_estado_administrativo_to_financieras_table', 1),
(177, '2025_07_03_014342_add_documento_adjunto_to_archivos_table', 1),
(178, '2025_07_09_165152_create_preventivos_table', 1),
(179, '2025_07_14_220950_change_numero_secuencia_nullable_on_preventivos_table', 1),
(180, '2025_07_23_154711_add_module_and_description_to_permissions_table', 1),
(181, '2025_08_07_134547_modify_estado_administrativo_enum_in_financieras_table', 2),
(182, '2025_08_08_152113_add_beneficiario_to_preventivos_table', 3),
(183, '2025_08_08_170954_create_areas_despacho_table', 4),
(184, '2025_08_08_171027_create_areas_archivos_table', 4),
(185, '2025_08_08_171047_add_area_despacho_id_and_area_archivo_id_to_financieras_table', 4),
(186, '2025_08_08_182527_add_enviado_a_tesoreria_to_financieras_table', 5),
(188, '2025_08_08_182815_add_enviado_a_tesoreria_to_financieras_table', 6),
(189, '2025_08_13_165731_fix_numero_secuencia_in_preventivos', 7),
(190, '2025_08_14_181302_add_estado_despacho_to_financieras_table', 8),
(191, '2025_08_27_183627_add_fields_to_financieras_table', 9),
(192, '2025_09_11_182621_add_fecha_envio_to_financieras_table', 10),
(193, '2025_09_12_171633_add_fecha_envio_to_areas_table', 11),
(194, '2025_09_17_134139_add_fecha_envio_to_areas_despacho_table', 12),
(195, '2025_09_17_162244_add_fecha_envio_to_areas_archivos_table', 13),
(196, '2025_09_30_182617_create_ubicaciones_table', 14),
(199, '2025_09_30_184242_create_prestamos_archivos_table', 15),
(201, '2025_10_01_152009_remove_ubicacion_id_from_financieras_table', 16),
(202, '2025_10_01_152314_drop_ubicaciones_table', 17),
(203, '2025_10_01_153706_create_ubicaciones_table', 18),
(204, '2025_10_01_155657_add_ubicacion_id_to_financieras_table', 18),
(205, '2025_10_06_144101_add_estado_tesoreria_to_financieras_table', 19),
(206, '2025_10_17_160255_add_campos_to_prestamos_archivos_table', 20),
(207, '2025_11_11_143612_create_prestamo_archivocentral_table', 21),
(208, '2025_11_13_185616_remove_estado_documento_from_financieras_table', 22),
(209, '2025_11_14_160348_remove_fecha_envio_from_financieras_table', 23),
(210, '2025_11_14_160500_add_enviado_a_despacho_to_financieras_table', 24),
(211, '2025_11_14_224217_add_fecha_envio_to_financieras_table', 25),
(212, '2025_11_14_232231_create_notificaciones_table', 26),
(213, '2025_11_14_232521_add_estado_actual_to_financieras_table', 26),
(214, '2025_11_17_190530_modificar_mensaje_notificaciones', 27),
(215, '2026_02_14_145516_add_two_factor_columns_to_users_table', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `financiera_id` bigint(20) UNSIGNED NOT NULL,
  `de_area` varchar(255) NOT NULL,
  `para_area` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `financiera_id`, `de_area`, `para_area`, `mensaje`, `leido`, `created_at`, `updated_at`) VALUES
(55, 1, 'SMAF', 'Despacho', 'Se envió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 36.11.1.1', 1, '2025-11-18 08:31:54', '2025-11-18 08:32:07'),
(56, 1, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 36.11.1.1, N° Foja: 100, N° Hoja Ruta: 10', 1, '2025-11-18 08:36:54', '2025-11-18 08:49:28'),
(57, 2, 'SMAF', 'Despacho', 'Se envió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Educacion, Preventivo: 36.11', 1, '2025-11-18 18:56:01', '2025-11-18 19:58:51'),
(58, 2, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Direccion de Salud, Preventivo: 36.11.5', 1, '2025-11-18 21:51:15', '2025-11-18 21:51:36'),
(60, 1, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 36.11.1.1', 1, '2025-11-18 22:01:13', '2025-11-18 22:05:07'),
(61, 2, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Direccion de Salud, Preventivo: 36.11.5', 1, '2025-11-18 22:01:24', '2025-11-18 22:05:17'),
(64, 3, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 30.11.1.1', 1, '2025-12-10 05:38:29', '2025-12-10 05:38:42'),
(65, 3, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 30.11.1.1', 1, '2025-12-10 05:40:28', '2025-12-10 05:40:40'),
(66, 1, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 36.11.1.1, N° Foja: 102, N° Hoja Ruta: 10', 1, '2025-12-10 05:57:12', '2025-12-10 05:57:25'),
(67, 4, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Direccion de Salud, Preventivo: 20.2.2', 1, '2025-12-10 08:02:05', '2025-12-10 08:03:16'),
(68, 2, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Direccion de Salud, Preventivo: 36.11.5, N° Foja: 200, N° Hoja Ruta: 21', 1, '2025-12-10 18:05:31', '2025-12-10 18:21:40'),
(69, 3, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 30.11.1.1, N° Foja: 122, N° Hoja Ruta: 12', 1, '2025-12-10 18:05:38', '2025-12-10 18:21:47'),
(70, 4, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Direccion de Salud, Preventivo: 20.2.2, N° Foja: , N° Hoja Ruta: ', 1, '2025-12-10 18:16:59', '2025-12-10 18:21:53'),
(71, 1, 'Tesoreria', 'Archivo', 'Se envió una financiera a Archivos: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivos: N° Preventivo: 36.11.1.1, Secuencia: 36.11.2, Beneficiario: Carlos, N° Foja: 102, N° Hoja Ruta: 10', 1, '2026-01-14 04:10:51', '2026-01-14 04:11:06'),
(72, 2, 'Tesoreria', 'Archivo', 'Se envió una financiera a Archivos: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Direccion de Salud, Preventivos: N° Preventivo: 36.11.5, Secuencia: 36.11.5.1, Beneficiario: Daniela Mendez, N° Foja: 200, N° Hoja Ruta: 21', 1, '2026-01-20 06:27:25', '2026-01-20 06:27:39'),
(73, 3, 'Tesoreria', 'Archivo', 'Se envió una financiera a Archivos: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivos: N° Preventivo: 30.11.1.1, Secuencia: 30.11.1.2.1, Beneficiario: Juana, N° Foja: 122, N° Hoja Ruta: 12', 1, '2026-01-20 06:40:00', '2026-01-20 06:40:14'),
(74, 5, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 30.11.1.1', 1, '2026-01-25 01:50:24', '2026-01-25 01:50:48'),
(75, 5, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 30.11.1.1, N° Foja: 24, N° Hoja Ruta: 244', 1, '2026-01-25 01:53:09', '2026-01-25 01:53:34'),
(76, 5, 'Tesoreria', 'Archivo', 'Se envió una financiera a Archivos: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivos: N° Preventivo: 30.11.1.1, Secuencia: 30.11.1.2.1, Beneficiario: Juana | N° Preventivo: 30.11.1.1, Secuencia: 30.11.1.3.1, Beneficiario: Marco | N° Preventivo: 30.11.1.1, Secuencia: 30.11.2, Beneficiario: Maria, N° Foja: 24, N° Hoja Ruta: 244', 1, '2026-01-25 01:55:10', '2026-01-25 01:55:26'),
(77, 5, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 30.11.1.1', 1, '2026-01-25 04:58:30', '2026-01-25 04:58:41'),
(78, 6, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autónomo Municipal de Viacha, Unidad: Obras Publicas y Gestión Ambiental, Preventivo: 1175.1.1', 1, '2026-01-26 01:50:35', '2026-01-26 03:37:55'),
(79, 6, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autónomo Municipal de Viacha, Unidad: Obras Publicas y Gestión Ambiental, Preventivo: 1175.1.1, N° Foja: 21, N° Hoja Ruta: 211', 1, '2026-01-26 03:47:27', '2026-01-27 04:48:44'),
(80, 23, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 101.1.1', 1, '2026-01-27 04:45:43', '2026-01-27 04:46:16'),
(81, 23, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 101.1.1, N° Foja: 100, N° Hoja Ruta: 1001', 1, '2026-01-27 04:48:04', '2026-01-27 04:48:55'),
(82, 23, 'Tesoreria', 'Archivo', 'Se envió una financiera a Archivos: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivos: N° Preventivo: 101.1.1, Secuencia: 101.1.1.2, Beneficiario: Luis Campos, N° Foja: 100, N° Hoja Ruta: 1001', 1, '2026-01-27 04:51:39', '2026-01-27 04:51:53'),
(83, 22, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autónomo Municipal de Viacha, Unidad: Direccion de Salud, Preventivo: 36.13.1.1', 1, '2026-01-27 20:47:27', '2026-01-27 20:47:40'),
(84, 24, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 201.1.1', 1, '2026-01-28 02:37:29', '2026-01-28 02:37:50'),
(85, 24, 'Despacho', 'Tesoreria', 'Se envió una financiera a Tesorería: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivo: 201.1.1, N° Foja: 200, N° Hoja Ruta: 2011', 1, '2026-01-28 02:39:24', '2026-01-28 02:39:36'),
(86, 24, 'Tesoreria', 'Archivo', 'Se envió una financiera a Archivos: Entidad: Gobierno Autonomo Municipal de Viacha, Unidad: Tecnologias de Informacion y Comunicacion, Preventivos: N° Preventivo: 201.1.1, Secuencia: 201.1.2, Beneficiario: Guddy Ticona, N° Foja: 200, N° Hoja Ruta: 2011', 1, '2026-01-28 02:40:36', '2026-01-28 02:40:45'),
(87, 21, 'SMAF', 'Despacho', 'Se reenvió una financiera: Entidad: Gobierno Autónomo Municipal de Viacha, Unidad: Obras Publicas y Gestión Ambiental, Preventivo: 1339.1.1', 0, '2026-02-23 22:46:10', '2026-02-23 22:46:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `module`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'despacho.index', 'despacho', 'ver listado de registro de despacho', 'web', '2025-07-28 05:24:17', '2025-07-28 05:24:17'),
(2, 'despacho.create', 'despacho', 'Registrar datos en despacho', 'web', '2025-07-28 17:34:21', '2025-07-28 17:34:21'),
(3, 'despacho.edit', 'despacho', 'Editar datos en el registro despacho', 'web', '2025-07-28 17:34:49', '2025-07-28 17:34:49'),
(4, 'despacho.destroy', 'despacho', 'Eliminar datos en el registro despacho', 'web', '2025-07-28 17:35:31', '2025-12-10 18:53:06'),
(5, 'smaf.create', 'smaf', 'crear datos en el registro smaf', 'web', '2025-07-28 17:36:06', '2025-07-28 17:36:06'),
(6, 'smaf.index', 'smaf', 'ver listado de datos en el registro smaf', 'web', '2025-07-28 17:36:40', '2025-07-28 17:36:40'),
(7, 'smaf.edit', 'smaf', 'editar datos en el registro smaf', 'web', '2025-07-28 17:37:03', '2025-07-28 17:37:03'),
(8, 'smaf.destroy', 'smaf', 'eliminar datos en el registro smaf', 'web', '2025-07-28 17:37:30', '2025-07-28 17:37:30'),
(9, 'unidades.index', 'unidades', 'ver listado del registro unidades', 'web', '2025-07-28 21:49:44', '2025-07-28 21:49:44'),
(10, 'unidades.create', 'unidades', 'crear datos en el registro unidades', 'web', '2025-07-28 21:51:01', '2025-07-28 21:51:01'),
(11, 'unidades.edit', 'unidades', 'editar datos del registro unidades', 'web', '2025-07-28 22:01:04', '2025-07-28 22:01:04'),
(12, 'unidades.destroy', 'unidades', 'eliminar datos del registro unidades', 'web', '2025-07-28 22:06:43', '2025-07-28 22:06:43'),
(13, 'tesoreria.index', 'tesoreria', 'Ver listado de registro de tesorería', 'web', '2025-12-10 05:28:27', '2025-12-10 05:28:27'),
(14, 'tesoreria.create', 'tesoreria', 'Crear datos en tesorería', 'web', '2025-12-10 05:29:14', '2025-12-10 05:29:14'),
(15, 'tesoreria.edit', 'tesoreria', 'Editar datos en el registro tesorería', 'web', '2025-12-10 05:30:24', '2025-12-10 05:30:24'),
(16, 'tesoreria.destroy', 'tesoreria', 'Eliminar datos en el registro tesorería', 'web', '2025-12-10 05:30:42', '2025-12-10 05:30:42'),
(17, 'areas.index', 'Actas smaf', 'Ver listado de actas de smaf', 'web', '2025-12-10 06:12:35', '2025-12-10 06:12:35'),
(18, 'areas.create', 'Actas smaf', 'Crear un campo para actas', 'web', '2025-12-10 06:13:05', '2025-12-10 06:13:05'),
(19, 'areas.show', 'Actas smaf', 'Ver registros de actas en reporte de smaf', 'web', '2025-12-10 06:13:42', '2025-12-10 06:13:42'),
(20, 'areas.destroy', 'Actas smaf', 'Eliminar registro', 'web', '2025-12-10 06:14:11', '2025-12-10 06:14:11'),
(21, 'areas-despacho.index', 'Actas despacho', 'Ver listado de actas despacho', 'web', '2025-12-10 06:24:54', '2025-12-10 06:24:54'),
(22, 'areas-despacho.create', 'Actas despacho', 'Crear el registro de actas', 'web', '2025-12-10 06:27:43', '2025-12-10 06:27:43'),
(23, 'areas-despacho.edit', 'Actas despacho', 'Editar datos en el registro', 'web', '2025-12-10 06:28:22', '2025-12-10 06:28:22'),
(24, 'areas-despacho.show', 'Actas despacho', 'Ver el listado de actas despacho', 'web', '2025-12-10 06:29:04', '2025-12-10 06:29:04'),
(25, 'areas-despacho.destroy', 'Actas despacho', 'Eliminar registro', 'web', '2025-12-10 06:29:39', '2025-12-10 06:29:39'),
(26, 'areas-archivos.index', 'Actas tesoreria', 'Ver listado de actas tesoreria', 'web', '2025-12-10 06:31:51', '2025-12-10 06:31:51'),
(27, 'areas-archivos.create', 'Actas tesoreria', 'Crear registro de actas', 'web', '2025-12-10 06:33:26', '2025-12-10 06:33:26'),
(28, 'areas-archivos.edit', 'Actas tesoreria', 'Editar registro de actas', 'web', '2025-12-10 06:34:03', '2025-12-10 06:34:03'),
(29, 'areas-archivos.show', 'Actas tesoreria', 'Ver listado de reportes actas tesoreria', 'web', '2025-12-10 06:34:54', '2025-12-10 06:34:54'),
(30, 'areas-archivos.destroy', 'Actas tesoreria', 'Eliminar registro', 'web', '2025-12-10 06:35:30', '2025-12-10 06:35:30'),
(31, 'ubicaciones.index', 'Ubicaciones', 'Listado ubicaciones de archivos financieros', 'web', '2025-12-10 06:38:06', '2025-12-10 06:38:06'),
(32, 'ubicaciones.create', 'Ubicaciones', 'Crear nuevos estantes de ubicaciones', 'web', '2025-12-10 06:39:07', '2025-12-10 06:39:07'),
(33, 'ubicaciones.edit', 'Ubicaciones', 'Editar ubicaciones creadas', 'web', '2025-12-10 06:39:47', '2025-12-10 06:40:06'),
(34, 'ubicaciones.show', 'Ubicaciones', 'Ver listado de archivos financieros asignados en el estante', 'web', '2025-12-10 06:40:50', '2025-12-10 06:40:50'),
(35, 'ubicaciones.destroy', 'Ubicaciones', 'Eliminar la asignacion de archivos financieras', 'web', '2025-12-10 06:41:28', '2025-12-10 06:41:28'),
(36, 'financieras.index', 'Financieras', 'Listado de registros', 'web', '2025-12-10 06:43:43', '2025-12-10 06:43:43'),
(37, 'financieras.create', 'Financieras', 'Crear registros', 'web', '2025-12-10 06:44:14', '2025-12-10 06:44:14'),
(38, 'financieras.edit', 'Financieras', 'Editar registros', 'web', '2025-12-10 06:44:52', '2025-12-10 06:44:52'),
(39, 'financieras.show', 'Financieras', 'Ver listado de registros financieros', 'web', '2025-12-10 06:45:26', '2025-12-10 06:45:26'),
(40, 'financieras.destroy', 'Financieras', 'Eliminar registros financieras', 'web', '2025-12-10 06:48:59', '2025-12-10 06:48:59'),
(41, 'prestamos.index', 'Prestamos archivo financiero', 'Listado de prestamos de archivos financieros', 'web', '2025-12-10 06:49:57', '2025-12-10 06:49:57'),
(42, 'prestamos.create', 'Prestamos archivo financiero', 'Registrar prestamo  de archivos', 'web', '2025-12-10 06:50:35', '2025-12-10 06:50:35'),
(43, 'prestamos.edit', 'Prestamos archivo financiero', 'Editar el registro de prestamos', 'web', '2025-12-10 06:50:56', '2025-12-10 06:50:56'),
(44, 'prestamos.show', 'Prestamos archivo financiero', 'Ver el registro de prestamo', 'web', '2025-12-10 06:51:26', '2025-12-10 06:51:26'),
(45, 'prestamos.destroy', 'Prestamos archivo financiero', 'Eliminar registro', 'web', '2025-12-10 06:53:45', '2025-12-10 06:53:45'),
(46, 'prestamo-central.index', 'Prestamo archivo central', 'Listado de archivos prestados central', 'web', '2025-12-10 06:57:22', '2025-12-10 06:57:22'),
(47, 'prestamo-central.create', 'Prestamo archivo central', 'Registrar prestamo de archivo central', 'web', '2025-12-10 06:58:03', '2025-12-10 06:58:03'),
(48, 'prestamo-central.edit', 'Prestamo archivo central', 'Editar prestamo', 'web', '2025-12-10 06:58:39', '2025-12-10 06:58:39'),
(49, 'prestamo-central.show', 'Prestamo archivo central', 'Ver registros prestados', 'web', '2025-12-10 06:59:05', '2025-12-10 06:59:05'),
(50, 'prestamo-central.destroy', 'Prestamo archivo central', 'Eliminar prestamos', 'web', '2025-12-10 06:59:38', '2025-12-10 06:59:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_archivos`
--

CREATE TABLE `prestamos_archivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `financiera_id` bigint(20) UNSIGNED NOT NULL,
  `solicitante` varchar(255) NOT NULL,
  `cargo_departamento` varchar(255) DEFAULT NULL,
  `fecha_prestamo` date NOT NULL,
  `motivo_prestamo` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prestamos_archivos`
--

INSERT INTO `prestamos_archivos` (`id`, `financiera_id`, `solicitante`, `cargo_departamento`, `fecha_prestamo`, `motivo_prestamo`, `observaciones`, `fecha_devolucion`, `created_at`, `updated_at`) VALUES
(8, 1, 'Juan Carlos', 'Encragado de educacion', '2026-01-19', 'nnnn', 'ddd', '2026-01-20', '2026-01-20 03:50:19', '2026-01-20 06:34:02'),
(9, 2, 'Pedro Flores', 'Jefe de direccion en educacion', '2026-01-19', 'Informe tecnico de revision', 'Ninguno', '2026-02-23', '2026-01-20 06:32:06', '2026-02-23 22:47:05'),
(10, 1, 'Juan Andres', 'tecnico', '2026-01-19', 'Verificacion', 'Ninguno', NULL, '2026-01-20 06:35:01', '2026-01-20 06:35:01'),
(11, 3, 'Juan Andres', 'tecnico', '2026-01-19', 'xx', 'ninguna', '2026-02-23', '2026-01-20 06:41:27', '2026-02-23 22:47:02'),
(12, 5, 'Lizeth Huanca', 'Tecnico en TIC', '2026-01-24', 'Revison de datos enviados', 'Ninguna obser...', '2026-01-24', '2026-01-25 02:00:54', '2026-01-25 02:01:25'),
(13, 24, 'Juan Carlos', 'tecnico', '2026-01-27', 'pretamos 27', 'xxx', '2026-01-27', '2026-01-28 02:43:43', '2026-01-28 02:44:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo_archivocentral`
--

CREATE TABLE `prestamo_archivocentral` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `archivo_id` bigint(20) UNSIGNED NOT NULL,
  `solicitante` varchar(255) NOT NULL,
  `cargo_departamento` varchar(255) DEFAULT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `motivo_prestamo` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prestamo_archivocentral`
--

INSERT INTO `prestamo_archivocentral` (`id`, `archivo_id`, `solicitante`, `cargo_departamento`, `fecha_prestamo`, `fecha_devolucion`, `motivo_prestamo`, `observaciones`, `created_at`, `updated_at`) VALUES
(2, 2, 'Carlos Apaza', 'tecnico tic', '2026-01-20', NULL, 'Revision', 'Ninguna', '2026-01-20 18:01:07', '2026-01-20 18:01:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preventivos`
--

CREATE TABLE `preventivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `financiera_id` bigint(20) UNSIGNED NOT NULL,
  `numero_preventivo` varchar(50) NOT NULL,
  `total_pago` decimal(12,3) NOT NULL DEFAULT 0.000,
  `descripcion_gasto` text DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `beneficiario` varchar(150) DEFAULT NULL,
  `numero_secuencia` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preventivos`
--

INSERT INTO `preventivos` (`id`, `financiera_id`, `numero_preventivo`, `total_pago`, `descripcion_gasto`, `empresa`, `beneficiario`, `numero_secuencia`, `created_at`, `updated_at`) VALUES
(103, 1, '36.11.1.1', 78.000, 'descripcion1', 'empresa1', 'Carlos', '36.11.2', '2025-11-18 08:27:46', '2025-12-10 18:47:56'),
(104, 2, '36.11.5', 78.000, 'CONSUL', 'empresa1', 'Daniela Mendez', '36.11.5.1', '2025-11-18 18:55:54', '2026-01-20 06:27:10'),
(106, 3, '30.11.1.1', 653.000, 'compra de discos', 'Tsicon', 'Juana', '30.11.1.2.1', '2025-11-18 22:04:52', '2026-01-20 06:39:50'),
(107, 4, '20.2.2', 2500.000, 'prueba de funcion', 'funcion', NULL, NULL, '2025-12-10 08:00:19', '2025-12-10 08:00:19'),
(108, 5, '30.11.1.1', 233.000, 'truerba', 'emp1', NULL, NULL, '2026-01-25 01:49:36', '2026-01-25 02:03:59'),
(109, 5, '30.11.1.1', 233.000, 'consultores', 'empresa', NULL, NULL, '2026-01-25 01:49:36', '2026-01-25 02:03:59'),
(110, 5, '30.11.1.1', 200.000, 'x2', 'empres', NULL, NULL, '2026-01-25 01:49:36', '2026-01-25 02:03:59'),
(111, 6, '1175.1.1', 3465.000, 'ADQ. CEMENTO U.E. ISRAEL II D-3', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 01:35:49', '2026-01-26 01:35:49'),
(112, 7, '384.1.1', 1755.000, 'ADQ. CEMENTO U.E. COLINA BLANCA D-3', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 01:37:48', '2026-01-26 01:37:48'),
(113, 8, '1167.1.1', 11475.000, 'ADQ. MATERIAL DE FERRETERIA Y OTROS URB. SAN LORENZO', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A. RIVERO QUISBERT ALINA', NULL, NULL, '2026-01-26 01:41:31', '2026-01-26 01:41:31'),
(114, 9, '1174.1.1', 4566.000, 'ADQ. CEMENTO Y OTROS U.E. SANGRAMAYA D-3', 'CHIPANA CHOQUE ROLANDO  SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 01:43:16', '2026-01-26 01:47:19'),
(115, 10, '1240.1.1', 8280.000, 'ADQ. CEMENTO P/ VARIAS URB. DEL D-6', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A', NULL, NULL, '2026-01-26 01:48:44', '2026-01-26 01:48:44'),
(116, 11, '959.1.1', 99992.000, 'CONST. PAVIMENTO RIGIDO AV. HACIA EL MAR C/ HUGO ORTIZ D-1', 'PIZA ESPINOZA MARIO', NULL, NULL, '2026-01-26 01:56:14', '2026-01-26 01:56:14'),
(117, 12, '771.1.1', 2.163, 'ADQ. CEMENTO URB. JOSE BALLIVIAN “A” D-6', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 01:57:52', '2026-01-26 01:59:29'),
(118, 13, '769.1.1', 3.371, 'ADQ. CEMENTO URB. NUEVO AMANECER D-6', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A', NULL, NULL, '2026-01-26 02:01:19', '2026-01-26 02:01:19'),
(119, 14, '983.1.1', 12990.000, 'ADQ. MATERIAL DE FERRETERIA URB. SAN LORENZO D-6', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A. ESPINOZA SIRPA CATALINA', NULL, NULL, '2026-01-26 02:36:09', '2026-01-26 02:36:09'),
(120, 15, '853.1.1', 19970.000, 'ADQ. CEMENTO URB. NUEVO AMANECER D-6', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 02:38:21', '2026-01-26 02:38:21'),
(121, 16, '760.1.1', 15900.000, 'ADQ. CEMENTO URB. WARA, RODRIGO, SAN MARTIN, ROSALES, SANTIAGO Y SANTA ISABEL II D-6', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A', NULL, NULL, '2026-01-26 02:51:09', '2026-01-26 02:51:09'),
(122, 17, '798.1.1', 5978.000, 'ADQ. CEMENTO URB. NUEVA ESPERANZA D-6', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 02:53:27', '2026-01-26 02:53:27'),
(123, 18, '813.1.1', 7175.000, 'ADQ. LADRILLO GAMBOTE U.E. CHACOMA ALTA D-3', 'QUISPE FLORES DELIA', NULL, NULL, '2026-01-26 03:01:07', '2026-01-26 03:04:47'),
(124, 19, '1335.1.1', 14175.000, 'ADQ. CEMENTO PARA VARIAS ZONAS DEL D-2', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 03:04:23', '2026-01-26 03:04:23'),
(125, 20, '1337.1.1', 12150.000, 'ADQ. CEMENTO PARA VARIAS ZONAS DEL D-2', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 03:09:56', '2026-01-26 03:09:56'),
(126, 21, '1339.1.1', 14175.000, 'ADQ. CEMENTO PARA VARIAS ZONAS DEL D-2', 'SOCIEDAD BOLIVIANA DE CEMENTO S.A.', NULL, NULL, '2026-01-26 03:11:09', '2026-01-26 03:11:09'),
(127, 22, '36.13.1.1', 5462.000, 'CONSULTORES (PERSONAL MEDICO HOSP. 2º NIVEL) MES MAYO 2025', 'APAZA CARI SERGIA DEBIE', NULL, NULL, '2026-01-26 03:27:57', '2026-01-26 03:27:57'),
(128, 22, '36.13.1.2', 3982.000, 'CONSULTORES (PERSONAL MEDICO HOSP. 2º NIVEL)', 'CHOQUE PLATA ANA MARIA', NULL, NULL, '2026-01-26 03:27:57', '2026-01-26 03:27:57'),
(129, 22, '36.13.1.3', 3982.000, 'CONSULTORES (PERSONAL MEDICO HOSP. 2º NIVEL)', 'CONDORI LIMACHI CRISTINA', NULL, NULL, '2026-01-26 03:27:57', '2026-01-26 03:27:57'),
(130, 22, '36.13.1.4', 6633.000, 'CONSULTORES (PERSONAL MEDICO HOSP. 2º NIVEL)', 'MOLLO BLANCO JOSE LUIS', NULL, NULL, '2026-01-26 03:27:57', '2026-01-26 03:27:57'),
(131, 22, '36.13.1.5', 3152.000, 'CONSULTORES (PERSONAL MEDICO HOSP. 2º NIVEL)', 'MOLLO CONDORI LUIS BERNARDO', NULL, NULL, '2026-01-26 03:27:57', '2026-01-26 03:27:57'),
(133, 23, '101.1.1', 5200.000, 'prueba de funcion 26', 'empresa 26', 'Luis Campos', '101.1.1.2', '2026-01-27 04:45:07', '2026-01-27 04:51:13'),
(134, 24, '201.1.1', 2500.000, 'preueba 27', 'empresa 27', 'Guddy Ticona', '201.1.2', '2026-01-28 02:37:13', '2026-01-28 02:40:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrador', 'web', '2025-07-28 00:33:03', '2025-07-28 00:33:03'),
(2, 'smaf', 'web', '2025-07-28 00:33:03', '2025-07-28 00:33:03'),
(3, 'despacho', 'web', '2025-07-28 00:33:03', '2025-07-28 00:33:03'),
(4, 'tesoreria', 'web', '2025-07-28 00:33:03', '2025-07-28 00:33:03'),
(5, 'archivos', 'web', '2025-07-28 00:33:03', '2025-07-28 00:33:03'),
(6, 'central', 'web', '2025-12-10 07:29:44', '2025-12-10 07:29:44');

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
(1, 3),
(2, 1),
(2, 3),
(3, 1),
(3, 3),
(3, 4),
(4, 1),
(4, 3),
(4, 4),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 6),
(10, 1),
(10, 6),
(11, 1),
(11, 6),
(12, 1),
(12, 6),
(13, 1),
(13, 4),
(14, 1),
(14, 4),
(15, 1),
(15, 4),
(16, 1),
(16, 4),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 3),
(22, 1),
(22, 3),
(23, 1),
(23, 3),
(24, 1),
(24, 3),
(25, 3),
(26, 1),
(26, 4),
(27, 1),
(27, 4),
(28, 1),
(28, 4),
(29, 1),
(29, 4),
(30, 1),
(30, 4),
(31, 1),
(31, 5),
(32, 1),
(32, 5),
(33, 1),
(33, 5),
(34, 1),
(34, 5),
(35, 1),
(35, 5),
(36, 1),
(36, 2),
(36, 4),
(37, 1),
(38, 1),
(38, 4),
(39, 1),
(39, 2),
(40, 1),
(41, 1),
(41, 5),
(42, 1),
(42, 5),
(43, 1),
(43, 5),
(44, 1),
(44, 5),
(45, 1),
(45, 5),
(46, 1),
(46, 6),
(47, 1),
(47, 6),
(48, 1),
(48, 6),
(49, 1),
(49, 6),
(50, 1),
(50, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
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
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('24zXIrtwuXI2cGSLi4KR8oQUf6K0UNcR6eMej9cv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkhGRldzNzREbkJzRFA2aEpVbUx1bWdqcW1GTmZ5aGFvYkNrS25LMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1771879712);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estante` varchar(255) NOT NULL,
  `fila` int(11) NOT NULL,
  `columna` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `estante`, `fila`, `columna`, `created_at`, `updated_at`) VALUES
(128, 'A', 1, 1, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(132, 'A', 1, 5, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(133, 'A', 1, 6, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(134, 'A', 1, 7, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(135, 'A', 1, 8, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(136, 'A', 1, 9, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(137, 'A', 2, 1, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(138, 'A', 2, 2, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(139, 'A', 2, 3, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(140, 'A', 2, 4, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(141, 'A', 2, 5, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(142, 'A', 2, 6, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(143, 'A', 2, 7, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(144, 'A', 2, 8, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(145, 'A', 2, 9, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(146, 'A', 3, 1, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(147, 'A', 3, 2, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(148, 'A', 3, 3, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(149, 'A', 3, 4, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(150, 'A', 3, 5, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(151, 'A', 3, 6, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(152, 'A', 3, 7, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(153, 'A', 3, 8, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(154, 'A', 3, 9, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(155, 'A', 4, 1, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(156, 'A', 4, 2, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(157, 'A', 4, 3, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(158, 'A', 4, 4, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(159, 'A', 4, 5, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(160, 'A', 4, 6, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(161, 'A', 4, 7, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(162, 'A', 4, 8, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(163, 'A', 4, 9, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(164, 'A', 5, 1, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(165, 'A', 5, 2, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(166, 'A', 5, 3, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(167, 'A', 5, 4, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(168, 'A', 5, 5, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(169, 'A', 5, 6, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(170, 'A', 5, 7, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(171, 'A', 5, 8, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(172, 'A', 5, 9, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(173, 'A', 6, 1, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(174, 'A', 6, 2, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(175, 'A', 6, 3, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(176, 'A', 6, 4, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(177, 'A', 6, 5, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(178, 'A', 6, 6, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(179, 'A', 6, 7, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(180, 'A', 6, 8, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(181, 'A', 6, 9, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(182, 'A', 7, 1, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(183, 'A', 7, 2, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(184, 'A', 7, 3, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(185, 'A', 7, 4, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(186, 'A', 7, 5, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(187, 'A', 7, 6, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(188, 'A', 7, 7, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(189, 'A', 7, 8, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(190, 'A', 7, 9, '2025-10-14 00:59:09', '2025-10-14 00:59:09'),
(758, 'REPORTES', 1, 1, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(759, 'REPORTES', 1, 2, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(760, 'REPORTES', 1, 3, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(761, 'REPORTES', 1, 4, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(762, 'REPORTES', 1, 5, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(763, 'REPORTES', 1, 6, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(764, 'REPORTES', 1, 7, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(765, 'REPORTES', 1, 8, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(766, 'REPORTES', 1, 9, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(767, 'REPORTES', 2, 1, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(768, 'REPORTES', 2, 2, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(769, 'REPORTES', 2, 3, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(770, 'REPORTES', 2, 4, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(771, 'REPORTES', 2, 5, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(772, 'REPORTES', 2, 6, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(773, 'REPORTES', 2, 7, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(774, 'REPORTES', 2, 8, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(775, 'REPORTES', 2, 9, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(776, 'REPORTES', 3, 1, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(777, 'REPORTES', 3, 2, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(778, 'REPORTES', 3, 3, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(779, 'REPORTES', 3, 4, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(780, 'REPORTES', 3, 5, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(781, 'REPORTES', 3, 6, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(782, 'REPORTES', 3, 7, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(783, 'REPORTES', 3, 8, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(784, 'REPORTES', 3, 9, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(785, 'REPORTES', 4, 1, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(786, 'REPORTES', 4, 2, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(787, 'REPORTES', 4, 3, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(788, 'REPORTES', 4, 4, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(789, 'REPORTES', 4, 5, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(790, 'REPORTES', 4, 6, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(791, 'REPORTES', 4, 7, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(792, 'REPORTES', 4, 8, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(793, 'REPORTES', 4, 9, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(794, 'REPORTES', 5, 1, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(795, 'REPORTES', 5, 2, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(796, 'REPORTES', 5, 3, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(797, 'REPORTES', 5, 4, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(798, 'REPORTES', 5, 5, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(799, 'REPORTES', 5, 6, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(800, 'REPORTES', 5, 7, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(801, 'REPORTES', 5, 8, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(802, 'REPORTES', 5, 9, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(803, 'REPORTES', 6, 1, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(804, 'REPORTES', 6, 2, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(805, 'REPORTES', 6, 3, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(806, 'REPORTES', 6, 4, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(807, 'REPORTES', 6, 5, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(808, 'REPORTES', 6, 6, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(809, 'REPORTES', 6, 7, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(810, 'REPORTES', 6, 8, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(811, 'REPORTES', 6, 9, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(812, 'REPORTES', 7, 1, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(813, 'REPORTES', 7, 2, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(814, 'REPORTES', 7, 3, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(815, 'REPORTES', 7, 4, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(816, 'REPORTES', 7, 5, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(817, 'REPORTES', 7, 6, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(818, 'REPORTES', 7, 7, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(819, 'REPORTES', 7, 8, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(820, 'REPORTES', 7, 9, '2025-11-05 23:33:27', '2025-11-05 23:33:27'),
(821, 'AMBIENTE 4', 1, 1, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(822, 'AMBIENTE 4', 1, 2, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(823, 'AMBIENTE 4', 1, 3, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(824, 'AMBIENTE 4', 1, 4, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(825, 'AMBIENTE 4', 1, 5, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(826, 'AMBIENTE 4', 1, 6, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(827, 'AMBIENTE 4', 1, 7, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(828, 'AMBIENTE 4', 1, 8, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(829, 'AMBIENTE 4', 1, 9, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(830, 'AMBIENTE 4', 2, 1, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(831, 'AMBIENTE 4', 2, 2, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(832, 'AMBIENTE 4', 2, 3, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(833, 'AMBIENTE 4', 2, 4, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(834, 'AMBIENTE 4', 2, 5, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(835, 'AMBIENTE 4', 2, 6, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(836, 'AMBIENTE 4', 2, 7, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(837, 'AMBIENTE 4', 2, 8, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(838, 'AMBIENTE 4', 2, 9, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(839, 'AMBIENTE 4', 3, 1, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(840, 'AMBIENTE 4', 3, 2, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(841, 'AMBIENTE 4', 3, 3, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(842, 'AMBIENTE 4', 3, 4, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(843, 'AMBIENTE 4', 3, 5, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(844, 'AMBIENTE 4', 3, 6, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(845, 'AMBIENTE 4', 3, 7, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(846, 'AMBIENTE 4', 3, 8, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(847, 'AMBIENTE 4', 3, 9, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(848, 'AMBIENTE 4', 4, 1, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(849, 'AMBIENTE 4', 4, 2, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(850, 'AMBIENTE 4', 4, 3, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(851, 'AMBIENTE 4', 4, 4, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(852, 'AMBIENTE 4', 4, 5, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(853, 'AMBIENTE 4', 4, 6, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(854, 'AMBIENTE 4', 4, 7, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(855, 'AMBIENTE 4', 4, 8, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(856, 'AMBIENTE 4', 4, 9, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(857, 'AMBIENTE 4', 5, 1, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(858, 'AMBIENTE 4', 5, 2, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(859, 'AMBIENTE 4', 5, 3, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(860, 'AMBIENTE 4', 5, 4, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(861, 'AMBIENTE 4', 5, 5, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(862, 'AMBIENTE 4', 5, 6, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(863, 'AMBIENTE 4', 5, 7, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(864, 'AMBIENTE 4', 5, 8, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(865, 'AMBIENTE 4', 5, 9, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(866, 'AMBIENTE 4', 6, 1, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(867, 'AMBIENTE 4', 6, 2, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(868, 'AMBIENTE 4', 6, 3, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(869, 'AMBIENTE 4', 6, 4, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(870, 'AMBIENTE 4', 6, 5, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(871, 'AMBIENTE 4', 6, 6, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(872, 'AMBIENTE 4', 6, 7, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(873, 'AMBIENTE 4', 6, 8, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(874, 'AMBIENTE 4', 6, 9, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(875, 'AMBIENTE 4', 7, 1, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(876, 'AMBIENTE 4', 7, 2, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(877, 'AMBIENTE 4', 7, 3, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(878, 'AMBIENTE 4', 7, 4, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(879, 'AMBIENTE 4', 7, 5, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(880, 'AMBIENTE 4', 7, 6, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(881, 'AMBIENTE 4', 7, 7, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(882, 'AMBIENTE 4', 7, 8, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(883, 'AMBIENTE 4', 7, 9, '2025-11-05 23:39:59', '2025-11-05 23:39:59'),
(884, 'PAGOS', 1, 1, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(885, 'PAGOS', 1, 2, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(886, 'PAGOS', 1, 3, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(887, 'PAGOS', 1, 4, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(888, 'PAGOS', 1, 5, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(889, 'PAGOS', 1, 6, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(890, 'PAGOS', 1, 7, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(891, 'PAGOS', 1, 8, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(892, 'PAGOS', 1, 9, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(893, 'PAGOS', 2, 1, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(894, 'PAGOS', 2, 2, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(895, 'PAGOS', 2, 3, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(896, 'PAGOS', 2, 4, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(897, 'PAGOS', 2, 5, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(898, 'PAGOS', 2, 6, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(899, 'PAGOS', 2, 7, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(900, 'PAGOS', 2, 8, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(901, 'PAGOS', 2, 9, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(902, 'PAGOS', 3, 1, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(903, 'PAGOS', 3, 2, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(904, 'PAGOS', 3, 3, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(905, 'PAGOS', 3, 4, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(906, 'PAGOS', 3, 5, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(907, 'PAGOS', 3, 6, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(908, 'PAGOS', 3, 7, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(909, 'PAGOS', 3, 8, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(910, 'PAGOS', 3, 9, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(911, 'PAGOS', 4, 1, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(912, 'PAGOS', 4, 2, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(913, 'PAGOS', 4, 3, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(914, 'PAGOS', 4, 4, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(915, 'PAGOS', 4, 5, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(916, 'PAGOS', 4, 6, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(917, 'PAGOS', 4, 7, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(918, 'PAGOS', 4, 8, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(919, 'PAGOS', 4, 9, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(920, 'PAGOS', 5, 1, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(921, 'PAGOS', 5, 2, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(922, 'PAGOS', 5, 3, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(923, 'PAGOS', 5, 4, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(924, 'PAGOS', 5, 5, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(925, 'PAGOS', 5, 6, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(926, 'PAGOS', 5, 7, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(927, 'PAGOS', 5, 8, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(928, 'PAGOS', 5, 9, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(929, 'PAGOS', 6, 1, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(930, 'PAGOS', 6, 2, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(931, 'PAGOS', 6, 3, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(932, 'PAGOS', 6, 4, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(933, 'PAGOS', 6, 5, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(934, 'PAGOS', 6, 6, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(935, 'PAGOS', 6, 7, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(936, 'PAGOS', 6, 8, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(937, 'PAGOS', 6, 9, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(938, 'PAGOS', 7, 1, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(939, 'PAGOS', 7, 2, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(940, 'PAGOS', 7, 3, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(941, 'PAGOS', 7, 4, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(942, 'PAGOS', 7, 5, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(943, 'PAGOS', 7, 6, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(944, 'PAGOS', 7, 7, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(945, 'PAGOS', 7, 8, '2026-01-28 02:42:18', '2026-01-28 02:42:18'),
(946, 'PAGOS', 7, 9, '2026-01-28 02:42:18', '2026-01-28 02:42:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_unidad` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `nombre_unidad`, `descripcion`, `fecha_creacion`, `created_at`, `updated_at`) VALUES
(1, 'Educacion', 'Direccion de educacion', '2025-07-26', '2025-07-28 04:57:59', '2025-07-28 04:57:59'),
(2, 'Tecnologias de Informacion y Comunicacion', 'Unidad encargada de software y hardware', '2025-07-27', '2025-07-28 04:58:58', '2025-07-28 04:58:58'),
(3, 'Direccion de Salud', 'Responsabilidad en salud', '2025-08-29', '2025-08-29 17:21:38', '2025-08-29 17:21:38'),
(4, 'Auditoria Interna', 'Auditoria interna gamv', '2025-11-08', '2025-11-09 06:07:13', '2025-11-09 06:07:13'),
(5, 'Secretaria de Desarrollo Humano', 'Desarrollo Humano', '2026-01-19', '2026-01-19 19:58:52', '2026-01-19 19:58:52'),
(6, 'Medio Ambiente', 'Secretaria de medio ambiente', '2026-01-19', '2026-01-19 20:03:10', '2026-01-19 20:03:10'),
(7, 'Obras Publicas y Gestión Ambiental', 'Secretaria Municipal Obras Publicas y Gestión Ambiental', '2026-01-19', '2026-01-19 20:04:19', '2026-01-19 20:04:19'),
(8, 'Infraestructura', 'Direccion de Infraestructura', '2026-01-19', '2026-01-19 20:06:12', '2026-01-19 20:06:12'),
(9, 'Despacho', 'Direccion de Despacho', '2026-01-19', '2026-01-19 20:06:51', '2026-01-19 20:06:51'),
(10, 'Tesoreria', 'Unidad de Tesoreria', '2026-01-19', '2026-01-19 20:08:12', '2026-01-19 20:08:12'),
(11, 'Smaf', 'Secretaria municipal smaf', '2026-01-25', '2026-01-26 01:29:42', '2026-01-26 01:29:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `two_factor_code` varchar(255) DEFAULT NULL,
  `two_factor_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `fecha_ingreso`, `estado`, `remember_token`, `created_at`, `updated_at`, `two_factor_code`, `two_factor_expires_at`) VALUES
(1, 'Administrador', 'admin@sistema.com', NULL, '$2y$12$m5r5BJ/GsewfVSQUfnjavOAuDq9LDfE/pMh6KG/WEiFwRsUmR/oa2', 'eyJpdiI6ImplaHc3Y1ZHTmRCbm5pTmJLK0swTXc9PSIsInZhbHVlIjoiYzYzZHFNRCtUbUlxM1BUSjE3MmRjYThVR3dQU1pFUlVIZXJGMDg2d2p2TT0iLCJtYWMiOiI1M2E2OGY5NWI5ODAzNzFiNjA4ODUyZjBlNzkwNzA2NmRhN2U2ODkwYWJlOWI2YjRiMmI5NWY2YjE3MTBjMTFlIiwidGFnIjoiIn0=', 'eyJpdiI6IlozZjBkamhsWmJQaWxmVjBxTDZQYnc9PSIsInZhbHVlIjoiZ3F5WlZTOUJ1cUFJb2VOUHk4K2tGMXhCeDYwSnRMa0JKR3JjWWVzaGNGTk90NzIzME40OUE1cGkvZlB1TWdoQTk1dFJlRW91b2E5Yld4MTdrM3lsWGp0L3UxczlMMm5DbkI0ZXhOQ2hIVDNVdnFSNnpielBLZncvWGtYTGdYVklLMExXMnQwUEdZNmlCMytiMXoxN3hQMzNyUlAwanVFV2tOWmJtQlNaaGJHbDIrcnhjUit4STlhYVJ6QmoveHZoVUMxeWhvUlN2eWx0OHM0MnlGSXJwUnZoTmJGOVJkK1J2aXI0alEwNStMd1piWkRyU0wrK3BSaEthajNYdk1VV2x5UkRyU1MwNzRQZ2lEaHZpRy9RbFE9PSIsIm1hYyI6IjY4ZDY5YjQ4NzgzMDJjMDZmMzMzMjAxM2IwZGQ1NjQzNzE1ZGFlYzlmMTZjMzU5ZTQ1YTQ3YWU1NjAzMDA2YzQiLCJ0YWciOiIifQ==', '2026-02-19 04:17:07', '2025-07-27', 'activo', NULL, '2025-07-28 00:33:04', '2026-02-19 04:17:07', NULL, NULL),
(2, 'Encargado smaf', 'smaf@gmail.com', NULL, '$2y$12$LGO7veua2CIMM4gE9n8/FeoSflQvIFbYlyGiP/Y.GBgX5VTNXAj7q', 'eyJpdiI6InhPcDRUR0J1MzhLbkVXZU1tcUs2NUE9PSIsInZhbHVlIjoicHBxYTgwclNxOEM0M0NuN0tHc0owZGExWlFuVFFuL3V2ZWFUL3BDVmJRWT0iLCJtYWMiOiIxMDkyY2M3YTAxMDZmZTQxN2FmODc5YWVkOGUzOWVmMjhhM2Y4MzA3ZjdmMjU0ZTJhOTVkYjRjMGNjNWRiZWJkIiwidGFnIjoiIn0=', 'eyJpdiI6InVCZXRPMUczK0pwZ0laWU1Pa1R3cHc9PSIsInZhbHVlIjoic3RLc1RlTVdQbFg2WUp0MTNJMG5oUmk0WFVRUVRTTFZIZGhnY1grUnRmYThVNmZaTG8zc245N3Y0OHhibUZvWWVDVTlUL1VJOTdDYWNac05OQVlYSmc3MytTVzdJaER2VS9DWnJSRm04azd1WHRockhLdHA1V0svT1BkcXJxeU1ONk1JRlpSdUlqWnIvdG1BeFVteXg1Wmh6YXRqT2VLYndWK2lvTVIzRjBhZGYvOURvbExlTTF3cDlqWDY2c1ljQVZ3WGFwQUNtMVZ5UEhucVJyZmlUUHN6emFubWxEVHNqZzF5d0JYaDlPaHdBT2NwSHFwRUF3UllPUGJDSHluODRWUHRKVk9aQVZGc0IvUEVJdWFFb1E9PSIsIm1hYyI6IjE3NWI4ZDI0N2JhMTkxYTFkODkxMTA1OWYzMDEzZjNlM2YxN2NmNTY0OGM0M2EzYzFiMjJkZjEzZmRlYjJhZjAiLCJ0YWciOiIifQ==', '2026-02-20 06:02:18', '2025-12-07', 'activo', NULL, '2025-12-07 06:22:12', '2026-02-20 06:02:18', NULL, NULL),
(3, 'Encargado despacho', 'despacho@gmail.com', NULL, '$2y$12$KIDqS8kcai9wQe2b/eEMzeFrW/251CgS1FMJ15MteiF.bxgzQG9BS', 'eyJpdiI6InVLWVFrRUVIVzFUcngrM1h1R3NidFE9PSIsInZhbHVlIjoiaDZ3ZWU3bUs3SWpmelQ5ZU9Yc1dONmRycWdxdWxWcDB5L21wUS91azFqMD0iLCJtYWMiOiI4NDM2ZGU4NmJkZGRlZDBhMmRkOTA5MDE0YmFkNDZkM2RkY2VhNGU5YmU3Mjc2Nzc1YmU5NGM3YWZmZDg0YTg3IiwidGFnIjoiIn0=', 'eyJpdiI6IkhwLzgzdUNDdzlYVkUzbkVsNXRWVEE9PSIsInZhbHVlIjoiRnYxbFp3NjFScHNxdmZIcGU3ek9Wdk0xOXNwWGNkR2U0NGhYb1NkYi9pY1RzeTg5RlA0eXJhQ3RuSzFtRHRLMUlPUXRDZW9OSTdZaWQwVGNGdlJvcXE3dWpaRFQ5KzVLRDd6UkJnZnQyc0JOVXRydmVCSjYvTXpvbFhpQU9ucmV6cHdkWGZsV2FIdFh1UFRYOXNZeFB6TlQxT1VLTDVadnFrTHZGWk5OelQ5VlBRTHpPWjJDY2VVbTJFQkluekdaUTg2Q0pFb0dlYi9FZE96UkhRc09UVXhWYnUyY0N4bm5qdnZqVjh3NFl5T1JUTkthT0RZayttMElkVXNiNFd2ZDJnN2ZXSFRJU2FCNlJnQTFMK0Jybnc9PSIsIm1hYyI6ImYyYzNmN2YzZTgwNTczMzcyZjEyYTc2ZDQyOTIzMmJiMzUwNzI3NGVjMWIwNGYzMjM5ZDExNzViY2E2MmZmNGMiLCJ0YWciOiIifQ==', '2026-02-20 05:33:47', '2025-12-07', 'activo', NULL, '2025-12-07 08:18:07', '2026-02-20 05:33:47', NULL, NULL),
(4, 'Encargado tesoreria', 'tesoreria@gmail.com', NULL, '$2y$12$AqDhl8LKT7LBLnhe/lRLJu9heZcuOhQocxtkcnI8CK6XyeX4n6BM.', 'eyJpdiI6ImY0djcxOUZacDB2NllnQnBxR090VHc9PSIsInZhbHVlIjoiWGVaN3dyNlZQZWdCOHNCMWpGNlZyZmgyVFR4QkFXSlEwVk16L2VxekcxOD0iLCJtYWMiOiJjM2YwZjQwZDUyMjBkODUwZmQ3NWVjMjYyMDUwMDgyMjQ3Yjk1Y2Y1NzU0NzJmYWJlNGJlYzMyNTZmYzAxMTg3IiwidGFnIjoiIn0=', 'eyJpdiI6IldHcFczTXNvRkFEVG5XL2hMNzgrd3c9PSIsInZhbHVlIjoiaDNsOERiOXd5VTBuMFZoVEI3UHhXL2xRNlA2RFc4WE1QQ1pTK25US1lPeXVPaDVtbG5TcUYrdzdOYUg1bTcwcVA5TmhWaFBEeXZScnYydzBkUkljY1BKbndWNVY3aXJMSitZanB1bkU1dldZN3Zzckt0b2RUMGt6TUZIY0pQUHA5S09PVmtBVEhsVHBtWW9INEhraVY4cjh3WFM3MTRBTURWbEdwb2VOYi9LYnZkbzJCN3FkVVU2ejE1YkxaSDcvMVM4Y3RjemtlR3Rza1hYUE5RUVIzemxwQ0VtSlF0SjhITGMvMHJKem0rQ0hob2QwcGRLcWVMMDZTYzg3RlZTdTk3UXBpVENoYm4zekhPWExYM0FvWEE9PSIsIm1hYyI6IjBhNDEwM2VjMDA3ZWI1NDU0MmJlZWY2MGYxZWUxN2U3ZmNlYzZmZTBkNjlmMDI4N2QwZjgwYWQ5MmM5YzM5NmMiLCJ0YWciOiIifQ==', '2026-02-18 06:32:09', '2025-12-10', 'activo', NULL, '2025-12-10 18:19:48', '2026-02-18 06:32:09', NULL, NULL),
(5, 'central', 'central@gmail.com', NULL, '$2y$12$TriV9/zkX03VLT57J/inYuTyq.O2VeZ0Ng7.jRamlKW.plA6aG2Vi', 'eyJpdiI6Ik9NQ0FJOW5rZENrWVFYNmZwc1I1aVE9PSIsInZhbHVlIjoidU9jbGtLaEZZS3M4dHNLUHVqMHUycGVHdER2THhvYjNiUlVDcVk2TTdUMD0iLCJtYWMiOiJiZWU0N2JlOTY3Mzc1ZWNmNTEwOGE5ODYyMTk1MWY0NTA2YzJiNTc0MzE4ZjU3YTQ2ZjYwYjQxMWQ5MjI0MzcxIiwidGFnIjoiIn0=', 'eyJpdiI6IjBNZmk5RjROeGIydi9ZR1hRelVRc0E9PSIsInZhbHVlIjoiUDNUM3JuSURSTjZhYVBxV2ZENEtLemtqQXF0Ty8vUnhJWFdDeVFibTJPbEtzR2NqUEhrUkJ4RXllN01GM0xRRC85T1c4U1M5Y0NmK2taMEpBdUIyQTVwdTU3UTZocTI1eUM2NU9LMVFCU282djk4Y1c0bTl1Y1RXdEtiQ080eXQySUhuU0MvUHhwamNaZzlEeGF1bHUvSXZia2JwNnRIT0tFQWFjbXNYNzJPVmdVUnlzSGxSUG9iY2tyc1lKR0RRS1dSdlpyWk5IQ3JhTFZhb3RHUjUrOVpSKzNHQzVLYUdkNm4xM1Y0SVNJWUI1a0FRS1g4NTFIUkd0NEFFK1FSRUcrTGhMR0t6SkZ4SWJ6VEZnMWd1Q2c9PSIsIm1hYyI6IjEzZjQ1YmI2M2FiMWE3ZjBkYWJmNGY4YzUzMzg2ZDgyZGNhNjU4N2FhOTY5Nzc4MDhiMjE2N2E4NzYwOTcyMTEiLCJ0YWciOiIifQ==', '2026-02-20 06:06:42', '2026-02-14', '1', NULL, '2026-02-14 04:51:26', '2026-02-20 06:06:42', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones_virtual`
--
ALTER TABLE `acciones_virtual`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `archivos_codigo_archivo_unique` (`codigo_archivo`),
  ADD KEY `archivos_unidad_id_foreign` (`unidad_id`),
  ADD KEY `archivos_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas_archivos`
--
ALTER TABLE `areas_archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas_despacho`
--
ALTER TABLE `areas_despacho`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistente_virtual`
--
ALTER TABLE `asistente_virtual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistente_virtual_user_id_foreign` (`user_id`),
  ADD KEY `asistente_virtual_accion_id_foreign` (`accion_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `financieras`
--
ALTER TABLE `financieras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `financieras_codigo_unique` (`codigo`),
  ADD KEY `financieras_unidad_id_foreign` (`unidad_id`),
  ADD KEY `financieras_area_id_foreign` (`area_id`),
  ADD KEY `financieras_area_despacho_id_foreign` (`area_despacho_id`),
  ADD KEY `financieras_area_archivo_id_foreign` (`area_archivo_id`),
  ADD KEY `financieras_ubicacion_id_foreign` (`ubicacion_id`);

--
-- Indices de la tabla `historial_archivos`
--
ALTER TABLE `historial_archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historial_archivos_archivo_id_foreign` (`archivo_id`),
  ADD KEY `historial_archivos_user_id_foreign` (`user_id`),
  ADD KEY `historial_archivos_id_financiera_foreign` (`id_financiera`);

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
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notificaciones_financiera_id_foreign` (`financiera_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `prestamos_archivos`
--
ALTER TABLE `prestamos_archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestamos_archivos_financiera_id_foreign` (`financiera_id`);

--
-- Indices de la tabla `prestamo_archivocentral`
--
ALTER TABLE `prestamo_archivocentral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestamo_archivocentral_archivo_id_foreign` (`archivo_id`);

--
-- Indices de la tabla `preventivos`
--
ALTER TABLE `preventivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preventivos_financiera_id_foreign` (`financiera_id`);

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
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones_virtual`
--
ALTER TABLE `acciones_virtual`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `areas_archivos`
--
ALTER TABLE `areas_archivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `areas_despacho`
--
ALTER TABLE `areas_despacho`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asistente_virtual`
--
ALTER TABLE `asistente_virtual`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `financieras`
--
ALTER TABLE `financieras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `historial_archivos`
--
ALTER TABLE `historial_archivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `prestamos_archivos`
--
ALTER TABLE `prestamos_archivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `prestamo_archivocentral`
--
ALTER TABLE `prestamo_archivocentral`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `preventivos`
--
ALTER TABLE `preventivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=947;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `archivos_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `asistente_virtual`
--
ALTER TABLE `asistente_virtual`
  ADD CONSTRAINT `asistente_virtual_accion_id_foreign` FOREIGN KEY (`accion_id`) REFERENCES `acciones_virtual` (`id`),
  ADD CONSTRAINT `asistente_virtual_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `financieras`
--
ALTER TABLE `financieras`
  ADD CONSTRAINT `financieras_area_archivo_id_foreign` FOREIGN KEY (`area_archivo_id`) REFERENCES `areas_archivos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `financieras_area_despacho_id_foreign` FOREIGN KEY (`area_despacho_id`) REFERENCES `areas_despacho` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `financieras_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `financieras_ubicacion_id_foreign` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicaciones` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `financieras_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `historial_archivos`
--
ALTER TABLE `historial_archivos`
  ADD CONSTRAINT `historial_archivos_archivo_id_foreign` FOREIGN KEY (`archivo_id`) REFERENCES `archivos` (`id`),
  ADD CONSTRAINT `historial_archivos_id_financiera_foreign` FOREIGN KEY (`id_financiera`) REFERENCES `financieras` (`id`),
  ADD CONSTRAINT `historial_archivos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_financiera_id_foreign` FOREIGN KEY (`financiera_id`) REFERENCES `financieras` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `prestamos_archivos`
--
ALTER TABLE `prestamos_archivos`
  ADD CONSTRAINT `prestamos_archivos_financiera_id_foreign` FOREIGN KEY (`financiera_id`) REFERENCES `financieras` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `prestamo_archivocentral`
--
ALTER TABLE `prestamo_archivocentral`
  ADD CONSTRAINT `prestamo_archivocentral_archivo_id_foreign` FOREIGN KEY (`archivo_id`) REFERENCES `archivos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `preventivos`
--
ALTER TABLE `preventivos`
  ADD CONSTRAINT `preventivos_financiera_id_foreign` FOREIGN KEY (`financiera_id`) REFERENCES `financieras` (`id`) ON DELETE CASCADE;

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
