<?php


class AdminController extends Controller
{
    protected function loadModel($modelName)
    {
        return $this->model($modelName);
    }

    public function index()
    {
        $this->manageUsers();
    }

    public function manageUsers()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6; 
        $userModel = $this->loadModel('UserModel');
        $userList = $userModel->getListUser($page, $limit);
        $totalUsers = $userModel->getTotalUsers();
        $totalPages = ceil($totalUsers / $limit);
        $this->view('LayoutAdmin', [
            "admin" => "ManageUsers",
            'userList' => $userList,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'resultsPerPage' => $limit
        ]);
    }

    public function manageProducts()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $resultsPerPage = 4;
        
        $data = $this->loadModel('ProductModel')->getProductListAdmin($currentPage, $resultsPerPage);
        
        $this->view('LayoutAdmin', [
            "admin" => "ManageProducts",
            "productList" => $data['productList'],
            "totalProducts" => $data['totalProducts'],
            "currentPage" => $currentPage,
            "resultsPerPage" => $resultsPerPage,
        ]);
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $role = (int)($_POST['role'] ?? 0);

            $userModel = $this->loadModel("UserModel");
            $result = $userModel->addUser($name, $password, $email, $role);

            $this->handleResponse($result, 'Thêm người dùng thành công.', 'AdminController/ManageUsers', 'Thêm thất bại. Vui lòng thử lại.');
        }
    }

    public function updateProduct()
    {
        if (!isset($_POST['product_id'])) {
            echo "Product ID is missing.";
            exit();
        }

        $productId = intval($_POST['product_id']);
        $productName = $_POST['name'] ?? '';
        $productPrice = floatval($_POST['price'] ?? 0.0);
        $productQuantity = intval($_POST['quantity'] ?? 0);
        $productBrand = $_POST['brand'] ?? '';
        $img_url = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = 'public/imgs/';
            $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $fileName;

            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $img_url = $fileName;
                } else {
                    echo "Có lỗi xảy ra khi tải ảnh.";
                    return;
                }
            } else {
                echo "Chỉ cho phép các định dạng jpg, jpeg, png, gif, webp.";
                return;
            }
        }
        $productModel = $this->loadModel('ProductModel');
        $result = $productModel->updateProduct($productId, $productName, $productPrice, $productQuantity, $productBrand, $img_url);

        if ($result) {
            $this->manageProducts();
        } else {
            echo "Error updating product.";
        }
    }

    public function deleteUser()
    {
        $userId = $_GET['id'] ?? null;
        if ($userId) {
            $userModel = $this->loadModel("UserModel");
            $result = $userModel->deleteUser($userId);
            if ($result) {
                $this->manageUsers();
            }
        }
    }

    public function deleteProduct()
    {
        $productID = $_GET['id'] ?? null;
        if ($productID) {
            $productModel = $this->loadModel("ProductModel");
            $result = $productModel->deleteProduct($productID);
            if ($result) {
                $this->manageProducts();
            }
        }
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = intval($_POST['user_id'] ?? 0);
            $userName = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->loadModel('UserModel');
            $result = $userModel->updateUser($userId, $userName, $password, $email);

            if ($result) {
                $this->manageUsers();
            }
        }
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = floatval($_POST['price'] ?? 0); 
            $quantity = intval($_POST['quantity'] ?? 0);
            $brand = $_POST['brand'] ?? '';

            $img_url = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $targetDir = 'public/imgs/';
                $fileName = uniqid() . '_' . basename($_FILES['image']['name']); // Tạo tên file duy nhất
                $targetFile = $targetDir . $fileName;

                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($imageFileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        $img_url = $fileName; 
                    } else {
                        echo "Có lỗi xảy ra khi tải ảnh.";
                        return; 
                    }
                } else {
                    echo "Chỉ cho phép các định dạng jpg, jpeg, png, gif, webp.";
                    return; 
                }
            }

            $productModel = $this->model('ProductModel');
            $result = $productModel->addProduct($name, $price, $quantity, $brand, $img_url);

            if ($result) {
                $this->manageProducts();
            } else {
                echo "Có lỗi xảy ra khi thêm sản phẩm.";
            }
        }
    }

    private function handleResponse($result, $successMessage, $redirectUrl, $errorMessage)
    {
        if ($result) {
            $_SESSION['message'] = $successMessage;
            header("Location: $redirectUrl");
        } else {
            $_SESSION['error'] = $errorMessage;
            header("Location: $redirectUrl");
        }
        exit();
    }

    public function manageOrders()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 4; 
        $orderModel = $this->loadModel('OrderModel');
        $orderList = $orderModel->getOrdersAdmin($page, $limit);
        $totalOrders = $orderModel->getTotalOrders();
        $totalPages = ceil($totalOrders / $limit);
        $this->view('LayoutAdmin', [
            'admin' => 'ManageOrders',
            'orders' => $orderList,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'resultsPerPage' => $limit
        ]);
    }


    public function updateOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'] ?? null;
            $status = $_POST['status'] ?? null;
            if ($order_id && $status) {
                $this->model("OrderModel")->updateOrderStatus($order_id, $status);
            }
           $this->manageOrders();
        }
    }

    public function deleteOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'] ?? null;
            if ($order_id) {
                $this->model("OrderModel")->deleteOrder($order_id);
            }
            $this->manageOrders();
        }
    }


    public function searchProduct()
    {
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
        $productModel = $this->loadModel('ProductModel');
        $result = $productModel->searchProducts($searchQuery);
        $data = [
                "admin" => "ManageProducts",
                "productList" => $result, 
            ];
        if (empty($result)) {
            $data["message"] = "Không tìm thấy sản phẩm nào khớp với từ khóa.";
        }
        $this->view('LayoutAdmin', $data);
    }

    public function searchUsers()
    {
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
        $userList = $this->loadModel('UserModel')->searchUsers($searchQuery);
        $data = [
            "admin" => "ManageUsers",
            "userList" => $userList        
        ];
        $this->view('LayoutAdmin', $data);

    }


    public function searchOrders()
    {
        $buyerName = isset($_GET['buyer_name']) ? trim($_GET['buyer_name']) : '';
        $orders = $this->loadModel('OrderModel')->searchOrdersByBuyerName($buyerName);
        $data = [
            'admin' => 'ManageOrders',
            'orders' => $orders
        ];
        if (empty($result)) {
            $data["message"] = "Không tìm thấy sản phẩm nào khớp với từ khóa.";
        }
        $this->view('LayoutAdmin', $data);
    }

    public function showChart()
    {
        $products = $this->model("OrderModel")->getBestSellingProducts();
        // Kiểm tra dữ liệu
        if (empty($products)) {
            echo "Không có sản phẩm nào được bán.";
            return; 
        }

        $this->view('LayoutAdmin', [
            'admin' => 'DashBoard',
            'products' => $products
        ]);
    }
}
