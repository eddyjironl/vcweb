-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2020 a las 04:07:23
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `systdbc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sygrup`
--

CREATE TABLE `sygrup` (
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sygrup`
--

INSERT INTO `sygrup` (`cgrpid`, `cdesc`, `cstatus`) VALUES
('01', 'Sistemas INT', 'OP'),
('02', 'Administracion', 'OP'),
('', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `symenu`
--

CREATE TABLE `symenu` (
  `cmenuid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `symenu`
--

INSERT INTO `symenu` (`cmenuid`, `cdesc`) VALUES
('sy001', 'configuracion de la compañia'),
('sy002', 'Grupos de Trabajo'),
('tr001', 'Facturacion y Notas de Debito'),
('tr002', 'Recibos de Dinero'),
('tr003', 'Cotizaciones'),
('tr004', 'Entradas y Salidas de Inventario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `syperm`
--

CREATE TABLE `syperm` (
  `cuid` int(10) NOT NULL,
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cmenuid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `allow` tinyint(1) NOT NULL,
  `ccompid` char(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'compañia a la que pertenece el permiso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `syperm`
--

INSERT INTO `syperm` (`cuid`, `cgrpid`, `cmenuid`, `cdesc`, `allow`, `ccompid`) VALUES
(1, '01', 'sy001', 'configuracion de la compañia', 0, ''),
(2, '01', 'sy002', 'Grupos de Trabajo', 0, ''),
(3, '01', 'tr001', 'Facturacion y Notas de Debito', 1, ''),
(4, '01', 'tr002', 'Recibos de Dinero', 1, ''),
(5, '01', 'tr003', 'Cotizaciones', 1, ''),
(6, '01', 'tr004', 'Entradas y Salidas de Inventario', 1, ''),
(7, '02', 'sy001', 'configuracion de la compañia', 0, ''),
(8, '02', 'sy002', 'Grupos de Trabajo', 0, ''),
(9, '02', 'tr001', 'Facturacion y Notas de Debito', 1, ''),
(10, '02', 'tr002', 'Recibos de Dinero', 1, ''),
(11, '02', 'tr003', 'Cotizaciones', 1, ''),
(12, '02', 'tr004', 'Entradas y Salidas de Inventario', 0, ''),
(13, '', 'sy001', 'configuracion de la compañia', 0, ''),
(14, '', 'sy002', 'Grupos de Trabajo', 0, ''),
(15, '', 'tr001', 'Facturacion y Notas de Debito', 0, ''),
(16, '', 'tr002', 'Recibos de Dinero', 0, ''),
(17, '', 'tr003', 'Cotizaciones', 0, ''),
(18, '', 'tr004', 'Entradas y Salidas de Inventario', 0, ''),
(19, '01', 'sy001', 'configuracion de la compañia', 0, '02'),
(20, '01', 'sy002', 'Grupos de Trabajo', 0, '02'),
(21, '01', 'tr001', 'Facturacion y Notas de Debito', 1, '02'),
(22, '01', 'tr002', 'Recibos de Dinero', 0, '02'),
(23, '01', 'tr003', 'Cotizaciones', 1, '02'),
(24, '01', 'tr004', 'Entradas y Salidas de Inventario', 0, '02'),
(25, '01', 'sy001', 'configuracion de la compañia', 1, 'KSIS01'),
(26, '01', 'sy002', 'Grupos de Trabajo', 1, 'KSIS01'),
(27, '01', 'tr001', 'Facturacion y Notas de Debito', 1, 'KSIS01'),
(28, '01', 'tr002', 'Recibos de Dinero', 1, 'KSIS01'),
(29, '01', 'tr003', 'Cotizaciones', 1, 'KSIS01'),
(30, '01', 'tr004', 'Entradas y Salidas de Inventario', 1, 'KSIS01'),
(31, '02', 'sy001', 'configuracion de la compañia', 0, 'KSIS01'),
(32, '02', 'sy002', 'Grupos de Trabajo', 0, 'KSIS01'),
(33, '02', 'tr001', 'Facturacion y Notas de Debito', 0, 'KSIS01'),
(34, '02', 'tr002', 'Recibos de Dinero', 0, 'KSIS01'),
(35, '02', 'tr003', 'Cotizaciones', 0, 'KSIS01'),
(36, '02', 'tr004', 'Entradas y Salidas de Inventario', 0, 'KSIS01'),
(37, '02', 'sy001', 'configuracion de la compañia', 0, '02'),
(38, '02', 'sy002', 'Grupos de Trabajo', 0, '02'),
(39, '02', 'tr001', 'Facturacion y Notas de Debito', 0, '02'),
(40, '02', 'tr002', 'Recibos de Dinero', 0, '02'),
(41, '02', 'tr003', 'Cotizaciones', 0, '02'),
(42, '02', 'tr004', 'Entradas y Salidas de Inventario', 0, '02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `syscomp`
--

CREATE TABLE `syscomp` (
  `ccompid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `compdesc` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `ctel` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `cfax` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `mdirecc` text COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL,
  `llogo` tinyint(1) NOT NULL,
  `lview` tinyint(1) NOT NULL,
  `cfoto` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `dbc` char(50) COLLATE latin1_spanish_ci NOT NULL,
  `nperfisc` int(3) NOT NULL,
  `nanofisc` int(4) NOT NULL,
  `ntaxratg` decimal(10,2) NOT NULL,
  `lunicontdat` tinyint(1) NOT NULL,
  `dnextclear` date NOT NULL,
  `dbname` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `chost` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `cpasword` char(200) COLLATE latin1_spanish_ci NOT NULL,
  `cuserid` char(200) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `syscomp`
--

INSERT INTO `syscomp` (`ccompid`, `compdesc`, `ctel`, `cfax`, `mdirecc`, `cstatus`, `llogo`, `lview`, `cfoto`, `dbc`, `nperfisc`, `nanofisc`, `ntaxratg`, `lunicontdat`, `dnextclear`, `dbname`, `chost`, `cpasword`, `cuserid`) VALUES
('02', 'Compañia de pruebas', '', '', '', '', 0, 0, '', '', 0, 0, '0.00', 0, '0000-00-00', '', '', '', ''),
('KSIS01', 'Mini Market Lolita', '', '', '', '', 0, 0, '', '', 0, 0, '0.00', 0, '0000-00-00', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sysuser`
--

CREATE TABLE `sysuser` (
  `cuid` int(10) NOT NULL,
  `cgrpid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cfullname` char(100) COLLATE latin1_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE latin1_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'OP',
  `cpasword` char(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sysuser`
--

INSERT INTO `sysuser` (`cuid`, `cgrpid`, `cfullname`, `cuserid`, `cstatus`, `cpasword`) VALUES
(9, '01', 'Administrador General', 'SUPERVISOR', 'OP', '2505'),
(10, '01', 'Eddy jiron', 'EDDY', 'OP', '1'),
(11, '02', 'Wendy Sauceda Torrez', 'WENDY', 'OP', '2212'),
(13, '01', 'Ivan Alfonso Jiron Guillen', 'ivan', 'CL', '2'),
(14, '01', 'Ivan Alfonso Jiron Guillen', 'alfonso', 'CL', '5'),
(18, '02', 'Ivan Alfonso Jiron Guillen', 'ivan', 'OP', '3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `syperm`
--
ALTER TABLE `syperm`
  ADD PRIMARY KEY (`cuid`);

--
-- Indices de la tabla `syscomp`
--
ALTER TABLE `syscomp`
  ADD PRIMARY KEY (`ccompid`);

--
-- Indices de la tabla `sysuser`
--
ALTER TABLE `sysuser`
  ADD PRIMARY KEY (`cuid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `syperm`
--
ALTER TABLE `syperm`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `sysuser`
--
ALTER TABLE `sysuser`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
