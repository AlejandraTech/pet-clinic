SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `mascotasclinic`
--

CREATE DATABASE IF NOT EXISTS mascotasclinic;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_de_historial`
--

CREATE TABLE `lineas_de_historial` (
  `id` int(11) NOT NULL,
  `idmascota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `motivo_visita` varchar(300) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineas_de_historial`
--

INSERT INTO `lineas_de_historial` (`id`, `idmascota`, `fecha`, `motivo_visita`, `descripcion`) VALUES
(1, 2, '2021-01-28', 'motivo1', 'descripción 1'),
(2, 1, '2021-01-01', 'motivo2', 'descripción 3'),
(3, 1, '2021-01-01', 'motivo3', 'descripción 4'),
(4, 2, '2021-01-01', 'motivo4', 'descripción 5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id` int(11) NOT NULL,
  `nifpropietario` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id`, `nifpropietario`, `nom`) VALUES
(1, '02258461E', 'Doggyy'),
(2, '01685047K', 'Catty');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `nif` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `movil` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`nif`, `nom`, `email`, `movil`) VALUES
('01685047K', 'Maria', 'maria1@mail.com', '222222222'),
('02258461E', 'Mario', 'mario1@mail.com', '111111112');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lineas_de_historial`
--
ALTER TABLE `lineas_de_historial`
  ADD PRIMARY KEY (`id`,`idmascota`),
  ADD KEY `idmascota` (`idmascota`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id`,`nifpropietario`),
  ADD KEY `nifpropietario` (`nifpropietario`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`nif`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lineas_de_historial`
--
ALTER TABLE `lineas_de_historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_de_historial`
--
ALTER TABLE `lineas_de_historial`
  ADD CONSTRAINT `lineas_de_historial_ibfk_1` FOREIGN KEY (`idmascota`) REFERENCES `mascotas` (`id`);

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`nifpropietario`) REFERENCES `propietarios` (`nif`);
COMMIT;
