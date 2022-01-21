/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.1.25-MariaDB : Database - simaset
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`simaset` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `simaset`;

/*Table structure for table `asets` */

DROP TABLE IF EXISTS `asets`;

CREATE TABLE `asets` (
  `id_increment` int(10) NOT NULL AUTO_INCREMENT,
  `id_aset` varchar(128) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kode_aset` varchar(128) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_lokasi` varchar(128) DEFAULT NULL,
  `pr_assets` varchar(100) DEFAULT NULL,
  `po_assets` varchar(100) DEFAULT NULL,
  `sn_assets` varchar(100) DEFAULT NULL,
  `tglbarangdatang_assets` date DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan_id` varchar(20) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `kondisi` varchar(128) DEFAULT 'Baik',
  `status_aset` varchar(50) DEFAULT NULL,
  `umur_ekonomis` int(11) DEFAULT NULL,
  `jenis_bantuan` varchar(128) DEFAULT NULL,
  `jenis_aset` varchar(128) DEFAULT 'Berwujud',
  `keterangan` text,
  `qr_code` varchar(128) DEFAULT NULL,
  `id_user_input` int(10) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  `device_input` varchar(170) DEFAULT NULL,
  `ip_input` varchar(30) DEFAULT NULL,
  `id_user_ubah` int(10) DEFAULT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `device_ubah` varchar(170) DEFAULT NULL,
  `ip_ubah` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_aset`),
  KEY `id_barang` (`id_barang`),
  KEY `id_lokasi` (`id_lokasi`),
  KEY `user_id` (`user_id`),
  KEY `satuan_id` (`satuan_id`),
  KEY `id_increment` (`id_increment`),
  CONSTRAINT `asets_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asets_ibfk_3` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `asets` */

insert  into `asets`(`id_increment`,`id_aset`,`user_id`,`kode_aset`,`id_barang`,`id_lokasi`,`pr_assets`,`po_assets`,`sn_assets`,`tglbarangdatang_assets`,`gambar`,`volume`,`satuan_id`,`harga`,`total_harga`,`kondisi`,`status_aset`,`umur_ekonomis`,`jenis_bantuan`,`jenis_aset`,`keterangan`,`qr_code`,`id_user_input`,`tgl_input`,`device_input`,`ip_input`,`id_user_ubah`,`tgl_ubah`,`device_ubah`,`ip_ubah`) values 
(19,'073b11da52564a63a61b367ba02bdbf2',1,'19/FNT/2022',16,'1','sds','sda','232s','2022-01-12',NULL,1,'S03',12122,12122,'Baik','Aktif',12,'GA','Berwujud','d','e8e26cd88c2642ee8501e9e7158292a6.png',1,'2022-01-19 09:07:59','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36','::1',1,'2022-01-19 09:12:24','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36','::1'),
(1,'0a087a5a44bb40b0aaad13f3695d4f44',9,'121212',6,'25',NULL,NULL,NULL,NULL,NULL,1,'S01',12000,12000,'Baik','Aktif',1,'Pemerintah','Berwujud','-','331f6618654e470889dc5fddf734df73.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(2,'2ce7c84b803f497189ce3b2601350c7b',1,'0004/FNT/2021',11,'25',NULL,NULL,NULL,NULL,NULL,0,'S01',200000,200000,'Baik','Aktif',5,'Pemerintah','Berwujud','-','1d21ddd7e3ec4a17b66737355a40ea2a.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,'454725bfd63b48dcbc1e7d0b9259c967',9,'0008/FNT/2021',15,'1',NULL,NULL,NULL,NULL,NULL,1,'S03',600000,600000,'Baik','Aktif',5,'Pemerintah','Berwujud','-','0e8519197ca140928beff597c9c19b83.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(17,'4a454721aa0c43c293b94b05bbf11a94',9,'17/FNT/2022',16,'1',NULL,NULL,NULL,NULL,NULL,1,'S03',230000,230000,'Baik','Aktif',1,'Sekolah','Berwujud','121','183b3a5ef01c4897b204953531ad2a35.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,'4ce099334b6e4f7db5269102c8a9fe30',1,'0001/FNT/2021',14,'25',NULL,NULL,NULL,NULL,NULL,1,'S01',350000,350000,'Baik','Aktif',1,'Pemerintah','Berwujud','-','efea8751e0a94a0b9d2b257dd7478838.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(18,'5291d5e38a3947b898352bcd9b4bfbf6',1,'18/FNT/2022',13,'25','PR/192./sds/sd2/2022','PO/192./sds/sd2/2022',NULL,NULL,NULL,1,'S01',23,23,'Baik','Aktif',1,'IT','Berwujud','wew','2ae025bb5291488da0fd4e825c250f9b.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(13,'5d708ab87d474be2a743973aa05ccbfd',10,'13/ELK/2022',17,'1',NULL,NULL,NULL,NULL,NULL,1,'S03',2000,2000,'Baik','Aktif',1,'Sekolah','Berwujud','ww','7d6e02a576c445b4b6308057de765bfe.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(15,'780fcebc5395444c92194ec19d435984',9,'15/FNT/2022',16,'1',NULL,NULL,NULL,NULL,NULL,1,'S03',230000,230000,'Baik','Aktif',1,'Sekolah','Berwujud','121','177277fb16ad40b68ce2978012830439.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(5,'7cb6ce45e39e4fd0a8245f4029f2418b',1,'0006/FNT/2021',9,'25',NULL,NULL,NULL,NULL,NULL,2,'S01',300000,600000,'Baik','Aktif',5,'Pemerintah','Berwujud','-','f4103002832c4104b2933169d401c0b4.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(6,'8b90225c91434887bb8f095b3405e44a',1,'0002/FNT/2021',13,'25',NULL,NULL,NULL,NULL,NULL,1,'S01',200000,200000,'Baik','Aktif',1,'Pemerintah','Berwujud','-','35302c738eea43aea76b75857ce7167d.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(7,'91a18727357142a99b7302013a6d6ad0',1,'0005/FNT/2021',10,'25',NULL,NULL,NULL,NULL,NULL,3,'S01',100000,300000,'Baik','Aktif',5,'Yayasan','Berwujud','-','13197b8bac3c4c66be220fdfc2717f34.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(8,'a16daacfc694448d9462ac47a14ed81f',1,'0007/FNT/2021',8,'25',NULL,NULL,NULL,NULL,NULL,1,'S01',200000,200000,'Baik','Aktif',5,'Pemerintah','Berwujud','-','80d618c56e074351b6e506e3492166a7.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(16,'d044fcbb60c64f2eaf3c5b0e16806bf0',9,'16/FNT/2022',16,'1',NULL,NULL,NULL,NULL,NULL,1,'S03',230000,230000,'Baik','Aktif',1,'Sekolah','Berwujud','121','cba8e2b4847047079bdf6a453a874bf4.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(9,'db1f21c1e8934b0a94b4addc50ef0d23',1,'0003/FNT/2021',12,'25',NULL,NULL,NULL,NULL,NULL,1,'S01',500000,500000,'Baik','Aktif',5,'Pemerintah','Berwujud','-','cedd851f20c5405cb5574e9f83168591.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(10,'de0ebc12062f43a383cbf9849be492c9',1,'0001/ELK/2021',7,'25',NULL,NULL,NULL,NULL,NULL,2,'S03',2000000,4000000,'Baik','Aktif',5,'Pemerintah','Berwujud','-','106e801ed289425c8fe005d2fe435329.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(14,'f79b1c7a1cc747b0961bac3ad3c088a4',9,'14/FNT/2022',16,'1',NULL,NULL,NULL,NULL,NULL,1,'S03',230000,230000,'Baik','Aktif',1,'Sekolah','Berwujud','121','697f083925ad4014828cdb2afa2c47c9.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `id_sub_kategori` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(128) NOT NULL,
  `tahun_perolehan` year(4) NOT NULL,
  `picture` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_jenis` (`id_kategori`),
  KEY `id_sub_kategori` (`id_sub_kategori`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`id_sub_kategori`) REFERENCES `sub_kategori` (`kode_sub`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`id_kategori`,`id_sub_kategori`,`nama_barang`,`merek`,`tahun_perolehan`,`picture`) values 
(6,3,'FNT01','Raks','Olympic',2021,NULL),
(7,2,'ELK01','TV Led','Polytron',2021,NULL),
(8,3,'FNT02','Kursi Komputer','Oympic',2021,NULL),
(9,3,'FNT02','Kursi Administrasi','Olympic',2021,NULL),
(10,3,'FNT02','Kursi Plastik','Olympic',2021,NULL),
(11,3,'FNT02','Kursi Kayu','Olympic',2021,NULL),
(12,3,'FNT01','Rak Absensi','Hitari',2021,NULL),
(13,3,'FNT02','Kursi Staff TU','Olympic',2021,NULL),
(14,3,'FNT02','Kursi Guru','Sinar Jaya',2021,'0d47a73c782bcb6a04659713c88d9b83.jpg'),
(15,2,'ELK01','TV LED 32','Sharp',2021,NULL),
(16,3,'FNT02','asas','asas',2021,NULL),
(17,2,'ELK01','LG LED TV','SMAS',2022,'c96be45fd157e91db5389bcb9a1eeb5d.PNG');

/*Table structure for table `data_aset` */

DROP TABLE IF EXISTS `data_aset`;

CREATE TABLE `data_aset` (
  `id_aset` int(11) NOT NULL AUTO_INCREMENT,
  `nama_aset` varchar(128) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id_aset`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `data_aset` */

insert  into `data_aset`(`id_aset`,`nama_aset`,`harga`) values 
(1,'Full Set Komputer Core i5 Lcd 19inc Acer',3499000),
(2,'Full Set Komputer Core i5 Lcd 19inc Asus',4000000),
(3,'Full Set Komputer Core i5 Lcd 19inc Lenovo',3000000),
(4,'Full Set Komputer Core i5 Lcd 19inc Acer',2925000);

/*Table structure for table `kategori_barang` */

DROP TABLE IF EXISTS `kategori_barang`;

CREATE TABLE `kategori_barang` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kategori` varchar(128) DEFAULT NULL,
  `nama_kategori` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori_barang` */

insert  into `kategori_barang`(`id_kategori`,`kode_kategori`,`nama_kategori`,`updated_at`) values 
(2,'ELK','ELEKTRONIK','2020-09-24 22:48:34'),
(3,'FNT','FURNITURE','2020-09-24 22:48:44'),
(4,'OA','Office Accessories','2021-09-07 14:17:14');

/*Table structure for table `keputusan_pengadaan` */

DROP TABLE IF EXISTS `keputusan_pengadaan`;

CREATE TABLE `keputusan_pengadaan` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_aset` int(11) DEFAULT NULL,
  `id_spesifikasi` int(11) DEFAULT NULL,
  `id_kualitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_spesifikasi` (`id_spesifikasi`),
  KEY `id_kualitas` (`id_kualitas`),
  KEY `id_aset` (`id_aset`),
  CONSTRAINT `keputusan_pengadaan_ibfk_1` FOREIGN KEY (`id_spesifikasi`) REFERENCES `kriteria_spesifikasi` (`id_spesifikasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `keputusan_pengadaan_ibfk_2` FOREIGN KEY (`id_kualitas`) REFERENCES `kriteria_kualitas` (`id_kualitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `keputusan_pengadaan_ibfk_3` FOREIGN KEY (`id_aset`) REFERENCES `data_aset` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `keputusan_pengadaan` */

insert  into `keputusan_pengadaan`(`id_nilai`,`id_aset`,`id_spesifikasi`,`id_kualitas`) values 
(1,1,1,2),
(2,2,2,1),
(3,3,2,2),
(4,4,3,2);

/*Table structure for table `kriteria_kualitas` */

DROP TABLE IF EXISTS `kriteria_kualitas`;

CREATE TABLE `kriteria_kualitas` (
  `id_kualitas` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(128) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_kualitas`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kriteria_kualitas` */

insert  into `kriteria_kualitas`(`id_kualitas`,`keterangan`,`nilai`) values 
(1,'Sangat Baik',0.5),
(2,'Baik',0.4),
(3,'Cukup',0.3),
(4,'Jelek',0.2),
(5,'Sangat Jelek',0.1);

/*Table structure for table `kriteria_spesifikasi` */

DROP TABLE IF EXISTS `kriteria_spesifikasi`;

CREATE TABLE `kriteria_spesifikasi` (
  `id_spesifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(128) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_spesifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kriteria_spesifikasi` */

insert  into `kriteria_spesifikasi`(`id_spesifikasi`,`keterangan`,`nilai`) values 
(1,'Sangat Baik',0.5),
(2,'Baik',0.4),
(3,'Cukup',0.3),
(4,'Jelek',0.2),
(5,'Sangat Jelek',0.1);

/*Table structure for table `lokasi_aset` */

DROP TABLE IF EXISTS `lokasi_aset`;

CREATE TABLE `lokasi_aset` (
  `id_lokasi` int(128) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(128) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `lokasi_aset` */

insert  into `lokasi_aset`(`id_lokasi`,`nama_lokasi`,`updated_at`) values 
(1,'Ruang Laboratorium Fisika','2021-09-07 15:31:11'),
(25,'Ruang Laboratorium Komputer','2021-09-07 14:29:17');

/*Table structure for table `monitoring_aset` */

DROP TABLE IF EXISTS `monitoring_aset`;

CREATE TABLE `monitoring_aset` (
  `id_monitoring` int(11) NOT NULL AUTO_INCREMENT,
  `id_aset` varchar(128) DEFAULT NULL,
  `kerusakan` text,
  `akibat` text,
  `faktor` text,
  `monitoring` text,
  `pemeliharaan` text,
  `jml_rusak` varchar(128) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_monitoring`),
  KEY `id_aset` (`id_aset`),
  CONSTRAINT `monitoring_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `monitoring_aset` */

insert  into `monitoring_aset`(`id_monitoring`,`id_aset`,`kerusakan`,`akibat`,`faktor`,`monitoring`,`pemeliharaan`,`jml_rusak`,`foto`,`updated_at`) values 
(2,'de0ebc12062f43a383cbf9849be492c9','<p>-</p>','<p>-</p>','<p>-</p>','<p>-</p>','<p>-</p>','1','c8cb201401471bbb41b21421e3362a91.jpg','2021-12-25 10:55:20');

/*Table structure for table `mutasi` */

DROP TABLE IF EXISTS `mutasi`;

CREATE TABLE `mutasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aset_id` varchar(128) DEFAULT NULL,
  `nama_user_m` varchar(128) DEFAULT NULL,
  `lokasi_m` varchar(128) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aset_id` (`aset_id`),
  KEY `user_id` (`nama_user_m`),
  KEY `lokasi_id` (`lokasi_m`),
  KEY `user_id_2` (`user_id`),
  KEY `lokasi_id_2` (`lokasi_id`),
  CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mutasi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mutasi_ibfk_3` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi_aset` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mutasi` */

insert  into `mutasi`(`id`,`aset_id`,`nama_user_m`,`lokasi_m`,`user_id`,`lokasi_id`,`tgl_mutasi`,`status`) values 
(5,'454725bfd63b48dcbc1e7d0b9259c967','Ikbal Akbar','Ruang Laboratorium Komputer',9,1,'2021-12-25','-');

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aset_id` varchar(128) DEFAULT NULL,
  `jml_pinjam` int(11) DEFAULT NULL,
  `kondisi_pinjam` varchar(128) DEFAULT NULL,
  `no_pinjam` varchar(128) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aset_id` (`aset_id`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id`,`aset_id`,`jml_pinjam`,`kondisi_pinjam`,`no_pinjam`,`tgl_pinjam`,`tgl_kembali`,`status`) values 
(3,'91a18727357142a99b7302013a6d6ad0',1,'Baik','001','2021-12-25','2022-01-08','Dipinjam');

/*Table structure for table `pengadaan` */

DROP TABLE IF EXISTS `pengadaan`;

CREATE TABLE `pengadaan` (
  `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama_item` int(10) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` varchar(128) DEFAULT NULL,
  `harga_satuan` double DEFAULT NULL,
  `tahun_pengadaan` varchar(4) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `status_keranjang` double DEFAULT '0',
  `tgl_keranjang` datetime DEFAULT NULL,
  `device_keranjang` varchar(180) DEFAULT NULL,
  `ip_keranjang` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pengadaan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `pengadaan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `pengadaan` */

insert  into `pengadaan`(`id_pengadaan`,`id_user`,`nama_item`,`volume`,`satuan`,`harga_satuan`,`tahun_pengadaan`,`status`,`created_at`,`status_keranjang`,`tgl_keranjang`,`device_keranjang`,`ip_keranjang`) values 
(7,1,15,1,'Unit',25000000,'2022','0','2022-01-19 19:42:57',1,'2022-01-19 19:51:53','0','::1'),
(8,1,8,2,'Unit',2500000,'2022','0','2022-01-19 19:52:42',0,NULL,NULL,NULL);

/*Table structure for table `penghapusan` */

DROP TABLE IF EXISTS `penghapusan`;

CREATE TABLE `penghapusan` (
  `id_penghapusan` int(11) NOT NULL AUTO_INCREMENT,
  `id_aset` varchar(128) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `faktor` text,
  `tgl_penghapusan` date DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_penghapusan`),
  KEY `id_aset` (`id_aset`),
  CONSTRAINT `penghapusan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penghapusan` */

insert  into `penghapusan`(`id_penghapusan`,`id_aset`,`jumlah`,`faktor`,`tgl_penghapusan`,`status`) values 
(2,'2ce7c84b803f497189ce3b2601350c7b',1,'Patah','2021-12-25','Dihapuskan');

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id_satuan` varchar(20) NOT NULL,
  `nama_satuan` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `satuan` */

insert  into `satuan`(`id_satuan`,`nama_satuan`) values 
('S01','Buah'),
('S02','Lembar'),
('S03','Unit');

/*Table structure for table `sub_kategori` */

DROP TABLE IF EXISTS `sub_kategori`;

CREATE TABLE `sub_kategori` (
  `kode_sub` varchar(20) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `nama_sub` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`kode_sub`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `sub_kategori_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `sub_kategori` */

insert  into `sub_kategori`(`kode_sub`,`kategori_id`,`nama_sub`) values 
('ELK01',2,'Televisi'),
('FNT01',3,'Rak Penyimpanan'),
('FNT02',3,'Kursi');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(6) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(125) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `role` enum('1','2','3') DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id_user`,`nama_user`,`username`,`password`,`jabatan`,`role`,`foto`) values 
(1,'Ikbal Akbar','admin','21232f297a57a5a743894a0e4a801fc3','Kepala Sarana','2','1a8e897e32abe9537b1183c8e27611b8.png'),
(9,'Fulan','fulan','3fc0a7acf087f549ac2b266baf94b8b1','Tim IT','3',NULL),
(10,'Asep Ramdani','asepramdani','36ff6eb57f93e9261db02336bc68e0c1','Kepala Lab Fisika','3',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
