-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Maio-2022 às 03:36
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `loja-exemplo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `cep` varchar(8) NOT NULL,
  `logradouro` varchar(150) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `quant` int(11) NOT NULL,
  `data_alteracao` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor` decimal(11,2) NOT NULL,
  `largura` decimal(11,3) DEFAULT NULL,
  `altura` decimal(11,3) DEFAULT NULL,
  `comprimento` decimal(11,3) DEFAULT NULL,
  `peso` decimal(11,3) DEFAULT NULL,
  `fotos` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `quant`, `data_alteracao`, `valor`, `largura`, `altura`, `comprimento`, `peso`, `fotos`, `ativo`) VALUES
(1, 'Celular ', 'Celular 4G', 10, '2022-05-10 00:57:09', '1200.00', '0.000', '0.000', '0.000', '0.000', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `nome` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `cpf` varchar(12) NOT NULL,
  `id` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`nome`, `senha`, `data_nasc`, `email`, `foto_perfil`, `tel`, `cpf`, `id`, `ativo`) VALUES
('Silvia Cristiana Da Silva', '3f415f27d8797b3003575ee77b0ec225', '0000-00-00', 'sc@email.com', 'd00a0bb5897e59483116a919cc64f124.jpg', '', '12323434522', 23, 1),
('Pedro Cunha Souza', 'f3c055d289f91aa900ada6066a7c356b', '0000-00-00', 'pc@email.com', '367bade5e9b971239f60a9e65ea7941b.jpg', '', '12323445633', 24, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_endereco`
--

CREATE TABLE `usuario_endereco` (
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `ehPrincipal` tinyint(1) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cep`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario_endereco`
--
ALTER TABLE `usuario_endereco`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `cep` (`cep`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `usuario_endereco`
--
ALTER TABLE `usuario_endereco`
  ADD CONSTRAINT `usuario_endereco_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `usuario_endereco_ibfk_2` FOREIGN KEY (`cep`) REFERENCES `endereco` (`cep`);
COMMIT;
