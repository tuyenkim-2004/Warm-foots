<?php
class ShoppingCart extends Database
    {
        private $user;
    
    public function getPrice($price){
            
            $qr = "select*from warm_foots where price = '45' " ;
            $result = $qr;
            
            return $result;
    }

    // public function loginUser($email){
    //     $sql = "SELECT * FROM users WHERE email = '$email'";
    //     return mysqli_query($this->con, $sql);
    // }
    
    
}