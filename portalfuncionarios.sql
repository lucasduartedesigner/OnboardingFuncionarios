-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23/05/2024 às 00:22
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
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id_documentos`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `documentos`
--

INSERT INTO `documentos` (`id_documentos`, `nome`, `caminho_arquivo`, `status`, `data`, `tipo_arquivo`, `imagem`, `titulo`) VALUES
(1, 'Acesse aqui, o seu manual do colaborador!', 'https://drive.google.com/file/d/1tN-lOzAe4J4xcFeBMFROB23FuSvVE7Lh/view?usp=drive_link', 1, '2024-05-09', 'pdf', 'https://www.unifeso.edu.br/cursos/images/cursos/head/632739744f3d488a5a7b4910caf4f306.png', 'Manual do Colaborador'),
(2, 'Ja registrou sua batidade de ponto hoje?', 'https://drive.google.com/file/d/1F_yulL4QwmZZ9kwrWDaLWNzH4urf-kiz/view', 1, '2024-05-09', 'mp4', 'https://www.totvs.com/wp-content/uploads/2022/10/ponto-eletronico-digital.jpg', 'Vídeo ponto eletrônico'),
(3, 'Conheça um pouco mais sobre nós!', 'https://www.youtube.com/watch?v=iWYpGV6cJp0', 1, '2024-05-09', 'mp4', 'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/824191be56e48c740500188bd68cf2e7.jpg', 'Vídeo Ambientação'),
(4, 'Floresta e Arbustos', 'https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf', NULL, '0000-00-00', 'pdf', 'https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg', 'Arvores'),
(5, 'teste 2', 'https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf', NULL, '0000-00-00', 'pdf', 'https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg', 'teste'),
(6, 'teste 2', 'https://www.caceres.mt.gov.br/fotos_institucional_downloads/2.pdf', 1, '0000-00-00', 'pdf', 'https://conceito.de/wp-content/uploads/2022/05/trees-3822149_1280.jpg', 'teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `id_tipo_evento` int NOT NULL,
  `id_responsavel` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `dt_inicio` datetime NOT NULL,
  `dt_fim` datetime NOT NULL,
  `status` int NOT NULL,
  `link` varchar(255) NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_evento`),
  KEY `FK_evento_tipo_evento` (`id_tipo_evento`),
  KEY `id_responsavel` (`id_responsavel`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `evento`
--

INSERT INTO `evento` (`id_evento`, `id_tipo_evento`, `id_responsavel`, `titulo`, `descricao`, `dt_inicio`, `dt_fim`, `status`, `link`, `dt_created`, `dt_updated`) VALUES
(1, 1, 2, 'TESTE', 'DESCRIÇÃO TESTE', '2024-05-16 00:00:00', '2024-05-16 00:00:00', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_perguntas`
--

DROP TABLE IF EXISTS `forum_perguntas`;
CREATE TABLE IF NOT EXISTS `forum_perguntas` (
  `id_forum_perguntas` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_departamento` int NOT NULL,
  `titulo_pergunta` varchar(50) NOT NULL,
  `descricao_pergunta` text NOT NULL,
  `visualizacao` int DEFAULT NULL,
  `qtd_resposta` int NOT NULL,
  `data_pergunta` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_topico` int DEFAULT NULL,
  PRIMARY KEY (`id_forum_perguntas`),
  KEY `FK_forum_perguntas_departamento` (`id_departamento`),
  KEY `FK_forum_perguntas_pessoa` (`id_pessoa`),
  KEY `FK_forum_perguntas_forum_topicos` (`id_topico`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `forum_perguntas`
--

INSERT INTO `forum_perguntas` (`id_forum_perguntas`, `id_pessoa`, `id_departamento`, `titulo_pergunta`, `descricao_pergunta`, `visualizacao`, `qtd_resposta`, `data_pergunta`, `id_topico`) VALUES
(1, 1, 1, 'teste 1', 'descrição do teste 1', NULL, 0, '2024-04-25 21:48:55', NULL),
(2, 1, 1, 'teste 2', 'descrição de teste 2', NULL, 0, '2024-04-25 21:49:19', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_respostas`
--

DROP TABLE IF EXISTS `forum_respostas`;
CREATE TABLE IF NOT EXISTS `forum_respostas` (
  `id_forum_respostas` int NOT NULL AUTO_INCREMENT,
  `id_forum_perguntas` int NOT NULL,
  `id_pessoa` int NOT NULL,
  `resposta` text NOT NULL,
  `data_respostas` datetime NOT NULL,
  PRIMARY KEY (`id_forum_respostas`),
  KEY `FK_forum_respostas_forum_perguntas` (`id_forum_perguntas`),
  KEY `FK_forum_respostas_pessoa` (`id_pessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_topicos`
--

DROP TABLE IF EXISTS `forum_topicos`;
CREATE TABLE IF NOT EXISTS `forum_topicos` (
  `id_topicos` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`id_topicos`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `nome` varchar(50) NOT NULL,
  `status` int DEFAULT NULL,
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
  `status` int DEFAULT NULL,
  `dt_begin` date DEFAULT NULL,
  `dt_end` date DEFAULT NULL,
  PRIMARY KEY (`id_item_tarefa`),
  KEY `id_tarefa` (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `item_tarefa`
--

INSERT INTO `item_tarefa` (`id_item_tarefa`, `id_tarefa`, `nome`, `status`, `dt_begin`, `dt_end`) VALUES
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
  `titulo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ordem` int NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(10, 'Departamento', 'departamento.php', 2, '2024-04-16 21:54:52', '2024-04-16 21:56:05', 3, 'Inclui os departamentos da empresa para uma organização mais detalhada das funcionalidades e filtros do sistema.'),
(11, 'Recursos e Documentação', 'recursos.php', 2, '2024-04-16 02:22:11', '2024-04-16 02:22:49', 2, 'Inclui os arquivos do menu Recursos e Documentação');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id_permissao`),
  KEY `FK_permissao_grupo_acesso` (`id_grupo_acesso`),
  KEY `FK_permissao_menu` (`id_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id_departamento` int NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_pessoa`),
  KEY `fk_pessoa_campus` (`id_campus`),
  KEY `FK_pessoa_departamento` (`id_departamento`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `matricula`, `nome`, `status`, `email`, `token`, `senha`, `dt_created`, `dt_updated`, `id_campus`, `id_departamento`, `telefone`) VALUES
(2, '2345', 'João da Silva', 1, 'joaosilva@unifeso.edu.br', '961e50d73bfdd3edbbd46188ecbde30a3936d83d9d4a35899fa16ac8b4ffbc35', '$2y$10$r1Nt0YGZ.HsZuNnA57RO5uNgv2W.1ZN8LX2pMkFRkQfPWWJA0hA5G', '2024-03-20 19:13:42', '2024-03-20 19:13:42', 6, 0, NULL),
(4, '062168', 'Hugo', 0, 'hugo@gmail.com', '4c86cf5d0745caa4e1661559b7b8271043fb22021c8853b0c073e108ef586f57', '$2y$10$kcVjh1YHGU4FTxn4jlim7um6o4o0ACiZrZg5DmyoXqd7Djn5oXli2', '2024-04-05 01:34:56', '2024-04-16 21:44:02', 3, 0, NULL),
(3, '06004672', 'Gabriel Guedes', 1, 'gabrielguedes00@hotmail.com', 'c8b082d35ba2a8b2765828cccaa2496d8a6a095d7410f8b3544461ca606bcdc0', '$2y$10$HU0..v1MrAzAxCEKnivJpOVtcvwGeM4fBnHPSVF9gnx1bP7rJP9ES', '2024-03-21 01:04:07', '2024-03-21 01:04:07', 3, 0, NULL),
(1, '073842', 'Lucas', 1, 'lucasduarte@feso.edu.br', '3b42bf0d3d3aa83495d431704bf36ab49688dbd23f978e1e91008924418f1d52', '$2y$10$CzlnkuUeeuxUI10RSOSOpOlcstrI60Y0aj484O5gpKZqOP6gq6MC2', '2024-03-20 18:04:57', '2024-04-17 01:07:19', 5, 0, NULL),
(5, '111222', 'Ronald', 1, 'ronaldmc@gmail.com', 'd8094448cd1aa6b88815a7c2a064c4b772b2d2da04d21295a13916dfd32feb4c', '$2y$10$9b6EF6YTat3Bc4k0l/hoSOx5NNXecpyc84vq/ka.zsSz7pWryOZMy', '2024-04-16 20:52:46', '2024-04-16 20:52:46', 6, 0, NULL),
(8, '1234', 'Mauricio', 1, 'maumau@unifeso.edu.br', 'a960e61280734fb017f6d97d48b8a6c4913e146035279e4b564a640116f78e99', '$2y$10$TWrd2mjNgq2/HsRs84DOm.qSV6URu9fFTYCZfFgtgPsCe4k1sUePe', '2024-04-26 00:08:37', '2024-04-26 00:08:37', 5, 0, NULL);

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
  `status` int DEFAULT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pessoa_tarefa`),
  KEY `FK_pessoa_tarefa_pessoa` (`id_pessoa`),
  KEY `id_tarefa` (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pessoa_tarefa`
--

INSERT INTO `pessoa_tarefa` (`id_pessoa_tarefa`, `id_pessoa`, `id_tarefa`, `status`, `dt_created`, `dt_updated`) VALUES
(6, 1, 15, 1, '2024-05-23 00:19:39', '2024-05-23 00:19:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefa`
--

DROP TABLE IF EXISTS `tarefa`;
CREATE TABLE IF NOT EXISTS `tarefa` (
  `id_tarefa` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `dt_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `dt_begin` date DEFAULT NULL,
  `dt_end` date DEFAULT NULL,
  PRIMARY KEY (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tarefa`
--

INSERT INTO `tarefa` (`id_tarefa`, `nome`, `dt_created`, `dt_updated`, `status`, `dt_begin`, `dt_end`) VALUES
(15, 'Criar Sistema para Funcionários', '2024-05-23 00:19:39', '2024-05-23 00:20:10', 0, '2024-01-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_arquivo`
--

DROP TABLE IF EXISTS `tipo_arquivo`;
CREATE TABLE IF NOT EXISTS `tipo_arquivo` (
  `id_tipo_arquivo` int NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `formato` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `nome` varchar(100) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_tipo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
