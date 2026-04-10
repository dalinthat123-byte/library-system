<?php
session_start();
require("db.php"); 

$error_message = ""; 

if(isset($_POST["submit"])){
    $u = $_POST['username'];
    $p = md5($_POST['password']);

    $sql = "SELECT staffname FROM tblstaff WHERE username=? AND password=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $u, $p);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){
        $_SESSION['staffname'] = $row['staffname'];
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Invalid username or password!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Bright Library</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/layout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="bg-container">
        <div class="login-card">
            <h1>WELCOME BACK</h1>
            <p class="subtitle">Enter your credentials to access the BBL</p>
            <p class="role">- Librarian -</p>

            <form method="POST" action="">
                <div class="input-container">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-container">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="button-group">
                    <button type="button" class="btn-back" onclick="window.history.back();">Back</button>
                    <button type="submit" name="submit" class="btn-signin">SIGN IN</button>
                </div>
            </form>

            <?php if($error_message !== ""): ?>
                <p class="error-text">
                    <i class="fa-solid fa-circle-exclamation"></i> 
                    <?php echo $error_message; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>