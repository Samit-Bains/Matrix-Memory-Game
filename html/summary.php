
<?php 
include("../session.php");
if (!isset($_SESSION['user_name'])){
		header("Location: http://localhost:3000/dashboard");
		
	}?> 


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<title>Example of Auto Loading Bootstrap Modal on Page Load</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
</head>
<body>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
				
                <h4 class="modal-title text-danger">Do you want to go to the leaderboard? </h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
				<div class="container-fluid">
            
            <form action="../php/app.php" method="POST">
			<input type="hidden"  name="Name" value="<?php echo $_SESSION['user_name']?>"><br>
                  <div id="myform"></div>
                <input type="submit" class="btn btn-primary "value="Submit">
				
				<a href= "../index.php"> <button type= "button" class="outerButton btn btn-warning" >Restart</button></a>
				
            </form>
            
        </div>
            </div>
        </div>
    </div>
</div>
<script>
		console.log(localStorage.getItem("score"));
		document.getElementById("myform").innerHTML= '<input type="hidden" name="score" value="' + localStorage.getItem("score")+'">'
	</script>
</body>
</html>                            