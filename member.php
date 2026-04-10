<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Members</title>

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
        <?php 
            $text = isset($_POST['txtsearch']) ? $_POST['txtsearch'] : null; 
            $filterby = isset($_POST['filterby']) ? $_POST['filterby'] : 'Name'; // Default filter
        ?>
        
        <form method="post">
            <input type="radio" name="filterby" id="rbtid" value="ID" <?php echo($filterby=='ID' ? 'checked' : null) ?>>
            <label for="rbtid" class="me-2">ID</label>

            <input type="radio" name="filterby" id="rbtName" value="Name" <?php echo($filterby=='Name' ? 'checked' : null) ?>>
            <label for="rbtName" class="me-2">Name</label>

            <input type="radio" name="filterby" id="rbtGender" value="Gender" <?php echo($filterby=='Gender' ? 'checked' : null) ?>>
            <label for="rbtGender" class="me-2">Gender</label>

            <input type="radio" name="filterby" id="rbtPhone" value="Phone" <?php echo($filterby=='Phone' ? 'checked' : null) ?>>
            <label for="rbtPhone" class="me-2">Phone</label>

            <input type="text" name="txtsearch" value="<?php echo($text) ?>" placeholder="Search here...">
            <input type="submit" name="btnsearch" value="Search" class='btn btn-sm btn-primary'>
            <input type="submit" name="btnreset" value="Reset" class='btn btn-sm btn-secondary'>
        </form>

        <table class="table table-bordered table-hover mt-3">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Join Date</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require("db.php");
            $sql = "SELECT * FROM tblmember";

            if(isset($_POST["btnsearch"]) && !empty($text)){
                switch($filterby){
                    case 'ID': 
                        $sql .= " WHERE ID = ?";
                        break;
                    case 'Name': 
                        $sql .= " WHERE Name LIKE CONCAT('%',?,'%')";
                        break;
                    case 'Gender': 
                        $sql .= " WHERE Gender = ?";
                        break;
                    case 'Phone': 
                        $sql .= " WHERE Phone LIKE CONCAT('%',?,'%')";
                        break;
                }
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $text);
            } else {
                $stmt = $conn->prepare($sql);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["Gender"] . "</td>";
                echo "<td>" . $row["Phone"] . "</td>";
                echo "<td>" . $row["JoinDate"] . "</td>";
               echo "<td>
                        <a href='EditMember.php?ID=" . $row["ID"] . "' class='btn btn-sm btn-warning'>Edit</a> |
                        <button type='button' 
                                class='btn btn-sm btn-danger' 
                                data-bs-toggle='modal' 
                                data-bs-target='#deleteModal' 
                                data-id='" . $row["ID"] . "'>
                            Delete
                        </button>
                    </td>";
            }
            ?>
            </tbody>
        </table>
        
        <p>
            <a href="AddMember.php" class="btn btn-sm btn-success">Add New Member</a>
        </p>
    </div>
</div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this member?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete Member</a>
      </div>
    </div>
  </div>
</div>

    <script>
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const memberId = button.getAttribute('data-id');
                const confirmBtn = deleteModal.querySelector('#confirmDeleteBtn');
                confirmBtn.href = 'DeleteMember.php?ID=' + memberId;
            });
        }
    </script>

</body>
</html>