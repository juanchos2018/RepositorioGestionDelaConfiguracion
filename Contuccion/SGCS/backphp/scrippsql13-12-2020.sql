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


-- Volcando estructura de base de datos para sistemagc
CREATE DATABASE IF NOT EXISTS `sistemagc` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `sistemagc`;

-- Volcando estructura para tabla sistemagc.cronograma
CREATE TABLE IF NOT EXISTS `cronograma` (
  `id_cronograma` int(100) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` varchar(100) DEFAULT NULL,
  `fecha_termino` varchar(100) DEFAULT NULL,
  `id_proyecto` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_cronograma`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.cronograma: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cronograma` DISABLE KEYS */;
INSERT INTO `cronograma` (`id_cronograma`, `fecha_inicio`, `fecha_termino`, `id_proyecto`) VALUES
	(16, '2020-12-15', '2020-12-19', 21),
	(17, '2020-12-01', '2020-12-12', 22);
/*!40000 ALTER TABLE `cronograma` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.cronogramafase
CREATE TABLE IF NOT EXISTS `cronogramafase` (
  `id_cronograma_fase` int(100) NOT NULL AUTO_INCREMENT,
  `coronogramaId` int(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `id_fase` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_cronograma_fase`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.cronogramafase: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `cronogramafase` DISABLE KEYS */;
INSERT INTO `cronogramafase` (`id_cronograma_fase`, `coronogramaId`, `nombre`, `id_fase`) VALUES
	(37, 16, 'Inicio', 13),
	(38, 16, 'Elaboracion', 14),
	(39, 16, 'Construccion', 15),
	(40, 16, 'Transicion', 16),
	(41, 17, 'incio', 17),
	(42, 17, 'reportes', 18),
	(43, 17, 'termino', 19);
/*!40000 ALTER TABLE `cronogramafase` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.cronograma_elemento
CREATE TABLE IF NOT EXISTS `cronograma_elemento` (
  `id_cronograma_elemento` int(100) NOT NULL AUTO_INCREMENT,
  `id_elemento` varchar(100) DEFAULT NULL,
  `nombre_elemento` varchar(100) DEFAULT NULL,
  `coronogramaId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_cronograma_elemento`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.cronograma_elemento: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `cronograma_elemento` DISABLE KEYS */;
INSERT INTO `cronograma_elemento` (`id_cronograma_elemento`, `id_elemento`, `nombre_elemento`, `coronogramaId`) VALUES
	(61, '2', 'prototipos', 13),
	(62, '3', 'Casos de uso', 13),
	(63, '5', 'diagrama de secuencia', 14),
	(64, '7', 'sat', 15),
	(65, '11', 'elemnto 10', 17),
	(66, '12', 'elemnto 11', 18),
	(67, '13', 'elemnto 12', 19);
/*!40000 ALTER TABLE `cronograma_elemento` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.elementoconfiguracion
CREATE TABLE IF NOT EXISTS `elementoconfiguracion` (
  `id_elemento` int(100) NOT NULL AUTO_INCREMENT,
  `codigo_elemento` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_elemento`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.elementoconfiguracion: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `elementoconfiguracion` DISABLE KEYS */;
INSERT INTO `elementoconfiguracion` (`id_elemento`, `codigo_elemento`, `nombre`) VALUES
	(2, 'e-001', 'prototipos'),
	(3, 'e-002', 'Casos de uso'),
	(4, 'e-003', 'diagrama de clases'),
	(5, 'e-004', 'diagrama de secuencia'),
	(6, 'e-005', 'diagrama de  despliegue'),
	(7, 'e-006', 'sat'),
	(8, 'e-007', 'especificar información sobre el inventario'),
	(9, 'e-008', 'reporte'),
	(10, 'ere', 'neuvo'),
	(11, 'E-010', 'elemnto 10'),
	(12, 'E-011', 'elemnto 11'),
	(13, 'E-012', 'elemnto 12');
/*!40000 ALTER TABLE `elementoconfiguracion` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.fase
CREATE TABLE IF NOT EXISTS `fase` (
  `id_fase` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_fase` varchar(50) DEFAULT NULL,
  `metodologiaId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_fase`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.fase: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `fase` DISABLE KEYS */;
INSERT INTO `fase` (`id_fase`, `nombre_fase`, `metodologiaId`) VALUES
	(13, 'Inicio', 19),
	(14, 'Elaboracion', 19),
	(15, 'Construccion', 19),
	(16, 'Transicion', 19),
	(17, 'incio', 20),
	(18, 'reportes', 20),
	(19, 'termino', 20);
/*!40000 ALTER TABLE `fase` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.metodologia
CREATE TABLE IF NOT EXISTS `metodologia` (
  `id_metodologia` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_metodologia`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.metodologia: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `metodologia` DISABLE KEYS */;
INSERT INTO `metodologia` (`id_metodologia`, `nombre`) VALUES
	(19, 'Scrum'),
	(20, 'xp');
/*!40000 ALTER TABLE `metodologia` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.miembroproyecto
CREATE TABLE IF NOT EXISTS `miembroproyecto` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario_miembroid` int(100) DEFAULT NULL,
  `rolId` int(100) DEFAULT NULL,
  `proyectoId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.miembroproyecto: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `miembroproyecto` DISABLE KEYS */;
INSERT INTO `miembroproyecto` (`id`, `usuario_miembroid`, `rolId`, `proyectoId`) VALUES
	(19, 1, 1, 6),
	(20, 1, 1, 7),
	(21, 1, 1, 8),
	(22, 1, 1, 9),
	(23, 1, 1, 10),
	(24, 1, 1, 11),
	(25, 1, 1, 12),
	(26, 1, 1, 13),
	(27, 1, 1, 14),
	(28, 1, 1, 15),
	(29, 1, 1, 16),
	(30, 1, 1, 17),
	(31, 1, 1, 18),
	(32, 1, 1, 19),
	(33, 1, 1, 20),
	(34, 1, 1, 21),
	(35, 1, 1, 22),
	(36, 2, 4, 21),
	(37, 3, 6, 21),
	(38, 2, 6, 22),
	(39, 3, 5, 22);
/*!40000 ALTER TABLE `miembroproyecto` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.plantillaconfiguracion
CREATE TABLE IF NOT EXISTS `plantillaconfiguracion` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `faseId` int(100) DEFAULT NULL,
  `elementoId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.plantillaconfiguracion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `plantillaconfiguracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `plantillaconfiguracion` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.plantillaelementoconfiguracion
CREATE TABLE IF NOT EXISTS `plantillaelementoconfiguracion` (
  `id_plantilla` int(100) NOT NULL AUTO_INCREMENT,
  `faseId` int(100) DEFAULT NULL,
  `elementoId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_plantilla`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.plantillaelementoconfiguracion: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `plantillaelementoconfiguracion` DISABLE KEYS */;
INSERT INTO `plantillaelementoconfiguracion` (`id_plantilla`, `faseId`, `elementoId`) VALUES
	(1, 13, 2),
	(2, 13, 3),
	(3, 14, 5),
	(4, 14, 6),
	(5, 15, 7),
	(6, 17, 11),
	(7, 18, 12),
	(8, 19, 13),
	(9, 17, 7),
	(10, 18, 10);
/*!40000 ALTER TABLE `plantillaelementoconfiguracion` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.proyecto
CREATE TABLE IF NOT EXISTS `proyecto` (
  `id_proyecto` int(100) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` varchar(10) DEFAULT NULL,
  `nombre_proyecto` varchar(50) DEFAULT NULL,
  `fecha_inicio` varchar(50) DEFAULT NULL,
  `fecha_termino` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `metodologiaId` int(100) DEFAULT NULL,
  `usuariojefeId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.proyecto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` (`id_proyecto`, `codigo_proyecto`, `nombre_proyecto`, `fecha_inicio`, `fecha_termino`, `descripcion`, `estado`, `metodologiaId`, `usuariojefeId`) VALUES
	(21, '', 'proyedto 7', '2020-12-15', '2020-12-19', 'dsfsfdsfdsfdsfdsf', 'activo', 19, 1),
	(22, '', 'Proyecto Nuevo', '2020-12-01', '2020-12-12', 'proyecto nuevo apra hcer bien ', 'activo', 20, 1);
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.proyectoelementos
CREATE TABLE IF NOT EXISTS `proyectoelementos` (
  `idprolemento` int(100) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(100) DEFAULT NULL,
  `id_metodologia` int(100) DEFAULT NULL,
  `id_fase` int(100) DEFAULT NULL,
  `id_elemeto` int(100) DEFAULT NULL,
  PRIMARY KEY (`idprolemento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.proyectoelementos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectoelementos` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyectoelementos` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.prueba
CREATE TABLE IF NOT EXISTS `prueba` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nombreproyecto` varchar(100) DEFAULT NULL,
  `tarea1` int(100) DEFAULT NULL,
  `tarea2` int(100) DEFAULT NULL,
  `tarea3` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.prueba: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `prueba` DISABLE KEYS */;
/*!40000 ALTER TABLE `prueba` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.rol: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
	(1, 'Jefe de Proyecto'),
	(2, 'Analista de Sistemas'),
	(3, 'Desarollador'),
	(4, 'Diseñador'),
	(5, 'Arquitecto de Software'),
	(6, 'Auditor');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.tareas2
CREATE TABLE IF NOT EXISTS `tareas2` (
  `id_tarea` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_tarea` varchar(100) DEFAULT NULL,
  `estado_tarea` varchar(100) DEFAULT NULL,
  `fecha_tarea` varchar(100) DEFAULT NULL,
  `id_proyecto` int(100) DEFAULT NULL,
  `id_fase` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_tarea`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.tareas2: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `tareas2` DISABLE KEYS */;
INSERT INTO `tareas2` (`id_tarea`, `nombre_tarea`, `estado_tarea`, `fecha_tarea`, `id_proyecto`, `id_fase`) VALUES
	(1, 'tarea 1', 'nueva', '10/12/2020', 21, 1),
	(2, 'tarea 2', 'nueva', '10/12/2020', 21, 1),
	(3, 'tarea 3', 'nueva', '10/12/2020', 21, 1),
	(4, 'tarea 4', 'proceso', '10/12/2020', 21, 1),
	(5, 'tarea 5', 'nueva', '10/12/2020', 21, 1),
	(6, 'tarea 6', 'proceso', '10/12/2020', 21, 1),
	(7, 'tarea 7', 'proceso', '10/12/2020', 21, 1),
	(8, 'tarea 8', 'proceso', '10/12/2020', 21, 1),
	(9, 'tarea 9', 'nueva', '10/12/2020', 21, 1),
	(10, 'tarea 10', 'terminado', '10/12/2020', 21, 1),
	(11, 'tarea 11', 'terminado', '10/12/2020', 21, 1),
	(12, 'tarea 12', 'proceso', '10/12/2020', 22, 1),
	(13, 'tarea 13', 'nueva', '10/12/2020', 22, 2),
	(14, 'tarea 14', 'nueva', '10/12/2020', 22, 2),
	(15, 'tarea 15', 'nueva', '10/12/2020', 22, 2),
	(16, 'tarea 16', 'nueva', '10/12/2020', 22, 2),
	(17, 'tarea 17', 'nueva', '10/12/2020', 22, 2),
	(18, 'tarea 18', 'proceso', '10/12/2020', 22, 2),
	(19, 'tarea 19', 'proceso', '10/12/2020', 22, 2),
	(20, 'tarea 20', 'proceso', '10/12/2020', 22, 2),
	(21, 'tarea 23', 'nueva', '10/12/2020', 22, 3),
	(22, 'tarea 24', 'nueva', '10/12/2020', 22, 3),
	(23, 'tarea 25', 'nueva', '10/12/2020', 22, 3),
	(24, 'tarea 26', 'nueva', '10/12/2020', 22, 3),
	(25, 'tarea 27', 'nueva', '10/12/2020', 22, 3),
	(26, 'tarea 28', 'terminado', '10/12/2020', 22, 3),
	(27, 'tarea 29', 'terminado', '10/12/2020', 22, 3),
	(28, 'tarea 30', 'terminado', '10/12/2020', 22, 3);
/*!40000 ALTER TABLE `tareas2` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.tarea_ecs
CREATE TABLE IF NOT EXISTS `tarea_ecs` (
  `id_tarea` int(100) NOT NULL AUTO_INCREMENT,
  `verionID` int(100) DEFAULT NULL,
  `miembroresponsableID` int(100) DEFAULT NULL,
  `fecha_inicio` varchar(100) DEFAULT NULL,
  `fecha_termino` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `porcentajeavance` int(100) DEFAULT NULL,
  `urlevidencia` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tarea`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.tarea_ecs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tarea_ecs` DISABLE KEYS */;
INSERT INTO `tarea_ecs` (`id_tarea`, `verionID`, `miembroresponsableID`, `fecha_inicio`, `fecha_termino`, `descripcion`, `porcentajeavance`, `urlevidencia`, `estado`) VALUES
	(1, 1, 36, '2020-12-01', '2020-12-07', 'Tarea neuva ', 0, 'nulo', 'Nuevo'),
	(2, 2, 37, '2020-12-02', '2020-12-24', 'tarea hacer', 0, 'nulo', 'Nuevo'),
	(3, 1, 36, '2020-12-14', '2020-12-15', 'tarea 3', 0, 'nulo', 'Proceso'),
	(4, 3, 36, '2020-12-07', '2020-12-30', 'tarea 4', 0, 'nulo', 'Proceso'),
	(5, 4, 37, '2020-12-23', '2020-12-25', 'tarea 6', 0, 'nulo', 'Nuevo'),
	(6, 4, 37, '2020-12-15', '2020-12-18', 'tarea 7', 0, 'nulo', 'Terminado'),
	(7, 5, 38, '2020-12-02', '2020-12-22', 'tarea proyecto 2', 0, 'nulo', 'Nuevo'),
	(8, 5, 38, '2020-12-02', '2020-12-22', 'tarea proyecto 2  2', 0, 'nulo', 'Proceso'),
	(9, 6, 39, '2020-12-08', '2020-12-15', 'tarea proyecto 2', 0, 'nulo', 'Nuevo');
/*!40000 ALTER TABLE `tarea_ecs` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.tipousuario
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id_tipo` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.tipousuario: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` (`id_tipo`, `nombre`) VALUES
	(1, 'Administrador'),
	(2, 'Jefe de Proyecto'),
	(3, 'Miembro'),
	(4, 'Cliente');
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tiposusuarioId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.usuario: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `password`, `tiposusuarioId`) VALUES
	(1, 'juan carlos', 'panty', 'jcarlossenati@gmail.com', '123456', 1),
	(2, 'william', 'huilca', 'william@gmail.com', '123456', 3),
	(3, 'nilson', 'laura', 'laura@gmail.com', '123456', 3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.version
CREATE TABLE IF NOT EXISTS `version` (
  `id_version` int(100) NOT NULL AUTO_INCREMENT,
  `elemntoconfiguracionID` int(100) DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `fecha_inicio` varchar(100) DEFAULT NULL,
  `fecha_termino` varchar(100) DEFAULT NULL,
  `miembroresponsableID` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_version`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.version: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `version` DISABLE KEYS */;
INSERT INTO `version` (`id_version`, `elemntoconfiguracionID`, `version`, `fecha_inicio`, `fecha_termino`, `miembroresponsableID`) VALUES
	(1, 61, '1', '2020-12-15', '2020-12-19', 36),
	(2, 62, '1', '2020-12-09', '2020-12-24', 37),
	(3, 63, '1', '2020-11-30', '2020-12-10', 36),
	(4, 64, '1', '2020-12-09', '2020-12-22', 37),
	(5, 65, '1', '2020-12-01', '2020-12-07', 38),
	(6, 66, '1', '2020-12-01', '2020-12-22', 39);
/*!40000 ALTER TABLE `version` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
