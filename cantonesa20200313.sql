-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cantonesa
-- ------------------------------------------------------
-- Server version	5.5.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(65) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1',
  `id_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_actividad`),
  KEY `actividad_producto_idx` (`id_producto`),
  CONSTRAINT `actividad_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES (1,'Embalando','0',NULL),(2,'Forrando cajas','1',NULL),(3,'Colocando pasta','1',NULL),(4,NULL,'1',NULL),(5,'Actividad_bc','0',NULL),(6,'Empacando cajas','0',NULL),(7,'Embalando','1',NULL),(8,'Operando maquina','1',NULL);
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actividades_colaboradores`
--

DROP TABLE IF EXISTS `actividades_colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades_colaboradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_colaborador` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `id_control` int(11) DEFAULT NULL,
  `fecha_hora_asociacion` datetime DEFAULT NULL,
  `fecha_asistencia` datetime DEFAULT NULL,
  `asistio` char(1) DEFAULT '0',
  `no_orden_produccion` varchar(45) DEFAULT NULL,
  `fecha_hora_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades_colaboradores`
--

LOCK TABLES `actividades_colaboradores` WRITE;
/*!40000 ALTER TABLE `actividades_colaboradores` DISABLE KEYS */;
INSERT INTO `actividades_colaboradores` VALUES (127,913,7,63,'2020-02-26 10:07:42',NULL,'0',NULL,'2020-03-03 18:57:38'),(128,911,2,64,'2020-02-27 08:29:23',NULL,'0',NULL,'2020-02-27 10:28:24'),(129,998,7,63,'2020-03-03 18:57:41',NULL,'0',NULL,NULL),(130,939,7,64,'2020-03-09 14:19:47',NULL,'0',NULL,'2020-03-09 14:57:17');
/*!40000 ALTER TABLE `actividades_colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6328 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (6271,'default','updated',1,'App\\User',1,'App\\User','{\"attributes\":[],\"old\":[]}','2020-02-26 14:49:16','2020-02-26 14:49:16'),(6272,'default','created',15,'App\\Recepcion',1,'App\\User','{\"attributes\":{\"orden_compra\":\"Doc123\",\"id_proveedor\":165,\"fecha_ingreso\":\"2020-02-26 08:56:19\",\"id_producto\":null,\"usuario_recepcion\":1,\"estado\":\"T\"}}','2020-02-26 14:56:19','2020-02-26 14:56:19'),(6273,'default','created',15,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"id\":15,\"no_requision\":\"R2602\",\"no_orden_produccion\":null,\"fecha_ingreso\":\"2020-02-26 09:41:54\",\"id_usuario_ingreso\":1,\"id_usuario_aprobo\":null,\"estado\":\"P\",\"fecha_actualizacion\":null}}','2020-02-26 15:41:54','2020-02-26 15:41:54'),(6274,'default','updated',15,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"no_orden_produccion\":\"PROD-20200227\"},\"old\":{\"no_orden_produccion\":null}}','2020-02-26 15:41:56','2020-02-26 15:41:56'),(6275,'default','created',29,'App\\RequisicionDetalle',1,'App\\User','{\"attributes\":{\"id\":29,\"id_requisicion_encabezado\":15,\"orden_requisicion\":\"R2602\",\"orden_produccion\":\"PROD-20200227\",\"id_producto\":1555,\"cantidad\":\"55.00\",\"estado\":\"P\"}}','2020-02-26 15:42:09','2020-02-26 15:42:09'),(6276,'default','created',30,'App\\RequisicionDetalle',1,'App\\User','{\"attributes\":{\"id\":30,\"id_requisicion_encabezado\":15,\"orden_requisicion\":\"R2602\",\"orden_produccion\":\"PROD-20200227\",\"id_producto\":1546,\"cantidad\":\"1501.00\",\"estado\":\"P\"}}','2020-02-26 15:43:25','2020-02-26 15:43:25'),(6277,'default','updated',15,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"estado\":\"R\",\"fecha_actualizacion\":\"2020-02-26 09:43:58\"},\"old\":{\"estado\":\"P\",\"fecha_actualizacion\":null}}','2020-02-26 15:43:58','2020-02-26 15:43:58'),(6278,'default','created',16,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"id\":16,\"no_requision\":\"R2602-01\",\"no_orden_produccion\":null,\"fecha_ingreso\":\"2020-02-26 09:45:26\",\"id_usuario_ingreso\":1,\"id_usuario_aprobo\":null,\"estado\":\"P\",\"fecha_actualizacion\":null}}','2020-02-26 15:45:26','2020-02-26 15:45:26'),(6279,'default','updated',16,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"no_orden_produccion\":\"PROD-20200227-1\"},\"old\":{\"no_orden_produccion\":null}}','2020-02-26 15:45:29','2020-02-26 15:45:29'),(6280,'default','created',31,'App\\RequisicionDetalle',1,'App\\User','{\"attributes\":{\"id\":31,\"id_requisicion_encabezado\":16,\"orden_requisicion\":\"R2602-01\",\"orden_produccion\":\"PROD-20200227-1\",\"id_producto\":1546,\"cantidad\":\"150.00\",\"estado\":\"P\"}}','2020-02-26 15:46:17','2020-02-26 15:46:17'),(6281,'default','created',32,'App\\RequisicionDetalle',1,'App\\User','{\"attributes\":{\"id\":32,\"id_requisicion_encabezado\":16,\"orden_requisicion\":\"R2602-01\",\"orden_produccion\":\"PROD-20200227-1\",\"id_producto\":1555,\"cantidad\":\"55.00\",\"estado\":\"P\"}}','2020-02-26 15:46:27','2020-02-26 15:46:27'),(6282,'default','created',33,'App\\RequisicionDetalle',1,'App\\User','{\"attributes\":{\"id\":33,\"id_requisicion_encabezado\":16,\"orden_requisicion\":\"R2602-01\",\"orden_produccion\":\"PROD-20200227-1\",\"id_producto\":1578,\"cantidad\":\"40.00\",\"estado\":\"P\"}}','2020-02-26 15:46:42','2020-02-26 15:46:42'),(6283,'default','created',34,'App\\RequisicionDetalle',1,'App\\User','{\"attributes\":{\"id\":34,\"id_requisicion_encabezado\":16,\"orden_requisicion\":\"R2602-01\",\"orden_produccion\":\"PROD-20200227-1\",\"id_producto\":1547,\"cantidad\":\"85.00\",\"estado\":\"P\"}}','2020-02-26 15:46:54','2020-02-26 15:46:54'),(6284,'default','updated',16,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"estado\":\"R\",\"fecha_actualizacion\":\"2020-02-26 09:47:00\"},\"old\":{\"estado\":\"P\",\"fecha_actualizacion\":null}}','2020-02-26 15:47:00','2020-02-26 15:47:00'),(6285,'default','updated',15,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"estado\":\"D\"},\"old\":{\"estado\":\"R\"}}','2020-02-26 15:50:31','2020-02-26 15:50:31'),(6286,'default','updated',16,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"estado\":\"D\"},\"old\":{\"estado\":\"R\"}}','2020-02-26 15:53:40','2020-02-26 15:53:40'),(6287,'default','updated',1795,'App\\Producto',1,'App\\User','{\"attributes\":{\"descripcion\":\"PASTA CHAO MEIN CANTONES 180 GRAMOS\"},\"old\":{\"descripcion\":\"PASTA CHAO MEIN CANTONES 180 GRAMOS \"}}','2020-02-26 16:10:32','2020-02-26 16:10:32'),(6288,'default','created',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"id_chaomin\":23,\"id_control\":63,\"id_producto\":1795,\"no_orden_produccion\":null,\"id_presentacion\":\"62\",\"id_turno\":\"1\",\"cant_solucion_carga\":null,\"cantidad_solucion_observacion\":null,\"ph_solucion_inicial\":null,\"ph_solucion_observacion\":null,\"mezcla_seca_inicial\":null,\"mezcla_seca_observacion\":null,\"mezcla_alta_inicial\":null,\"mezcla_alta_observacion\":null,\"mezcla_baja_inicial\":null,\"mezcla_baja_observacion\":null,\"temperatura_reposo_inicial\":null,\"temperatura_reposo_observacion\":null,\"ancho_cartucho_inicial\":null,\"ancho_cartucho_observacion\":null,\"temperatura_precocedora_1_inicial\":null,\"temperatura_precocedora_1_observacion\":null,\"tiempo_precocedora_1_inicial\":null,\"tiempo_precocedora_1_observacion\":null,\"temperatura_precocedora_2_inicial\":null,\"temperatura_precocedora_2_observacion\":null,\"tiempo_precocedora_2_inicial\":null,\"tiempo_precocedora_2_observacion\":null,\"temperatura_central_inicial\":null,\"temperatura_central_observaciones\":null,\"velocidad_pass200_inicial\":null,\"velocidad_pass200_observaciones\":null,\"velocidad_pasc180_inicial\":null,\"velocidad_pasc180_observaciones\":null,\"velocidad_pask180_inicial\":null,\"velocidad_pask180_observaciones\":null,\"velocidad_pasi180_inicial\":null,\"velocidad_pasi180_observaciones\":null,\"velocidad_pasm160_inicial\":null,\"velocidad_pasm160_observaciones\":null,\"extractor_activo_inicial\":null,\"extractor_activo_observaciones\":null,\"ventilacion_inicial\":null,\"verificacion_codificacion_lote\":null,\"verificacion_codificacion_vence\":null,\"verificacion_codificacion_obs\":null,\"ventilacion_observacion\":null,\"fecha\":\"2020-02-26 10:10:56\",\"responsable\":\"1\",\"maquina_inicial_1\":null,\"sellos_observaciones\":null,\"maquina_inicial_2\":null,\"sellos_observaciones_2\":null,\"estado\":\"0\",\"observaciones_acciones\":null}}','2020-02-26 16:10:56','2020-02-26 16:10:56'),(6289,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"mezcla_alta_observacion\":\"600\"},\"old\":{\"mezcla_alta_observacion\":null}}','2020-02-26 16:44:55','2020-02-26 16:44:55'),(6290,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"mezcla_baja_observacion\":\"este es unico\"},\"old\":{\"mezcla_baja_observacion\":null}}','2020-02-26 16:45:05','2020-02-26 16:45:05'),(6291,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"temperatura_reposo_observacion\":\"este es lo unic q\"},\"old\":{\"temperatura_reposo_observacion\":null}}','2020-02-26 16:45:24','2020-02-26 16:45:24'),(6292,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"temperatura_reposo_observacion\":\"sss\"},\"old\":{\"temperatura_reposo_observacion\":\"este es lo unic q\"}}','2020-02-26 16:46:44','2020-02-26 16:46:44'),(6293,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"temperatura_reposo_observacion\":\"ssssss\"},\"old\":{\"temperatura_reposo_observacion\":\"sss\"}}','2020-02-26 16:46:45','2020-02-26 16:46:45'),(6294,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"tiempo_precocedora_1_inicial\":\"10\"},\"old\":{\"tiempo_precocedora_1_inicial\":null}}','2020-02-26 16:50:17','2020-02-26 16:50:17'),(6295,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"temperatura_precocedora_2_inicial\":\"100\"},\"old\":{\"temperatura_precocedora_2_inicial\":null}}','2020-02-26 16:50:37','2020-02-26 16:50:37'),(6296,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"tiempo_precocedora_2_inicial\":\"30\"},\"old\":{\"tiempo_precocedora_2_inicial\":null}}','2020-02-26 16:50:47','2020-02-26 16:50:47'),(6297,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"temperatura_central_inicial\":\"72\"},\"old\":{\"temperatura_central_inicial\":null}}','2020-02-26 16:50:57','2020-02-26 16:50:57'),(6298,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"velocidad_pass200_inicial\":\"53\"},\"old\":{\"velocidad_pass200_inicial\":null}}','2020-02-26 16:51:07','2020-02-26 16:51:07'),(6299,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"velocidad_pasc180_inicial\":\"58\"},\"old\":{\"velocidad_pasc180_inicial\":null}}','2020-02-26 16:51:17','2020-02-26 16:51:17'),(6300,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"velocidad_pasm160_inicial\":\"160\"},\"old\":{\"velocidad_pasm160_inicial\":null}}','2020-02-26 16:51:27','2020-02-26 16:51:27'),(6301,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"extractor_activo_inicial\":\"1\"},\"old\":{\"extractor_activo_inicial\":\"0\"}}','2020-02-26 16:51:37','2020-02-26 16:51:37'),(6302,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"extractor_activo_observaciones\":\"Ninguna\"},\"old\":{\"extractor_activo_observaciones\":null}}','2020-02-26 16:51:47','2020-02-26 16:51:47'),(6303,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"ventilacion_inicial\":\"1\"},\"old\":{\"ventilacion_inicial\":\"0\"}}','2020-02-26 16:51:57','2020-02-26 16:51:57'),(6304,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"estado\":\"1\",\"observaciones_acciones\":\"Observsciones\"},\"old\":{\"estado\":\"0\",\"observaciones_acciones\":null}}','2020-02-26 16:51:58','2020-02-26 16:51:58'),(6305,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"verificacion_codificacion_lote\":\"lote\"},\"old\":{\"verificacion_codificacion_lote\":null}}','2020-02-27 14:27:24','2020-02-27 14:27:24'),(6306,'default','updated',1758,'App\\Producto',1,'App\\User','{\"attributes\":[],\"old\":[]}','2020-02-27 14:30:09','2020-02-27 14:30:09'),(6307,'default','created',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"id_sopa\":2,\"id_producto\":1758,\"id_presentacion\":64,\"id_control\":64,\"identificacion_cartucho\":null,\"identificacion_cartucho_observaciones\":null,\"presion_vapor\":null,\"presion_vapor_observaciones\":null,\"temperatura_del_aceite_set\":null,\"temperatura_del_aceite_set_observaciones\":null,\"ph_solucion\":null,\"ph_solucion_observaciones\":null,\"compuestos_polares_libres_frio\":null,\"compuestos_polares_libres_antes\":null,\"compuestos_polares_libres_durante\":null,\"compuestos_polares_libres_despues\":null,\"compuestos_polares_libres_observaciones\":null,\"indice_acidez_frio\":null,\"indice_acidez_antes\":null,\"indice_acidez_durante\":null,\"indice_acidez_despues\":null,\"indice_acidez_observaciones\":null,\"temperatura_aceite_frio\":null,\"temperatura_aceite_antes\":null,\"temperatura_aceite_durante\":null,\"temperatura_aceite_despues\":null,\"temperatura_aceite_obsevaciones\":null,\"porcentaje_solucion\":null,\"porcentaje_solucion_observaciones\":null,\"verificacion_codificado_lote\":null,\"verificacion_codificado_vence\":null,\"medidas_molde_superior\":null,\"medidas_molde_inferior\":null,\"medidas_molde_altura\":null,\"medidas_nido_superior\":null,\"medidas_nido_inferior\":null,\"medidas_nido_altura\":null,\"tiempos_mezcla_seco\":null,\"tiempos_mezcla_alta\":null,\"tiempos_mezcla_baja\":null,\"verificacion_material\":null,\"verificacion_material_observaciones\":null,\"id_usuario\":1,\"id_turno\":\"1\",\"fecha_hora\":\"2020-02-27 08:34:47\",\"observaciones\":null,\"estado\":\"0\",\"lote\":null}}','2020-02-27 14:34:47','2020-02-27 14:34:47'),(6308,'default','updated',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"identificacion_cartucho\":\"8\"},\"old\":{\"identificacion_cartucho\":null}}','2020-02-27 14:35:19','2020-02-27 14:35:19'),(6309,'default','updated',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"identificacion_cartucho_observaciones\":\"OBSERVACIONES\"},\"old\":{\"identificacion_cartucho_observaciones\":null}}','2020-02-27 14:35:50','2020-02-27 14:35:50'),(6310,'default','updated',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"presion_vapor\":\"0.2\"},\"old\":{\"presion_vapor\":null}}','2020-02-27 14:35:53','2020-02-27 14:35:53'),(6311,'default','updated',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"presion_vapor_observaciones\":\"OBSERVACIONES\"},\"old\":{\"presion_vapor_observaciones\":null}}','2020-02-27 14:35:56','2020-02-27 14:35:56'),(6312,'default','updated',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"compuestos_polares_libres_frio\":\"25\"},\"old\":{\"compuestos_polares_libres_frio\":null}}','2020-02-27 15:09:14','2020-02-27 15:09:14'),(6313,'default','updated',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"indice_acidez_frio\":\"2\"},\"old\":{\"indice_acidez_frio\":null}}','2020-02-27 15:09:21','2020-02-27 15:09:21'),(6314,'default','updated',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"temperatura_aceite_frio\":\"3\"},\"old\":{\"temperatura_aceite_frio\":null}}','2020-02-27 15:09:30','2020-02-27 15:09:30'),(6315,'default','updated',2,'App\\LineaSopa',1,'App\\User','{\"attributes\":{\"estado\":\"1\"},\"old\":{\"estado\":\"0\"}}','2020-02-27 15:10:59','2020-02-27 15:10:59'),(6316,'default','updated',1,'App\\User',1,'App\\User','{\"attributes\":[],\"old\":[]}','2020-02-27 15:26:52','2020-02-27 15:26:52'),(6317,'default','updated',1,'App\\User',1,'App\\User','{\"attributes\":[],\"old\":[]}','2020-02-27 20:31:42','2020-02-27 20:31:42'),(6318,'default','updated',1,'App\\User',1,'App\\User','{\"attributes\":[],\"old\":[]}','2020-03-02 17:08:55','2020-03-02 17:08:55'),(6319,'default','updated',1,'App\\User',1,'App\\User','{\"attributes\":[],\"old\":[]}','2020-03-02 18:47:23','2020-03-02 18:47:23'),(6320,'default','created',17,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"id\":17,\"no_requision\":\"R101202\",\"no_orden_produccion\":null,\"fecha_ingreso\":\"2020-03-09 12:42:45\",\"id_usuario_ingreso\":1,\"id_usuario_aprobo\":null,\"estado\":\"P\",\"fecha_actualizacion\":null}}','2020-03-09 18:42:45','2020-03-09 18:42:45'),(6321,'default','updated',17,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"no_orden_produccion\":\"PROD-20200310\"},\"old\":{\"no_orden_produccion\":null}}','2020-03-09 18:42:48','2020-03-09 18:42:48'),(6322,'default','created',35,'App\\RequisicionDetalle',1,'App\\User','{\"attributes\":{\"id\":35,\"id_requisicion_encabezado\":17,\"orden_requisicion\":\"R101202\",\"orden_produccion\":\"PROD-20200310\",\"id_producto\":1555,\"cantidad\":\"45.00\",\"estado\":\"P\"}}','2020-03-09 18:42:57','2020-03-09 18:42:57'),(6323,'default','updated',17,'App\\Requisicion',1,'App\\User','{\"attributes\":{\"estado\":\"R\",\"fecha_actualizacion\":\"2020-03-09 12:43:33\"},\"old\":{\"estado\":\"P\",\"fecha_actualizacion\":null}}','2020-03-09 18:43:33','2020-03-09 18:43:33'),(6324,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"verificacion_codificacion_vence\":\"01\\/04\\/2020\"},\"old\":{\"verificacion_codificacion_vence\":null}}','2020-03-09 21:10:38','2020-03-09 21:10:38'),(6325,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"verificacion_codificacion_obs\":\"1\"},\"old\":{\"verificacion_codificacion_obs\":null}}','2020-03-09 21:11:14','2020-03-09 21:11:14'),(6326,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"sellos_observaciones\":\"2\"},\"old\":{\"sellos_observaciones\":null}}','2020-03-09 21:11:30','2020-03-09 21:11:30'),(6327,'default','updated',23,'App\\LineaChaomin',1,'App\\User','{\"attributes\":{\"maquina_inicial_1\":\"1\"},\"old\":{\"maquina_inicial_1\":\"0\"}}','2020-03-09 21:11:40','2020-03-09 21:11:40');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bines`
--

DROP TABLE IF EXISTS `bines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bines` (
  `id_bin` int(11) NOT NULL AUTO_INCREMENT,
  `id_posicion` int(11) DEFAULT NULL,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `codigo_interno` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_bin`),
  KEY `bine_posicion_idx` (`id_posicion`),
  CONSTRAINT `bine_posicion` FOREIGN KEY (`id_posicion`) REFERENCES `posiciones` (`id_posicion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bines`
--

LOCK TABLES `bines` WRITE;
/*!40000 ALTER TABLE `bines` DISABLE KEYS */;
INSERT INTO `bines` VALUES (1,1,'BIN1','BIN 1','1',1),(2,1,'BIN22','BIN22','0',2),(3,3,'BIN000002','BIN    2','1',1),(4,1,'932169371931','bin932169371931BIn','1',3),(5,4,'9163917309','9163917309','1',1);
/*!40000 ALTER TABLE `bines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bodegas`
--

DROP TABLE IF EXISTS `bodegas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bodegas` (
  `id_bodega` int(11) NOT NULL AUTO_INCREMENT,
  `id_localidad` int(11) DEFAULT NULL,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `id_encargado` int(11) DEFAULT NULL,
  `largo` decimal(18,2) DEFAULT NULL,
  `ancho` decimal(18,2) DEFAULT NULL,
  `alto` decimal(18,2) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `codigo_interno` tinyint(4) DEFAULT NULL,
  `sistema` char(1) DEFAULT '0',
  PRIMARY KEY (`id_bodega`),
  KEY `bodega_localidad_idx` (`id_localidad`),
  CONSTRAINT `bodega_localidad` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_localidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bodegas`
--

LOCK TABLES `bodegas` WRITE;
/*!40000 ALTER TABLE `bodegas` DISABLE KEYS */;
INSERT INTO `bodegas` VALUES (1,1,'4140754842000017','MATERIA PRIMA',1,301.00,300.00,3.00,'12121212','1',1,'0'),(2,1,'4140754842000031','BODEGA MATERIAL DE EMPAQUE',1,350.00,380.00,4.00,'22005060','1',2,'0'),(3,1,'4140754842000017','ÁREA DE RAMPA DESCARGAS',1,21.00,12.00,21.00,'45454545','1',3,'0'),(4,1,'4140754842000048','OFICINAS ADMINISTRATIVAS',1,NULL,NULL,NULL,NULL,'1',4,'0'),(5,1,'4140754842000055','LABORATORIO DE CALIDAD',1,NULL,NULL,NULL,NULL,'1',5,'0'),(6,1,'4140754842000062','BODEGA DE PRODUCTO TERMINADO',1,NULL,NULL,NULL,NULL,'1',6,'0'),(7,1,'4140754842000079','ÁREA DE RAMPA DE CARGA',1,NULL,NULL,NULL,NULL,'1',7,'0'),(8,1,'4140754842000086','ÁREA DE CONDIMENTOS',1,NULL,NULL,NULL,NULL,'1',8,'0'),(9,1,'4140754842000093','ENFERMERÍA',1,NULL,NULL,NULL,NULL,'0',9,'0'),(10,1,'4140754842000109','Área de Empaque de Sopas',1,NULL,NULL,NULL,NULL,'1',10,'0'),(11,1,'4140754842000116','Área de Empaque de Condimentos',1,NULL,NULL,NULL,NULL,'1',11,'0'),(12,1,'4140754842000123','Área de Almacenamiento de Químicos',1,NULL,NULL,NULL,NULL,'1',12,'0'),(13,1,'4140754842000130','Área de Elaboración de Sopas',1,NULL,NULL,NULL,NULL,'1',13,'0'),(14,1,'4140754842000147','Lavandería',1,NULL,NULL,NULL,NULL,'0',14,'0'),(15,1,'4140754842000154','Área de Empaque de Sopas',1,NULL,NULL,NULL,NULL,'1',15,'0'),(16,1,'4140754842000161','Área de Elaboración de Chao Mein',1,NULL,NULL,NULL,NULL,'1',16,'0'),(17,1,'4140754842000178','Área de Empaque de Chao Mein',1,NULL,NULL,NULL,NULL,'1',17,'0'),(18,1,'4140754842000184','Área de Mantenimiento',1,NULL,NULL,NULL,NULL,'1',18,'0'),(19,1,'4140754842000185','Área de Calderas',1,NULL,NULL,NULL,NULL,'1',19,'0'),(20,2,'B00000000001','BODEGA',1,21.00,21.00,21.00,'45122356','0',1,'0'),(21,1,'1','AREA DE BODEGAS',1,100.00,100.00,100.00,'22061499','1',20,'0'),(22,1,'2','AREA DE PRODUCCION',1,100.00,100.00,100.00,'22061499','1',21,'0'),(23,1,'0000000000000001','AREA CUARENTENA',1,0.00,0.00,0.00,'22000000','1',NULL,'1');
/*!40000 ALTER TABLE `bodegas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_clientes`
--

DROP TABLE IF EXISTS `categoria_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_clientes` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `tipo_documento` varchar(25) DEFAULT NULL,
  `impresion_recibo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_clientes`
--

LOCK TABLES `categoria_clientes` WRITE;
/*!40000 ALTER TABLE `categoria_clientes` DISABLE KEYS */;
INSERT INTO `categoria_clientes` VALUES (1,'GENERALES','1','FACC','1'),(2,'Generales 2','1','FAC','1'),(3,'categoria','0','FACC','0');
/*!40000 ALTER TABLE `categoria_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chaomin`
--

DROP TABLE IF EXISTS `chaomin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chaomin` (
  `id_chaomin` int(11) NOT NULL AUTO_INCREMENT,
  `id_control` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `no_orden_produccion` varchar(45) DEFAULT NULL,
  `id_presentacion` varchar(45) DEFAULT NULL,
  `id_turno` varchar(45) DEFAULT NULL,
  `cant_solucion_carga` varchar(45) DEFAULT NULL,
  `cantidad_solucion_observacion` varchar(45) DEFAULT NULL,
  `ph_solucion_inicial` varchar(45) DEFAULT NULL,
  `ph_solucion_observacion` varchar(45) DEFAULT NULL,
  `mezcla_seca_inicial` varchar(45) DEFAULT NULL,
  `mezcla_seca_observacion` varchar(45) DEFAULT NULL,
  `mezcla_alta_inicial` varchar(45) DEFAULT NULL,
  `mezcla_alta_observacion` varchar(45) DEFAULT NULL,
  `mezcla_baja_inicial` varchar(45) DEFAULT NULL,
  `mezcla_baja_observacion` varchar(45) DEFAULT NULL,
  `temperatura_reposo_inicial` varchar(45) DEFAULT NULL,
  `temperatura_reposo_observacion` varchar(45) DEFAULT NULL,
  `ancho_cartucho_inicial` varchar(45) DEFAULT NULL,
  `ancho_cartucho_observacion` varchar(45) DEFAULT NULL,
  `temperatura_precocedora_1_inicial` varchar(45) DEFAULT NULL,
  `temperatura_precocedora_1_observacion` varchar(45) DEFAULT NULL,
  `tiempo_precocedora_1_inicial` varchar(45) DEFAULT NULL,
  `tiempo_precocedora_1_observacion` varchar(45) DEFAULT NULL,
  `temperatura_precocedora_2_inicial` varchar(45) DEFAULT NULL,
  `temperatura_precocedora_2_observacion` varchar(45) DEFAULT NULL,
  `tiempo_precocedora_2_inicial` varchar(45) DEFAULT NULL,
  `tiempo_precocedora_2_observacion` varchar(45) DEFAULT NULL,
  `temperatura_central_inicial` varchar(45) DEFAULT NULL,
  `temperatura_central_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pass200_inicial` varchar(45) DEFAULT NULL,
  `velocidad_pass200_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pasc180_inicial` varchar(45) DEFAULT NULL,
  `velocidad_pasc180_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pask180_inicial` varchar(45) DEFAULT NULL,
  `velocidad_pask180_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pasi180_inicial` varchar(45) DEFAULT NULL,
  `velocidad_pasi180_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pasm160_inicial` varchar(45) DEFAULT NULL,
  `velocidad_pasm160_observaciones` varchar(45) DEFAULT NULL,
  `extractor_activo_inicial` varchar(45) DEFAULT NULL,
  `extractor_activo_observaciones` varchar(45) DEFAULT NULL,
  `ventilacion_inicial` varchar(45) DEFAULT NULL,
  `verificacion_codificacion_lote` varchar(45) DEFAULT NULL,
  `verificacion_codificacion_vence` varchar(45) DEFAULT NULL,
  `verificacion_codificacion_obs` varchar(45) DEFAULT NULL,
  `ventilacion_observacion` varchar(45) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `responsable` varchar(45) DEFAULT 'PRUEBA',
  `maquina_inicial_1` varchar(45) DEFAULT NULL,
  `sellos_observaciones` varchar(45) DEFAULT NULL,
  `maquina_inicial_2` varchar(45) DEFAULT NULL,
  `sellos_observaciones_2` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT '0',
  `observaciones_acciones` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_chaomin`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chaomin`
--

LOCK TABLES `chaomin` WRITE;
/*!40000 ALTER TABLE `chaomin` DISABLE KEYS */;
INSERT INTO `chaomin` VALUES (23,63,1795,NULL,'62','1','158.4','prueba','11','prueba','60','prueba','300','600','600','este es unico','37','ssssss','1',NULL,'98',NULL,'10',NULL,'100',NULL,'30',NULL,'72',NULL,'53',NULL,'58',NULL,NULL,NULL,NULL,NULL,'160',NULL,'1','Ninguna','1','lote','01/04/2020','1',NULL,'2020-02-26 16:10:56','1','1','2','0',NULL,'1','Observsciones');
/*!40000 ALTER TABLE `chaomin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(45) NOT NULL,
  `razon_social` varchar(90) DEFAULT NULL,
  `nit` varchar(15) NOT NULL DEFAULT 'C/F',
  `direccion` text,
  `telefono` varchar(20) DEFAULT NULL,
  `ruta` int(11) DEFAULT NULL,
  `lunes` varchar(1) DEFAULT NULL,
  `martes` varchar(1) DEFAULT NULL,
  `miercoles` varchar(1) DEFAULT NULL,
  `jueves` varchar(1) DEFAULT NULL,
  `viernes` varchar(1) DEFAULT NULL,
  `sabado` varchar(1) DEFAULT NULL,
  `domingo` varchar(45) DEFAULT NULL,
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `razon_social_idx` (`razon_social`),
  KEY `nit_idx` (`nit`),
  KEY `cliente_categoria_idx` (`id_categoria`),
  CONSTRAINT `cliente_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_clientes` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=78893 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (77618,'ABEL','ABEL MORALES RUIZ','CF','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77619,'AF','AF DISTRIBUCIONES, S.A.','3101292457','DE LA IGLESIA DE ZAPOTE 100M. SUR Y 450M. OESTE SAN JOSE, COSTA RICA.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77620,'ALICORP','ALICORP S. A. A.','20100055237','Av.Argentina N°4793 Zona Industrial (Entre Av.Argentina y Av. Elmer Faucett) Prov.Const.Del Callao-Ca',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77621,'ALLFOODS','ALLFOODS INC.','CF','519 Commack Road Deer Park 11729 New York, U.S.A.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77622,'ANGELES','SOCIEDAD DE PADRES FRANCISCANOS DE LA INMACULADA CONCEPCION','180822-2','55 CALLE 26-35 ZONA 24 EL PULTE, GUATEMALA','5053-3636',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77623,'ANT001','SURTIDORA DE MERCADOS, S.A.','7114615-6','ANTIGUA GUATEMALA','7832-2149 /   7832-2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77624,'AP001','ASINPRO','5583460-4','8 Av. 7-89, Zona 2 San Jose Villa Nueva',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77625,'AP002','SANDRA RODAS MARTINEZ','486142-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77626,'AP003','ASOCIACION SOLIDARISTA EMPLEADOS DE POPS','1954741-2','Avenida Las Americas 6-00 Zona 13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77627,'AP004','TIENDA DEBORAH','382320-2','Calzada Atanasio Tzul 22-00 Zona 12 Centro Empresarial Cortijo II',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77628,'AP005','VICTOR MEJIA','CF','4 AV. A 12-45 ZONA 9 GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77629,'AP006','OLGA DE RIVERA','9703596-3','31 Calle 25-45 Zona 12 Edificio Intercargo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77630,'ARIUM','DISTRIBUIDORA ME LLEGA, SOCIEDAD ANONIMA','9095885-3','18 AVE. \"A\" 1 - 41 ZONA 15 VISTA HERMOSA II, GUATEMALA','2367-2805',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'trizzo@sancris.com'),(77631,'ARRIOLA','UNISUPER, S.A.','2653247-6','8a. AVE. 5-37 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77632,'BEAVARI','BEATRIZ ADRIANA VASQUEZ','CF','CIUDAD, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77633,'CALLEJA','CALLEJA, S.A. DE C.V.','0614-110169-001','y calle El Progreso, Comalapa, El Salvador.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77634,'CAOP','DISTRIBUIDORA CAOP','535974-0','19 Ave. B, 10-77 zona 17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77635,'CAROLINA','PROVEEDORA MEDICA, S. A.','726945-5','KM. 11.5 Carretera Amatitlán, Villa Nueva','24772222, 23286200 e',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'compras7@carolinayh.com  (ext. 1-218 René-Cés'),(77636,'CB20CA','ADQUISICIONES Y REPRESENTACIONES, S.A.','2669584-7','AVE. BOLIVAR 20 CALLE ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77637,'CBCAMINERO','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','1ra.Ave o Blvd. El Caminero 11-46 Z.6 Col. San Francisco II, Mixco',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77638,'CBESCU','GRUPO SIMPLY, S.A.','9132496-3','4a AV. ¨A¨ 10-90 ZONA 1 ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77639,'CBGUAJ','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','BOULEVARD J.R. BARRIOS 6-39 Z. 21 GUATEMALA, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77640,'CBGUAR','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','AVE. BOLIVAR 39-58 ZONA 3 GUATEMALA, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77641,'CBJOCO','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','15 AV. LOTE 3 SAN JULIAN CHINAUTLA, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77642,'CBMAZA','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','KM163 Carr CA-2 local Ancla 2 CC Paseo Carnaval Mazatenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77643,'CBMIXC','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','6a. AVE. 7-39 ZONA 1 MIXCO, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77644,'CBMOLI','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','CALZADA ROOSEVELT 5a. AVE. Z.2 C.C. EL MOLINO MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77645,'CBREU','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','Salida a Champerico 2-69 local *B* zona 5 Retalhuleu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77646,'CBSNJOSE','GRUPO SIMPLY, S.A.','9132496-3','3a.CALLE 9-40 ZONA 2 VILLA NUEVA, C.C. EL PILAR LOCAL 17, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77647,'CBVINU','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','1a Calle 3-30 Z. 4 Villa Nueva, Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77648,'CBZO18','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','12 CALLE 23-58 ZONA 18 GUATEMALA, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77649,'CD','OPERADORA DE TIENDAS, S.A.','737810-6','CENTRO DE TRANSITO GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77650,'CD002','NEGOCIOS Y EXPORTACIONES CHANIN, S.A.','8132785-4','14 Av. 17-31 Z.4 Mixco Complejo Distribodegas 1, Bodega C-3.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77651,'CD003','MULTINEGOCIOS EL MAYOREO, S.A.','7271003-9','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77652,'CD004','GRUPO CORPORATIVO GADSS, S.A.','7878258-9','5 Calle 4-68 Zona 2 San Raymundo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77653,'CD005','ABASTECIMIENTO DE TIENDAS,S.A.','7408389-9','2 CALLE 34-43 ZONA 7 CALZ MATEO FLORES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77654,'CD006','DEL BARRIO TIENDAS, S.A.','7500087-3','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77655,'CD007','ESPECIES FLOR DE OCCIDENTE','CF','MERCADO LA PRESIDENTA ZONA1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77656,'CD008','COMANDO NAVAL DEL CARIBE','666240-4','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77657,'CD009','FREDI AUGUSTO LEMUS FARFAN','261001-9','12  Av. \"B\" 1-48 Col. Monte Real II, Z.4 Mixco, Guatemala','3029-2677',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77658,'CD010','TEKASA, S.A.','7703781-2','45 CALLE 16-42 ZONA 12, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77659,'CD011','INDUSTRIA PROCESADORA DE SALSAS, S.A.','2671425-6','7a. AVE. 1-53 ZONA 2 DE MIXCO COLONIA EL TESORO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77660,'CD013','FERNANDO RAMON MACARIO','1081780-8','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77661,'CD014','3 AKA 3, S.A.','10195760-2','33 Calle 22-31 Zona 12 Colonia Santa Elisa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77662,'CD015','NESTOR MARIANO DE LEON','2954616-8','6 CALLE 11-07 ZONA 19 LA FLORIDA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77663,'CD016','VEROPLAST','751630-4','1 CALLE 3-21 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77664,'CD017','LESBIA PADILLA','341043-9','RUTA 4 1-66 ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77665,'CD018','ESTADO MAYOR DEL MDN','337818-7','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77666,'CD019','GRUPO DE TIENDAS ASOCIADAS, S.A.','103319700','Km. 20 Carretera al Pacifico Bodega Alfa E-5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77667,'CD020','DEPOSITO LA CASA DEL AHORRO','133900489-6','7 CALLE 4-99 ZONA 1 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77668,'CD021','DISTRIBUIDORA HERVAL, S.A.','6702745-8','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77669,'CD022','DEPOSITO SAN NICOLAS','243663-9','AV BOLIVAR 32-33 ZONA 8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77670,'CD023','ANA DE GARCIA','2768284-6','GALPON 2 LOCAL 18 CENMA ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77671,'CD028','ESCUELA EXPERIMENTAL VILLA DE LOS NIÑOS','842904-9','16 AV. FINAL 22-99 PROYECTO 4-4 ZONA 6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77672,'CD031','ZONIA RUTH PAZ','CD031','5A. AV. 6-28, ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77673,'CD033','BRIGADA DE ARTILLERIA DE CAMPAÑA','337818-7','SALAMA BAJA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77674,'CD034','BRIGADA ESPECIAL DE OPERACIONES','337818-7','LA LIBERTAD PETEN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77675,'CD035','ESPECIES ARCORIS','2489156-6','GALPON 7, LOCAL 752 CENMA ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77676,'CD036','COMANDO NAVAL DEL PACIFICO','667168-3','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77677,'CD037','MIGUEL ALTUZAR','1445920-8','2A.AV.FINAL.LOT.CANDELARIAS K.56 R.AL SALVADOR BARBERENA,SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77678,'CD038','ESCUELA POLITECNICA','337818-7','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77679,'CD039','ESTABLECIMIENTOS DE OCCIDENTE, S.A.','7408413-5','1CALLE 6-128 ZONA 1 CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77680,'CD042','DELFINO VELASQUEZ','C/F','SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77681,'CD044','FIDEL ANTONIO LEMUS FARFAN','135855-3','2a. Av. 4-98 Panorama S.Cristobal Z.8 Mixco, Guatemala.','5128-6239 y 4627-007',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77682,'CD048','DISTRIBUIDORA Y DEPOSITO LA QUEZALTECA','3062888-1','1A CALLE B 20-00 ZONA 6, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77683,'CD24','PORFIRIO MENDOZA','5135587-1','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77684,'CDCB','ADQUISICIONES Y REPRESENTACIONES, S.A.','2669584-7','50 CALLE 23-70 ZONA 12 SECCION ´´A´´',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77685,'CENABA','CENTRAL ABARROTERA, S.A.','1689626-2','12 CALLE 5-57 ZONA 9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77686,'CF','.','CF','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77687,'CLUBCO','OPERADORA DE TIENDA, S.A.','737810-6','27 AVENIDA 6-50 ZONA 11','473 8060',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77688,'CLUBCON','OPERADORA DE TIENDAS, S.A.','737810-6','KM. 5 CARR. ATLAN.  Z. 17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77689,'COA001','DISTRIBUIDORA FALEM','1397555-2','7 AV. 0-190 Z.1 BARRIO LA ESPERANZA, COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77690,'COA002','HUMBERTO SALGUERO','C/F','COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77691,'COA003','ANA ALICIA REVOLORIO','C-F','MERCADO LOCAL 6, COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77692,'COA004','SUPER TIENDA QUICHE','COA004','Interior Modulo central Metamercado, Coatepeque.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77693,'COA005','MILDRED ESCOBAR','508332-K','INTERIOR MODULO CENTRAL METAMERCADO COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77694,'COA006','JUAN CHIROY','C/F','Modulo central metamercado Coatepeque.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77695,'COA007','DIEGO CHIROY','C/F','Modulo central local 27 metamercado, Coatepeque.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77696,'COA008','NOE CAPILLA','90836-3','3a.Av.entre 7a y 8a. Call Z.1,Barrio la Independencia, Coatepeque.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77697,'COA009','IRLANDA ANTONIA ARREAGA GARCIA DE SAMAYOA','241530-5','1a. Av. 06-01 Zona 1 Barrio Independencia, Coatepeque',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77698,'COA010','IRMA SACOJ','C/F','Modulo central Local 25 Metamercado, Coatepeque.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77699,'COA011','GUILLERMO JO CHANG','401848-6','6a. CALLE 3-06 ZONA 1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77700,'COA012','DORA MARIA PALAJ','C/F','Interior modulo central Metamercado, Coatepeque.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77701,'COA013','MINI MERCADO BRASILIA','308492-2','COATEPEQUE 0 AV. 6-37 ZONA 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77702,'COA014','COMERCIAL LOS HERMANOS, S.A.','3375934-0','2-1001, Zona 3, Coatepeque Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77703,'COA015','SISTEMAS ESPECIALIZADOS DE DISTRIBUCION HORIZONTAL, S.A.','8147221-8','7a. Av. \"A\" BARRIO LA ESPERANZA 1-24 B ZONA 1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77704,'COA016','JORGE LEON','CF','COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77705,'COA017','HILDA ELIZABETH LOPEZ BARRIOS DE LEMUS','701502-K','Coatepeque Piso Plaza Sol 8155-190 Zona 2 Metaterminal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77706,'COA018','MARIA DE LOS ANGELES LEMUS LOPEZ /TIENDA LOS TRES','4735184-5','7 CALLE LOCAL No3 3-011 Z 1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77707,'COA019','DISTRIBUIDORA COMERCIAL LUPITA, S.A.','5131688-9','7 CALLE 3-65 Z.1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77708,'COA020','ROSA ANGELICA ALVARADO','745557-7','7 CALLE ZONA 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77709,'COA021','TIENDA EL PERU / WALESKA IZAR','CF','7 CALLE ZONA 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77710,'COA022','ELIZABETH  TZUNUX FUENTES','CF','8 CALLE ZONA 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77711,'COA023','ROSARIO LOPEZ','CF','8 CALLE Z. 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77712,'COA024','JUANA GONZALES','CF','8 CALLE Z 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77713,'COA025','CELIA VASQUEZ','CF','8 CALLE Z.2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77714,'COA026','GLORIA OCHOA','CF','8 CALLE ZONA 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77715,'COA027','SOFIA CABRERA','CF','AV. DEL CEMENTERIO COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77716,'COA028','LETICIA CHAVEZ','CF','AV EL CEMENTERIO COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77717,'COA029','DISTRIBUIDORA CAPRICORNIO','3016437-0','COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77718,'COA030','TIENDA SAN MIGUELITO / JUAN MUZ','C/F','7A. CALLE ZONA 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77719,'COA031','GENOVEVA CARDONA','C/F','7A CALLE ZONA 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77720,'COA032','TIENDA GLADIS / GLADIS LOPES','C/F','7A. CALLE ZONA 2, COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77721,'COA033','TIENDA EL PROVEEDOR / VERONICA PAXTOR','C/F','1A CALLE 7-19 ZONA 4, COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77722,'COA034','TIENDA EL BUEN PRECIO / GEOVANNI LOPEZ','C/F','1A. AV 7-35, ZONA 1, COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77723,'COA035','ROSA ROSALES','C/F','CALLE EL CMENTERIO ZONA 1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77724,'COA036','TIENDA ZOILA / ZOILA GONZALEZ','C/F','8A. CALLE ZONA 2 COATEPEQUE (FRENTE AL HOTEL PILICÓ)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77725,'COA037','ISABEL PEREZ','C/F','CALLE DEL CEMENTERIO ZONA 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77726,'COA039','JUAN PÚ','C/F','FRENTE A MINIBODEGA BRASILIA COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77727,'COA040','HUGO RAMIREZ / TIENDA HUGO','C/F','6A. CALLE Y 0 AV. ZONA 2 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77728,'COA041','VENTAS VIVIAN / IRMA SACOR','C/F','EXT.MCDO. MCPAL, # 1, COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77729,'COA042','GLADIS LOPEZ','CF','7a CALLE Z 1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77730,'COA043','EL CAMPESINO / AMPARO RODAS','C/F','6A. CALLE 0-47 Z.1 COATEPQUE.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77731,'COA044','TIENDA SAN ANTONIO','614847-6','1 AV. 6-47 Z.1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77732,'COA045','MINIBODEGA EL MESIAS','2806204-3','1RA. AV. 9-20 ZONA 1, COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77733,'COA047','ABARROTERIA LUCY','2313201-9','6A. CALLE 0-67 Z.1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77734,'COA048','MULTIBEBIDAS JYM / MARIA DE LOS A.FUENTES','2211351-7','MULTIBEBIDAS J Y M, COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77735,'COB001','SURTIDORA COBAN','628147-8','EXTERIOR MERCADO MUNICIPAL COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77736,'COB002','JUAN JOSE MO AC','308810-3','TERMINAL DE BUSES ZONA 4 COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77737,'COB003','DEPOSITO MAGALY','C/F','COBAN ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77738,'COB004','TIENDA GONZALEZ','CF','COBAN ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77739,'COB005','GRUPO COMERCIAL MI CASITA, S.A.','9608729-3','Km. 186.7 Aldea Tampo Tac Tic, Alta Verapaz','5000-4932',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77740,'COB007','TIENDA LA ESTRELLITA','C/F','TAC TIC COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77741,'COB008','GLADYS AMARILIS','6950952-2','BARRIO SAN JACINTO TAC TIC, ALTA VERAPAZ.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77742,'COB009','CRISTINA SAY CHAMAN','2877070-6','3 Calle 2-29 Zona1 Coban, Alta Verapaz',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77743,'COB010','SILVIA ITZEP','2677239-6','COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77744,'COB011','MIGUEL GONZALEZ','CF','COBAN','4814-4430',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77745,'COB012','DEPOSITO EL ROSARIO','C-F','COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77746,'COB013','DEPOSITO  LA BENDICION','796762-4','COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77747,'COB014','MARGARITA CAHUEC CALEL','3591751-2','4ta. calle 6-15 z.1 Barrio San Jacinto Tac Tic, Alta Verapaz',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77748,'COB015','SURTIDORA ROSSY','1796965-4','EXT. MERCADO CENTRAL LOCAL 13 COBAN, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77749,'COB016','OSCAR CHOC','CF','COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77750,'COB017','GLORIA LEMUS','CF','TAC TIC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77751,'COB018','TERESA LEAL','CF','FRENTE A LA MUNI TUCURU, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77752,'COB019','RAFAEL COY LAJ','655391-5','INT MDO MPAL. TUCURU, TUCURU ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77753,'COB020','BONIFACIO SONTAY','638526-5','CALLE AL PARQUE, BARRIO EL CENTRO TUCURU ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77754,'COB021','ELSA MARIA MORALES CHAMAN','5230071-4','COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77755,'COB022','HERIBERTO HONES','372014-4','SALIDA A LA TINTA, TUCURU, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77756,'COB023','ROBERTO CASTRO','502395-5','CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77757,'COB024','ERNESTO BIN','2575798-9','BARRIO SAN BENITO, LA TINTA ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77758,'COB025','ALFREDO COC','774987-2','CALLE PRINCIPAL SALIDA A TELEMAN, LA TINTA ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77759,'COB026','ILSE BEATRIZ LOPEZ','3595105-2','SALIDA A TELEMAN, LA TINTA, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77760,'COB027','JAIME LEON RAMIREZ COPROPIEDAD','1415783-7','BARRIO EL CENTRO PANZOS, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77761,'COB028','ALEJANDRO COY','2892040-6','SALIDA AL ESTOR, PANZOS, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77762,'COB029','TIENDA MARLEN / DORA MARLENY','3362714-2','SALIDA AL ESTOR, PANZOS, ALTA VERPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77763,'COB030','ELSA NOEMI POSADA CERÓN','642438-4','CALLE PRINCIPAL, TELEMAN, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77764,'COB031','LUCIANO AJTE','CF','CALLE DE LA LINEA, TELEMAN, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77765,'COB032','ELVIRA CAZ','641660-8','CALLE PRINCIPAL, TELEMAN, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77766,'COB033','MARIA ELIZABETH','642497-K','CALLE PRINCIPAL, TELEMAN ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77767,'COB034','GERMAN EDUARDO QUEJ KAX','5731818-2','TACTIC, EXT. MERC MUNICIPAL, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77768,'COB035','EVELIN VARGAS','CF','2 CALLE 1-38 ZONA 1 TACTIC, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77769,'COB036','MARTA MEJIA','CF','INT MDO MPAL. TACTIC ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77770,'COB037','CLAUDIA XOL','CF','INT MDO MPAL. LOCAL # 32 TACTIC ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77771,'COB038','GASPAR MEJIA','3074528-4','INT MDO. MPAL.LOCAL # 35 TACTIC ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77772,'COB040','JUAN LUX PU','C/F','COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77773,'COB042','EMILIANO CAAL','596826-7','5A. AV. Y 2DA. CALLE ZONA 1, TAC TIC, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77774,'COB043','MARIANO MAAS','3562070-6','INT. MERCADO MUNICIPAL, TAMAHU, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77775,'COB044','ALBERTA TZUN','C/F','INT. MERCADO MUNICIPAL TAMAHU, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77776,'COB045','GREGORIO SUB','4181171-2','EXT. MERCADO MUNIC. TUCURÚ, ALTA VERAPAZ (FRENTE A RADIO EMANUEL)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77777,'COB046','JULIO SANTAY','620973-4','CALLE AL PERQUE, TUCURÚ, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77778,'COB047','TERESA LEAL','C/F','CALLE PRINCIPAL TUCURÚ, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77779,'COB048','ROBERTO COYOY','656494-1','CALLE PRINCIPAL LA TINTA, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77780,'COB049','PEDRO CHOC','4800530-4','BARRIO EL CENTRO LA TINTA, ALTA VERAPAZ (A LA PAR AGROFERR. EL AMANECER)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77781,'COB050','ANTONIO CHAVEZ','366673-7','SALIDA A TELEMAN, LA TINTA, ALTA VERAPAZ (A LA PAR DE BANRURAL)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77782,'COB051','DEPOSITO EL REY','542747-9','COBAN, ALTA VERAPAZ.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77783,'COB052','SAUL NOE CORDOVA','1481242-8','10 AV. 4-93 ZONA 6 B. LA ASUNCION TAC TIC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77784,'COB074','MINI DISTRIBUIDORA SANTIAGO','308954-1','CARCHA, COBAN.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77785,'COB075','NOVEDADES  MARISOL','821781-5','1a. Calle 2-38 Zona 1, Rabinal Baja Verapaz',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77786,'COCO','CONSERVAS Y CONGELADOS YA ESTA S.A.','773834-K','5ta. Calle 12-59 Col. La Escuadrilla Zona 2 de Mixco','432 4097',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77787,'CODISA','COMPAÑIA DISTRIBUIDORA, S.A.','107727-9','Boulevard Industrial Norte No. 440 El Naranjo Zona 4 Mixco, Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77788,'COEXPORT','PROVEE, S.A.','7055695-4','Empresarial El Cortijo, Interior 506',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77789,'COGISA','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','16 AV. 8-32 ZONA 4 VILLA NUEVA, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77790,'COGISA2','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','3a. Avenida 3-54 ZONA 1 AMATITLAN, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77791,'COGISA3','GRUPO SIMPLY SOCIEDAD ANONIMA','9132496-3','Calzada Aguilar Batres 44-12, Zona11 Guatemala, Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77792,'COGISA4','GRUPO SIMPLY, S.A.','9132496-3','Calz. San Juan 16-50 Z. 4 Mixco, Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77793,'COGISA5','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','11 Av Y 12 CALLE ZONA 18 PLAZA SURTI AHORRO LOCAL 211',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77794,'COGISA6','GRUPO SIMPLY SOCIEDAD ANONIMA','9132496-3','CALLE REAL 21-70 LOCAL B ZONA 10 SAN MIGUEL PETAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77795,'COGISA7','GRUPO SIMPLY SOCIEDAD ANONIMA','9132496-3','1A. AV 5-48 LOCAL 1 C.C.PLAZA DEL AHORRO BOCA DEL MONTE Z.1 VILLA CANALES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77796,'COGISA8','GRUPO SIMPLY, SOCIEDAD ANONIMA','9132496-3','4 CALLE 20-58 ZONA 6 LOCAL A CENTRO COMERCIAL LA CUCHILLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77797,'COGISA9','GRUPO SIMPLY, S.A.','9132496-3','KM 18.5 CARRETERA CA-9, RUTA AL PACIFICO, LOCAL 1-1, VILLA NUEVA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77798,'COMEDOR','ASOCIACION CIVIL NO LUCRATIVA TUS MANOS,COMEDOR','6499688-3','Calle de los Pasos # 2 Casa de la Tercera Orden Franciscana Seglar, Antigua Guatemala','7882-4439 - 7832-303',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77799,'CRISTY','SUPER TIENDA CRISTY','CF','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77800,'CUI001','TIENDA MANICS','4258673-4','CUILAPA, SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77801,'CHANIN','CHANIN EXPORT, S.A.','7339011-9','31 Av. A Ciudad de Plata II 14-80 Zona 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77802,'CHI001','YOLANDA RIVERA','605566-4','Calle Principal Concepción la Minas, Chiquimula',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77803,'CHI002','TIENDA NISSI / MAYRA LISBETH GALICIA LEIVA','3659674-4','MERCADO DE CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77804,'CHI003','TIENDA LA ECONOMICA','179953-3','CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77805,'CHI004','ADMINISTRADORA DE NEGOCIOS E INVERSIONES, S.A.','2693892-8','CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77806,'CHI005','MARIA OLIMPIA ESPAÑA','533216-8','3a. CALLE 7-61 ZONA 1 CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77807,'CHI006','TIENDAS DE ORIENTE, S.A.','9813313-6','Km. 172.1 ruta a Esquipulas, Chiquimula',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77808,'CHI007','DONY´S, S.A.','6438258-3','Calle Principal a una cuadra del parque Concepción la Minas, Chiquimula',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77809,'CHI008','BLANCA VIRGINIA TRUJILLO CARDONA','1962435-2','1 CALLE 2-15 ZONA 1 QUEZALTEPEQUE, CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77810,'CHI009','MARTA LUZ MENDEZ','762797-1','INT. MDO. MPAL CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77811,'CHI010','JULIAN PEREZ','7238486-7','1a. Calle,  CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77812,'CHI011','TIENDA CLARIBELY','442310-0','2 CALLE 1-41 ZONA 1 IPALA, CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77813,'CHI012','WILLIAM MORALES','C/F','Interior mercado la terminal local n-11, Chiquimula',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77814,'CHI013','NERY ORLANDO LEMUS','1271932-3','Interior mercado municipal local 196, Chiquimula.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77815,'CHI014','TIENDA LA OCCIDENTAL No. 2','CF','La Terminal, Chiquimula',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77816,'CHI015','LIDIA SANCE','759455-0','Interior mercado municipal, Chiquimula.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77817,'CHI016','CLAUDIA MARROQUIN','2553581-1','INTERIOR MERCADO CENTRAL CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77818,'CHI017','GLADIS ARACELY OSORIO','CF','INT MDO. MPAL CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77819,'CHI018','RODOLFO TUIZ','5536837-9','3a. Calle 7-21, Chiquimula.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77820,'CHI019','MANUEL ENRIQUE CORDERO','668979-5','Local 15 entre 10a. y 11a. Av. local 15 terminal, Chiquimula.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77821,'CHI020','DIEGO CASTRO','3027694-2','Frente al mercado La Terminal, Chiquimula.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77822,'CHI021','BRENDA YANETH SAGASTUME DE LOPEZ','721288-7','1 AV. 1-42 ZONA 3 IPALA, CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77823,'CHI022','PATRICIO CASTRO','CF','SANTA MARIA CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77824,'CHI023','TIENDA MARISELA/RUDY AVILA','665983-7','INT MERC TERMINAL CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77825,'CHI025','DEPOSITO ELSITA','4147780-4','CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77826,'CHI026','DEPOSITO MACARIO/PEDRO CHUMIL','748240-K','CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77827,'CHI028','LUIS DAVID LÓPEZ MONROY','794646-5','DIST. S. ESTEBAN. SAN ESTEBAN, CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77828,'CHI029','TIENDA PAOLITA','2724403-2','11 AV. L..185 MERC. LA TERMINAL, CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77829,'CHIC001','MIGUEL LUX','811728-4','INT MERCADO PLANTA ALTA LOCAL 132 CHICACAO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77830,'CHIC002','GASPAR LUX','3426293-8','INTERIOR MERCADO TRAMO 42 CHICACAO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77831,'CHIC003','TIENDA EL AGUILA','CF','INTERIOR MERC. LOCAL  71 CHICACAO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77832,'CHIC004','DAVID MEJIA','CF','INT. MERCADO TRAMO.59 CHICACAO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77833,'CHIC005','JOSE PEDRO TZUNUX','CF','EXT.DEL MERCADO FRENTE IGLESIA CATOLICA CHICACAO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77834,'CHIC006','LUIS GABRIEL SOC','CF','INT MERC No.2 FRENTE CARNICERIA MARIO´S SAN ANTONIO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77835,'CHIC007','PETRONA IZABEL TZIAN','CF','INT. MERC. PLANTA ALTA  SAMAYAC SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77836,'CHIC008','MATILDE YAC','637958-3','INT MERC PLANTA ALTA  SAMAYAC SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77837,'CHIC009','TIENDA ESQUIPULAS','CF','INT MERC SAMAYAC SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77838,'CHIC010','TIENDA REGALO DE DIOS','CF','ENTRADA AL MERC LADO DEL PARQUE SAMAYAC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77839,'CHIM001','TIENDA SHECANITA','C/F','CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77840,'CHIM002','MARIO JOEL LOPEZ','6704716-5','2A. CALLE  2-57 ZONA 3 CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77841,'CHIM003','JUAN VICTOR LOPEZ','583640-9','2A. CALLE 2-32 ZONA3, CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77842,'CHIM004','JUANA CRISTINA PAR','3536828-4','LOCAL 87 INTERIOR MERCADO CENTRAL CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77843,'CHIM005','TOMAS XOM','708782-9','INT MDO CENTRAL CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77844,'CHIM006','JUAN VICTOR LOPEZ YAX / TIENDA Y DEPOSITO LA ECONOMICA','583640-9','2 CALLE 2-32 ZONA 3 CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77845,'CHIM007','JERONIMO XOM','CF','CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77846,'CHIM008','DEPOSITO CHIMALTECO','134707-1','1A CALLE 1-59 ZONA 4 CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77847,'CHIM009','TIENDA MASHEÑITA / JERONIMO XON QUINO','1531496-0','INT MDO.CENTRAL LOC#88 Z.3 CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77848,'CHIM010','DEPOSITO TAPAZ / GUILLERMO TAPAZ','204100-6','5A AV. ZONA 2 COL.OCKLAN CHIMALTENANGO EXT MDO TERMI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77849,'CHIM011','TIENDA MAYA OCCIDENTAL #1','CF','LOCAL #1 EXT MDO. LA TERMINAL ZONA 2 CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77850,'CHIM012','TIENDA EL SALVADOR','CF','INT MDO.LA TERMINAL LOCAL #28 CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77851,'CHIM013','COOPERATIVA KAMOLON KI','CF','CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77852,'CHIM018','DISTRIBUIDORA REGIONAL COIRSA, S.A.','7010441-7','4 CALLE 0-63 ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77853,'CHIM019','TIENDA MARY','648142-6','CHIMALTENANGO, CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77854,'CHIM020','JERONIMO XOM QUINO','1531496-0','CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77855,'CHIM050','GRUPO CHIMALTECA, S.A.','6123211-4','2 CALLE 2-32 Z.3 CHIMALTENANGO.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77856,'CHINITO','EL CHINITO VELOZ S.A.','818597-2','CALZ. SAN JUAN 30-00 ZONA 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77857,'D13.5','OPERADORA DE TIENDAS , S. A.','737810-6','Carretera al Atlántico 46-98, zona 25, Guatemala, Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77858,'D20CA','OPERADORA DE TIENDAS, S.A.','737810-6','JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77859,'D6AVE','OPERADORA DE TIENDAS, S.A.','737810-6','6A. AVE. 9-42 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77860,'DALAM','OPERADORA DE TIENDAS SA','737810-6','15 AVE. 2-88 ZONA 6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77861,'DAMAT','OPERADORA DE TIENDAS S.A.','737810-6','2A. AVE. 6A.CA. ESQUINA NORORIENTE Z.1 AMATITLAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77862,'DAMATES','OPERADORA DE TIENDAS,S.A.','737810-6','LOS AMATES IZABAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77863,'DANT','OPERADORA DE TIENDAS S.A. C.P. 17371','737810-6','CASA 5 CALZADA SANTA LUCIA NORTE ANTIGUA','832 4212',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77864,'DATLA','OPERADORA DE TIENDAS S.A.','737810-6','11 AVE. 6-33 ZONA 18 COL. ATLANTIDA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77865,'DAVEL','OPERADORA DE TIENDAS S.A. C.P. 17371','737810-6','AVENIDA ELENA 12-59 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77866,'DBARB','OPERADORA DE TIENDAS S.A.','737810-6','3a. CALLE 6-40 ZONA 1 BARBERENA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77867,'DBARR','OPERADORA DE TIENDAS S.A. C.P. 17371','737810-6','8a. Calle y 7a Av Lote #63 Z 1. Puerto Barrios Izabal.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77868,'DBOCA','OPERADORA DE TIENDAS S.A.','737810-6','CARR. VILLA CANALES KM. 12.5 BOCA DEL MONTE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77869,'DBRIS','OPERADORA DE TIENDAS, S. A.','737810-6','KM. 16.5 CARR. SAN JUAN SACATEPÉQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77870,'DCARCHA','OPERADORA DE TIENDAS S.A. C.P. 17371','737810-6','10AVE. 4-35 ZONA 1 SAN PEDRO CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77871,'DCARR','OPERADORA DE TIENDAS, S.A.','737810-6','Granja El Refugio, Calle Principal, Sn Juan Sacatepequez, Sacapatequez',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77872,'DCATA','OPERADORA DE TIENDAS, S.A. C-P- 17371','737810-6','2a Calle \"A\" 3-84 Z 1, Santa Catarina Mita, Jutiapa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77873,'DCATALINA','OPERADORA DE TIENDAS, S.A.','737810-6','VILLA NUEVA, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77874,'DCOAT','OPERADORA DE TIENDAS, S.A.','737810-6','4a. AVENIDA 4-09 ZONA 1 COATEPEQUE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77875,'DCOBAN','OPERADORA DE TIENDAS, S.A.','737810-6','1a. CALLE 2-38, ZONA 3 COBAN ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77876,'DCOL','OPERADORA DE TIENDAS, S.A.','737810-6','COLOMBA QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77877,'DCOLO','OPERADORA DE TIENDAS, S.A.','737810-6','14 AVENIDA 5-19 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77878,'DCOMA','OPERADORA DE TIENDAS, S.A.','737810-6','COMALAPA CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77879,'DCOMU','OPERADORA DE TIENDAS, S. A.','7378106','ZONA 10 MIXCO, SAN JOSÉ LA COMUNIDA.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77880,'DCONC','OPERADORA DE TIENDAS, S.A.','737810-6','5a. AVENIDA 14-40 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77881,'DCQUET','OPERADORA DE TIENDAS, S.A.','737810-6','L.1,2,3,4,5,6,19,20,21,22,23 y24 \"M\"P, Sec 3-A El Eden Cd. Quetzal, Sn Juan Saca.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77882,'DCREAL','OPERADORA DE TIENDAS, S.A.','737810-6','1a Calla 3-69, Z 5, Villa Nueva',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77883,'DCUILA','OPERADORA DE TIENDAS, S.A.','737810-6','1a. Calle y 1a. Av. Z 1, Barrio El Centro, Cuilapa, Santa Rosa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77884,'DCUYO','OPERADORA DE TIENDAS S.A.','737810-6','2a. Av y 2a. Calle Z 1, Cuyotenango, Suchitepequez',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77885,'DCHIAN','OPERADORA DE TIENDAS, S.A.','737810-6','7a. Calle 4-43, Z 1 Chiantla, Huehuetenango.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77886,'DCHIC','OPERADORA DE TIENDAS, S.A.','737810-6','CHICACAO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77887,'DCHICHI','OPERADORA DE TIENDAS','737810-6','7a. Av. 7-04 Z.1, Chichicastenango, Quiche',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77888,'DCHIM','OPERADORA DE TIENDAS, S.A.','737810-6','5a. AVE. 3-05 ZONA 2 CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77889,'DCHIQ','OPERADORA DE TIENDAS, S.A.','737810-6','10 AVE. 2-11 ZONA 1 CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77890,'DCHIQU','OPERADORA DE TIENDAS, S.A.','737810-6','1a. CALLE, 2a. AVE. ZONA 4 CHIQUIMULILLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77891,'DDEMO','OPERADORA DE TIENDAS, S. A.','737810-6','15 Av. 1-50, Z.3, Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77892,'DEKA','DEKA TRADING CORP','DEKA','# 1003, MIAMI FL. 33130',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77893,'DELTA','NEGOCIOS DELTAVISTA, SRL','131-080911','Santo Domingo Oeste, República Dominicana.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77894,'DEPVARI','CLIENTES DEPARTAMENTALES VARIOS.','CF','ASUCION MITA, JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77895,'DESCU','OPERADORA DE TIENDAS, S.A.','737810-6','8a. CALLE 4-33 ZONA 1, ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77896,'DESQU','OPERADORA DE TIENDAS, S.A.','737810-6','3a. Y 4a AVE., 7a Y 9a. CALLE ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77897,'DESTOR','OPERADORA DE TIENDAS, S.A.','737810-6','IZABAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77898,'DFRAI','OPERADORA DE TIENDAS, S.A.','737810-6','FRAIJANES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77899,'DFRAY','OPERADORA DE TIENDAS,S.A.','737810-6','ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77900,'DFRUT','OPERADORA DE TIENDAS, S.A.','737810-6','LOTE 30 COMPLEJO COMERCIAL EL FRUTAL Z.5 VILLA NUEVA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77901,'DGOMER','OPERADORA DE TIENDAS, S.A.','737810-6','4a. Av. 3-00, Z.1 La Gomera, Escuintla',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77902,'DGUAL','OPERADORA DE TIENDAS, S.A.','737810-6','BARRIO EL CENTRO GUALAN, ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77903,'DGUAR','OPERADORA DE TIENDAS, S.A.','737810-6','2a. AVENIDA 2-67 ZONA 11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77904,'DHOND','SUPERMERCADOS DIVERSOS, S.A.','560739-6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77905,'DHUE','OPERADORA DE TIENDAS, S.A.','737810-6','1a. AVENIDA 4-19 ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77906,'DHUETERM','OPERADORA DE TIENDAS, S.A.','737810-6','Calz. Kaibil Balam, Z.5 Huehuetenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77907,'DIGNA','OPERADORA DE TIENDAS, S.A. C.P. 17371','737810-6','AVE. BRIGADA 13-92 \"A\"Z.7 MIXCO COL. BRIGADA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77908,'DIPALA','OPERADORA DE TIENDAS, S.A.','737810-6','IPALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77909,'DISCOMER','SANDRA MARITZA RAMIREZ ESPAÑA','1198896-7','3ra. CALLE ´A´ 3-09 RESIDENCIALES VALLE DE MARIA Z. 2 VILLA NUEVA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77910,'DIZAB','OPERADORA DE TIENDAS, S.A.','737810-6','MORALES, IZABAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77911,'DJALA','OPERADORA DE TIENDAS, S.A.','737810-6','2a. CALLE 7-72 ZONA 2, JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77912,'DJALAZO2','OPERADORA DE TIENDAS, S.A.','737810-6','JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77913,'DJALPA','OPERADORA DE TIENDAS,S.A.','737810-1','JUTIAPA GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77914,'DJILO','OPERADORA DE TIENDAS, S.A.','737810-6','SAN MARTIN JILOTEPEQUE CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77915,'DJOCO','OPERADORA DE TIENDAS, S.A.','737810-6','15 AVE. FINAL L-12 ZONA 6 JOCOTALES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77916,'DJOYA','OPERADORA DE TIENDAS, S.A.','737810-6','1A. CALLE SALIDA A SACUALPA, JOYABAJ QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77917,'DJUSTO','OPERADORA DE TIENDAS  S.A.','737810-6','6 CALLE 12-00 ZONA 21 JUSTO R. BARRIOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77918,'DJUTI','OPERADORA DE TIENDAS, S.A.','737810-6','4a. CALLE 3-51 ZONA 3 JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77919,'DLCOY','OPERADORA DE TIENDAS, S. A.','737810-6','Km.19.5 Calz.Roosevelt 6-20 Col.Lo de Coy, Z 1 Mix.','23842152',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77920,'DLIBERTAD','OPERADORA DE TIENDAS, S.A.','737810-6','LA LIBERTAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77921,'DLINDA','OPERADORA DE TIENDAS, S.A.','737810-6','1a. Av. y 3a. Calle, Colonia Guatel, zona 10, Villa Nueva ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77922,'DLOMAS','OPERADORA DE TIENDAS, S.A.','737810-6','11 Calle 13-18, zona 17, Colonia Lomas del Norte',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77923,'DLREYES','OPERADORA DE TIENDAS, S.A','737810-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77924,'DMART','OPERADORA DE TIENDAS, S.A.','737810-6','4a. CALLE 20-12 ZONA 6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77925,'DMATA','OPERADORA DE TIENDAS, S. A.','737810-6','MATAQUESCUINTLA, JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77926,'DMAZA','OPERADORA DE TIENDAS, S.A.','737810-6','MAZATENANGO, SUCHITIPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77927,'DMAZA2','OPERADORA DE TIENDAS,S.A. 17371','737810-6','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77928,'DMENCOS','OPERADORA DE TIENDAS S.A. 17371','737810-6','PETEN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77929,'DMESC','OPERADORA DE TIENDAS , S. A.','737810-6','MASAGUA ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77930,'DMILA','OPERADORA DE TIENDAS, S.A.','737810-6','LOT.11,12,13,24,25 SEC. T COL. MILAGRO Z.6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77931,'DMINI','OPERADORA DE TIENDAS, S.A.','737810-6','10a. AVENIDA 4-45 Z.19 COL. LA FLORIDA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77932,'DMITA','OPERADORA DE TIENDAS, S.A.','737810-6','ASUNCION MITA, JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77933,'DMIXC','OPERADORA DE TIENDAS, S.A.','737810-6','6a. AVENIDA 6-24 ZONA 3 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77934,'DNARA','OPERADORA DE TIENDAS, S.A.','737810-6','BOULEVARD BOSQUES DE SN. NICOLAS 24-53 Z.4 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77935,'DNIMA','OPERADORA DE TIENDAS, S.A.','737810-6','14 CALLE 16-50 ZONA 21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77936,'DNVCO','OPERADORA DE TIENDAS','737810-6','Lote 170, Sector \"B\", Nueva Concepción, Escuintla',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77937,'DNVSR','OPERADORA DE TIENDAS, S. A.','737810-6','NUEVA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77938,'DPALE','OPERADORA DE TIENDAS, S.A.','737810-6','Calle Real y 3a. Av. Esquina, Cantón Agua Tibia, Palencia, Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77939,'DPALIN','OPERADORA DE TIENDAS, S.A.','737810-6','PALIN, ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77940,'DPANA','OPERADORA DE TIENDAS, S.A..','737810-6','PANAJACHEL SOLOLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77941,'DPATU','OPERADORA DE TIENDAS, S.A.','737810-6','2a. AVENIDA 4-61 PATULUL SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77942,'DPATZUN','OPERADORA DE TIENDAS S.A.','737810-6','CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77943,'DPETA','OPERADORA DE TIENDAS, S.A.','737810-6','AVENIDA PETAPA 9-02 ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77944,'DPETEN','OPERADORA DE TIENDAS, S.A. C.P. 17371','737810-6','4a. CALLE 7-90 Z. 1 SANTA ELENA PETEN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77945,'DPOPT','OPERADORA DE TIENDAS, S.A. C.P. 17371','737810-6','POPTUN, PETEN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77946,'DPRO','OPERADORA DE TIENDAS','737810-6','2a. Av. Barrio La Democracia, Guastatoya, El Progreso',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77947,'DPROJU','OPERADORA DE TIENDAS, S.A.','737810-6','PROGRESO JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77948,'DPUERTO','OPERADORA DE TIENDAS, S.A. C.P. 17371','737810-6','AVE. 30 JUNIO F/MUNI.PTO. SAN JOSE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77949,'DQUET','OPERADORA DE TIENDAS, S.A.','737810-6','13 AVE. 6-94 Z. 1 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77950,'DQUETES','OPERADORA DE TIENDAS, S.A.','737810-6','LA ESPERANZA QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77951,'DQUICHE','OPERADORA DE TIENDAS, S.A.','737810-6','SANTA CRUZ  DEL QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77952,'DQUIN','OPERADORA DE TIENDAS, S.A.','737810-6','5a- CALLE 12-61 ZONA 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77953,'DRABI','OPERADORA DE TIENDAS S.A.','737810-6','RABINAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77954,'DREU','OPERADORA DE TIENDAS, S.A.','737810-6','RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77955,'DRIO','OPERADORA DE TIENDAS, S.A.','737810-6','RIO DULCE, IZABAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77956,'DROOS','OPERADORA DE TIENDAS, S.A. C.P.17371','737810-6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77957,'DSACA','OPERADORA DE TIENDAS, S.A   C.P. 17371','737810-6','6a. AVENIDA 8-00 ZONA 4 SAN JUAN SACATEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77958,'DSALA','OPERADORA DE TIENDAS, S.A.','737810-6','5a. CALLE #3B 0-6 Z.1 BARRIO CENTRO SALAMA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77959,'DSALCA','OPERADORA DE TIENDAS, S.A.','737810-6','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77960,'DSANA','OPERADORA DE TIENDAS, S.A.','737810-6','SANARATE, EL PROGRESO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77961,'DSANBOCA','OPERADORA DE TIENDAS, S.A.','737810-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77962,'DSANTI','OPERADORA DETIENDAS, S.A.','737810-6','SANTIAGO SACATEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77963,'DSCPN','OPERADORA DE TIENDAS, S. A.','737810-6','3A. AVE. 0-53, ZONA 2 STA. CATARINA PINULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77964,'DSJVN','OPERADORA DE TIENDAS, S. A.','737810-6','6a. Av. 4-00, zona 2, San José Villa Nueva',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77965,'DSNCR','OPERADORA DE TIENDAS, S.A.','737810-6','SAN CRISTOBAL ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77966,'DSNCHAM','OPERADORA DE TIENDAS, S.A.','737810-6','SAN JUAN CHAMELCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77967,'DSNFR','OPERADORA DE TIENDAS, S.A.','737810-6','BOULEVAR EL CAMINERO 13-48 COL. SAN FRANCISCO Z.6 DE MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77968,'DSNJO','OPERADORA DE TIENDAS, S.A.','737810-6','CALLE PRINCIPAL 1-35 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77969,'DSNJU','OPERADORA DE TIENDAS,  S.A.','737810-6','CALZADA SAN JUAN 9-00 ZONA 19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77970,'DSNJUOS','OPERADORA DE TIENDAS, S.A.','737810-6','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77971,'DSNLU','OPERADORA DE TIENDAS, S.A. 17371','737810-6','6.calle,Carretera a Santiago,San Lucas Sacatepquez,Sacatepquez',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77972,'DSNMA','OPERADORA DE TIENDAS, S.A.','737810-6','SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77973,'DSNMAR','OPERADORA DE TIENDAS, S.A.','737810-6','SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77974,'DSNMI','OPERADORA DE TIENDAS, S.A.','737810-6','0 CALLE 1-62 ZONA 9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77975,'DSNSU','OPERADORA DEE TIENDAS S.A.','737810-6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77976,'DSOLO','OPERADORA DE TIENDAS, S.A.','737810-6','6A. AVENIDA Y 9A. CALLE, ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77977,'DSOLOMA','OPERADORA DE TIENDAS S.A.','737810-6','4A. Av. 4-41 ZONA 1 SOLOMA, HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77978,'DSRAY','OPERADORA DE TIENDAS, S.A.','737810-6','SAN RAYMUNDO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77979,'DSTISA','OPERADORA DE TIENDAS, S.A.','737810-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77980,'DSTLU','OPERADORA DE TIENDAS, S.A.','737810-6','3a. Av. 4-31, zona 1, Santa Lucía Cotzumalguapa, Escuintla.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77981,'DSUM','OPERADORA DE TIENDAS, S.A.','737810-6','SUMPANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77982,'DTACTIC','OPERADORA DE TIENDAS, S.A.','737810-6','TACTIC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77983,'DTECPAN','OPERADORA DE TIENDAS, S.A.','737810-6','TECPAN CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77984,'DTECU','OPERADORA DE TIENDAS, S.A.','737810-6','Km 121.5 Carretera al Atlántico CA-9, Teculután, Zacapa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77985,'DTERM','OPERADORA DE TIENDAS, S.A','737810-6','1a. CALLE 3-36 ZONA 9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77986,'DTERM2','OPERADORA DE TIENDAS, S.A.','737810-6','9a. CALLE 3-16 ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77987,'DTIQUI','OPERADORA DE TIENDAS S.A.','737810-6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77988,'DTNV','OPERADORA DE TIENDAS, S.A.','737810-6','2ª. Calle 15-25, bulevar principal, Colonia Lo de Fuentes, zona 11 de Mixco.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77989,'DTOTO','OPERADORA DE TIENDAS,  S.A.','737810-6','9a. AVE. 05-15  ZONA 3 TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77990,'DTREB','OPERADORA DE TIENDAS, S.A.','737810-6','AUTOVIA MIXCO 4-34 ZONA 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77991,'DVERA','OPERADORA DE TIENDAS, S.A.','737810-6','ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77992,'DVICA','OPERADORA DE TIENDAS, S.A.','737810-6','9a. Calle 3-10, zona 1, Villa Canales',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77993,'DVIHE','OPERADORA DE TIENDAS, S.A.','737810-6','20 CALLE 33-65 ZONA 7 VILLA HERMOSA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77994,'DVINU','OPERADORA DE TIENDAS, S.A.','737810-6','4a. CALLE No. 6 VILLA NUEVA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77995,'DXELA','OPERADORA DE TIENDAS S.A.','737810-6','15 Av. 1-50, zona 3, Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77996,'DZACA','OPERADORA DE TIENDAS, S.A.','737810-6','ZACAPA, ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77997,'DZO10','OPERADORA DE TIENDAS, S.A.','737810-6','20 Calle 15-50, zona 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77998,'DZO18','OPERADORA DE TIENDAS, S.A.','737810-6','12 CALLE MANZANA 6 SAN RAFAEL I No. 495',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(77999,'DZO2','OPERADORA DE TIENDAS, S.A.','737810-6','10 AVE. \"A\" 00-21 ZONA 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78000,'DZO5','OPERADORA DE TIENDAS, S.A.','737810-6','27 CALLE 13-50 ZONA 5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78001,'ELCARMEN','EL CARMEN EXPORT','292075-1','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78002,'ELMAR','Supermercados Colis S.A.','9533768-7','33 AVENIDA 8-67 ZONA 7 TIKAL 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78003,'ELMAR2','SUPERMERCADO TIKAL, S.A','8093032-8','9 CALLE TIKAL II 33-56 ZONA 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78004,'EMD','E.M.D. SALES, INC.','.','3335 75TH AVENUE LANDOVER MD 20785',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78005,'ESC001','TIENDA CANIZ / JOEL LUX CANIZ','742012-9','10 CALLE 2-50 ZONA 1 ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78006,'ESC002','TDA LA OCCIDENTAL 1','2588031-4','AV. DEL COMERCIO PTO SAN JOSE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78007,'ESC003','ARCA DE NOE','2440024-6','EV. 30 DE JUNIO 6-03 Z.1 PTO SAN JOSE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78008,'ESC004','DISTRIBUIDORA D´FAMA, S.A.','7143910-2','5TA CALLE A 7-57 ZONA 0 SIPACATE ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78009,'ESC005','TIENDA EL BUEN PRECIO','CF','EXT MERC  COSTADO SALON MUNICIPAL LA GOMERA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78010,'ESC006','MULTIMERC KAIROS, S.A.','5201087-2','CALLE BELICE FRENTE MERC LA TERMINAL NVA CONCEPCION ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78011,'ESC007','JORGE CHOPEN','3675209-6','TIQUISATE ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78012,'ESC008','TIENDA FLOR CHICHICASTECA','CF','TIQUISATE ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78013,'ESC009','TIENDA EL TRIUNFO','CF','INT MERCADO LOCAL 74 Y 73 TIQUISATE ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78014,'ESC010','GRUPO CEMBER, S. A.','4506762-7','5ta. Avenida 6-40 Zona 1 Santa Lucia Cotzumalguapa, Escuintla.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78015,'ESC011','TIENDA MASHENITA','CF','TIQUISATE ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78016,'ESC012','TIENDA CLAUDIA','CF','TIQUISATE ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78017,'ESC013','TIENDA BRISAS DEL MAR','CF','EXT MERC LA TERMINAL NVA CONCEPCION ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78018,'ESC014','DESECHABLES NATANAHEL','609365-5','10a. CALLE A 2-82 Z 1 ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78019,'ESC015','CLAUDIA CLARIBEL PAR MELETZ','5189531-5','INT MERC PTO SAN JOSE ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78020,'ESC016','ANA REBECA SAPON','499922-3','MERCADO N.3 3RA. AV. ZONA 1 ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78021,'ESC017','DEPOSITO SHADDAI','206342-5','3a. AVE 10-79 Z 1 ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78022,'ESC018','CAMILO BOCEL','4360554-0','7a.Calle Oriente L.7 Loti.S.Vicente P.San Jose Escuintla.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78023,'ESC019','TOMAS CONOZ','443635-0','3a.Av.9-01 esquina Siquinala, Escuintla.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78024,'ESC020','ANTONIO CAC US','3726603-9','4a.Av.14-95 Escuintla.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78025,'ESC021','LUCAS JAX','C/F','Siquinala, Escuintla.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78026,'ESC022','MARCOS PU CASTRO','C/F','Siquinala, Escuintla.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78027,'ESC023','JOSE CARLOS PU','C/F','Siquinala, Escuintla.','59922435',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78028,'ESC024','MARIA FLORIDALMA BUSTAMANTE','806006-1','2da. Calle 0-41 z.4 local A, Palin Escuintla.','78388516',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78029,'ESC025','SELMA MENDIZABAL','1359027-8','Terminal del Sur Local 132, Escuintla.','56645069',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78030,'ESC026','TIENDA PATZITECA/JUAN SOC COR','549926-7','8A CALLE A 04-028 Z 1 ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78031,'ESC027','DISTRIBUIDORA RECAMF VALCOR, S.A.','3545483-0','4a CALLE 34-46 ZONA 3 ESCUINTLA COL. LAS GOLONDRINAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78032,'ESC028','RANDOLFO VALDEZ','462015-1','ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78033,'ESQ001','INVERSIONES Y TIENDA SAN JUDAS, S.A.','8829870-1','4 AVE. 7-29 ZONA 1 ESQUIPULAS, CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78034,'ESQ002','UNIMARKET','3628416-5','4 AVE. 8-55 ZONA 1 ESQUIPULAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78035,'ESQ003','SUPERMERCADO EL SOL S.A.','3879074-2','ESQUIPULAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78036,'ESQ004','MARIA CHITI ZAPON','2713680-9','5 AV. 7-53 ZONA 1 ESQUIPULAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78037,'ESQ005','RAFAEL HERRERA','905763-9','INT MDO MPAL ESQUIPULAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78038,'ESQ006','JOSE ANTONIO MONROY','725603-5','INT MDO MPAL ESQUIPULAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78039,'ESQ007','DISTRIBUIDORA EL PUNTO','1251044-0','5A. AVENIDA 9-12, ESQUIPULAS (FRENTE A TELGUA)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78040,'ESQ008','CRISTI CUTZ','C/F','INTERIOR MERCADO MUNICIPAL, ESQUIPULAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78041,'ESQ009','PEDRO HERRERA..','725596-9','5a AVE 8-53 Z1 FRENTE MERC MUNIC ESQUIPULAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78042,'ESQ010','ABARROTERIA EL SAUCE','1591020-2','INTERIOR MERCADO. ESQUIPUALS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78043,'FEDURO','AGENCIAS FEDURO COSTA RICA, S.A.','CF','200 MTS DE LA IGLESIA SN RAFAEL DESAMPARADO SN JOSE COSTA RICA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78044,'FESO','PROCESADORA DE ALIMENTOS FESO, S.A.','751636-3','10 AV. 28-50, ZONA 13 COLONIA SANTA FE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78045,'FOODCO','FOODCO DEVELOPMENT, INC.','FOODCO','ESTADOS UNIDOS DE NORTEAMERICA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78046,'FOTOLAB','FOTOS Y CONVENIENCIA, S.A.','3630463-8','5TA. AVENIDA 1-42 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78047,'FREDY','FREDY ESTUARDO ESPAÑA TORRES','621305-7','RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78048,'FRUTA','FRUTALETAS, S. A. DE C. V.','06142804790012','Boulevard Coronel José Arturo Castellanos, #2230 San Salvador, El Salvador',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78049,'GAMER','OPERADORA DE TIENDAS, S.A.','737810-6','AVENIDA LAS AMERICAS 17-70 ZONA 13','334 5441-42',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78050,'GIGANTE','IMPORTADORA GIGANTE, S. DE R.L.','05019001050020','BOULEVARD HACIA PTO CORTES KM3 CHOLOMA HONDURAS, C.A.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78051,'GOYA','GOYA FOODS, INC','-','1900 N.W. Avenue, Miami FL 33172 UNITED STATES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78052,'GOYACA','GOYA FOODS OF CALIFORNIA','-','14500 PROCTOR AVE CITY OF INDUSTRY CA 91746 UNITED STATES','PH:(626)961-6161',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'MARLON.TIXTA@GOYA.COM'),(78053,'GOYAFL','GOYA FOODS OF FLORIDA','-','13300 NW. 25 STREET MIAMI FL.33182 UNITED STATES','PH:(305) 592-3150',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'ARMANDO.ALVARADO@GOYA.COM'),(78054,'GOYANJ','GOYA FOODS, INC.','.','350 COUNTY ROAD JERSEY CITY, NJ 07307 UNITED STATES','PH:((201)-348-4900',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'JOSE.MORALES@GOYA.COM - MARCELA.CARLIN@GOYA.C'),(78055,'GOYATX','GOYA FOODS OF TEXAS','-','30602 McALLISTER ROAD BROOKSHIRE, TX.77423 UNITED STATES','PH:(713)266-9834',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'ANDREA.RESTREPO@GOYA.COM'),(78056,'GP','GUMERCINDO PINEDA','C/F','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78057,'GPENRA','ENRIQUE RAMIREZ','C/F','ASUNCION MITA, JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78058,'GPROC','OPERADORA DE TIENDAS, S.A.','737810-6','18 CALLE BOULEVARD LOS PROCERES 13-38 ZONA. 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78059,'GPUPA','Cooperativa de Ahorro, Crédito y Servicios Varios Unión Progresista','291823-4','2 AV 3-71 ZONA 1 AMATITLAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78060,'GPVARI','CLIENTES VARIOS RUTEO LOCAL GUMERCINDO PINEDA','C/F','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78061,'GUMER','GUMERCINDO PINEDA','C/F','CIUDAD, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78062,'HERMANOPEDRO','Asociación Obras Sociales Del Santo Hermano Pedro','546198-7','6a.Calle Oriente No.20, La Antigua Guatemala, Guatemala','7931-2100 Ext. 144 y',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78063,'HIPER','OPERADORA DE TIENDAS, S.A.','737810-6','CALZADA ROOSEVELT 26-95 ZONA 11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78064,'HIPERB','OPERADORA DE TIENDAS, S.A.  C.P. 17371','737810-6','41 AVE. 3-10 ZONA 4 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78065,'HIPERN','OPERADORA DE TIENDAS, S.A.','737810-6','KM. 5 CARR. ATLAN. C.C. METRO NORTE, Z. 17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78066,'HIPERNOR','OPERADORA DE TIENDAS, S.A.','737810-6','Km 4.5 Ruta al Atlántico, zona 17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78067,'HIPERP','OPERADORA DE TIENDAS, S.A.','737810-6','KM. 15.5 CARRETERA A EL SALVADOR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78068,'HIPERS','OPERADORA DE TIENDAS, S.A.','737810-6','KM. 17 CARRETERA AL PACIFICO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78069,'HIPERSKALA','OPERADORA DE TIENDAS, S.A.','737810-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78070,'HIPERX','OPERADORA DE TIENDAS, S.A.','737810-6','AVE. LAS AMERICAS C.C. PRADERA Z. 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78071,'HUE001','TIENDA LA ESPIGA DE ORO','819259-6','6a. CALLE 4-49 ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78072,'HUE002','LA MODERNA, S.A.','549239-4','3a. CALLE 3-08 ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78073,'HUE003','COMERCIAL ELVIRITA','671557-5','EXT. C.C. LA PLAZA L.5 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78074,'HUE004','MARINA CONSUELO HUITZ.','HUE004','INT. MERCADO LOCAL 191 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78075,'HUE005','DISTRIBUIDORA REGIONAL COIRSA, S.A.','7010441-7','4TA. CALLE 0-63 ZONA 1 HUEHUETENANGO','7764-3655',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'MARTA GONON - IRIS - RUTH'),(78076,'HUE006','EDWIN EDUARDO MOLINA GONON','1544579-8','HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78077,'HUE007','TIENDA IRIS','851182-9','HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78078,'HUE008','CESAR PEREZ','6595065-8','HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78079,'HUE009','MOISES JUAREZ','HUE009','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78080,'HUE010','WALTER AROCHE','769589-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78081,'HUE011','DEPOSITO SHADAI','3984557-5','HUEHUETENAGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78082,'HUE012','COMERCIAL CHAVEZ/ MARIO MORALES','CF','1A.AV 1-11 ZONA 1 CANTON EL CALVARIO HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78083,'HUE013','DISTRIBUIDORA CASTILLO / MARCO TULIO CASTILLO','471707-4','1A.AV 1-48 ZONA 1 BARRIO EL CALVARIO HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78084,'HUE014','DEPOSITO CALIFORNIA/FELICIANA MAZARIEGOS','CF','1A.AV Z.1 CALLE DEL CALVARIO HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78085,'HUE015','TIENDA COATANECA/ SEBASTIAN MARTIN','768530-0','1A. AV. 1-78 Z 1 CALLE DEL CALVARIO HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78086,'HUE016','COMERCIAL FLORY/ GILMA F RUEDAS DE DIAZ','2336144-1','1A.AV Y 4 CALLE Z.1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78087,'HUE017','TIENDA JERUSALEN/ BENEDICTO ALVARADO','444724-7','1A.AV 4-32 Z. 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78088,'HUE018','COMERCIAL MARIBEL','5175764-1','1A.AV Y 4 CALLE Z.1 HUEHUTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78089,'HUE019','COMERCIAL LA ECONOMICA','415196-8','1A.AV. Y 4 CALLE ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78090,'HUE020','DEPOSITO SAN FRANCISCO / EDWIN OTONIEL','2533017-9','1A.AV Y 4 CALLE ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78091,'HUE021','YOLANDA MARTINEZ','4141355-5','3AV. EXT LA PLAZA LOCAL #5 HUEHUTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78092,'HUE022','NOEMI MOLINA','819259-6','4 CALLE 1-61 ZONA 1 HUEHUETENANGO','7764-0580',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'DIEGO MOLINA'),(78093,'HUE023','JOSE SAQUIL','CF','HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78094,'HUE024','TIENDA PATZITE','CF','HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78095,'HUE025','DEPOSITO EL TRIUNFO','CF','HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78096,'HUE026','MABEL GONZALES','4274320-6','ALDEA EL JOBAL, LA DEMOCRACIA HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78097,'HUE027','ARMANDO O. CHAVEZ','877275-4','4 CALLE 0-63 ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78098,'HUE028','COMERCIAL CHAVEZ','CF','1 AV. 1-11 ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78099,'HUE029','TIENDA SOFIA','C/F','HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78100,'HUE030','MANUEL GONZALEZ','4274320-6','ALDEA EL JOBAL, LA DEMOCRACIA, HUEHUETENANGO.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78101,'HUE031','LUSBI HERRERA','C/F','CAMOJA, HUEHUETENANGO.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78102,'HUE032','FELICIANA MAZARIEGOS','C/F','CALLE AL CALVARIO ZONA 1, HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78103,'HUE033','BENEDICTO ALVARADO','C/F','1a. Av. 4ta. Calle Zona 1, Huehuetenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78104,'HUE034','AMILCAR GUTIERREZ','1614109-1','1A. AV. 4TA. CALLE ZONA 1 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78105,'HUE035','TIENDA LOS ANGELES','504988-1','7 C. 8-46 Z.1 CHIANTLA, HUEHUE.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78106,'HUE036','CARNES Y EMBUTIDOS OSTUNCALCO','674061-8','4TA. C. EXT.COMERCIAL L,PLAZA HUEHUE.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78107,'HUE037','ANA MARIA MARTINEZ','C/F','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78108,'HUE038','MICRO TIENDA BRASILIA','638772-1','CHIANTLA, HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78109,'HUE039','ORTELHUE','598325-8','1 AV. ENTRE 2DA.Y 3A. CALLE Z.8 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78110,'HUE040','LA SUPER ESTRELLA','4658503-6','2AV. Z.9 HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78111,'HUE041','COMERCIAL CALIN','4401217-9','INT. LA PLAZA LOCAL 15, HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78112,'INA','DISTRIBUIDORA INTERAMERICANA DE ALIMENTOS,S.A.','823380-2','33 CALLE 6-34 ZONA 11 COLONIA LAS CHARCAS','2376-800',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78113,'INASOPA','INDUSTRIA NACIONAL ALIMENTICIA, S.A.','156469-2','33 CALLE 6-34, ZONA 11 COLONIA LAS CHARCHAS','2376-8000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78114,'INDECA','INVERSIONES Y DESARROLLOS DE CENTRO AMERICA, S.A.','05019012536059','Boulevard hacia puerto cortes kilometro 3 choloma, Honduras,C.A.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78115,'INPRO','INDUSTRIA PRODUCTORA DE ALIMENTOS, S.A.','1191292-8','CALLE DE LOS PINOS 10-54 ZONA 7 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78116,'IVAN001','ESPECIES ESQUIPULAS','CF','LOCAL 257 MERCADO TERMINAL ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78117,'IVAN002','TIENDA LA PROVIDENCIA','CF','MERCADO LA TERMINAL ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78118,'IVAN003','ENACORE, S.A','1690157-0','20 CALLE 12-69 ZONA 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'CONTACTO AMPARITO'),(78119,'IVAN004','DISTRIBUIDORA TROPICAL- LESVIA PADILLA','341043-9','RUTA 4 1-66 ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'CONTACTO LORENA'),(78120,'IVAN005','DEPOSITO ARCO IRIS','CF','GALPON 7 CENMA ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78121,'IVAN006','TIENDA TONITO','CF','LOCAL 260-311 MERCADO NIMAJUYU ZONA 21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'TONITO'),(78122,'IVAN007','VARIEDADES LA ECONOMICA','CF','LOCAL 23 A MERCADO VILLA CANALES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'BLANCA Y JORGE'),(78123,'IVAN008','SUPERMERCADO PLACITA VERDE','CF','COLONIA MATAZANO BOCA DEL MONTE VILLA CANALES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'JUAN'),(78124,'IVAN009','BODEGONA LA ORIENTAL','CF','MATAQUESCUINTLA JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'PATY'),(78125,'IVAN010','ESPECIAS SAN FRANCISCO','CF','1 AV. 7-85 ZONA 1 NUEVA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'FRANCISCO'),(78126,'IVAN011','TIENDA LA ECONOMICA','CF','5 AV. 2-65 ZONA 3 EL GALLITO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78127,'IVAN012','ESPECIAS SEBASTIAN GONZALES','CF','INTERIOR MERCADO LA TERMINAL ZONA 4 AREA DE COMEDORES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'SEBASTIAN GONZALES'),(78128,'IVAN013','NOE JULAJU','CF','MERCADO LA TERMINAL ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'NOE'),(78129,'IVAN014','TIENDA JUANITA','CF','PUESTO 50 MERCADO BOLIVA ZONA 8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'JUANITA'),(78130,'IVAN015','DISTRIBUIDORA DIOS ES FIEL','CF','4 AV. ZONA 4 LA TERMINAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'MIGUEL'),(78131,'IVAN016','MEGA MUNDO DE A 3','CF','MERCADO 3 DE MAYO ZONA 6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78132,'IVAN017','DEPOSITO LOS REYES','CF','GALPON 12 LOCAL 45 CENMA ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78133,'IVAN018','TIENDA LA SURTIDORA','CF','MERCADO JOCOTALES CHINAUTLA GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78134,'IVAN019','DEPOSITO MARANATHA','CF','CALLE REAL 0-68 ZONA 2 SAN MIGUEL PETAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'ROSITA'),(78135,'IVAN020','TIENDA LUCY','CF','LOCAL 155 INTERIOR MERCADO SAN MIGUEL PETAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'TERECITA'),(78136,'IVAN021','ESPECIES PENIEL','CF','AREA DE COMEDORES INTERIOR MERCADO LA TERMINAL ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'RAMBO LOPIC'),(78137,'IVAN022','ORIENTAL EXPRESS','CF','GALPON 13 CENMA ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'WILLIANS'),(78138,'IVAN023','TIENDA LA BENDICION','CF','MERCADO SAN JUAN SACATEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78139,'IVAN024','OTTO BALCONI','688411-3','30 AV. 13-20 ZONA 7','2445-4483',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'RENATO BALCONI'),(78140,'IVAN025','SUPER VERDULERIA LLANO LARGO','CF','MERCADO LLANO LARGO ZONA 17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'DIEGO'),(78141,'IVAN026','MUNDO MAYA','CF','MERCADO LLANO LARGO ZONA 17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78142,'IVAN027','DISTRIBUIDORA LA COMPETIDORA','611285-4','5 CALLE 11-11 ZONA 7 QUINTA SAMAYOA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'JORGE YAQUI'),(78143,'IVAN028','TIENDA SAN MIGUEL # 2','CF','MERCADO CIUDAD QUETZAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78144,'IVAN029','CARNICERIA DON JUAN','CF','COLONIA SANTA RITA ZONA 3 DE MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'JUAN'),(78145,'IVAN030','DEPOSITO QUETZAL','CF','MERCADO CENTRAL CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'PEDRO CHUMIL'),(78146,'IVAN031','MEGA MUNDO DE A 3','CF','COLONIA SANTA FE ZONA 13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78147,'IVAN032','ESPECIAS CASTRO','9390483-5','GALPON 8 LOCAL 47 CENMA Z.12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'ALFREDO CASTRO'),(78148,'IVAN033','DISCOMER LA ECONOMICA','7787483-8','4 AV. 4-09 ZONA 21 GUAJITOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'DON PABLO'),(78149,'IVAN034','TIENDA LOS TRES REYES','CF','LOCAL 192 MERCADO NIMAJUYU ZONA 21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78150,'IVAN035','SELESTINO CORTEZ','CF','PUESTO 126 MERCADO LA PALMITA ZONA 5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'SELESTINO CORTEZ'),(78151,'IVAN036','VARIEDADES ELOHIN','CF','1 AV. 7-84 NUEVA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78152,'IVAN037','ESPECIAS CUATRO FLORES','CF','GALPON 16 CENMA ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'VICTOR TUY'),(78153,'IVAN038','VERDULERIA VERONICA','CF','MERCADO VILLA NUEVA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'VERONICA'),(78154,'IVAN039','DEPOSITO EBEN EZER','CF','2 AV. 6-75 ZONA 4 TERMINAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'CARLOS'),(78155,'IVAN040','EL RINCON DEL SABOR Y SALUD','CF','7 AV. 12-13 ZONA 9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'JEFFRY CHAN'),(78156,'IVAN041','TIENDA EL OFERTON','CF','MERCADO SANTA LUISA CHINAUTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78157,'IZAB002','GUISELA SALGUERO','1599026-5','BARRIO LAS BODEGAS LOS AMATES IZABAL','57323693',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78158,'IZAB003','RICARDO IBATE SALOJ','C/F','Frente a mercado los amates, Izabal.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78159,'IZAB004','TIENDA CAROLINA','1693930-1','C.C. Local 20 interior Mercado los Amates, Izabal.','79473916',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78160,'IZAB005','SANTIAGO ELIAS','522180-3','Interior mercado Local 31  Los Amates, Izabal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78161,'IZAB006','ILSIA ROQUE','3978685-4','Exterior Mercado Frente Terminal  Los amates, Izabal.','40756931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78162,'IZAB007','NOHEMY MORALES','980836-1','Km. 200 cruce a los Amates, Izabal.','79473007',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78163,'JAL001','TIENDA EBEN-EZER','CF','INT MERCADO LOCAL 252 JALAPA, JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78164,'JAL002','JUAN MEJIA','645008-3','JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78165,'JAL003','TIENDA LA POPULAR','495154-9','JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78166,'JAL004','ABARROTERIA LA POPULAR','180395-6','JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78167,'JAL005','DISTRIBUIDORA LUZ DE VIDA','6821641-1','JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78168,'JOC006','SPOKEN','3065944-2','BARRIO SAN LORENZO TERMINAL JOCOTAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78169,'JOC007','TIENDA LA BENDICION/SATURNINO RECINOS','1243424-8','BARRIO SAN SEBASTIAN CALLE PRINCIPAL JOCOTAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78170,'JOC009','TIENDA GARCIA/DAMIAN GARCIA','2553177-8','ENTRADA A JOCOTAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78171,'JUAN','JUAN CARLOS HERNANDEZ','CF','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78172,'JUT001',NULL,'1697063-2','BARRIO EL CENTRO MOYUTA JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78173,'JUT002','DEPOSITO LOS OLIVOS 3','5750064-4','SAN CRISTOBAL FRONTERA, JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78174,'JUT003','NOHEMY ORDOÑEZ','CF','CALLE DEL MARCADO FRENTE A DIST. ORIENTAL, JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78175,'JUT004','ADMINISTRADORA DE NEGOCIOS E INVERSIONES','2693892-8','8 AV. 3-61 ZONA 1 CHIQUIMULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78176,'JUT005','TIENDA TZUTUHIL #1','5027219-5','JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78177,'JUT006','CURIOSIDADES AGUILAR','CF','3RA. AV Y 1RA CALLE ZONA 3 EXT MERCADO JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78178,'JUT007','MIGUEL SOC','3386495-0','1RA AV. 1-57 ZONA 2 BARRIO LA ESPERANZA JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78179,'JUT008','VARIEDADES MARROQUIN','667605-7','JALPATAGUA, JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78180,'KEPIX','KEPIX CORP.','KEPIX','1607 PONCE DE LEON BLVD. SUITE 201 CORAL GABLES, FL.33134',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78181,'MAL001','DISTRIBUIDORA LA BENDICION','670119-1','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78182,'MAL003','CORPORACION DE TIENDAS, S.A.','6807974-5','6TA. CALLE 5-04 ZONA 1 MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78183,'MAL004','ABARROTERIA SAN FRANCISCO','C/F','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78184,'MAL005','TIENDA ROSITA / PEDRO LOPEZ','CF','TRAMO # 35 EXT. MDO. MPAL.# 1 MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78185,'MAL006','MARIO GOMEZ PEREZ','511950-2','EXT MERC MUNIC 1 MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78186,'MAL007','ELENA DE SANCHEZ','423803-6','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78187,'MAL008','EL CAMPESINO','520347-3','EXTERIOR MERCADO DE MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78188,'MAL009','PEDRO GOMEZ','502506-0','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78189,'MAL010','DISTRIBUIDORA PROGRESO','793916-7','4a. CALLE 2-66 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78190,'MAL011','ROMEO DE LEON','135368-3','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78191,'MAL012','CARLOS DE LEON','574276-5','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78192,'MAL013','TIENDA SAN FRANCISCO','MAL013','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78193,'MAL014','ROBERTO ILLESCAS','1743625-7','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78194,'MAL015','NORMA BARRIOS','502506-0','INTERIOR MERCADO LOCAL 82 MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78195,'MAL016','TIENDA LA PROVIDENCIA','108489-3','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78196,'MAL017','COMERCIAL LOS OLIVOS','3389119-2','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78197,'MAL018','MARIO OROZCO','MAL018','INTERIOR MERCADO DE MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78198,'MAL019','FELIPE GOMEZ','CF','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78199,'MAL020','AXEL ROSALES','688138-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78200,'MAL021','ALMACEN LA ESPERANZA','MAL021','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78201,'MAL022','RAFAEL VASQUEZ','CF','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78202,'MAL023','ABARROTERIA EL SOL','CF','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78203,'MAL024','JORGE MARIO SANCHEZ','CF','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78204,'MAL025','TIENDA SAN FRANCISCO','CF','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78205,'MAL026','GRUPO MIJANCI, S.A.','6921918-4','4Av. 3-04 MALACATAN, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78206,'MAL027','ROSA DIAZ TOMAS','CF','FRENTE INMEB EXT MDO. MPAL.MALACATAN SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78207,'MAL028','MILVIA LOPEZ','CF','EXT MDO. MPAL.MALACATAN SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78208,'MAL029','TIENDA LA ESPERANZA /HERLINDA MIRANDA','CF','EXT MDO. MPAL.MALACATAN SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78209,'MAL030','TIENDA GUZMAN /EPIFANIA GUZMAN','CF','LOCAL #150 EXT MDO. MPAL.MALACATAN SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78210,'MAL031','NORBERTO RUBEN','CF','EXT MDO. MPAL.MALACATAN SN MARCOS ESQ. INMEB',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78211,'MAL032','MERCEDES HERNANDEZ','C/F','EXT MDO MPAL MALACATAN, SAN MARCOS.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78212,'MAL033','SARA FUENTES','C/F','EXT MDO MPAL MALACATAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78213,'MAL034','ODILIA CIFUENTES','C/F','INT MDO MPAL MALACATAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78214,'MAL035','FEDERICO GOMEZ PEREZ','672926-6','EXT MDO MPAL LOCAL 158 MALACATAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78215,'MAL036','NORMA GARCIA','2577814-5','4 CALLE 4 AV ZONA 1 TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78216,'MAL037','TIENDA CHICO/FRANCISCO LOPEZ','CF','EXT MERC MUNIC MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78217,'MAL038','ADELA PEREZ VELASQUEZ','C/F','EXT. MERCADO MUNICIPAL MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78218,'MAL039','TIENDA LA ESPERANZA','C/F','MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78219,'MARKETING','MARKET INDUSTRIAL DE PRODUCTOS, S.A.','3477654-0','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78220,'MASS46CAZ12','MASS, SOCIEDAD ANONIMA','10244130-8','7a Avenida 3-74, Zona 9 Edificio 74, Nivel 5 Oficina 502','2296 0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78221,'MASS7AV.Z9','MASS, SOCIEDAD ANONIMA','10244130-8','7a Avenida 3-74, Zona 9 Edificio 74, Nivel 5 Oficina 502','2296 0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78222,'MASSABZ11PUMA','MASS, SOCIEDAD ANONIMA','10244130-8','7 Avenida 3-74 Zona 9 Edificio 74 Nivel 5 Oficina 502','2296 0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78223,'MASSAGUIBATRES','SERGIO ALVARADO','5341054-8','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78224,'MASSAMERICASZ14','SERGIO ALVARADO','5341054-8','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78225,'MASSAPTOAZ12','MATRISA, S.A.','8085136-3','7 AV. 9-60 APARTAMENTO A ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78226,'MASSCANCHONZ8','MASS, SOCIEDAD ANONIMA','10244130-8','7 Avenida 3-74 Zona 9 Edificio 74 Nivel 5 Oficina 502','2296 0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78227,'MASSCUM','RICARDO MOLINA,B','725659-0','9 av. 10-30 ZONA 11 COLONIA ROOSEVELT',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78228,'MASSEUROPLAZA','MASS, SOCIEDAD ANONIMA','10244130-8','7a Avenida 3-74, Zona 9 Edificio 74, Nivel 5 Oficina 502','2296 0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78229,'MASSHREALZ16','MASS, SOCIEDAD ANONIMA','10244130-8','7 Avenida 3-74 Zona 9 Edificio 74 Nivel 5 Oficina 502','2296 0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78230,'MASSOFICALPAZ','MASS, SOCIEDAD ANONIMA','10244130-8','7a Avenida 3-74, Zona 9 Edificio 74, Nivel 5 Oficina 502','2296 0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78231,'MASSPARQUE7','MASS, SOCIEDAD ANONIMA','10244130-8','7 Avenida 3-74 Zona 9 Edificio 74 Nivel 5 Oficina 502','2296-0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78232,'MASSTIKALFUTURA','MASS, SOCIEDAD ANONIMA','10244130-8','7a Avenida 3-74, Zona 9 Edificio 74, Nivel 5 Oficina 502','2296 0845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78233,'MASSTINCO','INVERSIONES Y NEGOCIOS GA, S.A.','10300225-1','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78234,'MASSUNICENTRO','ROMOR, S.A.','10367323-7','19 Calle 5-47 C.C. Unicentro Zona 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78235,'MAURICIO','MAURICIO PAREDES','559213-5','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78236,'MAZ001','JUAN CULAN','C-F','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78237,'MAZ002','TIENDA MARIA JOSE','628913-4','INT MERCADO MPAL. MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78238,'MAZ003','TIENDA ALCY','741069-7','MAZATENANGO MERCADO MUNICIPAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78239,'MAZ004','TIENDA LA SAMARITANA','820216-8','MAZATENANGO','78720565',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78240,'MAZ005','TIENDA LOS TRES','308404-3','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78241,'MAZ006','ANABELLA FEDERICA HERRARTE','3734808-6','MAZATENANGO, SUCHITEPEQUEZ','41335511',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78242,'MAZ007','SONIA MARIBEL PELICO LOPEZ','3977045-1','INTERIOR MERCADO MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78243,'MAZ008','EDWIN VARGAS','C/F','INTERIOR MERCADO MUNICIPAL, MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78244,'MAZ009','JUAN  YAC','CF','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78245,'MAZ010','CARNES Y EMBUTIDOS DE MAZATENANGO','470087-2','INT MERC TERMINAL MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78246,'MAZ011','GONZALO TUMIN','C/F','RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78247,'MAZ012','PEDRO XIVIR','CF','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78248,'MAZ013','ELVIA VILLATORO','CF','MERCADO MPAL. LOCAL 21 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78249,'MAZ014','MAYRA ANAI PELICO LOPEZ','6842510-4','Mazatenango.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78250,'MAZ015','TIENDA SAN JOSE','CF','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78251,'MAZ016','M MART, SOCIEDAD ANONIMA','9744366-2','Sexta Avenida \"La Libertad\" 9-29 Zona 1 Mazatenango, Suchitepequez',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78252,'MAZ017','TIENDA DORITA','288719-3','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78253,'MAZ018','SUPERTIENDA MARIOS','288469-7','INT MERC TERMINAL MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78254,'MAZ019','ALMACEN LA VICTORIA','27315-5','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78255,'MAZ020','DEPOSITO LA SORPRESA','MAZ020','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78256,'MAZ021','ISABEL RISCAJCHE','CF','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78257,'MAZ022','DIEGO DANIEL CULAN','MAZ022','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78258,'MAZ023','TIENDA FLOR CHICHICASTECA','361290-2','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78259,'MAZ024','ISABEL CULAN','CF','INT MDO LOCAL 33/34 No1 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78260,'MAZ025','TIENDA JUANITO','MAZ025','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78261,'MAZ026','ALFEVI, S.A.','CF','CALLE 30 DE JUNIO 4-25 ZONA 2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78262,'MAZ028','LEONEL SAENZ','CF','MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78263,'MAZ029','DEPOSITO EL JORDAN / ISRAEL MEJIA GARCIA','2488154-6','AV. 30 DE JUNIO 5-32 ZONA 2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78264,'MAZ030','DEPOSITO LA CORONA/ ILSY MARIELA GONZALES','4249959-3','CALLE 30 DE JUNIO 5-36 Z.2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78265,'MAZ031','DEPOSITO CONCEPCION/ CIRILA MORALES','4322368-0','CALLE 30 DE JUNIO Z.2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78266,'MAZ032','DEPOSITO EL SHADDAI /MIGUEL GONON','496113-7','10 CALLE 5-13 Z.2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78267,'MAZ033','DISTRIBUIDORA REGALO DE DIOS/ GUADALUPE ARGUETA','1705664-0','5A AV. 2-77 Z.2 BARRIO SANTA CRISTINA MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78268,'MAZ034','TIENDA EL BARQUITO/ ANA LUISA VILLAGRAN','CF','LOC. #4 INTERIOR MDO. LA TERMINAL MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78269,'MAZ035','FRANCISCA CHANCHAVAC','CF','AV. LINCOLN FRENTE A LAVICSA MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78270,'MAZ036','COMERCIAL NORMY / JOSUE GONZALES','827953-5','9A CALLE 3-06 ZONA 1 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78271,'MAZ037','COMERCIAL YOLI/ LUCIA MENDOZA','2570776-0','3A. AV. 8-90 ZONA 1 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78272,'MAZ038','TIENDA ALIZ','4915942-9','MERCADO MPAL. #1 LOCAL 36',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78273,'MAZ039','DOS R, S.A.','7646983-2','CALLE 30 DE JUNIO 4-26 Z.2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78274,'MAZ040','COMERCIAL NORMY No. 2/MARCOS GONZALES','CF','9a. CALLE 3-19 Z. 1 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78275,'MAZ041','TIENDA SUPER AB. MARIA/MARIO JOJ','842869-7','LOCAL 54 INT. MERCADO LA TERMINAL MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78276,'MAZ043','DEPOSITO EL EXITO/ANA GUARCAS','3182029-8','CALLE 30 DE JUNIO 5-10 Z 2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78277,'MAZ044','MULTISERVICIOS LA BENDICION','2251366-3','LOC 3 CENT. COMERC DON PEPE KM 157.5 MAZATE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78278,'MAZ045','DEPOSITO LA CORONA/ILSY GONZALEZ','4249959-3','AV 30 DE JUNIO 5-32 Z2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78279,'MAZ046','DEPOSITO SUPERAHORRO/GLENDA PEREZ','3889302-9','1a AVE 2-20 Z 2 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78280,'MAZ047','TIENDA FRANCISCA/FRANCISCA CHANCHAVAC','CF','AV LINCON EXT MERC TERMINAL MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78281,'MAZ048','HERLINDA DE NOLASCO / DEPOSITO JORGITO','C/F','8A CALLE 3-96 ZONA 3 CANTON LAS FLORES,MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78282,'MAZ049','ALFONZO GONON','C/F','CALLE 30 DE JUNIO 5-04 ZONA 2, MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78283,'MERCOSAL','MERCANTIL DE COMERCIO DEL SALVADOR, S.A.','CF','Calle circumbalacion #5 Col Santa Lucia Polisa Ilopango, San Salvador, El Salvador',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78284,'MODERNA','La Moderna Export, S.A.','5558877-8','1a. Avenida 6-57 Zona 3 Villa Canales  Guatemala','2422-3333',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78285,'MUNDI','MUNDI-GLOBALES, S.A.','3682679-0','KM. 14.5 CARR  A EL SALVADOR, C .EMPRESARIAL GRAN PLAZA OFIBODEGA 401',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78286,'MXATLA','OPERADORA DE TIENDAS, S.A.','737810-6','11 avenida 6-33, zona 18, colonia Atlántida,Centro Comercial Metaterminal del Norte.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78287,'MXATZUL','OPERADORA DE TIENDAS, S.A.','737810-6','Local 1 Plaza Atanasio Tzul Av. Petapa  51-57 Z.12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78288,'MXCHIM','OPERADORA DE TIENDAS','737810-6','CHIMALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78289,'MXESCU','OPERADORA DE TIENDAS, S.A.','737810-6','ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78290,'MXHUE','OPERADORA DE TIENDAS, S.A..','737810-6','HUEHUETENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78291,'MXMETA','OPERADORA DE TIENDAS, S.A.','737810-6','Calz San Juan Z 4 Mixco CC Metamercado Mixco San Juan, local 183.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78292,'MXREU','OPERADORA DE TIENDAS, S. A.','737810-6','RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78293,'MXROOS','OPERADORA DE TIENDAS, S.A.','737810-6','Calzada Roosevelt y 37 Av., zona 7. ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78294,'MXSNJO','OPERADORA DE TIENDAS','737810.6',' Km. 17.5 Carretera a San José Pinula, Centro Comercial El Faro, Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78295,'MXSNRA','OPERADORA DE TIENDAS, S.A.','737810-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78296,'MXSTELENA','OPERADORA DE TIENDAS, S.A.','737810-6','SANTA ELENA PETEN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78297,'MXSTLU','OPERADORA DE TIENDAS,S.A.','737810-6','Km 89.5 Carretera al Pacífico, Santa Lucía Cotzumalguapa, Escuintla.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78298,'MXVIHE','OPERADORA DE TIENDAS, S.A.','737810-6','SAN MIGUEL PETAPA GUATEMALA GRAN CC VILLA HERMOSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78299,'MXVINU','OPERADORA DE TIENDAS, S.A.','737810-6','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78300,'MXZACA','OPERADORA DE TIENDAS, S.A.','737810-6','ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78301,'NEW','NEW AGE TRADING CORP','.','19490 SW 156 ST MIAMI FL.33187',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78302,'P18CA','OPERADORA DE TIENDAS, S.A.','737810-6','18 CALLE 6-85 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78303,'P9AVE','OPERADORA DE TIENDAS, S.A.','737810-6','9A. AVENIDA 5-24 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78304,'P9CA','OPERADORA DE TIENDAS, S.A.','737810-6','6 CALLE 1-24 SAN LUCAS, SACATEPEQUEZ GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78305,'PAGBA','OPERADORA DE TIENDAS SA','737810-6','CALZADA AGUILAR BATRES Y 13 CALLE ZONA 11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78306,'PALSNCR','OPERADORA DE TIENDAS, S.A.  C.P.17371','737810-6','SAN CRISTOBAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78307,'PAMER','OPERADORA DE TIENDAS, S.A.','737810-6','11 CALLE 15-01 ZONA 13 C.C. GALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78308,'PASESA','PASESA, S. A.','4562767-3','MZ. ´C´ CASA 19 RESIDENCIALES VILLAS ALAMEDA','22429159   IVON',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78309,'PCAPI','OPERADORA DE TIENDAS, S.A.','737810-6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78310,'PCARR','OPERADORA DE TIENDAS, S.A.','737810-6','Km 14.1 Carr a el Salvador, Local Z, CC El Paseo de San Sebastian',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78311,'PCESPE','TIENDA LA ESPERANZA','C/F','MERCADO LA PRESIDENTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78312,'PCOAT','OPERADORA DE TIENDAS, S.A.','737810-6','3A. AV. 9-74 ZONA 2 C.C.INTERNACIONAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78313,'PCOBA','OPERADORA DE TIENDAS,   S.A.','737810-6','CC Plaza Magdalena, Local 52, Coban, Alta Verapaz',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78314,'PCSABRI','TIENDA SABRINA','C/F','MERCADO LA PRESIDENTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78315,'PCHIQ','OPERADORA DE TIENDAS, S.A.','737810-6','7A. AV. Y 3A. CALLE, ZONA 1 ESQUINA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78316,'PDC','PDC BRANDS S.A.','507308-1','Boulevard Industrial Norte No. 440 El Naranjo Zona 4 Mixco, Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78317,'PENAR','OPERADORA DE TIENDAS,  S. A.','737810-6','14 Av. Condado El Naranjo 9-20, zona 4 Mixco.','24855500',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78318,'PEPCOL','PEPCOL INTERNATIONAL FOODS / FRANCO GIOVANINI','.','14917 GWENCHRIS CT. PARAMOUNT, CALIFORNIA 90723 UNITED STATES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78319,'PESCU','OPERADORA DE TIENDAS, S.A.','737810-6','4A. AVE, NORTE 3-61 ZONA 2','889-3144',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78320,'PETRONA','PETRONA CRUZ','C/F','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78321,'PHUE','OPERADORA DE TIENDAS, S.A.','737810-6','9a. Av6-13, Z. 1 CC El Triangulo, Locales 23 y  41 Huehuetenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78322,'PJARD','OPERADORA DE TIENDAS, S.A.','737810-6','12 CALLE \"B\" 36-24 ZONA 5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78323,'PMAZA','OPERADORA DE TIENDAS, S.A.','737810-6','1A. AVENIDA 8-25 ZONA 1 MAZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78324,'PMEGA','OPERADORA DE TIENDAS, S.A.','737810-6','15 AVENIDA 16-11 ZONA 6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78325,'PMETR','OPERADORA DE TIENDAS, SA','737810-6','CALZADA AGUILAR BATRES 44-22 ZONA 11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78326,'PMONS','OPERADORA DE TIENDAS, S.A.','737810-6','LOC 90 C.C. MONTSERRAT CLZ. SAN JUAN 14-06 Z.4 DE MIXCO COL MONTE REAL GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78327,'PMONT','OPERADORA DE TIENDAS, S.A.','737810-6','12 CALLE 0-93 ZONA 9, C.C. MONTUFAR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78328,'PNOVI','OPERADORA DE TIENDAS, S.A.','737810-6','17 AVENIDA 26-75 ZONA 11 PERIFERICO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78329,'PPACI','OPERADORA DE TIENDAS S.A.','737810-6','CALZADA AGUILAR BATRES 32-00 ZONA 11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78330,'PPARR','OPERADORA DE TIENDAS, S.A.','737810-6','CALZADA JOSE MILLA Y VIDAURRE 16-80 ZONA 6, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78331,'PPETA','OPERADORA DE TIENDAS, S.A.','737810-6','AVENIDA PETAPA Y 35 CALLE ZONA 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78332,'PPRAD','OPERADORA DE TIENDAS, S.A.','737810-6','PROL. BOULEVARD LOS PROCEDERES 20 CALLE ZONA 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78333,'PPUER','OPERADORA DE TIENDAS, S.A.','737810-6','6A. AVENIDA 0-60 ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78334,'PQUET','OPERADORA DE TIENDAS','737810-6','4TA. CALLE 48-01 ZONA 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78335,'PRO001','CRUZ GOMEZ','C/F','San Agustin Acasagustlan, El Progreso','47824604',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78336,'PRO002','VENTA DE ESPECIES DOÑA PAOLA','C/F','Interior mercado San Agustin Acasagustlan el Progreso Guastatoya',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78337,'PRO003','DISTRIBUIDORA SANTA MARTA, S.A.','97481459','BARRIO EL GOLFO, GUASTATOYA, EL PROGRESO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78338,'PRO004','DISTRIBUIDORA F.V.O.','1589866-0','S. EL GOLFO GUASTATOYA EL PROGRESO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78339,'PRO005','DISTRIBUIDORA LOS MANGOS / JOSE ALBERTO','539202-0','2A. AV.0-87 Z.2 SANARATE, EL PROGRESO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78340,'PROOS','OPERADORA DE TIENDAS S.A.','737810-6','CALZADA ROOSEVELT 29-60 ZONA 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78341,'PS001','PRICESMART (GUATEMALA), S.A.','1494045-0','21 AVENIDA 7-90 ZONA 11','470  5025',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78342,'PS002','PRICESMART (GUATEMALA), S.A.','1494045-0','21 AVENIDA 7-90 ZONA 11 MIRA FLORES','279 3025-26',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78343,'PS003','PRICESMART (GUATEMALA), S.A.','1494045-0','21 AVENIDA 7-90 ZONA 11','379 4080',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78344,'PSNCR','OPERADORA DE TIENDAS S.A.','737810-6','BOULEVARD SAN CRISTOBAL ZONA 8 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78345,'PSTAME','OPERADORA DE TIENDAS, S.A.','737810-6','Boulevard Hospital Militar 13-95 Z.17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78346,'PUTAT','OPERADORA DE TIENDAS S.A.','737810-6','2A. CALLE \"A\" 32-05 ZONA 11, UTATLAN II','434 6812',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78347,'PVIHE','OPERADORA DE TIENDAS S.A.','737810-6','1A. CALLE 18-83 ZONA 15',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78348,'PXELA','OPERADORA DE TIENDAS S.A.','737810-6','4a. Calle 18-01 Z 3 CC Montblanc, Local 72 Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78349,'QLA','QUALA, S. A.','860074450-9','Carrera 68 D No. 39F-51 Sur Bogotá D.C., Colombia.','571 + 7700100',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78350,'QUE001','RODERICO MARTINEZ','143675-9','23 AV. 10-50 ZONA 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78351,'QUE002','BRYCAM, S.A','10073761-7','17 AV. 1-50 ZONA 3 QUETZALTENANGO','7763-2225/4605-5717',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'DOÑA IRMA PEREZ'),(78352,'QUE003','SUPERTIENDA XELAJU, S.A.','CF','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78353,'QUE004','DEPOSITO EL ROSARIO','5127446-9','17 AV.1-06 ZONA 3 QUETZALTENANGO','5338-8011 YOBANI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78354,'QUE005','GERONIMO DAVID PEREZ','1648609-9','17 AV. 1-56 ZONA 3 LA DEMOCRACIA QUETZALTENANGO','7765-8700',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78355,'QUE006','COMERCIALIZADORA EBEN EZER, S.A.','7550512-6','17Av. 2-19 ZONA 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78356,'QUE007',NULL,'7781938-1','17 Av. 1-41 Zona 3 Queltzaltenango.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78357,'QUE008','INDUSTRIAS MARC´S, SOCIEDAD ANONIMA','9361871-9','9 CALLE 24B-49 ZONA 7 BODEGA 13, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78358,'QUE009','FRANCISCO MEJIA PEREZ','3062482-7','17 AVE. 1-06 ZONA 3, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78359,'QUE010','OSCAR EDUARDO, DE LEON GARCIA','2052184-7','16 Av. y 1ra.Calle L.23 y 24 Callejon Richter Zona 3 Quetzaltenanago.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78360,'QUE011','BODEGA CENTRAL DE MAYOREO, S.A.','9527503-7','17 AVENIDA 1-41 ZONA 3, QUETZALTENANGO','7768-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'RUDY GONZALEZ'),(78361,'QUE012','ALMACEN ZHANG','4396885-6','Plaza la Democracia local 4-16 av. zona 3, Quetzaltenango.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78362,'QUE013','Global Distribución S.A.','5007715-5','9a. calle 24B-49 zona 7, bodega 11, Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78363,'QUE014','SUPER TIENDA PRIMAVERA','9194169-5','7a. Calle 29-88 zona 3 Local 5, Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78364,'QUE015','MARLEN ILEANA ARGUETA COJULUN','6169402-9','1 Calle 17-90 Zona 3 La Democracia, Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78365,'QUE017','SUPER TIENDA MEDALLA MILAGROSA, S.A.','6673697-8','17 AVENIDA. 0-70 ZONA 3, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78366,'QUE018','DEPOSITO LA BARATA','5373070-4','2 CALLE 19-75 ZONA 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78367,'QUE019','ISABEL ALVARADO MALDONADO','6488750-2','LA DEMOCRACIA  QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78368,'QUE020','SUPER MAYOREO BELEN, S.A.','8495277-6','1 CALLE 16 A-35 ZONA 3, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78369,'QUE021','SUPER TIENDA SAN MARTIN (JOSE R. PEREN)','CF','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78370,'QUE022','ABARROTERIA SUPER AHORRO','CF','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78371,'QUE023','TIENDA SUPER BARATA','CF','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78372,'QUE024','SURTIDORA SAN MARTIN','579776-4','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78373,'QUE025','SURTIDORA BETEL','1648609-9','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78374,'QUE026','TIENDA PRIMAVERA','CF','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78375,'QUE027','EL BUEN SAMARITANO','CF','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78376,'QUE028','TIENDA BELEN','1250711-3','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78377,'QUE029','SUPER MERCADO DELCO EL NUEVO, S.A.','4090160-2','AV LAS AMERICAS 9-50 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78378,'QUE030','TOMAS PANJOJ / TIENDA LISBETH','CF','SEC. ZAPATERIAS INT MDO MINIERVA LOCAL #13 QUETZALTENAGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78379,'QUE031','DISTRIBUIDORA EVELYN','505517-2','EXT MDO LA TERMINAL Z. 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78380,'QUE032','CORPORACION LA MERCED, S.A.','9496160-3','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78381,'QUE033','SUPERTIENDA LA BENDICION','5488992-4','16 AV. 1-53 Z.2 QUETZALTENANGO LA DEMOCRACIA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78382,'QUE034','HILDA VIOLETA PEREZ','CF','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78383,'QUE035','SUPER MERCADO XELA CENTER','2592777-9','21 AV. 7-47 ZONA 3 XELA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78384,'QUE036','TIENDA LA ESPERANZA #2','2546394-2','14 CALLE 15-30 ZONA 3 XELA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78385,'QUE037','LUIS CONCUL','CF','1 CALLE 17-96 ZONA 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78386,'QUE038','ALMA AZUCENA FLORES','4726770-4','1 CALLE 17-90 ZONA 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78387,'QUE039','CARMEN TOMASA','CF','LOCAL # 465 EXT. MDO MINERVA QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78388,'QUE040','DEPOSITO LA PRIMAVERA','C/F','INTERIOR MERCADO LA TERMINAL QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78389,'QUE041','DEPOSITO LA SALUD','C/F','1 CALLE 15-33 ZONA 3, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78390,'QUE042','ERICK MAURICIO SANCHEZ TOC','4876686-0','8a. Calle 19-13 A Zona 1 Quetzaltenango - El Calvario-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78391,'QUE043','ERICK MAURICIO SANCHEZ TOC','4876686-0','16 Av. 1-59 Zona 3 La Democracia Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78392,'QUE044','ERICK MAURICIO SANCHEZ TOC','4876686-0','C.C. Utz Ulew, Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78393,'QUE052','SURTIDORA WENDY / JORGE GOMEZ','803125-6','7A. CALLE 25 A-06 Z.3 T.MINERVA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78394,'QUE053','DEPOSITO EL MILAGRO / JOHANA BATEN','5975078-2','1A. CALLE 15 A -35 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78395,'QUE054','TIENDA MINERVA / ALLAN DE LEON','1817183-4','EXT. MDO.TERM BUSES MINERVA Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78396,'QUE055','SUPER TIENDA H.COLOMO/KORGE HERNANDEZ','1691641-7','28 AV. 7 A 24 Z.3 TERMINAL MINERVA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78397,'QUE064','TIENDA ELIO','C/F','INT. MERCADO SAN JUAN OSTUNCALCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78398,'QUE065','TIENDA FUENTES','3506500-1','1A. AV. 4-35 Z.2 SAN JUAN OSTUNCALCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78399,'QUE066','SUPERTIENDA EL CONQUISTADOR','C/F','2A. AV. 2-03 Z.1 SAN JUAN OSTUNCALCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78400,'QUE067','TIENDA TERESA / ANGEL CUYUCH','C/F','LA DEMOCRACIA CALLEJON RICHER QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78401,'QUE068','ABARROTERIA DOÑA JUANA','3881598-2','16 AV. 1-59 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78402,'QUE069','CORPORACION DE INVERSIONISTAS DE OCCIDENTE, S.A.','5958060-7','1 CALLE 16-32 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78403,'QUE070','TIENDA LA HOLANDESA','679531-5','16 AV. 1A. CALLE CALLEJON RICHCHIC L.11 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78404,'QUE071','ABARROTERIA LOS GEMELOS','5195722-1','16 AV. LOC.15A Z.3 CALLEJON RIECHES QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78405,'QUE072','EL ROSARIO','3668506-2','15 AV. 1-53 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78406,'QUE073','TIENDA EL LEON','C-F','MERCADO MINERVA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78407,'QUE074','SUPERTIENDA SAN RAFAEL','6521475-4','17 AV. 0-66 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78408,'QUE075','DISTRIBUIDORA EL TREBOL','500127-7','CALLE RODOLFO ROBLES 15-24 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78409,'QUE076','SUPER TIENDA XELAJU, S.A.','8485418-9','1A. CALLE 17-41 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78410,'QUE077','SURTIDORA BETEL','1648609-9','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78411,'QUE078','ANGEL EUGENIO RAMON MACARIO','3472313-7','Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78412,'QUE079','EFRAIN MACARIO SAQUIC','874223-5','INT. MERCADO RICTHER ZONA 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78413,'QUE080','MAURICIO QUEME','CF','17 AV.PLAZA CENTRO Z.3 LA DEMOCRACIA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78414,'QUE082','COMERCIALIZADORA DE PRODUCTOS \"LA BODEGA\"','3949813-8','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78415,'QUE083','COMERCIAL ROSY','2572311-1','OC.1-25 Z.2 SACAJA QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78416,'QUE084','DISTRIBUIDORA DIKSA, S.A.','3908276-8','22 AV. 4-39 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78417,'QUE086','TIENDA BLANQUITA / JOSEFINA AMBROSIO','630219-K','LOCAL 10 MDO. MINERVA QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78418,'QUE087','NICOLAS FIDEL','C/F','1A. CALLE 17-76 ZONA 3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78419,'QUE088','TIENDA EL SHADAY','4445188-1','16 AV. EXT. EDIFICIO RICHEWR Z-3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78420,'QUE089','MARIO RAMOS','580774-5','1A. CALLE Y 18 AV. ESQUINA Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78421,'QUE090','PATRICIA CATALAN','800374-2','INT. CC. XELA CENTRO PATRICIA CATALAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78422,'QUE091','TIENDA COLINA','CF','3a. Calle 2-10 Zona 1 San Juan Ostuncalco, Quetzo.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78423,'QUE092','ANGELA ODILIA PEREZ','CF','2da. Calle. 17 Av. Esquina Zona 3 Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78424,'QUE093','EL MILAGRO','CF','2da. Calle 16-15 Zona 3 Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78425,'QUE094','ROLANDO MACARIO','C/F','27 AV.ENTRE 4Y6 CALLE C.C. L.TERMINAL L.27 QUETZO.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78426,'QUE095','TIENDA EBEN EZER','C-F','18 AV. 1A. CALLE 0-69 Z.3 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78427,'QUE096','DEPOSITO EL PARAISO','29076-5','1 CALLE 1-18 AV.0 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78428,'QUE097','ELENA SIQUINA','3668384-1','CALLE 0 LOTE 101, 16 B -02 M.DEMOCRACIA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78429,'QUE098','ROLANDO MACARIO','C-F','27 AV.C.C. L NUEVOS #27 TERMINAL, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78430,'QUE099','ROGELIO MENDEZ','C-F','EXT. M.MINERVA TERMINAL, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78431,'QUE100','CLAUDIA GOMEZ','C/F','SAN JUAN OSTUNCALCO, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78432,'QUE101','CRISTY CARRETO','C/F','EXT. M.MINERVA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78433,'QUE102','ANIBAL RENE CHAN','3746248-2','EXTERIOR M. MINERVA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78434,'QUE103','REGINALDA GOMEZ','3438363-8','27 AV. C.C. MINERVA LOCAL #25, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78435,'QUE104','FRANCISCO JAVIER MORALES','C/F','INTERIOR M.MINERVA LOCAL # 20, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78436,'QUE105','OSEAS LUIS FUENTES','1578574-2','INTERIOR MDO TERMINAL LOCAL, #304 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78437,'QUE106','NICOLASA ARCADIA GOMEZ','4400663-2','QUETZATENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78438,'QUE107','MARCO GARRIDO','C/F','MERCADO LA DEMOCRACIA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78439,'QUE108','POLLERIA GREYS','729578-2','MECADO LA DEMOCRACIA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78440,'QUE109','DEPOSITO VIOLETA','2571404-K','MERCADO LA DEMOCRACIA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78441,'QUE110','MARTHA ALICIA MACARIO','5435426-9','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78442,'QUE111','PATRICIA RABANALES','1582070-K','8A.C.D 12-45 Z.1 ,MDO.LAS FLORES, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78443,'QUE112','ISABEL ALVARADO','6488750-2','QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78444,'QUE113','PASCUAL REY MACHIC','214126-4','1A. CALLE 17-76 Z.3, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78445,'QUE114','TIENDA LA BENDICION','C/F','17 CALLE LA DEMOCRACIA, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78446,'QUE115','-TIENDA LA ECONOMICA','CF','MERCADO LA TERMINAL, QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78447,'QUEZAL','DISTRIBUIDORA Y DEPOSITO LA QUEZALTECA, S.A.','3062888-1','1 CALLE ´B´ 20-00 ZONA 6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78448,'QUIC00','TIENDA ROGRIGO','536331-4','1A. AV.6-40 Z.1 STA. CRUZ EL QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78449,'QUIC01','CLARA LUZ PEREZ','471767-8','7 CALLE 1-18 Z.1 SANTA CRUZ EL QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78450,'QUIC010','AHORRO SUPER','3664954-6','CALLE PRINCIPAL QUICHE, QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78451,'QUIC011','TIENDA CARMENSITA','2237490-5','EXT. MDO. MPAL. QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78452,'QUIC012','TIENDA EL EXITO / MARIA MEDRANO','2237486-8','1RA.AV.EXT.4 Y  5TA. C. Z.5 L.21, EXT. MDO,QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78453,'QUIC013','ABARROTERIA DON JOSE','654619-6','C.C. MUNICIPAL, EL QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78454,'QUIC014','JOSE ENRIQUE MOTA','CF','1A. CALLE AV. 3-22 ZONA 2, QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78455,'QUIC015','DEPOSITO SAN JOSE','563009-6','6A.CALLE 0-02 Z.5 L.SUR MDO.MPAL STA, CRUZ QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78456,'QUIC016','..TIENDA LA BENDICION','2133789-6','CALLE PRINCIPAL,QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78457,'QUIC017','DEPOSITO Y TIENDA MARY','3939886-2','CANTON JACTEZAL NEBAJ, QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78458,'QUIC02','TIENDA GUADALUPANA','2237481-7','1A- AV. 5TA.Y6TA.CALLE L.44 EXT. MDO. QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78459,'QUIC03','TIENDA SANDRITA','2237481-7','1A. AV. 5TA.Y 6TA. CALLE EXT. MDO.QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78460,'QUIC04','ABARROTERIA DOÑA CONY','1758134-6','4TA. CALLE 0 AV. Z.5 SANTA CRUZ, QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78461,'QUIC05','MISCELANE LIRIO DE LOS VALLES','598480-7','CALLE PRINCIPAL SACAPULAS, QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78462,'QUIC06','ABARROTERIA CUNEN','2658447-5','CUNEN EL QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78463,'QUIC07','TIENDA HERNANDEZ','2312929-8','BARRIO SAN FRANCISCO CUNE, QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78464,'QUIC08','DISTRIBUIDORA MAJANAHIM','5054722-4','1A. AV. 8-01 Z.5 QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78465,'QUIC09','TIENDA SANTO DOMINGO','161136-6','1A .AV. 5-30 Z.5, SANTA CRUZ DEL QUICHE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78466,'RECINOS','D.R. CORPORACION, S.A.','3546563-8','3 CA. 7-83 SEC.1 C. SAN CRISTOBAL ZONA 8 MIXCO','478 4987',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78467,'REPRESA','REPRESENTACIONES SALVADOREÑAS, S.A. DE C.V.','CF','SAN SALVADOR LA LIBERTAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78468,'REU001','DELFINA TABELAN','425316-7','Sector Tabelan interior tabelan mercado la terminal, Retalhuleu.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78469,'REU002','TIENDA LA ENTRADITA','640232-1','INT. MERC. SAN NICOLAS, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78470,'REU003','NORMA MARIA ISABEL GONZALEZ IXCOT','REU003','SECTOR GARITA No.4 TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78471,'REU004','COMICEN, S.A.','3907975-9','RETALHULEU.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78472,'REU005','TIENDA \"LA ECONOMICA\"','641842-2','RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78473,'REU006','JUAN LUIS MOLINA','CF','RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78474,'REU008','TIENDA EL REGALO DE DIOS','5983800-0','RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78475,'REU009','TIENDA LA PRADERA / VILMA TEBELAN','1089758-5','INT.MDO.MPAL SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78476,'REU010','TIENDA JOSEFINA / JOSEFINA RAMOS','CF','PUESTO #14 INT.MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78477,'REU011','TIENDA RAMOS / MARINA RAMOS','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78478,'REU012','TIENDA LOS ANGELES/ VALENCIANO MENCHU','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78479,'REU013','TIENDA CORPUS/ GLORIA RAMOS','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78480,'REU014','TIENDA BETHEL / HERMELINDA ZACARIAS','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78481,'REU015','TIENDA LOLA / LOLA GONZALES','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78482,'REU016','TIENDA SAN ISIDRO/ LILIAN FLORES','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78483,'REU017','TIENDA EMMANUEL /ANA MARIA GOMEZ','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78484,'REU018','TIENDA LA BATANECA / JUANA GONZALES','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78485,'REU019','TIENDA CONCEPCION /JORGE CIPRIANO','CF','INT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78486,'REU020','TIENDA VICKY / VIRGINIA MENDEZ','CF','INT. MDO.LA TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78487,'REU021','TIENDA SAN JOSE/ MANUELA','CF','EXT. MDO.MPAL. SAN FELIPE RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78488,'REU022','TIENDA SANCHEZ /CARLOTA SANCHEZ','CF','SEC. LA PLACITA MDO. LA TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78489,'REU023','TIENDA EL NAZARENO/ ALICIA BARRIOS','CF','EXT.MDO. LA TERMINAL, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78490,'REU024','TIENDA FLOR DE LIZ/ GLORIA ALVARADO','CF','EXT.MDO. LA TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78491,'REU025','COMERCIAL LUX /NOE LUX','CF','EXT.MDO.MPAL. RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78492,'REU026','TIENDA EL BUEN PRECIO/ AUGUSTO MULUL','2907382-0','EXT.MDO. LA TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78493,'REU027','TIENDA AL AHORRO/ JULIO TORRES','1972358-K','SEC. LA PLACITA MDO. LA TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78494,'REU028','COMERCIAL MEXGUA, S.A.','4156557-6','5A 3-58 ZONA 1 RETLHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78495,'REU029','ZOILA DE LEON','4186384-4','INT. MERCADO SAN NICOLAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78496,'REU030','ABRAHAM TUMIN','CF','INTERIOR MERCADO SAN NICOLAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78497,'REU031','VILMA COCHAJIL','CF','INTERIOR MERCADO SAN NICOLAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78498,'REU032','EDGAR ESCOBAR','CF','6 AV. 10-16 ZONA 1 RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78499,'REU033','TIENDA OLGUITA/ROSALINDA GOMEZ','736108-4','LOCAL 25 EXT MERC. MUNICIPAL SAN FELIPE REU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78500,'REU034','TIENDA LA PREDILECTA','585462-8','EXT MERC MUNICIPAL SAN FELIPE REU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78501,'REU035','TIENDA LA PREFERIDA/MIGUEL CASTRO','210983-2','EXT MERC MUNICIPAL SAN FELIPE REU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78502,'REU036','DISTRIBUIDORA MINECY/ERLA DE MINERA','4769321-5','LOC 19 EXT MERC TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78503,'REU037','TIENDA LUCERITO/INGRID ORDOÑEZ','CF','LOC 218 SEC PLACITA MERC TERMINAL REU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78504,'REU038','TIENDA LA PRADERA/VILMA TABELAN','CF','INT MERC MUN SAN FELIPE REU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78505,'REU039','RIGOBERTO ESTEBAN','989348-2','5A CALLE 1-08 Z 3 SAN FELIPE REU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78506,'REU040','TIENDA LA ECONOMICA/HECTOR VICENTE','CF','INT MERC MUN SAN FELIPE REU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78507,'REU041','DISTRIBUIDORA ISRAEL/EBER JOSUE RAMIREZ','1392305-6','1A. AV.4-98 Z.4 RETALHULEU SALIDA A CHAMPERICO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78508,'REU044','TIENDA LA NUEVA / MARIA GONZALEZ','3039619-4','SEC. GARITA 4 TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78509,'REU045','TIENDA EL MARCHANTE / LUCIA TUMIN','626240-6','INTERIOR MDO. TERMINAL DE BUSES RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78510,'REU047','TIENDA Y DEPOSITO S.BARTOLO/ELVIA PEREZ','679992-2','EXT. MDO.TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78511,'REU049','TIENDA NUEVA ESPERANZA / ROLANDO MEJIA','1762705-2','EXT. MDO.TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78512,'REU050','DISTRIBUIDORA LOPEZ/ ODILIA LOPEZ','C/F','EXT. MDO. TERMINAL RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78513,'REU051','TIENDA ANGELA','C/F','INT. MDO.SEC.TABALAN RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78514,'REU052','DEPOSITO ROSALES','C/F','SECT. TABALAN RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78515,'REU053','ANA MARIA GOMEZ','CF','INT. MDO. MUNICIPAL SAN FELIPE, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78516,'REU054','TIENDA RAMOS','CF','INT. MDO. SAN FELIPE, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78517,'REU055','LILIAN FLORES','3380100-2','INT. MDO. SAN FELIPE, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78518,'REU056','TIENDA CONCEPCION','CF','INT. MDO. MPAL SAN FELIPE, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78519,'REU057','ESPIGA DE ORO','CF','INT. MDO. SAN FELIPE, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78520,'REU058','TIENDA KARLITA','210960-5','SECTOR MANGALES CAMPO FERIA, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78521,'REU059','NUEVO AMANECER','CF','EXT.MDO.TERMINAL SEC.MAIZ, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78522,'REU060','SUPER TIENDA NUEVA JERUSALEN','CF','INT. MDO. SAN FELIPE, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78523,'REU061','MARCO TULIO LOPEZ','4502354-9','SECT- TABLAS EXT.MDO. TERMINAL, RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78524,'RUTEO LOCAL INST.','ALEX PAREDES','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78525,'SAL001','SUPERMERCADOS GLORIA, SOCIEDAD ANONIMA','','17 CALLE \"A\" 31-64 ZONA 7 RESIDENCIAL VILLA LINDA 3, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78526,'SAL002','HENRY DIAZ GONZALEZ','','ALDEA LAS CAÑAS VIEJAS SAN JERONIMO, SALAMA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78527,'SAL003','SUPER MERCADO LA PLAZUELA','','3a. CALLE 3-25 ZONA 1 SALAMÁ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78528,'SAMYANG','MAPRIVA, S. A.','','2a. AVE. 3-04, ZONA 13, GUATEMALA.','53037849',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78529,'SAR001','TIENDA Y MARRANERIA EL COCHE CONTENTO','','INT MERC MUN 2 CHIQUIMULILLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78530,'SAR002','FERNANDO LAU/ALMACEN CHAN','','ZONA CENTRAL CHIQUIMULILLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78531,'SAS001','TIENDA JUAN CARLOS','','INT. MERC MUNICIPAL 1 LOC 97 SAN ANTONIO SUCH.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78532,'SAS002','TIENDA VICKY','','INT. MERC. MUNICIPAL 1 L 59 SAN ANTONIO SUCH.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78533,'SAS003','TIENDA LINDSEY','','INT. MERC. MUNICIPAL 1 L 77 SAN ANTONIO SUCH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78534,'SAS004','TIENDA BUENA ESPERANZA','','2a. AV Z 1 EXT. MERC. MUNICIPAL 1 SAN ANTONIO S.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78535,'SAS005','DEPOSITO LA CASCADA','','EXT MERC MUNICIPAL 1 SAN ANTONIO SUCH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78536,'SAS006','TIENDA ALEX','','LOC # 7Y 8 INT.MDO.MPAL #2 SAN ANTONIO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78537,'SAS007','TIENDA GONZALES','','2DA. ENTRADA MDO.MPAL.#2 SAN ANTONIO SUCHI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78538,'SAS008','TIENDA ROSIBEL /ROSA SUHUL','','LOC. #28 MDO.MPAL.#3 SAN ANTONIO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78539,'SAS009','TIENDA LA SEVILLANA/ JOSE ANTONIO CHOCOJ','','LOC#27 MDO.MPAL.#3 SAN ANTONIO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78540,'SAS010','TIENDA KEYLITA/ GENARO TACAIN','','LOC# 8 EXT.MDO.MPAL.# 3 SAN ANTONIO SUCHI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78541,'SATEX','SATEX AGENCIES N.V.','','SPORTLAND 11 P.O. BOX 3448 CURACAO, NETHERLANDS  ANTILLES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78542,'SAVE ALOT','Directores Estratégicos, S.A.','','10a Avenida 18-58 Zona 4, Pasaje Naranjo Local 33 Mixco, Guatemala.','2378-2201 6669-0974',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78543,'SBS','CRISTINA MERLOS','','KM 155.5 ESTACION SCOTT 77 SAN BERNARDINO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78544,'SIMON','PASTELERIA SIMON','','12 CALLE 5-34 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78545,'SIRACUSA','INVERSIONES SIRACUSA, SRL','','Prot.27 de Febrero No1515 Santo Domingo, Republica Dominicana',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78546,'SLU001','TIENDA FLOR DE OCCIDENTE','','Interior Mercado Central Santa Lucia Cotzumalguapa.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78547,'SLU002','TIENDA EMMANUEL','','INT. MERC. No. 1  LOC. 85 STA. LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78548,'SLU003','GABRIEL BATZ','','SANTA. LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78549,'SLU004','TIENDA EL ESFUERZO','','SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78550,'SLU005','FRANCISCO MAZARIEGOS','','4AV. 6-118 Z.1 SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78551,'SLU006','TIENDA TIKAL','','4 AV. 6-99 SANTA LUCIA COTZ.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78552,'SLU007','TIENDA SAN LUIS','','5 AV. 6-110 A Z.1 SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78553,'SLU008','MIGUEL ANGEL MARROQUIN','','5TA. AVE. 6-40 ZONA 1 SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78554,'SLU009','MANUEL SAQUIC','','SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78555,'SLU010','TIENDA PERSY','','SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78556,'SLU011','TIENDA MAYA','','SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78557,'SLU012','TIENDA SAN PEDRANA','','4 AVE. 3-7 ZONA 1 SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78558,'SLU013','ERICK ROLANDO MARROQUIN OCHOA','','6A. CALLE 5-81 TERMINAL SE BUSES STA. LUCIA COTZ.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78559,'SLU014','MANUEL AC MORALES','','SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78560,'SLU015','ABARROTERIA SAN JOSE','','SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78561,'SLU016','MARIA OLIVIA REYES','','SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78562,'SLU017','ROSA PEREZ','','SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78563,'SLU018','BLANCA LILY OCHOA/ ABARROTERIA LILY','','3 AVE 5-115 ZONA 1 SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78564,'SLU019','CLAUDIA LILI MARROQUIN OCHOA','','LA DEMOCRACIA ESCUINTLA.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78565,'SLU020','CORPORACION MOFA, S.A.','','3a. Calle 5-27 Zona 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78566,'SNMA001','JOAQUINA CANCINOS','','CALLE REAL SN RAFAEL PIE DE LA CUESTA, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78567,'SNMA002','TIENDA KARIVIVI/ FREDYCHACLAN','','INT MDO. MPAL. SN RAFAEL PIE DE LA CUESTA, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78568,'SNMA003','TIENDA GLADIS/GLADIS MARTINEZ','','INT. MDO. MPAL. SN RAFAEL PIE DE LA CUESTA SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78569,'SNMA004','TIENDA NORMA/ MARIO CORDOVA','','CALLE PRINCIPAL FRENTE MDO MPAL SN RAFAEL P DE LA CUESTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78570,'SNMA005','TIENDA LA ENTRADITA/','','CALLE PRINCIPAL FT. MDO MPAL SN RAFAEL PIE DE LA CUESTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78571,'SNMA006','MONICA LOPEZ','','SAN PEDRO, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78572,'SNMA007','ALMACEN OSORIO/ ISMAEL OSORIO','','CALLE PRINCIPAL SN RAFAEL PIE DE LA CUESTA SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78573,'SNMA008','TIENDA JONATHAN/ GEOVANY RAMIREZ','','CALLE REAL SAN RAFAEL PIE DE LA CUESTA, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78574,'SNMA009','TIENDA OSORIO/ ANTONIO OSORIO','','INT MDO. MPAL. SAN PABLO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78575,'SNMA010','JUAN ARTURO ESCOBAR','','INT.MDO.MPAL SN RAFAEL PIE DE LA CUESTA SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78576,'SNMA011','EFRAIN OROZCO','','INT.MDO.MPAL SAN PABLO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78577,'SNMA012','TIENDA OSORIO/ SAMUEL OSORIO','','INT.MDO. MPAL.SAN PABLO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78578,'SNMA013','TIENDA LA BENDICION/ PAUL DE LEON','','CALLE PRINCIPAL, CATARINA SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78579,'SNMA014','CARIDAD BRAVO','','CALLE PRINCIPAL, CATARINA SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78580,'SNMA017','ELADIO TEMA','','INT MDO. MPAL EL RODEO, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78581,'SNMA018','MELVA LOPEZ','','INT MDO MPAL EL RODEO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78582,'SNMA019','AMADO RODAS','','EXT. MDO MPAL EL RODEO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78583,'SNMA020','TORIBIO SANCHEZ','','INT MDO, MPAL SAN PABLO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78584,'SNMA021','ILSE DE MIRANDA','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78585,'SNMA022','TERESA LOPEZ','','EXT MDO MPAL SAN PABLO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78586,'SNMA023','TIENDA MARROQUIN/SONIA OSORIO','','CANTON SN ANDRES SAN RAFAEL PIE DE LA CUESTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78587,'SNMA024','TIENDA OSORIO/ISMAEL GASPAR','','CALLE PRINCIPAL SAN RAFAEL PIE DE LA CUESTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78588,'SNMA025','TIENDA ROSITA/ISMAEL SALVADOR','','INT MERC MUNIC EL RODEO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78589,'SPC001','ESTELA TZALAM','','CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78590,'SPC002','SUPER TIENDA LA INDIA','','SAN PEDRO CARCHA, COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78591,'SPC003','FROILAN BARRIENTOS COY','','7 AV. 3-00 ZONA 5 SAN PEDRO CARCHA, COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78592,'SPC004','COMERCIAL SAN PABLO','','SAN PEDRO CARCHA, COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78593,'SPC005','ABARROTERIA SAN JOSE','','SAN PEDRO CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78594,'SPC006','CESAR BELTETON','','COBAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78595,'SPC008','WALTER ESTUARDO SAJCHE HUITZ','','SAN PEDRO CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78596,'SPC009','CONSUELO DE POP','','SAN PEDRO CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78597,'SPC010','JUAN JOSE POP CHAMAN','','CARCHA 11 AV. 6.51 ZONA 1 BARRIO SAN PEDRO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78598,'SPC011','LUNITAS, S.A.','','5ta. calle 11-35 Zona 1 Carcha, Alta Verapaz',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78599,'SPC020','DEPOSITO SAN MIGUEL','','SAN PEDRO CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78600,'SPC021','HECTOR XOL','','4 CALLE 9-47 ZONA 1 CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78601,'SPC022','JULIAN QUINILLO','','CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78602,'SPC023','DISTRIBUIDORA COMERCIAL YASMIN, S.A.','','4 Calle 8-78 zona ,1 Carcha',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78603,'SPC024','MINI MERCADO SANTIAGUITO','','CARCHA COBAN.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78604,'SPC025','GERARDO CHON TIPOL','','11 AV. 6-49 ZONA 1 SAN PEDRO CARCHA, ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78605,'SPC026','DISTRIBUIDORA ROBERTH','','CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78606,'SPC027','DEPOSITO THELMITA','','4 CALLE 8-42 ZONA 1 SAN PEDRO, CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78607,'SPS001','MICELANEA GABY','','4 calle 7-56 zona 1 San Pedro, San Marcos',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78608,'SPS002','TIENDA NOEMI','','SAN PEDRO, SAN MARCOS','7760-1833',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'PEDRO CIFUENTES - CENTRO COMERCIAL No. 1 LOCA'),(78609,'SPS003','DEPOSITO VELASQUEZ','','SAN PEDRO, SAN MARCOS','7760-1176',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'ARACELY VELASQUEZ'),(78610,'SPS004','ABARROTERIA LA BARATA','','7A. AVE. 4-13 ZONA 1, SAN PEDRO SAN MARCOS','7760-2174',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'EDY BRAVO'),(78611,'SPS005','DEPOSITO SAN PEDRITO','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78612,'SPS006','MOLINO FENIX, S.A.','','7A. AVE. 3-20 ZONA 1, SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78613,'SPS007','LAURA GODINEZ','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78614,'SPS008','DEPOSITO AVE FENIX / SILVIA BARRIENTOS','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78615,'SPS009','DEPOSITO DOÑA AURORA','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78616,'SPS010','ANA TOSHYKO BARRIENTOS FONG','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78617,'SPS011','HAIRO RENE VELASQUEZ','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78618,'SPS012','MOLINO FENIX, S.A.','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78619,'SPS013','RUDY BARRIOS DE LEON / DEPOSITO LA BENDICION','','2 CALLE ´C´ 1-10 Z.3, NVO. TERMINAL EL MOSQUITO SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78620,'SPS014','MINI MERCADO SANTA TERESITA.','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78621,'SPS015','LUIS BARRIENTOS','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78622,'SPS016','SUPERMARQ, S.A.','','5 AV 9-71 ZONA 1 SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78623,'SPS017','MINI MERCADO SANTA TERESA S.P','','4TA. CALLE 6-55 Z.1SAN PEDRO SAC. SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78624,'SPS018','MARVIN SAJCHE','','CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78625,'SPS019','DEPOSITO LA BENDICION','','2 AV ´C´1-10 ZONA 3 CANTON EL MOSQUITO NVA.TERMINAL SN PEDRO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78626,'SPS020','BASILIO TEMAJ','','PLAZA CONCEPCION TUTUAPA, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78627,'SPS021','ABARROTERIA SU FAVORITA','','2A. CALLE 1-67 Z.3 EL MOSQUITO SAN PEDRO, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78628,'SPS022','GERARDO BATEN','','TERMINAL EL MOSQUITO SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78629,'SPS023','TIENDA JERUSALEM','','2A. CALLE  1-67 Z.3 EL MOSQUITO SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78630,'SPS024','TIENDA ECONOMICA / ANTONIA AGUILAR','','2A. Z.3 TERMINL EL MOSQUITO SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78631,'SPS025','TIENDA JULISA / ESMERALDA GODINEZ','','TERMINAL EL MOSQUITO SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78632,'SPS026','ABARROTERIA LA ESQUINA','','MERC. TERMINAL EL MOSQUITO SAN PEDRO SA, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78633,'SPS027','TIENDA LEO','','2DA. CALLE C Z.3 SAN PEDRO SAC, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78634,'SPS028','ABARROTERIA LA CHINITA','','NUEVA TERMINAL EL MOSQUITO SAN PEDRO SAC.SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78635,'SPS029','ABARROTERIA Y DEPOSITO VEROS M.J./ SELVIN JOCOL','','4A CALLE 7-57 Z.1 CANTON LA PARROQUIA SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78636,'SPS030','ABARROTERIA LA CHINITA / GLORIA OROZCO','','2A. CALLE Z.3 TERM.EL MOSQUITO SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78637,'SPS031','ABARROTERIA LIRIO / MARIAN XILOJ','','3A. AVE. 2-25 EL MOSQUITO SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78638,'SPS032','DEPOSITO EVELIN','','6A. AV. 4-29 Z.1 SAN PEDRO SACATEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78639,'SPS033','DEPOSITO EL TRIUNFO','','6ta. Av. 5-47 zona 1, San Pedro Sac, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78640,'SPS034','OLGA LETICIA ANDRADE','','SAN PEDRO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78641,'SPS035','ABARROTERIA PROGRESO','','2 CALLE 6-19 Z.1 SAN PEDRO SAC, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78642,'SPS036','ABARROTERIA MARINITA','','CC.2 LOCAL 6 SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78643,'SPS037','OBDULIO VELASQUEZ','','SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78644,'SPS038','.DEPOSITO EL TRIUNFO','','8 A. AV. 5-47 Z.1 SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78645,'SPS039','MINI ABARROTERIA FLORESITA','','2 AV. C 1-30 SAN PEDRO SAC, TERMINAL MOSQUITO, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78646,'SPS041','ABARROTERIA EL CENTRO','','7A. AV. 4-13 Z.1 SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78647,'SPS042','COMERCIAL GOMEZ','','3 CALLE 6-46 Z.1 SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78648,'SPS043','COMERCIALIZADORA EL PUEBLITO','','2DA. CALLE 6-21 Z.1 SAN PEDRO SAC, SM.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78649,'SPS044','ROSSEL MAGALI OROZCO','','SAN PEDRO SAC, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78650,'SPS045','ABARROTERIA SINAI','','2 C.A 3-22 Z.3 SAN PEDRO SAC.TERMINAL,EL MOSQUITO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78651,'SPS047','TIENDA JUANITA','','LOCAL 42 INT. MERCADO SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78652,'SPS048','GUALDER VELASQUEZ','','2DA. C. 1-24 Z. 2 SAN PEDRO SAC, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78653,'SPS049','DEPOSITO MI GRANJITA','','4TA. C. 3-45 Z.1 SAN PEDRO SAC, SAN MARCOS','51634920',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78654,'SPS050','COMERCIALIZADORA DE PRODUCTOS LA BODEGA','','7 Ave. A  2-15 Zona 1 San Pedro San Marcos.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78655,'SPS051','ALEJANDRO JUAREZ','','SAN PEDRO S.M. EL MOSQUITO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'CELIA SANCHEZ'),(78656,'SPS052','DEPOSITO SHALON','','8 AV. 3-45 ZONA 1 SAN PEDRO, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78657,'SSU001','TIENDA CARMEN JULIA /RODRIGO DOMINGUEZ','','INT MDO. MPAL#1 LOC.#6 SAN ANTONIO SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78658,'SSU002','TIENDA SUSY/EVELIN ORTIZ','','INT.MDO.MPAL #1 SAN ANTONIO SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78659,'SSU003','TIENDA MARQUENSE/AMERICO MIRANDA','','INT.MDO.MPAL.#1 LOCAL #86 SAN ANTONIO SUCHI.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78660,'STARO001','TIENDA EL AHORRO','','BARRIO EL CENTRO SANTA CRUZ NARANJO SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78661,'STARO002','GEOVANNY LUX','','SANTA CRUZ NARANJO CUILAPA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78662,'STARO003','MEGA PROMOTODO A 3.00','','1RA AV. 7-036 ZONA 1 NVA. SANTA ROSA,SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78663,'STARO004','CESAR AUGUSTO MONZON GARCIA','','RANCHON SAN JORGE SANTA ROSA DE LIMA, SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78664,'STARO005','TIENDA EL AHORRO','','CUILAPA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78665,'STARO006','TIENDA SANTA ELENA','','MERC PROVISIONAL STA CRUZ NARANJO CUILAPA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78666,'STARO007','DEPOSITO LA BARATA','','INT MERC #2 CHIQUIMULILLA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78667,'STARO008','TIENDA FLOR DE OCCIDENTE','','TAXISCO SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78668,'STARO009','FRANCISCA DE LA CRUZ PABLO','','Exterior del Mercado N.2 Esquina, Chiquimulilla Santa Rosa.','50817029',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78669,'STARO010','VICTORIANO JULAJUJ','','Terminal de Buses Chiquimulilla, Santa Rosa','50986675',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78670,'STARO011','OSCAR MORALES','','Terminal de Buses Chiquimulilla, Santa Rosa.','57406720',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78671,'STARO012','MARIANO CHOPEN','','Exterior Mercado N.2  2a.Av. Z.2, Chiquimulilla Santa Rosa.','49964749',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78672,'STARO013','VICTORIA COSIGUA COSIGUA','','Exterior Mercado N.2 Local 86, Chiquimulilla Santa Rosa.','56891912',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78673,'SUCH001','SUPER MERCADO LA LLAVE','','4 CALLE MERCADO MUNICIPAL ZONA 1 CHICACAO, SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78674,'SUCH002','FRANGIL MEJIA','','5TA  AV. CIRCUNVALACION ZONA 1 CUYOTENANGO, SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78675,'SUCH003','TIENDA VILMA /CATARINA HERNANDEZ','','LOC# 123INT.MDO.MPAL. STO TOMAS LA UNION , SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78676,'SUCH004','TIENDA KATY/ SEBASTIANA PAZ','','LOC# 137INT.MDO.MPAL. STO TOMAS LA UNION,SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78677,'SUCH005','TIENDA ROSY / JOSEFINA SALAS','','LOC# 110INT.MDO.MPAL. STO TOMAS LA UNION,SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78678,'SUCH006','TIENDA ESQUIPULAS/JUANA POP','','INT.MDO.MPAL SAMAYAC SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78679,'SUCH007','TIENDA PAULINA /PAULINA GARCIA','','INT.MDO.MPAL SAMAYAC SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78680,'SUCH008','PETRONA SIAN','','INT.MDO.MPAL SAMAYAC SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78681,'SUCH009','TIENDA LA POPULAR/ MARIO AVILA','','CANTON EL CALVARIOINT.SAMAYAC SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78682,'SUCH010','PETRONA ISABEL SIAN','','INT.MDO.MPAL SAMAYAC SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78683,'SUCH011','TIENDA MARIA´S/MARIA PEREZ HERNANDEZ','','2CALLE 2-34 Z.1 SN FRANCISCO SAPOTITLAN SUCHI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78684,'SUCH012','TIENDA EL QUETZAL /MANUEL CHACOJ','','INT MDO. MPAL LOCAL 113 STO TOMAS LA UNION SUCHI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78685,'SUCH020','TIENDA FLOR DE MARIA/VICENTA CASTRO','','EXT MERCADO MUNICIPAL CUYOTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78686,'SUCH021','TIENDA EBEN EZER/SAMUEL CUMES','','5a. CALLE 6a. AVENIDA Z.1 SAMAYAC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78687,'SUCH022','TIENDA WENDY/VILMA DE LEON','','LOC 129 INT MERC MUNIC SANTO TOMAS LA UNION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78688,'SUCH023','TIENDA LUX/PAULA CANASTU','','1a.AV 2a CALLE Z 1 STO TOMAS LA UNION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78689,'SUCH024','COMERCIAL JUAN GABRIEL/MAGDALENA HERNANDEZ','','2a AV 2-43 Z 1 STO TOMAS LA UNION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78690,'SUCH025','TIENDA DARLIN/CRISTINA GARCIA','','LOC 130 INT MERC MUNIC STO TOMAS LA UNION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78691,'SUCH026','TIENDA MILVIA/GLORIA MIS','','LOC 139 INT MERC MUNIC STO TOMAS LA UNION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78692,'SUCH027','TIENDA LA FAVORITA/ALICIA GARCIA','','LOC 74 INT MERC MUNICIP CHICACAO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78693,'SUCH028','TIENDA MENDEZ/MIGUEL LUX','','LOC 133 INT MERC MUNIC CHICACAO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78694,'SUCH029','TIENDA LA FAVORITA/DAVID MEJIA','','LOC 59 INT MERC MUNIC CHICACAO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78695,'SUCH030','TIENDA ALICIA/ISABEL SACALXOT','','INT MERC MUN SAN ANTONIO SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78696,'SUCH031','TIENDA SAMARIA/PETRONA ISABEL SIAN','','INT MERC MUNICIPAL SAMAYAC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78697,'SUCH032','TIENDA LA PUERTA DEL SOL/RAMONA CAP','','INT MERC MUN TRAMO 13 Y 14 CUYOTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78698,'SUCH033','HECTOR ENRIQUE DUBON CARRILLO','','CIUDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78699,'T20CA','UNISUPER, S.A.','','20 CALLE 08-47 ZONA 10, GUATEMALA, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78700,'TAMATES','UNISUPER, S.A.','','PLAZA LOS AMATES KM 200 RUTA AL ATLANTICO, LOS AMATES, IZABAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78701,'TARRAZOLA','UNISUPER, S.A.','','AV. 1-128 Z.1 ALDEA DON JUSTO KM 16.5 LO DE DIEGUEZ, CC. PLAZA ARRAZOLA, FRAIJANES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78702,'TCARCHA','UNISUPER, S.A.','','7A CALLE BARRIO SAN SEBASTIAN, SAN PEDRO CARCHA,ALTAVERAPAZ, C.C.GRAN CARCHA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78703,'TEC001','PEDRO PAZ CARDONA','','TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78704,'TEC002','DISTRIBUIDORA GENESIS','','TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78705,'TEC003','SUPER TIENDA LA BENDICION DE DIOS','','EXTERIOR MERCADO MUNICIPAL TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78706,'TEC004','NEGOCIOS EN CRECIMIENTO, LA BENDICION DE DIOS, S.A.','','6AV. ENTRE 4 Y 5TA CALLE Z. 1 TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78707,'TEC005','COMERCIAL LOS HERMANOS, S.A.','','TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78708,'TEC006','JUANA MERCEDES CHANCHAVAC ZAPETA','','INT MDO. MPAL TECUN UMAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78709,'TEC007','GLORIA RAMIREZ','','INT MDO MPAL LOC. 89, 90 Y 91 TECUN UMAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78710,'TEC008','TIENDA EL EDEN / CUPERTINA GOMERO','','INT MDO MPAL  TECUN UMAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78711,'TEC009','TIENDA ELIZABETH / ELIZABETH VICENTE','','INT MDO MPAL  TECUN UMAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78712,'TEC010','TIENDA CANAAN /ELMA OROZCO','','INT MDO MPAL  TECUN UMAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78713,'TEC011','PEDRO PAZ CARDONA','','INT MDO MPAL  TECUN UMAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78714,'TEC012','AUGUSTO VELASQUEZ','','INT MDO MPAL  TECUN UMAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78715,'TEC013','DEPOSITO ZIZA / ROBERTO RABANALES','','4 CALLE 4-36 ZONA 1 TECUN UMAN SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78716,'TEC014','TIENDA ELY / ELIDA DE LEON','','INT MDO MAPL LOCALES, TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78717,'TEC015','LUIS NOLASKO','','INT MDO MPAL TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78718,'TEC016','.TIENDA ELIZABETH','','MERCADO INT. TECUN UMAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78719,'TFRAI','UNISUPER, S.A.','','KM 19.5 CARR A FRAIJANES C.C. PLAZA FRAIJANES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78720,'TJALA2','UNISUPER, S.A.','','C C SN FRANCISCO 1A CALLLE Y 2DA AV ¨A¨ ZONA 2 JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78721,'TJOCO','UNISUPER,S.A.','','Calle a San Felipe Z4 finca Lizardi,CC Plaza Jocotenango ancla 1,Jocotenango,Sacatepequez',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78722,'TONANTEL','INVERSIONES TONANTEL, S.A.','','TONANTEL KM 54 CARR A EL SALVADOR, BARBERENA, SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78723,'TONANTEL2','INVERSIONES TONANTEL, S.A.','','7ma calle 1-35 zona 1, Nueva Santa Rosa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78724,'TOT001','DEPOSITO MARLEN','','10A. AVE. Y 6TA. CALLE ZONA 3 TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78725,'TOT002','DEPOSITO SAN GERMAN, S.A.','','5 CALLE 10 Y 11 ZONA 3 TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78726,'TOT003','TIENDA EL EDEN','','10 AVE. 6-50 ZONA 3 TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78727,'TOT005','DEPOSITO EL CUBANITO','','TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78728,'TOT006','TIENDA LA MOMOSTECA/LUIS HERNANDEZ','','6 CALLE LOCAL #8 NVO. MDO. MPAL TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78729,'TOT007','ABARROTERIA EMMANUEL/ANGELICA GARCIA','','10AV. Y 6 CALLE Z 3 TOTONICAPAN EXT MDO NVO.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78730,'TOT008','TIENDA FUENTE DE AGUA VIVA','','10 AV. 6-20 Z 3 LOCAL #3 TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78731,'TOT009','TIENDA LA TIENDONA/ PEDRO CHUC','','10 AV 8-25 Z.3 TOTONICAPAN SALIDA AL RASTRO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78732,'TOT010','SURTI HOGAR / MIGUEL GUTIERREZ','','10 AV Y 8 CALLE Z.3 TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78733,'TOT011','TIENDA LA SURTIDORA','','5 CALLE 11-33 ZONA 3 TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78734,'TOT012','LUIS HERNANDEZ','','6 CALLE LOC. # 8 ZONA 3 NUEVO MERCADO TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78735,'TOT013','ANGELICA GARCIA','','6 CALLE LOC. # 7 NUEVO MERCADO ZONA 3 TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78736,'TOT014','SUPER TIENDA LOS ANDES','','TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78737,'TOT015','PASCUALA TZIC','','TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78738,'TOT016','RODRIGO JUAN XURUC','','5 TA. CALLE EL MIRADOR ALDEA NIMASEJ TOTONICAPAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78739,'TPANA','UNISUPER, S.A.','','VIA PRINCIPAL 3-56 ZONA 2, PANAJACHEL, SOLOLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78740,'TPETA','UNISUPER, S. A.','','C.Real 8-00 zona 10, Col. Sta.Teresita Sn M.Petapa.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78741,'TPORTALES','UNISUPER, S.A.','','CARR. CA-9 RUTA NORTE AL ATLANTICO, 3-20 ZONA 17 C.C. PORTALES GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78742,'TPSJ','UNISUPER, S. A.','','Local 6 Puerto San José, Escuintla',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78743,'TRADIAL','UNISUPER, S.A.','','Km 18.5 Carretera Villa Canales, Centro Comercial Distrito Moran',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78744,'TRODEO','UNISUPER,S.A.','','Calzada San Juan 35-62 Zona 7 Colonia el Rodeo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78745,'TSANISIDRO','UNISUPER, S.A.','','Diagonal 34 Calle Real Acatan, 17-10 Zona 16, Colonia Jardines de San Isidro',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78746,'TSANJUAN','UNISUPER, S.A.','','Calzada San Juan 21-14 zona 7, Col. Kaminal Juyu I C.C. Centro 21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78747,'TSANNICO','UNISUPER,S.A.','','23 AV 11-55 COLONIA EL NARANJO C.C. ARBORETO SAN NICOLAS LOCAL 100 MIXCO, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78748,'TUM001','ARMANDO SANTIZO','','CALLE REAL DEL COMERCIO, EL TUMBADOR SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78749,'TUM002','TIENDA PAOLA /VINICIO GONZALES','','INT MDO. PROVISIONAL EL TUMBADOR, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78750,'TUM003','TIENDA MATIAS /SILVIA MATIAS','','INT. MDO. PROVISIONAL, EL TUMBADOR, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78751,'TUM004','TIENDA BLANQUITA/ BLANCA JERONIMO','','INT. MDO. PROVISIONAL, EL TUMBADOR, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78752,'TUM005','FERNANDO ANIBAL CUYUCH','','INT. MDO. PROVISIONAL, EL TUMBADOR, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78753,'TUM006','TIENDA COMITAN/ CLAUDIO PEREZ','','INT. MDO. PROVISIONAL, EL TUMBADOR, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78754,'TUM007','TIENDA ARELY / LUCY JERONIMO','','INT. MDO. PROVISIONAL, EL TUMBADOR, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78755,'TUM008','TIENDA SAN ANTONIO /BERENA RAMIREZ','','CALLE REAL DEL COMERCIO,  EL TUMBADOR, SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78756,'TUM009','TIENDA JOHANITA /ALEJANDRO RAMIREZ','','CALLE REAL DE COMERCIO, EL TUMBADOR SN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78757,'TUM010','LUCY JERONIMO','','INT MDO PROVISIONAL, EL TUMBADOR, SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78758,'TUM011','KARLA JUAREZ','','CALLE REAL DEL COMERCIO EL TUMBADOR, SAN MARCOS.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78759,'TUM012','DEPOSITO PEREZ/TITO AMILTON','','CALLE REAL DEL COMERCIO TUMBADOR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78760,'TUM013','TIENDA RAMIREZ/NICOLAS RAMIREZ','','INT MERC PROV TUMBADOR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78761,'TVINU','UNISUPER, S.A.','','CALZ. CONCEPCION 5A CALLE ZONA 6 VILLA NUEVA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78762,'UAGBA','UNISUPER,  S.A.','','CALZADA AGUILAR BATRES 28-48 ZONA 11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78763,'UAMA2','TORRE AMATITLAN 2','','KM 29.6 CARR CA-9, C.C. PLAZA DEL LAGO AMATITLAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78764,'UAMAT','UNISUPER, S.A.','','7a. Calle 11-85 Barrio El Hospital, Amatitlan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78765,'UBARB','UNISUPER, S.A.','','2A CALLE ENTRE 5A Y 6A AV. ZONA 1 BARBERENA SANTA ROSA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78766,'UBOCA','UNISUPER, S.A.','','1AV 2-51 ZONA 1 BOCA DEL MONTE, VILLA CANALES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78767,'UBOLSUR','UNISUPER, S.A.','','6AV. 22-55 MZ. Q L 2 BLVD. SUR SAN CRISTOBAL Z 8 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78768,'UBRI','UNISUPER, S.A.','','AV. LA BRIGADA 10-30 Z. 7 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78769,'UCAMI','UNISUPER,  S.A.','','Boulevar El Caminero entre 8va y 10ma calle Zona 6 Mixco',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78770,'UCAYALA','UNISUPER, S.A.','','Bolv. Rafael Landivar 10-05 Zona 16 C.C. Paseo Cayala Edificio A1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78771,'UCENTRA','UNISUPER, S.A.','','23 C,1-51 Z.12 INT CENTRAL MAYOREO CC PLAZA CENTRA SUR LOCAL 6-PB VILLA NUEVA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78772,'UCENTRANOR','UNISUPER, S.A.','','Carr Atlantico 40-26 Z. 17, CC Centra Norte Local A4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78773,'UCENTRO','UNISUPER, S.A.','','6a CALLE 4-27 ZONA 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78774,'UCOATE','UNISUPER, S.A.','','6C 12-24 Z1 LOT LA FELICIDAD CC LA TRINIDAD, ANCLA 1 COATE. QUET',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78775,'UCHIQ','UNISUPER, S.A.','','6ta. Av. 5-10 zona 1 Chiquimula, Chiquimula.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78776,'UENCI','UNISUPER, S.A.','','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78777,'UESCALA','UNISUPER, S.A.','','km14.5 Carr el salv aldea pta parada z7 ccEscala L35 sta Catarina Pinula',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78778,'UESCU','UNISUPER, S.A.','','1av- 1 Calle Z.2 C.C. Palmeras Escuintla',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78779,'UESCU2','UNISUPER, S.A.','','2 AV. Y 8 CALLE ZONA 1 CENTRO COMERCIAL MINUTO, ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78780,'UESQUI','UNISUPER, S.A.','','3ra Av. 6-02 Z.1, Barrio San Joaquin, Esquipulas, Chiquimula',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78781,'UFRUT','UNISUPER, S.A.','','Boulevard el frutal 14-00 Zona 5 C.C. complejo comercial el frutal, local 30 Z.5 Villa Nueva',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78782,'UGUASTATOYA','UNISUPER, S.A.','','CALLE DE LA DOBLE VIA, BARRIO EL GOLFO, PROGRESO, GUASTATOYA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78783,'UJALA','UNISUPER, S.A.','','1 RA CALLE 1-03 ZONA 1 JALAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78784,'UJARD','UNISUPER S.A.','','12 C \"B\" 36-24 Zona 5 Novicentro Loc.54-55',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78785,'UJUTIAPA','UNISUPER, S.A.','','5A. CALLE 1-36 ZONA 1, JUTIAPA, JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78786,'ULFUENTES','UNISUPER, S.A.','','CALLE PRINCIPAL 11-50 ZONA 11 MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78787,'UMADERO','UNISUPER, S.A.','','KM 21.7 CARR A EL SALVADOR Z3 VILLA CANALES C.C. PLAZA MADERO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78788,'UMAGNOLIA','UNISUPER, S.A.','','5A CALLE 3-38 Z. 2 BOCA DEL MONTE, C.C. PLAZA MAGNOLIA, VILLA CANALES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78789,'UMAL','UNISUPER, S.A.','','5 CALLE 5-51 Z.2 CANTON MORAZAN CC LA TRINIDAD MALACATAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78790,'UMAR','UNISUPER, S.A.','','DIAGONAL 17 24-40 ZO.11 COLONIA MARISCAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78791,'UMAZA','UNISUPER, S.A.','','1RA AV 4-00 COL. OBREGON MAZATENANGO SUCHITEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78792,'UMETRON','UNISUPER, S.A.','','KM5 CARR ATLANTICO Z17 CC METRONORTE LOCAL 2-2, GUATEMALA, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78793,'UMILPAS','UNISUPER, S.A.','','M 34.5 RUTA 10 C.C. PARADOR SANTA LUCIA, JUR. MUNICIPAL DE STA. LUCIA MILPAS ALTAS, SACATEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78794,'UMIXC','UNISUPER S.  A.','','6TA. CALLE 4-85 ZONA 1 DE MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78795,'UMOLI','UNISUPER,  S.  A.','','CALZADA ROOSEVEL KM.15 ZONA 11 CENTRO MOLINO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78796,'UMUX','UNISUPER, S.A.','','Km. 13.5 Ant. Carr a el Salvador L.20, Finca los Tilos Zona 4 CC Comercial Minuto Muxbal, Sta Catarin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78797,'UNARANJO','UNISUPER, S.A.','','23 CALLE 10-00 ZONA 4 DE MIXCO, CONDADO EL NARANJO, C.C. NARANJO MALL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78798,'UNIMA','UNISUPER S.A.','','16 ave.  0-30 Zona 21 Colonia Morse',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78799,'UPETA','UNISUPER , S.A.','','45 CALLE 19-40 Z.12 GRAN PORTAL PETAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78800,'UPETEN','UNISUPER, S.A.,','','1a C Y 6a. Av. Z 1, MUNDO MAYA INTERNATIONAL MALL LOCAL 101.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78801,'UPINARES','UNISUPER, S.A.','','4A CALLE 18-27 SECTOR B-3 SAN CRISTOBAL 2, ZONA 8, MIXCO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78802,'UPINU','UNISUPER, S.A.','','1A. AVE. 1-01, ZONA 4 SAN JOSE PINULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78803,'UPINU2','UNISUPER,S .A.','','Km 17.4 carretera a San Jose Pinula, C.C. Plaza Pinula, Local 10, San Jose Pinula.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78804,'UPOPTUN','UNISUPER, S.A.','','ENTRE LA CALLE 15 DE SEPTIEMBRE Y 4a CALLE A ZONA 2, POPTUN, PETEN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78805,'UPTOBARRIOS','UNISUPER, S.A.','','CALZ. JUSTO RUFINO BARRIOS Y 23 CALLE EL LIMONAR, PUERTO BARRIOS, IZABAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78806,'UQUET','UNISUPER, S. A.','','9 CALLE AV XELA LAS AMERICAS, 0-20 Z 9 QUETZALTENANGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78807,'UQUIN','UNISUPER, S.A.','','CALZADA SAN JUAN 13-90 ZONA 7, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78808,'UREFO','UNISUPER,S.A.','','AVENIDA LA REFORMA 16-00 ZONA 9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78809,'UREU','UNISUPER,   S.A.','','5TA. CALLE \"A\" 5TA. AV. ZONA 1 EDIF. MORAN RETALHULEU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78810,'UROOS','UNISUPER,   S.A.','','CALZADA ROOSEVELT  12-76 ZONA 7, GUATEMALA, GUATEMALA.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78811,'USALAMA','UNISUPER, S.A.','','1 CALLE 8-25 ZONA 2 BARRIO SAN JOSE, SALAMA, BAJA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78812,'USICA','UNISUPER, S.A.','','AVENIDA SIMEON CAÑAS 3-59 ZONA 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78813,'USNCR','UNISUPER, S.A.','','LOTE 7 MANZ. A ZONA 8 SEC. B6, CIUDAD SAN CRISTOBAL MIXCO, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78814,'USNCR2','UNISUPER, S.A.','','Bol. Sn Cristobal 3a C. 6-72, Sec.A3 Z.8 CC SANKRIS, Local 103, Mixco Guatemala',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78815,'USNFER','UNISUPER, S.A.','','24 C. 14-00 Z.16 BLVD. HOSPITAL MILITAR C.C. PLAZA SAN FERNANDO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78816,'USNFR','UNISUPER S.A.','','Blv. El Caminero 15 Calle Z.6 de Mixco',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78817,'USNJO','UNISUPER,   S.A.','','CARR. A SALV. KM 13.5 STA. CATARINA PINULA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78818,'USNJU','UNISUPER,  S.  A.','','CALZADA SAN JUAN 9-86 ZONA 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78819,'USNLU','UNISUPER, S.A.','','KM 29.9 CARRETERA INTERAMERICANCA SAN LUCAS SACATEPEQUEZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78820,'USNMA','UNISUPER, S.A.','','9 CALLE 6-01 ZONA 1 SAN MARCOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78821,'USTALUCIA','UNISUPER,S.A.','','3RA AV. 1-83 ZONA 1, KM 94, SANTA LUCIA COTZUMALGUAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78822,'UTECU','UNISUPER,S.A.','','KM 122 RUTA AL ATLANTICO TECULUTAN ZACAPA, BARRIO SAN JOSE.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78823,'UTIQUI','UNISUPER, S.A.','','1A. AVE Y 2A. CALLE ESQUINA BARRIO EL PORVENIR Z.2 TIQUISATE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78824,'UTIQUI2','UNISUPER, S.A.','','CALZ PRINCIPAL 1-01 Z4 TIQUISATE ESCUINTLA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78825,'UTRINI','UNISUPER, S.A.','','1a. Calle \"Y\" 5 ave. \"A\" Centro Comercial La Trinidad Loc. 47 Retalhuleu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78826,'UVICA','UNISUPER, S.A.','','4TA AVENIDA 0-41 ZONA 2 VILLA CANALES, GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78827,'UVIHE','UNISUPER ,  S.  A.','','2 CALLE 18-30 ZONA 15 VISTA HERMOSA II',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78828,'UVILLAHE','UNISUPER, S.A.','','23 CALLE 20-24 ZONA 7 VILLA HERMOSA I SAN MIGUEL PETAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78829,'UVINU','UNISUPER, S.A.','','0 CALLE 16-20 Z.4 CC METROCENTRO V-N.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78830,'UXELA2','UNISUPER, S.A.','','7 AV. 0-61 ZONA 2, QUETZALTENANGO, QUETZALTENANGO.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78831,'UXELA3','UNISUPER, S.A.','','Km205 Carr hacia San Marcos, C.C. Inter plaza Xela, La Esperanza, Quetzaltenango',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78832,'UZ02','UNISUPER, S.A.','','6 AVENIDA 2-31 ZONA 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78833,'UZ06','UNISUPER, S.A.','','8 Av. B-10 Z.6 SAUZALITO, SANTA LUISA GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78834,'UZO10','UNISUPER,S.A.','','CALLE REAL DE LA VILLA 14-14 ZONA 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78835,'UZO11','UNISUPER, S.A.','','CALZADA AGUILAR BATRES 34-48 ZONA 11 TORRE ZONA 11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78836,'UZO14','UNISUPER, S. A .','','AVENIDA LAS AMERICAS 6-69 ZONA 14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78837,'UZO15','UNISUPER S.A.','','2a calle 18-30 Z.15 Vista Hermosa II',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78838,'UZO18','UNISUPER, S.A.','','14 Calle A y 38 Av. Z.18 C.C. El Manantial',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78839,'UZO19','UNISUPER, S.A.','','CALZ. SN JUAN 1-83 Z.19 C.C.  PLAZA FLORIDA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78840,'UZO4','UNISUPER, S.A.','','7A AVENIDA 5-34 ZONA 4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78841,'VELOZ INC','LA TORTILLA VELOZ INC','','2351 43e AVE. LACHINE, QUEBEC H8T 2K1 CANADA','514 799 2683',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'latortillaveloz@hotmail.com'),(78842,'VRUTDEP C SUR','CLIENTES VARIOS CESAR POP','','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78843,'VRUTDEP C.SUR2','VENTAS RUTEO JUAN CARLOS HERNANDEZ','','COBAN ALTA VERAPAZ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78844,'VRUTDEP C.SUR3','VENTAS RUTEO BELNER IVAN LARA CARRILLO','','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78845,'VRUTDEP C.SUR4','VENTAS RUTEO DEPARTAMENTAL COSTA SUR 4','','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78846,'VRUTDEP NORTE','VENTAS RUTEO DEPARTAMENTAL NORTE','','ASUNCION MITA, JUTIAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78847,'VRUTDEP OR-2','VENTAS RUTEO DEPARTAMENTAL ORIENTE 2','','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78848,'VRUTDEP S-O','VENTAS RUTEO DEPARTAMENTAL SUR ORIENTE','','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78849,'VRUTDEP.ORIENTE','VENTAS RUTEO DEPARTAMENTAL ORIENTE','','CIUDAD DE GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78850,'WOK1','FRANQUICIAS ORIENTALES DE GUATEMALA, S.A..','','17 AVENIDA EDIFICIO TORINO, 5 NIVEL 19-70 ZONA 10 GUATEMALA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78851,'WOKSV','COMIDAS ORIENTALES, S. A. DE C. V.','','17 Av. Norte y Calle Chiltiupan Centro Comercial Chiltiupan Santa Tecla La Libertad','(503) 2523-3400',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'raul.solis@premium.sv'),(78852,'ZABLAH','DISTRIBUIDORA ZABLAH, S. A. DE C. V.','','17 Ave. Sur y 14 Calle Oriente, Santa Tecla La Libertad, El Salvador.','Tel.: (503) 2525-106',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'YURBINA@DISZASA.COM'),(78853,'ZAC001','TIENDA J Y L','','15 Av. A 7-27 ZONA 1, ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78854,'ZAC002','HECTOR ORELLANA','','13 AVE 6-34 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78855,'ZAC003','VARMAN DISTRIBUCIONES','','Caserio Los Puentes, Teculután Zacapa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78856,'ZAC004','TIENDA SHADAY / LUDIN UZIEL ACEVEDO','','14 AVENIDA 7-73 ZONA 1 BARRIO LA LAGUNA ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78857,'ZAC005','CASTA LUZ ORELLANA','','14 AV. 6-24 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78858,'ZAC006','EDNA LETICIA SALGUERO','','ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78859,'ZAC007','TIENDA EL DIVINO MAESTRO','','7ma. Calle 16-23 zona 1,  Zacapa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78860,'ZAC008','EDGAR GOMEZ','','Barrio el Centro Gualan, Zacapa','46655250',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78861,'ZAC009','JOSE REYNOSO','','ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78862,'ZAC010','DEPOSITO FLOR DE ORIENTE','','7 CALLE 15-23 ZONA 1, ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78863,'ZAC011','COMERCIAL BRENCY II','','13 AV. 6-13 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78864,'ZAC012','MANOLO CERIN','','INT MERC. SECTOR COMEDORES, ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78865,'ZAC013','JUSTO MEDRANO','','7a. Calle 14-22 zona 1, Zacapa.','49326704',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78866,'ZAC014','FRANCISCO OSORIO','','4ta. calle 16-30 barrio el calvario zona 1, Zacapa.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78867,'ZAC015','DISTRIBUIDORA COMERCIAL ROLDAN','','ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78868,'ZAC016','CATARINA ITZEP','','ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78869,'ZAC017','ZONIA GALVEZ','','ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78870,'ZAC018','SUPER TIENDA ELSITA/ LUIS CASTRO','','7 AV. 0-40 ZONA 1 TECULUTAN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78871,'ZAC019','ABARROTERIA SANTA CRUZ','','5 CALLE 14-37 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78872,'ZAC020','TIENDA JOSE CARLOS','','6TA CALLE 14-96 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78873,'ZAC021','DEPOSITO CERIN','','7 CALLE 16-23 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78874,'ZAC022','LUIS ASENCIO','','Rio Hondo, Zacapa.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78875,'ZAC023','JAIRO NOEL VARGAS','','3ra.Av. barrio el centro Rio Hondo, Zacapa.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78876,'ZAC024','TIENDA SANTA CRUZ','','8 CALLE LOC 4 13-78 ZONA 1 BARRIO LA LAGUNA ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78877,'ZAC025','TIENDA LUISITO/EDGAR MEDRANO','','7 CALLE 16-13 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78878,'ZAC026','ALIDA MENDEZ','','Mercado Municipal, Zacapa.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78879,'ZAC027','NORA LEON','','Barrio La estacion Gualan, Zacapa.','39331420',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78880,'ZAC028','SAUL SONTAY','','6a. Av. 16-45 Zona 1, Zacapa.','52205540',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78881,'ZAC029','JORGE ARMANDO VARGAS','','Barrio el centro gualan, Zacapa.','79332158',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78882,'ZAC031','NICOLAS LOPEZ','','7a. Calle zona 1, Zacapa.','46643964',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78883,'ZAC032','OSWALDO SOSA','','7a. Calle y 15 Av. esquina, Zacapa.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78884,'ZAC037','KARINA SUCHITE','','BARRIO LA ESTACION, GUALAN ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78885,'ZAC038','EDNA CERIN','','7A CALLE 16-16 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78886,'ZAC039','JOSE REYNOSO','','7 CALLE 16-32 ZONA 1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78887,'ZAC042','ABARROTERIA ALEJANDRA/SALOMON LEON','','BARRIO ESTACION GUALAN ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78888,'ZAC043','TIENDA SAMARITANA','','13 AVE Z 1 BARRIO LA LAGUNA ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78889,'ZAC044','DEPOSITO SANDOVAL/SHENY SANDOVAL','','BARRIO LA ESTACION, GUALAN ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78890,'ZAC045','TIENDA CONY','','7MA CALLE 15 AV ESQUINA Z.1 ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78891,'ZAC046','COMEDOR DOÑA BETTY','','ZACAPA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(78892,'prueba','prueba','prueba','prueba','prueba',NULL,'0','0','0','0','0','0','0','0','0',2,'prueba');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colaboradores` (
  `id_colaborador` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_colaborador`)
) ENGINE=InnoDB AUTO_INCREMENT=1023 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaboradores`
--

LOCK TABLES `colaboradores` WRITE;
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
INSERT INTO `colaboradores` VALUES (911,'8018075484200000000017','ABEL FERNANDO ','MORALES CONTRERAS','','1','2019-10-09 18:09:56','2019-10-09 18:09:56'),(912,'8018075484200000000024','BRENDA  ','CASTILLO ARGUETA','42483954','1','2019-10-09 18:09:57','2019-10-09 18:09:57'),(913,'8018075484200000000031','ESTUARDO DAVID ','ESPAÑA RIVERA','47680402','1','2019-10-09 18:09:57','2019-10-09 18:09:57'),(914,'8018075484200000000048','ALEX ABEL','PAREDES DELGADO','58250513','1','2019-10-09 18:09:57','2019-10-09 18:09:57'),(915,'8018075484200000000055','BELNER IVAN LARA CARRILLO','LARA CARRILLO','55712541','1','2019-10-09 18:09:57','2019-10-09 18:09:57'),(916,'8018075484200000000062','CESAR AUGUSTO ','POP CAAL','58250816','1','2019-10-09 18:09:57','2019-10-09 18:09:57'),(917,'8018075484200000000079','FREDY ESTUARDO ','ESPAÑA TORRES','55214210','1','2019-10-09 18:09:58','2019-10-09 18:09:58'),(918,'8018075484200000000086','GUMERCINDO  ','PINEDA LEMUS','58250782','1','2019-10-09 18:09:58','2019-10-09 18:09:58'),(919,'8018075484200000000093','MAURICIO  ','PAREDES ','58250492','1','2019-10-09 18:09:58','2019-10-09 18:09:58'),(920,'8018075484200000000109','MARVIN GEOVANNIE ','CARRILLO REYES','42721758','1','2019-10-09 18:09:58','2019-10-09 18:09:58'),(921,'8018075484200000000116','AURA ARACELI','HERNANDEZ DONIS','47305787','1','2019-10-09 18:09:58','2019-10-09 18:09:58'),(922,'8018075484200000000123','JOSE MIGUEL','ORDOÑEZ GUDIEL','48481602','1','2019-10-09 18:09:59','2019-10-09 18:09:59'),(923,'8018075484200000000130','JUAN CARLOS ','PULEX COJOLON','48977805','1','2019-10-09 18:09:59','2019-10-09 18:09:59'),(924,'8018075484200000000147','LETICIA MARISOL ','HERNANDEZ LOPEZ','43433331','1','2019-10-09 18:09:59','2019-10-09 18:09:59'),(925,'8018075484200000000154','LISBETH GABRIELA ','ZELADA MARTINEZ','54944732','1','2019-10-09 18:09:59','2019-10-09 18:09:59'),(926,'8018075484200000000161','MARIO ESAU ','JIMENEZ CORTEZ','34893070','1','2019-10-09 18:09:59','2019-10-09 18:09:59'),(927,'8018075484200000000178','OSCAR DAVID ','SINEY PIRIR','35131427','1','2019-10-09 18:09:59','2019-10-09 18:09:59'),(928,'8018075484200000000185','PABLO RENE ','BRAVO CARTAGENA','','1','2019-10-09 18:10:00','2019-10-09 18:10:00'),(929,'8018075484200000000192','ANA LUCIA ','VASQUEZ ROMERO','54749030','1','2019-10-09 18:10:00','2019-10-09 18:10:00'),(930,'8018075484200000000208','DERICK ORLANDO ','PEREZ BARRIOS','54799579','1','2019-10-09 18:10:00','2019-10-09 18:10:00'),(931,'8018075484200000000215','EVELYN JUDITH ','VASQUEZ ROMERO','54831307','1','2019-10-09 18:10:01','2019-10-09 18:10:01'),(932,'8018075484200000000222','KARYN DEL ROSARIO ','MORALES CONTRERAS','30205045','1','2019-10-09 18:10:01','2019-10-09 18:10:01'),(933,'8018075484200000000239','MAYRA LUISA ','RAXON HERNANDEZ','54276963','1','2019-10-09 18:10:01','2019-10-09 18:10:01'),(934,'8018075484200000000246','ABNER HUMBERTO ','CACERES MONTERROSO','58250656','1','2019-10-09 18:10:01','2019-10-09 18:10:01'),(935,'8018075484200000000253','CHRISTIAN ISAIAS ','CANAHUI CHAN','53337968','1','2019-10-09 18:10:02','2019-10-09 18:10:02'),(936,'8018075484200000000260','DAVID ORLANDO',' HERNANDEZ QUEJ','','1','2019-10-09 18:10:02','2019-10-09 18:10:02'),(937,'8018075484200000000277','HENRY DAMIAN ','SANCHEZ PEREZ','54435947','1','2019-10-09 18:10:02','2019-10-09 18:10:02'),(938,'8018075484200000000284','HUGO GEOVANI ','GOMEZ GARCIA','','1','2019-10-09 18:10:03','2019-10-09 18:10:03'),(939,'8018075484200000000291','JAIME GEOVANNY ','HERNANDEZ CHAVEZ','','1','2019-10-09 18:10:03','2019-10-09 18:10:03'),(940,'8018075484200000000307','JOSE ALEJANDRO',' QUIXNAY ','','1','2019-10-09 18:10:03','2019-10-09 18:10:03'),(941,'8018075484200000000314','MELVIN ABIMAÉL ','BOROR PIRIR','','1','2019-10-09 18:10:04','2019-10-09 18:10:04'),(942,'8018075484200000000321','RAMIRO  ','PAREDES ','NA','1','2019-10-09 18:10:04','2019-10-09 18:10:04'),(943,'8018075484200000000338','ALEYDA MAGALY ','MARTINEZ GIRON','32223392','1','2019-10-09 18:10:05','2019-10-09 18:10:05'),(944,'8018075484200000000345','ANGELA DEL CARMEN ','CUJ CUJ','44756002','1','2019-10-09 18:10:05','2019-10-09 18:10:05'),(945,'8018075484200000000352','BELARMINO  ','SUBUYUJ PATZAN','','1','2019-10-09 18:10:05','2019-10-09 18:10:05'),(946,'8018075484200000000369','CARLA VERONICA ','SUY QUECHE','42799309','1','2019-10-09 18:10:05','2019-10-09 18:10:05'),(947,'8018075484200000000376','CESAR  ','POP CÚ','47497286','1','2019-10-09 18:10:06','2019-10-09 18:10:06'),(948,'8018075484200000000383','EDWIN HERMENEGILDO ','GOMEZ RUIZ','','1','2019-10-09 18:10:06','2019-10-09 18:10:06'),(949,'8018075484200000000390','ERICKA YESENIA ','HERNANDEZ CASTRO','46109358','1','2019-10-09 18:10:06','2019-10-09 18:10:06'),(950,'8018075484200000000406','GEIDY MARGARITA ','GARCIA ROCA','53251263','1','2019-10-09 18:10:06','2019-10-09 18:10:06'),(951,'8018075484200000000413','GERARDO ANIBAL ','QUECHE ORDOÑEZ','52817124','1','2019-10-09 18:10:07','2019-10-09 18:10:07'),(952,'8018075484200000000420','INGRID IRACENDI ','ORTIZ TICURU','51499783','1','2019-10-09 18:10:07','2019-10-09 18:10:07'),(953,'8018075484200000000437','JENNIFER KARINA ','POLANCO HERNANDEZ','33622031','1','2019-10-09 18:10:07','2019-10-09 18:10:07'),(954,'8018075484200000000444','JOSE ANTONIO ','LEIVA ARTIAGA','45499491','1','2019-10-09 18:10:07','2019-10-09 18:10:07'),(955,'8018075484200000000451','JUANA MARIA','BARRERA ','43331555','1','2019-10-09 18:10:07','2019-10-09 18:10:07'),(956,'8018075484200000000468','MARELIN YECENIA ','HERNANDEZ LOPEZ','46938044','1','2019-10-09 18:10:07','2019-10-09 18:10:07'),(957,'8018075484200000000475','MARIA LUISA ','RAXCACO CHEN','','1','2019-10-09 18:10:08','2019-10-09 18:10:08'),(958,'8018075484200000000482','MARIO ALEXANDER ','ORDOÑEZ GARCIA','51937452','1','2019-10-09 18:10:08','2019-10-09 18:10:08'),(959,'8018075484200000000499','MAYLIN ESMERALDA ','CULAJAY CHACLAN','','1','2019-10-09 18:10:08','2019-10-09 18:10:08'),(960,'8018075484200000000505','MILTON ANIBAL',' RAYMUNDO LUCAS','31257778','1','2019-10-09 18:10:08','2019-10-09 18:10:08'),(961,'8018075484200000000512','RUDY RODOLFO ','ORDOÑEZ GARCIA','30844049','1','2019-10-09 18:10:08','2019-10-09 18:10:08'),(962,'8018075484200000000529','SAYABIL DAYANA ','FELIPE BERRIOS','43746403','1','2019-10-09 18:10:08','2019-10-09 18:10:08'),(963,'8018075484200000000536','TRINIDAD  ','RAMIREZ Y RAMIREZ','52439377','1','2019-10-09 18:10:09','2019-10-09 18:10:09'),(964,'8018075484200000000543','WILSON ALBERTO',' HERNANDEZ ORTIZ','56225032','1','2019-10-09 18:10:09','2019-10-09 18:10:09'),(965,'8018075484200000000550','WILSON NEFTALI ','GONZALEZ ALVARADO','44143079','1','2019-10-09 18:10:09','2019-10-09 18:10:09'),(966,'8018075484200000000567','YESSICA PAMELA ','YANTUCHE GARCIA','','1','2019-10-09 18:10:10','2019-10-09 18:10:10'),(967,'8018075484200000000574','AXEL EDUARDO ','HERNANDEZ ESPAÑA','54739058','1','2019-10-09 18:10:10','2019-10-09 18:10:10'),(968,'8018075484200000000581','CECILIO  ','XIQUIN LAYNEZ','59421651','1','2019-10-09 18:10:11','2019-10-09 18:10:11'),(969,'8018075484200000000598','JORGE ALFREDO ','SUBUYUJ PATZAN','44461713','1','2019-10-09 18:10:11','2019-10-09 18:10:11'),(970,'8018075484200000000604','JOSE ALBERTO ','PIRIR LOPEZ','53718491','1','2019-10-09 18:10:11','2019-10-09 18:10:11'),(971,'8018075484200000000611','ABRAHAM  ','GRANADOS CRUZ','46918841','1','2019-10-09 18:10:12','2019-10-09 18:10:12'),(972,'8018075484200000000628','JOSE LUIS ANTONIO ','GARCIA ROCA','34505057','1','2019-10-09 18:10:12','2019-10-09 18:10:12'),(973,'8018075484200000000635','MARLON ERNESTO ','GOMEZ PEREZ','41250862','1','2019-10-09 18:10:12','2019-10-09 18:10:12'),(974,'8018075484200000000642','ELSA ISABEL',' PAREDES DE LEON','NA','1','2019-10-09 18:10:13','2019-10-09 18:10:13'),(975,'8018075484200000000659','INES EUGENIA ','CIFUENTES DE MORALES','NA','1','2019-10-09 18:10:13','2019-10-09 18:10:13'),(976,'8018075484200000000666','ADRIANA MAYENA ','AJXUP ZABALETA','45545618','1','2019-10-09 18:10:13','2019-10-09 18:10:13'),(977,'8018075484200000000673','ANA MARIA ','DIAZ ESPAÑA','56737158','1','2019-10-09 18:10:13','2019-10-09 18:10:13'),(978,'8018075484200000000680','ANA MARIA ','GOMEZ ','58608182','1','2019-10-09 18:10:14','2019-10-09 18:10:14'),(979,'8018075484200000000697','ARACELI DE JESUS ','GOMEZ HERNANDEZ','30121516','1','2019-10-09 18:10:14','2019-10-09 18:10:14'),(980,'8018075484200000000703','BLANCA ESTELA ','BALAN OSORIO','24338005','1','2019-10-09 18:10:14','2019-10-09 18:10:14'),(981,'8018075484200000000710','CARLOS ANTONIO ','SUBUYUJ PATZAN','40790918','1','2019-10-09 18:10:14','2019-10-09 18:10:14'),(982,'8018075484200000000727','CLAUDIA LORENA','XITAMUL CERIOS','52379224','1','2019-10-09 18:10:14','2019-10-09 18:10:14'),(983,'8018075484200000000734','CLEMENTINO ','HERNANDEZ ACAJABON','41326573','1','2019-10-09 18:10:15','2019-10-09 18:10:15'),(984,'8018075484200000000741','DAMARIS DINORA ','CAMEY GARCIA','52615742','1','2019-10-09 18:10:15','2019-10-09 18:10:15'),(985,'8018075484200000000758','EZEQUIEL DE JESUS','RAMIREZ ESTEVEZ','50914221','1','2019-10-09 18:10:15','2019-10-09 18:10:15'),(986,'8018075484200000000765','FILITEO ',' AJPOP HERRERA','59752922','1','2019-10-09 18:10:16','2019-10-09 18:10:16'),(987,'8018075484200000000772','HECTOR ANIVAL ','NAJERA HERNANDEZ','58362404','1','2019-10-09 18:10:16','2019-10-09 18:10:16'),(988,'8018075484200000000789','HILDA  ','XITAMUL SANTIAGO','34986630','1','2019-10-09 18:10:16','2019-10-09 18:10:16'),(989,'8018075484200000000796','JACQUELINE LORENA ','GARCIA PEREZ','48851214','1','2019-10-09 18:10:16','2019-10-09 18:10:16'),(990,'8018075484200000000802','JEFFERSON ODISEO','GAYTAN RODRIGUEZ','30091520','1','2019-10-09 18:10:17','2019-10-09 18:10:17'),(991,'8018075484200000000819','JOSUE OTTONIEL','MACARIO PEREZ','33453221','1','2019-10-09 18:10:17','2019-10-09 18:10:17'),(992,'8018075484200000000826','LIGIA CARMINA ','PEREZ VASQUEZ','59502925','1','2019-10-09 18:10:17','2019-10-09 18:10:17'),(993,'8018075484200000000836','LILIAN LETICIA ','XITAMUL CERIOS','','1','2019-10-09 18:10:18','2019-10-09 18:10:18'),(994,'8018075484200000000840','MARGARITO  ','RAXCACÓ CHEN','44294263','1','2019-10-09 18:10:18','2019-10-09 18:10:18'),(995,'8018075484200000000857','MARIA DEL CARMEN ','RAXON HERNANDEZ','24351178','1','2019-10-09 18:10:18','2019-10-09 18:10:18'),(996,'8018075484200000000864','MARIA LORENA ','MELENDEZ BARRERA','','1','2019-10-09 18:10:18','2019-10-09 18:10:18'),(997,'8018075484200000000871','MARTHA JULIA',' PATZAN IQUIC','48122149','1','2019-10-09 18:10:19','2019-10-09 18:10:19'),(998,'8018075484200000000888','RUFINO  ','RAMIREZ ESTEVEZ','34813578','1','2019-10-09 18:10:19','2019-10-09 18:10:19'),(999,'8018075484200000000895','SANDRA PATRICIA ','SUBUYUJ PATZAN','50483328','1','2019-10-09 18:10:19','2019-10-09 18:10:19'),(1000,'8018075484200000000901','SANDRA VICTORIA ','DIAZ ESPAÑA','','1','2019-10-09 18:10:20','2019-10-09 18:10:20'),(1001,'8018075484200000000918','SINDY GABRIELA ','POLANCO HERNANDEZ','44461713','1','2019-10-09 18:10:20','2019-10-09 18:10:20'),(1002,'8018075484200000000925','SONIA ELIZABETH ','JIMENEZ CORTEZ','41575311','1','2019-10-09 18:10:20','2019-10-09 18:10:20'),(1003,'8018075484200000000932','SONIA ELIZABETH ','MORALES NATARENO','58732611','1','2019-10-09 18:10:20','2019-10-09 18:10:20'),(1004,'8018075484200000000949','VILMA ESPERANZA ','ORDOÑEZ GUDIEL','49666569','1','2019-10-09 18:10:21','2019-10-09 18:10:21'),(1005,'8018075484200000000956','ANGEL ARMANDO ','VIELMAN GARCIA','31134431','1','2019-10-09 18:10:21','2019-10-09 18:10:21'),(1006,'8018075484200000000963','JOSE ALBERTO ','PATZAN LOPEZ','56665717','1','2019-10-09 18:10:21','2019-10-09 18:10:21'),(1007,'8018075484200000000970','JOSE DAVID ','CULAJAY CHACLAN','','1','2019-10-09 18:10:21','2019-10-09 18:10:21'),(1008,'8018075484200000000987','LUIS ELEAZAR','HERNANDEZ AJU','31493736','1','2019-10-09 18:10:22','2019-10-09 18:10:22'),(1009,'8018075484200000000994','ANA MARIA ','TOJ PIRIR','52728099','1','2019-10-09 18:10:22','2019-10-09 18:10:22'),(1010,'8018075484200000001007','ELVA ISABEL ','CHAVEZ ESCOBAR','50707016','1','2019-10-09 18:10:22','2019-10-09 18:10:22'),(1011,'8018075484200000001014','IRMA LUCRECIA ','AJXUP ZABALETA','58250897','1','2019-10-09 18:10:22','2019-10-09 18:10:22'),(1012,'8018075484200000001021','KARIN LISETH','RIVAS CHAVEZ','57055640','1','2019-10-09 18:10:22','2019-10-09 18:10:22'),(1013,'8018075484200000001038','MIRIAM CAROLINA ','HERNANDEZ AJU','48761581','1','2019-10-09 18:10:23','2019-10-09 18:10:23'),(1014,'8018075484200000001045','MOISES ANTONIO ','CIFUENTES HIDALGO','NA','1','2019-10-09 18:10:23','2019-10-09 18:10:23'),(1015,'8018075484200000001052','BENITO','ORDOÑEZ ALEJANDRO','','1','2019-10-09 18:10:23','2019-10-09 18:10:23'),(1016,'8018075484200000001069','PETRONIO  ','CANAHUI GARCIA','58250788','1','2019-10-09 18:10:23','2019-10-09 18:10:23'),(1017,'8018075484200000001076','BERSY YOHANNA','CASTAÑON PEREZ','45481522','1','2019-10-09 18:10:23','2019-10-09 18:10:23'),(1018,'8018075484200000001083','CESAR ODILIO','AJPOP HERRERA','57460785','1','2019-10-09 18:10:24','2019-10-09 18:10:24'),(1019,'8018075484200000001090','JERONIMO  ','LUX ','22124076','1','2019-10-09 18:10:24','2019-10-09 18:10:24'),(1020,'8018075484200000001106','MAGDA BEATRIZ ','CASTILLO CHACOJ','','1','2019-10-09 18:10:24','2019-10-09 18:10:24'),(1021,'8018075484200000001113','MAIRA JUDITH ','LEMUS AVILA','33312285','1','2019-10-09 18:10:24','2019-10-09 18:10:24'),(1022,'8018075484200000001120','PAULA ','CURUP GUAMUCH','','1','2019-10-09 18:10:24','2019-11-12 16:30:51');
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_trazabilidad`
--

DROP TABLE IF EXISTS `control_trazabilidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control_trazabilidad` (
  `id_control` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL,
  `hora_inicio` datetime DEFAULT NULL,
  `hora_fin` datetime DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `cantidad_producida` decimal(18,2) DEFAULT NULL,
  `cantidad_programada` decimal(18,2) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `no_orden_produccion` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_control`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_trazabilidad`
--

LOCK TABLES `control_trazabilidad` WRITE;
/*!40000 ALTER TABLE `control_trazabilidad` DISABLE KEYS */;
INSERT INTO `control_trazabilidad` VALUES (63,1795,1,NULL,NULL,'2021-02-26',NULL,800.00,'PASC2602','PROD-20200227',1,'2020-02-26 10:05:41','2020-02-26 10:05:41'),(64,1758,2702,NULL,NULL,'2020-12-28',1200.00,1234.00,'2702','PROD-20200227',1,'2020-02-27 08:28:59','2020-03-04 13:11:19');
/*!40000 ALTER TABLE `control_trazabilidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_trazabilidad_orden_produccion`
--

DROP TABLE IF EXISTS `control_trazabilidad_orden_produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control_trazabilidad_orden_produccion` (
  `id_control` int(11) DEFAULT NULL,
  `no_orden_produccion` varchar(45) DEFAULT NULL,
  `id_requisicion` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_trazabilidad_orden_produccion`
--

LOCK TABLES `control_trazabilidad_orden_produccion` WRITE;
/*!40000 ALTER TABLE `control_trazabilidad_orden_produccion` DISABLE KEYS */;
INSERT INTO `control_trazabilidad_orden_produccion` VALUES (63,'PROD-20200227',15,1795),(64,'PROD-20200227',15,1758);
/*!40000 ALTER TABLE `control_trazabilidad_orden_produccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `correlativos`
--

DROP TABLE IF EXISTS `correlativos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `correlativos` (
  `id_correlativo` int(11) NOT NULL AUTO_INCREMENT,
  `prefijo` varchar(45) DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT '1',
  `modulo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_correlativo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `correlativos`
--

LOCK TABLES `correlativos` WRITE;
/*!40000 ALTER TABLE `correlativos` DISABLE KEYS */;
INSERT INTO `correlativos` VALUES (1,'PROV',42,1,'PROVEEDORES'),(2,'PROD',1,1,'PRODUCCION');
/*!40000 ALTER TABLE `correlativos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `det_mezclaharina`
--

DROP TABLE IF EXISTS `det_mezclaharina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `det_mezclaharina` (
  `id_det_mezclaharina` int(11) NOT NULL AUTO_INCREMENT,
  `id_Enc_mezclaharina` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `hora_carga` varchar(45) DEFAULT NULL,
  `hora_descarga` varchar(45) DEFAULT NULL,
  `solucion_inicial` varchar(45) DEFAULT NULL,
  `solucion_observacion` varchar(100) DEFAULT NULL,
  `ph_inicial` varchar(45) DEFAULT NULL,
  `ph_observacion` varchar(100) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_mezclaharina`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `det_mezclaharina`
--

LOCK TABLES `det_mezclaharina` WRITE;
/*!40000 ALTER TABLE `det_mezclaharina` DISABLE KEYS */;
INSERT INTO `det_mezclaharina` VALUES (97,67,1795,'123','12:34:45','12:34:51','158.4','observaciones','8','11',1),(98,67,1795,'123','12:35:33','12:44:52','158',NULL,'8','observacionesç',1),(99,67,1795,'123','12:48:06','12:49:16','158.4',',excedente de 45196 segundos','8','Observaciones',1),(100,67,1795,'123','12:48:37','15:08:35','158.4',NULL,'8','Observsciones',1),(101,67,1795,'123','15:39:28','15:39:40','158','observaciones','8','observaciones',1),(102,67,1795,'123','15:39:29','15:39:50','158',NULL,'8','observaciones',1),(103,67,1795,'123','15:41:49','15:41:57','158','dqdsa','8',NULL,1),(104,67,1795,'123','15:46:20','15:46:36','160','OBSERVACIONES','10',NULL,1);
/*!40000 ALTER TABLE `det_mezclaharina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_insumos`
--

DROP TABLE IF EXISTS `detalle_insumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_insumos` (
  `id_detalle_insumo` int(11) NOT NULL AUTO_INCREMENT,
  `id_control` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `olor` varchar(45) DEFAULT NULL,
  `impresion` varchar(45) DEFAULT 'N/A',
  `ausencia_material_extranio` char(1) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `fecha_vencimiento` datetime DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  `no_orden_produccion` varchar(45) DEFAULT NULL,
  `cantidad_utilizada` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_insumo`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_insumos`
--

LOCK TABLES `detalle_insumos` WRITE;
/*!40000 ALTER TABLE `detalle_insumos` DISABLE KEYS */;
INSERT INTO `detalle_insumos` VALUES (100,63,1546,'1','1','1','1','2602','2020-03-27 00:00:00',150.00,'PROD-20200227',NULL),(101,64,1546,'1','1','1','1','2602','2020-03-27 00:00:00',120.00,'PROD-20200227',NULL);
/*!40000 ALTER TABLE `detalle_insumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_lotes`
--

DROP TABLE IF EXISTS `detalle_lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_lotes` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) DEFAULT NULL,
  `no_lote` varchar(45) DEFAULT NULL,
  `fecha_vencimiento` datetime DEFAULT NULL,
  `id_recepcion_enc` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_lotes`
--

LOCK TABLES `detalle_lotes` WRITE;
/*!40000 ALTER TABLE `detalle_lotes` DISABLE KEYS */;
INSERT INTO `detalle_lotes` VALUES (14,1500,'2602','2020-03-27 00:00:00',15,1546,'2020-02-26 08:56:19','2020-02-26 08:56:19'),(15,580,'AR2602','2020-07-22 00:00:00',15,1547,'2020-02-26 08:56:19','2020-02-26 08:56:19'),(16,655,'CS2602','2020-07-17 00:00:00',15,1555,'2020-02-26 08:56:19','2020-02-26 08:56:19'),(17,540,'R2602','2020-07-30 00:00:00',15,1578,'2020-02-26 08:56:19','2020-02-26 08:56:19'),(18,650,'AJO2602','2020-07-28 00:00:00',15,1546,'2020-02-26 08:56:19','2020-02-26 08:56:19');
/*!40000 ALTER TABLE `detalle_lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dimensionales`
--

DROP TABLE IF EXISTS `dimensionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dimensionales` (
  `id_dimensional` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `unidad_medida` varchar(5) NOT NULL,
  `factor` int(11) NOT NULL,
  `estado` char(1) DEFAULT '1',
  PRIMARY KEY (`id_dimensional`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dimensionales`
--

LOCK TABLES `dimensionales` WRITE;
/*!40000 ALTER TABLE `dimensionales` DISABLE KEYS */;
INSERT INTO `dimensionales` VALUES (1,'UNIDAD','UN',1,'1'),(2,'LIBRA','LB',1,'1'),(3,'GALON','GAL',1,'1'),(4,'BOBINA ','KG',15,'1'),(5,'BOLSA','BOL',1,'1'),(6,'QUINTAL ','QQ',25,'1'),(7,'GALONES ','GL',1,'1'),(26,'CAJA','UNI',3300,'1'),(27,'dimesion_bc','gb_lb',10,'0'),(28,'Paquete','UN',6,'1'),(29,'PRUEBA','01',0,'1');
/*!40000 ALTER TABLE `dimensionales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enc_mezclaharina`
--

DROP TABLE IF EXISTS `enc_mezclaharina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enc_mezclaharina` (
  `id_Enc_mezclaharina` int(11) NOT NULL AUTO_INCREMENT,
  `no_orden` varchar(45) DEFAULT NULL,
  `id_responsable_maquina` int(11) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `observaciones` varchar(80) DEFAULT NULL,
  `id_usuario` varchar(45) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `id_control` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_Enc_mezclaharina`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enc_mezclaharina`
--

LOCK TABLES `enc_mezclaharina` WRITE;
/*!40000 ALTER TABLE `enc_mezclaharina` DISABLE KEYS */;
INSERT INTO `enc_mezclaharina` VALUES (67,NULL,1,'2020-03-02 18:34:35','Acciones correctivas','1',NULL,63,'123');
/*!40000 ALTER TABLE `enc_mezclaharina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fritura_sopas_det`
--

DROP TABLE IF EXISTS `fritura_sopas_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fritura_sopas_det` (
  `id_fritura_sopas_det` int(11) NOT NULL AUTO_INCREMENT,
  `id_fritura_sopas_enc` int(11) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `temperatura_inicial` varchar(45) DEFAULT NULL,
  `temperatura_final` varchar(45) DEFAULT NULL,
  `temperatura_general` varchar(45) DEFAULT NULL,
  `temperatura_set` varchar(45) DEFAULT NULL,
  `tiempo_fritura` varchar(45) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_fritura_sopas_det`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fritura_sopas_det`
--

LOCK TABLES `fritura_sopas_det` WRITE;
/*!40000 ALTER TABLE `fritura_sopas_det` DISABLE KEYS */;
INSERT INTO `fritura_sopas_det` VALUES (11,4,NULL,'18:32:42','21','21','21','21','21','21',1),(12,4,NULL,'18:32:42','21','21','21','21','21','21  -14 minutos antes',1),(13,4,NULL,'18:32:50','2121','21','212','1','21','21 -14 minutos antes',1),(14,4,NULL,'18:33:22','21','21','21','21','21','-14 minutos antes',1),(15,4,NULL,'18:33:34','21','21','21','21','21','-14 minutos antes',1),(16,4,NULL,'18:33:53','21','21','21','21','21','21 -14 minutos antes',1),(17,4,NULL,'18:36:25','2','33','2','21','2','-12 minutos antes',1),(18,4,NULL,'18:39:38','130','140','150','160','1.3','-11 minutos antes',1);
/*!40000 ALTER TABLE `fritura_sopas_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fritura_sopas_enc`
--

DROP TABLE IF EXISTS `fritura_sopas_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fritura_sopas_enc` (
  `id_frutura_sopas_enc` int(11) NOT NULL AUTO_INCREMENT,
  `id_control` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_presentacion` int(11) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `observaciones` varchar(45) DEFAULT NULL,
  `id_turno` varchar(45) DEFAULT '1',
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_frutura_sopas_enc`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fritura_sopas_enc`
--

LOCK TABLES `fritura_sopas_enc` WRITE;
/*!40000 ALTER TABLE `fritura_sopas_enc` DISABLE KEYS */;
INSERT INTO `fritura_sopas_enc` VALUES (4,64,1,1758,NULL,'2020-03-04 00:32:33','observaciones','1','2121');
/*!40000 ALTER TABLE `fritura_sopas_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inspeccion_documentos_vehiculos`
--

DROP TABLE IF EXISTS `inspeccion_documentos_vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inspeccion_documentos_vehiculos` (
  `id_inspeccion_documentos` int(11) NOT NULL AUTO_INCREMENT,
  `id_recepcion_enc` int(11) DEFAULT NULL,
  `proveedor_aprobado` varchar(1) DEFAULT NULL,
  `producto_acorde_compra` varchar(1) DEFAULT NULL,
  `cantidad_acorde_compra` varchar(1) DEFAULT NULL,
  `certificado_existente` varchar(1) DEFAULT NULL,
  `certificado_correspondiente_lote` varchar(1) DEFAULT NULL,
  `certificado_correspondiente_especificacion` varchar(1) DEFAULT NULL,
  `sin_polvo` varchar(1) DEFAULT NULL,
  `sin_material_ajeno` varchar(1) DEFAULT NULL,
  `ausencia_plagas` varchar(1) DEFAULT NULL,
  `sin_humedad` varchar(1) DEFAULT NULL,
  `sin_oxido` varchar(1) DEFAULT NULL,
  `ausencia_olores_extranios` varchar(1) DEFAULT NULL,
  `ausencia_material_extranio` varchar(1) DEFAULT NULL,
  `cerrado` varchar(1) DEFAULT NULL,
  `sin_agujeros` varchar(1) DEFAULT NULL,
  `observaciones` text,
  PRIMARY KEY (`id_inspeccion_documentos`),
  KEY `insp_recepcion_enc_idx` (`id_recepcion_enc`),
  CONSTRAINT `insp_recepcion_enc` FOREIGN KEY (`id_recepcion_enc`) REFERENCES `recepcion_encabezado` (`id_recepcion_enc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inspeccion_documentos_vehiculos`
--

LOCK TABLES `inspeccion_documentos_vehiculos` WRITE;
/*!40000 ALTER TABLE `inspeccion_documentos_vehiculos` DISABLE KEYS */;
INSERT INTO `inspeccion_documentos_vehiculos` VALUES (15,15,'1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','Ninguna');
/*!40000 ALTER TABLE `inspeccion_documentos_vehiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inspeccion_empaque_etiqueta`
--

DROP TABLE IF EXISTS `inspeccion_empaque_etiqueta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inspeccion_empaque_etiqueta` (
  `id_inspeccion_empaque` int(11) NOT NULL AUTO_INCREMENT,
  `id_recepcion_enc` int(11) DEFAULT NULL,
  `no_golpeado` varchar(1) DEFAULT NULL,
  `sin_roturas` varchar(1) DEFAULT NULL,
  `cerrado` varchar(1) DEFAULT NULL,
  `seco_limpio` varchar(1) DEFAULT NULL,
  `sin_material_extranio` varchar(1) DEFAULT NULL,
  `debidamente_identificado` varchar(1) DEFAULT NULL,
  `identificacion_legible` varchar(1) DEFAULT NULL,
  `no_lote_presente` varchar(1) DEFAULT NULL,
  `no_lote_legible` varchar(1) DEFAULT NULL,
  `fecha_vencimiento_legible` varchar(1) DEFAULT NULL,
  `fecha_vencimiento_vigente` varchar(1) DEFAULT NULL,
  `contenido_neto_declarado` varchar(1) DEFAULT NULL,
  `observaciones` text,
  PRIMARY KEY (`id_inspeccion_empaque`),
  KEY `inspeccion_empaque_recepcion_enc_idx` (`id_recepcion_enc`),
  CONSTRAINT `inspeccion_empaque_recepcion_enc` FOREIGN KEY (`id_recepcion_enc`) REFERENCES `recepcion_encabezado` (`id_recepcion_enc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inspeccion_empaque_etiqueta`
--

LOCK TABLES `inspeccion_empaque_etiqueta` WRITE;
/*!40000 ALTER TABLE `inspeccion_empaque_etiqueta` DISABLE KEYS */;
INSERT INTO `inspeccion_empaque_etiqueta` VALUES (15,15,'1','1','1','1','1','1','1','1','1','1','1','0','Ok');
/*!40000 ALTER TABLE `inspeccion_empaque_etiqueta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laminado_det`
--

DROP TABLE IF EXISTS `laminado_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laminado_det` (
  `id_det_laminado` int(11) NOT NULL AUTO_INCREMENT,
  `id_enc_laminado` int(11) DEFAULT NULL,
  `temperatura_inicio` double DEFAULT NULL,
  `temperatura_observaciones` varchar(45) DEFAULT NULL,
  `espesor_inicio` double DEFAULT NULL,
  `espesor_observaciones` varchar(45) DEFAULT NULL,
  `lote_producto` varchar(45) DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_laminado`),
  KEY `laminado_det_id_encabezado_idx` (`id_enc_laminado`),
  CONSTRAINT `laminado_det_id_encabezado` FOREIGN KEY (`id_enc_laminado`) REFERENCES `laminado_enc` (`id_enc_laminado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laminado_det`
--

LOCK TABLES `laminado_det` WRITE;
/*!40000 ALTER TABLE `laminado_det` DISABLE KEYS */;
INSERT INTO `laminado_det` VALUES (49,25,34,NULL,1.25,'B','213','17:13:22',1795,1),(50,25,34,'observaciones',1.25,'observaciones','213','17:28:02',1795,1),(51,25,34,'observaciones -14 minutos antes',1.25,'observcaciones','213','17:28:34',1795,1),(52,25,34,'observaciones -12 minutos antes',1.25,'observaciones','213','17:30:42',1795,1),(53,25,34,'observaciones -9 minutos antes',1.25,'observaciones','213','17:36:14',1795,1),(54,25,34,'-120 minutos antes',1.25,NULL,'213','15:50:49',1795,1);
/*!40000 ALTER TABLE `laminado_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laminado_enc`
--

DROP TABLE IF EXISTS `laminado_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laminado_enc` (
  `id_enc_laminado` int(11) NOT NULL AUTO_INCREMENT,
  `id_responsable` int(11) DEFAULT NULL,
  `turno` varchar(45) DEFAULT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `no_orden` varchar(45) DEFAULT NULL,
  `id_control` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_enc_laminado`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laminado_enc`
--

LOCK TABLES `laminado_enc` WRITE;
/*!40000 ALTER TABLE `laminado_enc` DISABLE KEYS */;
INSERT INTO `laminado_enc` VALUES (25,1,'1','2020-03-02 23:13:14','1',NULL,NULL,NULL,63,'213');
/*!40000 ALTER TABLE `laminado_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laminado_sopas_det`
--

DROP TABLE IF EXISTS `laminado_sopas_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laminado_sopas_det` (
  `id_laminado_sopas_det` int(11) NOT NULL AUTO_INCREMENT,
  `id_laminado_sopas_enc` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hora` varchar(45) DEFAULT NULL,
  `velocidad_laminado` varchar(45) DEFAULT NULL,
  `espesor_lamina` varchar(45) DEFAULT NULL,
  `presion_regulador_vapor` varchar(45) DEFAULT NULL,
  `indice_precoccion` varchar(45) DEFAULT NULL,
  `temperatura_precoccion_inicio` varchar(45) DEFAULT NULL,
  `temperatura_precoccion_salida` varchar(45) DEFAULT NULL,
  `tiempo_precoccion` varchar(45) DEFAULT NULL,
  `velocidad` varchar(45) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_laminado_sopas_det`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laminado_sopas_det`
--

LOCK TABLES `laminado_sopas_det` WRITE;
/*!40000 ALTER TABLE `laminado_sopas_det` DISABLE KEYS */;
INSERT INTO `laminado_sopas_det` VALUES (10,9,1,'2020-03-04 00:19:23','18:19:21','12','21','21','21','332','1','21','21212',NULL),(11,9,1,'2020-03-04 00:19:32','18:19:30','2121','2121','21','2121','2121','21','2121','21','-14 minutos antes'),(12,9,1,'2020-03-04 00:21:05','18:21:02','2121','121','2121','2121','21','21','21','21','-13 minutos antes'),(13,9,1,'2020-03-04 00:22:38','18:22:36','78','78','78','78','78','87','78','78','45'),(14,9,1,'2020-03-04 00:24:42','18:24:40','21','1','4','5','5','6','6','7','7 -12 minutos antes');
/*!40000 ALTER TABLE `laminado_sopas_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laminado_sopas_enc`
--

DROP TABLE IF EXISTS `laminado_sopas_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laminado_sopas_enc` (
  `id_laminado_sopas_enc` int(11) NOT NULL AUTO_INCREMENT,
  `id_control` int(11) DEFAULT NULL,
  `id_turno` varchar(45) DEFAULT NULL,
  `id_presentacion` int(11) DEFAULT NULL,
  `id_usuario` varchar(45) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `observaciones` varchar(45) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_laminado_sopas_enc`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laminado_sopas_enc`
--

LOCK TABLES `laminado_sopas_enc` WRITE;
/*!40000 ALTER TABLE `laminado_sopas_enc` DISABLE KEYS */;
INSERT INTO `laminado_sopas_enc` VALUES (9,64,'1',NULL,'1','2020-03-04 00:19:15','2121',1758,'2121');
/*!40000 ALTER TABLE `laminado_sopas_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linea_chaomin`
--

DROP TABLE IF EXISTS `linea_chaomin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linea_chaomin` (
  `id_chaomin` int(11) NOT NULL AUTO_INCREMENT,
  `no_orden_produccion` varchar(50) DEFAULT NULL,
  `id_presentacion` varchar(45) DEFAULT NULL,
  `turno` varchar(45) DEFAULT NULL,
  `cant_solucion_carga` varchar(45) DEFAULT NULL,
  `cant_carga_salida` varchar(45) DEFAULT NULL,
  `cantidad_solucion_observacion` varchar(45) DEFAULT NULL,
  `ph_solucion` varchar(45) DEFAULT NULL,
  `ph_solucion_salida` varchar(45) DEFAULT NULL,
  `ph_solucion_observacion` varchar(45) DEFAULT NULL,
  `mezcla_seca` varchar(45) DEFAULT NULL,
  `mezcla_seca_observacion` varchar(45) DEFAULT NULL,
  `mezcla_alta` varchar(45) DEFAULT NULL,
  `mezcla_alta_observacion` varchar(45) DEFAULT NULL,
  `mezcla_baja` varchar(45) DEFAULT NULL,
  `mezcla_baja_observacion` varchar(45) DEFAULT NULL,
  `temperatura_reposo` varchar(45) DEFAULT NULL,
  `temperatura_reposo_observacion` varchar(45) DEFAULT NULL,
  `ancho_cartucho` varchar(45) DEFAULT NULL,
  `ancho_cartucho_observacion` varchar(45) DEFAULT NULL,
  `temperatura_precocedora_1` varchar(45) DEFAULT NULL,
  `temperatura_precocedora_1_observacion` varchar(45) DEFAULT NULL,
  `tiempo_precocedora_1` varchar(45) DEFAULT NULL,
  `tiempo_precocedora_1_observacion` varchar(45) DEFAULT NULL,
  `temperatura_precocedora_2` varchar(45) DEFAULT NULL,
  `temperatura_precocedora_2_observacion` varchar(45) DEFAULT NULL,
  `tiempo_precocedora_2` varchar(45) DEFAULT NULL,
  `tiempo_precocedora_2_observacion` varchar(45) DEFAULT NULL,
  `temperatura_central` varchar(45) DEFAULT NULL,
  `temperatura_central_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pass200` varchar(45) DEFAULT NULL,
  `velocidad_pass200_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pasc180` varchar(45) DEFAULT NULL,
  `velocidad_pasc180_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pask180` varchar(45) DEFAULT NULL,
  `velocidad_pask180_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pasi180` varchar(45) DEFAULT NULL,
  `velocidad_pasi180_observaciones` varchar(45) DEFAULT NULL,
  `velocidad_pasm160` varchar(45) DEFAULT NULL,
  `velocidad_pasm160_observaciones` varchar(45) DEFAULT NULL,
  `extractor_activo` varchar(45) DEFAULT NULL,
  `extractor_activo_observaciones` varchar(45) DEFAULT NULL,
  `ventilacion_ideal` varchar(45) DEFAULT NULL,
  `ventilacion_ideal_observaciones` varchar(45) DEFAULT NULL,
  `verificacion_codificado` varchar(45) DEFAULT NULL,
  `verificacion_codificado_observaciones` varchar(45) DEFAULT NULL,
  `sello_1` varchar(45) DEFAULT NULL,
  `sellor_1_observaciones` varchar(45) DEFAULT NULL,
  `sello_2` varchar(45) DEFAULT NULL,
  `sellor_2_observaciones` varchar(45) DEFAULT NULL,
  `observaciones_acciones` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_chaomin`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea_chaomin`
--

LOCK TABLES `linea_chaomin` WRITE;
/*!40000 ALTER TABLE `linea_chaomin` DISABLE KEYS */;
INSERT INTO `linea_chaomin` VALUES (1,'orde001',NULL,NULL,'10',NULL,NULL,'20',NULL,NULL,'30','obs  mezcla seco 60','40','obs mezcal alta','50','obs mezcla baja','60','obs temperatura reposo','70','ancho cartucho','80','temperatura 1','90','tiempo 1','100','temperatura 2','110','tiempo 2','120','temperatura 3','130','pas 200','140','pasc180','150','pask180','160','pasi 180','170','pasm160','extractor','obs extractor activo','180','obs ventilacion idela','lot001','obs lot 001','sello 1','obs sello 1','sello 2','obs sello 2','estado correcto'),(2,NULL,'2','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'orden002','10','2','200',NULL,NULL,'210',NULL,NULL,'220','obs mezcal','230','obs mezcla alta','240','obs mezcla baja','250','obs reposso','260','obs ancho cartucho','270','obs temperatura 1','280','obs tiempo 1','290','obs temperatura 2','300','obs tiempo 2','310','obs temperatura secadora','320','obs vecloidad secadora','330','obs secadora pas180','340','obs pask 180','350','obs pasi 180','360','obs pasm 160','370','obs extractor activo','380','obs ventilacion idela','390','obs lote001','sello 1','obs sello1','obs sello 2','ob','sl'),(4,NULL,'3','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,'150',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,'2','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `linea_chaomin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localidades`
--

DROP TABLE IF EXISTS `localidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localidades` (
  `id_localidad` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `direccion` varchar(85) DEFAULT NULL,
  `id_encargado` int(11) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1',
  `codigo_interno` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_localidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localidades`
--

LOCK TABLES `localidades` WRITE;
/*!40000 ALTER TABLE `localidades` DISABLE KEYS */;
INSERT INTO `localidades` VALUES (1,'L00000000001','CANTONESA S.A.','Calle de los pinos 10-54 Km 15.5 carretera Roosvelt',1,'1',1),(2,'L00000000003','LOCALIDAD2','SALAMA BAJA VERAPAZ.',5,'0',2),(3,'L00000000001','mr bodegas','Zona 11',1,'0',3);
/*!40000 ALTER TABLE `localidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mezclado_sopas_det`
--

DROP TABLE IF EXISTS `mezclado_sopas_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mezclado_sopas_det` (
  `id_mezclado_sopas_det` int(11) NOT NULL AUTO_INCREMENT,
  `id_mezclado_sopas_enc` int(11) DEFAULT NULL,
  `id_usuario` varchar(45) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `no_batch` varchar(45) DEFAULT NULL,
  `hora_inicio_mezcla` varchar(45) DEFAULT NULL,
  `hora_fin_mezcla` varchar(45) DEFAULT NULL,
  `tiempo_velocidad_alta` varchar(45) DEFAULT NULL,
  `tiempo_velocidad_baja` varchar(45) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mezclado_sopas_det`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mezclado_sopas_det`
--

LOCK TABLES `mezclado_sopas_det` WRITE;
/*!40000 ALTER TABLE `mezclado_sopas_det` DISABLE KEYS */;
INSERT INTO `mezclado_sopas_det` VALUES (22,17,'1',NULL,'132','16:04:54','16:05:16','132','213','21'),(23,17,'1',NULL,'213','16:06:13','16:47:55','32','21',',excedente de 2052 segundos'),(24,17,'1',NULL,'21','16:59:59','17:09:00','13132','321',',excedente de 91 segundos'),(25,17,'1',NULL,'2121','17:02:18','17:09:04','2121','21',NULL),(26,17,'1',NULL,'2121','17:09:55','17:10:00','2121','2121','2121'),(27,17,'1',NULL,'21','17:11:07','18:11:09','90879','21',',excedente de 3152 segundos'),(28,17,'1',NULL,'150','18:11:15','18:11:21','213','2121','2121'),(29,17,'1',NULL,'Jqbs','18:12:20','18:12:38','125','6487','H'),(30,17,'1',NULL,'Jqbs','18:12:21','18:12:29','125','6487',',excedente de 65099 segundos'),(31,17,'1',NULL,'Ahba','18:12:52','18:13:02','58','69',NULL),(32,17,'1',NULL,'Ahba','18:12:54','18:13:05','58','69',',excedente de 65135 segundos');
/*!40000 ALTER TABLE `mezclado_sopas_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mezclado_sopas_enc`
--

DROP TABLE IF EXISTS `mezclado_sopas_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mezclado_sopas_enc` (
  `id_mezclado` int(11) NOT NULL AUTO_INCREMENT,
  `id_control` varchar(45) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_presentacion` int(11) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `id_turno` varchar(45) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mezclado`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mezclado_sopas_enc`
--

LOCK TABLES `mezclado_sopas_enc` WRITE;
/*!40000 ALTER TABLE `mezclado_sopas_enc` DISABLE KEYS */;
INSERT INTO `mezclado_sopas_enc` VALUES (17,'64','2020-03-03 16:04:40',1,1758,NULL,'observaciones','1','213');
/*!40000 ALTER TABLE `mezclado_sopas_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_07_31_140924_create_permission_tables',2),(4,'2019_07_31_183813_create_activity_log_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`(191)),
  KEY `model_has_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(1,'App\\User',3),(1,'App\\User',5),(1,'App\\User',9),(1,'App\\User',10),(2,'App\\User',11);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `numero_documento` varchar(45) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `tipo_movimiento` int(11) DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `fecha_hora_movimiento` datetime DEFAULT NULL,
  `ubicacion` varchar(80) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `clave_autorizacion` varchar(45) DEFAULT NULL,
  `usuario_autorizo` int(11) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `id_localidad` int(11) DEFAULT NULL,
  `id_bodega` int(11) DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `id_pasillo` int(11) DEFAULT NULL,
  `id_rack` int(11) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL,
  `id_posicion` int(11) DEFAULT NULL,
  `id_bin` int(11) DEFAULT NULL,
  `observaciones` text,
  PRIMARY KEY (`id_movimiento`),
  KEY `movimientos_tipo_idx` (`tipo_movimiento`),
  KEY `movimiento_producto_idx` (`id_producto`),
  CONSTRAINT `movimiento_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `movimiento_tipo` FOREIGN KEY (`tipo_movimiento`) REFERENCES `tipo_movimiento` (`id_movimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (45,'Doc123',1,1,650.00,1546,'2020-02-26 09:10:19','4140754842000017','AJO2602','2020-07-28','1234',1,'1',1,21,1,0,0,0,0,0,''),(46,'Doc123',1,1,540.00,1578,'2020-02-26 09:10:19','4140754842000017','R2602','2020-07-30','1234',1,'1',1,21,1,0,0,0,0,0,''),(47,'Doc123',1,1,655.00,1555,'2020-02-26 09:10:19','4140754842000017','CS2602','2020-07-17','1234',1,'1',1,21,1,0,0,0,0,0,''),(48,'Doc123',1,1,580.00,1547,'2020-02-26 09:10:19','4140754842000017','AR2602','2020-07-22','1234',1,'1',1,21,1,0,0,0,0,0,''),(49,'Doc123',1,1,1500.00,1546,'2020-02-26 09:10:19','4140754842000017','2602','2020-03-27','1234',1,'1',1,21,1,0,0,0,0,0,''),(51,'PROD-20200227',1,2,1500.00,1546,'2020-02-26 09:50:31','4140754842000017','2602','2020-03-27','1234',1,'1',1,21,1,0,0,0,0,0,''),(52,'PROD-20200227',1,2,1.00,1546,'2020-02-26 09:50:31','4140754842000017','AJO2602','2020-07-28','1234',1,'1',1,21,1,0,0,0,0,0,''),(53,'PROD-20200227',1,2,55.00,1555,'2020-02-26 09:50:31','4140754842000017','CS2602','2020-07-17','1234',1,'1',1,21,1,0,0,0,0,0,''),(54,'PROD-20200227-1',1,2,150.00,1546,'2020-02-26 09:53:40','4140754842000017','AJO2602','2020-07-28','1234',1,'1',1,21,1,0,0,0,0,0,''),(55,'PROD-20200227-1',1,2,85.00,1547,'2020-02-26 09:53:40','4140754842000017','AR2602','2020-07-22','1234',1,'1',1,21,1,0,0,0,0,0,''),(56,'PROD-20200227-1',1,2,55.00,1555,'2020-02-26 09:53:40','4140754842000017','CS2602','2020-07-17','1234',1,'1',1,21,1,0,0,0,0,0,''),(57,'PROD-20200227-1',1,2,40.00,1578,'2020-02-26 09:53:40','4140754842000017','R2602','2020-07-30','1234',1,'1',1,21,1,0,0,0,0,0,'');
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel`
--

DROP TABLE IF EXISTS `nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivel` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `id_rack` int(11) DEFAULT NULL,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `codigo_interno` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_nivel`),
  KEY `nivel_rack_idx` (`id_rack`),
  CONSTRAINT `nivel_rack` FOREIGN KEY (`id_rack`) REFERENCES `racks` (`id_rack`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel`
--

LOCK TABLES `nivel` WRITE;
/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
INSERT INTO `nivel` VALUES (1,2,'NIVEL01','NIVEL 1.1','1',1),(2,2,'NIVEL2','NIVEL 2','0',2),(3,4,'NIVEL00009','NIVEL 9','1',1),(4,5,'nivelnivelnivel','nivelnivelnivel','1',1);
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasillos`
--

DROP TABLE IF EXISTS `pasillos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasillos` (
  `id_pasillo` int(11) NOT NULL AUTO_INCREMENT,
  `id_sector` int(11) DEFAULT NULL,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `id_encargado` int(11) DEFAULT NULL,
  `codigo_interno` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_pasillo`),
  KEY `pasillo_sector_idx` (`id_sector`),
  CONSTRAINT `pasillo_sector` FOREIGN KEY (`id_sector`) REFERENCES `sectores` (`id_sector`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasillos`
--

LOCK TABLES `pasillos` WRITE;
/*!40000 ALTER TABLE `pasillos` DISABLE KEYS */;
INSERT INTO `pasillos` VALUES (7,3,'PASS123','PASILLO1','1',1,1),(8,5,'CODI09','PASILLO 12 - SEC','1',1,1);
/*!40000 ALTER TABLE `pasillos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `orden_menu` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_menu` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'role-list','web',NULL,NULL,'0','1',' fa-eye ','Ver','1'),(2,'role-create','web',NULL,NULL,'0','1','fa-plus  ','Crear','1'),(3,'role-edit','web',NULL,NULL,'0','1',' fa-pencil  ','Editar','1'),(4,'role-delete','web',NULL,NULL,'0','1',' fa-minus-circle  ','Dar de baja','1'),(5,'permisos','web',NULL,NULL,'1','0','fa-lock','Permisos','1'),(6,'usuarios','web',NULL,NULL,'10','0',' fa-cogs','Usuarios','1'),(23,'administrar','web',NULL,NULL,'0','10',' fa-cog ','Administrar','1'),(24,'roles','web',NULL,NULL,'0','10','fa-wrench','Roles','1'),(25,'registro','web',NULL,NULL,'2','0',' fa fa-file-text ','Registro','1'),(26,'proveedores','web',NULL,NULL,'0','2','fa fa-users','Proveedores','1'),(29,'productos','web',NULL,NULL,'0','2','fa fa-tags','Productos','1'),(32,'clientes','web',NULL,NULL,'0','2','fa fa-shopping-cart','Clientes','1'),(33,'localidades','web',NULL,NULL,'0','2','fa fa-building','Localidades','1'),(34,'bodegas','web',NULL,NULL,'0','2','fa fa-building-o','Areas','1'),(42,'recepcion','web',NULL,NULL,'3','0',' fa fa-arrow-circle-o-right ','Recepcion','1'),(43,'materia_prima','web',NULL,NULL,'0','3',' fa fa fa-sign-in  ','Materia Prima','1'),(44,'colaboradores','web',NULL,NULL,'0','2','fa fa-male','Colaboradores','1'),(45,'cambia_pass','web',NULL,NULL,'0','1','fa fa-lock','Cambiar contraseña','1'),(46,'importar','web',NULL,NULL,'0','1','fa fa-upload','Importar','1'),(47,'control_calidad','web',NULL,NULL,'0','3','fa-arrow-right','Control de Calidad','1'),(48,'verificacion_ingreso','web',NULL,NULL,'0','1','fa-unlock-alt','Autorizar Ubicacion','1'),(49,'ubicacion_producto','web',NULL,NULL,'0','3','fa fa-building-o','Asignar Ubicacion','1'),(50,'produccion','web',NULL,NULL,'4','0',' fa fa fa-cube ','Produccion','1'),(51,'control_chaomein','web',NULL,NULL,'5','0',' fa fa fa-check-square-o ','Control Chaomin','1'),(52,'control_sopas','web',NULL,NULL,'6','0',' fa fa fa-dot-circle-o ','Control Sopas','1'),(53,'kardex','web',NULL,NULL,'0','3','fa fa-th-list','Existencias ','1'),(54,'sectores','web',NULL,NULL,'0','2','fa-square-o','Bodegas','1'),(55,'generar_reporte','web',NULL,NULL,'0','1','fa-print','Generar Reporte','1'),(56,'actividades','web',NULL,NULL,'0','2','fa-hand-lizard-o','Actividades','1'),(57,'presentaciones','web',NULL,NULL,'0','2','fa-th-large','Presentaciones','1'),(58,'requisiciones','web',NULL,NULL,'0','4','fa fa-pencil-square','Requisiciones','1'),(59,'picking','web',NULL,NULL,'0','4','fa fa-hand-rock-o','Picking','1'),(60,'control_trazabilidad','web',NULL,NULL,'0','4','fa fa-list-alt','Control Trazabilidad','1'),(61,'verificacion_materia_chaomein','web',NULL,NULL,'0','5',' fa-check','Verificacion de materias rimas chao mein','1'),(62,'liberacion_chaomein','web',NULL,NULL,'0','5','fa fa-line-chart','Liberacion Linea Chao mein','1'),(63,'verficacion_materia_mezcladora','web',NULL,NULL,'0','5','fa-check-circle','Verificacion de materias primas en mezcladora','1'),(64,'mezcla_harina_chaomein','web',NULL,NULL,'0','5','fa fa-spoon','Mezcla de Harina','1'),(65,'laminado_chaomein','web',NULL,NULL,'0','5','fa fa-th','Laminado','1'),(66,'peso_humedo_chaomein','web',NULL,NULL,'0','5','fa fa-signal','Peso Humedo','1'),(67,'peso_seco_chaomein','web',NULL,NULL,'0','5','fa fa-bar-chart','Peso Seco','1'),(68,'precocido_pasta','web',NULL,NULL,'0','5','fa fa-cutlery','Pre-cocido de Pasta','1'),(71,'verificacion_materia_sopas','web',NULL,NULL,'0','6','fa-check-square','Verificacion de Materias primas Sopas','1'),(72,'liberacion_sopas','web',NULL,NULL,'0','6','fa-flag-o','Liberacion de Sopas','1'),(73,'mezclado_sopas','web',NULL,NULL,'0','6','fa-spinner','Mezclado de Sopas','1'),(74,'laminado_sopas','web',NULL,NULL,'0','6','fa fa-th-large','Laminado y Precoccion','1'),(75,'fritura_ropas','web',NULL,NULL,'0','6',' fa fa fa-fire  ','Fritura','1'),(76,'peso_pasta','web',NULL,NULL,'0','6','fa fa-industry','Peso de la pasta','1');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peso_humedo_det`
--

DROP TABLE IF EXISTS `peso_humedo_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peso_humedo_det` (
  `id_peso_humedo_det` int(11) NOT NULL AUTO_INCREMENT,
  `hora` varchar(45) DEFAULT NULL,
  `muestra_no1` varchar(45) DEFAULT NULL,
  `muestra_no2` varchar(45) DEFAULT NULL,
  `muestra_no3` varchar(45) DEFAULT NULL,
  `muestra_no4` varchar(45) DEFAULT NULL,
  `muestra_no5` varchar(45) DEFAULT NULL,
  `producto` varchar(45) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `id_peso_humedo_enc` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_peso_humedo_det`),
  KEY `id_peso_humedo_enc_idx` (`id_peso_humedo_enc`),
  CONSTRAINT `id_peso_humedo_enc` FOREIGN KEY (`id_peso_humedo_enc`) REFERENCES `peso_humedo_enc` (`id_peso_humedo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peso_humedo_det`
--

LOCK TABLES `peso_humedo_det` WRITE;
/*!40000 ALTER TABLE `peso_humedo_det` DISABLE KEYS */;
INSERT INTO `peso_humedo_det` VALUES (35,'14:18:35','21','21','262','122','15','1795','21',NULL,15,1),(36,'14:18:55','253','262','261','262','262','1795','21','-14 minutos antes',15,1),(37,'14:20:30','45','12','12','23','23','1795','21','-13 minutos antes',15,1),(38,'14:20:57','213','262','264','264','264','1795','21','-14 minutos antes',15,1),(39,'14:21:58','262','261','2621','264','264','1795','21','Los valores estan un poco excedidos -13 minutos antes',15,1),(40,'15:59:01','15','1','515','1','1','1795','21','1 Excede -82 minutos -14 minutos antes',15,1);
/*!40000 ALTER TABLE `peso_humedo_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peso_humedo_enc`
--

DROP TABLE IF EXISTS `peso_humedo_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peso_humedo_enc` (
  `id_peso_humedo` int(11) NOT NULL AUTO_INCREMENT,
  `cortador_no` varchar(45) DEFAULT NULL,
  `turno` varchar(45) DEFAULT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `no_orden` varchar(45) DEFAULT NULL,
  `id_control` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_peso_humedo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peso_humedo_enc`
--

LOCK TABLES `peso_humedo_enc` WRITE;
/*!40000 ALTER TABLE `peso_humedo_enc` DISABLE KEYS */;
INSERT INTO `peso_humedo_enc` VALUES (15,NULL,'1','2020-03-03 20:18:28',1,NULL,'Se estan tomando registro cada 15 min',NULL,63,'21');
/*!40000 ALTER TABLE `peso_humedo_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peso_pasta_det`
--

DROP TABLE IF EXISTS `peso_pasta_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peso_pasta_det` (
  `id_peso_pasta_det` int(11) NOT NULL AUTO_INCREMENT,
  `id_peso_pasta_enc` int(11) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `no_1` varchar(45) DEFAULT NULL,
  `no_2` varchar(45) DEFAULT NULL,
  `no_3` varchar(45) DEFAULT NULL,
  `no_4` varchar(45) DEFAULT NULL,
  `largo_fideo` varchar(45) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_peso_pasta_det`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peso_pasta_det`
--

LOCK TABLES `peso_pasta_det` WRITE;
/*!40000 ALTER TABLE `peso_pasta_det` DISABLE KEYS */;
INSERT INTO `peso_pasta_det` VALUES (10,7,'2020-03-04 00:43:36',1,'18:43:34','21','21','21','21',NULL,'21'),(11,7,'2020-03-04 00:43:42',1,'18:43:40','21','21','21','21',NULL,'21 -14 minutos antes'),(12,7,'2020-03-04 00:43:48',1,'18:43:46','21','21','21','21',NULL,'21 -14 minutos antes'),(13,7,'2020-03-04 00:44:44',1,'18:44:42','21','21','21','21',NULL,'21 -14 minutos antes'),(14,7,'2020-03-04 00:45:25',1,'18:45:23','21213','321','321','31',NULL,'*321* -14 minutos antes'),(15,7,'2020-03-04 00:45:39',1,'18:45:37','212','21','21','21',NULL,'21 -14 minutos antes'),(16,7,'2020-03-04 00:45:46',1,'18:45:44','2','23','32','21',NULL,'21 -14 minutos antes'),(17,7,'2020-03-04 00:47:07',1,'18:47:05','12','12','21','21',NULL,'21 -13 minutos antes');
/*!40000 ALTER TABLE `peso_pasta_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peso_pasta_enc`
--

DROP TABLE IF EXISTS `peso_pasta_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peso_pasta_enc` (
  `id_peso_pasta_enc` int(11) NOT NULL AUTO_INCREMENT,
  `id_control` int(11) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_producto` int(11) DEFAULT NULL,
  `id_presentacion` int(11) DEFAULT NULL,
  `id_turno` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_peso_pasta_enc`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peso_pasta_enc`
--

LOCK TABLES `peso_pasta_enc` WRITE;
/*!40000 ALTER TABLE `peso_pasta_enc` DISABLE KEYS */;
INSERT INTO `peso_pasta_enc` VALUES (7,64,'2020-03-04 00:43:29',1758,NULL,'1',1,'observaciones','21');
/*!40000 ALTER TABLE `peso_pasta_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peso_seco_det`
--

DROP TABLE IF EXISTS `peso_seco_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peso_seco_det` (
  `id_peso_seco_det` int(11) NOT NULL AUTO_INCREMENT,
  `hora` varchar(45) DEFAULT NULL,
  `muestra_no1` varchar(45) DEFAULT NULL,
  `muestra_no2` varchar(45) DEFAULT NULL,
  `muestra_no3` varchar(45) DEFAULT NULL,
  `muestra_no4` varchar(45) DEFAULT NULL,
  `muestra_no5` varchar(45) DEFAULT NULL,
  `producto` varchar(45) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `id_peso_seco_enc` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_peso_seco_det`),
  KEY `id_peso_detale_idx` (`id_peso_seco_enc`),
  CONSTRAINT `id_peso_detale` FOREIGN KEY (`id_peso_seco_enc`) REFERENCES `peso_seco_enc` (`id_peso_seco`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peso_seco_det`
--

LOCK TABLES `peso_seco_det` WRITE;
/*!40000 ALTER TABLE `peso_seco_det` DISABLE KEYS */;
INSERT INTO `peso_seco_det` VALUES (14,'14:30:08','186','185','185','184','185','1795','213','OBSERVACIONES',7,1),(15,'14:30:51','185','186','184','182','183','1795','213','-14 minutos antes',7,1),(16,'14:31:43','182','186','182','186','183','1795','213','observaciones -14 minutos antes',7,1),(17,'14:33:54','185','184','183','182','182','1795','213','-12 minutos antes',7,1),(18,'16:47:46','21','21','21','21','21','1795',NULL,'Excede -118 minutos',7,1),(19,'18:10:24','186','185','184','182','183','1795','213','Excede -67 minutos',7,1),(20,'16:01:16','1','2','3','4','5','1795','213','-144 minutos antes',7,1),(21,'16:02:56','2','3','4','5','6','1795','213','-13 minutos antes',7,1);
/*!40000 ALTER TABLE `peso_seco_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peso_seco_enc`
--

DROP TABLE IF EXISTS `peso_seco_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peso_seco_enc` (
  `id_peso_seco` int(11) NOT NULL AUTO_INCREMENT,
  `turno` varchar(45) DEFAULT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `no_orden` varchar(45) DEFAULT NULL,
  `id_control` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_peso_seco`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peso_seco_enc`
--

LOCK TABLES `peso_seco_enc` WRITE;
/*!40000 ALTER TABLE `peso_seco_enc` DISABLE KEYS */;
INSERT INTO `peso_seco_enc` VALUES (7,'1','2020-03-03 20:29:53',1,NULL,NULL,NULL,63,'213');
/*!40000 ALTER TABLE `peso_seco_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `picking_encabezado`
--

DROP TABLE IF EXISTS `picking_encabezado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `picking_encabezado` (
  `id_picking` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `id_requisicion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_picking`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `picking_encabezado`
--

LOCK TABLES `picking_encabezado` WRITE;
/*!40000 ALTER TABLE `picking_encabezado` DISABLE KEYS */;
INSERT INTO `picking_encabezado` VALUES (1,NULL,'2019-11-19 00:08:25',NULL,'P',1),(2,1,'2020-01-30 15:56:55','2020-01-30 16:19:04','D',2),(3,1,'2020-01-31 19:07:43','2020-01-31 19:10:27','D',3),(4,1,'2020-02-04 14:38:33','2020-02-04 14:42:44','D',4),(5,1,'2020-02-05 14:19:23','2020-02-05 14:50:00','D',5),(6,1,'2020-02-12 17:59:05','2020-02-12 18:00:33','D',8),(7,10,'2020-02-12 17:59:11','2020-02-12 18:05:08','D',7),(8,10,'2020-02-12 21:02:28','2020-02-12 21:03:21','D',9),(9,10,'2020-02-12 22:03:11','2020-02-12 22:05:12','D',10),(10,1,'2020-02-26 15:22:00','2020-02-26 15:22:35','D',12),(11,1,'2020-02-26 15:48:36','2020-02-26 15:53:40','D',16),(12,1,'2020-02-26 15:48:47','2020-02-26 15:50:31','D',15),(13,NULL,'2020-03-09 18:43:55',NULL,'P',17);
/*!40000 ALTER TABLE `picking_encabezado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posiciones`
--

DROP TABLE IF EXISTS `posiciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posiciones` (
  `id_posicion` int(11) NOT NULL AUTO_INCREMENT,
  `id_nivel` int(11) DEFAULT NULL,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `codigo_interno` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_posicion`),
  KEY `posicion_nivel_idx` (`id_nivel`),
  CONSTRAINT `posicion_nivel` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posiciones`
--

LOCK TABLES `posiciones` WRITE;
/*!40000 ALTER TABLE `posiciones` DISABLE KEYS */;
INSERT INTO `posiciones` VALUES (1,1,'1','POSICION 1','1',1),(2,1,'POSICION21','POSICION21','0',2),(3,3,'PASILLO0009','PASILLO   9','1',1),(4,4,'21312','POSICIONE1','1',1);
/*!40000 ALTER TABLE `posiciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precocido_det`
--

DROP TABLE IF EXISTS `precocido_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precocido_det` (
  `id_precocido_det` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` varchar(45) DEFAULT NULL,
  `hora_salida` varchar(45) DEFAULT NULL,
  `tiempo_efectivo` varchar(45) DEFAULT NULL,
  `alcance_presion` varchar(45) DEFAULT NULL,
  `temperatura` varchar(45) DEFAULT NULL,
  `id_producto` varchar(45) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `responsable` varchar(45) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `id_precocido_enc` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_precocido_det`),
  KEY `id_precocido_enc_idx` (`id_precocido_enc`),
  CONSTRAINT `id_precocido_enc` FOREIGN KEY (`id_precocido_enc`) REFERENCES `precocido_enc` (`id_precocido_enc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precocido_det`
--

LOCK TABLES `precocido_det` WRITE;
/*!40000 ALTER TABLE `precocido_det` DISABLE KEYS */;
INSERT INTO `precocido_det` VALUES (16,'14:07','14:39:14','21','2121','2121','1795','154',NULL,NULL,14,1),(17,'14:46:45','14:46','78','78','21','1795','154',NULL,'20',14,1),(18,'14:49:26','15:06:40','21','21','21','1795','154',NULL,'21',14,1),(19,'15:07:03','15:07:14','21','21','21','1795','154',NULL,'21',14,1),(20,'15:08:43','15:08:54','3','3','3','1795','154',NULL,NULL,14,1),(21,'15:08:49','15:10:44','32','32','32','1795','154',NULL,'32',14,1),(22,'16:13:53','16:14:02','150','150','temp','1795','154',NULL,NULL,14,1),(23,'16:14:20','16:14:24','1','1','1','1795','154',NULL,'2',14,1);
/*!40000 ALTER TABLE `precocido_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precocido_enc`
--

DROP TABLE IF EXISTS `precocido_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precocido_enc` (
  `id_precocido_enc` int(11) NOT NULL AUTO_INCREMENT,
  `turno` varchar(45) DEFAULT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `no_orden` varchar(45) DEFAULT NULL,
  `id_control` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_precocido_enc`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precocido_enc`
--

LOCK TABLES `precocido_enc` WRITE;
/*!40000 ALTER TABLE `precocido_enc` DISABLE KEYS */;
INSERT INTO `precocido_enc` VALUES (14,'1','2020-03-03 20:37:12',1,NULL,NULL,63,'154');
/*!40000 ALTER TABLE `precocido_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentaciones`
--

DROP TABLE IF EXISTS `presentaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentaciones` (
  `id_presentacion` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) NOT NULL,
  `estado` varchar(1) DEFAULT '1',
  `creado_por` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_presentacion`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentaciones`
--

LOCK TABLES `presentaciones` WRITE;
/*!40000 ALTER TABLE `presentaciones` DISABLE KEYS */;
INSERT INTO `presentaciones` VALUES (59,NULL,'PAS200','1',1,'2020-02-04 16:55:37','2020-02-04 16:55:37'),(60,NULL,'PASK180','1',1,'2020-02-04 16:57:10','2020-02-04 16:57:10'),(61,NULL,'PASI180','1',1,'2020-02-04 16:57:39','2020-02-04 16:58:17'),(62,NULL,'PASC180','1',1,'2020-02-04 16:58:37','2020-02-04 16:58:37'),(63,NULL,'PASM160','1',1,'2020-02-04 16:59:39','2020-02-04 16:59:39'),(64,NULL,'PASK200','1',1,'2020-02-04 16:59:50','2020-02-04 16:59:50');
/*!40000 ALTER TABLE `presentaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_presentacion`
--

DROP TABLE IF EXISTS `producto_presentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_presentacion` (
  `id_producto` int(11) DEFAULT NULL,
  `id_presentacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_presentacion`
--

LOCK TABLES `producto_presentacion` WRITE;
/*!40000 ALTER TABLE `producto_presentacion` DISABLE KEYS */;
INSERT INTO `producto_presentacion` VALUES (1706,61),(1706,62),(1706,61),(1706,62),(1706,63),(1706,61),(1706,62),(1706,63),(1769,59),(1759,59),(1759,60),(1759,61),(1759,62),(1759,63),(1759,64),(1708,59),(1708,60),(1708,61),(1708,62),(1708,63),(1708,64),(1758,64),(1795,62);
/*!40000 ALTER TABLE `producto_presentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `codigo_interno` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `id_dimensional` int(11) DEFAULT NULL,
  `id_presentacion` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `tipo_producto` varchar(2) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `creado_por` int(11) DEFAULT NULL,
  `unidad_medida` varchar(25) DEFAULT NULL,
  `codigo_proveedor` varchar(50) DEFAULT NULL,
  `dias_vencimiento` int(11) DEFAULT NULL,
  `codigo_interno_cliente` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `idx_codigo_barras` (`codigo_barras`),
  KEY `idx_codigo_interno` (`codigo_interno`),
  KEY `producto_dimensional_idx` (`id_dimensional`),
  KEY `producto_presentacion_idx` (`id_presentacion`),
  KEY `producto_proveedor_idx` (`id_proveedor`),
  CONSTRAINT `producto_dimensional` FOREIGN KEY (`id_dimensional`) REFERENCES `dimensionales` (`id_dimensional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `producto_presentacion` FOREIGN KEY (`id_presentacion`) REFERENCES `presentaciones` (`id_presentacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `producto_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1796 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1495,'7404007620750','10SACH','VASO IMPRESO CARNE AL HUESO',NULL,NULL,NULL,'ME','2019-11-22 09:37:00',NULL,'1',1,'UN',NULL,NULL,NULL),(1496,'7404007620767','10SACHP','VASO IMPRESO CARNE AL HUESO PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:00',NULL,'1',1,'UN',NULL,NULL,NULL),(1497,'7404007620774','10SAG','VASO IMPRESO GALLINA PECHUGONA',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'UN',NULL,NULL,NULL),(1498,'7404007620781','10SAGP','VASO IMPRESO GALLINA PECHUGONA PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'UN',NULL,NULL,NULL),(1499,'7404007620798','10SAM','VASO IMPRESO MARISCO REBELDE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'UN',NULL,NULL,NULL),(1500,'7404007620804','10SAMP','VASO IMPRESO MARISCO REBELDE PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'UN',NULL,NULL,NULL),(1501,'7404007620811','11SA','TENEDOR PLASTICO SOPA ARIUM',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'UN',NULL,NULL,NULL),(1502,'7404007620828','5SACH','BOBINA SOPA CARNE AL HUESO',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1503,'7404007620835','5SACHP','BOBINA SOPA CARNE AL HUESO PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1504,'7404007620842','5SAG','BOBINA SOPA GALLINA PECHUGONA',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1505,'7404007620859','5SAGP','BOBINA SOPA GALLINA PECHUGONA PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1506,'7404007620866','5SAM','BOBINA SOPA MARISCO REBELDE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1507,'7404007620873','5SAMP','BOBINA SOPA MARISCO REBELDE PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1508,'7404007620880','5SSCH','BOBINA SABOR CARNE AL HUESO',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1509,'7404007620897','5SSCHP','BOBINA SABOR CARNE AL HUESO PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1510,'7404007620903','5SSG','BOBINA SABOR GALLINA PECHUGONA',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1511,'7404007620910','5SSGP','BOBINA SABOR GALLINA PECHUGONA PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1512,'7404007620927','5SSM','BOBINA SABOR MARISCO REBELDE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1513,'7404007620934','5SSMP','BOBINA SABOR MARISCO REBELDE PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:01',NULL,'1',1,'KG',NULL,NULL,NULL),(1514,'7404007620941','8SA','TAPA GENERICA SOPA HAN RAN',NULL,NULL,NULL,'ME','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1515,'7404007620958','8SACH','TAPA SOPA CARNE AL HUESO',NULL,NULL,NULL,'ME','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1516,'7404007620965','8SACHP','TAPA SOPA CARNE AL HUESO PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1517,'7404007620972','8SAG','TAPA SOPA GALLINA PECHUGONA',NULL,NULL,NULL,'ME','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1518,'7404007620989','8SAM','TAPA SOPA MARISCO REBELDE',NULL,NULL,NULL,'ME','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1519,'7404007620996','8SAMP','TAPA SOPA MARISCO REBELDE PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1520,'7404007621009','SCOH','SAZONADOR COSTILLA PICANTE',NULL,NULL,NULL,'MP','2019-11-22 09:37:02',NULL,'1',1,'KG',NULL,NULL,NULL),(1521,'7404007621016','SCO ','SAZONADOR COSTILLA ORIGINAL ',NULL,NULL,NULL,'MP','2019-11-22 09:37:02',NULL,'1',1,'KG',NULL,NULL,NULL),(1522,'7404007621023','SGH','SAZONADOR GALLINA PICANTE',NULL,NULL,NULL,'MP','2019-11-22 09:37:02',NULL,'1',1,'KG',NULL,NULL,NULL),(1523,'7404007621030','SGO','SAZONADOR GALLINA ORIGINAL',NULL,NULL,NULL,'MP','2019-11-22 09:37:02',NULL,'1',1,'KG',NULL,NULL,NULL),(1524,'7404007621047','SMO ','SAZONADOR MARISCADA  ORIGINAL ',NULL,NULL,NULL,'MP','2019-11-22 09:37:02',NULL,'1',1,'KG',NULL,NULL,NULL),(1525,'7404007621054','SMH','SAZONADOR MARISCADA PICANTE',NULL,NULL,NULL,'MP','2019-11-22 09:37:02',NULL,'1',1,'KG',NULL,NULL,NULL),(1526,'7404007621061','SSCHO','SOBRES SABOR CARNE AL HUESO ORIGINAL',NULL,NULL,NULL,'PP','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1527,'7404007621078','SSCHP','SOBRES SABOR CARNE AL HUESO PICANTE',NULL,NULL,NULL,'PP','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1528,'7404007621085','SSGPO','SOBRES SABOR GALLINA PECHUGONA ORIGINAL',NULL,NULL,NULL,'PP','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1529,'7404007621092','SSGPP','SOBRES SABOR GALLINA PECHUGONA PICANTE',NULL,NULL,NULL,'PP','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1530,'7404007621108','SSMRO','SOBRES SABOR MARISCO REBELDE ORIGINAL',NULL,NULL,NULL,'PP','2019-11-22 09:37:02',NULL,'1',1,'UN',NULL,NULL,NULL),(1531,'7404007621115','SSMRP','SOBRES SABOR MARISCO REBELDE PICANTE',NULL,NULL,NULL,'PP','2019-11-22 09:37:03',NULL,'1',1,'UN',NULL,NULL,NULL),(1532,'7404007621122','SVHR','SOBRE VERDURA HAN RAN',NULL,NULL,NULL,'PP','2019-11-22 09:37:03',NULL,'1',1,'UN',NULL,NULL,NULL),(1533,'7404007620477','MISO','MICH EN SOBRE',NULL,NULL,NULL,'PP','2019-11-22 09:38:23',NULL,'1',1,'UN',NULL,NULL,NULL),(1534,'7404007620484','MIBA','MICH A GRANEL LIBRA',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'LB',NULL,NULL,NULL),(1535,'7404007620491','SALSO','SAL MAGICA EN SOBRE',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'UN',NULL,NULL,NULL),(1536,'7404007620507','SALBA','SAL MAGICA A GRANEL LIBRA',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'LB',NULL,NULL,NULL),(1537,'7404007620514','SOYSO','SALSA SOYA EN SOBRE',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'UN',NULL,NULL,NULL),(1538,'7404007620521','SOYBA','SALSA SOYA A GRANEL GALON',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'GAL',NULL,NULL,NULL),(1539,'7404007620538','SSP','SABOR A POLLO EN SOBRE',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'UN',NULL,NULL,NULL),(1540,'7404007620545','SASPO','SABOR A POLLO GRANEL ',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'LB',NULL,NULL,NULL),(1541,'7404007620552','COBA','CONSOME DE POLLO A GRANEL',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'LB',NULL,NULL,NULL),(1542,'7404007620569','SPIS','SABOR PICANTE EN SOBRE',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'UN',NULL,NULL,NULL),(1543,'7404007620576','SOP','BASE DE SABOR PICANTE (SOP)',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'LB',NULL,NULL,NULL),(1544,'7404007620583','SSR','SOBRE SABOR A RES',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'UN',NULL,NULL,NULL),(1545,'7404007620590','SSC','SOBRE SABOR A CAMARON',NULL,NULL,NULL,'PP','2019-11-22 09:38:24',NULL,'1',1,'UN',NULL,NULL,NULL),(1546,'7404007620019','AJO','AJO DESHIDRATADO EN POLVO',NULL,NULL,NULL,'MP','2019-11-22 09:39:13',NULL,'1',1,'KG',NULL,NULL,NULL),(1547,'7404007620026','ARVE','ARVEJA LIOFILIZADA',NULL,NULL,NULL,'MP','2019-11-22 09:39:13',NULL,'1',1,'KG',NULL,NULL,NULL),(1548,'7404007620033','AZU','AZUCAR REFINADA',NULL,NULL,NULL,'MP','2019-11-22 09:39:13',NULL,'1',1,'KG',NULL,NULL,NULL),(1549,'7404007620040','BCP','AROMA  POLLO COCIDO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1550,'7404007620057','BEN','BENZOATO DE SODIO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1551,'7404007620064','BICA','BICARBONATO DE SODIO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1552,'7404007620071','BSS','BASE PARA SALSA SOYA',1,NULL,NULL,'MP','2019-11-22 09:39:14','2019-11-22 10:52:01','1',1,'UN',NULL,NULL,'074261015004'),(1553,'7404007620088','BSSC','BASE PARA SALSA SOYA CONCENTRADA',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'UN',NULL,NULL,NULL),(1554,'7404007620095','CAR','COLOR CARAMELO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1555,'7404007620101','CAS','CARBONATO DE SODIO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1556,'7404007620118','CEB','CEBOLLA DESHIDRATADA EN POLVO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1557,'7404007620125','CEBO','CEBOLLIN DESHIDRATADO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1558,'7404007620132','CEBOI','CEBOLLITA DESHIDRATADA INA',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1559,'7404007620149','CHILE','CHILE COBANERO MOLIDO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1560,'7404007620156','CHIPI','CHILE PIMIENTO VERDE DESHIDRATADO INA',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1561,'7404007620163','CHS','AROMA ARTIFICIAL TIPO CHINO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1563,'7404007620187','CIT','CITRATO DE SODIO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1564,'7404007620194','CMC','CARBOXIMETILCELULOSA FH 3000',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1565,'7404007620200','COAMA','COLOR AMARILLO HUEVO',NULL,NULL,NULL,'MP','2019-11-22 09:39:14',NULL,'1',1,'KG',NULL,NULL,NULL),(1566,'7404007620217','COR','CORIANDRO',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1567,'7404007620224','CUR','CURRY EN POLVO',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1568,'7404007620231','CURC','CURCUMA MOLIDA',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1569,'7404007620248','ELOTE','ELOTE LIOFILIZADO',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1570,'7404007620255','GLU','GLUTAMATO MONOSODICO',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1571,'7404007620262','GLUT','GLUTEN DE TRIGO',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1572,'7404007620279','HARDE','HARINA DURA E',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'BOL',NULL,NULL,NULL),(1573,'7404007620286','HARGM','HARINA GOLD MEDAL',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'BOL',NULL,NULL,NULL),(1574,'7404007620293','MARG','MARGARINA',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'LB',NULL,NULL,NULL),(1575,'7404007620309','MOFO','SODIO FOSFATO MONOBASICO',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1576,'7404007620316','PAP','PAPRIKA',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1577,'7404007620323','PER','PEREJIL DESHIDRATADO',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'LB',NULL,NULL,NULL),(1578,'7404007620330','RIBO','RIBOTIDE',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1579,'7404007620347','SAL','SAL REFINADA',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'QQ',NULL,NULL,NULL),(1580,'7404007620354','SSB','SALSA DE SOYA EN BOLSA DE 10 ML.',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'UN',NULL,NULL,NULL),(1581,'7404007620361','ZANA','ZANAHORIA DESHIDRATADA',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1582,'7404007620378','ZANAI','ZANAHORIA DESHIDRATADA INA',NULL,NULL,NULL,'MP','2019-11-22 09:39:15',NULL,'1',1,'KG',NULL,NULL,NULL),(1583,'7404007620385','BCA','BETA CAROTENO',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'KG',NULL,NULL,NULL),(1584,'7404007620392','POT','CARBONATO DE POTASIO ',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'KG',NULL,NULL,NULL),(1585,'7404007620408','CSRT','CONCENTRADO DE RES ',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'KG',NULL,NULL,NULL),(1586,'7404007620415','CSCT','CONCENTRADO DE CAMARON ',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'KG',NULL,NULL,NULL),(1587,'7404007620422','FOS','FOSFATO TRICALCICO',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'KG',NULL,NULL,NULL),(1588,'7404007620439','XAM','GOMA XANTAN 200 DEOSEN',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'KG',NULL,NULL,NULL),(1589,'7404007620446','OLE ','OLEINA',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'GL',NULL,NULL,NULL),(1590,'7404007620453','PAPA','PAPAINA 600',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'KG ',NULL,NULL,NULL),(1591,'7404007620460','RIVO','RIVOFLAVINA ',NULL,NULL,NULL,'MP','2019-11-22 09:39:16',NULL,'1',1,'KG',NULL,NULL,NULL),(1592,'7404007621207','10SICA','VASO IMPRESO CHULETA AHUMADA',NULL,NULL,NULL,'ME','2019-11-22 09:40:27',NULL,'1',1,'UN',NULL,NULL,NULL),(1593,'7404007621214','10SIPC','VASO IMPRESO POLLO CRIOLLO',NULL,NULL,NULL,'ME','2019-11-22 09:40:27',NULL,'1',1,'UN',NULL,NULL,NULL),(1594,'7404007621221','10SC','VASO IMPRESO  PARA CANTONESA',NULL,NULL,NULL,'ME','2019-11-22 09:40:27',NULL,'1',1,'UN',NULL,NULL,NULL),(1595,'7404007621238','1BL','BANDEJA PARA CHAO MEIN 1 LIBRA',NULL,NULL,NULL,'ME','2019-11-22 09:40:27',NULL,'1',1,'UN',NULL,NULL,NULL),(1596,'7404007621245','1BML','BANDEJA PARA CHAO MEIN 1/2 LIBRA',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1597,'7404007621252','1KAL','ETIQ. CHAO MEIN KANTON 1LB. SIN SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1598,'7404007621269','1KALS','ETIQ. CHAO MEIN KANTON 1LB. CON SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1599,'7404007621276','1KAML','ETIQ. CHAO MEIN KANTON 1/2 LB.SIN SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1600,'7404007621283','1MICH','ETIQ.  MICH BOTE 1 LB.',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1601,'7404007621290','1SAL','ETIQ. SAL MAGICA BOTE 1 LIBRA',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1602,'7404007621306','1SCC','FAJILLA SOPA CANTONESA CAMARON',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1603,'7404007621313','1SCH','FAJILLA SOPA CANTONESA PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1604,'7404007621320','1SCP','FAJILLA SOPA CANTONESA POLLO',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1605,'7404007621337','1SCR','FAJILLA SOPA CANTONESA RES',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1606,'7404007621344','1SOY12','ETIQUETA SOYA  12 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1607,'7404007621351','1SOY3','ETIQUETA SOYA  3 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1608,'7404007621368','1SOY5','ETIQUETA SOYA  5 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1609,'7404007621375','1SOYG','ETIQUETA SOYA  GALON',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1610,'7404007621382','2GOYA','CAJA CHAO MEIN LS EXPORTACION (GOYA)',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1611,'7404007621399','2SAL','CAJA DISPENSADORA SAL MAGICA',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1612,'7404007621405','3BISAL','BISAGRA  PARA CARTONES DE SAL MAGICA',NULL,NULL,NULL,'ME','2019-11-22 09:40:28',NULL,'1',1,'UN',NULL,NULL,NULL),(1613,'7404007621412','4CANT','EMB. CHAO MEIN CANTONES',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1614,'7404007621429','4COND','EMB. PARA CONDIMENTOS',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1615,'7404007621436','4L','EMB. CHAO MEIN DE 1 LB.',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1616,'7404007621443','4LSEXP','EMB. CHAO MEIN 1 LB. EXPORTACIÓN',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1617,'7404007621450','4LSI','EMB. CHAO MEIN 1 LB. SIN IMPRESIÓN',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1618,'7404007621467','4ML','EMB. CHAO MEIN 1/2 LB. SIN SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1619,'7404007621474','4MLS','EMB. CHAO MEIN 1/2 LB. CON SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1620,'7404007621481','4PAGR','EMB. CHAO MEIN PARA PASTA A GRANEL',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1621,'7404007621498','4SACPP','CHAROLA CARNE AL HUESO PICANTE PAQUETE 80 g',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1622,'7404007621504','4SACPV','CHAROLA CARNE AL HUESO PICANTE VASO',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1623,'7404007621511','4SAL','EMB. SAL MAGICA CAJA DISPENSADORA',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1624,'7404007621528','4SAL12','EMBALAJE SAL MAGICA CAJA  12 UNI.',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1625,'7404007621535','4SAMP','CHAROLA MARISCO REBELDE PAQUETE 80 g',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1626,'7404007621542','4SAMV','CHAROLA MARISCO REBELDE VASO',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1627,'7404007621559','4SAP','CHAROLA GENERICA SOPA PAQUETE HAN RAN',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1628,'7404007621566','4SAV','CHAROLA GENERICA SOPA VASO HAN RAN',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1629,'7404007621573','4SCCP','EMB. SOPA CANTONESA CAMARON PAQUETE',NULL,NULL,NULL,'ME','2019-11-22 09:40:29',NULL,'1',1,'UN',NULL,NULL,NULL),(1630,'7404007621580','4SCCV','EMB. SOPA CANTONESA CAMARON VASO',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1631,'7404007621597','4SCHP','EMB. SOPA CANTONESA PICANTE PAQUETE',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1632,'7404007621603','4SCPP','EMB. SOPA CANTONESA POLLO PAQUETE',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1633,'7404007621610','4SCPV','EMB. SOPA CANTONESA POLLO VASO',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1634,'7404007621627','4SCRV','EMB. SOPA CANTONESA RES VASO',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1635,'7404007621634','4SIV','CHAROLA GENERICA SOPA INA VASO',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1636,'7404007621641','4SOY12','EMBALAJE SOYA DE 12 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1637,'7404007621658','5100','CINTA TRANSPARENTE DE 90 YARDAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1638,'7404007621665','51500','CINTA TRANSPARENTE DE 1,500 M.',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'UN',NULL,NULL,NULL),(1639,'7404007621672','5CACS','BOBINA CHAO MEIN CANTONES CON SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'KG',NULL,NULL,NULL),(1640,'7404007621689','5CASS','BOBINA CHAO MEIN CANTONES SIN SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'KG',NULL,NULL,NULL),(1641,'7404007621696','5INAS','BOBINA CHOW MEIN INA CON SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'KG',NULL,NULL,NULL),(1642,'7404007621702','5KAMLS','BOBINA CHAO MEIN KANTON 1/2 LB. CON SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'KG',NULL,NULL,NULL),(1643,'7404007621719','5L','BOBINA CHAO MEIN 1 LB. SIN SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'KG',NULL,NULL,NULL),(1644,'7404007621726','5LS','BOBINA CHAO MEIN 1 LB. CON SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'KG',NULL,NULL,NULL),(1645,'7404007621733','5MICH','BOBINA MICH SUPERSAZONADOR',NULL,NULL,NULL,'ME','2019-11-22 09:40:30',NULL,'1',1,'KG',NULL,NULL,NULL),(1646,'7404007621740','5ML','BOBINA CHAO MEIN 1/2 LB. SIN SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1647,'7404007621757','5MLS','BOBINA CHAO MEIN 1/2 LB. CON SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1648,'7404007621764','5OFER','CINTA PARA OFERTA ESPECIAL',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'UN',NULL,NULL,NULL),(1649,'7404007621771','5POLI','BOBINA POLIETILENO TERMOENCOGIBLE',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1650,'7404007621788','5POLI12','BOBINA POLIOLEFINA 12\" (GOYA CAJA)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'UN',NULL,NULL,NULL),(1651,'7404007621795','5POLI380','BOBINA POLIOLEFINA 380MM.(VASO)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'UN',NULL,NULL,NULL),(1652,'7404007621801','5POLI410','BOBINA POLIOLEFINA 410 MM (JUMBO)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'UN',NULL,NULL,NULL),(1653,'7404007621818','5PP11025','BOBINA DE PP 110X25 (SOBRE DE VERDURA)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1654,'7404007621825','5PP38025','BOBINA DE PP 380X25 (KANTON 1/2 LB.)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1655,'7404007621832','5PP44025','BOBINA DE PP 440X25 (GOYA)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1656,'7404007621849','5PP45035','BOBINA DE PP 450X35 (LIBRA)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1657,'7404007621856','5SAC','BOBINA SABOR CAMARON (SOBRES)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1658,'7404007621863','5SAH','BOBINA SABOR PICANTE (SOBRES)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1659,'7404007621870','5SAL','BOBINA DE SAL MAGICA',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1660,'7404007621887','5SAP','BOBINA SABOR POLLO (SOBRES)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1661,'7404007621894','5SAR','BOBINA SABOR RES (SOBRES)',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1662,'7404007621900','5SCC','BOBINA SOPA CANTONESA CAMARON',NULL,NULL,NULL,'ME','2019-11-22 09:40:31',NULL,'1',1,'KG',NULL,NULL,NULL),(1663,'7404007621917','5SCH','BOBINA SOPA CANTONESA PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'KG',NULL,NULL,NULL),(1664,'7404007621924','5SCP','BOBINA SOPA CANTONESA POLLO',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'KG',NULL,NULL,NULL),(1665,'7404007621931','5SCR','BOBINA SOPA CANTONESA  RES',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'KG',NULL,NULL,NULL),(1666,'7404007621948','5SF18','BOBINA STRECH FILM DE 18\"',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1667,'7404007621955','5SOY','BOBINA PARA SALSA SOYA',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'KG',NULL,NULL,NULL),(1668,'7404007621962','625LB','BOLSA DE 25 LIBRAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1669,'7404007621979','6INA','BOLSA CHOW MEIN INA',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1670,'7404007621986','6PAGR','BOLSA PARA PASTA A GRANEL',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1671,'7404007621993','6SAL','BOLSA SIX PACK SAL MAGICA',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1672,'7404007622006','7C454','BOTE PARA CONDIMENTOS DE 454 GRAMOS',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1673,'7404007622013','7SOY12','BOTELLA PARA SOYA DE 12 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1674,'7404007622020','7SOY3','BOTELLA PARA SOYA DE 3 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1675,'7404007622037','7SOY5','BOTELLA PARA SOYA DE 5 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1676,'7404007622044','7SOYG','ENVASE PARA SALSA SOYA GALON',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1677,'7404007622051','8C454','TAPA BOTE CONDIMENTOS DE 454 GRAMOS',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1678,'7404007622068','8SCC','TAPA SOPA CANTONESA CAMARON',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1679,'7404007622075','8SCH','TAPA SOPA CANTONESA PICANTE',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1680,'7404007622082','8SCP','TAPA SOPA CANTONESA POLLO',NULL,NULL,NULL,'ME','2019-11-22 09:40:32',NULL,'1',1,'UN',NULL,NULL,NULL),(1681,'7404007622099','8SCR','TAPA SOPA CANTONESA RES',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1682,'7404007622105','8SI','TAPA GENERICA SOPA INA',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1683,'7404007622112','8SOY12','TAPA PARA BOTELLA DE 12 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1684,'7404007622129','8SOY3','TAPA PARA BOTELLA DE 3 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1685,'7404007622136','8SOY5','TAPA PARA BOTELLA DE 5 ONZAS',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1686,'7404007622143','8SOYG','TAPA PARA ENVASE SOYA GALON',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1687,'7404007622150','9BOTE','SELLO DE GARANTIA PARA  BOTES CONDIMENTOS',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1688,'7404007622167','9SOY3','SELLO DE GARANTIA BOTELLA 3 OZ',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1689,'7404007622174','9SOY5','SELLO DE GARANTIA BOTELLA 5 OZ',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1690,'7404007622181','9SOYG','SELLO DE GARANTIA ENVASE GALON',NULL,NULL,NULL,'ME','2019-11-22 09:40:33',NULL,'1',1,'UN',NULL,NULL,NULL),(1691,'0740400762060','10SS','VASO IMPRESO SOPA SAMYANG',NULL,NULL,NULL,'ME','2019-11-22 09:42:17',NULL,'1',1,'UN',NULL,NULL,NULL),(1692,'0740400762061','10SSJ','VASO SOPA SAMYANG JUMBO',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1693,'0740400762062','1SSC','FAJILLA SOPA SAMYANG CAMARON',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1694,'0740400762063','1SSP','FAJILLA SOPA SAMYANG POLLO',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1695,'0740400762064','1SSPJ','MANGA SOPA SAMYANG POLLO JUMBO',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1696,'0740400762065','1SSR','FAJILLA SOPA SAMYANG RES',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1697,'0740400762066','4SSCV','EMB. SOPA SAMYANG CAMARON VASO',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1698,'0740400762067','4SSPJ15','EMB. SOPA SAMYANG POLLO JUMBO 15 U.',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1699,'0740400762068','4SSPV','EMB. SOPA SAMYANG POLLO VASO',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1700,'0740400762069','4SSRV','EMB. SOPA SAMYANG RES VASO',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1701,'0740400762070','8SSC','TAPA SOPA SAMYANG CAMARON',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1702,'0740400762071','8SSP','TAPA SOPA SAMYANG POLLO',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1703,'0740400762072','8SSPJ','TAPA SOPA SAMYANG POLLO JUMBO',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1704,'0740400762073','8SSR','TAPA SOPA SAMYANG RES',NULL,NULL,NULL,'ME','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1705,'0740400762074','SCH','SOBRE DE CHILE COBANERO',NULL,NULL,NULL,'MP','2019-11-22 09:42:18',NULL,'1',1,'UN',NULL,NULL,NULL),(1706,NULL,'CACS','CHAO MEIN CANTONES CON SOYA 48 UNIDADES',NULL,NULL,NULL,'PT',NULL,'2020-02-04 18:26:39','1',NULL,'CAJA',NULL,365,NULL),(1707,NULL,'CASS','CHAO MEIN CANTONES SIN SOYA 48 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1708,NULL,'COLB','CONSOME DE POLLO POR LIBRA',NULL,NULL,NULL,'PT',NULL,'2020-02-05 11:35:13','1',NULL,'LIBRA',NULL,365,NULL),(1709,NULL,'INAS','CHOW MEIN EL ORIENTAL 180 GRAMOS CON SOYA',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'BOLSAS ',NULL,365,NULL),(1710,NULL,'KAL','CHAO MEIN KANTON 1 LB. SIN SOYA',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'LIBRA',NULL,365,NULL),(1711,NULL,'KALS','CHAO MEIN KANTON 1 LB. CON SOYA',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'LIBRA',NULL,365,NULL),(1712,NULL,'KAML','CHAO MEIN KANTON 180g. SIN SOYA',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'LIBRA',NULL,365,NULL),(1713,NULL,'KAMLS','CHAO MEIN KANTON 180g. CON SOYA',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'LIBRA',NULL,365,NULL),(1714,NULL,'L','CHAO MEIN CANTONESA 1 LB. SIN SOYA 24 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1715,NULL,'LS','CHAO MEIN CANTONESA 1 LB CON SOYA 24 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1716,NULL,'LSEX','CHAO MEIN CANTONESA 1 LB. CON SOYA EXPORTACION',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,547,NULL),(1717,NULL,'MIB1','MICH EN BOTE DE 1 LB.',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD ',NULL,365,NULL),(1718,NULL,'MILB','MICH POR LIBRA',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'LIBRA',NULL,365,NULL),(1719,NULL,'ML','CHAO MEIN CANTONESA 1/2 LB SIN SOYA 48 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1720,NULL,'MLS','CHAO MEIN CANTONESA 1/2 LB CON SOYA  36 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA ',NULL,365,NULL),(1721,NULL,'MODE','CHAO MEIN LA MODERNA CON SOYA 160G.',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'BOLSAS ',NULL,365,NULL),(1722,NULL,'PAGR','CHAO MEIN A GRANEL',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'LIBRAS',NULL,365,NULL),(1723,NULL,'PAGRCW','PASTA A GRANEL 25 LBS',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1724,NULL,'SAB1','SAL MAGICA EN BOTE DE 1 LB.',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD',NULL,365,NULL),(1725,NULL,'SACA','SAL MAGICA EN CARTON DE 12 U.',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD',NULL,365,NULL),(1726,NULL,'SACJ','SAL MAGICA EN CAJA DISPENSADORA',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD',NULL,365,NULL),(1727,NULL,'SACJ12','SAL MAGICA EN CAJA 12 UNIDADES',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1728,NULL,'SALB','SAL MAGICA  POR LIBRA',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'LIBRA',NULL,365,NULL),(1729,NULL,'SASP','SAL MAGICA EN SIX PACK',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD',NULL,365,NULL),(1730,NULL,'SCCP','SOPA CANTONESA CAMARON PAQUETE 24 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1731,NULL,'SCCV','SOPA CANTONESA CAMARON VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1732,NULL,'SCHP','SOPA CANTONESA PICANTE PAQUETE 24 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1733,NULL,'SCHV','SOPA CANTONESA PICANTE VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1734,NULL,'SCPP','SOPA CANTONESA POLLO PAQUETE 24 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1735,NULL,'SCPV','SOPA CANTONESA POLLO VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1736,NULL,'SCRP','SOPA CANTONESA RES PAQUETE 24 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1737,NULL,'SCRV','SOPA CANTONESA RES VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1738,NULL,'SHCHP','SOPA HAN RAN CARNE AL HUESO PAQUETE 24 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1739,NULL,'SHCHPP','SOPA HAN RAN CARNE AL HUESO PICANTE PAQUETE 24U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1740,NULL,'SHCHPV','SOPA HAN RAN CARNE AL HUESO PICANTE VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1741,NULL,'SHCHV','SOPA HAN RAN CARNE AL HUESO VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1742,NULL,'SHGPP','SOPA HAN RAN GALLINA PECHUGONA PAQUETE 24 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1743,NULL,'SHGPPP','SOPA HAN RAN GALLINA PECHUGONA PICANTE PAQUETE 24U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1744,NULL,'SHGPPV','SOPA HAN RAN GALLINA PECHUGONA PICANTE VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1745,NULL,'SHGPV','SOPA HAN RAN GALLINA PECHUGONA  VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1746,NULL,'SHMRP','SOPA HAN RAN MARISCO REBELDE PAQUETE 24U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1747,NULL,'SHMRPP','SOPA HAN RAN MARISCO REBELDE PICANTE PAQUETE  24U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1748,NULL,'SHMRPV','SOPA HAN RAN MARISCO REBELDE PICANTE VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1749,NULL,'SHMRV','SOPA HAN RAN MARISCO REBELDE VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,304,NULL),(1750,NULL,'SOY12','SALSA SOYA 12 ONZAS',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD',NULL,365,NULL),(1751,NULL,'SOY3','SALSA SOYA DE 3 ONZAS',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD',NULL,365,NULL),(1752,NULL,'SOY5','SALSA SOYA DE 5 ONZAS',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD',NULL,365,NULL),(1753,NULL,'SOYG','SALSA SOYA EN GALON',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'UNIDAD',NULL,365,NULL),(1754,NULL,'SSCV','SOPA SAMYANG CAMARON VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1755,NULL,'SSPJ15','SOPA SAMYANG POLLO JUMBO 15 U.',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1756,NULL,'SSPV','SOPA SAMYANG POLLO VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1757,NULL,'SSRV','SOPA SAMYANG RES VASO 12 U',NULL,NULL,NULL,'PT',NULL,NULL,'1',NULL,'CAJA',NULL,365,NULL),(1758,NULL,'SMSCV','SOPA MILANO SABOR CHULETA 12X70G.',NULL,NULL,NULL,'PT',NULL,'2020-02-27 08:30:09','1',NULL,'CAJA',NULL,304,NULL),(1759,NULL,'SMSPV','SOPA MILANO SABOR POLLO 12X70 G.',NULL,NULL,NULL,'PT',NULL,'2020-02-05 11:34:56','1',NULL,'CAJA',NULL,304,NULL),(1762,'7404007620170','CILA','CILANTRO DESHIDRATADO EN HOJUELA INA',NULL,NULL,NULL,'MP','2019-11-22 09:50:36',NULL,'1',1,'KG',NULL,NULL,NULL),(1763,'7404007621160','HARDEI','HARINA DURA E INA',NULL,NULL,NULL,'MP','2019-11-22 09:50:37',NULL,'1',1,'UN',NULL,NULL,NULL),(1764,'7404007621177','SSCI','SOBRE SABOR CHULETA INA',NULL,NULL,NULL,'MP','2019-11-22 09:50:37',NULL,'1',1,'UNI',NULL,NULL,NULL),(1765,'7404007621184','SSPI','SOBRE SABOR POLLO INA',NULL,NULL,NULL,'MP','2019-11-22 09:50:37',NULL,'1',1,'UNI',NULL,NULL,NULL),(1767,'7404007621139','5MODE','BOBINA CHAO MEIN LA MODERNA',1,NULL,NULL,'ME','2019-11-29 11:41:34',NULL,'1',10,'KG',NULL,NULL,NULL),(1768,'7404007621146','5POLI9','BOBINA  POLIOLEFINA 9',1,NULL,NULL,'ME','2019-11-29 11:42:09','2019-11-29 11:42:26','1',10,'unidad',NULL,NULL,NULL),(1791,'','PAS200','PASTA CHAO MEIN CANTONESA 200 GRAMOS',NULL,NULL,NULL,'PP','2020-02-24 09:32:53',NULL,'1',1,'UN',NULL,365,' '),(1792,'','PASI180','PASTA CHOW MEIN EL ORIENTAL 180 GRAMOS ',NULL,NULL,NULL,'PP','2020-02-24 09:32:53',NULL,'1',1,'UN',NULL,365,' '),(1793,'','PASK180','PASTA CHAO MEIN KANTON  180 GRAMOS',NULL,NULL,NULL,'PP','2020-02-24 09:32:53',NULL,'1',1,'UN',NULL,365,' '),(1794,'','PASM160','PASTA CHOA MEIN MODERNA 160 GRAMOS ',NULL,NULL,NULL,'PP','2020-02-24 09:32:53',NULL,'1',1,'UN',NULL,365,' '),(1795,'','PASC180','PASTA CHAO MEIN CANTONES 180 GRAMOS',NULL,NULL,NULL,'PP','2020-02-24 09:32:53','2020-02-26 10:10:32','1',1,'UN',NULL,365,NULL);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_proveedor` varchar(55) DEFAULT NULL,
  `razon_social` varchar(50) DEFAULT NULL,
  `nombre_comercial` varchar(50) NOT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `direccion_fiscal` varchar(80) DEFAULT NULL,
  `direccion_planta` varchar(80) DEFAULT NULL,
  `nombre_contacto` varchar(50) DEFAULT NULL,
  `puesto_contacto` varchar(50) DEFAULT NULL,
  `telefono_contacto` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `regimen_tributario` varchar(50) DEFAULT NULL,
  `patente_comercio` varchar(50) DEFAULT NULL,
  `patente_sociedad` varchar(50) DEFAULT NULL,
  `dias_credito` varchar(50) DEFAULT NULL,
  `monto_credito` decimal(18,2) DEFAULT NULL,
  `programa_bpm_implementado` char(1) DEFAULT NULL,
  `otros_programas` char(1) DEFAULT NULL,
  `sistema_haccp` char(1) DEFAULT NULL,
  `programa_capacitacion` char(1) DEFAULT NULL,
  `sistema_trazabilidad` char(1) DEFAULT NULL,
  `sistema_calidad_auditado_intermamente` char(1) DEFAULT NULL,
  `sistema_calidad_auditado_por_terceros` char(1) DEFAULT NULL,
  `certificaciones` char(1) DEFAULT NULL,
  `observaciones` text,
  `estado` char(1) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (130,'PROV19','HECTOR ANTONIO QUIROA','PROINCO',NULL,'46 ave \"A\" 4-50 Zona 11 Molino de las  Flores II Guatemala','46 ave \"A\" 4-50 Zona 11 Molino de las  Flores II Guatemala','ANTONIO QUIROA',NULL,'24336114','ventas@proinco-gt.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:42:13','2019-11-22 10:00:59'),(131,'PROV20','AD INDUSTRIAL, S.A.','AD INDUSTRIAL, S.A.',NULL,'8 Avenida 10-56 Bodega 7  San Fermin Zona 21','8 Avenida 10-56 Bodega 7  San Fermin Zona 21','AURA SANDOVAL',NULL,'24487825','aurasandoval1@yahoo.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 14:32:32','2019-11-22 10:00:59'),(132,'PROV21','COMPAÑÍA INDUSTRIAL CORRUGADORA GUATEMALA, S.A.','CORRUGADORA DE GUATEMALA, S.A.',NULL,'Av. Las Americas 18-81 Edificio Columbus Center 3er Nivel Oficina 3A Zona 14, Gu','Av. Las Americas 18-81 Edificio Columbus Center 3er Nivel Oficina 3A Zona 14, Gu','WILLIAM BRITZ',NULL,'23827800','wbritz@e-galindo.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 15:13:56','2019-11-22 10:00:59'),(133,'PROV22','EMUSA,S. A.','EMUSA',NULL,'Km 20  Carretera Al Pacifico Parque Industrial Unisur, Bodegas   B-1 y B-2','Km 20  Carretera Al Pacifico Parque Industrial Unisur, Bodegas   B-1 y B-2','ROLANDO BONIFAZ',NULL,'66450500','rbonifaz@emusa.com.pe',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:24:18','2019-11-22 10:00:59'),(134,'PROV23','CARVAJAL EMPAQUES,S.A. DE CAPITAL VARIABLE','CARVAJAL EMPAQUES',NULL,'Km 10.5 Carretera al puerto La Libertad, Sta Tecla, El Salvador','Km 10.5 Carretera al puerto La Libertad, Sta Tecla, El Salvador',NULL,NULL,'52(55) 50930000','Daniel.VillegasV@carbajal.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 14:39:19','2019-11-22 10:00:59'),(135,'PROV24','ENVASES Y SELLOS, S.A.','ENVASEAL',NULL,'23 Avenida 41-14 Zona 12','23 Avenida 41-14 Zona 12','NANCY LOPEZ',NULL,'22792700','nancy.lopez@envaseal.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:27:01','2019-11-22 10:00:59'),(136,'PROV25','FLEXAPRINT, S.A.','FLEXAPRINT, S.A.',NULL,'Avenida Las Rosas Lote 123 Jardines de San Lucas IV San Lucas','Avenida Las Rosas Lote 123 Jardines de San Lucas IV San Lucas',NULL,NULL,'78281100','silvia@flexaprint.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:32:43','2019-11-22 10:00:59'),(137,'PROV26','INDUSTRIAS GRAFICAS DIAZ ALBURES, S.A','GRAFICOS DIAZ PAIZ',NULL,'2 Calle 35-70 Zona 11 Colonia Toledo','2 Calle 35-70 Zona 11 Colonia Toledo','ANA DE MOLINA',NULL,'22026000','ana.demolina@diazpaiz.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:35:10','2019-11-22 10:00:59'),(138,'PROV27','CLAUDINE ELIZABETH ORELLANA MORALES','LITOFLEXO',NULL,'13 Ave. 6-18 Zona  6, Guatemala.','13 Ave. 6-18 Zona  6, Guatemala.',NULL,NULL,'22549308','litoflexo@hotmail.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:46:34','2019-11-22 10:00:59'),(139,'PROV28','LITHO PRESS, S.A.','LITHO PRESS, S.A.',NULL,'Km. 15.5 Carretera Rooselvelt 0-80 Zona 2 de Mixco, Guatemala','Km. 15.5 Carretera Rooselvelt 0-80 Zona 2 de Mixco, Guatemala','LUCRECIA RIVERA',NULL,'24115511','lucreciarmolina@gmail.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:45:24','2019-11-22 10:00:59'),(140,'PROV29','MAPRIVA','MARCA PRIVADA, S.A.',NULL,'2a Ave. 3-04 Zona 13, Guatemala','2a Ave. 3-04 Zona 13, Guatemala','JORGE CHACON',NULL,'22960990','jchacon@maprivagt.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:07:15','2019-11-22 10:00:59'),(141,'PROV30','OREPLAST, S.A.','OREPLAST, S.A.',NULL,'2 calle 13-06 Zona 2 Colonia La Escuadrilla Mixco','2 calle 13-06 Zona 2 Colonia La Escuadrilla Mixco','BLANCA VALDEZ',NULL,'23894747','bdevaldes@oreplast.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:33:06','2019-11-22 10:00:59'),(142,'PROV31','PLASTICOS MAKILGAR,S.A.','PLASTICOS MAKILGAR',NULL,'17 Avenida 15-11 Anillo Periferico Zona 11, Guatemala','17 Avenida 15-11 Anillo Periferico Zona 11, Guatemala',NULL,NULL,'22067373','ldonis@makilgar.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:36:15','2019-11-22 10:01:00'),(143,'PROV32','POLIMEROS Y TECNOLOGIA, S.A.','POLYTEC',NULL,'1 Calle 2-68 Zona 2 Colonia San Jose Villa Nueva, Villa Nueva','1 Calle 2-68 Zona 2 Colonia San Jose Villa Nueva, Villa Nueva','FERNANDO ESTRADA',NULL,'66451414','festrada@polytec.com.gt',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:40:17','2019-11-22 10:01:00'),(144,'PROV33','TECNIPLAST, S.A.','TECNIPLAST, S.A.',NULL,'28 Calle \"A\" 0-08, Zona 8 Guatemala, C.A.','28 Calle \"A\" 0-08, Zona 8 Guatemala, C.A.',NULL,NULL,'24753232','josealopez@tecniplast.com.gt',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 16:32:42','2019-11-22 10:01:00'),(145,'PROV34','SOLUCIONES Y SERVICIOS IMPORCOMP, S.A.','IMPORCOMP',NULL,'0 Avenida 23-13  Zona 17, Calzada la Paz, centro de Negocios La Paz, Bodega 108','0 Avenida 23-13  Zona 17, Calzada la Paz, centro de Negocios La Paz, Bodega 108','ANTONIO QUIROA',NULL,'22177373','christoperalvarado@imporcomp.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:38:26','2019-11-22 10:01:00'),(146,'PROV35','VISUAL GRAPHICS,S.A.','DILISA',NULL,'4 calle \"A\" 4-83 Bodega I sector A-5 Zona 8  San Cristobal Mixco','4 calle \"A\" 4-83 Bodega I sector A-5 Zona 8  San Cristobal Mixco',NULL,NULL,'24724800','bbran@logansa.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 15:21:32','2019-11-22 10:01:00'),(147,'PROV36','INDUSTRIAS EXPERTAS, S.A.','INDEX',NULL,'0 Avenida 23-13, Centro de Negocios la Paz, Ofibodega 607,  Calzada la Paz, Zona','0 Avenida 23-13, Centro de Negocios la Paz, Ofibodega 607,  Calzada la Paz, Zona','ELMER ROMERO',NULL,'23275100','eromero@indexbsa.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:40:53','2019-11-22 10:01:00'),(148,'PROV37','PLASTIMAX, S.A.','PLASTICOS MAXIMOS',NULL,'3a Calle 0-81 zona 1 Boca del Monte, Villa Canales, Guatemala','3a Calle 0-81 zona 1 Boca del Monte, Villa Canales, Guatemala','JOSE LOPEZ',NULL,'24426147','jzamora@plastimaxsa.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:39:14','2019-11-22 10:01:00'),(149,'PROV38','DISTRIBUIDORA ME LLEGA, S.A.','DISTRIBUIDORA ME LLEGA, S.A.',NULL,'18 ave \"A\" 1-41 zona 15 Vista Hermosa II','18 ave \"A\" 1-41 zona 15 Vista Hermosa II',NULL,NULL,'24705454','salazar.j@ariumcorp.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:13:14','2019-11-22 10:01:00'),(150,'PROV39','CENTROPACK, S.A.','CENTROPACK, S.A.',NULL,'20 Calle 26-30  Zona 10  Oficina 13, Guatemala.','20 Calle 26-30  Zona 10  Oficina 13, Guatemala.',NULL,NULL,'22155600','ventas1@centropack.com.gt',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 14:44:49','2019-11-22 10:01:00'),(151,'PROV01','ARTICULOS DE COSUMO POPULAR','MAXA',NULL,'Avenida del ferrocarill  19-97  Zona 12 El Cortijo Empresarial ofi-bodega','Avenida del ferrocarill  19-97  Zona 12 El Cortijo Empresarial ofi-bodega',NULL,NULL,'22699898','mrivas@canareal.com.gt',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:08:35','2019-11-22 10:01:05'),(152,'PROV02','BALTIMORE SPICE GUATEMALA, S.A.','BALTIMORE SPICE GUATEMALA, S.A.',NULL,'Avenida Petapa 52-20 Zona 12 Guatemala','Avenida Petapa 52-20 Zona 12 Guatemala',NULL,NULL,'24793650','kulloa@baltimorespice.net',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 14:35:54','2019-11-22 10:01:05'),(153,'PROV03','CORPORACIÓN QUIRSA, S.A.','CORPORACION QUIRSA, S.A.',NULL,'Lotificacion Granjas Italia FRAccion No.5 Zona 4 Villa Nueva, Guatemala','Lotificacion Granjas Italia FRAccion No.5 Zona 4 Villa Nueva, Guatemala',NULL,NULL,'66305353','brenda@quirsa.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 14:56:30','2019-11-22 10:01:06'),(154,'PROV04','DISTRUBUIDORA DEL CARIBE DE GUATEMALA,S.A.','DISTRIBUIDORA  DEL CARIBE , S.A',NULL,'Calle 34-39 Zona 11 Colonia Toledo, Guatemala','Calle 34-39 Zona 11 Colonia Toledo, Guatemala','MARINA ORELLANA',NULL,'23266666','marinao@distcaribe.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 16:47:55','2019-11-22 10:01:06'),(155,'PROV05','DISTRIBUIDORA Y COMERCIALIZADORA DISCOMER','DISCOMER',NULL,'Calzada Aguilar Batres 54-85 Bodega 12 Felxibodegas II Zona 12 Villa Nueva','Calzada Aguilar Batres 54-85 Bodega 12 Felxibodegas II Zona 12 Villa Nueva',NULL,NULL,'24773790','distribuidoradiscomer@yahoo.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 15:34:55','2019-11-22 10:01:06'),(156,'PROV06','HARMONY FLAVOURS & INGREDIENTS, S.A','HARMONY FLAVOURS & INGREDIENTS, S.A',NULL,'24 avenida Bodega 66 41-81 Zona 12','24 avenida Bodega 66 41-81 Zona 12','JOSE DE LEON',NULL,'54137024','jose.deleon@grupoharmony.com .',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:36:00','2019-11-22 10:01:06'),(157,'PROV07','ALIMENTOS IDEAL,S.A.','IDEALSA',NULL,'Km 56-5 Carretera al Pacifico, Palin Escuintla','Km 56-5 Carretera al Pacifico, Palin Escuintla',NULL,NULL,'24219200','acardona@alimentosideal.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:37:12','2019-11-22 10:01:06'),(158,'PROV08','INDUSTRIAS DE ACEITES Y GRASAS SUPREMA','SUPREMA',NULL,'Avenida del Ferrocarril 5-90  Zona 3 de Escuintla','Avenida del Ferrocarril 5-90  Zona 3 de Escuintla','EDUARDO LETONA',NULL,'23870300','eduardoletona@yahoo.com.mx',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 16:31:06','2019-11-22 10:01:06'),(159,'PROV09','INDUSTRIAS PROCESADORA DE SALSAS, S.A.','INDUSTRIAS C&Q',NULL,'7 Avenida 1-53 Zona 2 Colonia El Tesoro Mixco','7 Avenida 1-53 Zona 2 Colonia El Tesoro Mixco','ANDREA GUZMAN',NULL,'22068700','ventas@industriacq.com.gt',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:42:36','2019-11-22 10:01:06'),(160,'PROV10','MERCK, S.A.','MERCK',NULL,'12 Avenida 0-33 Zona 2 Mixco','12 Avenida 0-33 Zona 2 Mixco','CRISTY  PUTZEYS',NULL,'24102332','cristy.putzeys@merckgroup.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:10:54','2019-11-22 10:01:06'),(161,'PROV11','MOLINOS MODERNOS, S.A.','MOLINOS MODERNOS, S.A.',NULL,'33 Calle 25-30 Zona 12,  Guatemala','33 Calle 25-30 Zona 12,  Guatemala','EDUARDO BOJORQUEZ',NULL,'24423439','ebojorquez@molinosmodernos.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:13:49','2019-11-22 10:01:06'),(162,'PROV12','REDESAL, S.A.','REDESAL',NULL,'26 Calle 7-23 zona 11 Ofibodegas San Luis Bodegas 1 y 2 Guatemala','26 Calle 7-23 zona 11 Ofibodegas San Luis Bodegas 1 y 2 Guatemala',NULL,NULL,'24403195','ventas@redesal.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 15:43:04','2019-11-22 10:01:06'),(163,'PROV13','SILESIA DE MEXICO, S. DE R.L. DE C.V.','SILESIA DE MEXICO, S. DE R.L. DE C.V.',NULL,'Miguel Hidalgo 6, Felipe Àngele, El Terrero 45680 El Salto Jalisco, Mexico.','Miguel Hidalgo 6, Felipe Àngele, El Terrero 45680 El Salto Jalisco, Mexico.',NULL,NULL,'3336889300','g.aguilar@silesia.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 16:30:19','2019-11-22 10:01:06'),(164,'PROV14','WANJASHAN INTERNATIONAL, LLC','WANJASHAN INTERNATIONAL, LLC',NULL,'4 Sands Station Road Middeltown, NY 10940','4 Sands Station Road Middeltown, NY 10940',NULL,NULL,'(845)3431505','willielin@wanjashan.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 16:34:42','2019-11-22 10:01:06'),(165,'PROV15','WOLF CANYON ASIA PACIFIC, LTD.','WOLF CANYON ASIA PACIFIC, LTD.',NULL,'Flat G, Seabright Plaza 9-23 Shell Street North Point, Hong Kong','Flat G, Seabright Plaza 9-23 Shell Street North Point, Hong Kong',NULL,NULL,'(852)28921252','claudio@wolfgroup.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-25 16:44:24','2019-11-22 10:01:06'),(166,'PROV16','ESPECIALIDADES GOURMAC,S.A.','ESPECIALIDADES GOURMAC,S.A.',NULL,'Condominio Millstone, sector 1 Molino de las Flores No. II Modulo 3, casa Apto.','Condominio Millstone, sector 1 Molino de las Flores No. II Modulo 3, casa Apto.','LAURA ZETINA',NULL,'25000550','lzetina@especialidadesgourmac.com.',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:31:26','2019-11-22 10:01:06'),(167,'PROV17','DIVSA DE GUATEMALA, S.A.','DIVSA',NULL,'Km 16.5 Carretera a San José Pinula Complejo Empresarial San José Bodega 2 Guate','Km 16.5 Carretera a San José Pinula Complejo Empresarial San José Bodega 2 Guate','JOHANNA LECHUGA',NULL,'66650505','jlechuga@divsa.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 16:14:33','2019-11-22 10:01:06'),(168,'PROV18','CONCADAL','CONCADAL',NULL,'28 Calle \"A\" 14-52 Zona 13','28 Calle \"A\" 14-52 Zona 13',NULL,NULL,'23338014-5319-1658','bness@concadal.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','1','0','0','0',NULL,'1','2019-11-22 14:53:44','2019-11-22 10:01:06'),(169,'PROV42','REC','REC',NULL,'3 AVENIDA 13-78 ZONA 10 EDIFICIO TORRE CITIGROUP 8 NIVEL','3 AVENIDA 13-78 ZONA 10 EDIFICIO TORRE CITIGROUP 8 NIVEL','RENE MONZON',NULL,NULL,'renemozon@rec.com',NULL,NULL,NULL,NULL,NULL,'0','0','0','0','0','0','0','0',NULL,'1','2019-11-25 16:50:21','2019-11-25 16:50:21');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores_productos`
--

DROP TABLE IF EXISTS `proveedores_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores_productos` (
  `id_proveedor` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  KEY `id_proveedor_fk_idx` (`id_proveedor`),
  KEY `id_producto_fk_idx` (`id_producto`),
  CONSTRAINT `id_producto_fk` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_proveedor_fk` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores_productos`
--

LOCK TABLES `proveedores_productos` WRITE;
/*!40000 ALTER TABLE `proveedores_productos` DISABLE KEYS */;
INSERT INTO `proveedores_productos` VALUES (131,1653),(131,1654),(131,1655),(131,1656),(152,1554),(152,1567),(134,1594),(150,1650),(150,1651),(150,1652),(168,1764),(168,1765),(168,1558),(168,1560),(168,1582),(168,1762),(153,1587),(132,1624),(132,1613),(132,1614),(132,1615),(132,1616),(132,1617),(132,1618),(132,1619),(132,1620),(132,1623),(132,1621),(132,1625),(132,1626),(132,1627),(132,1628),(132,1629),(132,1630),(132,1631),(132,1632),(132,1633),(132,1634),(132,1635),(132,1636),(146,1602),(146,1603),(146,1604),(146,1605),(146,1606),(146,1607),(146,1608),(146,1609),(146,1610),(146,1611),(146,1612),(146,1600),(146,1601),(155,1570),(155,1577),(155,1568),(149,1495),(149,1496),(149,1497),(149,1498),(149,1499),(149,1500),(149,1501),(149,1502),(149,1503),(149,1504),(149,1505),(149,1506),(149,1507),(149,1508),(149,1509),(149,1510),(149,1511),(149,1512),(149,1513),(149,1514),(149,1515),(149,1516),(149,1517),(149,1518),(149,1519),(149,1521),(149,1520),(149,1522),(149,1523),(149,1524),(149,1525),(167,1570),(167,1563),(167,1587),(133,1639),(133,1640),(133,1642),(133,1643),(133,1644),(133,1645),(133,1646),(133,1647),(133,1659),(133,1660),(133,1662),(133,1663),(133,1664),(133,1665),(133,1667),(135,1687),(166,1585),(166,1586),(166,1559),(136,1688),(136,1689),(137,1597),(137,1598),(137,1599),(156,1583),(156,1591),(157,1589),(145,1668),(145,1669),(145,1670),(147,1650),(147,1651),(147,1652),(159,1580),(139,1595),(139,1596),(138,1678),(138,1679),(138,1680),(138,1681),(131,1657),(131,1661),(131,1658),(131,1671),(140,1691),(140,1692),(140,1693),(140,1694),(140,1695),(140,1696),(140,1697),(140,1698),(140,1699),(140,1700),(140,1701),(140,1702),(140,1703),(140,1704),(140,1705),(151,1548),(160,1590),(161,1572),(161,1573),(161,1763),(141,1659),(141,1645),(141,1667),(141,1669),(141,1670),(141,1641),(142,1674),(142,1675),(142,1684),(142,1685),(148,1672),(148,1677),(143,1649),(130,1668),(130,1669),(130,1670),(162,1579),(163,1549),(163,1561),(163,1566),(158,1589),(144,1673),(144,1683),(164,1552),(164,1553),(165,1546),(165,1547),(165,1555),(165,1584),(165,1556),(165,1564),(165,1569),(165,1575),(165,1578),(165,1557),(165,1581),(154,1550),(154,1551),(154,1565),(154,1587),(154,1570),(154,1564),(169,1666);
/*!40000 ALTER TABLE `proveedores_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `racks`
--

DROP TABLE IF EXISTS `racks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `racks` (
  `id_rack` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasillo` int(11) DEFAULT NULL,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `lado` varchar(1) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `codigo_interno` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_rack`),
  KEY `rack_pasillo_idx` (`id_pasillo`),
  CONSTRAINT `rack_pasillo` FOREIGN KEY (`id_pasillo`) REFERENCES `pasillos` (`id_pasillo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `racks`
--

LOCK TABLES `racks` WRITE;
/*!40000 ALTER TABLE `racks` DISABLE KEYS */;
INSERT INTO `racks` VALUES (2,7,'RACK01','RACK1','A','1',1),(3,7,'RACK02','RACK-02','A','0',2),(4,7,'RACK008','RACK 8','A','1',3),(5,8,'D000001','RACK D-1','A','1',1),(6,NULL,NULL,NULL,NULL,'1',1);
/*!40000 ALTER TABLE `racks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recepcion_encabezado`
--

DROP TABLE IF EXISTS `recepcion_encabezado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recepcion_encabezado` (
  `id_recepcion_enc` int(11) NOT NULL AUTO_INCREMENT,
  `orden_compra` varchar(50) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `usuario_recepcion` int(11) DEFAULT NULL,
  `documento_proveedor` varchar(50) DEFAULT NULL,
  `estado` varchar(2) DEFAULT 'T',
  `rampa` char(1) DEFAULT '1',
  `control` char(1) DEFAULT '0',
  `mp` char(1) DEFAULT '0' COMMENT 'materia prima',
  PRIMARY KEY (`id_recepcion_enc`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recepcion_encabezado`
--

LOCK TABLES `recepcion_encabezado` WRITE;
/*!40000 ALTER TABLE `recepcion_encabezado` DISABLE KEYS */;
INSERT INTO `recepcion_encabezado` VALUES (15,'Doc123',165,'2020-02-26 08:56:19',NULL,1,'Doc123','T','1','0','0');
/*!40000 ALTER TABLE `recepcion_encabezado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referencias_comerciales`
--

DROP TABLE IF EXISTS `referencias_comerciales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referencias_comerciales` (
  `id_referencia_comercial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(50) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `contacto` varchar(45) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_referencia_comercial`),
  KEY `referencia_proveedor_idx` (`id_proveedor`),
  CONSTRAINT `referencia_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referencias_comerciales`
--

LOCK TABLES `referencias_comerciales` WRITE;
/*!40000 ALTER TABLE `referencias_comerciales` DISABLE KEYS */;
/*!40000 ALTER TABLE `referencias_comerciales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisicion_detalle`
--

DROP TABLE IF EXISTS `requisicion_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisicion_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_requisicion_encabezado` int(11) NOT NULL,
  `orden_requisicion` varchar(50) DEFAULT NULL,
  `orden_produccion` varchar(50) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  `estado` char(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisicion_detalle`
--

LOCK TABLES `requisicion_detalle` WRITE;
/*!40000 ALTER TABLE `requisicion_detalle` DISABLE KEYS */;
INSERT INTO `requisicion_detalle` VALUES (29,15,'R2602','PROD-20200227',1555,55.00,'D'),(30,15,'R2602','PROD-20200227',1546,1501.00,'D'),(31,16,'R2602-01','PROD-20200227-1',1546,150.00,'D'),(32,16,'R2602-01','PROD-20200227-1',1555,55.00,'D'),(33,16,'R2602-01','PROD-20200227-1',1578,40.00,'D'),(34,16,'R2602-01','PROD-20200227-1',1547,85.00,'D'),(35,17,'R101202','PROD-20200310',1555,45.00,'R');
/*!40000 ALTER TABLE `requisicion_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisicion_encabezado`
--

DROP TABLE IF EXISTS `requisicion_encabezado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisicion_encabezado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_requision` varchar(50) DEFAULT NULL,
  `no_orden_produccion` varchar(50) DEFAULT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT NULL,
  `id_usuario_ingreso` int(11) DEFAULT NULL,
  `id_usuario_aprobo` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT 'P',
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisicion_encabezado`
--

LOCK TABLES `requisicion_encabezado` WRITE;
/*!40000 ALTER TABLE `requisicion_encabezado` DISABLE KEYS */;
INSERT INTO `requisicion_encabezado` VALUES (15,'R2602','PROD-20200227','2020-02-26 15:41:54',1,NULL,'D','2020-02-26 15:43:58'),(16,'R2602-01','PROD-20200227-1','2020-02-26 15:45:26',1,NULL,'D','2020-02-26 15:47:00'),(17,'R101202','PROD-20200310','2020-03-09 18:42:45',1,NULL,'R','2020-03-09 18:43:33');
/*!40000 ALTER TABLE `requisicion_encabezado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva_lotes`
--

DROP TABLE IF EXISTS `reserva_lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva_lotes` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `lote` varchar(50) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  `id_requisicion` int(11) DEFAULT NULL,
  `id_bodega` int(11) DEFAULT NULL,
  `estado` char(2) DEFAULT 'P' COMMENT 'P -> Proceso\nR -> Reservado\nD ->Despachado',
  `leido` char(2) DEFAULT 'N',
  `fecha_lectura` datetime DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `id_usuario_picking` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_reserva`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva_lotes`
--

LOCK TABLES `reserva_lotes` WRITE;
/*!40000 ALTER TABLE `reserva_lotes` DISABLE KEYS */;
INSERT INTO `reserva_lotes` VALUES (22,1555,'CS2602','2020-07-17',25.00,12,21,'D','S','2020-02-26 09:22:19','4140754842000017',1,1,'2020-02-26 09:22:00','2020-02-26 09:22:35'),(27,1546,'2602','2020-03-27',1500.00,15,21,'D','S','2020-02-26 09:49:37','4140754842000017',1,1,'2020-02-26 09:48:47','2020-02-26 09:50:31'),(28,1546,'AJO2602','2020-07-28',1.00,15,21,'D','S','2020-02-26 09:49:57','4140754842000017',1,1,'2020-02-26 09:48:47','2020-02-26 09:50:31'),(29,1555,'CS2602','2020-07-17',55.00,15,21,'D','S','2020-02-26 09:50:22','4140754842000017',1,1,'2020-02-26 09:48:47','2020-02-26 09:50:31'),(30,1546,'AJO2602','2020-07-28',150.00,16,21,'D','S','2020-02-26 09:51:09','4140754842000017',1,1,'2020-02-26 09:50:44','2020-02-26 09:53:40'),(31,1547,'AR2602','2020-07-22',85.00,16,21,'D','S','2020-02-26 09:51:56','4140754842000017',1,1,'2020-02-26 09:50:44','2020-02-26 09:53:40'),(32,1555,'CS2602','2020-07-17',55.00,16,21,'D','S','2020-02-26 09:52:52','4140754842000017',1,1,'2020-02-26 09:50:44','2020-02-26 09:53:40'),(33,1578,'R2602','2020-07-30',40.00,16,21,'D','S','2020-02-26 09:53:34','4140754842000017',1,1,'2020-02-26 09:50:44','2020-02-26 09:53:40'),(34,1555,'CS2602','2020-07-17',45.00,17,21,'P','N',NULL,'4140754842000017',1,NULL,'2020-03-09 12:43:55','2020-03-09 12:43:55');
/*!40000 ALTER TABLE `reserva_lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rmi_detalle`
--

DROP TABLE IF EXISTS `rmi_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rmi_detalle` (
  `id_rmi_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_rmi_encabezado` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  `cantidad_entrante` decimal(18,2) DEFAULT '0.00',
  `estado` char(1) DEFAULT NULL,
  `rampa` char(1) DEFAULT NULL,
  `control` char(1) DEFAULT NULL,
  `mp` char(1) DEFAULT NULL COMMENT 'Mp -> Materia prima',
  PRIMARY KEY (`id_rmi_detalle`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rmi_detalle`
--

LOCK TABLES `rmi_detalle` WRITE;
/*!40000 ALTER TABLE `rmi_detalle` DISABLE KEYS */;
INSERT INTO `rmi_detalle` VALUES (35,15,1546,'2602','2020-03-27',1500.00,1500.00,NULL,'0','1','0'),(36,15,1547,'AR2602','2020-07-22',580.00,580.00,NULL,'0','1','0'),(37,15,1555,'CS2602','2020-07-17',655.00,655.00,NULL,'0','1','0'),(38,15,1578,'R2602','2020-07-30',540.00,540.00,NULL,'0','1','0'),(39,15,1546,'AJO2602','2020-07-28',650.00,650.00,NULL,'0','1','0');
/*!40000 ALTER TABLE `rmi_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rmi_encabezado`
--

DROP TABLE IF EXISTS `rmi_encabezado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rmi_encabezado` (
  `id_rmi_encabezado` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(45) DEFAULT NULL,
  `documento` varchar(45) DEFAULT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `usuario_ingreso` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `rampa` char(1) DEFAULT '1',
  `control` char(1) DEFAULT '0',
  `mp` char(1) DEFAULT '0',
  `observaciones` text,
  PRIMARY KEY (`id_rmi_encabezado`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rmi_encabezado`
--

LOCK TABLES `rmi_encabezado` WRITE;
/*!40000 ALTER TABLE `rmi_encabezado` DISABLE KEYS */;
INSERT INTO `rmi_encabezado` VALUES (15,'MP','Doc123','2020-02-26 08:56:19',1,'R','0','0','1',NULL);
/*!40000 ALTER TABLE `rmi_encabezado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(23,1),(24,1),(25,1),(26,1),(29,1),(32,1),(33,1),(34,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,1),(1,2),(2,2),(3,2),(5,2),(42,2),(43,2),(45,2),(49,2),(53,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2019-08-01 01:31:30','2019-11-22 16:05:07','Administrador, Acceso a todos los modulos','1'),(2,'BODEGAS MATERIALES','web','2019-11-25 22:59:32','2019-11-25 23:01:44','BODEGA  MATERIA PRIMA Y MATERIALES DE EMPAQUE','1');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sectores`
--

DROP TABLE IF EXISTS `sectores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sectores` (
  `id_sector` int(11) NOT NULL AUTO_INCREMENT,
  `id_bodega` int(11) DEFAULT NULL,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `id_encargado` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT '1',
  `codigo_interno` tinyint(4) DEFAULT NULL,
  `sistema` char(1) DEFAULT '0',
  PRIMARY KEY (`id_sector`),
  KEY `sector_bodega_idx` (`id_bodega`),
  CONSTRAINT `sector_bodega` FOREIGN KEY (`id_bodega`) REFERENCES `bodegas` (`id_bodega`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sectores`
--

LOCK TABLES `sectores` WRITE;
/*!40000 ALTER TABLE `sectores` DISABLE KEYS */;
INSERT INTO `sectores` VALUES (1,21,'4140754842000017','BODEGA DE MATERIA PRIMA',1,'1',1,'0'),(2,3,'SEC002','SECTOR2',3,'0',2,'0'),(3,1,'SEC003','Sector3',3,'1',1,'0'),(4,1,'SEC90902','Sector 1.2',4,'0',2,'0'),(5,20,'SEC0003','SEC',1,'0',1,'0'),(6,21,'4140754842000031','BODEGA DE MATERIAL DE EMPAQUE',1,'1',3,'0'),(7,23,'0000000000000004','BODEGA CUARENTENA',1,'1',NULL,'1');
/*!40000 ALTER TABLE `sectores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sopas`
--

DROP TABLE IF EXISTS `sopas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sopas` (
  `id_sopa` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `id_presentacion` int(11) DEFAULT NULL,
  `id_control` int(11) DEFAULT NULL,
  `identificacion_cartucho` varchar(45) DEFAULT NULL,
  `identificacion_cartucho_observaciones` varchar(45) DEFAULT NULL,
  `presion_vapor` varchar(45) DEFAULT NULL,
  `presion_vapor_observaciones` varchar(45) DEFAULT NULL,
  `temperatura_del_aceite_set` varchar(45) DEFAULT NULL,
  `temperatura_del_aceite_set_observaciones` varchar(45) DEFAULT NULL,
  `ph_solucion` varchar(45) DEFAULT NULL,
  `ph_solucion_observaciones` varchar(45) DEFAULT NULL,
  `compuestos_polares_libres_frio` varchar(45) DEFAULT NULL,
  `compuestos_polares_libres_antes` varchar(45) DEFAULT NULL,
  `compuestos_polares_libres_durante` varchar(45) DEFAULT NULL,
  `compuestos_polares_libres_despues` varchar(45) DEFAULT NULL,
  `compuestos_polares_libres_observaciones` varchar(45) DEFAULT NULL,
  `indice_acidez_frio` varchar(45) DEFAULT NULL,
  `indice_acidez_antes` varchar(45) DEFAULT NULL,
  `indice_acidez_durante` varchar(45) DEFAULT NULL,
  `indice_acidez_despues` varchar(45) DEFAULT NULL,
  `indice_acidez_observaciones` varchar(45) DEFAULT NULL,
  `temperatura_aceite_frio` varchar(45) DEFAULT NULL,
  `temperatura_aceite_antes` varchar(45) DEFAULT NULL,
  `temperatura_aceite_durante` varchar(45) DEFAULT NULL,
  `temperatura_aceite_despues` varchar(45) DEFAULT NULL,
  `temperatura_aceite_obsevaciones` varchar(45) DEFAULT NULL,
  `porcentaje_solucion` varchar(45) DEFAULT NULL,
  `porcentaje_solucion_observaciones` varchar(45) DEFAULT NULL,
  `verificacion_codificado_lote` varchar(45) DEFAULT NULL,
  `verificacion_codificado_vence` varchar(45) DEFAULT NULL,
  `medidas_molde_superior` varchar(45) DEFAULT NULL,
  `medidas_molde_inferior` varchar(45) DEFAULT NULL,
  `medidas_molde_altura` varchar(45) DEFAULT NULL,
  `medidas_nido_superior` varchar(45) DEFAULT NULL,
  `medidas_nido_inferior` varchar(45) DEFAULT NULL,
  `medidas_nido_altura` varchar(45) DEFAULT NULL,
  `tiempos_mezcla_seco` varchar(45) DEFAULT NULL,
  `tiempos_mezcla_alta` varchar(45) DEFAULT NULL,
  `tiempos_mezcla_baja` varchar(45) DEFAULT NULL,
  `verificacion_material` varchar(45) DEFAULT NULL,
  `verificacion_material_observaciones` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_turno` varchar(45) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `observaciones` varchar(45) DEFAULT NULL,
  `estado` char(10) DEFAULT '0',
  `lote` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_sopa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sopas`
--

LOCK TABLES `sopas` WRITE;
/*!40000 ALTER TABLE `sopas` DISABLE KEYS */;
INSERT INTO `sopas` VALUES (2,1758,64,64,'8','OBSERVACIONES','0.2','OBSERVACIONES',NULL,NULL,NULL,NULL,'25',NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,'3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'150','150','150','1',NULL,1,'1','2020-02-27 14:34:47',NULL,'1',NULL);
/*!40000 ALTER TABLE `sopas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_imprimir`
--

DROP TABLE IF EXISTS `tb_imprimir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_imprimir` (
  `CORRELATIVO` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(45) DEFAULT NULL,
  `CODIGO_BARRAS` varchar(45) DEFAULT NULL,
  `DESCRIPCION_PRODUCTO` varchar(45) DEFAULT NULL,
  `LOTE` varchar(45) DEFAULT NULL,
  `FECHA_VENCIMIENTO` varchar(45) DEFAULT NULL,
  `IMPRESO` varchar(45) DEFAULT 'N',
  `COPIAS` int(11) DEFAULT '1',
  `TIPO` char(1) DEFAULT NULL COMMENT 'PT - Producto terminado.\nD - Despacho\nR - Recepcion',
  PRIMARY KEY (`CORRELATIVO`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_imprimir`
--

LOCK TABLES `tb_imprimir` WRITE;
/*!40000 ALTER TABLE `tb_imprimir` DISABLE KEYS */;
INSERT INTO `tb_imprimir` VALUES (41,'192.168.1.179','7404007620019','AJO DESHIDRATADO EN POLVO','2602','2020-03-27 00:00:00','N',1,'R'),(42,'192.168.1.179','7404007620026','ARVEJA LIOFILIZADA','AR2602','2020-07-22 00:00:00','N',1,'R'),(43,'192.168.1.179','7404007620101','CARBONATO DE SODIO','CS2602','2020-07-17 00:00:00','N',1,'R'),(44,'192.168.1.179','7404007620330','RIBOTIDE','R2602','2020-07-30 00:00:00','N',1,'R'),(45,'192.168.1.179','7404007620019','AJO DESHIDRATADO EN POLVO','AJO2602','2020-07-28 00:00:00','N',1,'R');
/*!40000 ALTER TABLE `tb_imprimir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(90) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES (1,'FAC','Factura','1'),(2,'FACC','Factura cambiaria','1');
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_movimiento`
--

DROP TABLE IF EXISTS `tipo_movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_movimiento` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `factor` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  PRIMARY KEY (`id_movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_movimiento`
--

LOCK TABLES `tipo_movimiento` WRITE;
/*!40000 ALTER TABLE `tipo_movimiento` DISABLE KEYS */;
INSERT INTO `tipo_movimiento` VALUES (1,'ENTRADA',1,'1'),(2,'SALIDA',-1,'1');
/*!40000 ALTER TABLE `tipo_movimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicaciones` (
  `id_localidad` int(11) DEFAULT NULL,
  `id_bodega` int(11) DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `id_pasillo` int(11) DEFAULT NULL,
  `id_rack` int(11) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL,
  `id_posicion` int(11) DEFAULT NULL,
  `id_bin` int(11) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1',
  `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_barras` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ubicacion`),
  KEY `ubicacion_localidad_idx` (`id_localidad`),
  KEY `ubicacion_bodega_idx` (`id_bodega`),
  KEY `ubicacion_sector_idx` (`id_sector`),
  KEY `ubicacion_pasillo_idx` (`id_pasillo`),
  KEY `ubicacion_rack_idx` (`id_rack`),
  KEY `ubicacion_nivel_idx` (`id_nivel`),
  KEY `ubicaicon_posicion_idx` (`id_posicion`),
  CONSTRAINT `ubicacion_bodega` FOREIGN KEY (`id_bodega`) REFERENCES `bodegas` (`id_bodega`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ubicacion_localidad` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_localidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ubicacion_nivel` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ubicacion_pasillo` FOREIGN KEY (`id_pasillo`) REFERENCES `pasillos` (`id_pasillo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ubicacion_rack` FOREIGN KEY (`id_rack`) REFERENCES `racks` (`id_rack`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ubicacion_sector` FOREIGN KEY (`id_sector`) REFERENCES `sectores` (`id_sector`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ubicaicon_posicion` FOREIGN KEY (`id_posicion`) REFERENCES `posiciones` (`id_posicion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicaciones`
--

LOCK TABLES `ubicaciones` WRITE;
/*!40000 ALTER TABLE `ubicaciones` DISABLE KEYS */;
INSERT INTO `ubicaciones` VALUES (1,1,3,7,2,1,1,2,'1',4,'0101010110112','2019-09-02 14:22:33','2019-09-02 17:10:29'),(1,1,3,7,2,1,1,1,'1',6,'0101010110111','2019-09-02 14:37:04','2019-09-02 14:37:04'),(1,1,3,7,4,3,3,3,'1',7,'0101010130111','2019-09-02 14:38:32','2019-09-02 17:08:23'),(2,20,5,8,5,4,4,5,'1',8,'0201010110111','2019-09-02 14:54:01','2019-09-02 17:12:35'),(1,1,3,7,2,1,1,4,'1',9,'0101010110113','2019-10-07 13:05:11','2019-10-07 13:05:11');
/*!40000 ALTER TABLE `ubicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'eespana','estuardoespana@cantonesa.com','$2y$10$BGsJ16odYSvwTA2or1Jxa.5GAFHdS2j04aNYvGJbTXlWa8/2TAIom','Qo2JBca0VkboV4rRx9Xtz7KlD0ufyo8QeEQSg5KzfufH6SKoJOevqcd4RsGs','2019-07-31 06:06:00','2019-11-22 17:06:31','Estuardo España','1'),(10,'barcode','barcode@barcode.com.gt','$2y$10$Ut06Mg/13fTplWb66G1hqOesLO6q7LBCap4p778GBOHvzlix0tRBe','nRyE7v4la6Y2NPlMCI3vc0j0FyIVGgxy4PbvVsjJBxPTeSOY71Ia2wrEA0UZ','2019-11-22 18:30:34','2019-11-22 18:30:34','barcode','1'),(11,'AHERNANDEZ','estuardoespana@cantonesa.com','$2y$10$9Ul6Xextq2J6COSAUB9fVu8ZrfwMZ05UN45RpvLllJs6.wwvIjMLK','TTadSVxRVjbYanT9lohia2hrwRn7xO1LdLnQEwvm0QFljzFpszfY33OdfLZF','2019-11-25 23:02:49','2019-11-25 23:02:49','AXEL HERNANDEZ','1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verificacion_materias_chao_det`
--

DROP TABLE IF EXISTS `verificacion_materias_chao_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verificacion_materias_chao_det` (
  `id_verificacion_det` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hora` varchar(25) DEFAULT NULL,
  `batch_no` varchar(45) DEFAULT NULL,
  `equipo` varchar(35) DEFAULT NULL,
  `observaciones` text,
  `id_usuario` int(11) DEFAULT NULL,
  `id_verificacion` int(11) DEFAULT NULL,
  `producto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_verificacion_det`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verificacion_materias_chao_det`
--

LOCK TABLES `verificacion_materias_chao_det` WRITE;
/*!40000 ALTER TABLE `verificacion_materias_chao_det` DISABLE KEYS */;
INSERT INTO `verificacion_materias_chao_det` VALUES (1,21,NULL,21.00,'2020-03-04 16:23:25','10:23:23','21','21',NULL,1,4,NULL),(2,2,NULL,4.00,'2020-03-04 16:23:39','10:23:37','1','5','6',1,4,NULL),(3,2,NULL,3.00,'2020-03-04 16:23:59','10:23:57','1','4','5',1,4,NULL),(4,0,NULL,NULL,'2020-03-04 17:40:11',NULL,'21',NULL,NULL,1,29,NULL),(5,1546,'2602',21.00,'2020-03-04 17:45:50',NULL,'21',NULL,NULL,1,31,'AJO DESHIDRATADO EN POLVO'),(6,1546,'2602',150.00,'2020-03-04 17:50:27',NULL,'21','EQUIPO',NULL,1,33,'AJO DESHIDRATADO EN POLVO'),(7,1546,'2602',150.00,'2020-03-04 17:55:00',NULL,'1',NULL,NULL,1,34,'AJO DESHIDRATADO EN POLVO'),(8,1546,'2602',1.00,'2020-03-04 17:55:36',NULL,'21',NULL,NULL,1,34,'AJO DESHIDRATADO EN POLVO'),(9,1546,'2602',1.00,'2020-03-04 17:59:30',NULL,'21','2',NULL,1,35,'AJO DESHIDRATADO EN POLVO'),(10,1546,'2602',1.00,'2020-03-04 17:59:43',NULL,'1',NULL,NULL,1,35,'AJO DESHIDRATADO EN POLVO'),(11,1546,'2602',22.00,'2020-03-04 18:02:25',NULL,'1','21','21',1,36,'AJO DESHIDRATADO EN POLVO'),(12,1546,'2602',2.00,'2020-03-04 18:02:38',NULL,'2',NULL,NULL,1,36,'AJO DESHIDRATADO EN POLVO'),(13,1546,'2602',2.00,'2020-03-04 18:05:13',NULL,'88','EUIPO','2',1,37,'AJO DESHIDRATADO EN POLVO'),(14,1546,'2602',150.00,'2020-03-04 18:05:34',NULL,'1','1',NULL,1,37,'AJO DESHIDRATADO EN POLVO'),(15,1546,'2602',2.00,'2020-03-04 18:16:28',NULL,'2','3','1',1,40,'AJO DESHIDRATADO EN POLVO'),(16,1546,'2602',0.00,'2020-03-04 18:16:47',NULL,'12','1',NULL,1,40,'AJO DESHIDRATADO EN POLVO'),(17,1546,'2602',149.00,'2020-03-04 18:17:55',NULL,'1','1',NULL,1,41,'AJO DESHIDRATADO EN POLVO'),(18,1546,'2602',1.00,'2020-03-04 18:18:10',NULL,'2','1','2',1,41,'AJO DESHIDRATADO EN POLVO');
/*!40000 ALTER TABLE `verificacion_materias_chao_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verificacion_materias_chao_enc`
--

DROP TABLE IF EXISTS `verificacion_materias_chao_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verificacion_materias_chao_enc` (
  `id_verificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_turno` varchar(25) DEFAULT NULL,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_control` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_verificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verificacion_materias_chao_enc`
--

LOCK TABLES `verificacion_materias_chao_enc` WRITE;
/*!40000 ALTER TABLE `verificacion_materias_chao_enc` DISABLE KEYS */;
INSERT INTO `verificacion_materias_chao_enc` VALUES (41,1,'2','2020-03-04 18:17:35',63);
/*!40000 ALTER TABLE `verificacion_materias_chao_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verificacion_materias_det`
--

DROP TABLE IF EXISTS `verificacion_materias_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verificacion_materias_det` (
  `id_verificacion_det` int(11) NOT NULL AUTO_INCREMENT,
  `hora` varchar(25) DEFAULT NULL,
  `batch_no` varchar(45) DEFAULT NULL,
  `harina` varchar(45) DEFAULT NULL,
  `cantidad_solucion` varchar(45) DEFAULT NULL,
  `observaciones` text,
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  `id_verificacion_enc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_verificacion_det`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verificacion_materias_det`
--

LOCK TABLES `verificacion_materias_det` WRITE;
/*!40000 ALTER TABLE `verificacion_materias_det` DISABLE KEYS */;
INSERT INTO `verificacion_materias_det` VALUES (1,'08:24:03','21','123',NULL,'21','2020-03-04 14:24:06',1,3),(2,'08:24:30','21','2121',NULL,'2121','2020-03-04 14:24:32',1,3),(3,'08:26:58','105','515',NULL,'15','2020-03-04 14:27:00',1,4),(4,'08:31:03','21','21','21','21','2020-03-04 14:31:05',1,5),(5,'08:31:09','1','3','2','4','2020-03-04 14:31:11',1,5),(6,'08:41:43','21','21','21','21','2020-03-04 14:41:45',1,5),(7,'08:44:56','21','21','21','21','2020-03-04 14:44:58',1,5),(8,'08:45:56','500','210','400','250','2020-03-04 14:45:58',1,5),(9,'15:37:43','1','300','3','cambio','2020-03-09 21:37:45',1,5);
/*!40000 ALTER TABLE `verificacion_materias_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verificacion_materias_enc`
--

DROP TABLE IF EXISTS `verificacion_materias_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verificacion_materias_enc` (
  `id_verificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_control` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  `id_turno` varchar(45) DEFAULT NULL,
  `observaciones` text,
  PRIMARY KEY (`id_verificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verificacion_materias_enc`
--

LOCK TABLES `verificacion_materias_enc` WRITE;
/*!40000 ALTER TABLE `verificacion_materias_enc` DISABLE KEYS */;
INSERT INTO `verificacion_materias_enc` VALUES (5,63,1795,'2020-03-04 14:31:00',1,'1','observaciones, observaciones');
/*!40000 ALTER TABLE `verificacion_materias_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'cantonesa'
--

--
-- Dumping routines for database 'cantonesa'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-13 14:35:54
