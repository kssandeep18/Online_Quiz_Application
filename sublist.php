 <?php
if(!isset($_SESSION)){
	session_start();
}
include "db.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sublist</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="style1.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php if(!isset($_SESSION['uname'])){
			echo"<script>window.alert('Please Login to Take Test');
			window.location.href='http://localhost/quiz/';
			</script>";
			exit;
		}?>
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
					<center><h2>Select Language and Level</h2></center><br/><br/>
					<form class="form-horizontal" action="test.php" method="post">
						<div class="form-group">
							<label class="control-label col-lg-1">Select Language:</label>
							<div class="col-lg-5">
								<select class="form-control" name="subj" id="subj">
									<option value="">Select Language</option>
									<?php
										$query="SELECT * FROM sub_list";
										$result=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($result)){ 
									echo "<option value='$row[0]''>$row[1]</option>";
									}?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-1">Select Level:</label>
							<div class="col-lg-5">
								<select class="form-control col-lg-9" name="levels" id="levels">
								</select>
							</div>
						</div><br>
						<div class="form-group">
							<div class="col-lg-offset-1 col-lg-5">
								<button type="submit" class="btn btn-primary">Take Test</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$("#subj").change(function(){
				var a=$(this).val();
				$.ajax({
				url:'levels.php',
				type:'post',
				data:{
					'id':a ,
				},
				success: function(response){
					$('#levels').html(response);
				}
			});
			});
		</script>
	</body>
</html>