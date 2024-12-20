<?php
class DetailModel extends Database {
    public function getProductDetails($productID) {
        // Truy vấn SQL
        $sql = "SELECT p.*, c.name AS name 
                FROM products p
                JOIN categories c ON p.category_id = c.category_id
                WHERE p.product_id = ?";

    
        $stmt = $this->con->prepare($sql); 
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>


