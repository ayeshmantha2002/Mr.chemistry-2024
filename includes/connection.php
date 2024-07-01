<?php
$dbhost      =   "localhost";
$dbuser      =   "mrchemis_mr-chemistry";
$dbpassword  =   "qHDCLNKBbYKapi0";
$dbname      =   "mrchemis_mr-chemestry";

$connection =   mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$connection) {
    echo "Error";
}

session_start();
