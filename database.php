<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hospital";
$conn = "";


$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// try {
//     $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
// } catch (mysqli_sql_exception) {
//     echo "Could not connect!";
// }

?>