-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2018 a las 00:17:45
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videojuegos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `calcularNotaMedia` (IN `Vid_juego` INT(9))  BEGIN
	DECLARE Vtotal_votos INT;
    DECLARE Vtotal_nota INT;
    DECLARE Vnota_media FLOAT;
	SELECT  count(*) INTO Vtotal_votos from votos where juego = Vid_juego ;
    SELECT SUM(NOTA) INTO Vtotal_nota from votos where juego = Vid_juego ;
    SET Vnota_media = Vtotal_nota/Vtotal_votos;
    
	UPDATE juego SET media = Vnota_media where ID = Vid_juego;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `ID` int(9) NOT NULL,
  `JUEGO` int(9) NOT NULL,
  `USUARIO` int(6) NOT NULL,
  `TEXTO` text CHARACTER SET latin1 NOT NULL,
  `FECHA` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`ID`, `JUEGO`, `USUARIO`, `TEXTO`, `FECHA`) VALUES
(1, 49, 24, 'comentario', 1528655796),
(1, 51, 23, 'aqui es un comentario muy largo que se trimea en el index', 1528659255),
(1, 56, 23, 'buen juego.', 1528659098),
(2, 49, 23, 'otro comentario.', 1528656175);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `ID` int(6) NOT NULL,
  `NOMBRE` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `DESCRIPCION` text CHARACTER SET latin1 COLLATE latin1_spanish_ci,
  `FECHA` varchar(4) DEFAULT NULL,
  `PAIS` varchar(40) DEFAULT NULL,
  `ENLACE` varchar(100) DEFAULT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`ID`, `NOMBRE`, `DESCRIPCION`, `FECHA`, `PAIS`, `ENLACE`, `ACTIVO`) VALUES
(14, 'Electronic Arts', 'Electronic Arts Inc. (EA) es una empresa estadounidense desarrolladora y distribuidora de videojuegos para ordenador y videoconsolas fundada por Trip Hawkins.\n\nSus oficinas centrales están en Redwood City, California. Tiene estudios en varias ciudades de Estados Unidos, en Canadá, Japón e Inglaterra. Posee diversas subsidiarias, como EA Sports, encargada de los simuladores deportivos, EA Games para los demás juegos, y subsidiarias adquiridas durante el tiempo como Maxis, entre otras. Electronics Arts también posee la mayor distribución del mundo en este sector, con oficinas en países como Brasil, Polonia, República Checa y Japón.\n\nDespués de Need For Speed: La película estrenada en el 2014 Electronic Arts fue vendida a DreamWorks para llevar otras de sus franquicias a la pantalla grande aparte de Need For Speed 2, que se estrenará en el verano de 2018.', '1982', 'Estados Unidos', 'https://www.ea.com/', 1),
(15, 'Square Enix', 'es una compañía desarrolladora de videojuegos japonesa y distribuidora, más conocida por sus franquicias de videojuegos de rol como la saga Final Fantasy, Dragon Quest, y la saga de acción RPG Kingdom Hearts. Sus oficinas centrales se encuentran en Shinjuku Bunka Quint Building en Yoyogi, Shibuya, Tokyo', '2003', 'Japón', 'https://es.wikipedia.org/wiki/Square_Enix', 1),
(16, 'Nintendo', 'Es una empresa multinacional dedicada al mercado de los videojuegos y a la electrónica de consumo; con sede en Kioto, Japón. Fue fundada el 23 de septiembre de 1889, por el japonés Fusajiro Yamauchi.6?\n\nNintendo empezó fabricando barajas Hanafuda (tradicionales naipes japoneses),7? para luego evolucionar hacia los juguetes y acabar convirtiéndose en un referente en el sector de las videoconsolas tanto por su hardware como por el software que ha estado fabricando a lo largo de los años. Junto a máquinas como la NES, la Game Boy, la Wii, o la Nintendo DS ha creado personajes tan conocidos como Super Mario, Donkey Kong y Link.', '1889', 'Japón', 'https://es.wikipedia.org/wiki/Nintendo', 1),
(17, 'Sony', 'Es una empresa multinacional japonesa con sede en Tokio (Japón) y uno de los fabricantes más importantes a nivel mundial en electrónica de consumo: audio y vídeo, computación, fotografía, videojuegos, telefonía móvil y productos profesionales.\n\nÍndice', '1946', 'Japón', 'https://es.wikipedia.org/wiki/Sony', 1),
(18, 'Xseed Games', 'Is an American video game company. Founded as a subsidiary of the Japanese game company Marvelous in November 2004, Xseed Games provide localization and publishing services for video games and related materials.', '2004', 'Estados Unidos', 'http://www.xseedgames.com/', 1),
(19, 'Blizzard Entertainment', 'Es una empresa desarrolladora y distribuidora de videojuegos estadounidense con sede en Irvine, California y fundada el 1 de junio de 1994.', '', '', '', 1),
(20, 'Ubisoft', 'Ubisoft Entertainment es una compañía francesa desarrolladora y distribuidora de videojuegos, fundada en 1986 en Carentoir, en Bretaña. Yves Guillemot, uno de los fundadores, es el actual director ejecutivo y Presidente de la compañía.2? Las oficinas centrales se ubican en Montreuil-Sous-Bois, Francia.', '1986', 'Francia', '', 1),
(21, 'Naughty Dog', 'Naughty Dog es una empresa desarrolladora de videojuegos estadounidense fundada por Andy Gavin y Jason Rubin en 1984, conocida principalmente por ser la creadora de exitosas sagas, como Crash Bandicoot, para PlayStation, Jak and Daxter, para PlayStation 2 y Uncharted, para PlayStation 3, así como el juego The Last of Us. Con sede en Santa Mónica, California, la empresa fue comprada por Sony Computer Entertainment en 2001.', '1984', 'Estados Unidos', 'https://es.wikipedia.org/wiki/Naughty_Dog', 1),
(22, 'Microsoft', 'Compañía tecnológica multinacional con sede en Redmond, Washington en Estados Unidos. Desarrolla, manufactura, licencia y provee soporte de software para computadores personales, servidores, dispositivos electrónicos y servicios. Sus productos más conocidos son el sistema operativo Microsoft Windows, la suite ofimática Microsoft Office y los navegadores de Internet, Internet Explorer y Edge. Sus productos bandera de hardware son las consolas de videojuegos Xbox y la línea de tablets Microsoft Surface.', '1975', 'Estados Unidos', 'https://es.wikipedia.org/wiki/Microsoft', 1),
(23, 'Cavia inc', '', '2000', 'Japón', '', 1),
(24, 'Matt Makes Games', '', '', 'Canada', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_juegos`
--

CREATE TABLE `company_juegos` (
  `ID_JUEGO` int(9) NOT NULL,
  `ID_COMPANY` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `company_juegos`
--

INSERT INTO `company_juegos` (`ID_JUEGO`, `ID_COMPANY`) VALUES
(47, 20),
(48, 15),
(48, 23),
(49, 24),
(50, 17),
(50, 21),
(51, 20),
(52, 20),
(53, 20),
(54, 20),
(55, 20),
(56, 21),
(57, 21),
(58, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `ID` int(6) NOT NULL,
  `NOMBRE` varchar(40) CHARACTER SET latin1 NOT NULL,
  `PASSWORD` varchar(40) CHARACTER SET latin1 NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET latin1 NOT NULL,
  `registro` date NOT NULL,
  `tipo` int(1) NOT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`ID`, `NOMBRE`, `PASSWORD`, `EMAIL`, `registro`, `tipo`, `clave`, `ACTIVO`) VALUES
(23, 'juan', '$1$wt..3A0.$4OiYpOPBCIiZCrpuzcfgu1', 'juan@hotmaail.com', '2018-04-29', 1, '161fba3728fd6ca157cd01bcdfadea2c361616be730fe3d0c577ab714e59ac19664ae538fb6730925e2b7f7ad5754ddb', 1),
(24, 'juanuno', '$1$rKo42gbY$LGkNEt4ovXFl.5yeWW.In/', 'juan1243@gmail.com', '2018-05-19', 2, '5d821ce2d01eb1180d363004f1294162d42f55c8532f4923193e91bbf10e826e3e2037c67f41fb266fc7a22851e470e5', 0),
(27, 'juandos', '$1$kcrMO1Wx$xmVxJNmpa1E11O9cdBJy80', 'juan123@gmail.com', '2018-05-19', 2, 'f021746997758cddc3a09359948e0522d0524b9afd68519747ea37ed222a2185f1f09b8ef9a60a31764bb6f1e7008611', 1),
(28, 'juantres', '$1$oodctAtr$jACBVS.GTgC5fMiTSUo6k1', 'juan123@gmail.com', '2018-05-19', 2, 'c42db5650c30c583ea75ca3b4001c07085f2d884e505c523090e63333d943a3c3ac068bed59dd616987ee772aa0e030e', 1),
(29, 'juancuatro', '$1$diNWKACV$6EtrNL7ckIofRy3dKdDzt1', 'juan123@gmail.com', '2018-05-19', 2, '6bf3bb93732233521e3dd18d528d6414fc8b708be8a66cf0251e793a5740f97986954fb8afbc1f5b5048e9a7dc47b1f4', 1),
(30, 'juancinco', '$1$ZXR4OEEg$wSG0NgiFY8NiNY7uAtyQG0', 'juan123@gmail.com', '2018-05-19', 2, 'f7b65008cac0a42765215b3dec75bbcaa68658ef5c018e4a36b4edc12a9c1fdbc7eccdb09bb94fab21eab23ff127f11d', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_tipo`
--

CREATE TABLE `cuentas_tipo` (
  `ID` int(1) NOT NULL,
  `TIPO` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `duracion` (
  `ID` int(1) NOT NULL,
  `DURACION` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `generos` (
  `ID` int(2) NOT NULL,
  `GENERO` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `generos_juego` (
  `ID_JUEGO` int(9) NOT NULL,
  `ID_GENERO` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE `juego` (
  `ID` int(9) NOT NULL,
  `TITULO` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `SINOPSIS` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `FECHA` date DEFAULT NULL,
  `ENLACE` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `DURACION` int(1) DEFAULT NULL,
  `COVER` tinyint(1) DEFAULT NULL,
  `MEDIA` decimal(10,2) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `juego`
--

INSERT INTO `juego` (`ID`, `TITULO`, `SINOPSIS`, `FECHA`, `ENLACE`, `DURACION`, `COVER`, `MEDIA`, `ACTIVO`) VALUES
(47, 'Prince of Persia: Las Arenas Del Tiempo', 'tuado en la antigua Persia en el año 550 a. C. el Príncipe acompaña a su padre, el rey Sharaman, en el saqueo de la ciudad de un poderoso maharajá de la India. Previamente al asalto de la ciudad el rey Sharaman hace un pacto con el visir enemigo, el cual asesina al guardián de la puerta para permitir la entrada del ejército persa a cambio de poder elegir cualquiera de los tesoros del maharajá.', '2003-10-30', 'https://es.wikipedia.org/wiki/Prince_of_Persia:_Las_Arenas_del_Tiempo', NULL, 1, '0.00', 1),
(48, 'Nier Replicant', 'El juego sigue a Nier en su intento de encontrar una cura para una rara enfermedad, conocida como \"Black Scrawl\", que su hija Yonah tiene. Acompañado de un libro parlante llamado Grimoire Weiss, viaja con otros 2 personajes Kainé y Emil, mientras él trata encontrar un remedio y comprender la naturaleza de unas criaturas conocidas como Shades que acechan el mundo. El juego incluye elementos de varios géneros de videojuegos, cambiando a ellas en la acción primaria del estilo de los videojuegos de rol.', '2010-04-22', 'https://es.wikipedia.org/wiki/Nier_(videojuego)', NULL, 1, '8.00', 1),
(49, 'Celeste', 'Help Madeline survive her inner demons on her journey to the top of Celeste Mountain, in this super-tight, hand-crafted platformer from the creators of multiplayer classic TowerFall.', '2018-01-25', 'https://store.steampowered.com/app/504230/Celeste/', NULL, NULL, '8.50', 1),
(50, 'Jak and Daxter', '', '0000-00-00', '', NULL, NULL, '0.00', 1),
(51, 'Prince of Persia: El Alma del Guerrero', 'En el principio la pantalla enfoca al mar y se oyen los pasos de alguien corriendo, después se ve la ciudad de babilonia y luego se muestra a alguien escapando de una sombra o monstruo, que va arrasando con todo a su paso incluyendo un perro que asusta a esa persona, hasta que llega a un lugar sin salida (en concreto una puerta cerrada al final de un callejón) y se revela que es el príncipe, en ese momento de forma aparentemente endemoniada y resentida, voltea resignado a la pelea para mirar a su perseguidor, saca sus espadas y en el reflejo de sus ojos se ve una inmensa criatura que se lanza contra él. Entonces, de repente, muestran el barco del príncipe en medio de una tormenta, cuando aparece un barco con monstruos de arena y una chica vestida de negro , quien es la comandante del barco. El barco enemigo lo aborda y, mientras matan a todos, el príncipe va en busca de la chica de negro para matarla.', '2004-12-02', 'https://es.wikipedia.org/wiki/Prince_of_Persia:_El_Alma_del_Guerrero', NULL, NULL, '6.00', 1),
(52, 'Prince of Persia: Las Dos Coronas', 'En el video de introducción, se muestran imágenes de un barco, en este viajan el príncipe y Kaileena. Regresan de la Isla del Tiempo, tras los sucesos acontecidos en Prince of Persia:El Alma del Guerrero. Ella inicia relatando: Todos cometemos errores, algunos pequeños, otros grandes. Pero su error, cargado de inocencia y promovido por el orgullo, fue el más grande y terrible de todos. Algunos creen que cuando el Príncipe viajó a la Isla del Tiempo, para escapar de la muerte, regresó solo; el amuleto destruido, El Dahaka sometido, La Emperatriz muerta. Por fin el Príncipe era libre... pero no fue así como sucedió. La verdad es que eligió salvarme de mi destino. Con ello me liberó...y nos condenó a todos. El príncipe y Kaeleena navegan en el barco rumbo a Babilonia, hogar del príncipe, para vivir juntos. Entonces vemos cómo el príncipe, intentando deshacerse de cualquier objeto que tenga que ver con las arenas, tira al agua la última reliquia de las arenas del tiempo. Detrás de él, aparece Kaileena, que le dice Príncipe, de todos los futuros posibles, este era el más prometedor...pero algo ha cambiado. A lo que el Príncipe le responde No os preocupéis Kaileena. Ningún mal os aguarda en Babilonia, os lo prometo. Mirad, casi estamos en casa. Cuando estaban llegando, descubren como Babilonia esta invadida, en ese momento atacan su barco y lo destruyen. Los dos caen al agua quedando inconscientes. Kaileena llega a la orilla y el Príncipe también, pero a varios metros de distancia. El Príncipe despierta y contempla el panorama de batalla. A lo lejos reconoce a Kaileena inconsciente. Observa como unos soldados la encuentran y se la llevan. El Príncipe grita Dejadla!. Aquí es donde el jugador comienza su recorrido.', '2005-02-02', 'https://es.wikipedia.org/wiki/Prince_of_Persia:_Las_dos_coronas', NULL, NULL, '0.00', 1),
(53, 'Tom Clancy\'s Splinter Cell', 'La trama transcurre hacia finales de 2004, donde el jugador adopta el rol de Sam Fisher, un ex-agente vuelto a reclutar por la Agencia Nacional de Seguridad estadounidense, para trabajar en una subdivisión denominada \"Third Echelon\". Entonces, Fisher no había \"estado en el campo durante años\". Fisher debe investigar la misteriosa desaparición de varios oficiales de inteligencia de la CIA en territorio de Georgia, pero pronto se convierte en una misión más complicada.', '2002-11-17', 'https://es.wikipedia.org/wiki/Tom_Clancy\'s_Splinter_Cell_(videojuego)', NULL, NULL, '0.00', 1),
(54, 'Tom Clancy\'s Splinter Cell: Pandora Tomorrow', 'La trama principal de Pandora Tomorrow tiene lugar en Indonesia durante la primavera del año a principios del 2006, Estados Unidos estableció una presencia militar en Timor Oriental, un país recientemente independiente, para entrenar a los militares de Timor Oriental en su lucha contra las milicias guerrilleras indonesias antiseparativistas. La más importante entre estas milicias es Darah Dan Doa (en inglés: Blood and Prayer ), dirigida por la carismática Suhadi Sadono .', '2004-03-23', 'https://es.wikipedia.org/wiki/Tom_Clancy\'s_Splinter_Cell:_Pandora_Tomorrow', NULL, NULL, '0.00', 1),
(55, 'Tom Clancy\'s Splinter Cell: Chaos Theory', 'El principal enfoque del juego toma lugar en el este Asiático, en 2007, con tensiones entre China, Corea del Norte y Japón, siguiendo a la formación de la Información de Autodefensas de Japón (I-SDF). Considerándose esto como una violación a la Constitución japonesa posterior a la Segunda Guerra Mundial, las fuerzas chinas y norcoreanas establece un bloqueo contra los navíos japoneses. Como Japón y sus Fuerzas de Autodefensas son aliados de Estados Unidos y del Third Echelon, éstos envían un destructor, el USS Clarence E. Walsh, al Mar de Japón. Los Estados Unidos esperaban que al mostrarles su fuerza naval, China y Corea del Norte retrocederían.', '2005-03-28', 'https://es.wikipedia.org/wiki/Tom_Clancy\'s_Splinter_Cell:_Chaos_Theory', NULL, NULL, '0.00', 1),
(56, 'Jak 2', '', '0000-00-00', '', NULL, NULL, '0.00', 1),
(57, 'Jak 3', '', '0000-00-00', '', NULL, NULL, '0.00', 1),
(58, 'Jak X', '', '0000-00-00', '', NULL, NULL, '0.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `ID` int(6) NOT NULL,
  `NOMBRE` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `NACIONALIDAD` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `GENERO` varchar(10) DEFAULT NULL,
  `DESCRIPCION` text,
  `ENLACE` varchar(100) DEFAULT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`ID`, `NOMBRE`, `NACIONALIDAD`, `GENERO`, `DESCRIPCION`, `ENLACE`, `ACTIVO`) VALUES
(22, 'Jason Rubin', 'Estados Unidos', 'Masculino', 'Jason Rubin (nacido en 1970) es un director de videojuegos norteamericano, creador de historietas, y fundador de una compañía por Internet. Es mayormente reconocido por la serie de videojuegos Crash Bandicoot, producido por el estudio Naughty Dog, del cual es co-fundador junto con su socio y amigo de la infancia Andy Gavin', 'https://es.wikipedia.org/wiki/Jason_Rubin', 1),
(23, 'Andy Gavin', 'Estados Unidos', 'Masculino', 'Andrew de Scott Gavin conocido como Andy Gavin (nacido en 1970) es un programador estadounidense de videojuegos, diseñador, empresario y novelista. En la industria de los videojuegos que se destaca por ser cofundador de la compañía de videojuegos Naughty Dog con su amigo de la infancia Jason Rubin en 1986 los juegos de Naughty Dog (el más famoso, Crash Bandicoot y Jak and Daxter) son conocidos por su combinación de tecnología excepcional, agudo gráficos y jugabilidad pulida. la sofisticación de la tecnología de Naughty Dog se acredita a menudo al fondo de Gavin en LISP en el Laboratorio de Inteligencia Artificial del MIT.', 'https://es.wikipedia.org/wiki/Andy_Gavin', 1),
(24, 'Yokoo Tarou', 'Japón', 'Masculino', 'is a Japanese video game director and scenario writer. Starting his career at the now-defunct game company Cavia, he became known for his work on the action role-playing video game series Drakengard and its two spin-offs: Nier and its sequel, Nier: Automata. Yoko was born in Nagoya, Aichi, and studied at the Kobe Design University in the 1990s. While initially not intending to pursue a career in video games, after working at Namco and Sony, he joined Cavia and became the director and scenario writer for the first Drakengard game. He has since worked extensively on every game in the series (Except Drakengard 2), as well as on mobile titles after becoming a freelancer after Cavia\'s absorption into AQ Interactive', 'https://en.wikipedia.org/wiki/Yoko_Taro', 1),
(25, 'Matt Thorson', 'Canada', 'Masculino', '', 'https://twitter.com/mattthorson', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_roles_juegos`
--

CREATE TABLE `personas_roles_juegos` (
  `PERSONA` int(6) NOT NULL,
  `JUEGO` int(9) NOT NULL,
  `ROL` int(2) NOT NULL,
  `COMENTARIO` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas_roles_juegos`
--

INSERT INTO `personas_roles_juegos` (`PERSONA`, `JUEGO`, `ROL`, `COMENTARIO`) VALUES
(22, 50, 9, ''),
(22, 56, 9, ''),
(22, 57, 9, ''),
(22, 58, 9, 'Creador original'),
(24, 48, 1, ''),
(24, 48, 2, ''),
(25, 49, 1, ''),
(25, 49, 4, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma`
--

CREATE TABLE `plataforma` (
  `ID` int(3) NOT NULL,
  `NOMBRE` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `COMPANY` int(6) DEFAULT NULL,
  `FECHA` varchar(4) DEFAULT NULL,
  `DESCRIPCION` text CHARACTER SET latin1,
  `ESPECIFICACIONES` text,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `plataforma`
--

INSERT INTO `plataforma` (`ID`, `NOMBRE`, `COMPANY`, `FECHA`, `DESCRIPCION`, `ESPECIFICACIONES`, `ACTIVO`) VALUES
(22, 'Playstation', 17, '1994', 'es una videoconsola de sobremesa de 32 bits lanzada por Sony Computer Entertainment el 3 de diciembre de 1994 en Japón. Se considera la videoconsola más exitosa de la quinta generación tanto en ventas como en popularidad. Además de la original se lanzó la PSone. Tuvo gran éxito al implantar el CD-ROM dentro de su hardware a pesar de que otras compañías como SEGA (Sega CD), Panasonic (3DO), Phillips (CD-i), SNK (Neo Geo CD), NEC (Super CD ROM) y Atari (Atari Jaguar) ya lo habían empleado. Dichas compañías tuvieron poco éxito al utilizar el CD-ROM como soporte para almacenar juegos. Se estima que Sony logró vender 105 500 000 unidades de su videoconsola en 10 años. La consola dejó de fabricarse en 2006.', 'CPU: R3000A, de 32 bits RISC con una frecuencia de reloj a 33,8688 MHz. ...\n    GPU: separada de la CPU, se encarga de procesar toda la información de gráficos en 2D. ...\n    Unidad de procesamiento de sonido (SPU): este chip es el encargado de procesar el sonido. ...\n    Memoria: ...\n    Unidad de lectura de CD-ROM:', 1),
(23, 'Playstation 2', 17, '2000', 'Es la segunda videoconsola de sobremesa producida por Sony Computer Entertainment y la sucesora de PlayStation. Fue lanzada por primera vez el 4 de marzo del año 2000 en Japón, y unos meses después en el resto del mundo. Esta consola es también la que más títulos posee, aproximadamente 10 900 títulos seguida por su predecesora la PlayStation con unos 8000 títulos. Esta cantidad de títulos dada la extraordinaria acogida por parte del público en general hacia la misma, lo que incluso la consolidó como la consola con más tiempo en el mercado y a su vez la consola con más duración en el mismo, hasta ser descontinuada el 11 de enero de 2013 tras sus últimos títulos FIFA 14 y PES 2014.', '', 1),
(24, 'Playstation 3', 17, '2006', 'Es la tercera videoconsola del modelo PlayStation de Sony Computer Entertainment. Forma parte de las videoconsolas de séptima generación y sus competidores son la Xbox 360 de Microsoft y la Wii de Nintendo.', '', 1),
(25, 'Playstation 4', 17, '2013', 'ejándose de la compleja arquitectura utilizada en el procesador Cell de la videoconsola PlayStation 3, la PlayStation 4 cuenta con un procesador AMD de 8 núcleos bajo la arquitectura x86-64. Estas instrucciones x86-64 están diseñados para hacer más fácil el desarrollo de videojuegos en la consola de nueva generación, que atrae a un mayor número de desarrolladores. Estos cambios ponen de manifiesto el esfuerzo de Sony para mejorar las lecciones aprendidas durante el desarrollo, la producción y el lanzamiento de la PS3. Otras características de hardware notables de la PS4 es que incluyen 8 GB de memoria unificada GDDR5, una unidad de disco Blu-ray Disc más rápido, y los chips personalizados dedicados a tareas de procesamiento de audio, vídeo y de fondo.', '', 0),
(26, 'Nintendo Switch', 16, '2017', 'Es la séptima consola de videojuegos principal desarrollada por Nintendo. Conocida en el desarrollo por su nombre código «NX», se dio a conocer en octubre de 2016 y fue lanzada mundialmente el 3 de marzo de 2017.', '', 1),
(27, 'Nintendo 64', 16, '1996', 'Es la cuarta videoconsola de sobremesa producida por Nintendo, desarrollada para suceder a la Super Nintendo y para competir con el Saturn de Sega y la PlayStation de Sony.', '', 1),
(28, 'Xbox', 22, '2001', 'Xbox fue la primera videoconsola de sobremesa producida por Microsoft, en colaboración con Intel. Su principal característica es su procesador central basado en el procesador Intel Pentium III. El sistema también incorpora un lector de DVD, un disco duro interno, puerto ethernet y por último el sistema dispone de cuatro conectores para los mandos. Las unidades vendidas de este equipo fueron 24 000 000 consolas, según las cifras oficiales.', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma_juego`
--

CREATE TABLE `plataforma_juego` (
  `ID_JUEGO` int(9) NOT NULL,
  `ID_PLATAFORMA` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plataforma_juego`
--

INSERT INTO `plataforma_juego` (`ID_JUEGO`, `ID_PLATAFORMA`) VALUES
(47, 23),
(47, 24),
(47, 28),
(49, 26),
(51, 23),
(51, 28),
(52, 23),
(52, 24),
(52, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisiones`
--

CREATE TABLE `revisiones` (
  `ID` int(9) NOT NULL,
  `ID_MODELO` int(9) NOT NULL,
  `TIPO` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `NUMERO` int(9) NOT NULL,
  `FECHA` datetime NOT NULL,
  `DESCRIPCION` text CHARACTER SET latin1 COLLATE latin1_spanish_ci,
  `USUARIO` int(6) NOT NULL,
  `ANTES` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `DESPUES` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `revisiones`
--

INSERT INTO `revisiones` (`ID`, `ID_MODELO`, `TIPO`, `NUMERO`, `FECHA`, `DESCRIPCION`, `USUARIO`, `ANTES`, `DESPUES`) VALUES
(51, 14, 'C', 1, '2018-06-02 16:41:41', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Electronic Arts\",\"pais\":\"Estados Unidos\",\"desc\":\"Electronic Arts Inc. (EA) es una empresa estadounidense desarrolladora y distribuidora de videojuegos para ordenador y videoconsolas fundada por Trip Hawkins.\\n\\nSus oficinas centrales están en Redwood City, California. Tiene estudios en varias ciudades de Estados Unidos, en Canadá, Japón e Inglaterra. Posee diversas subsidiarias, como EA Sports, encargada de los simuladores deportivos, EA Games para los demás juegos, y subsidiarias adquiridas durante el tiempo como Maxis, entre otras. Electronics Arts también posee la mayor distribución del mundo en este sector, con oficinas en países como Brasil, Polonia, República Checa y Japón.\\n\\nDespués de Need For Speed: La película estrenada en el 2014 Electronic Arts fue vendida a DreamWorks para llevar otras de sus franquicias a la pantalla grande aparte de Need For Speed 2, que se estrenará en el verano de 2018.\",\"fecha\":\"1982\",\"enlace\":\"https://www.ea.com/\"}'),
(52, 15, 'C', 1, '2018-06-02 16:45:59', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Square Enix\",\"pais\":\"Japón\",\"desc\":\"es una compañía desarrolladora de videojuegos japonesa y distribuidora, más conocida por sus franquicias de videojuegos de rol como la saga Final Fantasy, Dragon Quest, y la saga de acción RPG Kingdom Hearts. Sus oficinas centrales se encuentran en Shinjuku Bunka Quint Building en Yoyogi, Shibuya, Tokyo\",\"fecha\":\"2003\",\"enlace\":\"https://es.wikipedia.org/wiki/Square_Enix\"}'),
(53, 16, 'C', 1, '2018-06-02 16:47:08', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Nintendo\",\"pais\":\"Japón\",\"desc\":\"Es una empresa multinacional dedicada al mercado de los videojuegos y a la electrónica de consumo; con sede en Kioto, Japón. Fue fundada el 23 de septiembre de 1889, por el japonés Fusajiro Yamauchi.6?\\n\\nNintendo empezó fabricando barajas Hanafuda (tradicionales naipes japoneses),7? para luego evolucionar hacia los juguetes y acabar convirtiéndose en un referente en el sector de las videoconsolas tanto por su hardware como por el software que ha estado fabricando a lo largo de los años. Junto a máquinas como la NES, la Game Boy, la Wii, o la Nintendo DS ha creado personajes tan conocidos como Super Mario, Donkey Kong y Link.\",\"fecha\":\"1889\",\"enlace\":\"https://es.wikipedia.org/wiki/Nintendo\"}'),
(54, 17, 'C', 1, '2018-06-02 16:49:57', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Sony\",\"pais\":\"Japón\",\"desc\":\"Es una empresa multinacional japonesa con sede en Tokio (Japón) y uno de los fabricantes más importantes a nivel mundial en electrónica de consumo: audio y vídeo, computación, fotografía, videojuegos, telefonía móvil y productos profesionales.\\n\\nÍndice\",\"fecha\":\"1946\",\"enlace\":\"https://es.wikipedia.org/wiki/Sony\"}'),
(55, 18, 'C', 1, '2018-06-02 16:51:58', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Xseed Games\",\"pais\":\"Estados Unidos\",\"desc\":\"Is an American video game company. Founded as a subsidiary of the Japanese game company Marvelous in November 2004, Xseed Games provide localization and publishing services for video games and related materials.\",\"fecha\":\"2004\",\"enlace\":\"http://www.xseedgames.com/\"}'),
(56, 19, 'C', 1, '2018-06-02 17:25:03', 'Editar información de compañía.', 23, '{\"id\":19,\"nombre\":\"Blizzard Entertainment\",\"pais\":\"\",\"desc\":\"\",\"fecha\":\"\",\"enlace\":\"\"}', '{\"id\":19,\"nombre\":\"Blizzard Entertainment\",\"pais\":\"\",\"desc\":\"Es una empresa desarrolladora y distribuidora de videojuegos estadounidense con sede en Irvine, California y fundada el 1 de junio de 1994.\",\"fecha\":\"\",\"enlace\":\"\"}'),
(57, 20, 'C', 1, '2018-06-02 17:30:50', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Ubisoft\",\"pais\":\"Francia\",\"desc\":\"Ubisoft Entertainment es una compañía francesa desarrolladora y distribuidora de videojuegos, fundada en 1986 en Carentoir, en Bretaña. Yves Guillemot, uno de los fundadores, es el actual director ejecutivo y Presidente de la compañía.2? Las oficinas centrales se ubican en Montreuil-Sous-Bois, Francia.\",\"fecha\":\"1986\",\"enlace\":\"\"}'),
(58, 21, 'C', 1, '2018-06-02 17:31:55', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Naughty Dog\",\"pais\":\"Estados Unidos\",\"desc\":\"Naughty Dog es una empresa desarrolladora de videojuegos estadounidense fundada por Andy Gavin y Jason Rubin en 1984, conocida principalmente por ser la creadora de exitosas sagas, como Crash Bandicoot, para PlayStation, Jak and Daxter, para PlayStation 2 y Uncharted, para PlayStation 3, así como el juego The Last of Us. Con sede en Santa Mónica, California, la empresa fue comprada por Sony Computer Entertainment en 2001.\",\"fecha\":\"1984\",\"enlace\":\"https://es.wikipedia.org/wiki/Naughty_Dog\"}'),
(59, 22, 'S', 1, '2018-06-02 17:34:04', 'Creación de entrada de staff.', 23, '0', '{\"nombre\":\"Jason Rubin\",\"nacionalidad\":\"Estados Unidos\",\"desc\":\"Jason Rubin (nacido en 1970) es un director de videojuegos norteamericano, creador de historietas, y fundador de una compañía por Internet. Es mayormente reconocido por la serie de videojuegos Crash Bandicoot, producido por el estudio Naughty Dog, del cual es co-fundador junto con su socio y amigo de la infancia Andy Gavin\",\"genero\":\"Masculino\",\"enlace\":\"https://es.wikipedia.org/wiki/Jason_Rubin\"}'),
(60, 23, 'S', 1, '2018-06-02 17:36:43', 'Creación de entrada de staff.', 23, '0', '{\"nombre\":\"Andy Gavin\",\"nacionalidad\":\"Estados Unidos\",\"desc\":\"Andrew de Scott Gavin conocido como Andy Gavin (nacido en 1970) es un programador estadounidense de videojuegos, diseñador, empresario y novelista. En la industria de los videojuegos que se destaca por ser cofundador de la compañía de videojuegos Naughty Dog con su amigo de la infancia Jason Rubin en 1986 los juegos de Naughty Dog (el más famoso, Crash Bandicoot y Jak and Daxter) son conocidos por su combinación de tecnología excepcional, agudo gráficos y jugabilidad pulida. la sofisticación de la tecnología de Naughty Dog se acredita a menudo al fondo de Gavin en LISP en el Laboratorio de Inteligencia Artificial del MIT.\",\"genero\":\"Masculino\",\"enlace\":\"https://es.wikipedia.org/wiki/Andy_Gavin\"}'),
(61, 24, 'S', 1, '2018-06-02 17:37:43', 'Creación de entrada de staff.', 23, '0', '{\"nombre\":\"Yokoo Tarou\",\"nacionalidad\":\"Japón\",\"desc\":\"is a Japanese video game director and scenario writer. Starting his career at the now-defunct game company Cavia, he became known for his work on the action role-playing video game series Drakengard and its two spin-offs: Nier and its sequel, Nier: Automata. Yoko was born in Nagoya, Aichi, and studied at the Kobe Design University in the 1990s. While initially not intending to pursue a career in video games, after working at Namco and Sony, he joined Cavia and became the director and scenario writer for the first Drakengard game. He has since worked extensively on every game in the series (Except Drakengard 2), as well as on mobile titles after becoming a freelancer after Cavia\'s absorption into AQ Interactive\",\"genero\":\"Masculino\",\"enlace\":\"https://en.wikipedia.org/wiki/Yoko_Taro\"}'),
(62, 22, 'P', 1, '2018-06-02 17:42:09', 'Creación de entrada de .', 23, '0', '{\"nombre\":\"Playstation\",\"company\":\"Sony\",\"desc\":\"es una videoconsola de sobremesa de 32 bits lanzada por Sony Computer Entertainment el 3 de diciembre de 1994 en Japón. Se considera la videoconsola más exitosa de la quinta generación tanto en ventas como en popularidad. Además de la original se lanzó la PSone. Tuvo gran éxito al implantar el CD-ROM dentro de su hardware a pesar de que otras compañías como SEGA (Sega CD), Panasonic (3DO), Phillips (CD-i), SNK (Neo Geo CD), NEC (Super CD ROM) y Atari (Atari Jaguar) ya lo habían empleado. Dichas compañías tuvieron poco éxito al utilizar el CD-ROM como soporte para almacenar juegos. Se estima que Sony logró vender 105 500 000 unidades de su videoconsola en 10 años. La consola dejó de fabricarse en 2006.\",\"fecha\":\"1994\",\"esp\":\"CPU: R3000A, de 32 bits RISC con una frecuencia de reloj a 33,8688 MHz. ...\\n    GPU: separada de la CPU, se encarga de procesar toda la información de gráficos en 2D. ...\\n    Unidad de procesamiento de sonido (SPU): este chip es el encargado de procesar el sonido. ...\\n    Memoria: ...\\n    Unidad de lectura de CD-ROM:\"}'),
(63, 23, 'P', 1, '2018-06-02 17:43:50', 'Creación de entrada de .', 23, '0', '{\"nombre\":\"Playstation 2\",\"company\":\"Sony\",\"desc\":\"Es la segunda videoconsola de sobremesa producida por Sony Computer Entertainment y la sucesora de PlayStation. Fue lanzada por primera vez el 4 de marzo del año 2000 en Japón, y unos meses después en el resto del mundo. Esta consola es también la que más títulos posee, aproximadamente 10 900 títulos seguida por su predecesora la PlayStation con unos 8000 títulos. Esta cantidad de títulos dada la extraordinaria acogida por parte del público en general hacia la misma, lo que incluso la consolidó como la consola con más tiempo en el mercado y a su vez la consola con más duración en el mismo, hasta ser descontinuada el 11 de enero de 2013 tras sus últimos títulos FIFA 14 y PES 2014.\",\"fecha\":\"2000\",\"esp\":\"\"}'),
(64, 24, 'P', 1, '2018-06-02 17:52:31', 'Creación de entrada de .', 23, '0', '{\"nombre\":\"Playstation 3\",\"company\":\"Sony\",\"desc\":\"Es la tercera videoconsola del modelo PlayStation de Sony Computer Entertainment. Forma parte de las videoconsolas de séptima generación y sus competidores son la Xbox 360 de Microsoft y la Wii de Nintendo.\",\"fecha\":\"2006\",\"esp\":\"\"}'),
(65, 25, 'P', 1, '2018-06-02 17:53:23', 'Creación de entrada de .', 23, '0', '{\"nombre\":\"Playstation 4\",\"company\":\"Sony\",\"desc\":\"ejándose de la compleja arquitectura utilizada en el procesador Cell de la videoconsola PlayStation 3, la PlayStation 4 cuenta con un procesador AMD de 8 núcleos bajo la arquitectura x86-64. Estas instrucciones x86-64 están diseñados para hacer más fácil el desarrollo de videojuegos en la consola de nueva generación, que atrae a un mayor número de desarrolladores. Estos cambios ponen de manifiesto el esfuerzo de Sony para mejorar las lecciones aprendidas durante el desarrollo, la producción y el lanzamiento de la PS3. Otras características de hardware notables de la PS4 es que incluyen 8 GB de memoria unificada GDDR5, una unidad de disco Blu-ray Disc más rápido, y los chips personalizados dedicados a tareas de procesamiento de audio, vídeo y de fondo.\",\"fecha\":\"2013\",\"esp\":\"\"}'),
(66, 26, 'P', 1, '2018-06-02 17:58:49', 'Creación de entrada de .', 23, '0', '{\"nombre\":\"Nintendo Switch\",\"company\":\"Nintendo\",\"desc\":\"Es la séptima consola de videojuegos principal desarrollada por Nintendo. Conocida en el desarrollo por su nombre código «NX», se dio a conocer en octubre de 2016 y fue lanzada mundialmente el 3 de marzo de 2017.\",\"fecha\":\"2017\",\"esp\":\"\"}'),
(67, 27, 'P', 1, '2018-06-02 17:59:51', 'Creación de entrada de .', 23, '0', '{\"nombre\":\"Nintendo 64\",\"company\":\"Nintendo\",\"desc\":\"\",\"fecha\":\"1996\",\"esp\":\"\"}'),
(68, 22, 'C', 1, '2018-06-02 18:06:39', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Microsoft\",\"pais\":\"Estados Unidos\",\"desc\":\"Compañía tecnológica multinacional con sede en Redmond, Washington en Estados Unidos. Desarrolla, manufactura, licencia y provee soporte de software para computadores personales, servidores, dispositivos electrónicos y servicios. Sus productos más conocidos son el sistema operativo Microsoft Windows, la suite ofimática Microsoft Office y los navegadores de Internet, Internet Explorer y Edge. Sus productos bandera de hardware son las consolas de videojuegos Xbox y la línea de tablets Microsoft Surface.\",\"fecha\":\"1975\",\"enlace\":\"https://es.wikipedia.org/wiki/Microsoft\"}'),
(69, 28, 'P', 1, '2018-06-02 18:09:24', 'Creación de entrada de plataforma.', 23, '0', '{\"nombre\":\"Xbox\",\"company\":\"Microsoft\",\"desc\":\"Xbox fue la primera videoconsola de sobremesa producida por Microsoft, en colaboración con Intel. Su principal característica es su procesador central basado en el procesador Intel Pentium III. El sistema también incorpora un lector de DVD, un disco duro interno, puerto ethernet y por último el sistema dispone de cuatro conectores para los mandos. Las unidades vendidas de este equipo fueron 24 000 000 consolas, según las cifras oficiales.\",\"fecha\":\"2001\",\"esp\":\"\"}'),
(70, 47, 'J', 1, '2018-06-02 18:11:29', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Prince of Persia: Las Arenas Del Tiempo\",\"arrayCompany\":[\"Ubisoft\"],\"sinopsis\":\"tuado en la antigua Persia en el año 550 a. C. el Príncipe acompaña a su padre, el rey Sharaman, en el saqueo de la ciudad de un poderoso maharajá de la India. Previamente al asalto de la ciudad el rey Sharaman hace un pacto con el visir enemigo, el cual asesina al guardián de la puerta para permitir la entrada del ejército persa a cambio de poder elegir cualquiera de los tesoros del maharajá.\",\"enlace\":\"https://es.wikipedia.org/wiki/Prince_of_Persia:_Las_Arenas_del_Tiempo\",\"fecha\":\"2003-10-30\"}'),
(71, 48, 'J', 1, '2018-06-02 18:13:05', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Nier Replicant\",\"arrayCompany\":[\"Square Enix\"],\"sinopsis\":\"El juego sigue a Nier en su intento de encontrar una cura para una rara enfermedad, conocida como \\\"Black Scrawl\\\", que su hija Yonah tiene. Acompañado de un libro parlante llamado Grimoire Weiss, viaja con otros 2 personajes Kainé y Emil, mientras él trata encontrar un remedio y comprender la naturaleza de unas criaturas conocidas como Shades que acechan el mundo. El juego incluye elementos de varios géneros de videojuegos, cambiando a ellas en la acción primaria del estilo de los videojuegos de rol.\",\"enlace\":\"https://es.wikipedia.org/wiki/Nier_(videojuego)\",\"fecha\":\"2010-04-22\"}'),
(72, 23, 'C', 1, '2018-06-02 18:13:58', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Cavia inc\",\"pais\":\"Japón\",\"desc\":\"\",\"fecha\":\"2000\",\"enlace\":\"\"}'),
(73, 24, 'C', 1, '2018-06-02 18:15:50', 'Creación de entrada de compañía.', 23, '0', '{\"nombre\":\"Matt Makes Games\",\"pais\":\"Estados Unidos\",\"desc\":\"\",\"fecha\":\"\",\"enlace\":\"http://www.mattmakesgames.com/\"}'),
(74, 25, 'S', 1, '2018-06-02 18:17:51', 'Creación de entrada de staff.', 23, '0', '{\"nombre\":\"Matt Thorson\",\"nacionalidad\":\"Canada\",\"desc\":\"\",\"genero\":\"Masculino\",\"enlace\":\"https://twitter.com/mattthorson\"}'),
(75, 24, 'C', 2, '2018-06-02 18:18:05', 'Editar información de compañía.', 23, '{\"id\":24,\"nombre\":\"Matt Makes Games\",\"pais\":\"Estados Unidos\",\"desc\":\"\",\"fecha\":\"\",\"enlace\":\"\"}', '{\"id\":24,\"nombre\":\"Matt Makes Games\",\"pais\":\"Canada\",\"desc\":\"\",\"fecha\":\"\",\"enlace\":\"\"}'),
(76, 49, 'J', 1, '2018-06-02 18:21:54', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Celeste\",\"arrayCompany\":[\"Matt Makes Games\"],\"sinopsis\":\"Help Madeline survive her inner demons on her journey to the top of Celeste Mountain, in this super-tight, hand-crafted platformer from the creators of multiplayer classic TowerFall.\",\"enlace\":\"https://store.steampowered.com/app/504230/Celeste/\",\"fecha\":\"2018-01-25\"}'),
(77, 48, 'J', 2, '2018-06-02 18:22:08', 'Editar compañías del juego.', 23, '{\"arrayCompany\":[\"Square Enix\"],\"id\":48}', '{\"arrayCompany\":[\"Square Enix\",\"Cavia inc\"],\"id\":48}'),
(78, 48, 'J', 3, '2018-06-02 18:22:24', 'Editar Staff del juego.', 23, '{\"id\":48,\"nombres\":[],\"roles\":[],\"coment\":[]}', '{\"id\":48,\"nombres\":[\"Yokoo Tarou\",\"Yokoo Tarou\"],\"roles\":[\"1\",\"2\"],\"coment\":[\"\",\"\"],\"roles_nomb\":[\"Director\",\"Escritor\"]}'),
(79, 50, 'J', 1, '2018-06-02 18:26:53', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Jak and Daxter\",\"arrayCompany\":[\"Sony\",\"Naughty Dog\"],\"sinopsis\":\"\",\"enlace\":\"\",\"fecha\":\"\"}'),
(80, 51, 'J', 1, '2018-06-02 21:00:07', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Prince of Persia: El Alma del Guerrero\",\"arrayCompany\":[\"Ubisoft\"],\"sinopsis\":\"En el principio la pantalla enfoca al mar y se oyen los pasos de alguien corriendo, después se ve la ciudad de babilonia y luego se muestra a alguien escapando de una sombra o monstruo, que va arrasando con todo a su paso incluyendo un perro que asusta a esa persona, hasta que llega a un lugar sin salida (en concreto una puerta cerrada al final de un callejón) y se revela que es el príncipe, en ese momento de forma aparentemente endemoniada y resentida, voltea resignado a la pelea para mirar a su perseguidor, saca sus espadas y en el reflejo de sus ojos se ve una inmensa criatura que se lanza contra él. Entonces, de repente, muestran el barco del príncipe en medio de una tormenta, cuando aparece un barco con monstruos de arena y una chica vestida de negro , quien es la comandante del barco. El barco enemigo lo aborda y, mientras matan a todos, el príncipe va en busca de la chica de negro para matarla.\",\"enlace\":\"https://es.wikipedia.org/wiki/Prince_of_Persia:_El_Alma_del_Guerrero\",\"fecha\":\"2004-12-02\"}'),
(81, 52, 'J', 1, '2018-06-02 21:03:09', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Prince of Persia: Las Dos Coronas\",\"arrayCompany\":[\"Ubisoft\"],\"sinopsis\":\"En el video de introducción, se muestran imágenes de un barco, en este viajan el príncipe y Kaileena. Regresan de la Isla del Tiempo, tras los sucesos acontecidos en Prince of Persia:El Alma del Guerrero. Ella inicia relatando: Todos cometemos errores, algunos pequeños, otros grandes. Pero su error, cargado de inocencia y promovido por el orgullo, fue el más grande y terrible de todos. Algunos creen que cuando el Príncipe viajó a la Isla del Tiempo, para escapar de la muerte, regresó solo; el amuleto destruido, El Dahaka sometido, La Emperatriz muerta. Por fin el Príncipe era libre... pero no fue así como sucedió. La verdad es que eligió salvarme de mi destino. Con ello me liberó...y nos condenó a todos. El príncipe y Kaeleena navegan en el barco rumbo a Babilonia, hogar del príncipe, para vivir juntos. Entonces vemos cómo el príncipe, intentando deshacerse de cualquier objeto que tenga que ver con las arenas, tira al agua la última reliquia de las arenas del tiempo. Detrás de él, aparece Kaileena, que le dice Príncipe, de todos los futuros posibles, este era el más prometedor...pero algo ha cambiado. A lo que el Príncipe le responde No os preocupéis Kaileena. Ningún mal os aguarda en Babilonia, os lo prometo. Mirad, casi estamos en casa. Cuando estaban llegando, descubren como Babilonia esta invadida, en ese momento atacan su barco y lo destruyen. Los dos caen al agua quedando inconscientes. Kaileena llega a la orilla y el Príncipe también, pero a varios metros de distancia. El Príncipe despierta y contempla el panorama de batalla. A lo lejos reconoce a Kaileena inconsciente. Observa como unos soldados la encuentran y se la llevan. El Príncipe grita Dejadla!. Aquí es donde el jugador comienza su recorrido.\",\"enlace\":\"https://es.wikipedia.org/wiki/Prince_of_Persia:_Las_dos_coronas\",\"fecha\":\"2005-02-02\"}'),
(82, 53, 'J', 1, '2018-06-02 21:04:16', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Tom Clancy\'s Splinter Cell\",\"arrayCompany\":[\"Ubisoft\"],\"sinopsis\":\"La trama transcurre hacia finales de 2004, donde el jugador adopta el rol de Sam Fisher, un ex-agente vuelto a reclutar por la Agencia Nacional de Seguridad estadounidense, para trabajar en una subdivisión denominada \\\"Third Echelon\\\". Entonces, Fisher no había \\\"estado en el campo durante años\\\". Fisher debe investigar la misteriosa desaparición de varios oficiales de inteligencia de la CIA en territorio de Georgia, pero pronto se convierte en una misión más complicada.\",\"enlace\":\"https://es.wikipedia.org/wiki/Tom_Clancy\'s_Splinter_Cell_(videojuego)\",\"fecha\":\"2002-11-17\"}'),
(83, 54, 'J', 1, '2018-06-02 21:04:59', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Tom Clancy\'s Splinter Cell: Pandora Tomorrow\",\"arrayCompany\":[\"Ubisoft\"],\"sinopsis\":\"La trama principal de Pandora Tomorrow tiene lugar en Indonesia durante la primavera del año a principios del 2006, Estados Unidos estableció una presencia militar en Timor Oriental, un país recientemente independiente, para entrenar a los militares de Timor Oriental en su lucha contra las milicias guerrilleras indonesias antiseparativistas. La más importante entre estas milicias es Darah Dan Doa (en inglés: Blood and Prayer ), dirigida por la carismática Suhadi Sadono .\",\"enlace\":\"https://es.wikipedia.org/wiki/Tom_Clancy\'s_Splinter_Cell:_Pandora_Tomorrow\",\"fecha\":\"2004-03-23\"}'),
(84, 55, 'J', 1, '2018-06-02 21:05:33', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Tom Clancy\'s Splinter Cell: Chaos Theory\",\"arrayCompany\":[\"Ubisoft\"],\"sinopsis\":\"El principal enfoque del juego toma lugar en el este Asiático, en 2007, con tensiones entre China, Corea del Norte y Japón, siguiendo a la formación de la Información de Autodefensas de Japón (I-SDF). Considerándose esto como una violación a la Constitución japonesa posterior a la Segunda Guerra Mundial, las fuerzas chinas y norcoreanas establece un bloqueo contra los navíos japoneses. Como Japón y sus Fuerzas de Autodefensas son aliados de Estados Unidos y del Third Echelon, éstos envían un destructor, el USS Clarence E. Walsh, al Mar de Japón. Los Estados Unidos esperaban que al mostrarles su fuerza naval, China y Corea del Norte retrocederían.\",\"enlace\":\"https://es.wikipedia.org/wiki/Tom_Clancy\'s_Splinter_Cell:_Chaos_Theory\",\"fecha\":\"2005-03-28\"}'),
(85, 51, 'J', 2, '2018-06-02 21:15:19', 'Editar plataformas del juego.', 23, '{\"plat\":[],\"id\":51}', '{\"plat\":[\"23\",\"28\"],\"id\":51}'),
(86, 47, 'J', 2, '2018-06-02 21:15:38', 'Editar plataformas del juego.', 23, '{\"plat\":[],\"id\":47}', '{\"plat\":[\"23\",\"24\",\"28\"],\"id\":47}'),
(87, 52, 'J', 2, '2018-06-02 21:15:51', 'Editar plataformas del juego.', 23, '{\"plat\":[],\"id\":52}', '{\"plat\":[\"23\",\"24\",\"28\"],\"id\":52}'),
(88, 56, 'J', 1, '2018-06-02 22:06:09', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Jak 2\",\"arrayCompany\":[\"Naughty Dog\"],\"sinopsis\":\"\",\"enlace\":\"\",\"fecha\":\"\"}'),
(89, 57, 'J', 1, '2018-06-02 22:06:18', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Jak 3\",\"arrayCompany\":[\"Naughty Dog\"],\"sinopsis\":\"\",\"enlace\":\"\",\"fecha\":\"\"}'),
(90, 58, 'J', 1, '2018-06-02 22:06:28', 'Creación de entrada de juego.', 23, '0', '{\"nombre\":\"Jak X\",\"arrayCompany\":[\"Naughty Dog\"],\"sinopsis\":\"\",\"enlace\":\"\",\"fecha\":\"\"}'),
(91, 50, 'J', 2, '2018-06-02 22:07:04', 'Editar Staff del juego.', 23, '{\"id\":50,\"nombres\":[],\"roles\":[],\"coment\":[]}', '{\"id\":50,\"nombres\":[\"Jason Rubin\"],\"roles\":[\"9\"],\"coment\":[\"\"],\"roles_nomb\":[\"Staff\"]}'),
(92, 56, 'J', 2, '2018-06-02 22:08:13', 'Editar Staff del juego.', 23, '{\"id\":56,\"nombres\":[],\"roles\":[],\"coment\":[]}', '{\"id\":56,\"nombres\":[\"Jason Rubin\"],\"roles\":[\"9\"],\"coment\":[\"\"],\"roles_nomb\":[\"Staff\"]}'),
(93, 57, 'J', 2, '2018-06-02 22:08:33', 'Editar Staff del juego.', 23, '{\"id\":57,\"nombres\":[],\"roles\":[],\"coment\":[]}', '{\"id\":57,\"nombres\":[\"Jason Rubin\"],\"roles\":[\"9\"],\"coment\":[\"\"],\"roles_nomb\":[\"Staff\"]}'),
(94, 58, 'J', 2, '2018-06-02 22:08:54', 'Editar Staff del juego.', 23, '{\"id\":58,\"nombres\":[],\"roles\":[],\"coment\":[]}', '{\"id\":58,\"nombres\":[\"Jason Rubin\"],\"roles\":[\"9\"],\"coment\":[\"Creador original\"],\"roles_nomb\":[\"Staff\"]}'),
(95, 49, 'J', 2, '2018-06-03 00:17:02', 'Editar plataformas del juego.', 23, '{\"plat\":[],\"id\":49}', '{\"plat\":[\"26\",\"25\"],\"id\":49}'),
(96, 49, 'J', 3, '2018-06-03 00:17:47', 'Añadir screenshots al juego.', 23, '0', '0'),
(97, 49, 'J', 4, '2018-06-03 01:01:37', 'Editar Staff del juego.', 23, '{\"id\":49,\"nombres\":[],\"roles\":[],\"coment\":[]}', '{\"id\":49,\"nombres\":[\"Matt Thorson\",\"Matt Thorson\"],\"roles\":[\"1\",\"4\"],\"coment\":[\"\",\"\"],\"roles_nomb\":[\"Director\",\"Diseño de Juego\"]}'),
(98, 47, 'J', 3, '2018-06-03 01:06:25', 'Agregar cover del juego.', 23, '0', '0'),
(99, 47, 'J', 4, '2018-06-03 01:09:12', 'Añadir screenshots al juego.', 23, '0', '0'),
(100, 51, 'J', 3, '2018-06-03 01:10:55', 'Añadir screenshots al juego.', 23, '0', '0'),
(101, 48, 'J', 4, '2018-06-03 01:13:32', 'Agregar cover del juego.', 23, '0', '0'),
(102, 48, 'J', 5, '2018-06-03 01:13:43', 'Añadir screenshots al juego.', 23, '0', '0'),
(103, 48, 'J', 6, '2018-06-03 01:14:26', 'Añadir screenshots al juego.', 23, '0', '0'),
(104, 50, 'J', 3, '2018-06-03 01:18:55', 'Añadir screenshots al juego.', 23, '0', '0'),
(105, 27, 'P', 2, '2018-06-03 19:35:44', 'Editar información de plataforma.', 23, '{\"id\":27,\"nombre\":\"Nintendo 64\",\"company\":\"Nintendo\",\"desc\":\"\",\"fecha\":\"1996\",\"esp\":\"\"}', '{\"id\":27,\"nombre\":\"Nintendo 64\",\"company\":\"Nintendo\",\"desc\":\"Es la cuarta videoconsola de sobremesa producida por Nintendo, desarrollada para suceder a la Super Nintendo y para competir con el Saturn de Sega y la PlayStation de Sony.\",\"fecha\":\"1996\",\"esp\":\"\"}'),
(106, 49, 'J', 5, '2018-06-12 00:16:56', 'Editar plataformas del juego.', 23, '{\"plat\":[\"26\"],\"id\":49}', '{\"plat\":[\"26\"],\"id\":49}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID` int(2) NOT NULL,
  `ROL` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `votos` (
  `JUEGO` int(9) NOT NULL,
  `CUENTA` int(6) NOT NULL,
  `NOTA` int(2) DEFAULT NULL,
  `FECHA` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`JUEGO`, `CUENTA`, `NOTA`, `FECHA`) VALUES
(48, 23, 8, '2018-06-03'),
(49, 23, 9, '2018-06-03'),
(49, 24, 8, '2018-06-10'),
(51, 23, 6, '2018-06-02');

--
-- Disparadores `votos`
--
DELIMITER $$
CREATE TRIGGER `DELETE_NuevaNotaMedia` AFTER DELETE ON `votos` FOR EACH ROW BEGIN
		CALL calcularNotaMedia(OLD.JUEGO);
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `INSERT_NuevaNotaMedia` AFTER INSERT ON `votos` FOR EACH ROW BEGIN
		CALL calcularNotaMedia(NEW.JUEGO);
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UPDATE_NuevaNotaMedia` AFTER UPDATE ON `votos` FOR EACH ROW BEGIN
		CALL calcularNotaMedia(NEW.JUEGO);
    END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`ID`,`JUEGO`),
  ADD KEY `JUEGO` (`JUEGO`),
  ADD KEY `USUARIO` (`USUARIO`);

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`);

--
-- Indices de la tabla `company_juegos`
--
ALTER TABLE `company_juegos`
  ADD PRIMARY KEY (`ID_JUEGO`,`ID_COMPANY`),
  ADD KEY `ID_COMPANY` (`ID_COMPANY`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`),
  ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `cuentas_tipo`
--
ALTER TABLE `cuentas_tipo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `duracion`
--
ALTER TABLE `duracion`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `generos_juego`
--
ALTER TABLE `generos_juego`
  ADD PRIMARY KEY (`ID_JUEGO`,`ID_GENERO`),
  ADD KEY `ID_GENERO` (`ID_GENERO`);

--
-- Indices de la tabla `juego`
--
ALTER TABLE `juego`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `TITULO` (`TITULO`),
  ADD KEY `DURACION` (`DURACION`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `personas_roles_juegos`
--
ALTER TABLE `personas_roles_juegos`
  ADD PRIMARY KEY (`PERSONA`,`JUEGO`,`ROL`),
  ADD KEY `JUEGO` (`JUEGO`),
  ADD KEY `ROL` (`ROL`);

--
-- Indices de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`),
  ADD KEY `COMPANY` (`COMPANY`);

--
-- Indices de la tabla `plataforma_juego`
--
ALTER TABLE `plataforma_juego`
  ADD PRIMARY KEY (`ID_JUEGO`,`ID_PLATAFORMA`),
  ADD KEY `ID_PLATAFORMA` (`ID_PLATAFORMA`);

--
-- Indices de la tabla `revisiones`
--
ALTER TABLE `revisiones`
  ADD PRIMARY KEY (`ID`,`TIPO`,`NUMERO`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`JUEGO`,`CUENTA`),
  ADD KEY `CUENTA` (`CUENTA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `cuentas_tipo`
--
ALTER TABLE `cuentas_tipo`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `duracion`
--
ALTER TABLE `duracion`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `juego`
--
ALTER TABLE `juego`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `revisiones`
--
ALTER TABLE `revisiones`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `company_juegos_ibfk_1` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_juegos_ibfk_2` FOREIGN KEY (`ID_COMPANY`) REFERENCES `company` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
