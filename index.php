<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
<!-- Bootstrap -->
<link href="styles/bootstrap.min.css" rel="stylesheet">
<link href="styles/layout.css" rel="stylesheet">
</head>
<body>
<!-- Sidebar -->
<?php include("includes/Sidebar.php"); ?>
<!-- Main Content -->
<div class="main">
<!-- Topbar -->
<?php include("includes/topbar.php"); ?>
<!-- Cards -->
<?php include("includes/Statistic.php"); ?>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-header">
                <span>Total Staff</span>
                <span>12</span>
            </div>
            <div class="progress-container">
                <div class="progress-fill" style="width: 70%; background-color: #80cbc4;"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-header">
                <span>Active Members</span>
                <span>345</span>
            </div>
            <div class="progress-container">
                <div class="progress-fill" style="width: 85%; background-color: #4db6ac;"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-header">
                <span>Books in Catalog</span>
                <span>1,890</span>
            </div>
            <div class="progress-container">
                <div class="progress-fill" style="width: 60%; background-color: #ce93d8;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="dashboard">
        <div class="card" style="background-color: #d1c4e9;">
            <a href="staff.php"><div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="card-title">View Staff</div></a>
        </div>
        <div class="card" style="background-color: #aed581;">
            <a href="member.php"><div class="card-icon"><i class="fas fa-users"></i></div>
            <div class="card-title">View Members</div></a>
        </div>
        <div class="card" style="background-color: #fff176;">
             <a href="book.php"><div class="card-icon"><i class="fas fa-book-medical"></i></div>
            <div class="card-title">View Books</div></a>
        </div>
        <div class="card" style="background-color: #ff8a65;">
             <a href="borrowbook.php"><div class="card-icon"><i class="fas fa-book-open"></i></div>
            <div class="card-title">Borrowed Books</div></a>
        </div>
        <div class="card" style="background-color: #e57373;">
             <a href="returnbook.php"><div class="card-icon"><i class="fas fa-book-reader"></i></div>
            <div class="card-title">Returned Books</div></a>
        </div>
        <div class="card" style="background-color: #90a4ae;">
            <a href="report.php"><div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="card-title">Reports</div></a>
        </div>
        <div class="card" style="background-color: #81c784;">
             <a href="addstaff.php"><div class="card-icon"><i class="fas fa-book-reader"></i></div>
            <div class="card-title">Non-Returned Books</div></a>
        </div>
        <div class="card" style="background-color: #aed581;">
             <a href="aboutus.php"><div class="card-icon"><i class="fas fa-history"></i></div>
            <div class="card-title">About Us</div></a>
        </div>
        <div class="card" style="background-color: #ba68c8;">
             <a href="logout.php"><div class="card-icon"><i class="fas fa-sign-out-alt"></i></div>
            <div class="card-title">Sign Out</div></a>
        </div>
    </div>

    <div class="footer">
        Build Bright Library Management System
    </div>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>

</div>
</body>
</html>