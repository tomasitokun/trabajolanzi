-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2024 a las 23:42:17
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
-- Base de datos: `chacabuco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_archivo` varchar(255) NOT NULL,
  `id_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `año` tinyint(4) DEFAULT NULL CHECK (`año` in (1,2,3,4,5,6,7)),
  `división` varchar(2) DEFAULT NULL CHECK (`división` in ('1°','2°','3°','4°','5°','6°','7°'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombre`, `descripcion`, `contenido`, `logo`, `año`, `división`) VALUES
(1, 'matematica', 'matematica', 'ecuaciones y esas cosas', 'img.png', 7, '4°'),
(2, 'laboratorio de aplicaciones', 'lengua y literatura', 'literatura y esas cosas', 'img.png', 7, '4°');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_usuario`
--

CREATE TABLE `materia_usuario` (
  `id_matusu` int(11) NOT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia_usuario`
--

INSERT INTO `materia_usuario` (`id_matusu`, `id_materia`, `id_usuario`) VALUES
(2, 2, 1),
(3, 1, 2),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `año` tinyint(4) DEFAULT NULL CHECK (`año` in (1,2,3,4,5,6,7)),
  `división` varchar(2) DEFAULT NULL CHECK (`división` in ('1°','2°','3°','4°','5°','6°','7°')),
  `email` varchar(100) NOT NULL,
  `tipo_documento` enum('DNI','LC','LE') NOT NULL,
  `numero_documento` int(11) NOT NULL,
  `contraseña` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `nombre`, `apellido`, `año`, `división`, `email`, `tipo_documento`, `numero_documento`, `contraseña`) VALUES
(1, 'franco', 'gallardo', 7, '4°', 'trabajosphyton@gmail.com', 'DNI', 47214943, 'holachau'),
(2, 'cole', 'palmer', 7, '4°', 'coldpalmer@yahoo.com', 'DNI', 69420420, 'holachau');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `materia_usuario`
--
ALTER TABLE `materia_usuario`
  ADD PRIMARY KEY (`id_matusu`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materia_usuario`
--
ALTER TABLE `materia_usuario`
  MODIFY `id_matusu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`);

--
-- Filtros para la tabla `materia_usuario`
--
ALTER TABLE `materia_usuario`
  ADD CONSTRAINT `materia_usuario_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `materia_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
