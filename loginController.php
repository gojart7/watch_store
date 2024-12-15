<?php 
include_once 'userRepository.php';

if(session_status() === PHP_SESSION_NONE) {
  session_start();
}

if(isset(($_POST['loginBtn']))){
    $email = isset($_POST['email']) ? $_POST['email'] : ''; 
    $password = isset($_POST['password']) ? $_POST['password'] : ''; 
    
    if(empty($email) || empty($password)) {
        echo "Fill all required fields!";
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
  
  
        $userRepository = new UserRepository;
        $user = $userRepository->getUserByEmail($email,$password);
    
        if(empty($user)){
          echo "email or Password is Incorrect!";
          
        }else{
            
        $_SESSION['email'] = $email;
          header("Location:index.php"); 
         exit;
        }
}
}
?>