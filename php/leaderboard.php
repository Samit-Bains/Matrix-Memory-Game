<?php
	include("../session.php");
	if (!isset($_SESSION['user_name'])){
	header("Location: http://localhost:3000/dashboard");
	}
   $servername = "remotemysql.com";
   $username = "WuCiVprOyc";
   $password = "o3omkCQO3a";
   $dbname = "WuCiVprOyc";
   
   $name= "";
   $score= "";
   
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   } 
   
  
	
   $sql = "SELECT name, score FROM leaderboard ORDER BY score DESC LIMIT 5";
   $result = $conn->query($sql);
   
   $data=array();
   $count = 0; 
   while ($row_data=mysqli_fetch_array($result)){
   	$data[$count]=array($row_data);
   	$count++;
   }
   
   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
           echo "name: " . $row["name"]. " - score: " . $row["score"]. "<br>";
       }
   } else {
       echo "0 results";
   }
   $conn->close();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <title>LeaderBoard</title>
      <link rel="stylesheet" href="../styles/style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   </head>
   <body>
    <nav class="navbar navbar-expand-sm bg-warning navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_name'] ?></a>
                </li>
            </ul>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../CoreApp/views/home.ejs">Home Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:3000/logout">Log out</a>
                    </li>
                </ul>
            </div>
        </nav>
      <center>
         <p class="text-warning" id="leaderboard">LeaderBoard</p>
      </center>
      <div id="mytable" class="container">
         <table class="table table-dark table-striped">
            <thead>
               <tr>
                  <th class="text-warning">User</th>
                  <th class="text-warning">Score</th>
               </tr>
               <?php 
                  foreach($data as $member){
                                            echo '<tr>
                                                <td>' .  ($member)[0][0] . '</td>' .
                                                '<td>' .  ($member)[0][1] . '</td>' .
                                            '</tr>';}?>
            </thead>
         </table>
      </div>
      <div> <a href= "../index.php"> <button type="button" class="btn btn-outline-primary" id="restartbtn">Restart</button></a></div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   </body>
</html>