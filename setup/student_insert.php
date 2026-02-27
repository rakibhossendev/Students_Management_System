<?php
require "../config/db.php";

// Assuming department_id = 1 is CSE
$insertStudent = "INSERT INTO students (first_name, last_name, email, phone, department_id) 
VALUES ('Sanjida', 'Aktar', 'sanjidaapu@gmail.com', '01812345678', 1)";

mysqli_query($conn, $insertStudent);
echo "Sample student inserted!";
?>