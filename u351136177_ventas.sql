-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 05:14 PM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u351136177_ventas`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria_productos`
--

CREATE TABLE `categoria_productos` (
  `ID_CATEGORIA` int(2) NOT NULL,
  `NOMBRE` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPCION` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IMAGEN` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ID_ESTATUS` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categoria_productos`
--

INSERT INTO `categoria_productos` (`ID_CATEGORIA`, `NOMBRE`, `DESCRIPCION`, `IMAGEN`, `ID_ESTATUS`) VALUES
(1, 'TODO', 'prueba', 'algo', '1'),
(2, 'NADA', 'asdad', '../../recursos/imagenes/regCategoria/hu-tao.png', '1'),
(3, 'dasdasd', 'asdasd', '../../recursos/imagenes/regCategoria/917063191786299473.png', '1'),
(4, 'HELADOS', 'PALETAS', '../../recursos/imagenes/regCategoria/17010.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `config_permisos`
--

CREATE TABLE `config_permisos` (
  `NIVEL` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `ID_PERMISO` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_permisos`
--

INSERT INTO `config_permisos` (`NIVEL`, `ID_PERMISO`) VALUES
('0', 1),
('1', 2),
('2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cotizacion`
--

CREATE TABLE `cotizacion` (
  `ID_COTIZACION` int(10) NOT NULL,
  `FECHA` date NOT NULL,
  `NOMBR_CLIENTE` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `CORREO_CLIENTE` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ID_ESTATUS` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cotizacion`
--

INSERT INTO `cotizacion` (`ID_COTIZACION`, `FECHA`, `NOMBR_CLIENTE`, `CORREO_CLIENTE`, `ID_ESTATUS`) VALUES
(1, '2022-05-22', 'pepito', 'pepito@hotmail.com', '4'),
(2, '2022-06-06', 'admin', 'pepito@hotmail.com', '3'),
(3, '2022-06-06', 'admin', 'pepito@hotmail.com', '3'),
(4, '2022-06-08', 'admin', 'pepito@hotmail.com', '3'),
(5, '2022-06-09', '', '', '3'),
(6, '2022-06-09', 'Juan Jose', 'asd@gmail.com', '4'),
(7, '2022-06-09', 'admin', 'pepito@hotmail.com', '3'),
(8, '2022-06-09', 'OREOS', 'ALGO@GMAIL.COM', '3'),
(9, '2022-06-09', 'OREOS', 'ALGO@GMAIL.COM', '3'),
(10, '2022-06-09', '', '', '4'),
(11, '2022-06-09', 'admin2', 'pepito@hotmail.com', '3'),
(12, '2022-06-09', 'admin2', 'pepito@hotmail.com', '3'),
(13, '2022-06-09', 'admin2', 'pepito@hotmail.com', '3'),
(14, '2022-06-09', 'admin2', 'pepito@hotmail.com', '3'),
(15, '2022-06-09', 'cliente', 'cliente@gmail.com', '4');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_cotizacion`
--

CREATE TABLE `detalle_cotizacion` (
  `ID_COTIZACION` int(10) NOT NULL,
  `ID_PRODUCTO` int(5) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `PRECIO_VENTA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detalle_cotizacion`
--

INSERT INTO `detalle_cotizacion` (`ID_COTIZACION`, `ID_PRODUCTO`, `CANTIDAD`, `PRECIO_VENTA`) VALUES
(2, 3, 4, 1000),
(3, 3, 1, 1000),
(4, 2, 1, 19),
(5, 8, 2, 30),
(6, 2, 1, 19),
(6, 4, 1, 30),
(6, 13, 1, 15),
(7, 3, 2, 1000),
(7, 6, 1, 30),
(8, 2, 1, 19),
(9, 3, 1, 1000),
(10, 2, 1, 19),
(10, 3, 1, 1000),
(11, 2, 10, 19),
(12, 2, 1, 19),
(12, 3, 1, 1000),
(12, 4, 1, 30),
(13, 2, 2, 19),
(13, 3, 1, 1000),
(14, 17, 1, 19),
(15, 2, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `ID_VENTA` int(10) NOT NULL,
  `ID_PRODUCTO` int(5) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `PRECIO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detalle_venta`
--

INSERT INTO `detalle_venta` (`ID_VENTA`, `ID_PRODUCTO`, `CANTIDAD`, `PRECIO`) VALUES
(1, 3, 10, 30),
(2, 1, 10, 19),
(4, 3, 1, 1000),
(5, 3, 1, 1000),
(7, 3, 2, 1000),
(7, 6, 1, 30),
(8, 2, 10, 10),
(9, 2, 1, 19),
(9, 3, 1, 1000),
(9, 4, 1, 30),
(10, 3, 1, 1000),
(11, 3, 1, 1000),
(12, 3, 1, 1000),
(13, 3, 1, 1000),
(14, 17, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `estatus`
--

CREATE TABLE `estatus` (
  `ID_ESTATUS` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPCION` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estatus`
--

INSERT INTO `estatus` (`ID_ESTATUS`, `DESCRIPCION`) VALUES
('1', 'ACTIVO'),
('2', 'ELIMINAR'),
('3', 'EN ESPERA'),
('4', 'EN TRAMITE');

-- --------------------------------------------------------

--
-- Table structure for table `forma_pago`
--

CREATE TABLE `forma_pago` (
  `ID_FORMA_PAGO` int(2) NOT NULL,
  `DESCRIPCION` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_ESTATUS` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forma_pago`
--

INSERT INTO `forma_pago` (`ID_FORMA_PAGO`, `DESCRIPCION`, `ID_ESTATUS`) VALUES
(1, 'EFECTIVO', '1'),
(2, 'TRANSFERENCIA', '1');

-- --------------------------------------------------------

--
-- Table structure for table `info_empresa`
--

CREATE TABLE `info_empresa` (
  `NOMBRE` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `LOGO` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `SLOGAN` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPCION` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `TELEFONO` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `CORREO` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `WEBSITE` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `FACEBOOK` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `TWITER` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info_empresa`
--

INSERT INTO `info_empresa` (`NOMBRE`, `LOGO`, `SLOGAN`, `DESCRIPCION`, `TELEFONO`, `CORREO`, `WEBSITE`, `FACEBOOK`, `TWITER`) VALUES
('FERREMOSA SA DE CV', 'http://ventas.research-soft.com/ProyectoTiendaOnline//recursos/imagenes/LOGO/FERREMOSA SA DE CV.png', 'A TU SERVICI', 'VENTA DE PRODUCTOS VARIADOS', '1111111111', 'FERREMOSA@OUTLOOK.COM', 'http://ventas.research-soft.com/Proyecto', 'Ferremosa', '@Ferremosa');

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE `permisos` (
  `ID_PERMISOS` int(2) NOT NULL,
  `DESCRIPCION` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`ID_PERMISOS`, `DESCRIPCION`) VALUES
(1, 'CLIENTE'),
(2, 'ADMIN'),
(3, 'VENTAS');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `ID_PRODUCTO` int(100) NOT NULL,
  `ID_CATEGORIA` int(2) NOT NULL,
  `NOMBRE` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IMAGEN` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRECIO_COMPRA` float NOT NULL,
  `PRECIO` float NOT NULL,
  `STOCK` int(11) NOT NULL,
  `STOCK_MIN` int(11) NOT NULL,
  `ID_ESTATUS` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `CODIGO_BARRAS` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`ID_PRODUCTO`, `ID_CATEGORIA`, `NOMBRE`, `IMAGEN`, `PRECIO_COMPRA`, `PRECIO`, `STOCK`, `STOCK_MIN`, `ID_ESTATUS`, `CODIGO_BARRAS`) VALUES
(1, 2, 'Pandas', '  ../../recursos/imagenes/productos/Pandas/Pandas.png', 30, 30, 10, 10, '1', '9786077834557'),
(2, 1, 'OREOS', 'https://bluemadness.000webhostapp.com/img/gen-ult.jpg', 14, 19, 283, 100, '1', ''),
(3, 1, 'EMPERADOR', 'https://bluemadness.000webhostapp.com/img/Hu-Tao.jpeg', 50, 1000, 95, 1, '1', ''),
(4, 1, 'GAMESA', 'https://bluemadness.000webhostapp.com/img/gen-ult.jpg', 30, 30, 19, 10, '1', ''),
(5, 1, 'OREOS', 'https://bluemadness.000webhostapp.com/img/gen-ult.jpg', 30, 30, 20, 10, '1', ''),
(6, 1, 'OREOS', 'https://bluemadness.000webhostapp.com/img/gen-ult.jpg', 30, 30, 19, 10, '1', ''),
(7, 1, 'OREOS', 'https://bluemadness.000webhostapp.com/img/gen-ult.jpg', 30, 30, 20, 10, '1', ''),
(8, 1, 'OREOS', 'https://bluemadness.000webhostapp.com/img/gen-ult.jpg', 30, 30, 20, 10, '1', ''),
(9, 1, 'OREOS', 'https://bluemadness.000webhostapp.com/img/gen-ult.jpg', 30, 30, 20, 10, '1', ''),
(10, 1, 'DORITOS', '  ../../recursos/imagenes/productos/DORITOS/DORITOS.png', 123, 12312, 123, 123, '1', ''),
(11, 1, 'ALGO', '  ../../recursos/imagenes/productos/ALGO/ALGO.png', 200, 210, 20, 1, '1', '11111111'),
(12, 1, 'DORITOS2', '  ../../recursos/imagenes/productos/TANT/TANT.png', 10, 11, 1, 1, '1', '000000'),
(13, 1, 'Chetos araña', '../../recursos/imagenes/productos/Chetos araña/Chetos araña.jpg', 10, 15, 20, 3, '1', '20'),
(14, 1, 'OREO', '../../recursos/imagenes/productos/OREO/OREO.png', 200, 210, 10, 1, '1', '0001111'),
(15, 1, 'PEPE', '  ../../recursos/imagenes/productos/PEPE/PEPE.png', 200, 1000, 10, 1, '1', '9786077834558'),
(16, 1, 'Frutsi', '../../recursos/imagenes/productos/Frutsi/Frutsi.jpg', 10, 17, 99, 5, '1', '01800'),
(17, 1, 'takis', '../../recursos/imagenes/productos/takis/takis.jpg', 8, 19, 6, 2, '1', '0000003001');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(5) NOT NULL,
  `NOMBRE` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `USUARIO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `CONTRA` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NIVEL` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `IMAGEN` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `CORREO` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ID_ESTATUS` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `NOMBRE`, `USUARIO`, `CONTRA`, `NIVEL`, `IMAGEN`, `CORREO`, `ID_ESTATUS`) VALUES
(1, 'pepito', 'pepito', 'pepito', '2', 'recursos/imagenes/productos/arma/arma.png', 'pepito@hotmail.com', '1'),
(2, 'admin2', 'admin', 'admin', '1', 'recursos/imagenes/usuarios/admin/admin.png', 'pepito@hotmail.com', '1'),
(3, 'juanito', 'juanito', '1234', '1', 'recursos/imagenes/usuarios/juanito/juanito.png', 'juanito@gmail.com', '2'),
(4, 'cliente', 'cliente', 'cliente', '0', 'recursos/imagenes/usuarios/cliente/cliente.png', 'cliente@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `ID_VENTA` int(10) NOT NULL,
  `ID_USUARIO` int(5) NOT NULL,
  `ID_FORMA_PAGO` int(2) NOT NULL,
  `FECHA` date NOT NULL,
  `ID_ESTATUS` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`ID_VENTA`, `ID_USUARIO`, `ID_FORMA_PAGO`, `FECHA`, `ID_ESTATUS`) VALUES
(1, 1, 1, '2022-06-07', '1'),
(2, 2, 1, '2022-06-08', '1'),
(3, 1, 1, '2022-06-09', '1'),
(4, 1, 2, '2022-06-09', '1'),
(5, 1, 1, '2022-06-09', '1'),
(6, 1, 1, '2022-06-09', '1'),
(7, 1, 1, '2022-06-09', '1'),
(8, 1, 1, '2022-06-09', '1'),
(9, 1, 1, '2022-06-09', '1'),
(10, 1, 2, '2022-06-09', '1'),
(11, 1, 2, '2022-06-09', '1'),
(12, 1, 1, '2022-06-09', '1'),
(13, 1, 1, '2022-06-09', '1'),
(14, 1, 1, '2022-06-09', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria_productos`
--
ALTER TABLE `categoria_productos`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indexes for table `config_permisos`
--
ALTER TABLE `config_permisos`
  ADD PRIMARY KEY (`NIVEL`),
  ADD KEY `RELACION_PERMISOS` (`ID_PERMISO`);

--
-- Indexes for table `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`ID_COTIZACION`),
  ADD KEY `STATUS_CO` (`ID_ESTATUS`);

--
-- Indexes for table `detalle_cotizacion`
--
ALTER TABLE `detalle_cotizacion`
  ADD PRIMARY KEY (`ID_COTIZACION`,`ID_PRODUCTO`),
  ADD KEY `PRODUCTO` (`ID_PRODUCTO`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`ID_VENTA`,`ID_PRODUCTO`),
  ADD KEY `PROD` (`ID_PRODUCTO`);

--
-- Indexes for table `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`ID_ESTATUS`);

--
-- Indexes for table `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`ID_FORMA_PAGO`),
  ADD KEY `STATUS_PAGO` (`ID_ESTATUS`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`ID_PERMISOS`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_PRODUCTO`),
  ADD KEY `CATEGORIA` (`ID_CATEGORIA`),
  ADD KEY `STATUS_PRO` (`ID_ESTATUS`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `ID_NIVEL` (`NIVEL`),
  ADD KEY `STATUS` (`ID_ESTATUS`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ID_VENTA`),
  ADD KEY `USUARIO_VENTA` (`ID_USUARIO`),
  ADD KEY `STATUS_VENTA` (`ID_ESTATUS`),
  ADD KEY `FORMA_PAGO` (`ID_FORMA_PAGO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_PRODUCTO` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `config_permisos`
--
ALTER TABLE `config_permisos`
  ADD CONSTRAINT `RELACION_PERMISOS` FOREIGN KEY (`ID_PERMISO`) REFERENCES `permisos` (`ID_PERMISOS`);

--
-- Constraints for table `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `STATUS_CO` FOREIGN KEY (`ID_ESTATUS`) REFERENCES `estatus` (`ID_ESTATUS`);

--
-- Constraints for table `detalle_cotizacion`
--
ALTER TABLE `detalle_cotizacion`
  ADD CONSTRAINT `COTIZACION` FOREIGN KEY (`ID_COTIZACION`) REFERENCES `cotizacion` (`ID_COTIZACION`),
  ADD CONSTRAINT `PRODUCTO` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `productos` (`ID_PRODUCTO`);

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `PROD` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `productos` (`ID_PRODUCTO`),
  ADD CONSTRAINT `VENTA` FOREIGN KEY (`ID_VENTA`) REFERENCES `venta` (`ID_VENTA`);

--
-- Constraints for table `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD CONSTRAINT `STATUS_PAGO` FOREIGN KEY (`ID_ESTATUS`) REFERENCES `estatus` (`ID_ESTATUS`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `CATEGORIA` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria_productos` (`ID_CATEGORIA`),
  ADD CONSTRAINT `STATUS_PRO` FOREIGN KEY (`ID_ESTATUS`) REFERENCES `estatus` (`ID_ESTATUS`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `ID_NIVEL` FOREIGN KEY (`NIVEL`) REFERENCES `config_permisos` (`NIVEL`),
  ADD CONSTRAINT `STATUS` FOREIGN KEY (`ID_ESTATUS`) REFERENCES `estatus` (`ID_ESTATUS`);

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `FORMA_PAGO` FOREIGN KEY (`ID_FORMA_PAGO`) REFERENCES `forma_pago` (`ID_FORMA_PAGO`),
  ADD CONSTRAINT `STATUS_VENTA` FOREIGN KEY (`ID_ESTATUS`) REFERENCES `estatus` (`ID_ESTATUS`),
  ADD CONSTRAINT `USUARIO_VENTA` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
