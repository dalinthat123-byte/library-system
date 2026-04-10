<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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


    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <link href="styles/layout.css" rel="stylesheet">
</head>
<body>
<?php include("includes/Sidebar.php"); ?>
<div class="main">
<?php include("includes/Topbar.php"); ?>
<div class="card-box">
<h5>Edit Book Form</h5>
<?php
require("db.php");
$Isbn = $_GET['Isbn'];

if(!isset($_POST['btnsubmit'])){
    $sql = "SELECT * FROM tblbook WHERE Isbn=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Isbn);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($row = $result->fetch_assoc()){
?>
<form method="post">
    <div class="col-md-6 mb-3">
        <label class="form-label">ISBN</label>
        <input type="text" class="form-control" value="<?php echo $Isbn; ?>" disabled>
    </div>
    <div class="col-md-6 mb-3">
        <label for="Title" class="form-label">Title</label>
        <input type="text" class="form-control" name="Title" value="<?php echo $row['Title']; ?>" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="Author" class="form-label">Author</label>
        <input type="text" class="form-control" name="Author" value="<?php echo $row['Author']; ?>" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="Status" required>
            <option value="Available" <?php if($row['Status'] == 'Available') echo 'selected'; ?>>Available</option>
            <option value="Borrowed" <?php if($row['Status'] == 'Borrowed') echo 'selected'; ?>>Borrowed</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success" name="btnsubmit">Update Book</button>
    <a href="Book.php" class="btn btn-secondary">Cancel</a>
</form>
<?php 
    } 
} 

if(isset($_POST['btnsubmit'])){
    $Title = $_POST["Title"];
    $Author = $_POST["Author"];
    $Status = $_POST["Status"]; 

    $sql = "UPDATE tblbook SET Title=?, Author=?, Status=? WHERE Isbn=?";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("ssss", $Title, $Author, $Status, $Isbn);

    if($stmt->execute()){
        echo "<script>window.location.href='Book.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?> 
</div>
</div>
</body>
</html>