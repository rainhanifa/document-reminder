-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table app_docrem.about
CREATE TABLE IF NOT EXISTS `about` (
  `about_description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table app_docrem.about: ~0 rows (approximately)
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT IGNORE INTO `about` (`about_description`) VALUES
	('Penggunaan Aplikasi Document Reminder dalam rangka Monitoring Dokumen Kredit<br>sebagai bahan untuk menyelesaikan tugas makalah<br>');
/*!40000 ALTER TABLE `about` ENABLE KEYS */;

-- Dumping structure for table app_docrem.detail_data
CREATE TABLE IF NOT EXISTS `detail_data` (
  `id_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_data` int(11) NOT NULL DEFAULT '0',
  `nama_dokumen` varchar(50) NOT NULL DEFAULT '0',
  `file_dokumen` text NOT NULL,
  `tipe_dokumen` varchar(50) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table app_docrem.detail_data: ~7 rows (approximately)
/*!40000 ALTER TABLE `detail_data` DISABLE KEYS */;
INSERT IGNORE INTO `detail_data` (`id_dokumen`, `id_master_data`, `nama_dokumen`, `file_dokumen`, `tipe_dokumen`, `status`) VALUES
	(1, 1, 'DR-1-1', 'uploads/DR-1-1.jpg', 'Logo Perusahaan', 1),
	(10, 8, 'DR-8-1', 'uploads/DR-8-1.pptx', 'Presentation', 0),
	(11, 8, 'DR-8-2', 'uploads/DR-8-2.docx', 'Surat-Surat', 0),
	(13, 10, 'DR-10-1', 'uploads/DR-10-1.xlsx', 'Cashflow', 0),
	(14, 10, 'DR-10-2', 'uploads/DR-10-2.docx', 'Akta Perusahaan', 1),
	(15, 10, 'DR-10-3', 'uploads/DR-10-3.vsd', 'Workflow', 1),
	(16, 10, 'DR-10-4', 'uploads/DR-10-4.docx', 'Business Requirement', 1),
	(17, 1, 'DR-1-2', 'uploads/DR-1-2.doc', 'Surat Izin Usaha', 1);
/*!40000 ALTER TABLE `detail_data` ENABLE KEYS */;

-- Dumping structure for table app_docrem.detail_peminjaman
CREATE TABLE IF NOT EXISTS `detail_peminjaman` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_dokumen` int(11) DEFAULT NULL,
  `status_dokumen` int(11) DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table app_docrem.detail_peminjaman: ~6 rows (approximately)
/*!40000 ALTER TABLE `detail_peminjaman` DISABLE KEYS */;
INSERT IGNORE INTO `detail_peminjaman` (`id_detail`, `id_peminjaman`, `id_dokumen`, `status_dokumen`, `tanggal_kembali`) VALUES
	(1, 1, 1, 1, '2017-05-05'),
	(3, 2, 10, 0, '0000-00-00'),
	(4, 2, 11, 0, '0000-00-00'),
	(6, 4, 13, 0, NULL),
	(7, 4, 14, 1, '2017-05-09');
/*!40000 ALTER TABLE `detail_peminjaman` ENABLE KEYS */;

-- Dumping structure for table app_docrem.master_data
CREATE TABLE IF NOT EXISTS `master_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_client` varchar(50) DEFAULT NULL,
  `tipe_client` int(11) DEFAULT NULL,
  `nama_proyek` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table app_docrem.master_data: ~2 rows (approximately)
/*!40000 ALTER TABLE `master_data` DISABLE KEYS */;
INSERT IGNORE INTO `master_data` (`id`, `nama_client`, `tipe_client`, `nama_proyek`) VALUES
	(1, 'Ibnu Suhaemy', 2, 'Illiyin Studio'),
	(8, 'Edo', 1, 'PT Jaya Ageng'),
	(10, 'Luqman', 1, 'Smart Media');
/*!40000 ALTER TABLE `master_data` ENABLE KEYS */;

-- Dumping structure for table app_docrem.master_peminjaman
CREATE TABLE IF NOT EXISTS `master_peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table app_docrem.master_peminjaman: ~3 rows (approximately)
/*!40000 ALTER TABLE `master_peminjaman` DISABLE KEYS */;
INSERT IGNORE INTO `master_peminjaman` (`id`, `id_client`, `tanggal_peminjaman`, `tanggal_jatuh_tempo`, `tanggal_kembali`, `status`, `keterangan`) VALUES
	(1, 1, '2017-05-05', '2017-05-08', NULL, '1', NULL),
	(2, 8, '2017-05-05', '2017-05-08', NULL, '0', 'Jatuh tempo di akhir pekan'),
	(4, 10, '2017-05-08', '2017-05-12', NULL, '0', NULL);
/*!40000 ALTER TABLE `master_peminjaman` ENABLE KEYS */;

-- Dumping structure for table app_docrem.users
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table app_docrem.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`username`, `password`, `nama_lengkap`) VALUES
	('admin', 'admin', 'Administrator');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
