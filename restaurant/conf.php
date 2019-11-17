<?php
	 
	 $dbhost = "localhost";
	 $dbuser = "root";
	 $dbpass = "";
	 $db = "restaurant";

	 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

	 if(!$conn){
	 	die("Couldn't Connect". mysqli_connect_error());
	 }
?>	 