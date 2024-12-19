<!-- // class ShoppingCart extends Database
//     {
//         private $user;
    

//     public function createOrder($product_id,$quatity,$price){
//         $qr = "INSERT INTO order(order_id,product_id,quatity,price)
//         VALUES(1,$product_id,$quatity,$price)";
//            $result = false;
//            if (mysqli_query($this->con, $qr)) {
//                $result = true;
//            }
//            return $result;
    
//     }
//     // public function loginUser($email){
//     //     $sql = "SELECT * FROM users WHERE email = '$email'";
//     //     return mysqli_query($this->con, $sql);
//     // }
    
    
// } -->


<?php
    class CartModel extends Database {
    
        public function createCartForUser($userId) {
            $stmt = $this->prepare("INSERT INTO cart (user_id) VALUES (?)");
            $stmt->bind_param("i", $userId);
            
            if ($stmt->execute()) {
                return $this->con->insert_id; // Return the cart ID if needed
            } else {
                return false; // Handle error appropriately
            }
        }
    
        public function addProductToCart($userId, $productId, $quantity) {
            // Fetch the cart ID for the user
            $cartId = $this->getCartIdByUserId($userId);
            if (!$cartId) {
                // If no cart is found, create one first
                $cartId = $this->createCartForUser($userId);
            }
    
            // Insert into cart_detail
            $stmt = $this->prepare("INSERT INTO cart_details (cart_id, product_id, quantity) VALUES ('$userId', '$productId', '$quantity' )");
            $stmt->bind_param("iii", $cartId, $productId, $quantity);
    
            return $stmt->execute();
        }
    
        public function getCartItems($userId) {
            $cartId = $this->getCartIdByUserId($userId);
            if (!$cartId) {
                return []; // No cart found
            }
    
            $stmt = $this->prepare("SELECT * FROM cart_items WHERE cart_id = ?");
            $stmt->bind_param("i", $cartId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    
        private function getCartIdByUserId($userId) {
            $stmt = $this->prepare("SELECT id FROM cart WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_column(); // Returns the cart ID
        }
    }

?>