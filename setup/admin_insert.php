<?php
require "../config/db.php";

$password = password_hash("admin123",PASSWORD_DEFAULT);

$insertAdmin = "INSERT INTO admins (name, email, password) VALUES 
('Super Admin', 'admin@example.com', '$password')";

if(mysqli_query($conn, $insertAdmin)){
    echo "Admin inserted successfully!";
}else{
    echo "Error: " . mysqli_error($conn);
}
?>