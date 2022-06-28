-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2022 a las 21:45:45
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mini-glossary`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glosarios`
--

CREATE TABLE `glosarios` (
  `id_glosario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_tema` varchar(100) NOT NULL,
  `lenguaje` varchar(100) NOT NULL,
  `fecha_at` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_up` datetime DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT 1
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras_glosario`
--

CREATE TABLE `palabras_glosario` (
  `id_palabra` int(11) NOT NULL,
  `id_glosario` int(11) NOT NULL,
  `concepto` varchar(250) NOT NULL,
  `definicion` varchar(250) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 1
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traducciones`
--

CREATE TABLE `traducciones` (
  `id_traduccion` int(11) NOT NULL,
  `id_glosario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `traduccion` varchar(250) NOT NULL,
  `fecha_trad` datetime NOT NULL DEFAULT current_timestamp(),
  `activo` int(11) NOT NULL DEFAULT 1
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `glosarios`
--
ALTER TABLE `glosarios`
  ADD PRIMARY KEY (`id_glosario`);

--
-- Indices de la tabla `palabras_glosario`
--
ALTER TABLE `palabras_glosario`
  ADD PRIMARY KEY (`id_palabra`);

--
-- Indices de la tabla `traducciones`
--
ALTER TABLE `traducciones`
  ADD PRIMARY KEY (`id_traduccion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `glosarios`
--
ALTER TABLE `glosarios`
  MODIFY `id_glosario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `palabras_glosario`
--
ALTER TABLE `palabras_glosario`
  MODIFY `id_palabra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `traducciones`
--
ALTER TABLE `traducciones`
  MODIFY `id_traduccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
