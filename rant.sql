-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2010 at 03:26 AM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rant`
--
CREATE DATABASE IF NOT EXISTS rant;
GRANT ALL PRIVILEGES ON rant.* to 'assist'@'localhost' identified by 'assist';
USE rant;
-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL default 'Untitled',
  `post` blob NOT NULL,
  `author` varchar(50) NOT NULL default '0',
  `date_posted` date NOT NULL default '0000-00-00',
  `pic` blob,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `posts` (`id`, `title`,`post`, `author`, `date_posted`) VALUES
(1,'350','I ABSOLUTELY HATE this nonsql project', 'Anonymous', '2011-04-17'),
(2,'the weather', 'I hate this weather!!!!!', 'Amanda', '2011-04-17');

CREATE TABLE IF NOT EXISTS `comment`(
`id` int(11) NOT NULL AUTO_INCREMENT,
`post` blob NOT NULL,
`author` varchar(50) NOT NULL default '0',
`date_posted` date NOT NULL default '0000-00-00',
PRIMARY KEY(`id`)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `comment` (`id`,`post`, `author`, `date_posted`) VALUES
(1,  'MongoDB is so confusing. and Node.js..and all this is just bullshit!','John Doe', '2008-10-17'),
(2,  'The rain sucks so much and I just hate it..its miserable!', 'Jane Doe', '2008-10-17'),
(3,  'I agree it just makes me want to stay in bed all day...it has ruined all of my plans for the day! ', 'UMW Student', '2008-10-18');


CREATE TABLE IF NOT EXISTS `postTocomment`(
`postId` int(11) NOT NULL, 
`commentId` int(2) NOT NULL,
  CONSTRAINT post_postId_fk
  FOREIGN KEY (postId)
  REFERENCES post (postId),
  CONSTRAINT comment_commentId_fk
  FOREIGN KEY (commentId)
  REFERENCES comment (commentId)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `postTocomment` (`postId`, `commentId`) VALUES
(1,1);
INSERT INTO `postTocomment` (`postId`, `commentId`) VALUES
(2,2);
INSERT INTO `postTocomment` (`postId`, `commentId`) VALUES
(2,3);
