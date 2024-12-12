<?php
    class AuthController extends Controller
    {
        public function register()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userName = $_POST['fullname'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirm_password'];
                $email = $_POST['email'];

                // Kiểm tra xác nhận mật khẩu
                if ($password !== $confirmPassword) {
                    $error = "Mật khẩu và xác nhận mật khẩu không khớp.";
                    $this->view('user/Register', ['error' => $error]);
                    return;
                }

                $userModel = $this->model('UserModel');
                if ($userModel->registerUser($userName, $email, $password)) {
                    header('Location: /user/login');
                    exit;
                } else {
                    $error = "Đăng ký không thành công.";
                    $this->view('user/Register', ['error' => $error]);
                }
            }
            $this->view('user/Register');
        }

        public function index() {
            $this->register();
        }

        public function hell() {
            echo "HEllo Hanh";
        }

        // public function login()
        // {
        //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //         $userName = $_POST['username'];
        //         $password = $_POST['password'];

        //         $userModel = $this->model('UserModel');
        //         $user = $userModel->authenticate($userName, $password);

        //         if ($user) {
        //             // Lưu thông tin người dùng vào session
        //             $_SESSION['user_id'] = $user['user_id'];
        //             $_SESSION['username'] = $user['user_name'];
        //             $_SESSION['role_id'] = $user['role_id']; // Lưu vai trò vào session

        //             // Chuyển hướng dựa trên vai trò
        //             if ($user['role_id'] == 1) {
        //                 header('Location: /admin/dashboard'); // Quản trị viên
        //             } else {
        //                 header('Location: /user/home'); // Người dùng bình thường
        //             }
        //             exit;
        //         } else {
        //             $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        //             $this->view('user/Login', ['error' => $error]);
        //         }
        //     }
        //     $this->view('user/Login');
        // }

        
    }

    

?>
