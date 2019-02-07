-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Feb 2019 pada 09.57
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE USER 'dev'@'localhost' IDENTIFIED BY 'dev';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP ON *.* TO 'dev'@'localhost';

CREATE DATABASE IF NOT EXISTS `bluetape` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bluetape`;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bluetape`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bluetape_userinfo`
--

CREATE TABLE `bluetape_userinfo` (
  `email` varchar(128) NOT NULL,
  `name` varchar(256) NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `bluetape_userinfo`
--

INSERT INTO `bluetape_userinfo` (`email`, `name`, `lastUpdate`) VALUES
('7316081@student.unpar.ac.id', 'JONATHAN LAKSAMANA PURNOMO', '2019-02-06 04:19:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_dosen`
--

CREATE TABLE `jadwal_dosen` (
  `id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `hari` int(11) NOT NULL,
  `jam_mulai` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `jenis` varchar(256) NOT NULL,
  `label` varchar(100) NOT NULL,
  `lastUpdate` datetime DEFAULT '2019-02-06 04:19:18'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20180821101900);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perubahankuliah`
--

CREATE TABLE `perubahankuliah` (
  `id` int(9) NOT NULL,
  `requestByEmail` varchar(256) NOT NULL,
  `requestDateTime` datetime NOT NULL,
  `mataKuliahName` varchar(256) NOT NULL,
  `mataKuliahCode` varchar(9) DEFAULT NULL,
  `class` varchar(1) NOT NULL,
  `changeType` varchar(1) NOT NULL,
  `fromDateTime` datetime DEFAULT NULL,
  `fromRoom` varchar(16) DEFAULT NULL,
  `to` varchar(1024) DEFAULT NULL,
  `remarks` varchar(256) NOT NULL,
  `answer` varchar(16) DEFAULT NULL,
  `answeredByEmail` varchar(256) DEFAULT NULL,
  `answeredDateTime` datetime DEFAULT NULL,
  `answeredMessage` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transkrip`
--

CREATE TABLE `transkrip` (
  `id` int(9) NOT NULL,
  `requestByEmail` varchar(128) DEFAULT NULL,
  `requestDateTime` datetime NOT NULL,
  `requestType` varchar(8) DEFAULT NULL,
  `requestUsage` varchar(256) NOT NULL,
  `answer` varchar(16) DEFAULT NULL,
  `answeredByEmail` varchar(128) DEFAULT NULL,
  `answeredDateTime` datetime DEFAULT NULL,
  `answeredMessage` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bluetape_userinfo`
--
ALTER TABLE `bluetape_userinfo`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `jadwal_dosen`
--
ALTER TABLE `jadwal_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perubahankuliah`
--
ALTER TABLE `perubahankuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transkrip`
--
ALTER TABLE `transkrip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_dosen`
--
ALTER TABLE `jadwal_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `perubahankuliah`
--
ALTER TABLE `perubahankuliah`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transkrip`
--
ALTER TABLE `transkrip`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
