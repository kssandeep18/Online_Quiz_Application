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
                  <li>
                     <h4 style="color:white; line-height:1.5">Welcome <?php echo $_SESSION['admin'];?></h4>
                  </li>
                  <li><a href="logout2.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="container">
         <div class="panel panel-default">
            <div class="panel-body">
               <ul class="nav nav-pills">
                  <li><a href="edit_subject.php">Edit Subject</a></li>
                  <li><a href="edit_levels.php">Edit Level</a></li>
                  <li class="active"><a href="edit_questions.php">Edit Question</a></li>
               </ul>
               <br/><br/>
               <div class="alert alert-success alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <strong>Success!</strong> Question Successfully Deleted!
               </div>
               <div class="alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <strong>Error!</strong> Sorry,Couldn't Delete the Question!
               </div>
               <form class="form-horizontal" action="" method="post">
                  <div class="form-group">
                     <label class="control-label col-sm-2">Courses:</label>
                     <div class="col-lg-7">
                        <select class="form-control" id="subj" name="subj">
                           <option value="0" selected hidden>Select Course</option>
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
                  <div class="form-group">
                     <label class="control-label col-sm-2">Level:</label>
                     <div class="col-lg-7">
                        <select class="form-control" id="level" name="level">
                           <option value="0" selected hidden>Select Level</option>
                           <option value="1">Easy</option>
                           <option value="2">Medium</option>
                           <option value="3">Hard</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btn1" class="btn btn-success" id="btn1">Submit</button>
                     </div>
                  </div>
                  <table class="table table-bordered table-hover table-responsive">
                  <thead>
                  <tr>
                     <th>Question</th>
                     <th>Option1</th>
                     <th>Option2</th>
                     <th>Option3</th>
                     <th>Answer</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
               </form>
            </div>
         </div>
      </div>
   </body>

<script type="text/javascript">
    $(document).ready(function() {
      $('.alert-success,.alert-danger').hide();
        $("#btn1").click(function(e) {
            e.preventDefault();
            var level = $('#level option:selected').text();
            var sub = $('#subj option:selected').text();
            if ($('#level').val() > 0 && $('#subj').val() > 0) {
                $.ajax({
                    type: 'get',
                    url: 'edit_contents.php',
                    dataType: 'json',
                    data: {
                        'name':level+'-'+sub,
                    },
                    success: function(response) {
                        if (response == '0') {
                            $('.ind').remove();
                            $('tbody').html("<h4 class='text-center ind'>No questions available for the selected course and level!</h4>");
                        } else {
                            $('.ind').remove();
                            $.each(response, function(i, k) {
                                $('tbody').append($('<tr class=ind id=' + response[i].q_id + '>').append('<td>' + response[i].question + '</td>').append('<td>' + response[i].option1 + '</td>').append('<td>' + response[i].option2 + '</td>').append('<td>' + response[i].option3 + '</td>').append('<td>' + response[i].answer + '</td>').append("<td><button type='button' name='button' id='" + response[i].q_id + "' class='btn btn-danger'>Delete</button></td>"));
                            });
                            $('.btn-danger').click(function() {
                                var ques_id = $(this).attr('id');
                                $.ajax({
                                    type: 'get',
                                    url: 'edit_contents.php',
                                    data: {
                                        'ques_id': ques_id,
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        if (response == '1') {
                                            $('.alert-success').removeClass('hide');
                                            $('.alert-success').show().delay(200).fadeOut(1500);
                                            $("#" +ques_id).remove();
                                        } else {
                                            $('.alert-danger').removeClass('hide');
                                            $('.alert-danger').show().delay(200).fadeOut(1500);
                                        }
                                    },
                                    error:function(response){
                                       console.log(response);
                                    }
                                });
                            });
                        }
                    },
                    error:function(response){
                      console.log(response);
                    }
                });
            } else {
                alert("Please select all the fields!");
            }
        });
    });
</script>
</html>