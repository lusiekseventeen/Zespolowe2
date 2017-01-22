-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Sty 2017, 15:35
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `events`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `foto_url` varchar(100) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `opis` varchar(1000) NOT NULL,
  `lokalizacja` varchar(25) DEFAULT NULL,
  `data_utowrzenia` datetime NOT NULL,
  `data_zakonczenia` datetime NOT NULL,
  `czy_zakonczone` tinyint(1) NOT NULL DEFAULT '0',
  `czy_sponsorowane` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `event`
--

INSERT INTO `event` (`id`, `foto_url`, `uzytkownik_id`, `opis`, `lokalizacja`, `data_utowrzenia`, `data_zakonczenia`, `czy_zakonczone`, `czy_sponsorowane`) VALUES
(1, 'uploads/kamaz/000000000000pobrane.jpg', 2, '321', NULL, '2017-01-22 09:43:56', '1231-03-12 13:21:00', 0, 0),
(2, 'uploads/kamaz/0000000000000pobrane.jpg', 2, '123213', NULL, '2017-01-22 09:51:13', '0023-03-12 12:32:00', 0, 0),
(3, 'uploads/kamaz/00000000000000pobrane.jpg', 2, '123123 213', NULL, '2017-01-22 09:52:48', '3123-03-12 12:23:00', 0, 0),
(4, 'uploads/kamaz/000000000000000pobrane.jpg', 2, '213213', NULL, '2017-01-22 09:53:31', '0213-03-12 12:32:00', 0, 0),
(5, 'uploads/kamaz/15289130_1298085753575082_4088513949238538103_o.jpg', 2, 'zjedz kanapke bla bla bla na szczycie mont everest', NULL, '2017-01-22 11:04:06', '2015-03-12 15:23:00', 0, 0),
(6, 'uploads/kamaz/1485081426427954764414.jpg', 2, 'Fhjvc', NULL, '2017-01-22 11:30:53', '2017-01-22 11:37:00', 0, 0),
(7, 'uploads/kamaz/20170122_113946.mp4', 2, 'Sfvv', NULL, '2017-01-22 11:33:49', '2017-01-22 11:40:00', 0, 0),
(8, 'uploads/kamaz/a.png', 2, 'hue hue hue', NULL, '2017-01-22 13:53:10', '2017-01-14 12:32:00', 0, 0),
(9, 'uploads/kamaz22/a.png', 24, 'hue hue hue', NULL, '2017-01-22 14:05:07', '2017-02-03 04:03:00', 0, 0),
(10, 'uploads/kamaz/256x256-accepted.png', 2, 'hihihihi', NULL, '2017-01-22 14:12:35', '2017-01-18 23:02:00', 0, 0),
(11, 'uploads/kamaz/015289130_1298085753575082_4088513949238538103_o.jpg', 2, '121212', NULL, '2017-01-22 14:19:54', '2017-01-22 21:12:00', 0, 0),
(12, 'uploads/kamaz22/pobrane.jpg', 24, 'nowe wydarzenie super extra wydarzenie', NULL, '2017-01-22 15:16:46', '2017-01-06 01:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ranking`
--

CREATE TABLE `ranking` (
  `tag_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `relacja_event_tag`
--

CREATE TABLE `relacja_event_tag` (
  `event_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `relacja_event_tag`
--

INSERT INTO `relacja_event_tag` (`event_id`, `tag_id`) VALUES
(11, 1),
(12, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `relacja_event_uzytkownik`
--

CREATE TABLE `relacja_event_uzytkownik` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `punkty` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `czy_zatwierdzona` tinyint(1) NOT NULL,
  `data_wyslania` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `relacja_tag_uzytkownik`
--

CREATE TABLE `relacja_tag_uzytkownik` (
  `uzytkownik_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `relacja_tag_uzytkownik`
--

INSERT INTO `relacja_tag_uzytkownik` (`uzytkownik_id`, `tag_id`) VALUES
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(22, 2),
(22, 3),
(22, 4),
(24, 4),
(24, 7),
(24, 6),
(24, 1),
(24, 3),
(24, 2),
(24, 5),
(24, 8),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `relacja_user_user`
--

CREATE TABLE `relacja_user_user` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `uzytkownik1_id` int(11) NOT NULL,
  `uzytkownik2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `tag`
--

INSERT INTO `tag` (`id`, `nazwa`) VALUES
(1, 'kamaz'),
(2, 'super'),
(3, 'ekstra'),
(4, 'wro'),
(5, 'tag'),
(6, 'hue'),
(7, 'kamaz2'),
(8, 'nowytag');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `haslo` varchar(30) DEFAULT NULL,
  `facebook_id` varchar(50) DEFAULT NULL,
  `opis` varchar(300) NOT NULL,
  `profilowe_url` varchar(100) DEFAULT NULL,
  `facebook_link` varchar(100) DEFAULT NULL,
  `typ` tinyint(1) NOT NULL,
  `punkty` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id`, `login`, `haslo`, `facebook_id`, `opis`, `profilowe_url`, `facebook_link`, `typ`, `punkty`) VALUES
(1, '1', '1', NULL, '1', NULL, '1', 0, 0),
(2, 'kamaz', 'kamaz', NULL, 'kamaz', NULL, 'kamaz', 0, 0),
(9, '2', '2', NULL, '1', NULL, '1', 1, 0),
(10, '3', '3', NULL, '3', NULL, '3', 1, 0),
(11, '4', '4', NULL, '', NULL, '4', 1, 0),
(12, '15', '5', NULL, '', NULL, '1', 1, 0),
(13, '20', '1', NULL, '', NULL, '11', 1, 0),
(14, '14', '14', NULL, '', NULL, '23', 1, 0),
(15, '13', '13', NULL, '', NULL, '123', 1, 0),
(16, '12', '12', NULL, '13,kamaz,super', NULL, '23', 1, 0),
(17, '231', '1', NULL, 'kamaz,super,ekstra,wro', NULL, '12', 1, 0),
(18, '1231', '1', NULL, 'kamaz,super,ekstra,wro', NULL, '1', 1, 0),
(19, '123213', '1', NULL, 'kamaz,super,ekstra,wro', NULL, '132', 1, 0),
(20, '12312', '123', NULL, 'kamaz,super,ekstra,wro', NULL, '123', 1, 0),
(21, '123321', '123321', NULL, 'kamaz,super,ekstra,wro', NULL, '123321', 1, 0),
(22, '111', '111', NULL, 'kamaz,super,ekstra,wro', NULL, '123', 1, 0),
(23, 'kamaz2', 'kamaz2', NULL, 'kamaz', NULL, 'brak', 0, 0),
(24, 'kamaz22', 'kamaz', NULL, 'hue,kamaz', NULL, 'brak', 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relacja_event_uzytkownik`
--
ALTER TABLE `relacja_event_uzytkownik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relacja_user_user`
--
ALTER TABLE `relacja_user_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `relacja_event_uzytkownik`
--
ALTER TABLE `relacja_event_uzytkownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `relacja_user_user`
--
ALTER TABLE `relacja_user_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
