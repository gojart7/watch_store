<?php 
// require_once 'auth_check.php';
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['adminemail'])) {
  header('Location: dashboard.php');
  exit;
}

require_once 'adminLoginController.php';  

$loginController = new AdminLoginController();
$loginController->handleLogin();
$errmessage = $loginController->getErrorMessage();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Watch Store</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" onsubmit="return validateForm()">
    <div class="signUp">
      <h1 class="signUp-h">Log In</h1>
      <div style="color: red;">
        <?= htmlspecialchars($errmessage ?? ''); ?>
      </div>
      <h3>Welcome Back Admin</h3>
      <!-- <p>Become a member a save big!</p> -->
      <div class="input-container">
        <img src="assets/images/emailicon.png" alt="" />
        <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="" />
        <span id="emailError" class="error-message"></span>
      </div>
      <div class="input-container">
        <img src="assets/images/passwordIcon.png" alt="" />
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Enter your password"
        />
        <span id="passwordError" class="error-message"></span>
      </div>
      <div class="button">
      <input class="loginButton" type="submit" value="Login" name="loginBtn">
        <!-- <button onclick="validateForm()">Login</button> -->
      </div>
      <p>Don't have a account <a href="signUp.php">Register now</a></p>
    </div>
  </form>
    <script src="login.js"></script>
  </body>
</html>
