-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2022 at 11:22 AM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dXku1KycHO`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` varchar(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `thumbnail` text NOT NULL,
  `content` longtext NOT NULL,
  `id_kategori` varchar(200) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `published_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `title`, `slug`, `thumbnail`, `content`, `id_kategori`, `created_at`, `published_at`) VALUES
('BA001', 'ubah sampah jadi emas, bank sampah universitas budi luhur jaksel juara umum tingkat nasional    artikel ini telah tayang di tribunjakarta.com dengan judul ubah sampah jadi emas, bank sampah universitas budi luhur jaksel juara umum tingkat nasional', 'ubah-sampah-jadi-emas,-bank-sampah-universitas-budi-luhur-jaksel-juara-umum-tingkat-nasional----artikel-ini-telah-tayang-di-tribunjakarta.com-dengan-judul-ubah-sampah-jadi-emas,-bank-sampah-universitas-budi-luhur-jaksel-juara-umum-tingkat-nasional', '6284b7200e6fa.jpeg', '<p><strong>TRIBUNJAKARTA.COM, PESANGGRAHAN -</strong> Bank Sampah <a href=\"https://jakarta.tribunnews.com/tag/universitas-budi-luhur\" target=\"_blank\">Universitas&nbsp;Budi&nbsp;Luhur</a>, Pesanggrahan, Jakarta Selatan, meraih tiga gelar juara dalam lomba yang diselenggarakan Pegadaian.</p><p>Lomba dengan tema <a href=\"https://jakarta.tribunnews.com/tag/memilah-sampah-menabung-emas\" target=\"_blank\">Memilah&nbsp;Sampah&nbsp;Menabung&nbsp;Emas</a> itu diikuti 70 <a href=\"https://jakarta.tribunnews.com/tag/bank-sampah\" target=\"_blank\">bank&nbsp;sampah</a> binaan Pegadaian di seluruh Indonesia</p><p><br></p><p>Rektor <a href=\"https://jakarta.tribunnews.com/tag/universitas-budi-luhur\" target=\"_blank\">Universitas&nbsp;Budi&nbsp;Luhur</a>, <a href=\"https://jakarta.tribunnews.com/tag/wendi-usino\" target=\"_blank\">Wendi&nbsp;Usino</a>, mengatakan, Bank Sampah Budi Luhur merupakan wadah pengelolaan sampah dan menjadi tempat sosialisasi di lingkungan masyarakat.</p><p><br></p><p>Hal itu sebagai bentuk kepedulian <a href=\"https://jakarta.tribunnews.com/tag/universitas-budi-luhur\" target=\"_blank\">Universitas&nbsp;Budi&nbsp;Luhur</a> peduli terhadap masyarakat, khususnya lingkungan hidup.</p><p>\"Bank Sampah Budi Luhur dinyatakan sebagai juara umum lomba <a href=\"https://jakarta.tribunnews.com/tag/memilah-sampah-menabung-emas\" target=\"_blank\">Memilah&nbsp;Sampah&nbsp;Menabung&nbsp;Emas</a> 2021 dan meraih hadiah mobil boks. Tetap semangat berkarya dan tidak cepat merasa puas,\" kata Wendi di <a href=\"https://jakarta.tribunnews.com/tag/universitas-budi-luhur\" target=\"_blank\">Universitas&nbsp;Budi&nbsp;Luhur</a>, Jakarta Selatan, Kamis (23/9/2021).</p><p>Koordinator Bank Sampah Budi Luhur, Umi Tutik, menjelaskan, pihaknya selalu fokus pada kegiatan lingkungan dan memberi edukasi kepada masyarakat terkait pengelolaan sampah.</p><p>\"Pencapaian yang sudah kita raih ini, kita akan banyak lagi melayani masyarakat dan jangkauan lebih luas lagi dan kita jaga lingkungan. Prestasi ini merupakan kekompakan kebersamaan dengan menjalin koordinasi dan kerja sama baik dalam segala hal,\" ujar Umi.</p><p><br></p><p>Ia mengungkapkan, pihaknya sanggup mengumpulkan dua ton sampah non organik setiap minggunya.</p><p><br></p><p>\"Jadi satu bulan bisa lima sampai tujuh ton mengirim (sampah non organik) untuk dijual,\" ucap dia.</p><p>3 gelar juara yang diraih Bank Sampah Budi Luhur berhasil yaitu kategori akumulasi sampah terbanyak, akumulasi saldo tabungan emas tertinggi, dan akumulasi jumlah partisipan terbanyak.&nbsp;</p><p>Bank Sampah Budi Luhur pun dinobatkan sebagai juara umum dan mendapatkan satu unit mobil box.</p><p><br></p>', 'KA01', 1652864887, 1652806800),
('BA002', 'kolaborasi universitas budi luhur dan pt pegadaian wujudkan ruang kreatif dan wisata edukasi daur ulang bank sampah budi luhur', 'kolaborasi-universitas-budi-luhur-dan-pt-pegadaian-wujudkan-ruang-kreatif-dan-wisata-edukasi-daur-ulang-bank-sampah-budi-luhur', '62a6e56d1bf7e.jpeg', '<p>PT. Pegadaian (Persero) telah meresmikan pembukaan The Gade Creative Lounge dan Bank Sampah Budi Luhur pada hari Kamis, 31 Maret 2021 di Universitas Budi Luhur Jakarta. Peresmian ini dihadiri oleh Rektor Universitas Budi Luhur Bapak Dr.Ir. Wendi Usino, M.Sc., M.M. ; Ketua Yayasan Pendidikan Budi Luhur Cakti, Bapak Kasih Hanggoro, MBA serta Bapak Dr. Damar Latri Setiawan selaku Direktur Jaringan, Operasi, dan Penjualan PT Pegadaian didampingi bersama Asisten Deputi Tanggung Jawab Sosial Lingkungan Kementerian BUMN, Bapak Agus Suharyono.</p><p><br></p><p><img src=\"https://www.budiluhur.ac.id/wp-content/uploads/2021/04/20210402_205327.jpg\" height=\"405\" width=\"720\" style=\"display: block; margin: auto;\"></p><p><br></p><p>Peresmian The Gade Creative Lounge dan Bank Sampah Budi Luhur ditandai dengan penandatanganan prasasti oleh Bapak Dr. Damar Latri Setiawan dan Bapak Dr.Ir. Wendi Usino, M.Sc., M.M. didampingi oleh Bapak Agus Suharyono dan Bapak Kasih Hanggoro, MBA. Peresmian ini salah satu implementasi kerja sama Universitas Budi Luhur dan PT. Pegadaian (Persero) sejak tahun 2019.</p><p><br></p><p><img src=\"https://www.budiluhur.ac.id/wp-content/uploads/2021/04/20210402_212144.jpg\" height=\"399\" width=\"698\" style=\"display: block; margin: auto;\"></p><p><br></p><p>Universitas Budi Luhur menerima hibah pembangunan The Gade Creative Lounge ini sebagai salah satu wujud kepedulian PT. Pegadaian (Persero) untuk menuangkan kreativitas mahasiswa dalam berbagai bidang dengan nuansa millennials, khususnya dalam masa pandemic Covid-19.</p><p><br></p><p><img src=\"https://www.budiluhur.ac.id/wp-content/uploads/2021/04/20210402_205245.jpg\" height=\"404\" width=\"719\" style=\"display: block; margin: auto;\"></p><p><br></p><p>Tumbuhnya kreativitas mahasiswa merupakan bagian dari membangun SDM juga termasuk tujuan BUMN yang secara konsisten membangun anak-anak bangsa.</p><p><br></p><p><img src=\"https://www.budiluhur.ac.id/wp-content/uploads/2021/04/20210402_211204.jpg\" height=\"395\" width=\"720\" style=\"display: block; margin: auto;\"></p><p><br></p><p>Sedangkan, pemberian hibah renovasi Bank Sampah Budi Luhur kepada Universitas Budi Luhur sebagai wujud kepedulian dan CSR PT. Pegadaian (Persero) terhadap lingkungan hidup khususnya pengelolaan sampah sesuai dengan sustainable development goals.</p><p><br></p><p><img src=\"https://www.budiluhur.ac.id/wp-content/uploads/2021/04/20210402_205227.jpg\" height=\"405\" width=\"720\" style=\"display: block; margin: auto;\"></p><p><br></p><p>Direktur Jaringan, Operasi dan Penjualan PT. Pegadaian (Persero) menyampaikan alasan pemilihan Universitas Budi Luhur karena selama ini diketahui bahwa Universitas Budi Luhur telah memiliki pengelolaan sampah secara organik dan anorganik sejak 8 tahun yang lalu dan telah memiliki nama besar. Ini dibuktikan dengan Bank Sampah Budi Luhur mendapat penghargaan dari Gubernur DKI Jakarta karena Bank Sampah Budi Luhur secara konsisten melakukan pemilahan sampah</p><p>Selain itu, PT Pegadaian memberikan apresiasi setinggi-tingginya terhadap Bank Sampah Budi Luhur sebagai lembaga pengelolaan sampah dengan kualitas Grade A, sehingga menjadi Bank Sampah percontohan di Indonesia dan menjadikan Bank Sampah Budi Luhur sebagai wisata edukasi daur ulang.</p><p>&nbsp;</p><p>Pada kesempatan ini pula dilakukan peninjauan ke Bank Sampah Budi Luhur yang mendemokan proses pengolahan sampah. Kegiatan akhir dalam acara hari ini adalah diadakannya webinar dengan judul Gue Millennials Melek Financials yang diikuti sekitar 1029 peserta mahasiswa Universitas Budi Luhur.</p><p><br></p><p>Rektor Universitas Budi Luhur Dr. Ir. Wendi Usino, M.Sc., MM. menyampaikan terima kasih dan penghargaan bagi PT. Pegadaian atas bantuan dan kerja sama selama ini yang sangat bermanfaat bagi mahasiswa, dosen maupun para masyarakat sekitar untuk mengelola sampah secara baik, ” Kolaborasi antara Universitas Budi luhur dan Pegadaian terhadap Bank Sampah Budi Luhur sehingga menjadikan wisata edukasi daur ulang yang diharapakan dapat bermanfaat bagi masyarakat di lingkungan hidup” Ungkap Rektor Universitas Budi Luhur.</p><p><br></p><p>Universitas Budi Luhur telah mencatatkan prestasi positif terkait pengelolaan sampah dilingkungan masyarakat serta menjadi motivator dalam hal pengelolaan di lingkungan perguruan tinggi. Hal ini sebagai bentuk konsistensi kampus dalam mendorong kepedulian masyarakat terhadap lingkungan hidup.</p>', 'KA01', 1655104877, 1655053200);

-- --------------------------------------------------------

--
-- Table structure for table `dompet`
--

CREATE TABLE `dompet` (
  `id` int(11) NOT NULL,
  `id_user` varchar(200) NOT NULL,
  `uang` int(11) NOT NULL DEFAULT '0',
  `emas` decimal(65,4) NOT NULL DEFAULT '0.0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dompet`
--

INSERT INTO `dompet` (`id`, `id_user`, `uang`, `emas`) VALUES
(1, '154140030011', 106000, '0.1222'),
(2, '123100010021', 0, '0.0000'),
(3, '122600110111', 0, '0.0000'),
(4, '122600110112', 18500, '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `jual_sampah`
--

CREATE TABLE `jual_sampah` (
  `no` int(11) NOT NULL,
  `id_transaksi` varchar(200) NOT NULL,
  `id_sampah` varchar(200) NOT NULL,
  `jumlah_kg` decimal(65,2) NOT NULL,
  `jumlah_rp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_artikel`
--

CREATE TABLE `kategori_artikel` (
  `id` varchar(200) NOT NULL,
  `icon` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `kategori_utama` tinyint(1) NOT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_artikel`
--

INSERT INTO `kategori_artikel` (`id`, `icon`, `name`, `description`, `kategori_utama`, `created_at`) VALUES
('KA01', '6284a3f5b57d6.png', 'sosialisasi dan edukasi', 'artikel mengenai kegiatan sosialisasi bank sampah budiluhur', 1, 1652859893),
('KA02', '6284a4be57be9.png', 'webinar', 'berisi kegiatan webinar yang dilakukan bank sampah budluhur', 1, 1652860094),
('KA03', '6284a4dba7714.png', 'kkn', 'kkn di bank sampah budiluhur', 1, 1652860123);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_sampah`
--

CREATE TABLE `kategori_sampah` (
  `id` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_sampah`
--

INSERT INTO `kategori_sampah` (`id`, `name`, `created_at`) VALUES
('KS01', 'plastik', 1652861383),
('KS02', 'kertas', 1652861461),
('KS03', 'logam', 1652861851),
('KS04', 'lain-lain', 1652861857);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(13, '2021-11-16-023013', 'App\\Database\\Migrations\\Users', 'default', 'App', 1652608373, 1),
(14, '2021-11-16-023841', 'App\\Database\\Migrations\\KategoriArtikel', 'default', 'App', 1652608374, 1),
(15, '2021-11-16-024046', 'App\\Database\\Migrations\\Artikel', 'default', 'App', 1652608375, 1),
(16, '2021-11-16-031046', 'App\\Database\\Migrations\\KategoriSampah', 'default', 'App', 1652608377, 1),
(17, '2021-11-16-031125', 'App\\Database\\Migrations\\Sampah', 'default', 'App', 1652608377, 1),
(18, '2021-11-16-031158', 'App\\Database\\Migrations\\Transaksi', 'default', 'App', 1652608380, 1),
(19, '2021-11-16-031238', 'App\\Database\\Migrations\\SetorSampah', 'default', 'App', 1652608382, 1),
(20, '2021-11-16-031308', 'App\\Database\\Migrations\\TarikSaldo', 'default', 'App', 1652608384, 1),
(21, '2021-11-16-031352', 'App\\Database\\Migrations\\PindahSaldo', 'default', 'App', 1652608385, 1),
(22, '2021-11-16-031428', 'App\\Database\\Migrations\\JualSampah', 'default', 'App', 1652608387, 1),
(23, '2021-11-16-040233', 'App\\Database\\Migrations\\Wilayah', 'default', 'App', 1652608389, 1),
(24, '2021-11-23-225132', 'App\\Database\\Migrations\\Dompet', 'default', 'App', 1652608390, 1),
(25, '2022-04-08-054206', 'App\\Database\\Migrations\\Penghargaan', 'default', 'App', 1652608391, 1),
(26, '2022-04-08-115035', 'App\\Database\\Migrations\\Mitra', 'default', 'App', 1652608392, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL,
  `icon` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id`, `icon`, `name`, `description`) VALUES
(10, '6298a7406d4a5.png', 'pegadaian', '-'),
(11, '6298a772f0ea9.png', 'ksm nyiur', '-'),
(12, '6298a7c9102ac.png', 'budiluhur', '-'),
(13, '6298a7f722dd3.png', 'jagadtani', '-'),
(14, '6298a8258537a.png', 'dinas lingkungan hidup dki jakarta', '-'),
(15, '6298a8524ab41.png', 'dinas ppapp dki jakarta', '-');

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

CREATE TABLE `penghargaan` (
  `id` int(11) NOT NULL,
  `icon` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penghargaan`
--

INSERT INTO `penghargaan` (`id`, `icon`, `name`, `description`) VALUES
(6, '6298a8c943584.png', 'juara 3 memilah sampah menabung emas', '-'),
(7, '6298a911b4e57.jpeg', 'green prize from kagoshima university', '-'),
(8, '6298a9555e88d.jpeg', 'juara umum memilah sampah menabung emas', '-'),
(10, '6298d7d0b27d7.jpeg', 'tanda terimakasih IPB', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi alias libero at quis error laborum sunt nobis magni aperiam sequi? Rerum, assumenda ut magnam inventore laboriosam aliquid dicta corporis deserunt beatae itaque repellendus facilis repudiandae cum ullam odio? Veritatis unde, optio, ad nesciunt omnis iste voluptatem vero quae tempore vel delectus doloremque facilis beatae. Autem totam ad non. Voluptatibus vel, adipisci perferendis nesciunt accusantium animi distinctio laudantium totam quaerat quod quidem molestiae! Et dolores, pariatur enim perspiciatis ad voluptatum ut rerum nam nesciunt veritatis quas quidem nulla fugit nihil. Suscipit, aspernatur! Dolore sint beatae quia illum adipisci, a vero harum.');

-- --------------------------------------------------------

--
-- Table structure for table `pindah_saldo`
--

CREATE TABLE `pindah_saldo` (
  `no` int(11) NOT NULL,
  `id_transaksi` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_emas` int(11) NOT NULL DEFAULT '0',
  `hasil_konversi` decimal(65,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pindah_saldo`
--

INSERT INTO `pindah_saldo` (`no`, `id_transaksi`, `jumlah`, `harga_emas`, `hasil_konversi`) VALUES
(1, 'TPS871455060', 200000, 900000, '0.2222');

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id` varchar(200) NOT NULL,
  `id_kategori` varchar(200) NOT NULL,
  `jenis` varchar(40) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` decimal(65,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id`, `id_kategori`, `jenis`, `harga`, `jumlah`) VALUES
('S001', 'KS03', 'logam jenis 1', 1000, '14.50'),
('S002', 'KS02', 'kertas jenis 1', 2000, '6.00'),
('S003', 'KS01', 'plastik jenis 1', 3000, '106.00'),
('S004', 'KS04', 'boncos', 1200, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `setor_sampah`
--

CREATE TABLE `setor_sampah` (
  `no` int(11) NOT NULL,
  `id_transaksi` varchar(200) NOT NULL,
  `id_sampah` varchar(200) NOT NULL,
  `jumlah_kg` decimal(65,2) NOT NULL,
  `jumlah_rp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setor_sampah`
--

INSERT INTO `setor_sampah` (`no`, `id_transaksi`, `id_sampah`, `jumlah_kg`, `jumlah_rp`) VALUES
(1, 'TSS256572289', 'S001', '10.00', 10000),
(2, 'TSS256572289', 'S002', '6.00', 12000),
(3, 'TSS737234920', 'S003', '100.00', 300000),
(4, 'TSS737234920', 'S001', '4.00', 4000),
(6, 'TSS343561461', 'S001', '0.50', 500),
(7, 'TSS343561461', 'S003', '6.00', 18000);

-- --------------------------------------------------------

--
-- Table structure for table `tarik_saldo`
--

CREATE TABLE `tarik_saldo` (
  `no` int(11) NOT NULL,
  `id_transaksi` varchar(200) NOT NULL,
  `jenis_saldo` enum('uang','ubs','antam','galery24') NOT NULL,
  `jumlah_tarik` decimal(65,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tarik_saldo`
--

INSERT INTO `tarik_saldo` (`no`, `id_transaksi`, `jenis_saldo`, `jumlah_tarik`) VALUES
(1, 'TTS389288780', 'uang', '20000.0000'),
(2, 'TTS784581625', 'ubs', '0.1000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no` int(11) NOT NULL,
  `id` varchar(200) NOT NULL,
  `id_user` varchar(200) NOT NULL,
  `jenis_transaksi` varchar(50) NOT NULL,
  `date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no`, `id`, `id_user`, `jenis_transaksi`, `date`) VALUES
(4, 'TPS871455060', '154140030011', 'konversi saldo', 1652864340),
(1, 'TSS256572289', '154140030011', 'penyetoran sampah', 1652864100),
(6, 'TSS343561461', '122600110112', 'penyetoran sampah', 1654758180),
(3, 'TSS737234920', '154140030011', 'penyetoran sampah', 1652864280),
(2, 'TTS389288780', '154140030011', 'penarikan saldo', 1652864280),
(5, 'TTS784581625', '154140030011', 'penarikan saldo', 1652864400);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `notelp` varchar(14) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL DEFAULT '00-00-0000',
  `kelamin` enum('laki-laki','perempuan') NOT NULL,
  `token` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_active` bigint(19) NOT NULL DEFAULT '0',
  `otp` varchar(6) DEFAULT NULL,
  `is_verify` tinyint(1) NOT NULL DEFAULT '0',
  `privilege` varchar(10) NOT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `nama_lengkap`, `notelp`, `nik`, `alamat`, `tgl_lahir`, `kelamin`, `token`, `is_active`, `last_active`, `otp`, `is_verify`, `privilege`, `created_at`) VALUES
('122600110111', 'herusaputro649@gmail.com', 'herusaputro', 'WEu4zvTISZ2RLnDP7sDz1Q==', 'heru saputro', '088210498547', '3525015201880002', 'petukangan utara, Jakarta Selatan', '07-01-2001', 'laki-laki', NULL, 1, 1653574172, NULL, 1, 'nasabah', 1653574168),
('122600110112', '272447@domain.com', 'kqkaslana', 'PLgnAaUoHGpTyu9xpihnEA==', 'rubi ahmad fauzan', '085157902255', '3525016005650004', 'Pesanggrahan, Jakarta Selatan', '05-04-2001', 'laki-laki', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEyMjYwMDExMDExMiIsInVuaXF1ZWlkIjoiNjJhOTc4Yjg4NGNlYiIsInBhc3N3b3JkIjoiUExnbkFhVW9IR3BUeXU5eHBpaG5FQT09IiwicHJpdmlsZWdlIjoibmFzYWJhaCIsImV4cGlyZWQiOjE2NTUyNzcyNTZ9.pI2VHHzqA8XP8bIty0oob8SVDJfKwF9gNRDd4mmi-W0', 1, 1655273656, '484088', 1, 'nasabah', 1653577469),
('123100010021', 'usertes1@domain.com', 'usertes1', '+EwO6tSrQOQ7IbGPk/FXcg==', 'ini user tes 1', '085155352477', '3674070310000005', 'indonesia', '17-05-2022', 'perempuan', NULL, 1, 1652862035, '082414', 1, 'nasabah', 1652862035),
('154140030011', 'elkoro424@gmail.com', 'elkoro424xxx', 'mV4J9iuK2oPsYVfhZMMI/w==', 'muhammad akbar bagaskoro', '085155352499', '3674070310000004', 'cendana residence blok b1 no.2, serua, ciputat', '03-10-2000', 'laki-laki', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjE1NDE0MDAzMDAxMSIsInVuaXF1ZWlkIjoiNjJhN2Q3YjQyYWU0MiIsInBhc3N3b3JkIjoibVY0SjlpdUsyb1BzWVZmaFpNTUlcL3c9PSIsInByaXZpbGVnZSI6Im5hc2FiYWgiLCJleHBpcmVkIjoxNjU1MTcwNTAwfQ.JeRI4nDMmcaOr7hWTlZHenpTBjZFeegk5cd5VQcHPpE', 1, 1655166900, NULL, 1, 'nasabah', 1652859602),
('A001', 'superadmin1@gmail.com', 'superadmin1', '$2y$10$y7cFh8D5QVDiQO8GQNT7QOLx2zx21l70s8KqbHaZ68XE1kjYu1Vty', 'super admin 1', '021123456789', '1234567890123456', 'cileduk', '18-05-2022', 'laki-laki', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IkEwMDEiLCJ1bmlxdWVpZCI6IjYyYWE5ZTg4YmZkYzAiLCJwYXNzd29yZCI6IiQyeSQxMCR5N2NGaDhENVFWRGlRTzhHUU5UN1FPTHgyengyMWw3MHM4S3FiSGFaNjhYRTFrall1MVZ0eSIsInByaXZpbGVnZSI6InN1cGVyYWRtaW4iLCJleHBpcmVkIjoxNjU1MzUyNDcyfQ.67S1AtHuNDnMIYj4J9fV_UBnKD_CxU-2Tv8aVUTcHfg', 1, 1655348872, NULL, 1, 'superadmin', 1652858905),
('A002', 'superadmin2@gmail.com', 'superadmin2', '$2y$10$GaRf62v.UAS6BP3I9ONwsOKoaI1XtkLxkzKrTvIKoCIob.X265T5S', 'ini superadmin 2', '08512345678', '0689353083338158', 'indonesia', '18-05-2022', 'laki-laki', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IkEwMDIiLCJ1bmlxdWVpZCI6IjYyYTk0YjFjNzg0NzUiLCJwYXNzd29yZCI6IiQyeSQxMCRHYVJmNjJ2LlVBUzZCUDNJOU9Od3NPS29hSTFYdGtMeGt6S3JUdklLb0NJb2IuWDI2NVQ1UyIsInByaXZpbGVnZSI6InN1cGVyYWRtaW4iLCJleHBpcmVkIjoxNjU1MjY1NTgwfQ.O3mjULps3SZ4-x68acecKVJIxPZlTZQ0xY53P77tnSg', 1, 1655261980, NULL, 1, 'superadmin', 1652861147);

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL,
  `id_user` varchar(200) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `kelurahan` varchar(200) NOT NULL,
  `kecamatan` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `provinsi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id`, `id_user`, `kodepos`, `kelurahan`, `kecamatan`, `kota`, `provinsi`) VALUES
(1, '154140030011', '15414', 'sarua (serua)', 'ciputat', 'tangerang selatan', 'banten'),
(2, '123100010021', '12310', 'pondok indah mall 1 ( pim 1 )', 'kebayoran lama', 'jakarta selatan', 'dki jakarta'),
(3, '122600110111', '12260', 'petukangan utara', 'pesanggrahan', 'jakarta selatan', 'dki jakarta'),
(4, '122600110112', '12260', 'petukangan utara', 'pesanggrahan', 'jakarta selatan', 'dki jakarta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `artikel_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `dompet`
--
ALTER TABLE `dompet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `jual_sampah`
--
ALTER TABLE `jual_sampah`
  ADD PRIMARY KEY (`no`),
  ADD KEY `jual_sampah_id_transaksi_foreign` (`id_transaksi`),
  ADD KEY `jual_sampah_id_sampah_foreign` (`id_sampah`);

--
-- Indexes for table `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `pindah_saldo`
--
ALTER TABLE `pindah_saldo`
  ADD PRIMARY KEY (`no`),
  ADD KEY `pindah_saldo_id_transaksi_foreign` (`id_transaksi`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis` (`jenis`),
  ADD KEY `sampah_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  ADD PRIMARY KEY (`no`),
  ADD KEY `setor_sampah_id_transaksi_foreign` (`id_transaksi`),
  ADD KEY `setor_sampah_id_sampah_foreign` (`id_sampah`);

--
-- Indexes for table `tarik_saldo`
--
ALTER TABLE `tarik_saldo`
  ADD PRIMARY KEY (`no`),
  ADD KEY `tarik_saldo_id_transaksi_foreign` (`id_transaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id_user_foreign` (`id_user`),
  ADD KEY `no` (`no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nama_lengkap` (`nama_lengkap`),
  ADD UNIQUE KEY `notelp` (`notelp`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `email_username_notelp` (`email`,`username`,`notelp`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wilayah_id_user_foreign` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dompet`
--
ALTER TABLE `dompet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jual_sampah`
--
ALTER TABLE `jual_sampah`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pindah_saldo`
--
ALTER TABLE `pindah_saldo`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tarik_saldo`
--
ALTER TABLE `tarik_saldo`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_artikel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dompet`
--
ALTER TABLE `dompet`
  ADD CONSTRAINT `dompet_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jual_sampah`
--
ALTER TABLE `jual_sampah`
  ADD CONSTRAINT `jual_sampah_id_sampah_foreign` FOREIGN KEY (`id_sampah`) REFERENCES `sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jual_sampah_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pindah_saldo`
--
ALTER TABLE `pindah_saldo`
  ADD CONSTRAINT `pindah_saldo_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sampah`
--
ALTER TABLE `sampah`
  ADD CONSTRAINT `sampah_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  ADD CONSTRAINT `setor_sampah_id_sampah_foreign` FOREIGN KEY (`id_sampah`) REFERENCES `sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `setor_sampah_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tarik_saldo`
--
ALTER TABLE `tarik_saldo`
  ADD CONSTRAINT `tarik_saldo_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD CONSTRAINT `wilayah_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
