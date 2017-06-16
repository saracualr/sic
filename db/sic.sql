-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-06-2017 a las 01:26:58
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE IF NOT EXISTS `cargos` (
  `id_cargo` int(10) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estatus` int(2) NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios`
--

CREATE TABLE IF NOT EXISTS `colegios` (
  `id_colegio` int(10) NOT NULL AUTO_INCREMENT,
  `colegio` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `representante` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `seguro` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codSeguro` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `imgCarnet` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estatus` int(1) NOT NULL,
  PRIMARY KEY (`id_colegio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='informacion referente a los colegios' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int(10) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedula` int(15) NOT NULL,
  `telefono` int(15) NOT NULL,
  `id_cargo` int(10) NOT NULL,
  `foto` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `periodo` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descargado` int(1) NOT NULL,
  `estatus` int(2) NOT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Información referente a empleados' AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadoscolegios`
--

CREATE TABLE IF NOT EXISTS `empleadoscolegios` (
  `id_empleado` int(10) NOT NULL AUTO_INCREMENT,
  `id_colegio` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedula` int(15) NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_cargo` int(10) NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `periodo` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descargado` int(1) NOT NULL,
  `estatus` int(2) NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='InformaciÃƒÂ³n referente a empleados' AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` int(10) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `representante` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` int(10) NOT NULL,
  `seguro` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codSeguro` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estatus` int(1) NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Información de las empresa' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE IF NOT EXISTS `estudiantes` (
  `id_estudiante` int(10) NOT NULL AUTO_INCREMENT,
  `id_colegio` int(10) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedula` int(15) NOT NULL,
  `grado` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `seccion` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `representante` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidoRepresentante` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedulaRepresentante` int(15) NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `periodo` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estatus` int(1) NOT NULL,
  `descargado` int(1) NOT NULL,
  PRIMARY KEY (`id_estudiante`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=452 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuarios`
--

CREATE TABLE IF NOT EXISTS `rol_usuarios` (
  `id_rol_usuario` int(2) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_rol_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(10) NOT NULL AUTO_INCREMENT,
  `autor` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `id_rol_usuario` int(2) NOT NULL,
  `estatus` int(2) NOT NULL,
  `id_colegio` int(2) NOT NULL,
  `fecha_creacion` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
