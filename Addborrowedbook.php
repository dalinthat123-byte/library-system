<?php
if(isset($_POST['btnsubmit'])){
    require("db.php");
    
    $ID = $_POST["ID"];
    $Isbn = $_POST["Isbn"];
    $StaffID = $_POST["StaffID"];
    $BorrowDate = $_POST["BorrowDate"];

    $sql = "INSERT INTO tblborrowbook(ID, Isbn, StaffID, BorrowDate) VALUES(?,?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $ID, $Isbn, $StaffID, $BorrowDate);

    if($stmt->execute() === true){ 
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    
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
    <h5>Add Borrow book</h5>
    <form method="post">
        <div class="col-md-6 mb-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="ID" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Isbn</label>
            <input type="text" class="form-control" name="Isbn" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">StaffID</label>
            <input type="text" class="form-control" name="StaffID">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Borrow Date</label>
            <input type="date" class="form-control" name="BorrowDate" value="<?php echo date('Y-m-d'); ?>">
        </div>

        <button type="submit" class="btn btn-success" name="btnsubmit">Save Borrowedbook</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
    </div>
</div>
</body>
</html>