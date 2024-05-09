-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09/05/2024 às 23:20
-- Versão do servidor: 11.3.2-MariaDB
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `caminho_arquivo` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `data` date NOT NULL,
  `tipo_arquivo` varchar(4) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `documentos`
--

INSERT INTO `documentos` (`id_documento`, `nome`, `caminho_arquivo`, `status`, `data`, `tipo_arquivo`, `imagem`, `titulo`) VALUES
(1, 'Acesse aqui, o seu manual do colaborador!', 'https://drive.google.com/file/d/1tN-lOzAe4J4xcFeBMFROB23FuSvVE7Lh/view?usp=drive_link', 1, '2024-05-09', 'pdf', 'https://www.unifeso.edu.br/cursos/images/cursos/head/632739744f3d488a5a7b4910caf4f306.png', 'Manual do Colaborador'),
(2, 'Ja registrou sua batidade de ponto hoje?', 'https://drive.google.com/file/d/1F_yulL4QwmZZ9kwrWDaLWNzH4urf-kiz/view', 1, '2024-05-09', 'mp4', 'https://www.totvs.com/wp-content/uploads/2022/10/ponto-eletronico-digital.jpg', 'Vídeo ponto eletrônico'),
(3, 'Conheça um pouco mais sobre nós!', 'https://www.youtube.com/watch?v=iWYpGV6cJp0', 1, '2024-05-09', 'mp4', 'https://unifeso.edu.br/9acda72fb88e5262b67849045ea604c3/?largura=500&url=../images/noticias/824191be56e48c740500188bd68cf2e7.jpg', 'Vídeo Ambientação');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
