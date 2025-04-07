<?php
session_start(); 
session_destroy(); 
echo "Du är utloggad!\n\n";
?>
<title>Utloggad</title>
<a href="index.html">Logga in</a>