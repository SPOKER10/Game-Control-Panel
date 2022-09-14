SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `donations` (
  `donateID` int(11) NOT NULL,
  `donateName` varchar(30) NOT NULL,
  `donatePIN` varchar(19) NOT NULL,
  `donateSUM` varchar(3) NOT NULL,
  `donateStatus` int(11) NOT NULL,
  `donateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `donateAdminAction` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `donations`
  ADD PRIMARY KEY (`donateID`);


ALTER TABLE `donations`
  MODIFY `donateID` int(11) NOT NULL AUTO_INCREMENT;