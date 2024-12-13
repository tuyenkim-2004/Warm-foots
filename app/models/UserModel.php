<?php

    class UserModel extends Database
    {
        private $user;
    
    public function registerUser($name, $password, $email){
            $qr = "INSERT INTO users(user_name, password, email, role_id) VALUES ('$name', '$password', '$email', 2)";
            $result = false;
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            return $result;
    }

    public function loginUser($email){
        $sql = "SELECT * FROM users WHERE email = '$email'";
        return mysqli_query($this->con, $sql);
    }
    
}
