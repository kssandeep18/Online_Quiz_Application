<?php
	if(!isset($_SESSION)){
		session_start();
	}
	include "session.php";
	include "db.php";
	$subid=$_POST['id'];
	$query= "SELECT * FROM levels WHERE sub_id='$subid' ";
	$result=mysqli_query($con,$query);
	$c=mysqli_num_rows($result);
	if($result>0){
		while($row=mysqli_fetch_row($result)){
			echo "<option value='$row[0]'>$row[2]</option>";
		}	
	}
?>