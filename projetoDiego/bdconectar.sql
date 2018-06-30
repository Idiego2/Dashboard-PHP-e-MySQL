-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Jul-2017 às 17:40
-- Versão do servidor: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdconectar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estacao`
--

CREATE TABLE `estacao` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Extraindo dados da tabela `estacao`
--

INSERT INTO `estacao` (`id`, `nome`) VALUES
(1, 'estação 1'),
(2, 'estação 2'),
(5, 'estação 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabelasensores`
--

CREATE TABLE `tabelasensores` (
  `id` int(11) NOT NULL,
  `evento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `temperatura` float NOT NULL,
  `umidade` float NOT NULL,
  `ph` float NOT NULL,
  `salinidade` float NOT NULL,
  `luminosidade` float NOT NULL,
  `idEstacao` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tabelasensores`
--

INSERT INTO `tabelasensores` (`id`, `evento`, `temperatura`, `umidade`, `ph`, `salinidade`, `luminosidade`, `idEstacao`) VALUES
(23, '2017-07-20 03:00:00', 12.2, 1.2, 4, 32, 14.89, 1),
(24, '2017-07-18 05:12:18', 32, 31.31, 2, 32.43, 32.4235, 2),
(25, '2017-07-20 23:04:18', 12, 21, 32, 42, 33, 1),
(26, '2017-07-03 13:20:04', 12, 3, 23, 42, 53, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`, `email`) VALUES
(1, 'Diego', 'Diego', '123', 'diegomartins_gs@hotmail.com'),
(2, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estacao`
--
ALTER TABLE `estacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabelasensores`
--
ALTER TABLE `tabelasensores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estacao`
--
ALTER TABLE `estacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tabelasensores`
--
ALTER TABLE `tabelasensores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
