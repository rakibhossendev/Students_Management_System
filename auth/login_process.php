<?php
session_start();
require "../config/db.php";

$email    = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $admin = mysqli_fetch_assoc($result);

    if (password_verify($password, $admin['password'])) {
        $_SESSION['admin_id']   = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];

        header("Location: ../index.php");
        exit;
    }
}

$_SESSION['error'] = "Invalid email or password";
header("Location: login.php");
exit;

?>