<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Refresh:0; url=index.html");
    }
?>

<html>
    <body>
        <form action="post.php" method="get">
            <input type="text" name="title" placeholder="Titel">
            <input type="text" name="text" placeholder="Text">
            <input type="submit" name="submit" value="Skapa inlägg">
        </form>
        <a href="forums.php">Avrbyt</a>
    </body>
</html>