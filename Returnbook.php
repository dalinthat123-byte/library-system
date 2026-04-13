<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Returnbook</title>
    
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
            <h5 class="mb-4">Returned Books List</h5>

            <?php
            require("db.php");

            // Initialize variables
            $text = "";
            $filterby = "title";
            $where_clause = "";

            // Handle Search Button
            if (isset($_POST["btnsearch"]) && !empty($_POST['txtsearch'])) {
                $text = $_POST['txtsearch'];
                $filterby = $_POST['filterby'];

                switch ($filterby) {
                    case 'name': 
                        $where_clause = " WHERE name LIKE CONCAT('%', ?, '%')"; 
                        break;
                    case 'isbn': 
                        $where_clause = " WHERE isbn = ?"; 
                        break;
                    case 'title': 
                        $where_clause = " WHERE title LIKE CONCAT('%', ?, '%')"; 
                        break;
                    case 'returndate': 
                        $where_clause = " WHERE returndate LIKE CONCAT(?, '%')"; 
                        break;
                }
            }

            // Handle Reset Button
            if (isset($_POST["btnreset"])) {
                $text = "";
                $filterby = "title";
                $where_clause = "";
            }
            ?>

            <form method="post" class="mb-3">
                <input type="radio" name="filterby" id="rbtName" value="name" <?php echo($filterby=='name' ? 'checked' : '') ?>>
                <label for="rbtName" class="me-2">Member Name</label>
                
                <input type="radio" name="filterby" id="rbtIsbn" value="isbn" <?php echo($filterby=='isbn' ? 'checked' : '') ?>>
                <label for="rbtIsbn" class="me-2">Isbn</label>
                
                <input type="radio" name="filterby" id="rbtTitle" value="title" <?php echo($filterby=='title' ? 'checked' : '') ?>>
                <label for="rbtTitle" class="me-2">Title</label>
                
                <input type="radio" name="filterby" id="rbtDate" value="returndate" <?php echo($filterby=='returndate' ? 'checked' : '') ?>>
                <label for="rbtDate" class="me-2">Date</label>

                <input type="text" name="txtsearch" value="<?php echo($text) ?>" placeholder="Search...">

                <input type="submit" name="btnsearch" value="Search" class='btn btn-sm btn-primary'>
                <input type="submit" name="btnreset" value="Reset" class='btn btn-sm btn-secondary'>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Returnid</th>
                            <th>Member Name</th>
                            <th>Isbn</th>
                            <th>Title</th>
                            <th>Staff Name</th>
                            <th>Borrowed Date</th>
                            <th>Returned Date</th>
                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM vreturned" . $where_clause . " ORDER BY returnid ASC";
                        $stmt = $conn->prepare($sql);

                        if (!empty($where_clause)) {
                            $stmt->bind_param('s', $text);
                        }

                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["returnid"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["isbn"] . "</td>";
                            echo "<td>" . $row["title"] . "</td>";
                            echo "<td>" . $row["staffname"] . "</td>";
                            echo "<td>" . $row["borrowdate"] . "</td>";
                            echo "<td>" . $row["returndate"] . "</td>";
                            echo "<td class='text-center'>
                                <div class='btn-group'>
                                    <a href='EditReturnbook.php?returnid=" . $row["returnid"] . "' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i> Edit</a>
                                </div>
                            </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <p>
                    <a href="Addreturnbook.php" class="btn btn-sm btn-success">AddNew</a>
                </p>
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