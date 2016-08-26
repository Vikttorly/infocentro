-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2016 a las 21:11:12
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `infocentro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
`id` int(2) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `contrasena` varchar(45) DEFAULT NULL,
  `nombre` text,
  `sexo` char(1) DEFAULT NULL,
  `rango` char(1) DEFAULT NULL,
  `fRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`id`, `usuario`, `contrasena`, `nombre`, `sexo`, `rango`, `fRegistro`) VALUES
(1, 'admin', '123456', NULL, NULL, NULL, '2016-07-20 20:31:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(8) NOT NULL,
  `ci` int(8) DEFAULT NULL,
  `nombre` text,
  `fNacimiento` date DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `registrador` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `ci`, `nombre`, `fNacimiento`, `sexo`, `direccion`, `registrador`) VALUES
(1, 25132279, 'VICTOR LAYA', '1995-07-10', 'M', 'BARRIO POZO AZUL CASA 23', 1),
(2, 0, 'VICTOR MANUEL LAYA CASTILLO', '1997-04-17', 'M', '', 1),
(3, 0, 'VICTOR MANUEL LAYA CASTILLO', '1997-05-15', 'M', 'CASA 23', 1),
(4, 24235566, 'JORGE JOSE LARA RODRIGUEZ', '1995-04-06', 'M', 'CAÃ‘AFISTOLA VEREDA 4', 1),
(6, 26027353, 'HECTOR ANTONIO RODRIGUEZ SOLORZANO', '1995-01-15', 'F', 'BRISAS DE ORITUCO', 1),
(7, 25132278, 'CARLOS RAUL VILLANUEVA GONZALES', '1995-11-15', 'M', 'CAÃ‘AFISTOLA VEREDA 3 CASA 8', 1),
(8, 0, 'EQWEQWE QWEQWEQWE', '1996-01-12', 'M', 'QWEQWEQWE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE IF NOT EXISTS `visitas` (
`id` int(8) NOT NULL,
  `usuario` int(8) DEFAULT NULL,
  `registrador` int(2) DEFAULT NULL,
  `fEntrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id`, `usuario`, `registrador`, `fEntrada`) VALUES
(1, 1, 1, '2016-07-29 02:07:31'),
(2, 1, 1, '2016-07-29 02:19:22'),
(3, 1, 1, '2016-08-01 02:00:33'),
(4, 5, 1, '2016-08-01 18:34:10'),
(5, 1, 1, '2016-08-04 02:25:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `funcionario`
--
ALTER TABLE `funcionario`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
