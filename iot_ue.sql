-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 29-Jul-2019 às 13:35
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot_ue`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_plantas_usuarios`
--

DROP TABLE IF EXISTS `acesso_plantas_usuarios`;
CREATE TABLE IF NOT EXISTS `acesso_plantas_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_planta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_planta` (`id_planta`) USING BTREE,
  KEY `fk_acesso_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `acesso_plantas_usuarios`
--

INSERT INTO `acesso_plantas_usuarios` (`id`, `id_planta`, `id_usuario`) VALUES
(17, 10, 25),
(18, 6, 25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `monitoramento`
--

DROP TABLE IF EXISTS `monitoramento`;
CREATE TABLE IF NOT EXISTS `monitoramento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` float NOT NULL,
  `data` datetime NOT NULL,
  `id_variavel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_variaveis` (`id_variavel`)
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `monitoramento`
--

INSERT INTO `monitoramento` (`id`, `valor`, `data`, `id_variavel`) VALUES
(443, 10.5, '2019-06-25 08:05:00', 6),
(444, 10.5, '2019-06-25 08:10:00', 6),
(445, 20, '2019-06-25 08:15:00', 6),
(446, 22, '2019-06-25 08:20:00', 6),
(447, 23, '2019-06-25 08:25:00', 6),
(448, 25, '2019-06-25 08:30:00', 6),
(449, 30, '2019-06-25 08:35:00', 6),
(450, 33, '2019-06-25 08:40:00', 6),
(451, 35, '2019-06-25 08:45:00', 6),
(452, 40, '2019-06-25 08:50:00', 6),
(453, 50, '2019-06-25 08:55:00', 6),
(454, 100, '2019-06-25 09:00:00', 6),
(455, 100, '2019-06-25 09:05:00', 6),
(456, 100, '2019-06-24 09:05:00', 6),
(457, 10.5, '2019-06-25 14:37:00', 7),
(458, 20, '2019-06-25 14:38:00', 7),
(459, 10.5, '2019-07-03 09:05:00', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plantas`
--

DROP TABLE IF EXISTS `plantas`;
CREATE TABLE IF NOT EXISTS `plantas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET latin1 NOT NULL,
  `localizacao` varchar(200) CHARACTER SET latin1 NOT NULL,
  `inicio_operacao` varchar(50) CHARACTER SET latin1 NOT NULL,
  `responsavel` varchar(200) CHARACTER SET latin1 NOT NULL,
  `imagem` varchar(200) CHARACTER SET latin1 NOT NULL,
  `codigo_google_maps` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `plantas`
--

INSERT INTO `plantas` (`id`, `nome`, `localizacao`, `inicio_operacao`, `responsavel`, `imagem`, `codigo_google_maps`) VALUES
(6, 'Jardim BotÃ¢nico 1', 'JoÃ£o Pessoa', '2019-06-15', 'JoÃ£o', '15607903215d07c5311faee.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.892371433062!2d-34.848778135680526!3d-7.1384432720005435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7acc2b7aeaa04d1%3A0xf78352c3214e6a1f!2sUniversidade+Federal+da+Para%C3%ADba!5e0!3m2!1spt-BR!2sbr!4v1560625274081!5m2!1spt-BR!2sbr\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>'),
(10, 'UFPB', 'JoÃ£o Pessoa - PB', '2019-07-25', 'Douglas e VinÃ­cius', '15640857875d3a0e1b3a483.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.901703433388!2d-34.84774008568065!3d-7.137364771988785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7acc2b7aeaa04d1%3A0xf78352c3214e6a1f!2sUniversidade+Federal+da+Para%C3%ADba!5e0!3m2!1spt-BR!2sbr!4v1564085770243!5m2!1spt-BR!2sbr\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) NOT NULL,
  `email` varchar(520) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel_acesso` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel_acesso`) VALUES
(11, 'Douglas de Farias Medeiros', 'douglas.medeiros@cear.ufpb.br', 'am9hb3Blc3NvYQ==', 1),
(25, 'JoÃ£o Vitor Holanda de Luna', 'joao.luna@cear.ufpb.br', 'am9hb3Blc3NvYQ==', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `variaveis`
--

DROP TABLE IF EXISTS `variaveis`;
CREATE TABLE IF NOT EXISTS `variaveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `unidade` varchar(50) NOT NULL,
  `id_planta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_planta` (`id_planta`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `variaveis`
--

INSERT INTO `variaveis` (`id`, `nome`, `descricao`, `unidade`, `id_planta`) VALUES
(6, 'temperatura', 'Temperatura do mÃ³dulo FV', 'Â°C', 10),
(7, 'umidade', 'Umidade do ar', 'g/Kg', 10),
(8, 'teste', 'Testando o sistema', 'm/s', 6);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `acesso_plantas_usuarios`
--
ALTER TABLE `acesso_plantas_usuarios`
  ADD CONSTRAINT `fk_acesso_plantas` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_acesso_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `monitoramento`
--
ALTER TABLE `monitoramento`
  ADD CONSTRAINT `fk_variaveis` FOREIGN KEY (`id_variavel`) REFERENCES `variaveis` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `variaveis`
--
ALTER TABLE `variaveis`
  ADD CONSTRAINT `fk_planta` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
