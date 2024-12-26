<?php
class UserProfileModel extends Database{
    private $user_id;

    public function __construct() {
        parent::__construct(); // Gọi hàm khởi tạo của lớp cha
    }

    // Tải thông tin người dùng từ cơ sở dữ liệu
    public function loadUserProfile() {

        if (isset($_SESSION["user_id"])) {

            $this->user_id = $_SESSION["user_id"];
            $sql = "SELECT *  FROM users WHERE user_id = $this->user_id";
            // return $sql;
           $stmt = $this->prepare($sql);
    
           try {
            $data = $this->query(($sql));
            $user = $data->fetch_assoc();
            return $user;

            if ($user) {
                return $user;
             } else {
            // Xử lý lỗi nếu không truy vấn được
            throw new Exception("Không thể tải thông tin người dùng.");
        }
        } catch (Exception $e) {
            throw new Exception("Không thể tải thông tin người dùng.");
            // Xử lý lỗi nếu không truy vấn được
        }
    }
}




    // Getter cho username
//     public function getUsername() {
//         return $this->username;
//     }

//     // Getter cho email
//     public function getEmail() {
//         return $this->email;
//     }

//     // Phương thức xác thực mật khẩu
//     public function verifyPassword($password) {
//         return password_verify($password, $this->hashedPassword);
//     }
}
?>