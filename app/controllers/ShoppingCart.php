<?php
require_once './app/models/CartModel.php';

class ShoppingCart extends Controller {
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST['product_id']);
            // Lấy product_id và quantity từ POST
            $productId = intval($_POST['product_id']);
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Mặc định quantity là 1

            // Khởi tạo model
            $CartModel = $this->model('CartModel');
            // Gọi phương thức addProductToCart từ model
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