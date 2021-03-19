<?php
    $servername = "remotemysql.com";
    $username = "WuCiVprOyc";
    $password = "o3omkCQO3a";
    $dbname = "WuCiVprOyc";

    $name= "";
    $score= "";

   if(isset($_POST['Name'])){
        $name=$_POST['Name'];
    }

    if(isset($_POST['score'])){
        $score=$_POST['score'];
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "INSERT INTO leaderboard (name, score) VALUES ('$name','$score')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("Location: leaderboard.php");
    die();

?>