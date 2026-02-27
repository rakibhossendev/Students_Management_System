<?php
$username = "127.0.0.1";
$localhost = "root";
$password = "1234";
$db_name = "student_system";

$conn = mysqli_connect($username,$localhost,$password,$db_name);

if(!$conn){
    die("Connection Failed!: ",mysqli_connect_error());
}

mysqli_set_charset($conn,"utf8mb4");
?>