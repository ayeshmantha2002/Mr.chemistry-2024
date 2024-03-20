<?php
$dbhost      =   "localhost";
$dbuser      =   "root";
$dbpassword  =   "";
$dbname      =   "mr-chemistry";

$connection =   mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$connection) {
    echo "Error";
}

session_start();
