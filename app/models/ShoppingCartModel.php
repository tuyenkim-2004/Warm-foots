<?php
class ShoppingCart extends Database
    {
        private $user;
    

    public function createOrder($product_id,$quatity,$price){
        $qr = "INSERT INTO order(order_id,product_id,quatity,price)
        VALUES(1,$product_id,$quatity,$price)";
           $result = false;
           if (mysqli_query($this->con, $qr)) {
               $result = true;
           }
           return $result;
    
    }
    // public function loginUser($email){
    //     $sql = "SELECT * FROM users WHERE email = '$email'";
    //     return mysqli_query($this->con, $sql);
    // }
    
    
}