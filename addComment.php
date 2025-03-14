<?php
// echo "yay";

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "INSERT INTO comments (postID,user,text,time) VALUES ('" . $_REQUEST['post'] . "','" . $_SESSION['username'] . "','" . $_REQUEST["comment"] . "',now())";
$result = $conn->query($sql);
$conn->close();
?>