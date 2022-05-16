-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 01:23 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medeast`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(10) NOT NULL,
  `ADMIN_NAME` varchar(25) NOT NULL,
  `ADMIN_TYPE` varchar(25) NOT NULL,
  `ADMIN_EMAIL` varchar(50) NOT NULL,
  `ADMIN_USERNAME` varchar(25) NOT NULL,
  `ADMIN_PASSWORD` varchar(100) NOT NULL,
  `ADMIN_STATUS` varchar(25) NOT NULL,
  `CREATED_BY` int(10) NOT NULL,
  `ADMIN_SAVE_TIME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_NAME`, `ADMIN_TYPE`, `ADMIN_EMAIL`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `ADMIN_STATUS`, `CREATED_BY`, `ADMIN_SAVE_TIME`) VALUES
(1, 'Syed Mubeen Hussain Shah', 'admin', 'shahmobeen333@gmail.com', 'mubeen.hussain', '$2y$10$gs1BcrN9mTXi6kZyGLpSM.gdrFF8Vff6ebwHAvaB6JVZWivnzBXAu', 'active', 0, 'Sat Feb 12 2022 02:26:44 GMT+0500 (Pakistan Standard Time)'),
(2, 'Staff User', 'user', 'staff.user@gmail.com', 'staff', '$2y$10$zRmX6LCWkc0UgoQNuCEe/.VjZwaUqvVhNLq7SBBuPYCUFzXq6uy4S', 'active', 1, 'Sat Apr 30 2022 13:46:30 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DEPARTMENT_ID` int(10) NOT NULL,
  `DEPARTMENT_NAME` varchar(100) NOT NULL,
  `DEPARTMENT_STATUS` varchar(10) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `DEPARTMENT_DATE_TIME` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DEPARTMENT_ID`, `DEPARTMENT_NAME`, `DEPARTMENT_STATUS`, `STAFF_ID`, `DEPARTMENT_DATE_TIME`) VALUES
(1, 'Gyneacologist', 'active', 1, 'Fri Mar 18 2022 21:20:03 GMT+0500 (Pakistan Standard Time)'),
(2, 'Ophthamology', 'active', 1, 'Fri Mar 18 2022 21:28:13 GMT+0500 (Pakistan Standard Time)'),
(3, 'Pediatric', 'active', 1, 'Fri Mar 18 2022 21:28:23 GMT+0500 (Pakistan Standard Time)'),
(4, 'Pediatric Surgery', 'active', 1, 'Fri Mar 18 2022 21:28:29 GMT+0500 (Pakistan Standard Time)'),
(5, 'Medicine', 'active', 1, 'Fri Mar 18 2022 21:28:37 GMT+0500 (Pakistan Standard Time)'),
(6, 'General Surgery', 'active', 1, 'Fri Mar 18 2022 21:28:44 GMT+0500 (Pakistan Standard Time)'),
(7, 'Physiatery', 'active', 1, 'Fri Mar 18 2022 21:28:51 GMT+0500 (Pakistan Standard Time)'),
(8, 'Psychology', 'active', 1, 'Fri Mar 18 2022 21:28:58 GMT+0500 (Pakistan Standard Time)'),
(9, 'ENT', 'active', 1, 'Fri Mar 18 2022 21:29:03 GMT+0500 (Pakistan Standard Time)'),
(10, 'Orthopedic', 'active', 1, 'Fri Mar 18 2022 21:29:09 GMT+0500 (Pakistan Standard Time)'),
(11, 'Radiology', 'active', 1, 'Fri Mar 18 2022 21:29:16 GMT+0500 (Pakistan Standard Time)'),
(12, 'Skin', 'active', 1, 'Fri Mar 18 2022 21:29:24 GMT+0500 (Pakistan Standard Time)'),
(13, 'Urology', 'active', 1, 'Fri Mar 18 2022 21:29:31 GMT+0500 (Pakistan Standard Time)'),
(14, 'Neurology', 'active', 1, 'Fri Mar 18 2022 21:29:36 GMT+0500 (Pakistan Standard Time)'),
(15, 'Cardiology', 'active', 1, 'Fri Mar 18 2022 21:29:42 GMT+0500 (Pakistan Standard Time)'),
(16, 'Physiotherapy', 'active', 1, 'Fri Mar 18 2022 21:29:52 GMT+0500 (Pakistan Standard Time)'),
(17, 'Nutrition', 'active', 1, 'Fri Mar 18 2022 21:29:58 GMT+0500 (Pakistan Standard Time)'),
(18, 'Medical Officer', 'active', 1, 'Fri Mar 18 2022 21:30:14 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DOCTOR_ID` int(10) NOT NULL,
  `DOCTOR_NAME` varchar(50) NOT NULL,
  `DEPARTMENT_ID` int(10) NOT NULL,
  `DOCTOR_STATUS` varchar(50) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `DOCTOR_DATE_TIME` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DOCTOR_ID`, `DOCTOR_NAME`, `DEPARTMENT_ID`, `DOCTOR_STATUS`, `STAFF_ID`, `DOCTOR_DATE_TIME`) VALUES
(1, 'Brig (R) Dr Shamim Akhtar', 1, 'active', 1, 'Sat Feb 05 2022 01:47:14 GMT+0500 (Pakistan Standard Time)'),
(2, 'Assist Prof Dr Riffat Sarwar', 1, 'active', 1, 'Fri Mar 18 2022 22:03:48 GMT+0500 (Pakistan Standard Time)'),
(3, 'Dr Sohaib Malik Abbas', 2, 'active', 1, 'Fri Mar 18 2022 22:04:32 GMT+0500 (Pakistan Standard Time)'),
(4, 'Dr Mansha', 2, 'active', 1, 'Fri Mar 18 2022 22:04:54 GMT+0500 (Pakistan Standard Time)'),
(5, 'Brig (R) Dr Humma Farrukh', 3, 'active', 1, 'Fri Mar 18 2022 22:05:06 GMT+0500 (Pakistan Standard Time)'),
(6, 'Brig (R) Dr Bashir Ahmad', 3, 'active', 1, 'Fri Mar 18 2022 22:05:22 GMT+0500 (Pakistan Standard Time)'),
(7, 'Dr Hammad Aslma Butt', 4, 'active', 1, 'Fri Mar 18 2022 22:05:35 GMT+0500 (Pakistan Standard Time)'),
(8, 'Dr Muhammad Rashid Khan', 5, 'active', 1, 'Fri Mar 18 2022 22:05:48 GMT+0500 (Pakistan Standard Time)'),
(9, 'Lt Col (R) Dr Tahir Ibrahim', 5, 'active', 1, 'Fri Mar 18 2022 22:06:06 GMT+0500 (Pakistan Standard Time)'),
(10, 'Dr Javariya Hammad', 6, 'active', 1, 'Fri Mar 18 2022 22:06:15 GMT+0500 (Pakistan Standard Time)'),
(11, 'Brig (R) Dr Tariq', 6, 'active', 1, 'Fri Mar 18 2022 22:06:28 GMT+0500 (Pakistan Standard Time)'),
(12, 'Brig (R) Dr Javaid Hashmi', 6, 'active', 1, 'Fri Mar 18 2022 22:06:39 GMT+0500 (Pakistan Standard Time)'),
(13, 'Dr Mehdi Raza Khawaja', 7, 'active', 1, 'Fri Mar 18 2022 22:06:50 GMT+0500 (Pakistan Standard Time)'),
(14, 'Dr Tanzeela Atif', 8, 'active', 1, 'Fri Mar 18 2022 22:07:10 GMT+0500 (Pakistan Standard Time)'),
(15, 'Maj (R) Khalid Ahmed', 9, 'active', 1, 'Fri Mar 18 2022 22:07:27 GMT+0500 (Pakistan Standard Time)'),
(16, 'Dr Tayyab Rehman', 10, 'active', 1, 'Fri Mar 18 2022 22:07:36 GMT+0500 (Pakistan Standard Time)'),
(17, 'Dr Salma Muzaffar', 11, 'active', 1, 'Fri Mar 18 2022 22:07:48 GMT+0500 (Pakistan Standard Time)'),
(18, 'Prof Col (R) Dr Asghar Bhatti', 11, 'active', 1, 'Fri Mar 18 2022 22:07:59 GMT+0500 (Pakistan Standard Time)'),
(19, 'Dr Sidra Tariq', 12, 'active', 1, 'Fri Mar 18 2022 22:08:12 GMT+0500 (Pakistan Standard Time)'),
(20, 'Assoc Prof Dr Hassan Raza Asghar', 13, 'active', 1, 'Fri Mar 18 2022 22:08:22 GMT+0500 (Pakistan Standard Time)'),
(21, 'Dr Muhammad Kalim', 14, 'active', 1, 'Fri Mar 18 2022 22:08:34 GMT+0500 (Pakistan Standard Time)'),
(22, 'Dr Usama', 15, 'active', 1, 'Fri Mar 18 2022 22:08:45 GMT+0500 (Pakistan Standard Time)'),
(23, 'Dr Sana Ayesha', 16, 'active', 1, 'Fri Mar 18 2022 22:08:57 GMT+0500 (Pakistan Standard Time)'),
(24, 'Dr Humaira Rashid Khan', 17, 'active', 1, 'Fri Mar 18 2022 22:09:10 GMT+0500 (Pakistan Standard Time)'),
(25, 'Dr Muhammad Waqas', 18, 'active', 1, 'Fri Mar 18 2022 22:09:25 GMT+0500 (Pakistan Standard Time)'),
(26, 'Dr Arslan Amjid', 18, 'active', 1, 'Fri Mar 18 2022 22:09:44 GMT+0500 (Pakistan Standard Time)'),
(27, 'Dr M Fahad Imtiaz', 18, 'active', 1, 'Fri Mar 18 2022 22:09:53 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_bill`
--

CREATE TABLE `emergency_bill` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `SLIP_ID` int(10) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `DATE_TIME` varchar(1000) NOT NULL,
  `ES_MO_CHARGE` int(11) DEFAULT NULL,
  `INJECTION_IM` int(11) DEFAULT NULL,
  `INJECTION_IV` int(11) DEFAULT NULL,
  `IV_LINE` int(10) DEFAULT NULL,
  `IV_INFUSION` int(10) DEFAULT NULL,
  `PS_IN_300` int(10) DEFAULT NULL,
  `PS_OUT_100` int(10) DEFAULT NULL,
  `BSF_BSR` int(10) DEFAULT NULL,
  `SHORT_STAY` int(10) DEFAULT NULL,
  `BP` int(10) DEFAULT NULL,
  `ECG` int(10) DEFAULT NULL,
  `OTHER` int(10) DEFAULT NULL,
  `OTHER_TEXT` varchar(250) DEFAULT NULL,
  `TOTAL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_slip`
--

CREATE TABLE `emergency_slip` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_MR_ID` varchar(20) NOT NULL,
  `SLIP_NAME` varchar(50) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `DOCTOR_ID` int(10) NOT NULL,
  `SLIP_DATE_TIME` varchar(100) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `BILL_STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indoor_eye_bill`
--

CREATE TABLE `indoor_eye_bill` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `SLIP_ID` int(10) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `ADMISSION_DATE` varchar(100) NOT NULL,
  `DISCHARGE_DATE` varchar(100) DEFAULT NULL,
  `DATE_TIME` varchar(1000) NOT NULL,
  `TOTAL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indoor_genillness_bill`
--

CREATE TABLE `indoor_genillness_bill` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `SLIP_ID` int(10) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `ADMISSION_DATE` varchar(100) NOT NULL,
  `DISCHARGE_DATE` varchar(100) DEFAULT NULL,
  `DATE_TIME` varchar(1000) NOT NULL,
  `PRIVATE_ROOM_CHARGE` int(10) DEFAULT NULL,
  `CONSULTANT_CHARGE` int(10) DEFAULT NULL,
  `MO_CHARGE` int(10) DEFAULT NULL,
  `MONITOR_CHARGE` int(10) DEFAULT NULL,
  `NURSING_CHARGE` int(10) DEFAULT NULL,
  `OXYGEN_CHARGE` int(10) DEFAULT NULL,
  `TOTAL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indoor_gensurgery_bill`
--

CREATE TABLE `indoor_gensurgery_bill` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `SLIP_ID` int(10) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `ADMISSION_DATE` varchar(100) NOT NULL,
  `DISCHARGE_DATE` varchar(100) DEFAULT NULL,
  `DATE_TIME` varchar(1000) NOT NULL,
  `ADMISSION_CHARGE` int(11) DEFAULT NULL,
  `SURGEON_CHARGE` int(11) DEFAULT NULL,
  `ANESTHETIST_CHARGE` int(11) DEFAULT NULL,
  `OPERATION_CHARGE` int(10) DEFAULT NULL,
  `LABOUR_ROOM_CHARGE` int(10) DEFAULT NULL,
  `PEDIATRIC_CHARGE` int(10) DEFAULT NULL,
  `PRIVATE_ROOM_CHARGE` int(10) DEFAULT NULL,
  `NURSURY_CHARGE` int(10) DEFAULT NULL,
  `NURSURY_STAFF_CHARGE` int(10) DEFAULT NULL,
  `MO_CHARGE` int(10) DEFAULT NULL,
  `CONSULTANT_CHARGE` int(10) DEFAULT NULL,
  `CTG_CHARGE` int(20) DEFAULT NULL,
  `RECOVERY_ROOM_CHARGE` int(20) DEFAULT NULL,
  `OTHER` int(10) DEFAULT NULL,
  `OTHER_TEXT` varchar(250) DEFAULT NULL,
  `TOTAL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indoor_slip`
--

CREATE TABLE `indoor_slip` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_MR_ID` varchar(20) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `DEPT_ID` int(10) NOT NULL,
  `DOCTOR_ID` int(10) NOT NULL,
  `SLIP_PROCEDURE` varchar(200) NOT NULL,
  `SLIP_TYPE` varchar(20) NOT NULL,
  `SLIP_DATE_TIME` varchar(100) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `BILL_STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indoor_type`
--

CREATE TABLE `indoor_type` (
  `TYPE_ID` int(11) NOT NULL,
  `TYPE_NAME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `TYPE_ALAIS` varchar(15) CHARACTER SET latin1 NOT NULL,
  `TYPE_SAVE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `TYPE_STATUS` varchar(10) CHARACTER SET latin1 NOT NULL,
  `STAFF_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indoor_type`
--

INSERT INTO `indoor_type` (`TYPE_ID`, `TYPE_NAME`, `TYPE_ALAIS`, `TYPE_SAVE_TIME`, `TYPE_STATUS`, `STAFF_ID`) VALUES
(1, 'Gynae Patient', 'gynae', 'Sat Mar 12 2022 19:24:50 GMT+0500 (Pakistan Standard Time)', 'active', 1),
(2, 'General Surgery', 'gensurgery', 'Sat Mar 12 2022 19:25:04 GMT+0500 (Pakistan Standard Time)', 'active', 1),
(3, 'General Illness', 'genillness', 'Sat Mar 12 2022 19:26:30 GMT+0500 (Pakistan Standard Time)', 'active', 1),
(4, 'Eye Patient', 'eye', 'Sat Mar 12 2022 19:27:06 GMT+0500 (Pakistan Standard Time)', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outdoor_slip`
--

CREATE TABLE `outdoor_slip` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_MR_ID` varchar(20) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `DEPT_ID` int(10) NOT NULL,
  `DOCTOR_ID` int(10) NOT NULL,
  `SLIP_FEE` int(10) NOT NULL,
  `SLIP_DATE_TIME` varchar(100) NOT NULL,
  `STAFF_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(25) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `CREATED_ON` varchar(100) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `ROOM_ID` int(10) NOT NULL,
  `ROOM_NAME` varchar(100) NOT NULL,
  `ROOM_RATE` int(20) NOT NULL,
  `ROOM_STATUS` varchar(50) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `ROOM_DATE_TIME` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`ROOM_ID`, `ROOM_NAME`, `ROOM_RATE`, `ROOM_STATUS`, `STAFF_ID`, `ROOM_DATE_TIME`) VALUES
(1, 'Semi Pvt Ward Charges', 5000, 'active', 1, 'Fri Mar 18 2022 22:59:10 GMT+0500 (Pakistan Standard Time)'),
(2, 'Pvt Room Charges', 8000, 'active', 1, 'Fri Mar 18 2022 23:00:22 GMT+0500 (Pakistan Standard Time)'),
(3, 'VIP Room Charges', 10000, 'active', 1, 'Fri Mar 18 2022 23:01:02 GMT+0500 (Pakistan Standard Time)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DEPARTMENT_ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DOCTOR_ID`);

--
-- Indexes for table `emergency_bill`
--
ALTER TABLE `emergency_bill`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `emergency_slip`
--
ALTER TABLE `emergency_slip`
  ADD PRIMARY KEY (`SLIP_ID`);

--
-- Indexes for table `indoor_eye_bill`
--
ALTER TABLE `indoor_eye_bill`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `indoor_genillness_bill`
--
ALTER TABLE `indoor_genillness_bill`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `indoor_gensurgery_bill`
--
ALTER TABLE `indoor_gensurgery_bill`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `indoor_slip`
--
ALTER TABLE `indoor_slip`
  ADD PRIMARY KEY (`SLIP_ID`);

--
-- Indexes for table `indoor_type`
--
ALTER TABLE `indoor_type`
  ADD PRIMARY KEY (`TYPE_ID`);

--
-- Indexes for table `outdoor_slip`
--
ALTER TABLE `outdoor_slip`
  ADD PRIMARY KEY (`SLIP_ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD UNIQUE KEY `PATIENT_MOBILE` (`PATIENT_MOBILE`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ROOM_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DEPARTMENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `DOCTOR_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `emergency_bill`
--
ALTER TABLE `emergency_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_slip`
--
ALTER TABLE `emergency_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indoor_eye_bill`
--
ALTER TABLE `indoor_eye_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indoor_genillness_bill`
--
ALTER TABLE `indoor_genillness_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indoor_gensurgery_bill`
--
ALTER TABLE `indoor_gensurgery_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indoor_slip`
--
ALTER TABLE `indoor_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indoor_type`
--
ALTER TABLE `indoor_type`
  MODIFY `TYPE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `outdoor_slip`
--
ALTER TABLE `outdoor_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `ROOM_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
