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

    public function countAlladmins(){
        $conn = $this->connection->startConnection();
        $query = "SELECT COUNT(*) AS total_admin FROM admins";

        if($statement = $conn->query($query)){
            $result = $statement->fetch_assoc();
            return $result['total_admin'];
        }
        
        return 0;
    }
}

?>