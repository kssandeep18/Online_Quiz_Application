<?php
if(!isset($_SESSION)){
	session_start();
}
include "db.php";
if(isset($_POST['levels'])){
	$subid=$_POST['subj'];
	$level_id=$_POST['levels'];
		$_SESSION['level']=$_POST['levels'];
}
else{
echo"<script>window.alert('Please Login to Take Test');
window.location.href='http://localhost/quiz/';
</script>";
exit;
}
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
						<li><a href="#"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Results</a></li>
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
				<div class="panel-body"><br/><br/>
					<form action="check_ans.php" method="post">
						<?php
							$query="SELECT * FROM questions WHERE level_id='$level_id' ORDER BY q_id ASC";
							$result=mysqli_query($con,$query);
							$count=mysqli_num_rows($result);
							if($count<1){
								echo"<script>window.alert('No Questions Available for the Selected Subject-Level');
								window.location.href='http://localhost/quiz/sublist.php';
								</script>";
								exit;
							}
						$c=1;$k=1;
						while($row=mysqli_fetch_row($result)){
						?>
						
						<div class="col-lg-12 queslist" id="ques_<?php echo $c; ?>">
							<h2 class="text-center">Questions</h2>
							<h3><?php echo"$c. "; echo"$row[2]"; ?></h3>
							<input type="radio" name="<?php echo $row[0]; ?>" value="<?php echo $row[3]; ?>"/> <?php echo"$row[3]"; ?><br/>
							<input type="radio" name="<?php echo $row[0]; ?>" value="<?php echo $row[4]; ?>"/> <?php echo"$row[4]"; ?><br/>
							<input type="radio" name="<?php echo $row[0]; ?>" value="<?php echo $row[5]; ?>"/> <?php echo"$row[5]"; ?><br/><br/>
							<input type="radio" checked='checked' style='display:none' value="unanswered" name="<?php echo $row[0];?>"/>
							<?php
								if($c==1 && $c==$count){
									echo "<button type='button' class='btn btn-success next finish'>Submit Test</button>";
								}
								else if($c==1){
									echo "<button type='button' class='btn btn-success next' id='$c'>Next</button>";
								}
								else if($c>1 && $c<$count){
									echo "<button type='button' class='btn btn-success prev' id='$c'>Previous</button>&nbsp;&nbsp;";
										echo "<button type='button' class='btn btn-success next' id='$c'>Next</button>";
								}
								else if($c==$count){
									echo "<button type='button' class='btn btn-success prev' id='$c'>Previous</button> &nbsp;&nbsp;";
										echo "<button type='button' class='btn btn-success finish'>Submit Test</button>";
								}
						echo "</div>";
						$c++;
						}
						?>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			$('document').ready(function(){
				$('.queslist').addClass('hide');
		if(<?php echo $k; ?>==1){
		$('#ques_1').removeClass('hide');
		}
		$('.next').click(function(){
		var cur=parseInt($(this).attr('id'));
		var nextt=cur+1;
		$('#ques_'+cur).addClass('hide');
		$('#ques_'+nextt).removeClass('hide');
		console.log(<?php echo $k; ?>);
		});
		$('.prev').click(function(){
		var present=parseInt($(this).attr('id'));
		var prev=present-1;
		$('#ques_'+present).addClass('hide');
		$('#ques_'+prev).removeClass('hide');
		});
		$('.finish').click(function(){
		$('form').submit();
		});
		
		});
		
		</script>
	</body>
</html>