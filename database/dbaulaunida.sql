-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-10-2024 a las 10:14:43
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbaulaunida`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrativos`
--

DROP TABLE IF EXISTS `administrativos`;
CREATE TABLE IF NOT EXISTS `administrativos` (
  `id_administrativo` int NOT NULL AUTO_INCREMENT,
  `persona_id` int NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_administrativo`),
  KEY `persona_id` (`persona_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `administrativos`
--

INSERT INTO `administrativos` (`id_administrativo`, `persona_id`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 2, '2024-09-01', '2024-09-01', '1'),
(2, 3, '2024-09-01', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

DROP TABLE IF EXISTS `asignaciones`;
CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id_asignacion` int NOT NULL AUTO_INCREMENT,
  `docente_id` int NOT NULL,
  `nivel_id` int NOT NULL,
  `grado_id` int NOT NULL,
  `materia_id` int NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_asignacion`),
  KEY `materia_id` (`materia_id`),
  KEY `docente_id` (`docente_id`),
  KEY `nivel_id` (`nivel_id`),
  KEY `grado_id` (`grado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id_asignacion`, `docente_id`, `nivel_id`, `grado_id`, `materia_id`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 1, 1, 1, 1, '2024-10-08', '2024-10-12', '1'),
(2, 1, 1, 1, 2, '2024-10-08', '2024-10-12', '1'),
(3, 5, 2, 2, 1, '2024-10-08', NULL, '1'),
(4, 5, 2, 2, 2, '2024-10-08', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
CREATE TABLE IF NOT EXISTS `calificaciones` (
  `id_calificacion` int NOT NULL AUTO_INCREMENT,
  `docente_id` int NOT NULL,
  `estudiante_id` int NOT NULL,
  `materia_id` int NOT NULL,
  `nota1` int DEFAULT NULL,
  `nota2` int DEFAULT NULL,
  `nota3` int DEFAULT NULL,
  `nota4` int DEFAULT NULL,
  `nota5` int DEFAULT NULL,
  `nota6` int DEFAULT NULL,
  `nota7` int DEFAULT NULL,
  `nota8` int DEFAULT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_calificacion`),
  KEY `docente_id` (`docente_id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `materia_id` (`materia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;



------------------------------------------------------



--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id_calificacion`, `docente_id`, `estudiante_id`, `materia_id`, `nota1`, `nota2`, `nota3`, `nota4`, `nota5`, `nota6`, `nota7`, `nota8`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 1, 2, 1, 80, 80, 0, 0, 0, 0, 0, 0, '2024-10-13', '2024-10-13', '1'),
(2, 1, 1, 1, 100, 100, 0, 0, 0, 0, 0, 0, '2024-10-13', '2024-10-13', '1'),
(3, 1, 3, 1, 60, 80, 0, 0, 0, 0, 0, 0, '2024-10-13', '2024-10-13', '1'),
(4, 5, 4, 1, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-13', NULL, '1'),
(5, 1, 1, 2, 80, 80, 0, 0, 0, 0, 0, 0, '2024-10-13', '2024-10-13', '1'),
(6, 1, 3, 2, 80, 100, 0, 0, 0, 0, 0, 0, '2024-10-13', '2024-10-13', '1'),
(7, 1, 2, 2, 100, 100, 0, 0, 0, 0, 0, 0, '2024-10-13', '2024-10-13', '1');

-- --------------------------------------------------------


CREATE TABLE informes (
  `id_informe` int (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `docente_id` int (11) NOT NULL,
  `estudiante_id` int (11) NOT NULL,
  `materia_id` int (11) NOT NULL,
  `fecha_informe` varchar (10) NOT NULL,
  `observacion` varchar (10) NOT NULL,
  `nota` text NOT NULL,

  `fyh_creacion` date NULL,
  `fyh_actualizacion` date NULL,
  `estado` varchar(11),

 FOREIGN KEY (docente_id) REFERENCES docentes (id_docente) on delete no action on update cascade,
 FOREIGN KEY (estudiante_id) REFERENCES estudiantes (id_estudiante) on delete no action on update cascade,
 FOREIGN KEY (materia_id) REFERENCES materias (id_materia) on delete no action on update cascade
) ENGINE=InnoDB;


-----------------------------------------------------------




--
-- Estructura de tabla para la tabla `configuracion_instituciones`
--

DROP TABLE IF EXISTS `configuracion_instituciones`;
CREATE TABLE IF NOT EXISTS `configuracion_instituciones` (
  `id_config_institucion` int NOT NULL AUTO_INCREMENT,
  `nombre_institucion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `celular` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_config_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion_instituciones`
--

INSERT INTO `configuracion_instituciones` (`id_config_institucion`, `nombre_institucion`, `logo`, `direccion`, `telefono`, `celular`, `correo`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 'Instituto Arturo Capdevila', '2024-06-03-20-30-17capdevila.png', 'Av. Arturo Capdevila 709', '351-355-7204', '351-355-7205', 'direccion@instituto-capdevila.com.ar', '2024-01-03', '2024-06-03', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

DROP TABLE IF EXISTS `docentes`;
CREATE TABLE IF NOT EXISTS `docentes` (
  `id_docente` int NOT NULL AUTO_INCREMENT,
  `persona_id` int NOT NULL,
  `integrador` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_cargo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_docente`),
  KEY `persona_id` (`persona_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `persona_id`, `integrador`, `tipo_cargo`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 4, 'NO', 'TITULAR', '2024-09-07', '2024-09-19', '1'),
(2, 5, 'SI', 'TITULAR', '2024-09-07', '2024-10-08', '1'),
(3, 6, 'NO', 'TITULAR', '2024-09-07', '2024-09-08', '1'),
(4, 7, 'SI', 'TITULAR', '2024-09-07', NULL, '1'),
(5, 8, 'NO', 'TITULAR', '2024-09-07', '2024-10-08', '1'),
(6, 9, 'NO', 'SUPLENTE', '2024-09-07', '2024-10-08', '1'),
(7, 10, 'SI', 'SUPLENTE', '2024-09-07', '2024-10-08', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `id_estudiante` int NOT NULL AUTO_INCREMENT,
  `persona_id` int NOT NULL,
  `nivel_id` int NOT NULL,
  `grado_id` int NOT NULL,
  `matricula` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `integracion` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `genero` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_estudiante`),
  KEY `persona_id` (`persona_id`),
  KEY `nivel_id` (`nivel_id`),
  KEY `grado_id` (`grado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_estudiante`, `persona_id`, `nivel_id`, `grado_id`, `matricula`, `integracion`, `genero`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 11, 1, 1, '476234', 'NO', 'MASCULINO', '2024-09-18', NULL, '1'),
(2, 12, 1, 1, '456090', 'SI', 'MASCULINO', '2024-09-18', NULL, '1'),
(3, 13, 1, 1, '568745', 'NO', 'PREFIERO NO DECIRLO', '2024-09-18', NULL, '1'),
(4, 14, 2, 2, '536985', 'NO', 'FEMENINO', '2024-09-18', '2024-10-12', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiones`
--

DROP TABLE IF EXISTS `gestiones`;
CREATE TABLE IF NOT EXISTS `gestiones` (
  `id_gestion` int NOT NULL AUTO_INCREMENT,
  `gestion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_gestion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `gestiones`
--

INSERT INTO `gestiones` (`id_gestion`, `gestion`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 'CICLO LECTIVO 2023', '2023-01-16', '2024-08-25', '0'),
(2, 'CICLO LECTIVO 2024', '2024-01-08', '2024-08-24', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

DROP TABLE IF EXISTS `grados`;
CREATE TABLE IF NOT EXISTS `grados` (
  `id_grado` int NOT NULL AUTO_INCREMENT,
  `nivel_id` int NOT NULL,
  `curso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `paralelo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_grado`),
  KEY `nivel_id` (`nivel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_grado`, `nivel_id`, `curso`, `paralelo`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 1, 'PRIMER GRADO', 'A', '2024-08-24', '2024-08-24', '1'),
(2, 2, 'PRIMER GRADO', 'B', '2024-08-25', '2024-08-25', '1'),
(8, 1, 'SEGUNDO GRADO', 'A', '2024-08-25', '2024-08-25', '1'),
(9, 2, 'SEGUNDO GRADO', 'B', '2024-08-25', '2024-08-25', '1'),
(10, 1, 'TERCER GRADO', 'A', '2024-08-25', NULL, '1'),
(11, 2, 'TERCER GRADO', 'B', '2024-08-25', NULL, '1'),
(12, 1, 'CUARTO GRADO', 'A', '2024-08-25', '2024-08-25', '1'),
(13, 2, 'CUARTO GRADO', 'B', '2024-08-25', NULL, '1'),
(14, 1, 'QUINTO GRADO', 'A', '2024-08-25', NULL, '1'),
(15, 2, 'QUINTO GRADO', 'B', '2024-08-25', NULL, '1'),
(16, 1, 'SEXTO GRADO', 'A', '2024-08-25', NULL, '1'),
(17, 2, 'SEXTO GRADO', 'B', '2024-08-25', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `id_materia` int NOT NULL AUTO_INCREMENT,
  `nombre_materia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `nombre_materia`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 'MATEMÁTICA', '2024-08-26', '2024-08-30', '1'),
(2, 'LENGUA Y LITERATURA', '2024-08-26', '2024-08-27', '1'),
(3, 'CIENCIAS SOCIALES', '2024-08-26', NULL, '1'),
(4, 'CIENCIAS NATURALES Y TECNOLOGÍA', '2024-08-26', '2024-08-30', '1'),
(5, 'EDUCACIÓN FÍSICA', '2024-08-26', '2024-08-30', '1'),
(6, 'EDUCACIÓN TECNOLÓGICA', '2024-08-26', '2024-08-30', '1'),
(7, 'EDUCACIÓN ARTÍSTICA', '2024-08-26', '2024-08-30', '1'),
(8, 'CIUDADANÍA Y PARTICIPACIÓN', '2024-08-26', '2024-08-30', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

DROP TABLE IF EXISTS `niveles`;
CREATE TABLE IF NOT EXISTS `niveles` (
  `id_nivel` int NOT NULL AUTO_INCREMENT,
  `gestion_id` int NOT NULL,
  `nivel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `turno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_nivel`),
  KEY `gestion_id` (`gestion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id_nivel`, `gestion_id`, `nivel`, `turno`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 2, 'PRIMARIA', 'MAÑANA', '2024-04-22', '2024-08-25', '1'),
(2, 2, 'PRIMARIA', 'TARDE', '2024-06-03', '2024-08-20', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `id_persona` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `nombres` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_nacimiento` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `profesion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `celular` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `usuario_id`, `nombres`, `apellidos`, `dni`, `fecha_nacimiento`, `profesion`, `direccion`, `celular`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 1, 'Leonardo', 'Rodriguez', '36143425', '1991-10-29', 'Analista de Sistemas', 'Ana Maria Janer 1227', '3512558885', '2024-08-30', NULL, '1'),
(2, 4, 'Pablo', 'Castillo', '36875234', '1992-08-04', 'DESARROLLADOR', 'Sucre 1826', '3513454237', '2024-09-01', '2024-09-01', '1'),
(3, 5, 'Leonardo', 'Rodriguez', '36143425', '1991-10-29', 'ANALISTA DE SISTEMAS', 'Ana Maria Janer 1227 Piso 3 Depto 10', '3512558885', '2024-09-01', NULL, '1'),
(4, 6, 'NOELIA', 'ALFONSO', '37453855', '1994-09-09', 'Profesorado en Educación Primaria', 'Miguel de Ardiles 517', '3515237651', '2024-09-07', '2024-09-19', '1'),
(5, 7, 'ROMINA MICAELA', 'PIZARRO', '34024504', '1987-11-14', 'Licenciatura en Educación', 'PADRE LUIS MONTI 1969', '3584493006', '2024-09-07', '2024-10-08', '1'),
(6, 8, 'SILVIA DAIANA', 'REINOSO', '350618543', '1990-04-02', 'Licenciada en Educación', 'BVRD DE LOS FRIULANOS 6115', '3514934669', '2024-09-07', '2024-09-08', '1'),
(7, 9, 'NAIRA', 'VITTAR', '340695548', '1989-06-08', 'Profesorado en Educación Especial', 'DR JOSE INGENIEROS 2353', '3514603267', '2024-09-07', NULL, '1'),
(8, 10, 'ESTEFANIA', 'DOTTI', '22036866', '1988-10-24', 'Profesorado en Matemática', 'OBISPO SALGUERO 774', '3514825583', '2024-09-07', '2024-10-08', '1'),
(9, 11, 'MARIA EUGENIA', 'PINTO', '34091167', '1989-02-18', 'Profesorado en Ciencias de la Educación', 'DIAGONAL ICA 450', '3513420385', '2024-09-07', '2024-10-08', '1'),
(10, 12, 'DANIELA', 'HEREDIA', '34128110', '1990-07-01', 'Profesorado en Educación Especial', 'TOLEDO PIMENTEL 680', '3541421369', '2024-09-07', '2024-10-08', '1'),
(11, 13, 'Santos', 'Diaz', '50398745', '2018-04-24', 'ESTUDIANTE', 'Juan Lucente 432', '0', '2024-09-12', NULL, '1'),
(12, 14, 'German', 'Gilla', '49547342', '2017-09-11', 'ESTUDIANTE', 'Av. Colón 1281', '0', '2024-09-13', NULL, '1'),
(13, 15, 'Adrian', 'Peralta', '45478965', '2006-08-28', 'ESTUDIANTE', 'Jose Calasanz 802', '0', '2024-09-18', NULL, '1'),
(14, 16, 'Jazmin', 'Torres', '51896635', '2006-08-28', 'ESTUDIANTE', 'Andres Maria Ampere 6050', '0', '2024-09-18', '2024-10-12', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ppffs`
--

DROP TABLE IF EXISTS `ppffs`;
CREATE TABLE IF NOT EXISTS `ppffs` (
  `id_ppff` int NOT NULL AUTO_INCREMENT,
  `estudiante_id` int NOT NULL,
  `nombres_apellidos_ppff` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni_ppff` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `celular_ppff` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ocupacion_ppff` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ref_nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ref_parentezco` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ref_celular` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_ppff`),
  KEY `estudiante_id` (`estudiante_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ppffs`
--

INSERT INTO `ppffs` (`id_ppff`, `estudiante_id`, `nombres_apellidos_ppff`, `dni_ppff`, `celular_ppff`, `ocupacion_ppff`, `ref_nombre`, `ref_parentezco`, `ref_celular`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 1, 'Mariano Diaz', '33476345', '3516987656', 'Empleado de comercio', 'Monica Juarez', 'Madre de Santos', '3513765560', '2024-09-18', NULL, '1'),
(2, 2, 'Ariel Gilla', '38987871', '3516812761', 'Encargado de Sucursal', 'Sandra Lopez', 'Tía', '3517843221', '2024-09-18', NULL, '1'),
(3, 3, 'Jose Peralta', '27458965', '3513698741', 'Empleado Municipal', 'Luciana Jimenez', 'Madre de Adrian', '3516986353', '2024-09-18', NULL, '1'),
(4, 4, 'Benjamin Torres', '36896574', '3515214789', 'Autónomo', 'Miriam Bejarano', 'Abuela de Jazmin', '3516896354', '2024-09-18', '2024-10-12', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `nombre_rol` (`nombre_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 'ADMINISTRADOR', '2024-01-03', NULL, '1'),
(2, 'DIRECTOR', '2024-01-03', NULL, '1'),
(3, 'DOCENTE', '2024-01-03', NULL, '1'),
(4, 'ESTUDIANTE', '2024-09-09', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `rol_id`, `email`, `password`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(1, 1, 'admin@admin.com', '$2y$10$0tYmdHU9uGCIxY1f90W1EuIm54NQ8axowkxL1WzLbqO2LdNa8m3l2', '2024-05-13', NULL, '1'),
(4, 1, 'pablojcastillo.94@gmail.com', '$2y$10$GquT900MudKROP8zGR4AZuyqBfGeeqN/xaUQy8Hp3LPBw65PQD/dy', '2024-09-01', '2024-09-09', '1'),
(5, 1, 'rodriguez.cl@outlook.com', '$2y$10$8cNIAmfI6OhlCKxTcuym3.obMgNhZDnaoK0WGaK2FMrvlCYf6YEvW', '2024-09-01', NULL, '1'),
(6, 3, 'noealfonso@gmail.com', '$2y$10$JU16A61jANNO8hcqxzBtG.WOLw1rC5TQJ76g0VDVhyBDrw49.HgHK', '2024-09-07', '2024-09-19', '1'),
(7, 3, 'romipizarro_15@hotmail.com', '$2y$10$3Y3xG9Q75ogwL6KTGD8bQuEWifqFec3/rjArlyJwciLhSdJsQsZ0u', '2024-09-07', '2024-10-08', '1'),
(8, 3, 'reinosodaiana61@gmail.com', '$2y$10$8Qa87CrK9tmeqbTHgyrt6eMndnEIID5/k5WsNEvreuWLx7Mzafo4.', '2024-09-07', '2024-09-08', '1'),
(9, 3, 'nairavittar@gmail.com', '$2y$10$L9S2u5..7nYZAksfMOqXXOwampDQTu2kS7YhO4VZCPjt5MIIl0Avi', '2024-09-07', NULL, '1'),
(10, 3, 'tefidotti88@gmail.com', '$2y$10$nxd183OQDHOPYyIQygyTEOmPLKALWZHF8iUG69rJjUoP/6j1JysOu', '2024-09-07', '2024-10-08', '1'),
(11, 3, 'euge_pinto89@hotmail.com', '$2y$10$7S9IGmLpJtAKJ4pbdcELoe.4I9D/nZnOJba0tHA2A5Q5LRImtivyG', '2024-09-07', '2024-10-08', '1'),
(12, 3, 'natty_9950@hotmail.com', '$2y$10$Vl0X5/J52CgCAFDve0f1b.kin25W/O6YhJVU/DZOf1xOKv5pAtnYC', '2024-09-07', '2024-10-08', '1'),
(13, 4, 'marianodiaztillard@gmail.com', '$2y$10$SvnT7ZH10o/iyIJsRDW9s.plfmb2FE2Fy3AQE1xrbn6.TzrOG.woq', '2024-09-12', NULL, '1'),
(14, 4, 'agilla@gmail.com', '$2y$10$F9HcXoe77sNJJU7DFyWf5OxNgBSr4LybOTr7OBLnWgJlWB98PTXW6', '2024-09-13', NULL, '1'),
(15, 4, 'joseperalta24@gmail.com', '$2y$10$sTzEF5MlXbitmoap1T23tOiQvO4COHgitgqthfS722K/yTF4zposS', '2024-09-18', NULL, '1'),
(16, 4, 'torresbenjamin696@gmail.com', '$2y$10$9VKK75/s.iNHe6DFeuAkS.9vPy6PPyhGTU/.mCANUl3FHQ6SXzycW', '2024-09-18', '2024-10-12', '1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrativos`
--
ALTER TABLE `administrativos`
  ADD CONSTRAINT `administrativos_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id_persona`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id_materia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id_docente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_3` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id_nivel`) ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_4` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id_grado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id_docente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id_estudiante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `calificaciones_ibfk_3` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id_materia`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id_persona`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id_persona`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiantes_ibfk_2` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id_nivel`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiantes_ibfk_3` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id_grado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `grados`
--
ALTER TABLE `grados`
  ADD CONSTRAINT `grados_ibfk_1` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id_nivel`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD CONSTRAINT `niveles_ibfk_1` FOREIGN KEY (`gestion_id`) REFERENCES `gestiones` (`id_gestion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ppffs`
--
ALTER TABLE `ppffs`
  ADD CONSTRAINT `ppffs_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id_estudiante`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
