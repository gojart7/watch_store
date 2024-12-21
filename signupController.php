<?php 
include_once 'userRepository.php';
include_once 'userModel.php';

class SignUpController{
    private $errorMessage;
    private $succedMessage;

    public function __construct(){
        $this->errorMessage="";
        $this->succedMessage="";
    }

    public function handleSingUp(){
        if(isset($_POST['signupBtn'])){
            $name = $_POST['name'] ?? '';
            $surname = $_POST['surname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if(empty($name) || empty($surname)|| empty($email)|| empty($password)){
                $this->errorMessage = "Fill all required fields!";
                return;
            }
            $id = rand(min:100, max:500);
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new UserModel($id,$name,$surname,$email,$password);

            $userRepo = new UserRepository();
            $existUser = $userRepo->getUserByEmail($email);
            if($existUser){
                $this->errorMessage = "User already exists!";
                return;
            }
            $userRepo->insertUser($user);
            $this->succedMessage = "Registered succesfully!";
        }
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function getSuccedMessage(){
        return $this->succedMessage;
    }
}
?>