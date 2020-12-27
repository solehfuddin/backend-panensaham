-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 27, 2020 at 04:05 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `panen_saham`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(11) NOT NULL,
  `nama_banner` varchar(50) NOT NULL,
  `header_banner` varchar(75) NOT NULL,
  `content_banner` varchar(150) NOT NULL,
  `gambar_banner` text NOT NULL,
  `link_banner` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '0 => hide, 1 => show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id_contact_us` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `isi_pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `custom`
--

CREATE TABLE `custom` (
  `kode_custom` varchar(10) NOT NULL,
  `judul_custom` varchar(100) NOT NULL,
  `isi_custom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `custom`
--

INSERT INTO `custom` (`kode_custom`, `judul_custom`, `isi_custom`) VALUES
('CSTM001', 'Nama perusahaan', 'Komunitas PanenSaham'),
('CSTM002', 'Alamat perusahaan', 'Gading bukit indah blok A no 27 Kelapa gading barat, Kelapa gading, Jakarta Utara 14240'),
('CSTM003', 'Judul Landing Page', 'Bot PanenSaham dari komunitas PanenSaham untuk komunitas PanenSaham'),
('CSTM004', 'About Us', 'Asisten panen saham adalah bla bla bla');

-- --------------------------------------------------------

--
-- Table structure for table `filter_media`
--

CREATE TABLE `filter_media` (
  `kode_filter_media` varchar(10) NOT NULL,
  `judul_filter` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filter_media`
--

INSERT INTO `filter_media` (`kode_filter_media`, `judul_filter`) VALUES
('FMED001', 'Video Utama'),
('FMED002', 'Rekomendasi Video'),
('FMED003', 'Video Landing Page'),
('FMED004', 'Gambar Landing Page');

-- --------------------------------------------------------

--
-- Table structure for table `harga_paket`
--

CREATE TABLE `harga_paket` (
  `kode_harga_paket` int(11) NOT NULL,
  `kode_jenis_member` varchar(10) NOT NULL,
  `kode_user_level` varchar(10) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `bulan` int(10) NOT NULL,
  `hemat` int(11) NOT NULL,
  `potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_paket`
--

INSERT INTO `harga_paket` (`kode_harga_paket`, `kode_jenis_member`, `kode_user_level`, `harga_paket`, `bulan`, `hemat`, `potongan`) VALUES
(1, 'JMBR001', 'MULV001', 0, 1, 0, 0),
(2, 'JMBR001', 'MULV002', 120000, 1, 0, 0),
(3, 'JMBR002', 'MULV001', 0, 1, 0, 0),
(4, 'JMBR002', 'MULV002', 75000, 1, 0, 0),
(5, 'JMBR001', 'MULV002', 1152000, 12, 20, 288000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengumuman`
--

CREATE TABLE `jenis_pengumuman` (
  `kode_jenis_pengumuman` varchar(10) NOT NULL,
  `jenis_pengumuman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_pengumuman`
--

INSERT INTO `jenis_pengumuman` (`kode_jenis_pengumuman`, `jenis_pengumuman`) VALUES
('JEPM001', 'News'),
('JEPM002', 'Events');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pengumuman`
--

CREATE TABLE `kategori_pengumuman` (
  `kode_kategori_pengumuman` varchar(10) NOT NULL,
  `nama_kategori_pengumuman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_pengumuman`
--

INSERT INTO `kategori_pengumuman` (`kode_kategori_pengumuman`, `nama_kategori_pengumuman`) VALUES
('KTPM001', 'HOT'),
('KTPM002', 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `keunggulan`
--

CREATE TABLE `keunggulan` (
  `kode_keunggulan` varchar(10) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `deskripsi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keunggulan`
--

INSERT INTO `keunggulan` (`kode_keunggulan`, `judul`, `deskripsi`) VALUES
('KUGL001', 'User Friendly', 'Tampilan aplikasi yang sangat mudah untuk digunakan'),
('KUGL002', 'Cepat & Ringan', 'Rasakan sensasi trading yang cepat dan ringan dengan bantuan tools dari kami');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `kode_media` varchar(10) NOT NULL,
  `link_media` text NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `jenis_media` varchar(10) NOT NULL,
  `kode_filter_media` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`kode_media`, `link_media`, `judul`, `deskripsi`, `jenis_media`, `kode_filter_media`) VALUES
('KMED001', 'http://nlalsbal.co.aasdf/asdf', 'Belajar saham dari nol', 'Dalam video ini dibahas mengenai bla bla bla', 'Video', 'FMED001'),
('KMED002', 'http://alsja.ajksk.co/aj123', 'Cara trading saham modal kecil, untung besar', 'Ini adalah best practice untuk bla bla bla', 'Video', 'FMED002'),
('KMED003', 'http://asfsa.co/afdaad', 'Gambar landing page', 'Gambar penting untuk landing page', 'Gambar', 'FMED004');

-- --------------------------------------------------------

--
-- Table structure for table `m_fitur_paket`
--

CREATE TABLE `m_fitur_paket` (
  `kode_fitur_paket` int(11) NOT NULL,
  `kode_user_level` varchar(10) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_fitur_paket`
--

INSERT INTO `m_fitur_paket` (`kode_fitur_paket`, `kode_user_level`, `keterangan`) VALUES
(1, 'MULV001', '1 Chart Daily'),
(2, 'MULV001', '1 Filter EOD'),
(3, 'MULV002', '12 Chart Realtime'),
(4, 'MULV002', 'Interval Chart 5 min-Mon');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_member`
--

CREATE TABLE `m_jenis_member` (
  `kode_jenis_member` varchar(10) NOT NULL,
  `keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_jenis_member`
--

INSERT INTO `m_jenis_member` (`kode_jenis_member`, `keterangan`) VALUES
('JMBR001', 'Member Baru'),
('JMBR002', 'Anggota Koperasi PanenSaham'),
('JMBR003', 'Member Komunitas PanenSaham');

-- --------------------------------------------------------

--
-- Table structure for table `m_user_level`
--

CREATE TABLE `m_user_level` (
  `kode_user_level` varchar(10) NOT NULL,
  `nama_level` varchar(50) NOT NULL,
  `alias_level` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `info_tambahan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_user_level`
--

INSERT INTO `m_user_level` (`kode_user_level`, `nama_level`, `alias_level`, `keterangan`, `info_tambahan`) VALUES
('MULV001', 'User Trial', 'BASIC', 'Refer friend and get up to $30', 'Untuk para investor dan trader yang ingin mengenal dan melihat fitur-fitur yang ada ditools ini'),
('MULV002', 'User Biasa', 'BIASA', '', ''),
('MULV003', 'User Teknikal', 'PAKET TA', 'Dapatkan diskon 50% dengan menjadi member komunitas PanenSaham dan anggota koperasi jasa PanenSaham GRATIS', 'Investasi dan trading tanpa gangguan, full akses ke semua fitur-fitur yang kami sediakan untuk anda dengan chart, interval, indikator dan alert yang sangat lengkap untuk anda.'),
('MULV004', 'User Fundamental', 'PAKET FA', 'Dapatkan diskon 50% dengan menjadi member komunitas PanenSaham dan anggota koperasi jasa PanenSaham GRATIS', 'Investasi dan trading tanpa gangguan, full akses ke semua fitur-fitur yang kami sediakan untuk anda dengan chart, interval, indikator dan alert yang sangat lengkap untuk anda.'),
('MULV005', 'User Ultimate', 'ULTIMATE', 'Dapatkan diskon 50% dengan menjadi member komunitas PanenSaham dan anggota koperasi jasa PanenSaham GRATIS', 'Investasi dan trading tanpa gangguan, full akses ke semua fitur-fitur yang kami sediakan untuk anda dengan chart, interval, indikator dan alert yang sangat lengkap untuk anda.'),
('MULV006', 'Administrator', 'Admin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `kode_pengumuman` varchar(10) NOT NULL,
  `kode_jenis_pengumuman` varchar(10) NOT NULL,
  `kode_kategori_pengumuman` varchar(10) NOT NULL,
  `tgl_pengumuman` date NOT NULL,
  `judul` varchar(150) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`kode_pengumuman`, `kode_jenis_pengumuman`, `kode_kategori_pengumuman`, `tgl_pengumuman`, `judul`, `isi_pengumuman`, `gambar`) VALUES
('PENG001', 'JEPM001', 'KTPM001', '2020-12-15', 'IHSG berpotensi melemah, simak rekomendasi saham sebelum trading', 'Indeks harga saham gabungan (IHGS) berpotensi melanjutkan pelemahannya bla bla bla', ''),
('PENG002', 'JEPM002', 'KTPM002', '2020-12-15', 'Hadiri contest trading jakarta', 'Hari ini pelaksanaan contest trading. ayo ikuti untuk mendapatkan hadiah bernilai bla bala bla', '');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id_subscriber` int(11) NOT NULL,
  `email_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id_subscriber`, `email_address`) VALUES
(1, 'udin@trl.co.id');

-- --------------------------------------------------------

--
-- Table structure for table `t_invoice`
--

CREATE TABLE `t_invoice` (
  `kode_invoice` varchar(20) NOT NULL,
  `kode_user` varchar(20) NOT NULL,
  `kode_harga_paket` int(11) NOT NULL,
  `invoicing_date` date NOT NULL,
  `extend_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 => pending, 1 => active, 2 => inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_invoice`
--

INSERT INTO `t_invoice` (`kode_invoice`, `kode_user`, `kode_harga_paket`, `invoicing_date`, `extend_date`, `expire_date`, `status`) VALUES
('APS001', 'TUSR001', 5, '2020-12-16', '2020-12-17', '2021-12-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `kode_user` varchar(20) NOT NULL,
  `kode_user_level` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(70) NOT NULL,
  `photo` text NOT NULL,
  `alamat_email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kode_referal` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `website` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tentang_saya` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`kode_user`, `kode_user_level`, `username`, `nama_lengkap`, `photo`, `alamat_email`, `password`, `no_hp`, `kota`, `kode_referal`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `website`, `alamat`, `tentang_saya`, `created_at`) VALUES
('TUSR001', 'MULV006', 'USRFUD1', 'Udin Poltak', '', 'udin@trl.co', 'e10adc3949ba59abbe56e057f20f883e', '08189203740', 'Jakarta', '', 'Laki-laki', 'Bogor', '1995-12-10', 'www.siudin.dev', 'Jakarta', '', '2020-12-20 20:33:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id_contact_us`);

--
-- Indexes for table `custom`
--
ALTER TABLE `custom`
  ADD PRIMARY KEY (`kode_custom`);

--
-- Indexes for table `filter_media`
--
ALTER TABLE `filter_media`
  ADD PRIMARY KEY (`kode_filter_media`);

--
-- Indexes for table `harga_paket`
--
ALTER TABLE `harga_paket`
  ADD PRIMARY KEY (`kode_harga_paket`);

--
-- Indexes for table `jenis_pengumuman`
--
ALTER TABLE `jenis_pengumuman`
  ADD PRIMARY KEY (`kode_jenis_pengumuman`);

--
-- Indexes for table `kategori_pengumuman`
--
ALTER TABLE `kategori_pengumuman`
  ADD PRIMARY KEY (`kode_kategori_pengumuman`);

--
-- Indexes for table `keunggulan`
--
ALTER TABLE `keunggulan`
  ADD PRIMARY KEY (`kode_keunggulan`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`kode_media`);

--
-- Indexes for table `m_fitur_paket`
--
ALTER TABLE `m_fitur_paket`
  ADD PRIMARY KEY (`kode_fitur_paket`);

--
-- Indexes for table `m_jenis_member`
--
ALTER TABLE `m_jenis_member`
  ADD PRIMARY KEY (`kode_jenis_member`);

--
-- Indexes for table `m_user_level`
--
ALTER TABLE `m_user_level`
  ADD PRIMARY KEY (`kode_user_level`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`kode_pengumuman`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id_subscriber`);

--
-- Indexes for table `t_invoice`
--
ALTER TABLE `t_invoice`
  ADD PRIMARY KEY (`kode_invoice`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id_contact_us` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harga_paket`
--
ALTER TABLE `harga_paket`
  MODIFY `kode_harga_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_fitur_paket`
--
ALTER TABLE `m_fitur_paket`
  MODIFY `kode_fitur_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id_subscriber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
