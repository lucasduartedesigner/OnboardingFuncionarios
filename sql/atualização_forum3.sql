-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17/05/2024 às 00:08
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_perguntas`
--

DROP TABLE IF EXISTS `forum_perguntas`;
CREATE TABLE IF NOT EXISTS `forum_perguntas` (
  `id_forum_perguntas` int NOT NULL AUTO_INCREMENT,
  `id_pessoa` int NOT NULL,
  `id_departamento` int NOT NULL,
  `titulo_pergunta` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_pergunta` text COLLATE utf8mb4_general_ci NOT NULL,
  `visualizacao` int NOT NULL DEFAULT '0',
  `qtd_resposta` int NOT NULL,
  `data_pergunta` datetime NOT NULL,
  `id_topicos` int DEFAULT NULL,
  PRIMARY KEY (`id_forum_perguntas`),
  KEY `FK_forum_perguntas_departamento` (`id_departamento`),
  KEY `FK_forum_perguntas_pessoa` (`id_pessoa`),
  KEY `FK_forum_perguntas_forum_topicos` (`id_topicos`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `forum_perguntas`
--

INSERT INTO `forum_perguntas` (`id_forum_perguntas`, `id_pessoa`, `id_departamento`, `titulo_pergunta`, `descricao_pergunta`, `visualizacao`, `qtd_resposta`, `data_pergunta`, `id_topicos`) VALUES
(3, 8, 1, 'teste 1', 'msg', 2, 1, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_respostas`
--

DROP TABLE IF EXISTS `forum_respostas`;
CREATE TABLE IF NOT EXISTS `forum_respostas` (
  `id_forum_respostas` int NOT NULL AUTO_INCREMENT,
  `id_forum_perguntas` int NOT NULL,
  `id_pessoa` int NOT NULL,
  `resposta` text COLLATE utf8mb4_general_ci NOT NULL,
  `data_respostas` datetime NOT NULL,
  PRIMARY KEY (`id_forum_respostas`),
  KEY `FK_forum_respostas_forum_perguntas` (`id_forum_perguntas`),
  KEY `FK_forum_respostas_pessoa` (`id_pessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `forum_respostas`
--

INSERT INTO `forum_respostas` (`id_forum_respostas`, `id_forum_perguntas`, `id_pessoa`, `resposta`, `data_respostas`) VALUES
(1, 1, 8, 'teste hugo', '2024-05-09 21:47:59'),
(7, 1, 8, 'gsfdghsfhsfghsfgh', '2024-05-10 00:08:18'),
(8, 1, 8, 'srtgjghjfhjfhjhf', '2024-05-10 00:08:46'),
(9, 1, 8, 'TESTE 4', '2024-05-10 00:41:35'),
(10, 1, 8, 'TESTE 4', '2024-05-10 00:42:35'),
(11, 1, 8, 'TESTE 6', '2024-05-10 00:42:50'),
(12, 1, 8, '35t34rtg3rtg35g5g', '2024-05-16 23:18:22'),
(13, 3, 8, 'fghdfghdfgh', '2024-05-16 23:39:43');

--
-- Acionadores `forum_respostas`
--
DROP TRIGGER IF EXISTS `atualizar_qtd_resposta`;
DELIMITER $$
CREATE TRIGGER `atualizar_qtd_resposta` AFTER INSERT ON `forum_respostas` FOR EACH ROW BEGIN
    DECLARE total_respostas INT;
    
    -- Contar o número de respostas para a pergunta específica
    SELECT COUNT(*) INTO total_respostas FROM forum_respostas WHERE id_forum_perguntas = NEW.id_forum_perguntas;
    
    -- Atualizar a coluna qtd_respostas na tabela forum_perguntas
    UPDATE forum_perguntas SET qtd_resposta = total_respostas WHERE id_forum_perguntas = NEW.id_forum_perguntas;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_topicos`
--

DROP TABLE IF EXISTS `forum_topicos`;
CREATE TABLE IF NOT EXISTS `forum_topicos` (
  `id_topicos` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_topicos`)
) ENGINE=MyISAM AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `forum_topicos`
--

INSERT INTO `forum_topicos` (`id_topicos`, `descricao`) VALUES
(1, 'Mais Populares'),
(2, 'Resolvidos'),
(3, 'Não Resolvidos'),
(4, 'Sem resposta');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
