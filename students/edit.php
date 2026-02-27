<?php
require "../partials/auth_check.php";
require "../config/db.php";

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

// Get student
$stmt = $conn->prepare("
    SELECT id, first_name, last_name, email, phone, department_id 
    FROM students 
    WHERE id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$student = $result->fetch_assoc();

// Get active departments
$deptQuery = "SELECT id, name FROM departments WHERE status='active' ORDER BY name ASC";
$departments = mysqli_query($conn, $deptQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid px-3">
        <span class="navbar-brand mb-0 h1">Edit Student</span>
        <a href="index.php" class="btn btn-sm btn-outline-light">Back</a>
    </div>
</nav>

<div class="container-sm mt-4 px-3 px-md-4">

    <div class="card shadow-sm">
        <div class="card-body p-3 p-md-4">

            <form action="update.php" method="POST">

                <input type="hidden" name="id" value="<?= $student['id'] ?>">

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name"
                               class="form-control"
                               value="<?= htmlspecialchars($student['first_name']) ?>"
                               required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name"
                               class="form-control"
                               value="<?= htmlspecialchars($student['last_name']) ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control"
                               value="<?= htmlspecialchars($student['email']) ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone"
                               class="form-control"
                               value="<?= htmlspecialchars($student['phone']) ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Department</label>
                        <select name="department_id" class="form-select" required>
                            <option value="">Select Department</option>

                            <?php while($dept = mysqli_fetch_assoc($departments)): ?>
                                <option value="<?= $dept['id'] ?>"
                                    <?= $dept['id'] == $student['department_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($dept['name']) ?>
                                </option>
                            <?php endwhile; ?>

                        </select>
                    </div>

                    <div class="col-12 d-grid d-md-flex gap-2">
                        <button class="btn btn-primary">Update</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>