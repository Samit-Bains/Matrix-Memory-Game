<?php
	include("session.php");
	if (isset($_GET["ID"])){
		$_SESSION['user_name'] = $_GET["ID"];
	}
	if (!isset($_SESSION['user_name'])){
		header("Location: http://localhost:3000/dashboard");
		
	}
	
		
	
    //Test comment
    $servername = "remotemysql.com";
    $username = "WuCiVprOyc";
    $password = "o3omkCQO3a";
    $dbname = "WuCiVprOyc";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT userName FROM users WHERE userName = 'jack'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $username = $row['userName'];
    $conn->close();
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Memory Game</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body onload="initialize()">
    <div id="initialpage" class="firstpage">
        <nav class="navbar navbar-expand-sm bg-warning navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_name'] ?></a>
                </li>
            </ul>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../CoreApp/views/home.ejs">Home Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:3000/logout">Log out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div> 
	<center>
        <div id="container">  
            <div  id="rotate" class="createMatrix"></div>
            <div id="beginning" class="interrupt beginning">
                <p onclick="createMatrix();startStop();">Click Here</p>
            </div>      
            <div id="resultScreen" class="interrupt resultScreen">
                <div>
					<div id="beginning" class=" beginning">
						<p id="next" class="alert" onclick="nextlevel()">Next</p>
					</div>
                        <p id="fail" class="alert" onclick="javascript:location.href='html/summary.php'">GG</p>
                    <p id="end" class="alert">End</p>
                </div>
            </div>
            <br>        
            <div> <a href= "html/summary.php"> <button type= "button" class="btn btn-info " >End Game</button></a></div>
            <div>
			<div class="container">

  


    </div>
                <span id="points" class="points badge badge-pill badge-primary badge-">Current Points : 0</span>
				<span id="lives" class="lives badge badge-pill badge-danger">Current Lives : 3</span>
            </div>
        </div> 
    </center>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/memorygame.js"></script>
	
	<script type="text/javascript" src="js/script.js"></script>
	
	<audio id="sound" src="sounds/sound.ogg"></audio>
</body>
</html>
