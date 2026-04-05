<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "ict";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die ("Error: " . mysqli_error($conn));
}





?>