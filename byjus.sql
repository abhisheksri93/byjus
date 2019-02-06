-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2019 at 01:54 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `byjus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_college`
--

CREATE TABLE `tbl_college` (
  `id` int(11) NOT NULL,
  `college_name` varchar(150) NOT NULL,
  `links` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_college`
--

INSERT INTO `tbl_college` (`id`, `college_name`, `links`) VALUES
(1, 'Acharya Narendra Dev College', 'http://andcollege.du.ac.in/ '),
(2, 'Aditi Mahavidyalaya', 'http://www.amv94.org/ '),
(3, 'Ahilya Bai College of Nursing', 'http://www.abconduadmission.in/ '),
(4, 'Amar Jyoti Institute of Physiotherapy', 'http://www.ajipt.org/ '),
(5, 'Aryabhatta College(Formally Ram Lal Anand College-Evg.)', 'http://aryabhattacollege.ac.in/ '),
(6, 'Atma Ram Sanatan Dharma College', 'http://arsdcollege.ac.in/ '),
(7, 'Ayurvedic & Unani Tibia College', 'http://google.com/'),
(8, 'Bhagini Nivedita College', 'http://www.bhagininiveditacollege.in/ '),
(9, 'Bharti College', 'https://www.bharaticollege.org/ '),
(10, 'Bhaskaracharya College of Applied Sciences', 'http://www.bcas.du.ac.in/ '),
(11, 'Bhim Rao Ambedkar College', 'http://www.drbrambedkarcollege.ac.in/ '),
(12, 'Chacha Nehru Bal Chikitsalaya', 'http://www.cnbchospital.in/ '),
(13, 'College of Nursing at Army Hospital (R&R)', 'http://google.com/'),
(14, 'Delhi Institute of Pharmaceutical Sciences and Research', 'http://www.dipsar.ac.in/ '),
(15, 'Deshbandhu College(Morning)', 'http://www.deshbandhucollege.ac.in/ '),
(16, 'Durga Bai Deshmukh College of Special Edu.(VI)', 'http://www.durgabaideshmukhcollege.org/ '),
(17, 'Dyal Singh College', 'http://www.dsc.du.ac.in/ '),
(18, 'Dyal Singh College (Evening)', 'http://www.dsc.du.ac.in/ '),
(19, 'Gargi College', 'http://gargi.du.ac.in/ '),
(20, 'Hans Raj College', 'http://www.hansrajcollege.ac.in/ '),
(21, 'Hindu College', 'http://www.hinducollege.ac.in/ '),
(22, 'Holy Family College of Nursing', 'http://google.com/'),
(23, 'Indira Gandhi Institute of Physical Education & Sports Sciences', 'http://igipess1.du.ac.in:8080/web/home_page.jsp '),
(24, 'Indraprastha College for Women', 'http://www.ipcollege.ac.in/ '),
(25, 'Institute of Home Economics', 'http://www.ihe-du.com/ '),
(26, 'Janki Devi Memorial College', 'http://jdm.du.ac.in/ '),
(27, 'Jesus & Mary College', 'http://www.jmc.ac.in/ '),
(28, 'Kalindi College for Women', 'http://kalindi.du.ac.in/ '),
(29, 'Kamla Nehru College for Women', 'http://www.knc.edu.in/ '),
(30, 'Keshav Mahavidyalaya', 'http://keshav.du.ac.in/ '),
(31, 'Kirori Mal College', 'http://www.kmcollege.ac.in/ '),
(32, 'Lady Hardinge Medical College', 'http://fmsc.ac.in/lady.htm '),
(33, 'Lady Irwin College', 'http://www.ladyirwin.edu.in/index.aspx '),
(34, 'Lady Shri Ram College for Women', 'http://google.com/'),
(35, 'Lakshmi Bai College for Women', 'https://lakshmibaicollege.in/'),
(36, 'Maharaja Agarsen College', 'http://mac.du.ac.in/ '),
(37, 'Maharshi Valmiki College of Education', 'http://www.mvce.ac.in/ '),
(38, 'Maitreyi College for Women', 'http://maitreyi.ac.in/ '),
(39, 'Mata Sundri College for Women', 'http://www.ms.du.ac.in/ '),
(40, 'Maulana Azad Institute of Dental Sciences', 'http://www.maids.ac.in/ '),
(41, 'Maulana Azad Medical College', 'http://www.mamc.ac.in/ '),
(42, 'Miranda House', 'http://www.mirandahouse.ac.in/ '),
(43, 'Moti Lal Nehru College', 'http://www.mlncdu.ac.in/ '),
(44, 'Moti Lal Nehru College (Evening)', 'http://www.mlnce.org/ '),
(45, 'Nehru Homeopathic Medical College &  Hospital', 'http://nhmc.delhigovt.nic.in/ '),
(46, 'Netaji Subhash Institute of Technology', 'http://www.nsit.ac.in/ '),
(47, 'P.G.D.A.V. College', 'http://pgdavcollege.edu.in/ '),
(48, 'P.G.D.A.V. College (Evening)', 'http://www.pgdaveve.in/ '),
(49, 'Pt. Deendayal Upadhyaya Institute of Physically Handicapped', 'http://iphnewdelhi.in/Home.aspx?ReturnUrl=%2f '),
(50, 'Rajdhani College', 'http://www.rajdhanicollege.ac.in/ '),
(51, 'Rajkumari Amrit Kaur College of Nursing', 'http://rakcon.com/ '),
(52, 'Ram Lal Anand College', 'https://rlacollege.edu.in/'),
(53, 'Ramanujan College', 'http://localhost/exam/byjus/'),
(54, 'Ramjas College', 'http://ramjas.du.ac.in/ '),
(55, 'Satyawati College', 'http://satyawati.du.ac.in/ '),
(56, 'Satyawati College (Evening)', 'http://satyawatievedu.ac.in/ '),
(57, 'School of Open Learning ( Erstwhile School of Correspondence &  Continuing Education)', 'https://sol.du.ac.in/welcome/english.php '),
(58, 'School of Rehabilitation Sciences', 'https://srs-mcmaster.ca/'),
(59, 'Shaheed Bhagat Singh College', 'http://www.sbsc.in/ '),
(60, 'Shaheed Bhagat Singh College (Evening)', 'http://www.sbsec.org/ '),
(61, 'Shaheed Rajguru College of Applied Sciences for Women', 'http://www.rajgurucollege.com/ '),
(62, 'Shaheed Sukhdev College of Business Studies', 'http://du.ac.in/'),
(63, 'Shivaji College', 'http://www.shivajicollege.ac.in/ '),
(64, 'Shri Ram College of Commerce', 'http://www.srcc.edu/ '),
(65, 'Shyam Lal College', 'http://du.ac.in/'),
(66, 'Shyam Lal College (Evening)', 'http://shyamlale.du.ac.in/ '),
(67, 'Shyama Prasad Mukherji College for Women', 'http://spm.du.ac.in/index.php?lang=en '),
(68, 'Sri Aurobindo College', 'http://www.aurobindo.du.ac.in/ '),
(69, 'Sri Aurobindo College (Evening)', 'https://www.saceve.in/ '),
(70, 'Sri Guru Gobind Singh College of Commerce', 'http://www.sggscc.ac.in/ '),
(71, 'Sri Guru Nanak Dev Khalsa College', 'http://sgndkc.org/ '),
(72, 'Sri Guru Tegh Bahadur Khalsa College', 'http://www.sgtbkhalsadu.ac.in/ '),
(73, 'Sri Venkateswara College', 'http://www.svc.ac.in/ '),
(74, 'St. Stephen''s College', 'https://ststephens.edu/'),
(75, 'Swami Shraddhanand College', 'http://www.ssncollege.com/ '),
(76, 'University College of Medical Sciences', 'http://www.ssncollege.com/ '),
(77, 'Vallabhbhai Patel Chest Institute', 'http://www.vpci.org.in/ '),
(78, 'Vivekananda College', 'http://vivekanandacollege.edu.in/ '),
(79, 'Zakir Husain Delhi College', 'http://www.zakirhusaindelhicollege.ac.in/ '),
(80, 'Zakir Husain Post Graduate Evening College', 'http://www.zakirhusainpgeve.in/ '),
(81, 'National Institute of Health &  Family Welfare', 'http://www.nihfw.org/ '),
(82, 'Kasturba Hospital', 'https://nhp.gov.in/'),
(83, 'Institute of Human Behaviour &  Allied Sciences', 'http://www.ihbas.delhigovt.nic.in/ '),
(84, 'G.B. Pant Hospital', 'http://gbpant.delhigovt.nic.in/ '),
(85, 'All India Institute of Ayurveda', 'http://www.aiia.co.in/ ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `userName` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `userName`, `email`, `mobile`) VALUES
(1, 'ndLN1ds', 'qN_K383Y5qHo1K1hxtDPyqfU6dze5J3OndCZ6w', 'bqSSmp2Vo3Gmqg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_college`
--
ALTER TABLE `tbl_college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_college`
--
ALTER TABLE `tbl_college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
