-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Nov-2024 às 19:37
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdforall`
--
CREATE DATABASE IF NOT EXISTS `bdforall` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdforall`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `idChat` int(11) NOT NULL,
  `tipoChat` enum('Individual','Grupo') DEFAULT NULL,
  `nome` varchar(70) DEFAULT NULL,
  `dataCriacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE `cidade` (
  `idCidade` int(11) NOT NULL,
  `cidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`idCidade`, `cidade`) VALUES
(1, 'Franco da Rocha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `idPublicacao` int(11) DEFAULT NULL,
  `idComentador` int(11) DEFAULT NULL,
  `tipoComentador` enum('Empresa','Funcionario') DEFAULT NULL,
  `dataComentario` date DEFAULT NULL,
  `horaComentario` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

DROP TABLE IF EXISTS `curtidas`;
CREATE TABLE `curtidas` (
  `idCurtida` int(11) NOT NULL,
  `idPublicacao` int(11) DEFAULT NULL,
  `idCurtidor` int(11) DEFAULT NULL,
  `tipoCurtidor` enum('Empresa','Funcionario') DEFAULT NULL,
  `dataCurtida` date DEFAULT NULL,
  `horaCurtida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL,
  `primeiroNome` varchar(100) DEFAULT NULL,
  `ultimoNome` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `videoApresentacao` text DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `fotoPerfil` varchar(255) DEFAULT NULL,
  `tipoUsuario` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`idempresa`, `primeiroNome`, `ultimoNome`, `email`, `senha`, `salt`, `videoApresentacao`, `cnpj`, `fotoPerfil`, `tipoUsuario`) VALUES
(3, 'Linkedin', 'INC.', 'linkedin@gmail.com', '123456789', 'hsdvbs', NULL, '01926592000130', NULL, b'1');

--
-- Acionadores `empresa`
--
DELIMITER $$
CREATE TRIGGER `after_insert_empresa` AFTER INSERT ON `empresa` FOR EACH ROW INSERT INTO usuario (nome, email, senha, salt, tipoUsuario, idEmpresa)
    VALUES (CONCAT(NEW.primeiroNome, ' ', NEW.ultimoNome), NEW.email, NEW.senha, NEW.salt, 1, NEW.idempresa)
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `after_update_empresa` AFTER UPDATE ON `empresa` FOR EACH ROW UPDATE usuario
    SET nome = CONCAT(NEW.primeiroNome, ' ', NEW.ultimoNome),
        email = NEW.email,
        senha = NEW.senha,
        salt = NEW.salt,
        idEmpresa = NEW.idempresa,  -- Atualiza o idEmpresa
        idTrabalhador = NULL        -- Limpa o idTrabalhador, pois este usuário é uma empresa
    WHERE idEmpresa = NEW.idempresa
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`idEstado`, `estado`) VALUES
(1, 'São Paulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicoempresas`
--

DROP TABLE IF EXISTS `historicoempresas`;
CREATE TABLE `historicoempresas` (
  `idContratacao` int(11) NOT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `dataContratacao` date DEFAULT NULL,
  `idTrabalhador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `historicoempresas`
--

INSERT INTO `historicoempresas` (`idContratacao`, `idempresa`, `dataContratacao`, `idTrabalhador`) VALUES
(1, 3, '2024-09-19', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicofuncionario`
--

DROP TABLE IF EXISTS `historicofuncionario`;
CREATE TABLE `historicofuncionario` (
  `idContratacaoFuncio` int(11) NOT NULL,
  `idFuncionario` int(11) DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `dataContratacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

DROP TABLE IF EXISTS `mensagem`;
CREATE TABLE `mensagem` (
  `idMensagem` int(11) NOT NULL,
  `idChat` int(11) DEFAULT NULL,
  `tipoAutor` enum('Empresa','Funcionario') DEFAULT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `conteudo` text DEFAULT NULL,
  `dataEnvio` date DEFAULT NULL,
  `horaEnvio` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `participante`
--

DROP TABLE IF EXISTS `participante`;
CREATE TABLE `participante` (
  `idParticipante` int(11) NOT NULL,
  `idChat` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataParticipacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

DROP TABLE IF EXISTS `publicacoes`;
CREATE TABLE `publicacoes` (
  `idPublicacao` int(11) NOT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `tipoAutor` enum('Empresa','Funcionario') DEFAULT NULL,
  `Conteudo` text DEFAULT NULL,
  `dataPublicacao` date DEFAULT NULL,
  `horaPublicacao` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

DROP TABLE IF EXISTS `servico`;
CREATE TABLE `servico` (
  `idServico` int(11) NOT NULL,
  `servico` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`idServico`, `servico`) VALUES
(1, 'TI & Programação'),
(2, 'Jurídico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE `subcategoria` (
  `idSubcategoria` int(11) NOT NULL,
  `subcategoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `subcategoria`
--

INSERT INTO `subcategoria` (`idSubcategoria`, `subcategoria`) VALUES
(1, 'Desenvolvedor Web - Frontend'),
(2, 'Advogado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalhador`
--

DROP TABLE IF EXISTS `trabalhador`;
CREATE TABLE `trabalhador` (
  `idTrabalhador` int(11) NOT NULL,
  `primeiroNome` varchar(100) DEFAULT NULL,
  `ultimoNome` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `experiencia` text DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `servico` int(11) DEFAULT NULL,
  `subcategoria` int(11) DEFAULT NULL,
  `telefone` char(18) DEFAULT NULL,
  `fotoPerfil` text DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `curriculo` varchar(255) DEFAULT NULL,
  `escolaridade` varchar(255) DEFAULT NULL,
  `videoApresentacao` varchar(255) DEFAULT NULL,
  `portifolio` varchar(255) DEFAULT NULL,
  `tipoUsuario` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `trabalhador`
--

INSERT INTO `trabalhador` (`idTrabalhador`, `primeiroNome`, `ultimoNome`, `email`, `senha`, `salt`, `experiencia`, `biografia`, `servico`, `subcategoria`, `telefone`, `fotoPerfil`, `dataNasc`, `curriculo`, `escolaridade`, `videoApresentacao`, `portifolio`, `tipoUsuario`) VALUES
(6, 'Julia ', 'Vitória', 'jv@gmail.com', '123456789', 'sjkidfb', 'tenho', 'fdkbnmoifbmio fdg', 1, 1, '11 958742145', NULL, '2006-05-24', NULL, NULL, NULL, NULL, b'0');

--
-- Acionadores `trabalhador`
--
DELIMITER $$
CREATE TRIGGER `after_insert_trabalhador` AFTER INSERT ON `trabalhador` FOR EACH ROW INSERT INTO usuario (nome, email, senha, salt, tipoUsuario, idTrabalhador)
    VALUES (CONCAT(NEW.primeiroNome, ' ', NEW.ultimoNome), NEW.email, NEW.senha, NEW.salt, 0, NEW.idTrabalhador)
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `after_update_trabalhador` AFTER UPDATE ON `trabalhador` FOR EACH ROW UPDATE usuario
    SET nome = CONCAT(NEW.primeiroNome, ' ', NEW.ultimoNome),
        email = NEW.email,
        senha = NEW.senha,
        salt = NEW.salt,
        idTrabalhador = NEW.idTrabalhador,  -- Atualiza o idTrabalhador
        idEmpresa = NULL                   -- Limpa o idEmpresa, pois este usuário é um trabalhador
    WHERE idTrabalhador = NEW.idTrabalhador
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `tipoUsuario` int(11) NOT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  `idTrabalhador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `email`, `senha`, `salt`, `tipoUsuario`, `idEmpresa`, `idTrabalhador`) VALUES
(1, 'Linkedin INC.', 'linkedin@gmail.com', '123456789', 'hsdvbs', 1, 3, NULL),
(2, 'Julia  Vitória', 'jv@gmail.com', '123456789', 'sjkidfb', 0, NULL, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

DROP TABLE IF EXISTS `vagas`;
CREATE TABLE `vagas` (
  `idVaga` int(11) NOT NULL,
  `servicoVaga` int(11) DEFAULT NULL,
  `tituloVaga` varchar(50) DEFAULT NULL,
  `salarioVaga` varchar(15) DEFAULT NULL,
  `tipoContrato` varchar(30) DEFAULT NULL,
  `cargaHoraria` varchar(50) DEFAULT NULL,
  `estadoEmpresa` int(11) DEFAULT NULL,
  `cidadeEmpresa` int(11) DEFAULT NULL,
  `bairroEmpresa` varchar(50) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `dataPublicacao` date DEFAULT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  `statusVaga` enum('Ativa','Cancelada') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`idVaga`, `servicoVaga`, `tituloVaga`, `salarioVaga`, `tipoContrato`, `cargaHoraria`, `estadoEmpresa`, `cidadeEmpresa`, `bairroEmpresa`, `complemento`, `descricao`, `dataPublicacao`, `idEmpresa`, `statusVaga`) VALUES
(1, 1, 'Estágio TI', '1500', 'CLT', '44 horas semanais', 1, 1, 'Parque Vitória', ' gjzxgv uyc ', 'dfdgfdegg tryg ergefge', '2024-08-07', 3, 'Ativa');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idChat`);

--
-- Índices para tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`idCidade`);

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `fkPublicacaoComen` (`idPublicacao`);

--
-- Índices para tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`idCurtida`),
  ADD KEY `fkpublicacao` (`idPublicacao`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD UNIQUE KEY `emailEmpresa` (`email`);

--
-- Índices para tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Índices para tabela `historicoempresas`
--
ALTER TABLE `historicoempresas`
  ADD PRIMARY KEY (`idContratacao`),
  ADD KEY `fkempresa` (`idempresa`),
  ADD KEY `fktrabalhador` (`idTrabalhador`) USING BTREE;

--
-- Índices para tabela `historicofuncionario`
--
ALTER TABLE `historicofuncionario`
  ADD PRIMARY KEY (`idContratacaoFuncio`),
  ADD KEY `fkEmpresaFuncio` (`idempresa`);

--
-- Índices para tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`idMensagem`),
  ADD KEY `fkChatMensagem` (`idChat`);

--
-- Índices para tabela `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`idParticipante`),
  ADD KEY `fkChat` (`idChat`);

--
-- Índices para tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  ADD PRIMARY KEY (`idPublicacao`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`idServico`);

--
-- Índices para tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idSubcategoria`);

--
-- Índices para tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  ADD PRIMARY KEY (`idTrabalhador`),
  ADD UNIQUE KEY `emailTrabalhador` (`email`),
  ADD KEY `trabalhador_ibfk_1` (`servico`),
  ADD KEY `trabalhador_ibfk_2` (`subcategoria`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Índices para tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`idVaga`),
  ADD KEY `servicoVaga` (`servicoVaga`),
  ADD KEY `estadoEmpresa` (`estadoEmpresa`),
  ADD KEY `cidadeEmpresa` (`cidadeEmpresa`),
  ADD KEY `idEmpresa` (`idEmpresa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `idChat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `idCidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `idCurtida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `historicoempresas`
--
ALTER TABLE `historicoempresas`
  MODIFY `idContratacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `historicofuncionario`
--
ALTER TABLE `historicofuncionario`
  MODIFY `idContratacaoFuncio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `idMensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `participante`
--
ALTER TABLE `participante`
  MODIFY `idParticipante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `idPublicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `idServico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  MODIFY `idTrabalhador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `idVaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fkPublicacaoComen` FOREIGN KEY (`idPublicacao`) REFERENCES `publicacoes` (`idPublicacao`);

--
-- Limitadores para a tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `fkpublicacao` FOREIGN KEY (`idPublicacao`) REFERENCES `publicacoes` (`idPublicacao`);

--
-- Limitadores para a tabela `historicoempresas`
--
ALTER TABLE `historicoempresas`
  ADD CONSTRAINT `fkempresa` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`),
  ADD CONSTRAINT `fktrabalhador` FOREIGN KEY (`idTrabalhador`) REFERENCES `trabalhador` (`idTrabalhador`);

--
-- Limitadores para a tabela `historicofuncionario`
--
ALTER TABLE `historicofuncionario`
  ADD CONSTRAINT `fkEmpresaFuncio` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`);

--
-- Limitadores para a tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `fkChatMensagem` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`);

--
-- Limitadores para a tabela `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `fkChat` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`);

--
-- Limitadores para a tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  ADD CONSTRAINT `trabalhador_ibfk_1` FOREIGN KEY (`servico`) REFERENCES `servico` (`idServico`),
  ADD CONSTRAINT `trabalhador_ibfk_2` FOREIGN KEY (`subcategoria`) REFERENCES `subcategoria` (`idSubcategoria`);

--
-- Limitadores para a tabela `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `vagas_ibfk_1` FOREIGN KEY (`servicoVaga`) REFERENCES `servico` (`idServico`),
  ADD CONSTRAINT `vagas_ibfk_2` FOREIGN KEY (`estadoEmpresa`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `vagas_ibfk_3` FOREIGN KEY (`cidadeEmpresa`) REFERENCES `cidade` (`idCidade`),
  ADD CONSTRAINT `vagas_ibfk_4` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idempresa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
