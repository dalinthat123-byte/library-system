<?php
require("db.php");

if(isset($_GET['BorrowID'])) {
    $BorrowID = $_GET['BorrowID'];
} else {
    header("Location: Borrowedbook.php");
    exit();
}

if(isset($_POST['btnsubmit'])){
    $Isbn = $_POST["Isbn"];
    $StaffID = $_POST["StaffID"];
    $BorrowDate = $_POST["BorrowDate"]; 
    $HiddenID = $_POST["HiddenID"];

    $sql = "UPDATE tblborrowbook SET Isbn=?, StaffID=?, BorrowDate=? WHERE BorrowID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $Isbn, $StaffID, $BorrowDate, $HiddenID);

    if($stmt->execute()){
        header("Location: Borrowedbook.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Borrowed Book</title>

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/layout.css" rel="stylesheet">
</head>
<body>
<?php include("includes/Sidebar.php"); ?>
<div class="main">
    <?php include("includes/Topbar.php"); ?>
    <div class="card-box">
    <h5>Edit Borrow Book Form</h5>

    <?php
    $sql_fetch = "SELECT * FROM tblborrowbook WHERE BorrowID=?;";
    $stmt_fetch = $conn->prepare($sql_fetch);
    $stmt_fetch->bind_param("s", $BorrowID);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();

    if($row = $result->fetch_assoc()){
    ?>
    <form method="post">
        <input type="hidden" name="HiddenID" value="<?php echo $BorrowID; ?>">

        <div class="col-md-6 mb-3">
            <label class="form-label">BorrowID</label>
            <input type="text" class="form-control" value="<?php echo $BorrowID; ?>" disabled>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Isbn</label>
            <input type="text" class="form-control" name="Isbn" value="<?php echo $row['Isbn']; ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">StaffID</label>
            <input type="text" class="form-control" name="StaffID" value="<?php echo $row['StaffID']; ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Borrow Date</label>
            <input type="date" class="form-control" name="BorrowDate" value="<?php echo $row['BorrowDate']; ?>">
        </div>

        <button type="submit" class="btn btn-success" name="btnsubmit">Update Book</button>
        <a href="Borrowedbook.php" class="btn btn-secondary">Cancel</a>
    </form>
    <?php } ?> 
    </div>
</div>
</body>
</html>