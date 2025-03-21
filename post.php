<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Refresh:0; url=index.html");
}

if (isset($_GET["title"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forum";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if (str_contains($_GET['title'], "'") || str_contains($_GET['text'], "'")) {
        echo "Your post contains invalid characters!";
        die();

    } else {
        $sql = "INSERT INTO posts (title,text,creator,time) VALUES ('" . $_GET['title'] . "','" . $_GET['text'] . "','" . $_SESSION['username'] . "',now())";
        $result = $conn->query($sql);
        
        header("Location: forums.php");
        die();
    }

} else {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forum";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM `posts` WHERE id=" . $_GET["post"];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8' />
                    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                    <title>" . $row["title"] . "</title>
                    <link rel='stylesheet' href='style.css' />
                </head>
                <html>
                    <body>
                        <form action='forums.php' method='post'>
                            <input type='submit' value='Till startsidan'>
                        </form>  <br>  
                    ";
        echo $row["creator"] . " la upp " . $row["title"] . ": ";
        echo $row["text"]; ?>
        


                <!-- <form action="addComment.php" method="POST">
                    <input type="text" name="comment" placeholder="Skriv en kommentar">
                    <input type="submit" value="Skapa kommentar">
                </form> -->
                <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
                <form action="post.php" target="dummyframe">
                    <input type="text" name="comment" id="comment" placeholder="Skriv en kommentar">
                    <input type="submit" onclick="accessCommentScript()" value="Skapa kommetar">
                </form>
                <!-- <button type="button" onclick="accessCommentScript()">Skapa kommentar</button> -->
            </body>
        <script>
                function accessCommentScript() {
                    const urlParams = new URLSearchParams(window.location.search);
                    const postID = urlParams.get('post');
                    let comment_content = document.getElementById('comment').value;
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        console.log(this.responseText);
                    }
                    xhttp.open("GET", "addComment.php?post="+postID+"&comment="+comment_content,true);
                    xhttp.send();
                    location.reload();
                }

            </script>
        </html>



        <?php
        $sql = "SELECT * FROM `comments` WHERE postID=" . $_GET["post"];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "Kommentarer: ";
            while($row = $result->fetch_assoc()) {
                echo "
                <html>
                    <body>
                        <div>"
                            . $row["user"] . " sa: " . $row["text"] . " (" . $row["time"] . ")
                        </div>
                    </body>
                </html>
                ";
            }
        }
    }
}
$conn->close();
?>