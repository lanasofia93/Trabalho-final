CREATE DATABASE small-phones;

USE small-phones;

--
-- Estrutura da tabela `Atendimento`
--

CREATE TABLE `Atendimento` (
  `ID` int(11) NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `ID_tecnico` int(11) DEFAULT NULL,
  `ID_remetente` int(11) NOT NULL,
  `nome_remetente` varchar(200) DEFAULT NULL,
  `email_remetente` varchar(150) DEFAULT NULL,
  `data_abertura` date DEFAULT NULL,
  `data_prazo` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Aguardando',
  `aceito` tinyint(1) NOT NULL DEFAULT 0,
  `concluido` tinyint(1) NOT NULL DEFAULT 0,
  `descricao` varchar(5000) DEFAULT NULL,
  `endereco` varchar(2000) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Tecnico`
--

CREATE TABLE `Tecnico` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `formacao` varchar(200) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `senha` varchar(2000) DEFAULT NULL,
  `CNPJ` varchar(14) NOT NULL,
  `idade` int(11) NOT NULL,
  `endereco` varchar(2000) NOT NULL,
  `cidade` varchar(200) NOT NULL
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Usuario`
--

CREATE TABLE `Usuario` (
  `ID` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `CPF` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `idade` int(11) NOT NULL,
  `endereco` varchar(1000) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(2000) NOT NULL
);

--
-- Criando chaves primárias
--

ALTER TABLE `Atendimento`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Tecnico`
  ADD PRIMARY KEY (`matricula`);

ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`ID`);
