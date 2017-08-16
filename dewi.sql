-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `Id_Customer` varchar(25) NOT NULL,
  `Nama_Customer` char(50) NOT NULL,
  `Alamat` varchar(250) NOT NULL,
  `Telpon` int(20) NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `Jenis` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_Customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`Id_Customer`, `Nama_Customer`, `Alamat`, `Telpon`, `Keterangan`, `Jenis`) VALUES
('001',	'fahmi tamvan',	'Jakarta',	12,	'OK',	'Konsultan'),
('9823',	'Ga Maju maju',	'ok',	212,	'ok',	'Kontraktor'),
('sda',	'PT. RASYA',	'JL.DKWKDWUDHAKJ',	123342,	'DASDWD',	'Kontraktor');

DROP TABLE IF EXISTS `kontrak`;
CREATE TABLE `kontrak` (
  `Id_Kontrak` varchar(25) NOT NULL,
  `Jenis_Kontrak` char(200) NOT NULL,
  `Nilai_kontrak` int(15) NOT NULL,
  `Paket_Pekerjaan` varchar(200) NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `payment` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Customer` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_Kontrak`),
  UNIQUE KEY `payment` (`payment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kontrak` (`Id_Kontrak`, `Jenis_Kontrak`, `Nilai_kontrak`, `Paket_Pekerjaan`, `Keterangan`, `payment`, `Id_Customer`) VALUES
('0901091',	'Jembatan',	100,	'Aspal Jalan',	'Di kerjakan denganbaik',	13,	'sda');

DROP TABLE IF EXISTS `paket_pekerjaan`;
CREATE TABLE `paket_pekerjaan` (
  `Id_Paket_Pekerjaan` varchar(100) NOT NULL,
  `Nama_Perusahaan` varchar(100) NOT NULL,
  `Keterangan` char(100) NOT NULL,
  PRIMARY KEY (`Id_Paket_Pekerjaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `paket_pekerjaan` (`Id_Paket_Pekerjaan`, `Nama_Perusahaan`, `Keterangan`) VALUES
('3456789',	'fghjk',	'bnm,'),
('909',	'090',	'9'),
('mekanikal',	'PT.Rasya',	'kontraktor mekanikal'),
('MK',	'PT.Rasya Anugrah Pratama',	'Kontraktor');

DROP TABLE IF EXISTS `proses`;
CREATE TABLE `proses` (
  `Id_Proses` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Customer` varchar(25) NOT NULL,
  `Tanggal_Pengajuan` varchar(15) NOT NULL,
  `progress` varchar(10) NOT NULL,
  `Tgl_Meeting_Progress` date NOT NULL,
  `status` char(20) DEFAULT NULL,
  `berita_acara` varchar(100) DEFAULT NULL,
  `approve` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id_Proses`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `proses` (`Id_Proses`, `Id_Customer`, `Tanggal_Pengajuan`, `progress`, `Tgl_Meeting_Progress`, `status`, `berita_acara`, `approve`) VALUES
(1,	'sda',	'2017-05-19',	'2',	'2017-05-18',	'LUNAS',	'files/edu.PNG.png',	1),
(2,	'sda',	'2017-05-19',	'3',	'2017-05-18',	'LUNAS',	'files/edu.PNG.png',	1);

DROP TABLE IF EXISTS `tbl_login`;
CREATE TABLE `tbl_login` (
  `Id_User` varchar(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Level` varchar(10) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_User`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_login` (`Id_User`, `UserName`, `Password`, `Level`, `Status`) VALUES
('Admin001',	'admin',	'123',	'Director',	'Aktif'),
('dewi',	'dewi',	'123',	'Admin',	'Aktif'),
('konsultan',	'konsultan',	'123',	'Konsultan',	'Aktif'),
('nicken',	'nicken',	'123',	'Kontraktor',	'Aktif');

DROP TABLE IF EXISTS `trx`;
CREATE TABLE `trx` (
  `id_trx` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Proses` varchar(50) NOT NULL,
  `Nilai_Kontrak` int(20) NOT NULL,
  `Id_Kontrak` varchar(25) NOT NULL,
  `Tgl_Pengajuan` varchar(15) NOT NULL,
  `Jumlah_Tagihan` int(20) NOT NULL,
  `Sisa_Tagihan` int(20) NOT NULL,
  `berita_acara` varchar(200) NOT NULL,
  PRIMARY KEY (`id_trx`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `trx` (`id_trx`, `Id_Proses`, `Nilai_Kontrak`, `Id_Kontrak`, `Tgl_Pengajuan`, `Jumlah_Tagihan`, `Sisa_Tagihan`, `berita_acara`) VALUES
(2,	'9',	200000,	'a',	'2017-05-14',	200,	199798,	'files/.'),
(3,	'10',	200000,	'a',	'2017-05-15',	10000,	189798,	'files/.'),
(4,	'11',	200000,	'a',	'2017-05-14',	1000,	188798,	'files/.'),
(5,	'12',	1000000,	'009',	'2017-05-09',	999998,	1,	''),
(6,	'1',	100,	'0901091',	'2017-05-19',	2,	97,	''),
(7,	'2',	100,	'0901091',	'2017-05-19',	10,	87,	'');

-- 2017-06-18 15:55:12
