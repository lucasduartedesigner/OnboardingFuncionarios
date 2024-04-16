-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16/04/2024 às 13:38
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

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `campus`
--

DROP TABLE IF EXISTS `campus`;
CREATE TABLE IF NOT EXISTS `campus` (
  `id_campus` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `campus`
--

INSERT INTO `campus` (`id_campus`, `nome`, `titulo`, `texto`, `url`, `imagem`, `status`, `dt_created`, `dt_updated`, `missao`, `visao`, `valores`) VALUES
(1, 'AMBULATÓRIO', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
(2, 'CESO', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
(3, 'HCTCO', NULL, '<p class=\"lead\">A partir de agora você faz parte do campus HCTCO.</p>\r\n<p class=\"lead\">Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional. </p>    \r\nNela você vai encontrar informações financeiras, benefícios, normas de trabalho e responsabilidades e os principais canais de comunicação. Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional.</p>\r\n<p class=\"lead\">Leia com atenção e conheça seus direitos e deveres.</p>\r\n<p class=\"lead\">Estará sempre disponível sempre que precisar.</p>', NULL, 'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/5ddd03d359886c38624ce835c9ad58f5.jpg', 1, '2024-03-20 16:05:58', '2024-03-20 19:05:24', NULL, NULL, NULL),
(4, 'PROARTE', NULL, NULL, NULL, NULL, 1, '2024-03-20 16:05:58', '2024-03-20 16:05:58', NULL, NULL, NULL),
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
  `status` int NOT NULL,
  PRIMARY KEY (`id_campus_tarefa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo_acesso`
--

DROP TABLE IF EXISTS `grupo_acesso`;
CREATE TABLE IF NOT EXISTS `grupo_acesso` (
  `id_grupo_acesso` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id_grupo_acesso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `nome` varchar(255) NOT NULL,
  `status` int NOT NULL,
  `dt_begin` date NOT NULL,
  `dt_end` date NOT NULL,
  PRIMARY KEY (`id_item_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `item_tarefa`
--

INSERT INTO `item_tarefa` (`id_item_tarefa`, `id_tarefa`, `nome`, `status`, `dt_begin`, `dt_end`) VALUES
(11, 1, 'terceiro item tarefa', 1, '0000-00-00', '0000-00-00'),
(10, 1, 'segundo item da tarefa', 1, '0000-00-00', '0000-00-00'),
(9, 1, 'primeira item da tarefa', 1, '0000-00-00', '0000-00-00'),
(12, 1, 'quarto item tarefa', 1, '0000-00-00', '0000-00-00'),
(13, 1, 'quinta tarefa', 1, '0000-00-00', '0000-00-00'),
(14, 1, 'sexta tarefa', 1, '0000-00-00', '0000-00-00'),
(17, 5, 'item 1', 1, '0000-00-00', '0000-00-00'),
(15, 1, 'setima tarefa', 1, '0000-00-00', '0000-00-00'),
(16, 1, 'oitava tarefa', 0, '0000-00-00', '0000-00-00'),
(18, 5, 'item 2', 0, '0000-00-00', '0000-00-00');

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
  `titulo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ordem` int NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `menu`
--

INSERT INTO `menu` (`id_menu`, `titulo`, `url`, `status`, `dt_created`, `dt_updated`, `ordem`, `descricao`) VALUES
(1, 'Dashboard', 'dashboard.php', 1, '2024-03-20 18:22:22', '2024-04-15 23:10:51', 1, NULL),
(2, 'Tarefas', 'tarefas.php', 1, '2024-03-20 18:22:22', '2024-04-15 23:10:51', 2, NULL),
(3, 'Recursos', 'recursos.php', 1, '2024-03-20 18:22:22', '2024-04-15 23:10:52', 3, NULL),
(4, 'Documentação', 'documentacao.php', 1, '2024-03-20 18:22:22', '2024-04-15 23:10:53', 4, NULL),
(5, 'Agendamento', 'agendamento.php', 1, '2024-03-20 18:22:22', '2024-04-15 23:10:54', 5, NULL),
(6, 'Fórum', 'forum.php', 1, '2024-03-20 18:22:22', '2024-04-15 23:10:55', 6, NULL),
(7, 'Feedback', 'feedback.php', 1, '2024-03-20 18:22:22', '2024-04-15 23:10:56', 7, NULL),
(8, 'Nível Acesso', 'acesso.php', 2, '2024-04-15 23:12:27', '2024-04-15 23:19:01', 1, 'Libera acesso aos usuários e concede permissão para visualizar, editar e deletar no sistema. '),
(9, 'Textos Padrões', 'texto.php', 2, '2024-04-15 23:22:11', '2024-04-15 23:22:49', 2, 'Inclui os textos da pagina inicial e as imagens padrões do sistema.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `id_permissao` int NOT NULL AUTO_INCREMENT,
  `id_grupo_acesso` int NOT NULL,
  `id_menu` int NOT NULL,
  `visualizar` char(1) NOT NULL DEFAULT 'N',
  `editar` char(1) NOT NULL DEFAULT 'N',
  `deletar` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_permissao`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `permissao`
--

INSERT INTO `permissao` (`id_permissao`, `id_grupo_acesso`, `id_menu`, `visualizar`, `editar`, `deletar`) VALUES
(1, 1, 1, 'S', 'S', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
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
  PRIMARY KEY (`id_pessoa`),
  KEY `fk_pessoa_campus` (`id_campus`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `matricula`, `nome`, `status`, `email`, `token`, `senha`, `dt_created`, `dt_updated`, `id_campus`) VALUES
(1, '073842', 'Lucas', 1, 'lucasduarte@feso.edu.br', '3b42bf0d3d3aa83495d431704bf36ab49688dbd23f978e1e91008924418f1d52', '$2y$10$CzlnkuUeeuxUI10RSOSOpOlcstrI60Y0aj484O5gpKZqOP6gq6MC2', '2024-03-20 15:04:57', '2024-04-12 00:09:25', 1),
(2, '2345', 'João da Silva', 1, 'joaosilva@unifeso.edu.br', '961e50d73bfdd3edbbd46188ecbde30a3936d83d9d4a35899fa16ac8b4ffbc35', '$2y$10$r1Nt0YGZ.HsZuNnA57RO5uNgv2W.1ZN8LX2pMkFRkQfPWWJA0hA5G', '2024-03-20 16:13:42', '2024-03-20 16:13:42', 6),
(3, '06004672', 'Gabriel Guedes', 1, 'gabrielguedes00@hotmail.com', 'c8b082d35ba2a8b2765828cccaa2496d8a6a095d7410f8b3544461ca606bcdc0', '$2y$10$HU0..v1MrAzAxCEKnivJpOVtcvwGeM4fBnHPSVF9gnx1bP7rJP9ES', '2024-03-20 22:04:07', '2024-03-20 22:04:07', 3),
(4, '062168', 'Hugo', 1, 'hugo@gmail.com', '4c86cf5d0745caa4e1661559b7b8271043fb22021c8853b0c073e108ef586f57', '$2y$10$kcVjh1YHGU4FTxn4jlim7um6o4o0ACiZrZg5DmyoXqd7Djn5oXli2', '2024-04-04 22:34:56', '2024-04-05 00:14:41', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa_acesso`
--

DROP TABLE IF EXISTS `pessoa_acesso`;
CREATE TABLE IF NOT EXISTS `pessoa_acesso` (
  `id_pessoa_acesso` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_grupo_acesso` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id_pessoa_acesso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `status` int NOT NULL,
  `dt_created` date NOT NULL,
  `dt_updated` date NOT NULL,
  PRIMARY KEY (`id_pessoa_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pessoa_tarefa`
--

INSERT INTO `pessoa_tarefa` (`id_pessoa_tarefa`, `id_pessoa`, `id_tarefa`, `status`, `dt_created`, `dt_updated`) VALUES
(1, 1, 1, 1, '2024-03-28', '0000-00-00'),
(2, 1, 1, 1, '2024-03-28', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefa`
--

DROP TABLE IF EXISTS `tarefa`;
CREATE TABLE IF NOT EXISTS `tarefa` (
  `id_tarefa` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `dt_created` date NOT NULL,
  `dt_updated` date NOT NULL,
  `status` int NOT NULL,
  `dt_begin` date NOT NULL,
  `dt_end` date NOT NULL,
  PRIMARY KEY (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tarefa`
--

INSERT INTO `tarefa` (`id_tarefa`, `nome`, `dt_created`, `dt_updated`, `status`, `dt_begin`, `dt_end`) VALUES
(1, 'Tarefa de teste', '2024-03-28', '0000-00-00', 0, '2024-03-28', '2024-04-30'),
(2, 'Tarefa de teste', '2024-03-28', '0000-00-00', 0, '2024-03-28', '2024-04-30'),
(3, 'teste 3', '0000-00-00', '0000-00-00', 0, '2024-01-01', '2024-03-03'),
(4, 'teste 4', '0000-00-00', '0000-00-00', 0, '2024-04-05', '2024-04-25'),
(5, 'tarefa professor', '0000-00-00', '0000-00-00', 0, '2024-04-11', '2024-04-25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
