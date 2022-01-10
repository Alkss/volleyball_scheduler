-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21-Dez-2021 às 14:39
-- Versão do servidor: 10.5.12-MariaDB-cll-lve
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u973673548_volley`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `available_days`
--

CREATE TABLE `available_days` (
                                  `id` int(11) NOT NULL,
                                  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `available_days`
--

INSERT INTO `available_days` (`id`, `code`, `name`) VALUES
                                                        (1, 'SUN', 'Sunday'),
                                                        (2, 'MON', 'Monday'),
                                                        (3, 'TUE', 'Tuesday'),
                                                        (4, 'WED', 'Wednesday'),
                                                        (5, 'THU', 'Thursday'),
                                                        (6, 'FRI', 'Friday'),
                                                        (7, 'SAT', 'Saturday');

-- --------------------------------------------------------

--
-- Estrutura da tabela `court`
--

CREATE TABLE `court` (
                         `id` int(11) NOT NULL,
                         `day` int(11) NOT NULL,
                         `players` int(11) DEFAULT NULL,
                         `datetime` datetime NOT NULL,
                         `isOpen` tinyint(1) NOT NULL DEFAULT 0,
                         `isScheduled` tinyint(1) NOT NULL DEFAULT 0,
                         `scheduleDatetime` datetime DEFAULT NULL,
                         `max_Players` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `court`
--

INSERT INTO `court` (`id`, `day`, `players`, `datetime`, `isOpen`, `isScheduled`, `scheduleDatetime`, `max_Players`) VALUES
                                                                                                                         (9, 2, NULL, '0001-12-23 19:00:00', 1, 0, '0000-00-00 00:00:00', 14),
                                                                                                                         (10, 2, NULL, '2021-12-23 19:00:00', 1, 0, '0000-00-00 00:00:00', 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `day`
--

CREATE TABLE `day` (
                       `id` int(11) NOT NULL,
                       `owner` int(11) NOT NULL,
                       `matchDay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `day`
--

INSERT INTO `day` (`id`, `owner`, `matchDay`) VALUES
                                                  (1, 1, 1),
                                                  (2, 1, 5),
                                                  (3, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `day_user`
--

CREATE TABLE `day_user` (
                            `id` int(11) NOT NULL,
                            `day` int(11) NOT NULL,
                            `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `players`
--

CREATE TABLE `players` (
                           `id` int(11) NOT NULL,
                           `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `isRemoved` tinyint(1) NOT NULL DEFAULT 0,
                           `isWaitingList` tinyint(1) NOT NULL DEFAULT 0,
                           `removedBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `datetime_inserted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `players`
--

INSERT INTO `players` (`id`, `name`, `isRemoved`, `isWaitingList`, `removedBy`, `datetime_inserted`) VALUES
                                                                                                         (1, 'Alex', 0, 0, NULL, '2021-12-21 14:28:10'),
                                                                                                         (2, 'Bruno', 0, 0, NULL, '2021-12-21 14:31:33'),
                                                                                                         (3, 'Lucas', 0, 0, NULL, '2021-12-21 14:32:01'),
                                                                                                         (4, 'Gui Furtado ', 0, 0, NULL, '2021-12-21 14:32:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `players_court`
--

CREATE TABLE `players_court` (
                                 `id` int(11) NOT NULL,
                                 `player` int(11) NOT NULL,
                                 `court` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `players_court`
--

INSERT INTO `players_court` (`id`, `player`, `court`) VALUES
                                                          (2, 2, 10),
                                                          (3, 3, 10),
                                                          (4, 4, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `isAdmin`) VALUES
                                                                      (1, 'Alex Oliveira', 'alexrjrjr@gmail.com', 'fc7455695c851c8e73b8bd268db1b0f3', 1),
                                                                      (4, 'Actual Name 2', 'newEmail@email.email2', '22', 0),
                                                                      (5, 'User Test11', 'Test@test.test', 'test', 0),
                                                                      (6, 'User Test 2', 'Test2@test.test', 'test2', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `available_days`
--
ALTER TABLE `available_days`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `available_days_id_uindex` (`id`);

--
-- Índices para tabela `court`
--
ALTER TABLE `court`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `court_id_uindex` (`id`),
    ADD KEY `court_day_id_fk` (`day`),
    ADD KEY `court_players_id_fk` (`players`);

--
-- Índices para tabela `day`
--
ALTER TABLE `day`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `day_id_uindex` (`id`),
    ADD KEY `day_user_id_fk` (`owner`),
    ADD KEY `day_available_days_id_fk` (`matchDay`);

--
-- Índices para tabela `day_user`
--
ALTER TABLE `day_user`
    ADD PRIMARY KEY (`id`),
    ADD KEY `day_user_day_id_fk` (`day`),
    ADD KEY `day_user_user_id_fk` (`user`);

--
-- Índices para tabela `players`
--
ALTER TABLE `players`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `players_id_uindex` (`id`);

--
-- Índices para tabela `players_court`
--
ALTER TABLE `players_court`
    ADD PRIMARY KEY (`id`),
    ADD KEY `players_court_court_id_fk` (`court`),
    ADD KEY `players_court_players_id_fk` (`player`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `user_email_uindex` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `available_days`
--
ALTER TABLE `available_days`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `court`
--
ALTER TABLE `court`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `day`
--
ALTER TABLE `day`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `day_user`
--
ALTER TABLE `day_user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `players`
--
ALTER TABLE `players`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `players_court`
--
ALTER TABLE `players_court`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `court`
--
ALTER TABLE `court`
    ADD CONSTRAINT `court_day_id_fk` FOREIGN KEY (`day`) REFERENCES `day` (`id`),
    ADD CONSTRAINT `court_players_id_fk` FOREIGN KEY (`players`) REFERENCES `players` (`id`);

--
-- Limitadores para a tabela `day`
--
ALTER TABLE `day`
    ADD CONSTRAINT `day_available_days_id_fk` FOREIGN KEY (`matchDay`) REFERENCES `available_days` (`id`),
    ADD CONSTRAINT `day_user_id_fk` FOREIGN KEY (`owner`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `day_user`
--
ALTER TABLE `day_user`
    ADD CONSTRAINT `day_user_day_id_fk` FOREIGN KEY (`day`) REFERENCES `day` (`id`),
    ADD CONSTRAINT `day_user_user_id_fk` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `players_court`
--
ALTER TABLE `players_court`
    ADD CONSTRAINT `players_court_court_id_fk` FOREIGN KEY (`court`) REFERENCES `court` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `players_court_players_id_fk` FOREIGN KEY (`player`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
