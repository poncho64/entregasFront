-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2025 a las 18:44:52
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
-- Base de datos: `centro_medico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL,
  `usuario_admin` varchar(50) NOT NULL,
  `contrasena_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admin`, `usuario_admin`, `contrasena_admin`) VALUES
(3, 'luisfelipe', '$2y$10$kBOM967r1ldie2N8H2Eo9e3V.K9OSs2pN/zLWTYsk9OmLr0tG7W0y'),
(4, 'poncho', '$2y$10$BFBVG.ynH1AHJabt./IVMeXWZO7I2clIaoLY9Wp3SfBRUZ9Ot9y0C'),
(5, 'julian Serna', '$2y$10$NUjT.7PjtalEE8TCHpXQjOEfcN8FgdTvqdGAfJrcSd4wld2ZYCszC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `doc_paciente` varchar(15) NOT NULL,
  `nombre_paciente` varchar(150) NOT NULL,
  `apellido_paciente` varchar(150) NOT NULL,
  `celular_paciente` varchar(15) NOT NULL,
  `nombre_medico` varchar(200) NOT NULL,
  `nombre_clinica` varchar(150) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `doc_paciente`, `nombre_paciente`, `apellido_paciente`, `celular_paciente`, `nombre_medico`, `nombre_clinica`, `fecha_cita`, `hora_cita`) VALUES
(1, '9855310', 'Alfonso', 'Serna', '3205934267', 'alfonso serna', 'la hortua', '2025-03-18', '12:05:00'),
(2, '9855310', 'Alfonso', 'Serna', '3205934267', 'alfonso serna', 'la hortua', '2025-03-18', '12:05:00'),
(3, '9855310', 'Alfonso', 'Serna', '3205934267', 'alfonso serna', 'la hortua', '2025-03-18', '16:00:00'),
(4, '1100', 'Justo', 'Bueno', '1500', 'luisfelipe serna', 'Santa Fe', '2025-03-26', '14:00:00'),
(5, '1100', 'Justo', 'Bueno', '1500', 'alfonso serna', 'la hortua', '2025-03-18', '13:30:00'),
(6, '9855310', 'Alfonso', 'Serna', '3205934267', 'luisfelipe serna', 'Santa Fe', '2025-03-18', '14:30:00'),
(7, '1100', 'Justo', 'Bueno', '1500', 'alfonso serna', 'la hortua', '2025-03-18', '14:30:00'),
(8, '1100', 'Justo', 'Bueno', '1500', 'alfonso serna', 'la hortua', '2025-03-19', '15:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinicas`
--

CREATE TABLE `clinicas` (
  `id` int(11) NOT NULL,
  `nombre_clinica` varchar(100) NOT NULL,
  `direccion_clinica` varchar(100) NOT NULL,
  `celular_clinica` varchar(15) NOT NULL,
  `fijo_clinica` varchar(15) NOT NULL,
  `contacto_clinica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clinicas`
--

INSERT INTO `clinicas` (`id`, `nombre_clinica`, `direccion_clinica`, `celular_clinica`, `fijo_clinica`, `contacto_clinica`) VALUES
(1, 'la hortua', 'centro', '318', '518', 0),
(2, 'Santa Fe', 'Norte', '351', '85556231', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id_medico` int(11) NOT NULL,
  `nombre_medico` varchar(150) NOT NULL,
  `apellido_medico` varchar(150) NOT NULL,
  `celular_medico` varchar(15) NOT NULL,
  `contrasena_medico` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id_medico`, `nombre_medico`, `apellido_medico`, `celular_medico`, `contrasena_medico`) VALUES
(1, 'alfonso', 'serna', '3205934267', '$2y$10$BpwF5uGLn9T1zkjjjbOYOOLE9Ksz1KAc29CdUs9wuvy37SR46pklK'),
(2, 'luisfelipe', 'serna', '321', '$2y$10$j152BpnhMDqnFsGhJFKLkuMlS7yJnhWTrWgmQkSQbsPudxjPs//Vy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `doc_paciente` varchar(15) NOT NULL,
  `nombre_paciente` varchar(150) NOT NULL,
  `apellido_paciente` varchar(150) NOT NULL,
  `celular_paciente` varchar(15) NOT NULL,
  `correo_paciente` varchar(150) NOT NULL,
  `contrasena_paciente` varchar(255) NOT NULL,
  `foto_paciente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `doc_paciente`, `nombre_paciente`, `apellido_paciente`, `celular_paciente`, `correo_paciente`, `contrasena_paciente`, `foto_paciente`) VALUES
(3, '9855310', 'Alfonso', 'Serna', '3205934267', 'plucky64@hotmail.com', '$2y$10$evxfiLqE1Br/HIq9i/1KE.1kZKQHM9yxmdII6QQaPXXyrXYzEAtzi', '../imagenes/fotos/67d2faba03391_poncho.jpg'),
(5, '1100', 'Justo', 'Bueno', '1500', 'justo@gmail.com', '$2y$10$Z1SXfAIe4GV1COu77pPpOO4A64j8zAOQyp3uBDwwB7hJOVW3jDN0y', '../imagenes/fotos/67d853c479390_imagen banner.jpg'),
(6, '121212', 'bertulio', 'zuluaga', '123456789', 'bertulio@gmail.com', '$2y$10$5Fq5.Ob4nwbn/.U1J8vA3.wZYRGvpbOWe.P4iI95B5LjuJH/bGgJG', '../imagenes/fotos/67d970f0605bf_bertulio.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superadmin`
--

CREATE TABLE `superadmin` (
  `id_super` int(11) NOT NULL,
  `usuario_super` varchar(150) NOT NULL,
  `contrasena_super` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `superadmin`
--

INSERT INTO `superadmin` (`id_super`, `usuario_super`, `contrasena_super`) VALUES
(1, 'luisfelipe', '$2y$10$ft6N7pGRAzXLN8pPeXM7Z.YMIuDL5WltJthrvlZ2QN0Y8JLuRboGi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`);

--
-- Indices de la tabla `clinicas`
--
ALTER TABLE `clinicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id_medico`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id_super`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clinicas`
--
ALTER TABLE `clinicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id_super` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
