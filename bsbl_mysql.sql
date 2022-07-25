-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: db_bsbl
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artikel`
--

DROP TABLE IF EXISTS `artikel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artikel` (
  `id` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `id_kategori` varchar(200) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `published_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `artikel_id_kategori_foreign` (`id_kategori`),
  CONSTRAINT `artikel_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_artikel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artikel`
--

LOCK TABLES `artikel` WRITE;
/*!40000 ALTER TABLE `artikel` DISABLE KEYS */;
/*!40000 ALTER TABLE `artikel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dompet`
--

DROP TABLE IF EXISTS `dompet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dompet` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(200) DEFAULT NULL,
  `uang` int(11) NOT NULL DEFAULT 0,
  `emas` decimal(65,4) NOT NULL DEFAULT 0.0000,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`),
  CONSTRAINT `dompet_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dompet`
--

LOCK TABLES `dompet` WRITE;
/*!40000 ALTER TABLE `dompet` DISABLE KEYS */;
INSERT INTO `dompet` VALUES (1,NULL,750,0.0000),(2,'154140030041',5000,0.0000);
/*!40000 ALTER TABLE `dompet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jual_sampah`
--

DROP TABLE IF EXISTS `jual_sampah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jual_sampah` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(200) NOT NULL,
  `id_sampah` varchar(200) NOT NULL,
  `jumlah_kg` decimal(65,2) NOT NULL,
  `harga_nasabah` int(11) NOT NULL,
  `jumlah_rp` int(11) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `jual_sampah_id_transaksi_foreign` (`id_transaksi`),
  KEY `jual_sampah_id_sampah_foreign` (`id_sampah`),
  CONSTRAINT `jual_sampah_id_sampah_foreign` FOREIGN KEY (`id_sampah`) REFERENCES `sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jual_sampah_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jual_sampah`
--

LOCK TABLES `jual_sampah` WRITE;
/*!40000 ALTER TABLE `jual_sampah` DISABLE KEYS */;
INSERT INTO `jual_sampah` VALUES (2,'TJS460832636','S001',5.00,5000,5500),(3,'TJS762090346','S001',2.50,2500,2750);
/*!40000 ALTER TABLE `jual_sampah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_artikel`
--

DROP TABLE IF EXISTS `kategori_artikel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_artikel` (
  `id` varchar(6) NOT NULL,
  `icon` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `kategori_utama` tinyint(1) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_artikel`
--

LOCK TABLES `kategori_artikel` WRITE;
/*!40000 ALTER TABLE `kategori_artikel` DISABLE KEYS */;
INSERT INTO `kategori_artikel` VALUES ('KA01','62de9cb15b207.png','WEBINAR','deskripsi webinar',1,1658756273),('KA02','62de9cc295e91.png','KKN','deskripsi kkn',1,1658756290),('KA03','62de9ce338e88.png','Sosialisasi Dan Edukasi','deskripsi Sosialisasi Dan Edukasi',1,1658756323);
/*!40000 ALTER TABLE `kategori_artikel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_sampah`
--

DROP TABLE IF EXISTS `kategori_sampah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_sampah` (
  `id` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_sampah`
--

LOCK TABLES `kategori_sampah` WRITE;
/*!40000 ALTER TABLE `kategori_sampah` DISABLE KEYS */;
INSERT INTO `kategori_sampah` VALUES ('KS01','tes',1658700551);
/*!40000 ALTER TABLE `kategori_sampah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (29,'2021-11-16-023013','App\\Database\\Migrations\\Users','default','App',1658699019,1),(30,'2021-11-16-023841','App\\Database\\Migrations\\KategoriArtikel','default','App',1658699019,1),(31,'2021-11-16-024046','App\\Database\\Migrations\\Artikel','default','App',1658699019,1),(32,'2021-11-16-031046','App\\Database\\Migrations\\KategoriSampah','default','App',1658699019,1),(33,'2021-11-16-031125','App\\Database\\Migrations\\Sampah','default','App',1658699019,1),(34,'2021-11-16-031158','App\\Database\\Migrations\\Transaksi','default','App',1658699019,1),(35,'2021-11-16-031238','App\\Database\\Migrations\\SetorSampah','default','App',1658699019,1),(36,'2021-11-16-031308','App\\Database\\Migrations\\TarikSaldo','default','App',1658699019,1),(37,'2021-11-16-031352','App\\Database\\Migrations\\PindahSaldo','default','App',1658699019,1),(38,'2021-11-16-031428','App\\Database\\Migrations\\JualSampah','default','App',1658699019,1),(39,'2021-11-16-040233','App\\Database\\Migrations\\Wilayah','default','App',1658699019,1),(40,'2021-11-23-225132','App\\Database\\Migrations\\Dompet','default','App',1658699019,1),(41,'2022-04-08-054206','App\\Database\\Migrations\\Penghargaan','default','App',1658699019,1),(42,'2022-04-08-115035','App\\Database\\Migrations\\Mitra','default','App',1658699020,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mitra`
--

DROP TABLE IF EXISTS `mitra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitra`
--

LOCK TABLES `mitra` WRITE;
/*!40000 ALTER TABLE `mitra` DISABLE KEYS */;
INSERT INTO `mitra` VALUES (1,'62de9b927f8e8.png','budiluhur','budiluhur'),(2,'62de9bbdbf58b.png','pegadaian','pegadaian'),(3,'62de9bd21ba90.png','jagadtani','jagadtani'),(4,'62de9be6e8ee0.png','ksm nyiur','ksm nyiur'),(5,'62de9c016bf6f.png','dinas lingkungan hidup DKI Jakarta','dinas lingkungan hidup DKI Jakarta'),(6,'62de9c21105d9.png','Dinas PPAPP DKI Jakarta','Dinas PPAPP DKI Jakarta');
/*!40000 ALTER TABLE `mitra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penghargaan`
--

DROP TABLE IF EXISTS `penghargaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penghargaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penghargaan`
--

LOCK TABLES `penghargaan` WRITE;
/*!40000 ALTER TABLE `penghargaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `penghargaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pindah_saldo`
--

DROP TABLE IF EXISTS `pindah_saldo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pindah_saldo` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_emas` int(11) NOT NULL DEFAULT 0,
  `hasil_konversi` decimal(65,4) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `pindah_saldo_id_transaksi_foreign` (`id_transaksi`),
  CONSTRAINT `pindah_saldo_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pindah_saldo`
--

LOCK TABLES `pindah_saldo` WRITE;
/*!40000 ALTER TABLE `pindah_saldo` DISABLE KEYS */;
/*!40000 ALTER TABLE `pindah_saldo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sampah`
--

DROP TABLE IF EXISTS `sampah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sampah` (
  `id` varchar(6) NOT NULL,
  `id_kategori` varchar(200) NOT NULL,
  `jenis` varchar(40) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_pusat` int(11) NOT NULL DEFAULT 0,
  `jumlah` decimal(65,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jenis` (`jenis`),
  KEY `sampah_id_kategori_foreign` (`id_kategori`),
  CONSTRAINT `sampah_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sampah`
--

LOCK TABLES `sampah` WRITE;
/*!40000 ALTER TABLE `sampah` DISABLE KEYS */;
INSERT INTO `sampah` VALUES ('S001','KS01','jenis tes 1',1000,1100,2.50);
/*!40000 ALTER TABLE `sampah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setor_sampah`
--

DROP TABLE IF EXISTS `setor_sampah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setor_sampah` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(200) NOT NULL,
  `id_sampah` varchar(200) NOT NULL,
  `jumlah_kg` decimal(65,2) NOT NULL,
  `jumlah_rp` int(11) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `setor_sampah_id_transaksi_foreign` (`id_transaksi`),
  KEY `setor_sampah_id_sampah_foreign` (`id_sampah`),
  CONSTRAINT `setor_sampah_id_sampah_foreign` FOREIGN KEY (`id_sampah`) REFERENCES `sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `setor_sampah_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setor_sampah`
--

LOCK TABLES `setor_sampah` WRITE;
/*!40000 ALTER TABLE `setor_sampah` DISABLE KEYS */;
INSERT INTO `setor_sampah` VALUES (1,'TSS092808024','S001',10.00,10000);
/*!40000 ALTER TABLE `setor_sampah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarik_saldo`
--

DROP TABLE IF EXISTS `tarik_saldo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarik_saldo` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(200) NOT NULL,
  `jenis_saldo` enum('uang','ubs','antam','galery24') NOT NULL,
  `jumlah_tarik` decimal(65,4) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `tarik_saldo_id_transaksi_foreign` (`id_transaksi`),
  CONSTRAINT `tarik_saldo_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarik_saldo`
--

LOCK TABLES `tarik_saldo` WRITE;
/*!40000 ALTER TABLE `tarik_saldo` DISABLE KEYS */;
INSERT INTO `tarik_saldo` VALUES (6,'TTS123873020','uang',5000.0000);
/*!40000 ALTER TABLE `tarik_saldo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(12) NOT NULL,
  `id_user` varchar(200) NOT NULL,
  `jenis_transaksi` varchar(50) NOT NULL,
  `date` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_id_user_foreign` (`id_user`),
  KEY `no` (`no`),
  CONSTRAINT `transaksi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (2,'TJS460832636','A001','penjualan sampah',1658723700),(3,'TJS762090346','A001','penjualan sampah',1658729100),(1,'TSS092808024','154140030041','penyetoran sampah',1658719080),(6,'TTS123873020','154140030041','penarikan saldo',1658737800);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` varchar(18) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `notelp` varchar(14) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL DEFAULT '00-00-0000',
  `kelamin` enum('laki-laki','perempuan') NOT NULL,
  `token` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_active` bigint(19) NOT NULL DEFAULT 0,
  `otp` varchar(6) DEFAULT NULL,
  `is_verify` tinyint(1) NOT NULL DEFAULT 0,
  `privilege` varchar(10) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `nama_lengkap` (`nama_lengkap`),
  UNIQUE KEY `notelp` (`notelp`),
  UNIQUE KEY `nik` (`nik`),
  UNIQUE KEY `email_username_notelp` (`email`,`username`,`notelp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('154140030041','286824@domain.com','nasabah1','Hx2cFciWfgICmqQq+JZk2g==','nasabah tes 1','085155352499','3674070310000004','cendana residence','25-07-2022','laki-laki',NULL,1,1658718809,'531022',1,'nasabah',1658718809),('A001','superadmin1@gmail.com','superadmin1','$2y$10$qXf3sIWNIIF0XFLeD5F.k.L8NOmS76gKi.SkKWvUGbQMyyRRE9jci','super admin 1','021123456789','1234567890123456','cileduk','24-07-2022','laki-laki','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IkEwMDEiLCJ1bmlxdWVpZCI6IjYyZGU5Njk5Y2JkMWYiLCJwYXNzd29yZCI6IiQyeSQxMCRxWGYzc0lXTklJRjBYRkxlRDVGLmsuTDhOT21TNzZnS2kuU2tLV3ZVR2JRTXl5UlJFOWpjaSIsInByaXZpbGVnZSI6InN1cGVyYWRtaW4iLCJleHBpcmVkIjoxNjU4NzU4MzEzfQ.A7V_aLzu0gD2tY5C8BKGU76Q-z7aEKx1xMgMh22sCfk',1,1658754713,NULL,1,'superadmin',1658699022);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wilayah`
--

DROP TABLE IF EXISTS `wilayah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(200) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `kelurahan` varchar(200) NOT NULL,
  `kecamatan` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wilayah_id_user_foreign` (`id_user`),
  CONSTRAINT `wilayah_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wilayah`
--

LOCK TABLES `wilayah` WRITE;
/*!40000 ALTER TABLE `wilayah` DISABLE KEYS */;
INSERT INTO `wilayah` VALUES (1,'154140030041','15414','sarua (serua)','ciputat','tangerang selatan','banten');
/*!40000 ALTER TABLE `wilayah` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-25 20:40:48
