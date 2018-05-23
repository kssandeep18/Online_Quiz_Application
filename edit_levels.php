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
						<li><a href="add_subject.php">Edit Subject</a></li>
						<li class="active"><a href="edit_levels.php">Edit Level</a></li>
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
						<div class="form-group">
						<label class="control-label col-sm-2">Courses:</label>
						<div class="col-lg-7">
						<select class="form-control" id="subj" name="subj">
						<option value="0" hidden>Select Course</option>
						<?php
							$query="SELECT * FROM sub_list";
		               		$result=mysqli_query($con,$query);
		               		while($row=mysqli_fetch_row($result)){
		               			echo "<option value='$row[0]'>$row[1]</option>";
		               		}	
						?>
						</select>
						</div>
						</div>
						<table class="table table-bordered table-hover table-responsive">
						<tbody>
						</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.alert-success,.alert-danger').hide();
			    $("#subj").change(function(){
              	var id=$(this).val();
              	console.log(id);
              	$.ajax({
                type:'get',
                url:'edit_contents.php',
                dataType:'json',
                data:{
                  'id':id,
                  'no':'1',
                },
                success:function(response){
                	console.log(response);
					if(response=="0"){

							$('tbody').html("<h4 class='text-center'>No levels available for the selected course!</h4>");
					}
					else{
							$('h4').remove();
							$('tbody').empty();
							$.each(response , function(i,k){
								$('tbody').append($('<tr id=row-'+response[i].level_id+'>').append('<td>'+response[i].level_names+'</td>').append("<td><button type='button' name='button' id='"+response[i].level_id+"'class='btn btn-danger'>Delete</button></td>"));
								$('.btn-danger').click(function(){
								 var id=$(this).attr("id");
									$.ajax({
										type:'get',
										url:'edit_contents.php',
										data:{
											'level_id':id,
										},
										success:function(response){
											if(response==1){
												$('.alert-success').removeClass('hide');
											 $('.alert-success').show().delay(200).fadeOut(1500);
												var row='row-'+id;
												$("#"+row).remove();
											}
											else{
												$('.alert-danger').removeClass('hide');
												$('.alert-danger').show().delay(200).fadeOut(1500);
											}
										}
									});
							 });
							});
					}
                },
                error:function(response){
                	console.log(response);
                }
              });
           });
			});
		</script>
	</body>
</html>