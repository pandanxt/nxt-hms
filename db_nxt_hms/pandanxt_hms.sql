-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2022 at 05:13 PM
-- Server version: 10.3.36-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `me_bill`
--

CREATE TABLE `me_bill` (
  `BILL_UUID` varchar(20) NOT NULL,
  `BILL_MRID` varchar(20) NOT NULL,
  `BILL_SLIP_UUID` varchar(20) NOT NULL,
  `BILL_NAME` varchar(100) NOT NULL,
  `BILL_MOBILE` varchar(15) NOT NULL,
  `BILL_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `BILL_AMOUNT` int(10) NOT NULL DEFAULT 0,
  `BILL_DISCOUNT` int(10) DEFAULT 0,
  `BILL_TOTAL` int(10) NOT NULL DEFAULT 0,
  `BILL_DELETE` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_bill_history`
--

CREATE TABLE `me_bill_history` (
  `BILL_ID` int(10) NOT NULL,
  `BILL_UUID` varchar(20) NOT NULL,
  `BILL_MRID` varchar(20) NOT NULL,
  `BILL_SLIP_UUID` varchar(20) NOT NULL,
  `BILL_NAME` varchar(100) NOT NULL,
  `BILL_MOBILE` varchar(15) NOT NULL,
  `BILL_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `BILL_AMOUNT` int(10) NOT NULL DEFAULT 0,
  `BILL_DISCOUNT` int(10) DEFAULT 0,
  `BILL_TOTAL` int(10) NOT NULL DEFAULT 0,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_department`
--

CREATE TABLE `me_department` (
  `DEPARTMENT_UUID` varchar(20) NOT NULL,
  `DEPARTMENT_NAME` varchar(100) NOT NULL,
  `DEPARTMENT_STATUS` int(10) NOT NULL DEFAULT 1,
  `DEPARTMENT_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_doctors`
--

CREATE TABLE `me_doctors` (
  `DOCTOR_UUID` varchar(20) NOT NULL,
  `DOCTOR_NAME` varchar(100) NOT NULL,
  `DOCTOR_MOBILE` varchar(15) DEFAULT NULL,
  `DOCTOR_DEPARTMENT` varchar(20) DEFAULT NULL,
  `DOCTOR_STATUS` int(10) NOT NULL DEFAULT 1,
  `DOCTOR_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `DOCTOR_TYPE` varchar(10) NOT NULL DEFAULT 'medeast',
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_emergency`
--

CREATE TABLE `me_emergency` (
  `EMERGENCY_UUID` varchar(20) NOT NULL,
  `EMERGENCY_SLIP_UUID` varchar(20) NOT NULL,
  `EMERGENCY_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `EMERGENCY_DELETE` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(20) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `me_emergency_history`
--

CREATE TABLE `me_emergency_history` (
  `EMERGENCY_ID` int(10) NOT NULL,
  `EMERGENCY_UUID` varchar(20) NOT NULL,
  `EMERGENCY_SLIP_UUID` varchar(20) NOT NULL,
  `EMERGENCY_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `me_emergency_service_charge`
--

CREATE TABLE `me_emergency_service_charge` (
  `SERVICE_UUID` varchar(20) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_CHARGE` int(10) NOT NULL,
  `SERVICE_STATUS` int(10) NOT NULL DEFAULT 1,
  `SERVICE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_followup_slip`
--

CREATE TABLE `me_followup_slip` (
  `SLIP_UUID` varchar(20) NOT NULL,
  `SLIP_REFERENCE_UUID` varchar(20) NOT NULL,
  `SLIP_FEE` int(10) NOT NULL DEFAULT 0,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `SLIP_DELETE` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_followup_slip_history`
--

CREATE TABLE `me_followup_slip_history` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_UUID` varchar(20) NOT NULL,
  `SLIP_REFERENCE_UUID` varchar(20) NOT NULL,
  `SLIP_FEE` int(10) NOT NULL DEFAULT 0,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_general_service`
--

CREATE TABLE `me_general_service` (
  `SERVICE_UUID` varchar(20) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_RATE` int(10) NOT NULL DEFAULT 0,
  `SERVICE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `SERVICE_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_indoor`
--

CREATE TABLE `me_indoor` (
  `INDOOR_UUID` varchar(20) NOT NULL,
  `INDOOR_SLIP_UUID` varchar(20) NOT NULL,
  `INDOOR_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `INDOOR_DELETE` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(20) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `me_indoor_history`
--

CREATE TABLE `me_indoor_history` (
  `INDOOR_ID` int(10) NOT NULL,
  `INDOOR_UUID` varchar(20) NOT NULL,
  `INDOOR_SLIP_UUID` varchar(20) NOT NULL,
  `INDOOR_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `me_indoor_type`
--

CREATE TABLE `me_indoor_type` (
  `INDOOR_TYPE_UUID` varchar(20) NOT NULL,
  `INDOOR_TYPE_NAME` varchar(100) NOT NULL,
  `INDOOR_TYPE_ALAIS` varchar(20) NOT NULL,
  `INDOOR_TYPE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `INDOOR_TYPE_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_patient`
--

CREATE TABLE `me_patient` (
  `PATIENT_MR_ID` varchar(20) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `PATIENT_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `PATIENT_DELETE` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_patient_history`
--

CREATE TABLE `me_patient_history` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(20) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `PATIENT_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_room`
--

CREATE TABLE `me_room` (
  `ROOM_UUID` varchar(20) NOT NULL,
  `ROOM_NAME` varchar(100) NOT NULL,
  `ROOM_RATE` int(10) NOT NULL,
  `ROOM_STATUS` int(10) NOT NULL DEFAULT 1,
  `ROOM_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_service_slip`
--

CREATE TABLE `me_service_slip` (
  `SLIP_UUID` varchar(20) NOT NULL,
  `SLIP_REFERENCE_UUID` varchar(20) NOT NULL,
  `SLIP_SERVICE_NAME` varchar(100) NOT NULL,
  `SLIP_SERVICE_RATE` int(10) NOT NULL DEFAULT 0,
  `SLIP_SERVICE_DISCOUNT` int(10) DEFAULT 0,
  `SLIP_SERVICE_TOTAL` int(10) NOT NULL DEFAULT 0,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `SLIP_DELETE` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_service_slip_history`
--

CREATE TABLE `me_service_slip_history` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_UUID` varchar(20) NOT NULL,
  `SLIP_REFERENCE_UUID` varchar(20) NOT NULL,
  `SLIP_SERVICE_NAME` varchar(100) NOT NULL,
  `SLIP_SERVICE_RATE` int(10) NOT NULL DEFAULT 0,
  `SLIP_SERVICE_DISCOUNT` int(10) DEFAULT 0,
  `SLIP_SERVICE_TOTAL` int(10) NOT NULL DEFAULT 0,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_slip`
--

CREATE TABLE `me_slip` (
  `SLIP_UUID` varchar(20) NOT NULL,
  `SLIP_MRID` varchar(20) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `SLIP_DEPARTMENT` varchar(20) DEFAULT NULL,
  `SLIP_DOCTOR` varchar(20) NOT NULL,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `SLIP_STATUS` int(10) NOT NULL DEFAULT 1,
  `SLIP_DELETE` int(10) NOT NULL DEFAULT 1,
  `SLIP_FEE` int(10) DEFAULT NULL,
  `SLIP_PROCEDURE` varchar(255) DEFAULT NULL,
  `SLIP_TYPE` varchar(15) NOT NULL,
  `SLIP_SUB_TYPE` varchar(25) DEFAULT NULL,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_slip_history`
--

CREATE TABLE `me_slip_history` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_UUID` varchar(20) NOT NULL,
  `SLIP_MRID` varchar(20) NOT NULL,
  `SLIP_NAME` varchar(255) DEFAULT NULL,
  `SLIP_MOBILE` varchar(15) DEFAULT NULL,
  `SLIP_DEPARTMENT` varchar(20) DEFAULT NULL,
  `SLIP_DOCTOR` varchar(20) DEFAULT NULL,
  `SLIP_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `SLIP_FEE` int(10) DEFAULT NULL,
  `SLIP_PROCEDURE` varchar(200) DEFAULT NULL,
  `SLIP_TYPE` varchar(100) DEFAULT NULL,
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_slip_type`
--

CREATE TABLE `me_slip_type` (
  `TYPE_UUID` varchar(20) NOT NULL,
  `TYPE_NAME` varchar(100) NOT NULL,
  `TYPE_ALAIS` varchar(10) NOT NULL,
  `TYPE_STATUS` int(10) NOT NULL DEFAULT 1,
  `TYPE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_user`
--

CREATE TABLE `me_user` (
  `USER_UUID` varchar(20) NOT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `USER_ROLE` varchar(50) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(100) NOT NULL,
  `USER_STATUS` int(10) NOT NULL DEFAULT 1,
  `USER_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `me_user`
--

INSERT INTO `me_user` (`USER_UUID`, `USER_NAME`, `USER_ROLE`, `USER_EMAIL`, `USER_ID`, `USER_PASSWORD`, `USER_STATUS`, `USER_DATE_TIME`, `STAFF_ID`) VALUES
('USR5235-10232022', 'Mubeen Hussain', 'admin', 'admin@gmail.com', 'admin', '$2y$10$EaiZrUWvxSDSHfe.JArG1.2a4ftktwL8yIE/rxPuZlWkPrDRgQLhq', 1, '2022-10-23 23:30:20', 'USR5235-10232022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `me_bill`
--
ALTER TABLE `me_bill`
  ADD PRIMARY KEY (`BILL_UUID`),
  ADD KEY `FK_ME_USER_FOR_STAFF_ID` (`STAFF_ID`);

--
-- Indexes for table `me_bill_history`
--
ALTER TABLE `me_bill_history`
  ADD PRIMARY KEY (`BILL_ID`),
  ADD KEY `FK_STAFF_ID_FOR_USER_UUID` (`STAFF_ID`);

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
  ADD KEY `FK_USER_UNIQUE_UUID_FOR_EMER_STAFF_ID` (`STAFF_ID`);

--
-- Indexes for table `me_emergency_history`
--
ALTER TABLE `me_emergency_history`
  ADD PRIMARY KEY (`EMERGENCY_ID`),
  ADD KEY `FK_EMERGENCY_STAFF_ID_FOR_USER_UUID` (`STAFF_ID`);

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
  ADD KEY `FK_STAFF_ME_FOLLOWUP_SLIP` (`STAFF_ID`);

--
-- Indexes for table `me_followup_slip_history`
--
ALTER TABLE `me_followup_slip_history`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `FK_FOLLOWUP_STAFF_ID_FOR_USER_UUID` (`STAFF_ID`);

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
  ADD KEY `FK_USER_UNIQUE_UUID_FOR_INDOOR_STAFF_ID` (`STAFF_ID`);

--
-- Indexes for table `me_indoor_history`
--
ALTER TABLE `me_indoor_history`
  ADD PRIMARY KEY (`INDOOR_ID`),
  ADD KEY `FK_INDOOR_STAFF_ID_FOR_USER_UUID` (`STAFF_ID`);

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
  ADD KEY `FK_STAFF_ID_ME_USER` (`STAFF_ID`);

--
-- Indexes for table `me_patient_history`
--
ALTER TABLE `me_patient_history`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD KEY `FK_PATIENT_STAFF_ID_FOR_USER_UUID` (`STAFF_ID`);

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
-- Indexes for table `me_service_slip_history`
--
ALTER TABLE `me_service_slip_history`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `FK_SERVICE_SLIP_STAFF_ID_FOR_USER_UUID` (`STAFF_ID`);

--
-- Indexes for table `me_slip`
--
ALTER TABLE `me_slip`
  ADD PRIMARY KEY (`SLIP_UUID`),
  ADD KEY `FK_STAFF_ID_FROM_ME_USER` (`STAFF_ID`),
  ADD KEY `FK_SLIP_DEPARTMENT_FROM_ME_DEPARTMENT` (`SLIP_DEPARTMENT`),
  ADD KEY `FK_SLIP_DOCTOR_FROM_ME_DOCTORS` (`SLIP_DOCTOR`),
  ADD KEY `FK_SLIP_MRID_FOR_SLIP_MRID` (`SLIP_MRID`);

--
-- Indexes for table `me_slip_history`
--
ALTER TABLE `me_slip_history`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `FK_SLIP_STAFF_ID_FOR_USER_UUID` (`STAFF_ID`),
  ADD KEY `FK_SLIP_MR_ID_FOR_SLIP_MRID` (`SLIP_MRID`),
  ADD KEY `FK_SLIP_DEPARTMENT_FOR_SLIP_DEPARTMENT_UUID` (`SLIP_DEPARTMENT`),
  ADD KEY `FK_SLIP_DOCTOR_FOR_SLIP_DOCTOR_UUID` (`SLIP_DOCTOR`);

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
-- AUTO_INCREMENT for table `me_bill_history`
--
ALTER TABLE `me_bill_history`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_emergency_history`
--
ALTER TABLE `me_emergency_history`
  MODIFY `EMERGENCY_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_followup_slip_history`
--
ALTER TABLE `me_followup_slip_history`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_indoor_history`
--
ALTER TABLE `me_indoor_history`
  MODIFY `INDOOR_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_patient_history`
--
ALTER TABLE `me_patient_history`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_service_slip_history`
--
ALTER TABLE `me_service_slip_history`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_slip_history`
--
ALTER TABLE `me_slip_history`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for table `me_bill`
--
ALTER TABLE `me_bill`
  ADD CONSTRAINT `FK_ME_USER_FOR_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_bill_history`
--
ALTER TABLE `me_bill_history`
  ADD CONSTRAINT `FK_STAFF_ID_FOR_USER_UUID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

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
  ADD CONSTRAINT `FK_USER_UNIQUE_UUID_FOR_EMER_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_emergency_history`
--
ALTER TABLE `me_emergency_history`
  ADD CONSTRAINT `FK_EMERGENCY_STAFF_ID_FOR_USER_UUID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_followup_slip`
--
ALTER TABLE `me_followup_slip`
  ADD CONSTRAINT `FK_STAFF_ME_FOLLOWUP_SLIP` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_followup_slip_history`
--
ALTER TABLE `me_followup_slip_history`
  ADD CONSTRAINT `FK_FOLLOWUP_STAFF_ID_FOR_USER_UUID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_general_service`
--
ALTER TABLE `me_general_service`
  ADD CONSTRAINT `FK_STAFF_ME_GENERAL_SERVICE` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_indoor`
--
ALTER TABLE `me_indoor`
  ADD CONSTRAINT `FK_USER_UNIQUE_UUID_FOR_INDOOR_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_indoor_history`
--
ALTER TABLE `me_indoor_history`
  ADD CONSTRAINT `FK_INDOOR_STAFF_ID_FOR_USER_UUID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

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
-- Constraints for table `me_patient_history`
--
ALTER TABLE `me_patient_history`
  ADD CONSTRAINT `FK_PATIENT_STAFF_ID_FOR_USER_UUID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

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
-- Constraints for table `me_service_slip_history`
--
ALTER TABLE `me_service_slip_history`
  ADD CONSTRAINT `FK_SERVICE_SLIP_STAFF_ID_FOR_USER_UUID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_slip`
--
ALTER TABLE `me_slip`
  ADD CONSTRAINT `FK_SLIP_DEPARTMENT_FROM_ME_DEPARTMENT` FOREIGN KEY (`SLIP_DEPARTMENT`) REFERENCES `me_department` (`DEPARTMENT_UUID`),
  ADD CONSTRAINT `FK_SLIP_DOCTOR_FROM_ME_DOCTORS` FOREIGN KEY (`SLIP_DOCTOR`) REFERENCES `me_doctors` (`DOCTOR_UUID`),
  ADD CONSTRAINT `FK_SLIP_MRID_FOR_SLIP_MRID` FOREIGN KEY (`SLIP_MRID`) REFERENCES `me_patient` (`PATIENT_MR_ID`),
  ADD CONSTRAINT `FK_STAFF_ID_FROM_ME_USER` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_slip_history`
--
ALTER TABLE `me_slip_history`
  ADD CONSTRAINT `FK_SLIP_DEPARTMENT_FOR_SLIP_DEPARTMENT_UUID` FOREIGN KEY (`SLIP_DEPARTMENT`) REFERENCES `me_department` (`DEPARTMENT_UUID`),
  ADD CONSTRAINT `FK_SLIP_DOCTOR_FOR_SLIP_DOCTOR_UUID` FOREIGN KEY (`SLIP_DOCTOR`) REFERENCES `me_doctors` (`DOCTOR_UUID`),
  ADD CONSTRAINT `FK_SLIP_MR_ID_FOR_SLIP_MRID` FOREIGN KEY (`SLIP_MRID`) REFERENCES `me_patient` (`PATIENT_MR_ID`),
  ADD CONSTRAINT `FK_SLIP_STAFF_ID_FOR_USER_UUID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);

--
-- Constraints for table `me_slip_type`
--
ALTER TABLE `me_slip_type`
  ADD CONSTRAINT `FK_TYPE_STAFF_ID_FROM_ME_USER` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);
COMMIT;