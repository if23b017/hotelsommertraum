-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Jan 2024 um 19:09
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hotel_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `newsID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `newsdate` date NOT NULL,
  `newstext` longtext NOT NULL,
  `thumbnail` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`newsID`, `title`, `newsdate`, `newstext`, `thumbnail`) VALUES
(16, 'Neueröffnung - Hotel Sommertraum', '2024-01-01', 'Herzlich willkommen in unserem wunderschönen Hotel Sommertraum, das nach umfassenden Renovierungsarbeiten nun in neuem Glanz erstrahlt. Tauchen Sie ein in eine Welt des Luxus und erleben Sie den unvergleichlichen Komfort unserer frisch renovierten Zimmer. Jedes Detail wurde sorgfältig durchdacht, um Ihnen einen Aufenthalt zu bieten, den Sie nicht so schnell vergessen werden.\n\nEntspannen Sie sich am großzügigen Poolbereich, der nun noch komfortabler gestaltet wurde, um Ihnen eine Oase der Ruhe und Erholung zu bieten. Unsere Außenanlagen laden dazu ein, die Sonne zu genießen oder sich bei einem erfrischenden Getränk zu entspannen.\n\nEntdecken Sie kulinarische Höhepunkte in unseren hervorragenden Restaurants, in denen unser Küchenteam mit Leidenschaft und Kreativität delikate Gerichte für Sie zubereitet. Von exquisiten Vorspeisen bis zu verführerischen Desserts - lassen Sie sich von unserer gastronomischen Vielfalt verwöhnen.\n\nWir sind stolz darauf, Ihnen ein rundum verbessertes und unvergessliches Hotelerlebnis bieten zu können. Unser engagiertes Team steht Ihnen jederzeit zur Verfügung, um sicherzustellen, dass Ihr Aufenthalt im Hotel Sommertraum alle Ihre Erwartungen übertrifft.\n\nTauchen Sie ein in Luxus, Entspannung und kulinarische Genüsse - wir freuen uns darauf, Sie in unserem neueröffneten Hotel begrüßen zu dürfen und Ihnen eine unvergessliche Zeit zu bereiten.', 'uploads/news/newsarticle1.jpg'),
(17, 'Unsere Umgebung', '2024-01-15', 'Inmitten einer faszinierenden Umgebung, die von atemberaubender Natur und aufregenden Sehenswürdigkeiten geprägt ist, eröffnen sich zahlreiche faszinierende Möglichkeiten für Abenteuer und Entspannung gleichermaßen. Tauchen Sie ein in die Vielfalt lokaler Attraktionen, erkunden Sie bezaubernde Landschaften bei ausgedehnten Wanderungen oder lassen Sie sich von kulturellen Höhepunkten verzaubern.\n\nVon majestätischen Berggipfeln bis hin zu idyllischen Küstenabschnitten bietet unsere Umgebung ein breites Spektrum an eindrucksvollen Naturschönheiten. Erkunden Sie die verborgenen Winkel und entdecken Sie die einzigartigen Facetten der Landschaft, die sowohl Naturliebhaber als auch Abenteurer gleichermaßen begeistern werden.\n\nZusätzlich zu den natürlichen Schätzen gibt es eine Vielzahl von kulturellen Highlights, die dazu einladen, die Geschichte und Traditionen unserer Region zu entdecken. Besuchen Sie lokale Museen, historische Stätten und Kunstgalerien, um einen Einblick in die reiche kulturelle Vergangenheit unserer Umgebung zu erhalten.\n\nFür diejenigen, die nach Entspannung streben, bieten malerische Aussichtspunkte und ruhige Plätze die perfekte Kulisse, um die Seele baumeln zu lassen. Genießen Sie die harmonische Verbindung zwischen Natur und Kultur, während Sie durch diese einladende Umgebung spazieren.\n\nGanz gleich, ob Sie Abenteuer suchen oder einfach nur die Schönheit der Natur und Kultur erleben möchten – unsere Umgebung verspricht ein unvergessliches Erlebnis für jeden Geschmack und jede Vorliebe.', 'uploads/news/newsarticle2.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reservations`
--

CREATE TABLE `reservations` (
  `reservationID` int(11) NOT NULL,
  `room` varchar(128) NOT NULL,
  `arrivaltime` varchar(128) NOT NULL,
  `departuretime` varchar(128) NOT NULL,
  `breakfast` int(1) NOT NULL,
  `pets` int(1) NOT NULL,
  `parking` int(1) NOT NULL,
  `status` varchar(128) NOT NULL DEFAULT 'neu',
  `sum` int(11) NOT NULL,
  `reservationDate` date NOT NULL,
  `FK_userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `reservations`
--

INSERT INTO `reservations` (`reservationID`, `room`, `arrivaltime`, `departuretime`, `breakfast`, `pets`, `parking`, `status`, `sum`, `reservationDate`, `FK_userId`) VALUES
(19, 'Doppelbettzimmer', '2024-01-20', '2024-01-24', 1, 0, 0, 'bestätigt', 240, '2024-01-15', 13),
(21, 'Luxussuite mit Jacuzzi', '2024-01-28', '2024-02-02', 1, 1, 1, 'neu', 1025, '2024-01-15', 14),
(24, 'Luxussuite', '2024-01-19', '2024-01-23', 0, 0, 1, 'storno', 420, '2024-01-15', 14);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthdate` date NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userId`, `email`, `password`, `role`, `firstname`, `lastname`, `gender`, `birthdate`, `active`) VALUES
(9, 'admin@localhost.com', '$2y$10$nDCGBLnfHh5/HjoabtD0Kef8Xvp6lgv.DAqcez/YkkitkxCQ5jp8C', 'admin', 'admin', 'admin', 'H', '2000-01-01', 1),
(13, 'gast1@gmail.com', '$2y$10$lm5bbnNrPlBSnUuX8X9w5..6hLH7ornsuw5iKD4Vpe.8aQnosrqDe', 'user', 'GastEins', 'gast', 'H', '2004-01-01', 1),
(14, 'gast2@gmail.com', '$2y$10$2drrtPLkfV/91ggbIGwbyetSaFIfWCRRPBNdC/HUb8pMaz/zNdpGK', 'user', 'GastZwei', 'gast', 'F', '2005-01-01', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indizes für die Tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
