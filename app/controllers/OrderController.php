<?php
require_once './app/models/OrderModel.php';
class OrderController extends Controller {
    function index(){
        session_start();
        
        // Khởi tạo biến data
        $data = [];
        $totalAmount = 0;
        foreach ($data["orderDetails"] as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }
        $data["totalAmount"] = $totalAmount;
    
        // Lấy user_id từ session
        $userId = $_SESSION['user_id'] ?? null;
    
        if ($userId) {
            // Lấy giỏ hàng của người dùng
            $item = $this->model("OrderModel")->getCartItems($userId);
    
            // Truyền dữ liệu vào view
            $this->view("LayoutUser", [
                "user" => "Order",
                "orderDetails" =>$item,
                "totalAmount" => $data["totalAmount"]
            ]);
        } else {
            // Nếu không có user_id, chuyển hướng đến trang đăng nhập
            header("Location: /login");
            exit();
        }
    }
    
    public function checkout() {
        // session_start();
    
        // Lấy user_id từ session
        $userId = $_SESSION['user_id'] ?? null;
    
        if ($userId) {
            $cartDetails = $this->orderModel->getCartItems($userId);
    
            // Tính tổng số tiền
            $totalAmount = array_reduce($cartDetails, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);
    
            // Truyền dữ liệu vào view
            $data = [
                "orderDetails" => $cartDetails,
                "totalAmount" => $totalAmount,
            ];
    
            // Truyền dữ liệu tới view (nếu cần)
            $this->view("LayoutUser", $data);
        } else {
            // Nếu user chưa đăng nhập, chuyển hướng tới trang đăng nhập
            header("Location: /login");
            exit();
        }
    }
    
    // Xử lý đặt hàng
    public function placeOrder() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $orderDate = date('Y-m-d H:i:s');
            $address = $_POST['address'];
            $paymentMethod = $_POST['payment_method'] ?? 'cash on delivery';
            $status = 'Procesing';

            // Lấy thông tin giỏ hàng từ model
            $cartItems = $this->orderModel->getCartItems($userId);

            if (!empty($cartItems)) {
                // Tạo đơn hàng
                try {
                    $orderId = $this->orderModel->createOrder($userId, $orderDate, $address, $paymentMethod, $status, $cartItems);

                    // Xóa giỏ hàng sau khi đặt hàng
                    $this->orderModel->clearCart($userId);

                    // Chuyển hướng tới trang xác nhận
                    header("Location: /order/confirmation?id=$orderId");
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Your cart is empty.";
            }
        }
    }
}
?>
