<?php
$pdo = new PDO("mysql:host=127.0.0.1", 'root', '');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->query("CREATE DATABASE IF NOT EXISTS assignment");

$pdo->query("USE assignment");

$sql = "CREATE TABLE registration(
          regId int(11) primary key not null auto_increment,
		  firstName varchar(30) not null,
		  surname varchar(30) not null,
		  email varchar(60) not null,
		  username varchar(30) not null,
		  password varchar(64) not null,
		  gender enum('male', 'female') not null,
		  area enum('auck', 'well', 'chch', 'dune') not null
		) engine = InnoDB";

$pdo->query($sql);

$sql = "CREATE TABLE login(
		  loginNo int(11) primary key not null auto_increment,
		  username varchar(30) not null,
		  password varchar(64) not null,
		  regId int(11) not null
		) engine = InnoDB";

$pdo->query($sql);

$sql = "CREATE TABLE comment(
		  commentNo int(11) primary key not null auto_increment,
		  dateTime datetime not null,
		  message text not null,
		  username varchar(30) not null,
		  loginNo int(11) not null
		) engine = InnoDB";

$pdo->query($sql);

$sql = "CREATE TABLE comment_likes(
		  likeNo int(11) primary key not null auto_increment,
		  commentNo int(11) not null,
		  username varchar(30) not null,
		  loginNo int(11) not null
		) engine = InnoDB";

$pdo->query($sql);