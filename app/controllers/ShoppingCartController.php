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
            header("Location: /Warm-foots/ProductController"); // Đảm bảo đường dẫn đúng
            exit();
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }
    public function removeToCart() {
        // Kiểm tra tham số đầu vào cos proId và cartId trong đường dẫn k (vd /shopingcartController/removetocart?proID=1&cartId=13) sau ? k ah tới đường link
        if (!isset($_GET['proId']) || !isset($_GET['cartId'])) {
            $_SESSION['message'] = "Thiếu tham số sản phẩm hoặc giỏ hàng.";
            header("Location: /Warm-foots/ProductController");
            exit();
        }
    
        // Chuyển đổi tham số đầu vào thành số nguyên
        $productId = intval($_GET['proId']);
        $cartID = intval($_GET['cartId']);
    
        // Gọi model để xử lý logic xóa sản phẩm
        $CartModel = $this->model('CartModel');
        $result = $CartModel->removeDetails($productId, $cartID);
    
        // Kiểm tra kết quả trả về
        if ($result) {
            // Lưu thông báo vào session
            $_SESSION['message'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
        } else {
            $_SESSION['message'] = "Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng.";
        }
    
        // Chuyển hướng về trang sản phẩm
        header("Location: /Warm-foots/ShoppingCartController/index"); // Đảm bảo đường dẫn đúng
        exit();
    }
    
}
?>