DROP TABLE tbl_files;

CREATE TABLE `tbl_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `isian` tinyint(1) NOT NULL,
  `rapat_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_files VALUES("1","35-32-10-17-08-21-logo-hut-ke-76-ri.jpg","upload/rapat/","1","7");
INSERT INTO tbl_files VALUES("2","4858-logo-hut-ke-76-ri.jpg","upload/rapat/","0","7");
INSERT INTO tbl_files VALUES("3","9916-PANITIA PERESMIAN MASJID BAITURROUF 2.docx","upload/rapat/","0","8");
INSERT INTO tbl_files VALUES("4","4675-1-dikonversi.pdf","upload/rapat/","0","9");
INSERT INTO tbl_files VALUES("5","14-53-11-17-08-21-logo-hut-ke-76-ri.jpg","upload/rapat/","1","10");
INSERT INTO tbl_files VALUES("6","8530-4858-logo-hut-ke-76-ri.jpg","upload/rapat/","0","10");
INSERT INTO tbl_files VALUES("7","4901-PANITIA PERESMIAN MASJID BAITURROUF 2.docx","upload/rapat/","0","11");
INSERT INTO tbl_files VALUES("8","6676-[PAGE 3] zak - Laporan TA..pdf","upload/rapat/","0","12");



DROP TABLE tbl_instansi;

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_instansi VALUES("1","Inspektorat Kabupaten Demak","INSPEKTORAT","Terakreditasi A","Jl. Kyai Mugni 1018-B, Petengan Selatan, Bintoro, Kec. Demak, Kabupaten Demak, Jawa Tengah 59511",".","-","https://localhost","rudi@masrud.com","234036693_206258044784916_3376650780198122801_n.jpg","3");



DROP TABLE tbl_rapat;

CREATE TABLE `tbl_rapat` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `notulis` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time(6) NOT NULL,
  `nama_pimpinan` varchar(255) NOT NULL,
  `peserta` varchar(255) NOT NULL,
  `isian` text NOT NULL,
  `CREATED_AT` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `id_user` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_rapat VALUES("10","392","Kemerdekaan Indonesia","2021-08-16","09:00:00.000000","Zaki","Alan","<p><em>Text</em> ini adalah hasil dari <span style=\"text-decoration: underline;\"><strong>rapat</strong></span><em> </em><strong>hari ini</strong></p>
<p><img src=\"upload/rapat/14-53-11-17-08-21-logo-hut-ke-76-ri.jpg\" alt=\"\" width=\"235\" height=\"132\" /></p>","2021-08-17 16:54:41.019374","1");
INSERT INTO tbl_rapat VALUES("11","462","Percobaan Ekstensi File DOC","2021-08-10","16:00:00.000000","Zaki","Chirza","<p>-</p>","2021-08-17 16:56:24.400006","1");
INSERT INTO tbl_rapat VALUES("12","4620","Percobaan Ekstensi File PDF","2021-08-17","16:00:00.000000","Zaki","Kiki","<p>-</p>","2021-08-17 16:57:17.513920","1");



DROP TABLE tbl_sett;

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_sett VALUES("1","10","10","10","1");



DROP TABLE tbl_user;

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","masrud","7d05dc02abe9cda729d0c798c886db47","M. Rudianto","-","1");
INSERT INTO tbl_user VALUES("2","masrud2","7d05dc02abe9cda729d0c798c886db47","masrud","1010","3");
INSERT INTO tbl_user VALUES("3","masrud3","7d05dc02abe9cda729d0c798c886db47","Test","1010","2");



