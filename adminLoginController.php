<?php 
require_once 'adminRepository.php';

class AdminLoginController{
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

      $adminRepo = new AdminRepository();
      $admin = $adminRepo->getAdminByEmailandPass($email,$password);

      if(empty($admin)){
        $this->errorMessage = "Email or Password is incorrect!";
      }else {
        session_start();
        $_SESSION['adminemail']=$email;
        header("Location: dashboard.php");
        exit;
      }
    }
  }

  public function getErrorMessage(){
    return $this->errorMessage;
  }
}
?>