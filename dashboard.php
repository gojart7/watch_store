<?php 
if(session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  if (!isset($_SESSION['adminemail'])) {
    header('Location: adminLogin.php');
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<a href="adminLogout.php">Logout</a>
<body>
    
</body>
</html>