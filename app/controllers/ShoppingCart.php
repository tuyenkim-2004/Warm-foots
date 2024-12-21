<?php
require_once './app/models/CartModel.php';

class ShoppingCart extends Controller {

    public function index() {
        // Khởi tạo model
        $cartModel = $this->model('CartModel');
    
        // Lấy thông tin chi tiết giỏ hàng
        $cartDetails = $cartModel->getCartDetails();
    
        // Tính tổng giá trị giỏ hàng
        $totalPrice = 0;
        foreach ($cartDetails as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Render view với dữ liệu giỏ hàng và tổng giá trị
        $this->view('LayoutUser', [
            'user' => 'ShoppingCart',
            'cartDetails' => $cartDetails, // Truyền dữ liệu giỏ hàng vào view
            'totalPrice' => $totalPrice // Truyền tổng giá trị vào view
        ]);

    }
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
            $productId = intval($_POST['product_id']);
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
            $CartModel = $this->model('CartModel');
            $result = $CartModel->addProductToCart($productId, $quantity);
            
            if ($result) {
                // Lưu thông báo vào session
                $_SESSION['message'] = "Sản phẩm đã được thêm vào giỏ hàng!";
            } else {
                $_SESSION['message'] = "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.";
            }
    
            // Chuyển hướng về trang sản phẩm
            header("Location: /Warm-foots/Products"); // Đảm bảo đường dẫn đúng
            exit();
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }
}
?>