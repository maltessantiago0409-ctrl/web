-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2026 a las 01:40:45
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
-- Base de datos: `grupo401`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `descripcion` varchar(2000) NOT NULL,
  `id` int(100) NOT NULL,
  `categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`descripcion`, `id`, `categoria`) VALUES
('- 1041 - Tubo PVC Presión Agua Almeja 1/2 RDE 21 - $16,000 | Cantidad: 3\n- 1043 - Limpiador Removedor PVC x 1/4 galón - $18,000 | Cantidad: 8\n- 1044 - Soldadura Líquida PVC Pega Max x 1/4 galón - $32,000 | Cantidad: 1\n- 1056 - Interruptor Sencillo de Pared Línea Modus - Bticino - $7,500 | Cantidad: 3\n- 1058 - Cinta Aislante Negra Temflex 1600 -3m- $4,500 | Cantidad: 4\n- 1012 - Alicate Universal de 8 pulgadas - Tramontina - $32,000 | Cantidad: 5\n- 1019 - Arco de Sierra para Metal - Tramontina - $22,000 | Cantidad: 3\n', 5, 'Plomería y Grifería, Electricidad e Iluminación, Herramientas manuales'),
('- 1043 - Limpiador Removedor PVC x 1/4 galón - $18,000 | Cantidad: 4\n- 1012 - Alicate Universal de 8 pulgadas - Tramontina - $32,000 | Cantidad: 2\n', 6, 'Plomería y Grifería, Herramientas manuales'),
('- 1041 - Tubo PVC Presión Agua Almeja 1/2 RDE 21 - $16,000 | Cantidad: 3\n- 1002 - Cemento Blanco x 40kg - Cemex - $45,000 | Cantidad: 2\n- 1012 - Alicate Universal de 8 pulgadas - Tramontina - $32,000 | Cantidad: 1\n', 7, 'Plomería y Grifería, Obra gris y cemento, Herramientas manuales');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
