<?php
	include "db.php";
	if(isset($_GET['id']) && $_GET['no']=='1') {
		$sub_id=$_GET['id'];
		$query= "SELECT * FROM levels WHERE sub_id='$sub_id'";
		$result=mysqli_query($con,$query);
		$num=mysqli_num_rows($result);
		if($num>0){
			while($row=mysqli_fetch_assoc($result)){
				$data[]=$row;
			}
			echo json_encode($data);
		}	
		else{
			echo "0";
		}
	}	
	else if(isset($_GET['id'])){
		$sub_id=$_GET['id'];
		$query= "DELETE FROM sub_list WHERE sub_id='$sub_id'";
		$result=mysqli_query($con,$query);
		if($result){
			echo "1";
		}	
		else{
			echo "0";
		}
	}
	else if(isset($_GET['level_id'])){
		$l_id=$_GET['level_id'];
		$query= "DELETE FROM levels WHERE level_id='$l_id'";
		$result=mysqli_query($con,$query);
		if($result){
			echo "1";
		}	
		else{
			echo "0";
		}
	}	
	else if(isset($_GET['name'])){
		$name=$_GET['name'];
		$query= "SELECT * FROM levels WHERE level_names='$name'";
		$result=mysqli_query($con,$query);
		$num=mysqli_num_rows($result);
		if($num<=0){
			echo "0";
		}
		else{
				while($row=mysqli_fetch_row($result)){
					$level_id=$row[0];
				}
			$query1= "SELECT * FROM questions WHERE level_id='$level_id'";
			$result1=mysqli_query($con,$query1);
			$num=mysqli_num_rows($result1);
			if($num>0){
				while($row=mysqli_fetch_assoc($result1)){
					$data[]=$row;
				}
				echo json_encode($data);
			}	
			else{
				echo "0";
			}
		}
	}
	else if(isset($_GET['ques_id'])){
		$qid=$_GET['ques_id'];
		$query= "DELETE FROM questions WHERE q_id='$qid'";
		$result=mysqli_query($con,$query);
		if($result){
			echo "1";
		}	
		else{
			echo "0";
		}
	}
?>