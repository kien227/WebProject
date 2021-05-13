<?php

	// Database configuration 	
	$hostname = "localhost"; 
	$username = "kienbucfoi"; 
	$password = "kiendeptry"; 
	$dbname   = "student_manager";
	 
	// Create database connection 
	$con = new mysqli($hostname, $username, $password, $dbname); 
	 
	// Check connection 
	if ($con->connect_error) { 
	    die("Connection failed: " . $con->connect_error); 
	}

	ini_set('display_errors',1);
?>