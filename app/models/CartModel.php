<?php

class CartModel extends Database {
    
    public function createCartForUser() {
        if (!isset($_SESSION['user_id'])) {
            return false; 
        }
        
        $userId = $_SESSION['user_id'];

        $stmt = $this->prepare("INSERT INTO carts (user_id) VALUES (?)");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return false;
        }
        $stmt->bind_param("i", $userId);
        
        if ($stmt->execute()) {
            return $this->con->insert_id; 
        } else {
            echo "Lỗi thực thi câu lệnh: " . $stmt->error; 
            return false;
        }
    }

    public function addProductToCart($productId, $quantity = 1) {
        if (!isset($_SESSION['user_id'])) {
            return false; 
        }
        var_dump($_SESSION['user_id']); 
        $userId = $_SESSION['user_id'];

        $cartId = $this->getCartIdByUserId($userId);
        if (!$cartId) {
            $cartId = $this->createCartForUser();
            if (!$cartId) {
                return false; 
            }
        }
        $stmt = $this->prepare("SELECT * FROM cart_details WHERE cart_id = ? AND product_id = ?");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return false;
        }
        $stmt->bind_param("ii", $cartId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity; 

            $stmt = $this->prepare("UPDATE cart_details SET quantity = ? WHERE cart_detail_id = ?");
            if (!$stmt) {
                echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
                return false;
            }
            $stmt->bind_param("ii", $newQuantity, $row['cart_detail_id']);
        } else {
            $stmt = $this->prepare("INSERT INTO cart_details (cart_id, product_id, quantity) VALUES (?, ?, ?)");
            if (!$stmt) {
                echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
                return false;
            }
            $stmt->bind_param("iii", $cartId, $productId, $quantity);
        }

        return $stmt->execute(); 
    }

    public function getCartItems() {
        if (!isset($_SESSION['user_id'])) {
            return []; 
        }

        $userId = $_SESSION['user_id'];
        $cartId = $this->getCartIdByUserId($userId);
        if (!$cartId) {
            return []; 
        }

        $stmt = $this->prepare("SELECT * FROM cart_details WHERE cart_id = ?");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return [];
        }
        $stmt->bind_param("i", $cartId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function getCartIdByUserId($userId) {
        $stmt = $this->prepare("SELECT cart_id FROM carts WHERE user_id = ?");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return null;
        }
        
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($row = $result->fetch_assoc()) {
            return $row['cart_id']; 
        } else {
            return null; 
        }
    }

    public function getCartDetails() {
        if (!isset($_SESSION['user_id'])) {
            return []; 
        }
    
        $userId = $_SESSION['user_id'];
        $cartId = $this->getCartIdByUserId($userId);
        if (!$cartId) {
            return []; 
        }
    
        $stmt = $this->prepare("
            SELECT cd.*, p.product_name, p.img_url, p.price 
            FROM cart_details cd 
            JOIN products p ON cd.product_id = p.product_id 
            WHERE cd.cart_id = ?
        ");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return [];
        }
    
        $stmt->bind_param("i", $cartId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function removeDetails($productID,$carId) {
        // Truy vấn SQL
        $sql = "DELETE FROM cart_details WHERE cart_id = $carId AND product_id = $productID";
        $stmt = $this->con->prepare($sql); 
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $result = $stmt->execute();
        return $result;
    }
}
?>