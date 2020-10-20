-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2020 at 03:59 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `datang` time DEFAULT NULL,
  `pulang` time DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `prakerin_siswa_id` int(11) NOT NULL,
  `status_kehadiran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aspek_penilaian`
--

CREATE TABLE `aspek_penilaian` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `nama_sekolah_id` int(11) NOT NULL,
  `kelompok_penilaian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aspek_penilaian`
--

INSERT INTO `aspek_penilaian` (`id`, `nama`, `nama_sekolah_id`, `kelompok_penilaian_id`) VALUES
(1, 'Disiplin', 22, 5);

-- --------------------------------------------------------

--
-- Table structure for table `gol_darah`
--

CREATE TABLE `gol_darah` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gol_darah`
--

INSERT INTO `gol_darah` (`id`, `nama`) VALUES
(4, 'A'),
(5, 'B'),
(6, 'AB'),
(7, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'Pembimbing Sekolah', 'Pembimbing');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id` int(1) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id`, `nama`) VALUES
(1, 'Laki-laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_user`
--

CREATE TABLE `jenis_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis_user`
--

INSERT INTO `jenis_user` (`id`, `nama`) VALUES
(1, 'administrator'),
(2, 'siswa'),
(3, 'pembimbing sekolah'),
(7, 'pembimbing unit');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `mulai` time DEFAULT NULL,
  `selesai` time DEFAULT NULL,
  `uraian_kegiatan` text DEFAULT NULL,
  `sarana` text DEFAULT NULL,
  `prakerin_siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`) VALUES
(18, 'RPL2'),
(19, 'ANM2');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_penilaian`
--

CREATE TABLE `kelompok_penilaian` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelompok_penilaian`
--

INSERT INTO `kelompok_penilaian` (`id`, `nama`) VALUES
(4, 'Kepribadian'),
(5, 'Kedisiplinan'),
(6, 'produktivitas');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nama_sekolah`
--

CREATE TABLE `nama_sekolah` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `hp` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nama_sekolah`
--

INSERT INTO `nama_sekolah` (`id`, `nama`, `alamat`, `hp`, `logo`) VALUES
(22, 'SMK NEGERI 1 CIOMAS', 'nio', '66', NULL),
(23, 'SMK NEGERI 1 CIBINONG', 'cibinong permai', '98989', NULL),
(24, 'SMK PGRI', 'BOGOR', '434234', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing_sekolah`
--

CREATE TABLE `pembimbing_sekolah` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `no_hp` varchar(45) DEFAULT NULL,
  `nama_sekolah_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembimbing_sekolah`
--

INSERT INTO `pembimbing_sekolah` (`id`, `nama`, `no_hp`, `nama_sekolah_id`) VALUES
(3, 'Sample', '088577', 22),
(29, 'Tubagus', '085210245332', 24);

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing_unit`
--

CREATE TABLE `pembimbing_unit` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `no_hp` varchar(45) DEFAULT NULL,
  `nip` varchar(45) DEFAULT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembimbing_unit`
--

INSERT INTO `pembimbing_unit` (`id`, `nama`, `no_hp`, `nip`, `unit_id`) VALUES
(4, 'Asep Mulyana', '084', '13213', 5),
(30, 'Udin Saprudin', '0852', '34131341', 6);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `nilai_angka` float DEFAULT NULL,
  `nilai_huruf` varchar(45) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `prakerin_siswa_id` int(11) NOT NULL,
  `aspek_penilaian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permasalahan`
--

CREATE TABLE `permasalahan` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `masalah` text DEFAULT NULL,
  `solusi` text DEFAULT NULL,
  `oleh` varchar(45) DEFAULT NULL,
  `prakerin_siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prakerin_siswa`
--

CREATE TABLE `prakerin_siswa` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `jabatan_pembimbing` varchar(255) DEFAULT NULL,
  `siswa_id` int(11) NOT NULL,
  `pembimbing_unit_id` int(11) NOT NULL,
  `pembimbing_sekolah_id` int(11) NOT NULL,
  `jabatan_pembimbing_sekolah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prakerin_siswa`
--

INSERT INTO `prakerin_siswa` (`id`, `unit_id`, `kelas_id`, `tanggal_mulai`, `tanggal_selesai`, `jabatan_pembimbing`, `siswa_id`, `pembimbing_unit_id`, `pembimbing_sekolah_id`, `jabatan_pembimbing_sekolah`) VALUES
(33, 5, 19, '2017-01-30', '2017-01-31', 'sekertariat', 21, 4, 3, 'kepala sekolah'),
(34, 5, 18, '2017-01-26', '2017-02-27', 'Kasubdit', 27, 4, 3, 'kepala sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `program_keahlian`
--

CREATE TABLE `program_keahlian` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_keahlian`
--

INSERT INTO `program_keahlian` (`id`, `nama`) VALUES
(5, 'RPL'),
(6, 'ANIMASI'),
(7, 'TKR'),
(8, 'LAS'),
(10, 'MULTIMEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `rencana_kegiatan`
--

CREATE TABLE `rencana_kegiatan` (
  `id` int(11) NOT NULL,
  `uraian_kegiatan` varchar(45) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `prakerin_siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `nomor_induk` varchar(45) DEFAULT NULL,
  `tempat_lahir` varchar(45) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `ayah` varchar(45) DEFAULT NULL,
  `ibu` varchar(45) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kabkot` varchar(45) DEFAULT NULL,
  `catatan_kesehatan` text DEFAULT NULL,
  `nama_sekolah_id` int(11) NOT NULL,
  `program_keahlian_id` int(11) NOT NULL,
  `gol_darah_id` int(11) NOT NULL,
  `jenis_kelamin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `foto`, `nomor_induk`, `tempat_lahir`, `tanggal_lahir`, `ayah`, `ibu`, `alamat`, `kabkot`, `catatan_kesehatan`, `nama_sekolah_id`, `program_keahlian_id`, `gol_darah_id`, `jenis_kelamin_id`) VALUES
(21, 'febri', NULL, '6153545', 'Bogor', NULL, 'jyet', 'tbuyb4', 'yb4u', 'ywb', NULL, 22, 6, 5, 0),
(23, 'siswa b', NULL, '3256464525', 'bogor', '2000-01-01', 'dtce', ' ete', 'yryec', 't3e', NULL, 22, 10, 5, 0),
(27, 'Ihsan Arif', 'PHOTO27.png', '0821309', 'Kota Tasikmalaya', '1992-10-02', 'ihsan', 'ihsan', 'Tegal Manggah No 10A RT 04 RW 06 Kelurahan Tegal Lega Kecamatan Bogor Tengah Kota Bogor (Masuk gang TK Mexindo, Posisi Rumah Setengah Tanjakan, sebelah kanan tanjakan ada Rumah Merah)', 'Bogor Tengah, Kota Bogor', NULL, 22, 5, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_kehadiran`
--

CREATE TABLE `status_kehadiran` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_kehadiran`
--

INSERT INTO `status_kehadiran` (`id`, `nama`) VALUES
(1, 'Izin'),
(2, 'Sakit'),
(3, 'Alfa');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `bidang` varchar(45) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `nama`, `bidang`, `alamat`) VALUES
(5, 'Direktorat Integrasi Data dan Sistem Informas', 'Sistem Informasi', 'Gedung Perpustakaan Lantai 2 Institut Pertanian Bogor Dramaga'),
(6, 'Publisher Andi', 'Penerbit', 'Ciapus');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `jenis_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `jenis_user_id`) VALUES
(0, NULL, NULL, 2),
(2, 'siswa@gmail.com', 'password', 2),
(3, 'pembimbing@gmail.com', 'password', 3),
(4, 'pembimbing.unit@gmail.com', 'password', 7),
(11, 'rahman@gmail.com', '12345678', 2),
(12, 'vini@gmail.com', 'vini1234567', 2),
(14, 'dina@gmail.com', 'dina', 2),
(15, 'mele@gmail.com', '12345678', 2),
(17, 'nana@gmail.com', 'abcdefghij', 2),
(18, 'ada@gmail.com', 'qwertyuio', 2),
(19, 'hikmah@gmail.com', 'hikmah', 2),
(20, 'salsa@gmail.com', 'salsa12345678', 2),
(21, 'febri@gmail.com', 'febri12345678', 2),
(23, 'siswab@admin.com', 'siswab12345', 2),
(25, 'siswaz@gmail.com', 'siswaz12345678', 2),
(27, 'ihsanarifr@hotmail.com', 'Rahman13', 2),
(29, 'pempgri', 'password', 3),
(30, 'pemunit001@yahoo.com', 'password', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'As034EW04Z0VnC/ZL4aqYe', 1268889823, 1596872812, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '127.0.0.1', 'siswa@gmail.com', '$2y$08$PAzcc2XEvEUCdTi0biefhetobZSv7v6iUWccceZcDDlvvbBgfTdFW', NULL, 'siswa@gmail.com', NULL, NULL, NULL, 'xdfbYkIM4pGSJCS5Ghsr4u', 1480452665, 1577344949, 1, 'siswa', 'siswa', 'siswa', '085222828740'),
(3, '127.0.0.1', 'pembimbing@gmail.com', '$2y$08$dNIbRJSDubhfsNquzD3VJ.zgTYHfrL6ID3Si38B2QOt7IsaTc9bQS', NULL, 'pembimbing@gmail.com', NULL, NULL, NULL, NULL, 1480452705, 1480475958, 1, 'Pembimbing Sekolah', 'pembimbing', 'pembimbing', '085222828740'),
(4, '127.0.0.1', 'pembimbing.unit@gmail.com', '$2y$08$4lQmX90l4UIpxNj7ew4bJ.jCNP8Gi3QZQ7k7EO3KAN/70wISRcj7m', NULL, 'pembimbing.unit@gmail.com', NULL, NULL, NULL, NULL, 1482209254, NULL, 1, 'Pembimbing Unit', 'pembimbing', 'DIDSI', '085222828740'),
(5, '::1', 'ihsan@gmail.com', '$2y$08$EhzefYwrJhj12C2YlaGWseAoWTBSp26ohg.j7SwaoqPIMkYvBQ7hG', NULL, 'ihsan@gmail.com', NULL, NULL, NULL, NULL, 1483676820, 1484884195, 1, 'a', 'a', 'a', '0'),
(7, '127.0.0.1', 'ihsan@ihsan.com', '$2y$08$BcxAhpTFz0Hq8XlbFJwawuSPdnj6qip/m6CgPSK.xRCdnPOOibEHe', NULL, 'ihsan@ihsan.com', NULL, NULL, NULL, NULL, 1483787100, 1483787236, 1, 'Ben', 'Edmunds', 'as', '085222828740'),
(8, '::1', 'tetst@gmail.com', '$2y$08$y4ssvgoX4ulWZeDyFvStW.bc9jZ5A9pRRFvH3wy28xwclAHrrlpIS', NULL, 'tetst@gmail.com', NULL, NULL, NULL, NULL, 1484189195, NULL, 1, 'q', NULL, NULL, NULL),
(9, '::1', 'bla@gmail.com', '$2y$08$dB6w5/EgV19MosBmabt5sOaAYcUVpVPL9MB07BJGhRo5Qmdo59aFO', NULL, 'bla@gmail.com', NULL, NULL, NULL, NULL, 1484189342, NULL, 1, 'bla', NULL, NULL, NULL),
(11, '::1', 'rahman@gmail.com', '$2y$08$tmr1.JdPnM6zwRzWDkwS8uyjYE/7wdxZhpQlFxLyM2abt43WCP.SW', NULL, 'rahman@gmail.com', NULL, NULL, NULL, NULL, 1484546473, NULL, 1, 'ANM2', NULL, NULL, NULL),
(12, '::1', 'vini@gmail.com', '$2y$08$fLaWMAE5d7EqU8HJxezzvuaAiiOpTJbIHFsfC1k5Yz/QGmCODyK3.', NULL, 'vini@gmail.com', NULL, NULL, NULL, NULL, 1484547719, NULL, 1, 'ggq', NULL, NULL, NULL),
(14, '::1', 'dina@gmail.com', '$2y$08$w3uiHGbsnOCKfBddBkJl3.8L7myNNayZl59HwStte9q74tvqWhXKy', NULL, 'dina@gmail.com', NULL, NULL, NULL, NULL, 1484706557, 1577345276, 1, 'dina anjani', NULL, NULL, NULL),
(15, '::1', 'mele@gmail.com', '$2y$08$GZC7HHEBNRQcYpbl8liN7usDHnQmUfV/85o5wgywlFcWR/1ib26Ne', NULL, 'mele@gmail.com', NULL, NULL, NULL, NULL, 1484711745, NULL, 1, 'melee', NULL, NULL, NULL),
(16, '::1', 'andini@gmail.com', '$2y$08$VXTCnFqDTD23g50zTBercOURxJb/bd9tFiYd.dG0nygsZRVJrEZKm', NULL, 'andini@gmail.com', NULL, NULL, NULL, NULL, 1484726345, NULL, 1, 'andini', NULL, NULL, NULL),
(17, '::1', 'nana@gmail.com', '$2y$08$QHntVUJDyr8xFCxsc1PWLerxjswzVS0JhXcHn7McNsGLu7qN8akXy', NULL, 'nana@gmail.com', NULL, NULL, NULL, NULL, 1484726554, NULL, 1, 'nananana', NULL, NULL, NULL),
(18, '::1', 'ada@gmail.com', '$2y$08$octBYRIcn415xGIc0FcgL.Va4M7AywKz7rbWs.B3sInwiPYrNVK6a', NULL, 'ada@gmail.com', NULL, NULL, NULL, NULL, 1484727059, NULL, 1, 'aaaa', NULL, NULL, NULL),
(19, '::1', 'hikmah@gmail.com', '$2y$08$ZKevfbX.FeY1XnW8cl8f/.JICk.BmQDdQ6g.Q7lsu74sk/HgoD7WO', NULL, 'hikmah@gmail.com', NULL, NULL, NULL, NULL, 1485305070, NULL, 1, 'RPL', NULL, NULL, NULL),
(20, '::1', 'salsa@gmail.com', '$2y$08$iU1Tca1HRuukSjQNPSLDIuNicV/RH7IdKBz6NsESovcXGOip2kNMC', NULL, 'salsa@gmail.com', NULL, NULL, NULL, NULL, 1485399482, NULL, 1, 'salsa', NULL, NULL, NULL),
(21, '::1', 'febri@gmail.com', '$2y$08$NxZuguAKJ/N3qc.XDftHtebMKOIq5ewEiD54XrPNjLKcXeOYLuQpu', NULL, 'febri@gmail.com', NULL, NULL, NULL, NULL, 1485404240, NULL, 1, 'febri', NULL, NULL, NULL),
(23, '::1', 'siswab@admin.com', '$2y$08$OOuuRhcGNnLm1i7Acz7VGuFCx6x0mrctxPt2MpXsOYrv82./U59zS', NULL, 'siswab@admin.com', NULL, NULL, NULL, NULL, 1485414864, 1596865904, 1, 'siswa b', NULL, NULL, NULL),
(25, '::1', 'siswaz@gmail.com', '$2y$08$LIG18zWAT4U495VjWlr4R.ukxeqdEbtz8BF5.erkotyFWtPX5209q', NULL, 'siswaz@gmail.com', NULL, NULL, NULL, NULL, 1485499088, NULL, 1, 'siswaz', NULL, NULL, NULL),
(27, '127.0.0.1', 'ihsanarifr@hotmail.com', '$2y$08$Zsv7ZBY2RxPvWSrr7DbQEOegwmAVnBqYKE/xnOZPEBy/9foI9oca.', NULL, 'ihsanarifr@hotmail.com', NULL, NULL, NULL, NULL, 1485504974, 1485512077, 1, 'Ihsan Arif', NULL, NULL, NULL),
(29, '::1', 'pempgri', '$2y$08$XYxG.WfMwBVp3yYE5ea1vu6sd2UWWBmycCX7.9mRGqheTYVKxX7.C', NULL, 'pempgri', NULL, NULL, NULL, NULL, 1577347778, 1577347795, 1, 'Tubagus', NULL, NULL, NULL),
(30, '::1', 'pemunit001@yahoo.com', '$2y$08$HUaX1M96ge9hPRz6uqdncOUWBEM4ikPjKmZiBKWLp4fcIbIHu/D2y', NULL, 'pemunit001@yahoo.com', NULL, NULL, NULL, NULL, 1577347974, 1577348319, 1, 'Udin Saprudin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(9, 2, 2),
(6, 3, 3),
(16, 5, 2),
(14, 7, 1),
(17, 8, 2),
(18, 9, 2),
(20, 11, 2),
(21, 12, 2),
(23, 14, 2),
(24, 15, 2),
(25, 17, 2),
(26, 18, 2),
(27, 19, 2),
(28, 20, 2),
(29, 21, 2),
(31, 23, 2),
(33, 25, 2),
(35, 27, 2),
(37, 29, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_absensi_prakerin_siswa1_idx` (`prakerin_siswa_id`),
  ADD KEY `fk_absensi_status_kehadiran1_idx` (`status_kehadiran_id`);

--
-- Indexes for table `aspek_penilaian`
--
ALTER TABLE `aspek_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aspek_penilaian_nama_sekolah1_idx` (`nama_sekolah_id`),
  ADD KEY `fk_aspek_penilaian_kelompok_penilaian1_idx` (`kelompok_penilaian_id`);

--
-- Indexes for table `gol_darah`
--
ALTER TABLE `gol_darah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_user`
--
ALTER TABLE `jenis_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kegiatan_prakerin_siswa1_idx` (`prakerin_siswa_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok_penilaian`
--
ALTER TABLE `kelompok_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nama_sekolah`
--
ALTER TABLE `nama_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembimbing_sekolah`
--
ALTER TABLE `pembimbing_sekolah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembimbing_sekolah_user1_idx` (`id`),
  ADD KEY `fk_pembimbing_sekolah_nama_sekolah1_idx` (`nama_sekolah_id`);

--
-- Indexes for table `pembimbing_unit`
--
ALTER TABLE `pembimbing_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembimbing_unit_user1_idx` (`id`),
  ADD KEY `fk_pembimbing_unit_unit1_idx` (`unit_id`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penilaian_prakerin_siswa1_idx` (`prakerin_siswa_id`),
  ADD KEY `fk_penilaian_aspek_penilaian1_idx` (`aspek_penilaian_id`);

--
-- Indexes for table `permasalahan`
--
ALTER TABLE `permasalahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_permasalahan_prakerin_siswa1_idx` (`prakerin_siswa_id`);

--
-- Indexes for table `prakerin_siswa`
--
ALTER TABLE `prakerin_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prakerin_siswa_unit1_idx` (`unit_id`),
  ADD KEY `fk_prakerin_siswa_kelas1_idx` (`kelas_id`),
  ADD KEY `fk_prakerin_siswa_siswa1_idx` (`siswa_id`),
  ADD KEY `fk_prakerin_siswa_pembimbing_unit1_idx` (`pembimbing_unit_id`),
  ADD KEY `fk_prakerin_siswa_pembimbing_sekolah1_idx` (`pembimbing_sekolah_id`);

--
-- Indexes for table `program_keahlian`
--
ALTER TABLE `program_keahlian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rencana_kegiatan`
--
ALTER TABLE `rencana_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rencana_kegiatan_prakerin_siswa1_idx` (`prakerin_siswa_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_siswa_nama_sekolah_idx` (`nama_sekolah_id`),
  ADD KEY `fk_siswa_program_keahlian1_idx` (`program_keahlian_id`),
  ADD KEY `fk_siswa_gol_darah1_idx` (`gol_darah_id`),
  ADD KEY `fk_siswa_user1_idx` (`id`);

--
-- Indexes for table `status_kehadiran`
--
ALTER TABLE `status_kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_jenis_user1_idx` (`jenis_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aspek_penilaian`
--
ALTER TABLE `aspek_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gol_darah`
--
ALTER TABLE `gol_darah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_user`
--
ALTER TABLE `jenis_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kelompok_penilaian`
--
ALTER TABLE `kelompok_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nama_sekolah`
--
ALTER TABLE `nama_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permasalahan`
--
ALTER TABLE `permasalahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prakerin_siswa`
--
ALTER TABLE `prakerin_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `program_keahlian`
--
ALTER TABLE `program_keahlian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rencana_kegiatan`
--
ALTER TABLE `rencana_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_kehadiran`
--
ALTER TABLE `status_kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absensi_prakerin_siswa1` FOREIGN KEY (`prakerin_siswa_id`) REFERENCES `prakerin_siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_absensi_status_kehadiran1` FOREIGN KEY (`status_kehadiran_id`) REFERENCES `status_kehadiran` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `aspek_penilaian`
--
ALTER TABLE `aspek_penilaian`
  ADD CONSTRAINT `fk_aspek_penilaian_kelompok_penilaian1` FOREIGN KEY (`kelompok_penilaian_id`) REFERENCES `kelompok_penilaian` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aspek_penilaian_nama_sekolah1` FOREIGN KEY (`nama_sekolah_id`) REFERENCES `nama_sekolah` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `fk_kegiatan_prakerin_siswa1` FOREIGN KEY (`prakerin_siswa_id`) REFERENCES `prakerin_siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pembimbing_sekolah`
--
ALTER TABLE `pembimbing_sekolah`
  ADD CONSTRAINT `fk_pembimbing_sekolah_nama_sekolah1` FOREIGN KEY (`nama_sekolah_id`) REFERENCES `nama_sekolah` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pembimbing_sekolah_user1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pembimbing_unit`
--
ALTER TABLE `pembimbing_unit`
  ADD CONSTRAINT `fk_pembimbing_unit_unit1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pembimbing_unit_user1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_penilaian_aspek_penilaian1` FOREIGN KEY (`aspek_penilaian_id`) REFERENCES `aspek_penilaian` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penilaian_prakerin_siswa1` FOREIGN KEY (`prakerin_siswa_id`) REFERENCES `prakerin_siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permasalahan`
--
ALTER TABLE `permasalahan`
  ADD CONSTRAINT `fk_permasalahan_prakerin_siswa1` FOREIGN KEY (`prakerin_siswa_id`) REFERENCES `prakerin_siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prakerin_siswa`
--
ALTER TABLE `prakerin_siswa`
  ADD CONSTRAINT `fk_prakerin_siswa_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prakerin_siswa_pembimbing_sekolah1` FOREIGN KEY (`pembimbing_sekolah_id`) REFERENCES `pembimbing_sekolah` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prakerin_siswa_pembimbing_unit1` FOREIGN KEY (`pembimbing_unit_id`) REFERENCES `pembimbing_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prakerin_siswa_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prakerin_siswa_unit1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rencana_kegiatan`
--
ALTER TABLE `rencana_kegiatan`
  ADD CONSTRAINT `fk_rencana_kegiatan_prakerin_siswa1` FOREIGN KEY (`prakerin_siswa_id`) REFERENCES `prakerin_siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_gol_darah1` FOREIGN KEY (`gol_darah_id`) REFERENCES `gol_darah` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_siswa_nama_sekolah` FOREIGN KEY (`nama_sekolah_id`) REFERENCES `nama_sekolah` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_siswa_program_keahlian1` FOREIGN KEY (`program_keahlian_id`) REFERENCES `program_keahlian` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_siswa_user1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_jenis_user1` FOREIGN KEY (`jenis_user_id`) REFERENCES `jenis_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
