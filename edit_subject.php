<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin'])){
	echo"<script>window.alert('Login required!');
	window.location.href='/quiz/admin_login';
	</script>";
	exit;
}
include "db.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Edit</title>
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
						<li><a href="add_subject.php"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;Add</a></li>
						<li class="active"><a href="edit_subject.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a></li>
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
						<li class="active"><a href="edit_subject.php">Edit Subject</a></li>
						<li><a href="edit_levels.php">Edit Level</a></li>
						<li><a href="edit_questions.php">Edit Question</a></li>
					</ul><br/><br/>
					<div class="alert alert-success alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Success!</strong> Subject Successfully Deleted
					</div>
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Error!</strong> Sorry,Couldn't Delete the Subject!
					</div>
					<form class="form-horizontal" action="" method="post">
						<table class="table table-bordered table-hover table-responsive">
			              <tbody>
			                <?php
			               		$query="SELECT * FROM sub_list";
			               		$result=mysqli_query($con,$query);
			               		while($row=mysqli_fetch_row($result)){
			               			echo "<tr id='$row[0]'>";
			               			echo"<td>$row[1]</td>";
			               			echo"<td><button type='button' name='button' id='$row[0]' class='btn btn-danger'>Delete</button></td>";
			               			echo"</tr>";
			               		}	
			                ?>
			              </tbody>
			            </table>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.alert-success,.alert-danger').hide();
				$('.btn-danger').click(function(){
					var id=$(this).attr("id");
					$.ajax({
					type:'get',
					url:'edit_contents.php',
					data:{
					  'id':id
					},
					success:function(response){
					  if(response=="1"){
					    $('.alert-success').removeClass('hide');
						$('.alert-success').show().delay(200).fadeOut(1500);
					    $("#"+id).remove();
					  }
					  else{
					  	console.log(id);
					    $('.alert-danger').removeClass('hide');
					    $('.alert-danger').show().delay(200).fadeOut(1500);
					  }
					}
					});
				});
			});
		</script>
	</body>
</html>