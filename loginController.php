<?php 
include_once 'userRepository.php';

session_start();
if(isset(($_POST['loginBtn']))){
    $email = isset($_POST['email']) ? $_POST['email'] : ''; 
    $password = isset($_POST['password']) ? $_POST['password'] : ''; 
    
    if(empty($email) || empty($password)) {
        echo "Fill all required fields!";
    }else{
     
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
  
        $userRepository = new UserRepository;
        $user = $userRepository->getUserByEmail(email: $email, password: $password);
    
        if(empty($user)){
          echo "email or Password is Incorrect!";
          exit();
        }
        else{
          header("location:index.php"); 
          exit();
        }
}
}
?>