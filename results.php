<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['uname'])){
	echo"<script>window.alert('Please Login to Take Test');
	window.location.href='http://localhost/quiz/';
	</script>";
	exit;
}
include "db.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Results</title>
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
						<li><a href="sublist.php"><span class="glyphicon glyphicon-edit"></span>&nbsp;Take Test</a></li>
						<li class="active"><a href="results.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Results</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><h4 style="color:white; line-height:1.5;">Welcome <?php echo $_SESSION['uname'];?></h4></li>
						<li><a href="logout1.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body"><br/>
					<h3 class="text-center">Your Results</h3><br>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Level</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							
							<?php 
								$name=$_SESSION['uname'];
								$query1="SELECT reg_num FROM users WHERE username='$name'";
								$result1=mysqli_query($con,$query1);
								while($row1=mysqli_fetch_array($result1)){
									$regno=$row1[0];
								}
								$query2="SELECT level_id,total FROM scores WHERE reg_num='$regno'";
								$result2=mysqli_query($con,$query2);
								while($row2=mysqli_fetch_array($result2)){
									$query3="SELECT level_names FROM levels WHERE level_id='$row2[0]'";
									$result3=mysqli_query($con,$query3);
									while($row3=mysqli_fetch_array($result3)){
										echo"<tr><td>$row3[0]</td>";
										break;
									}
									echo"<td>$row2[1]</td></tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>