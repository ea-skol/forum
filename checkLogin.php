<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$user_password = hash('sha3-512' , $_POST["password"]);

$login_success = false;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if($row["username"] == $_POST["username"] && $row["password"] == $user_password) {
			    $login_success = true;
			}
	}
} else {
    failedLogin(); 
}

if (!$login_success) {
    failedLogin(); 
}
$conn->close();

function failedLogin() {
    echo "Inloggning misslyckades :(";
	echo "<br><br><a href='index.html'>Tillbaka till inlogg</a>";
}

if($login_success) {
	session_start();
	$_SESSION["username"] = $_POST["username"]; 
    header("Location: forums.php");
    die();
}

?>
