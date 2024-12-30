<?php

    class UserModel extends Database
    {
    
    public function registerUser($name, $password, $email){
        $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->con->prepare($checkEmailQuery);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return false; 
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $qr = "INSERT INTO users(user_name, password, email, role_id) VALUES (?, ?, ?, 2)";
        $stmt = $this->con->prepare($qr);
        $stmt->bind_param('sss', $name, $hashedPassword, $email);

        if ($stmt->execute()) {
            return true;
        }
        return false; 
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
        $userList = [];
        while ($row = $this->fetch($results)) {
            $userList[] = $row;
        }

        return $userList;
    }


    public function updateUser($id, $name, $password, $email)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $qr = "UPDATE users SET user_name = '$name', password = '$hashedPassword', email = '$email' WHERE user_id = '$id'";

        if (mysqli_query($this->con, $qr)) {
            return true; // Cập nhật thành công
        } else {
            // In ra lỗi nếu có
            echo "Error updating record: " . mysqli_error($this->con);
            return false; // Cập nhật thất bại
        }
    }


    public function deleteUser($userId)
    {
        $deleteCartDetails = "DELETE cd FROM cart_details cd 
                          JOIN carts c ON cd.cart_id = c.cart_id 
                          WHERE c.user_id = $userId";
        if (!mysqli_query($this->con, $deleteCartDetails)) {
            echo "Lỗi khi xóa bản ghi trong bảng cart_details: " . mysqli_error($this->con);
            return false;
        }
        $deleteCarts = "DELETE FROM carts WHERE user_id = $userId";
        if (!mysqli_query($this->con, $deleteCarts)) {
            echo "Lỗi khi xóa bản ghi trong bảng carts: " . mysqli_error($this->con);
            return false;
        }
        $qr = "DELETE FROM users WHERE user_id = $userId";
        if (mysqli_query($this->con, $qr)) {
            return true; 
        } else {
            echo "Lỗi: " . mysqli_error($this->con);
            return false; 
        }
    }
    
}
