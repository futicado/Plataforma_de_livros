-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jun-2022 às 06:46
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `plataforma`
--
CREATE DATABASE IF NOT EXISTS `plataforma` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `plataforma`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblivro`
--

CREATE TABLE `tblivro` (
  `Pkcodliv` int(11) NOT NULL,
  `Nomeliv` varchar(60) NOT NULL,
  `Anoliv` date NOT NULL,
  `Emailliv` varchar(30) NOT NULL,
  `Autorliv` varchar(30) NOT NULL,
  `Isbnliv` varchar(60) DEFAULT NULL,
  `Generoliv` varchar(30) NOT NULL,
  `Descricaoliv` varchar(600) NOT NULL,
  `FKcodusuario` int(11) NOT NULL,
  `Statusliv` varchar(30) NOT NULL,
  `Pathliv` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tblivro`
--

INSERT INTO `tblivro` (`Pkcodliv`, `Nomeliv`, `Anoliv`, `Emailliv`, `Autorliv`, `Isbnliv`, `Generoliv`, `Descricaoliv`, `FKcodusuario`, `Statusliv`, `Pathliv`) VALUES
(36, 'Harry Potter', '2022-05-17', 'futicado123@gmail.com', 'J. K. Rowling', NULL, 'Fantasia', 'Harry Potter é um garoto órfão que vive infeliz com seus tios, os Dursleys. Ele recebe uma carta contendo um convite para ingressar em Hogwarts, uma famosa escola especializada em formar jovens bruxos. Inicialmente, Harry é impedido de ler a carta por seu tio, mas logo recebe a visita de Hagrid, o guarda-caça de Hogwarts, que chega para levá-lo até a escola. Harry adentra um mundo mágico que jamais imaginara, vivendo diversas aventuras com seus novos amigos, Rony Weasley e Hermione Granger.', 1, 'Doação', 'public/img/61jgm6ooXzL.jpg'),
(37, 'O Ladrão de raios', '2005-01-30', 'jhonatam.mattoss@hotmail.com', 'Rick Riordan', NULL, 'Fantasia', 'The Lightning Thief é o primeiro livro da série Percy Jackson & os Olimpianos baseado na mitologia grega, escrito por Rick Riordan., que narra a vida do adolescente Percy Jackson que descobre ser um semideus, filho de Poseidon com uma humana.', 1, 'Troca', 'public/img/YAkrUMESrZanXjUFLSvf87RPmDlWFj7n0v0t7imT.jpg'),
(43, 'Harry Potter Harry Potter E O Prisioneiro De Azkaban', '2020-01-30', 'tr6yurt@fdsfdsf', 'J. K. Rowling', NULL, 'Fantasia', 'Mais uma vez suas férias na rua dos Alfeneiros, 4 foram tristes e solitárias. Tio Válter Dursley estava especialmente irritado com ele, porque seu amigo Rony Weasley tinha lhe telefonado. E ele não aceitava qualquer ligação de Harry com o mundo dos mágicos dentro de sua casa. A situação piorou ainda mais com a chegada de tia Guida, irmã de Válter. Harry já estava acostumado a ser humilhado pelos Dursley, mas quando tia Guida passou a ofender os pais de Harry, mortos pelo bruxo Voldemort, ele não aguentou e transformou-a num imenso balão. Irritado, fugiu da casa dos tios;', 1, 'Doação', 'public/img/38KZiin0hgkgqfp9Uv42C1DDnjXbdyYB64HP97Rk.jpg'),
(44, 'Crepúsculo', '2008-01-30', 'jessica_jcrb94@hotmail.com', 'Stephenie Meyer', NULL, 'Fantasia', 'Isabella Swan chega à nublada e chuvosa cidadezinha de Forks - último lugar onde gostaria de viver. Tenta se adaptar à vida provinciana na qual aparentemente todos se conhecem, lidar com sua constrangedora falta de coordenação motora e se habituar a morar com um pai com quem nunca conviveu. Em seu destino está Edward Cullen.\r\n\r\nLindo, perfeito, misterioso ele é à primeira vista, hostil à presença de Bella - o que provoca nela uma inquietação desconcertante. Ela se apaixona. Ele, no melhor estilo \"amor proibido\", alerta: Sou um risco para você. Ela é uma garota incomum. Ele é um vampiro.', 1, 'Troca', 'public/img/nXvLdbQTQEs2sL11wXoB1y39t2kGnPbI27FZaPfF.jpg'),
(50, 'hardsds', '2022-05-11', 'yuiuyiuyiik@fgtfhgfhghfg', 'kjhkhjkjhk', NULL, 'Guias & Como fazer ', 'lkçlççllç', 1, 'Doação', 'public/img/wpA45gxtUjQ8Hm7i69R3S2g0JLkkIZBZaRQgPx6j.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `Pkcodu` int(11) NOT NULL,
  `Nomeu` varchar(30) NOT NULL,
  `emailu` varchar(30) NOT NULL,
  `senhau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tblivro`
--
ALTER TABLE `tblivro`
  ADD PRIMARY KEY (`Pkcodliv`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tblivro`
--
ALTER TABLE `tblivro`
  MODIFY `Pkcodliv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;
