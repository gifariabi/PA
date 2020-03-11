-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2020 pada 16.48
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_kas` (IN `total_kas` INT(255))  NO SQL
    DETERMINISTIC
BEGIN
SELECT (SUM(pemasukan_kas)-SUM(pengeluaran_kas)) AS 'Total Kas' FROM kas;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `nim` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `noWA` varchar(255) NOT NULL,
  `noHP` varchar(255) NOT NULL,
  `idLine` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `nim_pengurus` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`nim`, `username`, `password`, `nama`, `noWA`, `noHP`, `idLine`, `foto`, `prodi`, `nim_pengurus`) VALUES
(0, '', '', 'Yusril Wahyuda', '', '', '', '', 'D3SI', 0),
(777, 'wahyudayusril', '4101', 'Yusril Wahyuda', '087', '08177', 'yusrilw29', '', 'D3SI', 0),
(4101, '', '', 'yudas', '', '', '', '', 'D3SI', 0),
(7775, '', '', 'Yusril Wahyuda', '', '', '', '', 'D3SI', 0),
(9989, 'luqman', '1111', 'luqmannn', '', '', '', '', 'D3PH', 0),
(12345, '', '', 'm luqman', '', '', '', '', 'D3SI', 0),
(67676, '', '', 'nando', '', '', '', '', 'D3SI', 0),
(77778, '', '', 'Yusril Wahyuda', '', '', '', '', 'D3SI', 0),
(123456, '', '', 'Yusril Wahyudax', '', '', '', '', 'D3SI', 0),
(1234599, '', '', 'Yusril Wahyuda', '', '', '', '', 'D3SI', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ang_organisasi`
--

CREATE TABLE `ang_organisasi` (
  `nim` int(11) NOT NULL,
  `idOrganisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data untuk tabel `ang_organisasi`
--

INSERT INTO `ang_organisasi` (`nim`, `idOrganisasi`) VALUES
(12345, 111),
(1234599, 111),
(123456, 111),
(67676, 111),
(4101, 111),
(777, 106),
(777, 106),
(777, 107),
(777, 112);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `idDept` int(5) NOT NULL,
  `namaDepartemen` varchar(255) NOT NULL,
  `idOrganisasi` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(5) NOT NULL,
  `pemasukan_kas` int(255) NOT NULL,
  `pengeluaran_kas` int(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data untuk tabel `kas`
--

INSERT INTO `kas` (`id_kas`, `pemasukan_kas`, `pengeluaran_kas`, `tanggal`) VALUES
(1, 2500, 0, '2019-12-14'),
(2, 1000, 0, '0000-00-00'),
(3, 1000, 0, '2019-12-12'),
(4, 0, 1000, '2019-12-12'),
(5, 1000, 0, '0000-00-00'),
(6, 1500000, 0, '2019-12-13'),
(7, 1000, 0, '2019-12-14'),
(8, 0, 5000, '2019-12-15'),
(9, 1000, 0, '2019-12-16'),
(10, 0, 1000, '2019-12-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `organisasi`
--

CREATE TABLE `organisasi` (
  `idOrganisasi` int(11) NOT NULL,
  `namaOrganisasi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `logo` text NOT NULL,
  `ketua` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data untuk tabel `organisasi`
--

INSERT INTO `organisasi` (`idOrganisasi`, `namaOrganisasi`, `deskripsi`, `logo`, `ketua`) VALUES
(106, 'HMDSI', 'Himpunan Mahasiswa D3 Sistem Informasi', '5d458932f2c4f50297475fe9aa1c2d36.png', 'Kelvin'),
(107, 'SAMALOWA', 'Persatuan Mahasiswa Lombok Sumbawa', '66ab95336b8c0140d8fc5b950afa40da.jpg', 'Esa'),
(108, 'HIMADIRA', 'Himpunan Mahasiswa D3 RPLA', 'aded52e58ef6371e4711e7921eb62340.jpg', 'Riki'),
(111, 'UKM Search', 'Ukm untuk lomba', '1a50fb746f11414ca7315fdfc4fabf60.jpg', 'Adin'),
(112, 'UKM BALI', 'bali', '7df498e5b999561010537ebfa5ae9435.png', 'gede');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `nim_pengurus` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `noWA` varchar(255) NOT NULL,
  `noHP` varchar(255) NOT NULL,
  `idLine` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `idDept` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahunAjaran` int(5) NOT NULL,
  `tahunAjaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_total_kas`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_total_kas` (
`Total Kas` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_total_kas`
--
DROP TABLE IF EXISTS `view_total_kas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_kas`  AS  select (sum(`kas`.`pemasukan_kas`) - sum(`kas`.`pengeluaran_kas`)) AS `Total Kas` from `kas` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `nim_pengurus` (`nim_pengurus`) USING BTREE;

--
-- Indeks untuk tabel `ang_organisasi`
--
ALTER TABLE `ang_organisasi`
  ADD KEY `fk_idOrganisasi` (`idOrganisasi`),
  ADD KEY `fk_nim_anggota` (`nim`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`idDept`),
  ADD UNIQUE KEY `idOrganisasi` (`idOrganisasi`);

--
-- Indeks untuk tabel `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indeks untuk tabel `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`idOrganisasi`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`nim_pengurus`),
  ADD UNIQUE KEY `idDept` (`idDept`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahunAjaran`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `idDept` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `idOrganisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ang_organisasi`
--
ALTER TABLE `ang_organisasi`
  ADD CONSTRAINT `fk_idOrganisasi` FOREIGN KEY (`idOrganisasi`) REFERENCES `organisasi` (`idOrganisasi`),
  ADD CONSTRAINT `fk_nim_anggota` FOREIGN KEY (`nim`) REFERENCES `anggota` (`nim`);

--
-- Ketidakleluasaan untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `pengurus_ibfk_1` FOREIGN KEY (`idDept`) REFERENCES `departemen` (`idDept`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
