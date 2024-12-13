<?php
require_once './app/models/UserModel.php';
class AuthController extends Controller
{

    public function index()
    {
        $this->register();
    }
    
    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';

            if (empty($name) || empty($password) || empty($confirmPassword) || empty($email)) {
                $error = "Vui lòng điền đầy đủ thông tin.";
                $this->view('user/Register', ['error' => $error]);
                return;
            }

            if ($password !== $confirmPassword) {
                $error = "Mật khẩu và xác nhận mật khẩu không khớp.";
                $this->view('user/Register', ['error' => $error]);
                return;
            }
            $userModel = $this->model('UserModel');
            $result = $userModel->registerUser($name, $password, $email);
            print_r($result);
            
            if ($result) {
                header('Location: login');
                exit;
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại.";
                $this->view('user/Register', ['error' => $error]);
            }
        } else {
            $this->view('user/Register');
        }
    }

   

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $UserModel = $this->model('UserModel');
            $result = $UserModel->loginUser($email);

            if ($result) {
                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;

                    if ($user['role_id'] == 2) {
                        header("Location: LayoutUser/index"); // Trang người dùng
                    } else {
                        header("Location: layouts/LayoutAdmin"); // Trang admin
                    }
                    exit; 
                } else {
                    $error = "Email hoặc mật khẩu không đúng.";
                }
            } else {
                $error = "Email hoặc mật khẩu không đúng.";
            }
        }

        $this->view('user/Login');
    }
}
