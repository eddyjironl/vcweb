-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2020 a las 03:04:26
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
-- Base de datos: `ksisdbc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptran`
--

CREATE TABLE `aptran` (
  `cuid` int(10) NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `ctype` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `dtrndate` date NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `namount` decimal(10,2) NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aptran`
--

INSERT INTO `aptran` (`cuid`, `crespno`, `cstatus`, `ctype`, `dtrndate`, `mnotas`, `namount`, `cuserid`, `fecha`, `hora`) VALUES
(1, '0', 'OP', 'RE', '0000-00-00', '', '200.00', '', '', ''),
(2, '0', 'OP', 'IN', '0000-00-00', '', '200.00', '', '', ''),
(3, '0', 'OP', 'CT', '0000-00-00', '', '200.00', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arcust`
--

CREATE TABLE `arcust` (
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cname` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `ctel` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `cpasword` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `nlimcrd` decimal(10,2) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `ctype` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arcust`
--

INSERT INTO `arcust` (`ccustno`, `cname`, `ctel`, `cpasword`, `nlimcrd`, `mnotas`, `ctype`) VALUES
('00', 'Clientes Varios (Vta Contado)', '', 'VTA00', '1.00', 'Clientes de Contado', 'CT'),
('01', 'Carmelina Torrez', '', '1234', '2000.00', 'Suegra', 'IN'),
('02', 'Merlyn Vecina', '', '0000', '300.00', '', 'IN'),
('03', 'Melisa Amador', '', '0000', '2000.00', '', 'IN'),
('04', 'Gladys de lito', '', '', '1000.00', '', 'IN'),
('05', 'Ramon de Moncha', '', '', '200.00', '', 'IN'),
('06', 'Merci', '', '0006', '300.00', '', 'IN'),
('07', 'Seylin', '', '0003', '300.00', '', 'IN'),
('08', 'Fany Diaz', '', '', '100.00', '', 'IN'),
('09', 'Denis zelaya', '97516054', '', '1000.00', '', 'IN'),
('10', 'Jeny de Lolita', '', '', '200.00', '', 'IN'),
('11', 'Bertita', '', '', '200.00', '', 'IN'),
('12', 'pastora', '', '', '200.00', '', 'IN'),
('13', 'Gerardo de lito', '', '', '1500.00', '', 'IN'),
('14', 'melissa nuera de lolita', '', '', '300.00', '', 'IN'),
('15', 'nohemy de lolita', '', '', '300.00', 'credito de productos varios', 'IN'),
('16', 'suyapa de lolita', '', '', '300.00', '', 'IN'),
('17', 'Mandina de merci', '', '', '100.00', '', 'IN'),
('18', 'Hija de lolita', '', '', '300.00', 'la muchacha que trabajaba en donde mundi', 'IN'),
('19', 'Nely de Antonio', '', '', '100.00', '', 'IN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arinvc`
--

CREATE TABLE `arinvc` (
  `cinvno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `dstar` date NOT NULL,
  `dend` date NOT NULL,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `armedm`
--

CREATE TABLE `armedm` (
  `cmedno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `csigno` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arresp`
--

CREATE TABLE `arresp` (
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cfullname` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `mdirecc` text COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `mtels` text COLLATE utf8_spanish_ci NOT NULL,
  `cctaid` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cruc` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cfoto` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `nbalance` decimal(10,2) NOT NULL,
  `fecha` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arresp`
--

INSERT INTO `arresp` (`crespno`, `cfullname`, `cstatus`, `mdirecc`, `mnotas`, `mtels`, `cctaid`, `cruc`, `cfoto`, `nbalance`, `fecha`, `hora`, `cuserid`) VALUES
('01', 'Eddy  Jiron Guillen', 'OP', ' hola mundo', ' como estamos', '12345678', 'OP', '12345678', '', '0.00', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arserm`
--

CREATE TABLE `arserm` (
  `cservno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(200) COLLATE utf8_spanish_ci NOT NULL,
  `ncost` decimal(10,2) NOT NULL,
  `nprice` decimal(10,2) NOT NULL,
  `ctserno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cmedno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cfoto` text COLLATE utf8_spanish_ci NOT NULL,
  `lupdonhand` tinyint(1) NOT NULL,
  `lallowneg` tinyint(1) NOT NULL,
  `nlastcost` decimal(10,2) NOT NULL,
  `nprice1` decimal(10,2) NOT NULL,
  `nprice2` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arsetup`
--

CREATE TABLE `arsetup` (
  `ninvno` int(10) NOT NULL,
  `nrecno` int(10) NOT NULL,
  `nadjno` int(10) NOT NULL,
  `nncno` int(10) NOT NULL,
  `nndno` int(10) NOT NULL,
  `ncotno` int(10) NOT NULL,
  `ncashno` int(10) NOT NULL,
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `minvno` text COLLATE utf8_spanish_ci NOT NULL,
  `mestados` text COLLATE utf8_spanish_ci NOT NULL,
  `mcoti` text COLLATE utf8_spanish_ci NOT NULL,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `ccateno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `carsetup` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `ctypcost` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `ctaxproc` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `linvno` tinyint(1) NOT NULL,
  `lestados` tinyint(1) NOT NULL,
  `lcoti` tinyint(1) NOT NULL,
  `ninvlinmax` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arsetup`
--

INSERT INTO `arsetup` (`ninvno`, `nrecno`, `nadjno`, `nncno`, `nndno`, `ncotno`, `ncashno`, `cwhseno`, `minvno`, `mestados`, `mcoti`, `ccustno`, `cpaycode`, `ccateno`, `carsetup`, `ctypcost`, `ctaxproc`, `linvno`, `lestados`, `lcoti`, `ninvlinmax`) VALUES
(1, 0, 1, 1, 1, 1, 1, '', '\r\n', '', '', '00', '', '', '', 'UL', 'EX', 0, 0, 0, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artcas`
--

CREATE TABLE `artcas` (
  `cpaycode` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `ctype` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cvtype` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid1` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid2` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid3` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid4` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cctaid5` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `nday` int(3) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artran`
--

CREATE TABLE `artran` (
  `cuid` int(10) NOT NULL,
  `ccustno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `dtrndate` date NOT NULL,
  `namount` decimal(10,2) NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `ctype` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'IN',
  `cstatus` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP',
  `cuserid` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `artran`
--

INSERT INTO `artran` (`cuid`, `ccustno`, `dtrndate`, `namount`, `mnotas`, `ctype`, `cstatus`, `cuserid`, `fecha`, `hora`) VALUES
(27, '00', '2020-05-25', '36.00', '1 azucar, 3 cafe, 2 semitas de 3 , 5 semitas de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(28, '00', '2020-05-25', '8.00', '2 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(29, '01', '2020-05-25', '30.00', 'Venta de Aloe ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(30, '00', '2020-05-25', '40.00', 'Mantequilla ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(31, '00', '2020-05-25', '50.00', 'coca 2 litros ,\r\n10 vasos de plastico ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(32, '00', '2020-05-25', '6.00', '3 semitas de 2 ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(33, '00', '2020-05-25', '15.00', '1 leche sula, \r\nangeles la lleva pero no hay cambio talves haya que apuntarla.', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(34, '00', '2020-05-25', '100.00', '1 manzanilla\r\n10 de copetines\r\n6 huevos\r\n1 escoba 40\r\n1 bolsa de semitas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(35, '00', '2020-05-25', '3.00', '3 juguitos de 1', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(36, '00', '2020-05-25', '1.00', '1 bomba', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(37, '02', '2020-05-25', '20.00', '1 maseca de 2 lbrs', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(38, '00', '2020-05-25', '4.00', '1 confites sicis\r\n2 bombas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(39, '03', '2020-05-25', '27.00', '1 jugo la granja\r\n1 leche ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(40, '00', '2020-05-25', '10.00', '2 jugos YA', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(41, '00', '2020-05-25', '8.00', '2 shammpoo ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(42, '00', '2020-05-25', '10.00', '5 semitas de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(43, '00', '2020-05-25', '52.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(44, '00', '2020-05-25', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(45, '00', '2020-05-25', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(46, '00', '2020-05-25', '10.00', '5 panes de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(47, '00', '2020-05-25', '2.00', 'una agua', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(48, '00', '2020-05-25', '11.00', '2 hielo\r\n1 jugo Ya', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(49, '00', '2020-05-25', '5.00', '4 bombas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(50, '00', '2020-05-25', '2.00', 'semita 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(51, '00', '2020-05-25', '4.00', '4 bombas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(52, '00', '2020-05-25', '3.00', '1CAPI, 1 BOMBA', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(53, '00', '2020-05-25', '5.00', 'juguitos 5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(54, '00', '2020-05-25', '68.00', '4 malteadas sula', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(55, '03', '2020-05-25', '8.00', 'angeles 2 shampoo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(56, '00', '2020-05-25', '12.00', '12 polvorones', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(57, '03', '2020-05-25', '20.00', '2 chorisitos en bolsa', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(58, '00', '2020-05-25', '29.00', '1 malteada\r\n1 sofrito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(59, '00', '2020-05-25', '5.00', '1 panadol', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(60, '00', '2020-05-25', '11.00', '1 libra de azucar', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(61, '01', '2020-05-25', '-30.00', 'cancela aloe', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(62, '03', '2020-05-25', '-55.00', 'cancelacion varios', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(63, '03', '2020-05-25', '52.00', 'compra de una coca 3 litros', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(64, '00', '2020-05-25', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(65, '00', '2020-05-25', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(66, '00', '2020-05-25', '30.00', '2 leche sula', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(67, '00', '2020-05-25', '43.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(68, '04', '2020-05-25', '24.00', 'bolsa de pan', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(69, '03', '2020-05-25', '5.00', 'taquerito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(70, '00', '2020-05-25', '1.00', 'bomba', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(71, '05', '2020-05-25', '52.00', 'caca 3 litrs\r\n', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(72, '03', '2020-05-25', '7.00', 'jumypups', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(73, '03', '2020-05-25', '12.00', '3 huevos - angeles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(74, '00', '2020-05-25', '10.00', 'sopa', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(75, '00', '2020-05-25', '145.00', '1 pepsi 3lt\r\n1 lb mantequilla\r\n1 queso frijol', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(76, '00', '2020-05-25', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(77, '00', '2020-05-25', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(78, '00', '2020-05-25', '128.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(79, '00', '2020-05-25', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(80, '00', '2020-05-25', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(81, '00', '2020-05-25', '31.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(82, '06', '2020-05-25', '112.00', '2 mountain 14\r\nyumi 7\r\ncapy 2\r\nchorizo 1lb 40\r\nCocoa 35', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(83, '03', '2020-05-25', '7.00', 'yumi pop', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(84, '00', '2020-05-25', '22.00', 'pepsi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(85, '00', '2020-05-25', '12.00', '8 juguitos 2 capis', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(86, '00', '2020-05-25', '1.00', '1 sicis', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(87, '00', '2020-05-25', '18.00', 'Venta de 1 bolsita de chorizo 2 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(88, '00', '2020-05-25', '14.00', 'coca de 14 ..quede debiendo 1 lps a carlitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(89, '00', '2020-05-26', '12.00', 'semitas de 3, 1 gusanito\r\n', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(90, '00', '2020-05-26', '14.00', '1 HUEVO 5 SEMITAS 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(91, '00', '2020-05-26', '1.00', '1 BOMBA', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(92, '00', '2020-05-26', '22.00', '2 LB AZUCAR', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(93, '00', '2020-05-26', '13.00', '10 pan de 1 ,1 cafe', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(94, '00', '2020-05-26', '14.00', '14 panes', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(95, '02', '2020-05-26', '11.00', 'azucar 1 lb', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(96, '00', '2020-05-26', '2.00', 'confites', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(97, '00', '2020-05-26', '2.00', '1 juguito 1 bomba', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(98, '00', '2020-05-26', '2.00', 'semita', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(99, '00', '2020-05-26', '2.00', 'juguitos rojos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(100, '00', '2020-05-26', '8.00', 'uvita', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(101, '00', '2020-05-26', '64.00', '2 gatorade 1 raptor', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(102, '00', '2020-05-26', '2.00', 'capi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(103, '03', '2020-05-26', '8.00', 'jugo de 8', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(104, '00', '2020-05-26', '6.00', 'tan y bomba', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(105, '00', '2020-05-26', '15.00', '3 huevos y 3 panes ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(106, '00', '2020-05-26', '10.00', 'jugo', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(107, '00', '2020-05-26', '2.00', '1 algodon\r\n1 cubitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(108, '00', '2020-05-26', '13.00', '12 sofrito\r\n1 cubitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(109, '00', '2020-05-26', '2.00', 'confites', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(110, '00', '2020-05-26', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(111, '00', '2020-05-26', '7.00', 'semita 3 4juguitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(112, '00', '2020-05-26', '36.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(113, '03', '2020-05-26', '40.00', '1 coca de 2 litros', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(114, '01', '2020-05-26', '182.00', '1 molida 56,shorisos 20,semitas 24,pan 18,galleta 24,mant 40\r\n\r\n', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(115, '00', '2020-05-26', '20.00', '5 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(116, '00', '2020-05-26', '50.00', 'pepsi 3 lt', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(117, '00', '2020-05-26', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(118, '01', '2020-05-26', '10.00', '10 galletas\r\n', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(119, '01', '2020-05-26', '-7.00', 'cuenta de las galletas', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(120, '00', '2020-05-26', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(121, '07', '2020-05-26', '27.00', 'pepsi 1.5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(122, '06', '2020-05-26', '40.00', '1 pepsi 27, 1 chiky 5, jugo 8', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(123, '00', '2020-05-26', '6.00', 'semitas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(124, '00', '2020-05-26', '50.00', 'pepsi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(126, '00', '2020-05-26', '40.00', 'banana', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(127, '00', '2020-05-26', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(128, '00', '2020-05-26', '42.00', '1 coca 30\r\n6 pan blanco 12', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(129, '00', '2020-05-26', '14.00', 'mointan', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(130, '00', '2020-05-26', '27.00', 'pepsi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(131, '03', '2020-05-26', '1.00', '1 bombon', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(132, '00', '2020-05-26', '80.00', '2 lb mantequilla', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(133, '00', '2020-05-26', '7.00', 'capi y taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(134, '00', '2020-05-26', '17.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(135, '00', '2020-05-26', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(136, '00', '2020-05-26', '52.00', 'pepsi 3 lt', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(137, '00', '2020-05-26', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(138, '00', '2020-05-26', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(139, '00', '2020-05-26', '43.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(140, '00', '2020-05-26', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(141, '08', '2020-05-26', '32.00', '2 yumipups 1 coca de 18', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(142, '00', '2020-05-26', '5.00', '3 juguitos y 1 capi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(143, '00', '2020-05-26', '5.00', 'taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(144, '00', '2020-05-26', '32.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(145, '00', '2020-05-26', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(146, '00', '2020-05-26', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(147, '00', '2020-05-26', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(148, '00', '2020-05-26', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(149, '00', '2020-05-26', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(150, '00', '2020-05-26', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(151, '02', '2020-05-26', '22.00', 'pepsi de 22', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(152, '00', '2020-05-26', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(153, '00', '2020-05-26', '32.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(154, '03', '2020-05-26', '35.00', 'mantequilla 20\r\nmortadela 15', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(155, '00', '2020-05-26', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(157, '00', '2020-05-27', '41.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(158, '00', '2020-05-27', '11.00', 'azucar lb', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(159, '00', '2020-05-27', '20.00', 'mantequilla 1/2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(160, '00', '2020-05-27', '74.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(161, '00', '2020-05-27', '6.00', '3 semitas de 2', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(162, '00', '2020-05-27', '3.00', 'cafe', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(163, '00', '2020-05-27', '1.00', 'bombon', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(164, '00', '2020-05-27', '16.00', 'jugo de lata y 6 besitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(165, '00', '2020-05-27', '44.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(166, '00', '2020-05-27', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(167, '03', '2020-05-27', '62.00', 'coca 2lt 40 margarina 6 salsa dulce 10 marmelos 6', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(168, '00', '2020-05-27', '9.00', 'yumi y otros', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(169, '00', '2020-05-27', '14.00', 'coca 14', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(170, '00', '2020-05-27', '27.00', 'pepsi 27', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(171, '00', '2020-05-27', '50.00', 'media quezo y mantequilla', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(172, '09', '2020-05-27', '44.00', '2 arros 22 \r\nraptor 20\r\n2 cubitos 2', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(173, '00', '2020-05-27', '20.00', '10 extremeños', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(174, '00', '2020-05-27', '21.00', '2 capi 1 jugo la granja 1 chiqui', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(175, '00', '2020-05-27', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(176, '00', '2020-05-27', '5.00', 'tan', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(177, '03', '2020-05-27', '8.00', 'juguito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(178, '00', '2020-05-27', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(179, '00', '2020-05-27', '45.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(180, '00', '2020-05-27', '4.00', 'pan ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(181, '03', '2020-05-27', '7.00', 'yumi', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(182, '03', '2020-05-27', '-5.00', 'oscarito dio 5', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(183, '00', '2020-05-27', '17.00', 'ace y suavitel', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(184, '03', '2020-05-27', '7.00', 'shampoo ,1 agua', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(185, '03', '2020-05-27', '7.00', '1 yummy pops angeles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(186, '00', '2020-05-27', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(187, '00', '2020-05-27', '7.00', 'yumipups', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(188, '00', '2020-05-28', '37.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(189, '03', '2020-05-28', '20.00', '2 bolsas de chorizo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(190, '00', '2020-05-27', '154.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(191, '03', '2020-05-27', '32.00', '2 leches y churro', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(192, '00', '2020-05-27', '5.00', 'taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(193, '00', '2020-05-28', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(194, '03', '2020-05-28', '11.00', 'y bolsita chorizo y juguito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(195, '01', '2020-05-28', '-185.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(196, '01', '2020-05-01', '393.00', 'provision para el mes', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(197, '02', '2020-05-24', '288.00', 'provicion al mes de productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(198, '10', '2020-05-24', '167.00', 'saldo pendiente de deuda', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(199, '00', '2020-05-28', '27.00', 'pepsi 1.5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(200, '00', '2020-05-28', '48.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(201, '00', '2020-05-28', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(202, '03', '2020-05-28', '30.00', 'coca de 30', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(203, '07', '2020-05-28', '36.00', '4 huevos 2 lbs  maseca 20', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(204, '00', '2020-05-28', '50.00', '1lb mortadela ,5 huevos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(205, '00', '2020-05-28', '7.00', '3 juguitos y 2 capi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(206, '00', '2020-05-28', '5.00', '2 juguitos 3 besitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(207, '00', '2020-05-28', '5.00', 'tank', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(208, '00', '2020-05-28', '27.00', 'pepsi 1.5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(209, '07', '2020-05-28', '17.00', '2 hielo 1/4mantequilla', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(210, '03', '2020-05-28', '5.00', 'confites', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(211, '00', '2020-05-28', '6.00', 'jabon de lavar', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(212, '00', '2020-05-28', '12.00', 'sopa instantanea', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(213, '00', '2020-05-28', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(214, '00', '2020-05-28', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(215, '03', '2020-05-28', '3.00', 'hielo', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(216, '11', '2020-05-28', '20.00', 'toalla sanitaria', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(217, '00', '2020-05-28', '53.00', '3 azucar 2 shampoo 5 semitas 1 capi', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(218, '00', '2020-05-28', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(219, '00', '2020-05-28', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(220, '00', '2020-05-28', '42.00', 'pepsi 27 2 capi 1 oreon 4 confites', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(221, '00', '2020-05-28', '5.00', 'taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(222, '00', '2020-05-28', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(224, '12', '2020-05-24', '162.00', 'saldo inicial', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(225, '00', '2020-05-28', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(226, '00', '2020-05-28', '34.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(227, '00', '2020-05-28', '41.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(228, '00', '2020-05-28', '177.00', 'Vta a Lito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(229, '07', '2020-05-28', '115.00', 'aceite , chorizo, huevos, queso, polvorones', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(230, '00', '2020-05-28', '23.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(231, '00', '2020-05-28', '1.00', 'besito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(232, '00', '2020-05-28', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(233, '03', '2020-05-28', '26.00', 'montain 14 , yumipup 7, galleta 5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(234, '00', '2020-05-28', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(235, '00', '2020-05-28', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(236, '00', '2020-05-28', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(237, '00', '2020-05-28', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(238, '13', '2020-05-24', '298.00', 'Venta al credito de productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(239, '00', '2020-05-28', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(240, '00', '2020-05-28', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(241, '00', '2020-05-28', '32.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(242, '00', '2020-05-28', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(243, '00', '2020-05-28', '17.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(244, '00', '2020-05-28', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(245, '00', '2020-05-28', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(246, '00', '2020-05-28', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(247, '00', '2020-05-28', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(248, '00', '2020-05-28', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(249, '00', '2020-05-29', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(250, '00', '2020-05-29', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(251, '00', '2020-05-29', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(252, '00', '2020-05-29', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(253, '14', '2020-05-24', '379.00', 'credito de varios productos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(254, '15', '2020-05-24', '379.00', 'credito de productos ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(255, '00', '2020-05-29', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(256, '00', '2020-05-29', '26.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(257, '00', '2020-05-29', '10.00', '2 orchatas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(258, '15', '2020-05-29', '2.00', 'un huevo paga 2 ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(259, '00', '2020-05-29', '2.00', 'un huevo ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(260, '00', '2020-05-29', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(261, '00', '2020-05-29', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(262, '00', '2020-05-29', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(263, '00', '2020-05-29', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(264, '02', '2020-05-29', '25.00', 'mantequilla 20, clavo de olor 5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(265, '00', '2020-05-29', '37.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(266, '00', '2020-05-29', '5.00', 'marmelos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(267, '03', '2020-05-29', '73.00', '9 semitas 2, 2 cafes 3,2 arroz 11,pepsi 27', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(268, '00', '2020-05-29', '51.00', '', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(269, '00', '2020-05-29', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(270, '00', '2020-05-29', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(271, '00', '2020-05-29', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(272, '03', '2020-05-29', '4.00', 'shampoo angeles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(273, '03', '2020-05-29', '55.00', 'libra de queso ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(274, '03', '2020-05-29', '57.00', '2 jugo de lata 10, 1 leche 15, 2lb azucar 22', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(275, '03', '2020-05-29', '17.00', '2 juguitos ,7,8', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(276, '00', '2020-05-29', '125.00', 'asistin 35,cloro 28,18 ace,escoba 44', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(277, '00', '2020-05-29', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(278, '13', '2020-05-29', '127.00', 'jabon 22,\r\nj. platos 12,\r\nsal 2,\r\nfosforos 1,\r\npan 24,\r\n2 shampo 8,\r\n3 suavitel 30,\r\n2 azucar 22,\r\ncafe 6', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(279, '00', '2020-05-29', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(280, '00', '2020-05-29', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(281, '00', '2020-05-29', '52.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(282, '00', '2020-05-29', '57.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(283, '00', '2020-05-29', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(284, '00', '2020-05-29', '78.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(285, '15', '2020-05-29', '-381.00', 'Venta de contado productos varios', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(286, '00', '2020-05-29', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(287, '00', '2020-05-29', '46.00', '6 chiqui y 2 juguitos caja', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(288, '00', '2020-05-29', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(289, '07', '2020-05-01', '887.00', 'Saldo inicial ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(290, '00', '2020-05-29', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(291, '15', '2020-05-29', '162.00', 'ceteco 90, cereal 50, azucar 22', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(292, '00', '2020-05-29', '6.00', 'cafes', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(293, '00', '2020-05-29', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(294, '00', '2020-05-29', '7.00', 'juguitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(295, '03', '2020-05-24', '-23.00', 'ajuste de saldo de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(296, '00', '2020-05-30', '20.00', 'raptor', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(297, '15', '2020-05-30', '14.00', 'semitas 4 y pegaloca 10', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(298, '15', '2020-05-30', '-12.00', 'abona a cuenta de pegaloca y queda deviendo 2 lps', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(299, '00', '2020-05-30', '2.00', 'juguitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(300, '00', '2020-05-30', '10.00', 'alcazelser', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(301, '00', '2020-05-30', '47.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(302, '15', '2020-05-30', '64.00', 'sofrito 12, coca 3lt 52', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(303, '00', '2020-05-30', '2.00', 'besito y juguito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(304, '00', '2020-05-30', '8.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(305, '00', '2020-05-30', '29.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(306, '00', '2020-05-30', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(307, '00', '2020-05-30', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(308, '00', '2020-05-30', '6.00', 'tang y juguito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(309, '00', '2020-05-30', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(310, '00', '2020-05-30', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(311, '15', '2020-05-30', '-2.00', 'cancela la goma loca', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(312, '15', '2020-05-30', '6.00', 'margarina', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(313, '00', '2020-05-30', '21.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(314, '00', '2020-05-30', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(315, '00', '2020-05-30', '48.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(316, '00', '2020-05-30', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(317, '00', '2020-05-30', '21.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(318, '00', '2020-05-30', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(319, '02', '2020-05-30', '12.00', '3 huevos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(320, '00', '2020-05-30', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(321, '00', '2020-05-30', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(322, '00', '2020-05-30', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(323, '00', '2020-05-30', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(324, '15', '2020-05-30', '44.00', 'escoba', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(325, '00', '2020-05-30', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(326, '00', '2020-05-31', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(327, '00', '2020-05-31', '49.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(328, '00', '2020-05-31', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(329, '00', '2020-05-31', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(330, '16', '2020-05-01', '171.00', 'saldo inicial \r\npepsi 3 litros 2 cocas 3 litros una maleatda 5 pan blanco', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(331, '16', '2020-05-31', '10.00', '5 pan blancos ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(332, '00', '2020-05-31', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(333, '00', '2020-05-31', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(334, '00', '2020-05-31', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(335, '03', '2020-05-31', '20.00', 'mantequilla 1/2', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(336, '00', '2020-05-31', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(337, '00', '2020-05-31', '9.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(338, '00', '2020-05-31', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(339, '00', '2020-05-31', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(340, '00', '2020-05-31', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(341, '00', '2020-05-31', '43.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(342, '00', '2020-05-31', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(343, '00', '2020-05-31', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(344, '00', '2020-05-31', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(345, '16', '2020-05-31', '27.00', 'fresco 27', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(346, '00', '2020-05-31', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(347, '00', '2020-05-31', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(348, '00', '2020-05-31', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(349, '00', '2020-05-31', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(350, '00', '2020-05-31', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(351, '03', '2020-05-31', '7.00', 'churro angeles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(352, '00', '2020-05-31', '41.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(353, '00', '2020-05-31', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(354, '00', '2020-05-31', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(355, '00', '2020-05-31', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(356, '00', '2020-05-31', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(357, '03', '2020-05-31', '15.00', 'media de mortadela', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(358, '00', '2020-05-31', '9.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(359, '00', '2020-05-31', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(360, '15', '2020-05-31', '52.00', '52 coca', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(361, '00', '2020-05-31', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(362, '00', '2020-05-31', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(363, '00', '2020-05-31', '48.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(364, '00', '2020-05-31', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(365, '00', '2020-05-31', '55.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(366, '00', '2020-05-31', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(367, '02', '2020-06-01', '42.00', 'pepsi 22, 20 mantequilla', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(368, '07', '2020-06-01', '-1082.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(369, '00', '2020-06-01', '20.00', '1 libra arroz 15 , cubitos 5', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(370, '00', '2020-06-01', '4.00', 'capy y 2 juguitos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(371, '00', '2020-06-01', '41.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(372, '00', '2020-06-01', '27.00', 'coca', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(373, '00', '2020-06-01', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(374, '00', '2020-06-01', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(375, '00', '2020-06-01', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(376, '00', '2020-06-01', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(377, '00', '2020-06-01', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(378, '01', '2020-06-01', '14.00', '1 BABANA', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(379, '00', '2020-06-01', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(380, '00', '2020-06-01', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(381, '00', '2020-06-01', '80.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(382, '00', '2020-06-01', '31.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(383, '00', '2020-06-01', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(384, '00', '2020-06-01', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(385, '00', '2020-06-01', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(386, '00', '2020-06-01', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(387, '00', '2020-06-01', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(388, '00', '2020-06-01', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(389, '00', '2020-06-01', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(390, '00', '2020-06-01', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(391, '00', '2020-06-01', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(392, '07', '2020-06-01', '47.00', 'PEPSI 27 , MANTEQUILLA 20', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(393, '15', '2020-06-01', '52.00', 'COCA 3LT', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(394, '00', '2020-06-01', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(395, '00', '2020-06-01', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(396, '00', '2020-06-01', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(397, '18', '2020-06-01', '15.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(398, '00', '2020-06-01', '36.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(399, '00', '2020-06-01', '55.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(400, '00', '2020-06-01', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(401, '00', '2020-06-01', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(402, '00', '2020-06-01', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(403, '00', '2020-06-01', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(404, '00', '2020-06-01', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(405, '00', '2020-06-01', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(406, '00', '2020-06-01', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(407, '00', '2020-06-01', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(408, '00', '2020-06-02', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(409, '00', '2020-06-02', '40.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(410, '13', '2020-06-02', '59.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(411, '00', '2020-06-02', '50.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(412, '00', '2020-06-02', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(413, '00', '2020-06-02', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(414, '07', '2020-06-02', '61.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(415, '00', '2020-06-02', '36.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(416, '00', '2020-06-02', '3.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(417, '00', '2020-06-02', '15.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(418, '00', '2020-06-02', '77.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(419, '00', '2020-06-02', '58.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(420, '01', '2020-06-02', '11.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(421, '01', '2020-06-02', '2.00', 'jemita de 2', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(422, '06', '2020-06-02', '-152.00', 'cancelacion de cuenta pendiente', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(423, '17', '2020-06-02', '40.00', 'chorizo y 5 huevos', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(424, '07', '2020-06-02', '59.00', '.5 quesillo 20, .5 queso 28, salda dulce 11.', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(425, '00', '2020-06-02', '7.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(426, '01', '2020-06-02', '-11.00', 'abono a cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(427, '00', '2020-06-02', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(428, '00', '2020-06-02', '83.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(429, '00', '2020-06-02', '18.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(430, '00', '2020-06-02', '49.00', '3 sivas, 2 jugos de granja 12', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(431, '00', '2020-06-03', '1.00', 'caja de fosforos', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(432, '00', '2020-06-03', '72.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(433, '00', '2020-06-03', '118.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(434, '00', '2020-06-03', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(435, '00', '2020-06-03', '19.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(436, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(437, '00', '2020-06-03', '2.00', 'sicsis', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(438, '00', '2020-06-03', '39.00', 'MANTAQUILLA , JUGO LEYDE ', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(439, '00', '2020-06-03', '40.00', 'QUESILLO', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(440, '00', '2020-06-03', '10.00', 'Copetines', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(441, '00', '2020-06-03', '4.00', 'huevo', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(442, '12', '2020-06-03', '27.00', 'media de mortadela y 1 de tallarines', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(443, '00', '2020-06-03', '24.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(444, '00', '2020-06-03', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(445, '00', '2020-06-03', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(446, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(447, '03', '2020-06-03', '20.00', 'hidrocrema, cepillo ', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(448, '03', '2020-06-03', '2.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(449, '00', '2020-06-03', '64.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(450, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(451, '00', '2020-06-03', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(452, '00', '2020-06-03', '13.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(453, '00', '2020-06-03', '22.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(454, '00', '2020-06-03', '33.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(455, '00', '2020-06-03', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(456, '03', '2020-06-03', '20.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(457, '03', '2020-06-03', '12.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(458, '03', '2020-06-03', '8.00', 'juguito oscarito', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(459, '00', '2020-06-03', '5.00', 'TAJADITA', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(460, '00', '2020-06-03', '4.00', 'BOMBONES', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(461, '03', '2020-06-03', '1.00', 'BOMBON A OSCARITO', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(462, '00', '2020-06-03', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(463, '07', '2020-06-03', '-231.00', 'Cancelacion', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(464, '00', '2020-06-03', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(465, '00', '2020-06-03', '5.00', 'Taquerito', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(466, '00', '2020-06-03', '35.00', '', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(467, '01', '2020-06-03', '373.00', 'productos varios para el mes.', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(468, '03', '2020-06-03', '2.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(469, '03', '2020-06-03', '15.00', 'jugo de lata y 5 juguitos de lempira', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(470, '01', '2020-06-03', '-393.00', 'abono a cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(471, '00', '2020-06-03', '85.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(472, '00', '2020-06-03', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(473, '00', '2020-06-03', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000');
INSERT INTO `artran` (`cuid`, `ccustno`, `dtrndate`, `namount`, `mnotas`, `ctype`, `cstatus`, `cuserid`, `fecha`, `hora`) VALUES
(474, '00', '2020-06-03', '27.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(475, '00', '2020-06-03', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(476, '00', '2020-06-03', '80.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(477, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(478, '01', '2020-06-03', '9.00', 'agua 3', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(479, '00', '2020-06-03', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(480, '00', '2020-06-03', '25.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(481, '19', '2020-06-03', '37.00', '1 raptor , malteada de 17\r\npagara el 4/6/2020', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(482, '00', '2020-06-03', '20.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(483, '00', '2020-06-04', '74.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(484, '00', '2020-06-04', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(485, '00', '2020-06-04', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(486, '00', '2020-06-04', '2.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(487, '00', '2020-06-04', '16.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(488, '00', '2020-06-04', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(489, '00', '2020-06-04', '26.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(490, '00', '2020-06-04', '34.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(491, '00', '2020-06-04', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(492, '01', '2020-06-04', '130.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(493, '07', '2020-06-04', '28.00', 'media de queso', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(494, '00', '2020-06-04', '256.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(495, '19', '2020-06-04', '-37.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(496, '00', '2020-06-04', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(497, '00', '2020-06-04', '14.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(498, '00', '2020-06-04', '4.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(499, '00', '2020-06-04', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(500, '00', '2020-06-04', '12.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(501, '00', '2020-06-04', '54.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(502, '00', '2020-06-04', '45.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(503, '03', '2020-06-04', '10.00', 'taquerito, juguito 5', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(504, '00', '2020-06-04', '30.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(505, '00', '2020-06-04', '52.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(506, '00', '2020-06-04', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(507, '00', '2020-06-04', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(508, '00', '2020-06-04', '10.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(509, '16', '2020-06-04', '20.00', 'Venta de contado productos varios', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(510, '00', '2020-06-04', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(511, '00', '2020-06-04', '9.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(512, '00', '2020-06-04', '1.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(513, '17', '2020-06-04', '-40.00', 'cancelacion de deuda', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(514, '00', '2020-06-04', '6.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(515, '02', '2020-06-04', '-420.00', 'cancelacion de cuenta', 'RE', 'OP', '', '0000-00-00', '00:00:00.000000'),
(516, '00', '2020-06-04', '28.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(517, '02', '2020-06-04', '113.00', '', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(518, '02', '2020-06-04', '20.00', 'mantequilla 20', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(519, '00', '2020-06-04', '10.00', '5 semitas', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(520, '16', '2020-06-04', '20.00', '2 mufles', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000'),
(521, '00', '2020-06-04', '34.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(522, '00', '2020-06-04', '5.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(523, '00', '2020-06-04', '11.00', 'Venta de contado productos varios', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(524, '00', '2020-06-04', '10.00', 'candela y fresco de 8', 'CT', 'OP', '', '0000-00-00', '00:00:00.000000'),
(525, '03', '2020-06-04', '5.00', 'tajaditas', 'IN', 'OP', '', '0000-00-00', '00:00:00.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artser`
--

CREATE TABLE `artser` (
  `ctserno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arwhse`
--

CREATE TABLE `arwhse` (
  `cwhseno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `cdesc` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `crespno` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `mdirecc` text COLLATE utf8_spanish_ci NOT NULL,
  `mtel` text COLLATE utf8_spanish_ci NOT NULL,
  `mnotas` text COLLATE utf8_spanish_ci NOT NULL,
  `cstatus` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'OP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aptran`
--
ALTER TABLE `aptran`
  ADD PRIMARY KEY (`cuid`);

--
-- Indices de la tabla `arcust`
--
ALTER TABLE `arcust`
  ADD PRIMARY KEY (`ccustno`);

--
-- Indices de la tabla `arinvc`
--
ALTER TABLE `arinvc`
  ADD PRIMARY KEY (`cinvno`);

--
-- Indices de la tabla `armedm`
--
ALTER TABLE `armedm`
  ADD PRIMARY KEY (`cmedno`);

--
-- Indices de la tabla `arresp`
--
ALTER TABLE `arresp`
  ADD PRIMARY KEY (`crespno`);

--
-- Indices de la tabla `arserm`
--
ALTER TABLE `arserm`
  ADD PRIMARY KEY (`cservno`);

--
-- Indices de la tabla `artcas`
--
ALTER TABLE `artcas`
  ADD PRIMARY KEY (`cpaycode`);

--
-- Indices de la tabla `artran`
--
ALTER TABLE `artran`
  ADD UNIQUE KEY `cuid` (`cuid`);

--
-- Indices de la tabla `artser`
--
ALTER TABLE `artser`
  ADD PRIMARY KEY (`ctserno`);

--
-- Indices de la tabla `arwhse`
--
ALTER TABLE `arwhse`
  ADD PRIMARY KEY (`cwhseno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aptran`
--
ALTER TABLE `aptran`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `artran`
--
ALTER TABLE `artran`
  MODIFY `cuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
