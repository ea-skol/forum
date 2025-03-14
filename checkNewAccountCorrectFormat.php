<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT username FROM `users` WHERE username='" . $_REQUEST["username"] ."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Användarnamn är redan taget";
}
else {
    echo "username_free";
}

$conn->close();

?>