
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `me_request` (
  `REQUEST_UUID` varchar(10) NOT NULL,
  `REQUEST_TABLE_ID` varchar(10) NOT NULL,
  `REQUEST_TABLE_NAME` varchar(100) NOT NULL,
  `REQUEST_NAME` varchar(50) NOT NULL,
  `REQUEST_COMMENT` varchar(250) NOT NULL,
  `REQUEST_STATUS` int(11) NOT NULL DEFAULT 0,
  `REQUEST_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_department` (
  `DEPARTMENT_UUID` varchar(10) NOT NULL,
  `DEPARTMENT_NAME` varchar(100) NOT NULL,
  `DEPARTMENT_STATUS` int(10) NOT NULL DEFAULT 1,
  `DEPARTMENT_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_doctor` (
  `DOCTOR_UUID` varchar(10) NOT NULL,
  `DOCTOR_NAME` varchar(100) NOT NULL,
  `DOCTOR_MOBILE` varchar(50) NOT NULL,
  `DOCTOR_STATUS` int(10) NOT NULL DEFAULT 1,
  `DOCTOR_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `DEPARTMENT_UUID` varchar(10) NOT NULL,
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_emergency_bill` (
  `BILL_UUID` varchar(10) NOT NULL,
  `BILL_MR_ID` varchar(10) NOT NULL,
  `BILL_SLIP_ID` varchar(10) NOT NULL,
  `BILL_NAME` varchar(100) NOT NULL,
  `BILL_MOBILE` varchar(20) NOT NULL,
  `BILL_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `BILL_TOTAL_AMOUNT` int(10) NOT NULL,
  `BILL_DISCOUNT` int(10) NOT NULL,
  `BILL_TOTAL` int(10) NOT NULL,
  `STAFF_ID` varchar(10) NOT NULL,
  `ES_MO_FEE` int(10) NOT NULL DEFAULT 0,
  `INJECTION_IM` int(10) NOT NULL DEFAULT 0,
  `INJECTION_IV` int(10) NOT NULL DEFAULT 0,
  `DRIP_500ML` int(10) NOT NULL DEFAULT 0,
  `DRIP_1000ML` int(10) NOT NULL DEFAULT 0,
  `DRIP_VENOFER` int(10) NOT NULL DEFAULT 0,
  `INFUSION_500ML_ANTIBIOTIC` int(10) NOT NULL DEFAULT 0,
  `INFUSION_100ML_ANTIBIOTIC` int(10) NOT NULL DEFAULT 0,
  `IV_LINE_INJECTION` int(10) NOT NULL DEFAULT 0,
  `IV_LINE_REMOVE` int(10) NOT NULL DEFAULT 0,
  `DRESSING_SMALL` int(10) NOT NULL DEFAULT 0,
  `DRESSING_LARGE` int(10) NOT NULL DEFAULT 0,
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
  `ASCITIC_DIAGNOSTIC` int(10) NOT NULL DEFAULT 0,
  `ASCITIC_THERAPEUTIC` int(10) NOT NULL DEFAULT 0,
  `FOLEY_CATHETER_REMOVE` int(10) NOT NULL DEFAULT 0,
  `PLEURAL_FUID_THERAPEUTIC` int(10) NOT NULL DEFAULT 0,
  `PLEURAL_FUID_TAP_DIAGNOSTIC` int(10) NOT NULL DEFAULT 0,
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
  `OTHER_6` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_emergency_service_charge` (
  `SERVICE_UUID` varchar(10) NOT NULL,
  `SERVICE_NAME` varchar(100) NOT NULL,
  `SERVICE_CHARGE` int(10) NOT NULL,
  `SERVICE_STATUS` int(10) NOT NULL DEFAULT 1,
  `SERVICE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_emergency_slip` (
  `SLIP_UUID` varchar(10) NOT NULL,
  `SLIP_MR_ID` varchar(10) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(20) NOT NULL,
  `SLIP_DOCTOR` varchar(10) NOT NULL,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `SLIP_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_indoor_bill` (
  `BILL_UUID` varchar(10) NOT NULL,
  `BILL_MR_ID` varchar(10) NOT NULL,
  `BILL_SLIP_ID` varchar(10) NOT NULL,
  `BILL_NAME` varchar(100) NOT NULL,
  `BILL_MOBILE` varchar(20) NOT NULL,
  `BILL_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `BILL_TOTAL_AMOUNT` int(10) NOT NULL DEFAULT 0,
  `BILL_DISCOUNT` int(10) NOT NULL DEFAULT 0,
  `BILL_TOTAL` int(10) NOT NULL DEFAULT 0,
  `STAFF_ID` varchar(10) NOT NULL,
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
  `OTHER_CHARGE` int(10) NOT NULL DEFAULT 0,
  `OTHER_CHARGE_TEXT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_indoor_slip` (
  `SLIP_UUID` varchar(10) NOT NULL,
  `SLIP_MR_ID` varchar(10) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(20) NOT NULL,
  `SLIP_DEPARTMENT` varchar(10) NOT NULL,
  `SLIP_DOCTOR` varchar(10) NOT NULL,
  `SLIP_PROCEDURE` varchar(255) NOT NULL,
  `SLIP_TYPE` varchar(10) NOT NULL,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `SLIP_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_indoor_type` (
  `INDOOR_TYPE_UUID` varchar(10) NOT NULL,
  `INDOOR_TYPE_NAME` varchar(100) NOT NULL,
  `INDOOR_TYPE_ALAIS` varchar(20) NOT NULL,
  `INDOOR_TYPE_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `INDOOR_TYPE_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_outdoor_slip` (
  `SLIP_UUID` varchar(10) NOT NULL,
  `SLIP_MR_ID` varchar(10) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `SLIP_DEPARTMENT` varchar(10) NOT NULL,
  `SLIP_VT_DOCTOR` varchar(10) DEFAULT NULL,
  `SLIP_ME_DOCTOR` varchar(10) DEFAULT NULL,
  `SLIP_FEE` int(10) NOT NULL,
  `SLIP_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_patient` (
  `PATIENT_UUID` varchar(10) NOT NULL,
  `PATIENT_MR_ID` varchar(10) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_MOBILE` varchar(20) NOT NULL,
  `PATIENT_GENDER` varchar(10) NOT NULL,
  `PATIENT_AGE` int(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(255) NOT NULL,
  `PATIENT_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `me_room` (
  `ROOM_UUID` varchar(10) NOT NULL,
  `ROOM_NAME` varchar(100) NOT NULL,
  `ROOM_RATE` int(10) NOT NULL,
  `ROOM_STATUS` int(10) NOT NULL DEFAULT 1,
  `ROOM_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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


CREATE TABLE `vt_doctor` (
  `VISITOR_UUID` varchar(10) NOT NULL,
  `VISITOR_NAME` varchar(100) NOT NULL,
  `VISITOR_STATUS` int(10) NOT NULL DEFAULT 1,
  `VISITOR_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `edit_request`
--
ALTER TABLE `edit_request`
  ADD PRIMARY KEY (`REQUEST_ID`),
  ADD KEY `FK_STAFF_EDIT_REQUEST` (`REQUEST_BY`);

--
-- Indexes for table `me_department`
--
ALTER TABLE `me_department`
  ADD PRIMARY KEY (`DEPARTMENT_UUID`),
  ADD KEY `FK_USER_UUID_DEPARTMENT` (`STAFF_ID`) USING BTREE;

--
-- Indexes for table `me_doctor`
--
ALTER TABLE `me_doctor`
  ADD PRIMARY KEY (`DOCTOR_UUID`),
  ADD KEY `FK_USER_UUID_ME_DOCTOR` (`STAFF_ID`),
  ADD KEY `FK_DEPT_UUID_ME_DOCTOR` (`DEPARTMENT_UUID`);

--
-- Indexes for table `me_emergency_bill`
--
ALTER TABLE `me_emergency_bill`
  ADD PRIMARY KEY (`BILL_ID`),
  ADD KEY `FK_USER_UUID_EMERGENCY_BILL` (`STAFF_ID`),
  ADD KEY `FK_SLIP_ID_EMERGENCY_BILL` (`BILL_SLIP_ID`);

--
-- Indexes for table `me_emergency_service_charges`
--
ALTER TABLE `me_emergency_service_charges`
  ADD PRIMARY KEY (`SERVICE_ID`),
  ADD KEY `FK_USER_UUID_EMERGENCY_SERVICE_CHARGE` (`STAFF_ID`);

--
-- Indexes for table `me_emergency_slip`
--
ALTER TABLE `me_emergency_slip`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `FK_USER_UUID_EMERGENCY_SLIP` (`STAFF_ID`),
  ADD KEY `FK_DOCTOR_UUID_EMERGENCY_SLIP` (`SLIP_DOCTOR`);

--
-- Indexes for table `me_indoor_bill`
--
ALTER TABLE `me_indoor_bill`
  ADD PRIMARY KEY (`BILL_ID`),
  ADD KEY `FK_USER_UUID_INDOOR_BILL` (`STAFF_ID`),
  ADD KEY `FK_SLIP_ID_INDOOR_BILL` (`BILL_SLIP_ID`);

--
-- Indexes for table `me_indoor_slip`
--
ALTER TABLE `me_indoor_slip`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `FK_USER_UUID_INDOOR_SLIP` (`STAFF_ID`),
  ADD KEY `FK_DEPARTMENT_UUID_INDOOR_SLIP` (`SLIP_DEPARTMENT`),
  ADD KEY `FK_DOCTOR_UUID_INDOOR_SLIP` (`SLIP_DOCTOR`);

--
-- Indexes for table `me_indoor_type`
--
ALTER TABLE `me_indoor_type`
  ADD PRIMARY KEY (`INDOOR_TYPE_ID`),
  ADD UNIQUE KEY `INDOOR_TYPE_ALAIS` (`INDOOR_TYPE_ALAIS`),
  ADD KEY `FK_USER_UUID_INDOOR_TYPE` (`STAFF_ID`);

--
-- Indexes for table `me_outdoor_slip`
--
ALTER TABLE `me_outdoor_slip`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `FK_USER_UUID_OPD_SLIP` (`STAFF_ID`),
  ADD KEY `FK_DEPARTMENT_UUID_OPD_SLIP` (`SLIP_DEPARTMENT`),
  ADD KEY `FK_VT_DOCTOR_UUID_OPD_SLIP` (`SLIP_VT_DOCTOR`),
  ADD KEY `FK_ME_DOCTOR_UUID_OPD_SLIP` (`SLIP_ME_DOCTOR`);

--
-- Indexes for table `me_patient`
--
ALTER TABLE `me_patient`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD UNIQUE KEY `PATIENT_MR_ID` (`PATIENT_MR_ID`,`PATIENT_MOBILE`),
  ADD KEY `FK_USER_UUID_PATIENT` (`STAFF_ID`);

--
-- Indexes for table `me_room`
--
ALTER TABLE `me_room`
  ADD PRIMARY KEY (`ROOM_UUID`),
  ADD KEY `FK_USER_UUID_ROOM` (`STAFF_ID`) USING BTREE;

--
-- Indexes for table `me_user`
--
ALTER TABLE `me_user`
  ADD PRIMARY KEY (`USER_UUID`);

--
-- Indexes for table `vt_doctor`
--
ALTER TABLE `vt_doctor`
  ADD PRIMARY KEY (`VISITOR_UUID`),
  ADD KEY `FK_USER_UUID_VT_DOCTOR` (`STAFF_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `edit_request`
--
ALTER TABLE `edit_request`
  MODIFY `REQUEST_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_emergency_bill`
--
ALTER TABLE `me_emergency_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_emergency_service_charges`
--
ALTER TABLE `me_emergency_service_charges`
  MODIFY `SERVICE_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_emergency_slip`
--
ALTER TABLE `me_emergency_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_indoor_bill`
--
ALTER TABLE `me_indoor_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_indoor_slip`
--
ALTER TABLE `me_indoor_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_indoor_type`
--
ALTER TABLE `me_indoor_type`
  MODIFY `INDOOR_TYPE_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `me_outdoor_slip`
--
ALTER TABLE `me_outdoor_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `me_patient`
--
ALTER TABLE `me_patient`
  MODIFY `PATIENT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `me_department`
--
ALTER TABLE `me_department`
  ADD CONSTRAINT `FK_ADMIN_UUID` FOREIGN KEY (`STAFF_ID`) REFERENCES `me_user` (`USER_UUID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
