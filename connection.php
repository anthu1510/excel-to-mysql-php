<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'i3520629_wp5';

$conn = mysqli_connect($host,$username,$password) or die("check the connection");
mysqli_select_db($conn,$db_name) or die('Datatabase does not exists....');