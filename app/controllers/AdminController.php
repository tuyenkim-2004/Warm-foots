<?php
require_once './app/models/UserModel.php';
require_once './app/models/ProductModel.php';

    class AdminController extends Controller
    {
        public function index()
        {
            $this->ManageUsers();
        }

        public function ManageUsers(){
            $userList = $this->model('UserModel');
            $result = $userList->getListUser();
            $this->view('LayoutAdmin',[
                "admin" => "ManageUsers",
                'userList' => $result
            ]);
        }

        function ManageProducts()
        {
            $productList = $this->model('ProductModel');
            $result = $productList->getProductList();
            $this->view(
                'LayoutAdmin',
                [
                    "admin" => "ManageProducts",
                    "productList" => $result
                ]
            );
        }

        function createUser()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = isset($_POST['username']) ? trim($_POST['username']) : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $email = filter_var(trim($_POST['email']),
                    FILTER_SANITIZE_EMAIL
                );
                $role = (int)$_POST['role'];

                $userModel = $this->model("UserModel");
                $result = $userModel->addUser($name, $password, $email, $role);


                if ($result) {
                    $_SESSION['message'] = "Thêm người dùng thành công."; 
                    header('Location: /Warm-foots/AdminController/ManageUsers'); 
                    exit();
                } else {
                    $_SESSION['error'] = "Thêm thất bại. Vui lòng thử lại.";
                    header('Location: /Warm-foots/AdminController/ManageUsers');
                    exit();
                }
            }
        }
    }
?>