-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-11-2024 a las 15:45:34
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Base de datos: `dbaulaunida`
--

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `administrativos`
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

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE IF NOT EXISTS `archivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_archivo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tipo_archivo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ruta_archivo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `categoria` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

DROP TABLE IF EXISTS `asignaciones`;
CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id_asignacion` int NOT NULL AUTO_INCREMENT,
  `docente_id` int NOT NULL,
  `nivel_id` int NOT NULL,
  `grado_id` int NOT NULL,
  `materia_id` int NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_asignacion`),
  KEY `materia_id` (`materia_id`),
  KEY `docente_id` (`docente_id`),
  KEY `nivel_id` (`nivel_id`),
  KEY `grado_id` (`grado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

DROP TABLE IF EXISTS `asistencias`;
CREATE TABLE IF NOT EXISTS `asistencias` (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `docente_id` int NOT NULL,
  `estudiante_id` int NOT NULL,
  `materia_id` int NOT NULL,
  `estado_asistencia` int DEFAULT NULL,
  `fecha_asistencia` date NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `docente_id` (`docente_id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `materia_id` (`materia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1393 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `nota9` int DEFAULT NULL,
  `nota10` int DEFAULT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_calificacion`),
  KEY `docente_id` (`docente_id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `materia_id` (`materia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=373 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

DROP TABLE IF EXISTS `gestiones`;
CREATE TABLE IF NOT EXISTS `gestiones` (
  `id_gestion` int NOT NULL AUTO_INCREMENT,
  `gestion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_gestion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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

DROP TABLE IF EXISTS `informes`;
CREATE TABLE IF NOT EXISTS `informes` (
  `id_informe` int NOT NULL AUTO_INCREMENT,
  `docente_id` int NOT NULL,
  `estudiante_id` int NOT NULL,
  `materia_id` int NOT NULL,
  `fecha_informe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `observacion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_informe`),
  KEY `docente_id` (`docente_id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `materia_id` (`materia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `id_materia` int NOT NULL AUTO_INCREMENT,
  `nombre_materia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=373 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `reset_expiration` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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