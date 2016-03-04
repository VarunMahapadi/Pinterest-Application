-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2015 at 10:33 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pinboard`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `comments`(IN `userid` VARCHAR(50), IN `pictureid` INT, IN `usercomment` VARCHAR(500))
    NO SQL
insert into user_comment values (userid, pictureid, usercomment, now())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `createboard`(IN `name` VARCHAR(50), IN `type` VARCHAR(50), IN `details` VARCHAR(50), IN `username` VARCHAR(50))
    NO SQL
insert into board (bname, btype, bdetails, uid) values(name,type,details,username)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletepicture`(IN `pictureid` INT)
    NO SQL
delete from picture
where pid=pictureid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editprofile`(IN `username` VARCHAR(50), IN `firstname` VARCHAR(50), IN `lastname` VARCHAR(50), IN `newaboutme` VARCHAR(400))
    NO SQL
update user
set fname = firstname, lname = lastname, aboutme = newaboutme
where uid = username$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `like`(IN `userid` VARCHAR(50), IN `pictureid` INT(11))
    NO SQL
insert into user_like (user_like.uid,user_like.pid,user_like.ldate) values(userid, pictureid, now())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(IN `username` VARCHAR(50), IN `pswd` VARCHAR(50))
    NO SQL
select fname, lname from user
WHERE uid = username
and password = PASSWORD$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pinpicture`(IN `name` VARCHAR(50), IN `type` VARCHAR(50), IN `details` VARCHAR(200), IN `url` VARCHAR(400), IN `boardid` INT(11))
    NO SQL
insert into picture (pname,ptype,pdetails,purl,bid) values(name,type,details,url,boardid)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `repinpicture`(IN `pictureid` INT, IN `boardid` INT, IN `userid` VARCHAR(50))
    NO SQL
insert into repin values(userid, pictureid, boardid)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchpicture`(IN `tag` VARCHAR(50))
    NO SQL
select * from picture
where ptype = tag$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchuser`(IN `name` VARCHAR(50))
    NO SQL
SELECT * from user where fname = name or lname = name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `signup`(IN `username` VARCHAR(50), IN `pswd` VARCHAR(50), IN `firstname` VARCHAR(50), IN `lastname` VARCHAR(50), IN `dateofbirth` DATE)
insert into user(uid, password,fname,lname,dob,aboutme) values(username,pswd,firstname,lastname,dateofbirth,'')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `bid` int(11) NOT NULL,
  `bname` varchar(50) DEFAULT NULL,
  `btype` varchar(50) DEFAULT NULL,
  `bdetails` varchar(50) DEFAULT NULL,
  `uid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`bid`, `bname`, `btype`, `bdetails`, `uid`) VALUES
(1, 'Cricket', 'Sports', NULL, 'abc@gmail.com'),
(2, 'Soccer', 'Sports', NULL, 'anci@yahoo.com'),
(3, 'Drawings', 'Art', NULL, 'pqr@gmail.com'),
(4, 'New York', 'City', NULL, 'jbnd@yahoo.com'),
(5, 'IPL', 'Sports', NULL, 'kyr@rediff.com'),
(6, 'Beds', 'Furniture ', NULL, 'mks@gmail.com'),
(7, 'Super Cars', 'Vehicles', NULL, 'fag@yahoo.com'),
(8, 'Transformers', 'Movies', NULL, 'lmn@rediff.com'),
(9, 'Dresses', 'Fashion', NULL, 'ewtsn@yahoo.com'),
(10, 'Nature', 'Sceneries', NULL, 'xyz@yahoo.com'),
(11, 'Foreign Languages', 'Education', NULL, 'ehnt@gmail.com'),
(12, 'Actresses', 'Celebrities', NULL, 'abc@gmail.com'),
(13, 'Logo Design', 'Design', NULL, 'xyz@yahoo.com'),
(14, 'Workout Plans', 'Health and Fitness', NULL, 'ehnt@gmail.com'),
(15, 'Memes', 'Humor', NULL, 'rr@rich.com'),
(16, 'Monster', 'Cartoon', 'Monsters are cool!! hahaha', 'rr@rich.com'),
(17, 'FIFA', 'Games', 'I love games', 'abc@gmail.com'),
(18, 'Samsung', 'Mobile phones', 'I have samsing phine', 'abc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `uid` varchar(50) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`uid`, `bid`) VALUES
('lmn@rediff.com', 3),
('ehnt@gmail.com', 12),
('anci@yahoo.com', 9),
('mks@gmail.com', 3),
('rr@rich.com', 1),
('lmn@rediff.com', 5),
('abc@gmail.com', 10),
('abc@gmail.com', 1),
('mks@gmail.com', 13),
('abc@gmail.com', 6);

-- --------------------------------------------------------

--
-- Table structure for table `followstream`
--

CREATE TABLE IF NOT EXISTS `followstream` (
  `fsid` int(11) NOT NULL,
  `fsname` varchar(50) DEFAULT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `fstype` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followstream`
--

INSERT INTO `followstream` (`fsid`, `fsname`, `uid`, `fstype`) VALUES
(1, 'Real Madrid', 'anci@yahoo.com', 'Footballers'),
(2, 'Virat Kohli', 'kyr@rediff.com', 'Batsman'),
(3, 'Lamborghini', 'jbnd@yahoo.com', 'Cars'),
(4, 'Sketches', 'mks@gmail.com', 'Logo'),
(5, 'Shoes', 'rr@rich.com', 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `uid1` varchar(50) DEFAULT NULL,
  `uid2` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`uid1`, `uid2`) VALUES
('abc@gmail.com', 'kyr@rediff.com'),
('anci@yahoo.com', 'fag@yahoo.com'),
('ehnt@gmail.com', 'lmn@rediff.com'),
('ehnt@gmail.com', 'ewtsn@yahoo.com'),
('ehnt@gmail.com', 'rr@rich.com'),
('ewtsn@yahoo.com', 'lmn@rediff.com'),
('ewtsn@yahoo.com', 'xyz@yahoo.com'),
('fag@yahoo.com', 'kyr@rediff.com'),
('fag@yahoo.com', 'mks@gmail.com'),
('jbnd@yahoo.com', 'lmn@rediff.com'),
('jbnd@yahoo.com', 'abc@gmail.com'),
('lmn@rediff.com', 'rr@rich.com'),
('kyr@rediff.com', 'xyz@yahoo.com'),
('anci@yahoo.com', 'pqr@gmail.com'),
('jbnd@yahoo.com', 'kyr@rediff.com'),
('abc@gmail.com', 'rr@rich.com'),
('abc@gmail.com', 'rr@rich.com'),
('abc@gmail.com', 'rr@rich.com'),
('ewtsn@yahoo.com', 'abc@gmail.com'),
('mks@gmail.com', 'abc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `pid` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `ptype` varchar(50) NOT NULL,
  `pdetails` varchar(200) NOT NULL,
  `purl` varchar(400) NOT NULL,
  `bid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`pid`, `pname`, `ptype`, `pdetails`, `purl`, `bid`) VALUES
(1, 'Virat', 'Batsman', '', 'picture1.jpg', 1),
(2, 'Exercise Chart', 'Exercise', '', 'picture2.jpg', 14),
(3, 'Leo', 'Footballers', '', 'picture3.jpg', 2),
(4, 'CR7 vs Leo', 'Footballers', '', 'picture4.jpg', 2),
(5, 'Statue of Liberty', 'Monument', '', 'picture5.jpg', 4),
(6, 'Lamborghini', 'Cars', '', 'picture6.jpg', 7),
(7, 'Bumblebee', 'Robot', '', 'picture7.jpg', 8),
(8, 'Sunset', 'Nature', '', 'picture8.jpg', 10),
(9, 'Jennifer Aniston', 'Actress', '', 'picture9.jpg', 12),
(10, 'BMW logo', 'Logo', '', 'picture10.png', 13),
(11, 'Do it now', 'Funny', '', 'picture11.jpg', 15),
(12, 'French Greetings', 'French', '', 'picture12.jpg', 11),
(13, 'Leather Beds', 'Beds', '', 'picture13.jpg', 6),
(15, 'Mumbai Indians', 'IPL Cricket', '', 'picture15.jpg', 5),
(36, 'Sachin Tendulkar', 'Cricket', 'God of Cricket', 'picture14.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `picturefollowstream`
--

CREATE TABLE IF NOT EXISTS `picturefollowstream` (
  `fsid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `picturefollowstream`
--

INSERT INTO `picturefollowstream` (`fsid`, `pid`) VALUES
(1, 4),
(2, 1),
(3, 6),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `repin`
--

CREATE TABLE IF NOT EXISTS `repin` (
  `uid` varchar(50) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repin`
--

INSERT INTO `repin` (`uid`, `pid`, `bid`) VALUES
('abc@gmail.com', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `aboutme` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `password`, `fname`, `lname`, `dob`, `aboutme`) VALUES
('abc@gmail.com', '12345678', 'aaron', 'ramsey', '1990-03-28', ''),
('anci@yahoo.com', 'poiuyt', 'Carlo', 'Ancelotti', '1991-11-24', ''),
('ehnt@gmail.com', 'zxcvbnm', 'Ethan ', 'Hunt', '1982-05-15', ''),
('ewtsn@yahoo.com', '123789', 'Emma', 'Watson', '1991-12-18', ''),
('fag@yahoo.com', 'qwertyuiop', 'Franc', 'Watson', '1995-02-09', ''),
('jbnd@yahoo.com', 'asdf1234', 'James ', 'Bond', '1990-09-25', ''),
('jenc@gmail.com', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Jennifer', 'Cole', '1985-02-02', ''),
('jty@yahoo.com', '12396', 'John ', 'Terry', '1987-06-05', ''),
('kyr@rediff.com', 'qwer1234', 'Kyle', 'Reese', '1992-05-30', ''),
('lmn@rediff.com', 'asdfghjkl', 'Larry', 'Paige', '1992-09-10', ''),
('mks@gmail.com', 'qwerty', 'Michael', 'Kors', '1987-01-26', ''),
('pqr@gmail.com', '789456123', 'Pearl', 'Johnson', '1989-07-16', 'Hello!'),
('rr@rich.com', 'richrich', 'Richie', 'Rich', '1995-02-19', ''),
('xyz@yahoo.com', '1234567890', 'Xeus', 'Messiah', '1985-04-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_comment`
--

CREATE TABLE IF NOT EXISTS `user_comment` (
  `uid` varchar(50) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_comment`
--

INSERT INTO `user_comment` (`uid`, `pid`, `comment`, `cdate`) VALUES
('fag@yahoo.com', 5, 'Nice', '2015-05-05 09:26:32'),
('jbnd@yahoo.com', 1, 'Cool', '2015-05-03 05:40:40'),
('ehnt@gmail.com', 1, 'Good', '2015-05-01 07:19:16'),
('lmn@rediff.com', 1, 'Very good', '2015-05-06 06:12:30'),
('kyr@rediff.com', 11, 'Lol', '2015-05-26 12:37:38'),
('abc@gmail.com', 1, 'Viraaaaatttt!!', '2015-05-03 20:11:17'),
('abc@gmail.com', 1, 'Yo Virat!!', '2015-05-03 20:12:07'),
('abc@gmail.com', 1, 'You are the best!!', '2015-05-03 20:13:20'),
('abc@gmail.com', 1, 'Oh!', '2015-05-03 22:14:40'),
('rr@rich.com', 1, 'Wow!!', '2015-05-04 14:46:36'),
('abc@gmail.com', 1, 'SDSD', '2015-05-06 00:51:10'),
('abc@gmail.com', 36, 'Awesome!!!!', '2015-05-06 15:51:43'),
('abc@gmail.com', 36, 'Awesome!!!!', '2015-05-06 15:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_like`
--

CREATE TABLE IF NOT EXISTS `user_like` (
  `uid` varchar(50) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `ldate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_like`
--

INSERT INTO `user_like` (`uid`, `pid`, `ldate`) VALUES
('abc@gmail.com', 1, '2015-05-03 19:46:04'),
('abc@gmail.com', 11, '2015-05-05 01:12:51'),
('abc@gmail.com', 36, '2015-05-05 04:43:31'),
('anci@yahoo.com', 3, '2015-04-26 09:33:21'),
('ehnt@gmail.com', 9, '2015-04-08 09:30:15'),
('ehnt@gmail.com', 15, '2015-05-01 05:46:46'),
('jenc@gmail.com', 6, '2015-04-02 10:38:16'),
('jenc@gmail.com', 8, '2015-04-04 12:24:31'),
('kyr@rediff.com', 1, '2015-04-16 06:24:35'),
('rr@rich.com', 1, '2015-05-04 14:46:23'),
('rr@rich.com', 9, '2015-05-06 00:12:39'),
('xyz@yahoo.com', 7, '2015-04-13 15:39:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`bid`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD KEY `uid` (`uid`), ADD KEY `bid` (`bid`);

--
-- Indexes for table `followstream`
--
ALTER TABLE `followstream`
  ADD PRIMARY KEY (`fsid`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD KEY `uid1` (`uid1`), ADD KEY `uid2` (`uid2`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `picturefollowstream`
--
ALTER TABLE `picturefollowstream`
  ADD KEY `fsid` (`fsid`), ADD KEY `pid` (`pid`);

--
-- Indexes for table `repin`
--
ALTER TABLE `repin`
  ADD KEY `uid` (`uid`), ADD KEY `bid` (`bid`), ADD KEY `pid` (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD KEY `uid` (`uid`), ADD KEY `pid` (`pid`);

--
-- Indexes for table `user_like`
--
ALTER TABLE `user_like`
  ADD PRIMARY KEY (`uid`,`pid`), ADD KEY `pid` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `followstream`
--
ALTER TABLE `followstream`
  MODIFY `fsid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `board`
--
ALTER TABLE `board`
ADD CONSTRAINT `board_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `board` (`bid`);

--
-- Constraints for table `followstream`
--
ALTER TABLE `followstream`
ADD CONSTRAINT `followstream_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`uid1`) REFERENCES `user` (`uid`),
ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`uid2`) REFERENCES `user` (`uid`);

--
-- Constraints for table `picturefollowstream`
--
ALTER TABLE `picturefollowstream`
ADD CONSTRAINT `picturefollowstream_ibfk_1` FOREIGN KEY (`fsid`) REFERENCES `followstream` (`fsid`),
ADD CONSTRAINT `picturefollowstream_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `picture` (`pid`);

--
-- Constraints for table `repin`
--
ALTER TABLE `repin`
ADD CONSTRAINT `repin_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
ADD CONSTRAINT `repin_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `board` (`bid`),
ADD CONSTRAINT `repin_ibfk_3` FOREIGN KEY (`pid`) REFERENCES `picture` (`pid`);

--
-- Constraints for table `user_comment`
--
ALTER TABLE `user_comment`
ADD CONSTRAINT `user_comment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
ADD CONSTRAINT `user_comment_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `picture` (`pid`);

--
-- Constraints for table `user_like`
--
ALTER TABLE `user_like`
ADD CONSTRAINT `user_like_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
ADD CONSTRAINT `user_like_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `picture` (`pid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
