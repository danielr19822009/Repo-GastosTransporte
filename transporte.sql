-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 09-10-2024 a las 19:41:53
-- Versión del servidor: 8.0.35
-- Versión de PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cod_cliente` int NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cod_cliente`, `nombre_cliente`, `direccion`, `telefono`, `email`) VALUES
(1, 'Carlos Rodríguez', 'Calle 123', '123456789', 'carlos@example.com'),
(2, 'Laura Martínez', 'Avenida 456', '987654321', 'laura@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_transporte`
--

CREATE TABLE `gastos_transporte` (
  `cod_transporte` int NOT NULL,
  `origen` varchar(100) NOT NULL,
  `destino` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `cod_usuario` int DEFAULT NULL,
  `cod_tipotransporte` int DEFAULT NULL,
  `cod_cliente` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `gastos_transporte`
--

INSERT INTO `gastos_transporte` (`cod_transporte`, `origen`, `destino`, `fecha`, `valor`, `descripcion`, `cod_usuario`, `cod_tipotransporte`, `cod_cliente`) VALUES
(1, 'Oficina', 'Aeropuerto', '2024-10-01', 50.00, 'Viaje al aeropuerto', 1, 1, 1),
(2, 'Casa', 'Centro Comercial', '2024-10-02', 30.00, 'Compras en el centro', 2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_transporte`
--

CREATE TABLE `tipo_transporte` (
  `cod_tipotransporte` int NOT NULL,
  `nomb_transporte` enum('taxi','moto') DEFAULT 'taxi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_transporte`
--

INSERT INTO `tipo_transporte` (`cod_tipotransporte`, `nomb_transporte`) VALUES
(1, 'taxi'),
(2, 'moto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int NOT NULL,
  `nomb_usuario` varchar(50) NOT NULL,
  `ape_usuario` varchar(50) NOT NULL,
  `doc_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `rol_usuario` enum('admin','guest') DEFAULT 'guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nomb_usuario`, `ape_usuario`, `doc_usuario`, `contrasena`, `rol_usuario`) VALUES
(1, 'daniel', 'Pérez', '7126504', '123', 'admin'),
(2, 'María', 'González', '987654321', 'password2', 'guest');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indices de la tabla `gastos_transporte`
--
ALTER TABLE `gastos_transporte`
  ADD PRIMARY KEY (`cod_transporte`),
  ADD KEY `cod_usuario` (`cod_usuario`),
  ADD KEY `cod_tipotransporte` (`cod_tipotransporte`),
  ADD KEY `cod_cliente` (`cod_cliente`);

--
-- Indices de la tabla `tipo_transporte`
--
ALTER TABLE `tipo_transporte`
  ADD PRIMARY KEY (`cod_tipotransporte`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gastos_transporte`
--
ALTER TABLE `gastos_transporte`
  MODIFY `cod_transporte` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_transporte`
--
ALTER TABLE `tipo_transporte`
  MODIFY `cod_tipotransporte` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gastos_transporte`
--
ALTER TABLE `gastos_transporte`
  ADD CONSTRAINT `gastos_transporte_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`),
  ADD CONSTRAINT `gastos_transporte_ibfk_2` FOREIGN KEY (`cod_tipotransporte`) REFERENCES `tipo_transporte` (`cod_tipotransporte`),
  ADD CONSTRAINT `gastos_transporte_ibfk_3` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
