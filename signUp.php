<?php 
require_once 'signupController.php';

$signupController = new SignUpController();
$signupController->handleSingUp();
$errmessage = $signupController->getErrorMessage();
$smessage = $signupController->getSuccedMessage();
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
    <div class="signUp">
      <h1 class="signUp-h">Sign Up</h1>
      <h3>Create Your Account</h3>
      <p>Become a member a save big!</p>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" onsubmit="return validateForm()">
      <div style="color: red;">
        <?= htmlspecialchars($errmessage ?? ''); ?>
      </div>
      <div style="color: green;">
        <?= htmlspecialchars($smessage ?? ''); ?>
      </div>
      <div class="input-container">
        <img src="assets/images/userIcon.png" alt="" />
        <input type="text" placeholder="Enter your name" name="name"  />
      </div>
      <div class="input-container">
        <img src="assets/images/userIcon.png" alt="" />
        <input type="text" placeholder="Enter your surname" name="surname"  />
      </div>
      <div class="input-container">
        <img src="assets/images/emailicon.png" alt="" />
        <input type="email" id="email" placeholder="Enter your email"  name="email"  />
        <span id="emailError" class="error-message"></span>
      </div>
      <div class="input-container">
        <img src="assets/images/passwordIcon.png" alt="" />
        <input
          type="password"
          id="password"
          placeholder="Enter your password"
          name="password"
        />
        <span id="passwordError" class="error-message"></span>
      </div>
      <div class="button">
        <!-- <button onclick="validateForm()">Sign Up</button> -->
         <input class="loginButton" type="submit" value="Sign up" name="signupBtn">    
      </div>
      </form>
      <p>Already have a account <a href="login.php">Login</a></p>
    </div>
    <script src="javascript/login.js"></script>
  </body>
</html>
