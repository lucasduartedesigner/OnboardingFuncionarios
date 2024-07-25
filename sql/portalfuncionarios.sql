-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25/07/2024 às 18:53
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portalfuncionarios`
--

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `update_tarefa_status`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_tarefa_status` (IN `tarefa_id` INT)   BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `update_timestamps`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_timestamps` ()   BEGIN
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `campus`
--

DROP TABLE IF EXISTS `campus`;
CREATE TABLE IF NOT EXISTS `campus` (
  `id_campus` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `texto` mediumtext COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `dt_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `missao` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visao` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valores` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_campus`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `campus`
--

INSERT INTO `campus` (`id_campus`, `nome`, `titulo`, `texto`, `url`, `imagem`, `status`, `dt_created`, `dt_updated`, `missao`, `visao`, `valores`) VALUES
(1, 'AMBULATÓRIO', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
(2, 'CESO', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
(3, 'HCTCO', NULL, '<p class=\"lead\">A partir de agora você faz parte do campus HCTCO.</p>\r\n<p class=\"lead\">Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional. </p>    \r\nNela você vai encontrar informações financeiras, benefícios, normas de trabalho e responsabilidades e os principais canais de comunicação. Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional.</p>\r\n<p class=\"lead\">Leia com atenção e conheça seus direitos e deveres.</p>\r\n<p class=\"lead\">Estará sempre disponível sempre que precisar.</p>', NULL, 'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/5ddd03d359886c38624ce835c9ad58f5.jpg', 1, '2024-03-20 16:05:58', '2024-03-20 19:05:24', NULL, NULL, NULL),
(4, 'PROARTE', NULL, NULL, NULL, NULL, NULL, '2024-03-20 16:05:58', '2024-05-16 21:46:10', NULL, NULL, NULL),
(5, 'SEDE', NULL, '<p class=\"lead\">A partir de agora você faz parte do campus SEDE.</p>\n<p class=\"lead\">Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional. </p>    \nNela você vai encontrar informações financeiras, benefícios, normas de trabalho e responsabilidades e os principais canais de comunicação. Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional.</p>\n<p class=\"lead\">Leia com atenção e conheça seus direitos e deveres.</p>\n<p class=\"lead\">Estará sempre disponível sempre que precisar.</p>', '', 'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/b9a421dec6fb6371b171795747b274f4.jpg', 1, '2024-03-20 16:05:58', '2024-03-20 19:03:14', NULL, NULL, NULL),
(6, 'Q.PARAISO', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
(7, 'CAMPUS TESTE', NULL, 'teste 1', NULL, NULL, 1, '2024-04-15 21:04:38', NULL, 'teste 2', 'teste 3', 'teste 4');

-- --------------------------------------------------------

--
-- Estrutura para tabela `campus_tarefa`
--

DROP TABLE IF EXISTS `campus_tarefa`;
CREATE TABLE IF NOT EXISTS `campus_tarefa` (
  `id_campus_tarefa` int NOT NULL AUTO_INCREMENT,
  `id_campus` int NOT NULL,
  `id_tarefa` int NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_campus_tarefa`),
  KEY `FK_campus_tarefa_campus` (`id_campus`),
  KEY `FK_campus_tarefa_tarefa` (`id_tarefa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `id_documentos` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caminho_arquivo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `data` date NOT NULL,
  `tipo_arquivo` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordem` int DEFAULT NULL,
  PRIMARY KEY (`id_documentos`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `documentos`
--

INSERT INTO `documentos` (`id_documentos`, `nome`, `caminho_arquivo`, `status`, `data`, `tipo_arquivo`, `imagem`, `titulo`, `ordem`) VALUES
(1, 'Acesse aqui, o seu manual do colaborador!', 'https://drive.google.com/file/d/1tN-lOzAe4J4xcFeBMFROB23FuSvVE7Lh/view?usp=drive_link', 1, '2024-05-09', 'pdf', 'https://www.unifeso.edu.br/cursos/images/cursos/head/632739744f3d488a5a7b4910caf4f306.png', 'Manual do Colaborador', 3),
(2, 'Ja registrou sua batidade de ponto hoje?', 'https://drive.google.com/file/d/1F_yulL4QwmZZ9kwrWDaLWNzH4urf-kiz/view', 1, '2024-05-09', 'mp4', 'https://www.totvs.com/wp-content/uploads/2022/10/ponto-eletronico-digital.jpg', 'Vídeo ponto eletrônico', 1),
(3, 'Conheça um pouco mais sobre nós!', 'https://www.youtube.com/watch?v=iWYpGV6cJp0', 1, '2024-05-09', 'mp4', 'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/824191be56e48c740500188bd68cf2e7.jpg', 'Vídeo Ambientação', 2),
(4, 'Floresta e Arbustos', 'https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf', NULL, '0000-00-00', 'pdf', 'https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg', 'Arvores', NULL),
(5, 'teste 2', 'https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf', NULL, '0000-00-00', 'pdf', 'https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg', 'teste', NULL),
(6, 'teste 2', 'https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf', 1, '0000-00-00', 'pdf', 'https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg', 'teste', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `id_tipo_evento` int NOT NULL,
  `id_responsavel` int NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_begin` datetime NOT NULL,
  `dt_end` datetime NOT NULL,
  `status` int NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_evento`),
  KEY `FK_evento_tipo_evento` (`id_tipo_evento`),
  KEY `id_responsavel` (`id_responsavel`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `evento`
--

INSERT INTO `evento` (`id_evento`, `id_tipo_evento`, `id_responsavel`, `titulo`, `descricao`, `dt_begin`, `dt_end`, `status`, `link`, `dt_created`, `dt_updated`) VALUES
(1, 1, 1, 'Reunião entre Professores', 'DESCRIÇÃO TESTE', '2024-06-16 10:00:00', '2024-06-16 11:00:00', 4, 'https://www.youtube.com/watch?v=hCM1-X5nCLI', '0000-00-00 00:00:00', '2024-06-05 22:10:43'),
(2, 7, 1, 'Desligamento EAD', 'Desligamento do setor de EAD', '2024-06-04 20:00:00', '2024-06-04 20:00:00', 1, '', '2024-06-04 23:04:26', '2024-06-04 23:45:58'),
(3, 1, 1, 'Cofeso IX - 2024', 'Economia Azul', '2024-06-06 10:00:00', '2024-06-06 10:00:00', 1, '', '2024-06-06 23:38:41', '2024-06-06 23:38:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id_feedback` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_departamento` int NOT NULL,
  `titulo_feedback` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_feedback` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `avaliacao` int NOT NULL,
  `visualizacao` int DEFAULT NULL,
  PRIMARY KEY (`id_feedback`),
  KEY `FK_feedback_departamento` (`id_departamento`),
  KEY `FK_feedback_pessoa` (`id_pessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `id_pessoa`, `id_departamento`, `titulo_feedback`, `descricao_feedback`, `avaliacao`, `visualizacao`) VALUES
(1, 1, 0, 'titulo', 'descricao', 2, 3),
(2, 1, 1, 'teste', 'teste', 0, NULL),
(3, 1, 1, 'teste 2', 'teste de descrição', 0, NULL),
(4, 1, 1, 'teste 5 estrela', 'estrela 5', 5, NULL),
(5, 1, 1, 'teste 3', 'teste 3', 0, NULL),
(6, 1, 1, 'teste 4', 'teste 4', 0, NULL),
(7, 1, 1, 'teste 2', 'teste 2', 2, NULL),
(8, 1, 1, 'teste 3', 'teste 3', 3, NULL),
(9, 1, 1, '1 estrela', 'descrição 1 estrela', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_perguntas`
--

DROP TABLE IF EXISTS `forum_perguntas`;
CREATE TABLE IF NOT EXISTS `forum_perguntas` (
  `id_forum_perguntas` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_departamento` int NOT NULL,
  `titulo_pergunta` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_pergunta` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `visualizacao` int DEFAULT NULL,
  `qtd_resposta` int NOT NULL,
  `data_pergunta` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_topico` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_forum_perguntas`),
  KEY `FK_forum_perguntas_departamento` (`id_departamento`),
  KEY `FK_forum_perguntas_pessoa` (`id_pessoa`),
  KEY `FK_forum_perguntas_forum_topicos` (`id_topico`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `forum_perguntas`
--

INSERT INTO `forum_perguntas` (`id_forum_perguntas`, `id_pessoa`, `id_departamento`, `titulo_pergunta`, `descricao_pergunta`, `visualizacao`, `qtd_resposta`, `data_pergunta`, `id_topico`, `status`) VALUES
(1, 1, 1, 'porco', 'palmeiras não tem mundial', NULL, 0, '2024-04-25 21:48:55', NULL, 1),
(2, 1, 1, 'teste 2', 'descrição de teste 2', NULL, 0, '2024-04-25 21:49:19', NULL, 1),
(3, 1, 1, 'teste 1', 'descrição teste 1', NULL, 0, '2024-06-27 18:44:23', NULL, 1),
(4, 1, 1, 'Título 970', 'Descrição da pergunta 701', 559, 78, '2024-06-09 17:21:21', 12, 1),
(5, 1, 8, 'Título 413', 'Descrição da pergunta 445', 74, 59, '2024-05-10 05:23:40', 26, 1),
(6, 1, 5, 'Título 646', 'Descrição da pergunta 494', 511, 3, '2023-12-11 09:30:30', 47, 1),
(7, 1, 7, 'Título 509', 'Descrição da pergunta 855', 860, 67, '2024-01-25 22:54:44', 32, 1),
(8, 1, 8, 'Título 62', 'Descrição da pergunta 734', 264, 64, '2024-03-19 23:56:07', 45, 1),
(9, 1, 8, 'Título 986', 'Descrição da pergunta 347', 811, 27, '2024-02-03 07:10:08', 11, 1),
(10, 1, 3, 'Título 748', 'Descrição da pergunta 381', 522, 72, '2023-09-02 22:19:40', 28, 1),
(11, 1, 4, 'Título 22', 'Descrição da pergunta 442', 826, 100, '2023-09-09 22:49:27', 16, 1),
(12, 1, 8, 'Título 974', 'Descrição da pergunta 929', 698, 94, '2024-04-30 04:58:20', 45, 1),
(13, 1, 8, 'Título 807', 'Descrição da pergunta 106', 150, 96, '2023-08-12 05:45:45', 6, 1),
(14, 1, 1, 'Título 406', 'Descrição da pergunta 542', 319, 51, '2023-09-18 16:09:00', 30, 1),
(15, 1, 9, 'Título 997', 'Descrição da pergunta 709', 846, 41, '2024-04-23 23:21:13', 38, 1),
(16, 1, 6, 'Título 201', 'Descrição da pergunta 545', 493, 78, '2023-11-05 20:23:11', 34, 1),
(17, 1, 7, 'Título 179', 'Descrição da pergunta 192', 20, 64, '2023-10-18 00:07:09', 50, 1),
(18, 1, 4, 'Título 587', 'Descrição da pergunta 659', 705, 44, '2023-08-23 01:45:06', 40, 1),
(19, 1, 4, 'Título 791', 'Descrição da pergunta 120', 424, 67, '2024-06-04 13:16:14', 23, 1),
(20, 1, 4, 'Título 958', 'Descrição da pergunta 566', 994, 65, '2024-04-20 02:48:41', 41, 1),
(21, 1, 6, 'Título 809', 'Descrição da pergunta 821', 304, 86, '2024-01-29 15:57:27', 2, 1),
(22, 1, 1, 'Título 452', 'Descrição da pergunta 408', 798, 12, '2023-10-07 05:45:09', 29, 1),
(23, 1, 4, 'Título 306', 'Descrição da pergunta 31', 760, 72, '2024-05-28 16:46:28', 40, 1),
(24, 1, 9, 'Título 792', 'Descrição da pergunta 273', 628, 40, '2023-11-21 17:17:11', 25, 1),
(25, 1, 9, 'Título 62', 'Descrição da pergunta 1000', 701, 40, '2023-12-15 05:49:12', 2, 1),
(26, 1, 3, 'Título 959', 'Descrição da pergunta 68', 960, 58, '2024-04-03 04:17:25', 20, 1),
(27, 1, 5, 'Título 429', 'Descrição da pergunta 7', 617, 4, '2023-08-31 09:20:30', 42, 1),
(28, 1, 4, 'Título 944', 'Descrição da pergunta 83', 578, 17, '2023-10-24 06:09:26', 6, 1),
(29, 1, 5, 'Título 34', 'Descrição da pergunta 603', 799, 54, '2024-03-05 12:03:01', 21, 1),
(30, 1, 4, 'Título 843', 'Descrição da pergunta 135', 632, 87, '2023-11-27 11:24:54', 38, 1),
(31, 1, 1, 'Título 620', 'Descrição da pergunta 419', 219, 38, '2023-12-17 00:14:09', 45, 1),
(32, 1, 9, 'Título 702', 'Descrição da pergunta 248', 768, 56, '2023-07-13 15:48:18', 10, 1),
(33, 1, 9, 'Título 59', 'Descrição da pergunta 710', 9, 19, '2024-02-01 23:16:58', 29, 1),
(34, 1, 5, 'Título 127', 'Descrição da pergunta 992', 497, 7, '2023-07-07 16:33:18', 45, 1),
(35, 1, 4, 'Título 173', 'Descrição da pergunta 963', 451, 32, '2023-10-18 10:24:50', 9, 1),
(36, 1, 3, 'Título 157', 'Descrição da pergunta 274', 188, 27, '2024-03-02 18:13:43', 17, 1),
(37, 1, 2, 'Título 273', 'Descrição da pergunta 534', 777, 2, '2024-02-06 00:30:12', 42, 1),
(38, 1, 4, 'Título 422', 'Descrição da pergunta 755', 127, 10, '2024-03-26 04:21:43', 29, 1),
(39, 1, 5, 'Título 979', 'Descrição da pergunta 46', 358, 24, '2024-01-15 01:01:40', 23, 1),
(40, 1, 9, 'Título 924', 'Descrição da pergunta 645', 76, 51, '2023-08-20 08:31:08', 20, 1),
(41, 1, 9, 'Título 896', 'Descrição da pergunta 373', 927, 64, '2024-03-02 17:10:56', 12, 1),
(42, 1, 4, 'Título 336', 'Descrição da pergunta 787', 292, 43, '2023-09-23 17:44:13', 42, 1),
(43, 1, 10, 'Título 574', 'Descrição da pergunta 784', 669, 4, '2024-03-21 09:23:31', 23, 1),
(44, 1, 1, 'Título 128', 'Descrição da pergunta 546', 663, 12, '2023-08-22 08:28:44', 31, 1),
(45, 1, 8, 'Título 4', 'Descrição da pergunta 580', 355, 34, '2023-10-20 00:54:30', 35, 1),
(46, 1, 6, 'Título 379', 'Descrição da pergunta 346', 426, 82, '2023-07-21 03:22:25', 26, 1),
(47, 1, 8, 'Título 154', 'Descrição da pergunta 381', 939, 11, '2023-12-01 09:25:27', 21, 1),
(48, 1, 9, 'Título 307', 'Descrição da pergunta 121', 52, 96, '2023-11-22 22:10:36', 38, 1),
(49, 1, 5, 'Título 555', 'Descrição da pergunta 391', 785, 36, '2024-03-14 04:02:41', 39, 1),
(50, 1, 4, 'Título 356', 'Descrição da pergunta 897', 137, 10, '2024-01-21 11:26:00', 37, 1),
(51, 1, 4, 'Título 506', 'Descrição da pergunta 438', 56, 68, '2023-07-22 14:08:18', 22, 1),
(52, 1, 2, 'Título 862', 'Descrição da pergunta 124', 617, 93, '2023-08-06 00:59:04', 36, 1),
(53, 1, 3, 'Título 273', 'Descrição da pergunta 477', 208, 44, '2023-11-24 19:18:34', 12, 1),
(54, 1, 1, 'Título 750', 'Descrição da pergunta 145', 298, 89, '2024-04-25 15:26:23', 21, 1),
(55, 1, 6, 'Título 838', 'Descrição da pergunta 443', 848, 75, '2024-06-22 17:25:20', 50, 1),
(56, 1, 5, 'Título 453', 'Descrição da pergunta 746', 191, 47, '2024-01-17 08:54:30', 38, 1),
(57, 1, 10, 'Título 427', 'Descrição da pergunta 229', 954, 96, '2024-01-21 11:41:36', 37, 1),
(58, 1, 7, 'Título 320', 'Descrição da pergunta 997', 257, 33, '2024-01-24 12:55:45', 30, 1),
(59, 1, 8, 'Título 470', 'Descrição da pergunta 918', 0, 27, '2023-09-15 03:09:24', 47, 1),
(60, 1, 7, 'Título 587', 'Descrição da pergunta 16', 59, 95, '2023-09-30 09:50:00', 44, 1),
(61, 1, 9, 'Título 557', 'Descrição da pergunta 133', 230, 52, '2024-06-19 17:35:40', 22, 1),
(62, 1, 6, 'Título 744', 'Descrição da pergunta 301', 77, 90, '2024-03-03 21:58:30', 10, 1),
(63, 1, 5, 'Título 733', 'Descrição da pergunta 741', 476, 51, '2023-11-17 12:00:55', 3, 1),
(64, 1, 5, 'Título 919', 'Descrição da pergunta 294', 954, 7, '2024-04-09 07:48:45', 31, 1),
(65, 1, 3, 'Título 383', 'Descrição da pergunta 531', 670, 11, '2023-10-28 03:19:43', 15, 1),
(66, 1, 1, 'Título 165', 'Descrição da pergunta 666', 707, 36, '2023-10-02 10:56:56', 22, 1),
(67, 1, 6, 'Título 899', 'Descrição da pergunta 28', 897, 58, '2024-02-22 05:00:38', 15, 1),
(68, 1, 2, 'Título 982', 'Descrição da pergunta 949', 352, 39, '2023-09-29 11:05:45', 29, 1),
(69, 1, 8, 'Título 898', 'Descrição da pergunta 691', 526, 44, '2023-08-21 02:03:36', 38, 1),
(70, 1, 9, 'Título 894', 'Descrição da pergunta 245', 65, 37, '2024-06-09 12:14:58', 33, 1),
(71, 1, 10, 'Título 885', 'Descrição da pergunta 151', 957, 89, '2024-02-04 21:02:27', 28, 1),
(72, 1, 3, 'Título 387', 'Descrição da pergunta 622', 113, 76, '2023-12-24 17:54:46', 1, 1),
(73, 1, 3, 'Título 362', 'Descrição da pergunta 277', 387, 50, '2024-03-09 21:46:55', 42, 1),
(74, 1, 3, 'Título 24', 'Descrição da pergunta 728', 386, 71, '2024-06-12 05:54:19', 8, 1),
(75, 1, 9, 'Título 276', 'Descrição da pergunta 51', 370, 32, '2023-07-16 23:15:28', 45, 1),
(76, 1, 3, 'Título 583', 'Descrição da pergunta 393', 759, 36, '2024-06-07 19:31:44', 38, 1),
(77, 1, 1, 'Título 335', 'Descrição da pergunta 985', 825, 65, '2023-08-14 17:16:30', 8, 1),
(78, 1, 10, 'Título 602', 'Descrição da pergunta 498', 957, 13, '2024-02-21 03:45:44', 33, 1),
(79, 1, 3, 'Título 611', 'Descrição da pergunta 442', 556, 19, '2024-01-12 15:01:52', 20, 1),
(80, 1, 10, 'Título 628', 'Descrição da pergunta 287', 877, 81, '2024-03-23 18:25:04', 20, 1),
(81, 1, 10, 'Título 824', 'Descrição da pergunta 377', 666, 91, '2024-03-28 23:58:34', 25, 1),
(82, 1, 10, 'Título 323', 'Descrição da pergunta 328', 950, 36, '2024-02-09 06:46:26', 25, 1),
(83, 1, 3, 'Título 722', 'Descrição da pergunta 319', 518, 22, '2024-06-07 00:29:50', 30, 1),
(84, 1, 2, 'Título 187', 'Descrição da pergunta 936', 339, 0, '2024-04-06 17:27:54', 4, 1),
(85, 1, 3, 'Título 24', 'Descrição da pergunta 743', 726, 50, '2023-08-07 17:49:39', 31, 1),
(86, 1, 9, 'Título 291', 'Descrição da pergunta 265', 499, 28, '2024-01-07 22:14:02', 21, 1),
(87, 1, 10, 'Título 761', 'Descrição da pergunta 263', 455, 45, '2023-11-24 18:07:36', 10, 1),
(88, 1, 10, 'Título 328', 'Descrição da pergunta 373', 258, 96, '2024-05-14 15:24:00', 14, 1),
(89, 1, 10, 'Título 200', 'Descrição da pergunta 449', 98, 67, '2024-06-20 16:12:12', 27, 1),
(90, 1, 2, 'Título 646', 'Descrição da pergunta 227', 570, 100, '2024-05-14 02:09:41', 25, 1),
(91, 1, 4, 'Título 256', 'Descrição da pergunta 953', 851, 12, '2023-07-13 12:20:21', 34, 1),
(92, 1, 8, 'Título 119', 'Descrição da pergunta 771', 920, 11, '2024-03-22 17:58:15', 39, 1),
(93, 1, 4, 'Título 607', 'Descrição da pergunta 972', 683, 23, '2023-09-12 20:45:03', 20, 1),
(94, 1, 10, 'Título 419', 'Descrição da pergunta 946', 313, 39, '2023-09-30 22:57:55', 27, 1),
(95, 1, 4, 'Título 456', 'Descrição da pergunta 510', 32, 7, '2023-10-19 11:56:09', 19, 1),
(96, 1, 5, 'Título 190', 'Descrição da pergunta 52', 357, 94, '2024-04-03 03:30:59', 13, 1),
(97, 1, 8, 'Título 332', 'Descrição da pergunta 317', 809, 27, '2023-07-08 01:19:02', 20, 1),
(98, 1, 10, 'Título 585', 'Descrição da pergunta 319', 905, 39, '2024-05-16 02:47:44', 23, 1),
(99, 1, 10, 'Título 714', 'Descrição da pergunta 397', 413, 43, '2024-05-23 06:55:15', 45, 1),
(100, 1, 7, 'Título 744', 'Descrição da pergunta 321', 515, 3, '2024-06-27 08:00:26', 45, 1),
(101, 1, 5, 'Título 815', 'Descrição da pergunta 948', 413, 20, '2023-09-16 07:16:39', 50, 1),
(102, 1, 2, 'Título 483', 'Descrição da pergunta 789', 780, 66, '2023-07-23 00:59:35', 15, 1),
(103, 1, 3, 'Título 212', 'Descrição da pergunta 882', 276, 94, '2024-01-22 09:47:49', 13, 1),
(104, 11, 1, 'Treinamento LGPD', 'Realizar treinamento de Proteção e Privacidade de Dados com os colaboradores da UNIFESO.', NULL, 0, '2024-07-04 19:34:42', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_respostas`
--

DROP TABLE IF EXISTS `forum_respostas`;
CREATE TABLE IF NOT EXISTS `forum_respostas` (
  `id_forum_respostas` int NOT NULL AUTO_INCREMENT,
  `id_forum_perguntas` int NOT NULL,
  `id_pessoa` int NOT NULL,
  `resposta` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_respostas` datetime NOT NULL,
  PRIMARY KEY (`id_forum_respostas`),
  KEY `FK_forum_respostas_forum_perguntas` (`id_forum_perguntas`),
  KEY `FK_forum_respostas_pessoa` (`id_pessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `forum_respostas`
--

INSERT INTO `forum_respostas` (`id_forum_respostas`, `id_forum_perguntas`, `id_pessoa`, `resposta`, `data_respostas`) VALUES
(1, 104, 11, 'Ainda não treinei.', '2024-07-04 22:35:11'),
(2, 104, 11, 'rfsdfsdfsdfsd', '2024-07-04 22:35:35');

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_topicos`
--

DROP TABLE IF EXISTS `forum_topicos`;
CREATE TABLE IF NOT EXISTS `forum_topicos` (
  `id_topicos` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_topicos`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `forum_topicos`
--

INSERT INTO `forum_topicos` (`id_topicos`, `descricao`) VALUES
(1, 'Todos os tópicos'),
(2, 'Populares da semana'),
(3, 'Mais Populares'),
(4, 'Resolvidos'),
(5, 'Não resolvidos'),
(6, 'Sem respostas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo_acesso`
--

DROP TABLE IF EXISTS `grupo_acesso`;
CREATE TABLE IF NOT EXISTS `grupo_acesso` (
  `id_grupo_acesso` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_grupo_acesso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `grupo_acesso`
--

INSERT INTO `grupo_acesso` (`id_grupo_acesso`, `nome`, `status`) VALUES
(1, 'admin', 1),
(2, 'Funcionários', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_tarefa`
--

DROP TABLE IF EXISTS `item_tarefa`;
CREATE TABLE IF NOT EXISTS `item_tarefa` (
  `id_item_tarefa` int NOT NULL AUTO_INCREMENT,
  `id_tarefa` int NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `dt_begin` date DEFAULT NULL,
  `dt_end` date DEFAULT NULL,
  PRIMARY KEY (`id_item_tarefa`),
  KEY `id_tarefa` (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `item_tarefa`
--

INSERT INTO `item_tarefa` (`id_item_tarefa`, `id_tarefa`, `nome`, `status`, `dt_begin`, `dt_end`) VALUES
(40, 17, 'item tarefa 2', 0, '2024-06-04', '2024-06-04'),
(37, 16, 'Primeiro envio de arquivo', 0, '2024-05-28', '2024-05-29'),
(39, 17, 'item tarefa 1', 0, '2024-06-04', '2024-06-04'),
(38, 16, 'Clonar repositorio', 0, '2024-06-01', '2024-06-02'),
(36, 16, 'Como criar um repositorio', 0, '2024-05-27', '2024-05-27'),
(35, 15, 'Pagina de Boas vindas', 0, '2024-02-01', '2024-02-29'),
(34, 15, 'Tela de Login', 0, '2024-02-01', '2024-02-29'),
(33, 15, 'Cadastro de Usuário', 0, '2024-01-01', '2024-01-31');

--
-- Acionadores `item_tarefa`
--
DROP TRIGGER IF EXISTS `after_item_tarefa_insert`;
DELIMITER $$
CREATE TRIGGER `after_item_tarefa_insert` AFTER INSERT ON `item_tarefa` FOR EACH ROW BEGIN
    CALL update_tarefa_status(NEW.id_tarefa);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_item_tarefa_update`;
DELIMITER $$
CREATE TRIGGER `after_item_tarefa_update` AFTER UPDATE ON `item_tarefa` FOR EACH ROW BEGIN
    CALL update_tarefa_status(NEW.id_tarefa);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ordem` int NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=12435346 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `menu`
--

INSERT INTO `menu` (`id_menu`, `titulo`, `url`, `status`, `dt_created`, `dt_updated`, `ordem`, `descricao`) VALUES
(1, 'Dashboard', 'dashboard.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:51', 1, NULL),
(2, 'Tarefas', 'tarefas.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:51', 2, NULL),
(4, 'Recursos e Documentação', 'documentacao.php', 1, '2024-03-20 21:22:22', '2024-05-16 23:09:39', 4, NULL),
(5, 'Agendamento', 'agendamento.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:54', 5, NULL),
(6, 'Fórum', 'forum.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:55', 6, NULL),
(7, 'Feedback', 'feedback.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:56', 7, NULL),
(8, 'Nível Acesso', 'acesso.php', 2, '2024-04-16 02:12:27', '2024-04-16 02:19:01', 1, 'Libera acesso aos usuários e concede permissão para visualizar, editar e deletar no sistema. '),
(9, 'Textos Padrões', 'texto.php', 2, '2024-04-16 02:22:11', '2024-04-16 02:22:49', 2, 'Inclui os textos da pagina inicial e as imagens padrões do sistema.'),
(10, 'Departamento', 'departamento.php', 2, '2024-04-16 21:54:52', '2024-05-27 23:33:53', 4, 'Inclui os departamentos da empresa para uma organização mais detalhada das funcionalidades e filtros do sistema.'),
(11, 'Recursos e Documentação', 'recursos.php', 2, '2024-04-16 02:22:11', '2024-05-27 23:33:51', 3, 'Inclui os arquivos do menu Recursos e Documentação'),
(12, 'Tipo de Evento', 'tipo_evento.php', 2, '2024-05-27 23:33:27', '2024-07-10 00:59:26', 5, 'Inclui os tipos de eventos padrões do sistema.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `participante`
--

DROP TABLE IF EXISTS `participante`;
CREATE TABLE IF NOT EXISTS `participante` (
  `id_participante` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_evento` int NOT NULL,
  `status` int NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_participante`),
  KEY `FK_participante_evento` (`id_evento`),
  KEY `FK_participante_pessoa` (`id_pessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `participante`
--

INSERT INTO `participante` (`id_participante`, `id_pessoa`, `id_evento`, `status`, `dt_created`, `dt_updated`) VALUES
(1, 1, 1, 1, '2024-05-27 23:53:35', '2024-05-27 23:53:35'),
(2, 9, 2, 1, '2024-06-04 23:04:26', '2024-06-04 23:04:26'),
(3, 5, 1, 1, '2024-06-05 23:25:37', '2024-06-06 23:43:45'),
(4, 8, 1, 1, '2024-06-05 23:27:01', '2024-06-06 23:43:45'),
(5, 1, 3, 1, '2024-06-06 23:38:41', '2024-06-06 23:38:41'),
(6, 2, 3, 0, '2024-06-06 23:39:09', '2024-06-10 22:51:18'),
(7, 5, 3, 0, '2024-06-06 23:40:22', '2024-06-10 22:51:24'),
(8, 2, 1, 0, '2024-06-06 23:44:50', '2024-06-06 23:44:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `id_permissao` int NOT NULL AUTO_INCREMENT,
  `id_grupo_acesso` int NOT NULL,
  `id_menu` int NOT NULL,
  `visualizar` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `editar` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `deletar` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_permissao`),
  KEY `FK_permissao_grupo_acesso` (`id_grupo_acesso`),
  KEY `FK_permissao_menu` (`id_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_pessoa` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_campus` int NOT NULL,
  `id_departamento` int NOT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_pessoa`),
  KEY `fk_pessoa_campus` (`id_campus`),
  KEY `FK_pessoa_departamento` (`id_departamento`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `matricula`, `nome`, `status`, `email`, `token`, `senha`, `dt_created`, `dt_updated`, `id_campus`, `id_departamento`, `telefone`) VALUES
(2, '2345', 'João da Silva', 1, 'joaosilva@unifeso.edu.br', '961e50d73bfdd3edbbd46188ecbde30a3936d83d9d4a35899fa16ac8b4ffbc35', '$2y$10$r1Nt0YGZ.HsZuNnA57RO5uNgv2W.1ZN8LX2pMkFRkQfPWWJA0hA5G', '2024-03-20 19:13:42', '2024-03-20 19:13:42', 6, 0, NULL),
(4, '062168', 'Hugo', 0, 'hugo@gmail.com', '4c86cf5d0745caa4e1661559b7b8271043fb22021c8853b0c073e108ef586f57', '$2y$10$kcVjh1YHGU4FTxn4jlim7um6o4o0ACiZrZg5DmyoXqd7Djn5oXli2', '2024-04-05 01:34:56', '2024-04-16 21:44:02', 3, 0, NULL),
(3, '06004672', 'Gabriel Guedes', 1, 'gabrielguedes00@hotmail.com', 'c8b082d35ba2a8b2765828cccaa2496d8a6a095d7410f8b3544461ca606bcdc0', '$2y$10$HU0..v1MrAzAxCEKnivJpOVtcvwGeM4fBnHPSVF9gnx1bP7rJP9ES', '2024-03-21 01:04:07', '2024-03-21 01:04:07', 3, 0, NULL),
(1, '073842', 'Lucas', 1, 'lucasduarte@feso.edu.br', '3b42bf0d3d3aa83495d431704bf36ab49688dbd23f978e1e91008924418f1d52', '$2y$10$CzlnkuUeeuxUI10RSOSOpOlcstrI60Y0aj484O5gpKZqOP6gq6MC2', '2024-03-20 18:04:57', '2024-04-17 01:07:19', 5, 0, NULL),
(5, '111222', 'Ronald', 1, 'ronaldmc@gmail.com', 'd8094448cd1aa6b88815a7c2a064c4b772b2d2da04d21295a13916dfd32feb4c', '$2y$10$9b6EF6YTat3Bc4k0l/hoSOx5NNXecpyc84vq/ka.zsSz7pWryOZMy', '2024-04-16 20:52:46', '2024-04-16 20:52:46', 6, 0, NULL),
(8, '1234', 'Mauricio', 1, 'maumau@unifeso.edu.br', 'a960e61280734fb017f6d97d48b8a6c4913e146035279e4b564a640116f78e99', '$2y$10$TWrd2mjNgq2/HsRs84DOm.qSV6URu9fFTYCZfFgtgPsCe4k1sUePe', '2024-04-26 00:08:37', '2024-04-26 00:08:37', 5, 0, NULL),
(9, '4444', 'Maria Santos', 1, 'mariasantos@gmail.com', '1196835d78973f0abc4c15f225579ddd601ac0cbfaa5fc58ac22f493c08d95de', '$2y$10$Ioq69b8b1hpqUTYTrPOOcuwUNDK2F24WUa9U55albBR7FBjPyJU5W', '2024-06-04 22:51:47', '2024-06-04 22:51:47', 5, 0, NULL),
(10, '082772', 'Professor', 1, 'professor@unifeso', '2da49bb8b5c51dff2536fd16b98fe8dfa45ca7037ef4aec86274a3000af6155b', '$2y$10$0LlBamJXgTnRl0NegXubbeJA56.1smUZ8L1FoD3MyX48hMB2UxAj6', '2024-06-06 23:39:52', '2024-06-06 23:39:52', 5, 0, NULL),
(11, '082775', 'Antonio', 1, 'antoniopedrosa@unifeso.edu.br', '3cead3dac058eac372db5679862e1de546d4ede8add510b916dd752fc0f8dfac', '$2y$10$312EH/qHqik2Q3vdOl5Fxub7UTRHNjJpINAAbuPHWI4rdht4AXV9m', '2024-07-04 22:22:00', '2024-07-04 22:24:38', 5, 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa_acesso`
--

DROP TABLE IF EXISTS `pessoa_acesso`;
CREATE TABLE IF NOT EXISTS `pessoa_acesso` (
  `id_pessoa_acesso` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_grupo_acesso` int NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_pessoa_acesso`),
  KEY `FK_pessoa_acesso_pessoa` (`id_pessoa`),
  KEY `FK_pessoa_acesso_grupo_acesso` (`id_grupo_acesso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pessoa_acesso`
--

INSERT INTO `pessoa_acesso` (`id_pessoa_acesso`, `id_pessoa`, `id_grupo_acesso`, `status`) VALUES
(1, 4, 1, 1),
(2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa_tarefa`
--

DROP TABLE IF EXISTS `pessoa_tarefa`;
CREATE TABLE IF NOT EXISTS `pessoa_tarefa` (
  `id_pessoa_tarefa` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_tarefa` int NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pessoa_tarefa`),
  KEY `FK_pessoa_tarefa_pessoa` (`id_pessoa`),
  KEY `id_tarefa` (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pessoa_tarefa`
--

INSERT INTO `pessoa_tarefa` (`id_pessoa_tarefa`, `id_pessoa`, `id_tarefa`, `status`, `dt_created`, `dt_updated`) VALUES
(8, 9, 17, 1, '2024-06-04 22:52:23', '2024-06-04 22:52:23'),
(7, 1, 16, 1, '2024-05-27 22:57:56', '2024-05-27 22:57:56'),
(6, 1, 15, 1, '2024-05-23 00:19:39', '2024-05-23 00:19:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefa`
--

DROP TABLE IF EXISTS `tarefa`;
CREATE TABLE IF NOT EXISTS `tarefa` (
  `id_tarefa` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `dt_begin` date DEFAULT NULL,
  `dt_end` date DEFAULT NULL,
  PRIMARY KEY (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tarefa`
--

INSERT INTO `tarefa` (`id_tarefa`, `nome`, `dt_created`, `dt_updated`, `status`, `dt_begin`, `dt_end`) VALUES
(17, 'teste 2', '2024-06-04 22:52:23', '2024-06-04 22:53:43', 0, '2024-06-04', '2024-06-04'),
(16, 'Curso GitHub', '2024-05-27 22:57:56', '2024-05-27 22:59:03', 0, '2024-05-27', '2024-07-31'),
(15, 'Criar Sistema para Funcionários', '2024-05-23 00:19:39', '2024-05-23 00:20:10', 0, '2024-01-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_arquivo`
--

DROP TABLE IF EXISTS `tipo_arquivo`;
CREATE TABLE IF NOT EXISTS `tipo_arquivo` (
  `id_tipo_arquivo` int NOT NULL,
  `descricao` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formato` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tipo_arquivo`
--

INSERT INTO `tipo_arquivo` (`id_tipo_arquivo`, `descricao`, `formato`) VALUES
(1, 'Vídeo', 'mp4'),
(2, 'Documentos', 'pdf'),
(3, 'Áudio', 'mp3'),
(3, 'Planilha', 'xls');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_evento`
--

DROP TABLE IF EXISTS `tipo_evento`;
CREATE TABLE IF NOT EXISTS `tipo_evento` (
  `id_tipo_evento` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_tipo_evento`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tipo_evento`
--

INSERT INTO `tipo_evento` (`id_tipo_evento`, `nome`, `status`) VALUES
(1, 'Reunião', 1),
(2, 'Treinamento', 1),
(3, 'Palestra', 1),
(4, 'Confraternização', 1),
(5, 'Desligamento Coletivo', NULL),
(7, 'Desligamento Coletivo', 1),
(6, 'teste 2', NULL),
(8, 'teste', NULL),
(9, 'teste3333', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
