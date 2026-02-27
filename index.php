<?php  
require "partials/auth_check.php";  
require "config/db.php";  
  
function getCount($conn,$sql){  
    $result = mysqli_query($conn,$sql);  
    $row = mysqli_fetch_assoc($result);  
    return $row['total'];  
}  

$totalStudents = getCount($conn, "SELECT COUNT(*) AS total FROM students");  
$activeStudents = getCount($conn, "SELECT COUNT(*) AS total FROM students WHERE status='active'");  
$inactiveStudents = getCount($conn, "SELECT COUNT(*) AS total FROM students WHERE status='inactive'");  
$totalDepartments = getCount($conn, "SELECT COUNT(*) AS total FROM  departments");  

$latestStudentsQuery = "  
    SELECT s.first_name, s.last_name, d.name AS department, s.created_at  
    FROM students s  
    JOIN departments d ON s.department_id = d.id  
    ORDER BY s.created_at DESC  
    LIMIT 5  
";  

$latestStudents = mysqli_query($conn, $latestStudentsQuery);  
?>  

<!DOCTYPE html>  
<html lang="en">  
<head>  
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>Dashboard</title>  

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">  
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">  

</head>  

<body class="bg-body-tertiary">

<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <span class="navbar-brand fw-bold fs-4 text-primary">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </span>

        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="fw-semibold text-dark">
                <i class="bi bi-person-circle me-1"></i>
                <?= htmlspecialchars($_SESSION['admin_name']); ?>
            </span>
            <a href="../auth/logout.php" class="btn btn-sm btn-outline-danger rounded-pill">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<div class="container py-4">

<div class="row g-4">

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted small mb-1">Total Students</p>
                    <h3 class="fw-bold"><?= $totalStudents ?></h3>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                    <i class="bi bi-people fs-4 text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted small mb-1">Active Students</p>
                    <h3 class="fw-bold text-success"><?= $activeStudents ?></h3>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                    <i class="bi bi-person-check fs-4 text-success"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted small mb-1">Inactive Students</p>
                    <h3 class="fw-bold text-warning"><?= $inactiveStudents ?></h3>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                    <i class="bi bi-person-x fs-4 text-warning"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted small mb-1">Departments</p>
                    <h3 class="fw-bold text-dark"><?= $totalDepartments ?></h3>
                </div>
                <div class="bg-dark bg-opacity-10 p-3 rounded-circle">
                    <i class="bi bi-building fs-4 text-dark"></i>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="card border-0 shadow-sm mt-5">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">
            <i class="bi bi-clock-history me-2 text-primary"></i>
            Latest Students
        </h5>
        <a href="students/index.php" class="btn btn-sm btn-primary rounded-pill">
            View All
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Joined</th>
                </tr>
            </thead>

            <tbody>
            <?php if(mysqli_num_rows($latestStudents) > 0): ?>  
                <?php while($s = mysqli_fetch_assoc($latestStudents)): ?>  
                <tr>
                    <td class="fw-semibold">
                        <?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?>
                    </td>
                    <td>
                        <span class="badge bg-secondary bg-opacity-10 text-dark">
                            <?= htmlspecialchars($s['department']) ?>
                        </span>
                    </td>
                    <td class="text-muted">
                        <?= date("d M Y", strtotime($s['created_at'])) ?>
                    </td>
                </tr>
                <?php endwhile; ?>  
            <?php else: ?>  
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        No students found
                    </td>
                </tr>
            <?php endif; ?>  
            </tbody>

        </table>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>