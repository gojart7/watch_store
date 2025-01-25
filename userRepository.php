<?php 
include_once 'DatabaseConnection.php';

class UserRepository {
    private $connection;

    function __construct()
    {
        $conn = new DatabaseConnection;
        $this->connection = $conn;
    }

    function insertUser($user){
       
        $conn = $this->connection->startConnection();
       

        $id = $user->getId();
        $name = $user->getName();
        $surname = $user->getsurname();
        $email= $user->getemail();
        $password = $user->getPassword();


        $sql = "INSERT INTO users (id,Name,surname,email,Password) VALUES 
        ('$id','$name','$surname','$email','$password')";
        if(mysqli_query($conn,$sql)){
        // echo "query is executed succesfuly";
        }else{
            echo "This is an Error: ".mysqli_error($conn);
        }


    }

    function getUserByEmailandPass($email,$password){
        $conn = $this->connection->startConnection();

        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";

        if($statement = $conn->query($sql)){
            $result = $statement->fetch_row();
            // echo "query is executed succesfuly";
            return $result;
        }else{
            return null;
        }
    }

    function getUserByEmail($email){
        $conn = $this->connection->startConnection();

        $sql = "SELECT * FROM users WHERE email = '$email'";

        if($statement = $conn->query($sql)){
            $result = $statement->fetch_row();
            // echo "query is executed succesfuly";
            return $result;
        }else{
            return null;
        }
    }

    public function countAllusers(){
        $conn = $this->connection->startConnection();
        $query = "SELECT COUNT(*) AS total_users FROM users";

        if($statement = $conn->query($query)){
            $result = $statement->fetch_assoc();
            return $result['total_users'];
        }
        
        return 0;
    }
    public function getAllUsers() { 
        $conn = $this->connection->startConnection(); 
        $query = "SELECT * FROM users";
        $result = $conn->query($query); 
        $users = [];
    
        if ($result) { 
            while ($row = $result->fetch_assoc()) {
                $users[] = $row; 
            }
        } 
        return $users;
    }   
}

?>