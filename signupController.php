<?php 
include_once 'userRepository.php';
include_once 'userModel.php';

$name=$surname=$email=$password="";

if(isset($_POST['signupBtn'])){
    if(empty($_POST['name'])|| empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['password'])){
        echo "<pre style='color:red; font-size:15px;'>Fill all required Fields</pre>";  
    }else{
        $id = rand(min:100, max:500);
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new UserModel($id,$name,$surname,$email,$password);

        $userRepository = new UserRepository;
        $existUser= $userRepository->getUserByEmail($email);
        if($existUser){
            echo "User already exists";
        }else{
            $userRepository->insertUser($user);
        }
    }
}
?>