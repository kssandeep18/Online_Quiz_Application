<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin'])){
	header("location:/quiz/admin_login.php");
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
						<li><a href="add_subject.php">Add Subject</a></li>
						<li><a href="add_level.php">Add Level</a></li>
						<li class="active"><a href="add_question.php">Add Question</a></li>
					</ul><br/><br/>
					<div class="alert alert-success alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Success!</strong> Question Successfully Created!
					</div>
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<strong>Error!</strong> Error in Creation!
					</div>
					<form class="form-horizontal" action="/action_page.php">
						<div class="form-group">
							<label class="control-label col-sm-2">Subject&Levels:</label>
							<div class="col-lg-7">
								<select class="form-control" id="level" name="level">
									<?php
										$query="SELECT * FROM levels";
										$result=mysqli_query($con,$query);
									while($row=mysqli_fetch_row($result)){ ?>
									<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="question">Question:</label>
							<div class="col-lg-7">
								<textarea class="form-control" rows="5" id="question"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2" for="opt1">Option 1:</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" id="opt1" placeholder="Enter Option 1.." name="opt1" >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2" for="opt2">Option 2:</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" id="opt2" placeholder="Enter Option 2.." name="opt2" >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2" for="opt3">Option 3:</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" id="opt3" placeholder="Enter Option 3.." name="opt3" >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2" for="ans">Answer:</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" id="ans" placeholder="Enter Answer.." name="ans" >
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
					var levelid=$('#level').val();
					var ques=$('#question').val();
					var opt1=$('#opt1').val();
					var opt2=$('#opt2').val();
					var opt3=$('#opt3').val();
					var tans=$('#ans').val();
					if(ques.length>0&&opt1.length>0&&opt2.length>0&&opt3.length>0&&tans.length>0){
						$.ajax({
						url:'admin_add1.php',
						type:'post',
						data:{
							'level':levelid,
							'question':ques,
							'op1':opt1,
							'op2':opt2,
							'op3':opt3,
							'true_ans':tans,
						},
						success: function(response){
							if(response==1){
								$('.alert-success').show().delay(200).fadeOut(3500);
								
							}
							else{
								$('.alert-danger').show().delay(200).fadeOut(3500);
								
							}
						}
					});
					}
					else{
						alert("Please fill all the fields");
					}
					
				});
			});
			
		</script>
	</body>
</html>