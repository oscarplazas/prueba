-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2022 a las 02:22:47
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_ingreso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cl_identificacion` int(11) NOT NULL,
  `cl_nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `cl_estado` int(11) NOT NULL,
  `tp_codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cl_identificacion`, `cl_nombre`, `cl_estado`, `tp_codigo`) VALUES
(123, 'Oscar', 1, 1),
(789, 'Plazas', 1, 3),
(36156364, 'Douglas', 1, 2),
(1075256993, 'Douglas Plazas', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `pa_codigo` int(11) NOT NULL,
  `pa_num_plan` int(11) NOT NULL,
  `pa_valor` float NOT NULL,
  `pa_vencimiento` date NOT NULL,
  `pa_vigencia` int(11) NOT NULL,
  `cl_identificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`pa_codigo`, `pa_num_plan`, `pa_valor`, `pa_vencimiento`, `pa_vigencia`, `cl_identificacion`) VALUES
(1, 12345678, 520000, '2021-03-17', 1, 1075256993),
(2, 95126348, 850000, '2021-03-11', 0, 1075256993),
(3, 74589632, 860000, '2021-03-03', 1, 1075256993),
(4, 14785236, 70000, '2021-03-26', 0, 1075256993),
(5, 74384632, 1260000, '2021-04-03', 1, 1075256993),
(6, 74389822, 1870000, '2021-04-07', 0, 1075256993),
(7, 77969822, 1000, '2021-05-07', 1, 1075256993),
(8, 12969822, 1234000, '2021-05-12', 1, 1075256993),
(9, 43969832, 194000, '2021-05-13', 1, 1075256993),
(10, 12969822, 1234000, '2021-05-12', 1, 1075256993);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `tp_codigo` int(11) NOT NULL,
  `tp_nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `tp_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`tp_codigo`, `tp_nombre`, `tp_estado`) VALUES
(1, 'Cedula de ciudadania', 1),
(2, 'Cedula de extranjeria', 1),
(3, 'NIT', 1),
(4, 'Pasaporte', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cl_identificacion`),
  ADD KEY `fk_tp_codigo` (`tp_codigo`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`pa_codigo`),
  ADD KEY `fk_cl_identificacion` (`cl_identificacion`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`tp_codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `pa_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `tp_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_tp_codigo` FOREIGN KEY (`tp_codigo`) REFERENCES `tipo_documento` (`tp_codigo`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_cl_identificacion` FOREIGN KEY (`cl_identificacion`) REFERENCES `cliente` (`cl_identificacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
