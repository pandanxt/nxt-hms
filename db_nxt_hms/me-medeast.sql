-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2022 at 07:13 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `me-medeast`
--

-- --------------------------------------------------------

--
-- Table structure for table `me_bill`
--

CREATE TABLE `me_bill` (
  `BILL_UUID` varchar(10) NOT NULL,
  `BILL_MRID` varchar(10) NOT NULL,
  `BILL_SLIP_UUID` varchar(10) NOT NULL,
  `BILL_NAME` varchar(100) NOT NULL,
  `BILL_MOBILE` varchar(15) NOT NULL,
  `BILL_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `BILL_AMOUNT` int(10) NOT NULL DEFAULT 0,
  `BILL_DISCOUNT` int(10) DEFAULT 0,
  `BILL_TOTAL` int(10) NOT NULL DEFAULT 0,
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_bill`
--

INSERT INTO `me_bill` (`BILL_UUID`, `BILL_MRID`, `BILL_SLIP_UUID`, `BILL_NAME`, `BILL_MOBILE`, `BILL_DATE_TIME`, `BILL_AMOUNT`, `BILL_DISCOUNT`, `BILL_TOTAL`, `STAFF_ID`) VALUES
('081711-BID', '502256-MRD', '502256-SLP', 'Test Slip Indoor Gen Illness', '03256987456', '2022-09-27 15:21:58', 64000, 500, 63500, '776604-USR'),
('137300-BID', '799335-MRD', '799335-SLP', 'Test Slip Emergency two', '03225896475', '2022-09-25 22:17:08', 25750, 500, 25250, '776604-USR'),
('197072-BID', '401506-MRD', '401506-SLP', 'Test Emergency Slip Third', '03225894123', '2022-09-25 19:46:54', 4500, 500, 4000, '776604-USR'),
('355694-BID', '672649-MRD', '672649-SLP', 'Test Ameena', '03215465985', '2022-10-01 18:02:52', 9000, 500, 8500, '776604-USR'),
('431479-BID', '382522-MRD', '773095-SLP', 'Test Slip Emergency', '03225456987', '2022-09-25 18:44:34', 16000, 500, 15500, '776604-USR'),
('458059-BID', '405407-MRD', '405407-SLP', 'TEst Mubeen', '032154569874', '2022-10-01 18:04:33', 75000, 500, 74500, '776604-USR'),
('574456-BID', '532269-MRD', '532269-SLP', 'Testing Again Mubeen', '03256985756', '2022-10-01 18:06:37', 23500, 500, 23000, '776604-USR'),
('669754-BID', '618358-MRD', '618358-SLP', 'Testing Again Emergency', '03215654987', '2022-10-01 18:08:06', 20000, 540, 19460, '776604-USR'),
('760815-BID', '706511-MRD', '706511-SLP', 'Testing Again Emergency', '03215654568', '2022-10-01 18:09:38', 3650, 450, 3200, '776604-USR'),
('888691-BID', '633722-MRD', '633722-SLP', 'Test Slip Eye', '03234169956', '2022-09-27 15:18:18', 50000, 5000, 45000, '776604-USR'),
('967770-BID', '382522-MRD', '382522-SLP', 'Test Slip Indoor General Surgery', '03225456987', '2022-09-27 15:20:28', 30200, 4500, 25700, '776604-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_department`
--

CREATE TABLE `me_department` (
  `DEPARTMENT_UUID` varchar(10) NOT NULL,
  `DEPARTMENT_NAME` varchar(100) NOT NULL,
  `DEPARTMENT_STATUS` int(10) NOT NULL DEFAULT 1,
  `DEPARTMENT_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_department`
--

INSERT INTO `me_department` (`DEPARTMENT_UUID`, `DEPARTMENT_NAME`, `DEPARTMENT_STATUS`, `DEPARTMENT_DATE_TIME`, `STAFF_ID`) VALUES
('014656-DEP', 'Gynecology', 1, '2022-09-18 13:17:16', '776604-USR'),
('038852-DEP', 'Ophthalmology', 1, '2022-09-18 13:18:14', '776604-USR'),
('096538-DEP', 'Pediatric', 1, '2022-09-18 13:18:45', '776604-USR'),
('127260-DEP', 'Pediatric Surgery', 1, '2022-09-18 13:19:06', '776604-USR'),
('148883-DEP', 'Medical Specialist', 1, '2022-09-18 13:19:52', '776604-USR'),
('195084-DEP', 'General Surgery', 1, '2022-09-18 13:20:50', '776604-USR'),
('252801-DEP', 'Psychiatrist', 1, '2022-09-18 13:21:14', '776604-USR'),
('276503-DEP', 'Psychologist', 1, '2022-09-18 13:23:01', '776604-USR'),
('384146-DEP', 'ENT', 1, '2022-09-18 13:23:40', '776604-USR'),
('423294-DEP', 'Orthopedic', 1, '2022-09-18 13:24:06', '776604-USR'),
('448824-DEP', 'Radiology', 1, '2022-09-18 13:24:21', '776604-USR'),
('462994-DEP', 'Skin', 1, '2022-09-18 13:24:31', '776604-USR'),
('473272-DEP', 'Urology', 1, '2022-09-18 13:24:44', '776604-USR'),
('486130-DEP', 'Cardiology', 1, '2022-09-18 13:26:03', '776604-USR'),
('566141-DEP', 'Physiotherapy', 1, '2022-09-18 13:26:42', '776604-USR'),
('604207-DEP', 'Nutrition', 1, '2022-09-18 13:27:24', '776604-USR'),
('646955-DEP', 'Cupping Therapy', 1, '2022-09-18 13:28:18', '776604-USR'),
('701131-DEP', 'Speech Therapy', 1, '2022-09-18 13:28:42', '776604-USR'),
('724274-DEP', 'Neurology', 1, '2022-09-18 13:29:26', '776604-USR'),
('768663-DEP', 'Medical Officer', 1, '2022-09-18 13:29:46', '776604-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_doctors`
--

CREATE TABLE `me_doctors` (
  `DOCTOR_UUID` varchar(10) NOT NULL,
  `DOCTOR_NAME` varchar(100) NOT NULL,
  `DOCTOR_MOBILE` varchar(15) DEFAULT NULL,
  `DOCTOR_DEPARTMENT` varchar(10) DEFAULT NULL,
  `DOCTOR_STATUS` int(10) NOT NULL DEFAULT 1,
  `DOCTOR_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `DOCTOR_TYPE` varchar(10) NOT NULL DEFAULT 'medeast',
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_doctors`
--

INSERT INTO `me_doctors` (`DOCTOR_UUID`, `DOCTOR_NAME`, `DOCTOR_MOBILE`, `DOCTOR_DEPARTMENT`, `DOCTOR_STATUS`, `DOCTOR_DATE_TIME`, `DOCTOR_TYPE`, `STAFF_ID`) VALUES
('014720-DOC', 'Dr Adeeb', '03328675357', '724274-DEP', 1, '2022-09-18 14:07:58', 'medeast', '776604-USR'),
('061612-DOC', 'Assist Prof Dr Riffat Sarwar', '03214822323', '014656-DEP', 1, '2022-09-18 13:36:19', 'medeast', '776604-USR'),
('080721-DOC', 'Dr Ayesha', '03054336062', '768663-DEP', 1, '2022-09-18 14:09:18', 'medeast', '776604-USR'),
('124890-DOC', 'Dr Mubeen Hussain', '03215456984', NULL, 1, '2022-09-18 14:26:39', 'visitor', '776604-USR'),
('127232-DOC', 'Prof Col (R) Dr Asghar Bhatti', '03218848231', '448824-DEP', 1, '2022-09-18 13:53:37', 'medeast', '776604-USR'),
('160536-DOC', 'Dr Arslan Amjad', '03234979798', '768663-DEP', 1, '2022-09-18 14:10:20', 'medeast', '776604-USR'),
('182307-DOC', 'Dr Sohaib Malik Abbas', '03008016669', '038852-DEP', 1, '2022-09-18 13:37:42', 'medeast', '776604-USR'),
('220308-DOC', 'Dr Sidra Tariq', '03235142071', '462994-DEP', 1, '2022-09-18 13:55:01', 'medeast', '776604-USR'),
('223226-DOC', 'Dr M Fahad Imtiaz', '03084040035', '768663-DEP', 1, '2022-09-18 14:11:33', 'medeast', '776604-USR'),
('264668-DOC', 'Brig (R) Dr Humma Farrukh', '03215214420', '096538-DEP', 1, '2022-09-18 13:38:55', 'medeast', '776604-USR'),
('304217-DOC', 'Assoc Prof Dr Hassan Raza Asghar', '03228468880', '473272-DEP', 1, '2022-09-18 13:56:27', 'medeast', '776604-USR'),
('338394-DOC', 'Brig (R) Dr Bashir Ahmad', '03459301357', '096538-DEP', 1, '2022-09-18 13:39:50', 'medeast', '776604-USR'),
('389327-DOC', 'Dr Kamran Zebi', '03334257695', '473272-DEP', 1, '2022-09-18 13:57:38', 'medeast', '776604-USR'),
('392546-DOC', 'Dr Hammad Aslma Butt', '03217121008', '127260-DEP', 1, '2022-09-18 13:40:54', 'medeast', '776604-USR'),
('457374-DOC', 'Maj Dr Bilal', '03494823007', '148883-DEP', 1, '2022-09-18 13:42:10', 'medeast', '776604-USR'),
('461481-DOC', 'Dr Sobbyal', '03338733138', '486130-DEP', 1, '2022-09-18 13:58:34', 'medeast', '776604-USR'),
('516617-DOC', 'Dr Sana Ayesha', '03124452951', '566141-DEP', 1, '2022-09-18 13:59:18', 'medeast', '776604-USR'),
('532449-DOC', 'Dr Muhammad Rashid Khan', '03008421108', '148883-DEP', 1, '2022-09-18 13:43:28', 'medeast', '776604-USR'),
('560257-DOC', 'Brig (R) Dr Tariq', '03015385256', '195084-DEP', 1, '2022-09-18 14:01:05', 'medeast', '776604-USR'),
('610773-DOC', 'Dr Javariya Hammad', '03334171809', '195084-DEP', 1, '2022-09-18 13:44:30', 'medeast', '776604-USR'),
('668412-DOC', 'Brig (R) Dr Javaid Hashmi', '03009197439', '195084-DEP', 1, '2022-09-18 14:02:23', 'medeast', '776604-USR'),
('672634-DOC', 'Dr Mehdi Raza Khawaja', '03218401331', '252801-DEP', 1, '2022-09-18 13:45:46', 'medeast', '776604-USR'),
('746185-DOC', 'Dr Humaira Rashid Khan', '03008421108', '604207-DEP', 1, '2022-09-18 14:03:05', 'medeast', '776604-USR'),
('749001-DOC', 'Dr Tanzeela Atif', '03226067885', '276503-DEP', 1, '2022-09-18 13:46:36', 'medeast', '776604-USR'),
('788208-DOC', 'Dr Javariya Asif', '03067029279', '604207-DEP', 1, '2022-09-18 14:04:04', 'medeast', '776604-USR'),
('798573-DOC', 'Maj (R) Khalid Ahmed', '03224232396', '384146-DEP', 1, '2022-09-18 13:47:57', 'medeast', '776604-USR'),
('846911-DOC', 'Dr Ayesha Nawaz', '03125456987', '646955-DEP', 1, '2022-09-18 14:05:11', 'medeast', '776604-USR'),
('879959-DOC', 'Dr Faheem Nawaz', '03018498483', '423294-DEP', 1, '2022-09-18 13:48:47', 'medeast', '776604-USR'),
('888120-DOC', 'Brig (R) Dr Shamim Akhtar', '03218823242', '014656-DEP', 1, '2022-09-18 13:34:19', 'medeast', '776604-USR'),
('914258-DOC', 'Dr Nida Zahid', '03311446896', '701131-DEP', 1, '2022-09-18 14:05:49', 'medeast', '776604-USR'),
('929669-DOC', 'Dr Tayyab Rehman', '03336918555', '423294-DEP', 1, '2022-09-18 13:49:33', 'medeast', '776604-USR'),
('951876-DOC', 'Dr Humaira Nazir', '03234401468', '701131-DEP', 1, '2022-09-18 14:06:52', 'medeast', '776604-USR'),
('976211-DOC', 'Dr Salma Muzaffar', '03006355995', '448824-DEP', 1, '2022-09-18 13:52:04', 'medeast', '776604-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_emergency`
--

CREATE TABLE `me_emergency` (
  `EMERGENCY_UUID` varchar(10) NOT NULL,
  `EMERGENCY_SLIP_UUID` varchar(10) NOT NULL,
  `EMERGENCY_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `ES_MO_FEE` int(10) NOT NULL DEFAULT 0,
  `INJECTION_IM` int(10) NOT NULL DEFAULT 0,
  `INJECTION_IV` int(10) NOT NULL DEFAULT 0,
  `DRIP` int(10) NOT NULL DEFAULT 0,
  `DRIP_VENOFER` int(10) NOT NULL DEFAULT 0,
  `INFUSION_ANTIBIOTIC` int(10) NOT NULL DEFAULT 0,
  `IV_LINE_IN_OUT` int(10) NOT NULL DEFAULT 0,
  `DRESSING_SMALL_LARGE` int(10) NOT NULL DEFAULT 0,
  `PER_STITCH_IN` int(10) NOT NULL DEFAULT 0,
  `PER_STITCH_OUT` int(10) NOT NULL DEFAULT 0,
  `BSF_BSR` int(10) NOT NULL DEFAULT 0,
  `BP` int(10) NOT NULL DEFAULT 0,
  `NEBULIZATION` int(10) NOT NULL DEFAULT 0,
  `ECG` int(10) NOT NULL DEFAULT 0,
  `MONITOR_CHARGE` int(10) NOT NULL DEFAULT 0,
  `CTG` int(10) NOT NULL DEFAULT 0,
  `FOLEY_CATHETER` int(10) NOT NULL DEFAULT 0,
  `STOMACH_WASH` int(10) NOT NULL DEFAULT 0,
  `BLOOD_TRANSFUSION` int(10) NOT NULL DEFAULT 0,
  `ASCITIC_DIAGNOSTIC_THERAPEUTIC` int(10) NOT NULL DEFAULT 0,
  `PLEURAL_FUID_THERAPEUTIC_DIAGNOSTIC` int(10) NOT NULL DEFAULT 0,
  `ENDO_TRACHEAL_TUBE` int(10) NOT NULL DEFAULT 0,
  `ENEMA` int(10) NOT NULL DEFAULT 0,
  `LUMBER_PUNCTURE` int(10) NOT NULL DEFAULT 0,
  `SHORT_STAY` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_1` varchar(100) DEFAULT NULL,
  `OTHER_1` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_2` varchar(100) DEFAULT NULL,
  `OTHER_2` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_3` varchar(100) DEFAULT NULL,
  `OTHER_3` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_4` varchar(100) DEFAULT NULL,
  `OTHER_4` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_5` varchar(100) DEFAULT NULL,
  `OTHER_5` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_6` varchar(100) DEFAULT NULL,
  `OTHER_6` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_7` varchar(100) DEFAULT NULL,
  `OTHER_7` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_8` varchar(100) DEFAULT NULL,
  `OTHER_8` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_9` varchar(100) DEFAULT NULL,
  `OTHER_9` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_10` varchar(100) DEFAULT NULL,
  `OTHER_10` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_11` varchar(100) DEFAULT NULL,
  `OTHER_11` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_12` varchar(100) DEFAULT NULL,
  `OTHER_12` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_emergency`
--

INSERT INTO `me_emergency` (`EMERGENCY_UUID`, `EMERGENCY_SLIP_UUID`, `EMERGENCY_DATE_TIME`, `ES_MO_FEE`, `INJECTION_IM`, `INJECTION_IV`, `DRIP`, `DRIP_VENOFER`, `INFUSION_ANTIBIOTIC`, `IV_LINE_IN_OUT`, `DRESSING_SMALL_LARGE`, `PER_STITCH_IN`, `PER_STITCH_OUT`, `BSF_BSR`, `BP`, `NEBULIZATION`, `ECG`, `MONITOR_CHARGE`, `CTG`, `FOLEY_CATHETER`, `STOMACH_WASH`, `BLOOD_TRANSFUSION`, `ASCITIC_DIAGNOSTIC_THERAPEUTIC`, `PLEURAL_FUID_THERAPEUTIC_DIAGNOSTIC`, `ENDO_TRACHEAL_TUBE`, `ENEMA`, `LUMBER_PUNCTURE`, `SHORT_STAY`, `OTHER_TEXT_1`, `OTHER_1`, `OTHER_TEXT_2`, `OTHER_2`, `OTHER_TEXT_3`, `OTHER_3`, `OTHER_TEXT_4`, `OTHER_4`, `OTHER_TEXT_5`, `OTHER_5`, `OTHER_TEXT_6`, `OTHER_6`, `OTHER_TEXT_7`, `OTHER_7`, `OTHER_TEXT_8`, `OTHER_8`, `OTHER_TEXT_9`, `OTHER_9`, `OTHER_TEXT_10`, `OTHER_10`, `OTHER_TEXT_11`, `OTHER_11`, `OTHER_TEXT_12`, `OTHER_12`) VALUES
('137300-BID', '799335-SLP', '2022-09-25 22:17:08', 100, 100, 100, 1200, 500, 700, 150, 300, 1750, 750, 100, 100, 100, 500, 6000, 500, 1200, 500, 500, 500, 3500, 500, 500, 500, 100, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, 'Test Field', 5000, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('197072-BID', '401506-SLP', '2022-09-25 19:46:54', 0, 500, 0, 0, 500, 0, 0, 0, 1750, 750, 0, 0, 0, 0, 0, 500, 0, 500, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('431479-BID', '773095-SLP', '2022-09-25 18:44:35', 500, 500, 500, 0, 500, 0, 0, 0, 1750, 750, 500, 500, 500, 500, 6000, 500, 0, 500, 500, 0, 0, 500, 500, 500, 500, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('760815-BID', '706511-SLP', '2022-10-01 18:09:38', 0, 500, 0, 0, 0, 0, 250, 0, 1750, 750, 0, 0, 0, 0, 0, 400, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `me_emergency_service_charge`
--

CREATE TABLE `me_emergency_service_charge` (
  `SERVICE_UUID` varchar(10) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_CHARGE` int(10) NOT NULL,
  `SERVICE_STATUS` int(10) NOT NULL DEFAULT 1,
  `SERVICE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_followup_slip`
--

CREATE TABLE `me_followup_slip` (
  `SLIP_UUID` varchar(10) NOT NULL,
  `SLIP_REFERENCE_UUID` varchar(10) NOT NULL,
  `SLIP_FEE` int(10) NOT NULL DEFAULT 0,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_followup_slip`
--

INSERT INTO `me_followup_slip` (`SLIP_UUID`, `SLIP_REFERENCE_UUID`, `SLIP_FEE`, `SLIP_DATE_TIME`, `STAFF_ID`) VALUES
('029117-FOL', '672649-SLP', 1200, '2022-10-01 00:27:30', '776604-USR'),
('147310-FOL', '061644-SLP', 0, '2022-09-30 13:39:15', '776604-USR'),
('244586-FOL', '200355-SLP', 0, '2022-10-01 16:05:09', '776604-USR'),
('699367-FOL', '532269-SLP', 500, '2022-10-04 01:08:29', '776604-USR'),
('734076-FOL', '874994-SLP', 4500, '2022-10-01 00:22:32', '776604-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_general_service`
--

CREATE TABLE `me_general_service` (
  `SERVICE_UUID` varchar(10) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_RATE` int(10) NOT NULL DEFAULT 0,
  `SERVICE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `SERVICE_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_general_service`
--

INSERT INTO `me_general_service` (`SERVICE_UUID`, `SERVICE_NAME`, `SERVICE_RATE`, `SERVICE_DATE_TIME`, `SERVICE_STATUS`, `STAFF_ID`) VALUES
('261474-SER', 'Test Service', 5000, '2022-09-30 13:41:20', 1, '776604-USR'),
('367755-SER', 'Test Service Two', 4500, '2022-09-30 13:43:20', 1, '776604-USR'),
('403365-SER', 'Test Service Three', 1500, '2022-09-30 13:43:39', 1, '776604-USR'),
('422214-SER', 'Test Service Four', 2000, '2022-09-30 13:44:01', 1, '776604-USR'),
('575075-SER', 'X-Rays', 1000, '2022-10-01 16:09:59', 1, '776604-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_indoor`
--

CREATE TABLE `me_indoor` (
  `INDOOR_UUID` varchar(10) NOT NULL,
  `INDOOR_SLIP_UUID` varchar(10) NOT NULL,
  `INDOOR_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `ADMISSION_DATE_TIME` varchar(20) NOT NULL,
  `DISCHARGE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `ADMISSION_CHARGE` int(10) NOT NULL DEFAULT 0,
  `SURGEON_CHARGE` int(10) NOT NULL DEFAULT 0,
  `ANESTHETIST_CHARGE` int(10) NOT NULL DEFAULT 0,
  `OPERATION_CHARGE` int(10) NOT NULL DEFAULT 0,
  `LABOUR_ROOM_CHARGE` int(10) NOT NULL DEFAULT 0,
  `PEDIATRIC_CHARGE` int(10) NOT NULL DEFAULT 0,
  `PRIVATE_ROOM_CHARGE` int(10) NOT NULL DEFAULT 0,
  `NURSURY_CHARGE` int(10) NOT NULL DEFAULT 0,
  `NURSURY_STAFF_CHARGE` int(10) NOT NULL DEFAULT 0,
  `MO_CHARGE` int(10) NOT NULL DEFAULT 0,
  `CONSULTANT_CHARGE` int(10) NOT NULL DEFAULT 0,
  `CTG_CHARGE` int(10) NOT NULL DEFAULT 0,
  `RECOVERY_ROOM_CHARGE` int(10) NOT NULL DEFAULT 0,
  `MONITOR_CHARGE` int(10) NOT NULL DEFAULT 0,
  `OXYGEN_CHARGE` int(10) NOT NULL DEFAULT 0,
  `NURSING_CHARGE` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_1` varchar(100) DEFAULT NULL,
  `OTHER_1` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_2` varchar(100) DEFAULT NULL,
  `OTHER_2` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_3` varchar(100) DEFAULT NULL,
  `OTHER_3` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_4` varchar(100) DEFAULT NULL,
  `OTHER_4` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_5` varchar(100) DEFAULT NULL,
  `OTHER_5` int(10) NOT NULL DEFAULT 0,
  `OTHER_TEXT_6` varchar(100) DEFAULT NULL,
  `OTHER_6` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_indoor`
--

INSERT INTO `me_indoor` (`INDOOR_UUID`, `INDOOR_SLIP_UUID`, `INDOOR_DATE_TIME`, `ADMISSION_DATE_TIME`, `DISCHARGE_DATE_TIME`, `ADMISSION_CHARGE`, `SURGEON_CHARGE`, `ANESTHETIST_CHARGE`, `OPERATION_CHARGE`, `LABOUR_ROOM_CHARGE`, `PEDIATRIC_CHARGE`, `PRIVATE_ROOM_CHARGE`, `NURSURY_CHARGE`, `NURSURY_STAFF_CHARGE`, `MO_CHARGE`, `CONSULTANT_CHARGE`, `CTG_CHARGE`, `RECOVERY_ROOM_CHARGE`, `MONITOR_CHARGE`, `OXYGEN_CHARGE`, `NURSING_CHARGE`, `OTHER_TEXT_1`, `OTHER_1`, `OTHER_TEXT_2`, `OTHER_2`, `OTHER_TEXT_3`, `OTHER_3`, `OTHER_TEXT_4`, `OTHER_4`, `OTHER_TEXT_5`, `OTHER_5`, `OTHER_TEXT_6`, `OTHER_6`) VALUES
('063240-BID', '273480-SLP', '2022-09-26 12:25:27', '2022-09-18 14:28:56', '2022-09-26 12:25:27', 1000, 1000, 1000, 1000, 1000, 1000, 25000, 1000, 1000, 5000, 5000, 1000, 1000, 0, 0, 1000, 'Test Fields', 1000, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('081711-BID', '502256-SLP', '2022-09-27 15:21:58', '2022-09-18 14:32:50', '2022-09-27 15:21:58', 0, 0, 0, 0, 0, 0, 10000, 5000, 0, 5000, 2000, 0, 0, 6000, 35000, 5000, 'Test Description', 1000, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('355694-BID', '672649-SLP', '2022-10-01 18:02:52', '2022-09-27 17:28:35', '2022-10-01 18:02:52', 0, 0, 4000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('458059-BID', '405407-SLP', '2022-10-01 18:04:33', '2022-10-01 18:03:49', '2022-10-01 18:04:33', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('574456-BID', '532269-SLP', '2022-10-01 18:06:37', '2022-10-01 18:06:01', '2022-10-01 18:06:37', 0, 0, 5000, 0, 0, 0, 10000, 8000, 0, 0, 500, 0, 0, 0, 0, 8000, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('669754-BID', '618358-SLP', '2022-10-01 18:08:06', '2022-10-01 18:07:32', '2022-10-01 18:08:06', 0, 0, 0, 0, 0, 0, 10000, 2000, 0, 3000, 5000, 0, 0, 0, 0, 2000, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('888691-BID', '633722-SLP', '2022-09-27 15:18:18', '2022-09-18 14:34:49', '2022-09-27 15:18:18', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0),
('967770-BID', '382522-SLP', '2022-09-27 15:20:29', '2022-09-18 14:31:11', '2022-09-27 15:20:29', 1000, 1000, 1000, 1000, 1000, 1000, 10000, 1000, 1000, 5000, 200, 1000, 1000, 0, 0, 1000, 'Test Description', 5000, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `me_indoor_type`
--

CREATE TABLE `me_indoor_type` (
  `INDOOR_TYPE_UUID` varchar(10) NOT NULL,
  `INDOOR_TYPE_NAME` varchar(100) NOT NULL,
  `INDOOR_TYPE_ALAIS` varchar(20) NOT NULL,
  `INDOOR_TYPE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `INDOOR_TYPE_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_patient`
--

CREATE TABLE `me_patient` (
  `PATIENT_MR_ID` varchar(10) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `PATIENT_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_patient`
--

INSERT INTO `me_patient` (`PATIENT_MR_ID`, `PATIENT_NAME`, `PATIENT_MOBILE`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `PATIENT_DATE_TIME`, `STAFF_ID`) VALUES
('061644-MRD', 'Test Slip OPD', '03214256987', 'male', '28', 'Lahore, Pakistan', '2022-09-18 09:25:21', '776604-USR'),
('124890-MRD', 'Test Slip OPD Visit', '03256987452', 'male', '32', 'Lahore, Pakistan', '2022-09-18 09:27:18', '776604-USR'),
('200355-MRD', 'M Umer', '03235698745', 'male', '30', 'Lahore, Pakistan', '2022-10-01 11:03:53', '776604-USR'),
('273480-MRD', 'Test Slip Indoor Gynae', '03256985214', 'female', '37', 'Lahore, Pakistan', '2022-09-18 09:28:56', '776604-USR'),
('382522-MRD', 'Test Slip Indoor General Surgery', '03225456987', 'male', '27', 'Lahore, Pakistan', '2022-09-18 09:31:10', '776604-USR'),
('401506-MRD', 'Test Emergency Slip Third', '03225894123', 'male', '34', 'Lahore, Pakistan', '2022-09-18 10:03:55', '776604-USR'),
('405407-MRD', 'TEst Mubeen', '032154569874', 'male', '45', 'Test', '2022-10-01 13:03:49', '776604-USR'),
('502256-MRD', 'Test Slip Indoor Gen Illness', '03256987456', 'male', '25', 'Lahore, Pakistan', '2022-09-18 09:32:50', '776604-USR'),
('532269-MRD', 'Testing Again Mubeen', '03256985756', 'male', '45', 'Lahore', '2022-10-01 13:06:01', '776604-USR'),
('618358-MRD', 'Testing Again Emergency', '03215654987', 'male', '45', 'Lahore', '2022-10-01 13:07:32', '776604-USR'),
('633722-MRD', 'Test Slip Eye', '03234169956', 'male', '28', 'Lahore, Pakistan', '2022-09-18 09:34:49', '776604-USR'),
('672649-MRD', 'Test Ameena', '03215465985', 'female', '27', 'Lahore, Pakistan', '2022-09-27 12:28:35', '776604-USR'),
('706511-MRD', 'Testing Again Emergency', '03215654568', 'male', '45', 'Lahore Pakistan', '2022-10-01 13:08:53', '776604-USR'),
('799335-MRD', 'Test Slip Emergency two', '03225896475', 'male', '23', 'Lahore, Pakistan', '2022-09-18 09:58:11', '776604-USR'),
('874994-MRD', 'Abhishek Bachan', '03225654987', 'male', '45', 'Lahore, Pakistan', '2022-09-30 19:08:41', '776604-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_request`
--

CREATE TABLE `me_request` (
  `REQUEST_UUID` varchar(10) NOT NULL,
  `REQUEST_REFERENCE_UUID` varchar(10) NOT NULL,
  `REQUEST_NAME` varchar(50) NOT NULL,
  `REQUEST_COMMENT` varchar(250) NOT NULL,
  `REQUEST_STATUS` int(11) NOT NULL DEFAULT 0,
  `REQUEST_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_request`
--

INSERT INTO `me_request` (`REQUEST_UUID`, `REQUEST_REFERENCE_UUID`, `REQUEST_NAME`, `REQUEST_COMMENT`, `REQUEST_STATUS`, `REQUEST_DATE_TIME`, `STAFF_ID`) VALUES
('101967-REQ', '273480-SLP', 'cancel', 'Please Cancel this slip Test', 0, '2022-09-28 23:03:08', '157277-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_room`
--

CREATE TABLE `me_room` (
  `ROOM_UUID` varchar(10) NOT NULL,
  `ROOM_NAME` varchar(100) NOT NULL,
  `ROOM_RATE` int(10) NOT NULL,
  `ROOM_STATUS` int(10) NOT NULL DEFAULT 1,
  `ROOM_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_room`
--

INSERT INTO `me_room` (`ROOM_UUID`, `ROOM_NAME`, `ROOM_RATE`, `ROOM_STATUS`, `ROOM_DATE_TIME`, `STAFF_ID`) VALUES
('345075ROM', 'Test Room One', 5000, 1, '2022-09-26 11:56:03', '776604-USR'),
('365872ROM', 'Test Room Two', 10000, 1, '2022-09-26 11:56:30', '776604-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_service_slip`
--

CREATE TABLE `me_service_slip` (
  `SLIP_UUID` varchar(10) NOT NULL,
  `SLIP_REFERENCE_UUID` varchar(10) NOT NULL,
  `SLIP_SERVICE_NAME` varchar(100) NOT NULL,
  `SLIP_SERVICE_RATE` int(10) NOT NULL DEFAULT 0,
  `SLIP_SERVICE_DISCOUNT` int(10) DEFAULT 0,
  `SLIP_SERVICE_TOTAL` int(10) NOT NULL DEFAULT 0,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_service_slip`
--

INSERT INTO `me_service_slip` (`SLIP_UUID`, `SLIP_REFERENCE_UUID`, `SLIP_SERVICE_NAME`, `SLIP_SERVICE_RATE`, `SLIP_SERVICE_DISCOUNT`, `SLIP_SERVICE_TOTAL`, `SLIP_DATE_TIME`, `STAFF_ID`) VALUES
('086062-SRS', '874994-SLP', 'Test Service Four', 2000, 100, 1900, '2022-10-01 00:28:23', '776604-USR'),
('229290-SRS', '672649-SLP', 'Test Service', 5000, 100, 4900, '2022-10-01 00:30:44', '776604-USR'),
('258707-SRS', '405407-SLP', 'Test Service Four', 2000, 50, 1950, '2022-10-04 01:18:08', '776604-USR'),
('327066-SRS', '200355-SLP', 'Test Service Two', 4500, 500, 4000, '2022-10-01 16:07:31', '776604-USR'),
('338855-SRS', '672649-SLP', 'Test Service Three', 1500, 50, 1450, '2022-09-30 23:59:19', '157277-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_slip`
--

CREATE TABLE `me_slip` (
  `SLIP_UUID` varchar(10) NOT NULL,
  `SLIP_MRID` varchar(10) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `SLIP_DEPARTMENT` varchar(10) DEFAULT NULL,
  `SLIP_DOCTOR` varchar(10) NOT NULL,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `SLIP_STATUS` int(10) NOT NULL DEFAULT 1,
  `SLIP_FEE` int(10) DEFAULT NULL,
  `SLIP_PROCEDURE` varchar(255) DEFAULT NULL,
  `SLIP_TYPE` varchar(15) NOT NULL,
  `SLIP_SUB_TYPE` varchar(25) DEFAULT NULL,
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_slip`
--

INSERT INTO `me_slip` (`SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_DATE_TIME`, `SLIP_STATUS`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `SLIP_SUB_TYPE`, `STAFF_ID`) VALUES
('061644-SLP', '061644-MRD', 'Test Slip OPD', '03214256987', '038852-DEP', '182307-DOC', '2022-09-18 14:25:21', 1, 5200, NULL, 'OUTDOOR', NULL, '776604-USR'),
('200355-SLP', '200355-MRD', 'M Umer', '03235698745', '195084-DEP', '610773-DOC', '2022-10-01 16:03:53', 1, 1500, NULL, 'OUTDOOR', NULL, '776604-USR'),
('273480-SLP', '273480-MRD', 'Test Slip Indoor Gynae', '03256985214', '014656-DEP', '888120-DOC', '2022-09-18 14:28:56', 1, NULL, 'Test Procedure of Gynae', 'INDOOR', 'GYNEACOLOGY_PATIENT', '776604-USR'),
('382522-SLP', '382522-MRD', 'Test Slip Indoor General Surgery', '03225456987', '195084-DEP', '610773-DOC', '2022-09-18 14:31:11', 0, NULL, 'Test Procedure of General Surgery', 'INDOOR', 'GENERAL_SURGERY_PATIENT', '776604-USR'),
('401506-SLP', '401506-MRD', 'Test Emergency Slip Third', '03225894123', NULL, '061612-DOC', '2022-09-18 15:03:55', 0, NULL, NULL, 'EMERGENCY', NULL, '776604-USR'),
('405407-SLP', '405407-MRD', 'TEst Mubeen', '032154569874', '148883-DEP', '457374-DOC', '2022-10-01 18:03:49', 0, NULL, 'Test', 'INDOOR', 'EYE_PATIENT', '776604-USR'),
('502256-SLP', '502256-MRD', 'Test Slip Indoor Gen Illness', '03256987456', '127260-DEP', '392546-DOC', '2022-09-18 14:32:50', 0, NULL, 'Test Procedure of General Illness', 'INDOOR', 'GENERAL_ILLNESS_PATIENT', '776604-USR'),
('532269-SLP', '532269-MRD', 'Testing Again Mubeen', '03256985756', '038852-DEP', '182307-DOC', '2022-10-01 18:06:01', 0, NULL, 'Test Procedure', 'INDOOR', 'GENERAL_SURGERY_PATIENT', '776604-USR'),
('618358-SLP', '618358-MRD', 'Testing Again Emergency', '03215654987', '014656-DEP', '061612-DOC', '2022-10-01 18:07:32', 0, NULL, 'Lahore PRocedure', 'INDOOR', 'GENERAL_ILLNESS_PATIENT', '776604-USR'),
('633722-SLP', '633722-MRD', 'Test Slip Eye', '03234169956', '038852-DEP', '182307-DOC', '2022-09-18 14:34:49', 0, NULL, 'Test Procedure of Eye Specialist', 'INDOOR', 'EYE_PATIENT', '776604-USR'),
('672649-SLP', '672649-MRD', 'Test Ameena', '03215465985', '014656-DEP', '888120-DOC', '2022-09-27 17:28:35', 0, NULL, 'Test Procedure', 'INDOOR', 'GENERAL_SURGERY_PATIENT', '776604-USR'),
('706511-SLP', '706511-MRD', 'Testing Again Emergency', '03215654568', NULL, '127232-DOC', '2022-10-01 18:08:54', 0, NULL, NULL, 'EMERGENCY', NULL, '776604-USR'),
('773095-SLP', '382522-MRD', 'Test Slip Emergency', '03225456987', NULL, '914258-DOC', '2022-09-18 14:37:34', 0, NULL, NULL, 'EMERGENCY', NULL, '776604-USR'),
('799335-SLP', '799335-MRD', 'Test Slip Emergency two', '03225896475', NULL, '461481-DOC', '2022-09-18 14:58:11', 0, NULL, NULL, 'EMERGENCY', NULL, '776604-USR'),
('874994-SLP', '874994-MRD', 'Abhishek Bachan', '03225654987', '195084-DEP', '610773-DOC', '2022-10-01 00:08:41', 1, 4200, NULL, 'OUTDOOR', NULL, '776604-USR');

-- --------------------------------------------------------

--
-- Table structure for table `me_slip_type`
--

CREATE TABLE `me_slip_type` (
  `TYPE_UUID` varchar(10) NOT NULL,
  `TYPE_NAME` varchar(100) NOT NULL,
  `TYPE_ALAIS` varchar(10) NOT NULL,
  `TYPE_STATUS` int(10) NOT NULL DEFAULT 1,
  `TYPE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_user`
--

CREATE TABLE `me_user` (
  `USER_UUID` varchar(10) NOT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `USER_ROLE` varchar(50) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(100) NOT NULL,
  `USER_STATUS` int(10) NOT NULL DEFAULT 1,
  `USER_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_user`
--

INSERT INTO `me_user` (`USER_UUID`, `USER_NAME`, `USER_ROLE`, `USER_EMAIL`, `USER_ID`, `USER_PASSWORD`, `USER_STATUS`, `USER_DATE_TIME`, `STAFF_ID`) VALUES
('157277-USR', 'Mubeen Hussain', 'user', 'mubeen.hussain@gmail.com', 'mubeen.hussain', '$2y$10$.7d5jboKz2sK5aq5F/PecuEUMdVnGORaf6ipb0jqcszG.3LBkXh/e', 1, '2022-09-28 14:45:30', '776604-USR'),
('776604-USR', 'Administrator', 'admin', 'admin@gmail.com', 'admin', '$2y$10$j7bfaXlX.kZHL3Yiao4Qg.iusiQRgRRv7skT7LYJKOn2L9l3cUUni', 1, '2022-09-18 02:58:54', '776604-USR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `me_bill`
--
ALTER TABLE `me_bill`
  ADD PRIMARY KEY (`BILL_UUID`),
  ADD KEY `FK_ME_USER_FOR_STAFF_ID` (`STAFF_ID`),
  ADD KEY `FK_ME_SLIP_FOR_BILL_SLIP_UUID` (`BILL_SLIP_UUID`);

--
-- Indexes for table `me_department`
--
ALTER TABLE `me_department`
  ADD PRIMARY KEY (`DEPARTMENT_UUID`),
  ADD KEY `FK_STAFF_ME_DEPARTMENT` (`STAFF_ID`);

--
-- Indexes for table `me_doctors`
--
ALTER TABLE `me_doctors`
  ADD PRIMARY KEY (`DOCTOR_UUID`),
  ADD KEY `FK_STAFF_ID_ME_DOCTORS` (`STAFF_ID`),
  ADD KEY `FK_DEPARTMENT_NAME_ME_DEPARTMENT` (`DOCTOR_DEPARTMENT`);

--
-- Indexes for table `me_emergency`
--
ALTER TABLE `me_emergency`
  ADD PRIMARY KEY (`EMERGENCY_UUID`),
  ADD KEY `FK_SLIP_UUID_FOR_EMERGENCY_SLIP_UUID` (`EMERGENCY_SLIP_UUID`);

--
-- Indexes for table `me_emergency_service_charge`
--
ALTER TABLE `me_emergency_service_charge`
  ADD PRIMARY KEY (`SERVICE_UUID`),
  ADD KEY `FK_STAFF_ME_EMERGENCY_SERVICE_CHARGE` (`STAFF_ID`);

--
-- Indexes for table `me_followup_slip`
--
ALTER TABLE `me_followup_slip`
  ADD PRIMARY KEY (`SLIP_UUID`),
  ADD KEY `FK_STAFF_ME_FOLLOWUP_SLIP` (`STAFF_ID`),
  ADD KEY `FK_OPD_SLIP_ME_FOLLOWUP_SLIP` (`SLIP_REFERENCE_UUID`);

--
-- Indexes for table `me_general_service`
--
ALTER TABLE `me_general_service`
  ADD PRIMARY KEY (`SERVICE_UUID`),
  ADD KEY `FK_STAFF_ME_GENERAL_SERVICE` (`STAFF_ID`);

--
-- Indexes for table `me_indoor`
--
ALTER TABLE `me_indoor`
  ADD PRIMARY KEY (`INDOOR_UUID`),
  ADD KEY `FK_INDOOR_SLIP_UUID_FOR_SLIP_UUID` (`INDOOR_SLIP_UUID`);

--
-- Indexes for table `me_indoor_type`
--
ALTER TABLE `me_indoor_type`
  ADD PRIMARY KEY (`INDOOR_TYPE_UUID`),
  ADD UNIQUE KEY `INDOOR_TYPE_ALAIS` (`INDOOR_TYPE_ALAIS`),
  ADD KEY `FK_STAFF_ME_INDOOR_TYPE` (`STAFF_ID`);

--
-- Indexes for table `me_patient`
--
ALTER TABLE `me_patient`
  ADD PRIMARY KEY (`PATIENT_MR_ID`),
  ADD UNIQUE KEY `PATIENT_MOBILE` (`PATIENT_MOBILE`),
  ADD KEY `FK_STAFF_ID_ME_USER` (`STAFF_ID`);

--
-- Indexes for table `me_request`
--
ALTER TABLE `me_request`
  ADD PRIMARY KEY (`REQUEST_UUID`),
  ADD KEY `FK_STAFF_ME_REQUEST` (`STAFF_ID`);

--
-- Indexes for table `me_room`
--
ALTER TABLE `me_room`
  ADD PRIMARY KEY (`ROOM_UUID`),
  ADD KEY `FK_STAFF_ME_ROOM` (`STAFF_ID`);

--
-- Indexes for table `me_service_slip`
--
ALTER TABLE `me_service_slip`
  ADD PRIMARY KEY (`SLIP_UUID`),
  ADD KEY `FK_STAFF_ME_SERVICE_SLIP` (`STAFF_ID`);

--
-- Indexes for table `me_slip`
--
ALTER TABLE `me_slip`
  ADD PRIMARY KEY (`SLIP_UUID`),
  ADD KEY `FK_STAFF_ID_FROM_ME_USER` (`STAFF_ID`),
  ADD KEY `FK_SLIP_DEPARTMENT_FROM_ME_DEPARTMENT` (`SLIP_DEPARTMENT`),
  ADD KEY `FK_SLIP_DOCTOR_FROM_ME_DOCTORS` (`SLIP_DOCTOR`);

--
-- Indexes for table `me_slip_type`
--
ALTER TABLE `me_slip_type`
  ADD PRIMARY KEY (`TYPE_UUID`),
  ADD KEY `FK_TYPE_STAFF_ID_FROM_ME_USER` (`STAFF_ID`);

--
-- Indexes for table `me_user`
--
ALTER TABLE `me_user`
  ADD PRIMARY KEY (`USER_UUID`),
  ADD UNIQUE KEY `USER_EMAIL` (`USER_EMAIL`,`USER_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `me_bill`
--
ALTER TABLE `me_bill`
  ADD CONSTRAINT `FK_ME_SLIP_FOR_BILL_SLIP_UUID` FOREIGN KEY (`BILL_SLIP_UUID`) REFERENCES `me_slip` (`SLIP_UUID`),
  ADD CONSTRAINT `FK_ME_USER_FOR_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_doctors`
--
ALTER TABLE `me_doctors`
  ADD CONSTRAINT `FK_DEPARTMENT_NAME_ME_DEPARTMENT` FOREIGN KEY (`DOCTOR_DEPARTMENT`) REFERENCES `me_department` (`DEPARTMENT_UUID`),
  ADD CONSTRAINT `FK_STAFF_ID_ME_DOCTORS` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_emergency`
--
ALTER TABLE `me_emergency`
  ADD CONSTRAINT `FK_SLIP_UUID_FOR_EMERGENCY_SLIP_UUID` FOREIGN KEY (`EMERGENCY_SLIP_UUID`) REFERENCES `me_slip` (`SLIP_UUID`);

--
-- Constraints for table `me_followup_slip`
--
ALTER TABLE `me_followup_slip`
  ADD CONSTRAINT `FK_OPD_SLIP_ME_FOLLOWUP_SLIP` FOREIGN KEY (`SLIP_REFERENCE_UUID`) REFERENCES `me_slip` (`SLIP_UUID`),
  ADD CONSTRAINT `FK_STAFF_ME_FOLLOWUP_SLIP` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_general_service`
--
ALTER TABLE `me_general_service`
  ADD CONSTRAINT `FK_STAFF_ME_GENERAL_SERVICE` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_indoor`
--
ALTER TABLE `me_indoor`
  ADD CONSTRAINT `FK_INDOOR_SLIP_UUID_FOR_SLIP_UUID` FOREIGN KEY (`INDOOR_SLIP_UUID`) REFERENCES `me_slip` (`SLIP_UUID`);

--
-- Constraints for table `me_indoor_type`
--
ALTER TABLE `me_indoor_type`
  ADD CONSTRAINT `FK_STAFF_ME_INDOOR_TYPE` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_patient`
--
ALTER TABLE `me_patient`
  ADD CONSTRAINT `FK_STAFF_ID_ME_USER` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_room`
--
ALTER TABLE `me_room`
  ADD CONSTRAINT `FK_STAFF_ME_ROOM` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_service_slip`
--
ALTER TABLE `me_service_slip`
  ADD CONSTRAINT `FK_STAFF_ME_SERVICE_SLIP` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_slip`
--
ALTER TABLE `me_slip`
  ADD CONSTRAINT `FK_SLIP_DEPARTMENT_FROM_ME_DEPARTMENT` FOREIGN KEY (`SLIP_DEPARTMENT`) REFERENCES `me_department` (`DEPARTMENT_UUID`),
  ADD CONSTRAINT `FK_SLIP_DOCTOR_FROM_ME_DOCTORS` FOREIGN KEY (`SLIP_DOCTOR`) REFERENCES `me_doctors` (`DOCTOR_UUID`),
  ADD CONSTRAINT `FK_STAFF_ID_FROM_ME_USER` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_slip_type`
--
ALTER TABLE `me_slip_type`
  ADD CONSTRAINT `FK_TYPE_STAFF_ID_FROM_ME_USER` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
