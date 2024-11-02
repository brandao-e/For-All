-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/10/2024 às 19:46
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `idChat` int(11) NOT NULL,
  `tipoChat` enum('Individual','Grupo') DEFAULT NULL,
  `nome` varchar(70) DEFAULT NULL,
  `dataCriacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE `cidade` (
  `idCidade` int(11) NOT NULL,
  `cidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

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
-- Estrutura para tabela `curtidas`
--

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
-- Estrutura para tabela `empresa`
--

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
  `tipoUsuario` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historicoempresas`
--

CREATE TABLE `historicoempresas` (
  `idContratacao` int(11) NOT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `dataContratacao` date DEFAULT NULL,
  `idTrabalhador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historicofuncionario`
--

CREATE TABLE `historicofuncionario` (
  `idContratacaoFuncio` int(11) NOT NULL,
  `idFuncionario` int(11) DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `dataContratacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem`
--

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
-- Estrutura para tabela `outrasexperiencias`
--

CREATE TABLE `outrasexperiencias` (
  `idExperiencia` int(11) NOT NULL,
  `texto` text DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `idTrabalhador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `participante`
--

CREATE TABLE `participante` (
  `idParticipante` int(11) NOT NULL,
  `idChat` int(11) DEFAULT NULL,
  `tipoMembro` enum('Empresa','Funcionario') DEFAULT NULL,
  `idMemebro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `publicacoes`
--

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
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `idServico` int(11) NOT NULL,
  `servico` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategoria`
--

CREATE TABLE `subcategoria` (
  `idSubcategoria` int(11) NOT NULL,
  `subcategoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `trabalhador`
--

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
  `telefone` char(11) DEFAULT NULL,
  `fotoPerfil` text DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `curriculo` varchar(255) DEFAULT NULL,
  `escolaridade` varchar(255) DEFAULT NULL,
  `videoApresentacao` varchar(255) DEFAULT NULL,
  `portifolio` varchar(255) DEFAULT NULL,
  `tipoUsuario` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `trabalhador`
--

INSERT INTO `trabalhador` (`idTrabalhador`, `primeiroNome`, `ultimoNome`, `email`, `senha`, `salt`, `experiencia`, `biografia`, `servico`, `subcategoria`, `telefone`, `fotoPerfil`, `dataNasc`, `curriculo`, `escolaridade`, `videoApresentacao`, `portifolio`, `tipoUsuario`) VALUES
(1, 'teste', 'testedois', 'teste@gmail.com', '123456', NULL, 'tenho', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Kaun', 'Godoy', 'Kaun@gmail.com', '23456', NULL, 'tenho', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Gustavo', 'Vechetti', 'Gustavo@gmail.com', '7894561', NULL, 'tenho', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Belle', 'Adm', 'Belle@gmail.com', 'Rapel123', NULL, 'tenho', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Joao', 'Verissimo', 'Joao@gmail.com', '456789', NULL, 'tenho', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

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
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idChat`);

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`idCidade`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `fkPublicacaoComen` (`idPublicacao`);

--
-- Índices de tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`idCurtida`),
  ADD KEY `fkpublicacao` (`idPublicacao`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Índices de tabela `historicoempresas`
--
ALTER TABLE `historicoempresas`
  ADD PRIMARY KEY (`idContratacao`),
  ADD KEY `fkempresa` (`idempresa`),
  ADD KEY `fktrabalhador` (`idTrabalhador`);

--
-- Índices de tabela `historicofuncionario`
--
ALTER TABLE `historicofuncionario`
  ADD PRIMARY KEY (`idContratacaoFuncio`),
  ADD KEY `fkEmpresaFuncio` (`idempresa`);

--
-- Índices de tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`idMensagem`),
  ADD KEY `fkChatMensagem` (`idChat`);

--
-- Índices de tabela `outrasexperiencias`
--
ALTER TABLE `outrasexperiencias`
  ADD PRIMARY KEY (`idExperiencia`),
  ADD KEY `fkIdtrabalhador` (`idTrabalhador`);

--
-- Índices de tabela `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`idParticipante`),
  ADD KEY `fkChat` (`idChat`);

--
-- Índices de tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  ADD PRIMARY KEY (`idPublicacao`);

--
-- Índices de tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`idServico`);

--
-- Índices de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idSubcategoria`);

--
-- Índices de tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  ADD PRIMARY KEY (`idTrabalhador`),
  ADD KEY `servico` (`servico`),
  ADD KEY `subcategoria` (`subcategoria`);

--
-- Índices de tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`idVaga`),
  ADD KEY `servicoVaga` (`servicoVaga`),
  ADD KEY `estadoEmpresa` (`estadoEmpresa`),
  ADD KEY `cidadeEmpresa` (`cidadeEmpresa`),
  ADD KEY `idEmpresa` (`idEmpresa`);

--
-- AUTO_INCREMENT para tabelas despejadas
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
  MODIFY `idCidade` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historicoempresas`
--
ALTER TABLE `historicoempresas`
  MODIFY `idContratacao` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de tabela `outrasexperiencias`
--
ALTER TABLE `outrasexperiencias`
  MODIFY `idExperiencia` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idServico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  MODIFY `idTrabalhador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `idVaga` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fkPublicacaoComen` FOREIGN KEY (`idPublicacao`) REFERENCES `publicacoes` (`idPublicacao`);

--
-- Restrições para tabelas `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `fkpublicacao` FOREIGN KEY (`idPublicacao`) REFERENCES `publicacoes` (`idPublicacao`);

--
-- Restrições para tabelas `historicoempresas`
--
ALTER TABLE `historicoempresas`
  ADD CONSTRAINT `fkempresa` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`),
  ADD CONSTRAINT `fktrabalhador` FOREIGN KEY (`idTrabalhador`) REFERENCES `trabalhador` (`idTrabalhador`);

--
-- Restrições para tabelas `historicofuncionario`
--
ALTER TABLE `historicofuncionario`
  ADD CONSTRAINT `fkEmpresaFuncio` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`);

--
-- Restrições para tabelas `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `fkChatMensagem` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`);

--
-- Restrições para tabelas `outrasexperiencias`
--
ALTER TABLE `outrasexperiencias`
  ADD CONSTRAINT `fkIdtrabalhador` FOREIGN KEY (`idTrabalhador`) REFERENCES `trabalhador` (`idTrabalhador`);

--
-- Restrições para tabelas `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `fkChat` FOREIGN KEY (`idChat`) REFERENCES `chat` (`idChat`);

--
-- Restrições para tabelas `trabalhador`
--
ALTER TABLE `trabalhador`
  ADD CONSTRAINT `trabalhador_ibfk_1` FOREIGN KEY (`servico`) REFERENCES `servico` (`idServico`),
  ADD CONSTRAINT `trabalhador_ibfk_2` FOREIGN KEY (`subcategoria`) REFERENCES `subcategoria` (`idSubcategoria`);

--
-- Restrições para tabelas `vagas`
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
