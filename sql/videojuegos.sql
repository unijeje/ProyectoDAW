-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2018 a las 17:45:25
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `videojuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `ID` int(9) NOT NULL,
  `JUEGO` int(9) NOT NULL,
  `USUARIO` int(6) NOT NULL,
  `TEXTO` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID`,`JUEGO`),
  KEY `JUEGO` (`JUEGO`),
  KEY `USUARIO` (`USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compañia`
--

CREATE TABLE IF NOT EXISTS `compañia` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(40) CHARACTER SET latin1 NOT NULL,
  `DESCRIPCION` text CHARACTER SET latin1,
  `DIRECTOR` int(6) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`),
  KEY `DIRECTOR` (`DIRECTOR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compañia_juegos`
--

CREATE TABLE IF NOT EXISTS `compañia_juegos` (
  `ID_JUEGO` int(9) NOT NULL,
  `ID_COMPAÑIA` int(6) NOT NULL,
  PRIMARY KEY (`ID_JUEGO`,`ID_COMPAÑIA`),
  KEY `ID_COMPAÑIA` (`ID_COMPAÑIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE IF NOT EXISTS `cuentas` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(40) CHARACTER SET latin1 NOT NULL,
  `PASSWORD` varchar(40) CHARACTER SET latin1 NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_tipo`
--

CREATE TABLE IF NOT EXISTS `cuentas_tipo` (
  `ID` int(1) NOT NULL AUTO_INCREMENT,
  `TIPO` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `duracion`
--

CREATE TABLE IF NOT EXISTS `duracion` (
  `ID` int(1) NOT NULL AUTO_INCREMENT,
  `DURACION` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `duracion`
--

INSERT INTO `duracion` (`ID`, `DURACION`) VALUES
(0, '<5'),
(1, '5-10'),
(2, '10-15'),
(3, '15-30'),
(4, '30-50'),
(5, '50-75'),
(6, '75-100'),
(7, '>100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE IF NOT EXISTS `generos` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `GENERO` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`ID`, `GENERO`) VALUES
(1, 'Accion'),
(2, 'Aventura'),
(3, 'Horror'),
(4, 'Suspense'),
(5, 'Ciencia Ficcion'),
(6, 'Fantasia'),
(7, 'Drama'),
(8, 'Misterio'),
(9, 'RPG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos_juego`
--

CREATE TABLE IF NOT EXISTS `generos_juego` (
  `ID_JUEGO` int(9) NOT NULL,
  `ID_GENERO` int(2) NOT NULL,
  PRIMARY KEY (`ID_JUEGO`,`ID_GENERO`),
  KEY `ID_GENERO` (`ID_GENERO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE IF NOT EXISTS `juego` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `SINOPSIS` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `FECHA` date DEFAULT NULL,
  `ENLACE` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `DURACION` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TITULO` (`TITULO`),
  KEY `DURACION` (`DURACION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE` int(100) NOT NULL,
  `NACIONALIDAD` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `GENERO` varchar(10) DEFAULT NULL,
  `DESCRIPCION` text,
  `ENLACE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_roles_juegos`
--

CREATE TABLE IF NOT EXISTS `personas_roles_juegos` (
  `PERSONA` int(6) NOT NULL,
  `JUEGO` int(9) NOT NULL,
  `ROL` int(2) NOT NULL,
  PRIMARY KEY (`PERSONA`,`JUEGO`,`ROL`),
  KEY `JUEGO` (`JUEGO`),
  KEY `ROL` (`ROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma`
--

CREATE TABLE IF NOT EXISTS `plataforma` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(40) CHARACTER SET latin1 NOT NULL,
  `COMPAÑIA` int(6) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `DESCRIPCION` text CHARACTER SET latin1,
  `ESPECIFICACIONES` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`),
  KEY `COMPAÑIA` (`COMPAÑIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma_juego`
--

CREATE TABLE IF NOT EXISTS `plataforma_juego` (
  `ID_JUEGO` int(9) NOT NULL,
  `ID_PLATAFORMA` int(3) NOT NULL,
  PRIMARY KEY (`ID_JUEGO`,`ID_PLATAFORMA`),
  KEY `ID_PLATAFORMA` (`ID_PLATAFORMA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisiones`
--

CREATE TABLE IF NOT EXISTS `revisiones` (
  `ID` int(9) NOT NULL,
  `TIPO` varchar(1) NOT NULL,
  `NUMERO` int(9) NOT NULL,
  `FECHA` date NOT NULL,
  `DESCRIPCION` text,
  `USUARIO` int(6) NOT NULL,
  `ANTES` text NOT NULL,
  `DESPUES` text NOT NULL,
  PRIMARY KEY (`ID`,`TIPO`,`NUMERO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `ROL` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID`, `ROL`) VALUES
(1, 'Director'),
(2, 'Escritor'),
(3, 'Actor de voz'),
(4, 'Diseñador'),
(5, 'OST');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE IF NOT EXISTS `votos` (
  `JUEGO` int(9) NOT NULL,
  `CUENTA` int(6) NOT NULL,
  `NOTA` int(2) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  PRIMARY KEY (`JUEGO`,`CUENTA`),
  KEY `CUENTA` (`CUENTA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`USUARIO`) REFERENCES `cuentas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compañia`
--
ALTER TABLE `compañia`
  ADD CONSTRAINT `compa@0xia_ibfk_2` FOREIGN KEY (`DIRECTOR`) REFERENCES `personas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compañia_juegos`
--
ALTER TABLE `compañia_juegos`
  ADD CONSTRAINT `compa@0xia_juegos_ibfk_2` FOREIGN KEY (`ID_COMPAÑIA`) REFERENCES `compañia` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compa@0xia_juegos_ibfk_1` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `cuentas_tipo` (`ID`);

--
-- Filtros para la tabla `generos_juego`
--
ALTER TABLE `generos_juego`
  ADD CONSTRAINT `generos_juego_ibfk_3` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `generos_juego_ibfk_2` FOREIGN KEY (`ID_GENERO`) REFERENCES `generos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `juego`
--
ALTER TABLE `juego`
  ADD CONSTRAINT `juego_ibfk_6` FOREIGN KEY (`DURACION`) REFERENCES `duracion` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas_roles_juegos`
--
ALTER TABLE `personas_roles_juegos`
  ADD CONSTRAINT `personas_roles_juegos_ibfk_3` FOREIGN KEY (`ROL`) REFERENCES `roles` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_roles_juegos_ibfk_1` FOREIGN KEY (`PERSONA`) REFERENCES `personas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_roles_juegos_ibfk_2` FOREIGN KEY (`JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plataforma`
--
ALTER TABLE `plataforma`
  ADD CONSTRAINT `plataforma_ibfk_2` FOREIGN KEY (`COMPAÑIA`) REFERENCES `compañia` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plataforma_juego`
--
ALTER TABLE `plataforma_juego`
  ADD CONSTRAINT `plataforma_juego_ibfk_3` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plataforma_juego_ibfk_2` FOREIGN KEY (`ID_PLATAFORMA`) REFERENCES `plataforma` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votos_ibfk_2` FOREIGN KEY (`CUENTA`) REFERENCES `cuentas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
