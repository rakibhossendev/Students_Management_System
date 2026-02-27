<?php
require "../partials/auth_check.php";
require "../config/db.php";

$query = "
    SELECT 
        s.id,
        s.first_name,
        s.last_name,
        s.email,
        s.phone,
        s.status,
        s.created_at,
        d.name AS department
    FROM students s
    JOIN departments d ON s.department_id = d.id
    ORDER BY s.created_at DESC
";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Students</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="bg-body-tertiary">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <span class="navbar-brand fw-bold text-primary">
            <i class="bi bi-mortarboard-fill me-2"></i>
            Student Management
        </span>
        <a href="../index.php" class="btn btn-sm btn-outline-primary rounded-pill">
            <i class="bi bi-speedometer2 me-1"></i>
            Dashboard
        </a>
    </div>
</nav>

<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-people-fill text-primary me-2"></i>
            Students List
        </h4>

        <a href="create.php" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-plus-circle me-1"></i>
            Add Student
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th></th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php $i = 1; while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="fw-semibold text-muted"><?= $i++ ?></td>

                                <td class="fw-semibold">
                                    <?= htmlspecialchars($row['first_name'].' '.$row['last_name']) ?>
                                </td>

                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-dark fw-normal">
                                        <?= htmlspecialchars($row['department']) ?>
                                    </span>
                                </td>

                                <td class="text-muted small">
                                    <?= htmlspecialchars($row['email']) ?>
                                </td>

                                <td class="text-muted small">
                                    <?= htmlspecialchars($row['phone']) ?>
                                </td>

                                <td>
                                    <?php if($row['status'] === 'active'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                                            <i class="bi bi-check-circle me-1"></i>Active
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                            <i class="bi bi-x-circle me-1"></i>Inactive
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-muted small">
                                    <?= date("d M Y", strtotime($row['created_at'])) ?>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="edit.php?id=<?= $row['id'] ?>"
                                           class="btn btn-sm btn-warning rounded-pill">
                                           <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="delete.php?id=<?= $row['id'] ?>"
                                           class="btn btn-sm btn-danger rounded-pill"
                                           onclick="return confirm('Are you sure?')">
                                           <i class="bi bi-trash"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                No students found
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>