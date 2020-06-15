-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 07:46 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

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
(670117400, 'Yusril Wahyuda', 1, 'Anggota Divisi Sosial'),
(670117403, 'Gifari Abi Waqqash', 1, 'Anggota Devisi Olahraga'),
(670117406, 'Sherli Yualinda', 1, 'Anggota Divisi Sosial');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `isi` text COLLATE utf8_bin DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `isi`, `gambar`, `tanggal`) VALUES
(1, 'Anak Yang Terasingkan', 'Anak terlihat diasingkan di depan pertokoan', 'bagan.PNG', '2020-05-28 05:32:23'),
(2, 'Luxurious 2020', 'Mengundang onadio', 'index.png', '2020-05-28 05:35:35'),
(3, 'Ragam Kriteria Daerah yang Boleh Terapkan New Normal di Tengah Wabah', 'Pemerintah tengah menggodok protokol tatanan normal yang baru atau new normal di tengah pandemi virus Corona baru (COVID-19). Ada dua kriteria daerah yang akan menerapkan new normal.\r\n\"Adapun untuk daerah yang nantinya akan dibuka, dapat kami sampaikan ada 2 kriteria di sini,\" kata Ketua Gugus Tugas Penanganan COVID-19 Doni Monardo saat konferensi pers di YouTube Setpres, Rabu (25/7/2020).\r\n\r\nKriteria pertama adalah daerah-daerah yang sama sekali belum ada kasus Corona. Tercatat, terdapat sebanyak 110 kabupaten/kota di mana terdiri dari 87 di wilayah daratan, dan 23 di wilayah kepulauan, kemudian kecuali Papua.\r\n\"Makanya yang akan nantinya diberikan tawaran untuk membuka adalah 87 kabupaten/kota, yaitu 65 di wilayah daratan, dan 22 di wilayah kepulauan,\" jelas Doni.\r\nDoni mengatakan daerah-daerah yang akan dibuka atau dilonggarkan aktivitasnya adalah daerah yang nyaris steril. Meski begitu, Doni meminta semua daerah tetap waspada dari Corona.\r\n\r\n\"Daerah-daerah ini nyaris steril dari ancaman COVID, tetapi belum tentu selamanya akan tetap aman,\" ucapnya.\r\n\r\nAlasan mengapa daerah itu nyaris steril dari kasus Corona adalah tingginya tingkat kesadaran masyarakat dan kepatuhan masyarakat terhadap protokol kesehatan. Daerah ini, kata Doni, juga daerah yang jarang dikunjungi oleh wisatawan asing.\r\n\r\n\"Minggu lalu kami telah komunikasi dengan para pimpinan dan bupati, wali kota tentang kenapa daerah mereka aman COVID, setelah pemaparan yang diberikan, maka dapat disimpulkan bahwa yang pertama tingkat kesadaran dan kepatuhan masyarakat tinggi, kemudian kerja sama antar-tokoh di daerah, baik pemerintah daerah maupun unsur tokoh nonformal lainnya sampai tingkat RT dan RW,\" jelasnya.', '2682f0ab-0b82-4729-bd16-9218e56c5121_169.jpeg', '2020-05-28 06:01:28');

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
  `foto` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_programkerja` int(10) NOT NULL,
  `upload_lpj` tinyint(255) DEFAULT 0 COMMENT '1 = sudah upload , 0 belum upload'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `waktu`, `tempat`, `harga`, `qr_code`, `foto`, `id_programkerja`, `upload_lpj`) VALUES
(14, 'Seminar Android', '2020-05-05', 'Aula Fakultas Ilmu Terapan', '20000', 'Seminar UX .png', 'index1.png', 10, 1),
(15, 'Bakti Sosial COVID 19', '2020-05-05', 'Telkom University', '20000', 'Bakti Sosial COVID 19.png', '', 11, 0),
(16, 'Voli Competition', '2020-06-07', 'Batununggal Sport Center', '20000', 'Voli Competition.png', '', 5, 1),
(19, 'Sepak Bola Bersama', '2020-07-08', 'Batununggal Sport Center', '10000', 'Sepak Bola Bersama.png', '', 7, 1),
(20, 'MANIAC 2021', '2021-08-08', 'Batununggal Sport Center', '20000', 'MANIAC 2021.png', '', 7, 0),
(21, 'Badminton Competition', '2020-05-14', 'Aula Fakultas Ilmu Terapan', '20000', 'Badminton Competition.png', '', 7, 0),
(22, 'Seminar UX ', '2020-08-07', 'Aula Fakultas Ilmu Terapan', 'Free', 'Seminar UX .png', '', 7, 0),
(23, 'Seminar Pembangunan', '2020-09-02', 'Aula Fakultas Ilmu Terapan', '20000', 'Seminar Pembangunan.png', '', 5, 0),
(24, 'COVID 19', '2020-08-01', 'Lapangan FIT', 'Free', 'COVID 19.png', '107928881-profile-head-shot-from-red-blotched-tabby-american-curl-cat-kitten-looking-at-the-side-isolated-on-w.jpg', 5, 0),
(25, 'Seminar Kotlin', '2020-07-01', 'Aula Fakultas Ilmu Terapan', '10000', 'Seminar Kotlin.png', '', 10, 0),
(26, 'Bantuan Panti Asuhan', '2020-08-01', 'Lapangan FIT', '20000', 'Bantuan Panti Asuhan.png', '', 11, 0),
(27, 'Ping pong', '2020-08-01', 'Batununggal Sport Center', '10000', 'Ping pong.png', '', 7, 0),
(28, 'Badminton Competition', '2020-07-01', 'Batununggal Sport Center', '20000', '.png', '', 5, 0),
(29, 'Tenis Lapangan', '2020-08-01', 'Batununggal Sport Center', '20000', '.png', '', 7, 0),
(30, 'Archery', '2020-08-01', 'Batununggal Sport Center', '20000', 'Archery.png', '', 7, 0);

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
(3, '9586_TP32.pdf', 16),
(4, '6701174033_Registrasi___Telkom_University1.pdf', 19),
(5, '5__LEMBAR_AKTIVITAS_HARIAN_MAGANG_Gifari.pdf', 14);

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
(1, 'HMDSI', 'HMDSI adalah Himpunan Mahasiswa D3 Sistem Informasi, Organisasi Mahasiswa adalah wadah untuk penyaluran bakat buat KEMA untuk menyalurkan potensi-potensi yang ada pada diri kita. Selain potensi dalam akademik', '5d458932f2c4f50297475fe9aa1c2d36.png', 'kelvin'),
(2, 'SAMALOWA', 'UKM Lombok Sumbawa, Organisasi Mahasiswa adalah wadah untuk penyaluran bakat buat KEMA untuk menyalurkan potensi-potensi yang ada pada diri kita. Selain potensi dalam akademik', '0b9b5daa9df9de0b50cef003221ffb5b.jpg', 'Esa'),
(4, 'PERMALA', 'Mahasiswa Lampung, Organisasi Mahasiswa adalah wadah untuk penyaluran bakat buat KEMA untuk menyalurkan potensi-potensi yang ada pada diri kita. Selain potensi dalam akademik', '811539bf69c57ce8660fce77201a6a31.jpg', 'Deva'),
(5, 'SEARCH', 'Search adalah ukm lomba dan Organisasi Mahasiswa adalah wadah untuk penyaluran bakat buat KEMA untuk menyalurkan potensi-potensi yang ada pada diri kita. Selain potensi dalam akademik', '201a283dc472a6733bc943460775c71f.jpg', 'riko');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `nim` int(10) NOT NULL,
  `id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `idOrganisasi` int(11) NOT NULL,
  `id_thnAjaran` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`nim`, `id`, `nama`, `jabatan`, `idOrganisasi`, `id_thnAjaran`) VALUES
(670117403, 1, 'Gifari Abi Waqqash', 'Kepala Divisi Luar Negeri', 5, 1),
(670117455, 2, 'Eko Adinata', 'Sekertaris', 5, 1),
(670117410, 4, 'Muhammad Luqman', 'Sekretaris', 5, 1),
(670117403, 5, 'Gifari Abi Waqqash', '', 1, 1),
(670117410, 6, 'Muhammad Luqman', 'Sekretaris', 1, 1),
(670117400, 7, 'Yusril Wahyuda', '', 1, 1),
(670117406, 10, 'Sherli Yualinda', '', 1, 1);

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

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id_presensi`, `waktu_submit`, `status`, `nim`, `id_kegiatan`) VALUES
(1, '2020-06-05 05:44:44', 'Hadir', 670606006, 14),
(2, '2020-06-05 05:44:44', 'Hadir', 670117400, 19),
(3, '2020-06-11 17:09:32', 'Hadir', 670117410, 14),
(5, '2020-06-11 17:17:22', 'Hadir', 670117400, 14),
(8, '2020-06-14 05:24:37', 'Hadir', 670117403, 24),
(9, '2020-06-14 17:22:06', 'Hadir', 670117410, 24);

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
  `nim` int(10) NOT NULL,
  `id_organisasi` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `rapat`
--

INSERT INTO `rapat` (`id_rapat`, `perihal`, `tempat`, `tanggal`, `waktu`, `kategori`, `nim`, `id_organisasi`) VALUES
(1, 'Rapat Rutin', 'Ruang G6 FIT', '2020-10-02', '19:00', 'Pengurus', 670117410, 1),
(2, 'Coba 1', 'Telkom', '2020-05-16', '1700', 'Pengurus', 670117410, 2);

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
(3, '2021-2022'),
(4, '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `no_tiket` int(10) NOT NULL,
  `nama` varchar(255) COLLATE utf8_bin NOT NULL,
  `nimAkun` int(10) NOT NULL,
  `nim` varchar(255) COLLATE utf8_bin NOT NULL,
  `jurusan` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `total` varchar(255) COLLATE utf8_bin NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_kegiatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`no_tiket`, `nama`, `nimAkun`, `nim`, `jurusan`, `email`, `total`, `metode_pembayaran`, `status`, `id_kegiatan`) VALUES
(12, 'Shinta Fitria', 0, '6701174233', 'D3 Sistem Informasi', 'shintafitria2@gmail.com', '40000', 'Transfer', 'Accepted', 14),
(13, 'GIfari Abi Waqqash', 0, '6701174033', 'D3 Sistem Informasi', 'gifariabi75@gmail.com', '40000', 'Cash', 'Accepted', 14),
(14, 'Eko', 0, '6701174033', 'SI Teknik Informatika', 'gifariabi75@gmail.com', '40000', 'Transfer', 'Accepted', 14),
(15, 'Eko', 0, '6701174033', 'D3 Sistem Informasi', 'gifariabi9@gmail.com', '0', 'Transfer', 'Menunggu', 22),
(16, 'Yulia', 0, '6701174022', 'D3 Seni Budaya', 'gifariabi9@gmail.com', '20000', 'Transfer', 'Menunggu', 20),
(17, 'Anton', 0, '6701175533', 'D3 Sepakbola', 'anton@gmail.com', '20000', 'Transfer', 'Menunggu', 19),
(18, 'GIfari Abi Waqqash', 0, '6701174233', 'SI Teknik Informatika', 'gifariabi75@gmail.com', '20000', 'Transfer', 'Menunggu', 15),
(19, 'Sherli Y', 0, '6701174033', 'D3 Sistem Informasi', 'sherliyualinda@gmail.com', '20000', 'Transfer', 'Menunggu', 16),
(20, 'Sherla Y', 0, '670117406', 'D3 Sistem Informasi', 'sherlayualinda@gmail.com', '20000', 'Transfer', 'Menunggu', 16),
(21, 'Luqm', 0, '670117410', 'D3 Sistem Informasi', 'luqman@gmail.com', '20000', 'Transfer', 'Menunggu', 16),
(22, 'Sem', 670117410, '6701174033', 'D3 Sistem Informasi', 'gifariabi9@gmail.com', '20000', 'Transfer', 'Menunggu', 15),
(23, 'fajarrr', 670117410, 'fajarrr', 'fajarrr', 'emluqman194@gmail.com', '20,000', 'Transfer', 'Menunggu', 16),
(24, 'fajarrr', 670117410, 'fajarrr', 'fajarrr', 'emluqman194@gmail.com', '20,000', 'Transfer', 'Menunggu', 16),
(25, 'luwmann', 670117410, 'luwmnann', 'bfbebe', 'hbeve@gmail.com', '20,000', 'Transfer', 'Menunggu', 16),
(26, 'gitari', 670117403, '505050', 'gitari', 'gitari@gmail.com', '0', 'Transfer', 'Menunggu', 24),
(27, 'gifari abi', 670117403, '670117403', 'd3 si', 'gifari@gmail.com', '0', 'Transfer', 'Menunggu', 24),
(28, 'gifari', 670117403, '670117403', 'd3 si', 'emluqman194@gmail.com', '20,000', 'Cash', 'Menunggu', 23),
(29, 'gifari', 670117403, '670771584', 'D3 SI', 'gipati@gmail.com', '20,000', 'Transfer', 'Menunggu', 23),
(30, 'gipari', 670117403, '670014789', 'd3 telco', 'gipari@gmail.com', '0', 'Transfer', 'Menunggu', 24),
(31, 'luqman', 670117410, '670117410', 'desi', 'emluqman194@gmail.com', '0', 'Transfer', 'Menunggu', 24);

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
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

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
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `nim` (`nim`),
  ADD KEY `rapat_idOrganisasi` (`id_organisasi`);

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
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_kegiatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `lpj`
--
ALTER TABLE `lpj`
  MODIFY `id_lpj` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `idOrganisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `programkerja`
--
ALTER TABLE `programkerja`
  MODIFY `id_programkerja` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rapat`
--
ALTER TABLE `rapat`
  MODIFY `id_rapat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_thnAjaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `no_tiket` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  ADD CONSTRAINT `rapat_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `pengurus` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rapat_idOrganisasi` FOREIGN KEY (`id_organisasi`) REFERENCES `organisasi` (`idOrganisasi`);

--
-- Constraints for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  ADD CONSTRAINT `fk_idorganisasi3` FOREIGN KEY (`idOrganisasi`) REFERENCES `organisasi` (`idOrganisasi`),
  ADD CONSTRAINT `suratkeluar_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `pengurus` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
