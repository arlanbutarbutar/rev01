-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Nov 2023 pada 03.07
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tambal_ban_rev`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`) VALUES
(3, 'admin', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG'),
(7, 'famorbarros@gmail.com', 'famorbarros@gmail.com', '$2y$10$reWWnQo9hSBg9GOE5fbQS.QmOphp75g9mkGIm3pjAz2BUl6orqVyK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bengkel`
--

CREATE TABLE `bengkel` (
  `id_bengkel` int(6) NOT NULL,
  `image` varchar(100) NOT NULL,
  `nama_bengkel` text NOT NULL,
  `nama_pemilik` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bengkel`
--

INSERT INTO `bengkel` (`id_bengkel`, `image`, `nama_bengkel`, `nama_pemilik`, `no_hp`, `alamat`, `jam_buka`, `jam_tutup`) VALUES
(1, '', 'UMKM Gilang Pratama', 'unname', '08113827421', 'Jalan W.J. Lalamentik No.95', '16:54:00', '20:54:00'),
(2, '', 'Tambal Ban Om Semy', 'unname', '08113827421', 'Jalan W.J. Lalamentik No.95', '16:54:00', '20:54:00'),
(3, '', 'Tambal Ban Sebelum Jurusan Kesehatan Lingkungan ', 'unname', '08113827421', 'Liliba', '16:54:00', '20:54:00'),
(4, '', 'Tambal Ban Bundaran PU', 'unname', '08113827421', 'Bundaran PU', '16:54:00', '20:54:00'),
(5, '', 'Tambal Ban Bundaran PU Sesudah Hotel Amaris', 'unname', '08113827421', 'Bundaran PU Sesudah Hotel Amaris', '16:54:00', '20:54:00'),
(6, '', 'Tambal Ban Sebelum Hotel Amaris', 'unname', '08113827421', 'Sebelum Hotel Amaris', '16:54:00', '20:54:00'),
(7, '', 'Bengkel Tofa Jln Amabi', 'unname', '08113827421', 'Tofa Jln Amabi', '16:54:00', '20:54:00'),
(8, '', 'Tambal Ban Idaman ', 'unname', '08113827421', 'Jln Samratulangi Kec Kelapa 5', '16:54:00', '20:54:00'),
(9, '', 'Bengkel Tambal Ban', 'unname', '08113827421', 'Oesapa Barat', '16:54:00', '20:54:00'),
(10, '', 'Tambal Ban Putra', 'unname', '08113827421', 'Jalan W.J. Lalamentik No.95', '16:54:00', '20:54:00'),
(11, '', 'Bengkel Tambal Ban Kayu Putih', 'unname', '08113827421', 'Kayu Putih', '16:54:00', '20:54:00'),
(12, '', 'Tambal Ban Pojok Walikota', 'unname', '08113827421', 'Walikota', '16:54:00', '20:54:00'),
(13, '', 'Bengkel Tambal Ban Ama Rai ', 'unname', '08113827421', 'Jln. Thamrin', '16:54:00', '20:54:00'),
(14, '', 'Tambal Ban Senator Jaya ', 'unname', '08113827421', 'Fatululi, Kec Oebobo', '16:54:00', '20:54:00'),
(15, '', 'Tambal Ban Rasta ', 'unname', '08113827421', 'Tarus', '16:54:00', '20:54:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`) VALUES
(2, 'Pencucian Motor'),
(3, 'Tambal ban'),
(4, 'Kios');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas_bengkel`
--

CREATE TABLE `fasilitas_bengkel` (
  `id_fasilitas_bengkel` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL,
  `id_bengkel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_bengkel`
--

CREATE TABLE `lokasi_bengkel` (
  `id_lokasi` int(6) NOT NULL,
  `id_bengkel` int(6) NOT NULL,
  `nama_lokasi` varchar(75) NOT NULL,
  `latitude` char(25) NOT NULL,
  `longitude` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lokasi_bengkel`
--

INSERT INTO `lokasi_bengkel` (`id_lokasi`, `id_bengkel`, `nama_lokasi`, `latitude`, `longitude`) VALUES
(6, 1, 'UMKM Gilang Pratama', '-10.180028', '123.652361'),
(7, 2, 'Tambal Ban Om Semy', '-10.16303303624513', '123.6530080446519'),
(8, 3, 'Tambal Ban Sebelum Jurusan Kesehatan Lingkungan (Liliba )', '-10.157715902035587', '123.64092371303003'),
(9, 4, 'Tambal Ban Bundaran PU', '-10.1559135783656', '123.63221751928798'),
(10, 5, 'Tambal Ban Bundaran PU ( Sesudah Hotel Amaris)', '-10.157046', '123.632625'),
(11, 6, 'Tambal Ban (Sebelum Hotel Amaris)', '-10.158279882153042', '123.6321140756880'),
(12, 8, 'Tambal Ban Idaman (Jln Samratulangi Kec Kelapa 5)', '-10.156050', '123.626765'),
(13, 7, 'Bengkel Tofa Jln Amabi', '-10.181323717427992', '123.61426350380381'),
(14, 9, 'Bengkel Tambal (Ban Oesapa Barat)', '-10.147279', '123.631658'),
(15, 10, 'Tambal Ban Putra', '-10.187493199543344', '123.61044563360736'),
(16, 11, 'Bengkel Tambal Ban (Kayu Putih)', '-10.164617825851192', '123.6232727701468'),
(17, 12, 'Tambal Ban Pojok (Walikota)', '-10.155672', '123.618432'),
(18, 13, 'Bengkel Tambal Ban Ama Rai ( Jln. Thamrin)', '-10.161093487398377', '123.6132090842845'),
(19, 14, 'Tambal Ban Senator Jaya (Fatululi, Kec Oebobo)', '-10.158813983274184', '123.6071893830938'),
(20, 15, 'Tambal Ban Rasta Tarus', '-10.128605729585415', '123.67841972721054');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `bengkel`
--
ALTER TABLE `bengkel`
  ADD PRIMARY KEY (`id_bengkel`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indeks untuk tabel `fasilitas_bengkel`
--
ALTER TABLE `fasilitas_bengkel`
  ADD PRIMARY KEY (`id_fasilitas_bengkel`),
  ADD KEY `id_fasilitas` (`id_fasilitas`),
  ADD KEY `id_bengkel` (`id_bengkel`);

--
-- Indeks untuk tabel `lokasi_bengkel`
--
ALTER TABLE `lokasi_bengkel`
  ADD PRIMARY KEY (`id_lokasi`),
  ADD KEY `id_bengkel` (`id_bengkel`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `bengkel`
--
ALTER TABLE `bengkel`
  MODIFY `id_bengkel` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `fasilitas_bengkel`
--
ALTER TABLE `fasilitas_bengkel`
  MODIFY `id_fasilitas_bengkel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `lokasi_bengkel`
--
ALTER TABLE `lokasi_bengkel`
  MODIFY `id_lokasi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `fasilitas_bengkel`
--
ALTER TABLE `fasilitas_bengkel`
  ADD CONSTRAINT `fasilitas_bengkel_ibfk_1` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fasilitas_bengkel_ibfk_2` FOREIGN KEY (`id_bengkel`) REFERENCES `bengkel` (`id_bengkel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lokasi_bengkel`
--
ALTER TABLE `lokasi_bengkel`
  ADD CONSTRAINT `lokasi_bengkel_ibfk_1` FOREIGN KEY (`id_bengkel`) REFERENCES `bengkel` (`id_bengkel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
