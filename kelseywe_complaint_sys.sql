-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2022 at 02:12 PM
-- Server version: 5.7.36
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelseywe_complaint_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `phone_no` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `name`, `username`, `email`, `photo`, `phone_no`, `password`) VALUES
(1, 'YabaTech Complaint System', 'Matryx', 'franklynnnolukachukwudalu@gmail.com', '165777591837028.png', '09092588828', '$2y$12$00okN2MxMTBlYzhlYmEyNO6mv/XkYVyHOXW9Amj5QvCH4CtGldh1q');

-- --------------------------------------------------------

--
-- Table structure for table `admin_messages`
--

CREATE TABLE `admin_messages` (
  `id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `message_content` text NOT NULL,
  `date_received` varchar(200) NOT NULL,
  `complaint_no` int(11) NOT NULL,
  `is_read` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_messages`
--

INSERT INTO `admin_messages` (`id`, `user`, `message_content`, `date_received`, `complaint_no`, `is_read`) VALUES
(6, 'Frank', '<p>Hello, YabaTecm Complaint System, a new complaint has been made by Chukwudalu Frank  with complaint no: #5566138. Please visit the complaint page for more details. The Matryx Net Team.</p>', 'Jul 12, 2022 at 05:01pm', 5566138, 'yes'),
(7, 'Joe', '<p>Hello, YabaTecm Complaint System, a new complaint has been made by Onwuatuelo Joseph  with complaint no: #8398602. Please visit the complaint page for more details. The Matryx Net Team.</p>', 'Jul 12, 2022 at 05:26pm', 8398602, 'yes'),
(8, 'Frank', '<p>Hello, YabaTech Complaint System, a new reply have been made to the complaint with complaint no: #5566138. Please visit the complaint page for more details.</p>', 'Jul 14, 2022 at 06:33am', 5566138, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `complaint_number` varchar(100) NOT NULL,
  `matric_no` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `subcategory` varchar(200) NOT NULL,
  `urgency` varchar(100) NOT NULL,
  `complaint_message` longtext NOT NULL,
  `complaint_file` varchar(200) NOT NULL,
  `reg_date` varchar(200) NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'Open',
  `last_modified` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `studentID`, `title`, `complaint_number`, `matric_no`, `category`, `subcategory`, `urgency`, `complaint_message`, `complaint_file`, `reg_date`, `status`, `last_modified`, `email`) VALUES
(13, 4, 'Flooded classroom', '8269374', 'P/ND/19/3210191', '1', '1', 'critical', '<p>On the 7th of July, when i got to my classroom, the whole classroom was flooded, we couldn&#39;t have our lecturers that day because of the situation. Please, we need it sorted out as quickly as possible, so we can go back having our lecturers. Thanks in anticipation.</p>', '', 'Jul 12, 2022 at 03:48pm', 'Open', 'Jul 12, 2022 at 03:48pm', 'franklynnnolukachukwudalu@gmail.com'),
(14, 5, 'Harassment from security personnel ', '5566138', 'P/ND/19/3210001', '1', '2', 'medium', '<p>I was harassed by one of the securitymen in school today. I was able to catch his name, Mr. Kayode was asking me for money, else I won&#39;t be allowed inside the school, i had to give him a token of â‚¦500 before i was allowed entry into the school. Please, look into this. Thanks in anticipation.&nbsp;</p>', '', 'Jul 12, 2022 at 05:01pm', 'Open', 'Jul 14, 2022 at 06:33am', 'nnolukafranklyn@gmail.com'),
(15, 6, 'PC UPGRADING', '8398602', 'P/ND/19/3210195', '2', '3', 'critical', '<p>Hello,</p><p>Concerning the Last Exam, we had a course which units was 3 (PC UPGRADING).</p><p>We were given a shortage of 2 hrs in the exam to finish up which affected most results.<br /><br />Please treats this as urgent.</p><p>Thanks</p>', '165764320448463.jpg', 'Jul 12, 2022 at 05:26pm', 'Open', 'Jul 12, 2022 at 05:26pm', 'joedeola@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `complaints_category`
--

CREATE TABLE `complaints_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints_category`
--

INSERT INTO `complaints_category` (`id`, `name`) VALUES
(1, 'Administrative'),
(2, 'Academics');

-- --------------------------------------------------------

--
-- Table structure for table `complaints_subcategory`
--

CREATE TABLE `complaints_subcategory` (
  `subcatid` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcatname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints_subcategory`
--

INSERT INTO `complaints_subcategory` (`subcatid`, `category_id`, `subcatname`) VALUES
(1, 1, 'lecturer didn\'t attend lecture'),
(2, 1, 'harassment'),
(3, 2, 'missing score'),
(4, 2, 'School Fees');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_replies`
--

CREATE TABLE `complaint_replies` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `complaint_no` varchar(100) NOT NULL,
  `matric_no` varchar(100) NOT NULL,
  `complaint_message` text NOT NULL,
  `complaint_reply_message` text NOT NULL,
  `replied_by` varchar(100) NOT NULL,
  `last_updated` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Open',
  `new_complaint_file` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_replies`
--

INSERT INTO `complaint_replies` (`id`, `student_id`, `complaint_no`, `matric_no`, `complaint_message`, `complaint_reply_message`, `replied_by`, `last_updated`, `status`, `new_complaint_file`, `username`) VALUES
(4, 2, '7970202', 'P/ND/19/3210191', '<p>Our statistics lecturer did not come to class when he was supposed to.</p>', '<p>This is a new reply to my previous complain about the lecturer not coming to class. I was reported by some students and now am facing another trouble.<br />&nbsp;</p>', 'Kelsey Great', 'Jul 05, 2022 at 08:39pm', 'Open', '', 'kelsey'),
(5, 2, '7970202', 'P/ND/19/3210191', '<p>Our statistics lecturer did not come to class when he was supposed to.</p>', '<p>We are very sorry you have to face this issue <strong>Kelsey Great</strong>. Be rest assured that the management is doing every possible to profer a solution to this problem. The lecturer in question has already been summoned by the school board. Thanks for bringing this vital information to our notice.<br />&nbsp;</p>', 'Matryx', 'Jul 05, 2022 at 09:30pm', 'Open', '', 'kelsey'),
(6, 2, '7970202', 'P/ND/19/3210191', '<p>Our statistics lecturer did not come to class when he was supposed to.</p>', '<p>Thanks for your assistance, am realy glad you were able to help. i appreciate it.</p>', 'Kelsey Great', 'Jul 11, 2022 at 12:51am', 'Open', '', 'kelsey'),
(7, 2, '8700626', 'P/ND/19/3210191', '<p>Hello, pls I wish to bring to your notice that my entire firrst semester is missing.Â </p>', '<p>This is a follow up message on my previous message. I am yet to receive a reply to my earlier message.</p>', 'Kelsey Great', 'Jul 11, 2022 at 01:44am', 'Open', '', 'kelsey'),
(8, 2, '8700626', 'P/ND/19/3210191', '<p>Hello, pls I wish to bring to your notice that my entire firrst semester is missing.Â </p>', '<p>I noticed no reply has been made to my message yet. Pls try and reply my message. Thanks.</p>', 'Kelsey Great', 'Jul 11, 2022 at 07:40pm', 'Open', '', 'kelsey'),
(9, 2, '8700626', 'P/ND/19/3210191', '<p>Hello, pls I wish to bring to your notice that my entire firrst semester is missing.Â </p>', '<p>I am again yet to still receive a reply to my message. Patiently waiting for reply to be made. Sincere regards.&nbsp;</p>', 'Kelsey Great', 'Jul 11, 2022 at 07:44pm', 'Open', '', 'kelsey'),
(10, 2, '4536284', 'P/ND/19/3210191', '<p>School Fees payment not approved please I need an assistance.</p>', '<p>We have received your complaint Kelsey. Pls be restb assurred that our team will look into it as soon as possible. Thanks for yourn patient.&nbsp;</p>', 'Kelsey Great', 'Jul 12, 2022 at 01:55pm', 'Open', '', 'Matryx'),
(11, 2, '4536284', 'P/ND/19/3210191', '<p>School Fees payment not approved please I need an assistance.</p>', '<p>I will get it resolved</p>', 'Kelsey Great', 'Jul 12, 2022 at 02:07pm', 'Open', '', 'Matryx'),
(12, 2, '8700626', 'P/ND/19/3210191', '<p>Hello, pls I wish to bring to your notice that my entire firrst semester is missing.Â </p>', '<p>We&#39;re sincerely sorry for the missing marks in your result, you can be rest assured that we&#39;d get to it and correct it as soon as possible.</p>', 'Matryx Network', 'Jul 12, 2022 at 03:30pm', 'Open', '', 'Matryx'),
(13, 4, '8269374', 'P/ND/19/3210191', '<p>On the 7th of July, when i got to my classroom, the whole classroom was flooded, we couldn\'t have our lecturers that day because of the situation. Please, we need it sorted out as quickly as possible, so we can go back having our lecturers. Thanks in anticipation.</p>', '<p>We have received your complaint Franklyn. We are working on proferring a solution as soon as possible.</p>', 'YabaTech Complaint System', 'Jul 12, 2022 at 04:59pm', 'Open', '', 'Matryx'),
(14, 5, '5566138', 'P/ND/19/3210001', '<p>I was harassed by one of the securitymen in school today. I was able to catch his name, Mr. Kayode was asking me for money, else I won\'t be allowed inside the school, i had to give him a token of â‚¦500 before i was allowed entry into the school. Please, look into this. Thanks in anticipation.Â </p>', '<p>Thank you for bringing this to our notice, we&#39;ll surely investigate this and get back to you. Sorry for the inconveniences.</p>', 'YabaTech Complaint System', 'Jul 12, 2022 at 05:07pm', 'Open', '', 'Matryx'),
(15, 6, '8398602', 'P/ND/19/3210195', '<p>Hello,</p><p>Concerning the Last Exam, we had a course which units was 3 (PC UPGRADING).</p><p>We were given a shortage of 2 hrs in the exam to finish up which affected most results.<br /><br />Please treats this as urgent.</p><p>Thanks</p>', '<p>Thank you for bringing this to our knowledge, Joseph. What was the name of the hall you wrote your exam? We need it for our investigation.</p>', 'YabaTech Complaint System', 'Jul 12, 2022 at 05:28pm', 'Open', '', 'Matryx'),
(16, 4, '8269374', 'P/ND/19/3210191', '<p>On the 7th of July, when i got to my classroom, the whole classroom was flooded, we couldn\'t have our lecturers that day because of the situation. Please, we need it sorted out as quickly as possible, so we can go back having our lecturers. Thanks in anticipation.</p>', '<p>We are sorry for the incovenience the flooded classroon has caused you. I am happy to inform you that it has been resolved</p>', 'YabaTech Complaint System', 'Jul 14, 2022 at 06:21am', 'Open', '', 'Matryx'),
(17, 5, '5566138', 'P/ND/19/3210001', '<p>I was harassed by one of the securitymen in school today. I was able to catch his name, Mr. Kayode was asking me for money, else I won\'t be allowed inside the school, i had to give him a token of â‚¦500 before i was allowed entry into the school. Please, look into this. Thanks in anticipation.Â </p>', '<p>The same thing happend today again, i had to give the same man some money before iwas allowed entry into school. I though you said you working on it</p>', 'Chukwudalu Frank', 'Jul 14, 2022 at 06:33am', 'Open', '', 'Frank');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `message_sender` varchar(200) NOT NULL,
  `message_content` text NOT NULL,
  `date_received` varchar(150) NOT NULL,
  `complaint_no` int(11) NOT NULL,
  `is_read` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user`, `message_sender`, `message_content`, `date_received`, `complaint_no`, `is_read`) VALUES
(1, 'kelsey', 'Matryx', 'Hello, Kelsey, a new reply have been made to your complaint with complaint no: #7970202. Please click this link to visit the complaint page.\r\n\r\nThe Matryx Net. Admin', 'Jul 07, 2022 at 07:02pm', 7970202, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `icon`, `link`) VALUES
(1, 'dashboard', 'fas fa-tachometer-alt', 'index'),
(2, 'All Complaints', 'fas fa-bullhorn', 'complaints'),
(3, 'Add Complaint', 'fas fa-plus', 'add-complaint'),
(4, 'Contact', 'fas fa-phone', 'contact'),
(5, 'Logout', 'fas fa-lock', 'logout'),
(6, 'My Profile', 'fas fa-user', 'profile'),
(7, 'Messages', 'fas fa-comments', 'messages'),
(8, 'Edit Profile', 'mdi mdi-pencil', 'edit-profile'),
(9, 'Change Password', 'mdi mdi-lock', 'change-password'),
(10, 'Delete my Account', 'mdi mdi-delete', 'delete-account');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verify_id` varchar(200) NOT NULL,
  `code_expire` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`id`, `user_id`, `email`, `verify_id`, `code_expire`) VALUES
(1, 2, 'kelseygreat@gmail.com', '84cabba5a72c30d4d21bb63a8afb4ef51f8acf0af4a7ece58c9c9adcfe69efdaccfae258c678fff2', 'July 12, 2022 09:51am'),
(2, 2, 'kelseygreat@gmail.com', 'fda0a2be9958ecb4ccb5bdf9a6c6fa50884fad2fcf3b521dfc850f8fb690281726a7ff4ccfcd5e1a', 'July 12, 2022 10:03am'),
(3, 2, 'kelseygreat@gmail.com', '10f60117daafae23ef0591732bed34ec2f73a7c9daa415dbd2473f1d785748f7f6d5bee54eff134d', 'July 12, 2022 10:13am'),
(4, 5, 'nnolukafranklyn@gmail.com', '275eeba497b6e4f528fd05f4ff0c67bad2edee42e74a5cd139a359201075837a5477073d8b0273c2', 'July 12, 2022 05:06pm'),
(5, 5, 'nnolukafranklyn@gmail.com', '605799576cd0abc57f930113cdc5fba03a74c46737da8f0c20a52f33232aa0ae483240d6bc74cdde', 'July 12, 2022 05:06pm');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `studentID` int(11) NOT NULL,
  `matric_no` varchar(200) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `password` varchar(260) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `account_status` varchar(40) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`studentID`, `matric_no`, `name`, `username`, `email`, `phone_no`, `password`, `photo`, `account_status`) VALUES
(4, 'P/ND/19/3210191', 'Franklyn C. Nnoluka ', 'Dacole ', 'franklynnnolukachukwudalu@gmail.com', '09092588828', '$2y$12$00okMzM5NzM1MDhjNjM4ZOXDHHSj/SFzIcUIFIjyXgQPqc7n6opCe', '', 'active'),
(5, 'P/ND/19/3210001', 'Chukwudalu Frank', 'Frank', 'nnolukafranklyn@gmail.com', '07043624154', '$2y$12$00okMDI2M2M3ODA4Yzk0Z.k2G1/nBD/B1cCaKk/siDEH1qZIBcaIS', '165777671220441.jpg', 'active'),
(6, 'P/ND/19/3210195', 'Onwuatuelo Joseph', 'Joe', 'joedeola@gmail.com', '', '$2y$12$00okZDZlMGQ2MGQyOTZkNuuzj27Vu5Y9v8HT4fRxtQ9pBkEi.nOzS', '', 'active'),
(7, 'P/nd/20/3620600', 'Adigun oluwadamilola', 'Oluwadamilola', 'damiloladigun020@gmail.com', '', '$2y$12$00okNDFhMTUyMzhiNTc4MugirPYI6zfQnAJOFu9JAj5G0zfDWqgXC', '', 'active'),
(8, '007', 'Whoknows', 'Sabi boy', 'knowsall@gmail.com', '', '$2y$12$00okN2ZiMWM3YWVmMzlkYuMBB3v/yI/8VTGgXiL2hGRtuTeJZMzRW', '', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `admin_messages`
--
ALTER TABLE `admin_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints_category`
--
ALTER TABLE `complaints_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints_subcategory`
--
ALTER TABLE `complaints_subcategory`
  ADD PRIMARY KEY (`subcatid`);

--
-- Indexes for table `complaint_replies`
--
ALTER TABLE `complaint_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_messages`
--
ALTER TABLE `admin_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `complaints_category`
--
ALTER TABLE `complaints_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaints_subcategory`
--
ALTER TABLE `complaints_subcategory`
  MODIFY `subcatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complaint_replies`
--
ALTER TABLE `complaint_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
