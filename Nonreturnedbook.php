<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Non-Returned Books</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <link href="styles/layout.css" rel="stylesheet">
</head>
<body>
    <?php include("includes/Sidebar.php"); ?>
    <div class="main">
        <?php include("includes/Topbar.php"); ?>
        <div class="card-box">
            <h5>Non-Returned Books List</h5>
            <table class="table table-bordered table-hover mt-3">
                <thead>
                    <tr>
                        <th>BorrowID</th>
                        <th>Name</th>
                        <th>Isbn</th>
                        <th>Title</th>
                        <th>Borrowed Date</th>
                        <th>Staff Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require("db.php");

                    $sql = "SELECT * FROM vnotreturned ORDER BY borrowid ASC";
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row["borrowid"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["isbn"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["borrowdate"] . "</td>";
                        echo "<td>" . $row["staffname"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
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