-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/05/2025 às 01:21
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco_sa`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `razao_social` varchar(80) NOT NULL,
  `nome_fantasia` varchar(50) NOT NULL,
  `cnpj` bigint(20) NOT NULL,
  `endereco` varchar(80) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `flg_ativo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razao_social`, `nome_fantasia`, `cnpj`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `logo`, `flg_ativo`) VALUES
(1, '11', 'senai', 12346, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `nome_funcionario` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `Ativo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nome_funcionario`, `descricao`, `Ativo`) VALUES
(1, 'PEDRO', 'ADM', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id_movimentacao` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `data_hora` datetime DEFAULT NULL,
  `funcionario_id_funcionario` int(11) NOT NULL,
  `veiculo_usuario_id_veiculo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `movimentacao`
--

INSERT INTO `movimentacao` (`id_movimentacao`, `tipo`, `data_hora`, `funcionario_id_funcionario`, `veiculo_usuario_id_veiculo_usuario`) VALUES
(1, 'E', NULL, 1, 1),
(2, 'E', NULL, 1, 2),
(3, 'S', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `flg_ativo` char(1) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `complemento` varchar(45) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `uf` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `cpf` bigint(20) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `telefone`, `cep`, `foto`, `flg_ativo`, `endereco`, `complemento`, `bairro`, `cidade`, `uf`, `numero`, `cpf`, `id_empresa`) VALUES
(1, 'JOAO', 'Ss', '123', '123', '145', 'AAA', 'S', 'RUA', 'RUA', 'JOI', 'JOI', 'SC', 123, 1456, 1),
(2, 'teste', 'teste@gmail', '123', '1234', '123', '', 'S', 'rua', 'casa', 'jardim', 'jlle', 'sc', 1090, 9032141798, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_veiculo` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `ano_modelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `veiculo`
--

INSERT INTO `veiculo` (`id_veiculo`, `placa`, `marca`, `modelo`, `ano_modelo`) VALUES
(1, 'xrg', 'fiat', 'toro', 2024),
(2, 'UUG', 'VW', 'SPACECROSS', 2020);

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculo_usuario`
--

CREATE TABLE `veiculo_usuario` (
  `id_veiculo_usuario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `veiculo_usuario`
--

INSERT INTO `veiculo_usuario` (`id_veiculo_usuario`, `id_usuario`, `id_veiculo`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id_movimentacao`),
  ADD KEY `fk_movimentacao_funcionario1_idx` (`funcionario_id_funcionario`),
  ADD KEY `fk_movimentacao_veiculo_usuario1_idx` (`veiculo_usuario_id_veiculo_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD KEY `fk_usuario_empresa1_idx` (`id_empresa`);

--
-- Índices de tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD UNIQUE KEY `placa_UNIQUE` (`placa`);

--
-- Índices de tabela `veiculo_usuario`
--
ALTER TABLE `veiculo_usuario`
  ADD PRIMARY KEY (`id_veiculo_usuario`),
  ADD KEY `fk_veiculo_usuario_usuario1_idx` (`id_usuario`),
  ADD KEY `fk_veiculo_usuario_veiculo1_idx` (`id_veiculo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id_movimentacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `veiculo_usuario`
--
ALTER TABLE `veiculo_usuario`
  MODIFY `id_veiculo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `fk_movimentacao_funcionario1` FOREIGN KEY (`funcionario_id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  ADD CONSTRAINT `fk_movimentacao_veiculo_usuario1` FOREIGN KEY (`veiculo_usuario_id_veiculo_usuario`) REFERENCES `veiculo_usuario` (`id_veiculo_usuario`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`);

--
-- Restrições para tabelas `veiculo_usuario`
--
ALTER TABLE `veiculo_usuario`
  ADD CONSTRAINT `fk_veiculo_usuario_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_veiculo_usuario_veiculo1` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id_veiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
