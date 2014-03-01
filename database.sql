-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2014 at 06:58 AM
-- Server version: 5.1.73-0ubuntu0.10.04.1
-- PHP Version: 5.3.10-1~lucid+2uwsgi2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xmanager0`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `novaMedia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `novaMedia`(IN id_roomr INT,IN roundr INT, OUT ok INT)
BEGIN
        SET ok := 0;

        IF (roundr - 1 > -1) THEN
            SET @roundp = roundr - 1;
            SET @id_roomp = id_roomr;
            
        ELSE
            SELECT @nc := value FROM `Configuracao`
                    WHERE id = 1;

            SET @roundp = -(id_roomr%@nc +1);
            SET @id_roomp = -(id_roomr%@nc +1);

        END IF;

        SELECT @cntmedia := COUNT(id) 
            FROM `Media` 
            WHERE `round` =  roundr AND `id_room` =  id_roomr;

        IF (@cntmedia = 0) THEN
            SELECT @nplayers := COUNT(`id_player`) 
                    FROM `decisions` 
                    WHERE `id_room` = @id_roomp AND `round`= @roundp;
            
            SELECT @mpreco := SUM(`depreco`)/@nplayers,
                   @mprazo := SUM(`deprazo`)/@nplayers,
                   @mpropaganda := SUM(`depropaganda`)/@nplayers,
                   @mPD := SUM(`dePD`)/@nplayers,
                   @mdesconto := SUM(`dedesconto`)/@nplayers 
                   FROM `decisions` 
                   WHERE `id_room` = @id_roomp AND `round`= @roundp;

            INSERT INTO Media(`id_room`, Preco, `Propaganda`, `Prazo`, `PD`, `Desconto`, `round`) 
                   VALUES(id_roomr, 
                   @mpreco, @mpropaganda, @mprazo, @mPD, @mdesconto, 
                   roundr);
        END IF;
   
        SET ok := 1;
   END$$

DROP PROCEDURE IF EXISTS `novoTempo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `novoTempo`(IN ts INT)
BEGIN
        SELECT @mv := value FROM `Configuracao` WHERE id = 7;

        UPDATE `Configuracao` SET value = (30 * ts + 70 * @mv)/100 WHERE id = 7;
        UPDATE `Configuracao` SET value = value + ts WHERE id = 8;
        UPDATE `Configuracao` SET value = value + 1 WHERE id = 9;

        SELECT @tt := value FROM `Configuracao` WHERE id = 8;
        SELECT @nt := value FROM `Configuracao` WHERE id = 9;

        UPDATE `Configuracao` SET value = @tt / @nt WHERE id = 10;
   END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Balanco`
--

DROP TABLE IF EXISTS `Balanco`;
CREATE TABLE IF NOT EXISTS `Balanco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `Maquinas` float DEFAULT NULL,
  `Construcoes predias` float DEFAULT NULL,
  `Terreno` float DEFAULT NULL,
  `Caixa` float DEFAULT NULL,
  `Aplicacoes financeiras` float DEFAULT NULL,
  `Vendas a prazo a receber` float DEFAULT NULL,
  `Estoque materia prima` float DEFAULT NULL,
  `Estoque produto acabado` float DEFAULT NULL,
  `TOTAL DE ATIVOS` float DEFAULT NULL,
  `Emprestimos de longo prazo a pagar` float DEFAULT NULL,
  `Juros de emprestimos de longo prazo a pagar` float DEFAULT NULL,
  `Emprestimo de curto prazo a pagar` float DEFAULT NULL,
  `Juros de emprestimos de curto prazo a pagar` float DEFAULT NULL,
  `TOTAL DE PASSIVOS` float DEFAULT NULL,
  `Capital social` float DEFAULT NULL,
  `Lucros acumulados` float DEFAULT NULL,
  `Patrimonio liquido` float DEFAULT NULL,
  `Valor de venda da empresa` float DEFAULT NULL,
  `Juros vendas a prazo para receber` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `Balanco`
--

INSERT INTO `Balanco` (`id`, `id_player`, `id_room`, `round`, `time`, `Maquinas`, `Construcoes predias`, `Terreno`, `Caixa`, `Aplicacoes financeiras`, `Vendas a prazo a receber`, `Estoque materia prima`, `Estoque produto acabado`, `TOTAL DE ATIVOS`, `Emprestimos de longo prazo a pagar`, `Juros de emprestimos de longo prazo a pagar`, `Emprestimo de curto prazo a pagar`, `Juros de emprestimos de curto prazo a pagar`, `TOTAL DE PASSIVOS`, `Capital social`, `Lucros acumulados`, `Patrimonio liquido`, `Valor de venda da empresa`, `Juros vendas a prazo para receber`) VALUES
(-3, -3, -3, -3, -3, 596667, 398333, 50000, 582633, 2751, 118375, 39242, 0, 1.778e+06, 0, 0, 0, 0, 0, 2e+06, -45048, 1.95495e+06, 1.66284e+06, 0),
(-2, -2, -2, -2, -2, 295000, 398333, 50000, 241281, 449, 0, 64746, 0, 1.04981e+06, 0, 0, 0, 0, 0, 1e+06, 65614, 1.06561e+06, 1.00782e+06, 0),
(-1, -1, -1, -1, -1, 421458, 497917, 100000, 523710, 439, 0, 37580, 0, 1.5811e+06, 0, 0, 0, 0, 0, 1.3e+06, 328085, 1.62808e+06, 1.50205e+06, 0),
(131, 56, 68, 0, 1393667827, 2.91792e+06, 495834, 100000, -2.42818e+06, 0, 161641, 7120, 0, 1.25433e+06, 100, 2.5, 2.03229e+06, 162584, 2.19498e+06, 1.3e+06, 31147.4, 1.33115e+06, 1.03706e+06, 964.062);

-- --------------------------------------------------------

--
-- Table structure for table `Configuracao`
--

DROP TABLE IF EXISTS `Configuracao`;
CREATE TABLE IF NOT EXISTS `Configuracao` (
  `id` int(11) NOT NULL,
  `key` varchar(20) NOT NULL,
  `value` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Configuracao`
--

INSERT INTO `Configuracao` (`id`, `key`, `value`) VALUES
(1, 'NumCenarios', 3),
(2, 'myroomroundduration', 300),
(4, 'myroomnrounds', 6),
(5, 'myroomweight', 40),
(6, 'myroomnslots', 10),
(7, 'maxtimepagegen', 42),
(8, 'totaltimepagegen', 46850),
(9, 'npagegen', 204),
(10, 'avetimepagegen', 339);

-- --------------------------------------------------------

--
-- Table structure for table `Dados para tomada de decisao`
--

DROP TABLE IF EXISTS `Dados para tomada de decisao`;
CREATE TABLE IF NOT EXISTS `Dados para tomada de decisao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `Quantidade produzida` float DEFAULT NULL,
  `Quantidade vendida` float DEFAULT NULL,
  `Interesses nao atendidos` float DEFAULT NULL,
  `Estoque inicial de produtos acabados` float DEFAULT NULL,
  `Estoque final de produtos acabados` float DEFAULT NULL,
  `Materia prima disponivel` float DEFAULT NULL,
  `Maquinas disponiveis` float DEFAULT NULL,
  `Eficiencia das maquinas` float DEFAULT NULL,
  `Eficiencia dos operarios` float DEFAULT NULL,
  `Salario dos operarios` float DEFAULT NULL,
  `PD acumulado` int(11) NOT NULL,
  `Potencial ELP` float NOT NULL,
  `Engenheiro` int(11) NOT NULL,
  `Secretaria` int(11) NOT NULL,
  `Administrador` int(11) NOT NULL,
  `Vendedor` int(11) NOT NULL,
  `Estagiarios` int(11) NOT NULL,
  `Supervisor` int(11) NOT NULL,
  `Operarios` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `Dados para tomada de decisao`
--

INSERT INTO `Dados para tomada de decisao` (`id`, `id_player`, `id_room`, `round`, `time`, `Quantidade produzida`, `Quantidade vendida`, `Interesses nao atendidos`, `Estoque inicial de produtos acabados`, `Estoque final de produtos acabados`, `Materia prima disponivel`, `Maquinas disponiveis`, `Eficiencia das maquinas`, `Eficiencia dos operarios`, `Salario dos operarios`, `PD acumulado`, `Potencial ELP`, `Engenheiro`, `Secretaria`, `Administrador`, `Vendedor`, `Estagiarios`, `Supervisor`, `Operarios`) VALUES
(-3, -3, -3, -3, -3, 2697, 2697, 270, 0, 0, 2803, 20, 90.47, 100, 622, 30000, 1.33027e+06, 2, 2, 2, 1, 0, 1, 200),
(-2, -2, -2, -2, -2, 701, 701, 70, 0, 0, 1199, 10, 99.45, 100, 622, 2000, 806253, 0, 0, 0, 0, 0, 2, 160),
(-1, -1, -1, -1, -1, 1621, 1621, 52, 0, 0, 1879, 17, 99.01, 100, 622, 1000, 1.20164e+06, 1, 2, 1, 1, 0, 1, 85),
(129, 56, 68, 0, 1393667827, 1623, 1623, 162.3, 0, 0, 356, 117, 100, 100.1, 628.22, 1100, 829548, 0, 0, 0, 0, 0, 1, 85);

-- --------------------------------------------------------

--
-- Table structure for table `decisions`
--

DROP TABLE IF EXISTS `decisions`;
CREATE TABLE IF NOT EXISTS `decisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `demateriaPrima` int(11) NOT NULL,
  `demaquinas` int(11) NOT NULL,
  `dehmmaquinas` int(11) NOT NULL,
  `denturnos` int(11) NOT NULL,
  `deHoraExtra` int(11) NOT NULL,
  `dePD` int(11) NOT NULL,
  `depreco` int(11) NOT NULL,
  `dedesconto` int(11) NOT NULL,
  `deprazo` int(11) NOT NULL,
  `depropaganda` int(11) NOT NULL,
  `deelp` int(11) NOT NULL,
  `deengenheiro` int(11) NOT NULL,
  `deadministrador` int(11) NOT NULL,
  `desecretaria` int(11) NOT NULL,
  `deestagiarios` int(11) NOT NULL,
  `devendedor` int(11) NOT NULL,
  `desalarioOperario` int(11) NOT NULL,
  `salvarDecisao` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=168 ;

--
-- Dumping data for table `decisions`
--

INSERT INTO `decisions` (`id`, `id_player`, `id_room`, `round`, `time`, `demateriaPrima`, `demaquinas`, `dehmmaquinas`, `denturnos`, `deHoraExtra`, `dePD`, `depreco`, `dedesconto`, `deprazo`, `depropaganda`, `deelp`, `deengenheiro`, `deadministrador`, `desecretaria`, `deestagiarios`, `devendedor`, `desalarioOperario`, `salvarDecisao`) VALUES
(-3, -3, -3, -3, -3, 2500, 0, 6, 1, 0, 30000, 435, 0, 0, 130000, 0, 2, 2, 2, 0, 1, 0, 0),
(-2, -2, -2, -2, -2, 1000, 0, 4, 2, 0, 2000, 650, 0, 0, 2000, 0, 0, 0, 0, 0, 0, 0, 0),
(-1, -1, -1, -1, -1, 1800, 0, 4, 1, 0, 1000, 500, 0, 0, 10000, 0, 1, 1, 2, 0, 1, 0, 0),
(167, 56, 68, 0, 1393667827, 100, 100, 100, 1, 0, 100, 100, 1, 100, 100, 100, 0, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Demonstrativo de Resultados`
--

DROP TABLE IF EXISTS `Demonstrativo de Resultados`;
CREATE TABLE IF NOT EXISTS `Demonstrativo de Resultados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `Receita de vendas` float DEFAULT NULL,
  `Aplicacoes financeiras` float DEFAULT NULL,
  `Venda de maquinas` float DEFAULT NULL,
  `Juros sobre vendas a prazo` float DEFAULT NULL,
  `Compra de materia prima` float DEFAULT NULL,
  `Compra de maquinas` float DEFAULT NULL,
  `Operacao de maquinas` float DEFAULT NULL,
  `Manutencao` float DEFAULT NULL,
  `Salario de operarios` float DEFAULT NULL,
  `Salarios administrativos` float DEFAULT NULL,
  `Contratacao` float DEFAULT NULL,
  `Demissao` float DEFAULT NULL,
  `Propaganda` float DEFAULT NULL,
  `P&D` float DEFAULT NULL,
  `Depreciacao das maquinas` float DEFAULT NULL,
  `Depreciacao predial` float DEFAULT NULL,
  `Comissoes` float DEFAULT NULL,
  `Estoque` float DEFAULT NULL,
  `Juros sobre emprestimos` float DEFAULT NULL,
  `Gastos gerais` float DEFAULT NULL,
  `Resultado bruto` float DEFAULT NULL,
  `Impostos totais sobre vendas` float DEFAULT NULL,
  `Lucro/prejuizo` float DEFAULT NULL,
  `Depreciacao Maquinas Acumulada` float NOT NULL,
  `Depreciacao Predial Acumulada` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `Demonstrativo de Resultados`
--

INSERT INTO `Demonstrativo de Resultados` (`id`, `id_player`, `id_room`, `round`, `time`, `Receita de vendas`, `Aplicacoes financeiras`, `Venda de maquinas`, `Juros sobre vendas a prazo`, `Compra de materia prima`, `Compra de maquinas`, `Operacao de maquinas`, `Manutencao`, `Salario de operarios`, `Salarios administrativos`, `Contratacao`, `Demissao`, `Propaganda`, `P&D`, `Depreciacao das maquinas`, `Depreciacao predial`, `Comissoes`, `Estoque`, `Juros sobre emprestimos`, `Gastos gerais`, `Resultado bruto`, `Impostos totais sobre vendas`, `Lucro/prejuizo`, `Depreciacao Maquinas Acumulada`, `Depreciacao Predial Acumulada`) VALUES
(-3, -3, -3, -3, -3, 1.1732e+06, 2751, 0, 0, 175000, 0, 192533, 12000, 124400, 11818, 0, 0, 130000, 30000, 3333, 1667, 2346, 280, 0, 68338, 424230, 469278, -45048, 3333, 1667),
(-2, -2, -2, -2, -2, 455650, 449, 0, 0, 90000, 0, 10433, 200, 99520, 19406, 0, 0, 1960, 2000, 5000, 1667, 456, 600, 0, 22548, 202309, 136695, 65614, 5000, 1667),
(-1, -1, -1, -1, -1, 810500, 439, 0, 0, 90000, 0, 11741, 1360, 52870, 14306, 0, 0, 9900, 1000, 3542, 2083, 1621, 188, 0, 18673, 603655, 275570, 328085, 3542, 2083),
(129, 56, 68, 0, 1393667827, 160677, 0, 0, 0, 5000, 0, 11741.4, 34000, 53398.7, 16918, 1443, 15363.4, 98, 100, 3541.67, 2083.33, 160.677, 35.6, 0, 259101, -242307, 54630.2, -296938, 7083.67, 4166.33);

-- --------------------------------------------------------

--
-- Table structure for table `Emprestimos longo prazo`
--

DROP TABLE IF EXISTS `Emprestimos longo prazo`;
CREATE TABLE IF NOT EXISTS `Emprestimos longo prazo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `Acumulado` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `Emprestimos longo prazo`
--

INSERT INTO `Emprestimos longo prazo` (`id`, `id_player`, `id_room`, `round`, `time`, `Acumulado`) VALUES
(-3, -3, -3, -3, -3, 0),
(-2, -2, -2, -2, -2, 0),
(-1, -1, -1, -1, -1, 0),
(129, 56, 68, 0, 1393667827, 100);

-- --------------------------------------------------------

--
-- Table structure for table `Fluxo de caixa`
--

DROP TABLE IF EXISTS `Fluxo de caixa`;
CREATE TABLE IF NOT EXISTS `Fluxo de caixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `Receita de vendas` float DEFAULT NULL,
  `Aplicacoes financeiras` float DEFAULT NULL,
  `Venda de maquinas` float DEFAULT NULL,
  `Vendas a prazo` float DEFAULT NULL,
  `Emprestimo de longo prazo` float DEFAULT NULL,
  `Compra de materia prima` float DEFAULT NULL,
  `Compra de maquinas` float DEFAULT NULL,
  `Operacao de maquinas` float DEFAULT NULL,
  `Manutencao` float DEFAULT NULL,
  `Salario de operarios` float DEFAULT NULL,
  `Salarios administrativos` float DEFAULT NULL,
  `Contratacao` float DEFAULT NULL,
  `Demissao` float DEFAULT NULL,
  `Propaganda` float DEFAULT NULL,
  `P&D` float DEFAULT NULL,
  `Comissoes` float DEFAULT NULL,
  `Estoque` float DEFAULT NULL,
  `Juros sobre emprestimos` float DEFAULT NULL,
  `Gastos gerais` float DEFAULT NULL,
  `Parcelas dos emprestimos` float DEFAULT NULL,
  `Impostos totais sobre vendas` float DEFAULT NULL,
  `Variacao do caixa` float DEFAULT NULL,
  `Caixa inicial` float DEFAULT NULL,
  `Caixa final` float DEFAULT NULL,
  `Movimentacao de caixa` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `Fluxo de caixa`
--

INSERT INTO `Fluxo de caixa` (`id`, `id_player`, `id_room`, `round`, `time`, `Receita de vendas`, `Aplicacoes financeiras`, `Venda de maquinas`, `Vendas a prazo`, `Emprestimo de longo prazo`, `Compra de materia prima`, `Compra de maquinas`, `Operacao de maquinas`, `Manutencao`, `Salario de operarios`, `Salarios administrativos`, `Contratacao`, `Demissao`, `Propaganda`, `P&D`, `Comissoes`, `Estoque`, `Juros sobre emprestimos`, `Gastos gerais`, `Parcelas dos emprestimos`, `Impostos totais sobre vendas`, `Variacao do caixa`, `Caixa inicial`, `Caixa final`, `Movimentacao de caixa`) VALUES
(-3, -3, -3, -3, -3, 1.05588e+06, 2751, 0, 0, 0, 175000, 0, 192533, 12000, 124400, 11818, 0, 0, 130000, 30000, 2346, 280, 0, 68338, 0, 469278, -157367, 740000, 582633, 347000),
(-2, -2, -2, -2, -2, 455650, 449, 0, 0, 0, 90000, 0, 10433, 200, 99520, 19406, 0, 0, 1960, 2000, 456, 600, 0, 22548, 0, 136695, 72281, 169000, 241281, 94160),
(-1, -1, -1, -1, -1, 810500, 439, 0, 0, 0, 90000, 0, 11741, 1360, 52870, 14306, 0, 0, 9900, 1000, 1621, 188, 0, 18673, 0, 275570, 333710, 190000, 523710, 102260),
(122, 56, 68, 0, 1393667827, 0, 0, 0, 0, 100, 5000, 2.5e+06, 11741.4, 34000, 53398.7, 16918, 1443, 15363.4, 98, 100, 160.677, 35.6, 0, 259101, 0, 54630.2, -2.95189e+06, 523710, -2.42818e+06, 2.556e+06);

-- --------------------------------------------------------

--
-- Table structure for table `Informacoes`
--

DROP TABLE IF EXISTS `Informacoes`;
CREATE TABLE IF NOT EXISTS `Informacoes` (
  `id` int(11) NOT NULL,
  `Peso Preco` float NOT NULL,
  `Peso Prazo` float NOT NULL,
  `Peso Propaganda` float NOT NULL,
  `Peso PD` float NOT NULL,
  `Valor do terreno` float NOT NULL,
  `Valor da materia-prima no estoque` float NOT NULL,
  `Valor da materia-prima` float NOT NULL,
  `Valor do produto acabado` float NOT NULL,
  `Capital social` float NOT NULL,
  `Operarios por maquina` float NOT NULL,
  `Tempo de fabricacao (horas)` float NOT NULL,
  `Valor da maquina nova` float NOT NULL,
  `Vida util das maquinas` float NOT NULL,
  `Valor da sucata` float NOT NULL,
  `Valor inicial dos predios` float NOT NULL,
  `Parcela minima` float NOT NULL,
  `Perda de eficiencia mensal das maquinas` float NOT NULL,
  `Materia Prima necessaria` float NOT NULL,
  `Custo por hora de fabricacao` float NOT NULL,
  `Custo fixo mensal` float NOT NULL,
  `Custo por hora de manutencao` float NOT NULL,
  `Custo de armanezamento do produto acabado` float NOT NULL,
  `Custo de armanezamento da materia-prima` float NOT NULL,
  `Engenheiro A` float NOT NULL,
  `Engenheiro B` float NOT NULL,
  `Engenheiro C` float NOT NULL,
  `Administrador A` float NOT NULL,
  `Administrador B` float NOT NULL,
  `Administrador C` float NOT NULL,
  `Secretaria A` float NOT NULL,
  `Secretaria B` float NOT NULL,
  `Secretaria C` float NOT NULL,
  `Vendedor A` float NOT NULL,
  `Vendedor B` float NOT NULL,
  `Estagiario de engenharia` float NOT NULL,
  `Operario` float NOT NULL,
  `Supervisor de turno` float NOT NULL,
  `Salario minimo` float NOT NULL,
  `EF Engenheiro A` float NOT NULL,
  `EF Engenheiro B` float NOT NULL,
  `EF Engenheiro C` float NOT NULL,
  `EF Administrador A` float NOT NULL,
  `EF Administrador B` float NOT NULL,
  `EF Administrador C` float NOT NULL,
  `EF Secretaria A` float NOT NULL,
  `EF Secretaria B` float NOT NULL,
  `EF Secretaria C` float NOT NULL,
  `EF Vendedor A` float NOT NULL,
  `EF Vendedor B` float NOT NULL,
  `EF Estagiario de engenharia` float NOT NULL,
  `EF Operario` float NOT NULL,
  `Taxa de amortizacao` float NOT NULL,
  `Valor da hora extra` float NOT NULL,
  `Potencial de emprestimo de longo prazo` float NOT NULL,
  `Taxa de demissao` float NOT NULL,
  `Taxa de contratacao` float NOT NULL,
  `Imposto totais de venda` float NOT NULL,
  `Desvalorizacao da empresa na hora da venda` float NOT NULL,
  `Taxa Selic` float NOT NULL,
  `Taxa de juros da poupanca` float NOT NULL,
  `Juros de curto prazo` float NOT NULL,
  `Taxa de juros dos emprestimos de longo prazo` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Informacoes`
--

INSERT INTO `Informacoes` (`id`, `Peso Preco`, `Peso Prazo`, `Peso Propaganda`, `Peso PD`, `Valor do terreno`, `Valor da materia-prima no estoque`, `Valor da materia-prima`, `Valor do produto acabado`, `Capital social`, `Operarios por maquina`, `Tempo de fabricacao (horas)`, `Valor da maquina nova`, `Vida util das maquinas`, `Valor da sucata`, `Valor inicial dos predios`, `Parcela minima`, `Perda de eficiencia mensal das maquinas`, `Materia Prima necessaria`, `Custo por hora de fabricacao`, `Custo fixo mensal`, `Custo por hora de manutencao`, `Custo de armanezamento do produto acabado`, `Custo de armanezamento da materia-prima`, `Engenheiro A`, `Engenheiro B`, `Engenheiro C`, `Administrador A`, `Administrador B`, `Administrador C`, `Secretaria A`, `Secretaria B`, `Secretaria C`, `Vendedor A`, `Vendedor B`, `Estagiario de engenharia`, `Operario`, `Supervisor de turno`, `Salario minimo`, `EF Engenheiro A`, `EF Engenheiro B`, `EF Engenheiro C`, `EF Administrador A`, `EF Administrador B`, `EF Administrador C`, `EF Secretaria A`, `EF Secretaria B`, `EF Secretaria C`, `EF Vendedor A`, `EF Vendedor B`, `EF Estagiario de engenharia`, `EF Operario`, `Taxa de amortizacao`, `Valor da hora extra`, `Potencial de emprestimo de longo prazo`, `Taxa de demissao`, `Taxa de contratacao`, `Imposto totais de venda`, `Desvalorizacao da empresa na hora da venda`, `Taxa Selic`, `Taxa de juros da poupanca`, `Juros de curto prazo`, `Taxa de juros dos emprestimos de longo prazo`) VALUES
(-3, 0.23, 0.85, 0.7, 0.9, 50000, 20, 70, 255, 2e+06, 10, 1.4, 30000, 15, 2000, 400000, 10000, 15, 1, 40, 2000, 100, 0.5, 0.1, 5598, 4976, 3732, 5598, 4976, 3732, 746, 684, 622, 2488, 1244, 809, 622, 2488, 622, 101, 100, 99, 98, 99, 100, 100, 100, 100, 0.1, 0.2, 101, 100, 25, 150, 80, 130, 10, 40, 7, 0.9, 0.7, 10, 2),
(-2, 0.18, 0.8, 0.95, 0.58, 50000, 60, 90, 300, 1e+06, 8, 5, 30000, 5, 5000, 400000, 10000, 2, 1, 2, 350, 5, 3, 0.5, 5598, 4976, 3732, 5598, 4976, 3732, 746, 684, 622, 2488, 1244, 809, 622, 2488, 622, 101, 100, 99, 98, 99, 100, 100, 100, 100, 0.1, 0.2, 101, 100, 25, 150, 80, 130, 10, 30, 4, 0.7, 0.6, 6, 1),
(-1, 0.2, 1, 1, 0.6, 100000, 40, 50, 150, 1.3e+06, 5, 2, 25000, 10, 2500, 500000, 10000, 4, 1, 1, 500, 20, 1, 0.1, 5598, 4976, 3732, 5598, 4976, 3732, 746, 684, 622, 2488, 1244, 809, 622, 2488, 622, 101, 100, 99, 98, 99, 100, 100, 100, 100, 0.1, 0.2, 101, 100, 25, 150, 80, 130, 10, 34, 5, 0.6, 0.5, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loginLogs`
--

DROP TABLE IF EXISTS `loginLogs`;
CREATE TABLE IF NOT EXISTS `loginLogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL,
  `IP` varchar(30) NOT NULL,
  `id_player` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2316 ;

--
-- Dumping data for table `loginLogs`
--

INSERT INTO `loginLogs` (`id`, `time`, `IP`, `id_player`) VALUES
(2312, 1393664205, '187.54.176.28', 557),
(2313, 1393664301, '187.54.176.28', 557),
(2314, 1393666559, '187.54.176.28', 56),
(2315, 1393666728, '187.54.176.28', 56);

-- --------------------------------------------------------

--
-- Table structure for table `Media`
--

DROP TABLE IF EXISTS `Media`;
CREATE TABLE IF NOT EXISTS `Media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_room` int(11) NOT NULL,
  `Preco` float NOT NULL,
  `Propaganda` float NOT NULL,
  `Prazo` float NOT NULL,
  `PD` float NOT NULL,
  `Desconto` float NOT NULL,
  `round` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `Media`
--

INSERT INTO `Media` (`id`, `id_room`, `Preco`, `Propaganda`, `Prazo`, `PD`, `Desconto`, `round`) VALUES
(16, 68, 435, 130000, 0, 30000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
CREATE TABLE IF NOT EXISTS `noticias` (
  `Titulo` text NOT NULL,
  `Texto` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `noticias`
--

INSERT INTO `noticias` (`Titulo`, `Texto`, `id`) VALUES
('21/11/2012 - Fase inicial de teste', 'O <b>X-Manager</b> encontra-se em fase inicial de teste. Aguarde a libera&ccedil;&atilde;o do Beta para fazer parte do novo modelo de simula&ccedil;&atilde;o empresarial do Brasil.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Parceiros`
--

DROP TABLE IF EXISTS `Parceiros`;
CREATE TABLE IF NOT EXISTS `Parceiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` text COLLATE utf8_bin NOT NULL,
  `Caminho para a imagem` text CHARACTER SET latin1 NOT NULL,
  `Caminho para o site ou pagina` text CHARACTER SET latin1 NOT NULL,
  `Tamanho` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_room` int(11) DEFAULT NULL,
  `id_player` int(11) DEFAULT NULL,
  `pontuation` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `id_room`, `id_player`, `pontuation`) VALUES
(121, 67, 56, 0),
(122, 68, 56, 1.03706e+06);

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

DROP TABLE IF EXISTS `ranking`;
CREATE TABLE IF NOT EXISTS `ranking` (
  `id` int(11) NOT NULL,
  `rating` float DEFAULT NULL,
  `id_player` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ranking sala`
--

DROP TABLE IF EXISTS `Ranking sala`;
CREATE TABLE IF NOT EXISTS `Ranking sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `pontuation` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_player` (`id_player`),
  KEY `id_room` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `Ranking sala`
--

INSERT INTO `Ranking sala` (`id`, `id_player`, `id_room`, `round`, `time`, `pontuation`) VALUES
(126, 56, 68, 0, 1393667827, 1.03706e+06);

-- --------------------------------------------------------

--
-- Table structure for table `relatorioLogs`
--

DROP TABLE IF EXISTS `relatorioLogs`;
CREATE TABLE IF NOT EXISTS `relatorioLogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player` int(11) NOT NULL,
  `IP` varchar(30) NOT NULL,
  `round` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=825 ;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `slots` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `nrounds` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `id_owner` int(11) NOT NULL,
  `time_init` int(11) NOT NULL,
  `round_duration` int(11) NOT NULL,
  `current_round` int(11) NOT NULL,
  `seed` int(11) NOT NULL,
  `Tipo cenario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `slots`, `status`, `nrounds`, `weight`, `id_owner`, `time_init`, `round_duration`, `current_round`, `seed`, `Tipo cenario`) VALUES
(-3, 'default3', 0, 0, 0, 0, 0, 0, 0, 0, 123456, 0),
(-2, 'default2', 0, 0, 0, 0, 0, 0, 0, 0, 357891, 0),
(-1, 'default1', 0, 0, 0, 0, 0, 0, 0, 0, 741523, 0),
(67, 'teste', 9, 1, 4, 10, 56, 1393667606, 3600, 0, 1393667606, 3),
(68, 'teste2', 9, 1, 4, 10, 56, 1393667659, 3600, 0, 1393667659, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `privilege` tinyint(4) DEFAULT NULL,
  `pwd` varchar(50) NOT NULL,
  `capital` float NOT NULL,
  `rating` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `privilege`, `pwd`, `capital`, `rating`) VALUES
(-3, 'default3', 0, '0', 0, 0),
(-2, 'default2', 0, '0', 0, 0),
(-1, 'default1', 0, '0', 0, 0),
(53, 'pmachado', 0, 'db1064039c59e94bb5a28a51024dccd7', -8754, 0),
(55, 'hug', 0, '5f662630391136de17f4705bb35be788', 25061, 57),
(56, 'gogo40', 1, 'db1064039c59e94bb5a28a51024dccd7', 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Balanco`
--
ALTER TABLE `Balanco`
  ADD CONSTRAINT `Balanco_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Balanco_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Dados para tomada de decisao`
--
ALTER TABLE `Dados para tomada de decisao`
  ADD CONSTRAINT `Dados@0020para@0020tomada@0020de@0020decisao_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Dados@0020para@0020tomada@0020de@0020decisao_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `decisions`
--
ALTER TABLE `decisions`
  ADD CONSTRAINT `decisions_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `decisions_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Demonstrativo de Resultados`
--
ALTER TABLE `Demonstrativo de Resultados`
  ADD CONSTRAINT `Demonstrativo@0020de@0020Resultados_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Demonstrativo@0020de@0020Resultados_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Emprestimos longo prazo`
--
ALTER TABLE `Emprestimos longo prazo`
  ADD CONSTRAINT `Emprestimos@0020longo@0020prazo_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Emprestimos@0020longo@0020prazo_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Fluxo de caixa`
--
ALTER TABLE `Fluxo de caixa`
  ADD CONSTRAINT `Fluxo@0020de@0020caixa_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fluxo@0020de@0020caixa_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Informacoes`
--
ALTER TABLE `Informacoes`
  ADD CONSTRAINT `Informacoes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Media`
--
ALTER TABLE `Media`
  ADD CONSTRAINT `Media_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ranking sala`
--
ALTER TABLE `Ranking sala`
  ADD CONSTRAINT `Ranking@0020sala_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ranking@0020sala_ibfk_1` FOREIGN KEY (`id_player`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
