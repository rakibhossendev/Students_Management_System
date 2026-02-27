<?php
require "../config/db.php";

$departments = ["CST","ET","TC","ME"];

foreach($departments as $dept){
    mysqli_query($conn, "INSERT INTO departments (name) VALUES('$dept')");
    
}

echo "Departments inserted successfully!";
?>