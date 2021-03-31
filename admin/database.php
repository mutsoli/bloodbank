<?php

$server='localhost';
$user='root';
$password='';
$database="mybloodbank";

$con=new mysqli($server,$user,$password) or die($con->error);

$query="CREATE DATABASE IF NOT EXISTS ".$database;

$con->query($query)or die($con->error);

$con->select_db($database)or die($con->error);

$query="CREATE TABLE IF NOT EXISTS blood_requests(Id INT(14) NOT NULL AUTO_INCREMENT PRIMARY KEY,user_email TEXT NOT NULL, user_phone TEXT NOT NULL ,blood_group TEXT NOT NULL,required_units INT NOT NULL, request_date TIMESTAMP NOT NULL) ";

$con->query($query)or die($con->error);
$query="CREATE TABLE IF NOT EXISTS users(Id INT(14) NOT NULL AUTO_INCREMENT PRIMARY KEY,user_email TEXT NOT NULL, user_phone TEXT NOT NULL ,blood_group TEXT NOT NULL,user_age INT NOT NULL, user_name TEXT NOT NULL, user_location TEXT NOT NULL,user_password TEXT NOT NULL) ";

$con->query($query)or die($con->error);

$query="CREATE TABLE IF NOT EXISTS blood_table(Id INT(14) NOT NULL AUTO_INCREMENT PRIMARY KEY,blood_group TEXT NOT NULL, units_available INT NOT NULL ) ";
$con->query($query)or die($con->error);

$query="CREATE TABLE IF NOT EXISTS blood_donation(Id INT(14) NOT NULL AUTO_INCREMENT PRIMARY KEY,user_email TEXT NOT NULL,last_date TEXT NOT NULL, units INT NOT NULL ) ";
$con->query($query)or die($con->error);


?>


