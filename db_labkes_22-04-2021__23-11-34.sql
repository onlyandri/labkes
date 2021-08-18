-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 22 Apr 2021 pada 23.27
-- Versi Server: 5.5.34
-- Versi PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `db_labkes`
--
CREATE DATABASE IF NOT EXISTS `db_labkes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_labkes`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(100) NOT NULL,
  `tlp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `tlp`, `alamat`, `user_id`) VALUES
(1, 'Soekarno', '082323499905', 'Jl. Raya Waru Kidul, Warukidul Kidul, Warukidul, Kec. Wiradesa, Pekalongan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE IF NOT EXISTS `dokter` (
  `id_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dokter` varchar(100) NOT NULL,
  `spesifikasi` varchar(100) NOT NULL,
  `tlp` varchar(14) DEFAULT NULL,
  `alamat` text,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_dokter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesifikasi`, `tlp`, `alamat`, `user_id`) VALUES
(1, 'dr. Soekarno Hatta', 'Patologi Klinik', '082323499906', 'Jl. Gajah Mada Bar. No.27, Kramatsari, Kec. Pekalongan Barat, Kota Pekalongan', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pemeriksaan`
--

CREATE TABLE IF NOT EXISTS `jenis_pemeriksaan` (
  `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemeriksaan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pemeriksaan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `jenis_pemeriksaan`
--

INSERT INTO `jenis_pemeriksaan` (`id_pemeriksaan`, `nama_pemeriksaan`) VALUES
(1, 'HEMATOLOGI'),
(2, 'MIKROBIOLOGI'),
(3, 'KIMIA /ENSYM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE IF NOT EXISTS `pasien` (
  `id_pasien` varchar(10) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tlp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_pasien`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `tgl_daftar`, `nama_pasien`, `tgl_lahir`, `jk`, `tlp`, `alamat`, `user_id`) VALUES
('PS210401', '2021-04-21', 'Cut Nyak Dien', '1985-06-13', 'P', '085642325656', 'Jl. Merpati No.23 Mayangan Wiradesa', 1),
('PS210402', '2021-04-22', 'W.R Supratman', '1982-01-22', 'L', '082323499905', 'Jl. Merdeka No.45 Kandang Panjang Pekalongan', 1),
('PS210403', '2021-04-23', 'Dewi Sartika', '2021-01-14', 'P', '085642327659', 'Jl. Lawu No.45 Warung Asem Pekalongan', 1),
('PS210404', '2021-04-23', 'Sutan Syahrir', '2021-04-20', 'L', '+6282323469856', 'Jl. Kutilang No.45 Pencongan Wiradesa', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan_pasien`
--

CREATE TABLE IF NOT EXISTS `pemeriksaan_pasien` (
  `id_pp` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_periksa` date NOT NULL,
  `ket_klinis` text NOT NULL,
  `pasien_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id_pp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `pemeriksaan_pasien`
--

INSERT INTO `pemeriksaan_pasien` (`id_pp`, `tgl_periksa`, `ket_klinis`, `pasien_id`) VALUES
(1, '2021-04-22', '-', 'PS210402'),
(2, '2021-04-21', '-', 'PS210401'),
(3, '2021-04-23', '-', 'PS210402'),
(4, '2021-04-23', '-', 'PS210403'),
(5, '2021-04-23', '-', 'PS210404');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_periksa`
--

CREATE TABLE IF NOT EXISTS `sub_periksa` (
  `id_sub_periksa` int(11) NOT NULL AUTO_INCREMENT,
  `pemeriksaan_id` int(11) NOT NULL,
  `nama_sub_periksa` varchar(100) NOT NULL,
  PRIMARY KEY (`id_sub_periksa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data untuk tabel `sub_periksa`
--

INSERT INTO `sub_periksa` (`id_sub_periksa`, `pemeriksaan_id`, `nama_sub_periksa`) VALUES
(1, 1, 'Darah Rutin'),
(2, 1, 'Darah Lengkap (Hb)'),
(3, 1, 'Darah Lengkap (Leukosit)'),
(4, 2, 'Sekret Go'),
(5, 2, 'BTA'),
(6, 2, 'Gram'),
(7, 3, 'Glukosa Sewaktu'),
(8, 3, 'Glukosa Puasa'),
(9, 1, 'Darah Lengkap (LED)'),
(10, 1, 'Darah Lengkap (Hitung Jenis)'),
(11, 1, 'Darah Lengkap (Trombosit)'),
(12, 1, 'Darah Lengkap (Hematokrit)'),
(13, 1, 'Gambaran Darah Tepi'),
(14, 2, 'Neisser'),
(15, 2, 'Trichomonas'),
(16, 2, 'Jamur'),
(17, 2, 'Malaria'),
(18, 3, 'Glukosa 2 Jam PP'),
(19, 3, 'Bilirubin Total'),
(20, 3, 'Dilirubin Direk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes_pasien`
--

CREATE TABLE IF NOT EXISTS `tes_pasien` (
  `pp_id` int(11) NOT NULL,
  `sub_periksa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tes_pasien`
--

INSERT INTO `tes_pasien` (`pp_id`, `sub_periksa_id`) VALUES
(2, 1),
(2, 13),
(2, 16),
(2, 7),
(2, 8),
(1, 1),
(1, 10),
(1, 17),
(1, 8),
(3, 1),
(4, 17),
(5, 13),
(5, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `user_level` enum('Admin','PJ') NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `user_level`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Y'),
(2, 'pj', '477d786be0fbb228db53105e6d5a029f', 'PJ', 'Y');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
