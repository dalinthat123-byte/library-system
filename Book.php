<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Books</title>

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
<?php include("includes/Topbar.php"); ?>

<?php include("includes/Statistic.php"); ?>
<div class="card-box">
<?php $text = isset($_POST['txtsearch']) ? $_POST['txtsearch'] : null; ?>
<?php $filterby = isset($_POST['filterby']) ? $_POST['filterby'] : null; ?>
<form method="post">
<input type="radio" name="filterby" id="rbtIsbn" value="Isbn" <?php echo($filterby=='Isbn' ? 'checked' : null) ?>>
<label for="rbtIsbn">Isbn</label>
<input type="radio" name="filterby" id="rbtTitle" value="Title" <?php echo($filterby=='Title' ? 'checked' : null) ?>>
<label for="rbtTitle">Title</label>
<input type="radio" name="filterby" id="rbtAuthor" value="Author" <?php echo($filterby=='Author' ? 'checked' : null) ?>>
<label for="rbtAuthor">Author</label>
<input type="text" name="txtsearch" value="<?php echo($text) ?>">
<input type="submit" name="btnsearch" value="Search" class='btn btn-sm btn-primary'>
<input type="submit" name="btnreset" value="Reset" class='btn btn-sm btn-secondary'>
<input type="submit" name="btnavailable" value="Available" class='btn btn-sm btn-primary'>
<input type="submit" name="btnborrowed" value="Borrowed Books" class='btn btn-sm btn-primary'>
</form>
<table class="table table-bordered table-hover mt-3">
<thead>
<tr>
<th>Isbn</th>
<th>Title</th>
<th>Author</th>
<th>Status</th>
<th>Options</th>
</tr>
</thead>
<tbody>
<?php
require("db.php");
$sql = "SELECT * FROM tblbook";
$stmt = null;

if(isset($_POST["btnsearch"])){
    switch($filterby){
        case 'Isbn': $sql .= " WHERE Isbn=?"; break;
        case 'Title': $sql .= " WHERE Title LIKE CONCAT('%',?,'%')"; break;
        case 'Author': $sql .= " WHERE Author LIKE CONCAT('%',?,'%')"; break;
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $text);
} elseif(isset($_POST["btnavailable"])) {
    $sql .= " WHERE Status = 'Available'";
    $stmt = $conn->prepare($sql);
} elseif(isset($_POST["btnborrowed"])) {
    $sql .= " WHERE Status = 'Borrowed'";
    $stmt = $conn->prepare($sql);
} else {
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row["Isbn"] . "</td>";
    echo "<td>" . $row["Title"] . "</td>";
    echo "<td>" . $row["Author"] . "</td>";
    echo "<td>" . $row["Status"] . "</td>";
    echo "<td>
        <a href='Editbook.php?Isbn=" . $row["Isbn"] . "' class='btn btn-sm btn-warning'>Edit</a> | 
        <a href='Deletebook.php?Isbn=" . $row["Isbn"] . "' class='btn btn-sm btn-danger' 
        onclick='return confirm(\"Sure?\");'>Delete</a>
    </td>";
    echo "</tr>";
}
?>
</tbody>
</table>
<p>
<a href="Addbook.php" class="btn btn-sm btn-success">Add New Book</a>
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