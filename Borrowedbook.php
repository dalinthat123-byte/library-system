<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Borrowed Books</title>

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="styles/layout.css" rel="stylesheet">
</head>
<body>
    <?php include("includes/Sidebar.php"); ?>
    <div class="main">
        <?php include("includes/Topbar.php"); ?>
        <div class="card-box">
            <h5>Borrowed Books List</h5>
            
            <?php 
                $text = isset($_POST['txtsearch']) ? $_POST['txtsearch'] : null; 
                $filterby = isset($_POST['filterby']) ? $_POST['filterby'] : 'Title'; 
            ?>

            <form method="post">
                <input type="radio" name="filterby" id="rbtIsbn" value="Isbn" <?php echo($filterby=='Isbn' ? 'checked' : '') ?>>
                <label for="rbtIsbn">Isbn</label>
                
                <input type="radio" name="filterby" id="rbtTitle" value="Title" <?php echo($filterby=='Title' ? 'checked' : '') ?>>
                <label for="rbtTitle">Title</label>
                
                <input type="radio" name="filterby" id="rbtBorrowedDate" value="BorrowedDate" <?php echo($filterby=='BorrowedDate' ? 'checked' : '') ?>>
                <label for="rbtBorrowedDate">Date</label>

                <input type="text" name="txtsearch" value="<?php echo($text) ?>" placeholder="Search here...">
                
                <input type="submit" name="btnsearch" value="Search" class='btn btn-sm btn-primary'>
                <input type="submit" name="btnreset" value="Reset" class='btn btn-sm btn-secondary'>
            </form>

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
                    
                    $sql = "SELECT * FROM vborrowed";
                    $where_clause = "";

                    if(isset($_POST["btnsearch"]) && !empty($text)){
                        switch($filterby){
                            case 'Isbn': 
                                $where_clause = " WHERE Isbn = ?"; 
                                break;
                            case 'Title': 
                                $where_clause = " WHERE Title LIKE CONCAT('%', ?, '%')"; 
                                break;
                            case 'BorrowedDate': 
                                $where_clause = " WHERE BorrowDate LIKE CONCAT(?, '%')"; 
                                break;
                        }
                    }

                    $sql .= $where_clause . " ORDER BY BorrowID ASC";
                    $stmt = $conn->prepare($sql);

                    if(!empty($where_clause)){
                        $stmt->bind_param('s', $text);
                    }

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
                        echo "<td align='center' width='1%' style='white-space: nowrap;'>
                            <a href='Editborrowedbook.php?BorrowID=" . $row["BorrowID"] . "' class='btn btn-sm text-white' style='background-color: #15317E;'><i class='fa-solid fa-pen-to-square'></i></a>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <p>
                <a href="Addborrowedbook.php" class="btn btn-sm btn-success"><i class='fa-solid fa-plus'></i> AddNew</a>
            </p>
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