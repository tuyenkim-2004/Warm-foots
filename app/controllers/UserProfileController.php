<?php
class UserProfileController extends Controller {
    private $model;

    public function __construct() {
        $this->model = $this->model("UserProfileModel"); // Khởi tạo model
    }

    // Hiển thị thông tin người dùng
    public function displayUserProfile() {  
        $userProfile = $this->model->loadUserProfile();

        if ($userProfile) {
            $this->view("LayoutUser", [
                "user" => "UserProfile",
                "user_data" => $userProfile
            ]);
        } else {
            header("location: /Warm-foots/AuthenticationController/login");
        }
    }

    // Chỉnh sửa thông tin người dùng
    public function editUserProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            // var_dump($password);
            $userModel = $this->model('UserProfileModel');
            
            $result = $userModel->updateUserProfile($name, $password);
            if($result){
                $this->displayUserProfile();
            }
        }
    }
}
?>
