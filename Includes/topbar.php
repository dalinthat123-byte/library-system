<div class="topbar d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Build Bright Library</h5>
    <?php
    session_start();
    if(isset($_SESSION['staffname'])){
        echo('
        <div class="d-flex align-items-center">
            <span class="me-2">Welcome, ' . $_SESSION['staffname'] . '</span>
            <img src="images/logo.png" alt="Logo" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
        </div>');
    } else {
        header("Location:login.php");
        exit();
    }
    ?>
</div>