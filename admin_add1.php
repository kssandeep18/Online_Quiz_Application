<?php
	include "db.php";
	if(isset($_POST['sub'])){
		$subject=$_POST['sub'];
		$query= "SELECT * FROM sub_list WHERE sub_name='$subject'";
		$result=mysqli_query($con,$query);
		$select=mysqli_num_rows($result);
		if($select<1){
			$query= "INSERT INTO sub_list (sub_id,sub_name) VALUES ('','$subject')";
			$result=mysqli_query($con,$query);
			if($result){
				echo "1";
			}
		}
		else{
			echo "0";
		}	
	}
	else if(isset($_POST['subject']) && isset($_POST['diff'])){
		$subj=$_POST['subject'];
		$subid=$_POST['subjectid'];
		$level=$_POST['diff'];
		$merge=$level."-".$subj;
		$query1= "SELECT * FROM levels WHERE level_names='$merge'";
		$result1=mysqli_query($con,$query1);
		$select1=mysqli_num_rows($result1);
		if($select1<1){
			$query2= "INSERT INTO levels (level_id,sub_id,level_names) VALUES ('','$subid','$merge')";
			$result2=mysqli_query($con,$query2);
			if($result2){
				echo "1";
			}
		}
		else{
			echo "0";
		}
	}
	else if(isset($_POST['question']) && isset($_POST['true_ans'])){
		$level=$_POST['level'];
		$question=$_POST['question'];
		$opt1=$_POST['op1'];
		$opt2=$_POST['op2'];
		$opt3=$_POST['op3'];
		$answer=$_POST['true_ans'];
		$query3= "INSERT INTO questions (q_id,level_id,question,option1,option2,option3,answer) VALUES ('','$level','$question','$opt1','$opt2','$opt3','$answer')";
		$result3=mysqli_query($con,$query3);
		if($result3){
				echo "1";
		}
	}
	
?>