-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09/05/2024 às 01:36
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

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
  `texto` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `dt_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `missao` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visao` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valores` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_campus`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `campus`
--

INSERT INTO `campus` (`id_campus`, `nome`, `titulo`, `texto`, `url`, `imagem`, `status`, `dt_created`, `dt_updated`, `missao`, `visao`, `valores`) VALUES
(1, 'AMBULATÓRIO', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
(2, 'CESO', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
(3, 'HCTCO', NULL, '<p class=\"lead\">A partir de agora você faz parte do campus HCTCO.</p>\r\n<p class=\"lead\">Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional. </p>    \r\nNela você vai encontrar informações financeiras, benefícios, normas de trabalho e responsabilidades e os principais canais de comunicação. Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional.</p>\r\n<p class=\"lead\">Leia com atenção e conheça seus direitos e deveres.</p>\r\n<p class=\"lead\">Estará sempre disponível sempre que precisar.</p>', NULL, 'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/5ddd03d359886c38624ce835c9ad58f5.jpg', 1, '2024-03-20 16:05:58', '2024-03-20 19:05:24', NULL, NULL, NULL),
(4, 'PROARTE', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
(5, 'SEDE', NULL, '<p class=\"lead\">A partir de agora você faz parte do campus SEDE.</p>\n<p class=\"lead\">Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional. </p>    \nNela você vai encontrar informações financeiras, benefícios, normas de trabalho e responsabilidades e os principais canais de comunicação. Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional.</p>\n<p class=\"lead\">Leia com atenção e conheça seus direitos e deveres.</p>\n<p class=\"lead\">Estará sempre disponível sempre que precisar.</p>', '', 'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/b9a421dec6fb6371b171795747b274f4.jpg', 1, '2024-03-20 16:05:58', '2024-03-20 19:03:14', NULL, NULL, NULL),
(6, 'QUINTA DO PARAÍSO', NULL, '', NULL, '', 1, '2024-03-20 16:05:58', '2024-05-08 21:00:52', '', '', ''),
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
  `dt_created` datetime DEFAULT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `id_documento` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caminho_arquivo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `data` date NOT NULL,
  `tipo_arquivo` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `dt_inicio` datetime NOT NULL,
  `dt_fim` datetime NOT NULL,
  `status` int NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime NOT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `FK_evento_tipo_evento` (`id_tipo_evento`),
  KEY `id_responsavel` (`id_responsavel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `descricao_feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avaliacao` int NOT NULL,
  `visualizacao` int DEFAULT NULL,
  PRIMARY KEY (`id_feedback`),
  KEY `FK_feedback_departamento` (`id_departamento`),
  KEY `FK_feedback_pessoa` (`id_pessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `descricao_pergunta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `visualizacao` int DEFAULT NULL,
  `qtd_resposta` int NOT NULL,
  `data_pergunta` datetime NOT NULL,
  `id_topico` int DEFAULT NULL,
  PRIMARY KEY (`id_forum_perguntas`),
  KEY `FK_forum_perguntas_departamento` (`id_departamento`),
  KEY `FK_forum_perguntas_pessoa` (`id_pessoa`),
  KEY `FK_forum_perguntas_forum_topicos` (`id_topico`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `forum_perguntas`
--

INSERT INTO `forum_perguntas` (`id_forum_perguntas`, `id_pessoa`, `id_departamento`, `titulo_pergunta`, `descricao_pergunta`, `visualizacao`, `qtd_resposta`, `data_pergunta`, `id_topico`) VALUES
(6, 8, 1, 'pergunta 1', 'texto 1', NULL, 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_respostas`
--

DROP TABLE IF EXISTS `forum_respostas`;
CREATE TABLE IF NOT EXISTS `forum_respostas` (
  `id_forum_respostas` int NOT NULL AUTO_INCREMENT,
  `id_forum_perguntas` int NOT NULL,
  `id_pessoa` int NOT NULL,
  `resposta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_respostas` datetime NOT NULL,
  PRIMARY KEY (`id_forum_respostas`),
  KEY `FK_forum_respostas_forum_perguntas` (`id_forum_perguntas`),
  KEY `FK_forum_respostas_pessoa` (`id_pessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_topicos`
--

DROP TABLE IF EXISTS `forum_topicos`;
CREATE TABLE IF NOT EXISTS `forum_topicos` (
  `id_topicos` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_topicos`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `forum_topicos`
--

INSERT INTO `forum_topicos` (`id_topicos`, `descricao`) VALUES
(1, 'Populares da semana'),
(2, 'Mais Populares'),
(3, 'Resolvidos'),
(4, 'Não Resolvidos'),
(5, 'Sem resposta');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `menu`
--

INSERT INTO `menu` (`id_menu`, `titulo`, `url`, `status`, `dt_created`, `dt_updated`, `ordem`, `descricao`) VALUES
(1, 'Dashboard', 'dashboard.php', 1, '2024-03-21 00:22:22', '2024-04-16 05:10:51', 1, NULL),
(2, 'Tarefas', 'tarefas.php', 1, '2024-03-21 00:22:22', '2024-04-16 05:10:51', 2, NULL),
(4, 'Recursos e Documentação', 'documentacao.php', 1, '2024-03-21 00:22:22', '2024-05-03 03:18:55', 4, NULL),
(5, 'Agendamento', 'agendamento.php', 1, '2024-03-21 00:22:22', '2024-04-16 05:10:54', 5, NULL),
(6, 'Fórum', 'forum.php', 1, '2024-03-21 00:22:22', '2024-04-16 05:10:55', 6, NULL),
(7, 'Feedback', 'feedback.php', 1, '2024-03-21 00:22:22', '2024-04-16 05:10:56', 7, NULL),
(8, 'Nível Acesso', 'acesso.php', 2, '2024-04-16 05:12:27', '2024-04-16 05:19:01', 1, 'Libera acesso aos usuários e concede permissão para visualizar, editar e deletar no sistema. '),
(9, 'Textos Padrões', 'texto.php', 2, '2024-04-16 05:22:11', '2024-04-16 05:22:49', 2, 'Inclui os textos da pagina inicial e as imagens padrões do sistema.'),
(10, 'Departamento', 'departamento.php', 2, '2024-04-17 00:54:52', '2024-04-17 00:56:05', 3, 'Inclui os departamentos da empresa para uma organização mais detalhada das funcionalidades e filtros do sistema.');

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
  `dt_created` datetime NOT NULL,
  `dt_updated` datetime NOT NULL,
  PRIMARY KEY (`id_participante`),
  KEY `FK_participante_evento` (`id_evento`),
  KEY `FK_participante_pessoa` (`id_pessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `matricula`, `nome`, `status`, `email`, `token`, `senha`, `dt_created`, `dt_updated`, `id_campus`, `id_departamento`, `telefone`) VALUES
(2, '2345', 'João da Silva', 1, 'joaosilva@unifeso.edu.br', '961e50d73bfdd3edbbd46188ecbde30a3936d83d9d4a35899fa16ac8b4ffbc35', '$2y$10$r1Nt0YGZ.HsZuNnA57RO5uNgv2W.1ZN8LX2pMkFRkQfPWWJA0hA5G', '2024-03-20 19:13:42', '2024-03-20 19:13:42', 6, 0, NULL),
(7, '12345687', 'teste ', 1, 'teste@unifeso.edu.br', 'e2b4f2dd9dc34052cc01787335dc9357ceea8e655a8a963b379c19e7f4afd5c2', '$2y$10$6jb5oBZ94dH5HXi8Z2jdmez/4Ta0mAdiTRFAdNPGFDD866DLM/bH.', '2024-04-25 23:56:13', '2024-04-25 23:56:13', 5, 0, NULL),
(1, '073842', 'Lucas Duarte', 1, 'lucasduarte@unifeso.edu.br', '3b42bf0d3d3aa83495d431704bf36ab49688dbd23f978e1e91008924418f1d52', '$2y$10$CzlnkuUeeuxUI10RSOSOpOlcstrI60Y0aj484O5gpKZqOP6gq6MC2', '2024-03-20 18:04:57', '2024-03-28 01:52:55', 5, 0, NULL),
(3, '06004672', 'Gabriel Guedes', 1, 'gabrielguedes00@hotmail.com', 'c8b082d35ba2a8b2765828cccaa2496d8a6a095d7410f8b3544461ca606bcdc0', '$2y$10$HU0..v1MrAzAxCEKnivJpOVtcvwGeM4fBnHPSVF9gnx1bP7rJP9ES', '2024-03-21 01:04:07', '2024-03-21 01:04:07', 3, 0, NULL),
(8, '062168', 'Hugo', 1, 'hugo@gmail.com', 'dd19b1460fd11ec3e5851c199b538a58f50f143e8a243e94043cd43c10a21003', '$2y$10$o.HBKufVVAuUJXFiWYRYROCDS.BiiWJ.F7PM3VwKdxG3cVA2Rnveu', '2024-05-08 23:50:33', '2024-05-08 23:50:33', 5, 0, NULL);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `dt_created` date NOT NULL,
  `dt_updated` date NOT NULL,
  PRIMARY KEY (`id_pessoa_tarefa`),
  KEY `FK_pessoa_tarefa_pessoa` (`id_pessoa`),
  KEY `id_tarefa` (`id_tarefa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefa`
--

DROP TABLE IF EXISTS `tarefa`;
CREATE TABLE IF NOT EXISTS `tarefa` (
  `id_tarefa` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created` date NOT NULL,
  `dt_updated` date NOT NULL,
  `status` int DEFAULT NULL,
  `dt_begin` date DEFAULT NULL,
  `dt_end` date DEFAULT NULL,
  PRIMARY KEY (`id_tarefa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
