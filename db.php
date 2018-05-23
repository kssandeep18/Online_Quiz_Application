<?php
$con = mysqli_connect('localhost', 'root', '');
if (!$con){
 die("Server Connection Failed" . mysqli_error($con));
}
$select_db = mysqli_select_db($con,'register');
if (!$select_db){
 die("Database Selection Failed" . mysqli_error($con));
}
?>