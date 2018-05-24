-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-05-2018 a las 19:05:21
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inventario`
--

CREATE TABLE `Inventario` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(128) NOT NULL,
  `Descu` varchar(128) NOT NULL,
  `Costo` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Cantidad` varchar(128) NOT NULL,
  `FechaIngreso` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Inventario`
--

INSERT INTO `Inventario` (`ID`, `Nombre`, `Descu`, `Costo`, `Precio`, `Cantidad`, `FechaIngreso`) VALUES
(1, 'Tacos', 'Unos rikos taquitos', 20, 50, '100', '2018-05-11'),
(2, 'Hamburguesa', 'Una hamburguesa bien sabrontosauria', 50, 80, '100', '2018-05-18'),
(3, 'Tostadas', 'unas tostadas rikas', 30, 55, '100', '2018-05-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE `Producto` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(128) NOT NULL,
  `Descu` varchar(128) NOT NULL,
  `Precio` int(11) DEFAULT NULL,
  `Cantidad` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(128) NOT NULL,
  `Apellidos` varchar(128) NOT NULL,
  `Pass` varchar(128) NOT NULL,
  `Cargo` varchar(128) NOT NULL,
  `Login` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`ID`, `Nombre`, `Apellidos`, `Pass`, `Cargo`, `Login`) VALUES
(1, 'root', 'root', '123', 'adm', 'n'),
(2, 'jose', 'Orozco', '123', 'adm', 'n'),
(3, 'andres', 'Sada', '123', 'adm', 'n'),
(4, 'louis', 'Kardashian', '123', 'mesero', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Venta`
--

CREATE TABLE `Venta` (
  `ID` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `Fecha` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Inventario`
--
ALTER TABLE `Inventario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Venta`
--
ALTER TABLE `Venta`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
