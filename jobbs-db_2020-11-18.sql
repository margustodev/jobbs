-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18-Nov-2020 às 03:47
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jobbs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncio`
--

CREATE TABLE `anuncio` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `ativo` int(11) NOT NULL,
  `fotos_trabalhos` varchar(255) NOT NULL,
  `perfil_profissional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `anuncio`
--

INSERT INTO `anuncio` (`id`, `titulo`, `descricao`, `data_inicio`, `data_fim`, `ativo`, `fotos_trabalhos`, `perfil_profissional`) VALUES
(12, 'Trabalho de Pintura', 'pedreiro', '2020-10-23', NULL, 1, '32', 27),
(13, 'Pedreirando', 'Trabalho duro            ', '2020-10-23', NULL, 1, '123', 27),
(14, 'zecaaa', '            baleirrro', '2020-10-23', NULL, 1, '3232', 27),
(16, 'Trabalho de Gesseiro', 'Tudo de gesso é cmg msm            ', '2020-10-01', NULL, 1, '', 28),
(17, 'Lavar Roupa', '            Sim eu sou limpinho mesmo', '2020-11-16', NULL, 1, '', 27),
(18, 'Faço de tudo e um pouco mais esse é meu titulo', 'Trabalho com pintura a muitos anos', '2020-11-16', NULL, 1, '', 35),
(19, 'Abacate verde', 'suprasumo            ', '2020-11-18', NULL, 1, '', 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`id`, `nome`, `estado`) VALUES
(1, 'Cabo Frio', 'RJ'),
(2, 'São Pedro da Aldeia', 'RJ'),
(3, 'Araruama', 'RJ'),
(4, 'Iguaba', 'RJ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamento`
--

CREATE TABLE `formas_pagamento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formas_pagamento`
--

INSERT INTO `formas_pagamento` (`id`, `descricao`, `ativo`) VALUES
(1, 'Dinheiro', 1),
(2, 'Cartão de Crédito', 1),
(3, 'Cartão de Débito', 1),
(4, 'Cheque', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `foto`
--

INSERT INTO `foto` (`id`, `url`) VALUES
(1, 'https://openthread.google.cn/images/ot-contrib-google.png'),
(2, 'https://img.ibxk.com.br/2012/9/materias/302782016572.jpg?w=1120&h=420&mode=crop&scale=both'),
(3, 'https://www.fazfacil.com.br/wp-content/uploads/2018/09/20180913-poltrona-parede-colorida.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos_trabalhos`
--

CREATE TABLE `fotos_trabalhos` (
  `id` int(11) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `id_foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_has_cidades`
--

CREATE TABLE `perfil_has_cidades` (
  `id` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_cidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil_has_cidades`
--

INSERT INTO `perfil_has_cidades` (`id`, `id_perfil`, `id_cidade`) VALUES
(4, 28, 1),
(5, 28, 1),
(6, 27, 2),
(7, 27, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_has_formas_pagamento`
--

CREATE TABLE `perfil_has_formas_pagamento` (
  `id` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_formas_pagamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil_has_formas_pagamento`
--

INSERT INTO `perfil_has_formas_pagamento` (`id`, `id_perfil`, `id_formas_pagamento`) VALUES
(3, 28, 2),
(4, 28, 1),
(5, 27, 2),
(6, 27, 4),
(7, 27, 1),
(8, 27, 2),
(9, 28, 1),
(10, 28, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_profissional`
--

CREATE TABLE `perfil_profissional` (
  `id` int(11) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `endereco_residencial` varchar(255) DEFAULT NULL,
  `endereco_comercial` varchar(255) DEFAULT NULL,
  `nome_publico` varchar(255) DEFAULT NULL,
  `sobre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `ramo_atividade_id` int(11) DEFAULT NULL,
  `ativo` int(11) NOT NULL,
  `cidade_atuacao` int(11) NOT NULL,
  `formas_pagamento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil_profissional`
--

INSERT INTO `perfil_profissional` (`id`, `cpf`, `data_nascimento`, `telefone`, `endereco_residencial`, `endereco_comercial`, `nome_publico`, `sobre`, `usuario_id`, `ramo_atividade_id`, `ativo`, `cidade_atuacao`, `formas_pagamento`) VALUES
(27, '889898985', '1920-01-01', '655658wq', '', 'trabalho mesmox', 'sanderao97', 'sou muito trabalhadorxaeaeea', 762, 1, 1, 1, 'Array'),
(28, '323', '7887-04-01', '323232', '32', '', '32321231', NULL, 763, 1, 1, 1, ''),
(29, '478787878', '1980-01-01', '22981218303', 'Rua Líbano, lote 1 quadra 30, casa 2', 'Rua Líbano, lote 1 quadra 30, casa 2', '32', NULL, 764, 1, 1, 2, 'Dinheiro'),
(30, '32323232', '1980-01-01', '22981218303', 'Rua Líbano, lote 1 quadra 30, casa 2', 'Rua Líbano, lote 1 quadra 30, casa 2', '32', NULL, 765, 1, 1, 2, 'Cartão de Crédito'),
(31, 'eaeaea', '1980-01-01', '22981218303', 'Rua Líbano, lote 1 quadra 30, casa 2', 'Rua Líbano, lote 1 quadra 30, casa 2', '32', NULL, 766, 1, 1, 2, 'Dinheiro'),
(32, '154545', '1980-01-01', '323232', '3232', '', '323232', NULL, 767, 1, 1, 1, '0'),
(33, '154545', '1980-01-01', '323232', '3232', '', '323232', NULL, 768, 1, 1, 1, '0'),
(34, '445787878', '1990-01-01', '233333eaea', 'eaeaea', 'eaeaeaeaea', 'Joao da Silva', NULL, 769, 2, 1, 4, ' , Dinheiro , Cartão de Débito'),
(35, 'eaeaew', '1980-01-01', '323232', '', '3232', '32', NULL, 770, 2, 1, 3, 'Cartão de Crédito , Dinheiro , ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ramo_atividade`
--

CREATE TABLE `ramo_atividade` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ramo_atividade`
--

INSERT INTO `ramo_atividade` (`id`, `descricao`) VALUES
(1, 'Construção Civil'),
(2, 'Pintura'),
(3, 'Elétrica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto_perfil_id` int(11) DEFAULT NULL,
  `acesso` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `login`, `senha`, `email`, `foto_perfil_id`, `acesso`, `ativo`) VALUES
(1, 'Felipe', 'teste123', 'teste123', 'teste@teste.com', 1, 1, 1),
(762, 'Joao', 'aaa', 'aaa', 'a@a.com', 2, 1, 1),
(763, 'Carlos', '323', '323', 'el@gf.com', NULL, 1, 1),
(764, 'Uba Uba', 'ubauba', 'ubauba', 'Ubaeee@gm.com', NULL, 1, 1),
(765, 'Felipe', '32323', '2323232', 'lipew_cf@ho323232tmail.com', NULL, 1, 1),
(766, 'Felipe', 'eaeaeaea', 'eaea', 'lipew_cf@hotmail.comeaeaea', NULL, 1, 1),
(767, 'Felipe', 'eaeaea', 'eaea', 'eaeea22@DAADDA.COM', NULL, 1, 1),
(768, 'Felipeea', 'eaeaea32', '323', 'eaeea22@DAADDA.COMx', NULL, 1, 1),
(769, 'Ubaubaeea', 'ubaubaeaeaea', 'eaeaea', 'eba@gmail.comeaeaeaea', NULL, 1, 1),
(770, 'Felipe/', '3232', '3232', 'eaeaea@gmail.com', NULL, 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perfil_profissional_fk` (`perfil_profissional`);

--
-- Índices para tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fotos_trabalhos`
--
ALTER TABLE `fotos_trabalhos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anuncio_fk` (`id_anuncio`),
  ADD KEY `id_foto_fk` (`id_foto`);

--
-- Índices para tabela `perfil_has_cidades`
--
ALTER TABLE `perfil_has_cidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cidade` (`id_cidade`),
  ADD KEY `id_perfil` (`id_perfil`);

--
-- Índices para tabela `perfil_has_formas_pagamento`
--
ALTER TABLE `perfil_has_formas_pagamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_formas_pagamento_fk` (`id_formas_pagamento`),
  ADD KEY `id_perfil_fk` (`id_perfil`);

--
-- Índices para tabela `perfil_profissional`
--
ALTER TABLE `perfil_profissional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_fk` (`usuario_id`),
  ADD KEY `ramo_atividade_fk` (`ramo_atividade_id`),
  ADD KEY `cidade_atuacao` (`cidade_atuacao`);

--
-- Índices para tabela `ramo_atividade`
--
ALTER TABLE `ramo_atividade`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_foto_perfil_fk` (`foto_perfil_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fotos_trabalhos`
--
ALTER TABLE `fotos_trabalhos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `perfil_has_cidades`
--
ALTER TABLE `perfil_has_cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `perfil_has_formas_pagamento`
--
ALTER TABLE `perfil_has_formas_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `perfil_profissional`
--
ALTER TABLE `perfil_profissional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `ramo_atividade`
--
ALTER TABLE `ramo_atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=771;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `id_perfil_profissional_fk` FOREIGN KEY (`perfil_profissional`) REFERENCES `perfil_profissional` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `fotos_trabalhos`
--
ALTER TABLE `fotos_trabalhos`
  ADD CONSTRAINT `id_anuncio_fk` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncio` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_foto_fk` FOREIGN KEY (`id_foto`) REFERENCES `foto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `perfil_has_cidades`
--
ALTER TABLE `perfil_has_cidades`
  ADD CONSTRAINT `id_cidade` FOREIGN KEY (`id_cidade`) REFERENCES `cidade` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil_profissional` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `perfil_has_formas_pagamento`
--
ALTER TABLE `perfil_has_formas_pagamento`
  ADD CONSTRAINT `id_formas_pagamento_fk` FOREIGN KEY (`id_formas_pagamento`) REFERENCES `formas_pagamento` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_perfil_fk` FOREIGN KEY (`id_perfil`) REFERENCES `perfil_profissional` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `perfil_profissional`
--
ALTER TABLE `perfil_profissional`
  ADD CONSTRAINT `id_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ramo_atividade_fk` FOREIGN KEY (`ramo_atividade_id`) REFERENCES `ramo_atividade` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `id_foto_perfil_fk` FOREIGN KEY (`foto_perfil_id`) REFERENCES `foto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
