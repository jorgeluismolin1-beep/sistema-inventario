-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-03-2026 a las 16:41:44
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

DROP TABLE IF EXISTS `activos`;
CREATE TABLE IF NOT EXISTS `activos` (
  `ID_Activos` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `costo` float NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`ID_Activos`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`ID_Activos`, `descripcion`, `fecha`, `costo`, `status`) VALUES
(52, 'peperni', '2000-11-11', 2000.55, 1),
(49, 'refriee', '2030-11-11', 11900, 0),
(47, 'horno', '2029-12-11', 8000.59, 0),
(42, 'refrigerador', '1111-11-11', 11, 0),
(46, 'microondas', '2030-03-12', 400, 1),
(50, 'licuadora', '2029-02-12', 1200.99, 0),
(53, 'mesa redondas', '2026-03-20', 1255.5, 1),
(54, 'prueba', '2222-02-22', 2222, 1),
(55, 'mesas redonda', '2026-03-24', 1250.99, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidas`
--

DROP TABLE IF EXISTS `bebidas`;
CREATE TABLE IF NOT EXISTS `bebidas` (
  `ID_Bebida` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `tamano` varchar(20) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Bebida`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bebidas`
--

INSERT INTO `bebidas` (`ID_Bebida`, `descripcion`, `precio`, `tamano`, `stock`) VALUES
(14, 'prueba', 66, 'prueba', 66),
(12, 'refriiii', 1, '1.1', 0),
(17, 'prueba', 10.4, 'chico', 1),
(15, 'prueba', 66, 'prueba', 66);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pizzas`
--

DROP TABLE IF EXISTS `pizzas`;
CREATE TABLE IF NOT EXISTS `pizzas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `precio` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pizzas`
--

INSERT INTO `pizzas` (`id`, `nombre`, `descripcion`, `precio`) VALUES
(14, 'pizza pizza ', 'pp', 124),
(15, 'jamon con queso ', 'ujj', 935),
(17, 'kkkk', 'tr', 56),
(23, 'peperoni MEGAA', 'MEGAA', 1200),
(25, 'ss', 'sds', 127);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`) VALUES
(1, 'jorge', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
