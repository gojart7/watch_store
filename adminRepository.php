<?php 
include_once 'DatabaseConnection.php';

class AdminRepository {
    private $connection;

    function __construct()
    {
        $conn = new DatabaseConnection;
        $this->connection = $conn;
    }

    function getAdminByEmailandPass($email,$password){
        $conn = $this->connection->startConnection();

        $sql = "SELECT * FROM admins WHERE email = '$email' and password = '$password'";

        if($statement = $conn->query($sql)){
            $result = $statement->fetch_row();
            // echo "query is executed succesfuly";
            return $result;
        }else{
            return null;
        }
    }
}

?>