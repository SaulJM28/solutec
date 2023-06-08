-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2023 a las 23:05:49
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `solutec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_are` int(4) NOT NULL,
  `nom_are` varchar(50) NOT NULL,
  `num_emp` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_are`, `nom_are`, `num_emp`) VALUES
(2, 'Contabilidad', 0),
(3, 'RH', 0),
(6, 'inventarios', 0),
(9, 'Gerencia', 0),
(11, 'TI', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_emp` int(4) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `ap1` varchar(50) NOT NULL,
  `ap2` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `id_are` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `empleados`
--
DELIMITER $$
CREATE TRIGGER `actualizar_areas_trigger` AFTER UPDATE ON `empleados` FOR EACH ROW BEGIN
    -- Verificar si el área ha sido modificada
    IF NEW.id_are <> OLD.id_are THEN
       -- Eliminar al empleado de la antigua área
          IF (SELECT num_emp FROM areas WHERE id_are = OLD.id_are) > 0 THEN
            UPDATE areas
        SET num_emp = num_emp - 1
        WHERE id_are = OLD.id_are;
        END IF;
        -- Agregar al empleado a la nueva área
        UPDATE areas
        SET num_emp = num_emp + 1
        WHERE id_are = NEW.id_are;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `aumento_empleados_trigger` AFTER INSERT ON `empleados` FOR EACH ROW BEGIN
    -- Actualizar el número de empleados en el área correspondiente
    UPDATE areas
    SET num_emp = num_emp + 1
    WHERE id_are = NEW.id_are;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `decremento_empleados_trigger` AFTER DELETE ON `empleados` FOR EACH ROW BEGIN
    DECLARE contador INT;
    SELECT COUNT(*) INTO contador FROM empleados WHERE id_are = OLD.id_are;
    
    IF contador = 0 THEN
        UPDATE areas
        SET num_emp = 0
        WHERE id_are = OLD.id_are;
    ELSE
        IF (SELECT num_emp FROM areas WHERE id_are = OLD.id_are) > 0 THEN
            UPDATE areas
            SET num_emp = num_emp - 1
            WHERE id_are = OLD.id_are;
        END IF;
    END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_are`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_emp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_are` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_emp` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
