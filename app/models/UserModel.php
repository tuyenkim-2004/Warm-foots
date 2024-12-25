<?php

    class UserModel extends Database
    {
    
    public function registerUser($name, $password, $email){
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $qr = "INSERT INTO users(user_name, password, email, role_id) VALUES ('$name', '$hashedPassword', '$email', 2)";
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

    public function addUser($name, $pass, $email, $role)
    {
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
        $qr = "INSERT INTO users(user_name, password, email, role_id) VALUES ('$name', '$hashedPassword', '$email', $role)";

        $result = false;
        if (mysqli_query($this->con, $qr)) {
            $result = true;
        }
        return $result;
    }

    public function getListUser(){
        $results = $this->query("SELECT * FROM users");
        if (!$results) {
            return [];
        }

        // Lấy tất cả các hàng
        $userList = [];
        while ($row = $this->fetch($results)) {
            $userList[] = $row;
        }

        return $userList;
    }


   

}
