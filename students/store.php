<?php
require "../partials/auth_check.php";
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

// Collect & sanitize
$first_name     = trim($_POST['first_name']);
$last_name      = trim($_POST['last_name']);
$email          = trim($_POST['email']);
$phone          = trim($_POST['phone']);
$department_id  = intval($_POST['department_id']);

// Basic validation
if (empty($first_name) || empty($department_id)) {
    die("Required fields missing.");
}

// Check department exists & active
$checkDept = $conn->prepare("SELECT id FROM departments WHERE id = ? AND status = 'active'");
$checkDept->bind_param("i", $department_id);
$checkDept->execute();
$checkDept->store_result();

if ($checkDept->num_rows === 0) {
    die("Invalid department selected.");
}

// Insert student
$stmt = $conn->prepare("
    INSERT INTO students 
    (first_name, last_name, email, phone, department_id, status, created_at) 
    VALUES (?, ?, ?, ?, ?, 'active', NOW())
");

$stmt->bind_param(
    "ssssi",
    $first_name,
    $last_name,
    $email,
    $phone,
    $department_id
);

if ($stmt->execute()) {
    header("Location: index.php?success=Student added successfully");
    exit();
} else {
    die("Something went wrong.");
}