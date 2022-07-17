-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2021 pada 11.42
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_karyawan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` varchar(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` time NOT NULL,
  `keluar` time NOT NULL,
  `suhu_badan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absen`, `username`, `Nama`, `tanggal`, `masuk`, `keluar`, `suhu_badan`) VALUES
('1', '112211', 'namikaze ouwo', '2021-06-01', '12:10:09', '17:10:08', '34'),
('2', '1234567', 'zainal', '2021-04-05', '14:11:40', '17:11:40', '10'),
('3', '131214', 'john kelor', '2021-06-02', '13:12:41', '17:12:41', '11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `tmpt_lahir` varchar(30) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` int(13) NOT NULL,
  `kd_jabatan` varchar(10) NOT NULL,
  `Gender` varchar(13) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `nama_admin`, `tmpt_lahir`, `tgl_lhr`, `alamat`, `no_hp`, `kd_jabatan`, `Gender`, `password`) VALUES
('7654321', 'apin', 'cilgon', '2021-06-16', 'asssssssaaaa', 898937118, 'adm', 'laki laki', '14022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` int(2) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama_krywn` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `username`, `nama_krywn`, `tgl_mulai`, `tgl_selesai`, `ket`) VALUES
(12, '1234567', 'asdasd', '2021-06-01', '2021-06-03', 'sad');

-- --------------------------------------------------------

--
-- Struktur dari tabel `izin`
--

CREATE TABLE `izin` (
  `id_izin` int(2) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama_krywn` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `kd_jabatan` varchar(50) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_krywn` varchar(100) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` int(50) NOT NULL,
  `kd_jabatan` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `username`, `nama_krywn`, `tmpt_lahir`, `tgl_lhr`, `alamat`, `no_hp`, `kd_jabatan`, `Gender`, `password`) VALUES
(2, '1234567', 'Muhamad Zainal Arifin', 'Cilegon', '1999-09-30', 'Link.Pabuaran RT/RW 01/05 No.082', 896927834, 'manager', 'L', '300999'),
(3, '90909090', 'yudha iskana', 'cirebon', '1998-11-16', 'warnasari indah', 2312232, 'asisten manager', 'L', '15022');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`),
  ADD UNIQUE KEY `id_krywn` (`username`),
  ADD KEY `id_krywn_2` (`username`);

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD UNIQUE KEY `id_krywn` (`username`),
  ADD KEY `id_krywn_2` (`username`);

--
-- Indeks untuk tabel `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD UNIQUE KEY `id_krywn` (`username`),
  ADD KEY `id_krywn_2` (`username`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kd_jabatan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `kd_jabatan` (`kd_jabatan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`username`) REFERENCES `karyawan` (`username`);

--
-- Ketidakleluasaan untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`username`) REFERENCES `karyawan` (`username`);

--
-- Ketidakleluasaan untuk tabel `izin`
--
ALTER TABLE `izin`
  ADD CONSTRAINT `izin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `karyawan` (`username`);

--
-- Ketidakleluasaan untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`kd_jabatan`) REFERENCES `karyawan` (`kd_jabatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
