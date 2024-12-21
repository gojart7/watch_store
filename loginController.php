<?php 
require_once 'userRepository.php';

class LoginController{
  private $errorMessage;

  public function __construct(){
    $this->errorMessage="";
  }

  public function handleLogin(){
    if(isset($_POST['loginBtn'])){
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      if(empty(($email) || empty(($password)))){
        $this->errorMessage = "Fill all required fields!";
        return;
      }

      $userRepo = new UserRepository();
      $user = $userRepo->getUserByEmailandPass($email,$password);

      if(empty($user)){
        $this->errorMessage = "Email or Password is incorrect!";
      }else {
        session_start();
        $_SESSION['email']=$email;
        header("Location: index.php");
        exit;
      }
    }
  }

  public function getErrorMessage(){
    return $this->errorMessage;
  }
}
?>