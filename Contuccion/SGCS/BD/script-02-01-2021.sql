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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.cronograma: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cronograma` DISABLE KEYS */;
INSERT INTO `cronograma` (`id_cronograma`, `fecha_inicio`, `fecha_termino`, `id_proyecto`) VALUES
	(19, '2020-09-07', '2021-01-08', 43),
	(20, '2020-12-07', '2020-12-11', 44),
	(21, '2021-01-04', '2021-01-27', 45);
/*!40000 ALTER TABLE `cronograma` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.cronogramafase
CREATE TABLE IF NOT EXISTS `cronogramafase` (
  `id_cronograma_fase` int(100) NOT NULL AUTO_INCREMENT,
  `coronogramaId` int(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `id_fase` int(100) DEFAULT NULL,
  `porcentaje` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_cronograma_fase`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.cronogramafase: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `cronogramafase` DISABLE KEYS */;
INSERT INTO `cronogramafase` (`id_cronograma_fase`, `coronogramaId`, `nombre`, `id_fase`, `porcentaje`) VALUES
	(111, 19, 'fase inicio', 20, 10),
	(112, 19, 'fase elaboracion', 21, 12),
	(113, 19, 'fase construccion', 22, 15),
	(114, 19, 'fase transición', 23, 13),
	(115, 20, 'fase inicio', 20, NULL),
	(116, 20, 'fase elaboracion', 21, NULL),
	(117, 20, 'fase construccion', 22, NULL),
	(118, 20, 'fase transición', 23, NULL),
	(119, 21, 'incio', 17, NULL),
	(120, 21, 'reportes', 18, NULL),
	(121, 21, 'termino', 19, NULL);
/*!40000 ALTER TABLE `cronogramafase` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.cronograma_elemento
CREATE TABLE IF NOT EXISTS `cronograma_elemento` (
  `id_cronograma_elemento` int(100) NOT NULL AUTO_INCREMENT,
  `id_elemento` varchar(100) DEFAULT NULL,
  `nombre_elemento` varchar(100) DEFAULT NULL,
  `coronogramaId` int(100) DEFAULT NULL,
  `id_cronograma_fase` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cronograma_elemento`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.cronograma_elemento: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `cronograma_elemento` DISABLE KEYS */;
INSERT INTO `cronograma_elemento` (`id_cronograma_elemento`, `id_elemento`, `nombre_elemento`, `coronogramaId`, `id_cronograma_fase`) VALUES
	(124, '16', 'Esepecificación de Requerimientos', 20, 111),
	(125, '17', 'Esepecificación de Paquetes', 20, 111),
	(126, '18', 'Especificación de Casos de usos', 20, 111),
	(127, '4', 'diagrama de clases', 21, 112),
	(128, '5', 'diagrama de secuencia', 21, 112),
	(129, '19', 'Prototipos de Pantalla', 21, 112),
	(130, '20', 'Diagrama de Componentes', 21, 112),
	(131, '6', 'diagrama de  despliegue', 21, 112),
	(132, '21', 'Sistema Web', 22, 113),
	(133, '23', 'Manual de Instalación', 23, 114),
	(134, '24', 'Manual de Tecnico', 23, 114),
	(135, '22', 'Manual de Usuario', 23, 114),
	(136, '25', 'Acta de Informe Final', 23, 114),
	(137, '16', 'Esepecificación de Requerimientos', 20, 115),
	(138, '17', 'Esepecificación de Paquetes', 20, 115),
	(139, '5', 'diagrama de secuencia', 21, 116),
	(140, '4', 'diagrama de clases', 21, 116),
	(141, '23', 'Manual de Instalación', 23, 118),
	(142, '22', 'Manual de Usuario', 23, 118);
/*!40000 ALTER TABLE `cronograma_elemento` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.elementoconfiguracion
CREATE TABLE IF NOT EXISTS `elementoconfiguracion` (
  `id_elemento` int(100) NOT NULL AUTO_INCREMENT,
  `codigo_elemento` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_elemento`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.elementoconfiguracion: ~21 rows (aproximadamente)
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
	(13, 'E-012', 'elemnto 12'),
	(14, 'E13', 'modificrere'),
	(15, 'E-014', 'elemeto 13'),
	(16, 'EE', 'Esepecificación de Requerimientos'),
	(17, 'EP', 'Esepecificación de Paquetes'),
	(18, 'ECU', 'Especificación de Casos de usos'),
	(19, 'PT', 'Prototipos de Pantalla'),
	(20, 'DC', 'Diagrama de Componentes'),
	(21, 'SW', 'Sistema Web'),
	(22, 'MU', 'Manual de Usuario'),
	(23, 'MI', 'Manual de Instalación'),
	(24, 'MT', 'Manual de Tecnico'),
	(25, 'AIF', 'Acta de Informe Final');
/*!40000 ALTER TABLE `elementoconfiguracion` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.fase
CREATE TABLE IF NOT EXISTS `fase` (
  `id_fase` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_fase` varchar(50) DEFAULT NULL,
  `metodologiaId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_fase`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.fase: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `fase` DISABLE KEYS */;
INSERT INTO `fase` (`id_fase`, `nombre_fase`, `metodologiaId`) VALUES
	(13, 'Inicio', 19),
	(14, 'Elaboracion', 19),
	(15, 'Construccion', 19),
	(16, 'Transicion', 19),
	(17, 'incio', 20),
	(18, 'reportes', 20),
	(19, 'termino', 20),
	(20, 'fase inicio', 21),
	(21, 'fase elaboracion', 21),
	(22, 'fase construccion', 21),
	(23, 'fase transición', 21);
/*!40000 ALTER TABLE `fase` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.historial_tarea_ecs
CREATE TABLE IF NOT EXISTS `historial_tarea_ecs` (
  `id_historial` int(100) NOT NULL AUTO_INCREMENT,
  `id_timeline` int(100) DEFAULT NULL,
  `miembroresponsableID` int(100) DEFAULT NULL,
  `id_tarea` int(100) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  `porcentajeavance` int(100) DEFAULT NULL,
  `urlevidencia` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_historial`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.historial_tarea_ecs: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `historial_tarea_ecs` DISABLE KEYS */;
INSERT INTO `historial_tarea_ecs` (`id_historial`, `id_timeline`, `miembroresponsableID`, `id_tarea`, `fecha`, `porcentajeavance`, `urlevidencia`, `descripcion`) VALUES
	(1, 0, 61, 13, '29/12/2020', NULL, NULL, 'avance'),
	(2, 0, 61, 13, '29/12/2020', NULL, NULL, 'avande diagram'),
	(3, 20, 61, 13, '29/12/2020', NULL, NULL, 'Avance'),
	(4, 21, 61, 13, '29/12/2020', 97, 'aqui', 'aqui'),
	(5, 22, 61, 14, '30/12/2020', 100, 'url', 'acabasod we');
/*!40000 ALTER TABLE `historial_tarea_ecs` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.informecambio
CREATE TABLE IF NOT EXISTS `informecambio` (
  `id_informe` int(100) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) DEFAULT NULL,
  `solicitudcambioId` int(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `tiempo` varchar(100) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `impactoproblema` varchar(100) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  `miembrojefeId` int(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_informe`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.informecambio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `informecambio` DISABLE KEYS */;
/*!40000 ALTER TABLE `informecambio` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.informecambiodetalle
CREATE TABLE IF NOT EXISTS `informecambiodetalle` (
  `id_detalle` int(100) NOT NULL AUTO_INCREMENT,
  `id_informecambio` int(100) DEFAULT NULL,
  `cronogramaelemetoId` int(100) DEFAULT NULL,
  `miembroresponsableId` int(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `fechainicio` varchar(100) DEFAULT NULL,
  `fechatermino` varchar(100) DEFAULT NULL,
  `porcentajeavance` int(100) DEFAULT NULL,
  `predecesota` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.informecambiodetalle: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `informecambiodetalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `informecambiodetalle` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.metodologia
CREATE TABLE IF NOT EXISTS `metodologia` (
  `id_metodologia` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_metodologia`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.metodologia: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `metodologia` DISABLE KEYS */;
INSERT INTO `metodologia` (`id_metodologia`, `nombre`) VALUES
	(19, 'scs'),
	(20, 'xp'),
	(21, 'Rup');
/*!40000 ALTER TABLE `metodologia` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.miembroproyecto
CREATE TABLE IF NOT EXISTS `miembroproyecto` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario_miembroid` int(100) DEFAULT NULL,
  `rolId` int(100) DEFAULT NULL,
  `proyectoId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.miembroproyecto: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `miembroproyecto` DISABLE KEYS */;
INSERT INTO `miembroproyecto` (`id`, `usuario_miembroid`, `rolId`, `proyectoId`) VALUES
	(58, 2, 2, 38),
	(60, 1, 1, 43),
	(61, 2, 3, 43),
	(62, 3, 5, 43),
	(63, 1, 1, 44),
	(64, 6, 5, 44),
	(65, 2, 6, 44),
	(66, 8, 1, 45);
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.plantillaelementoconfiguracion: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `plantillaelementoconfiguracion` DISABLE KEYS */;
INSERT INTO `plantillaelementoconfiguracion` (`id_plantilla`, `faseId`, `elementoId`) VALUES
	(1, 13, 2),
	(2, 13, 3),
	(3, 14, 5),
	(5, 15, 7),
	(6, 17, 11),
	(7, 18, 12),
	(8, 19, 13),
	(10, 18, 10),
	(12, 20, 16),
	(13, 20, 17),
	(14, 20, 18),
	(15, 21, 4),
	(16, 21, 5),
	(17, 21, 19),
	(18, 21, 20),
	(19, 21, 6),
	(20, 22, 21),
	(21, 23, 22),
	(22, 23, 23),
	(23, 23, 24),
	(24, 23, 25);
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
  `porcentaje` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.proyecto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` (`id_proyecto`, `codigo_proyecto`, `nombre_proyecto`, `fecha_inicio`, `fecha_termino`, `descripcion`, `estado`, `metodologiaId`, `usuariojefeId`, `porcentaje`) VALUES
	(43, '', 'Proyecto SGCS', '2020-09-07', '2021-01-08', 'Proyecto de Gestion de la Configuracion de Softwar', 'activo', 21, 1, 0),
	(44, '', 'Poyecto Sistema Web', '2020-12-07', '2020-12-11', 'sdfadfdsfsdfdsfsd', 'activo', 21, 1, 0),
	(45, '', 'proyecto de miguel', '2021-01-04', '2021-01-27', 'proyecto de miguel we', 'activo', 20, 8, NULL);
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

-- Volcando estructura para tabla sistemagc.solicitudcambio
CREATE TABLE IF NOT EXISTS `solicitudcambio` (
  `id_solicitud` int(100) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `id_proyecto` int(100) DEFAULT NULL,
  `miembrojefeId` int(100) DEFAULT NULL,
  `miembrosolicitanteId` int(100) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  `objetivo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `respuesta` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.solicitudcambio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `solicitudcambio` DISABLE KEYS */;
INSERT INTO `solicitudcambio` (`id_solicitud`, `codigo`, `id_proyecto`, `miembrojefeId`, `miembrosolicitanteId`, `fecha`, `objetivo`, `descripcion`, `respuesta`, `estado`) VALUES
	(158, 'SC-0', 43, 61, 61, '2021-01-01', 'objetivo cambiar', 'tenemos lancesidad de cambiar  a la solicitud', '', '1');
/*!40000 ALTER TABLE `solicitudcambio` ENABLE KEYS */;

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
  `estado1` varchar(100) DEFAULT NULL,
  `estado2` varchar(100) DEFAULT NULL,
  `respuesta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tarea`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.tarea_ecs: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `tarea_ecs` DISABLE KEYS */;
INSERT INTO `tarea_ecs` (`id_tarea`, `verionID`, `miembroresponsableID`, `fecha_inicio`, `fecha_termino`, `descripcion`, `porcentajeavance`, `urlevidencia`, `estado`, `estado1`, `estado2`, `respuesta`) VALUES
	(12, 8, 61, '2020-11-30', '2020-12-11', 'Diagrama de clase', 100, 'https://github.com/apexcharts/vue-apexcharts/blob/master/example/src/App.vue', 'Terminado', 'Terminado', 'Revision', NULL),
	(13, 8, 61, '2020-12-08', '2020-12-24', 'tarea diagrama', 100, 'jjjjaaaaaajj', 'Terminado', 'Terminado', 'Aprobado', NULL),
	(14, 8, 61, '2020-12-02', '2020-12-10', 'tarea resolver ', 100, 'url', 'Proceso', 'Terminado', 'Observado', 'rechazar wee'),
	(17, 9, 62, '2020-12-08', '2020-12-11', 'hacer diagram ade paquetes', 16, 'https://github.com/apexcharts/vue-apexcharts/blob/master/example/src/App.vue', 'Proceso', NULL, NULL, NULL),
	(18, 10, 64, '2020-12-23', '2020-12-11', 'tareanueva ', 0, 'nulo', 'Nuevo', NULL, NULL, NULL),
	(19, 8, 61, '2020-12-03', '2020-12-11', 'trea 5', 0, 'nulo', 'Nuevo', NULL, NULL, NULL),
	(20, 11, 62, '2020-12-09', '2020-12-16', 'trareas', 0, 'nulo', 'Nuevo', NULL, NULL, NULL),
	(21, 9, 62, '2020-12-04', '2020-12-11', 'trareas ', 0, 'nulo', 'Nuevo', NULL, NULL, NULL),
	(22, 9, 62, '2020-12-01', '2020-12-16', 'tarea nueva', 0, 'nulo', 'Nuevo', NULL, NULL, NULL),
	(23, 12, 62, '2021-01-04', '2021-01-18', 'tarea fae con', 0, 'nulo', 'Nuevo', NULL, NULL, NULL);
/*!40000 ALTER TABLE `tarea_ecs` ENABLE KEYS */;

-- Volcando estructura para tabla sistemagc.timeline
CREATE TABLE IF NOT EXISTS `timeline` (
  `id_timeline` int(100) NOT NULL AUTO_INCREMENT,
  `miembroresponsableID` int(100) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  `hora` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `id_tarea` int(100) DEFAULT NULL,
  PRIMARY KEY (`id_timeline`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.timeline: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `timeline` DISABLE KEYS */;
INSERT INTO `timeline` (`id_timeline`, `miembroresponsableID`, `fecha`, `hora`, `estado`, `id_tarea`) VALUES
	(1, 61, '24/12/2020', '00:09:09', 'Proceso', 14),
	(2, 61, '24/12/2020', '00:09:09', 'Proceso', 14),
	(3, 62, '24/12/2020', '02:21:27', 'Proceso', 17),
	(4, 61, '24/12/2020', '03:35:21', 'Terminado', 12),
	(5, 61, '28/12/2020', '23:17:53', 'Proceso', 13),
	(6, 61, '28/12/2020', '23:20:28', 'Proceso', 13),
	(7, 61, '29/12/2020', '00:35:53', 'Proceso', 13),
	(8, 61, '29/12/2020', '01:32:12', 'Proceso', 14),
	(9, 61, '29/12/2020', '01:32:12', 'Proceso', 14),
	(10, 61, '29/12/2020', '01:32:12', 'Proceso', 14),
	(11, 61, '29/12/2020', '01:32:12', 'Proceso', 14),
	(12, 61, '29/12/2020', '01:32:12', 'Proceso', 14),
	(13, 61, '29/12/2020', '01:32:12', 'Proceso', 14),
	(14, 61, '29/12/2020', '01:32:12', 'Proceso', 13),
	(15, 61, '29/12/2020', '01:32:12', 'Proceso', 13),
	(16, 61, NULL, NULL, NULL, NULL),
	(17, 61, '29/12/2020', NULL, NULL, NULL),
	(18, 61, '29/12/2020', '15:53:34', NULL, NULL),
	(19, 61, '29/12/2020', '15:53:34', 'Proceso', NULL),
	(20, 61, '29/12/2020', '15:53:34', 'Proceso', 13),
	(21, 61, '29/12/2020', '15:53:34', 'Proceso', 13),
	(22, 61, '30/12/2020', '03:02:28', 'Proceso', 14);
/*!40000 ALTER TABLE `timeline` ENABLE KEYS */;

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
	(2, 'Jefe'),
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.usuario: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `password`, `tiposusuarioId`) VALUES
	(1, 'juan carlos', 'panty', 'jcarlossenati@gmail.com', '123456', 2),
	(2, 'william', 'huilca', 'william@gmail.com', '123456', 3),
	(3, 'nilson', 'laura', 'laura@gmail.com', '123456', 3),
	(4, 'ingeniero', 'valcarcel', 'valcarcel@gmail.com', '123456', 1),
	(5, 'jose', 'jose', 'jose@gmail.com', '123456', 0),
	(6, 'pepe', 'pepe', 'pepe@gmail.com', '123456', 3),
	(7, 'pedro', 'pedro', 'pedro@gmail.com', '123456', 2),
	(8, 'miguel', 'migeul', 'miguel@gmail.com', '123456', 2);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sistemagc.version: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `version` DISABLE KEYS */;
INSERT INTO `version` (`id_version`, `elemntoconfiguracionID`, `version`, `fecha_inicio`, `fecha_termino`, `miembroresponsableID`) VALUES
	(1, 61, '1', '2020-12-15', '2020-12-19', 36),
	(2, 62, '1', '2020-12-09', '2020-12-24', 37),
	(3, 63, '1', '2020-11-30', '2020-12-10', 36),
	(4, 64, '1', '2020-12-09', '2020-12-22', 37),
	(5, 65, '1', '2020-12-01', '2020-12-07', 38),
	(6, 66, '1', '2020-12-01', '2020-12-22', 39),
	(7, 108, '1', '2020-12-03', '2020-12-12', 58),
	(8, 124, '1', '2020-08-31', '2021-01-08', 61),
	(9, 125, '1', '2020-09-02', '2021-01-07', 62),
	(10, 137, '1', '2020-12-03', '2020-12-11', 64),
	(11, 127, '1', '2020-09-07', '2021-01-08', 62),
	(12, 132, '1', '2020-09-07', '2021-01-15', 62);
/*!40000 ALTER TABLE `version` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
