-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: portalfuncionarios
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `campus`
--

DROP TABLE IF EXISTS `campus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campus` (
  `id_campus` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `texto` text,
  `url` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `dt_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `missao` varchar(1000) DEFAULT NULL,
  `visao` varchar(1000) DEFAULT NULL,
  `valores` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_campus`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus`
--

LOCK TABLES `campus` WRITE;
/*!40000 ALTER TABLE `campus` DISABLE KEYS */;
INSERT INTO `campus` VALUES (1,'AMBULATÓRIO',NULL,NULL,NULL,NULL,1,'2024-03-20 16:05:58','2024-03-20 16:05:58',NULL,NULL,NULL),(2,'CESO',NULL,NULL,NULL,NULL,1,'2024-03-20 16:05:58','2024-03-20 16:05:58',NULL,NULL,NULL),(3,'HCTCO',NULL,'<p class=\"lead\">A partir de agora você faz parte do campus HCTCO.</p>\r\n<p class=\"lead\">Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional. </p>    \r\nNela você vai encontrar informações financeiras, benefícios, normas de trabalho e responsabilidades e os principais canais de comunicação. Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional.</p>\r\n<p class=\"lead\">Leia com atenção e conheça seus direitos e deveres.</p>\r\n<p class=\"lead\">Estará sempre disponível sempre que precisar.</p>',NULL,'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/5ddd03d359886c38624ce835c9ad58f5.jpg',1,'2024-03-20 16:05:58','2024-03-20 19:05:24',NULL,NULL,NULL),(4,'PROARTE',NULL,NULL,NULL,NULL,NULL,'2024-03-20 16:05:58','2024-05-16 21:46:10',NULL,NULL,NULL),(5,'SEDE',NULL,'<p class=\"lead\">A partir de agora você faz parte do campus SEDE.</p>\n<p class=\"lead\">Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional. </p>    \nNela você vai encontrar informações financeiras, benefícios, normas de trabalho e responsabilidades e os principais canais de comunicação. Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional.</p>\n<p class=\"lead\">Leia com atenção e conheça seus direitos e deveres.</p>\n<p class=\"lead\">Estará sempre disponível sempre que precisar.</p>','','https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/b9a421dec6fb6371b171795747b274f4.jpg',1,'2024-03-20 16:05:58','2024-03-20 19:03:14',NULL,NULL,NULL),(6,'Q.PARAISO',NULL,NULL,NULL,NULL,1,'2024-03-20 16:05:58','2024-03-20 16:05:58',NULL,NULL,NULL),(7,'CAMPUS TESTE',NULL,'teste 1',NULL,NULL,1,'2024-04-15 21:04:38',NULL,'teste 2','teste 3','teste 4');
/*!40000 ALTER TABLE `campus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus_tarefa`
--

DROP TABLE IF EXISTS `campus_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campus_tarefa` (
  `id_campus_tarefa` int NOT NULL AUTO_INCREMENT,
  `id_campus` int NOT NULL,
  `id_tarefa` int NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_campus_tarefa`),
  KEY `FK_campus_tarefa_campus` (`id_campus`),
  KEY `FK_campus_tarefa_tarefa` (`id_tarefa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus_tarefa`
--

LOCK TABLES `campus_tarefa` WRITE;
/*!40000 ALTER TABLE `campus_tarefa` DISABLE KEYS */;
/*!40000 ALTER TABLE `campus_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `id_departamento` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documentos` (
  `id_documentos` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `caminho_arquivo` varchar(100) NOT NULL,
  `status` int DEFAULT NULL,
  `data` date NOT NULL,
  `tipo_arquivo` varchar(4) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `ordem` int DEFAULT NULL,
  PRIMARY KEY (`id_documentos`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,'Acesse aqui, o seu manual do colaborador!','https://drive.google.com/file/d/1tN-lOzAe4J4xcFeBMFROB23FuSvVE7Lh/view?usp=drive_link',1,'2024-05-09','pdf','https://www.unifeso.edu.br/cursos/images/cursos/head/632739744f3d488a5a7b4910caf4f306.png','Manual do Colaborador',3),(2,'Ja registrou sua batidade de ponto hoje?','https://drive.google.com/file/d/1F_yulL4QwmZZ9kwrWDaLWNzH4urf-kiz/view',1,'2024-05-09','mp4','https://www.totvs.com/wp-content/uploads/2022/10/ponto-eletronico-digital.jpg','Vídeo ponto eletrônico',1),(3,'Conheça um pouco mais sobre nós!','https://www.youtube.com/watch?v=iWYpGV6cJp0',1,'2024-05-09','mp4','https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/824191be56e48c740500188bd68cf2e7.jpg','Vídeo Ambientação',2),(4,'Floresta e Arbustos','https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf',NULL,'0000-00-00','pdf','https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg','Arvores',NULL),(5,'teste 2','https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf',NULL,'0000-00-00','pdf','https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg','teste',NULL),(6,'teste 2','https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf',1,'0000-00-00','pdf','https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg','teste',4);
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evento` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `id_tipo_evento` int NOT NULL,
  `id_responsavel` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `dt_begin` datetime NOT NULL,
  `dt_end` datetime NOT NULL,
  `status` int NOT NULL,
  `link` varchar(255) NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_evento`),
  KEY `FK_evento_tipo_evento` (`id_tipo_evento`),
  KEY `id_responsavel` (`id_responsavel`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (1,1,1,'Reunião entre Professores','DESCRIÇÃO TESTE','2024-06-16 10:00:00','2024-06-16 11:00:00',4,'https://www.youtube.com/watch?v=hCM1-X5nCLI','0000-00-00 00:00:00','2024-06-05 22:10:43'),(2,7,1,'Desligamento EAD','Desligamento do setor de EAD','2024-06-04 20:00:00','2024-06-04 20:00:00',1,'','2024-06-04 23:04:26','2024-06-04 23:45:58');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id_feedback` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_departamento` int NOT NULL,
  `titulo_feedback` varchar(50) NOT NULL,
  `descricao_feedback` text NOT NULL,
  `avaliacao` int NOT NULL,
  `visualizacao` int DEFAULT NULL,
  PRIMARY KEY (`id_feedback`),
  KEY `FK_feedback_departamento` (`id_departamento`),
  KEY `FK_feedback_pessoa` (`id_pessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_perguntas`
--

DROP TABLE IF EXISTS `forum_perguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_perguntas` (
  `id_forum_perguntas` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_departamento` int NOT NULL,
  `titulo_pergunta` varchar(50) NOT NULL,
  `descricao_pergunta` text NOT NULL,
  `visualizacao` int NOT NULL DEFAULT '0',
  `qtd_resposta` int NOT NULL,
  `data_pergunta` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_topico` int NOT NULL DEFAULT '1',
  `status` int DEFAULT '1',
  PRIMARY KEY (`id_forum_perguntas`),
  KEY `FK_forum_perguntas_departamento` (`id_departamento`),
  KEY `FK_forum_perguntas_pessoa` (`id_pessoa`),
  KEY `FK_forum_perguntas_forum_topicos` (`id_topico`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_perguntas`
--

LOCK TABLES `forum_perguntas` WRITE;
/*!40000 ALTER TABLE `forum_perguntas` DISABLE KEYS */;
INSERT INTO `forum_perguntas` VALUES (1,1,1,'teste 1','descrição do teste 1',NULL,0,'2024-04-25 21:48:55',0,1),(2,1,1,'teste 2','descrição de teste 2',NULL,0,'2024-04-25 21:49:19',0,1);
/*!40000 ALTER TABLE `forum_perguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_respostas`
--

DROP TABLE IF EXISTS `forum_respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_respostas` (
  `id_forum_respostas` int NOT NULL AUTO_INCREMENT,
  `id_forum_perguntas` int NOT NULL,
  `id_pessoa` int NOT NULL,
  `resposta` text NOT NULL,
  `data_respostas` datetime NOT NULL,
  PRIMARY KEY (`id_forum_respostas`),
  KEY `FK_forum_respostas_forum_perguntas` (`id_forum_perguntas`),
  KEY `FK_forum_respostas_pessoa` (`id_pessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Acionadores `forum_respostas`
--
DROP TRIGGER IF EXISTS `atualiza_qtd_respostas`;
DELIMITER $$
CREATE TRIGGER `atualiza_qtd_respostas` AFTER INSERT ON `forum_respostas` FOR EACH ROW BEGIN
    UPDATE forum_perguntas
    SET qtd_resposta = qtd_resposta + 1
    WHERE id_forum_perguntas = NEW.id_forum_perguntas;
END
$$
DELIMITER ;

--
-- Dumping data for table `forum_respostas`
--

LOCK TABLES `forum_respostas` WRITE;
/*!40000 ALTER TABLE `forum_respostas` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_respostas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_topicos`
--

DROP TABLE IF EXISTS `forum_topicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_topicos` (
  `id_topicos` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`id_topicos`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_topicos`
--

LOCK TABLES `forum_topicos` WRITE;
/*!40000 ALTER TABLE `forum_topicos` DISABLE KEYS */;
INSERT INTO `forum_topicos` VALUES (1,'Todos os tópicos'),(2,'Mais Populares'),(3,'Resolvidos'),(4,'Não resolvidos'),(5,'Sem respostas');
/*!40000 ALTER TABLE `forum_topicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_acesso`
--

DROP TABLE IF EXISTS `grupo_acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupo_acesso` (
  `id_grupo_acesso` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_grupo_acesso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_acesso`
--

LOCK TABLES `grupo_acesso` WRITE;
/*!40000 ALTER TABLE `grupo_acesso` DISABLE KEYS */;
INSERT INTO `grupo_acesso` VALUES (1,'admin',1),(2,'Funcionários',1);
/*!40000 ALTER TABLE `grupo_acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_tarefa`
--

DROP TABLE IF EXISTS `item_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_tarefa` (
  `id_item_tarefa` int NOT NULL AUTO_INCREMENT,
  `id_tarefa` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` int DEFAULT NULL,
  `dt_begin` date DEFAULT NULL,
  `dt_end` date DEFAULT NULL,
  PRIMARY KEY (`id_item_tarefa`),
  KEY `id_tarefa` (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_tarefa`
--

LOCK TABLES `item_tarefa` WRITE;
/*!40000 ALTER TABLE `item_tarefa` DISABLE KEYS */;
INSERT INTO `item_tarefa` VALUES (40,17,'item tarefa 2',0,'2024-06-04','2024-06-04'),(37,16,'Primeiro envio de arquivo',0,'2024-05-28','2024-05-29'),(39,17,'item tarefa 1',0,'2024-06-04','2024-06-04'),(38,16,'Clonar repositorio',0,'2024-06-01','2024-06-02'),(36,16,'Como criar um repositorio',0,'2024-05-27','2024-05-27'),(35,15,'Pagina de Boas vindas',0,'2024-02-01','2024-02-29'),(34,15,'Tela de Login',0,'2024-02-01','2024-02-29'),(33,15,'Cadastro de Usuário',0,'2024-01-01','2024-01-31');
/*!40000 ALTER TABLE `item_tarefa` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_item_tarefa_insert` AFTER INSERT ON `item_tarefa` FOR EACH ROW BEGIN
    CALL update_tarefa_status(NEW.id_tarefa);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_item_tarefa_update` AFTER UPDATE ON `item_tarefa` FOR EACH ROW BEGIN
    CALL update_tarefa_status(NEW.id_tarefa);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `tabela` varchar(50) DEFAULT NULL,
  `acao` varchar(15) DEFAULT NULL,
  `usuario` varchar(70) DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  `chave` varchar(255) DEFAULT NULL,
  `antes` varchar(4000) DEFAULT NULL,
  `depois` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'pessoa','INSERT','root@localhost','2024-06-18 14:44:13','15',NULL,NULL);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ordem` int NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Dashboard','dashboard.php',1,'2024-03-20 21:22:22','2024-04-16 02:10:51',1,NULL),(2,'Tarefas','tarefas.php',1,'2024-03-20 21:22:22','2024-04-16 02:10:51',2,NULL),(4,'Recursos e Documentação','documentacao.php',1,'2024-03-20 21:22:22','2024-05-16 23:09:39',4,NULL),(5,'Agendamento','agendamento.php',1,'2024-03-20 21:22:22','2024-04-16 02:10:54',5,NULL),(6,'Fórum','forum.php',1,'2024-03-20 21:22:22','2024-04-16 02:10:55',6,NULL),(7,'Feedback','feedback.php',1,'2024-03-20 21:22:22','2024-04-16 02:10:56',7,NULL),(8,'Nível Acesso','acesso.php',2,'2024-04-16 02:12:27','2024-04-16 02:19:01',1,'Libera acesso aos usuários e concede permissão para visualizar, editar e deletar no sistema. '),(9,'Textos Padrões','texto.php',2,'2024-04-16 02:22:11','2024-04-16 02:22:49',2,'Inclui os textos da pagina inicial e as imagens padrões do sistema.'),(10,'Departamento','departamento.php',2,'2024-04-16 21:54:52','2024-05-27 23:33:53',4,'Inclui os departamentos da empresa para uma organização mais detalhada das funcionalidades e filtros do sistema.'),(11,'Recursos e Documentação','recursos.php',2,'2024-04-16 02:22:11','2024-05-27 23:33:51',3,'Inclui os arquivos do menu Recursos e Documentação'),(12,'Tipo de Evento','tipo_evento.php',2,'2024-05-27 23:33:27','2024-05-27 23:35:04',5,'Inclui os tipos de eventos padrões do sistema.');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participante`
--

DROP TABLE IF EXISTS `participante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participante` (
  `id_participante` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_evento` int NOT NULL,
  `status` int NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_participante`),
  KEY `FK_participante_evento` (`id_evento`),
  KEY `FK_participante_pessoa` (`id_pessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participante`
--

LOCK TABLES `participante` WRITE;
/*!40000 ALTER TABLE `participante` DISABLE KEYS */;
INSERT INTO `participante` VALUES (1,1,1,1,'2024-05-27 23:53:35','2024-05-27 23:53:35'),(2,9,2,1,'2024-06-04 23:04:26','2024-06-04 23:04:26'),(3,5,1,0,'2024-06-05 23:25:37','2024-06-05 23:25:37'),(4,8,1,0,'2024-06-05 23:27:01','2024-06-05 23:27:01');
/*!40000 ALTER TABLE `participante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao`
--

DROP TABLE IF EXISTS `permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissao` (
  `id_permissao` int NOT NULL AUTO_INCREMENT,
  `id_grupo_acesso` int NOT NULL,
  `id_menu` int NOT NULL,
  `visualizar` char(1) NOT NULL DEFAULT 'N',
  `editar` char(1) NOT NULL DEFAULT 'N',
  `deletar` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_permissao`),
  KEY `FK_permissao_grupo_acesso` (`id_grupo_acesso`),
  KEY `FK_permissao_menu` (`id_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao`
--

LOCK TABLES `permissao` WRITE;
/*!40000 ALTER TABLE `permissao` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa` (
  `id_pessoa` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` int DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_campus` int NOT NULL,
  `id_departamento` int NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_pessoa`),
  KEY `fk_pessoa_campus` (`id_campus`),
  KEY `FK_pessoa_departamento` (`id_departamento`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (2,'2345','João da Silva',1,'joaosilva@unifeso.edu.br','961e50d73bfdd3edbbd46188ecbde30a3936d83d9d4a35899fa16ac8b4ffbc35','$2y$10$r1Nt0YGZ.HsZuNnA57RO5uNgv2W.1ZN8LX2pMkFRkQfPWWJA0hA5G','2024-03-20 19:13:42','2024-03-20 19:13:42',6,0,NULL),(4,'062168','Hugo',0,'hugo@gmail.com','4c86cf5d0745caa4e1661559b7b8271043fb22021c8853b0c073e108ef586f57','$2y$10$kcVjh1YHGU4FTxn4jlim7um6o4o0ACiZrZg5DmyoXqd7Djn5oXli2','2024-04-05 01:34:56','2024-04-16 21:44:02',3,0,NULL),(3,'06004672','Gabriel Guedes',1,'gabrielguedes00@hotmail.com','c8b082d35ba2a8b2765828cccaa2496d8a6a095d7410f8b3544461ca606bcdc0','$2y$10$HU0..v1MrAzAxCEKnivJpOVtcvwGeM4fBnHPSVF9gnx1bP7rJP9ES','2024-03-21 01:04:07','2024-03-21 01:04:07',3,0,NULL),(1,'073842','Lucas',1,'lucasduarte@feso.edu.br','3b42bf0d3d3aa83495d431704bf36ab49688dbd23f978e1e91008924418f1d52','$2y$10$CzlnkuUeeuxUI10RSOSOpOlcstrI60Y0aj484O5gpKZqOP6gq6MC2','2024-03-20 18:04:57','2024-04-17 01:07:19',5,0,NULL),(5,'111222','Ronald',1,'ronaldmc@gmail.com','d8094448cd1aa6b88815a7c2a064c4b772b2d2da04d21295a13916dfd32feb4c','$2y$10$9b6EF6YTat3Bc4k0l/hoSOx5NNXecpyc84vq/ka.zsSz7pWryOZMy','2024-04-16 20:52:46','2024-04-16 20:52:46',6,0,NULL),(10,'111446688','rafael',1,'rafael@gmail.com','a960e61280734fb017f6d97d48b8a6c4913e146035279e4b564a640116f78e88','$2y$10$TWrd2mjNgq2/HsRs84BUm.qSV6URu9fFTYCZfFgtgPsCe4k1sUePe','2024-06-18 17:41:30','2024-06-18 17:41:30',5,0,NULL),(15,'111446688','rafael',1,'rafael@gmail.com','a960e61280734fb017f6d97d48b8a6c4913e146035279e4b564a640116f78e88','$2y$10$TWrd2mjNgq2/HsRs84BUm.qSV6URu9fFTYCZfFgtgPsCe4k1sUePe','2024-06-18 17:44:13','2024-06-18 17:44:13',5,0,NULL);
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trigger_log_insert` AFTER INSERT ON `pessoa` FOR EACH ROW begin
    insert into Logs (tabela, acao, usuario, data_hora, chave, antes, depois)
    values ('pessoa', 'INSERT', current_user, now(), new.id_pessoa, null,
           concat(new.id_pessoa, new.matricula, new.nome, new.status, new.email, new.token, new.senha, new.id_campus, new.id_departamento, new.telefone));
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trigger_log_update` AFTER UPDATE ON `pessoa` FOR EACH ROW begin
    insert into Logs (tabela, acao, usuario, data_hora, chave, antes, depois)
    values ('pessoa', 'UPDATE', current_user, now(), new.id_pessoa,
			concat(old.id_pessoa, old.matricula, old.nome, old.status, old.email, old.token, old.senha, old.id_campus, old.id_departamento, old.telefone),
           concat(new.id_pessoa, new.matricula, new.nome, new.status, new.email, new.token, new.senha, new.id_campus, new.id_departamento, new.telefone));
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trigger_log_delete` AFTER DELETE ON `pessoa` FOR EACH ROW begin
    insert into Logs (tabela, acao, usuario, data_hora, chave, antes, depois)
    values ('pessoa', 'DELETE', current_user, now(), old.id_pessoa,
			concat(old.id_pessoa, old.matricula, old.nome, old.status, old.email, old.token, old.senha, old.id_campus, old.id_departamento, old.telefone),
          null);
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `pessoa_acesso`
--

DROP TABLE IF EXISTS `pessoa_acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa_acesso` (
  `id_pessoa_acesso` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_grupo_acesso` int NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_pessoa_acesso`),
  KEY `FK_pessoa_acesso_pessoa` (`id_pessoa`),
  KEY `FK_pessoa_acesso_grupo_acesso` (`id_grupo_acesso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa_acesso`
--

LOCK TABLES `pessoa_acesso` WRITE;
/*!40000 ALTER TABLE `pessoa_acesso` DISABLE KEYS */;
INSERT INTO `pessoa_acesso` VALUES (1,4,1,1),(2,1,2,1);
/*!40000 ALTER TABLE `pessoa_acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa_tarefa`
--

DROP TABLE IF EXISTS `pessoa_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa_tarefa` (
  `id_pessoa_tarefa` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_tarefa` int NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pessoa_tarefa`),
  KEY `FK_pessoa_tarefa_pessoa` (`id_pessoa`),
  KEY `id_tarefa` (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa_tarefa`
--

LOCK TABLES `pessoa_tarefa` WRITE;
/*!40000 ALTER TABLE `pessoa_tarefa` DISABLE KEYS */;
INSERT INTO `pessoa_tarefa` VALUES (8,9,17,1,'2024-06-04 22:52:23','2024-06-04 22:52:23'),(7,1,16,1,'2024-05-27 22:57:56','2024-05-27 22:57:56'),(6,1,15,1,'2024-05-23 00:19:39','2024-05-23 00:19:39');
/*!40000 ALTER TABLE `pessoa_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarefa`
--

DROP TABLE IF EXISTS `tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarefa` (
  `id_tarefa` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `dt_begin` date DEFAULT NULL,
  `dt_end` date DEFAULT NULL,
  PRIMARY KEY (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarefa`
--

LOCK TABLES `tarefa` WRITE;
/*!40000 ALTER TABLE `tarefa` DISABLE KEYS */;
INSERT INTO `tarefa` VALUES (17,'teste 2','2024-06-04 22:52:23','2024-06-04 22:53:43',0,'2024-06-04','2024-06-04'),(16,'Curso GitHub','2024-05-27 22:57:56','2024-05-27 22:59:03',0,'2024-05-27','2024-07-31'),(15,'Criar Sistema para Funcionários','2024-05-23 00:19:39','2024-05-23 00:20:10',0,'2024-01-01','2024-12-31');
/*!40000 ALTER TABLE `tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_arquivo`
--

DROP TABLE IF EXISTS `tipo_arquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_arquivo` (
  `id_tipo_arquivo` int NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `formato` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_arquivo`
--

LOCK TABLES `tipo_arquivo` WRITE;
/*!40000 ALTER TABLE `tipo_arquivo` DISABLE KEYS */;
INSERT INTO `tipo_arquivo` VALUES (1,'Vídeo','mp4'),(2,'Documentos','pdf'),(3,'Áudio','mp3'),(3,'Planilha','xls');
/*!40000 ALTER TABLE `tipo_arquivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_evento`
--

DROP TABLE IF EXISTS `tipo_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_evento` (
  `id_tipo_evento` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_tipo_evento`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_evento`
--

LOCK TABLES `tipo_evento` WRITE;
/*!40000 ALTER TABLE `tipo_evento` DISABLE KEYS */;
INSERT INTO `tipo_evento` VALUES (1,'Reunião',1),(2,'Treinamento',1),(3,'Palestra',1),(4,'Confraternização',1),(5,'Desligamento Coletivo',NULL),(7,'Desligamento Coletivo',1),(6,'teste 2',NULL),(8,'teste',NULL),(9,'teste3333',NULL);
/*!40000 ALTER TABLE `tipo_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'portalfuncionarios'
--
/*!50003 DROP PROCEDURE IF EXISTS `update_tarefa_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_tarefa_status`(IN `tarefa_id` INT)
BEGIN
    DECLARE total_status INT;
    DECLARE total_concluidos INT;

    -- Conta quantos itens de tarefa estão marcados como concluídos (status = 1)
    SELECT COUNT(*) INTO total_status
    FROM item_tarefa
    WHERE id_tarefa = tarefa_id AND status = 1;

    -- Conta quantos itens de tarefa existem para a tarefa
    SELECT COUNT(*) INTO total_concluidos
    FROM item_tarefa
    WHERE id_tarefa = tarefa_id;

    -- Se todos os itens de tarefa para essa tarefa estiverem marcados como concluídos, atualize o status da tarefa para 1
    IF total_status = total_concluidos THEN
        UPDATE tarefa SET status = 1 WHERE id_tarefa = tarefa_id;
    -- Se houver itens de tarefa marcados como concluídos, mas não todos, atualize o status da tarefa para 0
    ELSEIF total_status > 0 THEN
        UPDATE tarefa SET status = 0 WHERE id_tarefa = tarefa_id;
    -- Se não houver nenhum item de tarefa marcado como concluído, atualize o status da tarefa para 0
    ELSE
        UPDATE tarefa SET status = 0 WHERE id_tarefa = tarefa_id;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_timestamps` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_timestamps`()
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE table_name VARCHAR(255);
    DECLARE cur CURSOR FOR 
        SELECT TABLE_NAME 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_SCHEMA = 'your_database_name';

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO table_name;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        SET @alter_sql = CONCAT('ALTER TABLE ', table_name, 
                                ' ADD COLUMN IF NOT EXISTS dt_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,',
                                ' ADD COLUMN IF NOT EXISTS dt_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');
        PREPARE stmt FROM @alter_sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END LOOP;

    CLOSE cur;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-18 14:47:42
