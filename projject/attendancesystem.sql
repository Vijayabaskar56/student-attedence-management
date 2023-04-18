-- -- creating database


-- creatinig table for the database

-- Table structure for table admin
CREATE TABLE `tbladmin` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- dumping data into the tbladmin table

insert into `tbladmin` ( `ID`,`firstName`,`lastName`,`emailAddress`,`password`) values 
(1, 'Admin', 'Liam', 'admin@mail.com', 'D00F5D5217896FB7FD601412CB890830');


-- ------------------------------------------------------------

--
-- Table strutre for tblattendance
--

create table `tblattendance` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `rollNo` varchar(255) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmId` varchar(10) NOT NULL,
  `semTermId` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `dateTimeTaken` varchar(20) NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- dumpuing values into tblattedence table not yet executed

INSERT INTO `tblattendance` (`Id`, `rollNo`, `classId`, `classArmId`, `semTermId`, `status`, `dateTimeTaken`) VALUES
(001, '2020ITC001', '1', '2', '1', '1', '2020-11-01'),
(002, '2020ITC002', '1', '2', '1', '1', '2020-11-01'),
(003, '2020ITC003', '1', '2', '1', '1', '2020-11-01'),
(004, '2020ITC004', '1', '4', '1', '1', '2020-11-01'),
(005, '2020ITC005', '1', '4', '1', '0', '2020-11-01');


-- --------------------------------------------------------

--
-- Table struture for tblclass
-- 

create table `tblclass` (
	`Id` int(10) NOT NULL AUTO_INCREMENT,
    `className` varchar(50) NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`Id`, `className`) VALUES
(1, '1-IT'),
(2, '2-IT'),
(3, '3-IT');

-- --------------------------------------------------------

--
-- Table structure for table `tblclassarms`
--

CREATE TABLE `tblclassarms` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `classId` varchar(10) NOT NULL,
  `classArmName` varchar(255) NOT NULL,
  `isAssigned` varchar(10) NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table `tblclassarms`
--

INSERT INTO `tblclassarms` (`Id`, `classId`, `classArmName`, `isAssigned`) VALUES
(1, '1', 'Self', '1'),
(2, '2', 'Regular', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblclassteacher`
--

CREATE TABLE `tblclassteacher` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNo` varchar(50) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmId` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Dumping data for table `tblclassteacher`
--

INSERT INTO `tblclassteacher` (`Id`, `firstName`, `lastName`, `emailAddress`, `password`, `phoneNo`, `classId`, `classArmId`, `dateCreated`) VALUES
(1, 'Leksha', 'Priya', 'lekshapriya@gmail.com', '32250170a0dca92d53ec9624f336ca24', '09089898999', '3', '1', '2020-10-31'),
(4, 'Vaira', 'Meenakshi', 'vairam@gmail.com', '32250170a0dca92d53ec9624f336ca24', '09672002882', '3', '1', '2020-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `tblsessionterm`
--

CREATE TABLE `tblsemterm` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `batchName` varchar(50) NOT NULL,
  `semId` varchar(50) NOT NULL,
  `isActive` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsessionterm`
--

INSERT INTO `tblsemterm` (`Id`, `batchName`, `semId`, `isActive`, `dateCreated`) VALUES
(1, '2019/2022', '1', '0', '2020-10-31'),
(2, '2020/2023', '2', '1', '2020-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `rollNumber` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmId` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`Id`, `firstName`, `lastName`, `otherName`, `rollNumber`, `password`, `classId`, `classArmId`, `dateCreated`) VALUES
(1, 'Aathi', 'sesan', 'none', '2020ITC001', '12345', '3', '1', '2020-10-31'),
(2, 'Abinaya', 'none', 'none', '2020ITC002', '12345', '3', '1', '2020-10-31'),
(3, 'Anitha', 'none', 'none', '2020ITC003', '12345', '3', '1', '2020-10-31'),
(4, 'Aruna', 'Devi', 'none', '2020ITC004', '12345', '3', '1', '2020-10-31'),
(5, 'Bala', 'Prasana', 'none', '2020ITC005', '12345', '3', '1', '2020-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `tblterm`
--

CREATE TABLE `tblsem` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `semName` varchar(20) NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblterm`
--

INSERT INTO `tblsem` (`Id`, `semName`) VALUES
(1, 'First'),
(2, 'Second'),
(3, 'Third'),
(4, 'Fourth'),
(5, 'Fifth'),
(6, 'Sixth');


