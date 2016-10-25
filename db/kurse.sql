-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Okt 2016 um 10:48
-- Server-Version: 5.7.14
-- PHP-Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `kurse`
--
CREATE DATABASE IF NOT EXISTS `kurse` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `kurse`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunden`
--

DROP TABLE IF EXISTS `kunden`;
CREATE TABLE `kunden` (
  `kunden_id` int(11) NOT NULL,
  `kunden_kundennummer` varchar(11) NOT NULL,
  `kunden_vorname` varchar(80) NOT NULL,
  `kunden_nachname` varchar(120) NOT NULL,
  `kunden_adresse` varchar(1205) NOT NULL,
  `kunden_plz` varchar(4) NOT NULL,
  `kunden_ort` varchar(80) NOT NULL,
  `kunden_telefon` varchar(32) NOT NULL,
  `kunden_email` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kunden`
--

INSERT INTO `kunden` (`kunden_id`, `kunden_kundennummer`, `kunden_vorname`, `kunden_nachname`, `kunden_adresse`, `kunden_plz`, `kunden_ort`, `kunden_telefon`, `kunden_email`) VALUES
(85, 'KdNr-000003', 'Maria', 'Musterfrau', 'Straße 2', '1010', 'Irgendwoanders', '01 081523', 'maria.m@gmail.com'),
(88, 'KdNr-000005', 'Max', 'Mustermann', 'Straße 2', '1090', 'Irgendwo', '010815', 'test@gmail.com'),
(102, 'KdNr-000010', 'Josef', 'Mustermann', 'Straße 1', '1090', 'Irgendwo', '010815', 'test@gmail.com'),
(105, 'KdNr-000001', 'Kurt', 'Mustermann', 'Strasse ', '9999', 'Drüben', '010815', 'test@test.com'),
(110, 'KdNr-000002', 'Max', 'Mustermann', 'Straße 1', '9999', 'Drüben', '010815', 'test@test.com'),
(150, 'KdNr-000012', 'Max', 'Mustermann', 'Straße 1', '9999', 'Drüben', '010815', 'test@test.com'),
(152, 'KdNr-000013', 'Max', 'Mustermann', 'Straße 1', '9999', 'Drüben', '010815', 'test@test.com'),
(154, 'KdNr-000014', 'Max', 'Mustermann', 'Straße 1', '9999', 'Drüben', '010815', 'test@test.com'),
(155, 'KdNr-000015', 'Max', 'Mustermann', 'Straße 1', '9999', 'Drüben', '010815', 'test@test.com'),
(160, 'KdNr-000016', 'Max', 'Mustermann', 'Straße 1', '9999', 'Drüben', '010815', 'test@test.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kurse`
--

DROP TABLE IF EXISTS `kurse`;
CREATE TABLE `kurse` (
  `kurse_id` int(11) NOT NULL,
  `kurse_kursnummer` varchar(12) NOT NULL,
  `kurse_kurstitel` varchar(255) NOT NULL,
  `kurse_kursbeschreibung` text NOT NULL,
  `kurse_kursdatum` date NOT NULL,
  `kurse_teilnehmermin` tinyint(3) UNSIGNED NOT NULL DEFAULT '3',
  `kurse_teilnehmermax` tinyint(3) UNSIGNED NOT NULL DEFAULT '10',
  `raume_raume_id` int(11) NOT NULL,
  `trainer_trainer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kurse`
--

INSERT INTO `kurse` (`kurse_id`, `kurse_kursnummer`, `kurse_kurstitel`, `kurse_kursbeschreibung`, `kurse_kursdatum`, `kurse_teilnehmermin`, `kurse_teilnehmermax`, `raume_raume_id`, `trainer_trainer_id`) VALUES
(2, '1', 'php für einsteiger', 'mehr blabla', '2016-10-17', 3, 10, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kurse_has_kunden`
--

DROP TABLE IF EXISTS `kurse_has_kunden`;
CREATE TABLE `kurse_has_kunden` (
  `kurse_kurse_id` int(11) NOT NULL,
  `kunden_kunden_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kurse_has_kunden`
--

INSERT INTO `kurse_has_kunden` (`kurse_kurse_id`, `kunden_kunden_id`) VALUES
(2, 88);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `raume`
--

DROP TABLE IF EXISTS `raume`;
CREATE TABLE `raume` (
  `raume_id` int(11) NOT NULL,
  `raeume_raumnummer` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `raume`
--

INSERT INTO `raume` (`raume_id`, `raeume_raumnummer`) VALUES
(1, '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trainer`
--

DROP TABLE IF EXISTS `trainer`;
CREATE TABLE `trainer` (
  `trainer_id` int(11) NOT NULL,
  `trainer_trainernummer` varchar(5) NOT NULL,
  `trainer_vorname` varchar(80) NOT NULL,
  `trainer_nachname` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `trainer_trainernummer`, `trainer_vorname`, `trainer_nachname`) VALUES
(1, '1', 'Thomas', 'Macher');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `kunden`
--
ALTER TABLE `kunden`
  ADD PRIMARY KEY (`kunden_id`),
  ADD UNIQUE KEY `kunden_kundennummer` (`kunden_kundennummer`);

--
-- Indizes für die Tabelle `kurse`
--
ALTER TABLE `kurse`
  ADD PRIMARY KEY (`kurse_id`),
  ADD UNIQUE KEY `kursnummer_UNIQUE` (`kurse_kursnummer`),
  ADD KEY `fk_kurse_raume_idx` (`raume_raume_id`),
  ADD KEY `fk_kurse_trainer1_idx` (`trainer_trainer_id`);
ALTER TABLE `kurse` ADD FULLTEXT KEY `kurse_textsuche` (`kurse_kurstitel`,`kurse_kursbeschreibung`);

--
-- Indizes für die Tabelle `kurse_has_kunden`
--
ALTER TABLE `kurse_has_kunden`
  ADD PRIMARY KEY (`kurse_kurse_id`,`kunden_kunden_id`),
  ADD KEY `fk_kurse_has_kunden_kunden1_idx` (`kunden_kunden_id`),
  ADD KEY `fk_kurse_has_kunden_kurse1_idx` (`kurse_kurse_id`);

--
-- Indizes für die Tabelle `raume`
--
ALTER TABLE `raume`
  ADD PRIMARY KEY (`raume_id`);

--
-- Indizes für die Tabelle `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainer_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `kunden`
--
ALTER TABLE `kunden`
  MODIFY `kunden_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT für Tabelle `kurse`
--
ALTER TABLE `kurse`
  MODIFY `kurse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `raume`
--
ALTER TABLE `raume`
  MODIFY `raume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `kurse`
--
ALTER TABLE `kurse`
  ADD CONSTRAINT `fk_kurse_raume` FOREIGN KEY (`raume_raume_id`) REFERENCES `raume` (`raume_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kurse_trainer1` FOREIGN KEY (`trainer_trainer_id`) REFERENCES `trainer` (`trainer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `kurse_has_kunden`
--
ALTER TABLE `kurse_has_kunden`
  ADD CONSTRAINT `fk_kurse_has_kunden_kunden1` FOREIGN KEY (`kunden_kunden_id`) REFERENCES `kunden` (`kunden_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kurse_has_kunden_kurse1` FOREIGN KEY (`kurse_kurse_id`) REFERENCES `kurse` (`kurse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
