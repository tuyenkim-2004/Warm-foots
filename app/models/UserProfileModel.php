<?php
class UserProfileModel extends Database
{
    private $user_id;

    public function __construct()
    {
        parent::__construct(); // Gọi hàm khởi tạo của lớp cha
    }

    // Tải thông tin người dùng từ cơ sở dữ liệu
    public function loadUserProfile()
    {
        if (isset($_SESSION["user_id"])) {
            $this->user_id = $_SESSION["user_id"];
            $sql = "SELECT * FROM users WHERE user_id = $this->user_id";
            $stmt = $this->prepare($sql);

            try {
                $data = $this->query($sql);
                $user = $data->fetch_assoc();
                return $user;
            } catch (Exception $e) {
                throw new Exception("Không thể tải thông tin người dùng.");
            }
        }
    }

    // Cập nhật thông tin người dùng
    public function updateUserProfile($name, $password)
    {
        if (!isset($_SESSION['user_id'])) {
            return false; 
        }
        
        $userId = $_SESSION['user_id'];

        $qr = "UPDATE users SET user_name ='$name', password = '$password' WHERE user_id = '$userId'";
            $result = false;
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            return $result;

    }

}
?>
