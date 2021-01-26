-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2021 pada 06.12
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_todoes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_todoes`
--

CREATE TABLE `tb_todoes` (
  `id` int(32) NOT NULL,
  `id_user` int(32) NOT NULL,
  `title_todoes` varchar(32) NOT NULL,
  `des_todoes` varchar(500) NOT NULL,
  `date_todoes` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_todoes`
--

INSERT INTO `tb_todoes` (`id`, `id_user`, `title_todoes`, `des_todoes`, `date_todoes`) VALUES
(18, 12, 'Make Cars', 'make like lambo cars', '2021-02-01'),
(19, 12, 'Make HOuse', 'House link iromnan', '2021-03-12'),
(20, 19, 'Gladi note', 'note', '2021-01-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(32) NOT NULL,
  `nama_lengkap` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama_lengkap`, `email`, `username`, `password`) VALUES
(12, 'Dandi Supriyadi', 'dandi.061100@gmail.com', 'dannndi', 'f5c633e51eb3051dc4485869ac9df6f50b1a6652'),
(19, 'Gladiator', 'gladi9838@gmail.com', '18111032', '7c222fb2927d828af22f592134e8932480637c0d');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_todoes`
--
ALTER TABLE `tb_todoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_todoes`
--
ALTER TABLE `tb_todoes`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_todoes`
--
ALTER TABLE `tb_todoes`
  ADD CONSTRAINT `tb_todoes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
