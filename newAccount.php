<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);

$user_password = hash('sha3-512' , $_REQUEST['pass']);

$sql = "INSERT INTO users (username,password) VALUES ('" . $_REQUEST['username'] . "','" . $user_password . "')";
$result = $conn->query($sql);
$conn->close();

echo "success";
?>