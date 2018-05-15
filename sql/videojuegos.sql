-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2018 a las 21:02:26
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
  `FECHA` int(20) NOT NULL,
  PRIMARY KEY (`ID`,`JUEGO`),
  KEY `JUEGO` (`JUEGO`),
  KEY `USUARIO` (`USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`ID`, `JUEGO`, `USUARIO`, `TEXTO`, `FECHA`) VALUES
(1, 30, 23, 'test', 1525885433),
(1, 33, 23, 'ajksddddddddddddddddddd180923yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyasddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddshhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh182hddddddddddddddddddddddddddd', 1525887970),
(2, 30, 23, 'test2', 1525885449),
(3, 30, 23, 'sdbn', 1525890611),
(4, 30, 23, 'asd', 1525890614),
(5, 30, 23, 'aw1', 1525890618),
(6, 30, 23, 'h', 1525890621);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(40) CHARACTER SET latin1 NOT NULL,
  `DESCRIPCION` text CHARACTER SET latin1,
  `FECHA` varchar(4) DEFAULT NULL,
  `PAIS` varchar(40) DEFAULT NULL,
  `ENLACE` varchar(100) DEFAULT NULL,
  `ACTIVO` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`ID`, `NOMBRE`, `DESCRIPCION`, `FECHA`, `PAIS`, `ENLACE`, `ACTIVO`) VALUES
(4, 'Naughty Dog', 'Empresa desarrolladora de videojuegos estadounidense fundada por Andy Gavin y Jason Rubin en 1984, conocida principalmente por ser la creadora de exitosas sagas, como Crash Bandicoot, para PlayStation, Jak and Daxter, para PlayStation 2 y Uncharted, para PlayStation 3, así como el juego The Last of Us. Con sede en Santa Mónica, California, la empresa fue comprada por Sony Computer Entertainment en 2001.', '1984', 'Estados Unidos', 'https://www.naughtydog.com/', 1),
(5, 'test02', 'Entrada de prueba', '2018', 'Estados Unidos', '', 0),
(6, 'Sony Corporation', 'Japanese multinational conglomerate corporation headquartered in K?nan, Minato, Tokyo. Its diversified business includes consumer and professional electronics, gaming, entertainment and financial services. The company is one of the leading manufacturers of electronic products for the consumer and professional markets. Sony was ranked 105th on the 2017 list of Fortune Global 500.', '1946', 'Japón', 'https://www.sony.net/', 1),
(7, 'Ubisoft', 'es una compañía francesa desarrolladora y distribuidora de videojuegos, fundada en 1986 en Carentoir, en Bretaña. Yves Guillemot, uno de los fundadores, es el actual director ejecutivo y Presidente de la compañía.2 Las oficinas centrales se ubican en Montreuil-Sous-Bois, Francia.', '1986', 'Francia', 'https://www.ubisoft.com/es-es/', 1),
(8, 'test', '', '', '', '', 1),
(9, 'Microsoft', '', '1975', 'Estados Unidos', 'https://es.wikipedia.org/wiki/Microsoft', 1),
(11, 'Square Enix', '', '2003', 'Japón', '', 1),
(12, 'Nihon Falcom', '', '1981', 'Japón', '', 1),
(13, 'Nintendo', '', '', 'Japón', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_juegos`
--

CREATE TABLE IF NOT EXISTS `company_juegos` (
  `ID_JUEGO` int(9) NOT NULL,
  `ID_COMPANY` int(6) NOT NULL,
  PRIMARY KEY (`ID_JUEGO`,`ID_COMPANY`),
  KEY `ID_COMPANY` (`ID_COMPANY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `company_juegos`
--

INSERT INTO `company_juegos` (`ID_JUEGO`, `ID_COMPANY`) VALUES
(6, 4),
(12, 4),
(14, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(6, 6),
(14, 6),
(19, 6),
(20, 6),
(21, 6),
(22, 6),
(29, 6),
(30, 6),
(1, 7),
(35, 7),
(35, 9),
(36, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE IF NOT EXISTS `cuentas` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(40) CHARACTER SET latin1 NOT NULL,
  `PASSWORD` varchar(40) CHARACTER SET latin1 NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET latin1 NOT NULL,
  `registro` date NOT NULL,
  `tipo` int(1) NOT NULL,
  `clave` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`ID`, `NOMBRE`, `PASSWORD`, `EMAIL`, `registro`, `tipo`, `clave`) VALUES
(23, 'juan', '$1$wt..3A0.$4OiYpOPBCIiZCrpuzcfgu1', 'juan@hotmail.com', '2018-04-29', 2, '161fba3728fd6ca157cd01bcdfadea2c361616be730fe3d0c577ab714e59ac19664ae538fb6730925e2b7f7ad5754ddb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_tipo`
--

CREATE TABLE IF NOT EXISTS `cuentas_tipo` (
  `ID` int(1) NOT NULL AUTO_INCREMENT,
  `TIPO` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cuentas_tipo`
--

INSERT INTO `cuentas_tipo` (`ID`, `TIPO`) VALUES
(1, 'admin'),
(2, 'usuario');

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
(1, 'Acción'),
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

--
-- Volcado de datos para la tabla `generos_juego`
--

INSERT INTO `generos_juego` (`ID_JUEGO`, `ID_GENERO`) VALUES
(12, 1),
(12, 2),
(1, 7),
(1, 8),
(1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE IF NOT EXISTS `juego` (
  `ID` int(9) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `SINOPSIS` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `FECHA` date DEFAULT NULL,
  `ENLACE` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `DURACION` int(1) DEFAULT NULL,
  `COVER` tinyint(1) DEFAULT NULL,
  `ACTIVO` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TITULO` (`TITULO`),
  KEY `DURACION` (`DURACION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `juego`
--

INSERT INTO `juego` (`ID`, `TITULO`, `SINOPSIS`, `FECHA`, `ENLACE`, `DURACION`, `COVER`, `ACTIVO`) VALUES
(1, 'test editado', 'test123\n\neditado', '2018-12-19', '987', 2, NULL, 0),
(2, 'test2', 'test123333', '2018-03-31', '1234', NULL, 1, 1),
(6, 'Crash 2', '123', '2018-03-27', '123', NULL, NULL, 1),
(12, 'Crash Bandicoot 1', 'El juego se centra alrededor de Crash Bandicoot, un marsupial mutado por el doctor psicópata Neo Cortex y su mano derecha Nitrus Brio, pero Crash intenta parar los planes de su creador (la dominación del mundo), cruzando sobre cualquier contaminación que haya causado para salvar a su novia Tawna, un bandicoot femenino también mutado por el doctor Cortex y Nitrus Brio.', '1996-09-09', 'https://es.wikipedia.org/wiki/Crash_Bandicoot_(videojuego)', 2, NULL, 1),
(13, 'Crash3', 'test', '2018-03-04', 'test', NULL, NULL, 1),
(14, 'Crash4', 'test', '2018-03-04', 'test', NULL, NULL, 1),
(19, 'Crash5', 'test', '2018-03-04', 'test', NULL, NULL, 1),
(20, 'Crash6', 'test', '2014-03-19', 'test', NULL, NULL, 1),
(21, 'Crash7', 'test', '2014-03-19', 'test', NULL, NULL, 1),
(22, 'Crash9', 'test', '2014-03-19', 'test', NULL, NULL, 1),
(23, 'Crash10', 'test', '2014-03-19', 'test', NULL, NULL, 1),
(24, 'Crash11', 'test', '2014-03-19', 'test', NULL, NULL, 1),
(25, 'Crash12', 'test', '2014-03-19', 'test', NULL, NULL, 1),
(29, 'Crash13', 'test', '2014-03-19', 'test', NULL, NULL, 1),
(30, 'bandicoot', 'test', '2016-02-01', 'test', NULL, 1, 1),
(31, 'hehehe', '', '0000-00-00', '', NULL, NULL, 1),
(32, '123', '', '0000-00-00', '', NULL, NULL, 1),
(33, '456', '456', '2018-03-10', '', NULL, NULL, 1),
(35, 'juegoRevision1', '', '2018-05-24', '', NULL, NULL, 1),
(36, 'testInsert123', '', '0000-00-00', '', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(100) NOT NULL,
  `NACIONALIDAD` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `GENERO` varchar(10) DEFAULT NULL,
  `DESCRIPCION` text,
  `ENLACE` varchar(100) DEFAULT NULL,
  `ACTIVO` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`ID`, `NOMBRE`, `NACIONALIDAD`, `GENERO`, `DESCRIPCION`, `ENLACE`, `ACTIVO`) VALUES
(3, 'test01', 'España', 'Masculino', 'Entrada de prueba EDIT', 'prueba', 0),
(4, 'test02', 'España', 'Masculino', 'Otro test', '', 1),
(5, 'test03', 'Dinamarca', 'Masculino', 'Prueba 3', '', 0),
(6, 'test 04', 'Inglaterra', 'Masculino', 'Prueba nº 5', '', 1),
(7, 'test 05', 'esp', 'Masculino', 'esp', '', 1),
(8, 'test 06', 'esp', 'Masculino', 'esp', '', 1),
(9, 'test 07', 'esp', 'Masculino', 'esp', '', 1),
(10, 'test 08', 'esp', 'Masculino', 'esp', '', 1),
(11, 'test 10', 'esp', 'Masculino', 'esp', '', 1),
(12, 'test 09', 'esp', 'Masculino', 'esp', '', 0),
(13, 'test 11', 'esp', 'Masculino', 'esp', '', 1),
(14, 'test 12', 'esp', 'Masculino', 'esp', '', 1),
(15, 'test 13', 'esp', 'Masculino', 'esp', '', 1),
(16, 'Jason Rubin', 'Estadounidense', 'Masculino', 'Fundador de Naughty Dog', 'https://en.wikipedia.org/wiki/Jason_Rubin', 1),
(17, '123', '', 'Masculino', '', '', 1),
(18, 'test', '', 'Femenino', '', '', 1),
(19, 'testRevision', 'España', 'Masculino', '', '', 1),
(20, 'testRevision2', 'España', 'Masculino', '', '', 1),
(21, 'testRev3', 'España', 'Masculino', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_roles_juegos`
--

CREATE TABLE IF NOT EXISTS `personas_roles_juegos` (
  `PERSONA` int(6) NOT NULL,
  `JUEGO` int(9) NOT NULL,
  `ROL` int(2) NOT NULL,
  `COMENTARIO` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`PERSONA`,`JUEGO`,`ROL`),
  KEY `JUEGO` (`JUEGO`),
  KEY `ROL` (`ROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas_roles_juegos`
--

INSERT INTO `personas_roles_juegos` (`PERSONA`, `JUEGO`, `ROL`, `COMENTARIO`) VALUES
(4, 12, 3, ''),
(6, 12, 1, ''),
(7, 12, 2, 'xd'),
(8, 12, 1, ''),
(13, 12, 1, ''),
(14, 12, 5, ''),
(16, 6, 2, 'hola'),
(16, 12, 9, 'cx'),
(16, 13, 2, ''),
(16, 30, 1, 'test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma`
--

CREATE TABLE IF NOT EXISTS `plataforma` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(40) CHARACTER SET latin1 NOT NULL,
  `COMPANY` int(6) DEFAULT NULL,
  `FECHA` varchar(4) DEFAULT NULL,
  `DESCRIPCION` text CHARACTER SET latin1,
  `ESPECIFICACIONES` text,
  `ACTIVO` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`),
  KEY `COMPANY` (`COMPANY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `plataforma`
--

INSERT INTO `plataforma` (`ID`, `NOMBRE`, `COMPANY`, `FECHA`, `DESCRIPCION`, `ESPECIFICACIONES`, `ACTIVO`) VALUES
(1, 'Playstation 1', 6, '1994', 'Test ED', 'Test ED', 1),
(2, 'Playstation 2', 6, '2000', 'Es la segunda videoconsola de sobremesa producida por Sony Computer Entertainment y la sucesora de PlayStation. Fue lanzada por primera vez el 4 de marzo del año 2000 en Japón, y unos meses después en el resto del mundo. Esta consola es también la que más títulos posee, aproximadamente 10 900 títulos seguida por su predecesora la PlayStation con unos 8000 títulos.', 'CPU: Chip Emotion Engine (128 bits con capacidades SIMD) corriendo a 294.912 MHz (lanzamiento), 299 MHz (nuevos modelos).\nGPU: Chip GraphicsSynthesizer corriendo a 147.456 MHz', 1),
(3, '12345', 4, '', '', '', 1),
(4, 'test01', 4, '2018', 'test', 'test', 0),
(7, 'Xbox', 9, '2001', 'es una marca de videojuegos creada por Microsoft que incluye una serie de videoconsolas desarrolladas por la misma compañía, de sexta a octava generación, así como aplicaciones (juegos), servicios de streaming y el servicio en línea Xbox Live. La marca fue introducida por primera vez el 15 de noviembre de 2001 en los Estados Unidos, con el lanzamiento de la consola Xbox.', '', 1),
(18, 'Xbox 360', 9, '', '', '', 1),
(21, 'Nintendo Switch', 8, '2016', '', '', 1);

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

--
-- Volcado de datos para la tabla `plataforma_juego`
--

INSERT INTO `plataforma_juego` (`ID_JUEGO`, `ID_PLATAFORMA`) VALUES
(1, 1),
(12, 1),
(1, 2),
(12, 3),
(19, 3),
(25, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisiones`
--

CREATE TABLE IF NOT EXISTS `revisiones` (
  `ID` int(9) NOT NULL AUTO_INCREMENT,
  `ID_MODELO` int(9) NOT NULL,
  `TIPO` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `NUMERO` int(9) NOT NULL,
  `FECHA` datetime NOT NULL,
  `DESCRIPCION` text CHARACTER SET latin1 COLLATE latin1_spanish_ci,
  `USUARIO` int(6) NOT NULL,
  `ANTES` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `DESPUES` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`,`TIPO`,`NUMERO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `revisiones`
--

INSERT INTO `revisiones` (`ID`, `ID_MODELO`, `TIPO`, `NUMERO`, `FECHA`, `DESCRIPCION`, `USUARIO`, `ANTES`, `DESPUES`) VALUES
(1, 0, 'P', 1, '2018-05-13 00:00:00', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"Xbox 360","company":"Microsoft","desc":"","fecha":"","esp":""}'),
(2, 0, 'S', 1, '2018-05-13 00:00:00', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"testRevision","nacionalidad":"España","desc":"","genero":"Masculino","enlace":""}'),
(3, 0, 'S', 2, '2018-05-13 00:00:00', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"testRevision2","nacionalidad":"España","desc":"","genero":"Masculino","enlace":""}'),
(4, 0, 'J', 1, '2018-05-13 00:00:00', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"juegoRevision1","arrayCompany":"[\\"Microsoft\\",\\"Ubisoft\\"]","sinopsis":"","enlace":"","fecha":"2018-05-24"}'),
(5, 0, 'C', 1, '2018-05-13 00:00:00', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"Square Enix","pais":"Japón","desc":"","fecha":"2003","enlace":""}'),
(6, 0, 'C', 2, '2018-05-13 16:13:24', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"Nihon Falcom","pais":"Japón","desc":"","fecha":"1981","enlace":""}'),
(7, 21, 'P', 2, '2018-05-13 16:36:22', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"Nintendo Switch","company":"test","desc":"","fecha":"2016","esp":""}'),
(8, 21, 'S', 3, '2018-05-13 16:58:55', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"testRev3","nacionalidad":"España","desc":"","genero":"Masculino","enlace":""}'),
(9, 13, 'C', 3, '2018-05-13 17:07:44', 'Creación de entrada de plataforma.', 23, '0', '{"nombre":"Nintendo","pais":"Japón","desc":"","fecha":"","enlace":""}'),
(10, 36, 'J', 2, '2018-05-13 17:15:31', 'Creación de entrada de juego .', 23, '0', '{"nombre":"testInsert123","arrayCompany":"[\\"Nintendo\\"]","sinopsis":"","enlace":"","fecha":""}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `ROL` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID`, `ROL`) VALUES
(1, 'Director'),
(2, 'Escritor'),
(3, 'Actor de voz'),
(4, 'Diseño de Juego'),
(5, 'Compositor'),
(6, 'Artista'),
(7, 'Programador'),
(8, 'Productor'),
(9, 'Staff');

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
-- Filtros para la tabla `company_juegos`
--
ALTER TABLE `company_juegos`
  ADD CONSTRAINT `company_juegos_ibfk_2` FOREIGN KEY (`ID_COMPANY`) REFERENCES `company` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_juegos_ibfk_1` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `cuentas_tipo` (`ID`);

--
-- Filtros para la tabla `generos_juego`
--
ALTER TABLE `generos_juego`
  ADD CONSTRAINT `generos_juego_ibfk_2` FOREIGN KEY (`ID_GENERO`) REFERENCES `generos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `generos_juego_ibfk_3` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `juego`
--
ALTER TABLE `juego`
  ADD CONSTRAINT `juego_ibfk_6` FOREIGN KEY (`DURACION`) REFERENCES `duracion` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas_roles_juegos`
--
ALTER TABLE `personas_roles_juegos`
  ADD CONSTRAINT `personas_roles_juegos_ibfk_1` FOREIGN KEY (`PERSONA`) REFERENCES `personas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_roles_juegos_ibfk_2` FOREIGN KEY (`JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_roles_juegos_ibfk_3` FOREIGN KEY (`ROL`) REFERENCES `roles` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plataforma`
--
ALTER TABLE `plataforma`
  ADD CONSTRAINT `plataforma_ibfk_1` FOREIGN KEY (`COMPANY`) REFERENCES `company` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `plataforma_juego`
--
ALTER TABLE `plataforma_juego`
  ADD CONSTRAINT `plataforma_juego_ibfk_2` FOREIGN KEY (`ID_PLATAFORMA`) REFERENCES `plataforma` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plataforma_juego_ibfk_3` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votos_ibfk_2` FOREIGN KEY (`CUENTA`) REFERENCES `cuentas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
