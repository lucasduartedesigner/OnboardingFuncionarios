-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/05/2024 às 01:01
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
-- Despejando dados para a tabela `forum_topicos`
--

INSERT INTO `forum_topicos` (`id_topicos`, `descricao`) VALUES
(1, 'Populares da semana'),
(2, 'Mais Populares'),
(3, 'Resolvidos'),
(4, 'Não Resolvidos'),
(5, 'Sem resposta');

--
-- Despejando dados para a tabela `menu`
--

INSERT INTO `menu` (`id_menu`, `titulo`, `url`, `status`, `dt_created`, `dt_updated`, `ordem`, `descricao`) VALUES
(1, 'Dashboard', 'dashboard.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:51', 1, NULL),
(2, 'Tarefas', 'tarefas.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:51', 2, NULL),
(4, 'Recursos e Documentação', 'documentacao.php', 1, '2024-03-20 21:22:22', '2024-05-03 00:18:55', 4, NULL),
(5, 'Agendamento', 'agendamento.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:54', 5, NULL),
(6, 'Fórum', 'forum.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:55', 6, NULL),
(7, 'Feedback', 'feedback.php', 1, '2024-03-20 21:22:22', '2024-04-16 02:10:56', 7, NULL),
(8, 'Nível Acesso', 'acesso.php', 2, '2024-04-16 02:12:27', '2024-04-16 02:19:01', 1, 'Libera acesso aos usuários e concede permissão para visualizar, editar e deletar no sistema. '),
(9, 'Textos Padrões', 'texto.php', 2, '2024-04-16 02:22:11', '2024-04-16 02:22:49', 2, 'Inclui os textos da pagina inicial e as imagens padrões do sistema.'),
(10, 'Departamento', 'departamento.php', 2, '2024-04-16 21:54:52', '2024-04-16 21:56:05', 3, 'Inclui os departamentos da empresa para uma organização mais detalhada das funcionalidades e filtros do sistema.');

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `matricula`, `nome`, `status`, `email`, `token`, `senha`, `dt_created`, `dt_updated`, `id_campus`, `id_departamento`, `telefone`) VALUES
(2, '2345', 'João da Silva', 1, 'joaosilva@unifeso.edu.br', '961e50d73bfdd3edbbd46188ecbde30a3936d83d9d4a35899fa16ac8b4ffbc35', '$2y$10$r1Nt0YGZ.HsZuNnA57RO5uNgv2W.1ZN8LX2pMkFRkQfPWWJA0hA5G', '2024-03-20 19:13:42', '2024-03-20 19:13:42', 6, 0, NULL),
(4, '062168', 'Hugo', 0, 'hugo@gmail.com', '4c86cf5d0745caa4e1661559b7b8271043fb22021c8853b0c073e108ef586f57', '$2y$10$jkQok0zGIuZodMkDflhsn.hj39djCXOk7eLdZ978GjfBuh/KpGXiy', '2024-04-05 01:34:56', '2024-05-03 00:15:12', 3, 0, NULL),
(3, '06004672', 'Gabriel Guedes', 1, 'gabrielguedes00@hotmail.com', 'c8b082d35ba2a8b2765828cccaa2496d8a6a095d7410f8b3544461ca606bcdc0', '$2y$10$HU0..v1MrAzAxCEKnivJpOVtcvwGeM4fBnHPSVF9gnx1bP7rJP9ES', '2024-03-21 01:04:07', '2024-03-21 01:04:07', 3, 0, NULL),
(1, '073842', 'Lucas', 1, 'lucasduarte@feso.edu.br', '3b42bf0d3d3aa83495d431704bf36ab49688dbd23f978e1e91008924418f1d52', '$2y$10$CzlnkuUeeuxUI10RSOSOpOlcstrI60Y0aj484O5gpKZqOP6gq6MC2', '2024-03-20 18:04:57', '2024-04-17 01:07:19', 5, 0, NULL),
(5, '111222', 'Ronald', 1, 'ronaldmc@gmail.com', 'd8094448cd1aa6b88815a7c2a064c4b772b2d2da04d21295a13916dfd32feb4c', '$2y$10$9b6EF6YTat3Bc4k0l/hoSOx5NNXecpyc84vq/ka.zsSz7pWryOZMy', '2024-04-16 20:52:46', '2024-04-16 20:52:46', 6, 0, NULL),
(8, '082775', 'Antonio', 1, 'antonio@gmail.com', '26464ec27616052ac2a35fb616b3670c570eb2f59b6694b367f8c8c4934b68a5', '$2y$10$h7QybVA9P5CvCi0NfIqe9e4Vmwwg7zaBNY4DYzfNstmGhe4CDKWyG', '2024-05-03 00:27:39', '2024-05-03 00:33:31', 6, 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
