-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2023 a las 21:42:50
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbinstagramkillerlaravel`
--
CREATE DATABASE IF NOT EXISTS `dbinstagramkillerlaravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbinstagramkillerlaravel`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `contenido` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `imagen_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `contenido`, `usuario_id`, `imagen_id`, `created_at`, `updated_at`) VALUES
(1, 'Excelente tanque.', 2, 1, '2022-01-13 13:20:26', '2022-01-13 13:20:26'),
(2, 'Tengo el AMD Ryzen PRO 4650U.', 2, 5, '2022-01-13 13:21:09', '2022-01-13 13:21:09'),
(3, 'Mi canción favorita es Ghost Rule.', 1, 6, '2022-01-13 13:22:17', '2022-01-13 13:22:17'),
(4, 'El mejor Utaloid hasta la actualidad sin duda.', 1, 3, '2022-01-13 13:23:38', '2022-01-13 13:23:38'),
(5, 'Comparto este paisaje por que me gusta.', 1, 4, '2022-01-13 13:24:28', '2022-01-13 13:24:28'),
(6, 'Estoy completamente de acuerdo.', 3, 3, '2023-02-10 05:59:30', '2023-02-10 05:59:30'),
(7, 'Se nota que no conoces Windows 7.', 3, 8, '2023-02-10 06:02:22', '2023-02-10 06:02:22'),
(8, 'El año pasado fui y no pesqué nada, nunca mas vuelvo.', 2, 9, '2023-02-10 06:04:34', '2023-02-10 06:04:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `imagen`, `descripcion`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'img-1642079564-Tanque.png', 'El mejor tanque del planeta.', 1, '2022-01-13 13:12:44', '2022-01-13 13:12:44'),
(2, 'img-1642079630-Girls und Panzer.PNG', 'El mejor anime de tanques, 100% recomendado.', 2, '2022-01-13 13:13:50', '2022-01-13 13:13:50'),
(3, 'img-1642079680-Kasane Teto.png', 'El mejor Utaloid jamás creado.', 2, '2022-01-13 13:14:40', '2022-01-13 13:14:40'),
(4, 'img-1642079870-Paisaje.png', 'Un hermoso paisaje.', 1, '2022-01-13 13:17:50', '2022-01-13 13:17:50'),
(5, 'img-1642079967-Ryzen.png', 'Mi marca favorita de procesadores.', 1, '2022-01-13 13:19:27', '2022-01-13 13:19:27'),
(6, 'img-1642080005-Miku.png', 'El primer Vocaloid que conocí.', 2, '2022-01-13 13:20:05', '2022-01-13 13:20:05'),
(7, 'img-1676008698-Bosque.png', 'Las mejores vacaciones no siempre son en la playa.', 3, '2023-02-10 05:58:18', '2023-02-10 05:58:18'),
(8, 'img-1676008902-Windows.png', 'En mi opinión el nuevo fondo de pantalla de Windows supera con creces a su antecesor.', 4, '2023-02-10 06:01:42', '2023-02-10 06:01:42'),
(9, 'img-1676009010-Rio.png', 'Excelente río para ir a pescar truchas.', 3, '2023-02-10 06:03:30', '2023-02-10 06:03:30'),
(10, 'img-1676009143-Lago.png', 'El lago más hermoso del país sin duda alguna.', 4, '2023-02-10 06:05:43', '2023-02-10 06:05:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `imagen_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `like`
--

INSERT INTO `like` (`id`, `usuario_id`, `imagen_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2022-01-13 13:13:29', '2022-01-13 13:13:29'),
(2, 1, 3, '2022-01-13 13:18:54', '2022-01-13 13:18:54'),
(3, 1, 5, '2022-01-13 13:26:13', '2022-01-13 13:26:13'),
(5, 2, 3, '2022-01-13 13:26:36', '2022-01-13 13:26:36'),
(6, 3, 3, '2023-02-10 05:58:31', '2023-02-10 05:58:31'),
(7, 4, 8, '2023-02-10 06:01:47', '2023-02-10 06:01:47'),
(8, 3, 8, '2023-02-10 06:02:08', '2023-02-10 06:02:08'),
(9, 3, 9, '2023-02-10 06:03:33', '2023-02-10 06:03:33'),
(10, 1, 9, '2023-02-10 06:03:45', '2023-02-10 06:03:45'),
(11, 2, 9, '2023-02-10 06:04:11', '2023-02-10 06:04:11'),
(12, 1, 10, '2023-02-10 06:06:09', '2023-02-10 06:06:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rol`, `nombre`, `apellido`, `alias`, `correo`, `clave`, `imagen`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Usuario', 'Daniel', 'Alvarez', 'MelchioT', 'daniel@ejemplo.local', '$2y$10$iWEq9oPbCj43E3cl2DCIs.YK/bHx09CzD.x.oo.3tCs4T2xxlABpq', 'img-1642079373-Avatar 1.png', NULL, '2022-01-13 13:09:17', '2022-01-13 13:09:34'),
(2, 'Usuario', 'Esteban', 'Alvarez', 'KvtAlib', 'esteban@ejemplo.local', '$2y$10$pezHsoMaVn2Reeute8u/PeUS34ky6RTkKnfzfnh5FS./e6DYc2CD6', 'img-1642079424-Avatar 2.png', NULL, '2022-01-13 13:10:18', '2022-01-13 13:10:24'),
(3, 'Usuario', 'Nicolas', 'Mesina', 'Mesinator', 'nicolas@ejemplo.local', '$2y$10$.skwbUcSvn5jnwmMCnlCwujxfZJNG5gvbW7tB2hcYpYAEoJT4BcFq', 'img-1676008582-Avatar 3.png', NULL, '2023-02-10 05:55:53', '2023-02-10 05:56:22'),
(4, 'Usuario', 'Angel', 'Berrios', 'Angel98', 'angel@ejemplo.local', '$2y$10$zdGKgu3.HAgoUbUzhzw.P.oZOX8.uvjdFllRot07YxkUEwcMcxmzS', 'img-1676008835-Avatar 4.png', NULL, '2023-02-10 06:00:25', '2023-02-10 06:00:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`,`usuario_id`,`imagen_id`),
  ADD KEY `fk_comentario_usuario_idx` (`usuario_id`),
  ADD KEY `fk_comentario_imagen1_idx` (`imagen_id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD KEY `fk_imagen_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`,`usuario_id`,`imagen_id`),
  ADD KEY `fk_like_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_like_imagen1_idx` (`imagen_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_imagen1` FOREIGN KEY (`imagen_id`) REFERENCES `imagen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `fk_imagen_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `fk_like_imagen1` FOREIGN KEY (`imagen_id`) REFERENCES `imagen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_like_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
