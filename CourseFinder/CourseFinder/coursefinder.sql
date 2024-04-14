-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `courses`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `saved`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `courses` (
  `courseCode` varchar(20) NOT NULL,
  `courseTitle` varchar(50) NOT NULL,
  `university` varchar(50) NOT NULL,
  `durationYears` int(11) NOT NULL,
  `startYear` year(4) NOT NULL,
  `categoryID` varchar(10) DEFAULT NULL,
  `saved` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `courses` (`courseCode`, `courseTitle`, `university`, `durationYears`, `startYear`, `categoryID`, `saved`)
VALUES
('CAO-0001', 'Biology', 'University College Dublin', 4, 2022, '001', 'N'),
('CAO-0002', 'Chemistry', 'University College Cork', 4, 2023, '001', 'N'),
('CAO-0003', 'Physics', 'National University of Ireland, Galway', 4, 2022, '001', 'N'),
('CAO-0004', 'Mathematics', 'Trinity College Dublin', 4, 2022, '001', 'N'),
('CAO-0005', 'Economics', 'University College Dublin', 3, 2023, '002', 'N'),
('CAO-0006', 'Management', 'University College Cork', 3, 2023, '002', 'N'),
('CAO-0007', 'Marketing', 'National University of Ireland, Galway', 3, 2022, '002', 'N'),
('CAO-0008', 'Finance', 'Trinity College Dublin', 3, 2022, '002', 'N'),
('CAO-0009', 'Civil Engineering', 'University College Dublin', 4, 2023, '003', 'N'),
('CAO-0010', 'Mechanical Engineering', 'University College Cork', 4, 2023, '003', 'N'),
('CAO-0011', 'Electrical Engineering', 'National University of Ireland, Galway', 4, 2022, '003', 'N'),
('CAO-0012', 'Chemical Engineering', 'Trinity College Dublin', 4, 2022, '003', 'N'),
('CAO-0013', 'Art History', 'University College Dublin', 3, 2023, '004', 'N'),
('CAO-0014', 'Music', 'University College Cork', 3, 2023, '004', 'N'),
('CAO-0015', 'Literature', 'National University of Ireland, Galway', 3, 2022, '004', 'N'),
('CAO-0016', 'Film Studies', 'Trinity College Dublin', 3, 2022, '004', 'N'),
('CAO-0017', 'Medicine', 'University College Dublin', 5, 2022, '005', 'N'),
('CAO-0018', 'Dentistry', 'University College Cork', 5, 2023, '005', 'N'),
('CAO-0019', 'Pharmacy', 'National University of Ireland, Galway', 4, 2022, '005', 'N'),
('CAO-0020', 'Nursing', 'Trinity College Dublin', 4, 2022, '005', 'N'),
('CAO-0021', 'Law', 'University College Dublin', 4, 2023, '006', 'N'),
('CAO-0022', 'Criminal Justice', 'University College Cork', 3, 2023, '006', 'N'),
('CAO-0023', 'International Law', 'National University of Ireland, Galway', 3, 2022, '006', 'N'),
('CAO-0024', 'Corporate Law', 'Trinity College Dublin', 3, 2022, '006', 'N'),
('CAO-0025', 'Psychology', 'University College Dublin', 4, 2023, '007', 'N'),
('CAO-0026', 'Sociology', 'University College Cork', 4, 2023, '007', 'N'),
('CAO-0027', 'Anthropology', 'National University of Ireland, Galway', 4, 2022, '007', 'N'),
('CAO-0028', 'Political Science', 'Trinity College Dublin', 4, 2022, '007', 'N'),
('CAO-0029', 'Architecture', 'University College Dublin', 5, 2023, '008', 'N'),
('CAO-0030', 'Interior Design', 'University College Cork', 5, 2023, '008', 'N'),
('CAO-0031', 'Linguistics', 'National University of Ireland, Galway', 4, 2022, '008', 'N'),
('CAO-0032', 'Philosophy', 'Trinity College Dublin', 4, 2022, '008', 'N'),
('CAO-0033', 'Physiotherapy', 'University College Dublin', 4, 2023, '005', 'N'),
('CAO-0034', 'Occupational Therapy', 'University College Cork', 4, 2023, '005', 'N'),
('CAO-0035', 'Veterinary Medicine', 'National University of Ireland, Galway', 5, 2022, '005', 'N'),
('CAO-0036', 'Optometry', 'Trinity College Dublin', 5, 2022, '005', 'N'),
('CAO-0037', 'Fashion Design', 'University College Dublin', 4, 2023, '004', 'N'),
('CAO-0038', 'Graphic Design', 'University College Cork', 4, 2023, '004', 'N'),
('CAO-0039', 'Industrial Design', 'National University of Ireland, Galway', 4, 2022, '004', 'N'),
('CAO-0040', 'Web Design', 'Trinity College Dublin', 4, 2022, '004', 'N'),
('CAO-0041', 'Agricultural Science', 'University College Dublin', 4, 2023, '001', 'N'),
('CAO-0042', 'Food Science', 'University College Cork', 4, 2023, '001', 'N'),
('CAO-0043', 'Forensic Science', 'National University of Ireland, Galway', 4, 2022, '001', 'N'),
('CAO-0044', 'Computer Engineering', 'Trinity College Dublin', 4, 2022, '003', 'N'),
('CAO-0045', 'Biotechnology', 'University College Dublin', 4, 2023, '003', 'N'),
('CAO-0046', 'History', 'University College Cork', 4, 2023, '004', 'N'),
('CAO-0047', 'Geography', 'National University of Ireland, Galway', 4, 2022, '004', 'N');


CREATE TABLE `categories` (
  `categoryID` varchar(10) NOT NULL,
  `categoryDescription` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categories` (`categoryID`, `categoryDescription`) VALUES
('001', 'Science'),
('002', 'Business'),
('003', 'Engineering'),
('004', 'Environmental'),
('005', 'Medicine'),
('006', 'Law');

CREATE TABLE `saved` (
  `courseCode` varchar(20) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `saveDate` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `saved` (`courseCode`, `username`, `saveDate`) VALUES
('CAO-1234', 'rahul', '2022-01-08');

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`username`, `password`, `firstname`, `surname`, `addressLine1`, `addressLine2`, `city`, `mobile`) VALUES
('rahul', 'password', 'Rahul', 'Powhani', '123 Long Drive', '123 Lane', 'Dublin', '0862839921');

ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseCode`),
  ADD KEY `categoryID` (`categoryID`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

ALTER TABLE `saved`
  ADD PRIMARY KEY (`courseCode`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`);
COMMIT;

