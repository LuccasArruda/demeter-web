-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/06/2025 às 22:07
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
-- Banco de dados: `demeter`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ambiente`
--

CREATE TABLE `ambiente` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `TIPO` varchar(2) NOT NULL,
  `VL_MEDIO_CONTA_LUZ` float(6,2) DEFAULT NULL,
  `PERCENTUAL_SUSTENTABILIDADE` int(11) DEFAULT 0,
  `TOTAL_APARELHOS_AMBIENTE` int(11) DEFAULT 0,
  `GASTO_TOTAL_AMBIENTE` float(6,2) DEFAULT 0.00,
  `GASTO_ABATIDO_AMBIENTE` float(6,2) DEFAULT 0.00,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_ENDERECO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ambiente`
--

INSERT INTO `ambiente` (`ID`, `DESCRICAO`, `TIPO`, `VL_MEDIO_CONTA_LUZ`, `PERCENTUAL_SUSTENTABILIDADE`, `TOTAL_APARELHOS_AMBIENTE`, `GASTO_TOTAL_AMBIENTE`, `GASTO_ABATIDO_AMBIENTE`, `ID_USUARIO`, `ID_ENDERECO`) VALUES
(4, 'Ambiente Pessoal', 'PE', 400.00, 71, 7, 342.00, 0.00, 1, 1),
(5, 'Ambiente Profissional', 'PR', 800.00, 78, 13, 742.99, 300.00, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aparelho`
--

CREATE TABLE `aparelho` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL,
  `CONSUMO` float(4,2) DEFAULT NULL,
  `FABRICANTE` varchar(50) DEFAULT NULL,
  `TEMPO_DE_USO` int(11) DEFAULT NULL,
  `ENCE` varchar(1) DEFAULT NULL,
  `MODELO` varchar(50) DEFAULT NULL,
  `ID_REDE_ELETRICA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aparelho`
--

INSERT INTO `aparelho` (`ID`, `DESCRICAO`, `CONSUMO`, `FABRICANTE`, `TEMPO_DE_USO`, `ENCE`, `MODELO`, `ID_REDE_ELETRICA`) VALUES
(8, 'Geladeira', 54.00, NULL, 24, 'A', NULL, 4),
(9, 'Micro-Ondas', 15.00, NULL, 1, 'A', NULL, 4),
(15, 'teste aparei', 23.00, NULL, 6, 'A', NULL, 4),
(18, 'aparelhoaa', 50.00, NULL, 18, 'E', NULL, 4),
(20, 'Aparelho 1', 40.00, NULL, 8, 'A', NULL, 5),
(21, 'Aparalho 2', 50.00, NULL, 10, 'A', NULL, 5),
(22, 'Aparelho 3', 60.00, NULL, 5, 'B', NULL, 5),
(23, 'Geladeira', 54.00, NULL, 24, 'A', NULL, 5),
(24, 'Aparelho 4', 80.00, NULL, 15, 'A', NULL, 5),
(25, 'Ar condicionado 1', 88.99, NULL, 24, 'A', NULL, 6),
(26, 'Ar Condicionado 2', 80.00, NULL, 24, 'A', NULL, 6),
(27, 'Aparelho 1', 40.00, NULL, 24, 'A', NULL, 6),
(28, 'Aparelho 3', 50.00, NULL, 8, 'B', NULL, 6),
(29, 'Aparelho1', 40.00, NULL, 8, 'A', NULL, 4),
(30, 'Aparelho 2', 80.00, NULL, 20, 'B', NULL, 6),
(31, 'Aparelho 10', 80.00, NULL, 17, 'B', NULL, 4),
(32, 'Aparelho 5', 60.00, NULL, 9, 'A', NULL, 5),
(33, 'Aparelho 5', 60.00, NULL, 9, 'A', NULL, 6),
(34, 'Aparelho 6', 80.00, NULL, 10, 'C', NULL, 4);

--
-- Acionadores `aparelho`
--
DELIMITER $$
CREATE TRIGGER `TR_AD_APARELHO` AFTER DELETE ON `aparelho` FOR EACH ROW BEGIN
    DECLARE ID_REDE_ELETRICA INT;

    SET ID_REDE_ELETRICA = OLD.ID_REDE_ELETRICA;

    UPDATE REDE_ELETRICA
    SET 
        TOTAL_APARELHOS = TOTAL_APARELHOS - 1,
        GASTO_TOTAL = GASTO_TOTAL - OLD.CONSUMO
    WHERE ID = ID_REDE_ELETRICA;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_AI_APARELHO` AFTER INSERT ON `aparelho` FOR EACH ROW BEGIN
    DECLARE ID_REDE_ELETRICA INT;

    SET ID_REDE_ELETRICA = NEW.ID_REDE_ELETRICA;

    UPDATE REDE_ELETRICA
    SET 
        TOTAL_APARELHOS = TOTAL_APARELHOS + 1,
        GASTO_TOTAL = GASTO_TOTAL + NEW.CONSUMO
    WHERE ID = ID_REDE_ELETRICA;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_AU_APARELHO` AFTER UPDATE ON `aparelho` FOR EACH ROW BEGIN
    DECLARE ID_REDE_ELETRICA INT;

    SET ID_REDE_ELETRICA = NEW.ID_REDE_ELETRICA;

    UPDATE REDE_ELETRICA
    SET GASTO_TOTAL = GASTO_TOTAL - OLD.CONSUMO + NEW.CONSUMO 
    WHERE ID = ID_REDE_ELETRICA;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairro`
--

CREATE TABLE `bairro` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bairro`
--

INSERT INTO `bairro` (`ID`, `NOME`, `ID_CIDADE`) VALUES
(1, 'Centenario', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE `cidade` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `ID_ESTADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cidade`
--

INSERT INTO `cidade` (`ID`, `NOME`, `ID_ESTADO`) VALUES
(1, 'Porto Ferreira', 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `ID` int(11) NOT NULL,
  `RUA` varchar(100) NOT NULL,
  `NUMERO` varchar(10) NOT NULL,
  `ID_BAIRRO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`ID`, `RUA`, `NUMERO`, `ID_BAIRRO`) VALUES
(1, 'Antonio Mendonca', '205', 1),
(2, 'Antonio Mendonça', '204', 1),
(3, 'Antonio Mendonça', '205', 1),
(4, 'Antonio Mendonça Salvador', '205', 1),
(5, 'Antonio Mendonca', '205', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `SIGLA` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estado`
--

INSERT INTO `estado` (`ID`, `NOME`, `SIGLA`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amapa', 'AP'),
(4, 'Amazonas', 'AM'),
(5, 'Bahia', 'BA'),
(6, 'Ceara', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espirito Santo', 'ES'),
(9, 'Goias', 'GO'),
(10, 'Maranhao', 'MA'),
(11, 'Mato Grosso', 'MT'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Minas Gerais', 'MG'),
(14, 'Para', 'PA'),
(15, 'Paraiba', 'PB'),
(16, 'Parana', 'PR'),
(17, 'Pernambuco', 'PE'),
(18, 'Piaui', 'PI'),
(19, 'Rio de Janeiro', 'RJ'),
(20, 'Rio Grande do Norte', 'RN'),
(21, 'Rio Grande do Sul', 'RS'),
(22, 'Rondonia', 'RO'),
(23, 'Roraima', 'RR'),
(24, 'Santa Catarina', 'SC'),
(25, 'Sao Paulo', 'SP'),
(26, 'Sergipe', 'SE'),
(27, 'Tocantins', 'TO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `gerador`
--

CREATE TABLE `gerador` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL,
  `ENERGIA_GERADA` float NOT NULL,
  `TIPO` varchar(2) DEFAULT NULL,
  `ID_REDE_ELETRICA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `gerador`
--

INSERT INTO `gerador` (`ID`, `DESCRICAO`, `ENERGIA_GERADA`, `TIPO`, `ID_REDE_ELETRICA`) VALUES
(10, 'Painel Solar', 300, 'R', 5);

--
-- Acionadores `gerador`
--
DELIMITER $$
CREATE TRIGGER `TR_AD_GERADOR` AFTER DELETE ON `gerador` FOR EACH ROW BEGIN
    DECLARE ID_REDE_ELETRICA INT;

    SET ID_REDE_ELETRICA = OLD.ID_REDE_ELETRICA;

    UPDATE REDE_ELETRICA
    SET 
        TOTAL_APARELHOS = TOTAL_APARELHOS - 1,
        GASTO_ABATIDO = GASTO_ABATIDO - OLD.ENERGIA_GERADA
    WHERE ID = ID_REDE_ELETRICA;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_AI_GERADOR` AFTER INSERT ON `gerador` FOR EACH ROW BEGIN
    DECLARE ID_REDE_ELETRICA INT;

    SET ID_REDE_ELETRICA = NEW.ID_REDE_ELETRICA;

    UPDATE REDE_ELETRICA
    SET 
        TOTAL_APARELHOS = TOTAL_APARELHOS + 1,
        GASTO_ABATIDO = GASTO_ABATIDO + NEW.ENERGIA_GERADA
    WHERE ID = ID_REDE_ELETRICA;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_AU_GERADOR` AFTER UPDATE ON `gerador` FOR EACH ROW BEGIN
    DECLARE ID_REDE_ELETRICA INT;

    SET ID_REDE_ELETRICA = NEW.ID_REDE_ELETRICA;

    UPDATE REDE_ELETRICA
    SET GASTO_ABATIDO = GASTO_ABATIDO - OLD.ENERGIA_GERADA + NEW.ENERGIA_GERADA
    WHERE ID = ID_REDE_ELETRICA;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `ID` int(11) NOT NULL,
  `IMAGEM` longblob NOT NULL,
  `MIME_TYPE` varchar(100) NOT NULL,
  `TIPO` varchar(2) DEFAULT NULL,
  `ID_ORIGEM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rede_eletrica`
--

CREATE TABLE `rede_eletrica` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(500) DEFAULT NULL,
  `PERCENTUAL_SUSTENTABILIDADE` int(11) DEFAULT 0,
  `TOTAL_APARELHOS` int(11) DEFAULT 0,
  `GASTO_TOTAL` float(6,2) DEFAULT 0.00,
  `GASTO_ABATIDO` float(6,2) DEFAULT 0.00,
  `ID_AMBIENTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rede_eletrica`
--

INSERT INTO `rede_eletrica` (`ID`, `DESCRICAO`, `PERCENTUAL_SUSTENTABILIDADE`, `TOTAL_APARELHOS`, `GASTO_TOTAL`, `GASTO_ABATIDO`, `ID_AMBIENTE`) VALUES
(4, 'Rede Casa', 71, 7, 342.00, 0.00, 4),
(5, 'Rede escritório', 100, 7, 344.00, 300.00, 5),
(6, 'Rede almoxarifado', 72, 6, 398.99, 0.00, 5);

--
-- Acionadores `rede_eletrica`
--
DELIMITER $$
CREATE TRIGGER `TR_AD_REDE_ELETRICA` AFTER DELETE ON `rede_eletrica` FOR EACH ROW BEGIN
    DECLARE ID_AMBIENTE INT;

    SET ID_AMBIENTE = OLD.ID_AMBIENTE;

    UPDATE AMBIENTE
    SET 
        TOTAL_APARELHOS_AMBIENTE = TOTAL_APARELHOS_AMBIENTE - OLD.TOTAL_APARELHOS,
        GASTO_TOTAL_AMBIENTE = GASTO_TOTAL_AMBIENTE - OLD.GASTO_TOTAL,
        GASTO_ABATIDO_AMBIENTE = GASTO_ABATIDO_AMBIENTE - OLD.GASTO_ABATIDO
    WHERE ID = ID_AMBIENTE;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_AI_REDE_ELETRICA` AFTER INSERT ON `rede_eletrica` FOR EACH ROW BEGIN
    DECLARE ID_AMBIENTE INT;

    SET ID_AMBIENTE = NEW.ID_AMBIENTE;

    UPDATE AMBIENTE
    SET 
        TOTAL_APARELHOS_AMBIENTE = TOTAL_APARELHOS_AMBIENTE + NEW.TOTAL_APARELHOS,
        GASTO_TOTAL_AMBIENTE = GASTO_TOTAL_AMBIENTE + NEW.GASTO_TOTAL,
        GASTO_ABATIDO_AMBIENTE = GASTO_ABATIDO_AMBIENTE + NEW.GASTO_ABATIDO
    WHERE ID = ID_AMBIENTE;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_AU_REDE_ELETRICA` AFTER UPDATE ON `rede_eletrica` FOR EACH ROW BEGIN
    DECLARE ID_AMBIENTE INT;

    SET ID_AMBIENTE = NEW.ID_AMBIENTE;

    UPDATE AMBIENTE
    SET 
        TOTAL_APARELHOS_AMBIENTE = TOTAL_APARELHOS_AMBIENTE - OLD.TOTAL_APARELHOS + NEW.TOTAL_APARELHOS,
        GASTO_TOTAL_AMBIENTE = GASTO_TOTAL_AMBIENTE - OLD.GASTO_TOTAL + NEW.GASTO_TOTAL,
        GASTO_ABATIDO_AMBIENTE = GASTO_ABATIDO_AMBIENTE - OLD.GASTO_ABATIDO + NEW.GASTO_ABATIDO
    WHERE ID = ID_AMBIENTE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `TELEFONE` varchar(20) NOT NULL,
  `SENHA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `NOME`, `EMAIL`, `TELEFONE`, `SENHA`) VALUES
(1, 'Ereque', 'eric@email.com', '19994926715', '$2y$10$lIV9AJig8OePUpWXvuXhX.O2b1ORV/MgCZqSo0vydheeCZn/A1/sS'),
(2, 'Andre', 'andre@email.com', '19994926715', '$2y$10$SwpDPRsjdHOH0JkNT9kTRujzzRgJq6hI2F89Ri1IGFju.Rc1DLQUa'),
(3, 'Eric', 'ereque@gmail.com', '19994926715', '$2y$10$5ecTOA9lXviEASIVR7R4au5pTn.I0YmqLDE4tjK6P5j9bIFU/bZoy'),
(4, 'ErequeH', 'eric@gmail.com', '19994926715', '$2y$10$6Svr/mrEEM07OmNdaRanFOgz0r.USRT3/bE/8m.KAFE8TLTvH8ONC');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_aparelhos`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_aparelhos` (
`TIPO` varchar(2)
,`ID` int(11)
,`DESCRICAO` varchar(100)
,`CONSUMO` float(4,2)
,`FABRICANTE` varchar(50)
,`TEMPO_DE_USO` int(11)
,`ENCE` varchar(1)
,`MODELO` varchar(50)
,`ENERGIA_GERADA` float
,`ID_REDE_ELETRICA` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_endereco`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_endereco` (
`ID_ENDERECO` int(11)
,`RUA` varchar(100)
,`NUMERO` varchar(10)
,`BAIRRO` varchar(50)
,`CIDADE` varchar(50)
,`ESTADO_SIGLA` varchar(2)
,`ESTADO_NOME` varchar(50)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_rede_eletrica`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_rede_eletrica` (
`ID` int(11)
,`GASTO_TOTAL` float(6,2)
,`GASTO_ABATIDO` float(6,2)
,`TOTAL_APARELHOS` int(11)
,`ID_APARELHO` int(11)
,`DESCRICAO_APARELHO` varchar(100)
,`CONSUMO` float(4,2)
,`FABRICANTE` varchar(50)
,`TEMPO_DE_USO` int(11)
,`ENCE` varchar(1)
,`MODELO` varchar(50)
,`TIPO` varchar(2)
,`ID_GERADOR` int(11)
,`DESCRICAO_GERADOR` varchar(100)
,`ENERGIA_GERADA` float
);

-- --------------------------------------------------------

--
-- Estrutura para view `view_aparelhos`
--
DROP TABLE IF EXISTS `view_aparelhos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_aparelhos`  AS SELECT 'A' AS `TIPO`, `aparelho`.`ID` AS `ID`, `aparelho`.`DESCRICAO` AS `DESCRICAO`, `aparelho`.`CONSUMO` AS `CONSUMO`, `aparelho`.`FABRICANTE` AS `FABRICANTE`, `aparelho`.`TEMPO_DE_USO` AS `TEMPO_DE_USO`, `aparelho`.`ENCE` AS `ENCE`, `aparelho`.`MODELO` AS `MODELO`, NULL AS `ENERGIA_GERADA`, `aparelho`.`ID_REDE_ELETRICA` AS `ID_REDE_ELETRICA` FROM `aparelho`union select `end`.`TIPO` AS `TIPO`,`end`.`ID` AS `ID`,`end`.`DESCRICAO` AS `DESCRICAO`,NULL AS `CONSUMO`,NULL AS `FABRICANTE`,NULL AS `TEMPO_DE_USO`,NULL AS `ENCE`,NULL AS `MODELO`,`end`.`ENERGIA_GERADA` AS `ENERGIA_GERADA`,`end`.`ID_REDE_ELETRICA` AS `ID_REDE_ELETRICA` from `gerador` `end`  ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_endereco`
--
DROP TABLE IF EXISTS `view_endereco`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_endereco`  AS SELECT `e`.`ID` AS `ID_ENDERECO`, `e`.`RUA` AS `RUA`, `e`.`NUMERO` AS `NUMERO`, `b`.`NOME` AS `BAIRRO`, `c`.`NOME` AS `CIDADE`, `es`.`SIGLA` AS `ESTADO_SIGLA`, `es`.`NOME` AS `ESTADO_NOME` FROM (((`endereco` `e` left join `bairro` `b` on(`e`.`ID_BAIRRO` = `b`.`ID`)) left join `cidade` `c` on(`b`.`ID_CIDADE` = `c`.`ID`)) left join `estado` `es` on(`c`.`ID_ESTADO` = `es`.`ID`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_rede_eletrica`
--
DROP TABLE IF EXISTS `view_rede_eletrica`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rede_eletrica`  AS SELECT `r`.`ID` AS `ID`, `r`.`GASTO_TOTAL` AS `GASTO_TOTAL`, `r`.`GASTO_ABATIDO` AS `GASTO_ABATIDO`, `r`.`TOTAL_APARELHOS` AS `TOTAL_APARELHOS`, `a`.`ID` AS `ID_APARELHO`, `a`.`DESCRICAO` AS `DESCRICAO_APARELHO`, `a`.`CONSUMO` AS `CONSUMO`, `a`.`FABRICANTE` AS `FABRICANTE`, `a`.`TEMPO_DE_USO` AS `TEMPO_DE_USO`, `a`.`ENCE` AS `ENCE`, `a`.`MODELO` AS `MODELO`, 'A' AS `TIPO`, NULL AS `ID_GERADOR`, NULL AS `DESCRICAO_GERADOR`, NULL AS `ENERGIA_GERADA` FROM (`rede_eletrica` `r` join `aparelho` `a` on(`r`.`ID` = `a`.`ID_REDE_ELETRICA`))union all select `r`.`ID` AS `ID`,`r`.`GASTO_TOTAL` AS `GASTO_TOTAL`,`r`.`GASTO_ABATIDO` AS `GASTO_ABATIDO`,`r`.`TOTAL_APARELHOS` AS `TOTAL_APARELHOS`,NULL AS `ID_APARELHO`,NULL AS `DESCRICAO_APARELHO`,NULL AS `CONSUMO`,NULL AS `FABRICANTE`,NULL AS `TEMPO_DE_USO`,NULL AS `ENCE`,NULL AS `MODELO`,`g`.`TIPO` AS `TIPO`,`g`.`ID` AS `ID_GERADOR`,`g`.`DESCRICAO` AS `DESCRICAO_GERADOR`,`g`.`ENERGIA_GERADA` AS `ENERGIA_GERADA` from (`rede_eletrica` `r` join `gerador` `g` on(`r`.`ID` = `g`.`ID_REDE_ELETRICA`))  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_ENDERECO` (`ID_ENDERECO`);

--
-- Índices de tabela `aparelho`
--
ALTER TABLE `aparelho`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_REDE_ELETRICA` (`ID_REDE_ELETRICA`);

--
-- Índices de tabela `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CIDADE` (`ID_CIDADE`);

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ESTADO` (`ID_ESTADO`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_BAIRRO` (`ID_BAIRRO`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `gerador`
--
ALTER TABLE `gerador`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_REDE_ELETRICA` (`ID_REDE_ELETRICA`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `idx_id_origem_tipo` (`ID_ORIGEM`,`TIPO`);

--
-- Índices de tabela `rede_eletrica`
--
ALTER TABLE `rede_eletrica`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_AMBIENTE` (`ID_AMBIENTE`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ambiente`
--
ALTER TABLE `ambiente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `aparelho`
--
ALTER TABLE `aparelho`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `bairro`
--
ALTER TABLE `bairro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `gerador`
--
ALTER TABLE `gerador`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rede_eletrica`
--
ALTER TABLE `rede_eletrica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `ambiente`
--
ALTER TABLE `ambiente`
  ADD CONSTRAINT `ambiente_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ambiente_ibfk_2` FOREIGN KEY (`ID_ENDERECO`) REFERENCES `endereco` (`ID`);

--
-- Restrições para tabelas `aparelho`
--
ALTER TABLE `aparelho`
  ADD CONSTRAINT `aparelho_ibfk_1` FOREIGN KEY (`ID_REDE_ELETRICA`) REFERENCES `rede_eletrica` (`ID`) ON DELETE CASCADE;

--
-- Restrições para tabelas `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `cidade` (`ID`);

--
-- Restrições para tabelas `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `cidade_ibfk_1` FOREIGN KEY (`ID_ESTADO`) REFERENCES `estado` (`ID`);

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`ID_BAIRRO`) REFERENCES `bairro` (`ID`);

--
-- Restrições para tabelas `gerador`
--
ALTER TABLE `gerador`
  ADD CONSTRAINT `gerador_ibfk_1` FOREIGN KEY (`ID_REDE_ELETRICA`) REFERENCES `rede_eletrica` (`ID`) ON DELETE CASCADE;

--
-- Restrições para tabelas `rede_eletrica`
--
ALTER TABLE `rede_eletrica`
  ADD CONSTRAINT `rede_eletrica_ibfk_1` FOREIGN KEY (`ID_AMBIENTE`) REFERENCES `ambiente` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
