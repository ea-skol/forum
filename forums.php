<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Refresh:0; url=index.html");
    }
?>

<html>
    <body>
        <form action="newPost.php" method="post">
            <input type="submit" value="Skapa nytt inlägg">
        </form>
        <form action="logOut.php">
            <input type="submit" value="Logga ut" />
        </form>
    </body>
</html>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
                <html>
                    <title>Forum</title>
                    <body>
                        <div style='display: flex;'>
                            <div>" .
                                $row["creator"] . " skapade " . $row["title"] . " (" . $row["time"] . ")
                                <a href='post.php?post=" . $row["id"] ."'>Gå till inlägg</a>
                            </div>
                        </div>
                    </body>
                </html>";
	}
}
$conn->close();
?>