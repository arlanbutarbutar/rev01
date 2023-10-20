-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Okt 2023 pada 06.03
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
(3, 'admin', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bengkel`
--

CREATE TABLE `bengkel` (
  `id_bengkel` int(6) NOT NULL,
  `nama_bengkel` text NOT NULL,
  `nama_pemilik` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bengkel`
--

INSERT INTO `bengkel` (`id_bengkel`, `nama_bengkel`, `nama_pemilik`, `no_hp`, `alamat`, `jam_buka`, `jam_tutup`, `deskripsi`) VALUES
(1, 'Madu Jaya x', 'Nyaris', '081222334455', 'Kayu Putih', '08:00:00', '17:00:00', 'Ok'),
(3, 'bengkel tambal ban Liliba', '', '1234567899', 'Liliba', '08:00:00', '19:00:00', 'tersedia tambal ban tubles dan biasa'),
(4, 'Bengkel tambal ban Regen TDM', '', '1234578', 'Tdm', '07:28:00', '19:00:00', 'tersedia alat - alatmotor da tambal ban'),
(5, 'Bengkel Tambal Ban Oebufu', '', '123456789999', 'Oebufu', '08:00:00', '20:00:00', 'tersedia tambal ban tubles dan biasa'),
(7, 'tes', '', '08113827421', 'Jalan W.J. Lalamentik No.95', '10:00:00', '17:00:00', 'Daerah yang masih berada di dalam perkotaan'),
(8, 'tes', '', '08113827421', 'Jalan W.J. Lalamentik No.95', '11:21:00', '17:21:00', 'Daerah yang masih berada di dalam perkotaan'),
(9, 'tes', 'tes', '08113827421', 'Jln. Adisucipto', '14:32:00', '15:32:00', 'as');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(6) NOT NULL,
  `id_bengkel` int(6) NOT NULL,
  `nama_lokasi` text NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longtitude` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `id_bengkel`, `nama_lokasi`, `latitude`, `longtitude`) VALUES
(1, 1, 'Kayu Putih', '345678cc', '6578900--cV'),
(2, 4, 'Tdm', '-10.1719719', '123.6285784'),
(3, 3, 'Liliba', '-10.17145892', '123.6268155'),
(4, 5, 'Oebufu', '-10.1745892', '123.6268155');

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
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bengkel`
--
ALTER TABLE `bengkel`
  MODIFY `id_bengkel` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
