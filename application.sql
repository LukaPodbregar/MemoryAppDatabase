-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2022 at 06:52 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `application`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `userID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  `imageName` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`userID`, `imageID`, `imageName`, `gender`, `path`) VALUES
(58, 104, 'Tone test123322', 'female', 'userImages/58_1642522893_Tina.png'),
(62, 117, 's', 'male', 'userImages/62_1657533899_s.jpg'),
(61, 118, 'asd', 'male', 'userImages/61_1657534934_asd.jpg'),
(61, 119, 'dda\n', 'male', 'userImages/61_1657534941_dd.png'),
(64, 120, 'test', 'female', 'userImages/64_1657535759_test.jpg'),
(65, 122, 'Jan', 'male', 'userImages/65_1658821298_Jan.jpg'),
(65, 123, 'David', 'male', 'userImages/65_1658821305_David.jpg'),
(65, 124, 'Karin', 'female', 'userImages/65_1658821316_Karin.jpg'),
(65, 125, 'Jurij', 'male', 'userImages/65_1658821327_Jurij.jpg'),
(65, 126, 'Matic', 'male', 'userImages/65_1658821336_Matic.jpg'),
(65, 127, 'Mustafa', 'male', 'userImages/65_1658821343_Mustafa.jpg'),
(65, 128, 'Zan', 'male', 'userImages/65_1658821356_Zan.jpg'),
(65, 129, 'Urban', 'male', 'userImages/65_1658821365_Urban.jpg'),
(65, 130, 'Erika', 'female', 'userImages/65_1658821392_Erika.png'),
(60, 132, 'Jim', 'male', 'userImages/60_1659430686_Jim.jpg'),
(65, 133, 'Janez', 'male', 'userImages/65_1662202982_janez.jpg'),
(69, 134, 'Tine', 'male', 'userImages/69_1662212732_Tine.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `imagespreset`
--

CREATE TABLE `imagespreset` (
  `imageID` int(11) NOT NULL,
  `imageName` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `imagespreset`
--

INSERT INTO `imagespreset` (`imageID`, `imageName`, `gender`, `path`) VALUES
(1, 'Barack', 'male', 'presetImages/barack.png'),
(2, 'Elizabeth', 'female', 'presetImages/elizabeth.jpg'),
(3, 'Mark', 'male', 'presetImages/mark.jpg'),
(4, 'Jackie', 'male', 'presetImages/jackie.jpg'),
(5, 'Michael', 'male', 'presetImages/michael.jpg'),
(6, 'David', 'male', 'presetImages/david.jpg'),
(7, 'Lionel', 'male', 'presetImages/lionel.jpg'),
(8, 'Ronaldo', 'male', 'presetImages/ronaldo.jpg'),
(9, 'Michael', 'male', 'presetImages/michaelJ.jpg'),
(10, 'Nelson', 'male', 'presetImages/nelson.jpg'),
(11, 'Stephen', 'male', 'presetImages/stephen.jpg'),
(12, 'Bob', 'male', 'presetImages/bob.jpg'),
(13, 'Albert', 'male', 'presetImages/albert.jpg'),
(14, 'Marilyn', 'female', 'presetImages/marilyn.jpg'),
(15, 'Diana', 'female', 'presetImages/diana.jpg'),
(16, 'Oprah', 'female', 'presetImages/oprah.jpg'),
(17, 'Jennifer', 'female', 'presetImages/jennifer.jpg'),
(18, 'Angelina', 'female', 'presetImages/angelina.jpg'),
(19, 'Serena', 'female', 'presetImages/serena.jpg'),
(20, 'Michelle', 'female', 'presetImages/michelle.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `randomnames`
--

CREATE TABLE `randomnames` (
  `name` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `randomnames`
--

INSERT INTO `randomnames` (`name`, `gender`) VALUES
('Aleks', 'male'),
('Aleksandra', 'female'),
('Alen', 'male'),
('Alja', 'female'),
('Aljaž', 'male'),
('Andraž', 'male'),
('Andreja', 'female'),
('Anže', 'male'),
('Barbara', 'female'),
('Bob', 'male'),
('Brigita', 'female'),
('David', 'male'),
('Deja', 'female'),
('Diana', 'female'),
('Erika', 'female'),
('Eva', 'female'),
('Evita', 'female'),
('Gašper', 'male'),
('Grega', 'male'),
('Jackie', 'male'),
('Jakob', 'male'),
('Janez', 'male'),
('Jurij', 'male'),
('Lionel', 'male'),
('Lojze', 'male'),
('Luka', 'male'),
('Maks', 'male'),
('Mark', 'male'),
('Matej', 'male'),
('Matic', 'male'),
('Michael', 'male'),
('Michelle', 'female'),
('Miha', 'male'),
('Mustafa', 'male'),
('Nika', 'female'),
('Pavel', 'male'),
('Rok', 'male'),
('Sara', 'female'),
('Serena', 'female'),
('Tilen', 'male'),
('Tim', 'male'),
('Tina', 'female'),
('Tomaž', 'male'),
('Urban', 'male'),
('Urh', 'male'),
('Veronika', 'female'),
('Žan', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `userID`) VALUES
('test', '$2y$10$9T.SiwRJ//0xnSJhMLT9.uY7A9vOY3Yi3dBMr5FDkX4clzZen3dBy', 1),
('test2', 's1y$10$9T.SiwRJ//0xnSJhMLT9.uY7A9vOY3Yi3dBMr5FDkX4clzZen3dBy', 2),
('test3', 'z2y$10$9T.SiwRJ//0xnSJhMLT9.uY7A9vOY3Yi3dBMr5FDkX4clzZen3dBy', 3),
('test4', 'rw2$10$9T.SiwRJ//0xnSJhMLT9.uY7A9vOY3Yi3dBMr5FDkX4clzZen3dBy', 4),
('test5', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 5),
('test6', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 6),
('test7', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 7),
('test8', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 8),
('test9', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 9),
('test10', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 10),
('test11', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 11),
('test12', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 12),
('test13', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 13),
('test14', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 14),
('test15', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 15),
('test16', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 16),
('test17', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 17),
('test18', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 18),
('asdaa', '$2y$10$9T.SiwRJ//0xnSJhMLT9.uY7A9vOY3Yi3dBMr5FDkX4clzZen3dBy', 19),
('adsd', '$2y$10$bcxMc09yzV4I1NwgqNx4WObSFniOQlQMMWMjtRXb5CIgQ5Nfs3oMe', 20),
('adsds', '$2y$10$Jd5FJlPRydN9M2wCGNZeaut9H8IQJS62bKCHxqQZyCDyihUd2gB5a', 21),
('testpost123', '$2y$10$GEZDJtlQoHIgwktlvnY2.u02YsrTplkXFBErW8UdswRO7qfqKxBEW', 22),
('testpost1234123', '$2y$10$0sR63evcYlzdMDYxUZVro.Lynb2RQWzYDI88XF0Ly7O3aKTwltBkm', 23),
('asdaaaa', '$2y$10$jr21HthTs5E3EuPKsJtMw.pbvGTHit9IAV/m8ALS4pcFNziPSfP1G', 24),
('testpost11', '$2y$10$pBF3lOJzLL5Uf7.AeqJ3I.vZnT5e70qWgP2ydCv3/LuIRqEatZGFy', 25),
('testp', '$2y$10$OU7iShxWwqj4wsNoCXgWleYmsIa74vlXPG3RR1/CLTaS.4DIZe6ym', 26),
('testp1', '$2y$10$FBjmrzlB3jw1Zm5l2N24p.o3mMemOrcZu2aw0JDNNjNHOCDEqWB4e', 27),
('testp12', '$2y$10$mM.w6Vhr.E24ZLdB/y3t7uM56pIFtjY7u.8feMtiGZViIffUn84j.', 28),
('testpp', '$2y$10$u0h/DXAkOdOTczW.06qj/.F7prb5HaA3I4sLAgbCO5m3nZWYG3Vem', 29),
('asdasdaaa', '$2y$10$X8pFw.K2N2QpB5gqFkP0OOt5BO4osLlfro/Z07PGqlB37mWykVLX.', 30),
('adasd123123', '$2y$10$7ivgpmVLhPFu8JjxymDVnuplY32FFz7CDZjg..d3c5Ry5W4gutvvC', 31),
('adasdadada', '$2y$10$VC9ijpBvHzdhxUmh3evVy.5XAcTGd4sAKVUGgpUCpjj3RPvB/Booe', 32),
('kkkk', '$2y$10$z9or7ZP/X9NPDO/xFFfYDe18uS0j1b9qojHVmvtqrw8IqcC5kY2Be', 33),
('zuzuzuzu', '$2y$10$kFpxeXZcHmvar4r9y99/xuVgnJw.YMOxK6k.z2BV8ljSkKMonzBl6', 34),
('pop', '$2y$10$SirGxkvAKKSfy2I.zwI0ruAZX0oV0yjpqbCSwJQ0b.QB4XtD3Soq2', 35),
('popo', '$2y$10$Dhf60dYEzbqt58PlyIfFGek3rpz.rlEPgA/ZzTg3V1RhJTR5HcHHu', 36),
('popoo', '$2y$10$Kh6AHa0rWWZNFLOCT6OJ3.LgrxQD9/KUmvxKIXu/PnIH97UIi83fW', 37),
('klkl', '$2y$10$B5/0FTPSanQIsbUxFTFrLu.wNn90W.mUHKoNjag2a70IvDAwbLSQ6', 38),
('testdi', '$2y$10$EI.DWw1uFpioFpXinUatRudVhL0ReLrQcAQo0pd8UbT0PTSBdrLVW', 39),
('testdidi', '$2y$10$Gczla2LwYHPJB0mZy745FegpuSnazhcKkVlEJSWV/zVRpp6V7veSW', 40),
('tt1', '$2y$10$g6FAEigln12nOnOoBIFKve.7xxBO8ztNRUa61SgA3RhrHWQxeLKF6', 41),
('ttt1', '$2y$10$gcYLIvOXYZq3CBwNjxaxueibAbUyWB8UnxIKL2D.pNH3eyko3Ae1i', 42),
('aaa', '$2y$10$uKMx0eUd3doWP8v.9F5yZeRDg4dtxqysAUbSF3nO9pEuspvc/tL1W', 43),
('tt1123', '$2y$10$U4VPpskiWyHsj156ri.iRe24RErcEfr/MZy7jOYLsaqcTKncHBSKK', 44),
('top', '$2y$10$IoihG4GqRMSexRTDNbC2LOFKJZGm5o7fNhio.RlYnoKnFX4oo5B.m', 45),
('t1t', '$2y$10$8HVm3cBrvRK8tjJfsjo2JOEzYiXrzvTUzOJfJB6ATEbOfhBMGixNC', 46),
('z1', '$2y$10$ekZhEiOtf3srGWd.rOxjNOeOxMOAg1gdEmqvrKtvWF./JrCx57XU2', 47),
('diana', '$2y$10$7/x62DBvtpoaCTokl1oa0Oeqs2.e7pOu/CkjOXE2HUrXO3.kPWCwK', 48),
('luka', '$2y$10$kdW/.gKN7JJ7FnBJV/qtEObfje8DVDWLJPp/CfCXIPOrQUjbZ2TWG', 49),
('luka1', '$2y$10$skbbGFvBxBPEkD3fzJiutOHpPhR.cxcMwZ7BpAaE0SDrVeUni07Tu', 50),
('testaaaa', '$2y$10$0ERG.XrSjq8s.Oj4OwX4xuvDP0DP/OPm32AmVlppGi88uEpNgGd6u', 51),
('aaaa', '$2y$10$EYqkhfOvHSljUyiHyDeDCe/w44plT5pY2nzq7X733IwIvr.Xwe4Ty', 52),
('dianabanana', '$2y$10$Oo5zUYi8OR3XoUy3GjboB.PTmG3gIeNu5rKOZPVivbfFjLPy7L4.6', 53),
('didi', '$2y$10$.tjXxP60Bf84MSY/x.7kWeZnCWSFGi8dS8K5AD2XTteZqhwmL/SD.', 54),
('poskus123123', '$2y$10$QBbOLFRBalp1HxtZoo1MfeNYrOBQR0UfgmBottfcqzMqiW4ECYj1.', 55),
('poskus', '$2y$10$jzyQM2TYrifrf6i5Bp.nOOzbL1Ef5Hzq1M7JULQPD45dXvjZntUGy', 56),
('pos', '$2y$10$GBUov.3LppUxo8ZkGQY6VebBFdlPPWtkmNcpGODDHr25Ur9/0vD/e', 57),
('posku', '$2y$10$s6bRuCVEwz.G1QVuBArsHueVkgitxxDICRW7fViNIrgRLSH.jjh8W', 58),
('luka123', '$2y$10$8F3GlXQMai5PHfRWUoiqXOpuXkgG2CWx2k/Vhj5y05jHEHUz/FS2O', 59),
('lukatest', '$2y$10$4INhBtwBETZgPC3opd2ln..uOHYfpNPlT7n9dLdNxkNJGsSD3Mgma', 60),
('tttt', '$2y$10$4.VOJNnBbu321zC0/5xS7OpP11y.zI0HG4bnu6ncEIWB6QJ.9NeNm', 61),
('ttttt', '$2y$10$ET45GduW2UP4JuCwf/Yns.FhHovK.SoLPJa1SrrPtx86TXlUlyh/i', 62),
('tttttt', '$2y$10$zhRbPYTKjBT2iHNkk5Pq6es6.VCAFKbvEPUwrAHx/d1onU8oKSX9.', 63),
('lukatest1', '$2y$10$QW.gGot9QXEnYUGRHRf6AuSrA/Gg/h/Px1VdgjmGOD.1uPHj0xXje', 64),
('luka1234', '$2y$10$gR3eBWS1HfgH9EbhI1XEXerBzWCHJQbfjxHc9ltcMNtFHfhLAjEei', 65),
('admin', '$2y$10$Kong0N00Aew/qUMvc3nId.IW2155v0ZNcGJ9XM0MUZhw.J4ca7BE2', 66),
('tim123', '$2y$10$2NzkRTLY5ZEVrbtztFDIK.VZd/CCDyAMjioN.cFv8CscY9P2xQrU6', 68),
('novRacun', '$2y$10$jk7RKamVaxJK/WjOmyBfr.XVraR35WfDjYyVLqKopeZawbxNFV8oa', 69);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `imagespreset`
--
ALTER TABLE `imagespreset`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `randomnames`
--
ALTER TABLE `randomnames`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `imagespreset`
--
ALTER TABLE `imagespreset`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `userIDimages` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
