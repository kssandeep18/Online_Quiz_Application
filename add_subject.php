<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin'])){
	echo"<script>window.alert('Login required!');
	window.location.href='/quiz/admin_login.php';
	</script>";
	exit;
}
include "db.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Add</title>
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
					<a class="navbar-brand" href="#">Admin</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="add_subject.php"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;Add</a></li>
						<li><a href="edit_subject.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><h4 style="color:white; line-height:1.5">Welcome <?php echo $_SESSION['admin'];?></h4></li>
						<li><a href="logout2.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="nav nav-pills">
						<li class="active"><a href="add_subject.php">Add Subject</a></li>
						<li><a href="add_level.php">Add Level</a></li>
						<li><a href="add_question.php">Add Question</a></li>
					</ul><br/><br/>
					<div class="alert alert-success alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Success!</strong> Subject Successfully Created!
					</div>
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Error!</strong> The Entered Subject Already Exists!
					</div>
					<form class="form-horizontal" action="" method="post">
						<div class="form-group">
							<label class="control-label col-lg-2" for="subj">Subject:</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" id="subj" placeholder="Enter Subject Name.." name="subj" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="button" name="btn" id="btn" class="btn btn-success">ADD</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('document').ready(function(){
				$('.alert-success,.alert-danger').hide();
				$('#btn').click(function(){
					var subj=$('#subj').val();
					console.log(subj);
					if(subj.length>0){
						$.ajax({
						url:'admin_add1.php',
						type:'post',
						data:{
							'sub':subj,
						},
						success: function(response){
							if(response==1){
								$('.alert-success').show().delay(200).fadeOut(1500);
								$('#subj').val("");
							}
							else{
								$('.alert-danger').show().delay(200).fadeOut(1500);
								$('#subj').val("");
							}
						}
					});
					}
					else{
						alert("Please fill the field");
					}
					
				});
			});
			
		</script>
	</body>
</html>