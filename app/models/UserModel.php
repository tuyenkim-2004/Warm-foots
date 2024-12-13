<?php

    class UserModel extends Database
    {
        private $user;
    //     public function __construct()
    //     {
    //         parent::__construct();
    //     }

    //     public function model()
    //     {
    //         return "users";
    //     }

    //     public function getUser($username, $password)
    //     {
    //         $tableName = $this->model();
    //         $params = [
    //             "username" => $username
    //         ];

    //         $data = $this->getData($tableName, $params);
    //         $result = array();
    //         foreach ($data as $row) {
    //             $result = $row;
    //         }
    //         if ($result && password_verify($password, $result['password'])) {
    //             return $result;
    //         } else {
    //             return null;
    //         }
    //     }

    // public function registerUser($name, $password, $email)
    // {
    //     $tableName = $this->model();
    //     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    //     $params = [
    //         'user_name' => $name,
    //         'password' => $hashedPassword,
    //         'email' => $email,
    //         'role_id' => 2
    //     ];
    //     print_r($params);

    //     error_log("Dữ liệu đăng ký: " . print_r($params, true)); // Ghi log dữ liệu

    //     try {
    //         $result = $this->insertData($tableName, $params);
    //         return true;
    //     } catch (Exception $e) {
    //         error_log("Lỗi trong registerUser: " . $e->getMessage()); // Ghi log lỗi
    //         return false;
    //     }
    // }
    public function registerUser($name, $password, $email){
            $qr = "INSERT INTO users(user_name, password, email, role_id) VALUES ('$name', '$password', '$email', 2)";
            $result = false;
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            return $result;
    }
    
}
