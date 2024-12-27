<?php
require_once './app/models/CartModel.php';

class ShoppingCartController extends Controller {

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
            header("Location: /Warm-foots/ProductController"); // Đảm bảo đường dẫn đúng
            exit();
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }
    public function removeToCart() {
        header('Content-Type: application/json'); // Đảm bảo phản hồi là JSON
        if (!isset($_GET['proId']) || !isset($_GET['cartId'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Thiếu tham số sản phẩm hoặc giỏ hàng.'
            ]);
            return;
        }
    
        $productId = intval($_GET['proId']);
        $cartID = intval($_GET['cartId']);
        $CartModel = $this->model('CartModel');
        $result = $CartModel->removeDetails($productId, $cartID);
    
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi xóa sản phẩm.'
            ]);
        }
    }

    public function updateQuantity() {
        header('Content-Type: application/json'); // Đảm bảo nội dung trả về là JSON
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartId = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
            $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    
            if ($cartId > 0 && $productId > 0 && $quantity > 0) {
                $cartModel = $this->model('CartModel');
                $newTotalPrice = $cartModel->updateQuantity($cartId, $productId, $quantity);
    
                if ($newTotalPrice) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Cập nhật số lượng thành công.',
                        'totalPrice' => $newTotalPrice // Trả về số float, không định dạng
                    ]);
                    return;
                }
            }
            echo json_encode([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi cập nhật số lượng.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Yêu cầu không hợp lệ.'
            ]);
        }
    }
    public function getTotalPrice() {
        // Khởi tạo model
        $cartModel = $this->model('CartModel');
    
        // Lấy thông tin chi tiết giỏ hàng
        $cartDetails = $cartModel->getCartDetails();
    
        // Tính tổng giá trị giỏ hàng
        $totalPrice = 0;
        foreach ($cartDetails as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
    
        // Trả về JSON cho client
        echo json_encode([
            'status' => 'success',
            'totalPrice' => number_format($totalPrice, 2)
        ]);
        exit;
    }
    
}
?>