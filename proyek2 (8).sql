-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 09:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_kas` (IN `total_kas` INT(255))  NO SQL
    DETERMINISTIC
BEGIN
SELECT (SUM(pemasukan_kas)-SUM(pengeluaran_kas)) AS 'Total Kas' FROM kas;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ang_organisasi`
--

CREATE TABLE `ang_organisasi` (
  `nim` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `idOrganisasi` int(11) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `ang_organisasi`
--

INSERT INTO `ang_organisasi` (`nim`, `nama`, `idOrganisasi`, `jabatan`) VALUES
(670117403, 'Gifari Abi Waqqash', 1, 'Anggota Divisi Olahraga'),
(670117410, 'Muhammad Luqman', 1, 'Sekertaris'),
(670117410, 'Muhammad Luqman', 5, 'Anggota Divisi Dalam Negeri'),
(670117455, 'Eko Adinata', 5, 'Sekertaris');

-- --------------------------------------------------------

--
-- Table structure for table `datauser`
--

CREATE TABLE `datauser` (
  `nama` varchar(50) DEFAULT NULL,
  `nim` varchar(10) NOT NULL,
  `jenisKelamin` varchar(15) DEFAULT NULL,
  `prodi` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `foto` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datauser`
--

INSERT INTO `datauser` (`nama`, `nim`, `jenisKelamin`, `prodi`, `username`, `password`, `foto`) VALUES
('yusril wahyuda', '670117400', 'Laki-laki', 'D3SI', 'yusril', 'yusril', NULL),
('Eko adinata', '670117455', 'Laki-laki', 'D3SI', 'eko', 'eko', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `idDept` int(5) NOT NULL,
  `namaDepartemen` varchar(255) NOT NULL,
  `idOrganisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`idDept`, `namaDepartemen`, `idOrganisasi`) VALUES
(1, 'Departemen Olahraga', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(5) NOT NULL,
  `pemasukan_kas` int(255) NOT NULL,
  `pengeluaran_kas` int(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `idOrganisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id_kas`, `pemasukan_kas`, `pengeluaran_kas`, `keterangan`, `tanggal`, `idOrganisasi`) VALUES
(12, 1200000, 0, '', '2020-03-24', 1),
(14, 0, 50000, 'Beli Kain Hitam', '2020-03-25', 1),
(15, 0, 500, 'Print Proposal', '2020-03-25', 1),
(17, 0, 500, 'Beli Pulpen', '2020-03-30', 1),
(18, 0, 10000, 'Print Proposal', '2020-03-30', 5),
(20, 100000, 0, '', '2020-03-30', 5),
(21, 0, 50000, 'Sewa Kain Hitam', '2020-03-30', 5);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(10) NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8_bin NOT NULL,
  `waktu` varchar(255) COLLATE utf8_bin NOT NULL,
  `tempat` varchar(255) COLLATE utf8_bin NOT NULL,
  `harga` varchar(255) COLLATE utf8_bin NOT NULL,
  `qr_code` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_programkerja` int(10) NOT NULL,
  `upload_lpj` tinyint(255) DEFAULT 0 COMMENT '1 = sudah upload , 0 belum upload'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `waktu`, `tempat`, `harga`, `qr_code`, `id_programkerja`, `upload_lpj`) VALUES
(14, 'Seminar Android', '2020-05-05', 'Aula Fakultas Ilmu Terapan', '20000', 'Seminar UX .png', 10, 0),
(15, 'Bakti Sosial COVID 19', '2020-05-05', 'Telkom University', '20000', 'Bakti Sosial COVID 19.png', 11, 0),
(16, 'Voli Competition', '2020-06-07', 'Batununggal Sport Center', '20000', 'Voli Competition.png', 5, 1),
(17, 'sepakbola', '2020-06-0 7', 'batununggal sport', '20000', '', 5, 0),
(18, 'sepakbola', '2020-06-0 7', 'batununggal sport', '20000', '', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `deskripsi` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`deskripsi`) VALUES
('shdsgadgashjdgashjdgsdgja');

-- --------------------------------------------------------

--
-- Table structure for table `lpj`
--

CREATE TABLE `lpj` (
  `id_lpj` int(5) NOT NULL,
  `file` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_kegiatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lpj`
--

INSERT INTO `lpj` (`id_lpj`, `file`, `id_kegiatan`) VALUES
(3, '9586_TP32.pdf', 16);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `noWA` varchar(255) NOT NULL,
  `noHP` varchar(255) NOT NULL,
  `idLine` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `username`, `password`, `nama`, `noWA`, `noHP`, `idLine`, `foto`, `prodi`) VALUES
(0, 'bk', 'bk', '', '', '', '', '', ''),
(670117400, 'yusril', 'yusril123', 'Yusril Wahyuda', '', '', '', 'b60e2ca62d0a36db693c98d0191a9586.jpg', 'D3SI'),
(670117403, 'gifariabi', 'gifariabi', 'Gifari Abi Waqqash', '085868442225', '085868442226', 'gifarifr', '217af0b91e134c93fe445afec6e3c284.jpg', 'D3 Sistem Informasi'),
(670117406, 'sherli', 'sherli', 'Sherli Yualinda', '', '', '', '', 'D3 Sistem Informasi'),
(670117410, 'Luqman', 'luqman123', 'Muhammad Luqman', '080808099', '080808089', 'luqmaneuy', '2323ec9a9fc0bb6dfd56ddb9a37f8402.jpg', 'D3 Sistem Informasi'),
(670117455, 'eko', 'eko', 'Eko Adinata', '', '', '', '', 'D3SI'),
(670606006, 'ade', 'ade123', 'Ade Pangestu', '', '', '', '', 'D3 Sistem Informasi\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE `organisasi` (
  `idOrganisasi` int(11) NOT NULL,
  `namaOrganisasi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `logo` text NOT NULL,
  `ketua` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`idOrganisasi`, `namaOrganisasi`, `deskripsi`, `logo`, `ketua`) VALUES
(1, 'HMDSI', 'HMDSI adalah Himpunan Mahasiswa D3 Sistem Informasi', '5d458932f2c4f50297475fe9aa1c2d36.png', 'kelvin'),
(2, 'SAMALOWA', 'UKM Lombok Sumbawa', '0b9b5daa9df9de0b50cef003221ffb5b.jpg', 'Esa'),
(4, 'PERMALA', 'Mahasiswa Lampung', '811539bf69c57ce8660fce77201a6a31.jpg', 'Deva'),
(5, 'SEARCH', 'Lomba dll', '201a283dc472a6733bc943460775c71f.jpg', 'riko');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `nim` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `idOrganisasi` int(11) NOT NULL,
  `id_thnAjaran` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`nim`, `nama`, `jabatan`, `idOrganisasi`, `id_thnAjaran`) VALUES
(670117403, 'Gifari Abi Waqqash', 'Kepala Divisi Luar Negeri', 5, 1),
(670117455, 'Eko Adinata', 'Sekertaris', 5, 1),
(670117410, 'Muhammad Luqman', 'Sekertaris', 1, 1),
(670117410, 'Muhammad Luqman', 'Kepala Divisi Dalam Negeri', 5, 1),
(670117403, 'Gifari Abi Waqqash', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(5) NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) COLLATE utf8_bin NOT NULL,
  `nim` int(10) NOT NULL,
  `id_kegiatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `programkerja`
--

CREATE TABLE `programkerja` (
  `id_programkerja` int(10) NOT NULL,
  `nama_programkerja` varchar(255) COLLATE utf8_bin NOT NULL,
  `waktu_pelaksanaan` varchar(255) COLLATE utf8_bin NOT NULL,
  `departemen` varchar(255) COLLATE utf8_bin NOT NULL,
  `idOrganisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `programkerja`
--

INSERT INTO `programkerja` (`id_programkerja`, `nama_programkerja`, `waktu_pelaksanaan`, `departemen`, `idOrganisasi`) VALUES
(5, 'Bakti Sosial Panti Asuhan', '2020-03-02', 'Sosial', 1),
(7, 'Olahraga Sehat', '2020-12-03', 'Olahraga', 1),
(10, 'Study Group', '2020-04-02', 'Minat dan Bakat', 1),
(11, 'Sosial Indonesia Maju', '2020-03-04', 'Sosial', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rapat`
--

CREATE TABLE `rapat` (
  `id_rapat` int(11) NOT NULL,
  `perihal` varchar(255) COLLATE utf8_bin NOT NULL,
  `tempat` varchar(255) COLLATE utf8_bin NOT NULL,
  `tanggal` varchar(255) COLLATE utf8_bin NOT NULL,
  `waktu` varchar(255) COLLATE utf8_bin NOT NULL,
  `kategori` varchar(255) COLLATE utf8_bin NOT NULL,
  `nim` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `rapat`
--

INSERT INTO `rapat` (`id_rapat`, `perihal`, `tempat`, `tanggal`, `waktu`, `kategori`, `nim`) VALUES
(9, 'Rapat Rutin', 'Aula Fakultas Ilmu Terapan', '2020-01-02', '16:00', '', 670117410),
(10, 'Rapat bersama DPM', 'G6 FIT', '2020-05-03', '19:00', '', 670117410),
(11, 'Pemaparan Progress', 'A1 FIT', '2020-06-05', '19:00', '', 670117410),
(12, 'Rapat bersama DPM', 'Aula Fakultas Ilmu Terapan', '2020-04-21', '04:00', '', 670117410),
(13, 'Rapat bersama DPM', 'Aula Fakultas Ilmu Terapan', '2020-01-02', '16:00', '', 670117410),
(14, 'MANIAC ', 'Aula Fakultas Ilmu Terapan', '2020-04-28', '19:00', 'on', 670117410);

-- --------------------------------------------------------

--
-- Table structure for table `suratkeluar`
--

CREATE TABLE `suratkeluar` (
  `id` int(10) NOT NULL,
  `no_suratkeluar` varchar(255) COLLATE utf8_bin NOT NULL,
  `penerima` varchar(255) COLLATE utf8_bin NOT NULL,
  `tanggalkeluar` varchar(255) COLLATE utf8_bin NOT NULL,
  `waktu` varchar(255) COLLATE utf8_bin NOT NULL,
  `perihal` varchar(255) COLLATE utf8_bin NOT NULL,
  `nim` int(10) NOT NULL,
  `idOrganisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `suratkeluar`
--

INSERT INTO `suratkeluar` (`id`, `no_suratkeluar`, `penerima`, `tanggalkeluar`, `waktu`, `perihal`, `nim`, `idOrganisasi`) VALUES
(6, '2112', 'ketua', '11-11-11', '20:12', 'undangan', 670117455, 5),
(7, '004', 'Ketua Search', '2020-02-01', '16:00', 'Seminar', 670117455, 5),
(8, '002', 'Ketua Search', '2020-04-03', '19:00', 'Ulang tahun Himpunan', 670117410, 1),
(9, '004', 'Ketua Wapala', '2020-10-03', '19:00', 'Seminar', 670117410, 1),
(10, '003', 'Ketua Search', '2020-01-01', '20:00', 'Seminar Pembangunan', 670117410, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_thnAjaran` int(5) NOT NULL,
  `tahunAjaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_thnAjaran`, `tahunAjaran`) VALUES
(1, '2019-2020'),
(2, '2020-2021'),
(3, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `no_tiket` int(10) NOT NULL,
  `nama` varchar(255) COLLATE utf8_bin NOT NULL,
  `nim` varchar(255) COLLATE utf8_bin NOT NULL,
  `jurusan` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `jumlah` varchar(255) COLLATE utf8_bin NOT NULL,
  `total` varchar(255) COLLATE utf8_bin NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_kegiatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`no_tiket`, `nama`, `nim`, `jurusan`, `email`, `jumlah`, `total`, `metode_pembayaran`, `status`, `id_kegiatan`) VALUES
(12, 'Shinta Fitria', '6701174233', 'D3 Sistem Informasi', 'shintafitria2@gmail.com', '2', '40000', 'Transfer', 'Accepted', 14);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_total_kas`
-- (See below for the actual view)
--
CREATE TABLE `view_total_kas` (
`Total Kas` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Structure for view `view_total_kas`
--
DROP TABLE IF EXISTS `view_total_kas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_kas`  AS  select sum(`kas`.`pemasukan_kas`) - sum(`kas`.`pengeluaran_kas`) AS `Total Kas` from `kas` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ang_organisasi`
--
ALTER TABLE `ang_organisasi`
  ADD KEY `fk_idOrganisasi` (`idOrganisasi`),
  ADD KEY `fk_nim_anggota` (`nim`);

--
-- Indexes for table `datauser`
--
ALTER TABLE `datauser`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`idDept`),
  ADD UNIQUE KEY `idOrganisasi` (`idOrganisasi`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`),
  ADD KEY `fk_idOrganisasii` (`idOrganisasi`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `id_programkerja` (`id_programkerja`);

--
-- Indexes for table `lpj`
--
ALTER TABLE `lpj`
  ADD PRIMARY KEY (`id_lpj`),
  ADD UNIQUE KEY `id_kegiatan` (`id_kegiatan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`idOrganisasi`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD KEY `id_thnAjaran` (`id_thnAjaran`) USING BTREE,
  ADD KEY `fk_organisasi` (`idOrganisasi`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `nim` (`nim`) USING BTREE,
  ADD KEY `id_kegiatan` (`id_kegiatan`) USING BTREE;

--
-- Indexes for table `programkerja`
--
ALTER TABLE `programkerja`
  ADD PRIMARY KEY (`id_programkerja`),
  ADD KEY `idOrganisasi` (`idOrganisasi`) USING BTREE;

--
-- Indexes for table `rapat`
--
ALTER TABLE `rapat`
  ADD PRIMARY KEY (`id_rapat`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`) USING BTREE,
  ADD KEY `fk_idorganisasi3` (`idOrganisasi`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_thnAjaran`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`no_tiket`),
  ADD KEY `id_kegiatan` (`id_kegiatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `idDept` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lpj`
--
ALTER TABLE `lpj`
  MODIFY `id_lpj` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `idOrganisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programkerja`
--
ALTER TABLE `programkerja`
  MODIFY `id_programkerja` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rapat`
--
ALTER TABLE `rapat`
  MODIFY `id_rapat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_thnAjaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `no_tiket` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ang_organisasi`
--
ALTER TABLE `ang_organisasi`
  ADD CONSTRAINT `fk_idOrganisasi` FOREIGN KEY (`idOrganisasi`) REFERENCES `organisasi` (`idOrganisasi`),
  ADD CONSTRAINT `fk_nim_anggota` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);

--
-- Constraints for table `departemen`
--
ALTER TABLE `departemen`
  ADD CONSTRAINT `departemen_ibfk_1` FOREIGN KEY (`idOrganisasi`) REFERENCES `organisasi` (`idOrganisasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kas`
--
ALTER TABLE `kas`
  ADD CONSTRAINT `fk_idOrganisasii` FOREIGN KEY (`idOrganisasi`) REFERENCES `organisasi` (`idOrganisasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`id_programkerja`) REFERENCES `programkerja` (`id_programkerja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lpj`
--
ALTER TABLE `lpj`
  ADD CONSTRAINT `lpj_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `fk_organisasi` FOREIGN KEY (`idOrganisasi`) REFERENCES `organisasi` (`idOrganisasi`),
  ADD CONSTRAINT `fk_thnAjaran` FOREIGN KEY (`id_thnAjaran`) REFERENCES `tahun_ajaran` (`id_thnAjaran`),
  ADD CONSTRAINT `pengurus_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `fk_mahasiswa` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `presensi_ibfk_2` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programkerja`
--
ALTER TABLE `programkerja`
  ADD CONSTRAINT `pk` FOREIGN KEY (`idOrganisasi`) REFERENCES `organisasi` (`idOrganisasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rapat`
--
ALTER TABLE `rapat`
  ADD CONSTRAINT `rapat_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `pengurus` (`nim`);

--
-- Constraints for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  ADD CONSTRAINT `fk_idorganisasi3` FOREIGN KEY (`idOrganisasi`) REFERENCES `organisasi` (`idOrganisasi`),
  ADD CONSTRAINT `suratkeluar_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `pengurus` (`nim`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
