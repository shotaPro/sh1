<?php
$mysqli_hostname = "localhost";
$mysqli_user = "ec";
$mysqli_password = "ec123";
$mysqli_database = "sh1";
$prefix = "";
$conn = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password,$mysqli_database) or die("Could not connect database");
