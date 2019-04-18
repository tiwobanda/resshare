-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2019 at 04:32 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resshare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `grp_id` int(10) NOT NULL,
  `grp_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`grp_id`, `grp_name`) VALUES
(9, 'Group Alpha'),
(10, 'Group Beta'),
(11, 'Group April'),
(12, 'Group Echo');

-- --------------------------------------------------------

--
-- Table structure for table `grp_members`
--

CREATE TABLE `grp_members` (
  `grp_id` int(10) NOT NULL,
  `student_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grp_members`
--

INSERT INTO `grp_members` (`grp_id`, `student_id`) VALUES
(6, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecturer_id` int(9) NOT NULL,
  `title` varchar(6) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `school` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecturer_id`, `title`, `fname`, `lname`, `email`, `school`) VALUES
(41, 'Prof', 'Joy', 'Kha', 'joy@gmail.com', 'CSDM'),
(42, 'Prof', 'Teacher', 'Kaluwa', 'teacher@gmail.com', 'CSDM'),
(43, 'Prof', 'George', 'Kaluba', 'gkaluba@gmail.com', 'CSDM'),
(45, 'Prof', 'Albert', 'Mofolo', 'mofolo@gmail.com', 'Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `pp_id` int(9) NOT NULL,
  `pp_title` varchar(255) NOT NULL,
  `pp_author` varchar(100) NOT NULL,
  `student_id` int(9) NOT NULL,
  `grp_id` int(9) NOT NULL,
  `path` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`pp_id`, `pp_title`, `pp_author`, `student_id`, `grp_id`, `path`, `date`) VALUES
(1, 'One upon a time in the city of Watchmovia', 'Albert Watch', 6, 11, '../uploads/8542185288-471288-1-SM.pdf', '2019-04-03 23:00:00'),
(2, 'And then there was X', 'George Lampedusa', 6, 11, '../uploads/9690185288-471288-1-SM.pdf', '2019-04-04 21:38:36'),
(3, 'There was a man in Palestine', 'Yousef Jalal', 6, 11, '../uploads/1428185288-471288-1-SM.pdf', '2019-04-04 21:45:45'),
(4, 'Long-range angular correlations on the near and away side in pâ€“Pb collisions at sNN= 5.02 TeV', 'Roberto Barbera', 11, 10, '../uploads/75211-s2.0-S037026931300035X-main.pdf', '2019-04-05 19:38:37'),
(5, 'Global linkages over broadband links', 'Camilo Castelli', 12, 10, '../uploads/51761-s2.0-S037026931300035X-main.pdf', '2019-04-11 21:13:11'),
(6, 'Factors influencing the performance of safety programmes in the Ghanaian construction industry', 'Kofi Agyekum', 13, 10, '../uploads/9052180639-460909-1-SM.pdf', '2019-04-11 22:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(9) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `grp_id` int(10) DEFAULT NULL,
  `student_role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `fname`, `lname`, `email`, `grp_id`, `student_role`) VALUES
(3, 'Jos', 'Phi', 'jos@gmail.com', 9, NULL),
(4, 'Dien', 'Bien Phu', 'dien@gmail.com', 9, 'Group Leader'),
(5, 'Abdoul', 'Abdoul', 'abdoul@gmail.com', 9, NULL),
(6, 'Test', 'Student', 'student@gmail.com', 11, 'Group Leader'),
(11, 'Giovanni', 'Banda', 'giovanni@gmail.com', 10, NULL),
(12, 'Milca', 'Banda', 'milca@banda.me', 10, 'Group Leader'),
(13, 'Thomson', 'Bulk', 'thomson@gmail.com', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `user_cat`) VALUES
('abdoul@gmail.com', '$2y$10$OlEjbr2L0bpwg./Q7eIH6.Hv24Nq/IstObpYqqjqjQZsnSSY.wDoi', 'Student'),
('dien@gmail.com', '$2y$10$OMLIhFjsKpiufEBO9NGBm.VGua1XeXLe7pC3loceLG9fsh/8B45SW', 'Student'),
('father@radovani.com', '$2y$10$LENIm7lcP54.52Ha0j3ISOo22hFQWL3TS6ZEBGNAoyGor5TCFd4dq', 'Lecturer'),
('giovanni@gmail.com', '$2y$10$IqbNSmeIPalVJmlczkVV5Oki7Q7sPRlVP3pV90/LB1LUJo5DEHOYu', 'Student'),
('gkaluba@gmail.com', '$2y$10$2HawbjtsyzTTP40LwLegU.tgALpJaD/ylY/8L0evHf5XEthl4.iZq', 'Lecturer'),
('jos@gmail.com', '$2y$10$RGnFPvUIlm8tOJfk4xrISOULkZJw7tG5oTITh5PF2PPCKNzx1km4i', 'Student'),
('joy@gmail.com', '$2y$10$TvdxNhSUUBM41HyP3wz6eutS6RDrZbitUHCGW3WqNcYl97qnQy5MC', 'Lecturer'),
('milca@banda.me', '$2y$10$MOzqIsuGehc.NkLRO24vZ.L.sTz6HxdNqx9122SYnp0HiDgmfb/SW', 'Student'),
('mofolo@gmail.com', '$2y$10$/tjPCcKMSfmwuMMBvhJepuPkoznoztKvKH/aDkhuyEvUoh4//VI66', 'Lecturer'),
('student@gmail.com', '$2y$10$7qrqFkjL8ru7xhH4EYlRluj0/yhlx4M7mMufeA6W/aRMZSuk/FjfK', 'Student'),
('teacher@gmail.com', '$2y$10$Iv7soDmYS0uvQCVotDv1J.GrnB92ImEs9ILWahOsKFiKCrhIp9QDi', 'Lecturer'),
('thomson@gmail.com', '$2y$10$bu2IZOgFb7OAu4KqPeD3AOBcs5m1Vi4X5ZnYvPFT0t4Rs1QBhGOia', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD UNIQUE KEY `grp_id` (`grp_id`) USING BTREE;

--
-- Indexes for table `grp_members`
--
ALTER TABLE `grp_members`
  ADD KEY `grp_id_fk` (`grp_id`),
  ADD KEY `student_id_fk` (`student_id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecturer_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`pp_id`),
  ADD KEY `grp_id_fk` (`grp_id`),
  ADD KEY `student_id_papers_fk` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_email_fk` (`email`),
  ADD KEY `group_id_fk` (`grp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `grp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lecturer_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `pp_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grp_members`
--
ALTER TABLE `grp_members`
  ADD CONSTRAINT `student_id_fk` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `lecturer_email_fk` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `papers`
--
ALTER TABLE `papers`
  ADD CONSTRAINT `grp_id_fk` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`),
  ADD CONSTRAINT `student_id_papers_fk` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `group_id_fk` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`),
  ADD CONSTRAINT `student_email_fk` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
