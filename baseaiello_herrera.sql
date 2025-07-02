-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2025 a las 02:47:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baseaiello_herrera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `activo` int(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `activo`) VALUES
(1, 'Cafe', 'varios tipos de cafe', 1),
(3, 'Maquinas', 'Maquinas diversas', 1),
(7, 'Accesorios', 'filtros, mangas, etc', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `leido` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `correo`, `tipo`, `descripcion`, `fecha`, `leido`) VALUES
(1, 'matiasherrera1591@gmail.cmo', 'consulta', 'no puedo ver el footer', '2025-07-02 00:35:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `descripcion`) VALUES
(1, 'Admin'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_prod` varchar(100) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `precio_vta` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `eliminado` varchar(10) NOT NULL DEFAULT 'NO',
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_prod`, `categoria_id`, `precio`, `precio_vta`, `stock`, `stock_min`, `eliminado`, `imagen`) VALUES
(15, 'Cafe importado', 1, 5000.00, 7500.00, 5, 1, 'NO', '1750950343_5911e8421b9731d579ba.png'),
(16, 'Nescafe gold ', 1, 4000.00, 9000.00, 10, 1, 'NO', '1750949743_3da6d13cb778ab72e60d.jpg'),
(17, 'Maquina de Cafe', 3, 20000.00, 40000.00, 5, 1, 'NO', '1750950304_330f371ece4e6fd594a7.jpg'),
(18, 'Filtros descartables', 7, 2000.00, 3800.00, 10, 1, 'NO', '1750949275_9253f23cb6e0ef7f0803.jpg'),
(19, 'Manga de cafe ', 7, 1000.00, 2000.00, 5, 1, 'NO', '1750949329_fd599289e9b7ea08cc03.jpg'),
(20, 'Capsula Café expreso', 1, 2000.00, 6710.30, 6, 1, 'NO', '1750950819_7ef22673b1cd2d3bc573.jpg'),
(21, 'Cafetera Atma', 3, 20000.00, 39272.63, 6, 1, 'NO', '1750950267_024da1212be13d3fef71.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `email` text NOT NULL,
  `usuario` text NOT NULL,
  `contraseña` text NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `baja` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `usuario`, `contraseña`, `perfil_id`, `baja`) VALUES
(1, 'matias', 'Rodriguez', 'matiash1591@gmail.com', 'mh1591', '$2y$10$vsnujhB0dCZDSIBNp7.pIuEtHdCG05vK85GO.T2h8aNA/CUvmbm1.', 1, ''),
(5, 'Cliente1', 'Cliente1', 'Cliente1@hotmail.com', 'Cliente1', '$2y$10$kw0VlZO/3cck3G.VpM6.Lub73Kr/IfOirCKQnzqdpnSE/cX0oevMO', 2, 'NO'),
(6, 'Cliente2', 'Cliente2', 'Cliente2@hotmail.com', 'Cliente2', '$2y$10$nKea/KcoEhZTOmkjsWZET.sEzwgNqNR0V0V75.j2ez.y3p7b.ub82', 2, 'NO'),
(7, 'Admin', 'admin', 'Admin12@hotmail.com', 'Admin', '$2y$10$NR7grEXH06ECA7SH82n9c.2M1rE7hbBNfWBfEM.4ZNOwRv.qalJqG', 1, 'NO'),
(8, 'Cliente3', 'Cliente3', 'cliente3@hotmail.com', 'Cliente3', '$2y$10$ArYoqNvyZ25OEt6cPAZcSeo2QESPZOikd1gSgO3DsDT/RCua/Jx5W', 2, 'NO'),
(9, 'Admin2', 'admin2', 'admin2@gmail.com', 'Admin2', '$2y$10$sGgkG8czlGyeWrO1SkljduaTbFMK3jPS50bW/m58qf1cOa9Rm6tmq', 1, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `total_venta` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id`, `fecha`, `usuario_id`, `total_venta`) VALUES
(1, '2025-06-26 02:48:51', 7, 500.00),
(2, '2025-06-26 02:49:04', 7, 1000.00),
(3, '2025-06-26 02:52:20', 7, 1000.00),
(4, '2025-06-26 02:53:03', 7, 100000.00),
(5, '2025-06-26 03:51:16', 7, 600.00),
(6, '2025-06-26 12:51:33', 7, 750.00),
(7, '2025-06-26 13:09:29', 7, 750.00),
(8, '2025-06-26 13:11:47', 7, 600.00),
(9, '2025-06-26 13:13:44', 7, 100000.00),
(10, '2025-06-26 13:54:40', 5, 600.00),
(11, '2025-06-26 13:56:22', 5, 100000.00),
(12, '2025-06-26 14:00:34', 5, 600.00),
(13, '2025-06-26 14:09:06', 5, 600.00),
(14, '2025-06-26 14:13:11', 5, 600.00),
(15, '2025-06-26 14:16:16', 5, 600.00),
(16, '2025-06-26 14:21:33', 5, 600.00),
(17, '2025-06-26 14:25:29', 5, 600.00),
(18, '2025-06-26 14:36:17', 5, 600.00),
(19, '2025-06-26 14:37:35', 5, 600.00),
(20, '2025-06-26 14:38:22', 5, 600.00),
(21, '2025-06-26 14:38:58', 5, 600.00),
(22, '2025-06-26 14:39:44', 5, 600.00),
(23, '2025-06-26 14:42:33', 5, 600.00),
(24, '2025-06-30 23:09:30', 7, 6710.30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(11) NOT NULL,
  `ventas_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `ventas_id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 16, 1, 500.00),
(2, 2, 16, 2, 500.00),
(3, 3, 16, 2, 500.00),
(4, 4, 17, 1, 100000.00),
(5, 5, 16, 1, 600.00),
(6, 6, 15, 1, 750.00),
(7, 7, 15, 1, 750.00),
(8, 8, 16, 1, 600.00),
(9, 9, 17, 1, 100000.00),
(10, 10, 16, 1, 600.00),
(11, 11, 17, 1, 100000.00),
(12, 12, 16, 1, 600.00),
(13, 13, 16, 1, 600.00),
(14, 14, 16, 1, 600.00),
(15, 15, 16, 1, 600.00),
(16, 16, 16, 1, 600.00),
(17, 17, 16, 1, 600.00),
(18, 18, 16, 1, 600.00),
(19, 19, 16, 1, 600.00),
(20, 20, 16, 1, 600.00),
(21, 21, 16, 1, 600.00),
(22, 22, 16, 1, 600.00),
(23, 23, 16, 1, 600.00),
(24, 24, 20, 1, 6710.30);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `ventas_id` (`ventas_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);

--
-- Filtros para la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD CONSTRAINT `ventas_cabecera_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `ventas_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `ventas_detalle_ibfk_2` FOREIGN KEY (`ventas_id`) REFERENCES `ventas_cabecera` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
