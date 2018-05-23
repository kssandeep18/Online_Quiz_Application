<?php
include "db.php";
if(!isset($_SESSION)){
	session_start();
}
$reg=$_SESSION['regno'];
$level=$_SESSION['level'];
if(isset($_POST)){
	$right=0;
	$wrong=0;
	$unanswered=0;$c=0;$k=0;$mark=0;
	$key=array_keys($_POST);
	foreach ($key as $value) {
		$c++;
	}
	
	$order=join(",",$key);
	$query = "SELECT q_id,answer from questions where q_id IN($order) ORDER BY FIELD(q_id,$order)";
	$result=mysqli_query( $con,$query) or die(mysqli_error($con));
	while($row=mysqli_fetch_row($result)){
		if($k<$c){
			$temp=$key[$k];
			if($row[1]==$_POST[$temp]){
				$right++;
				$mark=$mark+2;
			}
			elseif ($_POST[$temp]=="unanswered") {
				$unanswered++;	
			}
			else{
				$wrong++;
			}
			$k++;
		}
	}
	$query = "INSERT INTO scores (user_id,reg_num,level_id,correct,unanswered,wrong,total) VALUES('','$reg','$level','$right','$unanswered','$wrong','$mark')";
	$result=mysqli_query( $con,$query) or die(mysqli_error($con));
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Results_view</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="style1.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Student</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="sublist.php"><span class="glyphicon glyphicon-edit"></span>&nbsp;Take Test</a></li>
						<li><a href="results.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Results</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><h4 style="color:white; line-height:1.5">Welcome <?php echo $_SESSION['uname'];?></h4></li>
						<li><a href="logout1.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body"><br/>
					<h2 class="text-center">Your Test Results</h2><br/><br/>
					<div class="row">
						<div class="col-lg-4">
						</div>
						<div class="col-lg-2">
							<h4>Correct Answers:</h4>
						</div>
						<div class="col-lg-1">
							<div class="well well-lg"><?php echo $right; ?></div>
						</div>
						<div class="col-lg-5">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
						</div>
						<div class="col-lg-2">
							<h4>Unanswered:</h4>
						</div>
						<div class="col-lg-1">
							<div class="well well-lg"><?php echo $unanswered; ?></div>
						</div>
						<div class="col-lg-5">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
						</div>
						<div class="col-lg-2">
							<h4>Wrong Answers:</h4>
						</div>
						<div class="col-lg-1">
							<div class="well well-lg"><?php echo $wrong; ?></div>
						</div>
						<div class="col-lg-5">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
						</div>
						<div class="col-lg-2">
							<h4>Marks Obtained:</h4>
						</div>
						<div class="col-lg-1">
							<div class="well well-lg"><?php echo $mark; ?></div>
						</div>
						<div class="col-lg-5">
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</body>
</html>