<?php

$db_server = "localhost";
$db_user = "root"; // Replace with your database username
$db_pass = ""; // Replace with your database password
$db_name = "player"; // Replace with your database name

try {
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);    
}
catch (mysqli_sql_exception) {
    echo "could not connect";
}

?>
