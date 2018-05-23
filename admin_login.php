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
		session_start();
		include "db.php";
		if(isset($_POST['uname'])){
			$uname=$_POST['uname'];
			$pass=$_POST['password'];
			$query="SELECT * FROM final WHERE username='$uname' AND password='$pass'";
			$result=mysqli_query($con,$query) or die(mysqli_error($con));
			$selected=mysqli_num_rows($result);
			if($selected==1){
				$_SESSION['admin']='admin';
				header("location:/quiz/add_subject.php");
			}
			else{
				echo"<script>window.alert('Please re-check your login credentials!');
				window.location.href='/quiz/admin_login.php';
				</script>";
			}
		}
		else{
	?>
<div class="container">
		<a href="index.php" class="btn btn-success pull-right down">Login as Candidate</a>
		<div class="col-sm-6 col-xs-12 col-sm-offset-3 top">
			<div class="panel panel-default">
			  <div class="panel-body">
			    <h3 class="text-center">Admin Login</h3>
			    <form action="" method="post">
			    	<div class="input-group input-group-lg">
					  <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
					  <input type="text" name="uname" id="uname" class="form-control" placeholder="Username" required>
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
		alert("Login Credentials:\nUsername:admin \nPassword:admin");
	});
</script>
</html>