<?php
require_once("configuration_helper.php");
session_start();
$temp = "this is a temp variable";
$siteConfigurationObject = new SiteConfiguration();

$siteConfigurationObject->setWebsiteName('thetoybox.com');

$siteConfigurationObject->initializeDatabase('localhost', 'toy', 'root', 'root', 'UserLogin');

if(!$siteConfigurationObject->isUserLoggedIn())
	$siteConfigurationObject->setRandomKey();
/*

CREATE TABLE UserLogin(
	User_Id INT NOT NULL AUTO_INCREMENT,
	Fullname VARCHAR(150) NOT NULL,
	Email VARCHAR(150) NOT NULL,
	Password VARCHAR(80) NOT NULL,
	salt VARCHAR(50) NOT NULL,
	UserRole INT NOT NULL DEFAULT 1,
	confirmcode varchar(32),
	PRIMARY KEY(User_Id)
)

CREATE TABLE UserInformation(
	UserInfo_Id INT NOT NULL AUTO_INCREMENT,
	User_Id INT NOT NULL,
	Phone VARCHAR(20) NOT NULL,
	Street VARCHAR(150) NOT NULL,
	City VARCHAR(20) NOT NULL,
	State VARCHAR(10) NOT NULL,
	Zip VARCHAR(150) NOT NULL,
	PRIMARY KEY(UserInfo_Id),
	FOREIGN KEY(User_Id) REFERENCES UserLogin(User_Id) ON DELETE CASCADE
)

*/
?>
