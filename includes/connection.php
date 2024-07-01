<?php
$dbhost      =   "localhost";
$dbuser      =   "root";
$dbpassword  =   "";
$dbname      =   "mr-chemestry";

$connection =   mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$connection) {
    echo "Error";
}

session_start();
