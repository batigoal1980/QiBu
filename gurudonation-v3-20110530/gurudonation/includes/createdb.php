<?php

	include("linkmysql.php");

	

	//Creating database

	mysql_query("CREATE DATABASE $databasename",$link);	

	mysql_select_db("$databasename");

		

	//Creating Table

	$query = "CREATE TABLE settings(

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				attribute VARCHAR(100),

				value VARCHAR(1000)

			)";

	$result = mysql_query($query);



	$query = "CREATE TABLE admins (

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				username VARCHAR(25) NOT NULL,

				password VARCHAR(40) NOT NULL

			)";

	$result = mysql_query($query);

	

	$query = "CREATE TABLE contacts(

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				firstname VARCHAR(20),

				lastname VARCHAR(20),

				email VARCHAR(30),

				telephone VARCHAR(20),

				subject VARCHAR(20),

				message VARCHAR(1000)

			)";

	$result = mysql_query($query);

	$query = "CREATE TABLE users(

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				name VARCHAR(20),

				email VARCHAR(50),

				password VARCHAR(100),

				keycode VARCHAR(100),

				activate VARCHAR(1),

				balance float,

				paypalid VARCHAR(50)

			)";

	$result = mysql_query($query);
print $result;
	

	$query = "CREATE TABLE kapipals(

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				userid INT NOT NULL,

				title VARCHAR(50),

				amounttoraise float,

				duration int,

				mincontribution float,

				paypalemail VARCHAR(50),

				image VARCHAR(100),

				website VARCHAR(100),

				description VARCHAR(1000),

				fixedcontribution VARCHAR(300),

				created date,

				amountraised float,

				views int,

				featured VARCHAR(1),

				contributions int,

				FOREIGN KEY (userid) REFERENCES users(id)

			)";

	$result = mysql_query($query);

	

	$query = "CREATE TABLE resetrequests(

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				email VARCHAR(50),

				keycode VARCHAR(100)

			)";

	$result = mysql_query($query);

	

	$query = "CREATE TABLE abuses (

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				pageaddr VARCHAR(100),

				problem VARCHAR(100),

				youremail VARCHAR(50)

			)";

	$result = mysql_query($query);

	

	$query = "CREATE TABLE contributions (

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				kapipalid int NOT NULL,

				amount float,

				displayname VARCHAR(50),

				message VARCHAR(300),

				contributedate date,

				FOREIGN KEY (kapipalid) REFERENCES kapipals(id)

			)";

	$result = mysql_query($query);

	

	$query = "CREATE TABLE withdrawals (

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				userid int NOT NULL,

				amount float,

				FOREIGN KEY (userid) REFERENCES users(id)

			)";

	$result = mysql_query($query);

	

	$query = "CREATE TABLE categories (

				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

				catename VARCHAR(50),

				picture VARCHAR(100)

			)";

	$result = mysql_query($query);

?>