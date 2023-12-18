-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2023 at 08:16 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `No_anggota` int NOT NULL,
  `angg_nama` varchar(100) NOT NULL,
  `angg_alamat` varchar(100) NOT NULL,
  `angg_tlp` varchar(100) NOT NULL,
  `angg_tgldaftar` varchar(100) NOT NULL,
  `angg_berakhir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`No_anggota`, `angg_nama`, `angg_alamat`, `angg_tlp`, `angg_tgldaftar`, `angg_berakhir`) VALUES
(1, 'user', 'iasdj', 'asdasd', '10-12-2023', '15-12-2023');

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_peminjaman`
-- (See below for the actual view)
--
CREATE TABLE `detail_peminjaman` (
`No_anggota` int
,`Nama_anggota` varchar(100)
,`Kode_sewa` int
,`Tgl_kembali` varchar(100)
,`Vcd_judul` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` int NOT NULL,
  `kategori_nama` varchar(100) NOT NULL,
  `biaya_sewa` varchar(100) NOT NULL,
  `denda_perhari` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `kategori_nama`, `biaya_sewa`, `denda_perhari`) VALUES
(1, 'sdasd', '123123', '12');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_vcd`
--

CREATE TABLE `koleksi_vcd` (
  `kode_vcd` int NOT NULL,
  `vcd_judul` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `koleksi_vcd`
--

INSERT INTO `koleksi_vcd` (`kode_vcd`, `vcd_judul`, `kategori`) VALUES
(1, 'asdasd', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` int NOT NULL,
  `peg_nama` varchar(100) NOT NULL,
  `peg_alamat` varchar(100) NOT NULL,
  `peg_tlp` varchar(100) NOT NULL,
  `peg_tglmasuk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `peg_nama`, `peg_alamat`, `peg_tlp`, `peg_tglmasuk`) VALUES
(1, 'qweqwe', 'qweqwe', 'qweqwe', '12-12-2023');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `kode_sewa_penyewaan` int NOT NULL,
  `sw_tglsewa` varchar(100) NOT NULL,
  `sw_noanggota` varchar(100) NOT NULL,
  `sw_nip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`kode_sewa_penyewaan`, `sw_tglsewa`, `sw_noanggota`, `sw_nip`) VALUES
(1, '16-12-2023', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_detail`
--

CREATE TABLE `penyewaan_detail` (
  `kode_sewa` int NOT NULL,
  `sw_kodevcd` varchar(100) NOT NULL,
  `sw_tglkembali` varchar(100) NOT NULL,
  `sw_tglpengembaliaan` varchar(100) NOT NULL,
  `sw_biayasewa` varchar(100) NOT NULL,
  `sw_denda` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penyewaan_detail`
--

INSERT INTO `penyewaan_detail` (`kode_sewa`, `sw_kodevcd`, `sw_tglkembali`, `sw_tglpengembaliaan`, `sw_biayasewa`, `sw_denda`) VALUES
(1, '1', '15-12-2023', '16-12-2023', '123123', '12');

-- --------------------------------------------------------

--
-- Structure for view `detail_peminjaman`
--
DROP TABLE IF EXISTS `detail_peminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_peminjaman`  AS SELECT `a`.`No_anggota` AS `No_anggota`, `a`.`angg_nama` AS `Nama_anggota`, `p`.`kode_sewa_penyewaan` AS `Kode_sewa`, `pd`.`sw_tglkembali` AS `Tgl_kembali`, `kv`.`vcd_judul` AS `Vcd_judul` FROM (((`anggota` `a` join `penyewaan` `p` on((`a`.`No_anggota` = `p`.`sw_noanggota`))) join `penyewaan_detail` `pd` on((`p`.`kode_sewa_penyewaan` = `pd`.`kode_sewa`))) join `koleksi_vcd` `kv` on((`pd`.`sw_kodevcd` = `kv`.`kode_vcd`))) GROUP BY `a`.`No_anggota`, `a`.`angg_nama`, `p`.`kode_sewa_penyewaan`, `pd`.`sw_tglkembali`, `kv`.`vcd_judul``vcd_judul`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`No_anggota`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `koleksi_vcd`
--
ALTER TABLE `koleksi_vcd`
  ADD PRIMARY KEY (`kode_vcd`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`kode_sewa_penyewaan`);

--
-- Indexes for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  ADD PRIMARY KEY (`kode_sewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `koleksi_vcd`
--
ALTER TABLE `koleksi_vcd`
  MODIFY `kode_vcd` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `nip` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `kode_sewa_penyewaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  MODIFY `kode_sewa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
