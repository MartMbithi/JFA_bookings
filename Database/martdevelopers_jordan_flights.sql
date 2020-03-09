-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2020 at 02:55 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `martdevelopers_jordan_flights`
--

-- --------------------------------------------------------

--
-- Table structure for table `jordan_admin`
--

CREATE TABLE `jordan_admin` (
  `ja_id` int(20) NOT NULL,
  `ja_name` varchar(200) NOT NULL,
  `ja_email` varchar(200) NOT NULL,
  `ja_pwd` varchar(200) NOT NULL,
  `ja_pic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jordan_admin`
--

INSERT INTO `jordan_admin` (`ja_id`, `ja_name`, `ja_email`, `ja_pwd`, `ja_pic`) VALUES
(1, 'System Admin', 'sysadmin@jfa.org', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'sysadmin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jordan_flights`
--

CREATE TABLE `jordan_flights` (
  `jf_id` int(20) NOT NULL,
  `jf_name` varchar(200) NOT NULL,
  `jf_number` varchar(200) NOT NULL,
  `jf_passengers` varchar(200) NOT NULL,
  `jf_deptime` varchar(200) NOT NULL,
  `jf_arrtime` varchar(200) NOT NULL,
  `jf_flightroute_number` varchar(200) NOT NULL,
  `jf_flight_dep_airport` varchar(200) NOT NULL,
  `jf_flight_des_airport` varchar(200) NOT NULL,
  `jf_flight_route` varchar(200) NOT NULL,
  `jf_flight_ticket_fare` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jordan_flights`
--

INSERT INTO `jordan_flights` (`jf_id`, `jf_name`, `jf_number`, `jf_passengers`, `jf_deptime`, `jf_arrtime`, `jf_flightroute_number`, `jf_flight_dep_airport`, `jf_flight_des_airport`, `jf_flight_route`, `jf_flight_ticket_fare`) VALUES
(2, 'Boeing 720', 'JFA-FLIGHT-8576', '200', '0100Hrs', '0300Hrs', 'JFA-FR-7869', 'Mombasa', 'Nairobi', 'Mombasa-Nairobi ', 'Ksh 10500'),
(3, 'Cessna 350T', 'JFA-FLIGHT-9568', '20', '0800Hrs', '0900Hrs', 'JFA-FR-8023', 'Mombasa', 'Voi', 'Mombasa-Voi ', 'Ksh 5000'),
(4, 'Cessna 320', 'JFA-FLIGHT-2483', '20', '0700Hrs', '0730Hrs', 'JFA-FR-1365', 'Voi', 'Taveta', 'Voi-Taveta ', 'Ksh 2000'),
(5, 'Cessna 350T', 'JFA-FLIGHT-6572', '20', '0900 HRS', '0950HRS', 'JFA-FR-7302', 'Mombasa', 'Taveta', 'Mombasa-Taveta ', 'Ksh 8000');

-- --------------------------------------------------------

--
-- Table structure for table `jordan_flights_reservation`
--

CREATE TABLE `jordan_flights_reservation` (
  `jfs_id` int(20) NOT NULL,
  `jfs_number` varchar(200) NOT NULL,
  `jf_id` varchar(200) NOT NULL,
  `jf_name` varchar(200) NOT NULL,
  `jf_route` varchar(200) NOT NULL,
  `jf_number` varchar(200) NOT NULL,
  `jf_deptime` varchar(200) NOT NULL,
  `jf_arrtime` varchar(200) NOT NULL,
  `jp_id` varchar(200) NOT NULL,
  `jp_number` varchar(200) NOT NULL,
  `jp_name` varchar(200) NOT NULL,
  `jp_national_id` varchar(200) NOT NULL,
  `jf_flight_fare` varchar(200) NOT NULL,
  `jfs_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `payment_stats` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jordan_flights_reservation`
--

INSERT INTO `jordan_flights_reservation` (`jfs_id`, `jfs_number`, `jf_id`, `jf_name`, `jf_route`, `jf_number`, `jf_deptime`, `jf_arrtime`, `jp_id`, `jp_number`, `jp_name`, `jp_national_id`, `jf_flight_fare`, `jfs_date`, `payment_stats`) VALUES
(13, 'JFA-RESERVATION-7369', '', 'Cessna 350T', 'Mombasa-Voi ', 'JFA-FLIGHT-9568', '0800Hrs', '0900Hrs', '13', 'JFA-PASS-6815', 'Josephine Washala', '35590089', 'Ksh 5000', '2020-03-08 14:48:38.174596', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `jordan_flights_reservation_payments`
--

CREATE TABLE `jordan_flights_reservation_payments` (
  `jfsp_id` int(20) NOT NULL,
  `jfs_number` varchar(200) NOT NULL,
  `jf_name` varchar(200) NOT NULL,
  `jf_route` varchar(200) NOT NULL,
  `jf_number` varchar(200) NOT NULL,
  `jf_deptime` varchar(200) NOT NULL,
  `jf_arrtime` varchar(200) NOT NULL,
  `jp_id` varchar(200) NOT NULL,
  `jp_number` varchar(200) NOT NULL,
  `jp_name` varchar(200) NOT NULL,
  `jp_national_id` varchar(200) NOT NULL,
  `jf_flight_fare` varchar(200) NOT NULL,
  `jf_amt_paid` varchar(200) NOT NULL,
  `jf_payment_method` varchar(200) NOT NULL,
  `jf_payment_refcode` varchar(200) NOT NULL,
  `jf_payment_number` varchar(200) NOT NULL,
  `jfs_date_paid` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jordan_flights_reservation_payments`
--

INSERT INTO `jordan_flights_reservation_payments` (`jfsp_id`, `jfs_number`, `jf_name`, `jf_route`, `jf_number`, `jf_deptime`, `jf_arrtime`, `jp_id`, `jp_number`, `jp_name`, `jp_national_id`, `jf_flight_fare`, `jf_amt_paid`, `jf_payment_method`, `jf_payment_refcode`, `jf_payment_number`, `jfs_date_paid`) VALUES
(23, 'JFA-RESERVATION-7369', 'Cessna 350T', 'Mombasa-Voi ', 'JFA-FLIGHT-9568', '0800Hrs', '0900Hrs', '13', 'JFA-PASS-6815', 'Josephine Washala', '35590089', 'Ksh 5000', '5000', 'Mpesa', 'OBTY6745RT', 'JG3EFC', '2020-03-08 14:51:54.744502');

-- --------------------------------------------------------

--
-- Table structure for table `jordan_flight_routes`
--

CREATE TABLE `jordan_flight_routes` (
  `jfr_id` int(20) NOT NULL,
  `jfr_number` varchar(200) NOT NULL,
  `jfr_dep_airport` varchar(200) NOT NULL,
  `jfr_arr_airport` varchar(200) NOT NULL,
  `jfr_ticket_fare` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jordan_flight_routes`
--

INSERT INTO `jordan_flight_routes` (`jfr_id`, `jfr_number`, `jfr_dep_airport`, `jfr_arr_airport`, `jfr_ticket_fare`) VALUES
(1, 'JFA-FR-7869', 'Mombasa', 'Nairobi', '10500'),
(2, 'JFA-FR-8023', 'Mombasa', 'Voi', '5000'),
(3, 'JFA-FR-7302', 'Mombasa', 'Taveta', '8000'),
(4, 'JFA-FR-1365', 'Voi', 'Taveta', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `jordan_passengers`
--

CREATE TABLE `jordan_passengers` (
  `jp_id` int(20) NOT NULL,
  `jp_name` varchar(200) NOT NULL,
  `jp_national_id` varchar(200) NOT NULL,
  `jp_phone` varchar(200) NOT NULL,
  `jp_number` varchar(200) NOT NULL,
  `passport_pic` varchar(200) NOT NULL,
  `jp_email` varchar(200) NOT NULL,
  `jp_pwd` varchar(200) NOT NULL,
  `jp_gender` varchar(200) NOT NULL,
  `jp_date_joined` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4) ON UPDATE CURRENT_TIMESTAMP(4)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jordan_passengers`
--

INSERT INTO `jordan_passengers` (`jp_id`, `jp_name`, `jp_national_id`, `jp_phone`, `jp_number`, `passport_pic`, `jp_email`, `jp_pwd`, `jp_gender`, `jp_date_joined`) VALUES
(6, 'MartDevelopers Inc.', '35574881', '+254737229776', 'JFA-PASS-1982', '', 'martdevelopers254@gmail.com', '93b2c68008d61880f9dc36e392d190f1cc97a58c', 'Male', '2020-03-03 15:36:51.8044'),
(7, 'Josephine Mwamburi', '35678689', '+25473722967', 'JFA-PASS-0986', '', 'josephinemwamburi98@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', 'Female', '2020-03-01 17:23:49.0975'),
(8, 'John Doe', '3458907', '+25473722967', 'JFA-PASS-8147', '1.jpg', 'johndoe@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'male', '2020-03-06 01:32:19.9562'),
(9, 'Tekashi Kovachs', '90235690', '+2307907865', 'JFA-PASS-9621', '', 'tekashokovaks@yahoo.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Male', '2020-03-03 17:41:00.3823'),
(10, 'Eric Baldwin Inc', '90078654', '+80-8987-9086', 'JFA-PASS-9501', '', 'ebaldi90@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Male', '2020-03-03 17:41:45.6650'),
(11, 'MartDevelopers Web Marster', '35590878', '+254740847563', 'JFA-PASS-2043', '', 'martdevwebmas@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Male', '2020-03-03 17:42:56.7231'),
(12, 'Hellwet Packyard', '456789089', '+908654-234', 'JFA-PASS-9147', '', 'hp@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Female', '2020-03-04 02:09:11.6255'),
(13, 'Josephine Washala', '35590089', '+254740847563', 'JFA-PASS-6815', '', 'washalajosephine98@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'female', '2020-03-08 10:29:38.5148');

-- --------------------------------------------------------

--
-- Table structure for table `jordan_passenger_feedbacks`
--

CREATE TABLE `jordan_passenger_feedbacks` (
  `jpf_id` int(20) NOT NULL,
  `jp_id` varchar(200) NOT NULL,
  `jp_name` varchar(200) NOT NULL,
  `jpf_feedback` varchar(200) NOT NULL,
  `jpf_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jordan_password_resets`
--

CREATE TABLE `jordan_password_resets` (
  `jps_id` int(20) NOT NULL,
  `jps_email` varchar(200) NOT NULL,
  `jps_token` varchar(200) NOT NULL,
  `jps_dummy_pwd` varchar(200) NOT NULL,
  `jps_tstamp` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `sent_mail_status` varchar(200) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jordan_staff`
--

CREATE TABLE `jordan_staff` (
  `js_id` int(20) NOT NULL,
  `js_number` varchar(200) NOT NULL,
  `js_name` varchar(200) NOT NULL,
  `js_dept` varchar(200) NOT NULL,
  `js_national_id` varchar(200) NOT NULL,
  `js_phone` varchar(200) NOT NULL,
  `js_email` varchar(200) NOT NULL,
  `js_pwd` varchar(200) NOT NULL,
  `js_pic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jordan_staff`
--

INSERT INTO `jordan_staff` (`js_id`, `js_number`, `js_name`, `js_dept`, `js_national_id`, `js_phone`, `js_email`, `js_pwd`, `js_pic`) VALUES
(3, 'JFA-STAFF-1256', 'Mwamburi Josephine', 'Crew Service', '35578690', '+254127001', 'mwamburijosephine98@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
(4, 'JFA-STAFF-9618', 'MartDevelopers Inc.', 'Pilot', '34578678', '+254127001', 'martdevelopers254@gmail.com', 'df0056bf1e9ee39794c7680a186bed41a7d5c0ec', ''),
(5, 'JFA-STAFF-8630', 'Jordan Flights Finance', 'Finance', '90078656', '+254756907865', 'finance@jfa.org', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
(6, 'JFA-STAFF-4903', 'Air Hostess', 'Crew Service', '9008976', '+90-90876-9008', 'airhostess@jfa.org', 'a69681bcf334ae130217fea4505fd3c994f5683f', '5.jpg'),
(7, 'JFA-STAFF-3025', 'System Admin', 'Pilot', '127001', '+254756907865', 'sysadmin@jfa.org', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jordan_admin`
--
ALTER TABLE `jordan_admin`
  ADD PRIMARY KEY (`ja_id`);

--
-- Indexes for table `jordan_flights`
--
ALTER TABLE `jordan_flights`
  ADD PRIMARY KEY (`jf_id`);

--
-- Indexes for table `jordan_flights_reservation`
--
ALTER TABLE `jordan_flights_reservation`
  ADD PRIMARY KEY (`jfs_id`);

--
-- Indexes for table `jordan_flights_reservation_payments`
--
ALTER TABLE `jordan_flights_reservation_payments`
  ADD PRIMARY KEY (`jfsp_id`);

--
-- Indexes for table `jordan_flight_routes`
--
ALTER TABLE `jordan_flight_routes`
  ADD PRIMARY KEY (`jfr_id`);

--
-- Indexes for table `jordan_passengers`
--
ALTER TABLE `jordan_passengers`
  ADD PRIMARY KEY (`jp_id`);

--
-- Indexes for table `jordan_passenger_feedbacks`
--
ALTER TABLE `jordan_passenger_feedbacks`
  ADD PRIMARY KEY (`jpf_id`);

--
-- Indexes for table `jordan_password_resets`
--
ALTER TABLE `jordan_password_resets`
  ADD PRIMARY KEY (`jps_id`);

--
-- Indexes for table `jordan_staff`
--
ALTER TABLE `jordan_staff`
  ADD PRIMARY KEY (`js_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jordan_admin`
--
ALTER TABLE `jordan_admin`
  MODIFY `ja_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jordan_flights`
--
ALTER TABLE `jordan_flights`
  MODIFY `jf_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jordan_flights_reservation`
--
ALTER TABLE `jordan_flights_reservation`
  MODIFY `jfs_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jordan_flights_reservation_payments`
--
ALTER TABLE `jordan_flights_reservation_payments`
  MODIFY `jfsp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jordan_flight_routes`
--
ALTER TABLE `jordan_flight_routes`
  MODIFY `jfr_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jordan_passengers`
--
ALTER TABLE `jordan_passengers`
  MODIFY `jp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jordan_passenger_feedbacks`
--
ALTER TABLE `jordan_passenger_feedbacks`
  MODIFY `jpf_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jordan_password_resets`
--
ALTER TABLE `jordan_password_resets`
  MODIFY `jps_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jordan_staff`
--
ALTER TABLE `jordan_staff`
  MODIFY `js_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
