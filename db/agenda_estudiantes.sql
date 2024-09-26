SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(100) DEFAULT NULL,
  `ClassDuration` int(11) DEFAULT NULL,
  `CourseAvailableDays` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `enrolls` (
  `EnrollID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `InstrumentID` int(11) NOT NULL,
  `SemesterID` int(11) NOT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `instruments` (
  `InstrumentID` int(11) NOT NULL,
  `InstrumentName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `professoravailability` (
  `AvailabilityID` int(11) NOT NULL,
  `ProfessorID` int(11) DEFAULT NULL,
  `DayOfWeek` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `professorinstrument` (
  `ProfessorID` int(11) NOT NULL,
  `InstrumentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `professorrooms` (
  `ProfessorID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `professors` (
  `ProfessorID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `semesters` (
  `SemesterID` int(11) NOT NULL,
  `SemesterName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `settings` (
  `SettingID` int(11) NOT NULL,
  `SettingName` varchar(255) NOT NULL,
  `SettingValue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Cedula` varchar(100) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `student_schedule` (
  `ScheduleID` int(11) NOT NULL,
  `ProfessorID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `DayOfWeek` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `EnrollID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`EnrollID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `InstrumentID` (`InstrumentID`),
  ADD KEY `SemesterID` (`SemesterID`);

ALTER TABLE `instruments`
  ADD PRIMARY KEY (`InstrumentID`);

ALTER TABLE `professoravailability`
  ADD PRIMARY KEY (`AvailabilityID`),
  ADD KEY `ProfessorID` (`ProfessorID`);

ALTER TABLE `professorinstrument`
  ADD PRIMARY KEY (`ProfessorID`,`InstrumentID`),
  ADD KEY `InstrumentID` (`InstrumentID`);

ALTER TABLE `professorrooms`
  ADD PRIMARY KEY (`ProfessorID`,`RoomID`),
  ADD KEY `RoomID` (`RoomID`);

ALTER TABLE `professors`
  ADD PRIMARY KEY (`ProfessorID`),
  ADD UNIQUE KEY `Email` (`Email`);

ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`);

ALTER TABLE `semesters`
  ADD PRIMARY KEY (`SemesterID`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`SettingID`);

ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `Cedula` (`Cedula`),
  ADD UNIQUE KEY `Email` (`Email`);

ALTER TABLE `student_schedule`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `ProfessorID` (`ProfessorID`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `student_schedule_ibfk_enroll` (`EnrollID`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);


ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enrolls`
  MODIFY `EnrollID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `instruments`
  MODIFY `InstrumentID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `professoravailability`
  MODIFY `AvailabilityID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `professors`
  MODIFY `ProfessorID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `semesters`
  MODIFY `SemesterID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `settings`
  MODIFY `SettingID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `student_schedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `enrolls`
  ADD CONSTRAINT `enrolls_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`),
  ADD CONSTRAINT `enrolls_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `enrolls_ibfk_3` FOREIGN KEY (`InstrumentID`) REFERENCES `instruments` (`InstrumentID`),
  ADD CONSTRAINT `enrolls_ibfk_4` FOREIGN KEY (`SemesterID`) REFERENCES `semesters` (`SemesterID`);

ALTER TABLE `professoravailability`
  ADD CONSTRAINT `professoravailability_ibfk_1` FOREIGN KEY (`ProfessorID`) REFERENCES `professors` (`ProfessorID`);

ALTER TABLE `professorinstrument`
  ADD CONSTRAINT `professorinstrument_ibfk_1` FOREIGN KEY (`ProfessorID`) REFERENCES `professors` (`ProfessorID`),
  ADD CONSTRAINT `professorinstrument_ibfk_2` FOREIGN KEY (`InstrumentID`) REFERENCES `instruments` (`InstrumentID`);

ALTER TABLE `professorrooms`
  ADD CONSTRAINT `professorrooms_ibfk_1` FOREIGN KEY (`ProfessorID`) REFERENCES `professors` (`ProfessorID`),
  ADD CONSTRAINT `professorrooms_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

ALTER TABLE `student_schedule`
  ADD CONSTRAINT `student_schedule_ibfk_2` FOREIGN KEY (`ProfessorID`) REFERENCES `professors` (`ProfessorID`),
  ADD CONSTRAINT `student_schedule_ibfk_3` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  ADD CONSTRAINT `student_schedule_ibfk_enroll` FOREIGN KEY (`EnrollID`) REFERENCES `enrolls` (`EnrollID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
