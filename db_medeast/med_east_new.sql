-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2022 at 11:43 PM
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
-- Database: `med_east`
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
(2, 'Administrator', 'admin', 'admin@gmail.com', 'admin', '$2y$10$9m90sOlP/JVSgQFA8RZUguGen6rJTPkoaWtdU5ad6cs0/ZitZGtbu', 'active', 1, 'Tue Feb 15 2022 18:18:28 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `bill_record`
--

CREATE TABLE `bill_record` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `CNIC` varchar(50) DEFAULT NULL,
  `ADMISSION_DATE` varchar(100) NOT NULL,
  `DISCHARGE_DATE` varchar(100) DEFAULT NULL,
  `ADMIT_DAYS` int(10) DEFAULT NULL,
  `BILL_DATE` varchar(100) DEFAULT NULL,
  `SERVICES` mediumtext DEFAULT NULL,
  `BILL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_record`
--

INSERT INTO `bill_record` (`BILL_ID`, `MR_ID`, `MOBILE`, `CNIC`, `ADMISSION_DATE`, `DISCHARGE_DATE`, `ADMIT_DAYS`, `BILL_DATE`, `SERVICES`, `BILL_AMOUNT`, `DISCOUNT`, `TOTAL`, `CREATED_BY`) VALUES
(1, '1999632-ME', '03128776604', NULL, '02/14/2022 6:34 PM', '02/15/2022 6:34 PM', 2, '02/15/2022 6:34 PM', 'Admission Charges,Operation Charges,Anesthetist Charges,Labour Room Charges,Nursery Charges,Visit Charges,', 6002, 500, 5502, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_service`
--

CREATE TABLE `bill_service` (
  `BILL_SERVICE_ID` int(10) NOT NULL,
  `BILL_SERVICE_NAME` varchar(50) NOT NULL,
  `BILL_SERVICE_AMOUNT` int(10) NOT NULL,
  `SERVICE_STATUS` varchar(10) NOT NULL,
  `CREATED_BY` int(10) NOT NULL,
  `SERVICE_SAVE_TIME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_service`
--

INSERT INTO `bill_service` (`BILL_SERVICE_ID`, `BILL_SERVICE_NAME`, `BILL_SERVICE_AMOUNT`, `SERVICE_STATUS`, `CREATED_BY`, `SERVICE_SAVE_TIME`) VALUES
(2, 'Admission Charges', 500, 'active', 0, '2022-01-25 15:42:57'),
(3, 'Operation Charges', 500, 'active', 0, '2022-01-25 15:43:15'),
(4, 'Anesthetist Charges', 500, 'active', 0, '2022-01-25 15:43:36'),
(5, 'Operation Theater Medicines', 500, 'active', 0, '2022-01-25 15:44:00'),
(6, 'Labour Room Charges', 500, 'active', 0, '2022-01-25 15:46:19'),
(7, 'Pediatric Doctor Charges', 500, 'active', 0, '2022-01-25 15:46:36'),
(8, 'Nursery Charges', 500, 'active', 0, '2022-01-25 15:47:08'),
(10, 'M O Charges', 500, 'active', 0, '2022-01-25 15:47:51'),
(12, 'Visit Charges', 500, 'active', 0, '2022-01-25 15:48:35'),
(13, 'CTG Charges', 500, 'active', 0, '2022-01-25 15:48:50'),
(14, 'Private Room Charges Edit', 5000, 'active', 0, '2022-01-25 15:49:06'),
(16, 'service charges', 500, 'active', 1, 'Tue Feb 15 2022 18:37:29 GMT+0500 (Pakistan Standard Time)');

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
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `EDUCATION_ID` int(10) NOT NULL,
  `EDUCATION_NAME` varchar(100) NOT NULL,
  `EDUCATION_ALAIS` varchar(50) NOT NULL,
  `EDUCATION_STATUS` varchar(50) NOT NULL,
  `CREATED_BY` int(10) NOT NULL,
  `EDUCATION_DATE_TIME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`EDUCATION_ID`, `EDUCATION_NAME`, `EDUCATION_ALAIS`, `EDUCATION_STATUS`, `CREATED_BY`, `EDUCATION_DATE_TIME`) VALUES
(1, 'Test Education', 'test', 'active', 0, 'Sat Feb 05 2022 01:45:47 GMT+0500 (Pakistan Standard Time)'),
(2, 'Test Education Two', 'test2', 'active', 0, 'Sat Feb 05 2022 01:46:19 GMT+0500 (Pakistan Standard Time)'),
(3, 'Test Education Three', 'test3', 'active', 0, 'Sat Feb 05 2022 01:46:36 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_bill`
--

CREATE TABLE `emergency_bill` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
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
  `TOTAL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency_bill`
--

INSERT INTO `emergency_bill` (`BILL_ID`, `MR_ID`, `PATIENT_NAME`, `MOBILE`, `DATE_TIME`, `ES_MO_CHARGE`, `INJECTION_IM`, `INJECTION_IV`, `IV_LINE`, `IV_INFUSION`, `PS_IN_300`, `PS_OUT_100`, `BSF_BSR`, `SHORT_STAY`, `BP`, `ECG`, `OTHER`, `TOTAL_AMOUNT`, `DISCOUNT`, `TOTAL`, `CREATED_BY`) VALUES
(1, '8481268-ME', '', '03123456789', 'Mubeen Hussain Shah', 0, 500, 100, 200, 200, 1500, 500, 500, 100, 500, 50, 500, 500, 5150, 150, 5000),
(2, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Sat Apr 09 2022 16:28:30 GMT+0500 (Pakistan Standard Time)', 500, 100, 200, 200, 1000, 1500, 500, 100, 500, 50, 500, 500, 5650, 650, 5000, 1),
(3, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Sat Apr 09 2022 16:28:30 GMT+0500 (Pakistan Standard Time)', 500, 100, 200, 200, 1000, 1500, 500, 100, 500, 50, 500, 500, 5650, 650, 5000, 1),
(4, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Sat Apr 09 2022 16:28:30 GMT+0500 (Pakistan Standard Time)', 500, 100, 200, 200, 1000, 1500, 500, 100, 500, 50, 500, 500, 5650, 650, 5000, 1),
(5, '8559360-ME', 'Alina Waseem', '03216549871', 'Sun Apr 10 2022 16:31:26 GMT+0500 (Pakistan Standard Time)', 200, 200, 200, 200, 1000, 1500, 500, 200, 200, 200, 200, 200, 4800, 500, 4300, 1),
(6, '8559360-ME', 'Alina Waseem', '03216549871', 'Sun Apr 10 2022 16:51:58 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 2400, 400, 500, 500, 500, 500, 500, 8000, 500, 7500, 1),
(7, '8559360-ME', 'Alina Waseem', '03216549871', 'Sun Apr 10 2022 20:09:53 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 1500, 500, 500, 500, 500, 500, 500, 7200, 200, 7000, 1),
(8, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:14:02 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 1500, 500, 500, 500, 500, 500, 500, 7200, 500, 6700, 0),
(9, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:14:02 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 1500, 500, 500, 500, 500, 500, 500, 7200, 500, 6700, 0),
(10, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:14:02 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 1200, 400, 500, 500, 500, 500, 500, 6800, 500, 6300, 0),
(11, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:17:05 GMT+0500 (Pakistan Standard Time)', 500, 500, 200, 200, 1000, 1500, 400, 500, 500, 500, 500, 500, 6800, 500, 6300, 0),
(12, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:17:05 GMT+0500 (Pakistan Standard Time)', 500, 500, 200, 200, 1000, 1500, 400, 500, 500, 500, 500, 500, 6800, 500, 6300, 0),
(13, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:17:05 GMT+0500 (Pakistan Standard Time)', 500, 500, 200, 200, 1000, 1500, 400, 500, 500, 500, 500, 500, 6800, 500, 6300, 0),
(14, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:21:56 GMT+0500 (Pakistan Standard Time)', 500, 500, 200, 100, 1000, 1500, 0, 500, 500, 500, 500, 0, 5800, 500, 5300, 0),
(15, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:24:09 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 100, 500, 1500, 500, 500, 500, 500, 0, 0, 5600, 5, 5595, 1),
(16, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Fri Apr 15 2022 23:42:03 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 1500, 500, 500, 500, 500, 500, 500, 7200, 500, 6700, 1),
(17, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Sat Apr 16 2022 03:29:30 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 1500, 500, 500, 500, 500, 500, 500, 7200, 200, 7000, 1),
(18, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'Sat Apr 16 2022 19:47:06 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 1500, 500, 500, 500, 500, 500, 500, 7200, 500, 6700, 1),
(19, '1999632-ME', 'test Patient', '03128776604', 'Sat Apr 16 2022 22:29:28 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 200, 1000, 1500, 500, 500, 500, 500, 500, 500, 7200, 500, 6700, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_patient`
--

CREATE TABLE `emergency_patient` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(25) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `DOCTOR_ID` int(10) NOT NULL,
  `PATIENT_DATE_TIME` varchar(100) DEFAULT NULL,
  `STAFF_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency_patient`
--

INSERT INTO `emergency_patient` (`PATIENT_ID`, `PATIENT_MR_ID`, `PATIENT_NAME`, `PATIENT_MOBILE`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `DOCTOR_ID`, `PATIENT_DATE_TIME`, `STAFF_ID`) VALUES
(1, '1999632-ME', 'test Patient', '03128776604', 'male', '25', 'Lahore, Pakistan', 1, 'Tue Feb 15 2022 18:33:19 GMT+0500 (Pakistan Standard Time)', 1),
(2, '8481268-ME', 'Mubeen Hussain Shah', '03123456789', 'male', '25', 'Lahore, Pakistan', 1, 'Sun Mar 13 2022 18:34:41 GMT+0500 (Pakistan Standard Time)', 1),
(3, '8691978-ME', 'Zahid Shah', '03216549873', 'male', '23', 'Lahore, Pakistan', 1, 'Sun Mar 13 2022 18:38:11 GMT+0500 (Pakistan Standard Time)', 1),
(4, '8795338-ME', 'Mubeen shah', '03215469877', 'male', '34', 'afdsfdsf', 1, 'Sun Mar 13 2022 18:39:55 GMT+0500 (Pakistan Standard Time)', 1),
(5, '9082015-ME', 'sdsdwea', '2342342344', 'male', '23', '2dfsdvxvdfvxcvdfvf', 1, 'Sun Mar 13 2022 21:31:21 GMT+0500 (Pakistan Standard Time)', 1),
(6, '8559360-ME', 'Alina Waseem', '03216549871', 'male', '24', 'Lahore, Pakistan', 3, 'Mon Apr 04 2022 15:35:59 GMT+0500 (Pakistan Standard Time)', 1),
(7, '0816765-ME', 'testTwo Patient', '0321547659875', 'male', '56', 'Lahore, Pakistan', 2, 'Sun Apr 10 2022 13:53:36 GMT+0500 (Pakistan Standard Time)', 1),
(8, '0855240-ME', 'testthreePatient', '0321654987123', 'male', '25', 'Lahore, Pakistan', 3, 'Sun Apr 10 2022 13:54:15 GMT+0500 (Pakistan Standard Time)', 1),
(9, '1168836-ME', 'testfour', '012345698745', 'male', '25', 'Lahore, Pakistan', 4, 'Sun Apr 10 2022 13:59:28 GMT+0500 (Pakistan Standard Time)', 1),
(10, '1243204-ME', 'testFive', '01236524198', 'male', '35', 'Lahore, Pakistan', 4, 'Sun Apr 10 2022 14:00:43 GMT+0500 (Pakistan Standard Time)', 1),
(11, '2283349-ME', 'testSix', '03216549874563', 'male', '25', 'Lahore, Pakistan', 4, 'Sun Apr 10 2022 14:18:03 GMT+0500 (Pakistan Standard Time)', 1),
(12, '2632573-ME', 'TestSeven', '01231253696857', 'male', '29', 'Lahore, Pakistan', 10, 'Sun Apr 10 2022 14:23:52 GMT+0500 (Pakistan Standard Time)', 1),
(13, '3468901-ME', 'TestEight', '032165498714', 'male', '30', 'Lahore, Pakistan', 10, 'Sun Apr 10 2022 14:37:48 GMT+0500 (Pakistan Standard Time)', 1),
(14, '3945081-ME', 'TestNine', '012569365241', 'male', '24', 'Lahore, Pakistan', 21, 'Sun Apr 10 2022 14:45:44 GMT+0500 (Pakistan Standard Time)', 1),
(15, '4206633-ME', 'TestTen', '01478523693', 'male', '29', 'Lahore, Pakistan', 23, 'Sun Apr 10 2022 14:50:06 GMT+0500 (Pakistan Standard Time)', 1),
(16, '9003487-ME', 'zahid one two three', '32165498741526', 'male', '54', 'Lahore, Pakistan', 2, 'Sat Apr 16 2022 19:23:23 GMT+0500 (Pakistan Standard Time)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_service`
--

CREATE TABLE `emergency_service` (
  `SERVICE_ID` int(10) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_AMOUNT` int(20) DEFAULT NULL,
  `SERVICE_STATUS` varchar(20) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `SERVICE_DATE_TIME` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency_service`
--

INSERT INTO `emergency_service` (`SERVICE_ID`, `SERVICE_NAME`, `SERVICE_AMOUNT`, `SERVICE_STATUS`, `STAFF_ID`, `SERVICE_DATE_TIME`) VALUES
(1, 'Emergency Slip / Medical Officer', 500, 'active', 1, 'Fri Mar 18 2022 18:13:03 GMT+0500 (Pakistan Standard Time)'),
(2, 'Injection I/M', 100, 'active', 1, 'Fri Mar 18 2022 18:43:49 GMT+0500 (Pakistan Standard Time)'),
(3, 'Injection I/V', 200, 'active', 1, 'Fri Mar 18 2022 18:44:17 GMT+0500 (Pakistan Standard Time)'),
(4, 'I/V Line (In / Out)', 0, 'active', 1, 'Fri Mar 18 2022 18:44:25 GMT+0500 (Pakistan Standard Time)'),
(5, 'I/V infusion', 0, 'active', 1, 'Fri Mar 18 2022 18:44:31 GMT+0500 (Pakistan Standard Time)'),
(6, 'Per Stitch In x 300', 0, 'active', 1, 'Fri Mar 18 2022 18:44:47 GMT+0500 (Pakistan Standard Time)'),
(7, 'Per Stitch Out x 100', 0, 'active', 1, 'Fri Mar 18 2022 18:44:55 GMT+0500 (Pakistan Standard Time)'),
(8, 'BSF / BSR', 100, 'active', 1, 'Fri Mar 18 2022 18:44:59 GMT+0500 (Pakistan Standard Time)'),
(9, 'Short Stay (After One Hour)', 0, 'active', 1, 'Fri Mar 18 2022 18:45:06 GMT+0500 (Pakistan Standard Time)'),
(10, 'BP', 50, 'active', 1, 'Fri Mar 18 2022 18:45:18 GMT+0500 (Pakistan Standard Time)'),
(11, 'ECG', 500, 'active', 1, 'Fri Mar 18 2022 18:45:25 GMT+0500 (Pakistan Standard Time)'),
(12, 'Other', 0, 'active', 1, 'Fri Mar 18 2022 18:45:32 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `eye_service`
--

CREATE TABLE `eye_service` (
  `SERVICE_ID` int(11) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_STATUS` varchar(20) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `SERVICE_DATE_TIME` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eye_service`
--

INSERT INTO `eye_service` (`SERVICE_ID`, `SERVICE_NAME`, `SERVICE_STATUS`, `STAFF_ID`, `SERVICE_DATE_TIME`) VALUES
(1, 'OT Charges', 'active', 1, 'Fri Mar 18 2022 18:40:15 GMT+0500 (Pakistan Standard Time)'),
(2, 'OTA Charges', 'active', 1, 'Fri Mar 18 2022 18:56:40 GMT+0500 (Pakistan Standard Time)'),
(3, 'Injection Charges', 'active', 1, 'Fri Mar 18 2022 18:56:47 GMT+0500 (Pakistan Standard Time)'),
(4, 'Lens Charges', 'active', 1, 'Fri Mar 18 2022 18:56:52 GMT+0500 (Pakistan Standard Time)'),
(5, 'Medicines Charges', 'active', 1, 'Fri Mar 18 2022 18:56:58 GMT+0500 (Pakistan Standard Time)'),
(6, 'Medication Charges', 'active', 1, 'Fri Mar 18 2022 18:57:04 GMT+0500 (Pakistan Standard Time)'),
(7, 'Others', 'active', 1, 'Fri Mar 18 2022 18:57:10 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `illness_service`
--

CREATE TABLE `illness_service` (
  `SERVICE_ID` int(11) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_STATUS` varchar(20) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `SERVICE_DATE_TIME` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `illness_service`
--

INSERT INTO `illness_service` (`SERVICE_ID`, `SERVICE_NAME`, `SERVICE_STATUS`, `STAFF_ID`, `SERVICE_DATE_TIME`) VALUES
(1, 'Pvt Room Charges', 'active', 1, 'Fri Mar 18 2022 18:36:27 GMT+0500 (Pakistan Standard Time)'),
(2, 'Medical Officer Charges', 'active', 1, 'Fri Mar 18 2022 18:51:36 GMT+0500 (Pakistan Standard Time)'),
(3, 'Monitoring Charges', 'active', 1, 'Fri Mar 18 2022 18:54:07 GMT+0500 (Pakistan Standard Time)'),
(4, 'Nursing Charges', 'active', 1, 'Fri Mar 18 2022 18:54:13 GMT+0500 (Pakistan Standard Time)'),
(5, 'Oxygen Charges', 'active', 1, 'Fri Mar 18 2022 18:54:20 GMT+0500 (Pakistan Standard Time)'),
(6, 'Consultant Charges (Per Visit)', 'active', 1, 'Fri Mar 18 2022 18:54:26 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `indoor_bill`
--

CREATE TABLE `indoor_bill` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `CNIC` int(20) DEFAULT NULL,
  `ADMIT_DATE_RANGE` varchar(100) DEFAULT NULL,
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
  `TOTAL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indoor_bill`
--

INSERT INTO `indoor_bill` (`BILL_ID`, `MR_ID`, `PATIENT_NAME`, `MOBILE`, `CNIC`, `ADMIT_DATE_RANGE`, `DATE_TIME`, `ADMISSION_CHARGE`, `SURGEON_CHARGE`, `ANESTHETIST_CHARGE`, `OPERATION_CHARGE`, `LABOUR_ROOM_CHARGE`, `PEDIATRIC_CHARGE`, `PRIVATE_ROOM_CHARGE`, `NURSURY_CHARGE`, `NURSURY_STAFF_CHARGE`, `MO_CHARGE`, `CONSULTANT_CHARGE`, `CTG_CHARGE`, `RECOVERY_ROOM_CHARGE`, `OTHER`, `TOTAL_AMOUNT`, `DISCOUNT`, `TOTAL`, `CREATED_BY`) VALUES
(1, '7533888-ME', 'Alina Waseem', '03216549874', 2147483647, NULL, 'Thu Apr 14 2022 01:32:45 GMT+0500 (Pakistan Standard Time)', 2000, 2000, 2000, 2000, 2000, 2000, 24000, 8000, 2000, 2000, 2000, 2000, 2000, 0, 54000, 4000, 50000, 1),
(2, '7533888-ME', 'Alina Waseem', '03216549874', 2147483647, NULL, 'Thu Apr 14 2022 01:32:45 GMT+0500 (Pakistan Standard Time)', 2000, 2000, 2000, 2000, 2000, 2000, 24000, 8000, 2000, 2000, 2000, 2000, 2000, 0, 54000, 4000, 50000, 1),
(3, '7533888-ME', 'Alina Waseem', '03216549874', 2147483647, NULL, 'Thu Apr 14 2022 01:39:47 GMT+0500 (Pakistan Standard Time)', 2000, 2000, 2000, 2000, 2000, 2000, 32000, 2000, 2000, 2000, 2000, 2000, 2000, 1000, 57000, 7000, 50000, 1),
(4, '7533888-ME', 'Alina Waseem', '03216549874', 2147483647, NULL, 'Thu Apr 14 2022 01:39:47 GMT+0500 (Pakistan Standard Time)', 2000, 2000, 2000, 2000, 2000, 2000, 32000, 2000, 2000, 2000, 2000, 2000, 2000, 1000, 57000, 7000, 50000, 1),
(5, '7533888-ME', 'Alina Waseem', '03216549874', 2147483647, NULL, 'Thu Apr 14 2022 01:39:47 GMT+0500 (Pakistan Standard Time)', 2000, 2000, 2000, 2000, 2000, 2000, 32000, 2000, 2000, 2000, 2000, 2000, 2000, 1000, 57000, 7000, 50000, 1),
(6, '7533888-ME', 'Alina Waseem', '03216549874', 2147483647, NULL, 'Thu Apr 14 2022 01:39:47 GMT+0500 (Pakistan Standard Time)', 2000, 2000, 2000, 2000, 2000, 2000, 32000, 2000, 2000, 2000, 2000, 2000, 2000, 1000, 57000, 7000, 50000, 1),
(7, '5094626-ME', 'Mubeen Bashir', '0312-8776604', 2147483647, NULL, 'Thu Apr 14 2022 01:42:53 GMT+0500 (Pakistan Standard Time)', 100, 100, 100, 100, 100, 100, 15000, 100, 100, 100, 100, 100, 100, 100, 16300, 500, 15800, 1),
(8, '5094626-ME', 'Mubeen Bashir', '0312-8776604', 2147483647, NULL, 'Thu Apr 14 2022 01:42:53 GMT+0500 (Pakistan Standard Time)', 100, 100, 100, 100, 100, 100, 15000, 100, 100, 100, 100, 100, 100, 100, 16300, 500, 15800, 1),
(9, '5094626-ME', 'Mubeen Bashir', '0312-8776604', 2147483647, NULL, 'Thu Apr 14 2022 01:42:53 GMT+0500 (Pakistan Standard Time)', 100, 100, 100, 100, 100, 100, 15000, 100, 100, 100, 100, 100, 100, 100, 16300, 500, 15800, 1),
(10, '5094626-ME', 'Mubeen Bashir', '0312-8776604', 2147483647, NULL, 'Thu Apr 14 2022 01:42:53 GMT+0500 (Pakistan Standard Time)', 100, 100, 100, 100, 100, 100, 15000, 100, 100, 100, 100, 100, 100, 100, 16300, 500, 15800, 1),
(11, '5094626-ME', 'Mubeen Bashir', '0312-8776604', 2147483647, NULL, 'Thu Apr 14 2022 01:51:06 GMT+0500 (Pakistan Standard Time)', 100, 100, 100, 100, 100, 111, 24000, 100, 100, 100, 100, 100, 100, 100, 25311, 100, 25211, 1),
(12, '5094626-ME', 'Mubeen Bashir', '0312-8776604', 2147483647, NULL, 'Thu Apr 14 2022 01:51:06 GMT+0500 (Pakistan Standard Time)', 100, 100, 100, 100, 100, 111, 0, 100, 100, 100, 100, 100, 100, 100, 1311, 500, 811, 1),
(13, '5094626-ME', 'Mubeen Bashir', '0312-8776604', 2147483647, '04/10/2022 2:05 AM', 'Thu Apr 14 2022 02:05:04 GMT+0500 (Pakistan Standard Time)', 100, 100, 100, 100, 100, 1100, 32000, 100, 100, 100, 100, 100, 100, 100, 34300, 300, 34000, 1),
(14, '7533888-ME', 'Alina Waseem', '03216549874', 2147483647, '04/12/2022 12:00 AM - 04/16/2022 11:00 PM', 'Sat Apr 16 2022 01:34:22 GMT+0500 (Pakistan Standard Time)', 200, 200, 200, 200, 200, 200, 30000, 200, 200, 200, 200, 200, 200, 200, 32600, 500, 32100, 1),
(15, '1999632-ME', 'test Patient', '03128776604', 0, '04/12/2022 12:00 AM - 04/16/2022 12:00 PM', 'Sat Apr 16 2022 19:55:50 GMT+0500 (Pakistan Standard Time)', 500, 500, 500, 500, 500, 500, 40000, 500, 500, 500, 500, 500, 500, 500, 46500, 500, 46000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `indoor_patient`
--

CREATE TABLE `indoor_patient` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(25) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `INDOOR_TYPE` varchar(10) NOT NULL,
  `PATIENT_PROCEDURE` varchar(500) DEFAULT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_CNIC` varchar(20) DEFAULT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `DOCTOR_ID` int(10) NOT NULL,
  `PATIENT_DATE_TIME` varchar(100) DEFAULT NULL,
  `STAFF_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indoor_patient`
--

INSERT INTO `indoor_patient` (`PATIENT_ID`, `PATIENT_MR_ID`, `PATIENT_NAME`, `INDOOR_TYPE`, `PATIENT_PROCEDURE`, `PATIENT_MOBILE`, `PATIENT_CNIC`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `DOCTOR_ID`, `PATIENT_DATE_TIME`, `STAFF_ID`) VALUES
(1, '1999632-ME', 'test Patient', 'outdoor', NULL, '03128776604', '', 'male', '25', 'Lahore, Pakistan', 1, 'Tue Feb 15 2022 18:33:19 GMT+0500 (Pakistan Standard Time)', 1),
(2, '0967140-ME', 'eserser', 'gensurgery', 'sfdsfsf,fwerwer,rewerw,rewerwe,erwerewr', '2342342342343', NULL, 'male', '34', 'Lahore, Pakistan', 1, 'Sun Mar 13 2022 19:16:06 GMT+0500 (Pakistan Standard Time)', 1),
(3, '1146677-ME', 'dfsdfsdf', 'gensurgery', 'esdfds,sdfsdf,sfsdfsfs,sfsdfsdfs,fsdfsdf', '324234234', '2222222222222', 'female', '34', 'Lahore, Pakistan', 1, 'Sun Mar 13 2022 19:19:06 GMT+0500 (Pakistan Standard Time)', 1),
(4, '8880581-ME', 'fsdfwewef', 'eye', 'fsfsdfdf,sdfsdfsdf,sdfsdfsdf,sfdsfsfwer,efefsefse', '2342344324', '4323423423422', 'male', '34', 'Lahore, Pakistan', 1, 'Sun Mar 13 2022 21:28:00 GMT+0500 (Pakistan Standard Time)', 1),
(5, '5094626-ME', 'Mubeen Bashir', 'gynae', 'this is procedure, this is also a procedure', '0312-8776604', '3520151562791', 'male', '23', 'Lahore, Pakistan', 22, 'Fri Mar 18 2022 22:38:14 GMT+0500 (Pakistan Standard Time)', 1),
(6, '7533888-ME', 'Alina Waseem', 'genillness', 'having serious stomach pain', '03216549874', '35201545612341', 'female', '24', 'Lahore, Pakistan', 1, 'Mon Apr 11 2022 02:52:13 GMT+0500 (Pakistan Standard Time)', 1),
(7, '7994881-ME', 'Test Three', 'eye', 'Problem in retina and having iching in eyes. need to have further examination to have better understanding', '03214253974', '3520151562791', 'male', '25', 'Lahore, Pakistan lidar DHA city phase 6 near askari 11 , Lahore, Pakistan', 3, 'Mon Apr 11 2022 02:59:54 GMT+0500 (Pakistan Standard Time)', 1),
(8, '1890878-ME', 'Testing one two three', 'gynae', 'this is a test procedure and nothing more than that', '+92312879865415', '352015156279145', 'male', '26', 'this is a test address and nothing more than that', 2, 'Sat Apr 16 2022 03:31:30 GMT+0500 (Pakistan Standard Time)', 1),
(9, '9084397-ME', 'zahid test one two three', 'gynae', 'this is a test procedure and nothing more.', '1593574682', '357951321654987', 'male', '35', 'Lahore, Pakistan', 3, 'Sat Apr 16 2022 19:24:44 GMT+0500 (Pakistan Standard Time)', 1),
(10, '0004506-ME', 'Zahid testing One two three', 'eye', 'this is a test procedure and nothing More than that', '+9231265498712', '35201515627913', 'male', '35', 'Lahore, Pakistan', 2, 'Sat Apr 16 2022 19:40:04 GMT+0500 (Pakistan Standard Time)', 1);

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
-- Table structure for table `outdoor_patient`
--

CREATE TABLE `outdoor_patient` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(25) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `DEPT_ID` int(10) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_CNIC` varchar(20) DEFAULT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `DOCTOR_ID` int(10) NOT NULL,
  `CONSULTANT_FEE` int(20) NOT NULL,
  `PATIENT_DATE_TIME` varchar(100) DEFAULT NULL,
  `STAFF_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outdoor_patient`
--

INSERT INTO `outdoor_patient` (`PATIENT_ID`, `PATIENT_MR_ID`, `PATIENT_NAME`, `DEPT_ID`, `PATIENT_MOBILE`, `PATIENT_CNIC`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `DOCTOR_ID`, `CONSULTANT_FEE`, `PATIENT_DATE_TIME`, `STAFF_ID`) VALUES
(1, '1999632-ME', 'test Patient', 0, '03128776604', '', 'male', '25', 'Lahore, Pakistan', 1, 0, 'Tue Feb 15 2022 18:33:19 GMT+0500 (Pakistan Standard Time)', 1),
(2, '0226191-ME', 'sfdsfsdfdsf', 1, '4534543543534', NULL, 'male', '34', 'fsdfsdfsdfsdf', 1, 5000, 'Sun Mar 13 2022 19:03:45 GMT+0500 (Pakistan Standard Time)', 1),
(3, '9128508-ME', 'asdasdasd', 1, '4324324234', NULL, 'male', '34', 'dsfsdfdsf,afdsfdfdfdf,afdsfdsf', 1, 3434, 'Sun Mar 13 2022 21:32:08 GMT+0500 (Pakistan Standard Time)', 1),
(4, '0243691-ME', 'Test Mubeen', 1, '0321654987325', NULL, 'male', '23', 'lahore,Pakistan', 1, 500, 'Thu Mar 17 2022 17:30:43 GMT+0500 (Pakistan Standard Time)', 1),
(5, '4647550-ME', 'Alina Wassem', 1, '032165498745', NULL, 'male', '26', 'Lahore, Pakistan', 1, 25000, 'Sun Apr 10 2022 20:30:47 GMT+0500 (Pakistan Standard Time)', 1),
(6, '6392392-ME', 'Test Two', 1, '012365478932', NULL, 'male', '26', 'Lahore, Pakistan', 1, 25000, 'Mon Apr 11 2022 02:33:12 GMT+0500 (Pakistan Standard Time)', 1),
(7, '0161026-ME', 'Zahid Test One two Three Four', 1, '+9231287766045', NULL, 'male', '38', 'Lahore, Pakistan', 1, 500, 'Sat Apr 16 2022 19:42:40 GMT+0500 (Pakistan Standard Time)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(25) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_CNIC` varchar(20) DEFAULT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `CREATED_ON` varchar(100) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PATIENT_ID`, `PATIENT_MR_ID`, `PATIENT_NAME`, `PATIENT_MOBILE`, `PATIENT_CNIC`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `CREATED_ON`, `CREATED_BY`) VALUES
(1, '1999632-ME', 'test Patient', '03128776604', '', 'male', '25', 'Lahore, Pakistan', 'Tue Feb 15 2022 18:33:19 GMT+0500 (Pakistan Standard Time)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_type`
--

CREATE TABLE `patient_type` (
  `PATIENT_TYPE_ID` int(10) NOT NULL,
  `PATIENT_TYPE_NAME` varchar(100) NOT NULL,
  `PATIENT_TYPE_ALAIS` varchar(15) NOT NULL,
  `TYPE_SAVE_TIME` varchar(100) NOT NULL,
  `PATIENT_TYPE_STATUS` varchar(10) NOT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_type`
--

INSERT INTO `patient_type` (`PATIENT_TYPE_ID`, `PATIENT_TYPE_NAME`, `PATIENT_TYPE_ALAIS`, `TYPE_SAVE_TIME`, `PATIENT_TYPE_STATUS`, `CREATED_BY`) VALUES
(1, 'Indoor Patient', 'indoor', '2022-01-23 14:35:39', 'active', 0),
(2, 'OPD Patient', 'outdoor', '2022-01-23 14:41:50', 'active', 0),
(3, 'Emergency Patient', 'outdoor', 'Fri Jan 28 2022 22:29:49 GMT+0500 (Pakistan Standard Time)', 'active', 0),
(4, 'test', 'indoor', 'Tue Feb 15 2022 18:28:03 GMT+0500 (Pakistan Standard Time)', 'active', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `surgery_service`
--

CREATE TABLE `surgery_service` (
  `SERVICE_ID` int(11) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_STATUS` varchar(20) NOT NULL,
  `STAFF_ID` int(10) NOT NULL,
  `SERVICE_DATE_TIME` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surgery_service`
--

INSERT INTO `surgery_service` (`SERVICE_ID`, `SERVICE_NAME`, `SERVICE_STATUS`, `STAFF_ID`, `SERVICE_DATE_TIME`) VALUES
(1, 'Admission Charges', 'active', 1, 'Fri Mar 18 2022 18:29:00 GMT+0500 (Pakistan Standard Time)'),
(2, 'Surgeon Charges', 'active', 1, 'Fri Mar 18 2022 18:49:10 GMT+0500 (Pakistan Standard Time)'),
(3, 'Anethetist Charges', 'active', 1, 'Fri Mar 18 2022 18:49:14 GMT+0500 (Pakistan Standard Time)'),
(4, 'Operation Theater Charges', 'active', 1, 'Fri Mar 18 2022 18:49:19 GMT+0500 (Pakistan Standard Time)'),
(5, 'Labour Room Charges', 'active', 1, 'Fri Mar 18 2022 18:49:27 GMT+0500 (Pakistan Standard Time)'),
(6, 'Pediatric Charges', 'active', 1, 'Fri Mar 18 2022 18:49:32 GMT+0500 (Pakistan Standard Time)'),
(7, 'Nursury Charges', 'active', 1, 'Fri Mar 18 2022 18:49:37 GMT+0500 (Pakistan Standard Time)'),
(8, 'Nursury Staff Charges', 'active', 1, 'Fri Mar 18 2022 18:49:42 GMT+0500 (Pakistan Standard Time)'),
(9, 'MO Charges', 'active', 1, 'Fri Mar 18 2022 18:49:48 GMT+0500 (Pakistan Standard Time)'),
(10, 'Consultant Visit Charges', 'active', 1, 'Fri Mar 18 2022 18:49:52 GMT+0500 (Pakistan Standard Time)'),
(11, 'CTG Charges', 'active', 1, 'Fri Mar 18 2022 18:50:00 GMT+0500 (Pakistan Standard Time)'),
(12, 'Recovery Room Charges', 'active', 1, 'Fri Mar 18 2022 18:50:06 GMT+0500 (Pakistan Standard Time)'),
(13, 'Private Room Charges', 'active', 1, 'Fri Mar 18 2022 18:50:13 GMT+0500 (Pakistan Standard Time)'),
(14, 'Other Charges', 'active', 1, 'Fri Mar 18 2022 18:50:19 GMT+0500 (Pakistan Standard Time)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `bill_record`
--
ALTER TABLE `bill_record`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `bill_service`
--
ALTER TABLE `bill_service`
  ADD PRIMARY KEY (`BILL_SERVICE_ID`);

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
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`EDUCATION_ID`);

--
-- Indexes for table `emergency_bill`
--
ALTER TABLE `emergency_bill`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `emergency_patient`
--
ALTER TABLE `emergency_patient`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD UNIQUE KEY `PATIENT_MOBILE` (`PATIENT_MOBILE`);

--
-- Indexes for table `emergency_service`
--
ALTER TABLE `emergency_service`
  ADD PRIMARY KEY (`SERVICE_ID`);

--
-- Indexes for table `eye_service`
--
ALTER TABLE `eye_service`
  ADD PRIMARY KEY (`SERVICE_ID`);

--
-- Indexes for table `illness_service`
--
ALTER TABLE `illness_service`
  ADD PRIMARY KEY (`SERVICE_ID`);

--
-- Indexes for table `indoor_bill`
--
ALTER TABLE `indoor_bill`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `indoor_patient`
--
ALTER TABLE `indoor_patient`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD UNIQUE KEY `PATIENT_MOBILE` (`PATIENT_MOBILE`);

--
-- Indexes for table `indoor_type`
--
ALTER TABLE `indoor_type`
  ADD PRIMARY KEY (`TYPE_ID`);

--
-- Indexes for table `outdoor_patient`
--
ALTER TABLE `outdoor_patient`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD UNIQUE KEY `PATIENT_MOBILE` (`PATIENT_MOBILE`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD UNIQUE KEY `PATIENT_MOBILE` (`PATIENT_MOBILE`);

--
-- Indexes for table `patient_type`
--
ALTER TABLE `patient_type`
  ADD PRIMARY KEY (`PATIENT_TYPE_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ROOM_ID`);

--
-- Indexes for table `surgery_service`
--
ALTER TABLE `surgery_service`
  ADD PRIMARY KEY (`SERVICE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill_record`
--
ALTER TABLE `bill_record`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill_service`
--
ALTER TABLE `bill_service`
  MODIFY `BILL_SERVICE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `EDUCATION_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emergency_bill`
--
ALTER TABLE `emergency_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `emergency_patient`
--
ALTER TABLE `emergency_patient`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `emergency_service`
--
ALTER TABLE `emergency_service`
  MODIFY `SERVICE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `eye_service`
--
ALTER TABLE `eye_service`
  MODIFY `SERVICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `illness_service`
--
ALTER TABLE `illness_service`
  MODIFY `SERVICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `indoor_bill`
--
ALTER TABLE `indoor_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `indoor_patient`
--
ALTER TABLE `indoor_patient`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `indoor_type`
--
ALTER TABLE `indoor_type`
  MODIFY `TYPE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `outdoor_patient`
--
ALTER TABLE `outdoor_patient`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_type`
--
ALTER TABLE `patient_type`
  MODIFY `PATIENT_TYPE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `ROOM_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surgery_service`
--
ALTER TABLE `surgery_service`
  MODIFY `SERVICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
