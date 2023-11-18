<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define("DB_NAME", 'shopping');

/*Attempt to connect to MYSQL database*/
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} /* else {
    echo "Connected successfully"; 
}*/
?>

