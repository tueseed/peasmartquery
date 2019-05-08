 <?php
 	$server = "us-cdbr-iron-east-02.cleardb.net";
    $username = "b4a190056925a9";
    $password = "2c6960b2";
    $db = "heroku_ea9f230e2c68254";
    $conn = new mysqli($server, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    mysqli_query($conn, "SET NAMES utf8");