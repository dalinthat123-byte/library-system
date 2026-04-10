<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Users</title>

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
            <h5>Borrowed Books List</h5>
            <table class="table table-bordered table-hover mt-3">
                <thead>
                    <tr>
                        <th>BorrowID</th>
                        <th>Member name</th>
                        <th>Isbn</th>
                        <th>Title</th>
                        <th>Staff name</th>
                        <th>Borrowed Date</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require("db.php");
                    
                    // FIXED: Added ORDER BY BorrowID ASC to keep the rows in a fixed order
                    $sql = "SELECT * FROM vborrowed ORDER BY BorrowID ASC";
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row["BorrowID"] . "</td>";
                        echo "<td>" . $row["MemberName"] . "</td>";
                        echo "<td>" . $row["Isbn"] . "</td>";
                        echo "<td>" . $row["Title"] . "</td>";
                        echo "<td>" . $row["StaffName"] . "</td>";
                        echo "<td>" . $row["BorrowDate"] . "</td>";
                        echo "<td>
                            <a href='Editborrowedbook.php?BorrowID=" . $row["BorrowID"] . "' class='btn btn-sm btn-warning'>Edit</a>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <p>
                <a href="Addborrowedbook.php" class="btn btn-sm btn-success">AddNew</a>
            </p>
        </div>
    </div>
</body>
</html>