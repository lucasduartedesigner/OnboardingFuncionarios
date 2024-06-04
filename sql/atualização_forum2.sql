-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08/05/2024 às 00:20
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

--
-- Despejando dados para a tabela `forum_perguntas`
--

INSERT INTO `forum_perguntas` (`id_forum_perguntas`, `id_pessoa`, `id_departamento`, `titulo_pergunta`, `descricao_pergunta`, `visualizacao`, `qtd_resposta`, `data_pergunta`, `id_topico`) VALUES
(1, 8, 1, 'titulo', 'desc', NULL, 0, '0000-00-00 00:00:00', NULL),
(2, 8, 1, 'teste 2', 'desc 2', NULL, 0, '0000-00-00 00:00:00', NULL),
(3, 8, 1, 'teste 3', 'desc', NULL, 0, '0000-00-00 00:00:00', NULL),
(4, 8, 1, 'teste 6', 'teste', NULL, 0, '0000-00-00 00:00:00', NULL);

--
-- Despejando dados para a tabela `forum_respostas`
--

INSERT INTO `forum_respostas` (`id_forum_respostas`, `id_forum_perguntas`, `id_pessoa`, `resposta`, `data_respostas`) VALUES
(1, 1, 3, 'teste de resposta', '2024-05-07 23:55:12'),
(2, 1, 1, 'teste de resposta 2', '2024-05-07 23:55:12'),
(234, 1, 8, 'hugo responde...', '2024-05-07 23:57:01');

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `matricula`, `nome`, `status`, `email`, `token`, `senha`, `dt_created`, `dt_updated`, `id_campus`, `id_departamento`, `telefone`) VALUES
(2, '2345', 'João da Silva', 1, 'joaosilva@unifeso.edu.br', '961e50d73bfdd3edbbd46188ecbde30a3936d83d9d4a35899fa16ac8b4ffbc35', '$2y$10$r1Nt0YGZ.HsZuNnA57RO5uNgv2W.1ZN8LX2pMkFRkQfPWWJA0hA5G', '2024-03-20 19:13:42', '2024-03-20 19:13:42', 6, 0, NULL),
(7, '12345687', 'teste ', 1, 'teste@unifeso.edu.br', 'e2b4f2dd9dc34052cc01787335dc9357ceea8e655a8a963b379c19e7f4afd5c2', '$2y$10$6jb5oBZ94dH5HXi8Z2jdmez/4Ta0mAdiTRFAdNPGFDD866DLM/bH.', '2024-04-25 23:56:13', '2024-04-25 23:56:13', 5, 0, NULL),
(1, '073842', 'Lucas Duarte', 1, 'lucasduarte@unifeso.edu.br', '3b42bf0d3d3aa83495d431704bf36ab49688dbd23f978e1e91008924418f1d52', '$2y$10$CzlnkuUeeuxUI10RSOSOpOlcstrI60Y0aj484O5gpKZqOP6gq6MC2', '2024-03-20 18:04:57', '2024-03-28 01:52:55', 5, 0, NULL),
(3, '06004672', 'Gabriel Guedes', 1, 'gabrielguedes00@hotmail.com', 'c8b082d35ba2a8b2765828cccaa2496d8a6a095d7410f8b3544461ca606bcdc0', '$2y$10$HU0..v1MrAzAxCEKnivJpOVtcvwGeM4fBnHPSVF9gnx1bP7rJP9ES', '2024-03-21 01:04:07', '2024-03-21 01:04:07', 3, 0, NULL),
(8, '062168', 'Hugo', 1, 'hugo@gmail.com', 'e149ed9424c80d7f8883bae141f354d2818fc947ba43440ff4ab6a3b815555cc', '$2y$10$M9EBc.SlZrBmoobqfW65fOeI7eT0sHcpU.QRA2wC2C57oFsWv7DCm', '2024-05-07 22:31:12', '2024-05-07 22:31:12', 5, 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
