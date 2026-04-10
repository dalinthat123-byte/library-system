<div class="topbar d-flex justify-content-between align-items-center">
    <h5 class="mb-0" style="font-weight: 600; color: #ffffff;">Build Bright Library</h5>
    
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['staffname'])){
        echo '
        <div class="d-flex align-items-center">
            <span class="me-3 text-muted"><div style="color: #ffffff";>Welcome, <strong>' . $_SESSION['staffname'] . '</strong></div></span>
            
            <div style="width: 40px; height: 40px; background-color: #e0e0e0; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fas fa-user" style="color: #888; font-size: 20px;"></i>
            </div>
        </div>';
    } else {
        header("Location: login.php");
        exit();
    }
    ?>
</div>