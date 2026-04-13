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
                <span class="stat-number"><?php echo $totalStaff; ?></span>
            </div>
            <div class="progress-container">
                <div class="progress-fill" style="width: 100%; background-color: #80cbc4;"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-header">
                <span>Active Members</span>
                <span class="stat-number"><?php echo $totalMembers; ?></span>
            </div>
            <div class="progress-container">
                <div class="progress-fill" style="width: 100%; background-color: #4db6ac;"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-header">
                <span>Books in Catalog</span>
                <span class="stat-number"><?php echo number_format($totalBooks); ?></span>
            </div>
            <div class="progress-container">
                <div class="progress-fill" style="width: 100%; background-color: #ce93d8;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="dashboard">
        <div class="card" style="background-color: #ffffff;">
            <a href="staff.php"><div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="card-title">View Staff</div></a>
        </div>

        <div class="card" style="background-color: #ffffff;">
            <a href="member.php"><div class="card-icon"><i class="fas fa-users"></i></div>
            <div class="card-title">View Members</div></a>
        </div>

        <div class="card" style="background-color: #ffffff;">
             <a href="book.php"><div class="card-icon"><i class="fa-solid fa-book-bookmark"></i></div>
            <div class="card-title">View Books</div></a>
        </div>

        <div class="card" style="background-color: #ffffff;">
             <a href="Borrowedbook.php"><div class="card-icon"><i class="fas fa-book-open"></i></div>
            <div class="card-title">Borrowed Books Record</div></a>
        </div>

        <div class="card" style="background-color: #ffffff;">
             <a href="returnbook.php"><div class="card-icon"><i class="fas fa-book-reader"></i></div>
            <div class="card-title">Returned Books Record</div></a>
            
        </div>
                <div class="card" style="background-color: #ffffff;">
             <a href="Nonreturnedbook.php"><div class="card-icon"><i class="fa-solid fa-book-journal-whills"></i></div>
            <div class="card-title">Non-Returned Books</div></a>
        </div>
    </div>

    <!--Footer-->
   <div class="container"> 
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center"> 
            <a href="index.php" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1"> 
                <i class="fa-solid fa-book-bookmark" style="font-size: 24px;"></i>
            </a> 
            <span class="mb-3 mb-md-0 text-body-secondary">© 2026 Library Management System</span> 
        </div> 

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex"> 
            <li class="ms-3">
                <a class="text-body-secondary" href="book.php" title="View Books">
                    <i class="fa-solid fa-book-atlas" style="font-size: 24px;"></i>
                </a>
            </li> 
            <li class="ms-3">
                <a class="text-body-secondary" href="member.php" title="View Members">
                    <i class="fa-regular fa-address-card" style="font-size: 24px;"></i>
                </a>
            </li> 
        </ul> 
    </footer> 
</div>

</div>
</body>
</html>