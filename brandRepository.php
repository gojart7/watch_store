<?php
include_once 'DatabaseConnection.php';

class BrandRepository{
    private $connection;
    private $table = "brands";

    function __construct()
    {
        $conn = new DatabaseConnection;
        $this->connection = $conn->startConnection();
    }

    public function getAllBrands() { 
        
        $query = "SELECT * FROM " . $this->table;
        $result  = $this->connection->query($query);
        $brands = [];

        while ($row = $result->fetch_assoc()) {
            $brands[] = $row;
        }
        return $brands;
    }

    public function addBrand($name, $description) {
        $query = "INSERT INTO " . $this->table . " (name, description) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ss', $name, $description);
        return $stmt->execute();
    }

    public function deleteBrand($id) {
    $query = "DELETE FROM " . $this->table . " WHERE id = ?";
    $stmt = $this->connection->prepare($query); 
    $stmt->bind_param('i', $id);
    return $stmt->execute();
    }

    public function countAllBrands(){
        $query = "SELECT COUNT(*) AS total_brands FROM " . $this->table;
        $result = $this->connection->query($query);

        if($result){
            $row = $result->fetch_assoc();
            return $row['total_brands'];
        }
        return 0;
    }

    public function checkIfBrandIsUsed($brand_id){
        $query = "SELECT * FROM products where brand_id=?";
        $stmt = $this->connection->prepare($query); 
        $stmt->bind_param("i", $brand_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $isUsed = $result->num_rows > 0;
        $stmt->close();
        return $isUsed;
    }
}

?>