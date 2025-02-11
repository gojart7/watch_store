<?php
include_once 'DatabaseConnection.php';

class ProductRepository{
    private $connection;
    private $table = "products";

    function __construct()
    {
        $conn = new DatabaseConnection;
        $this->connection = $conn->startConnection();
    }

    public function getAllProducts() { 
        
        $query = "SELECT products.*, brands.name AS brand_name FROM products LEFT JOIN brands ON products.brand_id = brands.id";
        $result  = $this->connection->query($query);
        $prods = [];

        while ($row = $result->fetch_assoc()) {
            $prods[] = $row;
        }
        return $prods;
    }

    public function addProductToDatabase($name, $description, $price, $brand_id, $imagePath) {
        $query = "INSERT INTO " . $this->table . " (name, description, price,brand_id, image) VALUES (?, ?, ?, ? ,?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssdis", $name, $description, $price,$brand_id, $imagePath);
        $stmt->execute();
        $stmt->close();
    }
    
    public function deleteProductById($id) {
        $query = "SELECT image FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
    
        if ($product) {
            //del image
            if (file_exists($product['image'])) {
                unlink($product['image']);
            }
        }
        $stmt->close();
    
        // delete prod
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
    
        return $affectedRows > 0;
    }
    public function updateProduct($id, $name, $description, $price, $brand_id,$imagePath) {
        $query = "UPDATE " . $this->table . " 
                  SET name = ?, description = ?, price = ?,brand_id=? ,image = ? 
                  WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssdisi", $name, $description, $price,$brand_id, $imagePath, $id);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
    
        return $affectedRows > 0;
    }    
    
    public function getProductById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
    
        return $product;
    }
    public function countAllProds(){
        $query = "SELECT COUNT(*) AS total_prods FROM " . $this->table;
        $result = $this->connection->query($query);

        if($result){
            $row = $result->fetch_assoc();
            return $row['total_prods'];
        }
        return 0;
    }
}
?>