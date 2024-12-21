<?php
require_once './app/models/UserModel.php';
class AuthenticationController extends Controller
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

            if ($result) {
                header('Location: login');
                exit;
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại.";
                $this->view('user/Register', ['error' => $error]);
            }
        } else {
            $this->view('LayoutUser',[
                "user" => 'Register'
            ]);
        }

    }

   

    public function login()
    {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $UserModel = $this->model('UserModel');
        $result = $UserModel->loginUser($email);
        $user = mysqli_fetch_assoc($result);

        if ($user) {  
            if ($user['password'] == $password) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['login-time'] = time();
                $_SESSION['users'] = $user;
                switch ($user['role_id']) {
                    case 2: 
                        header('Location: /Warm-foots/Home/index');
                        exit(); // Dừng thực thi script
                    default: 
                        header('Location: /Warm-foots/Admin/products/index'); // Điều chỉnh nếu cần
                        exit();
                }
            } else {
                $this->view('LayoutUser', [
                    'user' => 'Login',
                    'error' => 'Mật khẩu không đúng!'
                ]);
            }
        } else {
            $this->view('LayoutUser', [
                'user' => 'Login',
                'error' => 'Email không tồn tại!'
            ]);
        }
    } else {
        $this->view('LayoutUser', [
            'user' => 'Login'
        ]);
    }
    }
    
}