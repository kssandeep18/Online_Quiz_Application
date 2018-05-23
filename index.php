<!DOCTYPE html>
<html>
<head>
	<title>Quiz Portal</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		include "db.php";
		if(!isset($_SESSION)){
			session_start();
		}
		if(isset($_POST['regnum'])){
			$reg=$_POST['regnum'];
			$pass=$_POST['password'];
			$query="SELECT username FROM users WHERE reg_num='$reg' AND password='$pass'";
			$result=mysqli_query($con,$query) or die(mysqli_error($con));
			$selected=mysqli_num_rows($result);
			while($row=mysqli_fetch_array($result)){
				$uname=$row[0];
			}
			if($selected==1){
				$_SESSION['uname']=$uname;
				$_SESSION['regno']=$reg;
				header("location:/quiz/sublist.php");
			}
			else{
				echo"<script>window.alert('Please re-check your login credentials!');
				window.location.href='/quiz/index.php';
				</script>";
			}
		}
		else{
	?>
<div class="container">
		<a href="admin_login.php" class="btn btn-success pull-right down">Login as Admin</a>
		<div class="col-sm-6 col-xs-12 col-sm-offset-3 top">
			<div class="panel panel-default">
			  <div class="panel-body">
			    <h3 class="text-center">Candidate Login</h3>
			    <form action="" method="post">
			    	<div class="input-group input-group-lg">
					  <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
					  <input type="text" name="regnum" id="regnum" class="form-control" placeholder="Register No." required>
					</div>
					<br><br>
					<div class="input-group input-group-lg">
					  <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
					  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					</div>
					<br><br>
					 <button type="submit" name="btn" class="btn btn-primary btn-block">Let Me In!</button>
			    </form>
			  </div>
			</div>	
		</div>
</div>
<?php } ?>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		alert("Login Credentials:\nRegister No:1234 \nPassword:sandeep123");
	});
</script>
</html>