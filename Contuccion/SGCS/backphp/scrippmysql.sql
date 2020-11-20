-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.14-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sgcs
CREATE DATABASE IF NOT EXISTS `sgcs` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `sgcs`;

-- Volcando estructura para tabla sgcs.elementoconfiguracion
CREATE TABLE IF NOT EXISTS `elementoconfiguracion` (
  `id_elemento` int(100) NOT NULL AUTO_INCREMENT,
  `codigo_elemento` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_elemento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.elementoconfiguracion: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `elementoconfiguracion` DISABLE KEYS */;
INSERT INTO `elementoconfiguracion` (`id_elemento`, `codigo_elemento`, `nombre`) VALUES
	(1, 'e001', 'nuevio elemento'),
	(2, 'E002', 'elemento nuevo'),
	(3, 'E003', 'elemtno 3'),
	(4, 'E004', 'locos');
/*!40000 ALTER TABLE `elementoconfiguracion` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.fase
CREATE TABLE IF NOT EXISTS `fase` (
  `id_fase` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_fase` varchar(50) DEFAULT NULL,
  `metodologiaId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_fase`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.fase: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `fase` DISABLE KEYS */;
INSERT INTO `fase` (`id_fase`, `nombre_fase`, `metodologiaId`) VALUES
	(1, 'Inicio', 17),
	(2, 'Planificación y estimación', 17),
	(3, 'Planificacion', 18),
	(4, 'Diseño', 18),
	(5, 'Inicio', 16),
	(6, 'Elaboración', 16),
	(7, 'Implementación', 16),
	(8, 'Transición', 16),
	(10, 'Implementación', 17);
/*!40000 ALTER TABLE `fase` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.metodologia
CREATE TABLE IF NOT EXISTS `metodologia` (
  `id_metodologia` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_metodologia`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.metodologia: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `metodologia` DISABLE KEYS */;
INSERT INTO `metodologia` (`id_metodologia`, `nombre`) VALUES
	(15, 'Kanbam'),
	(16, 'RUP'),
	(17, 'Scrum'),
	(18, 'Xp');
/*!40000 ALTER TABLE `metodologia` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.miembroproyecto
CREATE TABLE IF NOT EXISTS `miembroproyecto` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario_miembroid` int(100) DEFAULT NULL,
  `rolId` int(100) DEFAULT NULL,
  `proyectoId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.miembroproyecto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `miembroproyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `miembroproyecto` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.plantillaconfiguracion
CREATE TABLE IF NOT EXISTS `plantillaconfiguracion` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `faseId` int(100) DEFAULT NULL,
  `elementoId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.plantillaconfiguracion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `plantillaconfiguracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `plantillaconfiguracion` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.plantillaelementoconfiguracion
CREATE TABLE IF NOT EXISTS `plantillaelementoconfiguracion` (
  `id_plantilla` int(100) NOT NULL AUTO_INCREMENT,
  `faseId` int(100) DEFAULT NULL,
  `elementoId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_plantilla`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.plantillaelementoconfiguracion: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `plantillaelementoconfiguracion` DISABLE KEYS */;
INSERT INTO `plantillaelementoconfiguracion` (`id_plantilla`, `faseId`, `elementoId`) VALUES
	(1, 6, 2),
	(2, 7, 3),
	(3, 7, 3);
/*!40000 ALTER TABLE `plantillaelementoconfiguracion` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.proyecto
CREATE TABLE IF NOT EXISTS `proyecto` (
  `id_proyecto` int(100) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` varchar(10) DEFAULT NULL,
  `nombre_proyecto` varchar(50) DEFAULT NULL,
  `fecha_inicio` varchar(50) DEFAULT NULL,
  `fecha_termino` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `metodologiaId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.proyecto: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` (`id_proyecto`, `codigo_proyecto`, `nombre_proyecto`, `fecha_inicio`, `fecha_termino`, `descripcion`, `estado`, `metodologiaId`) VALUES
	(1, '121', 'proyeco', '2020-10-30', '2020-10-30', 'cosas', 'activo', 16),
	(2, '1212', 'proeyctop 2', '2020-10-30', '2020-10-30', 'asdadaddddddddd', 'activo', 16);
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.rol: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
	(1, 'admin');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.tareas1
CREATE TABLE IF NOT EXISTS `tareas1` (
  `id_tarea` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_tarea` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tarea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.tareas1: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tareas1` DISABLE KEYS */;
/*!40000 ALTER TABLE `tareas1` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.tipousuario
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id_tipo` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.tipousuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` (`id_tipo`, `nombre`) VALUES
	(1, 'tipo1');
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.t_estado
CREATE TABLE IF NOT EXISTS `t_estado` (
  `est_codigo` int(100) NOT NULL,
  `est_nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`est_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.t_estado: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `t_estado` DISABLE KEYS */;
INSERT INTO `t_estado` (`est_codigo`, `est_nombre`) VALUES
	(1, 'Activo'),
	(2, 'Inactivo');
/*!40000 ALTER TABLE `t_estado` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.t_usuario
CREATE TABLE IF NOT EXISTS `t_usuario` (
  `usu_codigo` varchar(100) NOT NULL,
  `usu_nombre` varchar(100) DEFAULT NULL,
  `usu_contra` varchar(100) DEFAULT NULL,
  `usu_estado` int(100) DEFAULT NULL,
  PRIMARY KEY (`usu_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.t_usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `t_usuario` DISABLE KEYS */;
INSERT INTO `t_usuario` (`usu_codigo`, `usu_nombre`, `usu_contra`, `usu_estado`) VALUES
	('1', 'pee', '111111', 1),
	('123', 'juanchos', '123123123123', 1);
/*!40000 ALTER TABLE `t_usuario` ENABLE KEYS */;

-- Volcando estructura para tabla sgcs.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tiposusuarioId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sgcs.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `password`, `tiposusuarioId`) VALUES
	(1, 'juan arlos', 'panty', 'jcarlossenati@gmail.com', 'universidad', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
