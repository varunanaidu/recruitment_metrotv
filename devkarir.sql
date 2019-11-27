-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2019 at 08:56 AM
-- Server version: 5.5.56-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devkarir`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidat_achievement`
--

CREATE TABLE `candidat_achievement` (
  `achievement_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `achievement_title` varchar(150) NOT NULL,
  `achievement_org` varchar(200) DEFAULT NULL,
  `achievement_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidat_children`
--

CREATE TABLE `candidat_children` (
  `child_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `child_name` varchar(150) NOT NULL,
  `child_dob` date DEFAULT NULL,
  `child_gender` enum('M','F') DEFAULT NULL,
  `child_edu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidat_edu`
--

CREATE TABLE `candidat_edu` (
  `cedu_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `edu_title` enum('S2','S1','D3','SMU') NOT NULL,
  `edu_institute` varchar(150) NOT NULL,
  `edu_major` varchar(100) DEFAULT NULL,
  `edu_start` date DEFAULT NULL,
  `edu_end` date DEFAULT NULL,
  `gpa` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidat_edu`
--

INSERT INTO `candidat_edu` (`cedu_id`, `candidat_id`, `edu_title`, `edu_institute`, `edu_major`, `edu_start`, `edu_end`, `gpa`) VALUES
(3, 6, 'S1', 'Universitas Bina Nusantara', 'Teknik Informatika dan Matematika', '2007-09-01', '2013-12-31', '2.62'),
(4, 6, 'SMU', 'Katolik Sibolga', 'IPA', '2003-06-01', '2005-06-01', '-'),
(13, 35, 'S1', 'Universitas Brawijaya – UNIBRAW', 'TI', '2018-10-01', '2019-10-02', '3.1'),
(14, 35, 'D3', 'Universitas Islam Negeri (UIN) Alauddin', 'uy', '2017-09-01', '2018-09-05', '3.1'),
(23, 40, 'S1', 'Universitas Bina Nusantara (Kampus Alam Sutera) ', 'Teknik Informatika', '2015-09-01', '2019-03-01', '3.5'),
(26, 43, 'S1', 'Universitas Airlangga – UNAIR', 'tet', '2011-01-02', '2013-01-01', '4'),
(27, 26, 'S1', 'Universitas Sumatera Utara – USU', 'Ilmu Komputer', '2014-08-01', '2018-03-01', '3.5'),
(28, 26, 'S2', 'Universitas Indonesia – UI', 'Manajemen', '2018-09-01', '2019-08-01', '3.7'),
(31, 44, 'S1', 'Universitas Airlangga – UNAIR', 'Manajemen', '2012-01-01', '2015-02-02', '3.7');

-- --------------------------------------------------------

--
-- Table structure for table `candidat_family`
--

CREATE TABLE `candidat_family` (
  `family_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `family_name` varchar(150) NOT NULL,
  `family_relation` enum('PARENT','SIBLING') DEFAULT NULL,
  `family_dob` date DEFAULT NULL,
  `family_gender` enum('M','F') DEFAULT NULL,
  `family_edu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidat_family`
--

INSERT INTO `candidat_family` (`family_id`, `candidat_id`, `family_name`, `family_relation`, `family_dob`, `family_gender`, `family_edu`) VALUES
(1, 6, 'Djamer Pasaribu', 'PARENT', '1950-06-29', 'M', 'S1'),
(2, 6, 'Lintje R.D Situmorang', 'PARENT', '1958-06-16', 'F', 'D3'),
(3, 6, 'Merlin Nova Dameyanti Pasaribu', 'SIBLING', '1982-06-03', 'F', 'S1'),
(4, 6, 'Marsingkat Martin Avonlier Pasaribu', 'SIBLING', '1983-09-30', 'M', 'S1'),
(5, 6, 'Mario Marojahan Agustin Pasaribu', 'SIBLING', '1995-08-19', 'M', 'S1'),
(6, 24, 'Test 1', 'PARENT', '2019-09-03', 'M', 'S1'),
(7, 24, 'Test 2', 'SIBLING', '2019-09-06', 'F', 'S2'),
(8, 26, 'Test 1 Parent', 'PARENT', '1965-01-04', 'M', 'S2'),
(41, 33, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(42, 33, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(43, 33, 'Laxhmi Mahesvary', 'SIBLING', '1994-12-18', 'F', 'S1'),
(44, 33, 'Maharani Fatmawathy', 'SIBLING', '2001-11-03', 'F', 'SMU'),
(45, 33, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(46, 33, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(47, 33, 'Laxhmi Mahesvary', 'SIBLING', '1994-12-18', 'F', 'S1'),
(48, 33, 'Maharani Fatmawathy', 'SIBLING', '2001-11-03', 'F', 'SMU'),
(49, 33, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(50, 33, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(51, 33, 'Laxhmi Mahesvary', 'SIBLING', '1994-12-18', 'F', 'S1'),
(52, 33, 'Maharani Fatmawathy', 'SIBLING', '2001-11-03', 'F', 'SMU'),
(53, 33, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(54, 33, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(55, 33, 'Laxhmi Mahesvary', 'SIBLING', '1994-12-18', 'F', 'S1'),
(56, 33, 'Maharani Fatmawathy', 'SIBLING', '2001-11-03', 'F', 'SMU'),
(57, 33, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(58, 33, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(59, 33, 'Laxhmi Mahesvary', 'SIBLING', '1994-12-18', 'F', 'S1'),
(60, 33, 'Maharani Fatmawathy', 'SIBLING', '2001-11-03', 'F', 'SMU'),
(61, 33, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(62, 33, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(63, 33, 'Laxhmi Mahesvary', 'SIBLING', '1994-12-18', 'F', 'S1'),
(64, 33, 'Maharani Fatmawathy', 'SIBLING', '2001-11-03', 'F', 'SMU'),
(65, 35, 'Test A Edit', 'PARENT', '2003-01-29', 'M', 'S2'),
(66, 35, 'Parent B', 'PARENT', '2019-09-01', 'F', 'D3'),
(67, 36, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(68, 36, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(69, 37, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(70, 37, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(71, 38, 'Parent 1', 'PARENT', '1962-03-06', 'M', 'S2'),
(72, 38, 'Parent 2', 'PARENT', '1964-02-06', 'F', 'SMU'),
(73, 38, 'SIbling 1', 'SIBLING', '1990-04-21', 'F', 'S1'),
(74, 38, 'Sibling 2', 'SIBLING', '1991-12-18', 'M', 'S1'),
(75, 39, 'Wamanen', 'PARENT', '1959-09-30', 'M', 'SMU'),
(76, 39, 'Wanitha Dewi', 'PARENT', '1973-08-15', 'F', 'SMU'),
(96, 40, 'Parent 1', 'PARENT', '1962-03-06', 'M', 'S2'),
(97, 43, 'sdrkghdrkg', 'PARENT', '1991-02-02', 'M', 'S2'),
(101, 44, 'Parent 1', 'PARENT', '1972-02-02', 'M', 'S2');

-- --------------------------------------------------------

--
-- Table structure for table `candidat_inf_edu`
--

CREATE TABLE `candidat_inf_edu` (
  `inf_edu_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `inf_edu_name` varchar(200) NOT NULL,
  `inf_edu_cert` varchar(200) DEFAULT NULL,
  `inf_edu_year` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Informal Education Table';

-- --------------------------------------------------------

--
-- Table structure for table `candidat_lang`
--

CREATE TABLE `candidat_lang` (
  `clang_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `lang_name` varchar(50) NOT NULL,
  `cap_spoken` enum('Basic','Intermediate','Advanced') DEFAULT NULL,
  `cap_written` enum('Basic','Intermediate','Advanced') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidat_lang`
--

INSERT INTO `candidat_lang` (`clang_id`, `candidat_id`, `lang_name`, `cap_spoken`, `cap_written`) VALUES
(1, 6, 'English', 'Intermediate', 'Intermediate');

-- --------------------------------------------------------

--
-- Table structure for table `candidat_organizational`
--

CREATE TABLE `candidat_organizational` (
  `org_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `activities` varchar(100) NOT NULL,
  `type_of_org` varchar(150) DEFAULT NULL,
  `org_year_start` varchar(50) DEFAULT NULL,
  `org_year_end` varchar(50) DEFAULT NULL,
  `org_pos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidat_organizational`
--

INSERT INTO `candidat_organizational` (`org_id`, `candidat_id`, `activities`, `type_of_org`, `org_year_start`, `org_year_end`, `org_pos`) VALUES
(4, 33, 'Himpunan Mahasiswa Teknologi Informasi USU', NULL, NULL, NULL, 'anggota'),
(5, 33, 'Paguyuban Penerima Beasiswa KSE USU', NULL, NULL, NULL, 'Kepala divisi public relations'),
(6, 33, 'Himpunan Mahasiswa Teknologi Informasi USU', NULL, NULL, NULL, 'anggota'),
(7, 33, 'Paguyuban Penerima Beasiswa KSE USU', NULL, NULL, NULL, 'Kepala divisi public relations'),
(8, 33, 'Himpunan Mahasiswa Teknologi Informasi USU', NULL, NULL, NULL, 'anggota'),
(9, 33, 'Paguyuban Penerima Beasiswa KSE USU', NULL, NULL, NULL, 'Kepala divisi public relations'),
(10, 33, 'Himpunan Mahasiswa Teknologi Informasi USU', NULL, NULL, NULL, 'anggota'),
(11, 33, 'Paguyuban Penerima Beasiswa KSE USU', NULL, NULL, NULL, 'Kepala divisi public relations'),
(12, 33, 'Himpunan Mahasiswa Teknologi Informasi USU', NULL, NULL, NULL, 'anggota'),
(13, 33, 'Paguyuban Penerima Beasiswa KSE USU', NULL, NULL, NULL, 'Kepala divisi public relations'),
(14, 35, 'MPR', NULL, NULL, NULL, 'qwertyu'),
(15, 36, 'Himpunan Mahasiswa Teknologi Informasi USU', NULL, NULL, NULL, 'Anggota'),
(16, 36, 'Paguyuban Penerima Beasiswa KSE USU', NULL, NULL, NULL, 'Kepala Divisi Public Relations'),
(17, 37, 'Himpunan Mahasiswa Teknologi Informasi', NULL, NULL, NULL, 'Anggota'),
(19, 39, 'Himpunan Mahasiswa Teknologi Informasi', NULL, NULL, NULL, 'Anggota'),
(20, 39, 'Paguyuban KSE USU', NULL, NULL, NULL, 'Kepala Divisi'),
(23, 40, 'BEM', NULL, NULL, NULL, 'Korwil'),
(24, 44, 'Org 1', NULL, NULL, NULL, 'Pos 1'),
(25, 44, 'Org 2', NULL, NULL, NULL, 'Pos 2'),
(26, 44, 'Org 3', NULL, NULL, NULL, 'Pos 3');

-- --------------------------------------------------------

--
-- Table structure for table `candidat_references`
--

CREATE TABLE `candidat_references` (
  `cref_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `cref_name` varchar(100) NOT NULL,
  `cref_rel` varchar(100) DEFAULT NULL,
  `cref_addr` text,
  `cref_occu` varchar(100) DEFAULT NULL,
  `cref_years` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidat_work_exp`
--

CREATE TABLE `candidat_work_exp` (
  `work_exp_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `work_exp_from` date NOT NULL,
  `work_exp_to` date NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `work_exp_title` varchar(150) NOT NULL,
  `report_to` varchar(100) NOT NULL,
  `last_salary` bigint(20) NOT NULL,
  `job_desc` text NOT NULL,
  `reason_leaving` text NOT NULL,
  `may_contact` enum('Y','N') DEFAULT NULL,
  `reason_deny` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidat_work_exp`
--

INSERT INTO `candidat_work_exp` (`work_exp_id`, `candidat_id`, `work_exp_from`, `work_exp_to`, `company_name`, `work_exp_title`, `report_to`, `last_salary`, `job_desc`, `reason_leaving`, `may_contact`, `reason_deny`) VALUES
(6, 6, '2013-09-01', '2015-09-30', 'Metro TV', 'Programmer', 'Aris Suyudi', 5000000, 'Kerjain Kerjaan METRO', 'Mencari yang lebih baik', 'N', NULL),
(7, 6, '2015-10-13', '2016-09-30', 'ASI Asia Pacific', 'Senior Programmer', 'Darwin Tan', 9000000, 'Kerjain Kerjaan ASI', 'Mencari yang lebih baik', 'N', NULL),
(24, 35, '2017-09-10', '2018-08-24', 'PT A', 'Test 1', '', 5000000, 'hjfgfddrtg', '', NULL, NULL),
(25, 35, '2018-09-11', '2019-09-25', 'PT B', 'Test 2', '', 7500000, 'dgfhgd', '', NULL, NULL),
(31, 40, '2018-03-01', '2019-03-01', 'PT A', 'Programmer', '', 6000000, 'Back End', '', NULL, NULL),
(35, 26, '2019-01-01', '2019-08-01', 'PT Terajana', 'Front End Dev', '', 5000000, 'Developing User Interface of Web Application Using React Native', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tab_activity`
--

CREATE TABLE `tab_activity` (
  `activity_id` int(11) NOT NULL,
  `title` varchar(300) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `content` text,
  `url_image` varchar(300) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_activity`
--

INSERT INTO `tab_activity` (`activity_id`, `title`, `date`, `content`, `url_image`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`) VALUES
(1, 'September, Kereta LRT Cibubur-Cawang Diuji Coba', '2019-08-21 00:00:00', '<p><strong>Jakarta</strong>: PT Adhi Karya Tbk (ADHI) menyatakan uji coba kereta api ringan&nbsp;<em>light rapid transit&nbsp;</em>(LRT) ruas Cibubur-Cawang akan dimulai September.<br />\n&nbsp;<br />\nDirektur Sumber Daya Manusia Adhi Karya Agus Karianto mengatakan empat rangkaian kereta LRT yang diproduksi PT INKA (Persero) ditargetkan masuk bulan ini.<br />\n&nbsp;<br />\n&quot;Akhir bulan ini ditargetkan akan ada kereta datang dari PT INKA. Insyaalah akhir bulan akan datang dan akan&nbsp;<em>running test&nbsp;</em>(September),&quot; kata Agus dalam konferensi pers di Gedung BEI, Jakarta, Rabu, 21 Agustus 2019.&nbsp;<br />\nAgus mengakui perseroan memang memesan kereta LRT dari dalam negeri melalui INKA. Hingga akhir tahun akan ada empat rangkaian yang bakal masuk. Adapun uji coba jalan kereta LRT tersebut akan dilakukan hingga akhir 2020.<br />\n&nbsp;<br />\n&quot;Secara bertahap sampai akhir tahun akan ada empat rangkaian&nbsp;<em>train set&nbsp;</em>yang bisa didatangkan dari INKA dan diharapkan bisa dipakai untuk dipakai&nbsp;<em>running test&nbsp;</em>sampai dengan Cawang,&quot; jelas dia.<br />\n&nbsp;<br />\nDi tempat yang sama, Direktur Utama ADHI Harto menambahkan terkait keluhan INKA soal penumpukan gerbong kereta di pabriknya, ADHI menawarkan tempat untuk parkir kereta tersebut. Tempat tersebut berada pada rel kereta LRT ruas Cibubur-Ciracas sepanjang dua kilometer (km).<br />\n&nbsp;<br />\n&quot;Kami menawarkan keretanya INKA ini di stop di atas rel itu di antara Cibubur-Ciracas. Kereta hanya perlu dua kilometer. Jadi satu&nbsp;<em>track&nbsp;</em>untuk parkir kereta INKA dan satu lagi untuk&nbsp;<em>running test</em>,&quot; tukas dia.<br />\n&nbsp;<br />\n<br />\n(AHL)</p>\n', 'a6388343958d887fe2fe0c04f3d7e93e.jpg', 2, '2019-08-21 08:55:26', 2, '2019-08-28 04:32:13', 0),
(8, 'Menpora Imam Nahrawi Tersangka Suap Dana Hibah', '2019-09-19 00:00:00', '<p><strong>Jakarta</strong>: Komisi Pemberantasan Korupsi (KPK) menetapkan Menpora Imam Nahrawi tersangka kasus dugaan suap penyaluran bantuan dari pemerintah melalui Kemenpora pada KONI 2018. Penetapan tersangka Imam merupakan hasil pengembangan dari perkara sebelumnya.<br />\n&nbsp;<br />\n&ldquo;Dalam penyidikan ditetapkan dua orang tersangka yakni IMR dan MIU (asisten pribadi (aspri) Menpora, Miftahul Ulum),&rdquo; kata Wakil Ketua KPK Alexander Marwata dalam konferensi pers di Gedung KPK, Jakarta, Rabu, 18 September 2019.<br />\n&nbsp;<br />\nAlexander menuturkan Imam dan Miftahul diduga menerima Rp14,7 miliar. Imam juga disinyalir meminta uang Rp11,8 miliar selama 2016-2018. Total dugaan penerimaan Imam mencapai Rp26,5 miliar.</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy1</li>\n	<li>Inspire</li>\n	<li>Confuse1</li>\n	<li>Sad1</li>\n</ul>\n\n<p><br />\nUang diduga komitmen fee atas pengurusan proposal hibah yang diajukan pihak KONI kepada Kemenpora TA 2018. &ldquo;Uang tersebut diduga digunakan untuk kepentingan pribadi Menpora dan pihak Iain yang terkait,&rdquo; beber Alexander.<br />\n&nbsp;<br />\nImam dan Miftahul dijerat Pasal 12 huruf a atau huruf b atau Pasal 12 B atau Pasal 11 Undang-Undang Nomor 31 Tahun 1999 sebagaimana telah diubah dengan Undang-Undang Nomor 20 Tahun 2001 tentang Perubahan atas Undang Undang Nomor 31 Tahun 1999 tentang Pemberantasan Tindak Pidana Korupsi junto Pasal 55 ayat (1) ke-1 junto Pasal 64 ayat (1) KUHP.</p>\n', '8b537ae2dbf4b64e8ddeb9088def68de.jpg', 2, '2019-09-19 04:32:19', NULL, NULL, 0),
(9, 'Kapolri Sebut Kerja Sama Polisi ASEAN Menjaga Stabilias Keamanan', '2019-09-19 00:00:00', '<p><strong>Jakarta:</strong>&nbsp;Kapolri Jenderal Muhammad Tito Karnavian menyoroti pentingnya kerja sama kepolisian antar negara ASEAN untuk mewujudkan stabilitas keamanan di Asia Tenggara. Hal itu disampaikan Tito saat memimpin delegasi Polri dalam Konferensi ASEANAPOL Tahun 2019 di Hanoi, Vietnam, Rabu, 18 September 2019.<br />\n&nbsp;<br />\n&quot;Khususnya dalam penanggulangan kejahatan transnasional untuk mendukung terselenggaranya pembangunan ekonomi menuju kemajuan dan kesejahteraan bangsa,&quot; kata Tito melansir&nbsp;<em>Antara</em>, Kamis, 19 September 2019.<br />\n&nbsp;<br />\nDia menilai kerja sama tidak bisa lepas dari peran penting negara ASEAN dalam dinamika ekonomi dunia. Ketahanan dan pertumbuhan ekonomi negara di Asia Tenggara menjadi perhatian di tengah kemelut perdagangan dan ekonomi dunia.</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy</li>\n	<li>Inspire</li>\n	<li>Confuse</li>\n	<li>Sad</li>\n</ul>\n\n<p><br />\n&quot;Keunggulan dan keberhasilan ekonomi negara-negara ASEAN hanya akan dapat terwujud dengan terpeliharanya stabilitas keamanan yang optimal,&quot; ujarnya.<br />\n&nbsp;<br />\nTito mengatakan kerja sama antara kepolisian negara ASEAN memainkan peran penting. Dia melanjutkan Konferensi ASEANAPOL sangat strategis dalam upaya mengoptimalkan kerja sama kepolisian di kawasan Asia Tenggara.<br />\n&nbsp;<br />\n&quot;Kerja sama tersebut diwujudkan dalam berbagai bentuk kegiatan bidang operasional, seperti tukar menukar informasi dalam pencegahan kejahatan secara dini maupun penindakan, pencegahan dan penanganan kejahatan di kawasan perbatasan, serta berbagai bentuk komunikasi dan koordinasi dalam penegakan hukum,&quot; jelas dia.<br />\n&nbsp;<br />\nJenderal bintang empat itu menuturkan kerja sama diselenggarakan dalam penyelenggaraan pendidikan dan pelatihan kepolisian. Juga, berbagai bentuk diskusi dan kursus intensif dan berkelanjutan.<br />\n&nbsp;<br />\nDia menyampaikan dukungan secara terbuka terhadap upaya memperkuat aspek operasional ASEANAPOL melalui pembangunan pusat data yang kuat dan terintegrasi.<br />\n&nbsp;<br />\nNamun Tito menggarisbawahi upaya dapat terwujud bila ada keinginan kuat dari seluruh anggota ASEANAPOL dan pemerintah negara anggota.<br />\n&nbsp;<br />\nTito mengingatkan tantangan yang dihadapi dalam bidang operasional sangat besar, khususnya perbedaan sistem dan budaya hukum negara anggota. Kejahatan di sebuah negara belum tentu menjadi rumusan kejahatan berdasarkan undang-undang negara lain.<br />\n&nbsp;<br />\n&quot;Jenis data yang dikumpulkan dan dibagikan juga harus diatur secara ketat. Keberhasilan dan kegagalan yang dialami oleh EUROPOL dan INTERPOL dalam pengelolaan pusat data juga harus menjadi pelajaran untuk menentukan model terbaik bagi kepolisian negara-negara Asia Tenggara,&quot; tandasnya.<br />\n&nbsp;<br />\nKapolri Jenderal Tito Karnavian mengikuti Konferensi ASEANAPOL Tahun 2019 di Hanoi, Vietnam sampai Jumat, 20 September 2019. Tujuh dari sepuluh kepala kepolisian negara ASEANAPOL hadir sebagai pimpinan delegasi masing-masing negara.<br />\n&nbsp;<br />\nSedangkan, tiga negara yang dihadiri oleh wakil kepala kepolisian adalah Malaysia, Laos dan Thailand. Konferensi juga dihadiri oleh 10 delegasi mitra dialog yaitu Kepolisian Australia, China, Jepang, Korea, New Zealand, Rusia, Turki, Setjen INTERPOL dan EUROPOL.<br />\n&nbsp;<br />\nEnam delegasi turut hadir sebagai peninjau, yaitu Kepolisian Timor Leste, Fiji, National Crime Agency Inggris, FBI, International Association of Chief of Police, serta Palang Merah Internasional.</p>\n', 'aa21bd062c47312f348a2c09916d8224.jpg', 2, '2019-09-19 04:32:59', 2, '2019-09-19 08:36:03', 0),
(10, 'Operasi Hujan Buatan Berhasil di Dumai', '2019-09-19 00:00:00', '<p><strong>Jakarta:&nbsp;</strong>Teknologi Modifikasi Cuaca (TMC) yang dilakukan di Dumai, Riau, membuahkan hasil. Hujan turun kurang lebih setengah jam pada Rabu, 18 September 2019.<br />\n&nbsp;<br />\n&quot;Operasi TMC di Riau berhasil menurunkan hujan di Dumai, tepatnya di Kelurahan Batu Teritip yang berbatasan dengan Rokan Hilir (Rohil). Hujan turun kurang lebih selama 30 menit dengan intensitas sedang,&quot; kata Pelaksana Harian (Plh) Kepala Pusat Data, Informasi, dan Humas Badan Nasional Penanggulangan Bencana (BNPB) Agus Wibowo di Jakarta, Kamis, 19 September 2019.<br />\n&nbsp;<br />\nModifikasi cuaca juga dilakukan di wilayah lain di Provinsi Riau. Garam disebarkan menggunakan pesawat Hercules C-130 milik TNI.</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy</li>\n	<li>Inspire</li>\n	<li>Confuse</li>\n	<li>Sad</li>\n</ul>\n\n<p><br />\n&quot;Sedangkan di Riau pesawat Hercules C-130 melakukan penyemaian dengan menabur garam NaCl sebanyak 3.4 ton di daerah Dumai, Rohil, dan di Sumatera Utara di Padang Sidempuan, sesuai potensi pertumbuhan awan yang berpotensi menghasilkan hujan,&quot; ujar Agus.<br />\n&nbsp;<br />\nSedangkan di daerah Kalimantan Tengah penebaran garam dilakukan dengan pesawat CN 295. Penyebaran garam dilakukan sejak pukul 13.30 WIB hingga 15.45 WIB di Kabupaten Katingan, Palangka Raya, dan Kabupaten Kapuas.<br />\n&nbsp;<br />\n&quot;Pesawat itu terbang pada ketinggian 8.000 feet dan menghabiskan bahan semai garam NaCl sebanyak 1.500 kilogram,&quot; tutur Agus.<br />\n&nbsp;<br />\nPenebaran garam akan terus dilakukan untuk menurunkan hujan di sejumlah daerah terdampak kebakaran hutan dan lahan.<br />\n&nbsp;<br />\n&quot;Operasi TMC akan terus dilakukan di wilayah Sumatera dan Kalimantan. Disediakan tiga pesawat bantuan TNI yaitu dua di Pekanbaru dan satu di Palangkaraya,&quot; ucap Agus.</p>\n', '706cb00fda7f84ac8152682a7bf7349f.jpg', 2, '2019-09-19 04:33:31', NULL, NULL, 0),
(11, 'MK Minta Penggugat Tunggu UU KPK Diberi Nomor', '2019-09-19 00:00:00', '<p><strong>Jakarta:&nbsp;</strong>Juru bicara Mahkamah Konstitusi (MK) Fajar Laksono menyambut baik rencana sejumlah masyarakat mengajukan uji materi Undang-Undang Tentang Komisi Pemberantasan Korupsi (KPK) yang baru. Fajar meminta masyarakat tak buru-buru melayangkan gugatan.<br />\n&nbsp;<br />\nFajar mengatakan UU KPK anyar belum memiliki nomor. Ia meminta masyarakat menunggu UU KPK diberi nomor dan dicatat dalam lembaran negara.<br />\n&nbsp;<br />\n&quot;Semestinya demikian (menunggu penomoran dulu), agak bersabar sedikitlah, jadi semua jelas dan sesuai ketentuan,&quot; kata Fajar di Jakarta, Rabu, 18 September 2019.</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy</li>\n	<li>Inspire</li>\n	<li>Confuse</li>\n	<li>Sad</li>\n</ul>\n\n<p><br />\nFajar menyebut rencana pengajuan uji materi sudah tepat. Langkah itu sesuai dengan konstitusi yang berlaku di Indonesia.<br />\n&nbsp;<br />\n&quot;Ketika ada komponen masyarakat menggunakan saluran dan mekanisme yang telah disediakan oleh konstitusi, itu hal biasa saja, langkah itu layak diapresiasi,&quot; jelasnya di Jakarta, kemarin.<br />\n&nbsp;<br />\nMK akan menyikapi permohonan uji materi itu secara proporsional dan sesuai ketentuan hukum acara. Fajar menegaskan MK siap menerima permohonan uji materi dari masyarakat.<br />\n&nbsp;<br />\nFajar juga mempersilakan masyarakat ikut memantan proses uji materi di MK. Ia meminta masyarakat menerima apapun putusan MK karena bersifat final dan mengikat.<br />\n&nbsp;<br />\n&quot;Yang pasti, harus dipahami sejak awal, ketika sudah bertekad mengajukan permohonan uji materiil, maka sudah barang tentu pemohon dan publik pada umumnya berkewajiban untuk menerima, menghormati, dan melaksanakan apa pun yang kelak menjadi putusan MK,&quot; pungkasnya.</p>\n', '6441e2ee0c978fce64470b6f2e4930a1.jpg', 2, '2019-09-19 04:34:11', NULL, NULL, 0),
(12, 'Komisi III Persilakan UU KPK Digugat ke MK', '2019-09-19 00:00:00', '<p><strong>Jakarta:</strong>&nbsp;Anggota Komisi III DPR Arsul Sani mempersilakan masyarakat menggugat Undang-Undang tentang Komisi Pemberantasan Korupsi (KPK) ke Mahkamah Konstitusi (MK). Cara tersebut dapat ditempuh sebagai bagian dari demokrasi.<br />\n&nbsp;<br />\n&quot;PPP menghormati sepenuhnya elemen masyarakat sipil mana pun yang ingin menguji UU Perubahan atas UU KPK ke MK,&quot; kata Arsul saat dihubungi, Rabu, 18 September 2019.<br />\n&nbsp;<br />\nDPR siap menghadapi uji materi tersebut. Arsul mengatakan DPR bisa menjelaskan alasan pengesahan revisi UU KPK itu saat uji materi di Mahkamah Konstitusi (MK).</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy</li>\n	<li>Inspire</li>\n	<li>Confuse</li>\n	<li>Sad</li>\n</ul>\n\n<p><br />\n&quot;Nanti kan DPR juga diberi kesempatan untuk memberikan keterangan oleh MK. Ya nanti kita sampaikan semuanya sejelas-jelasnya,&quot; ucap politikus PPP itu.<br />\n&nbsp;<br />\nElemen Koalisi Masyarakat Sipil berencana mengajukan uji materi UU Nomor 30 Tahun 2002 Tentang KPK yang baru disahkan DPR. Upaya ditempuh guna menggugurkan regulasi Lembaga Antirasuah yang baru.<br />\n&nbsp;<br />\n&quot;Ada beberapa langkah yang pastinya kami akan lakukan.&nbsp;<em>Judicial review</em>&nbsp;(uji materi) ke Mahkamah Konstitusi (MK) secara hukum,&quot; kata perwakilan Lembaga Bantuan Hukum Indonesia (YLBHI) Asfinawati di Kompleks Parlemen Senayan, Jakarta, Selasa, 17 September 2019.<br />\n&nbsp;<br />\nDPR mengesahkan revisi UU KPK. Keputusan itu diambil dalam Rapat Paripurna di Gedung DPR/MPR, Senayan, Jakarta, Selasa, 17 September 2019.<br />\n&nbsp;<br />\nAda tujuh poin yang disepakati DPR dan pemerintah dalam revisi UU KPK ini. Pertama, kedudukan KPK sebagai lembaga penegak hukum berada pada rumpun eksekutif. Namun, kewenangan dan tugas KPK tetap independen.<br />\n&nbsp;<br />\nKedua, pembentukan Dewan Pengawas KPK sesuai peraturan perundang-undangan. Ketiga, pelaksanaan fungsi penyadapan. Keempat, mekanisme penerbitan surat perintah penghentian penyidikan (SP3) perkara korupsi yang ditangani KPK.<br />\n&nbsp;<br />\nPoin kelima koordinasi kelembagaan KPK dengan kepolisian, kejaksaan, dan kementerian atau lembaga lainnya dalam pelaksanaan penyelidikan, penyidikan, dan penuntutan perkara tindak pidana korupsi. Keenam, mekanisme penggeledahan dan penyitaan. Terakhir, terkait sistem kepegawaian KPK.</p>\n', '6a6482cfa1cd7ad536cca591ddc5d005.jpg', 2, '2019-09-19 04:34:50', NULL, NULL, 0),
(13, 'test', '2019-11-21 00:00:00', '<p>aaertawetawet</p>\n', '310cf7af9cb9e446b16cc7716c3c41c8.jpeg', 2, '2019-11-21 10:11:02', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tab_candidat`
--

CREATE TABLE `tab_candidat` (
  `candidat_id` int(11) NOT NULL,
  `candidat_email` varchar(150) NOT NULL,
  `candidat_name` varchar(150) NOT NULL,
  `candidat_phone` varchar(100) NOT NULL,
  `curr_address` text NOT NULL,
  `ca_zip_code` varchar(10) NOT NULL,
  `ca_ph` varchar(100) NOT NULL,
  `ca_city` varchar(100) NOT NULL,
  `per_address` text NOT NULL,
  `pa_zip_code` varchar(10) NOT NULL,
  `pa_ph` varchar(100) NOT NULL,
  `pa_city` varchar(100) NOT NULL,
  `pob` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `religion_id` enum('I','H','B','K','P','O') DEFAULT NULL,
  `blood_id` enum('A','B','AB','O') DEFAULT NULL,
  `nationality` enum('WNI','WNA') DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `id_number` varchar(50) NOT NULL,
  `marital_status` enum('Single','Married') NOT NULL,
  `marital_date` date DEFAULT NULL,
  `spouse_name` varchar(100) DEFAULT NULL,
  `spouse_dob` date DEFAULT NULL,
  `spouse_edu` varchar(100) DEFAULT NULL,
  `spouse_occupation` varchar(150) DEFAULT NULL,
  `candidat_foto` varchar(100) NOT NULL,
  `candidat_cv` varchar(100) NOT NULL,
  `expect_salary` bigint(20) DEFAULT NULL,
  `candidat_describe` text NOT NULL,
  `cp_name_family` varchar(100) NOT NULL,
  `cp_number_family` varchar(50) NOT NULL,
  `cp_rel_family` varchar(50) NOT NULL,
  `candidat_eng_cert` enum('TOEFL','TOEIC','IELTS') DEFAULT NULL,
  `candidat_eng_score` varchar(50) DEFAULT NULL,
  `candidat_eng_year` varchar(50) DEFAULT NULL,
  `candidat_hobby` text,
  `candidat_pwd` varchar(255) NOT NULL,
  `candidat_rg_key` varchar(50) NOT NULL,
  `candidat_verify` enum('Y','N') NOT NULL DEFAULT 'N',
  `candidat_status` enum('N/A','Passed') NOT NULL DEFAULT 'N/A',
  `candidat_instagram` varchar(100) DEFAULT NULL,
  `candidat_facebook` varchar(100) DEFAULT NULL,
  `candidat_linkedin` varchar(100) DEFAULT NULL,
  `candidat_whatsapp` varchar(100) DEFAULT NULL,
  `curr_district` varchar(100) DEFAULT NULL,
  `per_district` varchar(100) DEFAULT NULL,
  `candidat_latest_position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_candidat`
--

INSERT INTO `tab_candidat` (`candidat_id`, `candidat_email`, `candidat_name`, `candidat_phone`, `curr_address`, `ca_zip_code`, `ca_ph`, `ca_city`, `per_address`, `pa_zip_code`, `pa_ph`, `pa_city`, `pob`, `dob`, `religion_id`, `blood_id`, `nationality`, `gender`, `weight`, `height`, `id_number`, `marital_status`, `marital_date`, `spouse_name`, `spouse_dob`, `spouse_edu`, `spouse_occupation`, `candidat_foto`, `candidat_cv`, `expect_salary`, `candidat_describe`, `cp_name_family`, `cp_number_family`, `cp_rel_family`, `candidat_eng_cert`, `candidat_eng_score`, `candidat_eng_year`, `candidat_hobby`, `candidat_pwd`, `candidat_rg_key`, `candidat_verify`, `candidat_status`, `candidat_instagram`, `candidat_facebook`, `candidat_linkedin`, `candidat_whatsapp`, `curr_district`, `per_district`, `candidat_latest_position`) VALUES
(3, 'andi_fang@yahoo.com', 'Andi Putra', '0818100023', 'Jl. Ampera 2 No. 13 A\r\nRagunan - Pasar Minggu\r\nJakarta Selatan', '12550', '0217816632', 'DKI Jakarta', 'Jl. Ampera 2 No. 13 A\r\nRagunan - Pasar Minggu\r\nJakarta Selatan', '12550', '0217816632', 'Kota Administrasi Jakarta Selatan', 'Tembilahan', '1987-08-25', 'P', 'O', 'WNI', 'M', 91, 180, '3174042508870008', 'Married', '2016-11-12', 'Linda Soriyana', '1991-11-19', 'S1', 'Pegawai Swasta', 'media/candidates/fotos/1/foto_andar.jpg', 'media/candidates/cvs/1/CV_MAHA_ANDAR.doc', 1000000, 'Nothing is everything', 'Linda Soriyana', '0818100023', 'Istri', NULL, NULL, NULL, NULL, '2ea7c0cd9fbbbd28d3815999dbd4440a', '', 'Y', 'N/A', '', '', '', '', NULL, NULL, NULL),
(4, 'suminah@yahoo.com', 'Suminah', '0818100023', 'Jl. Ampera 2 No. 13 A\r\nRagunan - Pasar Minggu\r\nJakarta Selatan', '12550', '0217816632', 'DKI Jakarta', 'Jl. Ampera 2 No. 13 A\r\nRagunan - Pasar Minggu\r\nJakarta Selatan', '12550', '0217816632', 'Kota Administrasi Jakarta Selatan', 'Tembilahan', '1987-08-25', 'P', 'O', 'WNI', 'M', 91, 180, '3174042508870008', 'Married', '2016-11-12', 'Linda Soriyana', '1991-11-19', 'S1', 'Pegawai Swasta', 'media/candidates/fotos/1/foto_andar.jpg', 'media/candidates/cvs/1/CV_MAHA_ANDAR.doc', 1000000, 'Nothing is everything', 'Linda Soriyana', '0818100023', 'Istri', NULL, NULL, NULL, NULL, '2ea7c0cd9fbbbd28d3815999dbd4440a', '', 'Y', 'N/A', '', '', '', '', NULL, NULL, NULL),
(5, 'lukman@yahoo.com', 'Lukman', '0818100023', 'Jl. Ampera 2 No. 13 A\r\nRagunan - Pasar Minggu\r\nJakarta Selatan', '12550', '0217816632', 'DKI Jakarta', 'Jl. Ampera 2 No. 13 A\r\nRagunan - Pasar Minggu\r\nJakarta Selatan', '12550', '0217816632', 'Kota Administrasi Jakarta Selatan', 'Tembilahan', '1987-08-25', 'P', 'O', 'WNI', 'M', 91, 180, '3174042508870008', 'Married', '2016-11-12', 'Linda Soriyana', '1991-11-19', 'S1', 'Pegawai Swasta', 'media/candidates/fotos/1/foto_andar.jpg', 'media/candidates/cvs/1/CV_MAHA_ANDAR.doc', 1000000, 'Nothing is everything', 'Linda Soriyana', '0818100023', 'Istri', NULL, NULL, NULL, NULL, '2ea7c0cd9fbbbd28d3815999dbd4440a', '', 'Y', 'Passed', '', '', '', '', NULL, NULL, NULL),
(6, 'tikus1@yahoo.com', 'Maha Andar Pasaribu (SAMPLE)', '085718403000', 'Jl. Ampera II No. 13A', '12550', '021 7816632', 'DKI Jakarta', 'Jl. Palmerah Barat IIA\nGang Bahagia No. 39A', '11480', '-', 'DKI Jakarta', 'Tembilahan', '1987-08-25', 'P', 'O', 'WNI', 'M', 95, 180, '1234567890987654321', 'Married', '2016-11-11', 'Linda Soriyana', '1991-11-19', 'S1', 'Ibu Rumah Tangga', 'f7b1f35d13e3e88fbfc2fd95fa239f82.jpg', 'c802c605d44811fe32ab7cbbd581c69c.doc', 0, '', '', '', '', NULL, NULL, NULL, NULL, '', '', 'N', 'N/A', '', '', '', '', NULL, NULL, NULL),
(10, 'andi.fang.iu@gmail.com', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Single', NULL, NULL, NULL, NULL, NULL, '6afb841f7c92e38999c554e488dc6e48.jpg', '709de4ce6c397ff70c8ffaeaaa837f49.pdf', 1234567, 'Strength: abc\r\nWeakness: 123\r\nWhy: im awesome!', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$PveAU6X2H3TWhaiREauMouu/H7ante2EXEfV4Kx8WTRqcCbM0bkAm', '133224ddb94be502fe294d5bee73d5a6', 'Y', 'N/A', '', '', '', '', NULL, NULL, NULL),
(11, 'dita.permana2010@gmail.com', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'WNI', 'M', NULL, NULL, '', 'Single', NULL, NULL, NULL, NULL, NULL, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$NPMZxLX5Mej1LVoBOde/8OPDtZZjdnzYySbScmAZDwyYvpEoPcKKm', '0b94e77a2a73ab506bd121fed69a4d39', 'Y', 'N/A', '', '', '', '', NULL, NULL, NULL),
(12, 'maha_pasaribu@yahoo.com', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'WNI', 'M', NULL, NULL, '', 'Single', NULL, NULL, NULL, NULL, NULL, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$rEJlmapGYgAhRgBoTo9hCuT/bPR06SqdSCSJii08ZOfc1qDq8up/i', 'd3814532bf61356665ed807c59dd4ae2', 'N', 'N/A', '', '', '', '', NULL, NULL, NULL),
(13, 'pyschoprogrammer@gmail.com', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'WNI', 'M', NULL, NULL, '', 'Single', NULL, NULL, NULL, NULL, NULL, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$j7UJpBI8uKDVFeMxIFIlqen5WuR4LHftnyRl2i.IuPSlvC7zh.U4m', '83967c04b9b04cd824a51150c1505c80', 'Y', 'N/A', '', '', '', '', NULL, NULL, NULL),
(26, 'varunadewi@gmail.com', 'Varuna Dewi', '87654345678', 'Jalan A', '743829', '57348920345', 'DKI Jakarta', 'Jalan A', '743829', '57348920345', 'DKI Jakarta', 'Jakarta', '1996-06-05', 'H', NULL, NULL, 'F', NULL, NULL, '21345678976543', 'Single', NULL, NULL, NULL, NULL, NULL, 'abfed1ea92b55fde520b2aa408aaa2e8.jpg', '5d753c7e0f9e65a06febc88834324143.docx', 150000000, 'Because i\'m worth it', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$jBG3YcdXGwO0U4yK/wx9.eQQ2lOg77yWhYSJdICMtdHXif8bf2K0y', 'b0fe4e0af526c91c187505b555c4728c', 'Y', 'N/A', '', '', '', '', 'Palmerah', 'Kedoya', NULL),
(29, 'andi.putra@metrotvnews.com', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Single', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$cpmUp0G7tews.p.TQn9houWSesaajN5WKHkSJff/MG6yNDfhsdIOO', '3e9a1e56afcc09d6313e2827f98f6a4d', 'Y', 'N/A', '', '', '', '', NULL, NULL, NULL),
(30, 'internizti21@gmail.com', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Single', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$H4dfquG9icPFcS5r548HJ.0mMJsqn/Z0j1tBEJp9NA0GzrIIfGWeG', 'e712e3fef24d161464ba1bd2ccffd652', 'N', 'N/A', '', '', '', '', NULL, NULL, NULL),
(35, 'annomali74@gmail.com', 'Annomali', '091234834752', 'Jalan A', '12323', '9281347', 'DKI Jakarta', 'Jalan A', '12323', '9281347', 'DKI Jakarta', 'Jakarta', '1991-09-23', 'P', NULL, NULL, 'M', NULL, NULL, '1234567890', 'Single', NULL, NULL, NULL, NULL, NULL, '46e0442ae0eaaaa3075a488d265b198c.jpeg', '75ed16cc3eed1219d94369a91cd495d1.docx', 1234567897654, 'asdfghbnvccbvnfg', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$qKpvHbfshi1nzm/GMyl5/eps6ptjCo6bYinpuqvzzAKe0G8HjqCUm', 'd9697daf80d6da658ecfaacf4bfe4cfd', 'Y', 'N/A', NULL, NULL, NULL, NULL, 'Kedoya', 'Kedoya', NULL),
(40, 'seftianalfredo.9@gmail.com', 'Seftian Alfredo', '087885803753', 'Cibubur', '13720', '02112345678', 'DKI Jakarta', 'Cibubur', '13720', '02112345678', 'DKI Jakarta', 'Jakarta', '1997-09-02', 'P', NULL, NULL, 'M', NULL, NULL, '3175090209970006', 'Single', NULL, NULL, NULL, NULL, NULL, '387b26d5ad5e0d46873195c0ab7fb431.png', '68f5b994e96086fdecd7fadb8a564f08.pdf', 10000000, 'Hard Worker\r\nReliable\r\nFast Learner', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$1mq9BsV5HwQq92yciQyfyOm/WnN2QvwNbaQs92LdRorKMSTv7qgX.', '1bac3410240fc0d25b5f712a9e109c31', 'Y', 'N/A', NULL, NULL, NULL, NULL, 'Ciracas', 'Ciracas', NULL),
(41, 'poke789012@gmail.com', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Single', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$0UfopzrvB5eqO/OGtevqGu.Qf5Z3k9MTIFSaWMOSwdPfGCtcQdXR2', '8398b320b5815dc30df4548152002d89', 'Y', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'poke7890123@gmail.com', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Single', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$oalFhaSFXSvscS8ofvSxg.L.6Bjpqg56uNGVSi6YjZ.1R3ozW3Ri.', 'a9ab56d5be2868d03c14acdc6cbd10a5', 'N', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'unlockeverything69@gmail.com', 'Testing Full Name', '0811111111111', 'Jalan A', '12345', '0219876543', 'City A', 'Jalan A', '12345', '0219876543', 'City A', 'Jakarta', '1996-12-31', 'I', NULL, NULL, 'M', NULL, NULL, '1234567890', 'Single', NULL, NULL, NULL, NULL, NULL, '0bbc116476ddf7e7d66ef1aa5693d591.png', '4fd70ffd5c7742323bf8c2cfddc34399.pdf', 10000000, 'sdg\r\ndfgds\r\nfgda\r\nfhg\r\ndsf\r\nhdf\r\nhd\r\nfshsdh', '', '', '', NULL, NULL, NULL, NULL, '$2y$10$NfWzJA7y7kwDB23G/ZI8OOY8MH3vZevf/uSG67o3hVQR./v1yp7kO', '91a4bc59e968d7c4c05b6826eaef5d7d', 'Y', 'N/A', NULL, NULL, NULL, NULL, 'Sub A', 'Sub A', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tab_faq_general`
--

CREATE TABLE `tab_faq_general` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(300) DEFAULT NULL,
  `answer` text,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_faq_general`
--

INSERT INTO `tab_faq_general` (`faq_id`, `question`, `answer`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`) VALUES
(1, 'Kapan buka pendaftaran ?', 'Lihat web career.metrotvnews.com yang baru', 2, '2019-08-22 04:01:54', 2, '2019-08-22 04:02:00', 0),
(2, 'Bagaimana cara daftar', 'Lihat web career.metrotvnews.com', 2, '2019-08-22 04:23:33', NULL, NULL, 0),
(3, 'Kenapa harus daftar Metro TV ?', 'Biar Keren', 2, '2019-09-19 10:45:06', NULL, NULL, 0),
(4, 'Bisa jadi terkenal tidak ?', 'Tergantung amal dan ibadah', 2, '2019-09-19 10:45:24', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tab_kota`
--

CREATE TABLE `tab_kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_kota`
--

INSERT INTO `tab_kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Banda Aceh'),
(2, 'Langsa'),
(3, 'Lhokseumawe'),
(4, 'Meulaboh'),
(5, 'Sabang'),
(6, 'Subulussalam'),
(7, 'Denpasar'),
(8, 'Pangkalpinang'),
(9, 'Cilegon'),
(10, 'Serang'),
(11, 'Tangerang Selatan'),
(12, 'Tangerang'),
(13, 'Bengkulu'),
(14, 'Gorontalo'),
(15, 'DKI Jakarta'),
(20, 'Sungai Penuh'),
(21, 'Jambi'),
(22, 'Bandung'),
(23, 'Bekasi'),
(24, 'Bogor'),
(25, 'Cimahi'),
(26, 'Cirebon'),
(27, 'Depok'),
(28, 'Sukabumi'),
(29, 'Tasikmalaya'),
(30, 'Banjar'),
(31, 'Magelang'),
(32, 'Pekalongan'),
(33, 'Purwokerto'),
(34, 'Salatiga'),
(35, 'Semarang'),
(36, 'Surakarta'),
(37, 'Tegal'),
(38, 'Batu'),
(39, 'Blitar'),
(40, 'Kediri'),
(41, 'Madiun'),
(42, 'Malang'),
(43, 'Mojokerto'),
(44, 'Pasuruan'),
(45, 'Probolinggo'),
(46, 'Surabaya'),
(47, 'Pontianak'),
(48, 'Singkawang'),
(49, 'Banjarbaru'),
(50, 'Banjarmasin'),
(51, 'Palangkaraya'),
(52, 'Balikpapan'),
(53, 'Bontang'),
(54, 'Samarinda'),
(55, 'Tarakan'),
(56, 'Batam'),
(57, 'Tanjungpinang'),
(58, 'Bandar Lampung'),
(59, 'Kotabumi'),
(60, 'Liwa'),
(61, 'Metro'),
(62, 'Ternate'),
(63, 'Tidore Kepulauan'),
(64, 'Ambon'),
(65, 'Tual'),
(66, 'Bima'),
(67, 'Mataram'),
(68, 'Kupang'),
(69, 'Sorong'),
(70, 'Jayapura'),
(71, 'Dumai'),
(72, 'Pekanbaru'),
(73, 'Makassar'),
(74, 'Palopo'),
(75, 'Parepare'),
(76, 'Palu'),
(77, 'Bau-Bau'),
(78, 'Kendari'),
(79, 'Bitung'),
(80, 'Kotamobagu'),
(81, 'Manado'),
(82, 'Tomohon'),
(83, 'Bukittinggi'),
(84, 'Padang'),
(85, 'Padangpanjang'),
(86, 'Pariaman'),
(87, 'Payakumbuh'),
(88, 'Sawahlunto'),
(89, 'Solok'),
(90, 'Lubuklinggau'),
(91, 'Pagaralam'),
(92, 'Palembang'),
(93, 'Prabumulih'),
(94, 'Binjai'),
(95, 'Medan'),
(96, 'Padang Sidempuan'),
(97, 'Pematangsiantar'),
(98, 'Sibolga'),
(99, 'Tanjungbalai'),
(100, 'Tebingtinggi'),
(101, 'Yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `tab_slideshow`
--

CREATE TABLE `tab_slideshow` (
  `slideshow_id` int(11) NOT NULL,
  `slideshow_img` varchar(300) NOT NULL,
  `slideshow_text` varchar(300) NOT NULL,
  `is_active` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_slideshow`
--

INSERT INTO `tab_slideshow` (`slideshow_id`, `slideshow_img`, `slideshow_text`, `is_active`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`) VALUES
(22, 'ebb817108dbff48d74ea42fa3c1b0282.jpg', 'Metro TV News Room', 1, NULL, NULL, NULL, NULL, 0),
(23, '6368a4d1bb06eacfbe675bedf5a86ec5.jpg', 'Metro TV News Room1', 1, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tab_template`
--

CREATE TABLE `tab_template` (
  `template_id` int(11) NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `template_content` longtext NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_template`
--

INSERT INTO `tab_template` (`template_id`, `template_name`, `template_content`, `created_by`) VALUES
(1, 'Default Invitation', 'Dear CANDIDATNAME, \r\n\r\nThank you for your interest in joining PTNAME . We appreciate the time you\'ve taken to apply for the position of JOBPOSITION. \r\n\r\nAfter reviewing your profile, we would like to extend CURRTEST on the above opportunity. \r\n\r\nWe look forward to hearing from you. \r\n\r\nYours sincerely,\r\nPTNAME', 0),
(4, 'Default Interview Invitation', 'Dear CANDIDATNAME, \r\n\r\nWe would like to invite you to join the Interview Session as the schedule below\r\n\r\nDATATEST\r\n\r\nDOCUMENT\r\n1. Copy of certificates (Ijazah and other relevant certificates)\r\n2. Copy of transcript\r\n3. The latest resume\r\n4. Copy of ID Card (KTP)\r\n5. Photo 4 x 6 (1)\r\n6. Copy of family card \r\n7. Latest Salary Slip (if any)\r\n8. Copy of NPWP (if any)\r\n\r\n\r\nIf you have any further inquiries, kindly contact me by phone 0811 867 0031\r\nWe look forward to see you\r\n\r\nThank you\r\nDita Permana', 0),
(5, 'Default Psikotest Invitation', 'Dear CANDIDATNAME, \r\n\r\nWe would like to invite you to join the Assessment Process as the schedule below\r\n\r\nDATATEST\r\n\r\nDOCUMENT\r\n1. Copy of certificates (Ijazah and other relevant certificates)\r\n2. Copy of transcript\r\n3. The latest resume\r\n4. Copy of ID Card (KTP)\r\n5. Photo 4 x 6 (1)\r\n6. Copy of family card \r\n7. Latest Salary Slip (if any)\r\n8. Copy of NPWP (if any)\r\n\r\nIf you have any further inquiries, kindly contact me by phone 0811 867 0031\r\nWe look forward to see you. Thank you\r\n\r\nYours sincerely,\r\nDita Permana', 0),
(6, 'Default Greeting Apply', 'Dear Candidate, \r\n\r\nThank you for your interest in joining METRO TV . We appreciate the time you have taken to register your email. Please Click This Link: REGISTERLINK to activate your username and complete all the data required. \r\n\r\nWe will review your profile. If we consider you meet our requirements, soon we will send you invitation so that we can make further discussion.\r\n\r\nYours sincerely,\r\nDita Permana Putri\r\nRecruitment & Assessment\r\nMobile: 0811 867 0031\r\nEmail: dita.permana@metrotvnews.com ', 0),
(7, 'Default Walk In Interview Invitation', 'Dear CANDIDATNAME, \r\n\r\nWe would like to invite you to join the Walk In Interview Session as the schedule below\r\n\r\nDATATEST\r\n\r\nDOCUMENT\r\n1. Copy of certificates (Ijazah and other relevant certificates)\r\n2. Copy of transcript\r\n3. The latest resume\r\n4. Photo 4 x 6 (1)\r\n\r\n\r\nIf you have any further inquiries, kindly contact me by phone.\r\nWe look forward to see you\r\n\r\nThank you', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tab_testimoni`
--

CREATE TABLE `tab_testimoni` (
  `testimoni_id` int(11) NOT NULL,
  `content` text,
  `name` varchar(300) DEFAULT NULL,
  `batch` varchar(255) NOT NULL,
  `is_active` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `url_image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_testimoni`
--

INSERT INTO `tab_testimoni` (`testimoni_id`, `content`, `name`, `batch`, `is_active`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `url_image`) VALUES
(2, '<p>Diprogram ni saya diasah untuk menjadi pribadi yang mandiri yang bertujuan untuk siap diterjunkan dalam berbagai situasi dan kondisi seorang reporter.</p>\n', 'Harun Ramadhan', 'JDP Batch 16', 1, 2, '2019-08-22 11:45:22', NULL, NULL, 0, 'cb0aa46ff494f0971b264ee2f6f60e11.png'),
(3, '<p>Bekerja di Metro TV itu rasanya seperti belajar di perguruan tinggi (lagi)! Aku mendapatkann pengalaman dan pembelajaran yg bermanfaat, baik saat di kantor maupun di &lsquo;lapangan&rsquo;.</p>\n', 'Vallentina Chelsy Maharani', 'JDP Batch 19', 1, 2, '2019-08-22 11:46:57', 2, '2019-08-22 11:47:45', 0, '8ab30e56848d6dc2d6098ecd4740239c.png'),
(4, '<p>Saya sangat bersyukur bisa menjadi salah satu bagian dari JDP 19 Metro TV. Di sini, saya belajar banyak hal baru baik soal jurnalistik, maupun soal kedisiplinan.&nbsp;</p>\n', 'Marselina Tabita ', 'JDP Batch 17', 1, 2, '2019-08-22 11:48:33', NULL, NULL, 0, 'cb9357cd1e692735566da10ffc810220.png'),
(7, '<p>test ajaa dadldksja sdkja lsdkj asd laksdj laksd asda sdlka sdkljasldkjalsdkjalsdjasdalsdk alsdkj alsdkja sda</p>\n', 'TEST AP', '21', 1, 2, '2019-09-18 09:59:18', 2, '2019-09-18 10:03:19', 0, 'c1190f5bb173840c91cefa348c8512ba.png'),
(8, '<p>Nama saya&nbsp;Ferdinand&nbsp;Karsten. Saya bergabung di Metro TV sejak 1 Maret 2016, sebagai bagian Journalist Development Program dan menjalani pelatihan selama 4 bulan. Kemudian saya masuk ke divisi non-bulletin bernama Target Operasi/ TO, program yang mengangkat soal investigasi kasus-kasus kriminal, penyelundupan, dll. Di program TO, saya belajar banyak hal, mulai dari menentukan topik yang menarik, mencari celah untuk menembus narasumber yang sulit, hingga proses editing sampai liputan ditayangkan di Metro TV. Setelah 6 bulan di program TO, saya masuk ke divisi news gathering sebagai reporter reguler. Meliput semua hal menuntut pengetahuan yang lebih luas tentang peristiwa yang sedang terjadi, mengenal lebih banyak narasumber mulai dari para pengamat, aktivis, anggota DPR/MPR, tokoh politik, dan lainnya. Saya juga diberi kesempatan meliput bencana-bencana yang terjadi di Indonesia, seperti tenggelamnya kapal motor sinar bangun di Sumatera Utara, gempa Lombok, gempa dan tsunami di Palu, Sigi, dan Donggala, jatuhnya pesawat Lion Air JT610, tsunami di Banten, kerusuhan 22 Mei 2019.</p>\n\n<p>Setelah sekitar 3 tahun berkarir, saya ditempatkan untuk meliput kegiatan Presiden hingga saat ini. Tantangannya lebih sulit karena harus lebih peka terhadap banyak isu, baik nasional maupun internasional dan tentunya lebih melelahkan. Bekerja sebagai jurnalis di Metro TV memberikan saya banyak pengalaman yang tidak bisa terbayar dengan uang, membawa saya ke tempat-tempat baru, dan memberi saya kesempatan bertukar pikiran dengan semua orang dari segala posisi dan latar belakang, dari kalangan rakyat kecil hingga petinggi Negara.</p>\n', 'Edgar Parlindungan Saroha', 'JDP Batch X', 1, 2, '2019-09-23 05:56:34', 2, '2019-09-30 09:42:04', 0, '5da27d0faad8b7e8e09968be1e56dc02.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tab_tipsntrick`
--

CREATE TABLE `tab_tipsntrick` (
  `tipsntrick_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `url_image` varchar(300) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_tipsntrick`
--

INSERT INTO `tab_tipsntrick` (`tipsntrick_id`, `title`, `date`, `content`, `url_image`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`) VALUES
(3, 'Pengamat: Kaltim Penuhi Aspek Jadi Ibu Kota Baru Indonesia', '2019-08-22 00:00:00', '<p><strong>Jakarta</strong>: Pengamat tata kota Yayat Supriatna menilai pemilihan Provinsi Kalimantan Timur sebagai lokasi ibu kota baru sangat tepat. Hal itu menanggapi pernyataan Menteri Agraria dan Tata Ruang Sofyan Djalil yang akhirnya menyebutkan bahwa lokasi calon ibu kota baru berada di Kalimantan.<br />\n&nbsp;<br />\nYayat mengatakan dari berbagai hasil kajian Kalimantan timur memang lebih unggul dibandingkan wilayah Pulau Kalimantan lain, seperti aspek kebencanaan, aspek infrastruktur pelabuhan dan bandara, aspek kebakaran hutan, aspek demografi penduduk, dan aspek kemampuan finansial.<br />\n&nbsp;<br />\n&quot;Dia (Kalimantan Timur) memang rata-rata lebih baik dari yang lain,&quot; kata Yayat kepada&nbsp;<em>Medcom.id</em>, Kamis, 22 Agustus 2019.&nbsp;</p>\n\n<p><br />\nKemudian, dari sisi keterhubungan antarwilayah, Yayat menjelaskan Kalimantan Timur juga lebih baik dari wilayah Kalimantan yang lain.<br />\n&nbsp;<br />\n&quot;Jadi semua sudah dilakukan pemilihan. Bukan pada sisi teknisnya saja, tetapi juga pada pertimbangan-pertimbangan non teknisnya ekonomi, sosial, dan sebagainya,&quot; ujar dia.<br />\n&nbsp;<br />\nPasca ditentukannya wilayah ini, Yayat meminta kepada masyarakat untuk tidak termakan isu mengenai tanah yang akan dibangun. Sebab rencana pemerintah untuk memindahkan Ibu Kota ini sudah matang. Dia juga menegaskan pembangunan ibu kota baru ini nantinya memakai tanah milik negara.<br />\n&nbsp;<br />\n&quot;Tapi sekali lagi, ini menegaskan tidak ada transaksi jual beli tanah. Pemerintah sudah mengunci lokasinya. Pemerintah sudah menetapkan lokasinya. Itu di atas tanah negara,&quot; tukas dia.<br />\n<br />\n&nbsp;<br />\n<br />\n(SAW)</p>\n', '5a3bdc4d406b2362a7b098037da93b9e.jpg', 2, '2019-08-22 11:43:01', 2, '2019-08-22 11:43:09', 0),
(4, 'Mobil Dinas Presiden Sudah Tua dan Sering Mogok', '2019-08-22 00:00:00', '<p><strong>Jakarta:&nbsp;</strong>Kepala Sekretariat Presiden Heru Budi Hartono menyebut faktor usia menjadi alasan pemerintah mengganti mobil dinas Presiden, Wakil Presiden, dan menteri. Kendaraan dinas Presiden Joko Widodo juga sering mogok saat kunjungan ke daerah.<br />\n&nbsp;<br />\n&quot;Jadi ada umur sepuluh tahun, kalau sudah sepuluh tahun mungkin juga kalau diperbaiki sulit,&quot; kata Heru di Kementerian Dalam Negeri, Jalan Medan Merdeka Utara, Jakarta Pusat, Kamis, 22 Agustus 2019.<br />\n&nbsp;<br />\n<br />\nHeru menyebut mobil Kepala Negara pernah mogok saat kunjungan kerja di Bali. Rombongan kepresidenan dan Pasukan Pengamanan Presiden (Paspampres) harus mencari suku cadang mobil yang rusak.<br />\n&nbsp;<br />\n&quot;Saya bersama Paspampres berada di lokasi berusaha mencari pengganti,&quot; kata Heru.<br />\n&nbsp;<br />\nPresiden Jokowi juga memiliki agenda harian yang padat. Kepala Negara harus bertolak pulang pergi dari Istana Kepresidenan Bogor menuju Istana Kepresidenan Jakarta setiap hari.<br />\n&nbsp;<br />\nIa pun menilai pengadaan mobil dinas anyar wajar dilakukan. Apalagi, beberapa fitur kendaraan yang digunakan Kepala Negara sempat rusak dan membuat tak nyaman.<br />\n&nbsp;<br />\n&quot;Misalnya berkali-kali&nbsp;<em>power window</em>-nya enggak jalan, pernah semua&nbsp;<em>sound system</em>&nbsp;mobil bunyi (sendiri), itu enggak nyaman,&quot; ungkapya.<br />\n&nbsp;<br />\n<strong>Baca:&nbsp;<a href=\"https://www.medcom.id/nasional/politik/zNP4jjAN-pengadaan-mobil-dinas-baru-menteri-jokowi-dikritik\">Pengadaan Mobil Dinas Baru Menteri Jokowi Dikritik</a></strong><br />\n&nbsp;<br />\nHeru menilai kejadian serupa juga menimpa mobil para menteri. Beberapa menteri bahkan menggunakan mobil pribadi mereka untuk kegiatan sehari-hari.<br />\n&nbsp;<br />\n&quot;Beberapa menteri enggak pakai karena sering mogok, mesinnya panas dan lain-lain,&quot; pungkas dia.<br />\n<br />\n&nbsp;<br />\n<br />\n(DRI)</p>\n', 'a050c0fc4700b9bad839a1743c0c4f14.jpg', 2, '2019-08-22 11:52:03', NULL, NULL, 0),
(5, 'Mahathir Mohamad Jawab Kontroversi Gojek Masuk Malaysia', '2019-08-23 00:00:00', '<p>&quot;Kami mau memastikan apa pun yang kami lakukan itu berguna untuk masyarakat. Sama seperti Gojek,&quot; tambahnya.<br />\n<br />\nSebelumnya diberitakan, pemerintah Malaysia sudah memberikan lampu hijau bagi Gojek untuk beroperasi di negara tersebut. Namun pemerintah Malaysia akan meninjau kembali aturan-aturan yang ada sebelum Gojek bisa beroperasi di Malaysia.<br />\n<br />\nKabar ini mendapat reaksi bermacam-macam dari berbagai pihak. Salah satunya adalah pendiri Big Blue Taxi Services Shamsubahrin Ismail, yang mengancam akan mengadakan demonstrasi jika pemerintah Malaysia memberikan izin bagi Gojek.<br />\n<br />\nMenurutnya, menjadi pengemudi Gojek bukan karir yang bagus untuk anak muda yang layak mendapat kesempatan lebih baik. Lalu ada juga sejumlah netizen yang mengkritisi kabar ini, karena kehadiran Gojek dianggap akan meningkatkan risiko kecelakaan di jalan raya.</p>\n', '1513ab998bfe216f02910e7bdc438bdb.jpeg', 2, '2019-08-23 10:19:51', 2, '2019-08-23 10:34:22', 0),
(19, 'Roy Suryo Prihatin Imam Nahrawi Tersangka', '2019-09-19 00:00:00', '<p><strong>Jakarta</strong>: Mantan Menteri Pemuda dan Olahraga (Menpora) era Presiden Susilo Bambang Yudhoyono (SBY) prihatin dengan penetapan tersangka Menpora Imam Nahrawi oleh Komisi Pemberantasan Korupsi (KPK). Imam tersangka atas kasus penyaluran dana hibah Komite Olahraga Nasional Indonesia (KONI) melalui Kemenpora tahun anggaran 2018.<br />\n&nbsp;<br />\n&quot;Saya prihatin,&quot; kata Roy singkat kepada wartawan di Jakarta, Rabu, 18 September 2019.<br />\n&nbsp;<br />\nRoy mengaku sempat teringat perseteruannya dengan Kemenpora dan Imam beberapa waktu lalu. Perseteruan itu terkait temuan 3.226 aset negara oleh Badan Pemeriksa Keuangan (BPK). Belakangan perseteruan ini mereda setelah PN Jakarta Selatan mengabulkan pencabutan gugatan Menpora.</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy</li>\n	<li>Inspire</li>\n	<li>Confuse</li>\n	<li>Sad</li>\n</ul>\n\n<p><br />\n&quot;Gusti Allah SWT tidak&nbsp;<em>sare</em>&nbsp;(tidur). Kemarin saya juga sempat malah mau difitnah, digunakan untuk &#39;menutupi&#39; kasus besar. Alhamdulillah publik akhirnya tahu yang sebenarnya sekarang,&quot; tuntasnya.<br />\n&nbsp;<br />\n<a href=\"https://www.medcom.id/nasional/hukum/nbwQw63K-menpora-imam-nahrawi-tersangka-suap-dana-hibah\">Imam ditetapkan sebagai tersangka</a>&nbsp;bersama asisten pribadinya (aspri) Miftahul Ulum. Politikus Partai Kebangkitan Bangsa (PKB) itu diduga menerima suap dan gratifikasi sebanyak Rp26,5 miliar melalui Ulum.<br />\n&nbsp;<br />\nPemberian uang itu sebagai komitmen&nbsp;<em>fee</em>&nbsp;atas pengurusan proposal dana hibah yang diajukan KONI kepada Kemenpora tahun anggaran 2018. Imam menerima suap dan gratifikasi itu sebagai ketua Dewan Pengarah Satuan Pelaksana Program Indonesia Emas (Satlak Prima) dan menpora.<br />\n&nbsp;<br />\nPenetapan tersangka Imam hasil pengembangan perkara yang menjerat lima tersangka. Mereka adalah Sekretaris Jenderal KONI Ending Fuad Hamidy, Bendahara Umum KONI Jhonny E Awuy, Deputi IV Kemenpora Mulyana, Pejabat Pembuat Komitmen (PPK) pada Kemenpora Adhi Pumamo, dan Staf Kemenpora Eko Tryanto. Mereka telah divonis bersalah pengadilan tingkat pertama.<br />\n&nbsp;<br />\nImam dan Miftahul dijerat dengan Pasal 12 huruf a atau huruf b atau Pasal 12 B atau Pasal 11 Undang-Undang (UU) Nomor 31 Tahun 1999 sebagaimana telah diubah dengan UU Nomor 20 Tahun 2001 tentang Perubahan atas UU Nomor 31 Tahun 1999 tentang Pemberantasan Tindak Pidana Korupsi juncto Pasal 55 ayat (1) ke-1 junto Pasal 64 ayat (1) KUHP.</p>\n', 'd9a0bd227357dfef862aec04d7d69d8b.jpg', 2, '2019-09-19 04:28:09', NULL, NULL, 0),
(20, 'Arab Saudi Pamer Bukti Keterlibatan Iran dalam Serangan Kilang', '2019-09-19 00:00:00', '<p><strong>Riyadh</strong>: Arab Saudi menunjukkan bukti-bukti bahwa pesawat tak berawak dan rudal milik Iran digunakan dalam serangan ke kilang minyak Aramco.<br />\n&nbsp;<br />\nPihak Arab Saudi menuduh serangan itu disponsori oleh Iran, tetapi tidak secara langsung menuduh Teheran meluncurkan serangan.<br />\n&nbsp;<br />\nIran membantah terlibat dalam serangan yang sudah diklaim oleh pemberontak Yaman, Houthi. Atas tuduhan itu, Iran telah mengancam AS bahwa mereka akan membalas &lsquo;segera&rsquo; jika Teheran ditargetkan sebagai respons.</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy</li>\n	<li>Inspire</li>\n	<li>Confuse</li>\n	<li>Sad</li>\n</ul>\n\n<p><br />\nKonferensi pers oleh Juru Bicara militer Arab Saudi Kolonel Turki al-Malki muncul setelah ketegangan yang meningkat antara Iran dan AS mengenai Presiden Donald Trump secara sepihak menarik Amerika dari perjanjian nuklir Teheran tahun 2015 dengan kekuatan dunia.<br />\n&nbsp;<br />\nAS menuduh Iran melancarkan serangan itu, sebagai tanggapan terhadap perang yang dipimpin Arab Saudi selama bertahun-tahun dan menewaskan puluhan ribu orang.<br />\n&nbsp;<br />\nAl-Malki menegaskan untuk tidak secara langsung menuduh Iran menembakkan senjata atau meluncurkannya dari dalam wilayah Iran. Kerajaan Arab Saudi pun telah meminta bantuan dari penyelidik internasional dan PBB, baik memperpanjang penyelidikan dan internasionalisasi kesimpulannya.<br />\n&nbsp;<br />\n&quot;Serangan itu diluncurkan dari utara dan disponsori oleh Iran,&quot; kata Al-Malki kepada wartawan, seperti dikutip<em>&nbsp;AFP</em>, Kamis, 19 September 2019.<br />\n&nbsp;<br />\nMengatakan rudal diluncurkan dari Iran, kerajaan berpotensi menghindari respons yang dapat menyebabkan perang di antara negara-negara kelas di kawasan itu dan negara adidaya, Amerika Serikat. Namun, tidak membalas serangan juga membawa risiko meninggalkan Arab Saudi terkena serangan lanjutan.<br />\n&nbsp;<br />\nKonferensi pers berlangsung dengan latar belakang drone yang rusak dan terbakar serta potongan-potongan satu rudal jelajah yang diduga dikumpulkan dari serangan itu. Al-Malki menggambarkan drone sebagai model &lsquo;sayap delta&rsquo;, yang terlihat seperti segitiga besar. Rudal jelajah, yang digambarkan Al-Malki sebagai tipe &lsquo;Ya Ali&rsquo;, memiliki mesin jet kecil yang melekat padanya.<br />\n&nbsp;<br />\n&ldquo;Delapan belas drone dan tujuh rudal jelajah diluncurkan dalam serangan itu,&rdquo; ucap Al-Malki, dengan tiga rudal gagal mencapai target.<br />\n&nbsp;<br />\nDia mengatakan rudal jelajah memiliki jangkauan 700 kilometer, yang berarti mereka tidak mungkin ditembakkan dari dalam Yaman. Dia memutar video pengintai yang katanya menunjukkan sebuah drone datang dari utara. Gambar satelit yang dirilis sebelumnya oleh AS menunjukkan kerusakan sebagian besar pada sisi bangunan yang menghadap utara di lokasi tersebut.<br />\n&nbsp;<br />\n&quot;Ini adalah jenis senjata yang digunakan rezim dan IRGC (Pasukan Garda Revolusi) Iran terhadap target sipil dan infrastruktur fasilitas,&quot; tegasnya.<br />\n&nbsp;<br />\n&quot;Serangan ini tidak berasal dari Yaman, meskipun upaya terbaik Iran untuk membuatnya tampak begitu,&rdquo; imbuhnya.<br />\n&nbsp;<br />\nIran mengirim catatan ke AS melalui diplomat Swiss di Teheran awal pekan ini, menegaskan bahwa Teheran membantah terlibat dalam serangan Arab Saudi, kantor berita negara IRNA melaporkan. Swiss telah menjaga kepentingan Amerika di Teheran selama beberapa dekade.<br />\n&nbsp;<br />\n&quot;Jika ada tindakan yang dilakukan terhadap Iran, tindakan itu akan segera dihadapi oleh jawaban Iran,&quot; kata&nbsp;<em>IRNA</em>&nbsp;mengutip catatan itu.<br />\n&nbsp;<br />\nKantor berita nasional Iran itu menambahkan bahwa tanggapan pemerintahnya tidak akan terbatas pada sumber ancaman, menunjukkan bahwa itu akan menimbulkan kerusakan di luar apa yang telah dideritanya.</p>\n', '23a52f75314fca1a96a4898be548e18a.jpg', 2, '2019-09-19 04:28:43', NULL, NULL, 0),
(21, 'Real Madrid tak Berdaya di Markas PSG', '2019-09-19 00:00:00', '<p><strong>Paris</strong>: PSG mampu membuka kampanye Liga Champions mereka dengan kemenangan. Tak tanggung-tanggung, menghadapi Real Madrid di Parc des Princes pada Kamis, 19 September, dini hari tadi, PSG menang telak 3-0.<br />\n&nbsp;<br />\nIronisnya, mantan bintan Real Madrid, Angel Di Maria, menjadi protagonis PSG dengan dua golnya pada babak pertama. Satu gol lagi diciptakan oleh Thomas Meunier jelang akhir laga.<br />\n&nbsp;<br />\nEl Real benar-benar dibuat tak berkutik oleh Les Parisiens. Mereka hanya menguasai 47 persen penguasaan bola tanpa mencatatkan satu pun tembakan akurat dari 10 percobaan.</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy</li>\n	<li>Inspire</li>\n	<li>Confuse</li>\n	<li>Sad</li>\n</ul>\n\n<p><br />\n&nbsp; PSG langsung memimpin ketika pertandingan berjalan 14 menit. Mendapat umpan Juan Bernat, Angel Di Maria melepaskan tembakan kaki kiri yang tak mampu dijangkau Thibaut Courtois.<br />\n&nbsp;<br />\nDi Maria mencetak gol keduanya pada menit ke-33. Tembakan kaki kirinya lagi-lagi gagal dibendung Courtois usai memaksimalkan umpan Idrissa Gueye.<br />\n&nbsp;<br />\nReal Madrid sebenarnya mampu mencetak gol pada menit ke-35 lewat kaki Gareth Bale. Namun, gol tersebut dianulir karena bola dianggap mengenai tangan Bale terlebih dulu.<br />\n&nbsp;<br />\nPSG kembali mengancam gawang Madrid pada menit ke-39. Beruntung bagi Los Blancos karena sontekan Icardi masih bisa diselamatkan Courtois.<br />\n&nbsp;<br />\nDua menit kemudian, giliran Pablo Sarabia yang mengancam gawang Madrid. Namun, Courtois lagi-lagi menjadi penyelamat Madrid.<br />\n&nbsp;<br />\nMadrid terus mencoba menembus pertahanan PSG di sisa waktu yang ada. Tapi hingga turun minum, tak ada gol tambahan yang tercipta.<br />\n&nbsp;<br />\nMemasuki babak kedua, kedua tim masih memperagakan permainan menyerang. Tapi usaha Sarabia pada menit ke-61 lagi-lagi kandas di tangan Courtois.<br />\n&nbsp;<br />\nPSG menutup laga dengan kemenangan 3-0 setelah Thomas Meunier mencatatkan namanya di papan skor pada menit ke-91 setelah memanfaatkan umpan Bernat.<br />\n&nbsp;<br />\nDengan hasil ini, PSG memuncaki klasemen grup A. Sedangkan Madrid terbenam di dasar klasemen.<br />\n&nbsp;<br />\nSusunan pemain:<br />\n&nbsp;<br />\n<strong>PSG&nbsp;</strong>(4-3-3): Navas; Meunier, Silva, Kimpembe, Bernat; Gueye, Marquinhos (Herrera 70&#39;), Verratti; Sarabia (Diallo 89&#39;), Icardi (Choupo-Moting 60&#39;), Di Maria<br />\n&nbsp;<br />\n<strong>Madrid&nbsp;</strong>(4-3-3): Courtois; Carvajal, Varane, Militao, Mendy; Rodriguez (Jovic 70&#39;), Casemiro, Kroos; Bale (Vinicius 79&#39;), Benzema, Hazard (Vazquez 70&#39;)</p>\n', 'de066cc8c4d1e8f7e0a2be1d98ef7666.jpg', 2, '2019-09-19 04:29:15', NULL, NULL, 0),
(22, 'ICW bakal Ajukan Uji Materi Revisi UU KPK ke MK', '2019-09-19 00:00:00', '<p><strong>Jakarta</strong>: Indonesia Corruption Watch (ICW) memastikan akan mengajukan uji materi (<em>judicial review</em>) revisi Undang-undang Nomor 30 tahun 2002 tentang Komisi Pemberantasan Korupsi (KPK) ke Mahkamah Konstitusi (MK). UU itu telah disahkan DPR dan Pemerintah pada Selasa, 17 September 2019 lalu.<br />\n&nbsp;<br />\n&quot;<em>Judicial review</em>&nbsp;pasti. Kita akan melakukan&nbsp;<em>judicial review</em>&nbsp;ke MK,&quot; kata Peneliti ICW, Kurnia Ramadhana seperti dilansir Antara, Rabu, 18 September 2019.<br />\n&nbsp;<br />\nKurnia menyebut pihaknya akan mempersoalkan sejumlah dalil dalam revisi UU KPK yang dianggap melemahkan Lembaga Antirasuah. Poin-poin itu di antaranya terkait pembentukan dewan pengawas, izin penyadapan, hingga wewenang menerbitkan surat perintah penghentian perkara (SP3).</p>\n\n<p>&nbsp;</p>\n\n<p>Bagaimana tanggapan anda mengenai artikel ini?</p>\n\n<ul>\n	<li>Happy</li>\n	<li>Inspire</li>\n	<li>Confuse</li>\n	<li>Sad</li>\n</ul>\n\n<p><br />\nMenurut Kurnia, KPK tak membutuhkan dewan pengawas. Sebab KPK sudah memiliki sistem pengawasan yang berasal dari internal maupun eksternal.<br />\n&nbsp;<br />\nDia menjelaskan pengawasan internal KPK selama ini dijalankan oleh deputi pengawas internal dan pengaduan masyarakat. Sementara pengawasan eksternal dilakukan oleh Badan Pemeriksa Keuangan (BPK) dan DPR yang secara berkala menerima laporan kinerja KPK.<br />\n&nbsp;<br />\nDia menyebut mekanisme pengawasan KPK selama ini telah berjalan baik. Hal itu dibuktikan dari telah dijatuhkannya sanksi etik kepada dua eks pimpinan KPK, yaitu Saut Situmorang terkait pernyataanya soal organisasi kemahasiswaan dan Abraham Samad terkait bocornya Surat Perintah Penyidikan (Sprindik) salah satu tersangka kasus korupsi.<br />\n&nbsp;<br />\nTerkait penyadapan, Kurnia menyebut tindakan itu sah menurut hukum. Hal ini dibuktikan dari dijadikanya hasil penyadapan sebagai alat bukti di persidangan tindak pidana korupsi.<br />\n&nbsp;<br />\n&quot;KPK sudah melakukan tangkap tangan 123 kali, dengan menetapkan tersangka 432 orang. 432 orang yang masuk persidangan semuanya terbukti bersalah dengan penyadapan sebagai alat bukti yang kuat,&quot; ujarnya.<br />\n&nbsp;<br />\nDihubungi terpisah, Juru Bicara Mahkamah Konstitusi (MK) Fajar Laksono angkat bicara terkait wacana sejumlah masyarakat yang akan menguggat Undang-Undang Nomor 30 Tahun 2002 Tentang Komisi Pemberantasan Korupsi (KPK). Uji materi dinilai sebagai langkah tepat, bermartabat, dan konstitusional.<br />\n&nbsp;<br />\n&quot;Ketika ada komponen masyarakat menggunakan saluran dan mekanisme yang telah disediakan oleh konstitusi, itu hal biasa saja, walaupun langkah itu layak diapresiasi,&quot; kata Fajar<br />\n&nbsp;<br />\nFajar akan menyikapi permohonan uji materi itu sesuai dengan ketentutan hukum acara. Ia mengingatkan UU Tentang KPK itu belum diundangkan dan belum memiliki nomor.<br />\n&nbsp;<br />\nSebaiknya pengajuan uji materi menunggu penomoran terhadap undang-undang itu. &quot;Semestinya demikian (menunggu penomoran dulu), agak bersabar sedikitlah, jadi semua jelas dan sesuai ketentuan,&quot; katanya.</p>\n', '29482e369a3cc6140f81b11ac279dff5.jpg', 2, '2019-09-19 04:29:45', NULL, NULL, 0),
(23, 'test', '2019-09-25 00:00:00', '<p>se;riughlriughzldriug</p>\n\n<p>sDgf</p>\n\n<p>zsdg</p>\n\n<p>dzfg</p>\n\n<p>zdfg</p>\n', '73b23cb727c8c26ec4e0fe0ddedef672.jpg', 2, '2019-09-25 06:27:10', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tab_university`
--

CREATE TABLE `tab_university` (
  `university_id` int(11) NOT NULL,
  `university_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_university`
--

INSERT INTO `tab_university` (`university_id`, `university_name`) VALUES
(1, 'Universitas Airlangga – UNAIR'),
(2, 'Universitas Andalas – UNAND'),
(3, 'Universitas Bengkulu – UNIB'),
(4, 'Universitas Brawijaya – UNIBRAW'),
(5, 'Universitas Cenderawasih – UNCEN'),
(6, 'Universitas Diponegoro – UNDIP'),
(7, 'Universitas Gadjah Mada – UGM'),
(8, 'Universitas Haluoleo – UNHALU'),
(9, 'Universitas Hasanuddin – UNHAS'),
(10, 'Universitas Indonesia – UI'),
(11, 'Universitas Islam Negeri (UIN) Alauddin'),
(12, 'Universitas Islam Negeri (UIN) Malang'),
(13, 'Universitas Islam Negeri Sultan Syarif Qasim'),
(14, 'Universitas Islam Negeri Sunan Gunung Djati'),
(15, 'Universitas Islam Negeri (UIN) Sunan Kalijaga'),
(16, 'Universitas Islam Negeri Syarif Hidayatullah'),
(17, 'Universitas Jambi – UNJA'),
(18, 'Universitas Jenderal Soedirman – UNSOED'),
(19, 'Universitas Khairun Ternate'),
(20, 'Universitas Lambung Mangkurat – UNLAM'),
(21, 'Universitas Lampung – UNILA'),
(22, 'Universitas Malikussaleh'),
(23, 'Universitas Mataram'),
(24, 'Universitas Mulawarman – UNMUL'),
(25, 'Universitas Negeri Gorontalo – UNG'),
(26, 'Universitas Negeri Jakarta – UNJ'),
(27, 'Universitas Negeri Jember – UNEJ'),
(28, 'Universitas Negeri Makassar – UNM'),
(29, 'Universitas Negeri Malang – UNM'),
(30, 'Universitas Negeri Manado – UNIMA'),
(31, 'Universitas Negeri Medan – UNIMED'),
(32, 'Universitas Negeri Padang – UNP'),
(33, 'Universitas Negeri Papua – UNIPA'),
(34, 'Universitas Negeri Sebelas Maret – UNS'),
(35, 'Universitas Negeri Semarang – UNNES'),
(36, 'Universitas Negeri Surabaya – UNESA'),
(37, 'Universitas Negeri Yogyakarta – UNY'),
(38, 'Universitas Nusa Cendana – UNDANA'),
(39, 'Universitas Padjadjaran – UNPAD'),
(40, 'Universitas Palangkaraya – UPR'),
(41, 'Universitas Pattimura'),
(42, 'Universitas Pendidikan Ganesha'),
(43, 'Universitas Pendidikan Indonesia – UPI'),
(44, 'Universitas Riau – UNRI'),
(45, 'Universitas Sam Ratulangi – UNSRAT'),
(46, 'Universitas Sriwijaya – UNSRI'),
(47, 'Universitas Sultan Ageng Tirtayasa – UNTIRTA'),
(48, 'Universitas Sumatera Utara – USU'),
(49, 'Universitas Syiah Kuala – UNSYIAH'),
(50, 'Universitas Tadulako – UNTAD'),
(51, 'Universitas Tanjungpura – UNTAN'),
(52, 'Universitas Terbuka – UT'),
(53, 'Universitas Trunojoyo Madura'),
(54, 'Universitas Udayana – UNUD'),
(55, 'IPB – Institut Pertanian Bogor'),
(56, 'ITB – Institut Teknologi Bandung'),
(57, 'ITS – Institut Teknologi Sepuluh Nopember'),
(58, 'IAIN Antasari'),
(59, 'IAIN Ar-Raniry'),
(60, 'IAIN Imam Bonjol'),
(61, 'IAIN Mataram'),
(62, 'IAIN Raden Fatah'),
(63, 'IAIN Raden Intan'),
(64, 'IAIN Sultan Amai'),
(65, 'IAIN Sunan Ampel'),
(66, 'IAIN Walisongo'),
(67, 'IAIN Sultan Maulana Hasanuddin'),
(68, 'IAIN Sultan Thaha Saifuddin'),
(69, 'IAIN Sumatera Utara'),
(70, 'Institut Hindu Dharma Negeri (IHDN) Denpasar'),
(71, 'Institut Ilmu Pemerintahan – IIP'),
(72, 'Institut Seni Indonesia (ISI) Denpasar'),
(73, 'Institut Seni Indonesia (ISI) Yogyakarta'),
(74, 'Sekolah Tinggi Akuntansi Negara – STAN'),
(75, 'Sekolah Tinggi Hukum Militer – STHM'),
(76, 'Sekolah Tinggi Ilmu Administrasi – Bandung'),
(77, 'Sekolah Tinggi Ilmu Administrasi- LAN Jakarta'),
(78, '– Ujung Pandang'),
(79, 'Sekolah Tinggi Ilmu Kepolisian PTIK'),
(80, 'Sekolah Tinggi Ilmu Pelayaran – STIP'),
(81, 'Sekolah Tinggi Ilmu Statistik – STIS'),
(82, 'Sekolah Tinggi Manajemen Industri – STMI'),
(83, 'Sekolah Tinggi Penerbangan Indonesia – STPI'),
(84, 'Sekolah Tinggi Perikanan – STP'),
(85, 'Sekolah Tinggi Pertanahan Nasional – STPN'),
(86, 'Sekolah Tinggi Sandi Negara – STSN'),
(87, 'Sekolah Tinggi Seni Indonesia – STSI- Bandung'),
(88, 'Sekolah Tinggi Seni Indonesia – Padang Panjang'),
(89, 'Sekolah Tinggi Seni Indonesia – STSI -Surakarta'),
(90, 'Sekolah Tinggi Teknologi Nuklir – STTN'),
(91, 'Sekolah Tinggi Transportasi Darat – STTD'),
(92, 'Agama Hindu Negeri (STAHN) Gde Puja'),
(93, 'Agama Hindu Negeri Tampung Peyang'),
(94, 'Agama Kristen Negeri (STAKN) Denpasar'),
(95, 'Agama Kristen Negeri (STAKN) Jayapura'),
(96, 'Agama Kristen Negeri (STAKN) Palangkaraya'),
(97, 'Agama Kristen Negeri (STAKN) Toraja'),
(98, 'Agama Kristen Protestan Negeri Ambon'),
(99, 'Agama Kristen Protestan Negeri Tarutung'),
(100, 'Kesejahteraan Sosial – STKS – Bandung'),
(101, 'Pemerintahan Dalam Negeri – STPDN'),
(102, 'Penyuluhan Pertanian (STTP) Bogor'),
(103, 'Penyuluhan Pertanian (STTP) Gowa'),
(104, 'Penyuluhan Pertanian (STTP) Magelang'),
(105, 'Penyuluhan Pertanian (STTP) Magelang- DIY'),
(106, 'Penyuluhan Pertanian (STTP) Malang'),
(107, 'Penyuluhan Pertanian (STTP) Manokwari'),
(108, 'Penyuluhan Pertanian (STTP) Medan'),
(109, 'STAIN Al-Fatah'),
(110, 'STAIN Ambon'),
(111, 'STAIN Batusangkar'),
(112, 'STAIN Bengkulu'),
(113, 'STAIN Cirebon'),
(114, 'STAIN Curup'),
(115, 'STAIN Datokarama'),
(116, 'STAIN Jember'),
(117, 'STAIN Jurai Siwo'),
(118, 'STAIN Kediri'),
(119, 'STAIN Kerinci Sungai Penuh'),
(120, 'STAIN Kudus'),
(121, 'STAIN Malikusshaleh'),
(122, 'STAIN Manado'),
(123, 'STAIN Padang Sidempuan'),
(124, 'STAIN Palangkaraya'),
(125, 'STAIN Palopo'),
(126, 'STAIN Pamekasan'),
(127, 'STAIN Pare Pare'),
(128, 'STAIN Pekalongan'),
(129, 'STAIN Ponorogo'),
(130, 'STAIN Pontianak'),
(131, 'STAIN Prof.Dr.H.Mahmud Yunus'),
(132, 'STAIN Purwokerto'),
(133, 'STAIN Salatiga'),
(134, 'STAIN Samarinda'),
(135, 'Djambek'),
(136, 'STAIN Sultan Qaimuddin'),
(137, 'STAIN Surakarta'),
(138, 'STAIN Syekh Abdurrahman Siddik'),
(139, 'STAIN Ternate'),
(140, 'STAIN Tulungagung'),
(141, 'STAIN Watampone'),
(142, 'Politeknik Elektronika Negeri Surabaya'),
(143, 'Politeknik Ilmu Pelayaran Makasar'),
(144, 'Politeknik Ilmu Pelayaran Semarang'),
(145, 'Politeknik Kesehatan Banda Aceh'),
(146, 'Politeknik Kesehatan Bandung'),
(147, 'Politeknik Kesehatan Banjarmasin'),
(148, 'Politeknik Kesehatan Denpasar'),
(149, 'Politeknik Kesehatan Jakarta I'),
(150, 'Politeknik Kesehatan Jakarta II'),
(151, 'Politeknik Kesehatan Jambi'),
(152, 'Politeknik Kesehatan Lampung'),
(153, 'Politeknik Kesehatan Makassar'),
(154, 'Politeknik Kesehatan Malang'),
(155, 'Politeknik Kesehatan Manado'),
(156, 'Politeknik Kesehatan Medan'),
(157, 'Politeknik Kesehatan Padang'),
(158, 'Politeknik Kesehatan Palembang'),
(159, 'Politeknik Kesehatan Semarang'),
(160, 'Politeknik Kesehatan Surabaya'),
(161, 'Politeknik Kesehatan Surakarta'),
(162, 'Politeknik Kesehatan Yogyakarta'),
(163, 'Politeknik Manufaktur Bandung'),
(164, 'Politeknik Negeri Ambon'),
(165, 'Politeknik Negeri Bali'),
(166, 'Politeknik Negeri Bandung'),
(167, 'Politeknik Negeri Banjarmasin'),
(168, 'Politeknik Negeri Jakarta'),
(169, 'Politeknik Negeri Jember'),
(170, 'Politeknik Negeri Kupang'),
(171, 'Politeknik Negeri Lampung'),
(172, 'Politeknik Negeri Lhokseumawe'),
(173, 'Politeknik Negeri Makasar'),
(174, 'Politeknik Negeri Malang'),
(175, 'Politeknik Negeri Manado'),
(176, 'Politeknik Negeri Medan'),
(177, 'Politeknik Negeri Padang'),
(178, 'Politeknik Negeri Pontianak'),
(179, 'Politeknik Negeri Samarinda'),
(180, 'Politeknik Negeri Semarang'),
(181, 'Politeknik Negeri Sriwijaya'),
(182, 'Politeknik Perikanan Negeri Tual'),
(183, 'Politeknik Perkapalan Negeri Surabaya'),
(184, 'Politeknik Pertanian Negeri Jember'),
(185, 'Politeknik Pertanian Negeri Kupang'),
(186, 'Politeknik Pertanian Negeri Lampung'),
(187, 'Politeknik Pertanian Negeri Pangkep'),
(188, 'Politeknik Pertanian Negeri Payakumbuh'),
(189, 'Politeknik Pertanian Negeri Samarinda'),
(190, 'Akademi Kimia Analis – AKA'),
(191, 'Akademi Meteorologi dan Geofisika – AMG'),
(192, 'Akademi Imigrasi – AIM'),
(193, 'Akademi Ilmu Pemasyarakatan – AKIP'),
(194, 'Akademi Angkatan Udara – AAU – (AKABRI)'),
(195, 'Akademi Militer TNI AD – AKMIL – (AKABRI)'),
(196, 'Akademi Angkatan Laut – AAL – (AKABRI)'),
(197, 'Akademi Kepolisian – AKPOL – (AKABRI)'),
(198, 'Akademi Minyak dan Gas Bumi – AMGB – Cepu'),
(199, 'Akademi Pimpinan Perusahaan – APP'),
(200, 'Akademi Teknologi Kulit – ATK'),
(201, 'A.Teknik Keselamatan Penerbangan Makasar'),
(202, 'Penerbangan – ATKP – Medan'),
(203, 'ATKP – Surabaya'),
(204, 'Sanitasi dan Kesehatan Lingkungan – ASKK'),
(205, 'Universitas Tjut Nyak Dhien '),
(206, 'Universitas HKBP Nommensen '),
(207, 'Universitas Methodist Indonesia '),
(208, 'Universitas Islam Sumatera Utara'),
(209, 'Universitas Muhammadiyah Bengkulu'),
(210, 'Universitas Muhammadiyah Palembang'),
(211, 'Institut Informatika dan Bisnis Darmajaya '),
(212, 'Universitas Muhammadiyah Metro'),
(213, 'Universitas Budi Luhur '),
(214, 'Universitas Paramadina '),
(215, 'Inti College Indonesia '),
(216, 'Sekolah Tinggi Ilmu Komputer Inti '),
(217, 'Universitas Bhayangkara Jakarta Raya '),
(218, 'Universitas Persada Indonesia Y.A.I'),
(219, 'Universitas Katolik Indonesia Atma Jaya '),
(220, 'Universitas Bina Nusantara '),
(221, 'Universitas Borobudur '),
(222, 'Universitas Bunda Mulia '),
(223, 'Universitas Gunadarma '),
(224, 'Universitas Kristen Indonesia '),
(225, 'Universitas Kristen Krida Wacana '),
(226, 'Universitas Presiden '),
(227, 'Universitas Muhammadiyah Jakarta '),
(228, 'Universitas Muhammadiyah Prof. Dr. HAMKA '),
(229, 'Universitas Pancasila '),
(230, 'Universitas Mercubuana '),
(231, 'Universitas Nasional '),
(232, 'Universitas Tarumanagara '),
(233, 'Universitas Trisakti '),
(234, 'Universitas Bakrie '),
(235, 'Universitas Pembangunan Jaya '),
(236, 'Universitas Tanri Abeng '),
(237, 'Institut Kalbis '),
(238, 'Universitas YARSI '),
(239, 'STIMIK ESQ Business School'),
(240, 'Universitas Multimedia Nusantara '),
(241, 'Universitas Pamulang '),
(242, 'Universitas Pelita Harapan '),
(243, 'Universitas Gunadarma '),
(244, 'Universitas Swiss German '),
(245, 'Universitas Bina Nusantara (Kampus Alam Sutera) '),
(246, 'Sekolah Tinggi Ilmu Ekonomi Prasetiya Mulya '),
(247, 'Perguruan Tinggi Raharja Tangerang '),
(248, 'Universitas Serang Raya '),
(249, 'Universitas Teknologi Nusantara '),
(250, 'Universitas Surya'),
(251, 'Universitas Langlangbuana '),
(252, 'Universitas Komputer Indonesia '),
(253, 'Universitas Jenderal Achmad Yani '),
(254, 'Universitas Kristen Maranatha '),
(255, 'Universitas Muhammadiyah Cirebon '),
(256, 'Universitas Muhammadiyah Sukabumi '),
(257, 'Universitas Muhammadiyah Bandung '),
(258, 'Universitas Muhammadiyah Bogor '),
(259, 'Universitas Muhammadiyah Depok '),
(260, 'Universitas Muhammadiyah Sukabumi Utara '),
(261, 'Universitas Sultan Mahesa '),
(262, 'Universitas Siliwangi '),
(263, 'Universitas Muhammadiyah Tasikmalaya '),
(264, 'Universitas Muhammadiyah Garut '),
(265, 'Universitas Muhammadiyah Bekasi '),
(266, 'Universitas Muhammadiyah Cianjur '),
(267, 'Universitas Katolik Parahyangan '),
(268, 'Institut Teknologi Telkom '),
(269, 'Institut Manajemen Telkom'),
(270, 'Universitas Atmajaya Yogyakarta '),
(271, 'Universitas Ahmad Dahlan '),
(272, 'Institut Sains dan Teknologi AKPRIND '),
(273, 'Universitas Kristen Duta Wacana '),
(274, 'Universitas Islam Indonesia '),
(275, 'Universitas Mercubuana Yogyakarta '),
(276, 'Universitas Muhammadiyah Yogyakarta '),
(277, 'Universitas Pembangunan Nasional \"Veteran\" '),
(278, 'Universitas Teknologi Yogyakarta'),
(279, 'Universitas Katolik Soegijapranata '),
(280, 'Universitas Widya Dharma '),
(281, 'Universitas Kristen Satya Wacana '),
(282, 'Universitas Muhammadiyah Magelang '),
(283, 'Universitas Muhammadiyah Purwokerto '),
(284, 'Universitas Muhammadiyah Purworejo '),
(285, 'Universitas Muhammadiyah Semarang '),
(286, 'Universitas Muhammadiyah Surakarta '),
(287, 'Universitas Muria Kudus '),
(288, 'Universitas Surakarta '),
(289, 'Universitas Islam Batik Surakarta '),
(290, 'Akademi Manajemen Informatika BSI Purwokerto'),
(291, 'Sekolah Tinggi Ilmu Ekonomi Kertanegara Malang '),
(292, 'STIKES Katolik St. Vincentius a Paulo Surabaya '),
(293, 'Universitas Pembangunan Nasional Veteran Jawa Timur '),
(294, 'Universitas Muhammadiyah Malang '),
(295, 'Universitas Ma Chung '),
(296, 'Universitas Merdeka Malang '),
(297, 'Universitas Muhammadiyah Surabaya '),
(298, 'Universitas Muhammadiyah Sidoarjo '),
(299, 'Universitas Muhammadiyah Gresik '),
(300, 'Universitas Muhammadiyah Jember '),
(301, 'Universitas Widyagama '),
(302, 'Universitas PGRI Banyuwangi '),
(303, 'Universitas Kristen Petra '),
(304, 'Universitas Surabaya '),
(305, 'Universitas Ciputra'),
(306, 'STT Migas'),
(307, 'Universitas Balikpapan'),
(308, 'STMIK Balikpapan'),
(309, 'Universitas 17 Agustus 1945 Samarinda'),
(310, 'Universitas Trunajaya'),
(311, 'Universitas Katolik De La Salle Manado'),
(312, 'Universitas Fajar '),
(313, 'Universitas Muhammadiyah Makassar '),
(314, 'Universitas Pepabri Makassar');

-- --------------------------------------------------------

--
-- Table structure for table `tab_user`
--

CREATE TABLE `tab_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_pwd` varchar(50) NOT NULL,
  `user_f_name` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_status` enum('ACTIVE','NOT ACTIVE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_user`
--

INSERT INTO `tab_user` (`user_id`, `user_name`, `user_pwd`, `user_f_name`, `role_id`, `user_status`) VALUES
(1, 'dev', '2ea7c0cd9fbbbd28d3815999dbd4440a', 'Developer', 1, 'ACTIVE'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 1, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `template_venue`
--

CREATE TABLE `template_venue` (
  `tv_id` int(11) NOT NULL,
  `tv_name` varchar(100) NOT NULL,
  `tv_content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='untuk bikin template venue';

--
-- Dumping data for table `template_venue`
--

INSERT INTO `template_venue` (`tv_id`, `tv_name`, `tv_content`) VALUES
(1, 'HRD', 'Ruang HRD Metro TV\r\nGedung Indocater Lantai 3\r\nJl. Pilar Mas Raya, Kavling A-D, Kedoya\r\nKebon Jeruk, Jakarta Barat 11520'),
(2, 'Lobi Grand Metro TV', 'Lobi Grand Metro TV\r\nJl. Pilar Mas Raya, Kavling A-D, Kedoya\r\nKebon Jeruk, Jakarta Barat 11520'),
(3, 'Lobi 2', 'Lobi Grand Metro TV\r\nJl. Pilar Mas Raya, Kavling A-D, Kedoya\r\nKebon Jeruk, Jakarta Barat 11520'),
(4, 'Lobi 1', 'Lobi 1 Metro TV\r\nJl. Pilar Mas Raya, Kavling A-D, Kedoya\r\nKebon Jeruk, Jakarta Barat 11520\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tr_applicant`
--

CREATE TABLE `tr_applicant` (
  `applicant_id` int(11) NOT NULL,
  `vacant_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `applicant_status` enum('On Going','Failed','Passed','N/A') NOT NULL DEFAULT 'N/A',
  `applicant_date_res` datetime DEFAULT NULL,
  `applicant_ket` text,
  `applicant_user_id` varchar(20) DEFAULT NULL,
  `iu_stat` enum('Failed','Passed','On Going','N/A') NOT NULL DEFAULT 'N/A' COMMENT 'iu = Interview User',
  `iu_date` datetime DEFAULT NULL,
  `iu_lokasi` varchar(200) DEFAULT NULL,
  `iu_pic` varchar(100) DEFAULT NULL,
  `iu_acc` enum('A','R') DEFAULT NULL,
  `iu_acc_reason` text NOT NULL,
  `iu_user_id` varchar(20) DEFAULT NULL,
  `iu_ket` text,
  `iu_date_res` datetime DEFAULT NULL,
  `ihr_stat` enum('Failed','Passed','On Going','N/A') NOT NULL DEFAULT 'N/A' COMMENT 'ihr = Interview HR',
  `ihr_date` datetime DEFAULT NULL,
  `ihr_lokasi` varchar(200) DEFAULT NULL,
  `ihr_pic` varchar(100) DEFAULT NULL,
  `ihr_acc` enum('A','R') DEFAULT NULL,
  `ihr_acc_reason` text,
  `ihr_user_id` varchar(20) DEFAULT NULL,
  `ihr_ket` text,
  `ihr_date_res` datetime DEFAULT NULL,
  `psikotest_stat` enum('Failed','Passed','On Going','N/A') NOT NULL DEFAULT 'N/A',
  `psikotest_date` datetime DEFAULT NULL,
  `psikotest_lokasi` varchar(200) DEFAULT NULL,
  `psikotest_pic` varchar(100) DEFAULT NULL,
  `psikotest_acc` enum('A','R') DEFAULT NULL,
  `psikotest_acc_reason` text NOT NULL,
  `psikotest_user_id` varchar(20) DEFAULT NULL,
  `psikotest_ket` text,
  `psikotest_date_res` datetime DEFAULT NULL,
  `psikotest_file` varchar(100) DEFAULT NULL,
  `psikotest_file_entry` datetime DEFAULT NULL,
  `ia_stat` enum('Failed','Passed','On Going','N/A') NOT NULL DEFAULT 'N/A' COMMENT 'ia = Interview Assessor',
  `ia_date` datetime DEFAULT NULL,
  `ia_lokasi` varchar(200) DEFAULT NULL,
  `ia_pic` varchar(100) DEFAULT NULL,
  `ia_acc` enum('A','R') DEFAULT NULL,
  `ia_acc_reason` text NOT NULL,
  `ia_user_id` varchar(20) DEFAULT NULL,
  `ia_ket` text,
  `ia_date_res` datetime DEFAULT NULL,
  `mcu_stat` enum('Failed','Passed','On Going','N/A') NOT NULL DEFAULT 'N/A',
  `mcu_date` datetime DEFAULT NULL,
  `mcu_lokasi` varchar(200) DEFAULT NULL,
  `mcu_pic` varchar(100) DEFAULT NULL,
  `mcu_acc` enum('A','R') DEFAULT NULL,
  `mcu_acc_reason` text NOT NULL,
  `mcu_user_id` varchar(20) DEFAULT NULL,
  `mcu_ket` text,
  `mcu_date_res` datetime DEFAULT NULL,
  `mcu_file` varchar(100) DEFAULT NULL,
  `mcu_file_entry` datetime DEFAULT NULL,
  `final_stat` enum('Failed','Passed','On Going','N/A') NOT NULL DEFAULT 'N/A',
  `final_date` datetime DEFAULT NULL,
  `final_lokasi` varchar(200) DEFAULT NULL,
  `final_pic` varchar(100) DEFAULT NULL,
  `final_acc` enum('A','R') DEFAULT NULL,
  `final_acc_reason` text NOT NULL,
  `final_user_id` varchar(20) DEFAULT NULL,
  `final_ket` text,
  `final_date_res` datetime DEFAULT NULL,
  `apply_date` datetime NOT NULL,
  `is_visited` int(11) NOT NULL DEFAULT '0',
  `is_sent` enum('S','NS') NOT NULL DEFAULT 'NS'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_applicant`
--

INSERT INTO `tr_applicant` (`applicant_id`, `vacant_id`, `candidat_id`, `applicant_status`, `applicant_date_res`, `applicant_ket`, `applicant_user_id`, `iu_stat`, `iu_date`, `iu_lokasi`, `iu_pic`, `iu_acc`, `iu_acc_reason`, `iu_user_id`, `iu_ket`, `iu_date_res`, `ihr_stat`, `ihr_date`, `ihr_lokasi`, `ihr_pic`, `ihr_acc`, `ihr_acc_reason`, `ihr_user_id`, `ihr_ket`, `ihr_date_res`, `psikotest_stat`, `psikotest_date`, `psikotest_lokasi`, `psikotest_pic`, `psikotest_acc`, `psikotest_acc_reason`, `psikotest_user_id`, `psikotest_ket`, `psikotest_date_res`, `psikotest_file`, `psikotest_file_entry`, `ia_stat`, `ia_date`, `ia_lokasi`, `ia_pic`, `ia_acc`, `ia_acc_reason`, `ia_user_id`, `ia_ket`, `ia_date_res`, `mcu_stat`, `mcu_date`, `mcu_lokasi`, `mcu_pic`, `mcu_acc`, `mcu_acc_reason`, `mcu_user_id`, `mcu_ket`, `mcu_date_res`, `mcu_file`, `mcu_file_entry`, `final_stat`, `final_date`, `final_lokasi`, `final_pic`, `final_acc`, `final_acc_reason`, `final_user_id`, `final_ket`, `final_date_res`, `apply_date`, `is_visited`, `is_sent`) VALUES
(1, 1, 1, 'Failed', '2017-03-02 17:17:00', 'Setelah pertimbangan tidak sesuai untuk posisi JDP', 'dev', 'Failed', '2017-03-02 18:01:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, '', 'dev', 'test', '2017-03-02 17:07:00', 'Passed', '2017-03-02 17:01:00', 'Metro TV - Grand Lobby', 'Dita Permana / 081812345678', NULL, NULL, 'dev', '', '2017-03-02 17:02:00', 'N/A', '2017-02-11 10:00:00', 'Metro TV - Lt 8', 'Dita Permana / 081812345678', NULL, '', 'dev', '', '2017-02-11 17:59:00', NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-02 00:00:00', 0, 'NS'),
(2, 3, 1, 'On Going', '2017-02-09 12:12:00', '', 'dev', 'Passed', '2017-03-09 01:12:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, '', 'dev', '', '2017-03-09 01:12:00', 'Passed', '2017-03-02 11:00:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, NULL, 'dev', '', '2017-03-02 17:02:00', 'N/A', '2017-03-04 11:00:00', 'Metro TV - Lt 8', 'John Doe / 08123456789', NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-03 08:00:00', 0, 'NS'),
(3, 2, 5, 'Failed', '2017-03-07 17:09:00', 'Wanted to move', 'dev', 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'Passed', '2017-03-02 17:11:00', 'Metro TV - Grand Lobby', 'Dita Permana / 081812345678', NULL, NULL, 'dev', 'Cocok cocok saja', '2017-03-02 17:12:00', 'N/A', '2017-02-03 14:00:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-02-28 00:00:00', 0, 'NS'),
(4, 5, 2, 'On Going', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'Passed', '2017-03-02 17:11:00', 'Metro TV - Grand Lobby', 'Dita Permana / 081812345678', NULL, NULL, 'dev', 'Cocok cocok saja', '2017-03-02 17:12:00', 'N/A', '2017-02-03 14:00:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, '', NULL, NULL, NULL, NULL, NULL, 'On Going', '2017-03-09 01:12:00', 'Metro TV - Lt 8', 'Dita Permana / 081812345678', NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-10 00:00:00', 0, 'NS'),
(5, 3, 4, 'Failed', '2017-03-21 18:04:00', 'kurang gaol', 'admin', 'Passed', '2017-03-09 01:12:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, '', 'dev', '', '2017-03-09 01:12:00', 'Passed', '2017-03-02 11:00:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, NULL, 'dev', '', '2017-03-02 17:02:00', 'Failed', '2017-03-13 08:30:00', 'Gedung Indocater Lantai 3', 'lalala', NULL, '', 'admin', 'elek', '2017-03-21 18:03:00', NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-03 08:00:00', 0, 'NS'),
(6, 3, 3, 'On Going', '2017-02-09 12:12:00', '', 'dev', 'Passed', '2017-03-09 01:12:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, '', 'dev', '', '2017-03-09 01:12:00', 'Passed', '2017-03-02 11:00:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, NULL, 'dev', '', '2017-03-02 17:02:00', 'N/A', '2017-03-04 11:00:00', 'Metro TV - Lt 8', 'John Doe / 08123456789', NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-03 08:00:00', 0, 'NS'),
(7, 5, 3, 'On Going', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'Passed', '2017-03-02 17:11:00', 'Metro TV - Grand Lobby', 'Dita Permana / 081812345678', NULL, NULL, 'dev', 'Cocok cocok saja', '2017-03-02 17:12:00', 'N/A', '2017-02-03 14:00:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, '', NULL, NULL, NULL, NULL, NULL, 'On Going', '2017-03-09 01:12:00', 'Metro TV - Lt 8', 'Dita Permana / 081812345678', NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-10 00:00:00', 0, 'NS'),
(8, 5, 5, 'Passed', '2017-03-09 21:27:00', 'GEGE', 'dev', 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'Passed', '2017-03-02 17:11:00', 'Metro TV - Grand Lobby', 'Dita Permana / 081812345678', NULL, NULL, 'dev', 'Cocok cocok saja', '2017-03-02 17:12:00', 'N/A', '2017-02-03 14:00:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, '', NULL, NULL, NULL, NULL, NULL, 'Passed', '2017-03-09 01:12:00', 'Metro TV - Lt 8', 'Dita Permana / 081812345678', NULL, '', 'dev', '', '2017-03-09 21:22:00', 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-10 00:00:00', 0, 'NS'),
(12, 4, 6, 'N/A', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-13 11:03:30', 0, 'NS'),
(13, 6, 4, 'N/A', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'Passed', '2017-03-02 11:00:00', 'Metro TV - Grand Lobby', 'John Doe / 08123456789', NULL, NULL, 'dev', '', '2017-03-02 17:02:00', 'Failed', '2017-03-13 08:30:00', 'Gedung Indocater Lantai 3', 'lalala', NULL, '', 'admin', 'elek', '2017-03-21 18:03:00', NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2017-03-03 08:00:00', 0, 'NS'),
(14, 11, 26, 'On Going', NULL, NULL, NULL, 'On Going', '2019-10-28 14:56:00', 'Ruang HRD Metro TV\r\nGedung Indocater Lantai 3\r\nJl. Pilar Mas Raya, Kavling A-D, Kedoya\r\nKebon Jeruk, Jakarta Barat 11520', 'adsf', NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2019-09-13 17:51:50', 1, 'NS'),
(24, 11, 40, 'On Going', NULL, NULL, NULL, 'On Going', '2019-10-31 10:00:00', 'Lobi Grand Metro TV\r\nJl. Pilar Mas Raya, Kavling A-D, Kedoya\r\nKebon Jeruk, Jakarta Barat 11520', 'TEST', NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2019-09-27 13:51:22', 1, 'NS');

--
-- Triggers `tr_applicant`
--
DELIMITER $$
CREATE TRIGGER `trg_vacant` AFTER UPDATE ON `tr_applicant` FOR EACH ROW BEGIN
	DECLARE candidat_required INT;
	DECLARE candidat_curr INT;
	SELECT candidat_needed INTO candidat_required FROM tr_vacant WHERE vacant_id = NEW.vacant_id;
	SET candidat_curr = candidat_required - 1;
	IF candidat_curr >= 0 THEN
		IF NEW.applicant_status = "Passed" THEN
			IF candidat_curr <> 0 THEN
				UPDATE tr_vacant SET candidat_needed = candidat_curr WHERE vacant_id = NEW.vacant_id;
			ELSE
				UPDATE tr_vacant SET close_date = CURDATE(), candidat_needed = candidat_curr, vacant_status = 'NOT ACTIVE' WHERE vacant_id = NEW.vacant_id;
			END IF;
		END IF;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_vacant`
--

CREATE TABLE `tr_vacant` (
  `vacant_id` int(11) NOT NULL,
  `vacant_group_id` int(11) DEFAULT NULL,
  `vacant_title` varchar(150) DEFAULT NULL,
  `vacant_code` varchar(10) DEFAULT NULL,
  `vacant_criteria` longtext,
  `open_date` datetime DEFAULT NULL,
  `close_date` datetime DEFAULT NULL,
  `candidat_needed` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `vacant_status` enum('ACTIVE','NOT ACTIVE') DEFAULT NULL,
  `url_poster` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_vacant`
--

INSERT INTO `tr_vacant` (`vacant_id`, `vacant_group_id`, `vacant_title`, `vacant_code`, `vacant_criteria`, `open_date`, `close_date`, `candidat_needed`, `created_by`, `created_date`, `modified_by`, `modified_date`, `vacant_status`, `url_poster`) VALUES
(11, 2, 'IT PROGRAMMER', 'IT-PROG', '<p>WE ARE looking for young and highly motivated Millenials to join our team as Trainee. This program is designed to develop professional Digital Journalist person with multiplatform news which is television and online news portal. This program involves structure approach by combining in class enrichment and assignment at Metro TV and Medcom.id.</p>\n\n<p>Bachelor degree from reputable university with minimum GPA 2.75</p>\n\n<p>Majoring IT / Information System</p>\n\n<p>Willing to work Shift</p>\n\n<p>Fresh graduates are welcome</p>\n\n<p>Knowledge &amp; Skills:</p>\n\n<p>CODEIGNITER/LARAVEL</p>\n\n<p>IONIC/Bootstrap</p>\n\n<p>NODEJS, REACTJS,VUEJS, ANGULARJS, EXTJS</p>\n\n<p>SQL Server, ORACLE, INYSQL, POSTGRESSQL</p>\n\n<p>Windows, LINUX, IMACOS</p>\n', '2019-05-01 00:00:00', '2019-10-01 00:00:00', 2, 2, '2019-08-23 10:47:12', 2, '2019-09-13 04:06:14', 'ACTIVE', 'f41ce2889430f83a6ceda2b3049e7431.jpg'),
(12, 3, 'MARKETING PLANNER', 'MKTG - PLN', '<p>WE ARE looking for young and highly motivated Millenials to join our team as Trainee. This program is designed to develop professional Digital Journalist person with multiplatform news which is television and online news portal. This program involves structure approach by combining in class enrichment and assignment at Metro TV and Medcom.id.</p>\n\n<p>MIPA Major Preferably</p>\n\n<p>Have 1-3 years experience in Advertising / Market Research / Media Planning / Creative / Digital media</p>\n\n<p>Have knowledge in marketing and media plan</p>\n\n<p>Able to translate business brief and research insights into strategy</p>\n\n<p>Able to speak and write in Bahasa &amp; English</p>\n\n<p>Analythical thinking, creative and problem solver</p>\n\n<p>Have skills in power point &amp; presentation (Adobe PS / Al is a plus)</p>\n', '2019-07-06 00:00:00', '2019-09-11 00:00:00', 1, 2, '2019-08-23 10:48:15', 2, '2019-08-26 04:22:17', 'ACTIVE', 'eaef6a9cff328c1f547c74d6b4e842ea.jpg'),
(13, 4, 'JOURNALIST DEVELOPMENT PROGRAM', 'JDP', '<p>WE ARE looking for young and highly motivated Millenials to join our team as Trainee. This program is designed to develop professional Digital Journalist person with multiplatform news which is television and online news portal. This program involves structure approach by combining in class enrichment and assignment at Metro TV and Medcom.id.</p>\n\n<p>Bachelor Degree from Reputable University</p>\n\n<p>Any major with minimum GPA 3.00</p>\n\n<p>Have strong interest in Broadcast and Media Industry</p>\n\n<p>Good Team Player and Achievement Orientation</p>\n\n<p>Energetic and Willing to Work in Flexible Long Hours</p>\n\n<p>Smart, Good Interpersonal and Communication Skill</p>\n\n<p>Strong Interest in Journalism</p>\n\n<p>Willing to Work in Working Bound</p>\n', '2019-06-20 00:00:00', '2019-08-08 00:00:00', 1, 2, '2019-08-23 10:49:31', 2, '2019-08-26 04:22:26', 'ACTIVE', '2ce0de96b6ccbb47806553e2d72f3973.jpg'),
(14, 4, 'PRODUCTION ASSISTANT - PROMO', 'PA-PRO', '<p>WE ARE looking for young and highly motivated Millenials to join our team as Trainee. This program is designed to develop professional Digital Journalist person with multiplatform news which is television and online news portal. This program involves structure approach by combining in class enrichment and assignment at Metro TV and Medcom.id.</p>\n\n<p>Bachelor Degree majoring Broadcasting / Communication</p>\n\n<p>Strong interest in broadcast industry and promotion&nbsp;</p>\n\n<p>Good team player and willing to work in flexible long hours</p>\n\n<p>Good interpersonal and Communication Skill</p>\n\n<p>Good knowledge in&nbsp;editing software</p>\n\n<p>Good knowledge in microsoft office (excel)</p>\n', '2019-07-24 00:00:00', '2019-10-26 00:00:00', 1, 2, '2019-08-23 10:57:12', 2, '2019-09-03 04:55:54', 'ACTIVE', '7fa4879a91a664524a361e72f845d024.jpg'),
(16, NULL, 'ANY POSITION', 'ANY', '<p>WE ARE looking for young and highly motivated Millenials to join our team as Trainee. This program is designed to develop professional Digital Journalist person with multiplatform news which is television and online news portal. This program involves structure approach by combining in class enrichment and assignment at Metro TV and Medcom.id.</p>\n\n<p>Bachelor Degree from Reputable University</p>\n\n<p>Any major with minimum GPA 3.00</p>\n\n<p>Have strong interest in Broadcast and Media Industry</p>\n\n<p>Good Team Player and Achievement Orientation</p>\n\n<p>Energetic and Willing to Work in Flexible Long Hours</p>\n\n<p>Smart, Good Interpersonal and Communication Skill</p>\n\n<p>Strong Interest in Journalism</p>\n\n<p>Willing to Work in Working Bound</p>\n', '2019-07-02 00:00:00', '2019-09-27 00:00:00', 1, 2, '2019-09-13 09:46:51', 2, '2019-09-18 10:06:21', 'ACTIVE', '2c4d59dea34010273f6faa3ade07efd7.jpg'),
(43, 13, 'Sales', 'IDM-SA', '<p>asdasdad</p>\n\n<p>asda</p>\n', '2019-09-18 00:00:00', '2019-09-18 00:00:00', 1, 2, '2019-09-18 10:52:13', NULL, NULL, 'ACTIVE', '6fe5f2b02a58aaaf0412e8e7623ff841.png'),
(44, 15, 'Marketing Other', 'OTH-MAR', '<p>asd asd asd asd asd asd asdasdasdasdasd</p>\n', '2019-09-18 00:00:00', '2019-09-18 00:00:00', 1, 2, '2019-09-18 11:05:58', NULL, NULL, 'ACTIVE', 'ecc8896db3267c1c73c17c9d353c1047.png'),
(45, 14, 'WEB DESIGN', 'WEB', '<p>adsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsaf&nbsp;adsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsafadsfasdfa asdfasdf asdfasdfdas asdfasdfas adfadfadsf adsfadsaf</p>\n', '2019-09-20 00:00:00', '2019-10-29 00:00:00', 1, 2, '2019-09-20 06:06:42', NULL, NULL, 'ACTIVE', '25e8ba7703d3d53b4ca058df189e50c5.jpg'),
(46, 2, 'System Analysts', 'SA', '<p>Test</p>\n\n<p>setrd</p>\n\n<p>gdrg</p>\n\n<p>drg</p>\n\n<p>thfthdrtgwer</p>\n\n<p>ser</p>\n\n<p>s</p>\n\n<p>er</p>\n\n<p>ser</p>\n', '2019-09-01 00:00:00', '2019-09-30 00:00:00', 1, 2, '2019-10-07 04:50:03', NULL, NULL, 'ACTIVE', '3f6374435d04210120b2f298aa756af0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tr_vacant_group`
--

CREATE TABLE `tr_vacant_group` (
  `vacant_group_id` int(11) NOT NULL,
  `vacant_unit_id` int(11) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_vacant_group`
--

INSERT INTO `tr_vacant_group` (`vacant_group_id`, `vacant_unit_id`, `name`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`) VALUES
(2, 3, 'MIS', 2, '2019-08-21 04:58:33', 2, '2019-09-17 05:33:45', 0),
(3, 3, 'Digital Marketing', 2, '2019-08-21 04:58:41', 2, '2019-09-17 05:33:53', 0),
(4, 3, 'Journalist', 2, '2019-08-22 05:09:31', 2, '2019-09-17 05:33:58', 0),
(6, NULL, 'ANY GROUP', 2, '2019-09-13 09:45:21', NULL, NULL, 0),
(13, 5, 'asd', 2, '2019-09-18 10:20:35', 2, '2019-09-18 10:22:09', 0),
(14, 4, 'xxx', 2, '2019-09-18 10:21:08', 2, '2019-09-18 10:22:20', 0),
(15, 6, 'Other', 2, '2019-09-18 11:05:14', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tr_vacant_unit`
--

CREATE TABLE `tr_vacant_unit` (
  `vacant_unit_id` int(11) NOT NULL,
  `unit_name` varchar(300) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_vacant_unit`
--

INSERT INTO `tr_vacant_unit` (`vacant_unit_id`, `unit_name`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`) VALUES
(3, 'METRO TV', 2, '2019-09-02 04:19:16', NULL, NULL, 0),
(4, 'Medcom.id', 2, '2019-09-02 04:40:38', NULL, NULL, 0),
(5, 'iD.M', 2, '2019-09-02 04:41:15', NULL, NULL, 0),
(6, 'Other', 2, '2019-09-13 09:45:04', 2, '2019-09-18 11:04:23', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidat_achievement`
--
ALTER TABLE `candidat_achievement`
  ADD PRIMARY KEY (`achievement_id`);

--
-- Indexes for table `candidat_children`
--
ALTER TABLE `candidat_children`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `candidat_edu`
--
ALTER TABLE `candidat_edu`
  ADD PRIMARY KEY (`cedu_id`);

--
-- Indexes for table `candidat_family`
--
ALTER TABLE `candidat_family`
  ADD PRIMARY KEY (`family_id`);

--
-- Indexes for table `candidat_inf_edu`
--
ALTER TABLE `candidat_inf_edu`
  ADD PRIMARY KEY (`inf_edu_id`);

--
-- Indexes for table `candidat_lang`
--
ALTER TABLE `candidat_lang`
  ADD PRIMARY KEY (`clang_id`);

--
-- Indexes for table `candidat_organizational`
--
ALTER TABLE `candidat_organizational`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `candidat_references`
--
ALTER TABLE `candidat_references`
  ADD PRIMARY KEY (`cref_id`);

--
-- Indexes for table `candidat_work_exp`
--
ALTER TABLE `candidat_work_exp`
  ADD PRIMARY KEY (`work_exp_id`);

--
-- Indexes for table `tab_activity`
--
ALTER TABLE `tab_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `tab_candidat`
--
ALTER TABLE `tab_candidat`
  ADD PRIMARY KEY (`candidat_id`,`candidat_email`);

--
-- Indexes for table `tab_faq_general`
--
ALTER TABLE `tab_faq_general`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tab_kota`
--
ALTER TABLE `tab_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `tab_slideshow`
--
ALTER TABLE `tab_slideshow`
  ADD PRIMARY KEY (`slideshow_id`);

--
-- Indexes for table `tab_template`
--
ALTER TABLE `tab_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `tab_testimoni`
--
ALTER TABLE `tab_testimoni`
  ADD PRIMARY KEY (`testimoni_id`);

--
-- Indexes for table `tab_tipsntrick`
--
ALTER TABLE `tab_tipsntrick`
  ADD PRIMARY KEY (`tipsntrick_id`);

--
-- Indexes for table `tab_university`
--
ALTER TABLE `tab_university`
  ADD PRIMARY KEY (`university_id`);

--
-- Indexes for table `tab_user`
--
ALTER TABLE `tab_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `template_venue`
--
ALTER TABLE `template_venue`
  ADD PRIMARY KEY (`tv_id`);

--
-- Indexes for table `tr_applicant`
--
ALTER TABLE `tr_applicant`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `tr_vacant`
--
ALTER TABLE `tr_vacant`
  ADD PRIMARY KEY (`vacant_id`);

--
-- Indexes for table `tr_vacant_group`
--
ALTER TABLE `tr_vacant_group`
  ADD PRIMARY KEY (`vacant_group_id`);

--
-- Indexes for table `tr_vacant_unit`
--
ALTER TABLE `tr_vacant_unit`
  ADD PRIMARY KEY (`vacant_unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidat_achievement`
--
ALTER TABLE `candidat_achievement`
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidat_children`
--
ALTER TABLE `candidat_children`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidat_edu`
--
ALTER TABLE `candidat_edu`
  MODIFY `cedu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `candidat_family`
--
ALTER TABLE `candidat_family`
  MODIFY `family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `candidat_inf_edu`
--
ALTER TABLE `candidat_inf_edu`
  MODIFY `inf_edu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidat_lang`
--
ALTER TABLE `candidat_lang`
  MODIFY `clang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidat_organizational`
--
ALTER TABLE `candidat_organizational`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `candidat_references`
--
ALTER TABLE `candidat_references`
  MODIFY `cref_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidat_work_exp`
--
ALTER TABLE `candidat_work_exp`
  MODIFY `work_exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tab_activity`
--
ALTER TABLE `tab_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tab_candidat`
--
ALTER TABLE `tab_candidat`
  MODIFY `candidat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tab_faq_general`
--
ALTER TABLE `tab_faq_general`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tab_kota`
--
ALTER TABLE `tab_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tab_slideshow`
--
ALTER TABLE `tab_slideshow`
  MODIFY `slideshow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tab_template`
--
ALTER TABLE `tab_template`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tab_testimoni`
--
ALTER TABLE `tab_testimoni`
  MODIFY `testimoni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tab_tipsntrick`
--
ALTER TABLE `tab_tipsntrick`
  MODIFY `tipsntrick_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tab_university`
--
ALTER TABLE `tab_university`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `tab_user`
--
ALTER TABLE `tab_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_venue`
--
ALTER TABLE `template_venue`
  MODIFY `tv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tr_applicant`
--
ALTER TABLE `tr_applicant`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tr_vacant`
--
ALTER TABLE `tr_vacant`
  MODIFY `vacant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tr_vacant_group`
--
ALTER TABLE `tr_vacant_group`
  MODIFY `vacant_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tr_vacant_unit`
--
ALTER TABLE `tr_vacant_unit`
  MODIFY `vacant_unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
