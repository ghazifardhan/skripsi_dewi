-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Agu 2017 pada 05.07
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dewi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `Id_Customer` varchar(30) NOT NULL,
  `Nama_Customer` char(50) NOT NULL,
  `Alamat` varchar(250) NOT NULL,
  `Telpon` int(20) NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `Jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`Id_Customer`, `Nama_Customer`, `Alamat`, `Telpon`, `Keterangan`, `Jenis`) VALUES
('002VS_RAP_QS', 'Reka Prima Kuantitama', 'Jakarta', 55176243, 'QS', 'Konsultan'),
('007VS_DELTA_GENSET', 'PT. Delta Suplindo', 'Jakarta raya', 5527631, '', 'Kontraktor'),
('009VS_Megatika_ME', 'PT. Megatika', 'Jl. Jakarta pusat ', 55726341, '', 'Konsultan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontrak`
--

CREATE TABLE `kontrak` (
  `Id_Kontrak` varchar(50) NOT NULL,
  `Jenis_Kontrak` char(200) NOT NULL,
  `Nilai_kontrak` bigint(15) NOT NULL,
  `Paket_Pekerjaan` varchar(200) NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `payment` int(11) NOT NULL,
  `Id_Customer` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kontrak`
--

INSERT INTO `kontrak` (`Id_Kontrak`, `Jenis_Kontrak`, `Nilai_kontrak`, `Paket_Pekerjaan`, `Keterangan`, `payment`, `Id_Customer`) VALUES
('PEP/SPK-SK/004/II/17/SPK', 'monthlyprogress', 2000000, 'Genset', '', 500000, '007VS_DELTA_GENSET'),
('PEP/SPK-SK/006/VI/17/SPK', 'Termin', 2147483647, '', '', 550000, '002VS_RAP_QS'),
('PEP/SPK-SK/010/V/17/SPK', 'Termin', 120000000000, '', '', 2147483647, '009VS_Megatika_ME');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proses`
--

CREATE TABLE `proses` (
  `Id_Proses` int(11) NOT NULL,
  `Id_Customer` varchar(25) NOT NULL,
  `Tanggal_Pengajuan` varchar(15) NOT NULL,
  `progress` varchar(10) NOT NULL,
  `Tgl_Meeting_Progress` date NOT NULL,
  `status` char(20) DEFAULT NULL,
  `berita_acara` varchar(100) DEFAULT NULL,
  `approve` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proses`
--

INSERT INTO `proses` (`Id_Proses`, `Id_Customer`, `Tanggal_Pengajuan`, `progress`, `Tgl_Meeting_Progress`, `status`, `berita_acara`, `approve`) VALUES
(28, '002VS_RAP_QS', '2017-08-09', '30', '2017-08-31', 'LUNAS', 'files/.', 1),
(29, '001VS_DELTA_GENSET', '2017-08-26', '23,09', '2017-08-23', 'BELUM LUNAS', 'files/.', 1),
(30, '001VS_DELTA_GENSET', '2017-08-16', '30', '2017-08-23', 'BELUM LUNAS', 'files/.', 1),
(31, '002VS_RAP_QS', '2017-08-10', '40', '2017-08-17', 'LUNAS', 'files/.', 1),
(32, '007VS_DELTA_GENSET', '2017-08-23', '53', '2017-08-30', 'LUNAS', 'files/Monitoring_Progress_Fisik.xls.xls', 1),
(33, '009VS_Megatika_ME', '2017-08-17', '50', '2017-08-10', 'LUNAS', 'files/.', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `Id_User` varchar(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Level` varchar(10) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_login`
--

INSERT INTO `tbl_login` (`Id_User`, `UserName`, `Password`, `Level`, `Status`) VALUES
('001VS_APK', 'APK', '123', 'Kontraktor', 'Aktif'),
('001vs_RAP', 'RAP', '123', 'Konsultan', 'Aktif'),
('003VS_RPK', 'Reka prime kuantitama', '123', 'Konsultan', 'Aktif'),
('006VS_Toshi', 'toshindo', '123', 'Kontraktor', 'Aktif'),
('007VS_Lawan', 'Lawangijo', '123', 'Konsultan', 'Aktif'),
('dewi', 'dewi', '123', 'Admin', 'Aktif'),
('direktur', 'Direktur', '123', 'direktur', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx`
--

CREATE TABLE `trx` (
  `id_trx` int(11) NOT NULL,
  `Id_Proses` varchar(50) NOT NULL,
  `Nilai_Kontrak` bigint(20) NOT NULL,
  `Id_Kontrak` varchar(25) NOT NULL,
  `Tgl_Pengajuan` varchar(15) NOT NULL,
  `Jumlah_Tagihan` bigint(20) NOT NULL,
  `Sisa_Tagihan` bigint(20) NOT NULL,
  `berita_acara` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trx`
--

INSERT INTO `trx` (`id_trx`, `Id_Proses`, `Nilai_Kontrak`, `Id_Kontrak`, `Tgl_Pengajuan`, `Jumlah_Tagihan`, `Sisa_Tagihan`, `berita_acara`) VALUES
(3, '12', 189000000, 'PEP/SPK-SK/002/V/17/SPK', '2017-08-01', 123456, -123456, ''),
(5, '13', 28900000, 'PEP/SPK-SK/004/V/17/SPK', '2017-08-13', 123456, 28776544, ''),
(6, '21', 500000, 'pppfc', '2017-08-09', 5000, 495000, ''),
(7, '22', 10000, '123asd', '2017-08-01', 500, 9500, ''),
(8, '23', 10000, '123asd', '2017-08-24', 500, 9000, ''),
(9, '', 0, '', '2017-08-15', 120000, -120000, ''),
(10, '27', 10000, '123asd', '2017-08-17', 20, 8980, ''),
(11, '28', 1000000, 'PEP/SPK-SK/006/VI/17/SPK', '2017-08-01', 50000, 950000, ''),
(12, '31', 1000000, 'PEP/SPK-SK/006/VI/17/SPK', '2017-08-22', 500000, 450000, ''),
(13, '32', 2000000, 'PEP/SPK-SK/004/II/17/SPK', '2017-08-31', 500000, 1500000, ''),
(14, '33', 12000000000, 'PEP/SPK-SK/010/V/17/SPK', '2017-08-11', 2000000000, 1000000000, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id_Customer`);

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`Id_Kontrak`),
  ADD UNIQUE KEY `payment` (`payment`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`Id_Proses`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`Id_User`);

--
-- Indexes for table `trx`
--
ALTER TABLE `trx`
  ADD PRIMARY KEY (`id_trx`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `Id_Proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `trx`
--
ALTER TABLE `trx`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
