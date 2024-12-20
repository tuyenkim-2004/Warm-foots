<?php
require_once './app/models/CartModel.php';

class ShoppingCart extends Controller {

    public function index() {
        // Khởi tạo model
        $cartModel = $this->model('CartModel');
    
        // Lấy thông tin chi tiết giỏ hàng
        $cartDetails = $cartModel->getCartDetails();
    
        // Render view với dữ liệu giỏ hàng
        $this->view('LayoutUser', [
            'user' => 'ShoppingCart',
            'cartDetails' => $cartDetails // Truyền dữ liệu giỏ hàng vào view
        ]);
    }
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
            $productId = intval($_POST['product_id']);
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
            $CartModel = $this->model('CartModel');
            $result = $CartModel->addProductToCart($productId, $quantity);
            if ($result) {
                echo "Sản phẩm đã được thêm vào giỏ hàng!";
            } else {
                echo "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.";
            }
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }
}
?>