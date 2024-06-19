-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2024 a las 01:42:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda_estudiantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(100) DEFAULT NULL,
  `ClassDuration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`, `ClassDuration`) VALUES
(1, 'Técnico laboral', 60),
(10, 'Curso Músico Ministerial Semana (Jueves & Viernes)', 30),
(11, 'Curso Músico Ministerial Sábado', 30),
(12, 'Curso Músico Ministerial Online', 30),
(13, 'Teens', 30),
(14, 'Pre Teens', 30),
(15, 'Kids', 30),
(16, 'Instrumento Personalizado UNA HORA', 60),
(17, 'Instrumento Personalizado 1/2 hora', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instruments`
--

CREATE TABLE `instruments` (
  `InstrumentID` int(11) NOT NULL,
  `InstrumentName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instruments`
--

INSERT INTO `instruments` (`InstrumentID`, `InstrumentName`) VALUES
(3, 'Guitarra'),
(4, 'Bateria'),
(5, 'Piano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professoravailability`
--

CREATE TABLE `professoravailability` (
  `AvailabilityID` int(11) NOT NULL,
  `ProfessorID` int(11) DEFAULT NULL,
  `DayOfWeek` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professorinstrument`
--

CREATE TABLE `professorinstrument` (
  `ProfessorID` int(11) NOT NULL,
  `InstrumentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professorrooms`
--

CREATE TABLE `professorrooms` (
  `ProfessorID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professors`
--

CREATE TABLE `professors` (
  `ProfessorID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomName`) VALUES
(1, '201'),
(4, '204');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semesters`
--

CREATE TABLE `semesters` (
  `SemesterID` int(11) NOT NULL,
  `SemesterName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `SettingID` int(11) NOT NULL,
  `SettingName` varchar(255) NOT NULL,
  `SettingValue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `studentcoursesandinstruments`
--

CREATE TABLE `studentcoursesandinstruments` (
  `StudentCourseInstrumentID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `InstrumentID` int(11) DEFAULT NULL,
  `Selected` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Cedula` varchar(100) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Cedula`, `Status`, `Email`) VALUES
(1, 'angela', 'caballero', '123', 1, 'angela@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_schedule`
--

CREATE TABLE `student_schedule` (
  `ScheduleID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ProfessorID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `DayOfWeek` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `InstrumentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userID`, `cedula`, `password`, `role`, `lastLogin`) VALUES
(1, '1233502252', '$2y$10$WulZIShEc5VkRw/22QjG4evSz8/AEXevlOESJCxqs9CBVPI7i85KK', 'admin', '2024-05-31 13:47:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indices de la tabla `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`InstrumentID`);

--
-- Indices de la tabla `professoravailability`
--
ALTER TABLE `professoravailability`
  ADD PRIMARY KEY (`AvailabilityID`),
  ADD KEY `ProfessorID` (`ProfessorID`);

--
-- Indices de la tabla `professorinstrument`
--
ALTER TABLE `professorinstrument`
  ADD PRIMARY KEY (`ProfessorID`,`InstrumentID`),
  ADD KEY `InstrumentID` (`InstrumentID`);

--
-- Indices de la tabla `professorrooms`
--
ALTER TABLE `professorrooms`
  ADD PRIMARY KEY (`ProfessorID`,`RoomID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indices de la tabla `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`ProfessorID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indices de la tabla `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`SemesterID`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`SettingID`);

--
-- Indices de la tabla `studentcoursesandinstruments`
--
ALTER TABLE `studentcoursesandinstruments`
  ADD PRIMARY KEY (`StudentCourseInstrumentID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `InstrumentID` (`InstrumentID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `ProfessorID` (`ProfessorID`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `InstrumentID` (`InstrumentID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `instruments`
--
ALTER TABLE `instruments`
  MODIFY `InstrumentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `professoravailability`
--
ALTER TABLE `professoravailability`
  MODIFY `AvailabilityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `professors`
--
ALTER TABLE `professors`
  MODIFY `ProfessorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `semesters`
--
ALTER TABLE `semesters`
  MODIFY `SemesterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `SettingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `studentcoursesandinstruments`
--
ALTER TABLE `studentcoursesandinstruments`
  MODIFY `StudentCourseInstrumentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `student_schedule`
--
ALTER TABLE `student_schedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `professoravailability`
--
ALTER TABLE `professoravailability`
  ADD CONSTRAINT `professoravailability_ibfk_1` FOREIGN KEY (`ProfessorID`) REFERENCES `professors` (`ProfessorID`);

--
-- Filtros para la tabla `professorinstrument`
--
ALTER TABLE `professorinstrument`
  ADD CONSTRAINT `professorinstrument_ibfk_1` FOREIGN KEY (`ProfessorID`) REFERENCES `professors` (`ProfessorID`),
  ADD CONSTRAINT `professorinstrument_ibfk_2` FOREIGN KEY (`InstrumentID`) REFERENCES `instruments` (`InstrumentID`);

--
-- Filtros para la tabla `professorrooms`
--
ALTER TABLE `professorrooms`
  ADD CONSTRAINT `professorrooms_ibfk_1` FOREIGN KEY (`ProfessorID`) REFERENCES `professors` (`ProfessorID`),
  ADD CONSTRAINT `professorrooms_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

--
-- Filtros para la tabla `studentcoursesandinstruments`
--
ALTER TABLE `studentcoursesandinstruments`
  ADD CONSTRAINT `studentcoursesandinstruments_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`),
  ADD CONSTRAINT `studentcoursesandinstruments_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `studentcoursesandinstruments_ibfk_3` FOREIGN KEY (`InstrumentID`) REFERENCES `instruments` (`InstrumentID`);

--
-- Filtros para la tabla `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD CONSTRAINT `student_schedule_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`),
  ADD CONSTRAINT `student_schedule_ibfk_2` FOREIGN KEY (`ProfessorID`) REFERENCES `professors` (`ProfessorID`),
  ADD CONSTRAINT `student_schedule_ibfk_3` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  ADD CONSTRAINT `student_schedule_ibfk_4` FOREIGN KEY (`InstrumentID`) REFERENCES `instruments` (`InstrumentID`),
  ADD CONSTRAINT `student_schedule_ibfk_5` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
