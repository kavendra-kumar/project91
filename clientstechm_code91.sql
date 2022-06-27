-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 24, 2022 at 02:45 PM
-- Server version: 10.3.34-MariaDB-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clientstechm_code91`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_exam`
--

CREATE TABLE `admin_exam` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_color` varchar(20) NOT NULL,
  `event_note` text NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date DEFAULT NULL,
  `date_array` text NOT NULL,
  `end_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_repeat_option` varchar(30) NOT NULL,
  `event_allDay` varchar(10) NOT NULL,
  `event_reminder` varchar(30) NOT NULL,
  `draggable_event` varchar(10) NOT NULL,
  `draggable_id` varchar(10) NOT NULL,
  `task_note` text NOT NULL,
  `task_start_date` date NOT NULL,
  `task_start_time` time NOT NULL,
  `task_repeat_option` varchar(30) NOT NULL,
  `task_allDay` varchar(10) NOT NULL,
  `task_reminder` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `reminded` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_exam`
--

INSERT INTO `admin_exam` (`id`, `student_id`, `event_name`, `event_color`, `event_note`, `event_start_date`, `event_end_date`, `date_array`, `end_date`, `event_start_time`, `event_end_time`, `event_repeat_option`, `event_allDay`, `event_reminder`, `draggable_event`, `draggable_id`, `task_note`, `task_start_date`, `task_start_time`, `task_repeat_option`, `task_allDay`, `task_reminder`, `type`, `reminded`, `status`, `date`) VALUES
(1, 1, 'Zohar', 'bg-danger', 'chk', '2022-05-20', '2022-05-20', '[\"2022-05\"]', '2022-05-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-05-20 12:00:51'),
(2, 1, 'Biology System', 'bg-success', 'tets', '2022-05-01', '2022-05-01', '[\"2022-05\"]', '2022-05-01', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-05-20 12:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `confidence_level`
--

CREATE TABLE `confidence_level` (
  `id` int(11) NOT NULL,
  `level` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `confidence_level`
--

INSERT INTO `confidence_level` (`id`, `level`, `status`, `date`) VALUES
(1, 'Beginner', 'active', '2021-04-08 17:56:05'),
(2, 'Intermediate', 'active', '2021-04-08 17:56:05'),
(3, 'Advanced', 'active', '2021-04-08 17:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `status`, `date`) VALUES
(1, 'Step 1', 'active', '2021-04-08 17:56:05'),
(2, 'Step 2 CK', 'active', '2021-04-08 17:56:05'),
(3, 'Step 3', 'active', '2021-04-08 17:56:05'),
(4, 'MCAT', 'active', '2021-04-08 17:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `daily_activities`
--

CREATE TABLE `daily_activities` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `daily_activity` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_activities`
--

INSERT INTO `daily_activities` (`id`, `student_id`, `daily_activity`, `status`, `date`) VALUES
(1, 0, 'Namaz', 'active', '2021-04-22 14:10:43'),
(2, 0, 'Breakfast', 'active', '2021-04-22 14:10:43'),
(3, 0, 'Exercise', 'active', '2021-04-22 14:10:43'),
(4, 0, 'Meeting', 'active', '2021-04-22 14:10:43'),
(5, 0, 'Lunch', 'active', '2021-04-22 14:10:43'),
(6, 0, 'Fajr', 'active', '2021-04-22 14:10:43'),
(7, 0, 'Nap', 'active', '2021-04-22 14:10:43'),
(8, 0, 'Asr', 'active', '2021-04-22 14:10:43'),
(9, 0, 'Playing', 'active', '2021-04-22 14:10:43'),
(10, 0, 'Magrib', 'active', '2021-04-22 14:10:43'),
(11, 0, 'Dinner', 'active', '2021-04-22 14:10:43'),
(12, 0, 'Esha', 'active', '2021-04-22 14:10:43'),
(13, 0, 'Sleeping', 'active', '2021-04-22 14:10:43'),
(14, 0, 'Reading', 'active', '2021-04-22 15:24:22'),
(15, 0, 'Jogging', 'active', '2021-04-22 15:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `draggable_events`
--

CREATE TABLE `draggable_events` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_color` varchar(20) NOT NULL,
  `event_note` text NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_repeat_option` varchar(30) NOT NULL,
  `event_allDay` varchar(30) NOT NULL,
  `event_reminder` varchar(30) NOT NULL,
  `show_draggable_event` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `draggable_events`
--

INSERT INTO `draggable_events` (`id`, `student_id`, `event_name`, `event_color`, `event_note`, `event_start_date`, `event_end_date`, `event_start_time`, `event_end_time`, `event_repeat_option`, `event_allDay`, `event_reminder`, `show_draggable_event`, `status`, `date`) VALUES
(3, 1, 'chk', 'bg-success', 'test', '2022-05-06', '0000-00-00', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 1, 'active', '2022-05-06 19:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE `duration` (
  `id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duration`
--

INSERT INTO `duration` (`id`, `time`, `status`, `date`) VALUES
(1, '0 mins', 'active', '2021-10-25 11:15:12'),
(2, '15 mins', 'active', '2021-10-25 11:15:12'),
(3, '30 mins', 'active', '2021-10-25 11:15:12'),
(4, '45 mins', 'active', '2021-10-25 11:15:12'),
(5, '1 hr', 'active', '2021-10-25 11:15:12'),
(6, '1.5 hrs', 'active', '2021-10-25 11:15:12'),
(7, '2 hrs', 'active', '2021-10-25 11:15:12'),
(8, '2.5 hrs', 'active', '2021-10-25 11:15:12'),
(9, '3 hrs', 'active', '2021-10-25 11:15:12'),
(10, '3.5 hrs', 'active', '2021-10-25 11:15:12'),
(11, '4 hrs', 'active', '2021-10-25 11:15:12'),
(12, '4.5 hrs', 'active', '2021-10-25 11:15:12'),
(13, '5 hrs', 'active', '2021-10-25 11:15:12'),
(14, '5.5 hrs', 'active', '2021-10-25 11:15:12'),
(15, '6 hrs', 'active', '2021-10-25 11:15:12'),
(16, '6.5 hrs', 'active', '2021-10-25 11:15:12'),
(17, '7 hrs', 'active', '2021-10-25 11:15:12'),
(18, '7.5 hrs', 'active', '2021-10-25 11:15:12'),
(19, '8 hrs', 'active', '2021-10-25 11:15:12'),
(20, '8.5 hrs', 'active', '2021-10-25 11:15:12'),
(21, '9 hrs', 'active', '2021-10-25 11:15:12'),
(22, '9.5 hrs', 'active', '2021-10-25 11:15:12'),
(23, '10 hrs', 'active', '2021-10-25 11:15:12'),
(24, '10.5 hrs', 'active', '2021-10-25 11:15:12'),
(25, '11 hrs', 'active', '2021-10-25 11:15:12'),
(26, '11.5 hrs', 'active', '2021-10-25 11:15:12'),
(27, '12 hrs', 'active', '2021-10-25 11:15:12'),
(28, '12.5 hrs', 'active', '2021-10-25 11:15:12'),
(29, '13 hrs', 'active', '2021-10-25 11:15:12'),
(30, '13.5 hrs', 'active', '2021-10-25 11:15:12'),
(31, '14 hrs', 'active', '2021-10-25 11:15:12'),
(32, '14.5 hrs', 'active', '2021-10-25 11:15:12'),
(33, '15 hrs', 'active', '2021-10-25 11:15:12'),
(34, '15.5 hrs', 'active', '2021-10-25 11:15:12'),
(35, '16 hrs', 'active', '2021-10-25 11:15:12'),
(36, '16.5 hrs', 'active', '2021-10-25 11:15:12'),
(37, '17 hrs', 'active', '2021-10-25 11:15:12'),
(38, '17.5 hrs', 'active', '2021-10-25 11:15:12'),
(39, '18 hrs', 'active', '2021-10-25 11:15:12'),
(40, '18.5 hrs', 'active', '2021-10-25 11:15:12'),
(41, '19 hrs', 'active', '2021-10-25 11:15:12'),
(42, '19.5 hrs', 'active', '2021-10-25 11:15:12'),
(43, '20 hrs', 'active', '2021-10-25 11:15:12'),
(44, '20.5 hrs', 'active', '2021-10-25 11:15:12'),
(45, '21 hrs', 'active', '2021-10-25 11:15:12'),
(46, '21.5 hrs', 'active', '2021-10-25 11:15:12'),
(47, '22 hrs', 'active', '2021-10-25 11:15:12'),
(48, '22.5 hrs', 'active', '2021-10-25 11:15:12'),
(49, '23 hrs', 'active', '2021-10-25 11:15:12'),
(50, '23.5 hrs', 'active', '2021-10-25 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_color` varchar(20) NOT NULL,
  `event_note` text NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `date_array` text NOT NULL,
  `end_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_repeat_option` varchar(30) NOT NULL,
  `event_allDay` varchar(10) NOT NULL,
  `event_reminder` varchar(30) NOT NULL,
  `draggable_event` varchar(10) NOT NULL,
  `draggable_id` varchar(10) NOT NULL,
  `task_note` text NOT NULL,
  `task_start_date` date NOT NULL,
  `task_start_time` time NOT NULL,
  `task_repeat_option` varchar(30) NOT NULL,
  `task_allDay` varchar(10) NOT NULL,
  `task_reminder` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `reminded` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `student_id`, `event_name`, `event_color`, `event_note`, `event_start_date`, `event_end_date`, `date_array`, `end_date`, `event_start_time`, `event_end_time`, `event_repeat_option`, `event_allDay`, `event_reminder`, `draggable_event`, `draggable_id`, `task_note`, `task_start_date`, `task_start_time`, `task_repeat_option`, `task_allDay`, `task_reminder`, `type`, `reminded`, `status`, `date`) VALUES
(2, 1, 'Jogging', 'bg-danger', '', '2022-03-08', '2022-03-08', '[\"2022-03\"]', '2022-03-08', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '1', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-03-07 15:07:04'),
(3, 1, 'yuyu', 'bg-danger', 'yuyu', '2022-05-03', '2022-05-03', '[\"2022-05\"]', '2022-05-03', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-05-23 11:43:00'),
(4, 1, 'Respiratory System', 'bg-success', 'test', '2022-05-11', '2022-05-11', '[\"2022-05\"]', '2022-05-11', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-05-20 12:27:12'),
(5, 14, 'test', 'bg-danger', 'asad', '2022-05-26', '2022-05-26', '[\"2022-05\"]', '2022-05-26', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-05-25 15:15:21'),
(6, 0, 'dsfsd', 'bg-success', 'sdfsdf', '2022-06-13', '2025-06-13', '[\"2022-06\"]', '2022-06-13', '00:00:00', '00:00:00', 'Monday', 'true', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-13 12:46:10'),
(7, 1, 'Test', 'bg-danger', 'This is test Event', '2022-06-13', '2025-06-13', '[\"2022-06\"]', '2022-06-13', '00:00:00', '00:00:00', 'Monday', 'true', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-13 13:10:21'),
(8, 0, 'test', 'bg-success', '', '2022-06-09', '2022-06-09', '[\"2022-06\"]', '2022-06-09', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-16 07:40:16'),
(9, 0, 'aa', 'bg-primary', 'aa', '2022-06-22', '2022-07-25', '[\"2022-06\",\"2022-07\"]', '2022-07-25', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-16 07:41:29'),
(10, 0, 'bb', 'bg-danger', 'bb', '2022-06-24', '2022-07-19', '[\"2022-06\",\"2022-07\"]', '2022-07-19', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-16 07:42:25'),
(11, 0, 'test', 'bg-info', 'test', '2022-06-01', '2022-06-17', '[\"2022-06\"]', '2022-06-17', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-16 12:38:43'),
(12, 0, 'dsd', 'bg-success', '', '2022-06-16', '2022-06-16', '[\"2022-06\"]', '2022-06-16', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-16 15:34:48'),
(13, 1, 'asdas', 'bg-danger', 'asda', '2022-06-17', '2022-06-17', '[\"2022-06\"]', '2022-06-17', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-16 15:39:45'),
(14, 1, 'wqeqe', 'bg-primary', '', '2022-06-18', '2022-06-18', '[\"2022-06\"]', '2022-06-18', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-16 15:39:55'),
(17, 1, 'AAP', 'bg-danger', 'AAP', '2022-07-06', '2022-07-06', '[\"2022-07\"]', '2022-07-06', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-17 13:06:32'),
(19, 1, 'oct', 'bg-info', 'oct', '2022-10-10', '2022-10-14', '[\"2022-10\"]', '2022-11-24', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 13:58:26'),
(20, 1, 'oct', 'bg-info', 'oct', '2022-10-17', '2022-10-21', '[\"2022-10\"]', '2022-11-24', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 13:58:26'),
(21, 1, 'oct', 'bg-info', 'oct', '2022-10-24', '2022-10-28', '[\"2022-10\"]', '2022-11-24', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 13:58:26'),
(22, 1, 'oct', 'bg-info', 'oct', '2022-10-31', '2022-11-04', '[\"2022-10\",\"2022-11\"]', '2022-11-24', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 13:58:26'),
(23, 1, 'oct', 'bg-info', 'oct', '2022-11-07', '2022-11-11', '[\"2022-11\"]', '2022-11-24', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 13:58:26'),
(24, 1, 'oct', 'bg-info', 'oct', '2022-11-14', '2022-11-18', '[\"2022-11\"]', '2022-11-24', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 13:58:26'),
(25, 1, 'oct', 'bg-info', 'oct', '2022-11-21', '2022-11-25', '[\"2022-11\"]', '2022-11-24', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 13:58:26'),
(29, 1, 'mon-fri', 'bg-primary', '', '2022-07-01', '2022-07-01', '[\"2022-07\"]', '2022-07-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:47'),
(33, 1, 'new', 'bg-danger', 'new', '2022-10-05', '2022-10-07', '[\"2022-10\"]', '2022-11-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:57'),
(34, 1, 'new', 'bg-danger', 'new', '2022-10-10', '2022-10-14', '[\"2022-10\"]', '2022-11-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:57'),
(35, 1, 'new', 'bg-danger', 'new', '2022-10-17', '2022-10-21', '[\"2022-10\"]', '2022-11-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:57'),
(36, 1, 'new', 'bg-danger', 'new', '2022-10-24', '2022-10-28', '[\"2022-10\"]', '2022-11-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:57'),
(37, 1, 'new', 'bg-danger', 'new', '2022-10-31', '2022-11-04', '[\"2022-10\",\"2022-11\"]', '2022-11-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:57'),
(38, 1, 'new', 'bg-danger', 'new', '2022-11-07', '2022-11-11', '[\"2022-11\"]', '2022-11-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:57'),
(39, 1, 'new', 'bg-danger', 'new', '2022-11-14', '2022-11-18', '[\"2022-11\"]', '2022-11-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:57'),
(40, 1, 'new', 'bg-danger', 'new', '2022-11-21', '2022-11-23', '[\"2022-11\"]', '2022-11-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:01:57'),
(46, 1, 'sdfsdf', 'bg-success', 'fdfsdfs', '2022-07-11', '2022-07-11', '[\"2022-07\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 14:05:35'),
(50, 1, 'cheek', 'bg-info', '', '2022-07-01', '2022-07-01', '[\"2022-07\"]', '2022-07-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 15:10:16'),
(54, 1, 'asd', 'bg-info', '', '2022-06-21', '2022-06-24', '[\"2022-06\"]', '2022-06-30', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 15:13:44'),
(55, 1, 'asd', 'bg-info', '', '2022-06-27', '2022-07-01', '[\"2022-06\",\"2022-07\"]', '2022-06-30', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 15:13:44'),
(56, 1, 'bh', 'bg-warning', '', '2022-07-01', '2022-07-01', '[\"2022-07\"]', '2022-07-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 15:14:31'),
(57, 1, 'bh', 'bg-warning', '', '2022-07-04', '2022-07-08', '[\"2022-07\"]', '2022-07-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 15:14:31'),
(58, 1, 'bh', 'bg-warning', '', '2022-07-11', '2022-07-15', '[\"2022-07\"]', '2022-07-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 15:14:31'),
(59, 1, 'bh', 'bg-warning', '', '2022-07-18', '2022-07-21', '[\"2022-07\"]', '2022-07-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 15:14:31'),
(79, 1, 'lunch', 'bg-success', '', '2022-06-01', '2022-06-03', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:20:35'),
(80, 1, 'lunch', 'bg-success', '', '2022-06-06', '2022-06-10', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:20:35'),
(81, 1, 'lunch', 'bg-success', '', '2022-06-13', '2022-06-17', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:20:35'),
(82, 1, 'lunch', 'bg-success', '', '2022-06-20', '2022-06-23', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:20:35'),
(83, 1, 'Test Weekday', 'bg-warning', '', '2022-06-06', '2022-06-10', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:31:59'),
(84, 1, 'Test Weekday', 'bg-warning', '', '2022-06-13', '2022-06-17', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:31:59'),
(85, 1, 'Test Weekday', 'bg-warning', '', '2022-06-20', '2022-06-24', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:31:59'),
(86, 1, 'Test Weekday', 'bg-warning', '', '2022-06-27', '2022-07-01', '[\"2022-06\",\"2022-07\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:31:59'),
(87, 1, 'Test Weekday', 'bg-warning', '', '2022-07-04', '2022-07-08', '[\"2022-07\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:31:59'),
(88, 1, 'Test Weekday', 'bg-warning', '', '2022-07-11', '2022-07-15', '[\"2022-07\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 17:31:59'),
(89, 1, 'shivam weekday', 'bg-primary', '', '2022-06-01', '2022-06-03', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 20:22:16'),
(90, 1, 'shivam weekday', 'bg-primary', '', '2022-06-06', '2022-06-10', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 20:22:16'),
(91, 1, 'shivam weekday', 'bg-primary', '', '2022-06-13', '2022-06-17', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 20:22:16'),
(92, 1, 'shivam weekday', 'bg-primary', '', '2022-06-20', '2022-06-24', '[\"2022-06\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 20:22:16'),
(93, 1, 'shivam weekday', 'bg-primary', '', '2022-06-27', '2022-07-01', '[\"2022-06\",\"2022-07\"]', '2022-06-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-20 20:22:16'),
(95, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-21', '2022-03-25', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(96, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-28', '2022-04-01', '[\"2022-03\",\"2022-04\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(97, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-14', '2022-03-18', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(98, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-21', '2022-03-25', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(99, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-28', '2022-04-01', '[\"2022-03\",\"2022-04\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(100, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-14', '2022-03-18', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(101, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-21', '2022-03-25', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(102, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-28', '2022-04-01', '[\"2022-03\",\"2022-04\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(103, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-14', '2022-03-18', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(104, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-21', '2022-03-25', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(105, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-28', '2022-04-01', '[\"2022-03\",\"2022-04\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(106, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-14', '2022-03-18', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(107, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-21', '2022-03-25', '[\"2022-03\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(108, 1, 'sport activity', 'bg-success', 'for testing purpose ', '2022-03-28', '2022-04-01', '[\"2022-03\",\"2022-04\"]', '2022-06-21', '10:30:00', '12:30:00', 'Does not repeat', 'false', '15 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:42:37'),
(109, 1, 'Running', 'bg-danger', 'test', '2022-02-02', '2022-02-04', '[\"2022-02\"]', '2022-06-21', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:46:25'),
(110, 1, 'Running', 'bg-danger', 'test', '2022-02-07', '2022-02-11', '[\"2022-02\"]', '2022-06-21', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:46:25'),
(111, 1, 'Running', 'bg-danger', 'test', '2022-02-14', '2022-02-18', '[\"2022-02\"]', '2022-06-21', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:46:25'),
(112, 1, 'Running', 'bg-danger', 'test', '2022-02-21', '2022-02-24', '[\"2022-02\"]', '2022-06-21', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:46:25'),
(113, 1, 'test', 'bg-info', 'test', '2022-01-05', '2022-01-07', '[\"2022-01\"]', '2022-06-21', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:50:15'),
(114, 1, 'test', 'bg-info', 'test', '2022-01-10', '2022-01-14', '[\"2022-01\"]', '2022-06-21', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:50:15'),
(115, 1, 'test', 'bg-info', 'test', '2022-01-17', '2022-01-19', '[\"2022-01\"]', '2022-06-21', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 10:50:15'),
(116, 1, 'Today testing', 'bg-danger', '', '2022-08-10', '2022-08-12', '[\"2022-08\"]', '2022-08-23', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 11:54:47'),
(117, 1, 'Today testing', 'bg-danger', '', '2022-08-15', '2022-08-19', '[\"2022-08\"]', '2022-08-23', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 11:54:47'),
(118, 1, 'Today testing', 'bg-danger', '', '2022-08-22', '2022-08-24', '[\"2022-08\"]', '2022-08-23', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-06-21 11:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `events2`
--

CREATE TABLE `events2` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_color` varchar(20) NOT NULL,
  `event_note` text NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `date_array` text NOT NULL,
  `end_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_repeat_option` varchar(30) NOT NULL,
  `event_allDay` varchar(10) NOT NULL,
  `event_reminder` varchar(30) NOT NULL,
  `draggable_event` varchar(10) NOT NULL,
  `draggable_id` varchar(10) NOT NULL,
  `task_note` text NOT NULL,
  `task_start_date` date NOT NULL,
  `task_start_time` time NOT NULL,
  `task_repeat_option` varchar(30) NOT NULL,
  `task_allDay` varchar(10) NOT NULL,
  `task_reminder` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `reminded` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events2`
--

INSERT INTO `events2` (`id`, `student_id`, `event_name`, `event_color`, `event_note`, `event_start_date`, `event_end_date`, `date_array`, `end_date`, `event_start_time`, `event_end_time`, `event_repeat_option`, `event_allDay`, `event_reminder`, `draggable_event`, `draggable_id`, `task_note`, `task_start_date`, `task_start_time`, `task_repeat_option`, `task_allDay`, `task_reminder`, `type`, `reminded`, `status`, `date`) VALUES
(1, 1, 'Weekly meeting for class tenth', 'bg-success', 'Prepare all the reports', '2021-09-09', '2021-09-09', '[\"2021-09-09\"]', '2021-09-09', '11:00:00', '12:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '1', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-08 22:30:40'),
(2, 1, 'terminal exam 101', 'bg-danger', 'prepare all notes', '2021-09-11', '2021-09-11', '[\"2021-09-11\"]', '2021-09-11', '11:00:00', '12:00:00', 'Does not repeat', 'false', '15 minutes before', 'on', '4', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-08 22:32:39'),
(3, 1, 'second semester exam 102', 'bg-warning', 'prepare all notes', '2021-09-10', '2021-09-10', '[\"2021-09-10\"]', '2021-09-10', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '3', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-08 22:37:51'),
(4, 1, '108 long title long titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong titlelong title', 'bg-success', 'long description long descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong descriptionlong description', '2021-09-10', '2021-09-10', '[\"2021-09-10\"]', '2021-09-10', '01:30:00', '01:45:00', 'Does not repeat', 'false', '15 minutes before', 'on', '7', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 10:32:30'),
(7, 1, 'tenth standard surprise exam', 'bg-info', 'tenth standard surprise exam', '2021-09-09', '2021-09-09', '[\"2021-09-09\"]', '2021-09-09', '11:00:00', '12:00:00', 'Does not repeat', 'false', '15 minutes before', 'on', '8', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 12:28:39'),
(8, 1, 'distribute hall tickets', 'bg-danger', 'distribute hall tickets', '2021-09-09', '2021-09-09', '[\"2021-09-09\"]', '2021-09-09', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '9', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 12:43:31'),
(9, 1, 'give roll no to  students', 'bg-success', 'give roll no to  students', '2021-09-09', '2021-09-09', '[\"2021-09-09\"]', '2021-09-09', '01:00:00', '02:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '10', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 12:45:44'),
(10, 1, 'Take a biometric of every students', 'bg-primary', 'Take a biometric of every students', '2021-09-09', '2021-09-09', '[\"2021-09-09\"]', '2021-09-09', '00:00:00', '01:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '11', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 13:12:15'),
(12, 1, 'provide gr no', 'bg-danger', 'gr no', '2021-09-09', '2021-09-09', '[\"2021-09-09\"]', '2021-09-09', '02:30:00', '10:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '14', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 15:54:53'),
(13, 1, 'sddasdas qwer1', 'bg-success', 'dsddadsdsdsdsd', '2021-09-03', '2021-09-04', '', '2021-09-04', '20:45:00', '21:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '16', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 16:34:07'),
(14, 1, 'long date', 'bg-warning', 'long date', '2021-09-25', '2021-10-25', '', '2021-10-25', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '17', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 16:45:50'),
(16, 2, 'Meeting', 'bg-primary', 'awdewqwq', '2021-09-15', '2021-09-15', '[\"2021-09-15\"]', '2021-09-15', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '19', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 19:32:41'),
(17, 2, 'Exercise', 'bg-primary', 'ftfh', '2021-09-07', '2021-09-07', '[\"2021-09-07\"]', '2021-09-07', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '20', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-09 19:33:07'),
(18, 2, 'Namaz', 'bg-success', 'sdsad', '2021-09-04', '2021-09-04', '[\"2021-09-04\"]', '2021-09-04', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '102', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-10 11:29:47'),
(19, 2, 'Work', 'bg-warning', 'gfcg ffh', '2021-09-10', '2021-09-10', '[\"2021-09-10\"]', '2021-09-10', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '47', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-10 11:31:22'),
(20, 2, 'International Conference On Control, Automation, Robotics and Vision Engineering ((ICCARVE))', 'bg-info', 'The International Conference on Control, Automation, Robotics and Vision Engineering aims to promote scientific information interchange between researchers, developers, engineers, students, and practitioners working in and around the world. The conference will be held every year to make it an ideal platform for people to share views and experiences in Control, Automation, Robotics and Vision Engineering related areas.', '2021-10-13', '2021-10-13', '[\"2021-10-13\"]', '2021-10-13', '11:00:00', '12:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '33', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-10 11:31:51'),
(21, 4, 'test', 'bg-danger', 'testing', '2021-09-10', '2021-09-10', '[\"2021-09-10\"]', '2021-09-10', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-10 11:32:05'),
(22, 5, 'First morning meeting', 'bg-success', 'meeting at 5 AM Daily', '2021-09-10', '2021-09-10', '[\"2021-09-10\"]', '2021-09-10', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '27', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-10 11:33:45'),
(23, 1, 'djdsfkjdfkj', 'bg-danger', 'bdhjkgjkjdk', '2021-09-10', '2021-09-10', '[\"2021-09-10\"]', '2021-09-10', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '26', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-10 11:36:40'),
(24, 5, 'morning meeting', 'bg-success', 'meeting at 5 AM Daily', '2021-09-24', '2021-09-24', '[\"2021-09-24\"]', '2021-09-24', '05:00:00', '05:15:00', 'Does not repeat', 'false', 'No reminder', 'on', '25', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-10 11:43:26'),
(28, 2, 'Meeting', 'bg-info', 'awdewqwq', '2021-09-24', '2021-09-24', '[\"2021-09-24\"]', '2021-09-24', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-13 12:59:30'),
(30, 2, 'Medical Test', 'bg-danger', 'njnjnj', '2021-09-22', '2021-09-22', '[\"2021-09-22\"]', '2021-09-22', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '18', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-13 13:01:18'),
(55, 0, 'Breakfast', 'bg-danger', 'Time to eat a healthy breakfast', '2021-09-22', '2021-09-22', '[\"2021-09-22\"]', '2021-09-22', '07:15:00', '07:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '36', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-14 04:10:33'),
(69, 0, 'Breakfast', 'bg-danger', 'Time to eat a healthy breakfast', '2021-09-21', '2021-09-21', '[\"2021-09-21\"]', '2021-09-21', '07:15:00', '07:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '36', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-20 17:36:06'),
(84, 0, 'Breakfast', 'bg-danger', 'Time to eat a healthy breakfast', '2021-09-24', '2021-09-24', '[\"2021-09-24\"]', '2021-09-24', '07:15:00', '07:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '36', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-21 18:14:48'),
(87, 0, 'Breakfast', 'bg-danger', 'Time to eat a healthy breakfast', '2021-09-23', '2021-09-23', '[\"2021-09-23\"]', '2021-09-23', '07:15:00', '07:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '36', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-21 18:14:55'),
(88, 16, 'Buzzword', 'bg-success', '', '2021-09-21', '2021-09-21', '[\"2021-09-21\"]', '2021-09-21', '00:00:00', '00:00:00', 'Does not repeat', 'true', '1 hour before', 'on', '48', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-21 19:52:31'),
(111, 0, 'Breakfast', 'bg-danger', 'Time to eat a healthy breakfast', '2021-09-25', '2021-09-25', '[\"2021-09-25\"]', '2021-09-25', '07:15:00', '07:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '36', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-22 22:21:20'),
(120, 0, 'Marketing Meeting', 'bg-primary', 'Marketing Team Meeting', '2021-09-22', '2021-09-22', '[\"2021-09-22\"]', '2021-09-22', '08:00:00', '09:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '53', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:17:59'),
(121, 0, 'Marketing Meeting', 'bg-primary', 'Marketing Team Meeting', '2021-09-23', '2021-09-23', '[\"2021-09-23\"]', '2021-09-23', '08:00:00', '09:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '53', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:18:58'),
(122, 0, 'Marketing Meeting', 'bg-primary', 'Marketing Team Meeting', '2021-09-24', '2021-09-24', '[\"2021-09-24\"]', '2021-09-24', '08:00:00', '09:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '53', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:19:05'),
(123, 0, 'Marketing Meeting', 'bg-primary', 'Marketing Team Meeting', '2021-09-21', '2021-09-21', '[\"2021-09-21\"]', '2021-09-21', '08:00:00', '09:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '53', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:19:27'),
(124, 0, 'Development Meeting', 'bg-primary', 'Software Development Meeting', '2021-09-21', '2021-09-21', '[\"2021-09-21\"]', '2021-09-21', '09:00:00', '10:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '54', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:20:51'),
(125, 0, 'Development Meeting', 'bg-primary', 'Software Development Meeting', '2021-09-22', '2021-09-22', '[\"2021-09-22\"]', '2021-09-22', '09:00:00', '10:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '54', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:20:58'),
(126, 0, 'Development Meeting', 'bg-primary', 'Software Development Meeting', '2021-09-23', '2021-09-23', '[\"2021-09-23\"]', '2021-09-23', '09:00:00', '10:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '54', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:21:04'),
(127, 0, 'Development Meeting', 'bg-primary', 'Software Development Meeting', '2021-09-24', '2021-09-24', '[\"2021-09-24\"]', '2021-09-24', '09:00:00', '10:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '54', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:21:11'),
(128, 0, 'Lunch', 'bg-danger', 'Time to eat a healthy lunch', '2021-09-21', '2021-09-21', '[\"2021-09-21\"]', '2021-09-21', '14:30:00', '15:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '55', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:24:10'),
(129, 0, 'Lunch', 'bg-danger', 'Time to eat a healthy lunch', '2021-09-22', '2021-09-22', '[\"2021-09-22\"]', '2021-09-22', '14:30:00', '15:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '55', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:24:19'),
(130, 0, 'Lunch', 'bg-danger', 'Time to eat a healthy lunch', '2021-09-23', '2021-09-23', '[\"2021-09-23\"]', '2021-09-23', '14:30:00', '15:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '55', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:24:30'),
(131, 0, 'Lunch', 'bg-danger', 'Time to eat a healthy lunch', '2021-09-24', '2021-09-24', '[\"2021-09-24\"]', '2021-09-24', '15:30:00', '16:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '55', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:24:51'),
(132, 0, 'Wake Up', 'bg-success', 'Time to wake up', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '05:45:00', '06:00:00', 'Does not repeat', 'false', '15 minutes before', 'on', '32', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:25:20'),
(133, 0, 'Fajr Prayer', 'bg-info', 'Time to pray Fajr salat', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '06:00:00', '06:15:00', 'Does not repeat', 'false', '5 minutes before', 'on', '34', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:25:26'),
(134, 0, 'Walk', 'bg-danger', 'Time for a brisk walk - 2 miles at least', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '06:15:00', '06:45:00', 'Does not repeat', 'false', 'No reminder', 'on', '35', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:25:32'),
(135, 0, 'Drop Zee', 'bg-warning', 'Drop Zee off to Schoold', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '06:45:00', '07:15:00', 'Does not repeat', 'false', 'No reminder', 'on', '40', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:25:41'),
(136, 0, 'Breakfast', 'bg-danger', 'Time to eat a healthy breakfast', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '07:15:00', '07:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '36', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:25:47'),
(137, 0, 'Quran Class', 'bg-success', 'Quran reading class', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '07:30:00', '08:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '39', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:25:52'),
(138, 0, 'Marketing Meeting', 'bg-primary', 'Marketing Team Meeting', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '08:00:00', '09:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '53', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:25:59'),
(139, 0, 'Development Meeting', 'bg-primary', 'Software Development Meeting', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '09:00:00', '10:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '54', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:26:07'),
(140, 0, 'intely.io Website Connect', 'bg-primary', 'intely.io Website development sync up', '2021-09-20', '2021-09-20', '[\"2021-09-20\"]', '2021-09-20', '11:00:00', '11:30:00', 'Does not repeat', 'false', '5 minutes before', 'on', '56', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 02:31:01'),
(141, 0, 'Walk', 'bg-danger', 'Time for a brisk walk - 2 miles at least', '2021-09-21', '2021-09-21', '[\"2021-09-21\"]', '2021-09-21', '20:30:00', '21:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '35', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 09:55:48'),
(142, 0, 'Walk', 'bg-danger', 'Time for a brisk walk - 2 miles at least', '2021-09-22', '2021-09-22', '[\"2021-09-22\"]', '2021-09-22', '20:30:00', '21:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '35', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 09:55:56'),
(143, 0, 'Walk', 'bg-danger', 'Time for a brisk walk - 2 miles at least', '2021-09-23', '2021-09-23', '[\"2021-09-23\"]', '2021-09-23', '20:30:00', '21:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '35', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 09:56:10'),
(144, 0, 'Walk', 'bg-danger', 'Time for a brisk walk - 2 miles at least', '2021-09-24', '2021-09-24', '[\"2021-09-24\"]', '2021-09-24', '20:30:00', '21:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '35', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 09:56:19'),
(145, 0, 'Walk', 'bg-danger', 'Time for a brisk walk - 2 miles at least', '2021-09-25', '2021-09-25', '[\"2021-09-25\"]', '2021-09-25', '20:30:00', '21:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '35', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-09-23 09:56:26'),
(209, 2, 'Exercise', 'bg-primary', 'Exercise Exercise Exercise', '2021-10-06', '2021-10-06', '[\"2021-10-06\"]', '2021-10-06', '09:00:00', '09:15:00', 'Does not repeat', 'false', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-04 17:55:26'),
(210, 21, 'event1', 'bg-success', 'event 1', '2021-10-05', '2021-10-05', '[\"2021-10-05\"]', '2021-10-05', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '60', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-05 22:49:53'),
(211, 21, 'event2', 'bg-danger', 'event2', '2021-10-07', '2021-10-08', '', '2021-10-08', '11:00:00', '12:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '61', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-05 22:52:18'),
(229, 1, 'zzzzzzzz', 'bg-primary', 'zzzzzzzzzzzz', '2021-10-05', '2021-10-05', '[\"2021-10-05\"]', '2021-10-05', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '62', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-06 10:50:14'),
(230, 21, 'third semester exam', 'bg-success', 'read', '2021-10-09', '2021-10-10', '', '2021-10-10', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '63', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-07 22:42:00'),
(231, 21, 'event2', 'bg-danger', 'event2', '2021-10-03', '2021-10-03', '[\"2021-10-03\"]', '2021-10-03', '00:45:00', '05:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '61', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-07 22:46:16'),
(232, 21, 'third semester exam', 'bg-success', 'read', '2021-10-07', '2021-10-07', '[\"2021-10-07\"]', '2021-10-07', '04:00:00', '06:15:00', 'Does not repeat', 'false', 'No reminder', 'on', '63', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-07 22:48:52'),
(233, 1, 'namaaz', 'bg-success', 'namaaz', '2021-10-08', '2021-10-08', '[\"2021-10-08\"]', '2021-10-08', '11:00:00', '12:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '64', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-08 09:50:51'),
(234, 1, 'reading', 'bg-danger', 'reading', '2021-10-08', '2021-10-08', '[\"2021-10-08\"]', '2021-10-08', '11:00:00', '12:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '65', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-08 09:53:03'),
(235, 1, 'Weekly meeting for class tenth', 'bg-success', 'Prepare all the reports', '2021-10-08', '2021-10-08', '[\"2021-10-08\"]', '2021-10-08', '06:15:00', '06:30:00', 'Does not repeat', 'false', '5 minutes before', 'on', '1', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-08 10:32:59'),
(251, 4, 'lunch', 'bg-info', '', '2021-10-12', '2021-10-12', '[\"2021-10-12\"]', '2021-10-12', '13:30:00', '14:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '67', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 10:28:04'),
(252, 4, 'break fast', 'bg-danger', '', '2021-10-12', '2021-10-12', '[\"2021-10-12\"]', '2021-10-12', '10:00:00', '11:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 10:32:18'),
(253, 4, 'lunch with dark chocolate pinata cake', 'bg-info', '', '2021-10-15', '2021-10-15', '[\"2021-10-15\"]', '2021-10-15', '13:30:00', '14:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '70', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 10:54:49'),
(254, 4, 'lunch', 'bg-info', '', '2021-10-14', '2021-10-14', '[\"2021-10-14\"]', '2021-10-14', '12:45:00', '14:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '67', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 10:54:56'),
(255, 4, 'tea time', 'bg-warning', 'tea time note', '2021-10-12', '2021-10-12', '[\"2021-10-12\"]', '2021-10-12', '17:30:00', '18:00:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 10:57:15'),
(256, 4, 'lunch', 'bg-info', '', '2021-10-13', '2021-10-13', '[\"2021-10-13\"]', '2021-10-13', '13:30:00', '14:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '72', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 11:03:02'),
(257, 4, 'test event overlap', 'bg-primary', '', '2021-10-12', '2021-10-12', '[\"2021-10-12\"]', '2021-10-12', '10:00:00', '11:45:00', 'Does not repeat', 'false', 'No reminder', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 12:01:35'),
(258, 4, 'test reminder', 'bg-primary', '', '2021-10-12', '2021-10-12', '[\"2021-10-12\"]', '2021-10-12', '12:30:00', '12:45:00', 'Does not repeat', 'false', '5 minutes before', '', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 12:13:17'),
(259, 4, 'test long event', 'bg-success', '', '2021-10-12', '2021-11-25', '', '2021-11-25', '10:30:00', '12:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '71', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-10-12 12:14:26'),
(275, 1, 'Exam preparation', 'bg-success', 'All subject', '2021-11-02', '2021-11-07', '[]', '2021-11-07', '11:00:00', '12:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '75', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-01 16:54:14'),
(276, 1, 'Terminal exam', 'bg-info', 'all theory', '2021-11-01', '2021-11-01', '[\"2021-11-01\",\"2021-11-02\",\"2021-11-03\",\"2021-11-04\",\"2021-11-05\",\"2021-11-06\",\"2021-11-07\"]', '2021-11-07', '11:00:00', '12:00:00', 'Weekly', 'false', 'No reminder', 'on', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-01 17:46:45'),
(278, 1, 'random', 'bg-success', 'random', '2021-11-03', '2021-11-04', '[\"2021-11-03\",\"2021-11-04\"]', '2021-11-04', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '76', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-02 12:41:06'),
(279, 1, 'random1', 'bg-danger', 'random1', '2021-11-05', '2021-11-06', '[\"2021-11-05\",\"2021-11-06\"]', '2021-11-06', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '77', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-02 12:42:14'),
(280, 1, 'Weekly meeting for class tenth', 'bg-success', 'Prepare all the reports', '2021-11-19', '2021-11-19', '[\"2021-11-19\"]', '2021-11-19', '11:00:00', '12:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '1', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-02 12:52:26'),
(282, 1, 'Meeting', 'bg-primary', 'meeting', '2021-11-09', '2021-11-10', '[]', '2021-11-10', '11:00:00', '00:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '79', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-02 14:04:19'),
(283, 1, 'Weekly meeting for class tenth', 'bg-success', 'Prepare all the reports', '2021-11-11', '2021-11-11', '[\"2021-11-11\"]', '2021-11-11', '11:00:00', '12:00:00', 'Does not repeat', 'false', '5 minutes before', 'on', '1', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-02 18:44:27'),
(284, 1, 'terminal exam', 'bg-danger', 'prepare all notes', '2021-11-02', '2021-11-06', '', '2021-11-06', '11:00:00', '12:00:00', 'Does not repeat', 'false', '15 minutes before', 'on', '2', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-02 18:47:33'),
(285, 1, 'Practice math\'s numerical', 'bg-success', '', '2021-11-17', '2021-11-17', '[\"2021-11-17\"]', '2021-11-17', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '80', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-17 18:17:26'),
(286, 1, 'Practice math\'s numerical', 'bg-success', '', '2021-11-17', '2021-11-17', '[\"2021-11-17\"]', '2021-11-17', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '80', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2021-11-17 18:20:29'),
(287, 35, 'Biochemistry', 'bg-success', '', '2022-01-11', '2022-01-20', '[\"2022-01-11\",\"2022-01-12\",\"2022-01-13\",\"2022-01-14\",\"2022-01-15\",\"2022-01-16\",\"2022-01-17\",\"2022-01-18\",\"2022-01-19\"]', '2022-01-20', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-01-10 21:23:47'),
(288, 35, 'Immunology', 'bg-danger', '', '2022-01-20', '2022-01-24', '[\"2022-01-20\",\"2022-01-21\"]', '2022-01-24', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-01-10 21:24:10'),
(289, 35, 'Microbiology', 'bg-info', '', '2022-01-24', '2022-01-27', '[\"2022-01-24\",\"2022-01-25\",\"2022-01-26\"]', '2022-01-27', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-01-10 21:24:32'),
(290, 35, 'Psychiatry', 'bg-primary', '', '2022-01-27', '2022-02-01', '[\"2022-01-27\",\"2022-01-28\",\"2022-01-29\",\"2022-01-30\",\"2022-01-31\"]', '2022-02-01', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-01-10 21:25:01'),
(291, 35, 'Biostatistics', 'bg-warning', '', '2022-02-01', '2022-02-01', '[\"2022-02-01\"]', '2022-02-01', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '85', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-01-10 21:25:26'),
(292, 35, 'MSK/CTD', 'bg-success', '', '2022-02-02', '2022-02-07', '[\"2022-02-02\",\"2022-02-03\",\"2022-02-04\"]', '2022-02-07', '00:00:00', '00:00:00', 'Does not repeat', 'true', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-01-10 21:26:04'),
(312, 2, 'Event 4590', 'bg-dark', 'Event 4590 Event 4590 Event 4590 Event 4590', '2022-01-11', '2022-01-11', '[\"2022-01-11\"]', '2022-01-11', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '103', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-01-11 14:04:56'),
(315, 4, '20/1 event', 'bg-success', '', '2022-01-20', '2022-01-20', '[\"2022-01-20\"]', '2022-01-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '104', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-01-20 13:13:19'),
(317, 35, 'Rise & Shine!', 'bg-success', '', '2022-02-02', '2022-02-02', '[\"2022-02-01\",\"2022-02-02\"]', '2022-03-03', '07:00:00', '08:00:00', 'Daily', 'false', '15 minutes before', 'on', '106', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:05:35'),
(318, 35, 'Morning Exercise!', 'bg-danger', 'Do 10 Mixed UW Qs', '2022-02-02', '2022-03-02', '[\"2022-02-02\"]', '2022-03-02', '09:00:00', '10:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '107', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:20:42'),
(319, 35, 'Morning Exercise!', 'bg-danger', 'Do 10 Mixed UW Qs', '2022-02-01', '2022-02-01', '[\"2022-02-01\"]', '2022-02-01', '09:00:00', '10:00:00', 'Weekly', 'false', 'No reminder', 'on', '107', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:20:57'),
(320, 35, 'Session!', 'bg-info', '', '2022-02-02', '2022-03-02', '[\"2022-02-02\"]', '2022-03-02', '10:00:00', '10:15:00', 'Does not repeat', 'false', 'No reminder', 'on', '108', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:38:06'),
(321, 35, 'Session!', 'bg-info', '', '2022-02-01', '2022-02-01', '[\"2022-02-01\"]', '2022-02-01', '10:00:00', '13:00:00', 'Weekly', 'false', 'No reminder', 'on', '108', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:38:16'),
(322, 35, 'Lunch!', 'bg-warning', '', '2022-02-02', '2022-03-02', '[\"2022-02-02\"]', '2022-03-02', '13:00:00', '13:15:00', 'Does not repeat', 'false', 'No reminder', 'on', '109', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:42:04'),
(323, 35, 'Lunch!', 'bg-warning', '', '2022-02-01', '2022-02-01', '[\"2022-02-01\"]', '2022-02-01', '13:00:00', '14:00:00', 'Weekly', 'false', 'No reminder', 'on', '109', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:42:09'),
(324, 35, 'Revision Time!', 'bg-primary', '', '2022-02-02', '2022-03-02', '[\"2022-02-02\"]', '2022-03-02', '14:15:00', '18:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:45:28'),
(325, 35, 'Revision Time!', 'bg-primary', '', '2022-02-01', '2022-02-01', '[\"2022-02-01\"]', '2022-02-01', '14:00:00', '18:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '110', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:45:33'),
(326, 35, 'Self-Care!', 'bg-success', '', '2022-02-02', '2022-03-02', '[\"2022-02-02\"]', '2022-03-02', '18:00:00', '18:15:00', 'Does not repeat', 'false', 'No reminder', 'on', '111', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:46:53'),
(327, 35, 'Self-Care!', 'bg-success', 'Wednesday-Friday-Sunday', '2022-02-01', '2022-02-01', '[\"2022-02-01\"]', '2022-02-01', '18:00:00', '19:30:00', 'Daily', 'false', 'No reminder', 'on', '111', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:47:05'),
(328, 35, 'Dinner & Rest!', 'bg-warning', 'Rest up, spend time with pets and family!', '2022-02-02', '2022-03-02', '[\"2022-02-02\"]', '2022-03-02', '20:30:00', '20:45:00', 'Does not repeat', 'false', 'No reminder', 'on', '112', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:49:13'),
(329, 35, 'Dinner & Rest!', 'bg-warning', 'Rest up, spend time with pets and family!', '2022-02-02', '2022-02-02', '[\"2022-02-02\"]', '2022-03-02', '20:00:00', '22:00:00', 'Daily', 'false', 'No reminder', 'on', '112', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:49:22'),
(330, 35, 'Dinner & Rest!', 'bg-warning', 'Rest up, spend time with pets and family!', '2022-02-02', '2022-03-02', '', '2022-03-02', '19:30:00', '22:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '112', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:50:19'),
(331, 35, 'Dinner & Rest!', 'bg-warning', 'Rest up, spend time with pets and family!', '2022-02-02', '2022-02-02', '', '2022-03-02', '19:30:00', '22:00:00', 'Daily', 'false', 'No reminder', 'on', '112', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:51:35'),
(332, 35, 'Dinner & Rest!', 'bg-warning', 'Rest up, spend time with pets and family!', '2022-02-01', '2022-02-01', '[\"2022-02-01\"]', '2022-02-01', '19:30:00', '22:00:00', 'Daily', 'false', 'No reminder', 'on', '112', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:53:44'),
(333, 35, 'Rise & Shine!', 'bg-success', '', '2022-02-02', '2022-02-02', '', '2022-03-02', '07:00:00', '08:30:00', 'Daily', 'false', 'No reminder', 'on', '106', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:55:47'),
(334, 35, 'Rise & Shine!', 'bg-success', '', '2022-02-02', '2022-03-02', '', '2022-03-02', '07:15:00', '08:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '106', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:57:03'),
(335, 35, 'Rise & Shine!', 'bg-success', '', '2022-02-02', '2022-02-02', '', '2022-03-02', '07:15:00', '08:30:00', 'Daily', 'false', 'No reminder', 'on', '106', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:58:19'),
(336, 35, 'Rise & Shine!', 'bg-success', '', '2022-02-01', '2022-02-01', '[\"2022-02-01\"]', '2022-02-01', '07:15:00', '07:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '106', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-02 07:59:04'),
(337, 45, 'Event 1', 'bg-success', 'Event 1 notes', '2022-02-07', '2022-02-07', '[\"2022-02-07\"]', '2022-02-07', '11:00:00', '12:00:00', 'Does not repeat', 'false', '30 minutes before', 'on', '113', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-07 20:39:22'),
(338, 30, 'Step 1: GIT', 'bg-success', '', '2022-02-14', '2022-02-16', '[]', '2022-02-16', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '145', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:28:13'),
(339, 30, 'Step 1: Endocrine', 'bg-danger', '', '2022-02-22', '2022-02-23', '[]', '2022-02-23', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:28:50'),
(340, 30, 'Step 1: Reproductive System', 'bg-info', '', '2022-02-24', '2022-02-25', '[]', '2022-02-25', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '115', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:29:22'),
(341, 30, 'Step 1: Reproductive System', 'bg-info', '', '2022-02-28', '2022-02-28', '[\"2022-02-28\"]', '2022-02-28', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:29:47'),
(342, 30, 'Step 1: Renal', 'bg-primary', '', '2022-03-01', '2022-03-02', '[]', '2022-03-02', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '116', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:30:12'),
(343, 30, 'Step 1: Cardiology', 'bg-warning', '', '2022-03-03', '2022-03-04', '[]', '2022-03-04', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '117', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:30:36'),
(344, 30, 'Step 1: Respiratory System', 'bg-success', '', '2022-03-07', '2022-03-08', '[]', '2022-03-08', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '118', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:31:11'),
(345, 30, 'Step 1: Neurology', 'bg-danger', '', '2022-03-09', '2022-03-11', '[]', '2022-03-11', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '119', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:31:46'),
(346, 30, 'Step 1: General Principals', 'bg-info', '', '2022-03-14', '2022-03-15', '[]', '2022-03-15', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '122', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:33:29'),
(347, 30, 'Step 1: BioChemistry', 'bg-warning', '', '2022-03-16', '2022-03-18', '[]', '2022-03-18', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '121', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:33:58'),
(348, 30, 'Step 1: BioChemistry', 'bg-warning', '', '2022-03-21', '2022-03-21', '[\"2022-03-21\"]', '2022-03-21', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:34:55'),
(349, 30, 'Step 1: Genetics', 'bg-success', '', '2022-03-22', '2022-03-22', '[\"2022-03-22\"]', '2022-03-22', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '123', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:35:19'),
(350, 30, 'Step 1: Immunology', 'bg-danger', '', '2022-03-23', '2022-03-24', '[]', '2022-03-24', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '126', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:36:23'),
(351, 30, 'Step 1; Microbiology', 'bg-info', '', '2022-03-25', '2022-03-25', '[\"2022-03-25\"]', '2022-03-25', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '125', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:36:42'),
(352, 30, 'Step 1: Microbiology', 'bg-info', '', '2022-03-28', '2022-03-29', '[]', '2022-03-29', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '127', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:37:27'),
(353, 30, 'Step 1: Behavioral Science', 'bg-primary', '', '2022-03-30', '2022-04-01', '[]', '2022-04-01', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '128', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:38:23'),
(354, 30, 'Step 1: BioStat', 'bg-warning', '', '2022-04-04', '2022-04-04', '[\"2022-04-04\"]', '2022-04-04', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '129', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:38:49'),
(355, 30, 'Step 1: Dermatology', 'bg-success', '', '2022-04-05', '2022-04-05', '[\"2022-04-05\"]', '2022-04-05', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '130', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:39:28'),
(356, 30, 'Step 1: MSK', 'bg-danger', '', '2022-04-06', '2022-04-07', '[]', '2022-04-07', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '131', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:39:57'),
(357, 30, 'Step 1: Hematology', 'bg-info', '', '2022-04-08', '2022-04-08', '[\"2022-04-08\"]', '2022-04-08', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '132', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:40:45'),
(358, 30, 'Step 1: Hematology', 'bg-info', '', '2022-04-11', '2022-04-11', '[\"2022-04-11\"]', '2022-04-11', '09:00:00', '14:00:00', 'Does not repeat', 'false', 'No reminder', 'on', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:41:15'),
(359, 30, 'Step 3: GIT', 'bg-warning', '', '2022-02-14', '2022-02-15', '[]', '2022-02-15', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '133', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:43:04'),
(360, 30, 'Step 3: Endocrine', 'bg-primary', '', '2022-02-16', '2022-02-17', '[]', '2022-02-17', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '136', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:45:40'),
(361, 30, 'Step 3: Gynecology', 'bg-info', '', '2022-02-22', '2022-02-23', '[]', '2022-02-23', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '135', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:46:18'),
(362, 30, 'Step 3: Obstetrics', 'bg-info', '', '2022-02-24', '2022-02-25', '[]', '2022-02-25', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '137', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:46:56'),
(363, 30, 'Step 3: Nephrology', 'bg-danger', '', '2022-02-28', '2022-03-01', '[]', '2022-03-01', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '138', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:48:00'),
(364, 30, 'Step 3: Cardiology', 'bg-success', '', '2022-03-02', '2022-03-03', '[]', '2022-03-03', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '139', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:49:39'),
(365, 30, 'Step 3: Emergency Medicine', 'bg-warning', '', '2022-03-04', '2022-03-04', '[\"2022-03-04\"]', '2022-03-04', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '140', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:50:18'),
(366, 30, 'Step 3: Respiratory System', 'bg-danger', '', '2022-03-07', '2022-03-08', '[]', '2022-03-08', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '141', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:50:55'),
(367, 30, 'Step 3: Neurology', 'bg-info', '', '2022-03-09', '2022-03-10', '[]', '2022-03-10', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '142', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:51:31'),
(368, 30, 'Step 3: Dermatology', 'bg-success', '', '2022-03-11', '2022-03-11', '[\"2022-03-11\"]', '2022-03-11', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '143', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:52:43'),
(369, 30, 'Step 3: Rheumatology', 'bg-warning', '', '2022-03-14', '2022-03-15', '[]', '2022-03-15', '17:00:00', '19:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '144', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-11 22:58:17'),
(370, 47, 'Endocrine', 'bg-success', '', '2022-02-23', '2022-02-25', '[]', '2022-02-25', '08:30:00', '13:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '146', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:07:26'),
(371, 47, 'Male Repro', 'bg-info', '', '2022-02-28', '2022-02-28', '[\"2022-02-28\"]', '2022-02-28', '08:30:00', '14:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:08:12'),
(372, 47, 'Renal', 'bg-primary', '', '2022-03-01', '2022-03-04', '[]', '2022-03-04', '08:30:00', '14:30:00', 'Does not repeat', 'false', 'No reminder', 'on', '148', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:09:47'),
(373, 47, 'Respiratory', 'bg-success', '', '2022-03-07', '2022-03-09', '[]', '2022-03-09', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '149', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:11:33'),
(374, 47, 'Neuro', 'bg-danger', '', '2022-03-10', '2022-03-11', '[]', '2022-03-11', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '150', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:12:03'),
(375, 47, 'Neuro', 'bg-danger', '', '2022-03-14', '2022-03-15', '[]', '2022-03-15', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', 'no_drag_id', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:12:50'),
(376, 47, 'General principles', 'bg-info', 'Depending on Neurology ', '2022-03-16', '2022-03-18', '[]', '2022-03-18', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:13:31'),
(377, 47, 'Biochemistry', 'bg-warning', '', '2022-03-21', '2022-03-28', '[]', '2022-03-28', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '152', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:14:09'),
(378, 47, 'Immunology', 'bg-danger', '', '2022-03-29', '2022-03-31', '[]', '2022-03-31', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '153', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:14:43'),
(379, 47, 'Microbiology', 'bg-danger', '', '2022-04-01', '2022-04-05', '[]', '2022-04-05', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '154', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:15:14'),
(380, 47, 'Phsychiatry', 'bg-info', '', '2022-04-06', '2022-04-08', '[]', '2022-04-08', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '155', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:15:47'),
(381, 47, 'Biostats', 'bg-warning', 'depending on psych', '2022-04-06', '2022-04-08', '[]', '2022-04-08', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:16:19'),
(382, 47, 'MSK/Dermatology', 'bg-danger', '', '2022-04-12', '2022-04-15', '[]', '2022-04-15', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '157', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:16:40'),
(383, 47, 'Heme', 'bg-info', '', '2022-04-18', '2022-04-20', '[]', '2022-04-20', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '158', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:17:37'),
(384, 47, 'Repro female', 'bg-info', '', '2022-04-27', '2022-04-29', '[]', '2022-04-29', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '159', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:19:22'),
(385, 47, 'Cardiology', 'bg-warning', '', '2022-05-04', '2022-05-06', '[]', '2022-05-06', '11:00:00', '12:00:00', 'Does not repeat', 'false', 'No reminder', 'on', '160', '', '0000-00-00', '00:00:00', '', '', '', 'event', 0, 'active', '2022-02-22 21:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `hear_from`
--

CREATE TABLE `hear_from` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hear_from`
--

INSERT INTO `hear_from` (`id`, `name`, `status`, `date`) VALUES
(1, 'Magazine Ad', 'active', '2021-04-29 10:33:59'),
(2, 'E - News Letter', 'active', '2021-04-29 10:33:59'),
(3, 'Google', 'active', '2021-04-29 10:33:59'),
(4, 'Social Media', 'active', '2021-04-29 10:33:59'),
(5, 'Friend referral', 'active', '2021-04-29 10:33:59'),
(6, 'University referral', 'active', '2021-04-29 10:33:59'),
(7, 'Other', 'active', '2021-04-29 10:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `on_date` datetime NOT NULL,
  `category` text NOT NULL,
  `reason` text NOT NULL,
  `in_year` year(4) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `on_date`, `category`, `reason`, `in_year`, `status`, `date`) VALUES
(1, '2021-01-01 00:00:00', 'US & Common', 'New Year\'s Day', 2021, 'active', '2022-02-16 15:57:33'),
(2, '2021-01-18 00:00:00', 'US & Common', 'Martin Luther King Jr.', 2021, 'active', '2022-02-16 16:01:30'),
(3, '2021-01-20 00:00:00', 'US & Common', 'Inauguration Day', 2021, 'active', '2022-02-16 16:04:25'),
(4, '2021-02-02 00:00:00', 'US & Common', 'Groundhog Day', 2021, 'active', '2022-02-16 16:11:25'),
(5, '2021-02-07 00:00:00', 'US & Common', 'Super Bowl', 2021, 'active', '2022-02-17 19:43:13'),
(6, '2021-02-14 00:00:00', 'US & Common', 'Valentine\'s Day', 2021, 'active', '2022-02-17 19:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `names` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `names`, `status`, `date`) VALUES
(1, 'Study Allocator', 'active', '2021-04-05 20:10:26'),
(2, 'Scheduler', 'active', '2021-04-05 20:10:26'),
(3, 'CV Builder', 'active', '2021-04-05 20:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `motivator`
--

CREATE TABLE `motivator` (
  `id` int(11) NOT NULL,
  `quote` text NOT NULL,
  `writer` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motivator`
--

INSERT INTO `motivator` (`id`, `quote`, `writer`, `status`, `date`) VALUES
(1, 'Education is the most powerful weapon which you can use to change the world.', 'Nelson Mandela', 'active', '2022-01-24 17:10:14'),
(2, 'Take the attitude of a student, never be too big to ask questions, never know too much to learn something new.', 'Augustine OgMandino', 'active', '2022-01-25 13:32:01'),
(3, 'Just one small positive thought in the morning can change your whole day.', 'Dalai Lama', 'active', '2022-01-25 13:32:38'),
(4, 'The only one who can tell you “you can’t win” is you and you don’t have to listen.', 'Jessica Ennis', 'active', '2022-01-25 13:32:55'),
(5, 'When everything seems to be going against you, remember that the airplane takes off against the wind, not with it.', 'Henry Ford', 'active', '2022-01-25 13:33:10'),
(6, 'We are what we repeatedly do. Excellence, then, is not an act, but a habit.', 'Aristotle', 'active', '2022-01-25 13:36:10'),
(7, 'It’s not the will to win that matters—everyone has that. It’s the will to prepare to win that matters.', 'Paul Bryant', 'active', '2022-01-25 13:36:39'),
(8, 'Never give up on a dream just because of the time it will take to accomplish it. The time will pass anyway.', 'Earl Nightingale', 'active', '2022-01-25 13:37:03'),
(9, 'The two most important days in your life are the day you’re born and the day you find out why.', 'Mark Twain', 'active', '2022-01-25 13:37:21'),
(10, 'If there is no struggle, there is no progress.', 'Frederick Douglass', 'active', '2022-01-25 13:37:42'),
(11, 'If it makes you nervous, you’re doing it right.', 'Childish Gambino', 'active', '2022-01-25 13:37:59'),
(12, 'What you do makes a difference, and you have to decide what kind of difference you want to make.', 'Jane Goodall', 'active', '2022-01-25 13:38:26'),
(13, 'A surplus of effort could overcome a deficit of confidence.', 'Sonia Sotomayor', 'active', '2022-01-25 13:38:44'),
(14, 'Some people want it to happen, some wish it would happen, others make it happen.', 'Michael Jordan', 'active', '2022-01-25 13:38:58'),
(15, 'Don’t settle for what life gives you; make life better and build something.', 'Ashton Kutcher', 'active', '2022-01-25 13:39:14'),
(16, 'Life is a succession of lessons which must be lived to be understood.', 'Helen Keller', 'active', '2022-01-25 13:39:28'),
(17, 'Your work is going to fill a large part of your life, and the only way to be truly satisfied is to do what you believe is great work. And the only way to do great work is to love what you do. If you haven’t found it yet, keep looking. Don’t settle. As with all matters of the heart, you’ll know when you find it.', 'Steve Jobs', 'active', '2022-01-25 13:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `planner`
--

CREATE TABLE `planner` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `email_address` text NOT NULL,
  `mentor_request` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planner`
--

INSERT INTO `planner` (`id`, `student_id`, `mentor_id`, `course_id`, `title`, `email_address`, `mentor_request`, `status`, `date`) VALUES
(1, 1, 13, 1, 'Step 1 Planner - Part 1', '', 'accept', 'active', '2021-12-07 13:13:54'),
(2, 5, 0, 1, 'Planner 1', '', '', 'active', '2021-11-09 19:16:03'),
(3, 1, 13, 2, 'Step 2 CK Planner - Part 1', '', 'accept', 'active', '2021-12-07 13:14:10'),
(6, 1, 0, 3, 'Step 3 Planner - Part 2', '', '', 'active', '2021-12-07 13:14:27'),
(7, 1, 0, 1, 'Step 1 Planner - Part 2', '', '', 'active', '2021-12-07 13:14:34'),
(8, 1, 13, 3, 'Step 3 Planner - Part 3', '', 'accept', 'active', '2021-12-07 13:14:41'),
(9, 1, 13, 2, 'Step 2 CK Planner - Part 2', '', 'reject', 'active', '2021-12-07 13:14:48'),
(10, 1, 13, 2, 'Step 2 CK Planner - Part 3', '', 'accept', 'active', '2021-12-07 13:14:55'),
(11, 1, 0, 3, 'Step 3 Planner - Part 4', '', '', 'active', '2021-12-07 13:15:03'),
(12, 1, 13, 1, 'Step 1 Planner Final', '', 'accept', 'active', '2021-12-07 13:45:08'),
(13, 1, 13, 1, 'Step 1 Planner', '', '', 'active', '2021-12-08 19:47:43'),
(14, 1, 0, 2, 'Step 2 ck planner of usmle step 2', '', '', 'active', '2021-12-10 13:57:37'),
(17, 19, 0, 1, 'Bio', '', '', 'active', '2022-04-08 16:08:19'),
(18, 1, 0, 1, 'dgfdgfdfg', '', '', 'active', '2022-04-26 16:37:56'),
(19, 14, 0, 1, 'asad', '', '', 'active', '2022-05-25 13:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `planner_members`
--

CREATE TABLE `planner_members` (
  `id` int(11) NOT NULL,
  `planner_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `accept` int(11) NOT NULL,
  `reject` int(11) NOT NULL,
  `relation` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planner_members`
--

INSERT INTO `planner_members` (`id`, `planner_id`, `student_id`, `member_id`, `accept`, `reject`, `relation`, `status`, `date`) VALUES
(19, 4, 1, 4, 1, 0, 'owner', 'active', '2021-10-27 16:23:36'),
(20, 4, 1, 5, 1, 0, 'owner', 'active', '2021-10-27 16:23:37'),
(21, 4, 1, 6, 1, 0, 'owner', 'active', '2021-10-27 16:23:37'),
(56, 3, 1, 3, 1, 0, 'owner', 'active', '2021-10-29 14:07:38'),
(57, 5, 1, 3, 1, 0, 'owner', 'active', '2021-10-29 14:08:16'),
(58, 5, 1, 5, 1, 0, 'owner', 'active', '2021-10-29 14:08:16'),
(59, 5, 1, 7, 1, 0, 'owner', 'active', '2021-10-29 14:08:16'),
(61, 1, 1, 3, 1, 0, 'owner', 'active', '2021-10-29 14:09:33'),
(62, 1, 1, 4, 1, 0, 'owner', 'active', '2021-10-29 14:09:33'),
(67, 1, 1, 2, 1, 0, 'owner', 'active', '2021-10-29 17:20:50'),
(68, 1, 1, 5, 1, 0, 'owner', 'active', '2021-10-29 17:22:40'),
(69, 1, 1, 6, 1, 0, 'owner', 'active', '2021-10-29 17:22:40'),
(74, 6, 1, 3, 1, 0, 'owner', 'active', '2021-10-30 13:56:40'),
(75, 6, 1, 5, 1, 0, 'owner', 'active', '2021-10-30 13:56:56'),
(76, 6, 1, 11, 1, 0, 'owner', 'active', '2021-10-30 13:57:03'),
(77, 2, 1, 5, 0, 0, 'owner', 'active', '2021-10-30 14:23:22'),
(78, 2, 1, 6, 1, 0, 'owner', 'active', '2021-10-30 14:23:37'),
(79, 2, 1, 11, 0, 0, 'owner', 'active', '2021-10-30 14:23:45'),
(80, 3, 1, 5, 1, 0, 'owner', 'active', '2021-10-30 14:29:37'),
(81, 7, 1, 3, 0, 0, 'owner', 'active', '2021-11-01 16:29:49'),
(82, 7, 1, 5, 0, 0, 'owner', 'active', '2021-11-01 16:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `planner_task`
--

CREATE TABLE `planner_task` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planner_task`
--

INSERT INTO `planner_task` (`id`, `name`, `status`, `date`) VALUES
(1, 'Read', 'active', '2021-10-25 11:15:12'),
(2, 'Watch', 'active', '2021-10-25 11:15:12'),
(3, 'Do Questions', 'active', '2021-10-25 11:15:12'),
(4, 'Review', 'active', '2021-10-25 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `planner_template`
--

CREATE TABLE `planner_template` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planner_template`
--

INSERT INTO `planner_template` (`id`, `name`, `status`, `date`) VALUES
(1, 'Step 1', 'active', '2022-05-12 16:17:05'),
(2, 'Step 2 CK', 'active', '2022-05-12 16:19:51'),
(3, 'Step 3', 'active', '2022-05-12 16:51:47'),
(4, 'MCAT', 'active', '2022-05-12 16:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `program_cycle`
--

CREATE TABLE `program_cycle` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `course_code` text NOT NULL,
  `subject` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `hours` varchar(50) NOT NULL,
  `alc` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_cycle`
--

INSERT INTO `program_cycle` (`id`, `pid`, `day`, `course_code`, `subject`, `start_time`, `end_time`, `hours`, `alc`, `status`, `date`) VALUES
(2, 1, 1, 'S1-6RES1', 'Respiratory System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-12 13:06:00'),
(3, 1, 2, 'S1-6RES2', 'Respiratory System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-12 13:06:00'),
(4, 1, 3, 'S1-6NER1', 'Nervous System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-12 13:06:00'),
(5, 1, 4, 'S1-6NER2', 'Nervous System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-12 13:06:00'),
(6, 1, 5, 'S1-5NER3', 'Nervous System', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-12 13:06:00'),
(7, 1, 6, 'S1-5PAT', 'Gen. Principles - Pathology', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-12 13:06:00'),
(8, 1, 7, 'S1-5PAR', 'Gen. Principles - Pharmacology', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-12 13:06:00'),
(9, 1, 8, 'S1-4NUT', 'Biochemistry - Nutrition', '09:30:00', '13:30:00', '4:00', '120.00', 'active', '2022-02-12 13:06:00'),
(10, 1, 9, 'S1-4MOL', 'Biochemistry - Molecular & Cellular', '09:30:00', '13:30:00', '4:00', '120.00', 'active', '2022-02-12 13:06:00'),
(11, 1, 10, 'S1-6MET1', 'Biochemistry - Metabolism', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-12 13:06:00'),
(12, 1, 11, 'S1-6MET2', 'Biochemistry - Metabolism', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:11:38'),
(13, 1, 12, 'S1-6MET3', 'Biochemistry - Metabolism', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:12:52'),
(14, 1, 13, 'S1-5GEN', 'Genetics', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-14 19:13:53'),
(15, 1, 14, 'S1-6IMU1', 'Immunology', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:23:15'),
(16, 1, 15, 'S1-6IMU2', 'Immunology', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:23:58'),
(17, 1, 16, 'S1-6BAC', 'Microbiology - Bacteriology', '09:30:00', '13:00:00', '6:00', '180.00', 'active', '2022-02-14 19:25:04'),
(18, 1, 17, 'S1-6MYC', 'Microbiology - Mycology & Parasitology', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:25:37'),
(19, 1, 18, 'S1-5VIR', 'Microbiology - Virology', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-14 19:26:14'),
(20, 1, 19, 'S1-6PSY1', 'Behavioral Sciences - Psychiatry', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:26:49'),
(21, 1, 20, 'S1-6PSY2', 'Behavioral Sciences - Psychiatry', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:27:39'),
(22, 1, 21, 'S1-5EPI', 'Biostatistics / Epidemiology', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-14 19:28:53'),
(23, 1, 22, 'S1-4PHE', 'Biostatistics / Public Health & Ethics', '09:30:00', '13:30:00', '4:00', '120.00', 'active', '2022-02-14 19:29:49'),
(24, 1, 23, 'S1-4DER', 'Dermatology', '09:30:00', '14:30:00', '4:00', '150.00', 'active', '2022-02-14 19:43:54'),
(25, 1, 24, 'S1-5MUS1', 'Musculoskeletal / CTD', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-14 19:44:33'),
(26, 1, 25, 'S1-5MUS2', 'Musculoskeletal / CTD', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-14 19:45:02'),
(27, 1, 26, 'S1-5HEM1', 'Hematology System', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-14 19:45:39'),
(28, 1, 27, 'S1-5HEM2', 'Hematology System', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-14 19:46:10'),
(29, 1, 28, 'S1-6GAS1', 'Gastrointestinal System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:47:12'),
(30, 1, 29, 'S1-6GAS2', 'Gastrointestinal System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:48:06'),
(31, 1, 30, 'S1-6END1', 'Endocrine System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:48:29'),
(32, 1, 31, 'S1-6END2', 'Endocrine System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:48:59'),
(33, 1, 32, 'S1-5REP1', 'Reproductive - Female', '09:30:00', '14:30:00', '5:00', '150.00', 'active', '2022-02-14 19:49:30'),
(34, 1, 33, 'S1-5REP2', 'Reproductive - Female', '09:30:00', '14:30:00', '5:00', '180.00', 'active', '2022-02-14 19:49:56'),
(35, 1, 34, 'S1-2REP3', 'Reproductive - Male', '09:30:00', '12:00:00', '2:30', '75.00', 'active', '2022-02-14 19:51:03'),
(36, 1, 35, 'S1-6REN1', 'Renal System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:52:01'),
(37, 1, 36, 'S1-6REN2', 'Renal System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:52:26'),
(38, 1, 37, 'S1-6CAR1', 'Cardiovascular System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:52:53'),
(39, 1, 38, 'S1-6CAR2', 'Cardiovascular System', '09:30:00', '15:30:00', '6:00', '180.00', 'active', '2022-02-14 19:53:18'),
(40, 2, 1, 'S2-5RHE1', 'Rheumotology', '04:00:00', '09:00:00', '5:00', '150.00', 'active', '2022-05-10 18:07:06'),
(41, 2, 2, 'S2-5RHE2', 'Rheumotology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 16:52:17'),
(42, 2, 3, 'S2-5DER', 'Dermatology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 17:10:06'),
(43, 2, 4, 'S2-5GAS1', 'Gastreontology', '21:00:00', '16:00:00', '5:00', '150.00', 'active', '2022-05-13 17:24:44'),
(44, 2, 5, 'S2-5GAS2', 'Gastreontology', '21:00:00', '16:00:00', '5:00', '150.00', 'active', '2022-05-13 17:26:36'),
(45, 2, 6, 'S2-3HEP1', 'Hepatology', '16:00:00', '19:00:00', '3:00', '90.00', 'active', '2022-05-13 17:27:47'),
(46, 2, 7, 'S2-3HEP2', 'Hepatology', '16:00:00', '19:00:00', '3:00', '90.00', 'active', '2022-05-13 17:28:57'),
(47, 2, 8, 'S2-5NEP1', 'Nephrology', '16:00:00', '21:59:00', '5:00', '150.00', 'active', '2022-05-13 17:30:09'),
(48, 2, 9, 'S2-5NEP2', 'Nephrology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 21:42:25'),
(49, 2, 10, 'S2-5ELE', 'Electrolytes', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 21:49:19'),
(50, 2, 11, 'S2-5NEP3', 'Nephrology', '16:00:00', '16:00:00', '5:00', '150.00', 'active', '2022-05-13 21:56:20'),
(51, 2, 12, 'S2-5NEP4', 'Nephrology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 21:58:01'),
(52, 2, 13, 'S2-5END1', 'Endocrine', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 21:59:40'),
(53, 2, 14, 'S2-5END2', 'Endocrine', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:00:46'),
(54, 2, 15, 'S2-5HEM1', 'Hematology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:02:17'),
(55, 2, 16, 'S2-5HEM2', 'Hematology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:03:26'),
(56, 2, 17, 'S2-5BIO', 'Biostatistics', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:05:20'),
(57, 2, 18, 'S2-5PSY1', 'Psychiatry', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:07:44'),
(58, 2, 19, 'S2-5PSY2', 'Psychiatry', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:08:48'),
(59, 2, 20, 'S2-5GNY1', 'Gynecology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:10:33'),
(60, 2, 21, 'S2-5GNY2', 'Gynecology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:11:15'),
(61, 2, 22, 'S2-5OBS1', 'Obstetrics', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:12:34'),
(62, 2, 23, 'S2-5OBS2', 'Obstetrics', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:13:29'),
(63, 2, 24, 'S2-3SUR1', 'Surgery', '16:00:00', '19:00:00', '3.00', '90.00', 'active', '2022-05-13 22:15:51'),
(64, 2, 25, 'S2-3SUR2', 'Surgery', '16:00:00', '19:00:00', '3:00', '90.00', 'active', '2022-05-13 22:17:03'),
(65, 2, 26, 'S2-3SUR3', 'Surgery', '16:59:00', '19:00:00', '3:00', '90.00', 'active', '2022-05-13 22:17:37'),
(66, 2, 27, 'S2-3PED1', 'Pediatrics', '16:00:00', '19:00:00', '3:00', '90.00', 'active', '2022-05-13 22:18:53'),
(67, 2, 28, 'S2-3PED2', 'Pediatrics', '16:00:00', '19:00:00', '3:00', '90.00', 'active', '2022-05-13 22:19:44'),
(68, 2, 29, 'S2-3PED3', 'Pediatrics', '16:00:00', '19:00:00', '3:00', '90.00', 'active', '2022-05-13 22:20:42'),
(69, 2, 30, 'S2-3PED4', 'Pediatrics', '16:00:00', '19:00:00', '3:00', '90.00', 'active', '2022-05-13 22:21:17'),
(70, 2, 31, 'S2-3INF1', 'Infectious Diseases', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:23:52'),
(71, 2, 32, 'S2-3INF2', 'Infectious Diseases', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:24:31'),
(72, 2, 33, 'S2-3CAR1', 'Cardiology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:27:14'),
(73, 2, 34, 'S2-3CAR2', 'Cardiology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:27:48'),
(74, 2, 35, 'S2-3CAR3', 'Cardiology', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:28:31'),
(75, 2, 36, 'S2-3EMED', 'E Medicine', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:29:52'),
(76, 2, 37, 'S2-3PUL1', 'Pulmonolgy', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:31:09'),
(77, 2, 38, 'S2-3PUL2', 'Pulmonolgy', '16:00:00', '21:00:00', '5:00', '150.00', 'active', '2022-05-13 22:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `reg_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email_address` text NOT NULL,
  `password` text NOT NULL,
  `login_password` text NOT NULL,
  `role_id` int(11) NOT NULL,
  `start_cycle` datetime NOT NULL,
  `country_code` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `gender_other` text NOT NULL,
  `dob` date NOT NULL,
  `logged_in_with` text NOT NULL,
  `profile_link` text NOT NULL,
  `socialmedia_id` text NOT NULL,
  `socialmedia_picture` text NOT NULL,
  `google_locale` text NOT NULL,
  `hear_from` text NOT NULL,
  `hear_from_other` text NOT NULL,
  `university` varchar(100) NOT NULL,
  `university_other` text NOT NULL,
  `school_attend` int(11) NOT NULL,
  `school_attend_other` text NOT NULL,
  `is_graduated` varchar(10) NOT NULL,
  `graduated_when` date NOT NULL,
  `usmle_before` varchar(10) NOT NULL,
  `usmle_when` date NOT NULL,
  `review_programs` varchar(10) NOT NULL,
  `review_programs_when` date NOT NULL,
  `review_programs_which` text NOT NULL,
  `photo` text NOT NULL,
  `profile_visit` int(11) NOT NULL,
  `course_visit` int(11) NOT NULL,
  `mail_code` text NOT NULL,
  `verification_code` text NOT NULL,
  `verified` varchar(10) NOT NULL,
  `mail_date` datetime NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`reg_id`, `first_name`, `middle_name`, `last_name`, `email_address`, `password`, `login_password`, `role_id`, `start_cycle`, `country_code`, `phone_number`, `gender`, `gender_other`, `dob`, `logged_in_with`, `profile_link`, `socialmedia_id`, `socialmedia_picture`, `google_locale`, `hear_from`, `hear_from_other`, `university`, `university_other`, `school_attend`, `school_attend_other`, `is_graduated`, `graduated_when`, `usmle_before`, `usmle_when`, `review_programs`, `review_programs_when`, `review_programs_which`, `photo`, `profile_visit`, `course_visit`, `mail_code`, `verification_code`, `verified`, `mail_date`, `reg_date`) VALUES
(1, 'Afrin', 'Murtuza', 'Sayed', 'shaikhafrin33@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 1, '0000-00-00 00:00:00', 0, 8975837654, 'female', '', '0000-00-00', '', '', '', '', '', 'Other', 'dsesdw', '', '', 90, '', 'no', '0000-00-00', 'yes', '2021-11-11', 'no', '0000-00-00', '', '1558068317106.jpg', 2, 1, '61e6586527e8061e6586527e86', '', 'yes', '2022-01-18 11:34:32', '2021-04-14 12:58:07'),
(14, 'Afrin', '', 'Sayed', 'shaikhafrin3223@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 0, '2022-03-07 00:00:00', 0, 0, '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 1, 1, '', '61e520be01c5d61e520be01c68', 'yes', '0000-00-00 00:00:00', '2022-01-17 13:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `status`, `date`) VALUES
(1, 'Mentor', 'active', '2021-11-03 10:31:17'),
(2, 'Enroller', 'active', '2021-11-03 10:31:17'),
(3, 'Tutor', 'active', '2021-11-15 10:31:17'),
(4, 'Instructor', 'active', '2021-11-15 10:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `school_names`
--

CREATE TABLE `school_names` (
  `id` int(11) NOT NULL,
  `names` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_names`
--

INSERT INTO `school_names` (`id`, `names`, `status`, `date`) VALUES
(1, 'Addis Ababa University, Ethiopia', 'active', '2021-04-05 16:11:33'),
(2, 'Al Mustan Syria University COM ', 'active', '2021-04-05 16:11:33'),
(3, 'Al-Kindy COM Baghdad University', 'active', '2021-04-05 16:11:33'),
(4, 'Albert Einstein COM', 'active', '2021-04-05 16:11:33'),
(5, 'All Saints University SOM', 'active', '2021-04-05 16:11:33'),
(6, 'American International SOM', 'active', '2021-04-05 16:11:33'),
(7, 'American University of Antigua COM', 'active', '2021-04-05 16:11:33'),
(8, 'American University of Carribean', 'active', '2021-04-05 16:11:33'),
(9, 'American University of Integrative Sciences', 'active', '2021-04-05 16:11:33'),
(10, 'American University School of Medicine Aruba', 'active', '2021-04-05 16:11:33'),
(11, 'Amrita Institute of Medical Sciences', 'active', '2021-04-05 16:11:33'),
(12, 'Apollo Institute of Medical Sciences & Research', 'active', '2021-04-05 16:11:33'),
(13, 'Atlantic University', 'active', '2021-04-05 16:11:33'),
(14, 'Aureus University School of Medicine', 'active', '2021-04-05 16:11:33'),
(15, 'Avalon Univeresity SOM', 'active', '2021-04-05 16:11:33'),
(16, 'Baghdad College of Medicine', 'active', '2021-04-05 16:11:33'),
(17, 'Baylor University', 'active', '2021-04-05 16:11:33'),
(18, 'Bhaskar Medical College, India', 'active', '2021-04-05 16:11:33'),
(19, 'Cairo University, Egypt', 'active', '2021-04-05 16:11:33'),
(20, 'California Northstate University COM', 'active', '2021-04-05 16:11:33'),
(21, 'Caribbean Medical University', 'active', '2021-04-05 16:11:33'),
(22, 'Case Western Reserve University SOM', 'active', '2021-04-05 16:11:33'),
(23, 'Catholic University of Santa María', 'active', '2021-04-05 16:11:33'),
(24, 'Crete SOM', 'active', '2021-04-05 16:11:33'),
(25, 'Dammam University', 'active', '2021-04-05 16:11:33'),
(26, 'Dhaka Medical College, Bangladesh', 'active', '2021-04-05 16:11:33'),
(27, 'Emory University', 'active', '2021-04-05 16:11:33'),
(28, 'Ethnikon kai Kapodistriakon Panepistimion, Greece', 'active', '2021-04-05 16:11:33'),
(29, 'Faculte De Medecine de Besancon', 'active', '2021-04-05 16:11:33'),
(30, 'First Pavlov State Med. Univ. of St. Petersburg, Russia', 'active', '2021-04-05 16:11:33'),
(31, 'Fundacion Barcelo, Argentina', 'active', '2021-04-05 16:11:33'),
(32, 'Gazi University Medical School, Turkey', 'active', '2021-04-05 16:11:33'),
(33, 'Hacettepe Üniversity', 'active', '2021-04-05 16:11:33'),
(34, 'Heidelberg Universiity SOM', 'active', '2021-04-05 16:11:33'),
(35, 'Ibilis State Medical Univ. (Rep. of GA)', 'active', '2021-04-05 16:11:33'),
(36, 'Icahn School of Medicine at Mount Sinai', 'active', '2021-04-05 16:11:33'),
(37, 'International American University SOM', 'active', '2021-04-05 16:11:33'),
(38, 'Kathmandu University', 'active', '2021-04-05 16:11:33'),
(39, 'Kempegowda', 'active', '2021-04-05 16:11:33'),
(40, 'Lady Hardinge Medical College', 'active', '2021-04-05 16:11:33'),
(41, 'Mahidol Univ. / American Global Univ.', 'active', '2021-04-05 16:11:33'),
(42, 'Maringa State University,  Brazil', 'active', '2021-04-05 16:11:33'),
(43, 'Medical College of Baroda', 'active', '2021-04-05 16:11:33'),
(44, 'Medical College of Georgia', 'active', '2021-04-05 16:11:33'),
(45, 'Medical University of South Carolina', 'active', '2021-04-05 16:11:33'),
(46, 'Meharry Medical College', 'active', '2021-04-05 16:11:33'),
(47, 'Mercer University SOM', 'active', '2021-04-05 16:11:33'),
(48, 'MGM Medical College Navi Mumbai', 'active', '2021-04-05 16:11:33'),
(49, 'Mimer Medical College, India', 'active', '2021-04-05 16:11:33'),
(50, 'Morehouse SOM', 'active', '2021-04-05 16:11:33'),
(51, 'Obafemi Awolowo University ', 'active', '2021-04-05 16:11:33'),
(52, 'Philadelphia College of Osteopathic Medicine (PCOM)', 'active', '2021-04-05 16:11:33'),
(53, 'Ross University  SOM', 'active', '2021-04-05 16:11:33'),
(54, 'Royal College of Surgeons - Med. University of Bahrain', 'active', '2021-04-05 16:11:33'),
(55, 'Russia, Novoibizsk Med. Academy', 'active', '2021-04-05 16:11:33'),
(56, 'SABA University SOM', 'active', '2021-04-05 16:11:33'),
(57, 'Saint James School of Medicine', 'active', '2021-04-05 16:11:33'),
(58, 'Santa Casa of Sao Paulo Medical School', 'active', '2021-04-05 16:11:33'),
(59, 'Serbian Medical School', 'active', '2021-04-05 16:11:33'),
(60, 'Shandong University SOM', 'active', '2021-04-05 16:11:33'),
(61, 'SOMAH, Unversity of the Gambia', 'active', '2021-04-05 16:11:33'),
(62, 'South East Medical University', 'active', '2021-04-05 16:11:33'),
(63, 'Spartan Health Sciences', 'active', '2021-04-05 16:11:33'),
(64, 'St. Georges University SOM', 'active', '2021-04-05 16:11:33'),
(65, 'St. Matthew\'s University SOM', 'active', '2021-04-05 16:11:33'),
(66, 'Suez Canal University', 'active', '2021-04-05 16:11:33'),
(67, 'Texilla American University', 'active', '2021-04-05 16:11:33'),
(68, 'Tishreen University, Syria', 'active', '2021-04-05 16:11:33'),
(69, 'Trinity School of Medicine', 'active', '2021-04-05 16:11:33'),
(70, 'UAG - Universidad Autónoma de Guadalajara', 'active', '2021-04-05 16:11:33'),
(71, 'University of Mediciine and Health Sciences', 'active', '2021-04-05 16:11:33'),
(72, 'UNITAU - University of Taubaté, Brazil', 'active', '2021-04-05 16:11:33'),
(73, 'University Autonoma de Guadalajara', 'active', '2021-04-05 16:11:33'),
(74, 'University of Damascus', 'active', '2021-04-05 16:11:33'),
(75, 'Univeristy of Haiti SOM', 'active', '2021-04-05 16:11:33'),
(76, 'University of Ilorin, Nigeria', 'active', '2021-04-05 16:11:33'),
(77, 'University of Lago, Nigeria', 'active', '2021-04-05 16:11:33'),
(78, 'University of South Carolina', 'active', '2021-04-05 16:11:33'),
(79, 'Universidad de Panama SOM', 'active', '2021-04-05 16:11:33'),
(80, 'Universidad del Zulia', 'active', '2021-04-05 16:11:33'),
(81, 'Universidad Latino de Costa Rica', 'active', '2021-04-05 16:11:33'),
(82, 'Université de Bourgogne, France', 'active', '2021-04-05 16:11:33'),
(83, 'University of Georgia', 'active', '2021-04-05 16:11:33'),
(84, 'University of Health Sciences Antigua', 'active', '2021-04-05 16:11:33'),
(85, 'University of Pisa, Italy', 'active', '2021-04-05 16:11:33'),
(86, 'University of Titu Maiorescu, Bucharest', 'active', '2021-04-05 16:11:33'),
(87, 'University of Science, Arts and Technology', 'active', '2021-04-05 16:11:33'),
(88, 'Usmania SOM', 'active', '2021-04-05 16:11:33'),
(89, 'VCOM - Carolinas', 'active', '2021-04-05 16:11:33'),
(90, 'Washington University of Health & Sciences', 'active', '2021-04-05 16:11:33'),
(91, 'Windsor University SOM ', 'active', '2021-04-05 16:11:33'),
(92, 'Xavier University SOM', 'active', '2021-04-05 16:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `is_scheduled` varchar(10) NOT NULL,
  `exam_date` date NOT NULL,
  `confidence_level_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`id`, `student_id`, `course_id`, `is_scheduled`, `exam_date`, `confidence_level_id`, `status`, `date`) VALUES
(1, 3, 1, 'no', '0000-00-00', 1, 'active', '2021-04-21 14:02:14'),
(2, 6, 3, 'yes', '2021-06-30', 2, 'active', '2021-04-29 15:31:34'),
(3, 9, 2, 'yes', '2022-01-15', 1, 'active', '2021-11-08 11:26:28'),
(4, 13, 2, 'yes', '2022-01-11', 2, 'active', '2021-11-08 14:48:15'),
(6, 1, 2, 'no', '2022-04-26', 2, 'active', '2021-11-09 14:56:32'),
(7, 5, 2, 'yes', '2022-01-11', 2, 'active', '2021-11-09 19:14:53'),
(9, 19, 2, 'no', '2022-04-21', 2, 'active', '2022-04-08 15:41:33'),
(10, 14, 1, 'no', '2022-05-25', 2, 'active', '2022-05-25 13:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `student_module`
--

CREATE TABLE `student_module` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_module`
--

INSERT INTO `student_module` (`id`, `student_id`, `module_id`, `status`, `date`) VALUES
(2, 2, 2, 'active', '2021-04-15 13:47:16'),
(3, 3, 2, 'active', '2021-04-22 12:18:48'),
(4, 4, 2, 'active', '2021-04-22 15:33:41'),
(5, 5, 2, 'active', '2021-04-28 10:34:14'),
(6, 1, 2, 'active', '2021-04-29 12:09:46'),
(7, 6, 1, 'active', '2021-04-29 15:19:33'),
(8, 7, 2, 'active', '2021-06-01 13:41:02'),
(10, 8, 2, 'active', '2021-06-28 14:14:06'),
(11, 10, 2, 'active', '2021-07-05 13:14:29'),
(12, 11, 2, 'active', '2021-07-15 20:03:55'),
(13, 9, 1, 'active', '2021-11-08 11:13:21'),
(16, 13, 1, 'active', '2021-11-08 14:47:22'),
(18, 1, 1, 'active', '2021-11-09 14:33:11'),
(19, 5, 1, 'active', '2021-11-09 19:07:07'),
(20, 18, 1, 'active', '2022-04-07 12:39:17'),
(21, 19, 1, 'active', '2022-04-08 15:41:21'),
(23, 14, 1, 'active', '2022-05-25 13:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `study_block`
--

CREATE TABLE `study_block` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `planner_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `planner_task_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `duration` varchar(50) NOT NULL,
  `timer` int(11) NOT NULL,
  `is_completed` varchar(20) NOT NULL,
  `reminder` varchar(50) NOT NULL,
  `files` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_block`
--

INSERT INTO `study_block` (`id`, `student_id`, `planner_id`, `course_id`, `subject_id`, `planner_task_id`, `notes`, `start_date`, `start_time`, `duration`, `timer`, `is_completed`, `reminder`, `files`, `status`, `date`) VALUES
(1, 1, 1, 1, 2, 1, 'All the notes related to biochemistry examination question bank.\r\nStudy the chemistry of living things. Biochemistry is a rigorous field of study involving foundational and introductory courses in biology and chemistry with laboratory components, as well as advanced courses exploring topics such as cell biology, microbiology and genetics', '2021-11-17', '19:00:00', '4.5 hrs', 1, '', '5 minutes before', 'mail-after-registration-through-socialmedia.png, EduAdmin_-_Dashboard_Invoice_List13.pdf', 'active', '2021-11-22 19:09:57'),
(2, 1, 3, 2, 29, 3, 'Write all question and answers of Nephrology of Step 2 CK exam.\r\nNephrology is a specialty within the internal medicine field related to kidney care. It is often connected with hypertension or high blood pressure. Nephrologists are medical professionals who diagnose, treat, and manage acute and chronic kidney problems and diseases.', '2021-10-26', '15:00:00', '1.5 hrs', 1, 'yes', 'No reminder', '1634820695_Study_Planner_Workflow2.xlsx', 'active', '2021-11-13 15:31:44'),
(3, 1, 3, 2, 22, 2, 'Review all the chapters of emergency medical services of Step 2 CK exam.\r\nEmergency medicine is the medical specialty dedicated to the diagnosis and treatment of unforeseen illness or injury. Emergency medicine encompasses planning, oversight, and medical direction for community emergency medical response, medical control, and disaster preparedness.', '2021-10-26', '11:15:00', '0 mins', 0, 'yes', 'No reminder', ' EduAdmin_-_Dashboard_Invoice_List.pdf', 'active', '2021-10-30 14:29:37'),
(4, 1, 1, 1, 15, 4, 'Microbiology is the study of microscopic organisms, such as bacteria, viruses, archaea, fungi and protozoa. This discipline includes fundamental research on the biochemistry, physiology, cell biology, ecology, evolution and clinical aspects of microorganisms, including the host response to these agents.', '2021-10-30', '07:00:00', '30 mins', 1, '', '1 day before', 'EduAdmin_-_Dashboard_Invoice_List1.pdf, create-email.png', 'active', '2021-11-22 18:37:48'),
(5, 1, 3, 2, 27, 3, 'Question bank for hepatology.\r\nHepatology is an area of medicine that focuses on diseases of the liver as well as related conditions. A hepatologist is a specialized doctor involved in the diagnosis and treatment of hepatic diseases, which include issues that affect your: liver. gallbladder.', '2021-10-27', '09:00:00', '30 mins', 1, '', '30 minutes before', 'EduAdmin_-_Dashboard_Invoice_List1.xlsx, 1634820695_Study_Planner_Workflow3.xlsx', 'active', '2021-10-29 14:08:16'),
(6, 1, 1, 1, 4, 1, 'Cardiology is a medical specialty and a branch of internal medicine concerned with disorders of the heart. It deals with the diagnosis and treatment of such conditions as congenital heart defects, coronary artery disease, electrophysiology, heart failure and valvular heart disease.', '2021-11-02', '11:00:00', '30 mins', 1, 'yes', '5 minutes before', '1634820695_Study_Planner_Workflow4.xlsx, Splunk_APAC_ABM_FY21Q4_-_Assets.docx', 'active', '2021-12-07 13:15:27'),
(7, 1, 3, 2, 24, 2, '', '2021-11-03', '11:30:00', '30 mins', 1, '', '30 minutes before', 'ecommerce_functionality.docx', 'active', '2021-11-18 14:07:54'),
(8, 1, 3, 2, 23, 2, 'ht tryrtyrt', '2021-11-13', '11:00:00', '15 mins', 1, '', '2 days before', 'microsoft37.sql, medsmarter_(4).sql', 'active', '2021-11-13 13:24:46'),
(9, 1, 10, 2, 27, 2, 'notes', '2021-11-17', '11:00:00', '15 mins', 1, '', '15 minutes before', 'screencapture-mail-google-mail-u-1-2021-11-16-18_39_54.png', 'active', '2021-11-17 11:15:15'),
(10, 1, 1, 1, 5, 3, 'Emergency medicine is the medical speciality concerned with the care of illnesses or injuries requiring immediate medical attention. Emergency physicians (often called “ER doctors” in the United States) continuously learn to care for unscheduled and undifferentiated patients of all ages.', '2021-11-25', '11:30:00', '45 mins', 1, '', '15 minutes before', '1634820695_Study_Planner_Workflow_(2).xlsx, study-block-request1.png', 'active', '2021-12-07 13:43:19'),
(15, 1, 1, 1, 18, 3, 'cfdh er ter te rtert', '2021-11-24', '11:00:00', '15 mins', 1, 'yes', '30 minutes before', 'index_(1)2.php', 'active', '2021-11-24 20:10:41'),
(16, 1, 4, 3, 45, 3, 'notes', '2021-12-06', '11:00:00', '30 mins', 1, '', '1 hour before', 'Steps_to_login_Medsmarter.edited.docx', 'active', '2021-12-06 14:04:19'),
(19, 1, 12, 1, 12, 3, '', '2021-12-07', '11:00:00', '30 mins', 1, '', 'No reminder', 'logo-dark-text111.png', 'active', '2021-12-07 13:46:51'),
(21, 19, 17, 1, 1, 1, 'Test', '2022-04-16', '11:15:00', '0 mins', 0, '', 'No reminder', '', 'active', '2022-04-08 16:08:56'),
(24, 1, 19, 2, 18, 2, 'xcvxcv', '2022-04-23', '11:00:00', '0 mins', 0, '', 'No reminder', '', 'active', '2022-04-23 11:36:19'),
(25, 1, 18, 1, 9, 3, 'dfgdfgdfgs', '2022-04-26', '11:45:00', '0 mins', 0, '', 'No reminder', '', 'active', '2022-04-26 16:39:36'),
(26, 1, 1, 1, 9, 2, 'vbfdgdfgdfg', '2022-05-13', '12:00:00', '8 hrs', 0, '', 'No reminder', '', 'active', '2022-05-13 11:34:22'),
(27, 14, 19, 1, 3, 2, 'asas', '2022-05-25', '11:00:00', '0 mins', 0, '', 'No reminder', '', 'active', '2022-05-25 13:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course_id`, `name`, `status`, `date`) VALUES
(1, 1, 'Behavioral Science', 'active', '2021-10-25 11:26:30'),
(2, 1, 'Biochemistry', 'active', '2021-10-25 11:26:30'),
(3, 1, 'Biostatistics', 'active', '2021-10-25 11:26:30'),
(4, 1, 'Cardiology', 'active', '2021-10-25 11:26:30'),
(5, 1, 'Dermatology', 'active', '2021-10-25 11:26:30'),
(6, 1, 'Endocrinology', 'active', '2021-10-25 11:26:30'),
(7, 1, 'Gastrointestinal', 'active', '2021-10-25 11:26:30'),
(8, 1, 'General Principals', 'active', '2021-10-25 11:26:30'),
(9, 1, 'Genetics', 'active', '2021-10-25 11:26:30'),
(10, 1, 'Hematology', 'active', '2021-10-25 11:26:30'),
(11, 1, 'Immunology', 'active', '2021-10-25 11:26:30'),
(12, 1, 'Reproductive System', 'active', '2021-10-25 11:26:30'),
(13, 1, 'Renal System', 'active', '2021-10-25 11:26:30'),
(14, 1, 'Respiratory', 'active', '2021-10-25 11:26:30'),
(15, 1, 'Microbiology', 'active', '2021-10-25 11:26:30'),
(16, 1, 'Musculoskeletal', 'active', '2021-10-25 11:26:30'),
(17, 1, 'Nervous System', 'active', '2021-10-25 11:26:30'),
(18, 2, 'Biostatistics', 'active', '2021-10-25 11:26:30'),
(19, 2, 'Cardiology', 'active', '2021-10-25 11:26:30'),
(20, 2, 'Dermatology', 'active', '2021-10-25 11:26:30'),
(21, 2, 'Electrolytes', 'active', '2021-10-25 11:26:30'),
(22, 2, 'Emergency Medicine', 'active', '2021-10-25 11:26:30'),
(23, 2, 'Endocrine', 'active', '2021-10-25 11:26:30'),
(24, 2, 'Gastroenterology', 'active', '2021-10-25 11:26:30'),
(25, 2, 'Gynecology', 'active', '2021-10-25 11:26:30'),
(26, 2, 'Hematology', 'active', '2021-10-25 11:26:30'),
(27, 2, 'Hepatology', 'active', '2021-10-25 11:26:30'),
(28, 2, 'Infectious Diseases', 'active', '2021-10-25 11:26:30'),
(29, 2, 'Nephrology', 'active', '2021-10-25 11:26:30'),
(30, 2, 'Neurology', 'active', '2021-10-25 11:26:30'),
(31, 2, 'Obstetrics', 'active', '2021-10-25 11:26:30'),
(32, 2, 'Pediatrics', 'active', '2021-10-25 11:26:30'),
(33, 2, 'Psychiatry', 'active', '2021-10-25 11:26:30'),
(34, 2, 'Pulmonology', 'active', '2021-10-25 11:26:30'),
(35, 2, 'Rheumatology', 'active', '2021-10-25 11:26:30'),
(36, 2, 'Surgery', 'active', '2021-10-25 11:26:30'),
(37, 3, 'Biostatistics', 'active', '2021-10-25 11:26:30'),
(38, 3, 'Cardiology', 'active', '2021-10-25 11:26:30'),
(39, 3, 'Dermatology', 'active', '2021-10-25 11:26:30'),
(40, 3, 'Electrolytes', 'active', '2021-10-25 11:26:30'),
(41, 3, 'Emergency Medicine', 'active', '2021-10-25 11:26:30'),
(42, 3, 'Endocrine', 'active', '2021-10-25 11:26:30'),
(43, 3, 'Gastroenterology', 'active', '2021-10-25 11:26:30'),
(44, 3, 'Gynecology', 'active', '2021-10-25 11:26:30'),
(45, 3, 'Hematology', 'active', '2021-10-25 11:26:30'),
(46, 3, 'Hepatology', 'active', '2021-10-25 11:26:30'),
(47, 3, 'Infectious Diseases', 'active', '2021-10-25 11:26:30'),
(48, 3, 'Nephrology', 'active', '2021-10-25 11:26:30'),
(49, 3, 'Neurology', 'active', '2021-10-25 11:26:30'),
(50, 3, 'Obstetrics', 'active', '2021-10-25 11:26:30'),
(51, 3, 'Pediatrics', 'active', '2021-10-25 11:26:30'),
(52, 3, 'Psychiatry', 'active', '2021-10-25 11:26:30'),
(53, 3, 'Pulmonology', 'active', '2021-10-25 11:26:30'),
(54, 3, 'Rheumatology', 'active', '2021-10-25 11:26:30'),
(55, 3, 'Surgery', 'active', '2021-10-25 11:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `username`, `password`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `sort_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_note` text NOT NULL,
  `task_category` text NOT NULL,
  `task_start_date` date NOT NULL,
  `task_start_time` time NOT NULL,
  `task_allDay` varchar(10) NOT NULL,
  `task_reminder` varchar(30) NOT NULL,
  `priority` varchar(20) NOT NULL,
  `is_completed` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `sort_id`, `student_id`, `event_id`, `task_name`, `task_note`, `task_category`, `task_start_date`, `task_start_time`, `task_allDay`, `task_reminder`, `priority`, `is_completed`, `status`, `date`) VALUES
(1, 0, 1, 0, 'task 1', '', '', '2022-03-03', '11:00:00', 'false', 'No reminder', 'High Priority', 'yes', 'active', '2022-03-03 18:40:47'),
(2, 0, 19, 9, 'sn', 'nk', '', '2022-04-21', '13:30:00', 'false', 'No reminder', 'High Priority', '', 'active', '2022-04-18 12:47:19'),
(3, 0, 19, 9, 'bnvb', 'bvnvbnv', '', '2022-04-18', '00:00:00', 'true', 'No reminder', 'High Priority', '', 'active', '2022-04-18 12:48:51'),
(4, 0, 1, 3, 'Tsask', 'Task 1', '', '2022-06-15', '11:00:00', 'false', 'No reminder', 'High Priority', '', 'active', '2022-06-15 17:49:14'),
(5, 0, 0, 0, 'T1', 'Test', '', '2022-06-16', '11:00:00', 'false', 'No reminder', 'High Priority', '', 'active', '2022-06-16 07:40:48'),
(6, 0, 1, 1, 'dummy', '', '', '2022-06-22', '11:00:00', 'false', 'No reminder', 'High Priority', '', 'active', '2022-06-20 20:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `time_12hours`
--

CREATE TABLE `time_12hours` (
  `id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_12hours`
--

INSERT INTO `time_12hours` (`id`, `time`, `status`, `date`) VALUES
(1, '12:00 AM', 'active', '2021-05-25 11:15:12'),
(2, '12:15 AM', 'active', '2021-05-25 11:15:12'),
(3, '12:30 AM', 'active', '2021-05-25 11:15:12'),
(4, '12:45 AM', 'active', '2021-05-25 11:15:12'),
(5, '01:00 AM', 'active', '2021-05-25 11:15:12'),
(6, '01:15 AM', 'active', '2021-05-25 11:15:12'),
(7, '01:30 AM', 'active', '2021-05-25 11:15:12'),
(8, '01:45 AM', 'active', '2021-05-25 11:15:12'),
(9, '02:00 AM', 'active', '2021-05-25 11:15:12'),
(10, '02:15 AM', 'active', '2021-05-25 11:15:12'),
(11, '02:30 AM', 'active', '2021-05-25 11:15:12'),
(12, '02:45 AM', 'active', '2021-05-25 11:15:12'),
(13, '03:00 AM', 'active', '2021-05-25 11:15:12'),
(14, '03:15 AM', 'active', '2021-05-25 11:15:12'),
(15, '03:30 AM', 'active', '2021-05-25 11:15:12'),
(16, '03:45 AM', 'active', '2021-05-25 11:15:12'),
(17, '04:00 AM', 'active', '2021-05-25 11:15:12'),
(18, '04:15 AM', 'active', '2021-05-25 11:15:12'),
(19, '04:30 AM', 'active', '2021-05-25 11:15:12'),
(20, '04:45 AM', 'active', '2021-05-25 11:15:12'),
(21, '05:00 AM', 'active', '2021-05-25 11:15:12'),
(22, '05:15 AM', 'active', '2021-05-25 11:15:12'),
(23, '05:30 AM', 'active', '2021-05-25 11:15:12'),
(24, '05:45 AM', 'active', '2021-05-25 11:15:12'),
(25, '06:00 AM', 'active', '2021-05-25 11:15:12'),
(26, '06:15 AM', 'active', '2021-05-25 11:15:12'),
(27, '06:30 AM', 'active', '2021-05-25 11:15:12'),
(28, '06:45 AM', 'active', '2021-05-25 11:15:12'),
(29, '07:00 AM', 'active', '2021-05-25 11:15:12'),
(30, '07:15 AM', 'active', '2021-05-25 11:15:12'),
(31, '07:30 AM', 'active', '2021-05-25 11:15:12'),
(32, '07:45 AM', 'active', '2021-05-25 11:15:12'),
(33, '08:00 AM', 'active', '2021-05-25 11:15:12'),
(34, '08:15 AM', 'active', '2021-05-25 11:15:12'),
(35, '08:30 AM', 'active', '2021-05-25 11:15:12'),
(36, '08:45 AM', 'active', '2021-05-25 11:15:12'),
(37, '09:00 AM', 'active', '2021-05-25 11:15:12'),
(38, '09:15 AM', 'active', '2021-05-25 11:15:12'),
(39, '09:30 AM', 'active', '2021-05-25 11:15:12'),
(40, '09:45 AM', 'active', '2021-05-25 11:15:12'),
(41, '10:00 AM', 'active', '2021-05-25 11:15:12'),
(42, '10:15 AM', 'active', '2021-05-25 11:15:12'),
(43, '10:30 AM', 'active', '2021-05-25 11:15:12'),
(44, '10:45 AM', 'active', '2021-05-25 11:15:12'),
(45, '11:00 AM', 'active', '2021-05-25 11:15:12'),
(46, '11:15 AM', 'active', '2021-05-25 11:15:12'),
(47, '11:30 AM', 'active', '2021-05-25 11:15:12'),
(48, '11:45 AM', 'active', '2021-05-25 11:15:12'),
(49, '12:00 PM', 'active', '2021-05-25 11:15:12'),
(50, '12:15 PM', 'active', '2021-05-25 11:15:12'),
(51, '12:30 PM', 'active', '2021-05-25 11:15:12'),
(52, '12:45 PM', 'active', '2021-05-25 11:15:12'),
(53, '01:00 PM', 'active', '2021-05-25 11:15:12'),
(54, '01:15 PM', 'active', '2021-05-25 11:15:12'),
(55, '01:30 PM', 'active', '2021-05-25 11:15:12'),
(56, '01:45 PM', 'active', '2021-05-25 11:15:12'),
(57, '02:00 PM', 'active', '2021-05-25 11:15:12'),
(58, '02:15 PM', 'active', '2021-05-25 11:15:12'),
(59, '02:30 PM', 'active', '2021-05-25 11:15:12'),
(60, '02:45 PM', 'active', '2021-05-25 11:15:12'),
(61, '03:00 PM', 'active', '2021-05-25 11:15:12'),
(62, '03:15 PM', 'active', '2021-05-25 11:15:12'),
(63, '03:30 PM', 'active', '2021-05-25 11:15:12'),
(64, '03:45 PM', 'active', '2021-05-25 11:15:12'),
(65, '04:00 PM', 'active', '2021-05-25 11:15:12'),
(66, '04:15 PM', 'active', '2021-05-25 11:15:12'),
(67, '04:30 PM', 'active', '2021-05-25 11:15:12'),
(68, '04:45 PM', 'active', '2021-05-25 11:15:12'),
(69, '05:00 PM', 'active', '2021-05-25 11:15:12'),
(70, '05:15 PM', 'active', '2021-05-25 11:15:12'),
(71, '05:30 PM', 'active', '2021-05-25 11:15:12'),
(72, '05:45 PM', 'active', '2021-05-25 11:15:12'),
(73, '06:00 PM', 'active', '2021-05-25 11:15:12'),
(74, '06:15 PM', 'active', '2021-05-25 11:15:12'),
(75, '06:30 PM', 'active', '2021-05-25 11:15:12'),
(76, '06:45 PM', 'active', '2021-05-25 11:15:12'),
(77, '07:00 PM', 'active', '2021-05-25 11:15:12'),
(78, '07:15 PM', 'active', '2021-05-25 11:15:12'),
(79, '07:30 PM', 'active', '2021-05-25 11:15:12'),
(80, '07:45 PM', 'active', '2021-05-25 11:15:12'),
(81, '08:00 PM', 'active', '2021-05-25 11:15:12'),
(82, '08:15 PM', 'active', '2021-05-25 11:15:12'),
(83, '08:30 PM', 'active', '2021-05-25 11:15:12'),
(84, '08:45 PM', 'active', '2021-05-25 11:15:12'),
(85, '09:00 PM', 'active', '2021-05-25 11:15:12'),
(86, '09:15 PM', 'active', '2021-05-25 11:15:12'),
(87, '09:30 PM', 'active', '2021-05-25 11:15:12'),
(88, '09:45 PM', 'active', '2021-05-25 11:15:12'),
(89, '10:00 PM', 'active', '2021-05-25 11:15:12'),
(90, '10:15 PM', 'active', '2021-05-25 11:15:12'),
(91, '10:30 PM', 'active', '2021-05-25 11:15:12'),
(92, '10:45 PM', 'active', '2021-05-25 11:15:12'),
(93, '11:00 PM', 'active', '2021-05-25 11:15:12'),
(94, '11:15 PM', 'active', '2021-05-25 11:15:12'),
(95, '11:30 PM', 'active', '2021-05-25 11:15:12'),
(96, '11:45 PM', 'active', '2021-05-25 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `time_24hours`
--

CREATE TABLE `time_24hours` (
  `id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_24hours`
--

INSERT INTO `time_24hours` (`id`, `time`, `status`, `date`) VALUES
(1, '00:00', 'active', '2021-05-25 11:15:12'),
(2, '00:15', 'active', '2021-05-25 11:15:12'),
(3, '00:30', 'active', '2021-05-25 11:15:12'),
(4, '00:45', 'active', '2021-05-25 11:15:12'),
(5, '01:00', 'active', '2021-05-25 11:15:12'),
(6, '01:15', 'active', '2021-05-25 11:15:12'),
(7, '01:30', 'active', '2021-05-25 11:15:12'),
(8, '01:45', 'active', '2021-05-25 11:15:12'),
(9, '02:00', 'active', '2021-05-25 11:15:12'),
(10, '02:15', 'active', '2021-05-25 11:15:12'),
(11, '02:30', 'active', '2021-05-25 11:15:12'),
(12, '02:45', 'active', '2021-05-25 11:15:12'),
(13, '03:00', 'active', '2021-05-25 11:15:12'),
(14, '03:15', 'active', '2021-05-25 11:15:12'),
(15, '03:30', 'active', '2021-05-25 11:15:12'),
(16, '03:45', 'active', '2021-05-25 11:15:12'),
(17, '04:00', 'active', '2021-05-25 11:15:12'),
(18, '04:15', 'active', '2021-05-25 11:15:12'),
(19, '04:30', 'active', '2021-05-25 11:15:12'),
(20, '04:45', 'active', '2021-05-25 11:15:12'),
(21, '05:00', 'active', '2021-05-25 11:15:12'),
(22, '05:15', 'active', '2021-05-25 11:15:12'),
(23, '05:30', 'active', '2021-05-25 11:15:12'),
(24, '05:45', 'active', '2021-05-25 11:15:12'),
(25, '06:00', 'active', '2021-05-25 11:15:12'),
(26, '06:15', 'active', '2021-05-25 11:15:12'),
(27, '06:30', 'active', '2021-05-25 11:15:12'),
(28, '06:45', 'active', '2021-05-25 11:15:12'),
(29, '07:00', 'active', '2021-05-25 11:15:12'),
(30, '07:15', 'active', '2021-05-25 11:15:12'),
(31, '07:30', 'active', '2021-05-25 11:15:12'),
(32, '07:45', 'active', '2021-05-25 11:15:12'),
(33, '08:00', 'active', '2021-05-25 11:15:12'),
(34, '08:15', 'active', '2021-05-25 11:15:12'),
(35, '08:30', 'active', '2021-05-25 11:15:12'),
(36, '08:45', 'active', '2021-05-25 11:15:12'),
(37, '09:00', 'active', '2021-05-25 11:15:12'),
(38, '09:15', 'active', '2021-05-25 11:15:12'),
(39, '09:30', 'active', '2021-05-25 11:15:12'),
(40, '09:45', 'active', '2021-05-25 11:15:12'),
(41, '10:00', 'active', '2021-05-25 11:15:12'),
(42, '10:15', 'active', '2021-05-25 11:15:12'),
(43, '10:30', 'active', '2021-05-25 11:15:12'),
(44, '10:45', 'active', '2021-05-25 11:15:12'),
(45, '11:00', 'active', '2021-05-25 11:15:12'),
(46, '11:15', 'active', '2021-05-25 11:15:12'),
(47, '11:30', 'active', '2021-05-25 11:15:12'),
(48, '11:45', 'active', '2021-05-25 11:15:12'),
(49, '12:00', 'active', '2021-05-25 11:15:12'),
(50, '12:15', 'active', '2021-05-25 11:15:12'),
(51, '12:30', 'active', '2021-05-25 11:15:12'),
(52, '12:45', 'active', '2021-05-25 11:15:12'),
(53, '13:00', 'active', '2021-05-25 11:15:12'),
(54, '13:15', 'active', '2021-05-25 11:15:12'),
(55, '13:30', 'active', '2021-05-25 11:15:12'),
(56, '13:45', 'active', '2021-05-25 11:15:12'),
(57, '14:00', 'active', '2021-05-25 11:15:12'),
(58, '14:15', 'active', '2021-05-25 11:15:12'),
(59, '14:30', 'active', '2021-05-25 11:15:12'),
(60, '14:45', 'active', '2021-05-25 11:15:12'),
(61, '15:00', 'active', '2021-05-25 11:15:12'),
(62, '15:15', 'active', '2021-05-25 11:15:12'),
(63, '15:30', 'active', '2021-05-25 11:15:12'),
(64, '15:45', 'active', '2021-05-25 11:15:12'),
(65, '16:00', 'active', '2021-05-25 11:15:12'),
(66, '16:15', 'active', '2021-05-25 11:15:12'),
(67, '16:30', 'active', '2021-05-25 11:15:12'),
(68, '16:45', 'active', '2021-05-25 11:15:12'),
(69, '17:00', 'active', '2021-05-25 11:15:12'),
(70, '17:15', 'active', '2021-05-25 11:15:12'),
(71, '17:30', 'active', '2021-05-25 11:15:12'),
(72, '17:45', 'active', '2021-05-25 11:15:12'),
(73, '18:00', 'active', '2021-05-25 11:15:12'),
(74, '18:15', 'active', '2021-05-25 11:15:12'),
(75, '18:30', 'active', '2021-05-25 11:15:12'),
(76, '18:45', 'active', '2021-05-25 11:15:12'),
(77, '19:00', 'active', '2021-05-25 11:15:12'),
(78, '19:15', 'active', '2021-05-25 11:15:12'),
(79, '19:30', 'active', '2021-05-25 11:15:12'),
(80, '19:45', 'active', '2021-05-25 11:15:12'),
(81, '20:00', 'active', '2021-05-25 11:15:12'),
(82, '20:15', 'active', '2021-05-25 11:15:12'),
(83, '20:30', 'active', '2021-05-25 11:15:12'),
(84, '20:45', 'active', '2021-05-25 11:15:12'),
(85, '21:00', 'active', '2021-05-25 11:15:12'),
(86, '21:15', 'active', '2021-05-25 11:15:12'),
(87, '21:30', 'active', '2021-05-25 11:15:12'),
(88, '21:45', 'active', '2021-05-25 11:15:12'),
(89, '22:00', 'active', '2021-05-25 11:15:12'),
(90, '22:15', 'active', '2021-05-25 11:15:12'),
(91, '22:30', 'active', '2021-05-25 11:15:12'),
(92, '22:45', 'active', '2021-05-25 11:15:12'),
(93, '23:00', 'active', '2021-05-25 11:15:12'),
(94, '23:15', 'active', '2021-05-25 11:15:12'),
(95, '23:30', 'active', '2021-05-25 11:15:12'),
(96, '23:45', 'active', '2021-05-25 11:15:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_exam`
--
ALTER TABLE `admin_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confidence_level`
--
ALTER TABLE `confidence_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duration`
--
ALTER TABLE `duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hear_from`
--
ALTER TABLE `hear_from`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motivator`
--
ALTER TABLE `motivator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planner`
--
ALTER TABLE `planner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planner_task`
--
ALTER TABLE `planner_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_cycle`
--
ALTER TABLE `program_cycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_names`
--
ALTER TABLE `school_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_module`
--
ALTER TABLE `student_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_block`
--
ALTER TABLE `study_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_12hours`
--
ALTER TABLE `time_12hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_24hours`
--
ALTER TABLE `time_24hours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_exam`
--
ALTER TABLE `admin_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confidence_level`
--
ALTER TABLE `confidence_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `duration`
--
ALTER TABLE `duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `hear_from`
--
ALTER TABLE `hear_from`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `motivator`
--
ALTER TABLE `motivator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `planner`
--
ALTER TABLE `planner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `planner_task`
--
ALTER TABLE `planner_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program_cycle`
--
ALTER TABLE `program_cycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `school_names`
--
ALTER TABLE `school_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_module`
--
ALTER TABLE `student_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `study_block`
--
ALTER TABLE `study_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `time_12hours`
--
ALTER TABLE `time_12hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `time_24hours`
--
ALTER TABLE `time_24hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
