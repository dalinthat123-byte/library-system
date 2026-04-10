<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Fredoka:wght@300..700&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <link href="styles/layout.css" rel="stylesheet">
</head>
<body>
<?php include("includes/Sidebar.php"); ?>
<div class="main">
    <?php include("includes/Topbar.php"); ?>

    <div class="card-box">
        <h5>Add New Book</h5>
        <form method="post">
            <div class="col-md-6 mb-3">
                <label class="form-label">ISBN</label>
                <input type="text" class="form-control" name="Isbn" required placeholder="Enter ISBN">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Book Title</label>
                <input type="text" class="form-control" name="Title" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Author Name</label>
                <input type="text" class="form-control" name="Author" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="Status" required>
                    <option value="Available">Available</option>
                    <option value="Borrowed">Borrowed</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-success" name="btnsubmit">Save Book</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>

<?php
if(isset($_POST['btnsubmit'])){
    require("db.php");
    
    $Isbn = $_POST["Isbn"];
    $Title = $_POST["Title"];
    $Author = $_POST["Author"];
    $Status = $_POST["Status"];

    try {
        $sql = "INSERT INTO tblbook (Isbn, Title, Author, Status) VALUES (?, ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $Isbn, $Title, $Author, $Status);

        if($stmt->execute()){
            echo "<script>window.location.href='book.php';</script>";
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        if ($conn->errno == 1062) {
            echo "<div class='alert alert-warning mt-3'>
                    <i class='fa-solid fa-circle-exclamation'></i> 
                    <strong>Duplicate ISBN!</strong> A book with ISBN <b>$Isbn</b> already exists in the library.
                  </div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $e->getMessage() . "</div>";
        }
    }
}
?>
    </div>
</div>
</body>
</html>